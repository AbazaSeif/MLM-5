/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

$(document).ready(function() {
	$("ul.actions .delete a").bind("click", function(event) {
		if (confirm("Czy na pewno chcesz usunąć element z listy ?") == false) {
			event.preventDefault();
		}
	});
	
	$("li.change-to-employee a").bind("click", function(event) {
		event.preventDefault();
		var target = $(this), 
			form = $("#" + target.attr("rel"));
		
		form.attr("action", target.attr("href"));
		form.find("input[type='submit']").trigger("click");
	});
	
	$("#ajax-result").draggable();
	
	$(".filter-form .small").each(function(index, element) {
		var parent = $(element).parent("li")
			label = parent.find("label");
		
		parent.addClass("auto-width");
		
		if (label.attr("for").match(/^\w+_to$/)) {
			label.addClass("small");
		}
	});
});