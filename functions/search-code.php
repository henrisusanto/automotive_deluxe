<?php
function cps_add_query_vars( $qvars )

	{
		$qvars[] = 'searchquery';
		return $qvars;
	}
function cps_template_redirect_file()
	{
		global $wp_query;
		if ( $wp_query->get('searchquery') )
		{
			if (file_exists( TEMPLATEPATH . '/custom-search.php' ))
			{
				include( TEMPLATEPATH . '/custom-search.php' );
				exit;
			}
		}
	}
	add_filter('query_vars', 'cps_add_query_vars');
	add_action('template_redirect', 'cps_template_redirect_file');
	$use_ajax = get_option('cps_use_ajax');
	$options = my_get_theme_options();
		$array_taxonomy = array( 'makemodel', 'features','location');	
		if(($options['makemodelhide']) == 'on')
		{	  
		  $array_taxonomy = array_diff($array_taxonomy, array('makemodel'));
		}
		if(($options['state_hide']) == 'on')
		{	  
		  $array_taxonomy = array_diff($array_taxonomy, array('location'));
		}	
if(($options['featureshide']) == 'on')
		{	  
		  $array_taxonomy = array_diff($array_taxonomy, array('features'));	
		}
		$CPS_OPTIONS = array(
			'meta_boxes_vars' => array($meta_boxes,$feat_boxes,$comment_boxes),
			'taxonomies' =>  $array_taxonomy,
			'per_page' => get_option('posts_per_page'),
			'use_ajax' => (bool)$use_ajax,
			'slider_step' => 10000,
			'post_types' => array('gtcd','user_listing')
		);
		if(isset($_GET['searchquery'])){	
			$search_query = $_GET['searchquery'];
			$pieces = explode('/',$search_query);
			$new_parts = array();
			foreach($pieces as $piece){
				if(!trim($piece))
					continue;
				preg_match('/(?P<key>[^-]+)-(?P<val>.+)/', $piece, $matches);
				if(isset($matches['key']) && isset($matches['val']))
				$_GET[$matches['key']] = $matches['val'];
			}		
		}	
	add_action('wp_enqueue_scripts','cps_load_scripts_and_styles');
	add_action('wp_ajax_ajax_custom_search', 'cps_ajax_search');
	add_action('wp_ajax_nopriv_ajax_custom_search', 'cps_ajax_search');
	
function cps_search_form()
		{
			global $CPS_OPTIONS;
			?>	
			<div id="advSearchForm" class="print"> 			
			<form action="<?php echo get_site_url(); echo '/search' ?>" method="post"  class="advSearch" data-domain="<?php echo get_site_url() ?>" >  
				<div style="clear:both">
				<?php						
				cps_display_taxonomy_search_form($CPS_OPTIONS['taxonomies']);
				foreach($CPS_OPTIONS['meta_boxes_vars'] as $meta_boxes)
				{
					cps_display_meta_box_search_form($meta_boxes); 
				} 					
				$available_search_types = 2; //1 - both, 2 - only regular, 3 - only instant
				if ($available_search_types == 1) 
				{
					?>
					<p>Instant search:
					<label for="cps_use_ajax">On</label>
					<input type="radio" name="cps_use_ajax" id="cps_use_ajax" value="1" <?php echo (isset($_COOKIE['cps_use_ajax']) && $_COOKIE['cps_use_ajax'] == 1 ? 'checked="checked"' : '') ?> />
					<label for="cps_use_ajax2">Off</label>
					<input type="radio" name="cps_use_ajax" id="cps_use_ajax2" value="0" <?php echo (!isset($_COOKIE['cps_use_ajax']) || $_COOKIE['cps_use_ajax'] == 0 ? 'checked="checked"' : '') ?> />
					</p>
					<?php
				} 
				elseif ($available_search_types == 2) 
				{
				?>
					<input type="hidden" name="cps_use_ajax" id="cps_use_ajax" value="1" />
				<?php
				} else {
				?>
					<input type="hidden" name="cps_use_ajax" id="cps_use_ajax" value="0" />
				<?php
				}
				?>
				</div>
				<div style="clear:both"></div>
				 <div class="searchsub hide-for-small"><input class="search-btn" type="submit"  name="submit" value="<?php _e('Search','language');?>" /></div>             
                 <div class="row show-for-small">
                 	<div class="large-12 columns">
                  		<div class="searchsub"><input class="button expand" type="submit"  name="submit" value="<?php _e('Search','language');?>" /></div>
                  	</div>
                 </div>				                
			</form>
			<div style="clear:both"></div>
			</div>
			<?php
		}	
