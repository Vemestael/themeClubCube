"use strict";
appMakeBeCool.gateway.addClass('TicketCalc', function (properties, $, $window, $document) {
  var _ticketCalc = this,
    _defaults = {
      wrapper: 'body, html',
      anchorBtn: 'button.reserve',
      anchor: '#reserve',
      selectSum: '.select-sum',
      output: '.priceOutput'
    },
    _properties = $.extend(_defaults, properties),
    _globals = {
      wrapper: null,
      anchorBtn: null,
      anchor: null,
      selectSum: null,
      output: null,
      preloaded: false
    },

    _init = function () {
      appMakeBeCool.gateway.base.Class.apply(_ticketCalc, [_properties]);
      if (!_globals.preloaded) {
        return _ticketCalc.init();
      }
      _ticketCalc.globals.customCreate = function () {
        _config();
        _setup();
        _setBinds();
        _setCustomMethods();
      }
      _ticketCalc.create();
    },

    _config = function () {
      _globals.wrapper = $(_properties.wrapper);
      _globals.anchorBtn = $(_properties.anchorBtn);
      _globals.anchor = $(_properties.anchor);
      _globals.selectSum = $(_properties.selectSum);
      _globals.output = $(_properties.output);
    },

    _setup = function () {

      _globals.selectSum.on('change', function() {
        this.dataset.sum = this.dataset.price * this.value;
        var sum = 0;
        _globals.selectSum.each(function() {
          sum += parseInt( this.dataset.sum);
        });
        _globals.output.val( sum + ' €');
      })

      _globals.anchorBtn.on('click', function() {
        _globals.wrapper.animate({
          scrollTop: _globals.anchor.offset().top
        }, 500);
      })
      
    },

    _setBinds = function () {

    },

    _binds = function () {
      return {

      }
    },

    _triggers = function () {
      return {

      }
    },

    _setCustomMethods = function () {
      _ticketCalc.globals.customResurrect = function () {}
      _ticketCalc.globals.customDestroy = function () {}
    }

  _ticketCalc.addMethod('init', function () {
    _ticketCalc.bind($window, _ticketCalc.globals.classType + '_Init', function (e, data, el) {
      _globals.preloaded = true;
      _init();
    });
  });
  
  _init();
});