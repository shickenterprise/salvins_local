<?php

/**
	Penguin Framework
	
	Copyright (c) 2012 Activetofocus

	@url http://penguin.activetofocus.com
	@package Penguin
	@version 1.0
**/

class PenguinOption {
	
	public $menus = array();
	
	/**
	 *
	 * @$option admin option data
	 */
	function PenguinOption($option){
		
		foreach($option as $item)
		{
			$new_item = new PenguinOptionPage($item);
			array_push($this->menus, $new_item );
		}
		
		if (is_admin() && current_user_can('manage_options'))
		{
			add_action( 'admin_menu' , array( $this , 'penguin_admin_menu'));
			add_action( 'admin_init', array($this , 'register_penguin_settings'));
		}
	}
	
	// add menu,sub for option
	function penguin_admin_menu() {
		$hook;
		foreach($this->menus as $menu)
		{
			if($menu->type == "menu")
			{
				$hook = add_menu_page($menu->page_title,
						  $menu->menu_title,
						  $menu->capability,
						  $menu->menu_slug,
						  $menu->fun,
						  $menu->icon_url,
						  $menu->position); 
			}
			else if($menu->type == "submenu")
			{
				/* add submenu page */
				$hook = add_menu_page($menu->parent_slug,
							$menu->page_title,
						  	$menu->menu_title,
						 	$menu->capability,
							$menu->menu_slug,
						  	$menu->fun); 
			}
				
			add_action("admin_print_styles-$hook", array($this, 'on_load_styles'));
		}
	}
	
	// register penguin setting
	function register_penguin_settings() {
		foreach($this->menus as $menu)
		{
			$menu->register_penguin_settings();		
		}
	}
	
	// load page all scripts
	function on_load_styles() {
		
		wp_enqueue_style( 'thickbox' ); 
		wp_enqueue_style( 'colorpick', get_template_directory_uri() . Penguin::$FRAMEWORK_PATH . '/style/colorpicker.css');
		
		wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/fontawesome/css/font-awesome.min.css');
		
		wp_enqueue_style( 'penguin', get_template_directory_uri() . Penguin::$FRAMEWORK_PATH . '/style/penguin.css');
		
		wp_enqueue_script( 'jquery');
		wp_enqueue_script( 'colorpick', get_template_directory_uri() . Penguin::$FRAMEWORK_PATH . '/scripts/colorpicker.js');
		
		wp_enqueue_script( 'thickbox' ); 
		
		wp_enqueue_script( 'penguin', get_template_directory_uri() . Penguin::$FRAMEWORK_PATH . '/scripts/penguin.js');
		
		do_action("penguin_framework_option_scripts");
	}
	
}

class PenguinOptionPage {
	
	public $type; 				// menu type (menu,submenu)
	public $option_name; 		// option name for save data to mysql
	
	public $page_title;			// page title
	public $page_desc;			//page descriptions
	public $page_title_hide;	// show or hide page title , if use "yes" means just show logo
	public $page_logo;			// page logo
	public $page_logo_width;	// page logo width
	public $page_logo_height;	// page logo height max 50;
	public $page_logo_url;	// page logo height max 50;
	
	public $menu_title;
	public $capability;
	public $menu_slug;
	public $fun;
	public $icon_url;
	public $position;
	public $parent_slug;
	
	public $pages_type;	// pages type for show content is custom or default
	public $pages;	// when pages_type == "custom" will include .php files, or  pages as array for show
	public $default_property = array();	// default all property for your option
	public $update_opt;
	public $notifier = '';

