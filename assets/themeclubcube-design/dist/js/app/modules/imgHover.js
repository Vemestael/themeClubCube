"use strict";appMakeBeCool.gateway.addClass("ImgHover",function(t,e,i,n){function o(){if(appMakeBeCool.gateway.base.Class.apply(s,[a]),!c.preloaded)return s.init();s.globals.customCreate=function(){l(),u(),g(),m()},s.create()}var s=this,a=e.extend({item:".page-item__inner"},t),c={item:null,preloaded:!1},l=function(){c.item=e(a.item)},u=function(){f()},g=function(){},f=function(){c.item.each(function(){var t,i;e(this).height()<e(this).find(".img-block img").height()?(i=-((t=e(this).find(".img-block img")).height()-e(this).height())+"px",t.css({bottom:i},2e3)):e(this).find(".img-block img").css({position:"static"})})},m=function(){s.globals.customResurrect=function(){},s.globals.customDestroy=function(){}};s.addMethod("init",function(){s.bind(i,s.globals.classType+"_Init",function(t,i,e){c.preloaded=!0,o()})}),o()});