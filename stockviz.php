<?php /*

**************************************************************************

Plugin Name:  StockViz
Plugin URI:   http://stockviz.biz/plugins.aspx
Description:  Shortcodes to pull in the latest stock price of stocks listed in the Indian National Stock Exchange (NSE). Usage:[stockquote]INDUSINDBK[/stockquote]
Version:      2.0.0.0
Author:       Drona Analytics
Author URI:   http://drona-analytics.com/

**************************************************************************

Copyright (C) 2012 StockViz

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

**************************************************************************/

include 'option.php';

class StockVizCode {

	// Plugin initialization
	function StockVizCode() {
		// This version only supports WP 2.5+ (learn to upgrade please!)
		if ( !function_exists('add_shortcode') ) return;

		// Register the shortcodes
		add_shortcode( 'stockquote' , array(&$this, 'shortcode_quote') );
	}


	// No-name attribute fixing
	function attributefix( $atts = array() ) {
		if ( empty($atts[0]) ) return $atts;

		if ( 0 !== preg_match( '#=("|\')(.*?)("|\')#', $atts[0], $match ) )
			$atts[0] = $match[2];

		return $atts;
	}


	// Italics shortcode
	function shortcode_quote( $atts = array(), $content = NULL ) {
		if ( NULL === $content ) return '';
		$pg = $_SERVER['SERVER_NAME'];
		$pg = $pg.$_SERVER['REQUEST_URI'];
		$opts = array(
			'http'=>array(
			'method'=>"GET",
			'header'=>"Referer: ".$pg."\r\n"
			)
		);

		$context = stream_context_create($opts);

		$response = file_get_contents('http://stockviz.biz/api/plugin/equityinfo/?ticker='.$content, false, $context);

		$obj = json_decode($response);
		$color = 'green';
		$change = ($obj->CHANGE + 0.0);
		if ( $change < 0 )
			$color = 'red';
		$changeFmt = number_format($change, 2, '.', ',');

		$svzFont = get_option('svz_font_name');
		$svzFontSize = get_option('svz_font_size');
		$svzBackground = get_option('svz_background_color');

		//$svzFont = 'verdana';
		//$svzFontSize = '12px';
		//$svzBackground = 'blue';


		return '<span style="font-size:'.
			$svzFontSize.';font-family:'.
			$svzFont.';height:20px;padding-left:5px;padding-right:5px;background-color:'.
			$svzBackground.';display:inline-block;border-radius:3px 3px 3px 3px;-moz-border-radius: 3px;-webkit-border-radius: 3px;"><a style="text-decoration:none;" href="http://stockviz.biz/Equity.aspx?TICKER='.$content.'" title="'.$obj->NAME.'">'
			.$content.'</a> '.$obj->PX.' <span style="color:'.$color.'">'.$changeFmt.' '.$obj->CHANGE_PCT
			.'</span></span>';
	}
}

// Start this plugin once all other plugins are fully loaded
add_action( 'plugins_loaded', create_function( '', 'global $StockVizCode; $StockVizCode = new StockVizCode();' ) );
add_option('svz_font_name', 'verdana');
add_option('svz_font_size', '12px');
add_option('svz_background_color', '#E0E0FF');
?>