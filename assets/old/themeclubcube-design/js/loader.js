(function($) {
	var $body = $('body');
	var $loaderWrap = $('.loader-container');
	var $loader = $('.loader');
	var $tiles = $loader.children();
	var animate = true;
	var current = 0;
	var currentTime = new Date();
	var miliseconds = 0;
	var oldMiliseconds = 0;

	// console.log('Start');

	$body.addClass('ov-hidd');
	$loaderWrap.addClass('active');

	
	// window.loaderInterval = setInterval(function() {
	// 	// console.timeEnd('one');
	// 	oldMiliseconds = miliseconds - oldMiliseconds;
	// 	// $tiles.removeClass('active');
	// 	// $($tiles[current]).addClass('active');
	// 	current++;
	// 	if (current > 3) {
	// 		current = 0;
	// 	};
	// 	// console.time('one');
	// 	currentTime = new Date();
	// 	miliseconds = currentTime.getMilliseconds();
	// 	console.log(oldMiliseconds);
	// }, 300);

	$(window).load(function() {
		// clearInterval(window.loaderInterval);
		// console.log('Loaded');
		$body.removeClass('ov-hidd');
		$loaderWrap.removeClass('active');
		$loaderWrap.fadeOut(1000);
	});
})(jQuery);