function cps_load_scripts_and_styles(){
		global $CPS_OPTIONS;
		wp_enqueue_script('cps_jq_hashchange',get_bloginfo('template_url').'/custom-search/js/jquery.ba-hashchange.min.js');
		wp_enqueue_script('cps_jq_search',get_bloginfo('template_url').'/custom-search/js/search.js', false, '5');
	}
function cps_display_meta_box_search_form($meta_boxes){	
		global $CPS_OPTIONS;
		foreach($meta_boxes as $metaBox){	
			if(isset($metaBox['hide_in_search']) && $metaBox['hide_in_search'] === "on"){
				continue;
			}	
			switch($metaBox['type']){	
				case 'text':
				case 'textarea':
	?>				
					<div class="input_text"><label><?php echo $metaBox['title'] ?></label>
						<input type="text" name="<?php echo $metaBox['name']?>" value="" /></div>					

	<?php
			break;	
				case 'range':	
					$options = get_option('gorilla_symbols');
					$Range = cps_get_range('_'.$metaBox['name']);
					if(!isset($Range->min) || !isset($Range->max)) return;
					$formatted = number_format($Range->max);		
	?>
	<script type="text/javascript">
function addCommas(nStr)
	{
		nStr += '';
		x = nStr.split('.');
		x1 = x[0];
		x2 = x.length > 1 ? '.' + x[1] : '';
		var rgx = /(\d+)(\d{3})/;
		while (rgx.test(x1)) {
			x1 = x1.replace(rgx, '$1' + ',' + '$2');
		}
		return x1 + x2;
	}
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
</script>
	<div class="drop"><select name="price" class="dropdown">
	<option value=""><?php _e('Any price','language');?></option>
    <?php


     $symbols = get_option('gorilla_symbols');

	 $step = $CPS_OPTIONS['slider_step'];

	 $start = $Range->min - $step;

	 $price = $start < 0 ? 0 : $start;

	

	while( $price <  $Range->max )

	{

		echo '<option value="' . $price .'-' . ($price+$step) . '">'.$symbols['currency']. number_format($price) . ' --- '.$symbols['currency'] . number_format($price+$step) . '</option>';

		$price += $step;

	}

	?>

    </select></div>



	<?php

					break;

	

				case 'checkbox':

	?>

					<div class="checkbox">

						<label><?php echo $metaBox['title'] ?></label>

						<input type="checkbox" name="<?php echo $metaBox['name']?>" value="<?php echo $metaBox['options'][1] ?>" />

					</div>

	<?php

					break;	

				case 'radio':							

					echo '<div class="radio">';

					foreach($metaBox['options'] as $radio_value) {

						echo '<input type="radio" name="'.$metaBox['name'].'" value="'.$radio_value.'" /> <span class="rlabel">'.$radio_value.'</span>';

					}

					echo '</div>';	

					break;	

				case 'dropdown':

					echo '<div class="drop">';//<label>'.$metaBox['title'].'</label><br/> */';

					echo '<select  class="'.$metaBox['class'].'" name="'.$metaBox['name'].'">';

					echo '<option value="">'.$metaBox['title'].'</option>';	

					foreach($metaBox['options'] as $dropdown_key => $dropdown_value) {

							echo '<option value="'.$dropdown_value.'">'.$dropdown_value.'</option>';

					}

					echo '</select></div>';	

					break;

			}	

		}

	}

