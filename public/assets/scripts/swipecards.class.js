/**
 * Based on: Tindercards.js
 */

;(function ( $, Hammer, Modernizr, window, document, undefined ) {

  function Card( $element, index, parent, callback_swipe, callback_move, callback_miss ){
    this.$element = $element;
    this.$element.css('z-index',index);
    this.index = index;
    this.parent = parent;
    this.position = 0;
    this.callback_swipe = callback_swipe;
    this.callback_move = callback_move;
    this.callback_miss = callback_miss;
    if($element.length){
      this.hammer = new Hammer($element.get(0));
      var _this = this;
      this.hammer.on('panleft panright panend panup pandown', function ( event ) {
        switch(event.type){
          case 'panend':
            _this._testPanEnd( event.deltaX );
          break;
          case 'panup': case 'pandown':
            event.preventDefault();
          break;
          default:
            _this.move( event.deltaX, '' );
        }
      });
    }
  }
  Card.prototype._testPanEnd = function( direction ){
    if (this.isSwiped()) {
      this.swipe( direction );
    } else {
      this.move(0, '0.3s');
      if(typeof this.callback_miss === 'function') {
        this.callback_miss( this );
      }
    }
  };
  Card.prototype.move = function( position, time, factor ){
    this.position = position;
    factor = factor || 1;
    if(time !== undefined){
      this.transition(time);
    }
    this.transform(factor * this.position, Math.abs(this.position) * -0.15, factor * this.position * -0.1);
    if(typeof this.callback_move === 'function') {
      this.callback_move( this );
    }
  };
  Card.prototype.reset = function(){
    this.$element.show();
    this.move(0, '');
  };
  Card.prototype.return = function(){
    this.$element.show();
    var _this = this;
    setTimeout(function(){
      _this.move(0, '0.5s');  
    },50);
  };
  Card.prototype.swipe = function( direction, delay ){
    this.move(this.parent.getLimit() * (direction > 0 ? 1 : -1), '0.5s' + (delay !== undefined ? ' ' + delay : ''), 5);
    if(typeof this.callback_swipe === 'function') {
      this.callback_swipe( this );
    }
    var $e = this.$element;
    setTimeout(function () {
      $e.hide();
    }, 500);
  };
  Card.prototype.getPercentage = function(){
    return Math.max(0, Math.min(1, Math.abs(this.position) / this.parent.getLimit()));
  };
  Card.prototype.isSwiped = function(){
    return Math.abs(this.position) >= this.parent.getLimit();
  };
  Card.prototype.getDirection = function(){
    return this.position > 0 ? 'right' : 'left';
  };
  Card.prototype.transition = function( time ){
    this.$element.css(Modernizr.prefixed('transition'), time === '' ? '' : Modernizr.prefixed('transform') + ' ' + time);
  };
  Card.prototype.transform = function( x, y, rotate ){
    this.$element.css(Modernizr.prefixed('transform'), x === '' ? '' : 'translate3d(' + x + 'px, ' + y + 'px, 0) rotate(' + rotate + 'deg)');
  };
  Card.prototype.getIndex = function(){
    return this.index;
  };
  Card.prototype.getElement = function(){
    return this.$element;
  };
  Card.prototype.data = function( value ){
    return this.$element.data(data, value);
  };
  Card.prototype.clear = function(){
    this.hammer.off('panleft panright panend panup pandown');
    this.$element.remove();
  };

  function SwipeCards( limit ){
    this.$events = $({});
    this.limit = limit || 100;
    this.cards = [];
  }
  SwipeCards.prototype.on = function( event, fn ){
    this.$events.on(event, fn);
  };
  SwipeCards.prototype.one = function( event, fn ){
    this.$events.one(event, fn);
  };
  SwipeCards.prototype.off = function( event ){
    this.$events.off(event);
  };
  SwipeCards.prototype.getLimit = function(){
    return this.limit;
  };
  SwipeCards.prototype.addCard = function( $element ){
    var _this = this;
    this.cards.push(new Card( $element, this.cards.length, this, 
      function( card ){
        _this.$events.trigger('swipe', card);
        if(_this.isEmpty()){
          _this.$events.trigger('empty', card);
        }
      },
      function( card ){
        _this.$events.trigger('move', card);
      },
      function( card ){
        _this.$events.trigger('miss', card);
      }
    ));
  };
  SwipeCards.prototype.clear = function(){
    for (var i = this.cards.length - 1, o; i >= 0; i--) {
      this.cards[i].clear();
    }
    this.cards = [];
  };
  SwipeCards.prototype.getTopCard = function(){
    for (var i = this.cards.length - 1; i >= 0; i--) {
      if(!this.cards[i].isSwiped()){
        return this.cards[i];
      }
    }
    return false;
  };
  SwipeCards.prototype.getTrashCard = function(){
    for (var i = 0; i < this.cards.length; i++) {
      if(this.cards[i].isSwiped()){
        return this.cards[i];
      }
    }
    return false;
  };
  SwipeCards.prototype.isEmpty = function(){
    return this.getTopCard() === false;
  };
  SwipeCards.prototype.isFull = function(){
    return this.getTrashCard() === false;
  };
  SwipeCards.prototype.swipeRight = function(){
    var card = this.getTopCard();
    if(card){
      card.swipe(1, '0.2s');
    }
  };
  SwipeCards.prototype.swipeLeft = function(){
    var card = this.getTopCard();
    if(card){
      card.swipe(-1, '0.2s');
    }
  };
  SwipeCards.prototype.return = function(){
    var card = this.getTrashCard();
    if(card){
      card.return();
    }
  };
  SwipeCards.prototype.serialize = function( string ){
    var data = [];
    for (var i = this.cards.length - 1, o; i >= 0; i--) {
      o = this.cards[i].getElement().data() || {index:this.cards[i].getIndex()};
      o.v = this.cards[i].getDirection();
      data.push(o);
    }
    return string ? JSON.stringify(data) : data;
  };

  window.swipecards = SwipeCards;
    
})( jQuery, Hammer, Modernizr, window, document );  