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

        $clrPicker.removeClass('active');

        if (skin == "green") {
            $linkItm.attr('href', 'css/skins/clr-' + skin + '-violet.css');
            $('.green').addClass('active');

            if(typeof(Storage) !== "undefined") {
                localStorage.removeItem("skin");
                localStorage.setItem("skin", skin);
            }
        }
        if (skin == "orange") {
            $linkItm.attr('href', 'css/skins/clr-' + skin + '-red.css');
            $('.orange').addClass('active');

            if(typeof(Storage) !== "undefined") {
                localStorage.removeItem("skin");
                localStorage.setItem("skin", skin);
            }
        }
        if (skin == "crimson") {
            $linkItm.attr('href', 'css/skins/clr-' + skin + '-cyan.css');
            $('.crimson').addClass('active');

            if(typeof(Storage) !== "undefined") {
                localStorage.removeItem("skin");
                localStorage.setItem("skin", skin);
            }
        }
        if (skin == "yellow") {
            $linkItm.attr('href', 'css/skins/clr-' + skin + '-pink.css');
            $('.yellow').addClass('active');

            if(typeof(Storage) !== "undefined") {
                localStorage.removeItem("skin");
                localStorage.setItem("skin", skin);
            }
        }
        if (skin == "brown") {
            $linkItm.attr('href', 'css/skins/clr-' + skin + '-gray.css');
            $('.brown').addClass('active');

            if(typeof(Storage) !== "undefined") {
                localStorage.removeItem("skin");
                localStorage.setItem("skin", skin);
            }
        }
    });

    var loadSkin = function () {
        if(typeof(Storage) !== "undefined") {
            setTimeout( function() {
                $clrPicker.removeClass('active');

                if (localStorage.getItem("skin") == ('green')) {
                    $linkItm.attr('href', 'css/skins/clr-green-violet.css');
                    $('.green').addClass('active');
                }
                if (localStorage.getItem("skin") == ('orange')) {
                    $linkItm.attr('href', 'css/skins/clr-orange-red.css');
                    $('.orange').addClass('active');
                }
                if (localStorage.getItem("skin") == ('crimson')) {
                    $linkItm.attr('href', 'css/skins/clr-crimson-cyan.css');
                    $('.crimson').addClass('active');
                }
                if (localStorage.getItem("skin") == ('yellow')) {
                    $linkItm.attr('href', 'css/skins/clr-yellow-pink.css');
                    $('.yellow').addClass('active');

                }
                if (localStorage.getItem("skin") == ('brown')) {
                    $linkItm.attr('href', 'css/skins/clr-brown-gray.css');
                    $('.brown').addClass('active');
                }

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
       $('.pattern').removeClass('active');

        if ($(this).hasClass('circle')) {
            $body.addClass('circle');
            $(this).addClass('active')
        }
        if ($(this).hasClass('triangle')) {
            $body.addClass('triangle')
            $(this).addClass('active')
        }
        if ($(this).hasClass('solid')) {
            $body.addClass('solid')
            $(this).addClass('active')
        }
        if ($(this).hasClass('waves')) {
            $body.addClass('waves')
            $(this).addClass('active')
        }
        else {
            return false
        }
    });


});
