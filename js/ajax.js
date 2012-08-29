var Ajax = (function() {
	var my = {},
		_xhr,
		_requestTimeout,
		_requestTimeoutReached;

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

	_stringify = function(dataObject) {
		if (typeof dataObject === 'object') {
			var dataStr = '',
				first	= true;

			for (key in dataObject) {
				if (!first) {
					dataStr += '&';
				} else {
					first = false;
				}

				dataStr += encodeURIComponent(key) +'='+ encodeURIComponent(dataObject[key]);
			}

			return dataStr;
		} else {
			return dataObject;
		}
	},

	my.request = function(options) {
		console.log('request !', options.url);
		// Init parameters
		options.method  = (typeof options.method 	== 'undefined') 	? 'GET'             : options.method;
		options.async   = (typeof options.async 	== 'undefined') 	? true 	            : !!options.async;
		options.data    = (typeof options.data 		== 'undefined') 	? '' 	            : _stringify(options.data);
		options.timeout = (typeof options.timeout 	== 'undefined') 	? 5000 	            : options.timeout;
		options.success = (typeof options.success 	== 'function') 		? options.success 	: (function() {});
		options.error 	= (typeof options.error 	== 'function') 		? options.error 	: (function() {});

		_requestTimeoutReached = false;

		if (!_xhr) {
			_init();
		}
		if (_xhr) {
			_xhr.onreadystatechange = function() {
				if (_xhr.readyState === 4) {
					/*console.log(_requestTimeout);
					clearTimeout(_requestTimeout);
					clearTimeout(options.reqto);
					setTimeout(function() { console.log(_requestTimeout); }, 500);*/
					if (_xhr.status === 200 || _xhr.status === 304) {
						options.success(_xhr);				
					} else if (_requestTimeoutReached) {
						_xhr.abort();
						console.log('aborted');
						options.error(_xhr);
					} else {
						options.error(_xhr);
					}
				}
			};

			/*_xhr.onerror = _xhr.onabort = function() {
				options.error ? options.error(_xhr) : false;
				console.log('Lol xhr error');
			}*/

			// Check if URL is specified
			if (options.url) {
				_xhr.open(options.method, options.url, options.async);

				/*options.reqto = _requestTimeout = setTimeout(function() {
					console.log('Timeout : ', _xhr, options);
					_xhr.abort();
					_requestTimeoutReached = true;
				}, timeout);*/
			}

			// Send correct headers for post request
			if (options.method === 'POST') {
				_xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			}

			// Perform request
       		_xhr.send(options.data);  
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