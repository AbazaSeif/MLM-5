/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

var Tabs = (function($) {
	var object = {};
	
	object.initialize = function() {
		if ($(".tabs").length == 0) return;
		
		$("fieldset").addClass("none");
		object.setActiveTab();

		$("ul.tabs li").bind('click', function(event) {
			object.hideOthers();
			object.show($(this));
		});
	};
	
	object.setActiveTab = function() {
		var activeTab = $("ul.tabs li.active");
		
		if (activeTab.length == 0) {
			if (window.location.hash) {
				activeTab = $("ul.tabs li a[href='" + window.location.hash + "']").parent("li");
				object.show(activeTab);
			} else {
				object.show($("ul.tabs li:first-child"));
			}
		} else {
			object.show(activeTab);
		}
	};
	
	object.hideOthers = function() {
		var target = $("ul.tabs").find(".active").removeClass("active");
		object.getRelatedFieldset(target).addClass("none");
	};
	
	object.show = function(target) {
		target.addClass("active");	
		object.getRelatedFieldset(target).removeClass("none");
		object.hideButtons(target);
	};
	
	object.getRelatedFieldset = function(target) {
		var rel = target.find("a").attr("href").replace("#", "");
		return $('#fieldset-' + rel);
	};
	
	object.hideButtons = function(target) {
		target.hasClass("additional-tab") ? $(".buttons").hide() : $(".buttons").show();
	};
	
	return object;
}(jQuery));

$(document).ready(function(event) {
	Tabs.initialize();
});