	function PenguinOptionPage($page_obj = array()) {
		
		$this->type			= 	$page_obj['type'];
		$this->option_name	= 	$page_obj['option_name'];
		$this->page_desc	=   $page_obj['page_desc'];
		
		$this->page_logo	=   $page_obj['page_logo'];
		$this->page_logo_width	= Penguin::check_key_value('page_logo_width' , $page_obj , "");
		$this->page_logo_height	= Penguin::check_key_value('page_logo_height' , $page_obj , "");
		$this->page_logo_url	= Penguin::check_key_value('page_logo_url' , $page_obj , "");
		
		$this->page_title 	= 	Penguin::check_key_value('page_title' , $page_obj , "Penguin Option");
		$this->page_title_hide	= Penguin::check_key_value('page_title_hide' , $page_obj , "");
		
		$this->menu_title	=	Penguin::check_key_value('menu_title' , $page_obj , "Penguin");
		$this->capability	= 	Penguin::check_key_value('capability' , $page_obj , "manage_options");
		$this->menu_slug	= 	Penguin::check_key_value('menu_slug' , $page_obj , "penguin_options_page");
		$this->fun			= 	Penguin::check_key_value('fun' , $page_obj , array($this , 'show'));
		$this->icon_url		= 	Penguin::check_key_value('icon_url' , $page_obj , "");
		$this->position		= 	Penguin::check_key_value('position' , $page_obj ,'100');
		$this->parent_slug	= 	Penguin::check_key_value('parent_slug' , $page_obj ,'');
		$this->pages_type	= 	Penguin::check_key_value('pages_type' , $page_obj ,'');
		$this->pages		= 	Penguin::check_key_value('pages' , $page_obj ,'');
		$this->notifier		=	Penguin::check_key_value('notifier' , $page_obj ,'');
		$this->update_opt		=	Penguin::check_key_value('update_opt' , $page_obj ,'no');
		
		$this->default_property	=	Penguin::check_key_value('pages_default_property' , $page_obj , array());
		
		$this->addOptionProperty();
	}
	
	// if have no option then create it
	function addOptionProperty()
	{
		$option = get_option($this->option_name);
		if($option == null || is_string($option)){
			add_option($this->option_name,$this->default_property);
			if($this->update_opt == 'yes') add_option($this->option_name.'_update',array('update'=>'no','version'=>0));
		}
	}
	
	// register penguin setting for option submit
	function register_penguin_settings() {

		if($this->menu_slug != null) register_setting( $this->menu_slug, $this->option_name, array($this, 'validate_options'));
	}
	
	// refresh option value
	function validate_options($input) {
		
		if($this->update_opt == 'yes'){
			$options_update_name = $this->option_name.'_update';
			
			$options_update = get_option($options_update_name);
			$update_data;
			if(isset($options_update['update'])){
				$update_data = array('update'=>'no','version'=> $options_update['version'] );
			}else{
				$update_data = array('update'=>'no','version'=>0);
			}
			
			update_option($options_update_name,$update_data);
		}

		if(Penguin::check_key_value('resetting_default',$input) == "yes"){
			$this->default_property['resetting_default'] = "yes";
			return $this->default_property;
		}else if(isset($_POST['import_options']) && $_POST['import_options'] != ""){
			// import options data
			$import_data = json_decode(base64_decode($_POST['import_options']), true);
			if(!is_array($import_data)){
				$import_data = unserialize(base64_decode($_POST['import_options']));
			}
			return $import_data;
		}
		
		return $input;
	}
	
	// start show page
	function show() {
		
		if($this->pages_type == "custom"){
			if($this->pages != "") 
				include($this->pages);
			else
				echo "have no any php file for show";
		} else {
			if($this->pages == null){
				echo "have no any content for this page";
			}else{
				global $penguin_options;
				
				$penguin_options = get_option($this->option_name);
				
				$this->showPageHtml();
			}
		}
		
	}
	
