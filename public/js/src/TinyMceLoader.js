/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

var TinyMceLoader = (function(){
	var object = {};
	
	object.initialize = function() {
		$('textarea').tinymce({
			// Location of TinyMCE script
			script_url : '/js/tiny_mce/tiny_mce.js',

			// General options
			theme : "advanced",
			plugins: "iespell,nonbreaking",
			gecko_spellcheck : true,
			nonbreaking_force_tab : true,
			height: "220",
			width: "505",

			// Theme options
			theme_advanced_buttons1 : "formatselect,fontsizeselect,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,forecolor,backcolor",
			theme_advanced_buttons2 : "",
			theme_advanced_buttons3 : "",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
		});
	};
	
	return object;
}());

$(document).ready(function() {
	TinyMceLoader.initialize();
});