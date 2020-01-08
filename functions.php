<?php


/**
 * Wireframe functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage wireframe
 * @since 1.0
 */
$path1 = get_template_directory() . '/inc/Widget.php';
$path2 = get_template_directory() . '/inc/Sidebar.php';
$path3 = get_template_directory() . '/inc/WidgetFactory.php';
$path4 = get_template_directory() . '/inc/WidgetManager.php';
require($path1);
require($path2);
require($path3);
require($path4);
require(get_template_directory() .'/inc/site.inc');
require(get_template_directory() .'/inc/StyleLoader.php');



$widgewf = null;

// Query for existing widgets.
$manager = new WidgetManager();
// $widgets = $manager->loadWidgets('sidebar-1');

// Create a new widget.
$wign = new Widget('my-widget-id');
// $wign->save();

// Save the widget into the sidebar.
// $sidebar->addWidget($wign);
// $sidebar->save();


function is_inner_page() {
	return !is_homepage_template() && (is_single() || (is_page() && ! wireframe_is_frontpage()));
}

function is_homepage_template() {
	return get_page_template_slug( get_queried_object_id() ) == "front-page.php";
}

function wireframe_body_styles($names = array()){
	$css = array();
	foreach($names as $name){
		$css[] = $name.":".confget($name);
	}
	
	return implode(";",$css);
}



function wireframe_homepage_sections($limit = 5){
	if(!confget("show-homepage-sections")) return '';
	
	$sections = confget("sections");

	
	$markup = array();
	
	foreach($sections as $section){
		$tmp = "<section id='{$section['id']}' class='section-home'><h2 class='section-title'>{$section['title']}</h2><div class='section-content'>{$section['content']}</div></section>";
		$markup[]=$tmp;
	}
	
	return implode("\n",$markup);
}

function wireframe_homepage_pages($limit = 10){
	if(!confget("show-homepage-pages")) return '';
	
	$pages = confget("pages");

	
	$markup = array();
	
	foreach($pages as $page){
		$tmp = "<section id='{$page['id']}' class='section-home'><h2 class='section-title'>{$page['title']}</h2><div class='section-content'>{$page['content']}</div></section>";
		$markup[]=$tmp;
	}
	
	return implode("\n",$markup);
}


function wireframe_has_prop($element,$prop){
	$conf = confget("elements.".$element.".css");

	return null == $conf ? false : array_key_exists($prop,$conf);
}




function wfp($array){
	return "<pre>".print_r($array,true)."</pre>";
}

function _wireframe_get_css($element) {
	$styles = confget("elements.".$element.".css");
	$css = array();
	
	if(empty($styles)) return array();
	
	foreach($styles as $prop => $value){
		if(empty($value)) continue;
		$css[]=$prop.": ".$value;
	}
	
	return $css;
}

function wireframe_get_css($element = null){
	$css = _wireframe_get_css($element);
	
	return empty($css) ? "" : implode(";",$css);
}


