var checkDeviceWidthCheck = $(window).width(); // Single page Top Specs

$(document).ready(function() {

if(screen.width > 767){
			
			$('.header-home,#container,.header').css('padding','0 15px');
			$('.header-home').before($('<div class="bg_fix"></div>'));
			$('.header').before($('<div class="bg_fix_inner"></div>'));
			}	
	  
	 if(checkDeviceWidthCheck < 767){
	
		$( "#nav" ).elastislide();
		
	   $('#gallery').cycle({
		fx:     'fade',
		next:   '#gallery', 
		width:'100%',
		height:'auto',
		speed:  'slow',
		timeout: 0,
		pager:  '#nav',
		pagerAnchorBuilder: function(idx, slide) {
			// return sel string for existing anchor
			return '#nav li:eq(' + (idx) + ') a';
		}
	});
	 
						$("#gallery a img").css("width","100%");
						$("#gallery a").css("width","100%");
						$("#gallery a").css("width","");				
						$("#gallery a").css("height","");
						
						$(window).resize(function(){								
							var h = $("#gallery a").height();
							$("#gallery").css("height",h);
							$("#gallery a").css("width","");
							$("#gallery a").css("height","");								
						});
						
						 
						$("#nav li a").live({
							click: function() {
									$("#gallery a").css({display:"none"});
									$("#gallery a").css({width:"100%"});
									$("#gallery a").css({height:"100%"});
									$("#gallery a").css({display:"inherit"});
									//$("#gallery a").css("height","");
							}
						});

						$("#gallery a").bind({
							click: function() {
									$("#gallery a").animate({width:"100%"});
									$("#gallery a").css("height","");
							 }
	 });
						
	 				
	 
	  //Search Framework Action link fix for mobile. 
	// jQuery('#advSearch').attr('action', '/#search/')
	 
					jQuery("#sidebar-search").css({display: "none"});
					jQuery('a#searchBoxPop2').live('click',function(){
					jQuery("#sidebar-search").show();
					jQuery("#sidebar-search").css({top: "136px"});
					jQuery("#sidebar-search").css({width: "100%"});
					jQuery("#sidebar-search").css({paddingBottom: "20px"});
					jQuery(".advSearch").css({width: "100%"});
					jQuery("#sidebar-search").css({position: "absolute"});
					jQuery("#sidebar-search").css({background: "#000000"});
					jQuery("#sidebar-search").css("z-index","10000");
					jQuery('div.innerSearchPopup').css("z-index","9999");
					jQuery('div.innerSearchPopup').show();

				
			 //	jQuery('.detail-page-content').animate({marginTop:290}, 600);
				
				var number = 2; // the number of events you toggle through
				
				if (! window.toggle_counter )
					window.toggle_counter = 0;
				switch (window.toggle_counter) {
					case 0:
					
						jQuery('div.innerSearchPopup').show();
						 jQuery('div.search-form-wrapper').show();
						 
						break;
					case 1:
						jQuery('div.innerSearchPopup').hide();
						 jQuery("#sidebar-search").hide();
						 jQuery('div.search-form-wrapper').hide();
						break;
					 
				}
				window.toggle_counter = (window.toggle_counter + 1) % number;				
				
			 
		  if(jQuery('.header-wrapper-home').length){
				
				var number2 = 2; // the number of events you toggle through
				
				if (! window.toggle_counter )
					window.toggle_counter = 0;
				switch (window.toggle_counter) {
					case 0:
					
						jQuery('.header-wrapper-home').slideDown(500);
						 
						break;
					case 1:
						jQuery('.header-wrapper-home').slideUp(500);
						break;
					 
				}
				window.toggle_counter = (window.toggle_counter + 1) % number2;	
				
				
				
				 
			}
		}); //EOF CLICK EVENT
		
	  
	/*
if(jQuery('.header-wrapper-home').length){ // If homepage
			jQuery('.mobile-search-wrapper').show(); //show search function
			jQuery('.mobile-slider').show(); //show search function
	 }
	
*/
	
	 
	 jQuery(' .right-white-block .deal-rates li:last-child').css('border-bottom','0px');
	
	
	
	  
	} //widthCheck
	
	
$('.scrollup').click(function(){
            $("html, body").animate({ scrollTop: 0 }, 500);
            return false;
        });
 
});
  
	if(checkDeviceWidthCheck < 767){
	
function HideDivsOnSearch(){
			if(checkDeviceWidthCheck < 767){
			 
				$('.header-wrapper-home').slideUp(500);
				$('.innerSearchPopup').slideUp(500);
				$('.mobile-slider').hide(); //show search function
				$('.header').slideUp(500); //show search function
			 
			}
		 }
		
		$('ul.quick-list').wrapAll('<ul class="refine-nav"><li class="first-mobile"></li></ul>');
		$('ul.refine-nav ul.quick-list').before('<span>&nbsp;&nbsp;Specifications (touch to show/hide details)</span>');
		$("ul.refine-nav ul.quick-list").css("display", "none");
	}
	else
	{
		function HideDivsOnSearch(){}
		
	}