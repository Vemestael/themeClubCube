"use strict";appMakeBeCool.gateway.addClass("Sliders",function(e,s,l,i){function t(){if(appMakeBeCool.gateway.base.Class.apply(n,[r]),!a.preloaded)return n.init();n.globals.customCreate=function(){d(),c(),u(),w()},n.create()}var n=this,o={slGallery:s("#sliderGallery"),slPartners:s("#sliderPartners"),slAdvert:s("#sliderMain")},r=s.extend(o,e),a={slGallery:null,slPartners:null,slAdvert:null,preloaded:!1},d=function(){a.slGallery=s(r.slGallery),a.slPartners=s(r.slPartners),a.slAdvert=s(r.slAdvert)},c=function(){f(),g(),b(),y()},u=function(){p().setBgGlrChange()},p=function(){return{setBgGlrChange:function(){n.bind(a.slGallery,"click",function(){return y(),!1})}}},f=function(){a.slGallery.slick({accessibility:!1,dots:!1,infinite:!1,speed:330,rows:2,centerPadding:30,slidesToShow:4,slidesToScroll:4,responsive:[{breakpoint:1024,settings:{slidesToShow:3,slidesToScroll:2}},{breakpoint:992,settings:{slidesToShow:2,slidesToScroll:2}},{breakpoint:480,settings:{slidesToShow:1,slidesToScroll:1}}]})},g=function(){a.slPartners.slick({accessibility:!1,dots:!1,infinite:!1,speed:900,centerPadding:30,slidesToShow:6,slidesToScroll:3,responsive:[{breakpoint:1024,settings:{slidesToShow:4,slidesToScroll:2}},{breakpoint:768,settings:{slidesToShow:3,slidesToScroll:2}},{breakpoint:480,settings:{slidesToShow:2,slidesToScroll:2}}]})},b=function(){a.slAdvert.slick({accessibility:!1,dots:!1,infinite:!0,speed:500,swipe:!1,appendArrows:s(".main-slide__btn-item"),fade:!0,cssEase:"linear",autoplay:!0,autoplaySpeed:5e3,responsive:[{breakpoint:1200,settings:{swipe:!0}}]})},y=function(){var e;1280<l.width()&&(e=s(".b-gallery .slick-current .b-box__img-wrap").attr("style"),s(".b-gallery__img-wrap").attr("style",function(){return s(this).addClass("active"),e}),setTimeout(function(){s(".b-gallery__img-wrap").removeClass("active")},1e3))},w=function(){n.globals.customResurrect=function(){},n.globals.customDestroy=function(){}};n.addMethod("init",function(){n.bind(l,n.globals.classType+"_Init",function(e,s,l){a.preloaded=!0,t()})}),t()});