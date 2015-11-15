<?php

include_once 'defined-post-param.php';
if(isset($post['file-type']) && isset($post['file-name'])){
	echo '<div id="progressbar"><div class="progress-label">0%</div></div>';
	echo '<script type="text/javascript">updateProgress(0,\'0%\')</script>';
	ob_flush();
	flush();
	sleep(1);
	
	//get the file to loop through the records
	$post['file-name'] = $_POST['file-name'];
	$importFile = $post['file-name'];
	
	if($post['file-type']=='xml'){
		
		$fileData = file_get_contents(GTCDI_DIR . '/' . $importFile);
		
		$dom = new DomDocument();
		$dom->loadXML($fileData);
		$xmlArray = gtcd_xml_to_array($dom);
		
		$xmlRecords = gtcd_xml_records($xmlArray, $post['file-path']);
		$importFields = gtcd_get_xpath($xmlArray,$post['file-path']);
		$importFields = gtcd_get_keys($importFields);
		
		$post_types = array();
		foreach($xmlRecords as $key=>$value){
			$post_types[$key]['title'] = $value[$post['mapTitle']];
			$post_types[$key]['meta'] = gtcd_map_meta_fields($value,$post['mapMeta']);
			$post_types[$key]['tax'] = gtcd_map_tax_fields($value,$post['mapTax']);
			$post_types[$key]['photos'] = gtcd_map_photos($value, $post['mapPhoto']);
		}
	}elseif($post['file-type']=='csv'){
		$line = isset($_POST['csvline'])?$_POST['csvline']:0;
		$importData = array();
		if (($handle = fopen(GTCDI_DIR . '/' . $importFile, 'r')) !== FALSE) {
			while (($data = fgetcsv($handle, 1000, '|')) !== FALSE) {
				$importData[] = $data;
			}
			fclose($handle);
		}
		
		$columns = array_shift($importData);

		$importRecords = array();
		foreach($importData as $key=>$value){
			foreach($value as $key1=>$value1){
				$importRecords[$key][$columns[$key1]] = $value1;
			}
		}		

		$post_types = array();
		$conn_id = ftp_connect('ftp1.trader.com');
		ftp_login($conn_id, 'ONCE_FusionAS', ')15ueODb[n');
		$remote_files = ftp_nlist($conn_id, '/');
		$downloaded = array();
		$listing_totals = array('skipped' => 0, 'completed' => 0);
		
		// trim attributes name 
		foreach ($importRecords[$line] as $tr => $im) {
			unset($importRecords[$line][$tr]);
			$importRecords[$line][trim($tr)] = $im;
		}
			
		// ftp download csv.photos into vehicle.photos
		$postPhotos = array();
		foreach ($importRecords[$line] as $va => $lue) {
			if (!strpos($lue, '.jpg')) continue;
			$img = explode(',', $lue);
			foreach ($img as $i => $mg) {
				$download = trim($mg);
				if (strlen($download) < 1) continue;
				if (!in_array("/$download", $remote_files)) continue;
				if (file_exists(get_home_path() . $download)) continue;
				if (ftp_get($conn_id, get_home_path() . $download, $download, FTP_BINARY)) {
						$downloaded[] = get_home_path() . $download;
						$postPhotos[] = site_url($download); 
					}
				}
				$importRecords[$line][$va] = '';
			}
			ftp_close($conn_id);
			
			// mapping csv.options as vehicle.features
			$post['mapTax']['features'] = Array("field" => "Options","separator" => ",");
			$post_type['title'] = $importRecords[$line]['Make'] . ' ' . $importRecords[$line]['Model'];
			$post_type['meta'] = gtcd_map_meta_fields($importRecords[$line],$post['mapMeta']);
			$post_type['tax'] = gtcd_map_tax_fields($importRecords[$line],$post['mapTax']);
			$post_type['photos'] = $postPhotos;
	}
	$listing_totals = gtcdi_import_records(array($post_type));
	foreach ($downloaded as $dl) @unlink(get_home_path() . $dl);
	if ($line == count($importRecords) -1) @unlink(GTCDI_DIR . '/' . $importFile);
	else {
		$line++;
		?>
		<form method="POST" action="" id="bridge_form">
			<?php foreach($post as $name => $value): ?>
				<input type="hidden" name="<?= $name ?>" value="<?= $value ?>" />
			<?php endforeach; ?>
			<input type="hidden" name="csvline" value="<?= $line ?>" />
		</form>
		<script type="text/javascript">jQuery('form#bridge_form').submit()</script>
		<?php
	}
}
?>
<br><br>
<p><?php _e('File','language');?> <strong><?php print $_POST['file-name']; ?></strong><?php _e(' has successfully imported ','language');?><strong><?php echo ($listing_totals['completed']>0?$listing_totals['completed']:'0'); ?></strong><?php _e(' listings as ','language');?><strong><?php _e('pending','language');?></strong><?php _e(' status under Inventory.','language');?><br>
<?php if($listing_totals['skipped']>0){ ?><?php _e('There were','language');?> <strong><?php echo $listing_totals['skipped']; ?></strong><?php _e(' listings that were skipped because they already exist from a previous import.','language');?><br><?php } ?>
<br><?php _e('If you notice that some of your listings do not have photos attached it is because they were not found in the database.','language');?><br>
<?php _e('Please click ','language');?><a href="<?php echo get_admin_url(); ?>edit.php?post_status=publish&post_type=gtcd"><?php _e('here','language');?></a><?php _e(' to see your imported listings.','language');?></p>
