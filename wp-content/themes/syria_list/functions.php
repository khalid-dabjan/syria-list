<?php
/**
 * syria_list functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package syria_list
 */

class comment_walker extends Walker_Comment {
	var $tree_type = 'comment';
	var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );

	// constructor – wrapper for the comments list
	function __construct() { ?>

        <section class="bg-grey-lighter my-3 p-3">
        <h2 class="text-blue">Comments:</h2>

	<?php }

	// start_lvl – wrapper for child comments list
function start_lvl( &$output, $depth = 0, $args = array() ) {
	$GLOBALS['comment_depth'] = $depth + 2; ?>

    <section class="ml-6 my-3">

<?php }

	// end_lvl – closing wrapper for child comments list
function end_lvl( &$output, $depth = 0, $args = array() ) {
	$GLOBALS['comment_depth'] = $depth + 2; ?>

    </section>

<?php }

	// start_el – HTML for comment template
function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
	$depth ++;
	$GLOBALS['comment_depth'] = $depth;
	$GLOBALS['comment']       = $comment;
	$parent_class             = ( empty( $args['has_children'] ) ? '' : 'parent' );

	if ( 'article' == $args['style'] ) {
		$tag       = 'article';
		$add_below = 'comment';
	} else {
		$tag       = 'article';
		$add_below = 'comment';
	} ?>

    <article class="" id="comment-<?php comment_ID() ?>" itemprop="comment">
    <!--    <figure class="gravatar">-->
	<?php //echo get_avatar( $comment, 65, '[default gravatar URL]', 'Author’s gravatar' ); ?><!--</figure>-->
    <div class="" role="complementary">
        <div class="text-grey-darkest ">
            <h2 class="mb-1"><?php comment_author(); ?></h2>
            <span><?php comment_text() ?></span>
        </div>
        <!--        <time class="comment-meta-item" datetime="--><?php //comment_date( 'Y-m-d' ) ?><!--T-->
		<?php //comment_time( 'H:iP' ) ?><!--"-->
        <!--              itemprop="datePublished">--><?php //comment_date( 'jS F Y' ) ?><!--, <a href="#comment--->
		<?php //comment_ID() ?><!--"-->
        <!--                                                                             itemprop="url">-->
		<?php //comment_time() ?><!--</a>-->
        <!--        </time>-->
		<?php edit_comment_link( '<p class="">Edit this comment</p>', '', '' ); ?>
		<?php if ( $comment->comment_approved == '0' ) : ?>
            <p class="comment-meta-item">Your comment is awaiting moderation.</p>
		<?php endif; ?>
    </div>
    <div class="comment-content post-content" itemprop="text">

		<?php comment_reply_link( array_merge( $args, array(
			'add_below' => $add_below,
			'depth'     => $depth,
			'max_depth' => $args['max_depth']
		) ) ) ?>
    </div>

<?php }

	// end_el – closing HTML for comment template
function end_el( &$output, $comment, $depth = 0, $args = array() ) { ?>

    </article>

<?php }

	// destructor – closing wrapper for the comments list
	function __destruct() { ?>

        </section>

	<?php }

}

