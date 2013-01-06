/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

var FormAjax = (function() {
	var object = {};
	
	object.initialize = function() {
		$(".layer-close").live("click", function(event) {
			$("#ajax-result, #ajax-result-mask").hide()
		});
		
		$(".ajax-options a").bind("click", function(event) {
			event.preventDefault();
			_request($(this).attr("href"));			
			$("#ajax-result-mask").show();
		});
		
		$(".layer-container form input[type=submit]").live("click", function(event) {
			event.preventDefault();
			_submit.call(this, arguments);
		});
	};
	
	var _request = function(url) {
		$.ajax({
			'url' : url,
			'success' : function(response) {
				$("#ajax-result").html(response).show()
				
				DatePicker.initialize("#ajax-result");
				TinyMceLoader.initialize();
				JsonAction.initialize("#institution", "id", "#institution_product")
				if ($("#document").length) {
					object.documentAjaxUpload();
				}				
			},
			'complete' : function(XMLHttpRequest, textStatus) {
				var header = XMLHttpRequest.getResponseHeader("ajax-form");
				if (header == "completed") {
					$("#ajax-result, #ajax-result-mask").hide()
					window.location.reload();
				}
			}
		});
	};
	
	object.documentAjaxUpload = function () {
		var form = $("#document").parents("form");
		$("#document").attr("id", "form-file").addClass("none");
		
		$("<div>", {'id': 'document'}).insertAfter("#form-file");
		
		var uploader = new qq.FileUploader({
		    "element": document.getElementById('document'),
		    "action": '/layer/document/upload',
		    "onComplete" : function(index, filename, path) {
		    	$("#form-file").eq(0).val(filename);
		    }
		});
	};
	
	var _submit = function() {
		var form = $(this).parents("form");

		$.ajax({
			'type' : "POST",
			'url' : form.attr("action"),
			'data' : form.serialize(),
			'success' : function(response) {
				$("#ajax-result").html(response).show();
				DatePicker.initialize("#ajax-result");
				if ($("#document").length) {
					object.documentAjaxUpload();
				}	
			},
			'complete' : function(XMLHttpRequest, textStatus) {
				var header = XMLHttpRequest.getResponseHeader("ajax-form");
				if (header == "completed") {
					$("#ajax-result, #ajax-result-mask").hide()
					window.location.reload();
				}
			}
		});
	};
	
	return object;
}());

$(document).ready(function(event) {
	FormAjax.initialize();
});