/**
 * Wireframe only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wireframe_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/wireframe
	 * If you're building a theme based on Wireframe, use a find and replace
	 * to change 'wireframe' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'wireframe' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'wireframe-featured-image', 2000, 1200, true );

	add_image_size( 'wireframe-thumbnail-avatar', 100, 100, true );

	// Set the default content width.
	$GLOBALS['content_width'] = 525;

	// This theme uses wp_nav_menu() in five locations.
	register_nav_menus(
		array(
			'top' => __('Global Header', 'wireframe'),
			'main' => __('Hamburgler', 'wireframe'),
			'menu-loc-1' => __('Location 1', 'wireframe'),
			'menu-loc-2' => __('Location 2', 'wireframe'),
			'menu-loc-3' => __('Location 3', 'wireframe'),
			'social' => __('Social Links Menu', 'wireframe'),
			'site-map' => __('Site Map', 'wireframe')
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support(
		'post-formats',
		array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'audio',
		)
	);

	// Add theme support for Custom Logo.
	add_theme_support(
		'custom-logo',
		array(
			'width'      => 250,
			'height'     => 250,
			'flex-width' => true,
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
	  */
	add_editor_style( array( 'assets/css/editor-style.css', wireframe_fonts_url() ) );

	// Load regular editor styles into the new block-based editor.
	add_theme_support( 'editor-styles' );

	// Load default block styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(
		/* 'widgets'     => array(
			// Place three core-defined widgets in the sidebar area.
			'sidebar-1' => array(
				'text_business_info',
				'search',
				'text_about',
			),
			
			// Make search available in the global header.
			'global-header-left' => array(
				'search'
			),

			// Add the core-defined business info widget to the footer 1 area.
			'sidebar-2' => array(
				'text_business_info',
			),

			// Put two core-defined widgets in the footer 2 area.
			'sidebar-3' => array(
				'text_about',
				'search',
			),
			'sidebar-4' => array(
				'text_about',
				'widgets',
			)

		),
			*/
		// Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts'       => array(
			'home',
			'about'            => array(
				'thumbnail' => '{{image-sandwich}}',
			),
			'contact'          => array(
				'thumbnail' => '{{image-espresso}}',
			),
			'blog'             => array(
				'thumbnail' => '{{image-coffee}}',
			),
			'homepage-section' => array(
				'thumbnail' => '{{image-espresso}}',
			),
		),

		// Create the custom image attachments used as post thumbnails for pages.
		'attachments' => array(
			'image-espresso' => array(
				'post_title' => _x( 'Espresso', 'Theme starter content', 'wireframe' ),
				'file'       => 'assets/images/espresso.jpg', // URL relative to the template directory.
			),
			'image-sandwich' => array(
				'post_title' => _x( 'Sandwich', 'Theme starter content', 'wireframe' ),
				'file'       => 'assets/images/sandwich.jpg',
			),
			'image-coffee'   => array(
				'post_title' => _x( 'Coffee', 'Theme starter content', 'wireframe' ),
				'file'       => 'assets/images/coffee.jpg',
			),
		),

		// Default to a static front page and assign the front and posts pages.
		'options'     => array(
			'show_on_front'  => 'page',
			'page_on_front'  => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),

		// Set the front page section theme mods to the IDs of the core-registered pages.
		'theme_mods'  => array(
			'panel_1' => '{{homepage-section}}',
			'panel_2' => '{{about}}',
			'panel_3' => '{{blog}}',
			'panel_4' => '{{contact}}',
		),

		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus'   => array(
			// Assign a menu to the "top" location.
			'top'    => array(
				'name'  => __( 'Top Menu', 'wireframe' ),
				'items' => array(
					'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
					'page_about',
					'page_blog',
					'page_contact',
				),
			),

			// Assign a menu to the "social" location.
			'social' => array(
				'name'  => __( 'Social Links Menu', 'wireframe' ),
				'items' => array(
					'link_yelp',
					'link_facebook',
					'link_twitter',
					'link_instagram',
					'link_email',
				),
			),
		),
	);

	/**
	 * Filters Wireframe array of starter content.
	 *
	 * @since Wireframe 1.1
	 *
	 * @param array $starter_content Array of starter content.
	 */
	$starter_content = apply_filters( 'wireframe_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );
	

}


add_action( 'after_setup_theme', 'wireframe_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wireframe_content_width() {

	$content_width = $GLOBALS['content_width'];

	// Get layout.
	$page_layout = get_theme_mod( 'page_layout' );

	// Check if layout is one column.
	if ( 'one-column' === $page_layout ) {
		if ( wireframe_is_frontpage() ) {
			$content_width = 644;
		} elseif ( is_page() ) {
			$content_width = 740;
		}
	}

	// Check if is single post and there is no sidebar.
	if ( is_single() && ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 740;
	}

	/**
	 * Filter Wireframe content width of the theme.
	 *
	 * @since Wireframe 1.0
	 *
	 * @param int $content_width Content width in pixels.
	 */
	$GLOBALS['content_width'] = apply_filters( 'wireframe_content_width', $content_width );
}
add_action( 'template_redirect', 'wireframe_content_width', 0 );

/**
 * Register custom fonts.
 */
