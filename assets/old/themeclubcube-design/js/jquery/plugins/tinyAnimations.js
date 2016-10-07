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
			$nodes.on('click touchend', function(event) {
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
		dropdownHidden: function(nodes) {
			var $nodes = nodes;
			$nodes.on('click touchend', function(event) {
				var $target = $(event.target).closest('.button-dropdown');
				if ($target.hasClass('pressed')) {
					$target.find('.hidden-dv').removeClass('hide');
				} else {
					$target.find('.hidden-dv').addClass('hide');
				};
			});
		},
		checkboxButton: function(nodes) {
			var $nodes = nodes;
			$nodes.on('click touchend', function(event) {
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
		},
		initEventClasses: function() {
			var $tinyObj = {
				$button1: $('.read-more'),
				$button2: $('.left-pag, .right-pag'),
				$buttonSlider: $('.button-slider'),
				$buttonArrowL: $('.button-arrow-left'),
				$buttonArrowR: $('.button-arrow-right'),
				$buttonFilterChecked: $('.button-filter.checked'),
				$buttonFilterUnchecked: $('.button-filter.unchecked'),
				$buttonMoreBlogs: $('.button-more'),
				$buttonDropDown: $('.button-dropdown'),
				$dropDownList: $('.dropdown-list .button-dropdown-text'),
				$tab: $('.tab-custom'),
				$menu: $('.mob-menu li a'),
				$radio: $('.radio-b input, .radio-b label'),
				$checkbox: $('.checkbox-b input, .checkbox-b label'),
				$getIn: $('.get-in')
			};

			for (var key in $tinyObj) {
				$tinyObj[key].on('click touchend', function(event) {
					if (!($(event.currentTarget).hasClass('off')) && !($(event.currentTarget).hasClass('hover')) && !($(event.currentTarget).hasClass('pressed'))) {
						$(event.currentTarget).addClass('pressed');
						if ($(event.currentTarget).hasClass('left-pag') || $(event.currentTarget).hasClass('right-pag')) {
							setTimeout(function() {
								$(event.currentTarget).removeClass('pressed');
							}, 250);
						};
					} else if ($(event.currentTarget).hasClass('pressed')) {
						$(event.currentTarget).removeClass('pressed');
					};
				});
			};
		}
	};

	window.tinyAnimations = tinyAnimations;
	tinyAnimations.initEventClasses();
	tinyAnimations.dropdownHidden($('.button-dropdown.hidd'));
})(jQuery);