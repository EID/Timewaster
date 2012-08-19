var Timer = (function() {
	var my 			= {},
	_seconds 		= 0, 
	_minutes 		= 0,
	_hours 			= 0,
	_interval		= null;
	my.totalTime 	= 0,
	my.strTime 		= '',
	my.container	= null;

	_leadingZero = function (time) {
		return (time < 10) ? "0" + time : +time;
	},

	_pluriel = function (nb) {
		return nb == 1 ? '' : 's';
	},

	my.init = function(container) {
		my.container = container;
		return this; // OMG CHAINING !!!
	},

	my.update = function() {
		my.duration();
		my.updateStr();
		my.updateDom();
		return this;
	},

	my.updateStr = function() {
		my.strTime = _leadingZero(_hours) + " heure" + _pluriel(_hours) + " " +  _leadingZero(_minutes) + " minute" + _pluriel(_minutes) + " " + _leadingZero(_seconds) + " seconde" + _pluriel(_seconds);
		return this;
	}, 

	my.updateDom = function() {
		my.container.innerHTML = my.strTime;
		return this;
	},

	my.start = function() {
		_interval = setInterval(function() {
			my.update();
		}, 1000);
		return this;
	},

	my.pause = function() {
		clearInterval(_interval);
		return this;
	},

	my.stop = function() {
		my.pause();
		my.reset();
		return this;
	},

	my.reset = function() {
		_seconds = _minutes = _hours = my.totalTime = 0;
		my.updateStr();
		my.updateDom();
		return this;
	},

	my.duration = function() {
		my.totalTime++;
		_seconds++;
		
		if (_seconds == 60) {
			_seconds = 0;
			_minutes++;
		}
		
		if (_minutes == 60) {
			_hours++;
			_minutes = 0;
		}

		return [my.strTime, my.totalTime];
	};

	return my;
})();