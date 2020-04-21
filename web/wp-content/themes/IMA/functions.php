<?php

define( 'IMA_VERSION', 1.16 );

/*-----------------------------------------------------------------------------------*/
/* General
/*-----------------------------------------------------------------------------------*/
// Plugins updates
add_filter( 'auto_update_plugin', '__return_true' );

// Theme support
add_theme_support( 'html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'widgets') );
add_theme_support( 'post-thumbnails' , array('page', 'post', 'logos'));

/*-----------------------------------------------------------------------------------*/
/* Hide Wordpress version and stuff for security, hide login errors
/*-----------------------------------------------------------------------------------*/
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );

// remove api rest links
remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

// remove comment author class
function remove_comment_author_class( $classes ){
    foreach( $classes as $key => $class ){
        if(strstr($class, "comment-author-"))
            unset( $classes[$key] );
    }
    return $classes;
}
add_filter( 'comment_class' , 'remove_comment_author_class' );

// remove login errors
add_filter( 'login_errors', function($a){ return null; } );

/*-----------------------------------------------------------------------------------*/
/* Register main menu for Wordpress use
/*-----------------------------------------------------------------------------------*/
register_nav_menus(
	array(
		'primary'	=>	__( 'Primary Menu', 'ima' ),
		'menuFooter'	=>	__( 'Footer Menu', 'ima' ),
		'primaryPlan' => __( 'Plan du site - Primary Menu', 'ima' ),
		'secondaryPlan' => __( 'Plan du site - Secondary Menu', 'ima' ),
		'smallPlan' => __( 'Plan du site - Small Menu', 'ima' )
	)
);

// Cleanup WP Menu html
function css_attributes_filter($var) {
     return is_array($var) ? array_intersect($var, array('current-menu-item')) : '';
}
add_filter('nav_menu_css_class', 'css_attributes_filter', 100, 1);
add_filter('page_css_class', 'css_attributes_filter', 100, 1);

/*-----------------------------------------------------------------------------------*/
/* Activate sidebar for Wordpress use
/*-----------------------------------------------------------------------------------*/
function ima_register_sidebars() {
	register_sidebar(array(
		'id' => 'footer',
		'name' => 'Footer',
		'description' => 'Contenu du footer',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
		'empty_title'=> '',
	));
}
add_action( 'widgets_init', 'ima_register_sidebars' );