function cps_ajax_search($meta_boxes){

	$posts = cps_search_posts();?>

	<div style="clear:both"></div>	
		 <div class="top-single-bar">


  <div class="searchSort"> <!-- search sort starts -->
      <div class="sort_each_item"  style="margin-right:5px"><?php _e('Sort By:','language');?></div>
      <div  class="sort_filters" id="filt_1">
	  <?php cps_sort_by('miles')  ?><span class="sort_seperator hide-for-small">&nbsp;-&nbsp;</span>
      </div>
      <div class="sort_filters" id="filt_2">
      <?php cps_sort_by('year') ?><span class="sort_seperator hide-for-small">&nbsp;-&nbsp;</span>
       </div>
       <div class="sort_filters" id="filt_3">
      <?php cps_sort_by('price') ?>
      </div>
    </div>
    
    <script>
		$('#filt_1 .sort_each_item > a').text('<?php _e('Miles','language');?>');
		$('#filt_2 .sort_each_item > a').text('<?php _e('Year','language');?>');
		$('#filt_3 .sort_each_item > a').text('<?php _e('Price','language');?>');
	</script>
            <div class="clear"></div>
            </div>


<div style="clear:both"></div>
<div class="detail-page-content hideOnSearch">

<?php wp_reset_postdata();?>
<?php $displayed = array();
	    if(!empty($posts)): foreach($posts as $post): 
		if(in_array($post->ID,$displayed)):
		continue;
		else:
		$displayed[] = $post->ID;
		endif;
		?>
<?php global $options;$fields;$options2;$options3;$symbols;
	  $fields = get_post_meta($post->ID, 'mod1', true);
	  $options2 = get_post_meta($post->ID, 'mod2', true);
	  $options3 = get_post_meta($post->ID, 'mod3', true);
	  $symbols = get_option('gorilla_symbols');
	  $options = my_get_theme_options(); ?>			
<?php $blogurl = get_bloginfo('template_url'); ?>
<?php $surl = get_bloginfo('url'); ?>	
<div class="result-car"> <!-- result car -->
<a class="result-car-link" href="<?php echo $post->post_name ?>" rel="bookmark" title="<?php echo $post->post_title ?>"><div class="cpsAjaxLoaderResults"></div>
<?php
if ( 'user_listing' == get_post_type($post->ID) ) {
	$args = array(
		'order'          => 'ASC',
		'orderby'        => 'menu_order',
		'post_type'      => 'attachment',
		'post_parent'    => $post->ID,
		'post_mime_type' => 'image',
		'post_status'    => null,
		'numberposts'    => 1,
		);
		$attachments = get_posts($args);
		if ($attachments) {
			foreach ($attachments as $attachment) {
				echo '<div class="vehicle-main-image">'.wp_get_attachment_image($attachment->ID, 'thumbnail_results').'<span class="'.$fields['statustag'].'"></span></div>';
				}
			} ?>
<?php
} elseif ( 'gtcd' == get_post_type($post->ID) ) {
	echo '<div class="vehicle-main-image">'.gorilla_img ($post->ID,'thumbnail_results').'<span class="'.$fields['statustag'].'"></span></div>';
}?><div class="result-detail-wrapper">  <!-- result detail wrapper -->
	<p class="vehicle-name"><span class="mini-hide"><?php if ( $fields['year']){ echo $fields['year'];}else {  echo ''; }?></span> <?php echo $post->post_title ?></p>
	<p class="vehicle-price show-for-small"><?php if ( $fields['year']){ echo $fields['year'];}else {  echo ''; }?> | <?php if (is_numeric( $fields['price'])){ echo '<span class="small-price">'.$symbols['currency'].number_format($fields['price']).'</span>';} else  { echo $fields['price']; } ?>&nbsp;|&nbsp;<?php if (isset( $fields['miles'])){
							echo number_format($fields['miles'],0,'.',',').' '.$options['miles_text'];
							}else {  echo ''; };?></p>
                           
	                        <p class="vehicle-miles show-for-medium-up hide-for-small"><strong><?php if (isset( $fields['miles'])){

							echo number_format($fields['miles'],0,'.',',').' '.$options['miles_text'];

							} else {  echo ''; };?></strong></p>

	                        <p class="vehicle-secondary-info"><?php if (isset( $fields['vehicletype'])){ echo $fields['vehicletype'].' | ';}else {  echo ''; };?> <?php if (isset( $fields['transmission'])){ echo $fields['transmission'];}else {  echo ''; };?>
							 
							<?php if (isset( $options2['cylinders'])){ echo '| '.$options2['cylinders'].' '.$options['number_cylinders_text'].' | ';}else {  echo ''; };?><?php if (isset( $fields['interior'])){ echo '<span class="mini-hide">'.$fields['interior'].'</span>';}else {  echo ''; };?><?php if (isset( $fields['epamileage'])){ echo '| <span class="mini-hide">'.$fields['epamileage'].'</span>';}else {  echo ''; };?>
                            </p>
	                        <p class="result-price show-for-medium-up hide-for-small"><?php 
							if (is_numeric( $fields['price'])){ echo $symbols['currency']; echo  number_format($fields['price']); } else  { echo $fields['price']; }
							?>
							</p>
							 <div style="clear:both;"></div>
                        </div> <!--   result detail wrapper ends -->
          <div style="clear:both;"></div>               
</a>
 </div> <!-- result car ends --> 
			<?php endforeach; else: ?>
				<p style="padding:30px;"><?php _e('Sorry, no listings matched your criteria.','language');?></p>
			<?php endif; ?>
			<div style="clear:both;"></div>  
			<div class="bottom-pagination"> <!-- Pagination starts -->
                    	<p><a id="link" href="#top"><?php _e('BACK TO TOP','language');?></a></p>
                    	<p class="paging">
                        	<?php cps_show_pagination() ?>
                        </p>
                  </div>  <!-- Pagination ends -->	
           		</div>
	<?php	
	exit;
}
function cps_breadcrumbs()
	{
		global $CPS_OPTIONS;
		$i = 0;
		$link = isset($_GET['cps_use_ajax']) && $_GET['cps_use_ajax'] ? '#search/' : get_site_url().'/search/';
		if( isset($CPS_OPTIONS['taxonomies']) && !empty($CPS_OPTIONS['taxonomies']) )
		{
			foreach($CPS_OPTIONS['taxonomies'] as $taxonomy)
			{
				if(isset($_GET[$taxonomy]) && trim($_GET[$taxonomy] != ''))
				{

					$term = get_term_by('name', $_GET[$taxonomy], $taxonomy);
					$ins_par = '';
					$separator = $i ? '<span><strong> &raquo; </strong></span>': '';
					$link .= $i ? '/' : '';
					$child_link = $link . $taxonomy . '-' . $_GET[$taxonomy];
					$ready_link = $child_link . '/';
					if (isset($_GET['cps_use_ajax']) && $_GET['cps_use_ajax']) 
					{
						$ready_link =  'javascript:manual_hashchange(\'' . urlencode($child_link) . '/\');';
					}
					$parent_term = get_term_by('id', $term->parent, $taxonomy);
					$ins_par .= getAllParentTermsLinks($parent_term , $link, $taxonomy, $ins_par);
					echo $separator . $ins_par .'<a href="' . $ready_link . '">' . $_GET[$taxonomy] . '</a>';
					$i++;
				}
			}
		}		
		foreach($CPS_OPTIONS['meta_boxes_vars'] as $meta_boxes)
		{
			foreach($meta_boxes as $metaBox)
			{
				if(isset($_GET[$metaBox['name']]) && trim($_GET[$metaBox['name']]) != '')
				{
					$separator = $i ? '<span><strong> &raquo; </strong></span>': '';
					$link .= $i ? '/' : '';
					$link .= $metaBox['name'].'-'.$_GET[$metaBox['name']];
					$ready_link = $link . '/';
					if (isset($_GET['cps_use_ajax']) && $_GET['cps_use_ajax']) 
					{
						$ready_link =  'javascript:manual_hashchange(\'' . urlencode($link) . '/\');';
					}
					echo "$separator <a href=\"" . $ready_link . "\" class='cps_breadcrumbs'>" . $metaBox['title'] . ': ' .$_GET[$metaBox['name']]."</a>";
					$i++;
				}
			}
		}
	}	
