<?php
global $wpdb, $meta_boxes, $feat_boxes, $comment_boxes;

/*
$meta_keys = $wpdb->get_results("SELECT postmeta.meta_key 
								 FROM $wpdb->postmeta AS postmeta
								 JOIN $wpdb->posts AS posts ON posts.ID = postmeta.post_id
								 WHERE posts.post_type = 'gtcd'");	
*/		

$meta_keys = array_merge($meta_boxes,$feat_boxes,$comment_boxes);					 

$meta = array();

//Loop through each of the returned keys
foreach ($meta_keys as $key=>$value) : 
	$meta_key = ltrim($value['name'], '_');
	
	if(!empty($feat_boxes[$meta_key]['name'])){
		$meta['_'.$meta_key] = array('parent' => 'feat_boxes', 'meta_key' => '_'.$meta_key, 'title' => $feat_boxes[$meta_key]['title'], 'name' => $feat_boxes[$meta_key]['name']);
	}elseif(!empty($meta_boxes[$meta_key]['name'])){
		$meta['_'.$meta_key] = array('parent' => 'meta_boxes', 'meta_key' => '_'.$meta_key, 'title' => $meta_boxes[$meta_key]['title'], 'name' => $meta_boxes[$meta_key]['name']);
	}elseif(!empty($comment_boxes[$meta_key]['name'])){
		$meta['_'.$meta_key] = array('parent' => 'comment_boxes', 'meta_key' => '_'.$meta_key, 'title' => $comment_boxes[$meta_key]['title'], 'name' => $comment_boxes[$meta_key]['name']);
	}
endforeach;

$taxonomies = get_object_taxonomies( 'gtcd','objects' );


//Build array of user import fields
$importFields = array();
$importFile = $_POST['file-name'];

if($_POST['file-type']=='xml'){
	$fileData = file_get_contents(GTCDI_DIR . '/' . $importFile);
	
	$dom = new DomDocument();
	$dom->loadXML($fileData);
	$xmlArray = gtcd_xml_to_array($dom);
	
	$importFields = gtcd_get_xpath($xmlArray,$_POST['file-path']);
	$importFields = gtcd_get_keys($importFields);
}elseif($_POST['file-type']=='csv'){
	$row = 1;
	if (($handle = fopen(GTCDI_DIR . '/' . $importFile, 'r')) !== FALSE) {
		while (($data = fgetcsv($handle, 1000, '|')) !== FALSE) {
			//get first line column names and break
			$importFields = $data;
			break;
		}
		fclose($handle);
	}
}