// widget footer
class Footer_Contact_Widget extends WP_Widget {
	public function __construct() {
		parent::__construct(false, 'IMA - Footer contact');
	}
	function form($instance) {
		$adresse = esc_attr($instance['adresse']);
		$tel = esc_attr($instance['tel']);
		$tel2 = esc_attr($instance['tel2']);

		$twitter = esc_attr($instance['twitter']);
		$linkedin = esc_attr($instance['linkedin']);
		$instagram = esc_attr($instance['instagram']);
		$viadeo = esc_attr($instance['viadeo']);
		$scoopit = esc_attr($instance['scoopit']);

		?>
				<h3>Coordonnées</h3>
		        <p><titre for="<?php echo $this->get_field_id('adresse'); ?>"><?php _e('Texte central :'); ?> <input class="widefat" id="<?php echo $this->get_field_id('adresse'); ?>" name="<?php echo $this->get_field_name('adresse'); ?>" type="text" value="<?php echo $adresse; ?>" /></label></p>
				<p><titre for="<?php echo $this->get_field_id('tel'); ?>"><?php _e('Numéro de téléphone :'); ?> <input class="widefat" id="<?php echo $this->get_field_id('tel'); ?>" name="<?php echo $this->get_field_name('tel'); ?>" type="text" value="<?php echo $tel; ?>" /></label></p>
				<p><titre for="<?php echo $this->get_field_id('tel2'); ?>"><?php _e('Numéro de téléphone formaté : (pour le lien)'); ?> <input class="widefat" id="<?php echo $this->get_field_id('tel2'); ?>" name="<?php echo $this->get_field_name('tel2'); ?>" type="text" value="<?php echo $tel2; ?>" /></label></p>

				<h3>Réseaux sociaux</h3>
				<p><titre for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Lien twitter :'); ?> <input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo $twitter; ?>" /></label></p>
				<p><titre for="<?php echo $this->get_field_id('linkedin'); ?>"><?php _e('Lien linkedin :'); ?> <input class="widefat" id="<?php echo $this->get_field_id('linkedin'); ?>" name="<?php echo $this->get_field_name('linkedin'); ?>" type="text" value="<?php echo $linkedin; ?>" /></label></p>
				<p><titre for="<?php echo $this->get_field_id('viadeo'); ?>"><?php _e('Lien viadeo :'); ?> <input class="widefat" id="<?php echo $this->get_field_id('viadeo'); ?>" name="<?php echo $this->get_field_name('viadeo'); ?>" type="text" value="<?php echo $viadeo; ?>" /></label></p>
				<p><titre for="<?php echo $this->get_field_id('scoopit'); ?>"><?php _e('Lien scoopit :'); ?> <input class="widefat" id="<?php echo $this->get_field_id('scoopit'); ?>" name="<?php echo $this->get_field_name('scoopit'); ?>" type="text" value="<?php echo $scoopit; ?>" /></label></p>
				<p><titre for="<?php echo $this->get_field_id('instagram'); ?>"><?php _e('Lien instagram :'); ?> <input class="widefat" id="<?php echo $this->get_field_id('instagram'); ?>" name="<?php echo $this->get_field_name('instagram'); ?>" type="text" value="<?php echo $instagram; ?>" /></label></p>
				
		<?php
	}
	function update($new_instance, $old_instance) {
		return $new_instance;
	}
	function widget($args, $instance) {
		?>
		<li class="padding-top-footer">
			<?php if ($instance['adresse'] != '') { ?>
				<?php echo $instance['adresse']; ?>
			<?php } ?>
		</li>

		<li>
			<?php if ($instance['tel'] != '') { ?>
				<a href="tel:<?php echo $instance['tel2']; ?>" class="tel-footer"><?php echo $instance['tel']; ?></a>
			<?php } ?>
		</li>

		<li class="last padding-top-footer">
			Suivez-nous :
			<ul class="social-footer">
				<?php if ($instance['twitter'] != '') { ?>
					<li class="twitter">
						<a href="<?php echo $instance['twitter']; ?>" target="_blank"><span class="container-fond-social"><span class="fond-social"></span></span><span class="logo-footer icon-twitter"></span></a>
					</li>
				<?php } ?>
				<?php if ($instance['linkedin'] != '') { ?>
					<li class="linkedin">
						<a href="<?php echo $instance['linkedin']; ?>" target="_blank"><span class="container-fond-social"><span class="fond-social"></span></span><span class="logo-footer icon-linkedin"></span></a>
					</li>
				<?php } ?>
				<?php if ($instance['viadeo'] != '') { ?>
					<li class="viadeo">
						<a href="<?php echo $instance['viadeo']; ?>" target="_blank"><span class="container-fond-social"><span class="fond-social"></span></span><span class="logo-footer icon-viadeo"></span></a>
					</li>
				<?php } ?>
				<?php if ($instance['instagram'] != '') { ?>
					<li class="instagram">
						<a href="<?php echo $instance['instagram']; ?>" target="_blank"><span class="container-fond-social"><span class="fond-social"></span></span><span class="logo-footer icon-instagram"></span></a>
					</li>
				<?php } ?>
				<?php if ($instance['scoopit'] != '') { ?>
					<li class="scoopit">
						<a href="<?php echo $instance['scoopit']; ?>" target="_blank"><span class="container-fond-social"><span class="fond-social"></span></span><span class="logo-footer icon-scoopit"></span></a>
					</li>
				<?php } ?>
			</ul>
		</li>
		<?php
	}
}
register_widget('Footer_Contact_Widget');

// Deregister default widgets
function ima_unregister_default_widgets(){
    unregister_widget('WP_Widget_Pages');
    unregister_widget('WP_Widget_Calendar');
    unregister_widget('WP_Widget_Archives');
    unregister_widget('WP_Widget_Links');
    unregister_widget('WP_Widget_Meta');
    unregister_widget('WP_Widget_Search');
    unregister_widget('WP_Widget_Text');
    unregister_widget('WP_Widget_Categories');
    unregister_widget('WP_Widget_Recent_Posts');
    unregister_widget('WP_Widget_Recent_Comments');
    unregister_widget('WP_Widget_RSS');
    unregister_widget('WP_Widget_Tag_Cloud');
    unregister_widget('WP_Nav_Menu_Widget');
}
add_action( 'widgets_init', 'ima_unregister_default_widgets' );

