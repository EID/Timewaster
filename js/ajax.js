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
					options.error ? options.error(xhr) : false;
				}
			}

			if (options.url) {
				_xhr.open(method, options.url, async);  
			}
			if (method === 'POST') {
				_xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			}
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
		my.request(options);
	}

	return my;
})();