<?php 
	/**
	Penguin Framework Module - PenguinModuleCustomPostField as Basic Class
	
	Copyright (c) 2012 Activetofocus

	@url http://penguin.activetofocus.com
	@package Penguin
	@version 1.0
**/

class PenguinModuleCustomPostField {
	
	
	public $id = "penguin_custom";

	public $items; // all need add custom files type post
	
	public $fields; // all custom fields name,type  example: array('name'=>'seo','title'=>'Seo','type'=>'input')
	
	public static $SCRIPTS_LOAD = false;
	
	/**
	 *  Create PenguinModuleCustomPost 
	 */
	function PenguinModuleCustomPostField($id = '',$items = array(),$fields = array()){
		if($id != '') $this->id = $id;
		
		$this->items = $items;
		
		$this->fields = $fields;
		
		if(count($items) > 0){
			add_action( 'add_meta_boxes', array($this, 'custom_fields') );
			add_action( 'save_post', array($this,'save_fields' ));
		}
	}
	
	// custom fields
	function custom_fields() {
		
		foreach($this->items as $item){
			$callback = Penguin::check_key_value('callback',$item) == "" ? array($this,'show_fields') : $item['callback'];
			$context  = Penguin::check_key_value('context',$item) == "" ? "advanced" : $item['context'];
			$priority = Penguin::check_key_value('priority',$item) == "" ? "default" : $item['priority'];
			add_meta_box($this->id.'_'.$item['type'], $item['title'], $callback, $item['type'], $context, $priority);
		}
	}
	
