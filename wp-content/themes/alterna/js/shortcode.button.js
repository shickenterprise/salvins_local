/*! Alterna Theme Shortcode button*/
"use strict";

var alterna_shortcodeUrl = "";
jQuery(document).ready(function($) {
    tinymce.create('tinymce.plugins.alterna', {  
		init : function(ed, url) { 
			alterna_shortcodeUrl = url;
			ed.addButton('alterna', {  
				title : 'Add Alterna Shortcode',  
				image : url+'/../img/shortcode-icon.png',  
				onclick : function() {showAlternaShortcodePanel();}  
			});  
		},  
		createControl : function(n, cm) {  
			return null;  
		},  
	});
	
	tinymce.PluginManager.add('alterna', tinymce.plugins.alterna);  
});

/* Show Alterna Theme Shortcode Panel*/
function showAlternaShortcodePanel(){
	
	if(jQuery("#alterna-shortcode-container").length >= 1){
		if(jQuery("#alterna-shortcode-container").css("display") === "block"){
			jQuery("#alterna-shortcode-container").stop(true,true).fadeOut("fast");
		}else{
			jQuery("#alterna-shortcode-select").attr("value","03");
			jQuery("#alterna-shortcode-container").stop(true,true).fadeIn("fast");
		}
		return;
	}
	
	var postion = jQuery("#content_alterna").offset();
	var html = '<div id="alterna-shortcode-container">';
	html += '<h5 style="margin-top: 0px;margin-bottom: 5px;">Please select shortcode type :</h5><a id="alterna-shortcode-close-btn" style="display:block;width:16px;height:16px;position:absolute;top:5px;right:5px;cursor:pointer;" onclick="hideAlternaShortcodePanel()"></a>';
	html += '<select id="alterna-shortcode-select" style="width: 190px;" value="03">';
	html += '<optgroup label="Complex" >';
				html += '<option value="03">Title</option>';
				html += '<option value="04">Space</option>';
				html += '<option value="05">Button</option>';
				html += '<option value="06">Blockquote</option>';
				html += '<option value="07">Dropcap</option>';
				html += '<option value="08">Icon</option>';
				html += '<option value="09">Bullets</option>';
				html += '<option value="10">Alert Message</option>';
				html += '<option value="11">Accordion</option>';
				html += '<option value="12">Toggle</option>';
				html += '<option value="13">Tabs</option>';
				html += '<option value="14">SideTabs</option>';
				html += '<option value="15">Features</option>';
				html += '<option value="16">Services</option>';
				html += '<option value="17">History</option>';
				html += '<option value="18">Team</option>';
				html += '<option value="19">Call to action</option>';
				html += '<option value="20">Call to action bar</option>';
				html += '<option value="21">Price Table</option>';
				html += '<option value="22">Price Slider</option>';
				html += '<option value="23">Testimonials</option>';
				html += '<option value="24">Map</option>';
				html += '<option value="25">FlexSlider</option>';
				html += '<option value="26">Carousel</option>';
				html += '<option value="27">Social</option>';
				html += '<option value="28">Skills</option>';
				html += '</optgroup>';
				
				html += '<optgroup label="Media" >';
				html += '<option value="31">Youtube</option>';
				html += '<option value="32">Vimeo</option>';
				html += '<option value="33">Soundcloud</option>';
				html += '</optgroup>';
				
				html += '<optgroup label="Module" >';
				html += '<option value="41">Big Blog List</option>';
				html += '<option value="42">Blog List</option>';
				html += '<option value="43">Portflio List</option>';
				html += '</optgroup>';
				
				html += '<optgroup label="Columns" >';
				html += '<option value="51">One</option>';
				html += '<option value="52">One Half</option>';
				html += '<option value="53">One Third</option>';
				html += '<option value="54">Two Third</option>';
				html += '<option value="55">One Fourth</option>';
				html += '<option value="56">Two Fourth</option>';
				html += '<option value="57">Three Fourth</option>';
				html += '</optgroup>';
			html += '</select>';
			html += '<input id="alterna-shortcode-btn" type="button" title="Add shortcode" value="insert" style="float: right;padding: 4px 10px;cursor: pointer;" onclick="alternaShortcodeButtonClick()" />';
			html += '<h6 style="margin-top: 4px;margin-bottom: 0px;font-weight: normal;font-size: 9px;">More details you can <a  title="alterna shortcode help" target="_blank" href="http://support.activetofocus.com/alterna/index.php?p=/categories/shortcode">click here</a> preview or get code!</h6>';
			html += '</div>';
	
	jQuery("body").append(html);
	jQuery("#alterna-shortcode-close-btn").css('background','url("'+alterna_shortcodeUrl+'/../img/close_green.png")');
	jQuery("#alterna-shortcode-container").css({	'display':'block',
												'width':'265px',
												'height':'70px',
												'padding':'5px',
												'border':'1px #BCBCBC solid',
												'border-radius':'5px',
												'background':'#F9F9F9',
												'top':postion.top + 25,
												'left':postion.left,
												'position':'absolute'});
}

