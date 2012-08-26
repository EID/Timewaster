var Ajax = (function() {
	var my = {},
		_xhr;

	_init = function() {
		if(window.XMLHttpRequest) _xhr = new XMLHttpRequest();  
        else {  
            var versions = ["MSXML2.XmlHttp.5.0",   
                            "MSXML2.XmlHttp.4.0",  
                            "MSXML2.XmlHttp.3.0",   
                            "MSXML2.XmlHttp.2.0",  
                            "Microsoft.XmlHttp"]  
  
             for(var i = 0, len = versions.length; i < len; i++) {  
                try {  
                    _xhr = new ActiveXObject(versions[i]);  
                    break;  
                }  
                catch(e){}  
             } 
        }
	},

	my.request = function(options) {
		// Init parameters
		method = options.method || 'GET';
		async = options.async != null ? !!options.async : true;
		data = options.data || '';

		if (!_xhr) {
			_init();
		}
		if (_xhr) {
			_xhr.onreadystatechange = function() {
				if (_xhr.readyState === 4 && _xhr.status === 200) {
					options.success(_xhr);
				} else {
					options.error ? options.error(_xhr) : false;
				}
			}

			// Check if URL is specified
			if (options.url) {
				_xhr.open(method, options.url, async);  
			} else {
				if (options.error) {
					options.error(_xhr);
				} else {
					return false;
				}
			}

			// Format data
			if (typeof data === 'object') {
				var dataStr = '',
					first	= true;

				for (key in data) {
					if (!first) {
						dataStr += '&';
					} else {
						first = false;
					}

					dataStr += encodeURIComponent(key) +'='+ encodeURIComponent(data[key]);
				}

				data = dataStr;
			}

			// Send correct headers for post request
			if (method === 'POST') {
				_xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			}

			// Perform request
       		_xhr.send(data);  
		}
	}, 

	my.load = function(options) {
		my.request({
			url: options.url,
			data: options.data,
			method: options.method,
			async: options.async,
			success: function(xhr) {
				options.container.innerHTML = xhr.responseText;
			},
			error: options.error
		});
	},

	my.post = function(options) {
		options.method = 'POST';
		my.request(options);
	},

	my.get = function(options) {
		options.method = 'GET';
		my.request(options);
	}

	return my;
})();