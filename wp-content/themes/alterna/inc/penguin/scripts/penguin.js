/**
	Penguin Framework

	Copyright (c) 2012 Activetofocus

	@url http://penguin.activetofocus.com
	@package Penguin
	@version 1.0
**/
jQuery(document).ready(function($) {
    
	/* create penguin object */
	penguin = new Object({
		
		// ---------------------------------------
		//	tabs for penguin framework page
		// ---------------------------------------
		tabs:{
			init:function(params){
				
				// check tabs
				penguin.checkElement(".penguin-tabs",backTabs);
				
				// check tabs back
				function backTabs(params){
					openTabs(params,".penguin-tabs-nav li",".penguin-tabs-content");
				}
				
				// open tabs
				function openTabs(params,pname1,pname2){
					var ot_items = $(params).find(pname1);
					var citems = $(params).find(pname2);
					var ot_s1 = 0;
					var ot_sm = ot_items.length;
					
					$(ot_items).each(function(index, element) {
						// if item is link return;
						if($(element).find("a").attr("href") != null) return false;
						
						$(element).click(function(e) {
							
							if(ot_s1 == $(this).index()) return;
							
							$(citems[ot_s1]).stop(true,true).css("opacity",1);
							
							ot_new = $(this).index();
							
							$(ot_items[ot_s1]).removeClass("current");
							$(ot_items[ot_new]).addClass("current");
							
							$("#penguin_section_page").attr('value',$(citems[ot_new]).attr('id'));
							
							// save section
							penguin.addCookie("penguin_section_page",$(citems[ot_new]).attr('id'),0) ;
							
							// delete resetting status
							$(".penguin-setting-back").find(".penguin-input-checkbox").removeAttr("checked");
							$(".penguin-setting-tip").fadeOut(0);
							
							// hide submit for custom page
							changePageEndStatus(citems,ot_new);
							
							$(params).find(".penguin-arrow-icon").css("top",((ot_new * 40) - ot_new)  + 'px');
							if($(citems[ot_s1]) != null) $(citems[ot_s1]).fadeOut("fast","",runNewTabs);
						});
                    });
					
					function runNewTabs(){
						ot_s1 = ot_new;
						showElement(ot_s1,citems);
					}
					
					var j = -1;
					var cookie = penguin.getCookie("penguin_section_page");
					if(cookie != null && $(".penguin-update-tip").length>0) {
						for(var w=0; w<ot_sm;w++){
							if($(citems[w]).attr("id") == cookie){
								j = w;
								break;
							}
						}
					} else {
						penguin.delCookie("penguin_section_page");
					}
					
					if(j != -1) ot_s1 = j;
					
					for(var k=0; k<ot_sm;k++) {
						if(ot_s1 == k){
							if($(ot_items[k]).hasClass("current") == false) $(ot_items[k]).addClass("current");
							showElement(k,citems,true);
							changePageEndStatus(citems,ot_s1);
						} else {
							if($(ot_items[k]).hasClass("current") == true) $(ot_items[k]).removeClass("current");
							hideElement(k,citems,true);
						}
					}
					
					$(params).find(".penguin-arrow-icon").css("top",((ot_s1 * 40) - ot_s1)  + 'px');
				}
				
				function showElement(k,citems,bool){
					if($(citems[k]) != null) $(citems[k]).fadeIn((bool == true) ? 0 : "fast");
				}
				
				function hideElement(k,citems,bool){
					if($(citems[k]) != null) $(citems[k]).fadeOut((bool == true) ? 0 : "fast");
				}
				
				function changePageEndStatus(citems,ot_new){
					// hide submit for custom page
					if($(citems[ot_new]).hasClass("penguin-custom-page") || $(citems[ot_new]).hasClass("penguin-module-page")) {
						$(".penguin-page-end").fadeOut(0);
					} else {
						$(".penguin-page-end").fadeIn("fast");
					}
				}
				
			}
		}/* end tabs */
		,
		// ---------------------------------------
		//	toggle
		// ---------------------------------------
		toggle:{
			init:function(params){
				
				penguin.checkElement(".toggle",openToggle);
				
				function openToggle(params){
					
					if($(params).find(".toggle-title").hasClass("item-show") == false && $(params).find(".toggle-title").hasClass("item-hide") == false) hideToogle($(params).find(".toggle-title"),true);
					
					$(params).find(".toggle-title").click(function(e) {
						if($(this).hasClass("item-show"))
						{
							hideToogle(this);
						}
						else
						{
							showToogle(this);
						}
                    });
				}
				
				function showToogle(params){
					$(params).removeClass("item-hide");
					$(params).addClass("item-show");
					$(params).parent().find(".toggle-container").slideToggle("fast");
				}
				
				function hideToogle(params,bool){
					$(params).removeClass("item-show");
					$(params).addClass("item-hide");
					if(bool == true)
					{
						$(params).parent().find(".toggle-container").css("display","none");
					}
					else
					{
						$(params).parent().find(".toggle-container").fadeToggle("fast");
					}
				}
			}
		}/* end toggle */
		,
		// ---------------------------------------
		//	Upload your images 
		// ---------------------------------------
		uploadImages:{
			init:function(params){
				
				var upload_image_id = '';
				
				$( '.upload-image-button' ).click(function() {
					
					var imgUpload = $(this).parent().find('.upload-image-input');
					if( imgUpload.length != 0) {
						formfield = imgUpload.attr( 'name' );
						upload_image_id = imgUpload.attr( 'id' );
						tb_show( '', 'media-upload.php?type=image&amp;TB_iframe=true;width=700' );
					}
					return false;
				});
				
				
					// user inserts file into post. only run custom if user started process using the above process
					// window.send_to_editor(html) is how wp would normally handle the received data

				window.original_send_to_editor = window.send_to_editor;
				
				window.send_to_editor = function(html) {
					if(upload_image_id != ''){
						imgurl = $('img',html).attr('src');
						$( '#'+upload_image_id ).val(imgurl);
						$( '#'+upload_image_id).parent().parent().find('.penguin-preview-image').children("img").attr("src",imgurl).fadeIn();
						upload_image_id = '';
						tb_remove();
					} else {
							window.original_send_to_editor(html);
						}
				}
			}
		}
		,
		// ---------------------------------------
		//	ColorPicker
		// ---------------------------------------
		picker:{
			init:function(params){
				
				// check colorpicker
				penguin.checkElement(".penguin-colorpicker",backColorPicker);
				penguin.checkElement(".penguin-input-color",backColorPickerInput);
				
				function backColorPicker(params){
					var citem = params;
					$(citem).ColorPicker({
						color:penguin.RGBToHex($(citem).children("div").css('backgroundColor')),
						onShow: function (colpkr) {
							$(colpkr).fadeIn(500);
							return false;
						},
						onHide: function (colpkr) {
							$(colpkr).fadeOut(500);
							return false;
						},
						onChange: function (hsb, hex, rgb) {
							$(citem).children("div").css('backgroundColor', '#' + hex);
							$(citem).parent().find(".penguin-input-color").attr("value",hex);
						}
					});
				}
				
				function backColorPickerInput(params){
					var citem = params;
					$(citem).ColorPicker({
						onSubmit: function(hsb, hex, rgb, el) {
							$(el).val(hex);
							$(el).ColorPickerHide();
						},
						onBeforeShow: function () {
							$(this).ColorPickerSetColor(this.value);
							}
						})
						.bind('keyup', function(){
							$(this).ColorPickerSetColor(this.value);
							$(citem).parent().find(".penguin-colorpicker").children("div").css('backgroundColor', '#' + this.value);
					});
				}
			}
		},
		// ---------------------------------------
		//	Message
		// ---------------------------------------
		message:{
			init:function(params){
				if($(".penguin-update-tip").find(".message-close-button").length > 0)
				{
					$(".penguin-update-tip").find(".message-close-button").click(function(e) {
                        hideElement();
                    });
					setTimeout(hideElement,4000);
				}
				
				function hideElement(){
					$(".penguin-update-tip").fadeOut("fast");
				}
			}
		},
		backsetting:{
			init:function(params){
				penguin.checkElement(".penguin-setting-back",backSetting);
				
				function backSetting(params){
					var item = params;
					$(params).find(".penguin-input-checkbox").click(function(e) {
                       	if($(this).attr("checked") == "checked")
						{
							$(item).parent().find(".penguin-setting-tip").fadeIn("slow");
						}
						else
						{
							$(item).parent().find(".penguin-setting-tip").fadeOut("slow");
						}
                    });
				}
			}
		},
		// ---------------------------------------
		//	COMMON -----------  check element and ex fun
		// ---------------------------------------
		checkElement:function(params,fun){
			var list = $(params);

			if(list.length <= 0) return false;
			
			for (w=0;w<list.length;w++)
			{
				fun(list[w]);
			}
		}/* end check element */
		,
		// ---------------------------------------
		//	Cookie ----------- save ,delete ,get cookie
		// ---------------------------------------
		addCookie:function(name,value,hours){
			var str = name + "=" + escape(value); 
			if(hours > 0){
				var date = new Date();
				var ms = hours*3600*1000;
				date.setTime(date.getTime() + ms);
				str += "; expires=" + date.toGMTString();
			}
			document.cookie = str;
		},
		getCookie:function(name){
			var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
			if(arr != null) return unescape(arr[2]); 
			return null;
		},
		delCookie:function(name){
			document.cookie = name+"=;expires="+(new Date(0)).toGMTString();
		},
		// ---------------------------------------
		//	RGB -> HEX 
		// ---------------------------------------
		RGBToHex:function(color){ 
			if (color.substr(0, 1) === '#') {
				return color;
			}
			var digits = /(.*?)rgb\((\d+), (\d+), (\d+)\)/.exec(color);
			
			var red = parseInt(digits[2]);
			var green = parseInt(digits[3]);
			var blue = parseInt(digits[4]);
			
			var rgb = blue | (green << 8) | (red << 16);
			return digits[1] + '#' + rgb.toString(16);
		} 
	});/* penguin object */
	
	penguin.tabs.init();
	penguin.toggle.init();
	penguin.uploadImages.init();
	penguin.picker.init();
	penguin.backsetting.init();
	penguin.message.init();

});