	// show page html code
	function showPageHtml() {
		global $penguin_options;
		?>
        	<style>
				.update-nag { display: none; }
			</style>
			<div id="penguin-container">
                <div id="penguin-header">
                    <div id="penguin-custom-logo">
                        <a title="<?php echo $this->page_title; ?>"
                        <?php echo ($this->page_logo_url != "") ? 'href="'.$this->page_logo_url.'"' : "";?>><img width="<?php echo $this->page_logo_width != '' ? $this->page_logo_width : '100';?> " height="<?php echo $this->page_logo_height != '' ? $this->page_logo_height : '50';?>" src="<?php echo $this->page_logo?>" /></a>
                        <div style="margin-left: <?php echo (intval($this->page_logo_width)+10);?>px;">
                            <h3><?php echo $this->page_title_hide == "yes" ? "" : $this->page_title; ?></h3>
                            <span><?php echo $this->page_desc; ?></span>
                        </div>
                    </div>
                    <div id="penguin-logo">
                        <a title="Penguin Framework" href="http://penguin.activetofocus.com"><i class="icon-cogs"></i></a>
                        <div>
                            <h3><?php _e('Penguin Framework',Penguin::$THEME_NAME); ?></h3>
                            <span><?php echo __('version:',Penguin::$THEME_NAME).' '.Penguin::$FRAMEWORK_VERSION; ?></span>
                        </div>
                    </div>
                </div>
            	<div id="penguin-content">
                	<div class="penguin-tabs">
                       	<ul class="penguin-tabs-nav">
                        	<?php $this->getPageNav(); ?>
                        </ul>
                    <div class="penguin-arrow-icon"></div>
                    <div class="penguin-tabs-container">
            			<form method="post" action="options.php">
						<?php settings_fields( $this->menu_slug ); ?>
                        <?php if(isset($_GET['settings-updated']) && ($_GET['settings-updated'] == 'true')): ?>
                            <div class="penguin-update-tip">
                                <div class="message">
                                    <div class="green-success-message">
                                        <span class="green-success-icon"><?php echo (Penguin::check_key_value('resetting_default',$penguin_options) == "yes") ? __("You had back all setting to default value complete!",Penguin::$THEME_NAME) : __("setting complete!",Penguin::$THEME_NAME); ?></span>
                                    </div>
                                    <a class="message-close-button green-close"></a>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php $this->getPageContent(); ?>
                        <div class="penguin-page-end">
                            <div class="penguin-setting-back">
                                <input id="<?php echo $this->option_name; ?>_resetting_default" name="<?php echo $this->option_name . '[resetting_default]'; ?>" class="penguin-input-checkbox" type="checkbox" value="yes" <?php checked('yes', 'no'); ?> ></input>  
                                <span><?php _e('Reset to default',Penguin::$THEME_NAME); ?></span>
                            </div>
                            <input class="button-primary" type="submit" value="Save Changes"></input>
                            <div class="penguin-setting-tip">
                                <div class="message">
                                    <div class="orange-caution-message">
                                        <span class="orange-caution-icon"><?php _e('Notice: you had select back all setting to default value!',Penguin::$THEME_NAME); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
		<?php
	}
	
	// show page nav menu 
	function getPageNav() {
		foreach( $this->pages as $page ){
			?>
            <li <?php echo ' class="'.Penguin::check_key_value('class',$page).'" '; ?>><a<?php 
				if(array_key_exists('type',$page) &&  $page['type'] == "link"){
					echo ' href="'.$page['pagecontent'].'" target="_blank"';
				}
			 ?>><?php echo $page['name']; ?></a></li>
            <?php
		}
	}
	
