<?php
// create custom plugin settings menu
add_action('admin_menu', 'svz_create_menu');

function svz_create_menu() {

	//create new top-level menu
	add_menu_page('StockViz Plugin Settings', 'StockViz Settings', 'administrator', __FILE__, 'svz_settings_page',plugins_url('/images/icon.png', __FILE__));

	//call register settings function
	add_action( 'admin_init', 'register_mysettings' );
}


function register_mysettings() {
	//register our settings
	register_setting( 'svz-settings-group', 'svz_font_name' );
	register_setting( 'svz-settings-group', 'svz_font_size' );
	register_setting( 'svz-settings-group', 'svz_background_color' );
}

function svz_settings_page() {
?>
<div class="wrap">
<h2>StockViz</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'svz-settings-group' ); ?>

    <table class="form-table">
        <tr valign="top">
        <th scope="row">Font</th>
        <td><input type="text" name="svz_font_name" value="<?php echo get_option('svz_font_name'); ?>" /></td>
        </tr>

        <tr valign="top">
        <th scope="row">Font Size</th>
        <td><input type="text" name="svz_font_size" value="<?php echo get_option('svz_font_size'); ?>" /></td>
        </tr>

        <tr valign="top">
        <th scope="row">Background Color</th>
        <td><input type="text" name="svz_background_color" value="<?php echo get_option('svz_background_color'); ?>" /></td>
        </tr>
    </table>

    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>

</form>
</div>
<?php } ?>