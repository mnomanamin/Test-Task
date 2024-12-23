<?php

/**
 * My Theme functions and definitions
 */


if (!function_exists('site_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function site_setup()
	{
		// This is Theme Setting For Changing Logo
		add_theme_support('custom-logo');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		// Add support for editor styles.
		add_theme_support('editor-styles');

		// Enqueue editor styles.
		add_editor_style('style-editor.css');

		// Add support for responsive embedded content.
		add_theme_support('responsive-embeds');

		//Register Nav Menu
		register_nav_menus(array());
	}
endif;

add_action('after_setup_theme', 'site_setup');


/**
 * Theme Setting for changing Font Color
 */
function site_font_color($wp_customize) {
    $wp_customize->add_setting('theme_color', [
        'default' => '#000000',
        'transport' => 'refresh',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'theme_color', [
        'label' => 'Theme Color',
        'section' => 'colors',
        'settings' => 'theme_color',
    ]));
}
add_action('customize_register', 'site_font_color');
function custom_theme_dynamic_styles() {
    $theme_color = get_theme_mod('theme_color', '#ffffff');
    ?>
    <style>
        body {
            background-color: <?php echo esc_attr($theme_color); ?>;
        }
    </style>
    <?php
}

add_action('wp_head', 'custom_theme_dynamic_styles');

/**
 * Enqueue scripts and styles.
 */
function theme_scripts()
{
	wp_enqueue_style('theme-styles', get_stylesheet_directory_uri() . '/assets/css/style.css', array(), '2.0', 'all');
	wp_enqueue_script('theme-script', get_template_directory_uri() . '/assets/js/custom.js', array(), null, true);
	wp_localize_script('theme-script', 'infiniteScrollData', [
		'ajaxUrl'        => admin_url('admin-ajax.php'),
		'container'      => '.blogs__item-row',
		'loaderSelector' => '.loader-container',
		'action'         => 'load_more_posts',
	]);
}
add_action('wp_enqueue_scripts', 'theme_scripts');


function load_more_posts() {
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;

	// var_dump($_POST['page']);die;

    $args = [
        'post_type'      => 'post',
        'posts_per_page' => 6,
        'paged'          => $paged,
        'post_status'    => 'publish',
    ];

    $query = new WP_Query($args);
   // Start output buffering to capture the content
   	ob_start();

    if ($query->have_posts()) {
        
            ?>

				<?php while ($query->have_posts()) : $query->the_post(); ?>
					<div class="blogs__item-column">
						<a href="<?php the_permalink(); ?>" class="blogs__item-wapper">
							<div class="blog__featured-img">
								<?php the_post_thumbnail('full'); ?>
							</div>
							<div class="blog__featured-info">
								<h3><?php the_title(); ?></h3>
								<p><?php echo get_the_date(); ?></p>
							</div>
						</a>
					</div>
				<?php endwhile; ?>

			<?php
        
        // Get total pages and check if we're on the last page
        $total_pages = $query->max_num_pages;
        $current_page = $paged;
        $is_last_page = ($current_page >= $total_pages) ? true : false;

        // Send response in JSON format with content and last-page status
        $response = [
            'content' => ob_get_clean(),
            'is_last_page' => $is_last_page,
        ];

        echo json_encode($response); 
    } else {
        echo json_encode(['content' => '', 'is_last_page' => true]);
    }

    wp_reset_postdata();
    wp_die();
}

add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');
function add_rating_meta_box() {
    add_meta_box(
        'page_rating',
        'Page Rating',
        'display_rating_meta_box',
        'page',
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'add_rating_meta_box');

function display_rating_meta_box($post) {
    $rating = get_post_meta($post->ID, '_page_rating', true);
    ?>
    <label for="page_rating">Rating (1 to 5):</label>
    <select id="page_rating" name="page_rating">
        <?php for ($i = 1; $i <= 5; $i++) : ?>
            <option value="<?php echo $i; ?>" <?php selected($rating, $i); ?>><?php echo $i; ?></option>
        <?php endfor; ?>
    </select>
    <?php
}

function save_rating_meta_box($post_id) {
    if (isset($_POST['page_rating'])) {
        update_post_meta($post_id, '_page_rating', sanitize_text_field($_POST['page_rating']));
    }
}
add_action('save_post', 'save_rating_meta_box');