function getAllParentTermsLinks($parent_term , $link, $taxonomy, $ins_par)
	{
		if($parent_term)
		{
			$parent_link = $link . $taxonomy . '-' . $parent_term->name;										
			$ready_parent_link = $parent_link . '/';
			if (isset($_GET['cps_use_ajax']) && $_GET['cps_use_ajax']) 
			{
				$ready_parent_link =  'javascript:manual_hashchange(\'' . urlencode($parent_link) . '/\');';
			}	
			$ins_par = '<a href="' . $ready_parent_link . '">' . $parent_term->name . '</a>->' . $ins_par;
			$another_parent_term = get_term_by('id', $parent_term->parent, $taxonomy);
			return getAllParentTermsLinks($another_parent_term , $link, $taxonomy, $ins_par);
		}
		else
		{
			return $ins_par;
		}
	}
function cps_get_current_link(){

		global $CPS_OPTIONS;
		$link = isset($_GET['cps_use_ajax']) && $_GET['cps_use_ajax'] ? '#search/' : get_site_url().'/search/';
		$i = 0;
		if( isset($CPS_OPTIONS['taxonomies']) && !empty($CPS_OPTIONS['taxonomies']) ){
			foreach($CPS_OPTIONS['taxonomies'] as $taxonomy){
				if(isset($_GET[$taxonomy]) && trim($_GET[$taxonomy] != '')){
					$link .= $i ? '/' : '';
					$link .= $taxonomy.'-'.$_GET[$taxonomy];
					$i++;
				}
			}
		}
		foreach($CPS_OPTIONS['meta_boxes_vars'] as $meta_boxes){

			foreach($meta_boxes as $metaBox){
				if(isset($_GET[$metaBox['name']]) && trim($_GET[$metaBox['name']]) != ''){
					$link .= $i ? '/' : '';
					$link .= $metaBox['name'].'-'.$_GET[$metaBox['name']];
					$i++;
				}
			}
		}	
		$link .= $i === 0 ? '' : '/';
		if(isset($_GET['order'])){

			$link .='order-'.$_GET['order'].'/';

		}
		if(isset($_GET['orderdirection'])){

			$link .='orderdirection-'.$_GET['orderdirection'].'/';

		}
		return $link;

	}