if ( ! function_exists( 'syria_list_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function syria_list_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on syria_list, use a find and replace
		 * to change 'syria_list' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'syria_list', get_template_directory() . '/languages' );

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
		register_nav_menus(
			array(
				'header-menu'         => __( 'Header Menu' ),
				'content-footer-menu' => __( 'Content Footer Menu' ),
				'about-footer-menu'   => __( 'About Footer Menu' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'syria_list_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'syria_list_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function syria_list_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'syria_list_content_width', 640 );
}

add_action( 'after_setup_theme', 'syria_list_content_width', 0 );


/**
 * Enqueue scripts and styles.
 */
function syria_list_scripts() {
	wp_register_script( 'jQuery', 'https://code.jquery.com/jquery-3.3.1.min.js', null, null, true );
	wp_enqueue_script( 'jQuery' );

	wp_register_script( 'Select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js', null, null, true );
	wp_enqueue_script( 'Select2' );

	wp_register_style( 'Select2_css', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css' );
	wp_enqueue_style( 'Select2_css' );

	wp_enqueue_script( 'syria_list-custom_script', get_template_directory_uri() . '/js/main.js', array(), time(), true );
	wp_enqueue_style( 'syria_list-style', get_stylesheet_uri() );
	wp_localize_script( 'syria_list-custom_script', 'ajax_object',
		[
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'local'    => get_locale(),
			'trans'    => [
				'categories' => __( 'Categories', 'syria_list' )
			]
		] );
	if ( get_locale() === 'ar' ) {
		wp_register_style( 'rtl', get_template_directory_uri() . '/rtl.css' );
		wp_enqueue_style( 'rtl' );
	}

//	wp_enqueue_script( 'syria_list-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

//	wp_enqueue_script( 'syria_list-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

//	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
//		wp_enqueue_script( 'comment-reply' );
//	}
}

add_action( 'wp_enqueue_scripts', 'syria_list_scripts' );

function pluck_from_meta( $meta, $key ) {
	return isset( $meta[ $key ] ) && isset( $meta[ $key ][0] ) ? $meta[ $key ][0] : null;
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function getSimilarPlaces( $post, $count = 4 ) {
	$cats = implode( ',', array_map( function ( $cat ) {
		return $cat->term_id;
	}, get_the_category() ) );

	$posts = get_posts( [
		'post_status'    => 'publish',
		'post__not_in'   => [ $post->ID ],
		'posts_per_page' => $count,
		'post_type'      => 'business',
		'cat'            => $cats
	] );

	return $posts;

}

function isLTR() {
	return get_locale() === 'ar';
}

function syria_list_add_custom_types( $query ) {
	if ( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
		$query->set( 'post_type', array(
			'post',
			'nav_menu_item',
			'business'
		) );

		return $query;
	}
}

add_filter( 'pre_get_posts', 'syria_list_add_custom_types' );


// Add featured image sizes
add_image_size( 'featured-large', 640, 294, true ); // width, height, crop
add_image_size( 'featured-small', 320, 147, true );


function custom_rating_image_extension() {
	return 'png';
}

add_filter( 'wp_postratings_image_extension', 'custom_rating_image_extension' );

function syria_list_ajax_search() {
	$theQuery = new WP_Query( getSearchArgs() );

	ob_start();
	if ( $theQuery->have_posts() ) {
		while ( $theQuery->have_posts() ) {
			$theQuery->the_post();
			?>
            <div class="w-full md:w-1/2 lg:w-1/4 px-2 pb-3">
				<?php get_template_part( 'template-parts/content', 'busin' ) ?>
            </div>
			<?php
			wp_reset_postdata();
		}
	}
	$html = ob_get_clean();
	ob_end_clean();
	echo json_encode( [
		'count' => $theQuery->found_posts,
		'html'  => $html
	] );
	wp_die();
}

add_action( 'wp_ajax_sl_search', 'syria_list_ajax_search' );
add_action( 'wp_ajax_nopriv_sl_search', 'syria_list_ajax_search' );
function getSearchArgs() {
//    return [];
	$count                  = 16;
	$args['post_type']      = 'business';
	$args['posts_per_page'] = $count;
	$args['post_status']    = 'published';

	if ( ! empty( $_GET['offset'] ) ) {
		$args['offset'] = $count * $_GET['offset'];
	}

	if ( ! empty( $_GET['s'] ) ) {
		$args['s'] = $_GET['s'];
	}
	if ( ! empty( $_GET['categories'] ) ) {
		$args['cat'] = $_GET['categories'];
	}
	if ( ! empty( $_GET['city'] ) ) {
		$args['tax_query'] = [
			[
				'taxonomy' => 'city',
				'terms'    => $_GET['city'],
			]
		];
	}
	if ( ! empty( $_GET['type'] ) && $_GET['type'] === 'partners' ) {
		$args['meta_query'] = [
			'key'   => 'is_partner',
			'value' => '1',
		];
	}

	return $args;
}

function getCities() {
	return get_terms( [
		'taxonomy'   => 'city',
		'hide_empty' => false
	] );
}

function getCategories() {
	$all = get_terms( [
		'taxonomy' => 'category'
	] );

	$mains = array_filter( $all, function ( $c ) {
		return $c->parent === 0 AND $c->slug !== 'uncategorized';
	} );
	foreach ( $mains as $key => $main ) {
		$currentChildren         = array_filter( $all, function ( $c ) use ( $main ) {
			return $c->parent === $main->term_id;
		} );
		$mains[ $key ]->children = $currentChildren;
	}

	return $mains;
}

function my_acf_google_map_api( $api ) {

	$api['key'] = 'AIzaSyAWM6zS3GB5lkhbb27VIYZ3T80miumkdxE';

	return $api;

}

add_filter( 'acf/fields/google_map/api', 'my_acf_google_map_api' );

function filterContent( $content ) {
	preg_match_all( '(?:[a-z0-9!#$%&\'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])', $content, $emails );
//	die;
}

add_filter( 'the_content', 'filterContent' );


