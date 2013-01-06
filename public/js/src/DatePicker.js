/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

var DatePicker = (function(){
	var object = {};
	
	object.initialize = function(parent) {
		parent = parent || "body";
		$(parent).find("form input").each(function(index, element) {
			element = $(element);
			if (element.attr("name").match(/(.*_)?date(_.*)?/)) {
				element.datepicker();
			}
		});
	};
	
	object.dayNames = ["niedziela", "poniedziałek", "wtorek", "środa", "czwartek", "piątek","sobota"];
	object.dayNamesMin = ["Nd", "Pn", "Wt", "Śr", "Cz", "Pt", "So"];
	object.dayNamesShort = ["Nie", "Pon", "Wto", "Śro", "Czw", "Pią", "Sob"];
	object.monthNames = ["Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec", "Lipiec", "Sierpień", "Wrzesień", "Październik", "Listopad", "Grudzień"];
	object.monthNamesShort = ["Sty", "Lut", "Mar", "Kwi", "Maj", "Cze", "Lip", "Sie", "Wrz", "Paź", "Lis", "Gru"];
	
	return object;
}());

jQuery.datepicker.setDefaults({
	dateFormat: 'yy-mm-dd',
	firstDay : 1,
	dayNames : DatePicker.dayNames,
	dayNamesMin : DatePicker.dayNamesMin,
	dayNamesShort : DatePicker.dayNamesShort,
	monthNames : DatePicker.monthNames,
	monthNamesShort : DatePicker.monthNamesShort
});

$(document).ready(function() {
	DatePicker.initialize();
});