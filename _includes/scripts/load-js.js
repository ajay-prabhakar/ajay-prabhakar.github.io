  
// Compress via uglify:
// uglifyjs load-js.js -c -m > load-js.min.js
!function(window, document) {
  'use strict';

  function addEvent(el, type, cb, opts) {
    if (el.addEventListener) el.addEventListener(type, cb, opts);
    else if (el.attachEvent) el.attachEvent('on' + type, cb);
    else el['on' + type] = cb;
  }

  window.loadJS = function(src, cb) {
    var script = document.createElement('script');
    script.src = src;
    if (cb) addEvent(script, 'load', cb, { once: true });
    var ref = document.scripts[0];
    ref.parentNode.insertBefore(script, ref);

    return script;
  };

  window._loaded = false;
  window.loadJSDeferred = function(src, cb) {
    var script = document.createElement('script');
    script.src = src;

    function insert() {
      window._loaded = true;
      if (cb) addEvent(script, 'load', cb, { once: true });
      var ref = document.scripts[0];
      ref.parentNode.insertBefore(script, ref);
    }

    if (window._loaded) insert();
    else addEvent(window, 'load', insert, { once: true });

    return script;
  };

  window.setRel = window.setRelStylesheet = function (id) {
    var link = document.getElementById(id);
    function set() { this.rel = 'stylesheet'; }
    addEvent(link, 'load', set, { once: true });
  };
}(window, document);
