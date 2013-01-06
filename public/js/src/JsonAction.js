/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

var JsonAction = (function () {
	var object = {};
	
	object.initialize = function (element, paramName, target) {
		if (typeof element == "string") {
			element = $(element);
		}
		
		if (element.length == 0) {
			return false;
		}
		
		if (typeof target == "string") {
			target = $(target);
		}

		element.data('paramName', paramName);
		element.data('target', target);
		element.bind('change', _request).trigger('change');
	};
	
	var _request = function(event) {
		var element = $(this);
	
		$.ajax({
			'url' : element.attr('rel') + '/' + element.data('paramName') + '/' + element.val(),
			'success' : function(response) {
				var 	target = element.data('target'), 
						targetValue = target.val();
				
				target.html('');
				_createOptions(target, response, targetValue);
			}
		});
	};
	
	var _createOptions = function (select, data, defaultValue) {
		var option = $("<option>", {
			'value' : 0
		});
		select.append(option);
		
		for (var index in data) {
			option = $("<option>", {
				'html' 		: data[index]['name'],
				'value' 		: data[index]['identifier'],
				'label' 		: data[index]['name'],
				'selected' 	: data[index]['identifier'] == defaultValue
			});
			
			select.append(option);
		}
	};
	
	return object;
}());