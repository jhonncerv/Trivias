;(function ( $, Hammer, window, document, undefined ) {

  function ZoomPanel( $element, class_image, class_lens, class_marks, class_marks_item ){
    this.times = 0;
    this.$element = $element;
    this.class_image = class_image;
    this.class_lens = class_lens;
    this.class_marks = class_marks;
    this.class_marks_item = class_marks_item;
    this.$image = this.$element.find("." + this.class_image);
    this.$lens = this.$element.find("." + this.class_lens);
    this.$marks = this.$element.find("." + this.class_marks);
    this.$marks_item = this.$element.find("." + this.class_marks_item).clone();
    this.$marks.empty();
    var _this = this;
    this.$element.on({
      'mousemove': function( event ){ _this.showLens( event.pageX, event.pageY ); },
      'mouseleave': function( event ){ _this.hideLens( event ); }
    });
    //this.hammer = new Hammer(this.$element.get(0));
    this.$element.click(function( event ){ 
      _this.setMark( event.pageX - $(this).offset().left, event.pageY - $(this).offset().top );
    });
    this.$image.hide();
    this.marks = [];
    this.marks_total = -1;
  }
  ZoomPanel.prototype.hideLens = function( event ){
    this.$image.hide();
    this.$lens.hide();
  };
  ZoomPanel.prototype.setTotalMarks = function( total ) {
    this.marks_total = total;
  };
  ZoomPanel.prototype.clear = function(){
    this.$marks.empty();
    this.marks = [];
    this.marks_total = -1;
  };
  ZoomPanel.prototype.setMark = function( x, y ) {
    this.marks.push({x:x,y:y});
    if(this.marks.length > this.marks_total){
      this.marks.shift();
    }
    this.$marks.empty();
    for (var i = this.marks.length - 1; i >= 0; i--) {
      this.$marks_item.clone()
        .appendTo( this.$marks )
        .css({left:this.marks[i].x - 15,top:this.marks[i].y - 15});
    }
  };
  ZoomPanel.prototype.showLens = function( x, y ) {
    this.$image.show();
    var mouseX = x - this.$image.offset().left,
      mouseY = y - this.$image.offset().top,
      w = this.$image.width(),
      h = this.$image.height();
    this.$image.css({
      'background-position': (mouseX / w * 100) + '% ' + (mouseY / h * 100) + '%',
      '-webkit-mask-image': 'radial-gradient(circle 70px at ' + mouseX + 'px ' + mouseY + 'px, rgba(255,255,255,1) 90%, rgba(255,255,255,0) 100%)',
      'cursor': 'none'
    });
    this.$lens.show().css({
      'left': mouseX,
      'top': mouseY
    });
  };
  ZoomPanel.prototype.serialize = function( real_w, real_h ) {
    var data = [], 
        w = this.$marks.width(),
        h = this.$marks.height();
    real_w = real_w || w;
    real_h = real_h || h;
    for (var i = 0; i < this.marks.length; i++) {
      data.push( {x: Math.round(real_w * this.marks[i].x / w), y: Math.round(real_h * this.marks[i].y / h)} );
    }
    return data;
  };

  window.zoompanel = ZoomPanel;
    
})( jQuery, Hammer, window, document );