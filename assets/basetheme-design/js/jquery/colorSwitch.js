"use strict"

$(document).ready(function () {

    var $clrPicker = $('.clr-picker'),
        $linkItm = $('[href^="css/skins/clr"]'),
        $linkItmPtrn = $('[href^="css/skins/pattern"]'),
        $wideScrn = $('.navbar__tint-wide'),
        $ptrn = $('.pattern');


    // Change color theme

    $clrPicker.on('click', function () {
        var skin = $(this).data('skin');
        var $current = $(this);

        if (skin == "green") {
            $linkItm.attr('href', 'css/skins/clr-' + skin + '-violet.css');

            if(typeof(Storage) !== "undefined") {
                localStorage.removeItem("skin");
                localStorage.setItem("skin", skin);
            }
        }
        if (skin == "orange") {
            $linkItm.attr('href', 'css/skins/clr-' + skin + '-red.css');

            if(typeof(Storage) !== "undefined") {
                localStorage.removeItem("skin");
                localStorage.setItem("skin", skin);
            }
        }
        if (skin == "crimson") {
            $linkItm.attr('href', 'css/skins/clr-' + skin + '-cyan.css');

            if(typeof(Storage) !== "undefined") {
                localStorage.removeItem("skin");
                localStorage.setItem("skin", skin);
            }
        }
        if (skin == "yellow") {
            $linkItm.attr('href', 'css/skins/clr-' + skin + '-pink.css');

            if(typeof(Storage) !== "undefined") {
                localStorage.removeItem("skin");
                localStorage.setItem("skin", skin);
            }
        }
        if (skin == "brown") {
            $linkItm.attr('href', 'css/skins/clr-' + skin + '-gray.css');

            if(typeof(Storage) !== "undefined") {
                localStorage.removeItem("skin");
                localStorage.setItem("skin", skin);
            }
        }

        localStorage.setItem('saveActive', $(this).addClass('active'))

    });

    var loadSkin = function () {
        var crnt = $(this).addClass('active');
        if(typeof(Storage) !== "undefined") {
            setTimeout( function() {
                if (localStorage.getItem("skin") == ('green')) {
                    $linkItm.attr('href', 'css/skins/clr-green-violet.css');
                }
                if (localStorage.getItem("skin") == ('orange')) {
                    $linkItm.attr('href', 'css/skins/clr-orange-red.css');
                }
                if (localStorage.getItem("skin") == ('crimson')) {
                    $linkItm.attr('href', 'css/skins/clr-crimson-cyan.css');
                }
                if (localStorage.getItem("skin") == ('yellow')) {
                    $linkItm.attr('href', 'css/skins/clr-yellow-pink.css');
                }
                if (localStorage.getItem("skin") == ('brown')) {
                    $linkItm.attr('href', 'css/skins/clr-brown-gray.css');
                }
                localStorage.getItem('saveActive', $clrPicker.addClass('active'));

            }, 50)
        } else {
            alert('Sorry! No Web Storage support..')
        }
    };

    loadSkin();



    // Change pattern for body in boxed

   $ptrn.on('click', function () {
       var $body = $('body');
       $body.removeClass('circle triangle solid waves');

        if ($(this).hasClass('circle')) {
            $body.addClass('circle')
        }
        if ($(this).hasClass('triangle')) {
            $body.addClass('triangle')
            console.log(123)
        }
        if ($(this).hasClass('solid')) {
            $body.addClass('solid')
        }
        if ($(this).hasClass('waves')) {
            $body.addClass('waves')
        }
        else {
            return false
        }
    });


});
