(function($) {
	'use strict';
	var tinyAnimations = {
		//Button slider functions
		buttonSlider: function(nodes) {
			var $nodes = nodes;
			// $nodes.on('mouseover', function() {
			// 	var node = this;
			// 	setTimeout(function() {
			// 		$(node).addClass('hover-rotated');
			// 	}, 300);
			// });
			// $nodes.on('mouseout', function() {
			// 	$(this).removeClass('hover-rotated');
			// });
			$nodes.on('mousedown', function() {
				$(this).addClass('pressed');
			});
		},
		buttonArrow: function(nodes) {
			var $nodes = nodes;
			$nodes.on('mousedown', function() {
				$(this).addClass('pressed');
				console.log(this, 'pressed');
			});
		},
		radioButton: function(nodes) {
			var $nodes = nodes;
			$nodes.on('mousedown', function() {
				var idRadio = $(this).attr('for');
				var $checkB = $(document.getElementById(idRadio));
				if (!($(this).hasClass('off-lb')) && !($checkB.is(':checked')) && !($(this).hasClass('hover-lb'))) {
					$(this).addClass('pressed-lb');
				};
			});
			$nodes.on('click', function(event) {
				var idRadio = $(this).attr('for');
				var $checkB = $(document.getElementById(idRadio));

				if (!($(this).hasClass('off-lb')) && !($checkB.is(':checked')) && !($(this).hasClass('hover-lb'))) {
					$(this).removeClass('pressed-lb');
					$(this).addClass('active');
				};
				if ($(this).hasClass('off-lb')) {
					event.preventDefault();
				};
			});
		},
		checkboxButton: function(nodes) {
			var $nodes = nodes;
			// $nodes.on('mousedown', function() {
			// 	var idRadio = $(this).attr('for');
			// 	var $checkB = $(document.getElementById(idRadio));
			// 	if (!($(this).hasClass('off-lb')) && !($checkB.is(':checked')) && !($(this).hasClass('hover-lb'))) {
			// 		$(this).addClass('pressed-lb');
			// 	};
			// });
			$nodes.on('click', function(event) {
				var idRadio = $(this).attr('for');
				var $checkB = $(document.getElementById(idRadio));

				if (!($(this).hasClass('off-chb')) && !($checkB.is(':checked')) && !($(this).hasClass('hover-lb'))) {
					// $(this).removeClass('pressed-lb');
					$(this).addClass('active');
				};
				if ($(this).hasClass('off-lb')) {
					event.preventDefault();
				};
			});
		}
	};

	window.tinyAnimations = tinyAnimations;
})(jQuery);