/*-----------------------------------------------------------------------------------*/
/* Remove default WYSIWYG editor in Home, Contact, Postuler
/*-----------------------------------------------------------------------------------*/
function ima_hide_editor() {
	if(isset($_GET['post']) || isset($_POST['post_ID'])){
		$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
	}
    if( !isset( $post_id ) ) return;
    $template_file = get_post_meta($post_id, '_wp_page_template', true);

    if($template_file == 'home.php' || $template_file == 'contact.php' || $template_file == 'postuler.php'){
        remove_post_type_support('page', 'editor');
    }
}
add_action( 'admin_init', 'ima_hide_editor' );

/*-----------------------------------------------------------------------------------*/
/* Custom Post Types => Bloc liens, blocs média
/*-----------------------------------------------------------------------------------*/
function ima_create_post_type() {
  register_post_type('bloc', array(
    'label' => 'Blocs lien',
    'singular_label' => 'Bloc lien',
    'public' => true,
    'supports' => array( 'title','page-attributes')
  ));
  register_post_type('blocMedia', array(
    'label' => 'Blocs média',
    'singular_label' => 'Bloc média',
    'public' => true,
    'supports' => array( 'title','page-attributes')
  ));
  register_post_type('interlocuteur', array(
    'label' => 'Interlocuteurs',
    'singular_label' => 'Interlocuteur',
    'public' => true,
    'supports' => array('title', 'page-attributes')
  ));
  register_post_type('offres', array(
    'label' => "Offres d'emploi",
    'singular_label' => "Offre d'emploi",
    'public' => true
  ));
  register_post_type('logos', array(
    'label' => 'Logos',
    'singular_label' => 'Logo',
    'public' => true,
    'supports' => array( 'title', 'thumbnail')
  ));
}
add_action( 'init', 'ima_create_post_type' );

/*-----------------------------------------------------------------------------------*/
/* Custom Taxonomies => Catégories Logos
/*-----------------------------------------------------------------------------------*/
function ima_create_live_taxonomies() {
	register_taxonomy( 'catLogo', array( 'logos' ), array(
		'hierarchical' => true,
		'labels' => array(
						'name' => 'Catégories Logos', 'Logos',
						'singular_name' => 'Catégorie Logo', 'Logo'
					),
		'rewrite' => array( 'slug' => 'catLogo' )
	));
}
add_action( 'init', 'ima_create_live_taxonomies', 0 );

/*-----------------------------------------------------------------------------------*/
/* Ajout des [b] et [i] dans les field ACF
/*-----------------------------------------------------------------------------------*/
function formatTexte($field){
	echo str_replace("[b]", "<strong>", str_replace("[/b]", "</strong>", str_replace( "[i]", "<i>", str_replace( "[/i]", "</i>", $field))));
}

/*-----------------------------------------------------------------------------------*/
/* Désactiver les MAJ du plugin Infinite Scroll
   (correction d'un bug avec biblitohèque médias dans le code source)
/*-----------------------------------------------------------------------------------*/
function ima_stop_plugin_update( $value ) {
	unset( $value->response['infinite-scroll/infinite-scroll.php'] );
	return $value;
}
add_filter( 'site_transient_update_plugins', 'ima_stop_plugin_update' );

/*-----------------------------------------------------------------------------------*/
/* Retourne le nb d'articles dans une catégorie
/*-----------------------------------------------------------------------------------*/
function count_cat_post($category) {
if(is_string($category)) {
	$catID = get_cat_ID($category);
}
elseif(is_numeric($category)) {
	$catID = $category;
} else {
	return 0;
}
$cat = get_category($catID);
return $cat->count;
}

