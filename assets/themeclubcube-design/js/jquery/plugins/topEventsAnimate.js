$(document).ready(function() {
	'use strict';

	//Testing nodes to including into viewport
	function inViewport(el) {
		var offsetTop = $(window).scrollTop();
		var windowHeight = window.innerHeight;
		var elementOffsetTop = $(el).offset().top;
		if ((offsetTop + windowHeight) > elementOffsetTop) {
			return true;
		} else {
			return false;
		}
	};

	//Constructor
	function EventAnimate(nodes) {
		this.$nodes = nodes;
		this.options = {
			minDuration: 0.4,
			maxDuration: 1,
			durationIncrement: 0,
			singleIncrement: 0
		};
		this.init();
	};

	//Animate Event
	EventAnimate.prototype.animateEvents = function() {
		//Fire event animate for Events in viewport
		var durationIncr = this.options.minDuration;
		var self = this;
		this.options.singleIncrement = (this.options.maxDuration - this.options.minDuration) / 9;
		this.items.each(function() {
			var nodeOffsetTop = $(this).scrollTop();
			if (!$(this).hasClass('shown') && inViewport(this)) {
				// var randomDuration;
				// do {
				// 	randomDuration = (Math.random() * 0.3) + 0.4;
				// } while (!(randomDuration < 0.7));
				// randomDuration += 's';
				if ($(window).width() < 768) {
					this.style.WebkitAnimationDuration = '0.5s';
					this.style.MozAnimationDuration = '0.5s';
					this.style.animationDuration = '0.5s';
				} else {
					this.style.WebkitAnimationDuration = durationIncr + 's';
					this.style.MozAnimationDuration = durationIncr + 's';
					this.style.animationDuration = durationIncr + 's';
				};
				var selfy = this;
				// setTimeout(function() {
				// 	$(selfy).addClass('active');
				// }, 50);
				$(selfy).addClass('active');
				setTimeout(function() {
					$(selfy).addClass('shown');
					$(selfy).removeClass('active');
				}, 850);

				durationIncr += self.options.singleIncrement;
			};
		});
	};

	//Add visibility to Event that are already in the viewport
	EventAnimate.prototype.showVisibleEvents = function() {
		var visibleEventsCount = 0;
		var durationIncr = 0;
		var randomDuration;
		var mDuration = this.options.minDuration;
		for (var i = 0; i < this.itemsLength; i++) {
			if (inViewport(this.items[i])) {
				visibleEventsCount++;
			};
		};
		this.options.durationIncrement = (this.options.maxDuration - this.options.minDuration) / visibleEventsCount;
		durationIncr = mDuration;
		for (var i = 0; i < this.itemsLength; i++) {
			if (inViewport(this.items[i])) {
				// $(this.items[i]).addClass('shown');
				this.items[i].style.WebkitAnimationDuration = durationIncr + 's';
				this.items[i].style.MozAnimationDuration = durationIncr + 's';
				this.items[i].style.animationDuration = durationIncr + 's';
				$(this.items[i]).addClass('active');
				var self = this;
				setTimeout(function() {
					$(self.items[i]).addClass('shown');
					$(self.items[i]).removeClass('active');
				}, 1000);
				durationIncr += this.options.durationIncrement;
			};
		};
	};

	//Init slider
	EventAnimate.prototype.init = function() {
		var self = this;
		// this.items = self.$node.find('.top-event');
		this.items = self.$nodes;
		this.itemsLength = self.items.length;
		window.addEventListener('scroll', function() {
			self.animateEvents();
		});
		this.showVisibleEvents();
	};

	window.EventAnimate = EventAnimate;

	//Adding new object
	// var topEventCon = new EventAnimate($('.tab-pane.active'));
});