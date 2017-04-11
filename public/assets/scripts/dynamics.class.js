;(function ( $, Timer, SwipeCards, ZoomPanel, window, document, undefined ) {

  var config = {
    qs_field:'preguntas',
    q_id_field:'id',
    q_value_field:'pregunta',
    as_field:'respuestas',
    a_id_field:'id',
    a_value_field:'option',
    servertime_field:'servertime',
    endtime_field:'endtime'
  };

  function Answer( data ){
    this.data = data || {};
    this.selected = false;
  }
  Answer.prototype._ = function( v ){
    return typeof v !== 'undefined' ? v : false;
  };
  Answer.prototype.getId = function(){
    return this._(this.data[config.a_id_field]);
  };
  Answer.prototype.getValue = function(){
    return this._(this.data[config.a_value_field]);
  };
  Answer.prototype.select = function(){
    this.selected = true;
  };
  Answer.prototype.isSelected = function(){
    return this.selected;
  };

  function Question( data ){
    this.data = data || {};
    this.answers = [];
    if(this.data[config.as_field]){
      for (var i = 0; i < this.data[config.as_field].length; i++) {
        this.answers.push(new Answer(this.data[config.as_field][i]));
      }
    }
    this.index = 0;
  }
  Question.prototype._ = function( v ){
    return typeof v !== 'undefined' ? v : false;
  };
  Question.prototype.getId = function(){
    return this._(this.data[config.q_id_field]);
  };
  Question.prototype.getValue = function(){
    return this._(this.data[config.q_value_field]);
  };
  Question.prototype.getAnswer = function( index ){
    return this._(this.answers[index]);
  };
  Question.prototype.getAnswerLength = function(){
    return this.answers.length;
  };
  Question.prototype.reset = function(){
    this.index = 0;
  };
  Question.prototype.nextAnswer = function(){
    return this.getAnswer( this.index++ );
  };
  Question.prototype.selectAnswer = function( value ){
    for (var i = 0; i < this.answers.length; i++) {
      if(this.answers[i].getValue() === value){
        this.answers[i].select();
      }
    }
  };
  Question.prototype.serialize = function(){
    var answers = [], o = {};
    for (var i = 0; i < this.answers.length; i++) {
      if(this.answers[i].isSelected()){
        answers.push(this.answers[i].getId());
      }
    }
    o[config.q_id_field] = this.getId();
    o[config.a_value_field] = answers.join(',');
    return o;
  };

  function DynamicData( data ){
    this.data = data || {};
    this.questions = [];
    if(this.data[config.qs_field]){
      for (var i = 0; i < this.data[config.qs_field].length; i++) {
        this.questions.push(new Question(this.data[config.qs_field][i]));
      }
    }
    this.index = 0;
  }
  DynamicData.prototype._ = function( v ){
    return typeof v !== 'undefined' ? v : false;
  };
  DynamicData.prototype.get = function(){
    return this.data;
  };
  DynamicData.prototype.getKey = function( key ){
    return this._(this.data[ key ]);
  };
  DynamicData.prototype.getQuestion = function( index ){
    return this._(this.questions[index]);
  };
  DynamicData.prototype.getQuestionLength = function(){
    return this.questions.length;
  };
  DynamicData.prototype.reset = function(){
    this.index = 0;
    for (var i = this.questions.length - 1; i >= 0; i--) {
      this.questions[i].reset();
    }
  };
  DynamicData.prototype.nextQuestion = function(){
    return this.getQuestion( this.index++ );
  };
  DynamicData.prototype.serialize = function(){
    var data = [];
    for (var i = 0; i < this.questions.length; i++) {
      data.push(this.questions[i].serialize());
    }
    return data;
  };

  function Dynamic( dynamics ){ 
    this.timer = new Timer();
    this.type = false;
    this.data = new DynamicData();
    this.dynamics = dynamics;
  }
  Dynamic.prototype.getType = function(){
    return this.type;
  };
  Dynamic.prototype.getTimer = function(){
    return this.timer;
  };
  Dynamic.prototype.getData = function(){
    return this.data;
  };
  Dynamic.prototype.setData = function( data ){
    this.data = new DynamicData(data);
  };
  Dynamic.prototype.start = function(){
    this.initialize();
    var endtime = this.data.getKey(config.endtime_field);
    if(endtime){
      this.timer.start(endtime, this.data.getKey(config.servertime_field));
    }
  };
  Dynamic.prototype.stop = function(){
    this.timer.stop();
  };
  Dynamic.prototype.save = function(){ 
    this.dynamics.request_save( {data:this.serialize()} ); 
  };
  Dynamic.prototype.stop_n_save = function(){
    this.stop();
    this.save();
  };
  Dynamic.prototype.serialize = function(){ 
    return this.data.serialize();
  };
  Dynamic.prototype.initialize = function(){};
  
  function Twinder( dynamics, $swipecards, $swipecards_item ) { 
    Dynamic.call(this, dynamics);
    var _this = this;
    this.type = "twinder";
    this.$swipecards = $swipecards;
    this.$swipecards_item = $swipecards_item.clone();
    this.swipecards = new SwipeCards(150);
    this.swipecards.on("empty",function( event ){
      _this.stop_n_save();
    });
    this.swipecards.on("swipe",function( event, card ){
      card.getElement().data('question').selectAnswer( card.getDirection() );
    });
  }
  Twinder.prototype = Object.create(Dynamic.prototype);
  Twinder.prototype.constructor = Twinder;
  Twinder.prototype.getSwipeCards = function(){
    return this.swipecards;
  };
  Twinder.prototype.initialize = function(){
    this.swipecards.clear();
    this.$swipecards.empty();
    this.data.reset();
    var prevent = function(event) { event.preventDefault(); }, question, $c;
    while( (question = this.data.nextQuestion()) ){
      $c = this.$swipecards_item.clone();
      $c.appendTo( this.$swipecards )
        .data('question', question)
        .find('img')
          .on('dragstart', prevent)
          .attr("src", question.getValue());
      this.swipecards.addCard($c);
    }
  };

  function Trivia( dynamics, $element, class_item, class_item_text, class_item_r, class_item_r_item, class_item_r_item_active ) { 
    Dynamic.call(this, dynamics);
    var _this = this;
    this.type = "trivia";
    
    this.class_item = class_item;
    this.class_item_text = class_item_text;
    this.class_item_r = class_item_r;
    this.class_item_r_item = class_item_r_item;
    this.class_item_r_item_active = class_item_r_item_active;

    this.$element = $element;
    this.$element_item = this.$element.find("." + class_item).clone();
    this.$element_item_r_item = this.$element_item.find("." + class_item_r_item).clone();
  }
  Trivia.prototype = Object.create(Dynamic.prototype);
  Trivia.prototype.constructor = Trivia;
  Trivia.prototype.in = function( $element_item, callback ){
    $element_item.fadeIn("fast", callback);
  };
  Trivia.prototype.out = function( $element_item, callback ){
    $element_item.delay(200).fadeOut('fast', callback);
  };
  Trivia.prototype.select = function( $v ){
    var _this = this, 
        $element_item = $v.parents("." + this.class_item);
    $v.data('answer').select();
    $v.addClass(this.class_item_r_item_active);
    this.out($element_item,function(){
      $element_item.remove();
      _this.next();
    });
  };
  Trivia.prototype.next = function(){
    $element_item = this.$element.find("." + this.class_item).eq(0);
    if($element_item.length){
      this.in($element_item);
    } else {
      this.stop_n_save();
    }
  };
  Trivia.prototype.initialize_question = function( $element_item, question ){
    $element_item.find("." + this.class_item_text).text(question.getValue());
  };
  Trivia.prototype.initialize = function(){
    this.$element.empty();
    this.data.reset();
    var click_answer = function(){ _this.select($(this)); }, _this = this, question, answer, $c, $r;
    while( (question = this.data.nextQuestion()) ){
      $c = this.$element_item.clone();
      this.$element.append($c);
      this.initialize_question($c,question);
      $r = $c.find("." + this.class_item_r);
      $r.empty();
      while( (answer = question.nextAnswer()) ){
        this.$element_item_r_item.clone()
          .appendTo($r)
          .data('answer', answer)
          .click( click_answer )
          .text( answer.getValue() );
      }      
    }
    this.next();
  };

  function Siluetas( dynamics, $element, class_item, class_item_image, class_item_r, class_item_r_item, class_item_r_item_active ) { 
    Trivia.call(this, dynamics, $element, class_item, '', class_item_r, class_item_r_item, class_item_r_item_active);
    this.class_item_image = class_item_image;
    this.type = "siluetas";
  }
  Siluetas.prototype = Object.create(Trivia.prototype);
  Siluetas.prototype.constructor = Siluetas;
  Siluetas.prototype.initialize_question = function( $element_item, question ){
    $element_item.data("question",question);
  };
  Siluetas.prototype.in = function( $element_item, callback ){
    $element_item.find("." + this.class_item_image + " img").attr("src",$element_item.data("question").getValue());
    $element_item.fadeIn("fast", callback);
  };
  
  function Finding( dynamics, $element, $button, class__image, class__lens, class__marks, class__marks__item ) { 
    Dynamic.call(this, dynamics);
    var _this = this;
    this.type = "finding";
    this.$element = $element;
    this.class__image = class__image;
    this.zoompanel = new ZoomPanel($element, class__image, class__lens, class__marks, class__marks__item);
    $button.click(function(){
      _this.stop_n_save();
    });
  }
  Finding.prototype = Object.create(Dynamic.prototype);
  Finding.prototype.constructor = Finding;
  Finding.prototype.getZoomPanel = function(){
    return this.zoompanel;
  };
  Finding.prototype.serialize = function(){ 
    return this.zoompanel.serialize(800,800);
  };
  Finding.prototype.initialize = function(){
    this.zoompanel.clear();
    this.data.reset();
    var question, $c;
    while( (question = this.data.nextQuestion()) ){
      this.zoompanel.setTotalMarks(question.getAnswerLength());
      this.$element.css('background-image','url('+ question.getValue() +')');
      this.$element.find("." + this.class__image).css('background-image','url('+ question.getValue() +')');
    }
  };

  function Dynamics( dynamic, start, save ){
    this.$events = $({});
    this.endpoints = {
      dynamic:dynamic,
      start:start,
      save:save
    };
    this.waiting = false;
    this.current_dynamic = false;
    
    this.twinder = false;
    this.trivia = false;
    this.siluetas = false;
    this.finding = false;
  }
  Dynamics.prototype.on = function( event, fn ){
    this.$events.on(event, fn);
  };
  Dynamics.prototype.one = function( event, fn ){
    this.$events.one(event, fn);
  };
  Dynamics.prototype.off = function( event ){
    this.$events.off(event);
  };
  Dynamics.prototype.getCurrent = function(){
    return this.current_dynamic;
  };
  Dynamics.prototype._request = function( endpoint, data ){
    if(!this.waiting){
      if(typeof this.endpoints[endpoint] !== 'undefined'){
        data = data || {};
        var _this = this;
        this.waiting = true;
        this.$events.trigger("request.start");
        $.post(this.endpoints[endpoint], data, function( json ) {
          _this.waiting = false;
          _this.$events.trigger("request.end");
          if(json.status === 'success'){
            _this._success(json.data, endpoint);
          } else {
            _this._error(json.message, endpoint);
          }
        }, "json")
          .fail(function() {
            _this.waiting = false;
            _this.$events.trigger("request.end");
            _this._error('Ocurrió un error. Inténtelo de nuevo más tarde.', endpoint);
          })
          .always(function() {
            _this.waiting = false;
          });
      }
    }
  };
  Dynamics.prototype._error = function( message, endpoint ){
    this.$events.trigger("error", [message, endpoint]);
    this.$events.trigger(endpoint + ".error", [message]);
  };
  Dynamics.prototype._success = function( data, endpoint ){
    switch(endpoint){
      case 'dynamic':
        this.current_dynamic = false;
        if(data.type === "twinder" || data.type === "trivia" || data.type === "siluetas" || data.type === "finding"){
          this.current_dynamic = this[data.type];
        }
        this._trigger_(endpoint);
      break;
      case 'start':
        if(this.current_dynamic){
          this.current_dynamic.setData( data );
          this.current_dynamic.start();
          this._trigger_(endpoint);
        }
      break;
      case 'save':
        this._trigger_(endpoint, data);
        this.current_dynamic = false;
      break;
    }
  };
  Dynamics.prototype.request_dynamic = function( data ){
    if(this.current_dynamic){
      this._trigger_("dynamic");
    } else {
      this._request('dynamic',data);
    }
  };
  Dynamics.prototype.request_start = function(){
    if(this.current_dynamic){
      this._request('start');
    }
  };
  Dynamics.prototype.request_save = function( data ){
    if(this.current_dynamic){
      this._request('save',data);
    }
  };
  Dynamics.prototype._trigger_ = function( event_type, data ){
    if(this.current_dynamic){
      this.$events.trigger(event_type, [this.current_dynamic, data]);
      this.$events.trigger(event_type + "." + this.current_dynamic.getType(), [this.current_dynamic, data]);
    }
  };
  Dynamics.prototype.initTwinder = function( $swipecards, $swipecards_item ){
    this.twinder = new Twinder( this, $swipecards, $swipecards_item );
    return this.twinder;
  };
  Dynamics.prototype.initTrivia = function( $element, class_item, class_item_text, class_item_r, class_item_r_item, class_item_r_item_active ){
    this.trivia = new Trivia( this, $element, class_item, class_item_text, class_item_r, class_item_r_item, class_item_r_item_active );
    return this.trivia;
  };
  Dynamics.prototype.initSiluetas = function( $element, class_item, class_item_image, class_item_r, class_item_r_item, class_item_r_item_active ){
    this.siluetas = new Siluetas( this, $element, class_item, class_item_image, class_item_r, class_item_r_item, class_item_r_item_active );
    return this.siluetas;
  };
  Dynamics.prototype.initFinding = function( $element, $button, class__image, class__lens, class__marks, class__marks__item ){
    this.finding = new Finding( this, $element, $button, class__image, class__lens, class__marks, class__marks__item );
    return this.finding;
  };

  window.dynamics = Dynamics;
    
})( jQuery, window.timer, window.swipecards, window.zoompanel, window, document );