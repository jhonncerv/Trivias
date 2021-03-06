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

(function($) {

  var UTIL, Sage = {
    'common': {
      init: function() {
        
        window.requiereFB( window.config.appid );

        $('.main-header__menu').click(function(){
          $('body').toggleClass('menu-visible');
        });

        $('img.svg').each(function(){
            var $img = $(this);
            var imgID = $img.attr('id');
            var imgClass = $img.attr('class');
            $.get($img.attr('src'), function(data) {
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

        window.loader = function( show ){
          if(show){
            $(".tw-loader").stop().fadeIn("fast");  
          } else {
            $(".tw-loader").stop().fadeOut("fast");
          }
        };
        window.loader_start = function( event ){
          window.loader(true);
        };
        window.loader_end = function( event ){
          window.loader(false);
        };

        $('.tw-message__button').click(function(){
          $('.tw-message').fadeOut();
        });
        window.message = function( message ){
          $('.tw-message__text').html( message );
          $('.tw-message').fadeIn();
        };
        window.onerror_message = function( event, message ){
          window.message( message );
        };

        window.score = function( score ){
          $('.profile-photo__score').text( score );
        };
        window.onsuccess_score = function( event, data ){
          window.score( data.points_new );
        };
        
        function onclick_close_popup( event ){
          event.preventDefault();
          $( ".tw-popup" ).fadeOut();
        }
        $(".tw-popup__close").click(onclick_close_popup);
        $(".tw-popup-trigger").click(function( event ){
          event.preventDefault();
          window.loader_start();
          $( ".tw-popup__main" ).load( $(this).attr("href") + " .tw-page", function(){
            window.loader_end();
            var body_classes = $( ".tw-popup__main" ).find(".tw-page").data("body-classes");
            if(body_classes){
              UTIL.fireClasses(body_classes);
            }
            $( ".tw-popup__main .tw-page__return, .tw-popup__main .tw-page__logo" ).click(onclick_close_popup);
            $( ".tw-popup" ).fadeIn();
          });
        });
      }
    },
    'app': {
      init: function(){

        var Dynamics = window.dynamics,
            PinsPostals = window.pinspostals,
            dynamics = new Dynamics(window.config.dynamic, window.config.start, window.config.save),
            pins = new PinsPostals(window.config.postalto, $(".tw-map__pins__item"), "tw-map__pins__item--postal", "tw-map__pins__item__postal__share", window.config.postal, window.config.appid, window.config.hashtag);
        
        pins.postalEvents({
          'request.start':window.loader_start,
          'request.end':window.loader_end,
          'error':window.onerror_message,
          'success':window.onsuccess_score
        });

        pins.start(1);
        pins.start(2);
        pins.start(3);
        pins.start(4);
        pins.start(5);

        dynamics.on('request.start',window.loader_start);
        dynamics.on('request.end',window.loader_end);
        dynamics.on('error',window.onerror_message);

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
            $score.find('.tw-dynamic__score__message').html(data.message ? data.message : '');
            window.score(data.score_new);
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

        var finding = dynamics.initFinding( $('.tw-dynamic--finding .zoompanel'), $('.tw-dynamic--finding .finding__button'), 'zoompanel__image', 'zoompanel__lens', 'zoompanel__marks', 'zoompanel__marks__item' );
        attachTimerEvents(finding.getTimer());

        $(".tw-map__dots__item--available").click(function(){
          $(".tw-map").attr("class","tw-map tw-map--" + $(this).data("id"));
        });

      }
    },
    'login': {
      init: function() {

        var FBLogin = window.fblogin,
            facebook = new FBLogin( window.config.login, window.config.appid, window.config.scope );
        
        facebook.on('fblogin.error', window.onerror_message);
        facebook.on('fblogin.done', function( event, response ){
          window.location = response.redirect || window.location.href;
        });

        $('.login-page__button').click(function( event ){
          event.preventDefault();

          if($('.login-page__tyc input').is(":checked")){
            facebook.connect();
          } else {
            window.message("Debes aceptar los términos y condiciones para poder registrarte.");
          }
        });
      }

    },
    'postal_page': {
      init: function() {
        var PostalShare = window.postalshare,
            click = function( event ){
              event.preventDefault();
              $(this).data('postal').ui();
            };
        $(".tw-postal__share a.fb:not(.ps-initialized)").addClass("ps-initialized").each(function( i, e ){
          var $e = $(e),
              postal = new PostalShare(window.config.postal, window.config.appid, window.config.hashtag, $e.attr("href"), $e.data("id"));
          postal.on('request.start',window.loader_start);
          postal.on('request.end',window.loader_end);
          postal.on('error',window.onerror_message);
          postal.on('success',window.onsuccess_score);
          $e.data('postal',postal);
          $e.click( click );
        }); 
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