/*-----------------------------------------------------------------------------------*/
/* Metabox in page to display the code to add in other websites to display the iframe
/*-----------------------------------------------------------------------------------*/
function smashing_post_class_meta_box( $object, $box ) {
  	wp_nonce_field( basename( __FILE__ ), 'smashing_post_class_nonce' );
  	global $post; $postid = $post->ID; ?>

  	<p>
    	<b>Copiez-collez ce script pour faire apparaître cette page sur un autre site.</b>
    	<br/><br/>
    	<input class='widefat' type='text' value='&lt;script id="imaScript" src="<?php echo get_site_url(); ?>/wp-content/themes/IMA/js/iframe.js?s=<?php echo get_site_url(); ?>/&p=<?php echo get_permalink( $postid ); ?>"&gt;&lt;/script&gt;' readonly/>
  	</p>

	<?php
}
function smashing_post_meta_boxes_setup() {
	add_meta_box(
	    'box_iframe_script',
	    'Script',
	    'smashing_post_class_meta_box',
	    'page',
	    'side',
	    'default'
	  );
}
add_action( 'load-post.php', 'smashing_post_meta_boxes_setup' );
add_action( 'load-post-new.php', 'smashing_post_meta_boxes_setup' );


/*-----------------------------------------------------------------------------------*/
/* Admin
/*-----------------------------------------------------------------------------------*/
// Remove some useless admin stuff
function ima_remove_submenus() {
  $page = remove_submenu_page( 'themes.php', 'themes.php' );
}
add_action( 'admin_menu', 'ima_remove_submenus', 999 );
function ima_remove_top_menus( $wp_admin_bar ){
    $wp_admin_bar->remove_node( 'wp-logo' );
}
add_action( 'admin_bar_menu', 'ima_remove_top_menus', 999 );

// Custom posts in the dashboard
function ima_right_now_custom_post() {
    $post_types = get_post_types(array( '_builtin' => false ) , 'objects' , 'and');
    foreach($post_types as $post_type){
        $cpt_name = $post_type->name;
        if($cpt_name != 'acf'){
            $num_posts = wp_count_posts($post_type->name);
            $num = number_format_i18n($num_posts->publish);
            $text = _n($post_type->labels->name, $post_type->labels->name , intval($num_posts->publish));
            echo '<li class="'. $cpt_name .'-count"><tr><a class="'.$cpt_name.'" href="edit.php?post_type='.$cpt_name.'"><td></td>' . $num . ' <td>' . $text . '</td></a></tr></li>';
        }
    }
}
add_action( 'dashboard_glance_items', 'ima_right_now_custom_post' );