function cps_show_pagination(){

		global $RES_COUNT;
		global $CPS_OPTIONS;
		$links_count = ceil($RES_COUNT/$CPS_OPTIONS['per_page']);
		if($links_count<2) return;
		$link = cps_get_current_link();
		if($_GET['page'] <=0)
			$_GET['page'] = 1;
		for($i=1;$i<=$links_count;$i++){
			$cur_class = '';
			if(isset($_GET['page']) && $_GET['page'] == $i ){
			$cur_class = 'current';
			}	    
	    if (isset($_GET['cps_use_ajax']) && $_GET['cps_use_ajax']) {
		$ready_link = 'javascript:manual_hashchange("' . urlencode($link) . 'page-' . $i . '/")';
	    } else {
		$ready_link = $link . "page-$i/";

	    }		
			echo "<a href='{$ready_link}' class='convertUrl $cur_class'>$i</a>";

		}

	}

function cps_sort_by($field){

	  global $CPS_OPTIONS;	  
	  $order_asc = '';
	  $order_desc = '';	
	  $bOrderAsc = true;
	  $link = isset($_GET['cps_use_ajax']) && $_GET['cps_use_ajax'] ? '#search/' : get_site_url().'/search/';
	  $i = 0;

		if( isset($CPS_OPTIONS['taxonomies']) && !empty($CPS_OPTIONS['taxonomies']) ){
		foreach($CPS_OPTIONS['taxonomies'] as $taxonomy){
		  if(isset($_GET[$taxonomy]) && trim($_GET[$taxonomy] != '')){
		    $link .= $i ? '/' : '';
		    $link .= $taxonomy.'-'.$_GET[$taxonomy];
		    $i++;
		  }
		}

	    }	

	  $cur_meta_box = array();

	  foreach($CPS_OPTIONS['meta_boxes_vars'] as $meta_boxes){

	    if(isset($meta_boxes[$field]['name'])){

		$cur_meta_box = $meta_boxes;

	    }	

	    foreach($meta_boxes as $metaBox){

		if(isset($_GET[$metaBox['name']]) && (is_array($_GET[$metaBox['name']]) || trim($_GET[$metaBox['name']]) != '')) {

		  $link .= $i ? '/' : '';

		  if (is_array($_GET[$metaBox['name']])) {

		    foreach($_GET[$metaBox['name']] as $value) {

			$link .= urlencode($metaBox['name'] . '[]-' . $value) . '/';

			

		    }

		    $link = substr($link, 0, -1);

		  } else {

		    $link .= $metaBox['name'].'-'.$_GET[$metaBox['name']];

		  }

		  $i++;

		}

	    }

	  }

	  $link .= $i ? '/' : '';

	  $link .= "order-$field";

	  

	  if(!isset($_GET['orderdirection']) && isset($_GET['order']) && $_GET['order'] == $cur_meta_box[$field]['name']){

	    $link .= "/orderdirection-desc";

	    

	    $bOrderAsc = false;

	  }

	  if (isset($_GET['order']) && $_GET['order'] == $cur_meta_box[$field]['name']) {

	

	  }	

	  $link .= '/';

	  if (isset($_GET['cps_use_ajax']) && $_GET['cps_use_ajax']) {

	  	$page_num=($_GET['page'] > 0)?$_GET['page']:1;

		

	    $link =  'javascript:manual_hashchange(\'' . urlencode($link) .'\');';

	  }

	  echo "<div class='sort_each_item'><a  href=\"" . $link . "\"> ".ucfirst($cur_meta_box [$field]['name'])."</a>";
 		echo "<div class='sorting'>";
	  echo "<a href=\"" . $link . "\">".($bOrderAsc ? $order_asc : $order_desc)."</a>";	 

	  

	  	echo "</div></div>";

	  	

	}

