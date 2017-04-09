;(function ( $, window, document, undefined ) {

  function Timer(  ){ 
    this.$events = $({});
    this.interval = false;
  }
  Timer.prototype.on = function( event, fn ){
    this.$events.on(event, fn);
  };
  Timer.prototype.one = function( event, fn ){
    this.$events.one(event, fn);
  };
  Timer.prototype.off = function( event ){
    this.$events.off(event);
  };
  Timer.prototype.getTimeRemaining = function( endtime ) {
    var t = Math.max(0,new Date( endtime ) - Date.parse(new Date()));
    var seconds = Math.floor((t / 1000) % 60);
    var minutes = Math.floor((t / 1000 / 60) % 60);
    var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
    var days = Math.floor(t / (1000 * 60 * 60 * 24));
    return {
      'total': t,
      'days': days,
      'hours': hours,
      'minutes': minutes,
      'seconds': seconds
    };
  };
  Timer.prototype.start = function( endtime ){
    var _this = this,
        tick = function( start ){
          var t = _this.getTimeRemaining( endtime ),
              c = Math.floor(t.total / 1000);
          if (c >= 0 || start) {
            _this.$events.trigger(start === true ? "start" : "tick", [t.minutes +":"+ ('0' + t.seconds).slice(-2), 100 - Math.ceil(t.seconds * 100 / 60)]);
          }
          if (isNaN(c) || (c <= 0 && !start)) {
            _this.stop();
          }
        };
    tick(true);
    this.interval = setInterval(tick,1000);
  };
  Timer.prototype.stop = function(){
    clearInterval(this.interval);
    this.$events.trigger("end");
  };

  window.timer = Timer;
    
})( jQuery, window, document );  