//create import fields drop down
$options = '';
foreach($importFields as $field){
	$options .= '<option value="'.$field.'">'.$field.'</option>';
}
?>
<p class="gtcdi_desc"><?php _e('The fields on the left are Automotive theme inventory fields. 
The fields on the right are the fields you are uploading from your file. 
Select the mapped field on the right with the corresponding Automotive field on the left. 
Once done, please click Import below.','language');?></p>


<form action="" method="post">
<input type="hidden" name="file-name" id="file-name" value="<?php print $_POST['file-name']; ?>">
<input type="hidden" name="file-type" id="file-type" value="<?php print $_POST['file-type']; ?>">
<input type="hidden" name="file-path" id="file-path" value="<?php print $_POST['file-path']; ?>">
<input type="hidden" name="step" value="import">
<table cellspacing="0" class="wp-list-table widefat fixed posts">
	<thead>
	<tr>
    	<th style="" class="manage-column column-title" id="title" scope="col"><span><?php _e('Automotive Post Title','language');?></span></th>
        <th style="" class="manage-column column-title" id="title" scope="col"><span><?php _e('File Import Fields','language');?></span></th>
	</tr>
	</thead>

	<tfoot>
	<tr>
    	<th style="" class="manage-column column-title" id="title" scope="col"><span><?php _e('Automotive Post Title','language');?></span></th>
        <th style="" class="manage-column column-title" id="title" scope="col"><span><?php _e('File Import Fields','language');?></span></th>
	</tr>
	</tfoot>

	<tbody id="the-list">
		<tr valign="top" class="status-publish hentry alternate iedit author-self">
			<td class="post-title page-title column-title"><?php _e('Vehicle Title','language');?></td>
            <td class="post-title page-title column-title">
            <select name="mapTitle" id="mapTitle">
            <option value=""><?php _e('Select Field','language');?></option>
			<?php echo $options; ?>
            </select>
            </td>			
		</tr>
	</tbody>
</table><br><br>


<table cellspacing="0" class="wp-list-table widefat fixed posts">
	<thead>
	<tr>
    	<th style="" class="manage-column column-title" id="title" scope="col"><span><?php _e('Automotive Meta Fields','language');?></span></th>
        <th style="" class="manage-column column-title" id="title" scope="col"><span><?php _e('File Import Fields','language');?></span></th>
	</tr>
	</thead>

	<tfoot>
	<tr>
    	<th style="" class="manage-column column-title" id="title" scope="col"><span><?php _e('Automotive Meta Fields','language');?></span></th>
        <th style="" class="manage-column column-title" id="title" scope="col"><span><?php _e('File Import Fields','language');?></span></th>
	</tr>
	</tfoot>

	<tbody id="the-list">
    	<?php foreach($meta as $key=>$value){ ?>
		<tr valign="top" class="status-publish hentry alternate iedit author-self">
			<td class="post-title page-title column-title"><?php echo $value['title']; ?></td>
            <td class="post-title page-title column-title">
            <select name="mapMeta[<?php echo $key; ?>]" id="mapMeta_<?php echo $key; ?>">
            <option value=""><?php _e('Select Field','language');?></option>
			<?php echo $options; ?>
            </select>
            </td>			
		</tr>
        <?php } ?>
	</tbody>
</table><br><br>


<table cellspacing="0" class="wp-list-table widefat fixed posts">
	<thead>
	<tr>
    	<th style="" class="manage-column column-title" id="title" scope="col"><span><?php _e('Automotive Taxonomy','language');?></span></th>
        <th style="" class="manage-column column-title" id="title" scope="col"><span><?php _e('File Import Fields','language');?></span></th>
        <th style="" class="manage-column column-title" id="title" scope="col"><span><?php _e('Separator','language');?></span></th>
        <th style="" class="manage-column column-title" id="title" scope="col"><span><?php _e('Hierarchy','language');?></span></th>
	</tr>
	</thead>

	<tfoot>
	<tr>
    	<th style="" class="manage-column column-title" id="title" scope="col"><span><?php _e('Automotive Taxonomy','language');?></span></th>
        <th style="" class="manage-column column-title" id="title" scope="col"><span><?php _e('File Import Fields','language');?></span></th>
        <th style="" class="manage-column column-title" id="title" scope="col"><span><?php _e('Separator','language');?></span></th>
        <th style="" class="manage-column column-title" id="title" scope="col"><span><?php _e('Hierarchy','language');?></span></th>
	</tr>
	</tfoot>

	<tbody id="the-list">
    	<?php foreach($taxonomies as $key=>$value){ ?>
		<tr valign="top" class="status-publish hentry alternate iedit author-self">
			<td class="post-title page-title column-title"><?php echo $value->labels->singular_name; ?></td>
            <td class="post-title page-title column-title">
            <select name="mapTax[<?php echo $key; ?>][field]" id="mapTax_<?php echo $key; ?>">
            <option value=""><?php _e('Select Field','language');?></option>
			<?php echo $options; ?>
            </select>
            </td>		
            <td class="post-title page-title column-title"><input type="text" name="mapTax[<?php echo $key; ?>][separator]" size="1" maxlength="1"></td>		
            <td class="post-title page-title column-title"><input type="checkbox" name="mapTax[<?php echo $key; ?>][hierarchy]" value="1"></td>		
		</tr>
        <?php } ?>
	</tbody>
</table><br><br>


<table cellspacing="0" class="wp-list-table widefat fixed posts">
	<thead>
	<tr>
    	<th style="" class="manage-column column-title" id="title" scope="col"><span><?php _e('Automotive Photo Gallery','language');?></span></th>
        <th style="" class="manage-column column-title" id="title" scope="col"><span><?php _e('File Import Fields','language');?></span></th>
        <th style="" class="manage-column column-title" id="title" scope="col"><span><?php _e('Separator','language');?></span></th>
	</tr>
	</thead>

	<tfoot>
	<tr>
    	<th style="" class="manage-column column-title" id="title" scope="col"><span><?php _e('Automotive Photo Gallery','language');?></span></th>
        <th style="" class="manage-column column-title" id="title" scope="col"><span><?php _e('File Import Fields','language');?></span></th>
        <th style="" class="manage-column column-title" id="title" scope="col"><span><?php _e('Separator','language');?></span></th>
	</tr>
	</tfoot>

	<tbody id="the-list">
		<tr valign="top" class="status-publish hentry alternate iedit author-self">
			<td class="post-title page-title column-title"><?php _e('Photo Gallery','language');?></td>
            <td class="post-title page-title column-title">
            <select name="mapPhoto[field]" id="mapPhoto[field]">
            <option value=""><?php _e('Select Field','language');?></option>
			<?php echo $options; ?>
            </select>
            </td>		
            <td class="post-title page-title column-title"><input type="text" name="mapPhoto[separator]" size="1" maxlength="1"></td>		
		</tr>
	</tbody>
</table><br><br>

<input type="submit" class="button button-primary" value="Continue &raquo;">
</form>
