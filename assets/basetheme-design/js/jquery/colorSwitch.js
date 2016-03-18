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
        var ptrn = $(this).data('ptrn');

        $ptrn.removeClass('active');

        if (ptrn == "circle") {
            $('body').removeClass('circle triangle solid waves').addClass('circle body-boxed');
            $(this).addClass('active');
            $('#fullWide').removeClass('wide');

            if(typeof(Storage) !== "undefined") {
                localStorage.removeItem("ptrn");
                localStorage.setItem("ptrn", ptrn);
            }
        }
        if (ptrn == "triangle") {
            $('body').removeClass('circle triangle solid waves').addClass('triangle body-boxed');

            if(typeof(Storage) !== "undefined") {
                localStorage.removeItem("ptrn");
                localStorage.setItem("ptrn", ptrn);
            }
        }
        if (ptrn == "solid") {
            $('body').removeClass('circle triangle solid waves').addClass('solid body-boxed');

            if(typeof(Storage) !== "undefined") {
                localStorage.removeItem("ptrn");
                localStorage.setItem("ptrn", ptrn);
            }
        }
        if (ptrn == "waves") {
            $('body').removeClass('circle triangle solid waves').addClass('waves body-boxed');

            if(typeof(Storage) !== "undefined") {
                localStorage.removeItem("ptrn");
                localStorage.setItem("ptrn", ptrn);
            }
        }

    });

    var loadPtrn = function () {
        if(typeof(Storage) !== "undefined") {
            setTimeout( function() {
                //$clrPicker.removeClass('active');

                if (localStorage.getItem("ptrn") == ('circle')) {
                    $('body').removeClass('circle triangle solid waves').addClass('circle body-boxed');
                    $('.circle').addClass('active');
                    $('#fullWide').removeClass('wide');
                }
                if (localStorage.getItem("ptrn") == ('triangle')) {
                    $('body').removeClass('circle triangle solid waves').addClass('triangle body-boxed');
                    $('.triangle').addClass('active')
                }
                if (localStorage.getItem("ptrn") == ('solid')) {
                    $('body').removeClass('circle triangle solid waves').addClass('solid body-boxed');
                    $('.solid').addClass('active')
                }
                if (localStorage.getItem("ptrn") == ('waves')) {
                    $('body').removeClass('circle triangle solid waves').addClass('waves body-boxed');
                    $('.waves').addClass('active')
                }


            }, 50)
        } else {
            alert('Sorry! No Web Storage support..')
        }
    };
    loadPtrn();

    $('#fullWide').on('click', function () {
        var wide = $(this).hasClass('wide');
        $('#fullWide').addClass('wide');

        if (wide == true) {
            $('body').removeClass('body-boxed circle triangle solid waves');

            if(typeof(Storage) !== "undefined") {
                localStorage.removeItem("wide");
                localStorage.setItem("wide", wide);
            }
        }
    });

    var loadWide = function () {
        if(typeof(Storage) !== "undefined") {
            setTimeout( function() {

                if (localStorage.getItem("wide")) {
                    $('body').removeClass('body-boxed circle triangle solid waves');
                }

            }, 50)
        } else {
            alert('Sorry! No Web Storage support..')
        }
    };
    loadWide();


    $('.navbar__tint-wide').on('click', function (el) {
        $('.navbar__tint-wide').removeClass('active');
        $(this).toggleClass('active');
    });

});
