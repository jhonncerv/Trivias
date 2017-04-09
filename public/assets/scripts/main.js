/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

function message( text ){
  alert(text);
}

(function($) {

  var UTIL, Sage = {
    'common': {
      init: function() {
        $('.main-header__menu').click(function(){
          $('body').toggleClass('menu-visible');
        });

        $('img.svg').each(function(){
            var $img = $(this);
            var imgID = $img.attr('id');
            var imgClass = $img.attr('class');
            var imgURL = $img.attr('src');
            $.get(imgURL, function(data) {
                var $svg = $(data).find('svg');
                if(typeof imgID !== 'undefined') {
                    $svg = $svg.attr('id', imgID);
                }
                if(typeof imgClass !== 'undefined') {
                    $svg = $svg.attr('class', imgClass+' replaced-svg');
                }
                $svg = $svg.removeAttr('xmlns:a');
                $img.replaceWith($svg);
            }, 'xml');
        });
      }
    },
    'app': {
      init: function(){
        var dynamics = new window.dynamics(window.config.dynamic,window.config.start,window.config.save);
        
        dynamics.on('request.start',function(){
          $(".tw-loader").stop().fadeIn("fast");
        });
        dynamics.on('request.end',function(){
          $(".tw-loader").stop().fadeOut("fast");
        });
        dynamics.on('error',function( event, message ){
          message(message);
        });
        $('[data-trigger-city]').click(function(){
          dynamics.request_dynamic({city:$(this).data('trigger-city')});
        }); 
        dynamics.on('dynamic',function( event, dynamic ){
          var $dynamic = $('.tw-dynamic--' + dynamic.getType());
          $dynamic.find('.tw-dynamic__preview').show();
          $dynamic.find('.tw-dynamic__app').hide();
          $dynamic.find('.tw-dynamic__score').hide();
          $dynamic.fadeIn();
        });
        $('.tw-dynamic__start').click(function(){
          dynamics.request_start();
        });
        $('.tw-dynamic__close').click(function(){
          $('.tw-dynamic').fadeOut();
        });
        dynamics.on('start',function( event, dynamic ){
          var $dynamic = $('.tw-dynamic--' + dynamic.getType());
          $dynamic.find('.tw-dynamic__preview').fadeOut('fast', function(){
            $dynamic.find('.tw-dynamic__app').fadeIn('fast');  
          });
        });
        dynamics.on('save',function( event, dynamic, data ){
          var $dynamic = $('.tw-dynamic--' + dynamic.getType()),
              $score = $dynamic.find('.tw-dynamic__score');
          $dynamic.find('.tw-dynamic__app').fadeOut('fast',function(){
            $score.find('.dy-score_time').text(data.score_time);
            $score.find('.dy-score_dynamic').text(data.score_dynamic);
            $score.find('.dy-score_new').text(data.score_new);
            $('.profile-photo__score').text(data.score_new);
            $score.fadeIn();
          });
        });

        function attachTimerEvents( timer ){
          timer.on('start',function( event, time_string, progress ){
            $('.tw-timer').fadeIn();
          });
          timer.on('start tick',function( event, time_string, progress ){
            $('.tw-timer').attr('data-progress', 100 - progress);
            $('.tw-timer__inset').text(time_string);
          });
          timer.on('end',function( event ){
            $('.tw-timer').fadeOut();
          });
        }
        
        var twinder = dynamics.initTwinder( $('.tw-dynamic--twinder .swipecards'), $('.tw-dynamic--twinder .swipecards__item') ),
            twinder_swipecards = twinder.getSwipeCards();
        attachTimerEvents(twinder.getTimer());
        twinder_swipecards.on('move miss',function( event, card ){
          var $tags = card.getElement().find('.swipecards__item__tag'),
          percentage = card.getPercentage();
          $tags.css('opacity', 0);
          if(percentage > 0){
            $tags.filter('.swipecards__item__tag--' + card.getDirection()).css('opacity',percentage);
          }
        });
        $('.swipecards__c__item--right').click(function(){
          twinder_swipecards.swipeRight();
        });
        $('.swipecards__c__item--left').click(function(){
          twinder_swipecards.swipeLeft();
        });
        
        var trivia = dynamics.initTrivia( $('.tw-dynamic--trivia .trivia'), 'trivia__item', 'trivia__item__text', 'trivia__item__r', 'trivia__item__r__item', 'trivia__item__r__item--active' );
        attachTimerEvents(trivia.getTimer());

        var siluetas = dynamics.initSiluetas( $('.tw-dynamic--siluetas .trivia'), 'trivia__item', 'trivia__item__image', 'trivia__item__r', 'trivia__item__r__item', 'trivia__item__r__item--active' );
        attachTimerEvents(siluetas.getTimer());
      }
    },
    'login': {
      init: function() {
        var FBLogin = window.fblogin,
            facebook = new FBLogin( window.config.login, window.config.appid, window.config.scope );
        
        facebook.on('fblogin.error', function( event, error ){
          message(error);
        });
        facebook.on('fblogin.done', function( event, response ){
          window.location = response.redirect || window.location.href;
        });
        $('.login-page__button').click(function( event ){
          event.preventDefault();
          if($('.login-page__tyc input').is(":checked")){
            facebook.connect();  
          } else {
            message("Debes aceptar los términos y condiciones para poder registrarte.");
          }
        });
      }
    },
    'find': {
      init: function() {
        var TransformElement = window.transformelement,
            $element = $('.transform-element'),
            $bounds = $('.transform-element-bounds'),
            panel = new TransformElement( $element, $bounds );
        $element.find('img').on('dragstart', function(event) { event.preventDefault(); });
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        //console.log('UTIL.fire', 'Sage.' + func + '.' + funcname);
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      UTIL.fireClasses( document.body.className );
      
      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    },
    fireClasses: function( classes ){
      $.each(classes.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.