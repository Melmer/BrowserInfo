var app = (function() {

	var privateVariable = 'app fired!',
		docElem = document.documentElement;

	return {

		loadBrowserInfo: function() {
			
			//Browser detection from: http://stackoverflow.com/questions/5916900/detect-version-of-browser
			navigator.sayswho = (function(){
			    var ua= navigator.userAgent, tem, 
			    M= ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*([\d\.]+)/i) || [];
			    if(/trident/i.test(M[1])){
			        tem=  /\brv[ :]+(\d+(\.\d+)?)/g.exec(ua) || [];
			        return 'IE '+(tem[1] || '');
			    }
			    M= M[2]? [M[1], M[2]]:[navigator.appName, navigator.appVersion, '-?'];
			    if((tem= ua.match(/version\/([\.\d]+)/i))!= null) M[2]= tem[1];
			    return M.join(' ');
			})();

			$("#browser").val(navigator.sayswho);


			var allInputFields = $('input.get-info'), i, len, y, leny;

			for (i = 0, len = allInputFields.length; i < len; i++) {
			  	
			  	var $this = $(allInputFields[i]);

			  	var dataValue = $this.data('info');


			  	if(typeof dataValue !== "undefined"){

			  		//check if the first value is window, document or navigator
			  		if(dataValue.match('\window|document|navigator')){

			  			if(dataValue.match('window')){
			  				finalValue = this.objectByString(window, dataValue);	
			  			}

						if(dataValue.match('document')){
			  				finalValue = this.objectByString(document, dataValue);	
			  			}

			  			if(dataValue.match('navigator')){
			  				finalValue = this.objectByString(navigator, dataValue);	
			  			}
						
			  		} else {
						
					  	//check for a second dataValue
					  	var secondDataValue = $this.data('info-second');

					  	var finalValue = this.objectByString(window.session, dataValue);

					  	if(typeof secondDataValue !== 'undefined'){

					  		var separator = $this.data('info-separator')?$this.data('info-separator'):' ';
					  		var secondValue = this.objectByString(window.session, secondDataValue);

						 	finalValue += separator+secondValue;

					  	}
			  		}

					$this.val(finalValue);
			  	}
			}

			var data = $('#browser-info').serializeArray();
			var $url = $("#url");

			//perform an ajax request with all values
			$.ajax('process', {
				type: 'POST',
				dataType: 'json',
				data: data,
				success: function(data){					
					$("#url").val(data.url);
				}
			});

		},

		//object by string function from: http://stackoverflow.com/questions/6491463/accessing-nested-javascript-objects-with-string-key
		objectByString: function(o, s) {
		    s = s.replace(/\[(\w+)\]/g, '.$1');  // convert indexes to properties
		    s = s.replace(/^\./, ''); // strip leading dot
		    var a = s.split('.');
		    while (a.length) {
		        var n = a.shift();
		        if (n in o) {
		            o = o[n];
		        } else {
		            return;
		        }
		    }
		    return o;
		},

		userAgentInit: function() {
			docElem.setAttribute('data-useragent', navigator.userAgent);
			$("#agent-string").val(navigator.userAgent);
		}
	};

})();

(function() {

	//foundation init
	$(document).foundation();

	if($("#browser-info").hasClass('load')){

 	} else {

		app.userAgentInit();
		app.loadBrowserInfo();
		

		$(window).on('resize', function(){
			session_fetch(window, document, navigator);
			app.loadBrowserInfo();
		});


 	}




})();