/* Hide Alterna Theme Shortcode Panel*/
function hideAlternaShortcodePanel(){
	if(jQuery("#alterna-shortcode-container").css("display") === "block"){
			jQuery("#alterna-shortcode-container").stop(true,true).fadeOut("fast");
	}
}
/* Alterna Button Click*/
function alternaShortcodeButtonClick(){
	var str = "";
	switch(jQuery("#alterna-shortcode-select").attr("value"))
	{
		case "03":
			str = '[title text="Input Text"]';
			break;
		case "04":
			str = '[space line="no"]';
			break;
		case "05":
			str = '[button text="Button Name" type="btn-custom" size="" url="" target="" bg_color="" bg_hover_color="" txt_color="" txt_hover_color=""]';
			break;
		case "06":
			str = '[blockquote] Your Content... [/blockquote]';
			break;
		case "07":
			str = '[dropcap text="A"]';
			break;
		case "08":
			str = '[icon icon_name="icon-camera" icon_size="" icon_style=""]';
			break;
		case "09":
			str = '[bullets]';
			str += '<br>[bullet]Input Content...[/bullet]';
			str += '<br>[bullet]Input Content...[/bullet]';
			str += '<br>[/bullets]';
			break;
		case "10":
			str = '[alert type="success" title="Input Title"]';
			str += '<br>Input Content...';
			str += '<br>[/alert]';
			break;
		case "11":
			str = '[accordion id="accordion_1"]';
			str += '<br>[accordion_item id="accordion_item_1" title="Input Title" open="yes"] Input Item Content... [/accordion_item]';
			str += '<br>[accordion_item id="accordion_item_2" title="Input Title"] Input Item Content... [/accordion_item]';
			str += '<br>[/accordion]';
			break;
		case "12":
			str = '[toggle id="accordion_1" title="Toogle Title" open="yes"]';
			str += '<br>Input Content...';
			str += '[/toggle]';
			break;
		case "13":
			str = '[tabs]';
			str += '<br>[tabs_item title="Tab Title"] Input Item Content... [/tabs_item]';
			str += '<br>[tabs_item title="Tab Title"] Input Item Content... [/tabs_item]';
			str += '<br>[/tabs]';
			break;
		case "14":
			str = '[sidetabs]';
			str += '<br>[sidetabs_item title="SideTab Title"] Input Item Content... [/sidetabs_item]';
			str += '<br>[sidetabs_item title="SideTab Title"] Input Item Content... [/sidetabs_item]';
			str += '<br>[/sidetabs]';
			break;
		case "15":
			str = '[features title="Input Title" src="icon-laptop"] Input Content... [/features]';
			break;
		case "16":
			str = '[services src="icon-laptop"] Input Content... [/services]';
			break;
		case "17":
			str = '[history title="Company Start" day="Dec 12, 2013"] Input Content... [/history]';
			break;
		case "18":
			str = '[team name="Member Name" job="CEO"]';
			str += '<br>[team_content] Input Content [/team_content]';
			str += '<br>[team_social link=""] Social Name [/team_social]';
			str += '<br>[team_social link=""] Social Name [/team_social]';
			str += '<br>[/team]';
			break;
		case "19":
			str = '[call_to_action title="Input Title" desc="Input Content"]';
			break;
		case "20":
			str = '[call_to_action_bar title="Input Title" desc="Input Content"]';
			break;
		case "21":
			str = '[price title="Input Title" price="Price" plan="Plan name"]';
			str += '<br>[price_item] Input Item Content... [/price_item]';
			str += '<br>[price_item] Input Item Content... [/price_item]';
			str += '<br>[/price]';
			break;
		case "22":
			str = '[priceslider]';
			str += '<br>[priceslider_item price="" img=""] Input Item Content... [/priceslider_item]';
			str += '<br>[priceslider_item price="" img=""] Input Item Content... [/priceslider_item]';
			str += '<br>[/priceslider]';
			break;
		case "23":
			str = '[testimonials]';
			str += '<br>[testimonials_item name="user name" job="user job"] Input Content... [/testimonials_item]';
			str += '<br>[testimonials_item name="user name" job="user job"] Input Content... [/testimonials_item]';
			str += '<br>[/testimonials]';
			break;
		case "24":
			str = '[map id="unique map id" latlng="40.880003,-74.010866"] Input Content... [/map]';
			break;
		case "25":
			str = '[flexslider]';
			str += '<br>[flexslider_item type="image or video"] Just type = video , input Video Content... [/flexslider_item]';
			str += '<br>[flexslider_item type="image or video"] Just type = video , input Video Content... [/flexslider_item]';
			str += '<br>[/flexslider]';
			break;
		case "26":
			str = '[carousel id=""]';
			str += '<br>[carousel_item src="image url"] Input Content... [/carousel_item]';
			str += '<br>[carousel_item src="image url"] Input Content... [/carousel_item]';
			str += '<br>[/carousel]';
			break;
		case "27":
			str = '[social bg_color="#ddd" tooltip="no" tooltip_placement="top"]';
			str += '<br>[social_item type="twitter" link="" ]';
			str += '<br>[social_item type="facebook" link="" ]';
			str += '<br>[/social]';
			break;
		case "28":
			str = '[skills]';
			str += '<br>[skill name="Photoshop" percent="60%"]';
			str += '<br>[skill name="PHP" percent="80%"]';
			str += '<br>[/skills]';
			break;
		case "31":
			str = '[youtube id="Enter video ID (eg.6htyfxPkYDU)" width="600" height="360"]';
			break;
		case "32":
			str = '[vimeo id="Enter video ID (eg.54578415)" width="600" height="360"]';
			break;
		case "33":
			str = '[soundcloud url="http://api.soundcloud.com/tracks/38987054" iframe="true"  show_comments="true" auto_play="false" color="ff6699" width="100%" height="166" theme_color="ff6699"]';
			break;
		case "41":
			str = '[blog_bigcontent number="2"]';
			break;
		case "42":
			str = '[blog_list number="4" columns="4" show_style="0" show_type="0" related_slug="" post__not_in="" ]';
			break;
		
		case "43":
			str = '[portfolio_list number="4" columns="4" show_style="0" show_type="0" related_slug="" post__not_in="" ]';
			break;
		case "51":
			str = '[one] Input Content... [/one]';
			break;
		case "52":
			str = '[one_half] Input Content... [/one_half]';
			break;
		case "53":
			str = '[one_third] Input Content... [/one_third]';
			break;
		case "54":
			str = '[two_third] Input Content... [/two_third]';
			break;
		case "55":
			str = '[one_fourth] Input Content... [/one_fourth]';
			break;
		case "56":
			str = '[two_fourth] Input Content... [/two_fourth]';
			break;
		case "57":
			str = '[three_fourth] Input Content... [/three_fourth]';
			break;
	}
	if(window.tinyMCE) {
		window.tinyMCE.execInstanceCommand(window.tinyMCE.activeEditor.id, 'mceInsertContent', false, '<br>'+str+'<br>');
	}
}