function cps_get_terms($taxonomy){	

		global $wpdb;	

		$q = "

			SELECT

				term.name

				FROM {$wpdb->term_taxonomy} tt

				INNER JOIN {$wpdb->terms} term ON term.term_id = tt.term_id

				WHERE taxonomy = '$taxonomy'

		";

		$result = $wpdb->get_col($q);

	

		return $result;	

	}

function cps_get_range($custom_field_key){
		global $wpdb;
		$q = "
			SELECT
				MAX(CAST(pm.meta_value AS SIGNED)) AS max,
				MIN(CAST(pm.meta_value AS SIGNED)) AS min
			FROM {$wpdb->postmeta} pm
			WHERE pm.meta_key = '$custom_field_key'
		";
		$result = $wpdb->get_row($q);	
		return $result;
	}
function cps_display_taxonomy_search_form($taxonomy_names){	
$options = my_get_theme_options();
if (isset($options['state_hide']) && $options['state_hide'] == "off") {
?>
<script type="text/javascript">
    $(function()
    {
        $('#location').change(function()
        {
            var $mainCat=$('#location :selected').attr('data-value');
            if(!$mainCat){
                $mainCat = $('#location').val();
            }
            // .call ajax
            $("#city").empty();
            $.ajax
            (
            {
                url:"<?php bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php", 
                type:'POST',
                data:'action=call_location&main_catid=' + $mainCat,
                success:function(results)
                {
                    options = $(results);
if(options.length > 1){
$("#city").removeAttr("disabled"); 
} else {
if(!$("#city").is(':disabled')){
$("#city").attr("disabled", "disabled"); 
}
}
$("#city").append(results); 
$("#city").selectBox('destroy');
$("#city").selectBox();    
                }
            }
        ); 
        });
    }); 
</script>             
<?php
 wp_dropdown_categories(array(
 	'orderby' => 'name',
 	'order'=> 'ASC',
                'show_count' => '0' ,
                'selected' => '1' ,
                'hierarchical' => '1' ,
                'depth' => '1' ,
                'hide_empty' => '1' ,
                'exclude' => '1' ,
                'class' => 'dropdown',
                'show_option_none' => __('Select State','language'),
                'option_none_value' => '',
                'name' => 'location' ,
                'taxonomy' => 'location' ,
                'walker' => new Walker_CategoryDropdown_Custom() ,
            ));?>

<select name="location" id="city"  class="dropdown" disabled="disabled"><option value=""><?php _e('Select City','language');?></option></select>
<?php 
} else { echo '';}
?>
<?php 
if (isset($options['make_hide']) && $options['make_hide'] == "off") {
?>
<script type="text/javascript">
    $(function()
    {      
        $('#makemodel').change(function()
        {
            var $mainCat=$('#makemodel :selected').attr('data-value');
            if(!$mainCat){
                $mainCat = $('#makemodel').val();
            }
            $("#model").empty();
            $.ajax
            (
            {
                url:"<?php bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php", 
                type:'POST',
                data:'action=name_call&main_catid=' + $mainCat,
                success:function(results)
                {
                    options = $(results);
if(options.length > 1){
$("#model").removeAttr("disabled"); 
} else {
if(!$("#model").is(':disabled')){
$("#model").attr("disabled", "disabled"); 
}
}
$("#model").append(results); 
$("#model").selectBox('destroy');
$("#model").selectBox();                     
                }
            }
        ); 
        });
    }); 
</script>             
<?php
 wp_dropdown_categories(array(

 				'orderby' => 'name',
 				'order'=> 'ASC',
                'show_count' => '1' ,
                'selected' => '1' ,
                'hierarchical' => '1' ,
                'depth' => '1' ,
                'hide_empty' => '0' ,
                'exclude' => '1' ,
                'class' => 'dropdown',
                'show_option_none' =>  __('Select Make','language'),
                'option_none_value' => '',
                'name' => 'makemodel' ,
                'taxonomy' => 'makemodel' ,
                'walker' => new Walker_CategoryDropdown_Custom() ,
            ));?>
<select name="makemodel" id="model"  class="dropdown" disabled="disabled"><option value=""><?php _e('Select Model','language');?></option></select>
<?php 
} else { echo '';}
?>
<?php }	

