/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

var ActivityIcon = (function() {
	var object = {};
	
	object.initialize = function() {
		$("td.activity").each(function(index, element) {			
			var value = $(element).text(),
				img = $("<img>").attr("src", "/images/icons/" + (value == 1 ? "active" : "inactive") + ".png");
			$(element).html(img);
		});
	};
	
	return object;
}());

$(document).ready(function(event) {
	ActivityIcon.initialize();
});