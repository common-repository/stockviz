=== Plugin Name ===
Contributors: stockviz
Donate link: http://stockviz.biz/
Tags: stocks,india,shortcode
Requires at least: 3.3.1
Tested up to: 3.3.1
Stable tag: 1.0.1.0

The Wordpress shortcode plugin allows you to pull in the latest stock price from within your post.

== Description ==

The Wordpress shortcode plugin allows you to pull in the latest stock price from within your post. 
Simply surround the stock symbol by the shortcode: stockquote and you are all set!

For example, to insert the latest quote for INDUSINDBK, simply put:
[stockquote]INDUSINDBK[/stockquote]
inside your post. 

Note: This only works for stocks listed in the Indian National Stock Exchange (NSE)

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `stockviz.php, option.php and the images folder` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Use settings to format the output

== Frequently Asked Questions ==

= How does it work? =

A http call is made to StockViz.biz and the resulting JSON is formatted and displayed within your post.

== Screenshots ==

The stock quote is embedded within your post.

== Changelog ==
= 2.0.0 =
* all new back-end

= 1.0.1 =
* minor bug fixes

= 1.0 =
* Initial version.

`<?php code(); // goes in backticks ?>`