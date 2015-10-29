;(function ($, window, undefined){
  'use strict';

  $.fn.foundationAccordion = function (options) {

    // DRY up the logic used to determine if the event logic should execute.
    var hasHover = function(accordion) {
      return accordion.hasClass('hover') && !Modernizr.touch
    };

    $(document).on('mouseenter', '.accordion li', function () {
        var p = $(this).parent();

        if (hasHover(p)) {
          var flyout = $(this).children('.content').first();

          $('.content', p).not(flyout).slideUp('slow').parent('li').removeClass('active');
          flyout.show(function () {
			  flyout.slideDown('slow');
            flyout.parent('li').addClass('active').slideDown('slow');
			
          });
        }
      }
    );

    $(document).on('click.fndtn', '.accordion li .title', function () {
        var li = $(this).closest('li'),
            p = li.parent();

        if(!hasHover(p)) {
          var flyout = li.children('.content').first();

          if (li.hasClass('active')) {
            p.find('li').find('.content').slideUp('slow').end().removeClass('active');
          } else {
            $('.content', p).not(flyout).slideUp('slow').parent('li').removeClass('active');
            flyout.show(function () {
				 
              flyout.parent('li').addClass('active').slideDown('slow');
			  
            });
          }
        }
      }
     );

  };

})( jQuery, this );

