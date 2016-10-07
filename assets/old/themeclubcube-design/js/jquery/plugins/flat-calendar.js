$(document).ready(function() {

	function getDaysInTheMonth(year, month) {
		return 32 - new Date(year, month, 32).getDate();
	};

	function findMonday(year, month, day) {
		var date = new Date(year, month, day, 1, 1);
		var dateNow = date.getDate();
		var day = date.getDay();
		var dif = (day + 6) % 7;
		var monday = new Date(date - dif * 24 * 60 * 60 * 1000).getDate();
		return monday;
	};

	function findSunday(year, month, day) {
		var date = new Date(year, month, day, 1, 1);
		var dateNow = date.getDate();
		var day = date.getDay();
		var dif = (day + 6) % 7;
		var sunday = new Date(date - dif * 24 * 60 * 60 * 1000).getDate();
		return sunday;
	};

	// Function-constructor
	function FlatCalObj(node) {
		this.flatCalendar = node;
		this.date = new Date();
		this.currYear = this.date.getFullYear();
		this.currMonth = this.date.getMonth();
		this.currDay = this.date.getDay();
		this.currDate = this.date.getDate();
		this.weekDays = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
		this.daysClasses = ['sun', 'mon', 'tue', 'wed', 'thur', 'fri', 'sat'];
		this.nextButt = $('.events-tile-datapicker .datepicker.dropdown-menu .table-condensed>thead>tr>th.next');
		this.prevButt = $('.events-tile-datapicker .datepicker.dropdown-menu .table-condensed>thead>tr>th.prev');
		this.init();
	};

	// Fill calendar
	FlatCalObj.prototype.fillCalendar = function(year, month) {
		var rightDays = 0;
		var month = month ? month : this.currMonth;
		var year = year ? year : this.currYear;
		var daysInMonth = getDaysInTheMonth(year, month);
		var self = this;

		this.flatCalendar.empty();
		// Fill month days
		for (var i = 1; i <= daysInMonth; i++) {
			var curr = new Date(year, month, i, 1, 1).getDay();
			this.flatCalendar.append('<div class="flat-day"><div class="calendar-day">' + this.weekDays[curr] + '</div><div class="calendar-date">' + i + '</div><div class="line-bott"></div></div>');
		};

		// Fill previous month day
		this.flatCalendar.prepend('<div class="flat-day old"><div class="calendar-day">' + this.weekDays[new Date(year, month - 1, getDaysInTheMonth(this.currYear, this.currMonth - 1), 1, 1).getDay()] + '</div><div class="calendar-date">' + getDaysInTheMonth(this.currYear, this.currMonth - 1) + '</div><div class="line-bott"></div></div>');

		// Fill next month days
		rightDays = 35 - $('.flat-day').length;
		for (var j = 1; j <= rightDays; j++) {
			var curr = new Date(year, month + 1, j, 1, 1).getDay();
			this.flatCalendar.append('<div class="flat-day new"><div class="calendar-day">' + this.weekDays[curr] + '</div><div class="calendar-date">' + j + '</div><div class="line-bott"></div></div>');
		};

		$('.flat-calendar').mouseenter(function() {
			$('.flat-day').each(function() {
				if ($(this).find('.line-bott').hasClass('oranged')) {
					$(this).find('.line-bott').removeClass('oranged');
					$(this).find('.line-bott').addClass('greyd');
				};
			});
		});

		$('.flat-calendar').mouseleave(function() {
			$('.flat-day').each(function() {
				if ($(this).find('.line-bott').hasClass('greyd')) {
					$(this).find('.line-bott').removeClass('greyd');
					$(this).find('.line-bott').addClass('oranged');
				};
			});
		});

		$('.flat-day').mouseenter(function() {
			var dateNode = $(this).find('.calendar-date').text();
			var monday = findMonday(year, month, dateNode);
			var sunday = 7 - (getDaysInTheMonth(year, month - 1) - monday);
			var newSunday = monday + 7;
			var $mondayNode = '';
			var i = 1;
			var $prevNode = $(this);
			var $nextNode = $(this);
			var $prev = $(this);
			var $next = $(this);
			var length = $('.flat-day').length;


			if ($prev.find('.calendar-day').text() === 'SUN') {
				for (var i = 0; i < 7; i++) {
					$prev.find('.line-bott').addClass('active orange');
					$prev = $prev.prev();
				};
			};

			if ($next.find('.calendar-day').text() === 'MON') {
				for (var i = 0; i < 7; i++) {
					$next.find('.line-bott').addClass('active orange');
					$next = $next.next();
				};
			};

			for (var i = 0; i < length; i++) {
				if ($prevNode.find('.calendar-day').text() !== 'SUN') {
					$prevNode.find('.line-bott').addClass('active orange');
					$prevNode = $prevNode.prev();
				};
			};

			for (var j = 0; j < length; j++) {
				if ($nextNode.find('.calendar-day').text() !== 'MON') {
					$nextNode.find('.line-bott').addClass('active orange');
					$nextNode = $nextNode.next();
				};
			};
		});

		$('.flat-day').mouseleave(function() {
			$('.flat-day').each(function() {
				$(this).find('.line-bott').removeClass('active orange');
			});
		});
	};


	//Clear  all underlines
	FlatCalObj.prototype.clearUnderline = function() {
		$('.flat-day').find('.line-bott').removeClass('actived oranged active orange grey greyd');
	};

	// Add underlines to current week
	FlatCalObj.prototype.addUnderline = function(year, month, cDay) {
		var date = new Date(year, month, day, 1, 1);
		var dateNow = date.getDate();
		var day = date.getDay();
		var dif = (day + 6) % 7;
		var monday = findMonday(year, month, cDay);
		var previousMonthDays = getDaysInTheMonth(year, month - 1);
		var summary = 7 - (previousMonthDays - monday);

		this.clearUnderline();

		if (dateNow < monday) {
			$('.flat-day').each(function() {
				if (summary !== 0) {
					$(this).find('.line-bott').addClass('actived oranged');
					summary--;
				};
			});
		} else {
			$('.flat-day').each(function() {
				if ($(this).find('.calendar-date').text() == monday) {
					var $mondayNode = $(this);
					for (var j = 1; j < 8; j++) {
						$mondayNode.find('.line-bott').addClass('actived oranged');
						$mondayNode = $mondayNode.next();
					};
				};
			})
		};
	};

	// Click to next month
	FlatCalObj.prototype.nextMonth = function() {
		var self = this;
		this.nextButt.click(function() {
			self.flatCalendar.empty();
			self.currMonth = self.currMonth + 1;
			self.fillCalendar(self.currYear, self.currMonth);
		})
	};

	// Click to previous month
	FlatCalObj.prototype.prevMonth = function() {
		var self = this;
		this.prevButt.click(function() {
			self.flatCalendar.empty();
			self.currMonth = self.currMonth - 1;
			self.fillCalendar(self.currYear, self.currMonth);
		})
	};

	// Run intialize
	FlatCalObj.prototype.init = function() {
		this.fillCalendar();
		this.addUnderline(this.currYear, this.currMonth, this.currDate);
		this.prevMonth();
		this.nextMonth();
	};

	// Add global variable
	window.flatCalObj = new FlatCalObj($('.flat-calendar'));
});