	// show fields data 
	function show_fields($post){
		
		$custom = get_post_custom($post->ID);
		
		if(count($this->fields) > 0){
			?>
            <?php if(PenguinModuleCustomPostField::$SCRIPTS_LOAD == false){ 
					PenguinModuleCustomPostField::$SCRIPTS_LOAD = true;
			?>
            <style type="text/css">
				tr.enable-element-hide {display:none !important;};
				tr.enable-element-show {display:table-row;};
				table.custom-table label {cursor:auto}
				table.custom-table,td.custom-input input[type=text],td.custom-input  textarea ,.penguin-preview-image{width:100%;}
				table.custom-table td.custom-input {width:70%;}
				table.custom-table .custom-check {width: 20px;float: left;}
				table.custom-table .longdesc {font-size: 10px;}
				.penguin-preview-image img {max-width:190px;height:auto;}
				.upload-text {min-height:60px; margin-bottom:5px;};
				
			</style>
            <script type="text/javascript">
				jQuery(document).ready(function($) {
					var upload_image_id = '';
				
					jQuery( '.upload-image-button' ).click(function() {
						
						var imgUpload = jQuery(this).parent().find('.upload-image-input');
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
							imgurl = jQuery('img',html).attr('src');
							jQuery( '#'+upload_image_id ).val(imgurl);
							jQuery( '#'+upload_image_id).parent().parent().find('.penguin-preview-image').children("img").attr("src",imgurl).fadeIn();
							upload_image_id = '';
							tb_remove();
						} else {
							window.original_send_to_editor(html);
						}
					}
					
					//enable select change event
					jQuery('.enable-element select').each(function(index, element) {
                        jQuery(element).change(function(e) {
                            checkEnableSelect(this);
                        });
                    });
					
					function checkEnableSelect(element){
						var index = element.selectedIndex;
						var group = jQuery(element).parent().parent().attr('data-group');
						if(group && group != ''){
							var items = String(jQuery(element).parent().parent().attr('data-enable')).split(':');
							jQuery(('.'+group)).removeClass('enable-element-hide');
							jQuery(('.'+group)).removeClass('enable-element-show');
							jQuery(('.'+group)).addClass('enable-element-hide');

							for(var i=0;i<items.length;i++){
								var info = items[i].split('-');
								if(index == parseInt(info[0]) && String(info[1]) != ''){
									jQuery('.'+String(info[1])).removeClass('enable-element-hide');
									jQuery('.'+String(info[1])).addClass('enable-element-show');
								}
							}
						}
					}
					
					jQuery('.enable-element select').each(function(index, element) {
                        checkEnableSelect(this);
                    });
					
					
					// enable template show element
					jQuery('#page_template').change(function(e) {
						checkTemplate(this);
                    });
					
					function checkTemplate(element){
						if($(element).length > 0 && $(element).val().length > 0){
							var str = $(element).val();
							str = str.substr(0,str.length-4);
							$('.template-check').css('display','none');
							$('.'+str).css('display','table-row');
						}
					}
					
					checkTemplate($('#page_template'));
					
                });
			</script>
            <?php }
			$count = 0;
			foreach($this->fields as $field){
				$value = Penguin::check_key_value($field['name'],$custom) == "" ? "" : $custom[$field['name']][0];
				if($value == "" && Penguin::check_key_value('default',$field) != "" ) $value = $field['default'];
				
				$type  = Penguin::check_key_value('type',$field);
				$desc  = Penguin::check_key_value('desc',$field);
				$longdesc  = Penguin::check_key_value('longdesc',$field);
				$newline	= Penguin::check_key_value('newline',$field);
				$input_type = Penguin::check_key_value('input_type',$field);
				
				$enable_element  	= Penguin::check_key_value('enable-element',$field);
				$emable_id			= Penguin::check_key_value('emable-id',$field);
				$enabled_id			= Penguin::check_key_value('enabled-id',$field);
				$enable_group			= Penguin::check_key_value('emable-group',$field);
				$check_template		= Penguin::check_key_value('check-template',$field);
				
				if($count == 0) echo '<table class="custom-table"><tbody>';
				
				$k = 0;
				echo '<tr class="';
				if($check_template != "") echo 'template-check '.$check_template.' ';
				if($enable_element == "yes" && $emable_id != "") echo 'enable-element ';
				if($enabled_id != "" && $enable_group != "") echo $enabled_id.' '.$enable_group;
				echo '"';
				
				if($enable_element == "yes" && $emable_id != "") echo ' data-enable="'.$emable_id.'" data-group="'.$enable_group.'"';
				echo ">";
				
				echo '<td class="custom-title"><label>'.$field['title'].'</label></td><td class="custom-input">';
				switch($type){
					case 'checkbox':
						echo '<label><input class="custom-check" id="'.$field['name'].'-checkbox" name="'.$field['name'].'" type="checkbox" '?><?php checked('on', $value); ?><?php echo ' />'.$field['desc'].'</label>';
						break;
					case 'textarea':
						echo '<textarea id="'.$field['name'].'-textarea" name="'.$field['name'].'" '.(Penguin::check_key_value('textarea_height',$field) != "" ? 'style="height:'.$field['textarea_height'].'px;"' : '').'>'.$value.'</textarea>';
						break;
					case 'upload':
						?>
                        <div style="width:100%;float:left;">
                        	<input id="<?php echo $field['name'] . '-textarea'; ?>" style="width:60%" name="<?php echo $field['name']; ?>" value="<?php echo $value; ?>" class="penguin-input-text upload-image-input" type="text"></input>
                            <input class="penguin-input-button upload-image-button" type="button" value="Upload"></input>
                       	</div>
                        <?php if(Penguin::check_key_value('showthums',$field) == "") : ?>
            			<div class="penguin-preview-image"><img class="penguin-preview-image-img" src="<?php echo $value; ?>" /></div>   
                        <?php endif; ?>     
                        <?php 
						
						break;
					case 'radio':
						foreach($field['radios'] as $radio)
						{
							?>
							<label class="penguin-radio">
								<input type="radio" name="<?php echo $field['name']; ?>" class="penguin-input-radio" value="<?php echo $k; ?>" <?php checked($k, intval($value)); ?>></input><?php echo $radio; ?></label>
							<?php
							if($newline != "" && $newline == "yes") echo '<br />';
							$k++;
						}
						//echo '<textarea id="'.$field['name'].'-textarea" name="'.$field['name'].'">'.$value.'</textarea>';
						break;
					case 'select':
						$value_type = Penguin::check_key_value('value_type',$field);
						echo '<select id="'.$field['name'].'" name="'.$field['name'].'" class="penguin-select" >';
							
							if($field['options'] == 'wp_registered_sidebars'){
								global $wp_registered_sidebars;
								$sidebars = $wp_registered_sidebars;
								$field['options'] = array();
								if(is_array($sidebars) && !empty($sidebars)){
									foreach($sidebars as $sidebar){
										$field['options'][$sidebar['name']] = $sidebar['name'];
									}
								}
							}
							
							foreach($field['options'] as $key => $option)
							{
								if($option == "") continue;
								echo '<option value="'.$key.'" '.(($value == $key || $k ==0 && $value =="") ? ' selected="selected"' : ' ').' >'.$option.' </option>';
								$k++;
							}
							echo '</select>';
						break;
					default:
						echo '<input id="'.$field['name'].'-input" name="'.$field['name'].'" type="'.($input_type != '' ? $input_type : 'text').'" value="'.$value.'" />';
				}
				if($type != 'checkbox' && $desc != '') echo '<br />'.$desc;
				echo '</td></tr>';
				if($longdesc != "") echo '<tr><td><label></label></td><td class="custom-input"><label class="longdesc">'.$longdesc.'</label></td></tr>';
				
				$count++;
				if($count == count($this->fields)) echo '</tbody></table>';
			} 
		}
	}
		
	//save fields data
	function save_fields($post_id) {
		foreach($this->items as $item){
			$slug = $item['type'];
			/* check whether anything should be done */
			$_POST += array("{$slug}_edit_nonce" => '');
			if ( $slug != Penguin::check_key_value('post_type',$_POST) ) {
				continue;
			}
			// check use can edit post
			if ( !current_user_can( 'edit_post', $post_id ) ) {
				continue;
			}
			foreach($this->fields as $field){
				switch($field['type']){
					case 'checkbox':
						$value = $_REQUEST[$field['name']];
						if($value != "on") $value = "off";
						update_post_meta($post_id, $field['name'], $value);
						break;
					default:
						if (isset($_REQUEST[$field['name']])) {
							update_post_meta($post_id, $field['name'], $_REQUEST[$field['name']]);
						}
					
				}
			}
		}
	}
}

?>