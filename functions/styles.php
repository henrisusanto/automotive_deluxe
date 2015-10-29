<?php
	add_action( 'admin_init', 'theme_options_init' );
	add_action( 'admin_menu', 'theme_options_add_page' );
function theme_options_init(){
	register_setting( 'automotive_options', 'automotive_theme_options', 'theme_options_validate' );
}
function theme_options_add_page() {
	add_theme_page( __( 'Theme Style', 'language' ), __( 'Theme Color', 'language' ), 'edit_theme_options', 'styles_page', 'theme_options_do_page' );
}
function theme_options_do_page() {
	global $select_options, $radio_options;
	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;
	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Options', 'language' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', 'language' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php 
				settings_fields( 'automotive_options' );
				$options = get_option( 'automotive_theme_options' ); 
				$theme_color = $options['color'];
				if (!$theme_color)
				$theme_color = "style";
				
			?>
			<table class="form-table">
              <hr />
              <h2><?php _e('Automotive Color Selection','language')?></h2>
                <tr valign="top">
					<td>
                        <label class="description" for="automotive_theme_options[color]"><?php _e('Select a color style for your website: ','language')?></label>
						<select id="automotive_theme_options[color]" class="regular-text" name="automotive_theme_options[color]" style="width:150px; color: #333;">
						<option value="style" <?php echo ($theme_color == "style") ? "selected='selected'" : ''; ?>><?php _e('Red','language')?></option>
						<option value="black" <?php echo ($theme_color == "black") ? "selected='selected'" : ''; ?>><?php _e('Black','language')?></option>
						<option value="purple" <?php echo ($theme_color == "purple") ? "selected='selected'" : ''; ?>><?php _e('Purple','language')?></option>
						<option value="green" <?php echo ($theme_color == "green") ? "selected='selected'" : ''; ?>><?php _e('Green','language')?></option>
						<option value="blue" <?php echo ($theme_color == "blue") ? "selected='selected'" : ''; ?>><?php _e('Blue','language')?></option>
						</select>
					</td>
				</tr>
			</table>
			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'language' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}
function theme_options_validate( $input ) {
	global $select_options, $radio_options;
	return $input;
}