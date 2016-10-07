//Youtube
var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
var player = [];
var ids = [];

function onYouTubeIframeAPIReady() {
    $('.video-bg').each(function() {
        ids.push(this.id);
    });
    for (var j = 0; j < ids.length; j++) {
        if (ids[j]) {
            player[j] = new YT.Player(ids[j], {
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            })
        };
    };
};

function onPlayerReady(event) {
    var _eventTarget = event.target;
    var _iframe = event.target.d;
    var $playBtn = $(_iframe).closest('.container-fluidss').find('.video-btn').find('.left-btn');
    var $titles = $(_iframe).closest('.container-fluidss').find('.rowss');
    var $pattern = $(_iframe).closest('.container-fluidss').find('.pattern');
    var $bgImg = $(_iframe).closest('.container-fluidss').find('.vid');
    var $sPattern = $(_iframe).closest('.container-fluidss').find('.s-panel');
    var $vidTime = $(_iframe).closest('.container-fluidss').find('.video-time');
    var $slickPrev = $('.slick-prev');
    var $slickNext = $('.slick-next');
    var $slickDots = $('.slick-dots');
    var $scrollDownBtn = $('.scroll-down');
    var videoOnOff = false;

    function getTime(seconds) {
        var hours = '';
        var minutes = '';
        var second = ('' + (seconds / 60)).split('.')[1].substr(0, 2) + 'sec';
        var hoursAndMin = ('' + (seconds / 60)).split('.')[0].substr(0, 2);
        if ((hoursAndMin / 60) < 60) {
            minutes = hoursAndMin + 'min:';
        } else {
            hours = ('' + (hoursAndMin / 60)).split('.')[0].substr(0, 1) + 'h:';
            minutes = ('' + (hoursAndMin / 60)).split('.')[1].substr(0, 2) + 'min:';
        };
        //1h:22min:39sec
        $vidTime.text(hours + minutes + second);
    };

    //Get video duration
    getTime(_eventTarget.getDuration());

    function hideControls() {
        $titles.fadeOut();
        $slickPrev.fadeOut();
        $slickNext.fadeOut();
        $bgImg.fadeOut();
        $slickDots.fadeOut();
        $scrollDownBtn.fadeOut();
        $sPattern.fadeOut();
    };

    function showControls() {
        $titles.fadeIn();
        $slickPrev.fadeIn();
        $slickNext.fadeIn();
        $bgImg.fadeIn();
        $slickDots.fadeIn();
        $scrollDownBtn.fadeIn();
        $sPattern.fadeIn();
    };

    $playBtn.on('click touchend', function() {

        // $('.slider').slickPause();
        tileSlide.stopSlide();
        _eventTarget.playVideo();
        setTimeout(function() {
            hideControls();
        }, 200);
        videoOnOff = false;

        $pattern.on('click touchend', function() {
            showControls();
            _eventTarget.pauseVideo();
            setTimeout(function() {
                tileSlide.playSlide();
                // $('.slider').slickPlay();
            }, 3000);
            videoOnOff = true;
        });

        $(window).scroll(function() {
            if (($(document).scrollTop() >= $(window).height()) && (videoOnOff === false)) {
                videoOnOff = true;
                _eventTarget.pauseVideo();
                showControls();
            };
        });
    });
    $pattern.off('click touchend');
    // $('.slider').slickPlay();
    tileSlide.playSlide();
};

function onPlayerStateChange(event) {
    var _eventTarget = event.target;
    var _iframe = event.target.a;
    var $playBtn = $(_iframe).closest('.container-fluidss').find('.rnd-inner');
    var $titles = $(_iframe).closest('.container-fluidss').find('.rowss');
    var $pattern = $(_iframe).closest('.container-fluidss').find('.pattern');
    var $sPattern = $(_iframe).closest('.container-fluidss').find('.s-panel');
    var $bgImg = $(_iframe).closest('.container-fluidss').find('.vid');

    var $slickPrev = $('.slick-prev');
    var $slickNext = $('.slick-next');

    function showControls() {
        $titles.fadeIn();
        $slickPrev.fadeIn();
        $slickNext.fadeIn();
        $bgImg.fadeIn();
        $sPattern.fadeIn();
    };

    if (event.data === 0) {
        showControls();
        setTimeout(function() {
            tileSlide.playSlide();
            // $('.slider').slickPlay();
        }, 3000);
    };
};