function generate_dropdown_options($hTerm)

		{
			if(is_array($hTerm))

			{
				foreach($hTerm as $tChild)
				{
					echo '<option value="'.trim($tChild->name).'">'.$tChild->title.'</option>';
					//echo generate_dropdown_options($tChild);
				}

			} 

			else 

			{

				echo '<option value="'.trim($hTerm->name).'">&raquo;'.$hTerm->title.'</option>';

			}

		}

	$RES_COUNT = 0;	

function cps_search_posts(){

	

		global $CPS_OPTIONS;
		global $wpdb;	
		$join  = '';
		$where = '';
		$order = '';
		$joinedMeta = array();
		$i = 0;

		// Custom fields

		foreach($CPS_OPTIONS['meta_boxes_vars'] as $meta_boxes){

			foreach($meta_boxes as $metaBox){

				$mb_name = $metaBox['name'];

				if(isset($_GET[$mb_name]) && trim($_GET[$mb_name]) != ''){	

					$join .= " JOIN $wpdb->postmeta meta$i

											ON meta$i.post_id = p.ID

											AND meta$i.meta_key = '_$mb_name' ";

	

					if($metaBox['type'] === 'range'){

						$pieces = explode('-',$_GET[$mb_name]);

						$where .= " AND meta$i.meta_value BETWEEN $pieces[0]+0 AND $pieces[1]+0 ";

					} else {

						$where .= " AND meta$i.meta_value = '{$_GET[$mb_name]}' ";

					}	

					$joinedMeta["meta$i"] = $mb_name;

					// Order:	

					if(isset($_GET["order"])){

						if($_GET["order"] === $mb_name){

							$asc = isset($_GET["orderdirection"]) ? $_GET["orderdirection"] : 'ASC';

							$order .= " meta$i.meta_value $asc ";

						}

					}

				$i++;

				} else {

					if(isset($_GET["order"])){

						if($_GET["order"] === $mb_name){

							//$subq="SELECT * FROM (";

							$asc = isset($_GET["orderdirection"]) ? $_GET["orderdirection"] : 'ASC';

							$join .= " LEFT JOIN $wpdb->postmeta meta$i

													ON meta$i.post_id = p.ID

													AND meta$i.meta_key = '_$mb_name' ";

							####Changes####

							if($mb_name == 'price'){

								$order .= " meta$i.meta_value+0 $asc ";

							}else{

								$order .= " meta$i.meta_value+0 $asc ";

							}

							//$order2.= ") ORDER BY meta$i.meta_value $asc ";

							$i++;

						}

					}

				}

			}

		}
			// Custom Taxonomies

			$is_search_by_tax = false;

			if( isset($CPS_OPTIONS['taxonomies']) && !empty($CPS_OPTIONS['taxonomies']) ){

				foreach($CPS_OPTIONS['taxonomies'] as $taxonomy){

					if(isset($_GET[$taxonomy]) && trim($_GET[$taxonomy] != '')){

		    $sAlias = preg_replace('#\W#', '_', $_GET[$taxonomy]);

						$is_search_by_tax = true;

						$where .= " AND terms_" .$sAlias . ".name = '{$_GET[$taxonomy]}' ";

		    

		    $join .= "

		     JOIN $wpdb->term_relationships tr_" .$sAlias . " ON tr_" .$sAlias . ".object_id = p.ID

		     JOIN $wpdb->term_taxonomy tt_" .$sAlias . " ON tr_" .$sAlias . ".term_taxonomy_id = tt_" .$sAlias . ".term_taxonomy_id

		     JOIN $wpdb->terms terms_" .$sAlias . " ON terms_" .$sAlias . ".term_id = tt_" .$sAlias . ".term_id

		  ";

					}

				}

			}

			// Pagination:

			$page_num = isset($_GET['page']) ? (int)$_GET['page'] : 1;

			if($page_num <= 0) $page_num = 1;

			

			$from = $CPS_OPTIONS['per_page']*($page_num-1);

			$count = $CPS_OPTIONS['per_page'];

			//echo $page_num;

			//die();

			// Order:

			$order_by = '';

			if(!empty($order)){

				$order_by = "ORDER BY ".rtrim($order, ',');

			}/*else{

				$asc = isset($_GET["orderdirection"]) ? $_GET["orderdirection"] : 'DESC';

				$order_by = "ORDER BY p.ID $asc";

			}*/

			if(!$asc){

				$asc = isset($_GET["orderdirection"]) ? $_GET["orderdirection"] : 'DESC';

			}

	

			$in_posts = implode("','", $CPS_OPTIONS['post_types']);		

			 global $wpdb;

			 

			 $main_query = "SELECT p.* FROM {$wpdb->base_prefix}posts p WHERE p.post_status = 'publish' AND p.post_type IN ('$in_posts') ORDER BY p.ID DESC LIMIT $from, $count";

			 

			 $sub_query = "SELECT * FROM ($main_query) p $join $where $order_by";

			 if($join && $order_by){

			 	$new_query=$sub_query;

			 }else{

			 	$new_query=$main_query;

				#### Hack########

				$asc = isset($_GET["orderdirection"]) ? $_GET["orderdirection"] : 'DESC';

				$order_by = "ORDER BY p.ID $asc";

				####  ended#######

			 }

         $query = "

            SELECT

               p.*

            FROM {$wpdb->base_prefix}posts p

               $join

            WHERE p.post_status = 'publish'

               -- Only custom posts:

               AND p.post_type IN ('$in_posts')

               $where

               $order_by

            LIMIT $from, $count";

	

			 global $RES_COUNT,$wpdb;

			 

           // SteveL modifications   

         $RES_COUNT = $wpdb->get_var("

            SELECT

               count(p.ID)

            FROM {$wpdb->base_prefix}posts p

               $join

            WHERE p.post_status = 'publish'

               -- Only custom posts:

               AND p.post_type IN ('$in_posts')

               $where

         ");

		 ### Changes###

		 	//

			$old_style=2;

			//echo $query;

			if($old_style >= 1){

				return $wpdb->get_results($query);

			}

		###### Changes#######

			return $wpdb->get_results($new_query);

	}

	function cps_ajax_search_results(){

		echo "<div id='cps_ajax_search_results'></div>";

	}

?>
