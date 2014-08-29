(function($) {
	var $loaderWrap = $('.loader-container');
	var $loader = $('.loader');
	var $tiles = $loader.children();
	var animate = true;
	var current = 0;

	console.log('Start', $tiles);

	window.loaderInterval = setInterval(function() {
		console.log(current, $tiles[current]);
		// $tiles.removeClass('.active');
		$($tiles[current]).addClass('.active');
		current++;
		if (current > 3) {
			current = 0;
		};
	}, 300);

	$(window).load(function() {
		clearInterval(window.loaderInterval);
		console.log('Loaded');
		$loaderWrap.fadeOut(1000);
	});
})(jQuery);