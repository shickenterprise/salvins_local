<?php
/**
 * Penguin Framework Config for penguin framework.
 *
 * @package Penguin
 * @version 1.0
 */
	global $google_fonts;
	require_once("penguin/penguin.php");
	$dir = get_template_directory_uri();
	
	/**
	 * Google Web Font
	 * http://www.google.com/webfonts
	 * <link href='http://fonts.googleapis.com/css?family=...'rel='stylesheet' type='text/css'>
	 */
	$google_fonts = 'Abel|Abril+Fatface|Aclonica|Acme|Actor|Adamina|Advent+Pro|Aguafina+Script|Aladin|Aldrich|Alegreya|Alegreya+SC|Alex+Brush|Alfa+Slab+One|Alice|Alike|Alike+Angular|Allan|Allerta|Allerta+Stencil|Allura|Almendra|Almendra+SC|Amarante|Amaranth|Amatic+SC|Amethysta|Andada|Andika|Annie+Use+Your+Telescope|Anonymous+Pro|Antic|Antic+Didone|Antic+Slab|Anton|Arapey|Arbutus|Architects+Daughter|Arimo|Arizonia|Armata|Artifika|Arvo|Asap|Asset|Astloch|Asul|Atomic+Age|Aubrey|Audiowide|Average|Averia+Gruesa+Libre|Averia+Libre|Averia+Sans+Libre|Averia+Serif+Libre|Bad+Script|Balthazar|Bangers|Basic|Baumans|Belgrano|Belleza|Bentham|Berkshire+Swash|Bevan|Bigshot+One|Bilbo|Bilbo+Swash+Caps|Bitter|Black+Ops+One|Bonbon|Boogaloo|Bowlby+One|Bowlby+One+SC|Brawler|Bree+Serif|Bubblegum+Sans|Bubbler+One|Buda:300|Buenard|Butcherman|Butterfly+Kids|Cabin|Cabin+Condensed|Cabin+Sketch|Caesar+Dressing|Cagliostro|Calligraffitti|Cambo|Candal|Cantarell|Cantata+One|Cantora+One|Capriola|Cardo|Carme|Carter+One|Caudex|Cedarville+Cursive|Ceviche+One|Changa+One|Chango|Chau+Philomene+One|Chelsea+Market|Cherry+Cream+Soda|Chewy|Chicle|Chivo|Coda|Coda+Caption:800|Codystar|Comfortaa|Coming+Soon|Concert+One|Condiment|Contrail+One|Convergence|Cookie|Copse|Corben|Courgette|Cousine|Coustard|Covered+By+Your+Grace|Crafty+Girls|Creepster|Crete+Round|Crimson+Text|Crushed|Cuprum|Cutive|Damion|Dancing+Script|Dawning+of+a+New+Day|Days+One|Delius|Delius+Swash+Caps|Delius+Unicase|Della+Respira|Devonshire|Didact+Gothic|Diplomata|Diplomata+SC|Doppio+One|Dorsa|Dosis|Dr+Sugiyama|Droid+Sans|Droid+Sans+Mono|Droid+Serif|Duru+Sans|Dynalight|EB+Garamond|Eagle+Lake|Eater|Economica|Electrolize|Emblema+One|Emilys+Candy|Engagement|Enriqueta|Erica+One|Esteban|Euphoria+Script|Ewert|Exo|Expletus+Sans|Fanwood+Text|Fascinate|Fascinate+Inline|Federant|Federo|Felipa|Fjord+One|Flamenco|Flavors|Fondamento|Fontdiner+Swanky|Forum|Francois+One|Fredericka+the+Great|Fredoka+One|Fresca|Frijole|Fugaz+One|Galdeano|Galindo|Gentium+Basic|Gentium+Book+Basic|Geo|Geostar|Geostar+Fill|Germania+One|Give+You+Glory|Glass+Antiqua|Glegoo|Gloria+Hallelujah|Goblin+One|Gochi+Hand|Gorditas|Goudy+Bookletter+1911|Graduate|Gravitas+One|Great+Vibes|Griffy|Gruppo|Gudea|Habibi|Hammersmith+One|Handlee|Happy+Monkey|Headland+One|Henny+Penny|Herr+Von+Muellerhoff|Holtwood+One+SC|Homemade+Apple|Homenaje|IM+Fell+DW+Pica|IM+Fell+DW+Pica+SC|IM+Fell+Double+Pica|IM+Fell+Double+Pica+SC|IM+Fell+English|IM+Fell+English+SC|IM+Fell+French+Canon|IM+Fell+French+Canon+SC|IM+Fell+Great+Primer|IM+Fell+Great+Primer+SC|Iceberg|Iceland|Imprima|Inconsolata|Inder|Indie+Flower|Inika|Irish+Grover|Istok+Web|Italiana|Italianno|Jacques+Francois|Jacques+Francois+Shadow|Jim+Nightshade|Jockey+One|Jolly+Lodger|Josefin+Sans|Josefin+Slab|Judson|Julee|Junge|Jura|Just+Another+Hand|Just+Me+Again+Down+Here|Kameron|Karla|Kaushan+Script|Kelly+Slab|Kenia|Knewave|Kotta+One|Kranky|Kreon|Kristi|Krona+One|La+Belle+Aurore|Lancelot|Lato:100|League+Script|Leckerli+One|Ledger|Lekton|Lemon|Life+Savers|Lilita+One|Limelight|Linden+Hill|Lobster|Lobster+Two|Londrina+Outline|Londrina+Shadow|Londrina+Sketch|Londrina+Solid|Lora|Love+Ya+Like+A+Sister|Loved+by+the+King|Lovers+Quarrel|Luckiest+Guy|Lusitana|Lustria|Macondo|Macondo+Swash+Caps|Magra|Maiden+Orange|Mako|Marck+Script|Marko+One|Marmelad|Marvel|Mate|Mate+SC|Maven+Pro|McLaren|Meddon|MedievalSharp|Medula+One|Megrim|Meie+Script|Merienda+One|Merriweather|Metal+Mania|Metamorphous|Metrophobic|Michroma|Miltonian|Miltonian+Tattoo|Miniver|Miss+Fajardose|Modern+Antiqua|Molengo|Monofett|Monoton|Monsieur+La+Doulaise|Montaga|Montez|Montserrat|Mountains+of+Christmas|Mr+Bedfort|Mr+Dafoe|Mr+De+Haviland|Mrs+Saint+Delafield|Mrs+Sheppards|Muli|Mystery+Quest|Neucha|Neuton|News+Cycle|Niconne|Nixie+One|Nobile|Norican|Nosifer|Nothing+You+Could+Do|Noticia+Text|Nova+Cut|Nova+Flat|Nova+Mono|Nova+Oval|Nova+Round|Nova+Script|Nova+Slim|Nova+Square|Numans|Nunito|Old+Standard+TT|Oldenburg|Oleo+Script|Open+Sans+Condensed:300|Open+Sans:400,800|Oranienbaum|Orbitron|Oregano|Orienta|Original+Surfer|Oswald|Over+the+Rainbow|Overlock|Overlock+SC|Ovo|Oxygen|Oxygen+Mono|PT+Mono|PT+Sans|PT+Sans+Caption|PT+Sans+Narrow|PT+Serif|PT+Serif+Caption|Pacifico|Parisienne|Passero+One|Passion+One|Patrick+Hand|Patua+One|Paytone+One|Peralta|Permanent+Marker|Petit+Formal+Script|Petrona|Philosopher|Piedra|Pinyon+Script|Plaster|Play|Playball|Playfair+Display|Podkova|Poiret+One|Poller+One|Poly|Pompiere|Pontano+Sans|Port+Lligat+Sans|Port+Lligat+Slab|Prata|Press+Start+2P|Princess+Sofia|Prociono|Prosto+One|Puritan|Quando|Quantico|Quattrocento|Quattrocento+Sans|Questrial|Quicksand|Qwigley|Racing+Sans+One|Radley|Raleway|Raleway+Dots|Rammetto+One|Ranchers|Rancho|Rationale|Redressed|Reenie+Beanie|Revalia|Ribeye|Ribeye+Marrow|Righteous|Rochester|Rock+Salt|Rokkitt|Romanesco|Ropa+Sans|Rosario|Rosarivo|Rouge+Script|Ruda|Ruge+Boogie|Ruluko|Ruslan+Display|Russo+One|Ruthie|Rye|Sail|Salsa|Sancreek|Sansita+One|Sarina|Satisfy|Schoolbell|Seaweed+Script|Sevillana|Shadows+Into+Light|Shadows+Into+Light+Two|Shanti|Share|Shojumaru|Short+Stack|Sigmar+One|Signika|Signika+Negative|Simonetta|Sirin+Stencil|Six+Caps|Skranji|Slackey|Smokum|Smythe|Sniglet:800|Snippet|Sofia|Sonsie+One|Sorts+Mill+Goudy|Source+Sans+Pro|Special+Elite|Spicy+Rice|Spinnaker|Spirax|Squada+One|Stalin+One|Stardos+Stencil|Stint+Ultra+Condensed|Stint+Ultra+Expanded|Stoke|Sue+Ellen+Francisco|Sunshiney|Supermercado+One|Swanky+and+Moo+Moo|Syncopate|Tangerine|Telex|Tenor+Sans|The+Girl+Next+Door|Tienne|Tinos|Titan+One|Trade+Winds|Trocchi|Trochut|Trykker|Tulpen+One|Ubuntu|Ubuntu+Condensed|Ubuntu+Mono|Ultra|Uncial+Antiqua|UnifrakturCook:700|UnifrakturMaguntia|Unkempt|Unlock|Unna|VT323|Varela|Varela+Round|Vast+Shadow|Vibur|Vidaloka|Viga|Voces|Volkhov|Vollkorn|Voltaire|Waiting+for+the+Sunrise|Wallpoet|Walter+Turncoat|Warnes|Wellfleet|Wire+One|Yanone+Kaffeesatz|Yellowtail|Yeseva+One|Yesteryear|Zeyada';
                     
	/**
	 * Option page content
	 */
	$page_content = array(
		/* General Page */
		'general' => array(
			'section' => 'general',
			'name' => __('<i class=" icon-cog"></i>General','alterna'),
			'title' => __('General Setting','alterna'),
			'elements'	=> array(
				'theme_update'		=> array(
						'title' => __('Theme Auto Update Setting','alterna'),
						'type' 	=> 'moreline',
						'moreline'	=> array(
							'enable_auto'	=>	array(
									'name'	=> __('Enable Auto Update','alterna'),
									'type'	=>	'checkbox',
									'checkboxtitle' => __('Check to auto update when have new version.','alterna'),
									'property'	=> 'theme-update-enable'
								),
							'envato_name'		=> array(
									'name'	=> __('ThemeForest Username','alterna'),
									'type'	=>	'input',
									'property'	=> 'theme-name',
								),
							'envato_api'		=> array(
									'name'	=> __('ThemeForest API','alterna'),
									'type'	=>	'input',
									'property'	=> 'theme-api',
									'desc'	=> __('To obtain your API Key, visit your "My Settings" page on any of the Envato Marketplaces.','alterna')
								),
						)
					),
				'favicon'		=> array(
						'name'	=> __('Favicon','alterna'),
						'title'	=> __('Favicon','alterna'),
						'type'	=>	'upload',
						'property'	=> 'favicon',
						'show_thums'	=> 'yes'
					),
				'rss_feed'		=> array(
						'name'	=> __('Feed url','alterna'),
						'title'	=> __('RSS Feed','alterna'),
						'type'	=>	'input',
						'property'	=> 'rss-feed',
					),
				'global'		=> array(
						'title' => __('Global Setting','alterna'),
						'type' 	=> 'moreline',
						'moreline'	=> array(
							'global_responsive'		=> array(
									'name'	=> __('Global Responsive','alterna'),
									'type'	=>	'select',
									'property'	=> 'global-responsive',
									'options'	=> array(0 => 'Responsive', 1 => 'Fixed Width')
								),
							'global_layout'		=> array(
									'name'	=> __('Global Layout','alterna'),
									'type'	=>	'select',
									'property'	=> 'global-layout',
									'options'	=> array(0 => 'Boxed', 1 => 'Full Width')
								),
							'global_sidebar_layout'		=> array(
									'name'	=> __('Global Sidebar Layout','alterna'),
									'type'	=>	'select',
									'property'	=> 'global-sidebar-layout',
									'default'	=> 1,
									'options'	=> array(0 => 'Left Sidebar', 1 => 'Right Sidebar')
								),
							'global_read_more'		=> array(
									'name'	=> __('Read More Text','alterna'),
									'title'	=> __('Read More Text','alterna'),
									'type'	=>	'input',
									'property'	=> 'global-read-more',
								)
						)
					),
				'global_background'		=> array(
						'title' => __('Background Setting','alterna'),
						'type' 	=> 'moreline',
						'moreline'	=> array(
							'global_bg_type'		=> array(
								'name'	=> __('Background Image Type','alterna'),
								'type'	=>	'select',
								'property'	=> 'global-bg-type',
								'default'	=> 0,
								'options'	=> array(0 => 'Pattern', 1 => 'Image', 2 => 'Color'),
							),
							'global_bg_color'		=> array(
								'name'	=> __('Background Color','alterna'),
								'type'	=>	'color',
								'property'	=> 'global-bg-color',
								'desc'	=> __('When background type select "Color" use it.','alterna')
							),
							'global_bg_width'		=> array(
								'name'	=> __('Pattern Image Width','alterna'),
								'type'	=>	'input',
								'input_type' => 'number',
								'property'	=> 'global-bg-pattern-width',
								'desc'	=> __('When background type select "Pattern" use it.','alterna')
							),
							'global_bg_height'		=> array(
								'name'	=> __('Pattern Image Height','alterna'),
								'type'	=>	'input',
								'input_type' => 'number',
								'property'	=> 'global-bg-pattern-height',
								'desc'	=> __('When background type select "Pattern" use it.','alterna')
							),
							'global_bg'		=> array(
								'name'	=> __('Background Image','alterna'),
								'type'	=>	'upload',
								'property'	=> 'global-bg-image',
								'show_thums'	=> 'yes'
							),
							'global_bg_retina'		=> array(
								'name'	=> __('Background Retina Image @2x','alterna'),
								'type'	=>	'upload',
								'property'	=> 'global-bg-retina-image',
								'show_thums'	=> 'yes',
								'desc'	=> __('If you use "Pattern" type then need upload size is 400px * 400px retina support image. ','alterna')
							)
						)
					),
				'seo'		=> array(
						'title' => __('SEO Setting','alterna'),
						'type' 	=> 'moreline',
						'moreline'	=> array(
								'enable_seo'	=>	array(
										'name'	=> __('Enable SEO','alterna'),
										'type'	=>	'checkbox',
										'checkboxtitle' => __('Check to show custom seo','alterna'),
										'property'	=> 'seo-enable'
										),
								'seo_title' => array(
										'name'	=> __('Site Title','alterna'),
										'type'	=>	'input',
										'property'	=> 'seo-title'
									),
								'seo_description' => array(
										'name'	=> __('Site Description','alterna'),
										'type'	=>	'input',
										'property'	=> 'seo-description'
									),
								'seo_keywords' => array(
										'name'	=> __('Site Keywords','alterna'),
										'type'	=>	'textarea',
										'property'	=> 'seo-keywords'
									)
							)
					),
				'google_analytics'		=> array(
						'title'	=> __('Google Analytics','alterna'),
						'type'	=>	'moreline',
						'moreline'	=> array(
								'position' => array(
									'name'	=> __('Script position','alterna'),
									'type' 	=> 'radio',
									'property' => 'google_analytics-position',
									'radios'	=> array(
											'radios_1' => __('Header','alterna'),
											'radios_2' => __('Footer','alterna')
										)
									
									),
								'scripts' => array(
									'name'	=> __('Analytics script','alterna'),
									'type' 	=> 'textarea',
									'property' => 'google_analytics-text',
									'desc'	=> __('Paste your Google Analytics or other tracking code here.','alterna')
									)	
							)
					)
			),
		),
		/* Header */
			'header' => array(
				'section' => 'header',
				'name' => __('<i class="icon-glass"></i>Header','alterna'),
				'title' => __('Header Setting','alterna'),
				'elements'	=> array(
					'logo_custom'	=> array(
						'title' => __('Custom Logo','alterna'),
						'type' 	=> 'moreline',
						'moreline'	=> array(
								'logo_enable_txt'	=> array(
									'name'	=> __('Enable text logo','alterna'),
									'type' 	=> 'checkbox',
									'checkboxtitle' => __('Check to enable text logo','alterna'),
									'property' => 'logo-txt-enable'
								),
								'logo_image'	=> array(
									'name'	=> __('Logo image url','alterna'),
									'type' 	=> 'upload',
									'property' => 'logo-image',
									'show_thums'	=> 'yes'
									),
								'logo_retina_image'	=> array(
									'name'	=> __('Logo retina image @2x','alterna'),
									'type' 	=> 'upload',
									'property' => 'logo-retina-image',
									'show_thums'	=> 'yes',
									'desc'	=> __('You need upload a retina logo @2x default logo size. ','alterna')
									),
								'logo_image_width' => array(
									'name'	=> __('Logo image width','alterna'),
									'type' 	=> 'input',
									'input_type' => 'number',
									'property' => 'logo-image-width',
									'after'	=>	'px',
									),
								'logo_image_height' => array(
									'name'	=> __('Logo image height','alterna'),
									'type' 	=> 'input',
									'input_type' => 'number',
									'property' => 'logo-image-height',
									'after'	=>	'px',
									)
							)
					),
					'fixed_header'	=> array(
						'title' => __('Fixed Header','alterna'),
						'type' 	=> 'moreline',
						'moreline'	=> array(
								'fixed_enable'	=> array(
									'name'	=> __('Enable fixed header','alterna'),
									'type' 	=> 'checkbox',
									'checkboxtitle' => __('Check to enable fixed header','alterna'),
									'property' => 'fixed-enable'
								),
								'fixed_logo_image'	=> array(
									'name'	=> __('Fixed header logo image url','alterna'),
									'type' 	=> 'upload',
									'property' => 'fixed-logo-image',
									'show_thums'	=> 'yes',
									'desc'	=> __('It\'s important logo when scroll window show fixed header! Logo height fixed 44px.','alterna')
									),
								'fixed_logo_retina_image'	=> array(
									'name'	=> __('Fixed header logo retina image @2x','alterna'),
									'type' 	=> 'upload',
									'property' => 'fixed-logo-retina-image',
									'show_thums'	=> 'yes',
									'desc'	=> __('You need upload a retina support logo @2x default logo.','alterna')
									),
								'fixed_logo_image_width' => array(
									'name'	=> __('Fixed header logo image width','alterna'),
									'type' 	=> 'input',
									'input_type' => 'number',
									'property' => 'fixed-logo-image-width',
									'after'	=>	'px',
									)
							)
					),
					'social_right_area'	=> array(
						'title' => __('Header Right Area Setting','alterna'),
						'type' 	=> 'moreline',
						'moreline'	=> array(
							'area_type'		=> array(
								'name'	=> __('Header Right Area Show Type','alterna'),
								'type'	=>	'select',
								'property'	=> 'header-right-area-type',
								'default'	=> 0,
								'options'	=> array(0 => 'Social', 1 => 'Custom Content'),
								'desc'	=> __('If you want to custom content for right area, please choose "Custom". ','alterna')
							),
							'area_custom_content'	=> array(
								'name'	=> __('Header Right Area Content','alterna'),
								'type'	=>	'textarea',
								'property'	=> 'header-right-area-content',
								'desc'	=> __('Support HTML CODE for your custom content!','alterna')
							),
						)
					),
					'social_custom'	=> array(
						'title' => __('Header Social Setting','alterna'),
						'type' 	=> 'moreline',
						'moreline'	=> array(
								'header_social_padding_left' => array(
									'name'	=> __('Header Social padding from Left','alterna'),
									'type' 	=> 'input',
									'input_type' => 'number',
									'property' => 'header-social-padding-left',
									'after'	=>	'px',
									),
								'header_social_padding_top' => array(
									'name'	=> __('Header Social padding from Top','alterna'),
									'type' 	=> 'input',
									'input_type' => 'number',
									'property' => 'header-social-padding-top',
									'after'	=>	'px',
									)
								
							)
					),
					'header_alert_message'		=> array(
						'name'	=> __('Header Alert Message','alterna'),
						'title'	=> __('Header Alert Message','alterna'),
						'type'	=>	'textarea',
						'property'	=> 'header-alert-message'
					),
					'header_login_tools'	=> array(
						'title' => __('Header Login Tools Setting','alterna'),
						'type' 	=> 'moreline',
						'moreline'	=> array(
							'login_enable'		=> array(
								'name'	=> __('Enable login tools','alterna'),
								'type' 	=> 'checkbox',
								'checkboxtitle' => __('Check to enable show login tools','alterna'),
								'property' => 'custom-enable-login',
								'desc'	=> __('Just when not use woocommerce,then will run.','alterna')
							),
							'login_page'	=> array(
								'name'	=> __('Login Tools Turn Page Url','alterna'),
								'type'	=>	'input',
								'property'	=> 'custom-login-page',
								'desc'	=> __('Click login tools turn to which page (Which had used "Login Template" )!','alterna')
							),
						)
					),
				)
			),
		/* Footer */
			'footer' => array(
				'section' => 'footer',
				'name' => __('<i class="icon-coffee"></i>Footer','alterna'),
				'title' => __('Footer Setting','alterna'),
				'elements'	=> array(
					/*'footer_bg'		=> array(
								'name'	=> __('Background Image','alterna'),
								'title'	=> __('Background Image For Footer','alterna'),
								'type'	=>	'upload',
								'property'	=> 'footer-bg-image',
								'show_thums'	=> 'yes'
							),*/
					'footer_copyright_message'		=> array(
						'name'	=> __('Footer Copyright Setting','alterna'),
						'title'	=> __('Copyright Text','alterna'),
						'type'	=>	'textarea',
						'property'	=> 'footer-copyright-message',
					),
					'footer_link'		=> array(
						'name'	=> __('Footer Link Setting','alterna'),
						'title'	=> __('Link Text','alterna'),
						'type'	=>	'textarea',
						'property'	=> 'footer-link-text',
					),
				)
			),
		/* Font Setting Page */
		'font' => array(
			'section' => 'font',
			'name' => __('<i class="icon-font"></i>Font','alterna'),
			'title' => __('Font Setting','alterna'),
			'elements'	=> array(
					'font_enable'		=> array(
						'title'	=> __('Enable Font Setting','alterna'),
						'name'	=> __('Enable custom font','alterna'),
						'type' 	=> 'checkbox',
						'checkboxtitle' => __('Check to enable custom font','alterna'),
						'property' => 'custom-enable-font',
						'desc'	=> __('Just when enable custom font,then all choose font will run.','alterna')
						),
					'font_setting'	=> array(
						'title'	=> __('Theme Font Setting','alterna'),
						'type'	=>	'moreline',
						'moreline'	=> array(
								'general_font' => array(
									'name'	=> __('General Font','alterna'),
									'type' 	=> 'select',
									'property' => 'custom-general-font',
									'default_option'	=> 'Default: Source Sans Pro',
									'option_array'	=> $google_fonts,
									'desc' => __('Now have 530+ Google web font for u choose!<Br />Font sylte preview : http://google.com/webfonts','alterna')
									),
								'general_font_size' => array(
									'name'	=> '',
									'type' 	=> 'input',
									'input_type'	=> 'number',
									'property' => 'custom-general-font-size',
									'after'	=>	'px'
									),
								'top_nav_font' => array(
									'name'	=> __('Header Menu Font','alterna'),
									'type' 	=> 'select',
									'property' => 'custom-menu-font',
									'default_option'	=> 'Default: Oswald',
									'option_array'	=> $google_fonts
									),
								'top_nav_font_size' => array(
									'name'	=> '',
									'type' 	=> 'input',
									'input_type'	=> 'number',
									'property' => 'custom-menu-font-size',
									'after'	=>	'px'
									),
								'title_font' => array(
									'name'	=> __('Title (h1-h6) Font','alterna'),
									'type' 	=> 'select',
									'property' => 'custom-title-font',
									'default_option'	=> 'Default: Open Sans',
									'option_array'	=> $google_fonts
									)
							)
					),
				)
			),
		/* Color Setting Page */
		'color' => array(
			'section' => 'color',
			'name' => __('<i class=" icon-adjust"></i>Color','alterna'),
			'title' => __('Color Setting','alterna'),
			'elements'	=> array(
					'emable_colors'		=> array(
						'title'	=> __('Enable Color Setting','alterna'),
						'name'	=> __('Enable custom color','alterna'),
						'type' 	=> 'checkbox',
						'checkboxtitle' => __('Check to enable custom color','alterna'),
						'property' => 'custom-enable-color',
						'desc'	=> __('Just when enable custom color,then all choose color will run.','alterna')
						),
					'theme_color'		=> array(
						'title'	=> __('Theme Colors Setting','alterna'),
						'type'	=>	'moreline',
						'moreline'	=> array(
								'theme_color' => array(
									'name'	=> __('Theme Color','alterna'),
									'type' 	=> 'color',
									'property' => 'theme-color',
									'desc'	=> 'Theme color'
									),
								'theme_over_color' => array(
									'name'	=> __('Theme Over Color','alterna'),
									'type' 	=> 'color',
									'property' => 'theme-over-color',
									'desc'	=> 'Theme over color for element mouse hover status'
									),
								'general_text_color' => array(
									'name'	=> __('General Text Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-general-color',
									'desc'	=> __('General default text color for div,p,span,a color','alterna')
									),
								'a_color' => array(
									'name'	=> __('A default color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-a-color',
									'desc'	=> __('<a> defalut color','alterna')
									),
								'h_color' => array(
									'name'	=> __('Title default color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-h-color',
									'desc'	=> __('h1,h2,h3,h4,h5,h6 defalut color','alterna')
									),
							),
							
						),
						'theme_header_color'		=> array(
								'title'	=> __('Header Area Colors Setting','alterna'),
								'type'	=>	'moreline',
								'moreline'	=> array(
										'top_menu_bg_color' => array(
											'name'	=> __('Header Menu Background Color','alterna'),
											'type' 	=> 'color',
											'property' => 'custom-menu-background-color',
											'desc'	=> __('Header menu background color','alterna')
											),
										'top_sub_menu_bg_color' => array(
											'name'	=> __('Header Sub Menu Background Color','alterna'),
											'type' 	=> 'color',
											'property' => 'custom-sub-menu-background-color',
											'desc'	=> __('Header sub menu background color','alterna')
											),
										'top_sub_hover_menu_bg_color' => array(
											'name'	=> __('Header Sub Menu Hover Background Color','alterna'),
											'type' 	=> 'color',
											'property' => 'custom-sub-menu-hover-background-color',
											'desc'	=> __('Header sub menu hover background color','alterna')
											),
									)
							),
							
						'theme_footer_color'		=> array(
								'title'	=> __('Footer Area Colors Setting','alterna'),
								'type'	=>	'moreline',
								'moreline'	=> array(
										'footer_txt_color' => array(
											'name'	=> __('Footer Area Text Default Color','alterna'),
											'type' 	=> 'color',
											'property' => 'custom-footer-text-color',
											'desc'	=> __('Footer area text default color','alterna')
											),
										'footer_a_color' => array(
											'name'	=> __('Footer Area A Color','alterna'),
											'type' 	=> 'color',
											'property' => 'custom-footer-a-color',
											'desc'	=> __('Footer area <a> text color','alterna')
											),
										'footer_h_color' => array(
											'name'	=> __('Footer Title Default Color','alterna'),
											'type' 	=> 'color',
											'property' => 'custom-footer-h-color',
											'desc'	=> __('h1,h2,h3,h4,h5,h6 footer area title text color ','alterna')
											),
										'footer_bg_color' => array(
											'name'	=> __('Footer Area Background Color','alterna'),
											'type' 	=> 'color',
											'property' => 'custom-footer-bg-color',
											'desc'	=> __('Footer area background color','alterna')
											),
										'footer_copyright_a_color' => array(
											'name'	=> __('Footer Copyright Area A Color','alterna'),
											'type' 	=> 'color',
											'property' => 'custom-footer-copyright-a-color',
											'desc'	=> __('Footer copyright area a color','alterna')
											),
										'footer_copyright__a_hover_color' => array(
											'name'	=> __('Footer Copyright Area A Hover Color','alterna'),
											'type' 	=> 'color',
											'property' => 'custom-footer-copyright-a-hover-color',
											'desc'	=> __('Footer copyright area a hover color','alterna')
											),
										'footer_copyright_color' => array(
											'name'	=> __('Footer Copyright Area Background Color','alterna'),
											'type' 	=> 'color',
											'property' => 'custom-footer-copyright-color',
											'desc'	=> __('Footer copyright area background color','alterna')
											)
									)
							)
						
				)
			),
			/* Enbale Css */
		'css' => array(
			'section' => 'css',
			'name' => __('<i class="icon-magic"></i>CSS','alterna'),
			'title' => __('Custom Css Setting','alterna'),
			'elements'	=> array(
			'enable_custom_css'		=> array(
						'title'	=> __('Enable Custom CSS','alterna'),
						'type'	=>	'moreline',
						'moreline'	=> array(
								'emable_css' => array(
									'name'	=> __('Enable Custom CSS','alterna'),
									'type' 	=> 'checkbox',
									'checkboxtitle' 	=> __('Check here enable custom css for theme','alterna'),
									'property' => 'custom-enable-css',
									),
								'custom_css' => array(
									'name'	=> __('Custom CSS','alterna'),
									'type' 	=> 'textarea',
									'property' => 'custom-css-content',
									'desc'	=>	__('Please enter css format content as your custom css','alterna')
									)
							)
						)
					)
			),
		/* Enbale Scripts */
		'scripts' => array(
			'section' => 'scripts',
			'name' => __('<i class=" icon-beaker"></i>Scripts','alterna'),
			'title' => __('Custom Scripts Setting','alterna'),
			'elements'	=> array(
			'enable_custom_scripts'		=> array(
						'title'	=> __('Enable Custom Scripts','alterna'),
						'type'	=>	'moreline',
						'moreline'	=> array(
								'emable_scripts' => array(
									'name'	=> __('Enable Custom Scripts','alterna'),
									'type' 	=> 'checkbox',
									'checkboxtitle' 	=> __('Check here enable custom scripts for theme','alterna'),
									'property' => 'custom-enable-scripts',
									),
								'custom_scripts' => array(
									'name'	=> __('Custom Scripts','alterna'),
									'type' 	=> 'textarea',
									'property' => 'custom-scripts-content',
									'desc'	=>	__('Please enter scripts format content as your custom scripts','alterna')
									)
							)
						)
					)
			),
		/* Blog Page */
			'blog' => array(
				'section' => 'blog',
				'name' => __('<i class=" icon-bolt"></i>Blog','alterna'),
				'title' => __('Blog','alterna'),
				'elements'	=> array(
						
						'blog_enable_author' => array(
										'name'	=> __('Enable author','alterna'),
										'title'	=> __('Author Information Setting','alterna'),
										'type'	=>	'checkbox',
										'checkboxtitle' => __('Check to enable show author information','alterna'),
										'property'	=> 'blog-enable-author'
						),
						
						'blog_enable_share' => array(
									'title'	=> __('Post Share Setting','alterna'),
											'type'	=>	'moreline',
											'moreline'	=> array(
															'enable_share' => array(
																	'name'	=> __('Share style type','alterna'),
																	'type' 	=> 'select',
																	'options'	=> array(
																			0 => __('No share','alterna'),
																			1 => __('AddThis share','alterna'),
																			2 => __('Custom share use code','alterna')
																		),
																	'desc'	=> __('Default style for single page share!','alterna'),
																	'property' => 'blog-share-type',
																	),
															'custom_share' => array(
																	'name'	=> __('Custom share code','alterna'),
																	'type' 	=> 'textarea',
																	'property' => 'blog-share-code',
																	'desc'	=> __('You can copy your share plugin code into here when you choose "<h6>Custom share use code</h6>"','alterna')
																	)
																)
												),
						)
			),
		/* Portfolio Page */
			'portfolio' => array(
				'section' => 'portfolio',
				'name' => __('<i class="icon-th-large"></i>Portfolio','alterna'),
				'title' => __('Portfolio','alterna'),
				'elements'	=> array(
						'portfolio_page'	=> array(
											'title'	=> __('Default Portfolio Page','alterna'),
											'name'	=> __('Default Portfolio Page','alterna'),
											'type' 	=> 'select',
											'property' => 'portfolio-default-page',
											'desc'	=> __('Default portfolio page for category default show style.','alterna'),
											'options'	=> alterna_get_all_portfolio_type_pages()
										),
						'portfolio_enable_share' => array(
									'title'	=> __('Portfolio Share Setting','alterna'),
											'type'	=>	'moreline',
											'moreline'	=> array(
															'enable_share' => array(
																	'name'	=> __('Share style type','alterna'),
																	'type' 	=> 'select',
																	'options'	=> array(
																			0 => __('No share','alterna'),
																			1 => __('AddThis share','alterna'),
																			2 => __('Custom share use code','alterna')
																		),
																	'desc'	=> __('Default style for single portfolio page share!','alterna'),
																	'property' => 'portfolio-share-type',
																	),
															'custom_share' => array(
																	'name'	=> __('Custom share code','alterna'),
																	'type' 	=> 'textarea',
																	'property' => 'portfolio-share-code',
																	'desc'	=> __('You can copy your share plugin code into here when you choose "<h6>Custom share use code</h6>"','alterna')
																	)
																)
												)
					)
			),
		/* Social */
			'social' => array(
				'section' => 'social',
				'name' => __('<i class="icon-twitter"></i>Socials','alterna'),
				'title' => __('Socials','alterna'),
				'elements'	=> array(
					'social'	=> array(
						'title'	=> __('Social Links with http://','alterna'),
						'type'	=>	'moreline',
						'moreline'	=> array(
								'social_twitter'	=> array(
										'name'	=> __('Twitter','alterna'),
										'type' 	=> 'input',
										'property' => 'social-twitter'
									),
								'social_facebook'	=> array(
										'name'	=> __('Facebook','alterna'),
										'type' 	=> 'input',
										'property' => 'social-facebook'
									),
								'social_google_plus'	=> array(
										'name'	=> __('Google Plus','alterna'),
										'type' 	=> 'input',
										'property' => 'social-google-plus'
									),
								'social_dribbble'	=> array(
										'name'	=> __('Dribbble','alterna'),
										'type' 	=> 'input',
										'property' => 'social-dribbble'
									),
								'social_pinterest'	=> array(
										'name'	=> __('Pinterest','alterna'),
										'type' 	=> 'input',
										'property' => 'social-pinterest'
									),
								'social_flickr'	=> array(
										'name'	=> __('Flickr','alterna'),
										'type' 	=> 'input',
										'property' => 'social-flickr'
									),
								'social_skype'	=> array(
										'name'	=> __('Skype','alterna'),
										'type' 	=> 'input',
										'property' => 'social-skype'
									),
								'social_youtube'	=> array(
										'name'	=> __('Youtube','alterna'),
										'type' 	=> 'input',
										'property' => 'social-youtube'
									),
								'social_vimeo'	=> array(
										'name'	=> __('Vimeo','alterna'),
										'type' 	=> 'input',
										'property' => 'social-vimeo'
									),
								'social_linkedin'	=> array(
										'name'	=> __('Linkedin','alterna'),
										'type' 	=> 'input',
										'property' => 'social-linkedin'
									),
								'social_digg'	=> array(
										'name'	=> __('Digg','alterna'),
										'type' 	=> 'input',
										'property' => 'social-digg'
									),
								'social_deviantart'	=> array(
										'name'	=> __('Deviantart','alterna'),
										'type' 	=> 'input',
										'property' => 'social-deviantart'
									),
								'social_behance'	=> array(
										'name'	=> __('Behance','alterna'),
										'type' 	=> 'input',
										'property' => 'social-behance'
									),
								'social_forrst'	=> array(
										'name'	=> __('Forrst','alterna'),
										'type' 	=> 'input',
										'property' => 'social-forrst'
									),
								'social_lastfm'	=> array(
										'name'	=> __('Lastfm','alterna'),
										'type' 	=> 'input',
										'property' => 'social-lastfm'
									),
								'social_xing'	=> array(
										'name'	=> __('XING','alterna'),
										'type' 	=> 'input',
										'property' => 'social-xing'
									),
								'social_instagram'	=> array(
										'name'	=> __('Instagram','alterna'),
										'type' 	=> 'input',
										'property' => 'social-instagram'
									),
								'social_stumbleupon'	=> array(
										'name'	=> __('StumbleUpon','alterna'),
										'type' 	=> 'input',
										'property' => 'social-stumbleupon'
									),
								'social_picasa'	=> array(
										'name'	=> __('Picasa','alterna'),
										'type' 	=> 'input',
										'property' => 'social-picasa'
									)
							)
					)
				)
			),
		/* Update Information */
		'update' => array(
				'section' => 'update',
				'name' => __('<i class="icon-bullhorn"></i>Update Log','alterna'),
				'title' => __('Update History','alterna'),
				'type'	=> 'update'
				),
		/* Update Information */
		'import' => array(
				'section' => 'import',
				'name' => __('<i class="icon-wrench"></i>Import/Export','alterna') ,
				'title' => __('Import/Export Options', 'alterna'),
				'type'	=> 'import'
				),
		/* Support Link */
		'get_support' => array(
			'section' => 'get_support',
			'name' => __('<i class="icon-question-sign"></i>Get Support','alterna'),
			'title' => 'link',
			'type'	=> 'link',
			'class'	=>	'light',
			'pagecontent'	=> 'http://support.activetofocus.com/alterna/'
		)
	);
	
	/**
	 * Option Default Value
	 */
	$page_default_property = array(
		
		'theme-update-enable' => 'no',
		'theme-name'		=>	'',
		'theme-api'			=>	'',
		'favicon'			=>	$dir.'/img/favicon.png',
		'rss-feed'			=>	"",
		
		'global-responsive' => 0,
		'global-layout'		=>	0,
		'global-sidebar-layout'	=>	1,
		'global-bg-type'	=> 0,
		'global-bg-color'	=> '5a5a5a',
		'global-bg-pattern-width' => 200,
		'global-bg-pattern-height' => 200,
		'global-bg-image'	=>	$dir.'/img/wild_oliva.png',
		'global-bg-retina-image'	=>	$dir.'/img/wild_oliva@2x.png',
		'global-read-more'	=>	'Read More &raquo;',
		
		'seo-enable'		=>	"no",
		'seo-title'			=>	"",
		'seo-description'	=>	"",
		'seo-keywords'		=>	"",
		
		'google_analytics-position'	=> 	"0",
		'google_analytics-text'		=>	"",
		
		//header
		'logo-txt-enable' 	=> 	"",
		'logo-image'		=> 	$dir.'/img/logo.png',
		'logo-retina-image'		=> 	$dir.'/img/logo@2x.png',
		'logo-image-width'	=> 	227,
		'logo-image-height'	=>	60,
		
		'fixed-enable'				=>	"",
		'fixed-logo-image'			=> 	$dir.'/img/fixed-logo.png',
		'fixed-logo-retina-image'	=> 	$dir.'/img/fixed-logo@2x.png',
		'fixed-logo-image-width'	=> 	44,
		
		'header-social-padding-left' => 0,
		'header-social-padding-top' => 14,
		'header-alert-message'		=>	'',
		'custom-enable-login'		=> '',
		'custom-login-page'			=> '',
		
		//footer
		'footer-bg-image'			=>	'',
		'footer-copyright-message'	=> 'Copyright ® 2013 <a href="http://themeforest.net/user/activetofocus">ActiveToFocus</a>. All rights reserved.',
		'footer-link-text'	=> 'Powered by WordPress.',
		
		//font
		'custom-enable-font'		=>	"no",
		'custom-general-font'		=>	"0",
		'custom-general-font-size'	=>	"14",
		'custom-menu-font'			=>	"0",
		'custom-menu-font-size'		=>	"13",
		'custom-title-font'			=>	"0",
				
		//color
		'custom-color-enable'				=>	"no",
		'theme-color'						=>	'7AB80E',
		'theme-over-color'					=>	'5b8f00',
		'custom-general-color'				=>	'666666',
		'custom-a-color'					=>	'1c1c1c',
		'custom-h-color'					=>	'3a3a3a',
		
		'custom-menu-background-color'		=>	'0C0C0C',
		'custom-sub-menu-background-color'	=>	'7AB80E',
		'custom-sub-menu-hover-background-color' =>	'0c0c0c',
		
		'custom-footer-text-color'			=>	'999999',
		'custom-footer-a-color'				=>	'e7e7e7',
		'custom-footer-h-color'				=>	'ffffff',
		'custom-footer-bg-color'			=>	'404040',
		'custom-footer-copyright-color'     =>	'0C0C0C',
		'custom-footer-copyright-a-color' 	=> '606060',
		'custom-footer-copyright-a-hover-color' => '7AB80E',
		
		//css
		'custom-enable-css'			=>	'no',
		'custom-css-content'		=>	'',
		
		//scripts
		'custom-enable-scripts'			=>	'no',
		'custom-scripts-content'		=>	'',
		
		//blog
		'blog-enable-author'	=> 	"no",
		'blog-share-type'		=>	"0",
		'blog-share-code'		=>	"",
		
		//portfolio 
		'portfolio-default-page'	=> "",
		'portfolio-share-type'		=>	"",
		'portfolio-share-code'		=>	"",
		
		//social 
		'social-twitter'	=> "" ,
		'social-facebook'	=> "" ,
		'social-google-plus'=>	"" ,
		'social-pinterest'	=>	"",
		'social-github'		=>	"",
		'social-linkedin'	=>	"",
		'social-dribbble'	=>	"",
		'social-flickr'		=>	"",
		'social-skype'		=>	"",
		'social-vimeo'		=>	"",
		'social-digg'		=>	"",
		'social-deviantart'	=>	"",
		'social-behance'	=>	"",
		'social-forrst'		=>	"",
		'social-lastfm'		=>	"",
		'social-xing'		=>	"",
		'social-instagram'		=>	"",
		'social-stumbleupon'		=>	"",
		'social-picasa'		=>	""								
	);
	
	/**
	 * Option Config
	 */
	$optionConfig = array(
		/* type -> menu,submenu */
		/* page_title,menu_title,capability,menu_slug,function,icon_url,position from 100 */
		'menu'	=> array(
				'type'			=> 'menu',
				'option_name' 	=> 'alterna_options',
				'page_desc'		=> __('Welcome to setting alterna theme style!','alterna'),
				'page_logo'		=>	get_template_directory_uri().'/img/penguin_logo.png',
				'page_logo_width'	=> '56',
				'page_logo_height'	=> '50',
				'page_logo_url'		=> 'http://themes.activetofocus.com/alterna/',
				'page_title' 	=> __('Alterna Option','alterna'),
				'page_title_hide' => 'no',
				'menu_title' 	=> __('Alterna Options','alterna'),
				'capability' 	=> 'manage_options',
				'menu_slug'	 	=> 'alterna_options_page',
				'icon_url'		=> get_template_directory_uri().'/img/alterna-icon.png',
				'pages'		 	=> $page_content,
				'pages_default_property'	=> $page_default_property,
				'position'		=> 99,
				'notifier'		=> "http://support.activetofocus.com/alterna/notifier.xml",
				'update_opt'		=> "yes"
			)
	);
	
	// custom post 
	$custom_posts = array(
			'portfolio'	=> true,
		);

	// custom post field
	$custom_fields = array(
			'thumbnails'	=> array( 	'post' => array( 'title' => __('Post Thumbnail','alterna'),
												'type'	=> 'post',
											),
										'portfolio' => array( 'title' => __('Portfolio Thumbnail','alterna'),
												'type'	=> 'portfolio',
											)
							),
			'seo'	=> array( 	'post' => array( 'title' => __('Custom SEO Field','alterna'),
												'type'	=> 'post'
											),
								'page' => array( 'title' => __('Custom SEO Field','alterna'),
												'type'	=> 'page'
											),
								'portfolio' => array( 'title' => __('Custom SEO Field','alterna'),
												'type'	=> 'portfolio'
											)
							),
			'customfield'	=> array( 'post_setting' => array( 	'id' => 'post-custom',
												'items'		=> array(	array(	'title' => __('Post Option Setting','alterna'),
																				'type'	=>	'post',
																				'priority'	=> 'high'
																			)
																	),
												'fields'	=> array(	array(	'name' 	=> 'layout-type',
																				'title'	=> __('Layout Type','alterna'),
																				'type'	=>	'select',
																				'options' => array('Use Global','Full Width','Left Sidebar','Right Sidebar')
																			),
																		array(	'name' 	=> 'sidebar-type',
																				'title'	=> __('Sidebar','alterna'),
																				'type'	=>	'select',
																				'options' => 'wp_registered_sidebars'
																			),
																		array(	'name' 	=> 'title-show',
																				'title'	=> __('Page Title','alterna'),
																				'type'	=>	'select',
																				'options' => array('show','hide')
																			),
																		array(	'name' 	=> 'title-content',
																				'title'	=> __('Page Title Content (HTML FORMAT)','alterna'),
																				'type'	=>	'textarea'
																			),
																		array(	'name' 	=> 'slide-type',
																				'title'	=> __('Slider Type','alterna'),
																				'type'	=>	'select',
																				'options' => array('None Slider','Layer Slider','Revolution Slider'),
																				'enable-element' => 'yes',
																				'emable-id'	=> '1-layer_slide_id:2-rev_slide_id',
																				'emable-group'	=> 'layer_slide_group'
																			),
																		array(	'name' 	=> 'layer-slide-id',
																				'title'	=> __('Select Layer Slider','alterna'),
																				'type'	=>	'select',
																				'options' => alterna_get_layerslider(),
																				'enabled-id' => 'layer_slide_id',
																				'emable-group'	=> 'layer_slide_group'
																			),
																		array(	'name' 	=> 'rev-slide-id',
																				'title'	=> __('Select Revolution Slider','alterna'),
																				'type'	=>	'select',
																				'options' => alterna_get_revslider(),
																				'enabled-id' => 'rev_slide_id',
																				'emable-group'	=> 'layer_slide_group'
																			),
																		array(	'name' 	=> 'video-type',
																				'title'	=> __('Video Type (Note: Need Video Post Format)','alterna'),
																				'type'	=>	'select',
																				'options' => array('Youtube','Vimeo','Custom Code'),
																				
																			),
																		array(	'name' 	=> 'video-content',
																				'title'	=> __('Video ID or Custom Code','alterna'),
																				'type'	=>	'textarea',
																				'longdesc' => 'Youtube Id Example :  " OapE7K5KyG0 "'
																			),
																		array(	'name' 	=> 'audio-type',
																				'title'	=> __('Audio Type (Note: Need Audio Post Format)','alterna'),
																				'type'	=>	'select',
																				'options' => array('Soundcloud','Custom Code')
																			),
																		array(	'name' 	=> 'audio-content',
																				'title'	=> __('Soundcloud Url or Custom Code','alterna'),
																				'type'	=>	'textarea',
																				'longdesc' => __('Soundcloud Example:  " http://api.soundcloud.com/tracks/38987054 "','alterna')
																			),
																		array(	'name' 	=> 'show-related-post',
																				'title'	=> __('Show Related Posts','alterna'),
																				'type'	=>	'select',
																				'options' => array('show','hide')
																			),
																		array(	'name' 	=> 'show-related-post-number',
																				'title'	=> __('Show Related Posts Number','alterna'),
																				'type'	=>	'input',
																				'input_type'	=> 'number',
																				'default' => '3'
																			),
																)
											),
									
									'page_sidebar_setting' => array( 	'id' => 'post-layout-custom',
												'items'		=> array(	array(	'title' => __('Page Option Setting','alterna'),
																				'type'	=>	'page',
																				'priority'	=> 'high'
																			)
																	),
												'fields'	=> array(	array(	'name' 	=> 'layout-type',
																				'title'	=> __('Layout Type','alterna'),
																				'type'	=>	'select',
																				'options' => array('Use Global','Full Width','Left Sidebar','Right Sidebar')
																			),
																		array(	'name' 	=> 'sidebar-type',
																				'title'	=> __('Sidebar','alterna'),
																				'type'	=>	'select',
																				'options' => 'wp_registered_sidebars'
																			),
																		array(	'name' 	=> 'title-show',
																				'title'	=> __('Page Title','alterna'),
																				'type'	=>	'select',
																				'options' => array('show','hide')
																			),
																		array(	'name' 	=> 'title-content',
																				'title'	=> __('Page Title Content(HTML FORMAT)','alterna'),
																				'type'	=>	'textarea'
																			),
																		array(	'name' 	=> 'slide-type',
																				'title'	=> __('Slider Type','alterna'),
																				'type'	=>	'select',
																				'options' => array('None Slider','Layer Slider','Revolution Slider'),
																				'enable-element' => 'yes',
																				'emable-id'	=> '1-layer_slide_id:2-rev_slide_id',
																				'emable-group'	=> 'layer_slide_group'
																			),
																		array(	'name' 	=> 'layer-slide-id',
																				'title'	=> __('Select Layer Slider','alterna'),
																				'type'	=>	'select',
																				'options' => alterna_get_layerslider(),
																				'enabled-id' => 'layer_slide_id',
																				'emable-group'	=> 'layer_slide_group'
																			),
																		array(	'name' 	=> 'rev-slide-id',
																				'title'	=> __('Select Revolution Slider','alterna'),
																				'type'	=>	'select',
																				'options' => alterna_get_revslider(),
																				'enabled-id' => 'rev_slide_id',
																				'emable-group'	=> 'layer_slide_group'
																			),
																		// Blog with ajax
																		array(	'name' 	=> 'blog-ajax-cols-num',
																				'title'	=> __('Blog Waterfall Flux Columns','alterna'),
																				'type'	=>	'select',
																				'check-template' => 'page-blog-ajax',
																				'default' => 1 ,
																				'options' => array('2 columns' , '3 columns' , '4 columns')
																			),
																		array(	'name' 	=> 'blog-ajax-page-num',
																				'title'	=> __('Blog Show Posts Number','alterna'),
																				'type' 	=> 'input',
																				'input_type' => 'number',
																				'default' => 10 ,
																				'check-template' => 'page-blog-ajax' ,
																				'desc' => __('Also as read more load number.','alterna')
																			),
																		array(	'name' 	=> 'blog-ajax-cat',
																				'title'	=> __('Blog Post Show Category','alterna'),
																				'type'	=>	'input',
																				'check-template' => 'page-blog-ajax',
																				'desc'	=>	__('Input post category id will just show these category items use "," ','alterna')
																				
																			),
																		// Portfolio with ajax
																		array(	'name' 	=> 'portfolio-ajax-cols-num',
																				'title'	=> __('Portfolio Waterfall Flux Columns','alterna'),
																				'type'	=>	'select',
																				'check-template' => 'page-portfolio-ajax',
																				'default' => 1 ,
																				'options' => array('2 columns' , '3 columns' , '4 columns')
																			),
																		array(	'name' 	=> 'portfolio-ajax-page-num',
																				'title'	=> __('Portfolio Show Posts Number','alterna'),
																				'type' 	=> 'input',
																				'input_type' => 'number',
																				'default' => 10 ,
																				'check-template' => 'page-portfolio-ajax' ,
																				'desc' => __('Also as read more load number.','alterna')
																			),
																		// Portfolio Params for portfolio page
																		array(	'name' 	=> 'portfolio-cols-num',
																				'title'	=> __('Portfolio Columns','alterna'),
																				'type'	=>	'select',
																				'check-template' => 'page-portfolio',
																				'default' => 1 ,
																				'options' => array('2 columns' , '3 columns' , '4 columns')
																			),
																		array(	'name' 	=> 'portfolio-page-max-number',
																				'title'	=> __('Portfolio Page Show Max Number','alterna'),
																				'type'	=>	'input',
																				'input_type' => 'number',
																				'check-template' => 'page-portfolio',
																				'default' => '10'
																			),
																		array(	'name' 	=> 'portfolio-show-style',
																				'title'	=> __('Portfolio Item Show Style','alterna'),
																				'type'	=>	'select',
																				'check-template' => 'page-portfolio page-portfolio-ajax',
																				'options' => array('Default (content with category)','Style 2 (Title cover thumbs)' , 'Style 3(Date cover thumbs with title)' , 'Style 4(Popup Big Image)')
																			),
																		array(	'name' 	=> 'portfolio-show-filter',
																				'title'	=> __('Portfolio Show Filters','alterna'),
																				'type'	=>	'checkbox',
																				'check-template' => 'page-portfolio page-portfolio-ajax',
																				'desc'	=>	__('Check show filters buttons','alterna')
																				
																			),
																		array(	'name' 	=> 'portfolio-show-cat',
																				'title'	=> __('Portfolio Show Category','alterna'),
																				'type'	=>	'input',
																				'check-template' => 'page-portfolio page-portfolio-ajax',
																				'desc'	=>	__('Input portfolio category slug will just show these category items use "," ','alterna')
																				
																			),
																		// Google Map for contact page
																		array(	'name' 	=> 'contact-recipient',
																				'title'	=> __('Contact Recipient Email','alterna'),
																				'check-template' => 'page-contact',
																				'type'	=>	'input'
																			),
																			
																		array(	'name' 	=> 'form-recaptcha',
																				'title'	=> __('Contact Form Recaptcha','alterna'),
																				'type'	=>	'select',
																				'check-template' => 'page-contact',
																				'options' => array('hide','show'),
																				'enable-element' => 'yes',
																				'emable-id'	=> '1-recaptcha_show_id',
																				'emable-group'	=> 'recaptcha_show_group'
																			),
																		array(	'name' 	=> 'recaptcha-pub-api',
																				'title'	=> __('Recaptcha Public Key','alterna'),
																				'check-template' => 'page-contact',
																				'type'	=>	'input',
																				'default' => '',
																				'desc' =>	__('<strong>The basic registration form requires</strong> that new users copy text from a "Captcha" image to keep spammers out of the site. You need an account at <a href="http://recaptcha.net/">recaptcha.net</a>. Signing up is FREE and easy. Once you have signed up, come back here and enter the following settings:','alterna'),
																				'enabled-id' => 'recaptcha_show_id',
																				'emable-group'	=> 'recaptcha_show_group'
																			),
																		array(	'name' 	=> 'recaptcha-pri-api',
																				'title'	=> __('Recaptcha Private Key','alterna'),
																				'check-template' => 'page-contact',
																				'type'	=>	'input',
																				'enabled-id' => 'recaptcha_show_id',
																				'emable-group'	=> 'recaptcha_show_group'
																			),
																			
																		array(	'name' 	=> 'map-show',
																				'title'	=> __('Header Map Show','alterna'),
																				'type'	=>	'select',
																				'check-template' => 'page-contact',
																				'options' => array('hide','show'),
																				'enable-element' => 'yes',
																				'emable-id'	=> '1-map_show_id',
																				'emable-group'	=> 'map_show_group'
																			),
																		array(	'name' 	=> 'map-height',
																				'title'	=> __('Map Height ','alterna'),
																				'check-template' => 'page-contact',
																				'type'	=>	'input',
																				'input_type' => 'number',
																				'default' => '320',
																				'desc' =>	__('Header map height','alterna'),
																				'enabled-id' => 'map_show_id',
																				'emable-group'	=> 'map_show_group'
																			),
																		array(	'name' 	=> 'map-latlng',
																				'title'	=> __('Map LatLng ','alterna'),
																				'check-template' => 'page-contact',
																				'type'	=>	'input',
																				'desc' =>	__('For Example : 40.716038,-74.080811 ','alterna'),
																				'enabled-id' => 'map_show_id',
																				'emable-group'	=> 'map_show_group'
																			),
																		array(	'name' 	=> 'map-address',
																				'title'	=> __('Map Address ','alterna'),
																				'check-template' => 'page-contact',
																				'type'	=>	'textarea',
																				'desc' =>	__('(Support HTML )For Example : Company Name 123 street, New Valley , USA','alterna'),
																				'enabled-id' => 'map_show_id',
																				'emable-group'	=> 'map_show_group'
																			)
																)
											),
											'portfolio_information' => array( 	'id' => 'portfolio-custom',
																'items'		=> array(	array(	'title' => __('Portfolio Option Setting','alterna'),
																								'type'	=> 'portfolio',
																								'priority'	=> 'high')),
																'fields'	=> array(	
																						array(	'name' 	=> 'title-show',
																								'title'	=> __('Page Title','alterna'),
																								'type'	=>	'select',
																								'options' => array('show','hide')
																							),
																						array(	'name' 	=> 'title-content',
																								'title'	=> __('Page Title Content (HTML FORMAT)','alterna'),
																								'type'	=>	'textarea'
																							),
																						array(	'name' 	=> 'slide-type',
																								'title'	=> __('Slider Type','alterna'),
																								'type'	=>	'select',
																								'options' => array('None Slider','Layer Slider','Revolution Slider'),
																								'enable-element' => 'yes',
																								'emable-id'	=> '1-layer_slide_id:2-rev_slide_id',
																								'emable-group'	=> 'layer_slide_group'
																							),
																						array(	'name' 	=> 'layer-slide-id',
																								'title'	=> __('Select Layer Slider','alterna'),
																								'type'	=>	'select',
																								'options' => alterna_get_layerslider(),
																								'enabled-id' => 'layer_slide_id',
																								'emable-group'	=> 'layer_slide_group'
																							),
																						array(	'name' 	=> 'portfolio-type',
																								'title'	=> __('Portfolio Format:','alterna'),
																								'type'	=> 'radio',
																								'radios' => array('Image','Gallery','Video'),
																								'newline' => 'yes',
																								),
																						array(	'name' 	=> 'video-type',
																								'title'	=> __('Video Type (Note: Need Video Post Format)','alterna'),
																								'type'	=>	'select',
																								'options' => array('Youtube','Vimeo'),
																							
																							),
																						array(	'name' 	=> 'video-content',
																								'title'	=> __('Video ID','alterna'),
																								'desc' => 'Youtube Id Example :  " OapE7K5KyG0 "',
																							),
																						array(	'name' 	=> 'portfolio-client',
																								'title'	=> __('Client','alterna'),
																								'type'	=>	'input'																								
																							),
																						array(	'name' 	=> 'portfolio-skills',
																								'title'	=> __('Skills','alterna'),
																								'type'	=>	'input',		
																							),
																						array(	'name' 	=> 'portfolio-colors',
																								'title'	=> __('Colors','alterna'),
																								'type'	=>	'input',
																								'desc'	=> __('Please use "," for multiple colors. Example: #ffffff,#000000 ','alterna')																							
																							),
																						array(	'name' 	=> 'portfolio-link',
																								'title'	=> __('Link','alterna'),
																								'type'	=>	'input',									
																							),
																						array(	'name' 	=> 'show-related-portfolio',
																								'title'	=> __('Show Related Portfolios','alterna'),
																								'type'	=>	'select',
																								'options' => array('show','hide')
																							),
																						array(	'name' 	=> 'show-related-portfolio-number',
																								'title'	=> __('Show Related Portfolios Number','alterna'),
																								'type'	=>	'input',
																								'input_type'	=> 'number',
																								'default' => '3'
																							),
																					)
															),
							),
		);
	
	$postsConfig = array('posts'=>$custom_posts,'fields'=>$custom_fields);
	
	Penguin::$FRAMEWORK_PATH = "/inc/penguin";
	Penguin::$THEME_NAME = "alterna";
	
	// start penguin framework for them
	Penguin::start($optionConfig , $postsConfig );
?>