!function(e){"object"==typeof exports&&"undefined"!=typeof module?module.exports=e():"function"==typeof define&&define.amd?define([],e):("undefined"!=typeof window?window:"undefined"!=typeof global?global:"undefined"!=typeof self?self:this).flexibility=e()}(function(){return function o(f,i,s){function a(r,e){if(!i[r]){if(!f[r]){var t="function"==typeof require&&require;if(!e&&t)return t(r,!0);if(c)return c(r,!0);var l=new Error("Cannot find module '"+r+"'");throw l.code="MODULE_NOT_FOUND",l}var n=i[r]={exports:{}};f[r][0].call(n.exports,function(e){var t=f[r][1][e];return a(t||e)},n,n.exports,o,f,i,s)}return i[r].exports}for(var c="function"==typeof require&&require,e=0;e<s.length;e++)a(s[e]);return a}({1:[function(e,t,r){t.exports=function(e){var t,r,l,n=-1;if(1<e.lines.length&&"flex-start"===e.style.alignContent)for(t=0;l=e.lines[++n];)l.crossStart=t,t+=l.cross;else if(1<e.lines.length&&"flex-end"===e.style.alignContent)for(t=e.flexStyle.crossSpace;l=e.lines[++n];)l.crossStart=t,t+=l.cross;else if(1<e.lines.length&&"center"===e.style.alignContent)for(t=e.flexStyle.crossSpace/2;l=e.lines[++n];)l.crossStart=t,t+=l.cross;else if(1<e.lines.length&&"space-between"===e.style.alignContent)for(r=e.flexStyle.crossSpace/(e.lines.length-1),t=0;l=e.lines[++n];)l.crossStart=t,t+=l.cross+r;else if(1<e.lines.length&&"space-around"===e.style.alignContent)for(t=(r=2*e.flexStyle.crossSpace/(2*e.lines.length))/2;l=e.lines[++n];)l.crossStart=t,t+=l.cross+r;else for(r=e.flexStyle.crossSpace/e.lines.length,t=e.flexStyle.crossInnerBefore;l=e.lines[++n];)l.crossStart=t,l.cross+=r,t+=l.cross}},{}],2:[function(e,t,r){t.exports=function(e){for(var t,r=-1;line=e.lines[++r];)for(t=-1;child=line.children[++t];){var l=child.style.alignSelf;"auto"===l&&(l=e.style.alignItems),"flex-start"===l?child.flexStyle.crossStart=line.crossStart:"flex-end"===l?child.flexStyle.crossStart=line.crossStart+line.cross-child.flexStyle.crossOuter:"center"===l?child.flexStyle.crossStart=line.crossStart+(line.cross-child.flexStyle.crossOuter)/2:(child.flexStyle.crossStart=line.crossStart,child.flexStyle.crossOuter=line.cross,child.flexStyle.cross=child.flexStyle.crossOuter-child.flexStyle.crossBefore-child.flexStyle.crossAfter)}}},{}],3:[function(e,t,r){t.exports=function(e,t){var r="row"===t||"row-reverse"===t,l=e.mainAxis;l?r&&"inline"===l||!r&&"block"===l||(e.flexStyle={main:e.flexStyle.cross,cross:e.flexStyle.main,mainOffset:e.flexStyle.crossOffset,crossOffset:e.flexStyle.mainOffset,mainBefore:e.flexStyle.crossBefore,mainAfter:e.flexStyle.crossAfter,crossBefore:e.flexStyle.mainBefore,crossAfter:e.flexStyle.mainAfter,mainInnerBefore:e.flexStyle.crossInnerBefore,mainInnerAfter:e.flexStyle.crossInnerAfter,crossInnerBefore:e.flexStyle.mainInnerBefore,crossInnerAfter:e.flexStyle.mainInnerAfter,mainBorderBefore:e.flexStyle.crossBorderBefore,mainBorderAfter:e.flexStyle.crossBorderAfter,crossBorderBefore:e.flexStyle.mainBorderBefore,crossBorderAfter:e.flexStyle.mainBorderAfter}):(e.flexStyle=r?{main:e.style.width,cross:e.style.height,mainOffset:e.style.offsetWidth,crossOffset:e.style.offsetHeight,mainBefore:e.style.marginLeft,mainAfter:e.style.marginRight,crossBefore:e.style.marginTop,crossAfter:e.style.marginBottom,mainInnerBefore:e.style.paddingLeft,mainInnerAfter:e.style.paddingRight,crossInnerBefore:e.style.paddingTop,crossInnerAfter:e.style.paddingBottom,mainBorderBefore:e.style.borderLeftWidth,mainBorderAfter:e.style.borderRightWidth,crossBorderBefore:e.style.borderTopWidth,crossBorderAfter:e.style.borderBottomWidth}:{main:e.style.height,cross:e.style.width,mainOffset:e.style.offsetHeight,crossOffset:e.style.offsetWidth,mainBefore:e.style.marginTop,mainAfter:e.style.marginBottom,crossBefore:e.style.marginLeft,crossAfter:e.style.marginRight,mainInnerBefore:e.style.paddingTop,mainInnerAfter:e.style.paddingBottom,crossInnerBefore:e.style.paddingLeft,crossInnerAfter:e.style.paddingRight,mainBorderBefore:e.style.borderTopWidth,mainBorderAfter:e.style.borderBottomWidth,crossBorderBefore:e.style.borderLeftWidth,crossBorderAfter:e.style.borderRightWidth},"content-box"===e.style.boxSizing&&("number"==typeof e.flexStyle.main&&(e.flexStyle.main+=e.flexStyle.mainInnerBefore+e.flexStyle.mainInnerAfter+e.flexStyle.mainBorderBefore+e.flexStyle.mainBorderAfter),"number"==typeof e.flexStyle.cross&&(e.flexStyle.cross+=e.flexStyle.crossInnerBefore+e.flexStyle.crossInnerAfter+e.flexStyle.crossBorderBefore+e.flexStyle.crossBorderAfter))),e.mainAxis=r?"inline":"block",e.crossAxis=r?"block":"inline","number"==typeof e.style.flexBasis&&(e.flexStyle.main=e.style.flexBasis+e.flexStyle.mainInnerBefore+e.flexStyle.mainInnerAfter+e.flexStyle.mainBorderBefore+e.flexStyle.mainBorderAfter),e.flexStyle.mainOuter=e.flexStyle.main,e.flexStyle.crossOuter=e.flexStyle.cross,"auto"===e.flexStyle.mainOuter&&(e.flexStyle.mainOuter=e.flexStyle.mainOffset),"auto"===e.flexStyle.crossOuter&&(e.flexStyle.crossOuter=e.flexStyle.crossOffset),"number"==typeof e.flexStyle.mainBefore&&(e.flexStyle.mainOuter+=e.flexStyle.mainBefore),"number"==typeof e.flexStyle.mainAfter&&(e.flexStyle.mainOuter+=e.flexStyle.mainAfter),"number"==typeof e.flexStyle.crossBefore&&(e.flexStyle.crossOuter+=e.flexStyle.crossBefore),"number"==typeof e.flexStyle.crossAfter&&(e.flexStyle.crossOuter+=e.flexStyle.crossAfter)}},{}],4:[function(e,t,r){var n=e("../reduce");t.exports=function(r){var l;0<r.mainSpace&&(0<(l=n(r.children,function(e,t){return e+parseFloat(t.style.flexGrow)},0))&&(r.main=n(r.children,function(e,t){return"auto"===t.flexStyle.main?t.flexStyle.main=t.flexStyle.mainOffset+parseFloat(t.style.flexGrow)/l*r.mainSpace:t.flexStyle.main+=parseFloat(t.style.flexGrow)/l*r.mainSpace,t.flexStyle.mainOuter=t.flexStyle.main+t.flexStyle.mainBefore+t.flexStyle.mainAfter,e+t.flexStyle.mainOuter},0),r.mainSpace=0))}},{"../reduce":12}],5:[function(e,t,r){var n=e("../reduce");t.exports=function(r){var l;r.mainSpace<0&&(0<(l=n(r.children,function(e,t){return e+parseFloat(t.style.flexShrink)},0))&&(r.main=n(r.children,function(e,t){return t.flexStyle.main+=parseFloat(t.style.flexShrink)/l*r.mainSpace,t.flexStyle.mainOuter=t.flexStyle.main+t.flexStyle.mainBefore+t.flexStyle.mainAfter,e+t.flexStyle.mainOuter},0),r.mainSpace=0))}},{"../reduce":12}],6:[function(e,t,r){var n=e("../reduce");t.exports=function(e){var t;e.lines=[t={main:0,cross:0,children:[]}];for(var r,l=-1;r=e.children[++l];)"nowrap"===e.style.flexWrap||0===t.children.length||"auto"===e.flexStyle.main||e.flexStyle.main-e.flexStyle.mainInnerBefore-e.flexStyle.mainInnerAfter-e.flexStyle.mainBorderBefore-e.flexStyle.mainBorderAfter>=t.main+r.flexStyle.mainOuter?(t.main+=r.flexStyle.mainOuter,t.cross=Math.max(t.cross,r.flexStyle.crossOuter)):e.lines.push(t={main:r.flexStyle.mainOuter,cross:r.flexStyle.crossOuter,children:[]}),t.children.push(r);e.flexStyle.mainLines=n(e.lines,function(e,t){return Math.max(e,t.main)},0),e.flexStyle.crossLines=n(e.lines,function(e,t){return e+t.cross},0),"auto"===e.flexStyle.main&&(e.flexStyle.main=Math.max(e.flexStyle.mainOffset,e.flexStyle.mainLines+e.flexStyle.mainInnerBefore+e.flexStyle.mainInnerAfter+e.flexStyle.mainBorderBefore+e.flexStyle.mainBorderAfter)),"auto"===e.flexStyle.cross&&(e.flexStyle.cross=Math.max(e.flexStyle.crossOffset,e.flexStyle.crossLines+e.flexStyle.crossInnerBefore+e.flexStyle.crossInnerAfter+e.flexStyle.crossBorderBefore+e.flexStyle.crossBorderAfter)),e.flexStyle.crossSpace=e.flexStyle.cross-e.flexStyle.crossInnerBefore-e.flexStyle.crossInnerAfter-e.flexStyle.crossBorderBefore-e.flexStyle.crossBorderAfter-e.flexStyle.crossLines,e.flexStyle.mainOuter=e.flexStyle.main+e.flexStyle.mainBefore+e.flexStyle.mainAfter,e.flexStyle.crossOuter=e.flexStyle.cross+e.flexStyle.crossBefore+e.flexStyle.crossAfter}},{"../reduce":12}],7:[function(n,e,t){e.exports=function(e){for(var t,r,l=-1;t=e.children[++l];)n("./flex-direction")(t,e.style.flexDirection);for(n("./flex-direction")(e,e.style.flexDirection),n("./order")(e),n("./flexbox-lines")(e),n("./align-content")(e),l=-1;r=e.lines[++l];)r.mainSpace=e.flexStyle.main-e.flexStyle.mainInnerBefore-e.flexStyle.mainInnerAfter-e.flexStyle.mainBorderBefore-e.flexStyle.mainBorderAfter-r.main,n("./flex-grow")(r),n("./flex-shrink")(r),n("./margin-main")(r),n("./margin-cross")(r),n("./justify-content")(r,e.style.justifyContent,e);n("./align-items")(e)}},{"./align-content":1,"./align-items":2,"./flex-direction":3,"./flex-grow":4,"./flex-shrink":5,"./flexbox-lines":6,"./justify-content":8,"./margin-cross":9,"./margin-main":10,"./order":11}],8:[function(e,t,r){t.exports=function(e,t,r){var l,n,o,f=r.flexStyle.mainInnerBefore,i=-1;if("flex-end"===t)for(l=e.mainSpace,l+=f;o=e.children[++i];)o.flexStyle.mainStart=l,l+=o.flexStyle.mainOuter;else if("center"===t)for(l=e.mainSpace/2,l+=f;o=e.children[++i];)o.flexStyle.mainStart=l,l+=o.flexStyle.mainOuter;else if("space-between"===t)for(n=e.mainSpace/(e.children.length-1),l=0,l+=f;o=e.children[++i];)o.flexStyle.mainStart=l,l+=o.flexStyle.mainOuter+n;else if("space-around"===t)for(l=(n=2*e.mainSpace/(2*e.children.length))/2,l+=f;o=e.children[++i];)o.flexStyle.mainStart=l,l+=o.flexStyle.mainOuter+n;else for(l=0,l+=f;o=e.children[++i];)o.flexStyle.mainStart=l,l+=o.flexStyle.mainOuter}},{}],9:[function(e,t,r){t.exports=function(e){for(var t,r=-1;t=e.children[++r];){var l=0;"auto"===t.flexStyle.crossBefore&&++l,"auto"===t.flexStyle.crossAfter&&++l;var n=e.cross-t.flexStyle.crossOuter;"auto"===t.flexStyle.crossBefore&&(t.flexStyle.crossBefore=n/l),"auto"===t.flexStyle.crossAfter&&(t.flexStyle.crossAfter=n/l),"auto"===t.flexStyle.cross?t.flexStyle.crossOuter=t.flexStyle.crossOffset+t.flexStyle.crossBefore+t.flexStyle.crossAfter:t.flexStyle.crossOuter=t.flexStyle.cross+t.flexStyle.crossBefore+t.flexStyle.crossAfter}}},{}],10:[function(e,t,r){t.exports=function(e){for(var t,r=0,l=-1;t=e.children[++l];)"auto"===t.flexStyle.mainBefore&&++r,"auto"===t.flexStyle.mainAfter&&++r;if(0<r){for(l=-1;t=e.children[++l];)"auto"===t.flexStyle.mainBefore&&(t.flexStyle.mainBefore=e.mainSpace/r),"auto"===t.flexStyle.mainAfter&&(t.flexStyle.mainAfter=e.mainSpace/r),"auto"===t.flexStyle.main?t.flexStyle.mainOuter=t.flexStyle.mainOffset+t.flexStyle.mainBefore+t.flexStyle.mainAfter:t.flexStyle.mainOuter=t.flexStyle.main+t.flexStyle.mainBefore+t.flexStyle.mainAfter;e.mainSpace=0}}},{}],11:[function(e,t,r){var l=/^(column|row)-reverse$/;t.exports=function(e){e.children.sort(function(e,t){return e.style.order-t.style.order||e.index-t.index}),l.test(e.style.flexDirection)&&e.children.reverse()}},{}],12:[function(e,t,r){t.exports=function(e,t,r){for(var l=e.length,n=-1;++n<l;)n in e&&(r=t(r,e[n],n));return r}},{}],13:[function(e,t,r){var l=e("./read"),n=e("./write"),o=e("./readAll"),f=e("./writeAll");t.exports=function(e){f(o(e))},t.exports.read=l,t.exports.write=n,t.exports.readAll=o,t.exports.writeAll=f},{"./read":15,"./readAll":16,"./write":17,"./writeAll":18}],14:[function(e,t,r){t.exports=function(e,t,r){var l=e[t],n=String(l).match(s);if(!n){var o=t.match(y);return o?"none"!==e["border"+o[1]+"Style"]&&c[l]||0:l}var f=n[1],i=n[2];return"px"===i?+f:"cm"===i?.3937*f*96:"in"===i?96*f:"mm"===i?.3937*f*96/10:"pc"===i?12*f*96/72:"pt"===i?96*f/72:"rem"===i?16*f:function(e,t){a.style.cssText="border:none!important;clip:rect(0 0 0 0)!important;display:block!important;font-size:1em!important;height:0!important;margin:0!important;padding:0!important;position:relative!important;width:"+e+"!important",t.parentNode.insertBefore(a,t.nextSibling);var r=a.offsetWidth;return t.parentNode.removeChild(a),r}(l,r)};var s=/^([-+]?\d*\.?\d+)(%|[a-z]+)$/,a=document.createElement("div"),c={medium:4,none:0,thick:6,thin:2},y=/^border(Bottom|Left|Right|Top)Width$/},{}],15:[function(e,t,r){t.exports=function(e){var t={alignContent:"stretch",alignItems:"stretch",alignSelf:"auto",borderBottomStyle:"none",borderBottomWidth:0,borderLeftStyle:"none",borderLeftWidth:0,borderRightStyle:"none",borderRightWidth:0,borderTopStyle:"none",borderTopWidth:0,boxSizing:"content-box",display:"inline",flexBasis:"auto",flexDirection:"row",flexGrow:0,flexShrink:1,flexWrap:"nowrap",justifyContent:"flex-start",height:"auto",marginTop:0,marginRight:0,marginLeft:0,marginBottom:0,paddingTop:0,paddingRight:0,paddingLeft:0,paddingBottom:0,maxHeight:"none",maxWidth:"none",minHeight:0,minWidth:0,order:0,position:"static",width:"auto"};if(e instanceof Element){var r=e.hasAttribute("data-style"),l=r?e.getAttribute("data-style"):e.getAttribute("style")||"";r||e.setAttribute("data-style",l),function(e,t){for(var r in e){r in t&&!s.test(r)&&(e[r]=t[r])}}(t,window.getComputedStyle&&getComputedStyle(e)||{});var n=e.currentStyle||{};for(var o in function(e,t){for(var r in e){var l;r in t?e[r]=t[r]:(l=r.replace(/[A-Z]/g,"-$&").toLowerCase())in t&&(e[r]=t[l])}"-js-display"in t&&(e.display=t["-js-display"])}(t,n),function(e,t){for(var r;r=i.exec(t);){var l=r[1].toLowerCase().replace(/-[a-z]/g,function(e){return e.slice(1).toUpperCase()});e[l]=r[2]}}(t,l),t)t[o]=a(t,o,e);var f=e.getBoundingClientRect();t.offsetHeight=f.height||e.offsetHeight,t.offsetWidth=f.width||e.offsetWidth}return{element:e,style:t}};var i=/([^\s:;]+)\s*:\s*([^;]+?)\s*(;|$)/g,s=/^(alignSelf|height|width)$/,a=e("./getComputedLength")},{"./getComputedLength":14}],16:[function(e,t,r){t.exports=function(e){var t=[];return function e(t,r){for(var l,n=(x=t,S=x instanceof Element,m=S&&x.getAttribute("data-style"),d=S&&x.currentStyle&&x.currentStyle["-js-display"],u=B.test(m)||g.test(d),u),o=[],f=-1;l=t.childNodes[++f];){var i,s=3===l.nodeType&&!/^\s*$/.test(l.nodeValue);n&&s&&(i=l,(l=t.insertBefore(document.createElement("flex-item"),i)).appendChild(i));var a,c,y=l instanceof Element;y&&(a=e(l,r),n&&((c=l.style).display="inline-block",c.position="absolute",a.style=h(l).style,o.push(a)))}var x,S,m,d,u;var p={element:t,children:o};return n&&(p.style=h(t).style,r.push(p)),p}(e,t),t};var h=e("../read"),B=/(^|;)\s*display\s*:\s*(inline-)?flex\s*(;|$)/i,g=/^(inline-)?flex$/i},{"../read":15}],17:[function(e,t,r){function i(e){return"string"==typeof e?e:Math.max(e,0)+"px"}t.exports=function(e){s(e);var t=e.element.style,r="inline"===e.mainAxis?["main","cross"]:["cross","main"];t.boxSizing="content-box",t.display="block",t.position="relative",t.width=i(e.flexStyle[r[0]]-e.flexStyle[r[0]+"InnerBefore"]-e.flexStyle[r[0]+"InnerAfter"]-e.flexStyle[r[0]+"BorderBefore"]-e.flexStyle[r[0]+"BorderAfter"]),t.height=i(e.flexStyle[r[1]]-e.flexStyle[r[1]+"InnerBefore"]-e.flexStyle[r[1]+"InnerAfter"]-e.flexStyle[r[1]+"BorderBefore"]-e.flexStyle[r[1]+"BorderAfter"]);for(var l,n=-1;l=e.children[++n];){var o=l.element.style,f="inline"===l.mainAxis?["main","cross"]:["cross","main"];o.boxSizing="content-box",o.display="block",o.position="absolute","auto"!==l.flexStyle[f[0]]&&(o.width=i(l.flexStyle[f[0]]-l.flexStyle[f[0]+"InnerBefore"]-l.flexStyle[f[0]+"InnerAfter"]-l.flexStyle[f[0]+"BorderBefore"]-l.flexStyle[f[0]+"BorderAfter"])),"auto"!==l.flexStyle[f[1]]&&(o.height=i(l.flexStyle[f[1]]-l.flexStyle[f[1]+"InnerBefore"]-l.flexStyle[f[1]+"InnerAfter"]-l.flexStyle[f[1]+"BorderBefore"]-l.flexStyle[f[1]+"BorderAfter"])),o.top=i(l.flexStyle[f[1]+"Start"]),o.left=i(l.flexStyle[f[0]+"Start"]),o.marginTop=i(l.flexStyle[f[1]+"Before"]),o.marginRight=i(l.flexStyle[f[0]+"After"]),o.marginBottom=i(l.flexStyle[f[1]+"After"]),o.marginLeft=i(l.flexStyle[f[0]+"Before"])}};var s=e("../flexbox")},{"../flexbox":7}],18:[function(e,t,r){t.exports=function(e){for(var t,r=-1;t=e[++r];)l(t)};var l=e("../write")},{"../write":17}]},{},[13])(13)});