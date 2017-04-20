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
  PostalShare.prototype.setURL = function( url ){
    this.url = url;
  };
  PostalShare.prototype.getURL = function(){
    return this.url;
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

  function PinPostal( endpoint, $element, class_has, class_share, postal_endpoint, postal_appid, postal_hashtag ){
    this.$element = $element;
    this.endpoint = endpoint;
    this.id = this.$element.data("id");
    this.class_has = class_has;
    this.data = false;
    this.postal = new PostalShare(postal_endpoint, postal_appid, postal_hashtag, '', this.id);
    var _this = this;
    this.postal.on("success error",function(){
      _this.hidePostal();
    });
    this.$element.find("." + class_share).click(function( event ){
      event.preventDefault();
      _this.postal.ui();
    });
  }
  PinPostal.prototype.getId = function(){
    return this.id;
  };
  PinPostal.prototype.getPostal = function(){
    return this.postal;
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
      this.postal.setURL(this.data[0].url);
      this.$element.find('img').attr("src",this.data[0].img);
      this.$element.addClass(this.class_has);
    } else {
      this.$element.removeClass(this.class_has);
    }
  };
  PinPostal.prototype.hidePostal = function() {
    this.$element.removeClass(this.class_has);
  };

  function PinsPostals( endpoint, $pins, class_has, class_share, postal_endpoint, postal_appid, postal_hashtag, events ){ 
    this.$pins = $pins;
    events = events || {};
    var pins = [], postal, _this = this;
    this.$pins.each(function(i,e){
      postal = new PinPostal( endpoint, $(e), class_has, class_share, postal_endpoint, postal_appid, postal_hashtag );
      pins.push( postal );
      _this._attachPostalEvents(postal, events);
    });
    this.pins = pins;
  }
  PinsPostals.prototype._attachPostalEvents = function( postal, events ){
    for(var event in events){
      postal.on(event,events[event]);
    }
  };
  PinsPostals.prototype.postalEvents = function( events ){
    for (var i = this.pins.length - 1, postal; i >= 0; i--) {
      postal = this.pins[i].getPostal();
      for(var event in events){
        postal.on(event,events[event]);
      }
    }
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
    return pin;
  };
  
  window.pinspostals = PinsPostals;
    
})( jQuery, window, document );  