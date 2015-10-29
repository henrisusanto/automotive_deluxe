<?php
if(isset($_POST['file-type']) && isset($_POST['file-name'])){
	echo '<div id="progressbar"><div class="progress-label">0%</div></div>';
	echo '<script type="text/javascript">updateProgress(0,\'0%\')</script>';
	ob_flush();
	flush();
	sleep(1);
	
	//get the file to loop through the records
	$importFile = $_POST['file-name'];
	
	if($_POST['file-type']=='xml'){
		
		$fileData = file_get_contents(GTCDI_DIR . '/' . $importFile);
		
		$dom = new DomDocument();
		$dom->loadXML($fileData);
		$xmlArray = gtcd_xml_to_array($dom);
		
		$xmlRecords = gtcd_xml_records($xmlArray, $_POST['file-path']);
		$importFields = gtcd_get_xpath($xmlArray,$_POST['file-path']);
		$importFields = gtcd_get_keys($importFields);
		
		$post_types = array();
		foreach($xmlRecords as $key=>$value){
			$post_types[$key]['title'] = $value[$_POST['mapTitle']];
			$post_types[$key]['meta'] = gtcd_map_meta_fields($value,$_POST['mapMeta']);
			$post_types[$key]['tax'] = gtcd_map_tax_fields($value,$_POST['mapTax']);
			$post_types[$key]['photos'] = gtcd_map_photos($value, $_POST['mapPhoto']);
		}
		
	}elseif($_POST['file-type']=='csv'){
		
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
		
		$post = Array
		(
    "file-name" => "convertcsv.csv",
    "file-type" => "csv",
    "file-path" => "",
    "step" => "import",
    "mapTitle" => "Model",
    "mapMeta" => Array
        (
            "_statustag" => "",
            "_featured" => "",
            "_topdeal" => "",
            "_year" => "Year",
            "_price" => "Price", 
            "_miles" => "KMS",
            "_vehicletype" => "Category",
            "_stock" => "StockNumber",
            "_drive" => "Drive",
            "_transmission" => "Transmission",
            "_exterior" => "Exterior Color",
            "_interior" => " Interior Color",
            "_EPA_CITY_MPG" => "",
            "_EPA_HIGHWAY_MPG" => "",
            "_vin" => "Vin",
            "_carfax" => "",
            "_enginesize" => "Engine Size",
            "_cylinders" => "Cylinder",
            "_horsepower" => "",
            "_FRONT_AIR_CONDITIONING" => "",
            "_FRONT_BRAKE_TYPE" => "",
            "_ANTILOCK_BRAKING_SYSTEM" => "",
            "_BRAKING_ASSIST" => "",
            "_REAR_BRAKE_DIAMETER" => "",
            "_AUTO_DIMMING_REARVIEW_MIRROR" => "",
            "_RUNNING_BOARDS" => "",
            "_ROOF_RACK" => "",
            "_POWER_DOOR_LOCKS" => "",
            "_ANTI_THEFT_ALARM_SYSTEM" => "",
            "_CRUISE_CONTROL" => "",
            "_1ST_ROW_VANITY_MIRRORS" => "",
            "_HEATED_DRIVER_SIDE_MIRROR" => "",
            "_HEATED_PASSENGER_SIDE_MIRROR" => "",
            "_TRAILER_WIRING" => "",
            "_TRAILER_HITCH" => "",
            "_CRUISE_CONTROLS_ON_STEERING_WHEEL" => "",
            "_AUDIO_CONTROLS_ON_STEERING_WHEEL" => "",
            "_FOLDING_2ND_ROW" => "",
            "_1ST_ROW_POWER_OUTLET" => "",
            "_CARGO_AREA_POWER_OUTLET" => "",
            "_INDEPENDENT_SUSPENSION" => "",
            "_REAR_SUSPENSION_TYPE" => "",
            "_FRONT_SUSPENSION_TYPE" => "",
            "_MAX_CARGO_CAPACITY" => "",
            "_PASSENGER_AIRBAG" => "",
            "_enginetype" => "",
            "_fuelcapacity" => "",
            "_wheelbase" => "",
            "_overalllength" => "",
            "_width" => "",
            "_height" => "",
            "_legroom" => "",
            "_headroom" => "",
            "_seatingcapacity" => "Passenger",
            "_tires" => "",
            "_comment_area" => "AdDescription"
        ),

		    "mapTax" => Array
		        (
		            "category" => Array
		                (
		                    "field" => "Category",
		                    "separator" => ""
		                ),
		
		            "makemodel" => Array
		                (
		                    "field" => "Model",
		                    "separator" => ""
		                ),
		
		            "location" => Array
		                (
		                    "field" => "",
		                    "separator" => ""
		                ),
		
		            "features" => Array
		                (
		                    "field" => "",
		                    "separator" => ""
		                )
		
		        ),
		
		    "mapPhoto" => Array
		        (
		            "field" => "OtherPhoto",
		            "separator" => ""
		        )
		
		);

		$post_types = array();
		foreach($importRecords as $key=>$value){
			foreach ($value as $tr => $im) {
				unset($value[$tr]);
				$value[trim($tr)] = $im;
			}
			$post_types[$key]['title'] = $value['Year'] . ' ' . $value['Make'] . ' ' . $value['Model'];
			$post_types[$key]['meta'] = gtcd_map_meta_fields($value,$post['mapMeta']);
			$post_types[$key]['tax'] = gtcd_map_tax_fields($value,$post['mapTax']);
			$post_types[$key]['photos'] = gtcd_map_photos($value, $post['mapPhoto']);
		}
		
	}

	$listing_totals = gtcdi_import_records($post_types);
	
	//importing is completed, remove the uploaded file
	@unlink(GTCDI_DIR . '/' . $importFile);	
}
?>
<br><br>
<p><?php _e('File','language');?> <strong><?php print $_POST['file-name']; ?></strong><?php _e(' has successfully imported ','language');?><strong><?php echo ($listing_totals['completed']>0?$listing_totals['completed']:'0'); ?></strong><?php _e(' listings as ','language');?><strong><?php _e('pending','language');?></strong><?php _e(' status under Inventory.','language');?><br>
<?php if($listing_totals['skipped']>0){ ?><?php _e('There were','language');?> <strong><?php echo $listing_totals['skipped']; ?></strong><?php _e(' listings that were skipped because they already exist from a previous import.','language');?><br><?php } ?>
<br><?php _e('If you notice that some of your listings do not have photos attached it is because they were not found in the database.','language');?><br>
<?php _e('Please click ','language');?><a href="<?php echo get_admin_url(); ?>edit.php?post_status=pending&post_type=gtcd"><?php _e('here','language');?></a><?php _e(' to see your imported listings.','language');?></p>