function wireframe_fonts_url() {
	$fonts_url = '';

	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Libre Franklin, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$libre_franklin = _x( 'on', 'Libre Franklin font: on or off', 'wireframe' );

	if ( 'off' !== $libre_franklin ) {
		$font_families = array();

		$font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *wp_resource_hints', 'wireframe_resource_hints', 10, 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function wireframe_widgets_init() {

	// Borrowed from wp-packagist/twentyseventeen.
	register_sidebar(
		array(
			'name'          => __( 'Left Sidebar', 'wireframe' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'twentyseventeen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	
	register_sidebar(
		array(
			'name'          => __( 'Right Sidebar', 'wireframe' ),
			'id'            => 'sidebar-2',
			'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'twentyseventeen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	

	register_sidebar(
		array(
			'name'          => __( 'Global Header Left Widget Area', 'wireframe' ),
			'id'            => 'global-header-left',
			'description'   => __( 'Add widgets here to appear in the left side of the global header area. (i.e. search or social media)', 'wireframe' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Global Header Right Widget Area', 'wireframe' ),
			'id'            => 'global-header-right',
			'description'   => __( 'Add widgets here to appear in the right side of the global header area.  (i.e. search or social media)', 'wireframe' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Banner Left Widet Area', 'wireframe' ),
			'id'            => 'sidebar-3',
			'description'   => __( 'Add widgets here to appear in the left side of the banner area.(sidebar-3)', 'wireframe' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Banner Center Widet Area', 'wireframe' ),
			'id'            => 'sidebar-4',
			'description'   => __( 'Add widgets here to appear in the center of the banner area.(sidebar-4)', 'wireframe' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Banner Right Widget Area', 'wireframe' ),
			'id'            => 'sidebar-5',
			'description'   => __( 'Add widgets here to appear in the right side of the banner area.(sidebar-5)', 'wireframe' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	

	
	
	register_sidebar(
		array(
			'name'          => __( 'Footer Left Widget Area', 'wireframe' ),
			'id'            => 'sidebar-6',
			'description'   => __( 'Add widgets here to appear in the left side of the footer area. (i.e. social media icons or something similar)(sidebar-6)', 'wireframe' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Footer Center Widget Area', 'wireframe' ),
			'id'            => 'sidebar-7',
			'description'   => __( 'Add widgets here to appear in the center of the footer area.  (i.e. A site map perhaps, or maybe a company/site info tagline)(sidebar-7)', 'wireframe' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Footer Right Widget Area', 'wireframe' ),
			'id'            => 'sidebar-8',
			'description'   => __( 'Add widgets here to appear in the right side of the footer area.  (i.e. social media icons or something similar)(sidebar-8)', 'wireframe' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	
	

}

function wireframe_init_widgets_install() {
	global $widgewf;
	$widgewf = new WidgetFactory();
	
	register_widget($widgewf);
}

function wf_show_widget($name = null) {
	// global $widgewf;
	$widgewf = new WidgetFactory();
	$widgewf->widget();
}


if(!function_exists('override_parent_widget_areas')) {
	add_action( 'widgets_init', 'wireframe_widgets_init' );
}
add_action( 'widgets_init', 'wireframe_init_widgets_install' );
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Wireframe 1.0
 *
 * @param string $link Link to single post/page.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function wireframe_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf(
		'<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'wireframe' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'wireframe_excerpt_more' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Wireframe 1.0
 */
function wireframe_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'wireframe_javascript_detection', 0 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function wireframe_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'wireframe_pingback_header' );

/**
 * Display custom color CSS.
 */
function wireframe_colors_css_wrap() {
	if ( 'custom' !== get_theme_mod( 'colorscheme' ) && ! is_customize_preview() ) {
		return;
	}

	require_once( get_parent_theme_file_path( '/inc/color-patterns.php' ) );
	$hue = absint( get_theme_mod( 'colorscheme_hue', 250 ) );

	$customize_preview_data_hue = '';
	if ( is_customize_preview() ) {
		$customize_preview_data_hue = 'data-hue="' . $hue . '"';
	}
	?>
	<style type="text/css" id="custom-theme-colors" <?php echo $customize_preview_data_hue; ?>>
		<?php echo wireframe_custom_colors_css(); ?>
	</style>
	<?php
}
add_action( 'wp_head', 'wireframe_colors_css_wrap' );

/**
 * Enqueues scripts and styles.
 */
function wireframe_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'wireframe-fonts', wireframe_fonts_url(), array(), null );

	// BUG? @jbernal 2019-10-28
	// Theme stylesheet.
	// wp_enqueue_style( 'wireframe-style', get_stylesheet_uri() );

	// Theme block stylesheet.
	wp_enqueue_style( 'wireframe-block-style', get_theme_file_uri( '/assets/css/blocks.css' ), array( 'parent-styles' ), '1.1' );

	// Load the dark colorscheme.
	if ( 'dark' === get_theme_mod( 'colorscheme', 'light' ) || is_customize_preview() ) {
		wp_enqueue_style( 'wireframe-colors-dark', get_theme_file_uri( '/assets/css/colors-dark.css' ), array( 'parent-styles' ), '1.0' );
	}

	// Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
	if ( is_customize_preview() ) {
		wp_enqueue_style( 'wireframe-ie9', get_theme_file_uri( '/assets/css/ie9.css' ), array( 'parent-styles' ), '1.0' );
		wp_style_add_data( 'wireframe-ie9', 'conditional', 'IE 9' );
	}

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'wireframe-ie8', get_theme_file_uri( '/assets/css/ie8.css' ), array( 'parent-styles' ), '1.0' );
	wp_style_add_data( 'wireframe-ie8', 'conditional', 'lt IE 9' );

	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'wireframe-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix.js' ), array(), '1.0', true );

	$wireframe_l10n = array(
		'quote' => wireframe_get_svg( array( 'icon' => 'quote-right' ) ),
	);

	if ( has_nav_menu( 'top' ) ) {
		wp_enqueue_script( 'wireframe-navigation-top', get_theme_file_uri( '/assets/js/navigation-top.js' ), array( 'jquery' ), '1.0', true );
		$wireframe_l10n['expand']   = __( 'Expand child menu', 'wireframe' );
		$wireframe_l10n['collapse'] = __( 'Collapse child menu', 'wireframe' );
		$wireframe_l10n['icon']     = wireframe_get_svg(
			array(
				'icon'     => 'angle-down',
				'fallback' => true,
			)
		);
	}

		wp_enqueue_script( 'overlay-ui', get_theme_file_uri( '/assets/js/menu-click-event.js' ), array( 'jquery' ), '1.0', true );
		
		/*
		$wireframe_l10n['expand']   = __( 'Expand child menu', 'wireframe' );
		$wireframe_l10n['collapse'] = __( 'Collapse child menu', 'wireframe' );
		$wireframe_l10n['icon']     = wireframe_get_svg(
			array(
				'icon'     => 'angle-down',
				'fallback' => true,
			)
		);
		*/


	wp_enqueue_script( 'wireframe-global', get_theme_file_uri( '/assets/js/global.js' ), array( 'jquery' ), '1.0', true );

	wp_enqueue_script( 'jquery-scrollto', get_theme_file_uri( '/assets/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', true );

	wp_localize_script( 'wireframe-skip-link-focus-fix', 'wireframeScreenReaderText', $wireframe_l10n );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wireframe_scripts' );

/**
 * Enqueues styles for the block-based editor.
 *
 * @since Wireframe 1.8
 */
function wireframe_block_editor_styles() {
	// Block styles.
	// get_theme_file_uri
	
	wp_enqueue_style( 'wireframe-block-editor-style', get_template_directory_uri().'/assets/css/editor-blocks.css', array(), '1.1' );
	// Add custom fonts.
	wp_enqueue_style( 'wireframe-fonts', wireframe_fonts_url(), array(), null );
	
	if(function_exists('child_block_editor_styles')) {
		child_block_editor_styles();
	}
}
add_action( 'enqueue_block_editor_assets', 'wireframe_block_editor_styles' );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @since Wireframe 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function wireframe_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 740 <= $width ) {
		$sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
	}

	if ( is_active_sidebar( 'sidebar-1' ) || is_archive() || is_search() || is_home() || is_page() ) {
		if ( ! ( is_page() && 'one-column' === get_theme_mod( 'page_options' ) ) && 767 <= $width ) {
			$sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'wireframe_content_image_sizes_attr', 10, 2 );

/**
 * Filter the `sizes` value in the header image markup.
 *
 * @since Wireframe 1.0
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function wireframe_header_image_tag( $html, $header, $attr ) {
	if ( isset( $attr['sizes'] ) ) {
		$html = str_replace( $attr['sizes'], '100vw', $html );
	}
	return $html;
}
add_filter( 'get_header_image_tag', 'wireframe_header_image_tag', 10, 3 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @since Wireframe 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return array The filtered attributes for the image markup.
 */
function wireframe_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( is_archive() || is_search() || is_home() ) {
		$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'wireframe_post_thumbnail_sizes_attr', 10, 3 );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since Wireframe 1.0
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function wireframe_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template', 'wireframe_front_page_template' );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since Wireframe 1.4
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function wireframe_widget_tag_cloud_args( $args ) {
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';
	$args['format']   = 'list';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'wireframe_widget_tag_cloud_args' );

/**
 * Get unique ID.
 *
 * This is a PHP implementation of Underscore's uniqueId method. A static variable
 * contains an integer that is incremented with each call. This number is returned
 * with the optional prefix. As such the returned value is not universally unique,
 * but it is unique across the life of the PHP process.
 *
 * @since Wireframe 2.0
 * @see wp_unique_id() Themes requiring WordPress 5.0.3 and greater should use this instead.
 *
 * @staticvar int $id_counter
 *
 * @param string $prefix Prefix for the returned ID.
 * @return string Unique ID.
 */
function wireframe_unique_id( $prefix = '' ) {
	static $id_counter = 0;
	if ( function_exists( 'wp_unique_id' ) ) {
		return wp_unique_id( $prefix );
	}
	return $prefix . (string) ++$id_counter;
}

/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );





function wpdocs_custom_excerpt_length( $length ) {
    return 100;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );






/**
	* Queue up stylesheets for the parent theme.
	*
  * @function add_custom_stylesheets
  *
  */

	function add_base_stylesheets() {
		$basedir = get_template_directory_uri() .'/styles';
		$styles = array(
			'main' => 'main.css',
			'structure' => 'structure.css',
			'sidebar' => 'sidebar.css',
			'header' => 'header.css',
			'menu' => 'menu.css',
			'menu-accordion' => 'menu-accordion.css',
			'post' => 'post.css',
			'footer' => 'footer.css',
			'overlay' => 'overlay.css',
			'home' => 'home.css'
		);
	
		// Explicitly queueing of parent theme style.css required for child themes.
		if(is_child_theme_active()) {
			wp_enqueue_style('parent-styles',get_template_directory_uri().'/style.css');
		}
	
	
		if(!is_child_theme_active()) {
			foreach($styles as $id => $uri) {
				wp_enqueue_style($id,$basedir.'/'.$uri);
			}
		} else {
			foreach($styles as $id => $uri) {
				wp_enqueue_style($id,$basedir.'/'.$uri);
			}
		}
	
		
		// print debug_styles();
	}


function is_child_theme_active() {
	return strtolower(wp_get_theme()) != "wireframe";
}






if(function_exists('add_base_stylesheets')) {
	add_action('wp_enqueue_scripts', 'add_base_stylesheets');
}

// Only called when the child theme declares this function.
if(function_exists('add_child_stylesheets')) {
	add_action('wp_enqueue_scripts', 'add_child_stylesheets');
}


function wireframe_has_menu_content(){
	foreach(array('menu-loc-1','menu-loc-2','menu-loc-3') as $id) {
		if(has_nav_menu($id)) return true;
	}
	
	return false;
}



function wireframe_get_template_part($slug, $name=null) {
	$file = null == $name ? $slug : $slug.'-'.$name;
	$path = get_template_directory().'/'.$file.'.php';
	if(!file_exists($path)) {
		throw new Exception('Could not locate template file: '.$path);
	}
	get_template_part($slug,$name);
}


// https://developer.wordpress.org/reference/functions/add_rewrite_rule/
function wireframe_add_rewrite_rule(){
	add_action('init', function() {
 
			$page_id = 2; // update 2 (sample page) to your custom page ID where you can get the subscriber(s) data later
			$page_data = get_post( $page_id );
 
			if( ! is_object($page_data) ) { // post not there
					return;
			}
 
			add_rewrite_rule(
					'^content/([^/]+)/?$',
					'index.php?pagename=content&content=$matches[1]',
					'top'
			);
 
	});
	
	/*
	add_filter('query_vars', function($vars) {
    $vars[] = "my_subscriber";
    return $vars;
	});
	*/
}