(function($) {
	'use strict';

	//Constructor 
	function TileSlide(node, options) {
		this.node = node;
		this.pause = false;
		this.tiles = 4;
		this.timing = null;
		this.current = 1;
		this.panels = [].slice.call(document.querySelectorAll('.s-panel'));
		this.slides = [].slice.call(document.querySelectorAll('.container-fluidss'));
		this.panelsCount = this.panels.length;
		this.options = {
			dots: false,
			interval: 5000
		};
		this.options = $.extend({}, this.options, options);
		this.init();
	};

	//Add naviation dots
	TileSlide.prototype.addDots = function() {
		this.dots = '<ul class="slick-dots"></ul>';
		$(this.node).append(this.dots);
		var $sliderUl = $('.slick-dots');
		var self = this;
		for (var i = 0; i < this.slides.length; i++) {
			$sliderUl.append('<li><button></button></li>');
		};
		function dotClick(node) {
			for (var i = 0; i < self.slides.length; i++) {
				if (node === $dots[i]) {
					self.navigation(i);
				}
			};
		};
		var $dots = $('.slick-dots li button');
		$dots.on('click', function() {
			dotClick(this);
		});
	};

	//Init the slider
	TileSlide.prototype.init = function() {
		var self = this;
		this.isAnimating = false;
		// this.pause = false;
		// this.tiles = 4;
		// this.interval = 5000;
		// this.timing = null;
		// this.current = 1; //current slide
		// this.panels = [].slice.call(document.querySelectorAll('.s-panel'));
		// this.slides = [].slice.call(document.querySelectorAll('.container-fluidss'));
		// this.panelsCount = this.panels.length;

		//Transform pattern for tiles img
		this.transforms = {
			'effect-1': ['translate3d(-' + (window.innerWidth / 2 + 10) + 'px, 0, 0)',
				'translate3d(' + (window.innerWidth / 2 + 10) + 'px, 0, 0)',
				'translate3d(-' + (window.innerWidth / 2 + 10) + 'px, 0, 0)',
				'translate3d(' + (window.innerWidth / 2 + 10) + 'px, 0, 0)'
			]
		};

		//Insert 4 tiles with img
		this.panels.forEach(function(panel) {
			var img = panel.querySelector('img'),
				imgInsertion = '';
			for (var i = 0; i < self.tiles; i++) {
				imgInsertion += '<div class="bg-tile"><div class="bg-img"><img src="' + img.src + '" /></div></div>';
			};
			panel.removeChild(img);
			panel.innerHTML = imgInsertion + panel.innerHTML;
		});

		//Insert navigation for slider
		this.prev = document.createElement('div');
		this.next = document.createElement('div');
		this.prev.className = 'slick-prev';
		this.next.className = 'slick-next';
		this.node.appendChild(this.prev);
		this.node.appendChild(this.next);

		//If dots are needed — add dots
		if (this.options.dots === true) {
			this.addDots();
		};

		//Init first slider to current
		this.slides[0].className = 'container-fluidss current';
		this.events();
	};

	//Navigation and transforms
	TileSlide.prototype.navigation = function(direction) {
		var self = this;

		if (self.isAnimating === true) {
			return false
		};
		self.isAnimating = true;
		var currentPanel;
		var nextPanel;
		if (direction === 'prev') {
			currentPanel = this.slides[this.current - 1];
			this.current = this.current === 1 ? this.panelsCount : this.current - 1;
			var nextPanel = this.slides[this.current - 1];
		} else if (direction === 'next') {
			currentPanel = this.slides[this.current - 1];
			this.current = this.current === this.panelsCount ? 1 : this.current + 1;
			var nextPanel = this.slides[this.current - 1];
		} else {
			currentPanel = this.slides[this.current - 1];
			this.current = direction + 1;
			var nextPanel = this.slides[direction];
		};
		nextPanel.className = 'container-fluidss active';

		//Current slide change
		self.applyTransforms(currentPanel);
		currentPanel.querySelector('.rowss').style.visibility = 'hidden';
		if (currentPanel.querySelector('iframe')) {
			currentPanel.querySelector('iframe').style.visibility = 'hidden';
		};
		currentPanel.querySelector('.pattern').style.visibility = 'hidden';
		var currTransTotal = 0,
			onTransitionEnd = function(event) {
				currTransTotal++;
				if (currTransTotal < self.tiles) {
					return false
				};
				this.removeEventListener('transitionend', onTransitionEnd);

				//Next slide change
				currentPanel.className = 'container-fluidss';
				currentPanel.querySelector('.rowss').style.visibility = 'visible';
				if (currentPanel.querySelector('iframe')) {
					currentPanel.querySelector('iframe').style.visibility = 'visible';
				};
				currentPanel.querySelector('.pattern').style.visibility = 'visible';
				nextPanel.className = 'container-fluidss current';

				//Reset transforms for curent slide
				self.resetTransforms(currentPanel);
				self.isAnimating = false;
			};
		if (true) {
			currentPanel.addEventListener('webkitTransitionEnd', onTransitionEnd);
			currentPanel.addEventListener('transitionend', onTransitionEnd);
			currentPanel.addEventListener('oTransitionEnd otransitionend', onTransitionEnd);
		};
	};

	TileSlide.prototype.stopSlide = function() {
		// clearInterval(self.timing);
		this.pause = true;
	};

	TileSlide.prototype.playSlide = function() {
		this.pause = false;
	};

	TileSlide.prototype.runSlider = function() {
		var self = this;
		self.timing = setInterval(function() {
			if (self.pause === false) {
				self.navigation('next');
			};
		}, self.options.interval);
	};

	// TileSlide.prototype.buildDots = functions() {

	// };

	//Apply transforms
	TileSlide.prototype.applyTransforms = function(panel) {
		var self = this;
		[].slice.call(panel.querySelectorAll('div.bg-img')).forEach(function(tile, pos) {
			tile.style.WebkitTransform = self.transforms['effect-1'][pos];
			tile.style.transform = self.transforms['effect-1'][pos];
		});
	};

	//Reset transforms	
	TileSlide.prototype.resetTransforms = function(panel) {
		[].slice.call(panel.querySelectorAll('div.bg-img')).forEach(function(tile, pos) {
			tile.style.WebkitTransform = 'none';
			tile.style.transform = 'none';
		});
	};

	//Events binding
	TileSlide.prototype.events = function() {
		var self = this;
		var prevButt = document.querySelector('.slick-prev');
		var nextButt = document.querySelector('.slick-next');
		prevButt.addEventListener('click', function() {
			self.navigation('prev');
		});
		prevButt.addEventListener('touchstart', function() {
			self.navigation('prev');
		});
		nextButt.addEventListener('click', function() {
			self.navigation('next');
		});
		nextButt.addEventListener('touchstart', function() {
			self.navigation('next');
		});

		$(document).ready(function() {
			self.runSlider();
		});
	};

	window.TileSlide = TileSlide;
})(jQuery);