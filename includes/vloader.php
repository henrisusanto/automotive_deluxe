<?php
add_action('wp_ajax_rw_api_data', 'rw_api_data');	// load API data
function rw_api_data(){
	if (!isset($_POST[vin]) OR strlen($_POST[vin])!=17){		
	}else{
		$APIKey = get_option('Edmund_API');
		$VIN = $_POST[vin];
		$URL = 'http://api.edmunds.com/v1/api/toolsrepository/vindecoder?vin=' . $VIN . '&api_key=' . $APIKey . '&fmt=json';
		
		$json = file_get_contents($URL);
		$data = json_decode($json, TRUE);
		//echo $json;
		$Features = array();
		foreach($data['styleHolder'][0]['attributeGroups']['TMVU_FEATURE']['attributes'] as $key=>$value)
		{
			$Features[] = $value['value'];
		}
		$Features = implode(',',$Features);
			
		$Vehicle['newtag[features]'] = $Features;

		$Vehicle['Make'] = $data['styleHolder'][0]['makeName'];		
		$Vehicle['Model'] = $data['styleHolder'][0]['modelName'];
		$Vehicle['post_name'] = $data['styleHolder'][0]['modelId'];
		$Vehicle['post_title'] = $Vehicle['Make'] . ' ' . $Vehicle['Model'] . ' ' . $Vehicle['year'];			
		$Vehicle['year'] = $data['styleHolder'][0]['year'];		
		$Vehicle['vin'] = $VIN;		
		$Vehicle['epamileage'] = $data['styleHolder'][0]['attributeGroups']['SPECIFICATIONS']['attributes']['EPA_HIGHWAY_MPG']['value'];			
		
		$Vehicle['transmission'] = $data['styleHolder'][0]['transmissionType'];
		if ($Vehicle['transmission'] == 'AUTOMATIC') {
			$Vehicle['transmission'] = 'Automatic';
		} elseif ($Vehicle['transmission'] == 'MANUAL') {
			$Vehicle['transmission'] = 'Manual';
		} elseif ($Vehicle['transmission'] == 'SEMI-AUTO') {
			$Vehicle['transmission'] = 'Semi-Auto';
		}else{
			$Vehicle['transmission'] = 'Other';			
		}
		
		
        $Vehicle['vehicletype'] = strtolower($data['styleHolder'][0]['attributeGroups']['STYLE_INFO']['attributes']['VEHICLE_STYLE']['value']);

		
		if ($Vehicle['vehicletype'] == 'sedan') {
			$Vehicle['vehicletype'] = 'Sedans and Coupes';
		} elseif ($Vehicle['vehicletype'] == 'coupe') {
			$Vehicle['vehicletype'] = 'Sports Cars';
		} elseif ($Vehicle['vehicletype'] == 'wagon') {
			$Vehicle['vehicletype'] = 'Wagons';						
		} elseif ($Vehicle['vehicletype'] == 'passenger minivan') {
			$Vehicle['vehicletype'] = 'Minivans and Vans';
		} elseif ($Vehicle['vehicletype'] == 'crew cab pickup') {
			$Vehicle['vehicletype'] = 'Pickup Trucks';			
		} elseif ($Vehicle['vehicletype'] == '4dr hatchback') {
			$Vehicle['vehicletype'] = 'Hybrids';			
		} elseif ($Vehicle['vehicletype'] == 'convertible') {
			$Vehicle['vehicletype'] = 'Convertibles';	
		} elseif ($Vehicle['vehicletype'] == '4dr suv') {
			$Vehicle['vehicletype'] = 'Sport Utilities';			
		}else{
		
		}		
	
        $Vehicle['drive'] = $data['styleHolder'][0]['attributeGroups']['DRIVE_TYPE']['attributes']['DRIVEN_WHEELS']['value'];		
		
		$Vehicle['enginesize'] = $data['styleHolder'][0]['engineSize'];
		$Vehicle['cylinders'] = $data['styleHolder'][0]['engineCylinder'];
		$Vehicle['enginetype'] = $data['styleHolder'][0]['engineFuelType'];
		$Vehicle['fuelcapacity'] = $data['styleHolder'][0]['attributeGroups']['SPECIFICATIONS']['attributes']['FUEL_CAPACITY']['value'];
		$Vehicle['wheelbase'] = $data['styleHolder'][0]['attributeGroups']['EXTERIOR_DIMENSIONS']['attributes']['WHEELBASE']['value'];
		$Vehicle['overalllength'] = $data['styleHolder'][0]['attributeGroups']['EXTERIOR_DIMENSIONS']['attributes']['OVERALL_LENGTH']['value'];
		$Vehicle['width'] = $data['styleHolder'][0]['attributeGroups']['EXTERIOR_DIMENSIONS']['attributes']['OVERALL_WIDTH_WITHOUT_MIRRORS']['value'];
		$Vehicle['height'] = $data['styleHolder'][0]['attributeGroups']['EXTERIOR_DIMENSIONS']['attributes']['OVERALL_HEIGHT']['value'];
		$Vehicle['curbweight'] = $data['styleHolder'][0]['attributeGroups']['SPECIFICATIONS']['attributes']['CURB_WEIGHT']['value'];
		$Vehicle['legroom'] = $data['styleHolder'][0]['attributeGroups']['INTERIOR_DIMENSIONS']['attributes']['1ST_ROW_LEG_ROOM']['value'];
		$Vehicle['headroom'] = $data['styleHolder'][0]['attributeGroups']['INTERIOR_DIMENSIONS']['attributes']['1ST_ROW_HEAD_ROOM']['value'];
		$Vehicle['seatingcapacity'] = intval($data['styleHolder'][0]['attributeGroups']['SEATING_CONFIGURATION']['attributes']['1ST_ROW_SEATING_CAPACITY']['value']) + intval($data['styleHolder'][0]['attributeGroups']['SEATING_CONFIGURATION']['attributes']['2ND_ROW_SEATING_CAPACITY']['value']);
		$Vehicle['comment_area'] = $data['styleHolder'][0]['attributeGroups']['STYLE_INFO']['attributes']['STANDARD_VEHICLE_DESCRIPTION']['value'];		
		$Vehicle['tires'] = $data['styleHolder'][0]['attributeGroups']['SPARE_TIRE/WHEEL']['attributes']['SPARE_TIRE_SIZE']['value'];

$Vehicle['FRONT_AIR_CONDITIONING'] = $data['styleHolder'][0]['attributeGroups']['AIR_CONDITIONING']['attributes']['FRONT_AIR_CONDITIONING']['value'];
$Vehicle['FRONT_BRAKE_TYPE'] = $data['styleHolder'][0]['attributeGroups']['BRAKE_SYSTEM']['attributes']['FRONT_BRAKE_TYPE']['value'];
$Vehicle['ANTILOCK_BRAKING_SYSTEM'] = $data['styleHolder'][0]['attributeGroups']['BRAKE_SYSTEM']['attributes']['ANTILOCK_BRAKING_SYSTEM']['value'];
$Vehicle['BRAKING_ASSIST'] = $data['styleHolder'][0]['attributeGroups']['BRAKE_SYSTEM']['attributes']['BRAKING_ASSIST']['value'];
$Vehicle['REAR_BRAKE_DIAMETER'] = $data['styleHolder'][0]['attributeGroups']['BRAKE_SYSTEM']['attributes']['REAR_BRAKE_DIAMETER']['value'];
$Vehicle['AUTO_DIMMING_REARVIEW_MIRROR'] = $data['styleHolder'][0]['attributeGroups']['MIRRORS']['attributes']['AUTO_DIMMING_REARVIEW_MIRROR']['value'];
$Vehicle['1ST_ROW_VANITY_MIRRORS'] = $data['styleHolder'][0]['attributeGroups']['MIRRORS']['attributes']['1ST_ROW_VANITY_MIRRORS']['value'];
$Vehicle['HEATED_DRIVER_SIDE_MIRROR'] = $data['styleHolder'][0]['attributeGroups']['MIRRORS']['attributes']['HEATED_DRIVER_SIDE_MIRROR']['value'];
$Vehicle['HEATED_PASSENGER_SIDE_MIRROR'] = $data['styleHolder'][0]['attributeGroups']['MIRRORS']['attributes']['HEATED_PASSENGER_SIDE_MIRROR']['value'];
$Vehicle['TRAILER_WIRING'] = $data['styleHolder'][0]['attributeGroups']['TRAILER_TOWING_EQUIPMENT']['attributes']['TRAILER_WIRING']['value'];
$Vehicle['TRAILER_HITCH'] = $data['styleHolder'][0]['attributeGroups']['TRAILER_TOWING_EQUIPMENT']['attributes']['TRAILER_HITCH']['value'];
$Vehicle['CRUISE_CONTROLS_ON_STEERING_WHEEL'] = $data['styleHolder'][0]['attributeGroups']['STEERING_WHEEL']['attributes']['CRUISE_CONTROLS_ON_STEERING_WHEEL']['value'];
$Vehicle['AUDIO_CONTROLS_ON_STEERING_WHEEL'] = $data['styleHolder'][0]['attributeGroups']['STEERING_WHEEL']['attributes']['AUDIO_CONTROLS_ON_STEERING_WHEEL']['value'];
$Vehicle['FOLDING_2ND_ROW'] = $data['styleHolder'][0]['attributeGroups']['2ND_ROW_SEATS']['attributes']['FOLDING_2ND_ROW']['value'];
$Vehicle['1ST_ROW_POWER_OUTLET'] = $data['styleHolder'][0]['attributeGroups']['POWER_OUTLETS']['attributes']['1ST_ROW_POWER_OUTLET']['value'];
$Vehicle['CARGO_AREA_POWER_OUTLET'] = $data['styleHolder'][0]['attributeGroups']['POWER_OUTLETS']['attributes']['CARGO_AREA_POWER_OUTLET']['value'];
$Vehicle['INDEPENDENT_SUSPENSION'] = $data['styleHolder'][0]['attributeGroups']['SUSPENSION']['attributes']['INDEPENDENT_SUSPENSION']['value'];
$Vehicle['REAR_SUSPENSION_TYPE'] = $data['styleHolder'][0]['attributeGroups']['SUSPENSION']['attributes']['REAR_SUSPENSION_TYPE']['value'];
$Vehicle['FRONT_SUSPENSION_TYPE'] = $data['styleHolder'][0]['attributeGroups']['SUSPENSION']['attributes']['FRONT_SUSPENSION_TYPE']['value'];
$Vehicle['MAX_CARGO_CAPACITY'] = $data['styleHolder'][0]['attributeGroups']['CARGO_DIMENSIONS']['attributes']['MAX_CARGO_CAPACITY']['value'];
$Vehicle['EPA_CLASS'] = $data['styleHolder'][0]['attributeGroups']['STYLE_INFO']['attributes']['EPA_CLASS']['value'];
$Vehicle['STYLE_END_DATE'] = $data['styleHolder'][0]['attributeGroups']['STYLE_INFO']['attributes']['STYLE_END_DATE']['value'];
$Vehicle['TRIM_LEVEL'] = $data['styleHolder'][0]['attributeGroups']['STYLE_INFO']['attributes']['TRIM_LEVEL']['value'];
$Vehicle['FLEET'] = $data['styleHolder'][0]['attributeGroups']['STYLE_INFO']['attributes']['FLEET']['value'];
$Vehicle['TMV_CATEGORY'] = $data['styleHolder'][0]['attributeGroups']['STYLE_INFO']['attributes']['TMV_CATEGORY']['value'];
$Vehicle['VEHICLE_SIZE_CLASS'] = $data['styleHolder'][0]['attributeGroups']['STYLE_INFO']['attributes']['VEHICLE_SIZE_CLASS']['value'];
$Vehicle['LONG_NAME'] = $data['styleHolder'][0]['attributeGroups']['STYLE_INFO']['attributes']['LONG_NAME']['value'];
$Vehicle['PRIMARY_BODY_TYPE'] = $data['styleHolder'][0]['attributeGroups']['STYLE_INFO']['attributes']['PRIMARY_BODY_TYPE']['value'];
$Vehicle['STYLE_START_DATE'] = $data['styleHolder'][0]['attributeGroups']['STYLE_INFO']['attributes']['STYLE_START_DATE']['value'];
$Vehicle['WHERE_BUILT'] = $data['styleHolder'][0]['attributeGroups']['STYLE_INFO']['attributes']['WHERE_BUILT']['value'];
$Vehicle['VEHICLE_STYLE'] = $data['styleHolder'][0]['attributeGroups']['STYLE_INFO']['attributes']['VEHICLE_STYLE']['value'];
$Vehicle['ESTIMATE_TMV'] = $data['styleHolder'][0]['attributeGroups']['STYLE_INFO']['attributes']['ESTIMATE_TMV']['value'];
$Vehicle['MANUFACTURER_CODE'] = $data['styleHolder'][0]['attributeGroups']['STYLE_INFO']['attributes']['MANUFACTURER_CODE']['value'];
$Vehicle['EPA_CITY_MPG'] = $data['styleHolder'][0]['attributeGroups']['SPECIFICATIONS']['attributes']['EPA_CITY_MPG']['value'];
$Vehicle['FUEL_CAPACITY'] = $data['styleHolder'][0]['attributeGroups']['SPECIFICATIONS']['attributes']['FUEL_CAPACITY']['value'];
$Vehicle['EPA_HIGHWAY_MPG'] = $data['styleHolder'][0]['attributeGroups']['SPECIFICATIONS']['attributes']['EPA_HIGHWAY_MPG']['value'];
$Vehicle['RUNNING_BOARDS'] = $data['styleHolder'][0]['attributeGroups']['MISC._EXTERIOR_FEATURES']['attributes']['RUNNING_BOARDS']['value'];
$Vehicle['ROOF_RACK'] = $data['styleHolder'][0]['attributeGroups']['MISC._EXTERIOR_FEATURES']['attributes']['ROOF_RACK']['value'];
$Vehicle['POWER_DOOR_LOCKS'] = $data['styleHolder'][0]['attributeGroups']['SECURITY']['attributes']['POWER_DOOR_LOCKS']['value'];
$Vehicle['ANTI_THEFT_ALARM_SYSTEM'] = $data['styleHolder'][0]['attributeGroups']['SECURITY']['attributes']['ANTI_THEFT_ALARM_SYSTEM']['value'];
$Vehicle['CRUISE_CONTROL'] = $data['styleHolder'][0]['attributeGroups']['MISC._INTERIOR_FEATURES']['attributes']['CRUISE_CONTROL']['value'];


		$Vehicle['makemodel-all'] = '<input name="tax_input[makemodel][]" value="0" type="hidden">
		<input name="Vehicle_model" value="' . $Vehicle['Model'] .'" type="hidden">
		<input name="Vehicle_Make" value="' . $Vehicle['Make'] .'" type="hidden">		
		<ul id="makemodelchecklist" data-wp-lists="list:makemodel" class="categorychecklist form-no-clear">
				
<li id="makemodel-' . $MakeId .'" class="popular-category"><label class="selectit"><input value="' . $MakeId .'" name="" id="in-makemodel-' . $MakeId .'" checked="checked" type="checkbox" disabled> ' . $Vehicle['Make'] .'</label><ul class="children">

<li id="makemodel-109" class="popular-category"><label class="selectit"><input value="109" name="" id="in-makemodel-109" checked="checked" type="checkbox" disabled> ' . $Vehicle['Model'] . '</label></li>
</ul>
</li>
			</ul>';
		
		echo json_encode($Vehicle);
		die();
	}

}
?>