	// page content for options pages
	function getPageContent() {
		global $penguin_options;
		foreach( $this->pages as $page ){
			
			?>
            	<div id="<?php echo "section_".$page['section'] ?>" class="penguin-tabs-content <?php 
				echo (Penguin::check_key_value('type',$page) == "custom" || Penguin::check_key_value('type',$page) == "import" || Penguin::check_key_value('type',$page) == "update") ? " penguin-custom-page" : "";?> "> 
                     <h2 class="penguin-page-title"><?php echo $page['title']; ?></h2>
					<?php 
						if(Penguin::check_key_value('type',$page) != ""){
							switch($page['type']){
								case "custom" : 
									if(Penguin::check_key_value('pagecontent',$page) != "") include($page['pagecontent']);
									break;
								case "update" :
									if($this->notifier == "") break;
									
									if( function_exists('simplexml_load_string') && function_exists('file_get_contents') ) :
										$notifier_file_url = $this->notifier;
										$theme_data = wp_get_theme();
										try{
											$cache = file_get_contents($notifier_file_url); // ...if not, use the common file_get_contents()
										}catch(Exception $e){
											
										};
										
										if($cache == ""){ $cache = '<notifier><latest>1.0.0</latest><changelog><![CDATA[<div class="message" style="float: left;width: 100%;margin-bottom: 20px;">
		<div class="orange-caution-message">
			<span class="orange-caution-icon"><h4>Load update history files failure.Please try again or check your net connect.</h4></span>
		</div>
		</div>]]></changelog></notifier>';}
										$xml = simplexml_load_string($cache); 
										?>
										<div class="penguin-page-container">
											<?php if( version_compare($xml->latest, $theme_data['Version'], '>' )) : ?>
                                            	<div class="message" style="float: left;width: 100%;margin-bottom: 20px;">
                                                    <div class="orange-caution-message">
                                                        <span class="orange-caution-icon"><h4>You have version <?php echo $theme_data['Version']; ?> installed. You can update to version <?php echo $xml->latest; ?>.</h4></span>
                                                    </div>
                                                </div>
											<?php endif; ?>
											<?php echo $xml->changelog; ?>
										</div>
										<?php endif;
									break;
								case "import" :
									?>
                                    <div class="penguin-page-container penguin-import-options">
                                        <h4 class="penguin-page-content-title"><?php _e('Import Options',Penguin::$THEME_NAME); ?></h4>
                                        <div>
                                            <textarea rows="10" cols="50" name="import_options"></textarea>
                                            <button class="button-primary"><?php _e('Import',Penguin::$THEME_NAME); ?></button>
                                        </div>
                                        <hr />
                                        <h4 class="penguin-page-content-title"><?php _e('Export Options',Penguin::$THEME_NAME); ?></h4>
                                        <div>
                                            <textarea rows="10" cols="50" readonly="readonly"><?php echo base64_encode(json_encode($penguin_options)) ?></textarea>
                                            <p><?php _e('Paste the export code into the import text area field in your new site option and press "Import" button.',Penguin::$THEME_NAME); ?></p>
                                        </div>
                                    </div>
                                    <?php
									break;
							}
							
						} else {
							foreach( $page['elements'] as $item ){
								?>
									<div class="penguin-page-container">
										
										<h4 class="penguin-page-content-title"><?php echo $item['title']; ?></h4>
										<table class="penguin-table">
										<tbody>
										<?php 
											if($item['type'] == 'moreline' && Penguin::check_key_value('moreline',$item) != ''){
												foreach( $item['moreline'] as $subitem ){
													$this->addItemElement($subitem);
												}
											} else {
												$this->addItemElement($item);
											}
										?>       
										</tbody>
										</table>      
									</div>
								<?php
							}
						}
                    ?>
            </div>
            <?php
		}
	}
	
	// add item for a page
	function addItemElement($item) {
		?>
        	<tr>
            <th><?php echo $item['name'] ?></th>
            <td class="penguin-default">
            <?php
               	echo Penguin::check_key_value('before',$item);
                switch($item['type'])
                {
                    case "upload":
                        $this->addUploadElement($item);
                        break;
                    case "input":
                        $this->addInputText($item);
                        break;
					case "checkbox":
						$this->addCheckbox($item);
						break;
					case "radio":
						$this->addRadio($item);
						break;
					case "textarea":
						$this->addTextArea($item);
						break;
					case "select":
						$this->addSelect($item);
						break;
					case "color":
						$this->addColor($item);
						break;
					case "custom":
						if(Penguin::check_key_value('pagecontent',$item) != "") include($item['pagecontent']);
						break;
                }
                echo Penguin::check_key_value('after',$item);
            ?>
            </td>
        	<?php 
            if(Penguin::check_key_value('desc',$item) != "")
            {
                ?>
                    <td class="penguin-desc">
                        <div class="penguin-page-content-desc"><?php echo Penguin::check_key_value('desc',$item); ?></div>
                    </td>
                <?php
            }
			?>
            </tr>
            <?php
	}
	
	// get current value,if have no will use default value
	function getCurrentValue($item){
		global $penguin_options;
		if(!isset($item['property'])) return "";
		
		// check had save into options
		if( isset($penguin_options[$item['property']]))
			return $penguin_options[$item['property']];
		
		// get config item default value
		if( isset($item['default'])){
			return $item['default'];
		}
		
		// get default property array default value
		if(isset($this->default_property[$item['property']]))
			return $this->default_property[$item['property']];
		
		return "";
	}
	
	// add upload type element
	function addUploadElement($item){
		global $penguin_options;
		?>
            <div style="width:100%;float:left;"><input id="<?php echo $this->option_name . $item['property'] ?>" name="<?php echo $this->option_name . '[' . $item['property'] . ']'; ?>" value="<?php echo $this->getCurrentValue($item); ?>" class="penguin-input-text upload-image-input" type="text"></input>
            <input class="penguin-input-button upload-image-button" type="button" value="Upload"></input></div>
            <?php if(Penguin::check_key_value('show_thums',$item) == "yes") : ?>
            <div class="penguin-preview-image"><img class="penguin-preview-image-img" src="<?php echo $this->getCurrentValue($item); ?>" /></div>       
            <?php endif; ?>  
        <?php
	}
	
	// add text type element
	function addInputText($item){
		global $penguin_options;
		?>
			<input id="<?php echo $this->option_name . $item['property']; ?>" name="<?php echo $this->option_name . '[' . $item['property'] . ']'; ?>" value="<?php echo $this->getCurrentValue($item); ?>" class="penguin-input-text <?php echo (isset($item['input_type']) && $item['input_type'] == 'number') ? " penguin-input-text-number" : ""; ?>" type="<?php echo (isset($item['input_type']) && $item['input_type'] == 'number') ? "number" : "text"; ?>"></input>
		<?php
	}
	
	// add checkbox type element
	function addCheckbox($item){
		global $penguin_options;
		?>
        	<label class="penguin-checkbox-container">
            	<input id="<?php echo $this->option_name . $item['property']; ?>" name="<?php echo $this->option_name . '[' . $item['property'].']'; ?>" class="penguin-input-checkbox" type="checkbox" value="yes" <?php checked('yes', $this->getCurrentValue($item)); ?> ></input>  
                <?php echo $item['checkboxtitle']; ?>
            </label>
        <?php
	}
	
	// add radio type element
	function addRadio($item) {
		global $penguin_options;
		
		$k = 0;
		foreach($item['radios'] as $radio)
		{
			?>
            <label class="penguin-radio">
				<input type="radio" name="<?php echo $this->option_name . '[' . $item['property'] . ']'; ?>" class="penguin-input-radio" value="<?php echo $k; ?>" <?php checked($k, intval($this->getCurrentValue($item))); ?>></input>
				<?php echo $radio; ?>
			</label>
			<?php
			$k++;
		}
		
		
	}
	
	// add textarea element
	function addTextArea($item) {
		global $penguin_options;
		?>
        <textarea class="penguin-textarea" name="<?php echo $this->option_name . '[' . $item['property'] . ']'; ?>" ><?php echo $this->getCurrentValue($item); ?></textarea>
        
        <?php
	}
	
	// add select type element
	function addSelect($item) {
		global $penguin_options;
		
		?>
        	<select id="<?php echo $item['property']; ?>" name="<?php echo $this->option_name . '[' . $item['property'] . ']'; ?>" class="penguin-select" >
        <?php
		
			$k = 0;
			
			if(Penguin::check_key_value('option_array',$item) != ""){
				$array = explode("|",$item['option_array']);
				$item['options'] = array(Penguin::check_key_value('default_option',$item));
				if(count($array) > 0){
					$item['options'] = array_merge($item['options'] ,$array);
				}
			}
			
			foreach($item['options'] as $option)
			{
				if($option == "") continue;
		?>
                <option value="<?php echo $k; ?>" <?php echo intval($this->getCurrentValue($item)) == $k ? " selected='selected'" : " " ?> > <?php echo str_replace("+"," ",$option); ?> </option>
        <?php
				$k++;
			}
			
		?>
        	</select>
        <?php
		
	}
	
	// add color type element
	function addColor($item) {
		global $penguin_options;
		?>
        
		<div class="penguin-colorpicker"><div style="background-color: #<?php echo $this->getCurrentValue($item); ?>"></div></div>
        <input name="<?php echo $this->option_name . '[' . $item['property'] . ']'; ?>" class="penguin-input-color" type="text" maxlength="6" size="6" value="<?php echo $this->getCurrentValue($item); ?>" />
        
        <?php
	}
	
}

?>