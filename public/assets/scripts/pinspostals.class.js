;(function ( $, window, document, undefined ) {

  function PostalShare( endpoint, appid, hashtag, url, id ){ 
    this.$events = $({});
    this.endpoint = endpoint;
    this.appid = appid;
    this.hashtag = hashtag;
    this.url = url;
    this.id = id;
  }
  PostalShare.prototype.on = function( event, fn ){
    this.$events.on(event, fn);
  };
  PostalShare.prototype.one = function( event, fn ){
    this.$events.one(event, fn);
  };
  PostalShare.prototype.off = function( event ){
    this.$events.off(event);
  };
  PostalShare.prototype.ui = function(){
    var _this = this;
    if(window.FB){
      window.FB.ui({
        app_id: this.appid,
        method: 'share',
        href: this.url,
        hashtag: this.hashtag,
      }, function(response){
        _this.$events.trigger("request.start");
        $.post(_this.endpoint, {data:{post_id:response?response.post_id:undefined,postal_id:_this.id}}, function( json ) {
          _this.$events.trigger("request.end");
          if(json.status === 'success'){
            _this.$events.trigger("success",json.data);
          } else {
            _this.$events.trigger("error",json.message);
          }
        }, "json");
      });
    }
  };

  window.postalshare = PostalShare;

  function PinPostal( endpoint, $element, class_has ){
    this.$element = $element;
    this.endpoint = endpoint;
    this.id = this.$element.data("id");
    this.class_has = class_has;
    this.data = false;
  }
  PinPostal.prototype.getId = function(){
    return this.id;
  };
  PinPostal.prototype.start = function() {
    if(this.data === false){
      var _this = this;
      $.post(this.endpoint, {data:{id:this.id}}, function( json ) {
        if(json.status === 'success'){
          _this._success(json.data);
        }
      }, "json"); 
    }
  };
  PinPostal.prototype._success = function( data ) {
    if(data.length){
      this.data = [];
      for (var i = 0; i < data.length; i++) {
        this.data.push({
          'url': '/postales/' + data[i].name,
          'img': data[i].url
        });
      }
      this.setPostal();
    }
  };
  PinPostal.prototype.setPostal = function() {
    if(this.data.length){
      this.$element.find('a').attr("href",this.data[0].url);
      this.$element.find('img').attr("src",this.data[0].img);
      this.$element.addClass(this.class_has);
    } else {
      this.$element.removeClass(this.class_has);
    }
  };

  function PinsPostals( endpoint, $pins, class_has ){ 
    this.$events = $({});
    this.$pins = $pins;
    this.pins = [];
    var _this = this;
    this.$pins.each(function(i,e){
      var pin = new PinPostal( endpoint, $(e), class_has );
      _this.pins.push( pin );
    });
  }
  PinsPostals.prototype.on = function( event, fn ){
    this.$events.on(event, fn);
  };
  PinsPostals.prototype.one = function( event, fn ){
    this.$events.one(event, fn);
  };
  PinsPostals.prototype.off = function( event ){
    this.$events.off(event);
  };
  PinsPostals.prototype.getPin = function( id ){
    for (var i = this.pins.length - 1; i >= 0; i--) {
      if(this.pins[i].getId() === id){
        return this.pins[i];
      }
    }
    return false;
  };
  PinsPostals.prototype.start = function( id ){
    var pin = this.getPin(id);
    if(pin){
      pin.start();
    }
  };
  
  window.pinspostals = PinsPostals;
    
})( jQuery, window, document );  