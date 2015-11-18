<?php
$mod1 = "mod1";
$options = my_get_theme_options();
include(TEMPLATEPATH."/includes/vloader.php");
$meta_boxes = array(
  	"statustag" => array(
	  "name" => "statustag", 
	  "title" => $options['status_tag_text'], 
	  "description" => __('Enter vehicle condition.','language'),
	  "type" => "dropdown",
	  "class" => "dropdown",
	  "rows" => "",
	  "width" => "",
	  "hide_in_search" => $options['condition_hide'],
	  "options" => array("1" => __('None','language'),"2" => __('New','language'),"3" => __('Used','language'),"4" => __('Sale','language'),"5" => __('Reduced','language'),"6" => __('Sold','language'))

	), 
"featured" => array(
	  "name" => "featured",   
	  "title" => $options['featured_text'],
	  "description" => __('If yes this Vehicle will show up on the home page featured module.','language'),
	  "type" => "dropdown",	
	  "class" => 'dropdown',
	  "hide_in_search" => 'on',
	  "options" => array("1" => __('Yes','language'), "2" => __('No','language'),)
		), 
"topdeal" => array(
	  "name" => "topdeal",   
	  "title" => $options['top_deal_text'],
	  "description" => __('If yes this Vehicle will show up on the Top Deals Widget.','language'),
	  "type" => "dropdown",	
	  "class" => 'dropdown',
	  "hide_in_search" => 'on',
	  "options" => array("1" => __('Yes','language'), "2" => __('No','language'),)
		), 
 "year" => array(
	  "name" => "year",   
	  "title" => $options['year_text'], 
	  "description" => __('Enter vehicle year.','language'),
	  "type" => "dropdown",
	  "class" => "dropdown",
	  "rows" => "",
	  "hide_in_search" => $options['year_hide'],
	  "width" => "",
	  "options" => generate_years( $options['year_start_text'], $options['year_end_text'] ),
	  ),
"price" => array(
	  "name" => "price", 
  	  "title" => $options['price_text'], 
	  "description" => __('Enter the full vehicle price without commas or dots.','language'),
	  "type" => "range",
	  "class" => "range",
	  "rows" => "",
      "width" => "",
	  "hide_in_search" => $options['price_hide'],
	  "options" => ""
		), 	 
"miles" => array(
	  "name" => "miles",   
	  "title" => $options['miles_text'],  
	  "description" => __('Enter vehicle mileage.','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "width" => "",
	   "hide_in_search" => 'on',
	  "options" => "miles"	  
	),  
"vehicletype" => array(
	  "name" => "vehicletype",   
	  "title" => $options['vehicle_type_text'],  
	  "description" => __('Enter the Vehicle Type.','language'),
	  "type" => "dropdown",
	  "class" => "dropdown",
	  "rows" => "",
	  "width" => "",
	   "hide_in_search" => $options['vehicle_type_hide'],
	  "options" => array("1" => $options['vehicle_type_1'],  
	  					 "2" => $options['vehicle_type_2'],
	  					 "3" => $options['vehicle_type_3'],
	  					 "4" => $options['vehicle-type_4'],
	  					 "5" => $options['vehicle_type_5'],
	  					 /*"6" => $options['vehicle_type_6'],
	  					 "7" => $options['vehicle_type_7'],  
	  					 "8" => $options['vehicle_type_8'],
	  					 "9" => $options['vehicle_type_9'],
	  					 "10" => $options['vehicle-type_10'],
	  					 "11" => $options['vehicle_type_11'],
	  					 "12" => $options['vehicle_type_12'],*/    
	  					 )
	),  
"stock" => array(
	  "name" => "stock", 
	  "title" => $options['stock_text'], 
	  "description" => __('Enter vehicle stock number.','language'),
	  "type" => "text",
	  "class" => "dropdown",
	  "rows" => "",
	  "width" => "",
	  "hide_in_search" => 'on',
	  "options" => ""
	), 
"drive" => array(
	  "name" => "drive", 
	  "title" => $options['drive_text'],
	  "description" => __('Enter vehicle drive type.','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "",
	  "options" => "drive"
	),
"transmission" => array(
	  "name" => "transmission", 
	  "title" => $options['transmission_text'],
	  "description" => __('Enter vehicle transmission type.','language'),
	  "type" => "dropdown",
	  "class" => "dropdown",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "",
	  	  "options" => array("1" => $options['transmission_1'],  
	  					 	 "2" => $options['transmission_2'],
	  					 	 "3" => $options['transmission_3'],
	  					 	 "4" => $options['transmission_4'],
	 	  					 )
	),
"exterior" => array(
	  "name" => "exterior", 
	  "title" => $options['exterior_text'],
	  "description" => __('Enter vehicle exterior color.','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "",
	  "options" => ""
	), 
"interior" => array(
	  "name" => "interior", 
	  "title" => $options['interior_text'],
	  "description" =>  __('Enter vehicle interior color.','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "",
	  "options" => ""
	),
"EPA_CITY_MPG" => array(
	  "name" => "EPA_CITY_MPG", 
	  "title" => __('EPA City MPG.','language'),
	  "description" => __('Enter EPA City MPG.','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "",
	  "options" => ""
	),
"EPA_HIGHWAY_MPG" => array(
	  "name" => "EPA_HIGHWAY_MPG", 
	  "title" => __('EPA Highway MPG.','language'),
	  "description" => __('Enter EPA Highway MPG.','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "",
	  "options" => ""
	),
"vin" => array(
	  "name" => "vin", 
	  "title" => $options['vin_text'],
	  "description" => __('Enter vehicle identification number.','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "",
	  "options" => ""
	),
"carfax" => array(
"name" => "carfax", 
	  "title" => $options['carfax_text'],
	  "description" => __('Enter Carfax partner ID to offer free reports with your vehicle.','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "",
	  "options" => ""
	),
	 
		 );
?>
<?php	
 $mod2 = "mod2";
$options = my_get_theme_options();
$feat_boxes = array(
"enginesize" => array(
	  "name" => "enginesize", 
	  "title" => $options['engine_size_text'],  
	  "description" => __('Enter vehicle engine size.','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ), 
"cylinders" => array(
	  "name" => "cylinders", 
	  "title" => $options['number_cylinders_text'],  
	  "description" => __('Enter number of cylinders.','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ),
	 

"horsepower" => array(
	  "name" => "horsepower", 
	  "title" => $options['horsepower_text'],  
	  "description" =>  __('Enter vehicle horsepower.','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ), 

"FRONT_AIR_CONDITIONING" => array(
	  "name" => "FRONT_AIR_CONDITIONING", 
	  "title" => __('Front Air Conditioning','language'),  
	  "description" => __('Enter Front Air Conditioning','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ),
"FRONT_BRAKE_TYPE" => array(
	  "name" => "FRONT_BRAKE_TYPE", 
	  "title" => __('Front Brake Type','language'),  
	  "description" => __('Enter Front Brake Type','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ), 
"ANTILOCK_BRAKING_SYSTEM" => array(
	  "name" => "ANTILOCK_BRAKING_SYSTEM", 
	  "title" => __('Antilock Braking System','language'),  
	  "description" => __('Enter Antilock Braking System','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ),
"BRAKING_ASSIST" => array(
	  "name" => "BRAKING_ASSIST", 
	  "title" => __('Braking Assist','language'),  
	  "description" => __('Enter Braking Assist','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ),
"REAR_BRAKE_DIAMETER" => array(
	  "name" => "REAR_BRAKE_DIAMETER", 
	  "title" => __('Rear Brake Diameter','language'),  
	  "description" => __('Enter Rear Brake Diameter','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ), 
"AUTO_DIMMING_REARVIEW_MIRROR" => array(
	  "name" => "AUTO_DIMMING_REARVIEW_MIRROR", 
	  "title" => __('Auto Dimming Rearview Mirror','language'),  
	  "description" => __('Enter Auto Dimming Rearview Mirror','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ),
"RUNNING_BOARDS" => array(
	  "name" => "RUNNING_BOARDS", 
	  "title" => __('Running Boards','language'),  
	  "description" => __('Enter Running Boards','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ),  
"ROOF_RACK" => array(
	  "name" => "ROOF_RACK", 
	  "title" => __('Roof Rack','language'),  
	  "description" => __('Enter Roof Rack','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ), 
"POWER_DOOR_LOCKS" => array(
	  "name" => "POWER_DOOR_LOCKS", 
	  "title" => __('Power Door Locks','language'),  
	  "description" => __('Enter Power Door Locks','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ),  
"ANTI_THEFT_ALARM_SYSTEM" => array(
	  "name" => "ANTI_THEFT_ALARM_SYSTEM", 
	  "title" => __('Anti Theft Alarm System','language'),  
	  "description" => __('Enter Anti Theft Alarm System','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ),  
"CRUISE_CONTROL" => array(
	  "name" => "CRUISE_CONTROL", 
	  "title" => __('Cruise Control','language'),  
	  "description" => __('Enter Cruise Control','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""  
	  ),
"1ST_ROW_VANITY_MIRRORS" => array(
	  "name" => "1ST_ROW_VANITY_MIRRORS", 
	  "title" => __('First Row Vanity Mirrors','language'),  
	  "description" => __('Enter First Row Vanity Mirrors','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ), 
"HEATED_DRIVER_SIDE_MIRROR" => array(
	  "name" => "HEATED_DRIVER_SIDE_MIRROR", 
	  "title" => __('Heated Driver Side Mirror','language'),
	  "description" => __('Enter Heated Driver Side Mirror','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ),
"HEATED_PASSENGER_SIDE_MIRROR" => array(
	  "name" => "HEATED_PASSENGER_SIDE_MIRROR", 
	  "title" => __('Heated Driver Passenger Mirror','language'),  
	  "description" => __('Enter Heated Passenger Side Mirror','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ),
"TRAILER_WIRING" => array(
	  "name" => "TRAILER_WIRING", 
	  "title" => __('Trailer Wiring','language'),  
	  "description" => __('Enter Trailer Wiring','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ),
"TRAILER_HITCH" => array(
	  "name" => "TRAILER_HITCH", 
	  "title" => __('Trailer Hitch','language'),  
	  "description" => __('Enter Trailer Hitch','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ),
"CRUISE_CONTROLS_ON_STEERING_WHEEL" => array(
	  "name" => "CRUISE_CONTROLS_ON_STEERING_WHEEL", 
	  "title" => __('Cruise Control on Steering Wheel','language'),  
	  "description" => __('Enter Cruise Control on Steering Wheel','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ),
"AUDIO_CONTROLS_ON_STEERING_WHEEL" => array(
	  "name" => "AUDIO_CONTROLS_ON_STEERING_WHEEL", 
	  "title" => __('Audio Control on Steering Wheel','language'),  
	  "description" => __('Enter Audio Control on Steering Wheel','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ), 
"FOLDING_2ND_ROW" => array(
	  "name" => "FOLDING_2ND_ROW", 
	  "title" => __('Folding Second Row Seats','language'),  
	  "description" => __('Enter Folding Second Row Seats','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ), 
	  
	  "1ST_ROW_POWER_OUTLET" => array(
	  "name" => "1ST_ROW_POWER_OUTLET", 
	  "title" => __('First Row Power Outlet','language'),  
	  "description" => __('Enter First Row Power Outlet','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ), 
	  
	  "CARGO_AREA_POWER_OUTLET" => array(
	  "name" => "CARGO_AREA_POWER_OUTLET", 
	  "title" => __('Cargo Area Power Outlet','language'),  
	  "description" => __('Enter Cargo Area Power Outlet','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ), 
	  
	  "INDEPENDENT_SUSPENSION" => array(
	  "name" => "INDEPENDENT_SUSPENSION", 
	  "title" => __('Independent Suspension','language'),  
	  "description" => __('Enter Independent Suspension','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ), 
	    
	  "REAR_SUSPENSION_TYPE" => array(
	  "name" => "REAR_SUSPENSION_TYPE", 
	  "title" => __('Rear Suspension Type','language'),  
	  "description" => __('Enter Rear Suspension Type','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ), 
	  	  
	    
	  "FRONT_SUSPENSION_TYPE" => array(
	  "name" => "FRONT_SUSPENSION_TYPE", 
	  "title" => __('Front Suspension Type','language'),  
	  "description" => __('Enter Front Suspension Type','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ), 
	  	  
	    
	  "INDEPENDENT_SUSPENSION" => array(
	  "name" => "INDEPENDENT_SUSPENSION", 
	  "title" => __('Independent Suspension','language'),  
	  "description" => __('Enter Independent Suspension','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ), 
	  	  	  
	   "MAX_CARGO_CAPACITY" => array(
	  "name" => "MAX_CARGO_CAPACITY", 
	  "title" => __('Maximum Cargo Capacity Suspension','language'),  
	  "description" => __('Enter Maximum Cargo Capacity Suspension','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ), 
	 	  	  	  
	   "PASSENGER_AIRBAG" => array(
	  "name" => "PASSENGER_AIRBAG", 
	  "title" => __('Passenger Airbags','language'),  
	  "description" => __('Enter Passenger Airbags','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ), 
	  

/*
"torque" => array(
	  "name" => "torque", 
	  "title" => $options['torquetext'],  
	  "description" => "Enter vehicle torque.",
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ), 
*/
/*
"compressionratio" => array(
	  "name" => "compressionratio", 
	  "title" => $options['compressionratiotext'],  
	  "description" => "Enter vehicle compression ratio.",
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ),
*/ 	  	  
"enginetype" => array(
	  "name" => "enginetype", 
	  "title" => $options['engine_type_text'],  
	  "description" => __('Enter vehicle engine type.','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ), 	  
/*
"bore" => array(
	  "name" => "bore", 
	  "title" => $options['boretext'],  
	  "description" => "Enter bore.",
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ), 	  
"stroke" => array(
	  "name" => "stroke", 
	  "title" => $options['stroketext'],  
	  "description" => "Enter vehicle stroke.",
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ),	  

"valvespercylinder" => array(
	  "name" => "valvespercylinder", 
	  "title" => $options['valvespercylindertext'],  
	  "description" => "Enter number of valves per cylinder.",
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ),
*/
"fuelcapacity" => array(
	  "name" => "fuelcapacity", 
	  "title" => $options['fuel_capacity_text'],  
	  "description" => __('Enter vehicle fuel capacity.','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ),
"wheelbase" => array(
	  "name" => "wheelbase", 
	  "title" => $options['wheelbase_text'],  
	  "description" => __('Enter vehicle wheelbase'.'language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ),
"overalllength" => array(
	  "name" => "overalllength", 
	  "title" => $options['overall_length_text'],  
	  "description" => __('Enter vehicle overall length','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ),
"width" => array(
	  "name" => "width", 
	  "title" => $options['width_text'],  
	  "description" => __('Enter vehicle width','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ),	  
"height" => array(
	  "name" => "height", 
	  "title" => $options['height_text'],  
	  "description" => __('Enter vehicle height.','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ),
"curbweighttext" => array(
	  "name" => "curbweight", 
	  "title" => $options['curb_weight_text'],  
	  "description" => __('Enter vehicle curb weight','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ),	  		  
"legroom" => array(
	  "name" => "legroom", 
	  "title" => $options['leg_room_text'],  
	  "description" => __('Enter vehicle leg room','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ),
"headroom" => array(
	  "name" => "headroom", 
	  "title" => $options['head_room_text'],  
	  "description" => __('Enter vehicle head room.','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ),
"seatingcapacity" => array(
	  "name" => "seatingcapacity", 
	  "title" => $options['seating_text'],  
	  "description" => __('Enter vehicle seating capacity','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
		),
"tires" => array(
	  "name" => "tires", 
	  "title" => $options['tires_text'],  
	  "description" => __('Enter vehicle tires.','language'),
	  "type" => "text",
	  "class" => "text",
	  "rows" => "",
	  "hide_in_search" => 'on',
	  "width" => "10%",
	  "options" => ""
	  ),  
);
?>
<?php
$mod3 = "mod3";
$options = my_get_theme_options();
$comment_boxes = array(
  	"comment_area" => array(
	  "name" => "comment_area", 
	  "title" => $options['description_text'],  
	  "description" => "",
	  "type" => "textarea",
	  "class" => "textarea",
	  "hide_in_search" => 'on',
	  "rows" => "20%",
	  "width" => "80%",
	  "height" => "30%",
	  "options" => ""),
);

$feat = "feat1";
$options = my_get_theme_options();
$featured_post = array(
	  "featured" => array(
	  "name" => "featured",   
	  "title" => $options['featured_text'],
	  "description" => __('If YES selected the image of this post will be displayed in the home slideshow.','language'),
	  "type" => "dropdown",	
	  "class" => 'dropdown',
	  "hide_in_search" => 'on',
	  "options" => array("1" => __('No','language'), "2" => __('Yes','language')),
		));

?>
<?php	  
function create_meta_box() {
global $mod1, $mod3, $mod2, $feat, $meta_box, $page;
if( function_exists( 'add_meta_box' ) ) {
if ($_GET['action']!='edit'){
add_meta_box( 'new-meta-box0', __('Vehicle VIN Number Decoder','language'), 'display_api_box', 'gtcd', 'normal', 'high' );}
add_meta_box($meta_box['id'], $meta_box['title'], 'show', $page, $meta_box['context'], $meta_box['priority']);
add_meta_box( 'new-meta-box1',  __('Vehicle Information','language'), 'display_meta_box', 'gtcd', 'normal', 'core' );
add_meta_box( 'new-meta-box2',  __('Vehicle Specifications','language'), 'display_specifications_box', 'gtcd', 'normal', 'core' );
add_meta_box( 'new-meta-box3',  __('Vehicle Overview','language'), 'display_comments_box', 'gtcd', 'normal', 'core' );
add_meta_box( 'new-meta-box1',  __('Vehicle Information','language'), 'display_meta_box', 'user_listing', 'normal', 'core' );
add_meta_box( 'new-meta-box2',  __('Vehicle Specifications','language'), 'display_specifications_box', 'user_listing', 'normal', 'core' );
add_meta_box( 'new-meta-box3',  __('Vehicle Overview','language'), 'display_comments_box', 'user_listing', 'normal', 'core' );
add_meta_box( 'feat-meta-box',  __('Featured Post','language'), 'display_feat_meta_box', 'post', 'side', 'core' );
}
}
function display_api_box() {
  global $post,$wpdb, $meta_boxes, $mod1;
	$APIKey = get_option('Edmund_API');
	if ($APIKey==''){
		$disabled = 'disabled';
	}else{
		$disabled = '';		
	}
?>
<div class="form-wrap vin">
<?php 	if ($APIKey==''){?>

<div class="api-legend"><a href="admin.php?page=edmund_api"><?php _e('Click here to setup your VIN Decoder','language');?></a></div>

<?php
}
?>
<div class="vin-form"><?php _e('VIN Number: ','language');?><input type="text" width="50" value="" name="VIN_Code" id="VIN_Code" <?php echo $disabled;?>/>
<input type="button" onclick="get_api_data();" id="GetData" value="Get Data" class="button" <?php echo $disabled;?>></div><div id="API_message"></div>
<div class="vin-loader"><img id="MyLoading" style="display:none;" src="<?php bloginfo('template_url');?>/images/loading.gif" height="30" width="30"/></div><div><a href="http://developer.edmunds.com/" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/common/220_grey.png" alt="Edmunds"/></a></div>
</div>
<?php
}

function display_feat_meta_box() {
  global $post,$wpdb, $featured_post, $feat;
?>
<div class="form-wrap">
<?php
//wp_nonce_field( plugin_basename( __FILE__ ), $mod1 . '_wpnonce', false, true );

$output = '';
foreach($featured_post as $feat_post) { 

    $data = get_post_meta($post->ID, $feat, true);  
	$output .= '<div style="font-size:12px;color:#666;font-weight:normal;padding:20p 0x;"><br/>'.$feat_post['description'] .'</div><p style="border-bottom:1px solid #f1f1f1;padding-bottom:3px;"><div style="width:80px;padding:6px 0 20px 5px;font-size:12px;color:#252525; font-style:normal;font-weight:bold;float: left;">' . $feat_post['title'] . ':</div>' . "\n"; 
	 if(($feat_post['type'] == 'dropdown') && (!empty($feat_post['options']))) { // dropdown lists    
    
    $output .= '<select name="' . $feat_post['name'] . '">' . "\n";
    
    if (isset($data[$feat_post['name']])) {
        $output .= '<option selected>'. $data[$feat_post['name']] .'</option>' . "\n";	
    }     
		
    foreach($feat_post['options'] as $dropdown_key => $dropdown_value) {
        $output .= '<option value="' . $dropdown_value . '">' . $dropdown_value . '</option>' . "\n";
    }        
    $output .= '</select>' . "\n";		  	
  }
  $output .= '</p>' ;  
  }   
  echo '<div>' . "\n" . $output . "\n" . '</div></div><br/>' . "\n\n";
}
?>
<?php
function display_meta_box() {
  global $post,$wpdb, $meta_boxes, $mod1;
?>
<div class="form-wrap">
<?php
//wp_nonce_field( plugin_basename( __FILE__ ), $mod1 . '_wpnonce', false, true );

$output = '';
foreach($meta_boxes as $meta_box) { 

    $data = get_post_meta($post->ID, $mod1, true);  
	$output .= '<p style="border-bottom:1px solid #f1f1f1;padding-bottom:3px;"><div style="width:130px;padding:6px 0 0 5px;font-size:12px;color:#252525; font-style:normal;font-weight:bold;float: left;">' . $meta_box['title'] . ':&nbsp; </div>' . "\n"; 
	if($meta_box['type'] == 'text' || $meta_box['type'] == 'range') { // plain text input
      $output .= '<input type="text" name="' . $meta_box['name'] . '" value="' . (isset($data[$meta_box['name']]) ? $data[$meta_box['name']] : '') . '" style="margin-top:3px;width:' . $meta_box['width'] . ';" />';     
 	$output .= '<span style="font-size:11px;color:#666; font-style:italic;font-weight:normal;padding-bottom:10px;"> ' .$meta_box['description'] . '</span><br />' . "\n";      
  } else if($meta_box['type'] == 'textarea') { // textarea box
      $output .= '<textarea name="' . $meta_box['name'] . '" style="width:' . $meta_box['width'] . '; height:200px;">' . $data[$meta_box['name']] . '</textarea>'; 
    } else if(($meta_box['type'] == 'checkbox') && (!empty($meta_box['options']))) { // checkboxes
      foreach($meta_box['options'] as $checkbox_value) { 
         if(is_array($data) && $data[$meta_box['name']] != "") { // if array is empty, warnings will be issued, this circumvents it  
          $output .= '<input type="checkbox" name="' . $meta_box['name'] . '[]" value="' . $checkbox_value . '" ' . (isset($data[$meta_box['name']]) && (in_array($checkbox_value, $data[$meta_box['name']])) ? ' checked="checked"' : '') . '/> ' . $checkbox_value . ' &nbsp; ' . "\n";	
         } else {  
          $output .= '<input type="checkbox" name="' . $meta_box['name'] . '[]" value="' . $checkbox_value . '"/> ' . $checkbox_value . ' &nbsp; ' . "\n";	
         }
      }		  			
  } else if(($meta_box['type'] == 'radio') && (!empty($meta_box['options']))) { // radio buttons
  foreach($meta_box['options'] as $radio_value) {
          $output .= '<p style="padding-bottom:10px;display:inline;font-style:normal;"><input type="radio" name="' . $meta_box['name'] . '" value="' . $radio_value . '" ' . (isset($data[$meta_box['name']]) && ($data[$meta_box['name']] == $radio_value) ? ' checked="checked"' : '') . '/> ' . $radio_value . ' &nbsp; </p>' . "\n";	
      }		  	
  }
  
  else if(($meta_box['type'] == 'dropdown') && (!empty($meta_box['options']))) { // dropdown lists    
    
    $output .= '<select name="' . $meta_box['name'] . '">' . "\n";
    
    if (isset($data[$meta_box['name']])) {
        $output .= '<option selected>'. $data[$meta_box['name']] .'</option>' . "\n";	
    }     
		
    foreach($meta_box['options'] as $dropdown_key => $dropdown_value) {
        $output .= '<option value="' . $dropdown_value . '">' . $dropdown_value . '</option>' . "\n";
    }        
    $output .= '</select><span style="font-size:11px;color:#666; font-style:italic;font-weight:normal;padding-bottom:10px;"> ' . "".$meta_box['description']."</span>\n";		  	
  }
  $output .= "</p>\n\n";  
  }   
  echo '<div>' . "\n" . $output . "\n" . '</div></div>' . "\n\n";
}
?>
<?php
function display_specifications_box() {
  global $post, $feat_boxes, $mod2;
?>
<div class="form-wrap">
<?php
//wp_nonce_field( plugin_basename( __FILE__ ), $mod2 . '_wpnonce', false, true );
$output = '';
foreach($feat_boxes as $feat_box) { 
    $data = get_post_meta($post->ID, $mod2, true);       
	
  $output .= '<p style="border-bottom:1px solid #f1f1f1;padding-bottom:3px;"><div style="width:230px;padding:6px 0 0 5px;font-size:12px;color:#252525; font-style:normal;font-weight:bold;float: left;">' . $feat_box['title'] . ':&nbsp; </div>' . "\n"; 
  if($feat_box['type'] == 'text' || $feat_box['type'] == 'range') { // plain text input
      $output .= '<input type="text" name="' . $feat_box['name'] . '" value="' . (isset($data[$feat_box['name']]) ? $data[$feat_box['name']] : '') . '" style="margin-top:3px;width:' . $feat_box['width'] . ';" />';           
      $output .= '<span style="font-size:11px;color:#666; font-style:italic;font-weight:normal;padding-bottom:10px;"> ' .$feat_box['description'] . '</span><br />' . "\n";     
  }else if($feat_box['type'] == 'textarea') { // textarea box
      $output .= '<textarea name="' . $feat_box['name'] . '" style="width:' . $feat_box['width'] . '; height:100px;">' . $data[$feat_box['name']] . '</textarea>'; 
    }else if(($feat_box['type'] == 'checkbox') && (!empty($feat_box['options']))) { // checkboxes
      foreach($feat_box['options'] as $checkbox_value) { 
         if(is_array($data) && $data[$feat_box['name']] != "") { // if array is empty, warnings will be issued, this circumvents it  
          $output .= '<input type="checkbox" name="' . $feat_box['name'] . '[]" value="' . $checkbox_value . '" ' . (isset($data[$feat_box['name']]) && (in_array($checkbox_value, $data[$feat_box['name']])) ? ' checked="checked"' : '') . '/> ' . $checkbox_value . ' &nbsp; ' . "\n";	
         } else {  
          $output .= '<input type="checkbox" name="' . $feat_box['name'] . '[]" value="' . $checkbox_value . '"/> ' . $checkbox_value . ' &nbsp; ' . "\n";	
         }
      }		  			
  }else if(($feat_box['type'] == 'radio') && (!empty($feat_box['options']))) { // radio buttons        
      foreach($feat_box['options'] as $radio_value) {
          $output .= '<p style="padding-bottom:10px;display:inline;font-style:normal;"><input type="radio" name="' . $feat_box['name'] . '" value="' . $radio_value . '" ' . (isset($data[$feat_box['name']]) && ($data[$feat_box['name']] == $radio_value) ? ' checked="checked"' : '') . '/> ' . $radio_value . ' &nbsp; </p>' . "\n";	
      }		  	
  }else if(($feat_box['type'] == 'dropdown') && (!empty($feat_box['options']))) { // dropdown lists     
    $output .= '<select name="' . $feat_box['name'] . '">' . "\n";
    if (isset($data[$feat_box['name']])) {
        $output .= '<option selected>'. $data[$feat_box['name']] .'</option>' . "\n";	
    }      
		
    foreach($feat_box['options'] as $dropdown_key => $dropdown_value) {
        $output .= '<option value="' . $dropdown_value . '">' . $dropdown_value . '</option>' . "\n";
    }        
    $output .= '</select>' . "\n";		  	
  }
  $output .= "</p>\n\n";  
  }   
  echo '<div>' . "\n" . $output . "\n" . '</div></div>' . "\n\n";
}
function display_comments_box() {
  global $post, $comment_boxes, $mod3;
?>
<div class="form-wrap">
<?php
//wp_nonce_field( plugin_basename( __FILE__ ), $mod3 . '_wpnonce', false, true );
$output = '';
 foreach( $comment_boxes as $comment_box) { 
    $data = get_post_meta($post->ID, $mod3, true);  
	
	    $output .= '<p style="border-bottom:1px solid #f1f1f1;padding-bottom:3px;"><div style="width:130px;padding:6px 0 0 5px;font-size:12px;color:#252525; font-style:normal;font-weight:bold;float: left;">' . $comment_box['title'] . ':&nbsp; </div>' . "\n"; 
  if($comment_box['type'] == 'text' || $comment_box['type'] == 'range') { // plain text input
      $output .= '<input type="text" name="' . $comment_box['name'] . '" value="' . (isset($data[$comment_box['name']]) ? $data[$comment_box['name']] : '') . '" style="margin-top:3px;width:' . $comment_box['width'] . ';" />';     
      
      $output .= '<span style="font-size:11px;color:#666; font-style:italic;font-weight:normal;padding-bottom:10px;"> ' .$comment_box['description'] . '</span><br />' . "\n";      
  }else if($comment_box['type'] == 'textarea') { // textarea box
  
      $output .= '<textarea name="' . $comment_box['name'] . '" style="width:' . $comment_box['width'] . '; height:200px">' . (isset($data[$comment_box['name']]) ? $data[$comment_box['name']] : '') . '</textarea>'; 
    } else if(($comment_box['type'] == 'checkbox') && (!empty($comment_box['options']))) { // checkboxes
      foreach($comment_box['options'] as $checkbox_value) { 
         if(is_array($data) && $data[$comment_box['name']] != "") {           $output .= '<input type="checkbox" name="' . $comment_box['name'] . '[]" value="' . $checkbox_value . '" ' . (isset($data[$comment_box['name']]) && (in_array($checkbox_value, $data[$comment_box['name']])) ? ' checked="checked"' : '') . '/> ' . $checkbox_value . ' &nbsp; ' . "\n";	
         } else {  
          $output .= '<input type="checkbox" name="' . $comment_box['name'] . '[]" value="' . $checkbox_value . '"/> ' . $checkbox_value . ' &nbsp; ' . "\n";	
         }
      }		  			
  } else if(($comment_box['type'] == 'radio') && (!empty($comment_box['options']))) { // radio buttons
        
      foreach($comment_box['options'] as $radio_value) {
          $output .= '<p style="padding-bottom:10px;display:inline;font-style:normal;"><input type="radio" name="' . $comment_box['name'] . '" value="' . $radio_value . '" ' . (isset($data[$comment_box['name']]) && ($data[$comment_box['name']] == $radio_value) ? ' checked="checked"' : '') . '/> ' . $radio_value . ' &nbsp; </p>' . "\n";	
      }		  	
  } else if(($comment_box['type'] == 'dropdown') && (!empty($comment_box['options']))) { // dropdown lists
      
    $output .= '<select name="' . $comment_box['name'] . '">' . "\n";
    if (isset($data[$comment_box['name']])) {
        $output .= '<option selected>'. $data[$comment_box['name']] .'</option>' . "\n";	
    }      
		
    foreach($comment_box['options'] as $dropdown_key => $dropdown_value) {
        $output .= '<option value="' . $dropdown_value . '">' . $dropdown_value . '</option>' . "\n";
    }        
    $output .= '</select>' . "\n";		  	
  }
  $output .= "</p>\n\n";  
  } 
  echo '<div>' . "\n" . $output . "\n" . '</div></div>' . "\n\n";
}
add_action( 'admin_menu', 'create_meta_box' );
function save_feat_box( $post_id ) {
    if (!isset($_POST) || count($_POST) == 0) {
      return;
    }
   if ( (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || !isset($_POST['post_ID']) || $post_id != $_POST['post_ID'])
    return $post_id;
  global $post, $featured_post, $feat;
  foreach( $featured_post as $featured_box ) {
    $bDontUpdate = false;
    $data[ $featured_box[ 'name' ] ] = isset($_POST[ $featured_box[ 'name' ] ]) ? $_POST[ $featured_box[ 'name' ] ] : '';
    if (isset($_POST[ $featured_box[ 'name' ] ]) && is_array($_POST[ $featured_box[ 'name' ] ])) {
      $bDontUpdate = true;
      delete_post_meta($post_id, '_' . $featured_box['name']);
      foreach($_POST[ $$featured_box[ 'name' ] ] as $value) {
        add_post_meta($post_id, '_'.$featured_box['name'], $value);
      }
    }
    if(isset($_POST[ $featured_box[ 'name' ] ]) && $featured_box['type'] == 'range' && preg_match('/[\.,]/',$_POST[$feat_box[ 'name' ]])){
      $_POST[$featured_box[ 'name' ]] = preg_replace('/[\.,]/', '', $_POST[$featured_box[ 'name' ]]);
    }
    if (!$bDontUpdate) {
      update_post_meta( $post_id, '_'.$featured_box['name'], isset($_POST[$featured_box[ 'name' ]]) ? $_POST[$featured_box[ 'name' ]] : '' );
    }
  }
//	if ( !wp_verify_nonce( $_POST[ $mod1 . '_wpnonce' ], plugin_basename(__FILE__) ) )
//		return $post_id;
  if ( !current_user_can( 'edit_post', $post_id ))
    return $post_id;
  update_post_meta( $post_id, $feat, $data );
}
add_action( 'save_post', 'save_feat_box' );
function save_meta_box( $post_id ) {
    if (!isset($_POST) || count($_POST) == 0) {
      return;
    }
   if ( (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || !isset($_POST['post_ID']) || $post_id != $_POST['post_ID'])
    return $post_id;
  global $post, $meta_boxes, $mod1;
  foreach( $meta_boxes as $meta_box ) {
    $bDontUpdate = false;
    $data[ $meta_box[ 'name' ] ] = isset($_POST[ $meta_box[ 'name' ] ]) ? $_POST[ $meta_box[ 'name' ] ] : '';
    if (isset($_POST[ $meta_box[ 'name' ] ]) && is_array($_POST[ $meta_box[ 'name' ] ])) {
      $bDontUpdate = true;
      delete_post_meta($post_id, '_' . $meta_box['name']);
      foreach($_POST[ $meta_box[ 'name' ] ] as $value) {
        add_post_meta($post_id, '_'.$meta_box['name'], $value);
      }
    }
    if(isset($_POST[ $meta_box[ 'name' ] ]) && $meta_box['type'] == 'range' && preg_match('/[\.,]/',$_POST[$meta_box[ 'name' ]])){
      $_POST[$meta_box[ 'name' ]] = preg_replace('/[\.,]/', '', $_POST[$meta_box[ 'name' ]]);
    }
    if (!$bDontUpdate) {
      update_post_meta( $post_id, '_'.$meta_box['name'], isset($_POST[$meta_box[ 'name' ]]) ? $_POST[$meta_box[ 'name' ]] : '' );
    }
  }
//	if ( !wp_verify_nonce( $_POST[ $mod1 . '_wpnonce' ], plugin_basename(__FILE__) ) )
//		return $post_id;
  if ( !current_user_can( 'edit_post', $post_id ))
    return $post_id;
  update_post_meta( $post_id, $mod1, $data );
}
add_action( 'save_post', 'save_meta_box' );
function save_features_box( $post_id ) {
    if (!isset($_POST) || count($_POST) == 0) {
      return;
    }
   if ( (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || !isset($_POST['post_ID']) || $post_id != $_POST['post_ID'])
    return $post_id;


   global $post, $feat_boxes, $mod2, $feat;
  
 
  foreach( $feat_boxes as $feat_box ) {
    $bDontUpdate = false;
    $data[ $feat_box[ 'name' ] ] = isset($_POST[ $feat_box[ 'name' ] ]) ? $_POST[ $feat_box[ 'name' ] ] : '';
    if (isset($_POST[ $feat_box[ 'name' ] ]) && is_array($_POST[ $feat_box[ 'name' ] ])) {
      $bDontUpdate = true;
      delete_post_meta($post_id, '_' . $feat_box['name']);
      foreach($_POST[ $feat_box[ 'name' ] ] as $value) {
        add_post_meta($post_id, '_'.$feat_box['name'], $value);
      }
    }
    if(isset($_POST[ $feat_box[ 'name' ] ]) && $feat_box['type'] == 'range' && preg_match('/[\.,]/',$_POST[$feat_box[ 'name' ]])){
      $_POST[$feat_box[ 'name' ]] = preg_replace('/[\.,]/', '', $_POST[$feat_box[ 'name' ]]);
    }
    if (!$bDontUpdate) {
      update_post_meta( $post_id, '_'.$feat_box['name'], isset($_POST[$feat_box[ 'name' ]]) ? $_POST[$feat_box[ 'name' ]] : '' );
    }
  }
  
//	if ( !wp_verify_nonce( $_POST[ $mod2 . '_wpnonce' ], plugin_basename(__FILE__) ) )
//		return $post_id;
  if ( !current_user_can( 'edit_post', $post_id ))
    return $post_id;
  update_post_meta( $post_id, $mod2, $data );
}
add_action( 'save_post', 'save_features_box' );
function generate_years( $from, $to )
{
	$array = array();
	$i = 1;
	for( $number=$from; $number<=$to; $number++ )
	{
		$array[$i] = $number;
		$i++;
		
		$result = array_reverse($array);
		$result_num = array_reverse($array,true);
	

	}
	
	return $result_num;
}

function save_comments_box( $post_id ) {
    if (!isset($_POST) || count($_POST) == 0) {
      return;
    }
   if ( (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || !isset($_POST['post_ID']) || $post_id != $_POST['post_ID'])
    return $post_id;
   global $post, $comment_boxes, $mod3;
 
 foreach( $comment_boxes as $comment_box) { 
    $bDontUpdate = false;
    $data[ $comment_box[ 'name' ] ] = isset($_POST[ $comment_box[ 'name' ] ]) ? $_POST[ $comment_box[ 'name' ] ] : '';
    if (isset($_POST[ $comment_box[ 'name' ] ]) && is_array($_POST[ $comment_box[ 'name' ] ])) {
      $bDontUpdate = true;
      delete_post_meta($post_id, '_' . $comment_box['name']);
      foreach($_POST[ $comment_box[ 'name' ] ] as $value) {
        add_post_meta($post_id, '_'.$comment_box['name'], $value);
      }
    }
	
 if(isset($_POST[ $comment_box[ 'name' ] ]) && $comment_box['type'] == 'range' && preg_match('/[\.,]/',$_POST[$comment_box[ 'name' ]])){
      $_POST[$comment_box[ 'name' ]] = preg_replace('/[\.,]/', '', $_POST[$comment_box[ 'name' ]]);
    }

    if (!$bDontUpdate) {
      update_post_meta( $post_id, '_'.$comment_box['name'], isset($_POST[$comment_box[ 'name' ]]) ? $_POST[$comment_box[ 'name' ]] : '' );
    }
  }
  if ( !current_user_can( 'edit_post', $post_id ))
    return $post_id;
  update_post_meta( $post_id, $mod3, $data );
}
add_action( 'save_post', 'save_comments_box' );
function meta_box_craigslist()
{                                      
    add_meta_box( 'craigslist-meta-box', 
                  'Craigslist Code Generator:',     
                  'meta_box_callback', 
                  'gtcd',              
                  'normal', 
                  'low' );  
}
add_action( 'admin_menu', 'meta_box_craigslist' );
function meta_box_callback( $post )
{	global $options;$fields;$options2;$options3;$symbols;
			  $fields = get_post_meta($post->ID, 'mod1', true);
			  $symbols = get_option('gorilla_symbols');
			  $options = my_get_theme_options();
    $values = get_post_custom( $post->ID );
    $selected = isset( $values['meta_box_craigslist_embed'] ) ? $values['meta_box_craigslist_embed'][0] : '';

    wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );?> 
<p style="border-bottom:1px solid #f1f1f1;padding-bottom:3px;"><div style="height:200px;width:130px;padding:6px 0 0 5px;font-size:12px;color:#252525; font-style:normal;font-weight:bold;float: left;"><?php _e('Craigslist Code:','language');?><br/><br/><span
 style="font-weight:normal!important;font-size:11px;margin-top:15px;font-style:italic;"><?php echo _e('Copy & Paste the generated code into your Craigslist ad.','language');?></span></div></p>
<textarea name="meta_box_craigslist_embed" id="meta_box_craigslist_embed" style="width:80%;height:300px;" ><h1><?php if ( isset($fields['year'])){ echo $fields['year']; echo ' ';}else {  echo ''; }?><?php the_title();?></h1><hr /><b><?php _e('Contact:','language');?></b> <?php echo $symbols['phone']; ?><b><?php _e('Website:','language');?></b> <a href="<?php the_permalink();?>"><?php the_title();?></a><ul><?php if ( isset($fields['price'])){ echo '<li>'.$options['price_text'].': '.$symbols['currency']; echo $fields['price'].'</li>';}else {  echo ''; } ?><?php   if ( isset($fields['miles'])){ echo '<li>'.$options['miles_text'].': '.$fields['miles'].'</li>';}else {  echo ''; }?><?php if ( isset($fields['vehicletype'])){ echo '<li>'.$options['vehicle_type_text'].': '.$fields['vehicletype'].'</li>';}else {  echo ''; }?><?php if ( isset($fields['drive'])){ echo '<li>'.$options['drive_text'].': '.$fields['drive'].'</li>';}else {  echo ''; }?><?php if ( isset($fields['transmission'])){ echo '<li>'.$options['transmission_text'].': '.$fields['transmission'].'</li>';}else {  echo ''; }?></ul></td><td><ul><?php if ( isset($fields['exterior'])){ echo '<li>'.$options['exterior_text'].': '.$fields['exterior'].'</li>';}else {  echo ''; }?><?php if ( isset($fields['interior'])){ echo '<li>'.$options['interior_text'].':'.$fields['interior'].'</li>';}else {  echo ''; }?><?php   if ( isset($fields['epamileage'])){ echo '<li>'.$options['epa_mileage_text'].': '.$fields['epamileage'].'</li>';}else {  echo ''; }?><?php if ( isset($fields['stock'])){ echo '<li>'.$options['stock_text'].': '.$fields['stock'].'</li>';}else {  echo ''; }?><?php if ( isset($fields['vin'])){ echo '<li>'.$options['vin_text'].': '.$fields['vin'].'</li>';}else {  echo ''; }?></ul><br/><a href="<?php the_permalink();?>"><strong><?php _e('VIEW PHOTO GALLERY AND FULL VEHICLE DETAILS','language'); ?></strong></a><br/><p><b><?php _e('Description','language');?></b></p><p><?php $trim_length = 200;$values = get_post_meta($post->ID, 'mod3', true);if (is_array($values)){foreach($values as $value) {add_filter( 'custom_filter', 'wpautop' );echo apply_filters( 'custom_filter', $value );}} ?><p><b><?php _e('Features','language');?></b></p><p></p><?php   if (get_the_terms($post->ID, 'features')) {$taxonomy = get_the_terms($post->ID, 'features');foreach ($taxonomy as $taxonomy_term) {?><li style="float: left;position: relative;overflow: hidden;width: 207px;padding: 10px 0px;padding-left: 24px;margin: 0px 4px 0 4px; border-bottom: 1px dotted grey;"><?php echo $taxonomy_term->name;?></li><?php } } ?><br/><a href="<?php the_permalink();?>"><strong><?php _e('VIEW PHOTO GALLERY AND FULL VEHICLE DETAILS','language'); ?></strong></textarea><?php }
add_action( 'save_post', 'meta_box_craigslist_save' );
function meta_box_craigslist_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;

    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;

    // now we can actually save the data
    $allowed = array( 
        'a' => array( // on allow a tags
            'href' => array() // and those anchords can only have href attribute
        )
    );

    // Probably a good idea to make sure your data is set

    if( isset( $_POST['meta_box_craigslist_embed'] ) )
        update_post_meta( $post_id, 'meta_box_craigslist_embed', $_POST['meta_box_craigslist_embed'] );
}

//New functions for Gallery
	// Check field upload and add needed actions
	add_action('wp_ajax_rw_delete_file', 'delete_file');		// ajax delete files
	add_action('wp_ajax_rw_save_gallery', 'save_gallery');		// ajax save gallery	
	add_action('wp_ajax_rw_reorder_images', 'reorder_images');	// ajax reorder images

function save_gallery() {
		if (!isset($_POST['post_id'])) die('1');
		if (!wp_verify_nonce($_POST['nonce'], 'AddGalImage')) die('1');
		
		$All_IDS = explode(',',$_POST['Gallery_IDs']);
		$All_IDS = array_unique($All_IDS);
				
		foreach( $All_IDS as $key=>$val ){
			if (intval($val)==0){
				unset($All_IDS[$key]);
			}else{
				wp_update_post( array(
						'ID' => $val,
						'post_parent' => $_POST['post_id']
					)
				);				
			}
		}		
		$All_IDS = implode(',',$All_IDS);
		
		update_post_meta($_POST['post_id'], 'CarsGallery', $All_IDS);
		global $field;
		//wp_delete_attachment($_POST['image_id']);
		$saved = get_post_custom_values('CarsGallery', $_POST['post_id']);
		$saved = explode(',',$saved[0]);
		//Get gallery images from posts table
		if (count($saved)>0){
			foreach( $saved as $image ){
				if(intval($image)>0){
				$AllImages[] = $image;
				$attachmentimage=wp_get_attachment_image($image, 'thumbnail_medium');
				$tmp2='{'.$field['id'].'}[]';
				echo '<li id="item_'.$image.'">'.$attachmentimage.'<a class="delete" href="#" onClick="deletePost('.$image.')" >'. __('Delete','language').'</a>
				<input type="hidden" name="'.$tmp2.'" value="'.$tmp2.'" />
				</li>';
				}
			}
		}
		die();
	}
	function save_gallery_user() {
		if (!isset($_POST['post_id'])) die('1');
		if (!wp_verify_nonce($_POST['nonce'], 'AddGalImage')) die('1');
		
		$All_IDS = explode(',',$_POST['Gallery_IDs']);
		$All_IDS = array_unique($All_IDS);
				
		foreach( $All_IDS as $key=>$val ){
			if (intval($val)==0){
				unset($All_IDS[$key]);
			}else{
				wp_update_post( array(
						'ID' => $val,
						'post_parent' => $_POST['post_id']
					)
				);				
			}
		}		
		$All_IDS = implode(',',$All_IDS);
		
		update_post_meta($_POST['post_id'], 'CarsGallery', $All_IDS);
		global $field;
		//wp_delete_attachment($_POST['image_id']);
		$saved = get_post_custom_values('CarsGallery', $_POST['post_id']);
		$saved = explode(',',$saved[0]);
		//Get gallery images from posts table
		if (count($saved)>0){
			foreach( $saved as $image ){
				if(intval($image)>0){
				$AllImages[] = $image;
				$attachmentimage=wp_get_attachment_image($image, 'thumbnail_medium');
				$tmp2='{'.$field['id'].'}[]';
				echo '<li id="item_'.$image.'">'.$attachmentimage.'<a class="delete" href="#" onClick="deletePost('.$image.')" >'. __('Delete','language').'</a>
				<input type="hidden" name="'.$tmp2.'" value="'.$tmp2.'" />
				</li>';
				}
			}
		}
		die();
	}

		
	function delete_file() {
		if (!isset($_POST['image_id'])) die('1');
		if (!isset($_POST['postid'])) die('1');		
		if (!wp_verify_nonce($_POST['nonce'], 'DelGalImage')) die('1');
		$saved = get_post_custom_values('CarsGallery', $_POST['postid']);
		$saved = explode(',',$saved[0]);
		$saved = array_unique($saved);
				
		foreach($saved as $key => $val){
			if ($val == $_POST['image_id']){
				unset($saved[$key]);			
				$saved = implode(',',$saved);
				update_post_meta($_POST['postid'], 'CarsGallery', $saved);			
				//wp_delete_attachment($_POST['image_id']);
				die('0');				
			}
		}
	}
	function delete_file_user() {
		if (!isset($_POST['image_id'])) die('1');
		if (!isset($_POST['postid'])) die('1');		
		if (!wp_verify_nonce($_POST['nonce'], 'DelGalImage')) die('1');
		$saved = get_post_custom_values('CarsGallery', $_POST['postid']);
		$saved = explode(',',$saved[0]);
		$saved = array_unique($saved);
				
		foreach($saved as $key => $val){
			if ($val == $_POST['image_id']){
				unset($saved[$key]);			
				$saved = implode(',',$saved);
				update_post_meta($_POST['postid'], 'CarsGallery', $saved);			
				//wp_delete_attachment($_POST['image_id']);
				die('0');				
			}
		}
	}
	
	// Ajax callback for reordering images
	function reorder_images() {
		if (!isset($_POST['data'])) die();
		list($order, $post_id, $key, $nonce) = explode('|',$_POST['data']);
		if (!wp_verify_nonce($nonce, 'rw_ajax_reorder')) die('1');
		parse_str($order, $items);
		$items['item'] = array_unique($items['item']);
		$items = implode(',',$items['item']);
		update_post_meta($post_id, 'CarsGallery', $items);					
		die('0');
	}

// Ajax callback for reordering images
	function reorder_images_user() {
		if (!isset($_POST['data'])) die();
		list($order, $post_id, $key, $nonce) = explode('|',$_POST['data']);
		if (!wp_verify_nonce($nonce, 'rw_ajax_reorder')) die('1');
		parse_str($order, $items);
		$items['item'] = array_unique($items['item']);
		$items = implode(',',$items['item']);
		update_post_meta($post_id, 'CarsGallery', $items);					
		die('0');
	}

		
add_action('add_meta_boxes', 'add');
$types = array( 'user_listing', 'gtcd' );
function add() {
add_meta_box( 'gallery', __('Photo Gallery','language'), 'show','gtcd', 'normal', 'high' );
}


add_action('add_meta_boxes', 'add_user_gallery');
function add_user_gallery() {
add_meta_box( 'gallery_user', __('Photo Gallery','language'), 'show_user','user_listing', 'normal', 'high' );
}
	function show(){
		global $wpdb, $post, $AllImages, $field;
		$meta='';
		$size='small';
		$nonce_sort = wp_create_nonce('rw_ajax_reorder');	
		wp_nonce_field(basename(__FILE__), 'rw_meta_box_nonce');
		$blogurl = get_bloginfo('template_url');
		$saved = get_post_custom_values('CarsGallery', get_the_ID());
		$saved = explode(',',$saved[0]);
		$saved = array_unique($saved);
		$all_li = '';
		foreach( $saved as $image ){
			$image = intval($image);
			if ($image>0){							
			$AllImages[] = $image;
			$attachmentimage=wp_get_attachment_image($image, 'thumbnail_medium');
			$tmp2='{'.$field['id'].'}[]';
			$all_li .= '<li id="item_'.$image.'">'.$attachmentimage.'<a class="delete" href="#" onClick="deletePost('.$image.')" >'. __('Delete','language').'</a>
				<input type="hidden" name="'.$tmp2.'" value="'.$tmp2.'" />
				</li>';
			}
		}
				
		?>
            <div style="height:30px !important;" >
            <?php if(count($AllImages)>0){
				$AllImagesImp = implode(',',$AllImages);
				?>
            	<div class="messagebox" id="messageBox">
					Total images count: <?php echo count($AllImages); ?> images
                </div>
            <?php }else{
				$AllImagesImp ='';
				?>
            	<div class="messagebox" id="messageBox" style="display:none;">					
                </div>
            <?php 						
				}
			?>
            </div>                
        <?php
		echo '<table class="form-table">';
		echo '<tr><td style="padding:0px !important">';		
		echo "<input type='hidden' class='rw-images-data' value='{$post->ID}|{$field['id']}|$nonce_sort' />";			
		//Get gallery images from posts table
		?>
        <ul class="rw-images rw-upload" id="rw-images-<?php echo $field['id'];?>">
        <?php
			echo $all_li;
		?>
        </ul>        
        <?php
		echo "</td></tr>";
		echo '</table>';
        echo '<div id="tgm-new-media-settings">';
        echo '<p><a href="#" class="tgm-open-media button button-primary" title="' . 
		esc_attr__( 'Upload Images', 'language' ) . '">' . __( 'Upload Images', 'language' ) . '</a></p>';
        echo '<input type="hidden" name="CarsGallery" id="tgm-new-media-image" size="70" value="' . $AllImagesImp . '" />';
        echo '</div>';						
	}

	
	function show_user(){
		global $wpdb, $post, $AllImages, $field;
		if ( $images = get_children(array(
		'post_parent' => get_the_ID(),
		'post_type' => 'attachment',
		'order' => 'ASC',
		'orderby' => 'menu_order',
		'post_mime_type' => 'image',
		)))
	{		foreach( $images as $image ) {
		
			$attachmenturl=wp_get_attachment_url($image->ID);
			$attachmentlink=wp_get_attachment_url($image->ID);
			$attachmentimage= wp_get_attachment_image($image->ID, 'thumbnail_medium' );
			$img_title = $image->post_title;
			$img_desc = $image->post_excerpt;
			
			?>
			 <ul class="user-images">
        <?php
			echo '<li>'.$attachmentimage.'</li>';
		?>
        </ul>  	
			<?php
						
						
		}
	} else {
		echo "";
}	
				
		?>
            <div style="height:30px !important;" >
            <?php if(count($AllImages)>0){
				$AllImagesImp = implode(',',$AllImages);
				?>
            	<div class="messagebox" id="messageBox">
					<?php _e('Total images count: ','language');?><?php echo count($AllImages); ?> <?php _e('images','language');?>
                </div>
            <?php }else{
				$AllImagesImp ='';
				?>
            	<div class="messagebox" id="messageBox" style="display:none;">					
                </div>
            <?php 						
				}
			?>
            </div>                
        <?php
		echo '<table class="form-table">';
		echo '<tr><td style="padding:0px !important">';		
		echo "<input type='hidden' class='rw-images-data' value='{$post->ID}|{$field['id']}|$nonce_sort' />";			
		//Get gallery images from posts table
		?>
        <ul class="rw-images rw-upload" id="rw-images-<?php echo $field['id'];?>">
        <?php
			echo $all_li;
		?>
        </ul>        
        <?php
		echo "</td></tr>";
		echo '</table>';
        echo '<div id="tgm-new-media-settings">';
        echo '<p><a href="#" class="tgm-open-media button button-primary" title="' . 
		esc_attr__( 'Add - Delete Images', 'language' ) . '">' . __( 'Add - Delete Images', 'language' ) . '</a></p>';
        echo '<input type="hidden" name="CarsGallery" id="tgm-new-media-image" size="70" value="' . $AllImagesImp . '" />';
        echo '</div>';						
	}
		
add_action( 'admin_enqueue_scripts', 'assets');
function assets() {
  //if ( ! ( 'post' == get_current_screen()->base && 'page' == get_current_screen()->id ) )
	//  return;
  // This function loads in the required media files for the media manager.
  wp_enqueue_media();
  wp_register_script( 'tgm-nmp-media', get_bloginfo('template_url') . '/media.js', array( 'jquery' ), '1.0.0', true );
  wp_localize_script( 'tgm-nmp-media', 'tgm_nmp_media',
	  array(
		  'title'     => __( 'Upload or Choose Your Custom Image File', 'language' ),
		  'button'    => __( 'Insert Image into Input Field', 'language' ) 
	  )
  );
  wp_enqueue_script( 'tgm-nmp-media' );
}
?>