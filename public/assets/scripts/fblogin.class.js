;(function ( $, window, document, undefined ) {

    function FBLogin( endpoint, appId, scope ){
        this.test_api_attempts_speed = 50;
        this.test_api_attempts_max = 1000;
        this.test_api_attempts = 0;
        this.endpoint = endpoint;
        if(typeof scope === "string" && scope.indexOf("email") < 0){
            scope += (scope.length === 0?"":",") + "email";
        }
        if(typeof scope === "string" && scope.indexOf("public_profile") < 0){
            scope += (scope.length === 0?"":",") + "public_profile";
        }
        this.scope = scope || "email,public_profile";
        this.$events = $({});
        this.email = false;
        this.accessToken = false;
        window.requiereFB(appId);
    }
    FBLogin.prototype.on = function( event, fn ){
        this.$events.on(event, fn);
    };
    FBLogin.prototype.off = function( event ){
        this.$events.off(event);
    };
    FBLogin.prototype.hasEmail = function(){
        return typeof this.email === "string" && this.email.length > 0;
    };
    FBLogin.prototype.post = function(){
        if(this.hasEmail()){
            var _this = this;
            $.post(this.endpoint, {accessToken: this.accessToken}, function( json ) {
                if (json && json.status === 'success') {
                    _this.$events.trigger("fblogin.done", json);
                } else {
                    _this.$events.trigger("fblogin.error", json);
                }
            }, "json")
            .fail(function( jqXHR, textStatus, errorThrown ) {
                _this.$events.trigger("fblogin.error", errorThrown);
            });
        }
    };
    FBLogin.prototype.isFBReady = function(){ 
        return typeof window.FB === "object" && typeof window.FB.login === "function" && window.fbAsyncInit.hasRun;
    };
    FBLogin.prototype.getFB = function(){ return window.FB; };
    FBLogin.prototype.testFB = function( success ){
        if(typeof success === "function"){
            this.test_api_attempts = 0;
            var _this = this, _f = function(){
                if(_this.isFBReady()){
                    success();
                } else {
                    if(_this.test_api_attempts < _this.test_api_attempts_max){
                        _this.test_api_attempts++;
                        setTimeout(_f,_this.test_api_attempts_speed);  
                    }
                }
            };
            _f();
        }
    };
    FBLogin.prototype.connect = function(){
        if(this.hasEmail()){ 
            this.post(); 
        } else {
            var _this = this, FB = this.getFB();
            this.testFB(function(){
                var params = {scope: _this.scope};
                if(_this.email !== false){
                    params.auth_type = 'rerequest';
                }
                FB.login(function (response) {
                    if (response.authResponse) {
                        _this.accessToken = response.authResponse.accessToken;
                        FB.api('/me/?fields=email', function( response ) {
                            if (response && !response.error) {
                                _this.email = response.email;
                                if(_this.hasEmail()){
                                    _this.post();
                                } else {
                                    _this.$events.trigger("fblogin.error", "Debes aceptar el permiso para consultar tu email.");
                                }
                            }
                            else{
                                _this.$events.trigger("fblogin.error", response.error);
                            }
                        });
                    } else {
                        _this.$events.trigger("fblogin.error", "Debes aceptar los permisos para poder ingresar.");
                    }
                }, params);
            });
        }
    };
    
    window.FBRequired = false;
    window.requiereFB = function( appId ){
        if(appId && !window.FBRequired){
            window.FBRequired = true;
            if(!window.fbAsyncInit){
                window.fbAsyncInit = function() {
                    FB.init({
                        appId      : appId,
                        xfbml      : true,
                        version    : 'v2.8'
                    });
                };
            }
            if(typeof window.FB === "object"){
                if(!window.fbAsyncInit.hasRun){
                    window.fbAsyncInit.hasRun = true;
                    window.fbAsyncInit();
                }
            } else {
                (function(d, s, id){
                   var js, fjs = d.getElementsByTagName(s)[0];
                   if (d.getElementById(id)) {return;}
                   js = d.createElement(s); js.id = id;
                   js.src = "//connect.facebook.net/en_US/sdk.js";
                   fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
            }
        }
    };
    
    window.fblogin = FBLogin;
    
})( jQuery, window, document );