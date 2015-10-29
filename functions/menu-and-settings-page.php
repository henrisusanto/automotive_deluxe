<?php 	add_action('admin_menu', 'build_page');
	function build_page() 
		{
		global $submenu;
		$submenu['edit.php?post_type=gtre'][5][0] = __('View All Listings','language');
		$submenu['edit.php?post_type=user_listing'][5][0] = __('View All Listings','language');
	    add_theme_page(__('Currency and Metrics','language'),  __('Currency & Metrics','language'), 'add_users','currency_page', 'cm_settings_page','dashicons-admin-generic');

	add_theme_page(__('VIN Decoder Setup','language'),  __('VIN Decoder Setup','language'), 'add_users','edmund_api', 'cm_Edmund_API_page','dashicons-admin-generic');
	}
	add_action('admin_init', 'reg_fields'); 
	function reg_fields() 
	{
		add_settings_section('main_section', '', 'gorilla_t', 'currency_metrics');
		add_settings_section('main_section', '', 'gorilla_t', 'fields');		
		register_setting('gorilla_fields', 'gorilla_fields', 'validate_fields');
		register_setting('gorilla_symbols', 'gorilla_symbols', 'validate_symbols');		
		add_settings_field('currency', '<span class="optionmain"><strong>'.(__('Your Currency:','language')).'</strong></span>', 'currency_setting','currency_metrics', 'main_section');
		add_settings_field('metric', '<span class="optionmain"><strong>'.(__('Metric:','language')).'</strong></span>', 'metric_setting', 'currency_metrics', 'main_section');
		}
	
function cm_settings_page() 
	{
	?>
		<div id="theme-options-wrap" class="widefat">    
	    		<div id="icon-themes" class="icon32">
				<br />
			</div> 
			<h2><?php _e('Currency & Metrics','language') ?></h2>
			<form method="post" action="options.php" enctype="multipart/form-data">
				<?php settings_fields('gorilla_symbols'); ?>  
				<div class="tabber_container">
					<div class="block">
						<p><?php _e('Select your currency and metrics.','language')?></p>
						<?php do_settings_sections('currency_metrics'); ?>
					</div>
				</div>
				<p class="submit">
				 <input type="submit" name="submit" id="publish" class="button button-primary" value="<?php esc_attr_e('Save Changes','language'); ?>" >
				</p>
			</form>
		</div>
	<?php
	}

function cm_Edmund_API_page() 
	{	
	if (isset($_POST[Edmund_API])){
		update_option('Edmund_API', $_POST[Edmund_API]);
	}
	$Edmund_API = get_option('Edmund_API');
	?>
		<div id="theme-options-wrap" class="widefat martop">    
	    		<div id="icon-themes" class="icon32">
				<br />
			</div> 
			<h2><?php _e('Edmunds API Setup','language') ?></h2>
			<form method="post" action="" enctype="multipart/form-data">
            <?php if (isset($_POST[Edmund_API]) AND $_POST[Edmund_API] == ''){
			?>
	            <div class="error"><p><?php _e('Please insert API Key!','language');?></p></div>
            <?php
			}elseif (isset($_POST[Edmund_API]) AND $_POST[Edmund_API] != ''){
			?>
	            <div class="updated"><p><?php _e('API Key Updated!','language');?></p></div>            
            <?php
			}
			?>
             <table class="form-table">
                    <tbody>
                    	<tr valign="top">
                    	<p style="line-height:22px;font-size:13px"><?php _e('Go to ','language');?><a href="http://developer.edmunds.com/"><?php _e('Edmunds Developer Portal','language');?></a><?php _e(" to obtain the API Key",'language');?><?php _e(' and insert the alphanumeric key in the input field.','language')?></p>
                    	    <p style="line-height:22px;font-size:13px"><?php _e('Register a new free account on Edmunds website to get your API key in order to use the Automotive VIN Decoder.','language')?></p>
                    	      
                    	    
		                    <th scope="row">
		                    
                            <label for="blogname"><?php _e('Insert Edmunds API Vehicle Key','language')?></label>
                            </th><td>
                            	<input type="text" class="ed_api" value="<?php echo $Edmund_API;?>" class="ed_api" name="Edmund_API"> 
                            </td></tr>
                    	<tr valign="top">
		                    <th scope="row">
                            </th>	<td>
                            <input type="submit" name="submit" id="publish" class="button button-primary" value="<?php esc_attr_e('Save Changes','language'); ?>" >
                            
                            </td> </tr>                    
                    </tbody></table>      
			</form>      
			<div><a href="http://developer.edmunds.com/" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/common/220_color.png" alt="Edmunds"/></a></div>
		</div>
		
	<?php
}
function settings_page() {?>
<div id="theme-options-wrap" class="widefat">    
    <div id="icon-themes" class="icon32"><br /></div> 
      <h2><?php _e('Automotive Search Options Setup','language');?></h2>
      <form method="post" action="options.php" enctype="multipart/form-data">
         <?php settings_fields('gorilla_fields'); ?>
           <p><?php _e('Rename labels and options for the search module and hide-show each field in the form.','language');?></p>
		<h3 class="tabber legend"><a href="#"><?php _e("Fields","language"); ?></a></h3>
	<div class="tabber_container">
			<div class="block">			
				<?php do_settings_sections('fields'); ?>		</div>
			</div>
         <p class="submit">
            <input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes','language'); ?>" />
         </p>
   </form>
</div>
<?php }
function currency_setting() 
	{
		$options = get_option('gorilla_symbols'); 
		if(empty($options['currency']))
		{
			$options['currency'] = '$';
		} 
		else 
		{ 
			$options['currency'];
		}		
		$items = array("$","£","€","₤","¥","R$","元","Kč","Ft","₨","kr","Rp","₪","J$","Ls","Lt","RM","﷼","B/.","Ph","zł","﷼","le","ру,;","R","₩","kr","CHF","฿","YTL","Bs");		
	   	echo "<select name='gorilla_symbols[currency]'>";
	   	foreach ($items as $item) 
		{
			$selected = ( $options['currency'] === $item ) ? 'selected = "selected"' : '';
			echo "<option value='$item' $selected>$item</option>";
	   	}
	   	echo "</select>";
	}		
function metric_setting() 
	{
		$options = get_option('gorilla_symbols');
		if(empty($options['metric']))
		{
			$options['metric'] = 'sqft';
		} 
		else 
		{ 
			$options['metric'];
		}
		
		$items = array("Miles","Kilometers"); 
		
		echo "<select name='gorilla_symbols[metric]'>";		
		foreach ($items as $item) 
		{
			$selected = ( $options['metric'] === $item ) ? 'selected = "selected"' : '';
			echo "<option value='$item' $selected>$item</option>";
		}
		echo "</select>";
	}
?>