// Customize a bit the wysiwyg editor
function ima_mce_before_init( $styles ){
    // Remove h1 and code
    $styles['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6';
    return $styles;
}
add_filter( 'tiny_mce_before_init', 'ima_mce_before_init' );

// Enlever le lien par défaut autour des images
function ima_imagelink_setup(){
    $image_set = get_option( 'image_default_link_type' );
    if($image_set !== 'none')
        update_option('image_default_link_type', 'none');
}
add_action( 'admin_init', 'ima_imagelink_setup' );

// Allow svg in media library
function ima_mime_types($mimes){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'ima_mime_types' );


/*-----------------------------------------------------------------------------------*/
/* Enqueue Styles and Scripts
/*-----------------------------------------------------------------------------------*/

function ima_scripts(){
	// get the theme directory style.css and link to it in the header
	wp_enqueue_style( 'ima-norm', get_template_directory_uri() . '/css/libs/normalize.css', '10000', 'all' );
	wp_enqueue_style( 'ima-style', get_template_directory_uri() . '/css/style.css', '10000', IMA_VERSION );
	wp_enqueue_style( 'ima-videocss', get_template_directory_uri() . '/js/libs/videojs/video-js.css', '10000', 'all' );

	// add theme scripts (header)
    wp_deregister_script( 'wp-embed' );

	wp_enqueue_script( 'ima-modernizr', get_template_directory_uri() . '/js/libs/modernizr.js', array());
	wp_enqueue_script( 'ima-videojs', get_template_directory_uri() . '/js/libs/videojs/video.js', array(), null);
	wp_enqueue_script( 'ima-youtube', get_template_directory_uri() . '/js/libs/videojs/youtube.js', array(), null);
	wp_enqueue_script( 'ima-mobile', get_template_directory_uri() . '/js/libs/isMobile.min.js', array(), null);


	// add theme scripts (footer)
    wp_deregister_script('jquery');
    wp_enqueue_script( 'ima-jquery', get_template_directory_uri() . '/js/libs/jquery-1.11.1.min.js', array(), null, true);
	wp_enqueue_script( 'ima-jqueryui', get_template_directory_uri() . '/js/libs/jquery-ui.min.js', array(), null, true );
	wp_enqueue_script( 'ima-jquerycookie', get_template_directory_uri() . '/js/libs/jquery.cookie.js', array(), null, true );

	/*wp_enqueue_script( 'ima-bezier', get_template_directory_uri() . '/js/libs/jsPlumb/jsBezier-0.6.js', array(), null, true );
	wp_enqueue_script( 'ima-biltong', get_template_directory_uri() . '/js/libs/jsPlumb/biltong-0.2.js', array(), null, true );
	wp_enqueue_script( 'ima-util', get_template_directory_uri() . '/js/libs/jsPlumb/util.js', array(), null, true );
	wp_enqueue_script( 'ima-browserutil', get_template_directory_uri() . '/js/libs/jsPlumb/browser-util.js', array(), null, true );
	wp_enqueue_script( 'ima-dom', get_template_directory_uri() . '/js/libs/jsPlumb/dom-adapter.js', array(), null, true );
	wp_enqueue_script( 'ima-plumb', get_template_directory_uri() . '/js/libs/jsPlumb/jsPlumb.js', array(), null, true );
	wp_enqueue_script( 'ima-endpoint', get_template_directory_uri() . '/js/libs/jsPlumb/endpoint.js', array(), null, true );
	wp_enqueue_script( 'ima-connection', get_template_directory_uri() . '/js/libs/jsPlumb/connection.js', array(), null, true );
	wp_enqueue_script( 'ima-anchors', get_template_directory_uri() . '/js/libs/jsPlumb/anchors.js', array(), null, true );
	wp_enqueue_script( 'ima-defaults', get_template_directory_uri() . '/js/libs/jsPlumb/defaults.js', array(), null, true );
	wp_enqueue_script( 'ima-connectors', get_template_directory_uri() . '/js/libs/jsPlumb/connectors-bezier.js', array(), null, true );
	wp_enqueue_script( 'ima-connectorssm', get_template_directory_uri() . '/js/libs/jsPlumb/connectors-statemachine.js', array(), null, true );
	wp_enqueue_script( 'ima-connectorsfc', get_template_directory_uri() . '/js/libs/jsPlumb/connectors-flowchart.js', array(), null, true );
	wp_enqueue_script( 'ima-svg', get_template_directory_uri() . '/js/libs/jsPlumb/renderers-svg.js', array(), null, true );
	wp_enqueue_script( 'ima-vml', get_template_directory_uri() . '/js/libs/jsPlumb/renderers-vml.js', array(), null, true );
	wp_enqueue_script( 'ima-editors', get_template_directory_uri() . '/js/libs/jsPlumb/connector-editors.js', array(), null, true );
	wp_enqueue_script( 'ima-adapter', get_template_directory_uri() . '/js/libs/jsPlumb/jquery.jsPlumb.js', array(), null, true );*/

	wp_enqueue_script( 'ima-tweenmax', get_template_directory_uri() . '/js/libs/greensock/TweenMax.min.js', array(), null, true );
	wp_enqueue_script( 'ima-timeline', get_template_directory_uri() . '/js/libs/greensock/TimelineMax.min.js', array(), null, true );
	wp_enqueue_script( 'ima-beziermax', get_template_directory_uri() . '/js/libs/greensock/plugins/BezierPlugin.min.js', array(), null, true );

	if(is_page_template('logos-miniatures.php')){
        wp_enqueue_script( 'ima-clipboard', get_template_directory_uri() . '/js/libs/jquery.clipboard.js', array(), null, true );
    }

	wp_enqueue_script( 'ima', get_template_directory_uri() . '/js/script.js', array(), null, true );
	wp_enqueue_script( 'ima-secteurs', get_template_directory_uri() . '/js/build/secteurs-min.js', array(), null, true );

}
add_action( 'wp_enqueue_scripts', 'ima_scripts' );
