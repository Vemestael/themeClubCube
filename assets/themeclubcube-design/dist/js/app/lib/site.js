"use strict";var appMakeBeCool=void 0===appMakeBeCool?{}:console.log("Namespace appMakeBeCool is taken");appMakeBeCool.Site=function(a,t,e,s){var l=a(t),r=a(e),i=(a("html, body"),{properties:{},globals:{siteConfigured:!1,siteMode:null,winWidth:0},utils:{},classes:{},classInstances:[],events:{},init:function(e){var t=a.extend({onComplete:function(){}},e);i.config(),i.extendClasses(),i.instantiateClasses(),i.setup(),i.setEventBinds(),i.globals.siteConfigured=!0,l.trigger("siteConfigComplete"),t.onComplete(),l.trigger("siteInitComplete",{options:t})},setSiteMode:function(){i.globals.siteMode="ThemeMode"},config:function(){i.globals.winWidth=l.width(),t.requestAnimationFrame||(t.requestAnimationFrame=t.webkitRequestAnimationFrame||t.mozRequestAnimationFrame||t.oRequestAnimationFrame||t.msRequestAnimationFrame||function(e){return t.setTimeout(e,1e3/60)})},setup:function(){},setEventBinds:function(){},eventBinds:function(){return{}},extendClasses:function(){i.utils.extend(c.classes.SiteMode,c.base.Class)},instantiateClasses:function(){c.createClassInstances(i.getSiteMode())},createClassInstance:function(e,t,s,n){if(n&&i.utils.extend(t,n),"string"!=typeof e)return console.log("Error: _site.createClassInstance() expects a string for instanceName");if("function"!=typeof t)return console.log("Error: _site.createClassInstance() expects a function for classObject");var o=s||{};return c.classInstances[e]=new t(o,a,l,r),c.classInstances[e]},getSiteObj:function(){return c},getSiteMode:function(){var e=[];return e.push({classObject:i.globals.siteMode,classExtends:"SiteMode"}),e}});i.utils={extend:function(e,t){function s(){}s.prototype=t.prototype,e.prototype=new s,(e.prototype.constructor=e).superclass=t.prototype,t.prototype.constructor==Object.prototype.constructor&&(t.prototype.constructor=t)},arrayShiftTo:function(e,t,s){if("object"!=typeof e)return console.log("Error: array provided is not of type object");if("number"!=typeof t||t<0||t>=e.length)return console.log("error: index provided is not valid");if("number"!=typeof s||s<0||s>=e.length)return console.log("error: targetIndex provided is not valid");var n=e[t];return e.splice(t,1),e.splice(s,0,n),e},mergeOptions:function(e,t){var s={};for(var n in e)s[n]=e[n];for(var n in t)s[n]=t[n];return s}};var c=this;a.extend(c,{classes:{},modules:{},base:{},classInstances:{}}),c.init=function(){a.fn.findAndSelf||(a.fn.findAndSelf=function(e){return this.find(e).andSelf().filter(e)}),i.setSiteMode(),i.init()},c.addClass=function(e,t){c.classes[e]=t},c.createClassInstance=function(e,t,s,n){return i.createClassInstance(e,t,s,n)},c.createClassInstances=function(e){0<e.length&&a.each(e,function(){var e=a.extend({instanceName:this.classObject,classObject:this.classObject,classProperties:{classId:this.classObject},classExtends:c.base.Class},this);"string"==typeof e.classObject&&(e.classObject=c.classes[e.classObject]),"string"==typeof e.classExtends&&(e.classExtends=c.classes[e.classExtends]),i.createClassInstance(e.instanceName,e.classObject,e.classProperties,e.classExtends)})},c.utils={extend:function(e,t){i.utils.extend(e,t)},arrayShiftTo:function(e,t,s){return i.utils.arrayShiftTo(e,t,s)},mergeOptions:function(e,t){return i.utils.mergeOptions(e,t)}},c.getGlobals=function(){return i.globals},c.getClassInstance=function(e){return c.classInstances[e]},c.base.Class=function(e){var t=this,s={VAR_1:null,VAR_2:null};t.properties=a.extend({sourceEl:null,classId:null,classType:null,msg:"This is the default base message",debugMode:!1,eventsLog:{binds:[],triggers:[]},classDependents:[],triggerSrc:null,instanceName:"",autoCallCreateComplete:!0,instanceIdAttr:"data-mbc-instance-id",onCreateComplete:function(){},onLoadComplete:function(){},onDestroyComplete:function(){}},e),t.globals={classId:"",alive:!1,instantiated:!1,setupComplete:!1,createComplete:!1,loadComplete:!1,classDependentsInstantiated:!1,classDependentsInstances:[],classType:"",timeouts:[],intervals:[],customCreate:function(){},customCreateComplete:function(){},customDestroy:function(){},customDestroyComplete:function(){},customResurrect:function(){},customLoadComplete:function(){}};var n=function(){t.globals.classType=t.properties.classType||t.properties.classId,t.properties.sourceEl=a(t.properties.sourceEl),t.globals.classId=t.properties.classId||instance};t.getConstants=function(){return s},n()},c.base.Class.prototype={addMethod:function(e,t){if(!e||"function"!=typeof t)return this.logError("addMethod() parameters passed in are invalid");this[e]||(this[e]=t)},create:function(e){var t=this,s=a.extend({createStart:function(){},createComplete:function(){}},e);return t.globals.alive?(t.log(t),t.logWarning("Class.create cannot create class, it is already created.")):(t.globals.alive=!0,t.createStart(s.createStart),t.createClassDependents(),0<t.properties.sourceEl.length&&t.properties.sourceEl.attr(t.properties.instanceIdAttr,t.globals.classId),"function"!=typeof t.globals.customCreate||t.globals.instantiated?"function"==typeof t.globals.customResurrect&&t.globals.instantiated&&t.globals.customResurrect():t.globals.customCreate(),(t.globals.setupComplete=!0)===t.properties.autoCallCreateComplete&&t.createComplete(s.createComplete),!0)},destroy:function(e){var t=this,s=a.extend({destroyStart:function(){},destroyComplete:function(){}},e);return t.globals.alive?(t.destroyStart(function(){t.destroyClassDependents(),"function"==typeof t.globals.customDestroy&&t.globals.customDestroy(),t.globals.alive=!1,t.destroyComplete(s.destroyComplete)}),t.clearAllTimeouts(),t.clearAllIntervals(),!0):t.logWarning("Class.destroy cannot destroy class, it has not been created.")},createClassDependents:function(){var t=this;return t.globals.classDependentsInstantiated?(a.each(t.globals.classDependentsInstances,function(e){this.create()}),!0):!(t.properties.classDependents.length<1)&&(a.each(t.properties.classDependents,function(){i.utils.extend(this.obj,c.base.Class);var e=a.extend({onCreateComplete:function(){setTimeout(function(){t.globals.createComplete||t.createComplete()},1)}},this.properties);t.globals.classDependentsInstances.push(new this.obj(e))}),t.globals.classDependentsInstantiated=!0)},destroyClassDependents:function(){return!(this.globals.classDependentsInstances.length<1)&&(a.each(this.globals.classDependentsInstances,function(){this.destroy()}),!0)},classDependentsStatus:function(){var t=this;if(0===t.properties.classDependents.length)return!0;var s={setupComplete:!0,loadComplete:!0};return a.each(t.properties.classDependents,function(e){t.globals.classDependentsInstances[e].globals.setupComplete||(s=a.extend(s,{setupComplete:!1})),t.globals.classDependentsInstances[e].globals.loadComplete||(s=a.extend(s,{loadComplete:!1}))}),s},getInstanceName:function(){return!!this.properties.instanceName&&this.properties.instanceName},createStart:function(e){"function"==typeof e&&e()},createComplete:function(e){var t=this;if(t.globals.createComplete)return!1;if(0<t.globals.classDependentsInstances.length&&t.loadCompleteChecker(),0<t.globals.classDependentsInstances.length&&!t.classDependentsStatus().setupComplete)return!1;function s(){"function"==typeof e&&e(),t.properties.onCreateComplete(),t.globals.customCreateComplete(),t.globals.createComplete=!0,t.globals.instantiated=!0,l.trigger("classCreateComplete",{classId:t.properties.classId,classType:t.globals.classType}),t.isLoaded()&&(t.globals.loadComplete=!0)}return s(),!0},loadComplete:function(e){var t=this;"function"==typeof e&&e(),t.properties.onLoadComplete(),t.globals.customLoadComplete(),t.globals.loadComplete=!0},destroyStart:function(e){this.trigger("classDestroyStart",{classId:this.properties.classId,classType:this.globals.classType}),"function"==typeof e&&e()},destroyComplete:function(e){var t=this;"function"==typeof e&&("function"==typeof e&&e(),t.properties.onDestroyComplete(),t.globals.customDestroyComplete(),t.globals.createComplete=!1,t.trigger("classDestroyComplete",{classId:t.properties.classId,classType:t.globals.classType}))},isLoaded:function(){return!!this.globals.createComplete&&(this.globals.classDependentsInstances<1||!!this.classDependentsStatus().loadComplete)},loadCompleteChecker:function(){var e=this,t=e,s=t.setInterval(function(){t.isLoaded()&&(t.clearInterval(s),t.loadComplete())},60)},log:function(e,t){this.properties.debugMode&&("object"==typeof e&&(t=e,e=""),"object"!=typeof t&&(t=""),"object"==typeof console&&"function"==typeof console.log&&console.log(this.globals.classId+": "+e,t))},logError:function(e,t){this.log("Error - "+e,t)},logWarning:function(e,t){this.log("Warning - "+e,t)},logNotice:function(e,t){this.log("Notice - "+e,t)},setInterval:function(e,t){if("function"!=typeof e)return this.logError("setInterval() fn provided is not a function");var s=setInterval(e,t);return this.globals.intervals.push(s),s},clearInterval:function(e){clearInterval(e)},clearAllIntervals:function(){var e=this;return 0!==e.globals.intervals.length&&(a.each(e.globals.intervals,function(){e.clearInterval(this)}),e.globals.intervals=[],!0)},setTimeout:function(e,t){if("function"!=typeof e)return this.logError("setTimeout() fn provided is not a function");var s=setTimeout(e,t);return this.globals.timeouts.push(s),s},clearTimeout:function(e){clearTimeout(e)},clearAllTimeouts:function(){var e=this;return 0!==e.globals.timeouts.length&&(a.each(e.globals.timeouts,function(){e.clearTimeout(this)}),e.globals.timeouts=[],!0)},on:function(e,s,n){var o=this;o.properties.debugMode&&console.log("SET LIVE - class:"+o.globals.classId+", event:"+s),r.on(e,s,function(e,t){o.properties.debugMode&&"scroll"!=s&&console.log("LIVE - class:"+o.globals.classId+", event:"+s),"function"==typeof n&&n(e,t,this)})},bind:function(e,s,n){var o=this;o.properties.debugMode&&console.log("SET BIND - class:"+o.globals.classId+", event:"+s),e.bind(s,function(e,t){o.properties.debugMode&&"scroll"!=s&&console.log("BIND - class:"+o.globals.classId+", event:"+s),"function"==typeof n&&n(e,t,this)})},unbind:function(e,t){var s=this;s.properties.debugMode&&console.log("UNBIND - class:"+s.globals.classId+", event:"+t),e.unbind(t,function(e){s.properties.debugMode&&console.log("UNBIND - class:"+s.globals.classId+", event:"+t)})},trigger:function(e,t){var s=t||{};return this.properties.debugMode&&"scroll"!=event&&console.log("TRIGGER - class:"+this.globals.classId+", event:"+e),l.trigger(e,s),!0},makeTemplate:function(e,t){for(var s,n,o,a=/(?:\{{2})([\w\[\]\.]+)(?:\}{2})/,l=e;a.test(l);)s=l.match(a)[1],n=null!=(o=this.getObjectProperty(t,s))?o:"",l=l.replace(a,""+n);return l},getObjectProperty:function(e,t){for(var s,n=(t=t.replace(/\[(\w+)\]/g,".$1")).split(".");n.length;){if(s=n.shift(),!(null!=e&&s in e))return null;e=e[s]}return e}}},appMakeBeCool.gateway=new appMakeBeCool.Site(jQuery,window,window.document),appMakeBeCool.gateway||(appMakeBeCool.gateway=new appMakeBeCool.Site);