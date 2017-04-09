;(function ( $, Hammer, Modernizr, window, document, undefined ) {

  function TransformElement( $element, $container ){
    this.$events = $({});
    this.$element = $element;
    console.log($element.width(),$element);
    this.initial_width = $element.width();
    this.initial_height = $element.height();
    this.adjust_scale = 1;
    this.adjust_delta_x = 0;
    this.adjust_delta_y = 0;
    this.current_scale = null;
    this.current_delta_x = null;
    this.current_delta_y = null;
    this.bounds = false;
    if($container && $container.has($element)){
      this.$container = $container;
      this.bounds = {w:$container.width(), h:$container.height()};
    } else {
      this.$container = $("<div></div>");
      this.$element.parent().append(this.$container);
      this.$container.append(this.$element);
    }

    this.$container.on('touchstart', function( event ) {
      event.preventDefault();
    });
    
    this.manager = new Hammer.Manager( this.$element.get(0) );
    this.pinch = new Hammer.Pinch();
    this.pan = new Hammer.Pan();

    this.pinch.recognizeWith(this.pan);
    this.manager.add([this.pinch, this.pan]);
    var _this = this;
    this.manager.on("pinch pan", function (ev) {
      _this.adjust(ev.deltaX, ev.deltaY, ev.scale);
    });
    this.manager.on("panend pinchend", function (ev) {
      _this.adjust_scale = _this.current_scale;
      _this.adjust_delta_x = _this.current_delta_x;
      _this.adjust_delta_y = _this.current_delta_y;
    });
  }
  TransformElement.prototype.on = function( event, fn ){
    this.$events.on(event, fn);
  };
  TransformElement.prototype.one = function( event, fn ){
    this.$events.one(event, fn);
  };
  TransformElement.prototype.off = function( event ){
    this.$events.off(event);
  };
  TransformElement.prototype.adjust = function( x, y, scale ){
    this.current_scale = this.adjust_scale * scale;
    this.current_delta_x = this.adjust_delta_x + (x / this.current_scale);
    this.current_delta_y = this.adjust_delta_y + (y / this.current_scale);
    if(this.bounds){
      var w = this.initial_width * this.current_scale,
          h = this.initial_height * this.current_scale;
      console.log(this.current_delta_x,this.bounds.w,w,this.bounds.w - w);
      
      this.current_delta_x = Math.min(this.current_delta_x,this.bounds.w - w);
      this.current_delta_y = Math.min(this.current_delta_y,this.bounds.h - h);  
    }
    this.transform( this.current_delta_x, this.current_delta_y, this.current_scale );
  };
  TransformElement.prototype.transform = function( x, y, scale, rotate ){
    var transform = '';
    if(x !== ''){
      if(typeof x === 'object'){
        scale = x.scale;
        rotate = x.rotate;
        y = x.y;
        x = x.x;//Last!
      }
      var transforms = [];
      if(x !== '' && y !== '' && typeof x !== 'undefined' && typeof y !== 'undefined'){
        transforms.push('translate(' + x + 'px,' + y + 'px)');  
      }
      if(scale !== '' && typeof scale !== 'undefined'){
        transforms.push('scale('+ scale +')');
      }
      if(rotate !== '' && typeof rotate !== 'undefined'){
        transforms.push('rotate('+ (typeof rotate == 'string' ? rotate : rotate + 'deg') +')');
      }
      transform = transforms.join(' ');
    }
    this.$container.css(Modernizr.prefixed('transform'), transform);
  };
  
  window.transformelement = TransformElement;
    
})( jQuery, Hammer, Modernizr, window, document );  