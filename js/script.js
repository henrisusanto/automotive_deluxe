jQuery(document).ready(function(){



    $('#gallery').cycle({
        fx:     'fade',
        speed:  'slow',
        timeout: 0,
        pager:  '#nav',
        pagerAnchorBuilder: function(idx, slide) {
            // return sel string for existing anchor
            return '#nav li:eq(' + (idx) + ') a';
        }
    });


	$('ul.news > li:last-child').addClass('last-child');


	$("#contactForm").validate();
	$('.slides_container h2').show();
	$('.title-detail-tag').show();

	$(function(){
		
		$('#slides').slides({
			effect: 'fade',
			crossfade: true,
			preload: true,
			preloadImage: 'images/loading.gif',
			play: 6500,
			pause: 1000,
			hoverPause: true
		});
	});

	
		$('a#link').click(function(){
		var destination = $("#results").offset().top;
		$("html,body").animate({ scrollTop: destination},1100, 'swing', function() {
      
  });
	});

	

	$('.hideHome').hide();

	
	$('#cars-container').cycle({
		fx: 'fade',
		pause: 'true',
		speed: '1000',
		autostop: true,
		autostopCount: -1
	});
	
	$('.find-nav .one').click(function(){
		$('#cars-container').cycle(0);
		$('.find-nav .active').removeClass('active');
		$(this).addClass('active');
		return false;
	});
	
	$('.find-nav .two').click(function(){
		$('#cars-container').cycle(1);
		$('.find-nav .active').removeClass('active');
		$(this).addClass('active');
		return false;
	});
	
	$('.find-nav .three').click(function(){
		$('#cars-container').cycle(2);
		$('.find-nav .active').removeClass('active');
		$(this).addClass('active');
		return false;
	});
	
	$('.find-nav .four').click(function(){
		$('#cars-container').cycle(3);
		$('.find-nav .active').removeClass('active');
		$(this).addClass('active');
		return false;
	});
	
	$('.find-nav .five').click(function(){
		$('#cars-container').cycle(4);
		$('.find-nav .active').removeClass('active');
		$(this).addClass('active');
		return false;
	});
	
	// Function for expending sidebar info items
	$('.refine-nav>li.first').addClass('active');
	$('.refine-nav>li.second ul').slideUp(1000);
	$('.refine-nav>li.third ul').slideUp(1000);
	$('.refine-nav>li.fourth ul').slideUp(1000);
	$('.refine-nav>li span').click(function(){
		
		var parent = $(this).parent('li');
		
		if(parent.hasClass('active'))
		{
			if(parent.find('ul').hasClass('expanded')) 
			{
				parent.find('ul').slideUp(500).removeClass('expanded');
				parent.removeClass('active');
			}
			else
			{
				parent.find('ul').slideDown(500).addClass('expanded');
			}
		}
		else
		{
	  		
	  		$('.refine-nav li.active').find('ul').slideUp(500).removeClass('expanded');
			$('.refine-nav li.active').removeClass('active');
	  		parent.addClass('active');
	  		parent.find('ul').slideDown(500).addClass('expanded');
		}
	});
	
	// Sidebar Tabs Control

	
	
	$('.features-tab').click(function(){
		$('.tabs span').removeClass('active');
		$(this).addClass('active');
		$('.item-list ul.active').removeClass('active').fadeOut('fast',function(){
			$('.features').fadeIn('fast').addClass('active');
		});
	});
	$('.overview-tab').click(function(){
		$('.tabs span').removeClass('active');
		$(this).addClass('active');
		$('.item-list ul.active').removeClass('active').fadeOut('fast',function(){
			$('.overview').fadeIn('fast').addClass('active');	
		});
	});
	$('.video-tab').click(function(){
		$('.tabs span').removeClass('active');
		$(this).addClass('active');
		$('.item-list ul.active').removeClass('active').fadeOut('fast',function(){
			$('.video').fadeIn('fast').addClass('active');
		});
	});	
	

	
	
	
	// Gallery


		$('a.gallery').colorbox({ opacity:0.5 , rel:'gal1' });
		$('#bigphoto').colorbox({ opacity:0.5 , rel:'gal1' });
		$('.carfax').colorbox({opacity:0.5,iframe:true, innerWidth:940, innerHeight:800,fastIframe:false});
		$('a.attachment-thumbnail_gallery').colorbox({ opacity:0.5 , rel:'gal1' });

	$(".dropdown").selectBox();


	
	
$('img').each( function () {
		$(this).removeAttr( 'width' );
		$(this).removeAttr( 'height' );
	});

	

});