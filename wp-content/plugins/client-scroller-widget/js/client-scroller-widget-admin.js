var timeout;
jQuery(function () {
	jQuery('.client-scroller-widget-number-only-input').live('keydown', function (event) {
		// Allow: backspace, delete, tab, escape, and enter
		if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 ||
			// Allow: Ctrl+A
			(event.keyCode == 65 && event.ctrlKey === true) ||
			// Allow: home, end, left, right
			(event.keyCode >= 35 && event.keyCode <= 39)) {
			// let it happen, don't do anything
			return true;
		}
		else {
			// Ensure that it is a number and stop the keypress
			if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
				event.preventDefault();
			}
		}
	});
	var img_url_text_container_id = '';
	var submit_button_id = '';
	jQuery('[id$="slider-images-upload-button"]').live('click',function () {
		submit_button_id = jQuery(this).attr('id');
		img_url_text_container_id = jQuery(this).prev().attr('id');
		tb_show('', 'media-upload.php?TB_iframe=true&');

		var iframe = jQuery('#TB_iframeContent');
		iframe.css('display','none');
		iframe.load(function(){
			var iframeDoc = iframe[0].contentWindow.document;
			var iframeJQuery = iframe[0].contentWindow.jQuery;
			if (iframeJQuery != undefined)
				iframeJQuery('#tab-type_url').remove();

			iframe.css('display','');
			apply_insert_button_filter(iframeJQuery);
		});

		return false;
	});

	window.send_to_editor = function (html) {
		var imgurl = jQuery('img', html).attr('src');
		if (imgurl == undefined)
			imgurl = jQuery(html).attr('src');

		jQuery('#'+img_url_text_container_id).val(imgurl).prop('disabled',false);
		clearTimeout(timeout);
		tb_remove();
		jQuery('#' + submit_button_id).parent().parent().find('input[name=savewidget]').click();
	};


	jQuery('.client-scroller-images-delete-button').live('click',function () {
		var parent_li = jQuery(this).parent();

		parent_li.toggleClass('client-scroller-images-will-be-deleted');
		if (parent_li.hasClass('client-scroller-images-will-be-deleted')){
			parent_li.find('input').prop('disabled',true);
		}else{
			parent_li.find('input').prop('disabled',false);
		}
	});

	jQuery('.client-scroller-images-details-button').live('click', function () {
		var that = jQuery(this);

		if (that.parent().find('.client-scroller-images-details-table').is(':visible')){
			that.parent().find('.client-scroller-images-details-table').fadeOut(300);
			that.parent().animate({height:30, maxHeight:30  },360);
		}else{
			that.parent().animate({height:140, maxHeight:140},360, function () { that.parent().find('.client-scroller-images-details-table').fadeIn(300); });
		}
	});

});

