var Assert = (function() {
	var my             = {},
	_container         = null,
	_autoStyle         = null,
	_li                = document.createElement('li'),
	_autoRemoveTime    = 3000,
	_autoRemoveEnabled = true;

	_createContainer = function() {
		var assert = document.createElement('ul');
		assert.className = "assert";

		document.querySelector('body').appendChild(assert);
		return assert;
	},

	_autoRemove = function(elt) {
		if (_autoRemoveEnabled){
			setTimeout(function() {
				elt.parentNode.removeChild(elt);
			}, _autoRemoveTime);
		}
	},

	my.init = function(container, autoStyle, autoRemove) {
		_container         = container ? container : _createContainer();
		_autoStyle         = autoStyle || true;
		_autoRemoveEnabled = autoRemove || true;

		if (_autoStyle) {
			var cStyle = _container.style,
				lStyle = _li.style;

			cStyle.position = 'fixed';
			cStyle.bottom   = cStyle.right = '0px';
			cStyle.width    = '400px';

			lStyle.listStyleType = 'none';
			lStyle.background    = '#fff';
			lStyle.color         = '#666';
			lStyle.padding       = '10px 20px';
			lStyle.margin        = '10px 20px';
			lStyle.border        = '2px solid rgba(255, 255, 255, 0.2)';
			lStyle.borderRadius  = '2px';
			lStyle.maxWidth      = '350px';
			lStyle.float         = 'right';
		}
	},

	my.assert = function(outcome, description) {
		if (!_container) {
			my.init();
			arguments.callee(outcome, description);
		} else {
			var li = _li.cloneNode(false);
			if (outcome) {
				li.className = 'pass';
				li.style.border = '2px solid #0f0';
			} else {
				li.className = 'fail';
				li.style.border = '2px solid #f00';
			}
		    li.appendChild(document.createTextNode(description));

		    _container.insertBefore(li, _container.firstChild);
		    _autoRemove(li);
		}
	},

	my.log = function(content) {
	    if (!_container) {
			my.init();
			arguments.callee(content);
		} else {
			var li = _li.cloneNode(false);
		    li.className = 'log';
		    li.appendChild(document.createTextNode(content));

		    _container.insertBefore(li, _container.firstChild);
		    _autoRemove(li);
		}
	},

	my.success = function(content) {
	    if (!_container) {
			my.init();
			arguments.callee(content);
		} else {
			console.log('assert');
			var li = _li.cloneNode(false);
		    li.className = 'pass';
		    li.style.border = '2px solid rgba(0, 255, 0, 0.3)';
		    li.appendChild(document.createTextNode(content));

		    _container.insertBefore(li, _container.firstChild);
		    _autoRemove(li);
		}
	},

	my.error = function(content) {
	    if (!_container) {
			my.init();
			arguments.callee(content);
		} else {
			var li = _li.cloneNode(false);
		    li.className = 'fail';
		    li.style.border = '2px solid rgba(255, 0, 0, 0.3)';
		    li.appendChild(document.createTextNode(content));

		    _container.insertBefore(li, _container.firstChild);
		    _container.insertBefore(li, _container.firstChild);
		    _autoRemove(li);
		}
	},

	my.disableAutoRemove = function() {
	    _autoRemoveEnabled = false;
	},

	my.enableAutoRemove = function() {
	   _autoRemoveEnabled = true;
	},

	my.toggleAutoRemove = function() {
	    _autoRemoveEnabled = !_autoRemoveEnabled;
	},

	my.setAutoRemoveTime = function(time) {
	    _autoRemoveTime = time;
	};

	return my;
})();