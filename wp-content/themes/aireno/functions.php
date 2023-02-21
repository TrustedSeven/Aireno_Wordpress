<?php
define('TEXT_DOMAIN', 'aireno');
define('AIRENO_VERSION', '1.0');

const AIRENO_CPT_PROJECT = 'project';
const AIRENO_CPT_TEMPLATE = 'template';
const AIRENO_CPT_SCOPE = 'scope';
const AIRENO_CPT_PAYMENT = 'payment';
const AIRENO_CPT_INVOICE = 'invoice';
const AIRENO_CPT_PAYMENT_TEMPLATE = 'payment_template';
const AIRENO_CPT_SCHEDULE_TEMPLATE = 'schedule_template';
const AIRENO_CPT_ACTIVITY = 'activity';
const AIRENO_CPT_NOTE = 'note';
const AIRENO_CPT_TASK = 'task';
const AIRENO_CPT_MESSAGE = 'message';
const AIRENO_CPT_SCHEDULE = 'schedule';
const AIRENO_CPT_NOTIFICATION = 'ai_notification';

const AIRENO_FILE_TYPES = array(
    'project' => 'Project Photo',
    'plans' => 'Plans',
    'inspiration' => 'Inspiration',
    'before' => 'Before Photos',
    'after' => 'After Photos',
    'miscellaneous' => 'Miscellaneous',
);

const PREVIEW_ALLOWED_IMG_FILE_TYPES = array(
    'png' => 'image/png',
    'jpeg' => 'image/jpeg',
    'jpg' => 'image/jpg',
    'bmp' => 'image/bmp',
    'jpe' => 'image/jpe',
    'gif' => 'image/gif',
    'webp' => 'image/webp',
);
const ALLOWED_IMG_FILE_TYPES = array(
    'png' => 'image/png',
    'jpeg' => 'image/jpeg',
    'jpg' => 'image/jpg',
    'bmp' => 'image/bmp',
    'jpe' => 'image/jpe',
    'gif' => 'image/gif',
    'ico' => 'image/ico',
    'svg' => 'image/svg',
    'svgz' => 'image/svgz',
    'tif' => 'image/tif',
    'tiff' => 'image/tiff',
    'ai' => 'image/ai',
    'drw' => 'image/drw',
    'pct' => 'image/pct',
    'psp' => 'image/psp',
    'xcf' => 'image/xcf',
    'psd' => 'image/psd',
    'raw' => 'image/raw',
    'webp' => 'image/webp',
);
const ALLOWED_OTHER_FILE_TYPES = array(
    'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    'xls' => 'application/vnd.ms-excel',
    'csv' => 'application/vnd.ms-excel',
    'txt' => 'text/plain',
    'pdf' => 'application/pdf',
    'doc' => 'application/msword',
    'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
);

const AIRENO_PAYMENT_STATUSES = array(
    'Pending' => 'Pending',
    'Ready' => 'Ready',
    'Cancelled' => 'Cancelled',
    'Paid' => 'Paid',
);

const AIRENO_PROJECT_STATUSES = array(
    'quote' => 'Estimate',
    'active' => 'Reviewing',
    'updated' => 'Updated Estimated',
    'booked' => 'Site Visit',
    'pending' => 'Final Quote',
    'live' => 'Working',
    'completed' => 'Completed',
    'cancelled' => 'Closed',
);

const AIRENO_SCHEDULE_STATUSES = array(
    0 => 'Yet to start',
    1 => 'In Process',
    2 => 'Complete',
);
/* for removing ul li and add comments before <div> and <a> tag in wp_nav_menu we use this function */

class Aireno_Walker_Nav_Menu extends Walker_Nav_Menu
{
    function start_el(&$output, $data_object, $depth = 0, $args = null, $current_object_id = 0)
    {
        // Restores the more descriptive, specific name for use within this method.
        $menu_item = $data_object;

        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = ($depth) ? str_repeat($t, $depth) : '';

        $classes = empty($menu_item->classes) ? array() : (array)$menu_item->classes;
        $classes[] = 'menu-item-' . $menu_item->ID;

        /**
         * Filters the arguments for a single nav menu item.
         *
         * @param stdClass $args An object of wp_nav_menu() arguments.
         * @param WP_Post $menu_item Menu item data object.
         * @param int $depth Depth of menu item. Used for padding.
         * @since 4.4.0
         *
         */
        $args = apply_filters('nav_menu_item_args', $args, $menu_item, $depth);

        /**
         * Filters the CSS classes applied to a menu item's list item element.
         *
         * @param string[] $classes Array of the CSS classes that are applied to the menu item's `<li>` element.
         * @param WP_Post $menu_item The current menu item object.
         * @param stdClass $args An object of wp_nav_menu() arguments.
         * @param int $depth Depth of menu item. Used for padding.
         * @since 3.0.0
         * @since 4.1.0 The `$depth` parameter was added.
         *
         */
        $class_names = implode(' ', apply_filters('nav_menu_css_class', array_filter($classes), $menu_item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        /**
         * Filters the ID applied to a menu item's list item element.
         *
         * @param string $menu_id The ID that is applied to the menu item's `<li>` element.
         * @param WP_Post $menu_item The current menu item.
         * @param stdClass $args An object of wp_nav_menu() arguments.
         * @param int $depth Depth of menu item. Used for padding.
         * @since 3.0.1
         * @since 4.1.0 The `$depth` parameter was added.
         *
         */
        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $menu_item->ID, $menu_item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<div' . $id . $class_names . '>';

        $atts = array();
        $atts['title'] = !empty($menu_item->attr_title) ? $menu_item->attr_title : '';
        $atts['target'] = !empty($menu_item->target) ? $menu_item->target : '';
        if ('_blank' === $menu_item->target && empty($menu_item->xfn)) {
            $atts['rel'] = 'noopener';
        } else {
            $atts['rel'] = $menu_item->xfn;
        }
        $atts['href'] = !empty($menu_item->url) ? $menu_item->url : '';
        $atts['aria-current'] = $menu_item->current ? 'page' : '';
        $atts['class'] = 'menu-link fw-bolder text-hover-dark nav-link btn btn-active-secondary';
        /**
         * Filters the HTML attributes applied to a menu item's anchor element.
         *
         * @param array $atts {
         *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
         *
         * @type string $title Title attribute.
         * @type string $target Target attribute.
         * @type string $rel The rel attribute.
         * @type string $href The href attribute.
         * @type string $aria -current The aria-current attribute.
         * }
         * @param WP_Post $menu_item The current menu item object.
         * @param stdClass $args An object of wp_nav_menu() arguments.
         * @param int $depth Depth of menu item. Used for padding.
         * @since 3.6.0
         * @since 4.1.0 The `$depth` parameter was added.
         *
         */
        $atts = apply_filters('nav_menu_link_attributes', $atts, $menu_item, $args, $depth);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (is_scalar($value) && '' !== $value && false !== $value) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        /** This filter is documented in wp-includes/post-template.php */
        $title = apply_filters('the_title', $menu_item->title, $menu_item->ID);

        /**
         * Filters a menu item's title.
         *
         * @param string $title The menu item's title.
         * @param WP_Post $menu_item The current menu item object.
         * @param stdClass $args An object of wp_nav_menu() arguments.
         * @param int $depth Depth of menu item. Used for padding.
         * @since 4.4.0
         *
         */
        $title = apply_filters('nav_menu_item_title', $title, $menu_item, $args, $depth);

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        /**
         * Filters a menu item's starting output.
         *
         * The menu item's starting output only includes `$args->before`, the opening `<a>`,
         * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
         * no filter for modifying the opening and closing `<li>` for a menu item.
         *
         * @param string $item_output The menu item's starting HTML output.
         * @param WP_Post $menu_item Menu item data object.
         * @param int $depth Depth of menu item. Used for padding.
         * @param stdClass $args An object of wp_nav_menu() arguments.
         * @since 3.0.0
         *
         */
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $menu_item, $depth, $args);
        $output .= '</div>';
    }
}

require_once 'functions/aireno-options.php';
require_once 'functions/class-aireno-svg-icons.php';
require_once 'functions/template-functions.php';
require_once 'functions/general-functions.php';
require_once 'includes/post-types.php';
require_once 'functions/project.php';

require_once 'functions/pmpro-integration.php';
require_once 'functions/asp-integration.php';

require_once 'functions/ajax/auth.php';
require_once 'functions/ajax/quote.php';
require_once 'functions/ajax/project.php';
require_once 'functions/ajax/scope.php';
require_once 'functions/ajax/profile.php';

/**
 * theme setup
 * add theme support - custom header, custom logo, title tag
 * register nav menus
 */
function aireno_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('page-attributes');
    add_theme_support(
        'custom-logo',
        array(
            'width' => 90,
            'height' => 90,
            'flex-width' => true,
            'flex-height' => true,
            'header-text' => array('site-title', 'site-description'),
            'unlink-homepage-logo' => true,
        )
    );

    register_nav_menus(
        array(
            'primary' => __('Primary Menu', TEXT_DOMAIN),
        )
    );
    register_nav_menus(
        array(
            'footer' => __('Footer Menu', TEXT_DOMAIN),
        )
    );

    // Define and register starter content to showcase the theme on new sites.
    $starter_content = array(
        'widgets' => array(
            // Add business info widget to the footer 1 area.
            'footer-sidebar-1' => array(
                'text_about',
            ),

            // Put widgets in the footer 2 area.
            'footer-sidebar-2' => array(
                'recent-posts',
            ),
            // Putwidgets in the footer 3 area.
            'footer-sidebar-3' => array(
                'categories',
            ),

        ),

        // Set up nav menus for each of the two areas registered in the theme.
        'nav_menus' => array(
            // Assign a menu to the "top" location.
            'primary' => array(
                'name' => __('Primary Menu', TEXT_DOMAIN),
                'items' => array(
                    'link_home', // "home" page is actually a link in case a static front page is not used.
                ),
            ),
        ),
        // Assign a menu to the "footer" location.
        'footer' => array(
            'name' => __('Footer Menu', TEXT_DOMAIN),
            'items' => array(
                'link_home', // "home" page is actually a link in case a static front page is not used.
            ),
        ),
    );
    add_theme_support('starter-content', $starter_content);

    $args = array(
        'width' => 1170,
        'height' => 784,
        'flex-width' => true,
        'flex-height' => true,
        'uploads' => true,
        'default-image' => get_theme_file_uri() . '/assets/images/header.png',
        'random-default' => false,
        'header-text' => true,

    );
    //    add_theme_support('custom-header', $args);

//    add_filter('cron_schedules', 'aireno_add_wp_cron_schedule');
//    aireno_task_setup_cron_events();
}

add_action('after_setup_theme', 'aireno_setup');

/**
 * register theme sidebars
 */
function aireno_widgets_init()
{
    /* footer sidebar */
    register_sidebar(
        array(
            'name' => __('Footer 1', TEXT_DOMAIN),
            'id' => 'footer-sidebar-1',
            'description' => __('Add widgets here to appear in your footer.', TEXT_DOMAIN),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name' => __('Footer 2', TEXT_DOMAIN),
            'id' => 'footer-sidebar-2',
            'description' => __('Add widgets here to appear in your footer.', TEXT_DOMAIN),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name' => __('Footer 3', TEXT_DOMAIN),
            'id' => 'footer-sidebar-3',
            'description' => __('Add widgets here to appear in your footer.', TEXT_DOMAIN),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name' => __('Blog SideBar', TEXT_DOMAIN),
            'id' => 'blog-sidebar',
            'description' => __('Add widgets here to appear in Blog SideBar.', TEXT_DOMAIN),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );
}

add_action('widgets_init', 'aireno_widgets_init');

add_filter('login_headerurl', 'aireno_login_url');
function aireno_login_url($url)
{
    return aireno_get_page_link_by_name('login');
}

add_action('init', 'aireno_custom_login');
function aireno_custom_login()
{
    global $pagenow;
    //  URL for the HomePage. You can set this to the URL of any page you wish to redirect to.
    $aireno_login_page = aireno_get_page_link_by_name('login');
    //  Redirect to the Homepage, if if it is login page. Make sure it is not called to logout
    //  or for lost password feature
    if ('wp-login.php' == $pagenow && $_GET['action'] != "logout" && $_GET['action'] != "lostpassword") {
        wp_redirect($aireno_login_page);
        exit();
    }
}

function aireno_enqueue_scripts()
{
    //global css
    wp_enqueue_style('aireno-plugin-bundle-css', get_template_directory_uri() . '/assets/css/plugins.bundle.css', array(), AIRENO_VERSION, 'all');
    wp_enqueue_style('aireno-style-bundle-css', get_template_directory_uri() . '/assets/css/style.bundle.css', array(), AIRENO_VERSION, 'all');
    wp_enqueue_style('aireno-theme-style', get_template_directory_uri() . '/style.css', array(), AIRENO_VERSION, 'all');
    //global javascript
    wp_enqueue_script('aireno-plugin-bundle-js', get_template_directory_uri() . '/assets/js/plugins.bundle.js', array(), AIRENO_VERSION, true);
    wp_enqueue_script('aireno-script-bundle-js', get_template_directory_uri() . '/assets/js/scripts.bundle.js', array(), AIRENO_VERSION, true);

    $aireno = array(
        'ajax_url' => admin_url('admin-ajax.php'),
    );
    wp_localize_script('aireno-script-bundle-js', 'aireno', $aireno);

    wp_enqueue_script(
        'aireno-general',
        get_template_directory_uri() . '/assets/js/general.js',
        array(),
        AIRENO_VERSION,
        true
    );

    if (is_author()) {
        wp_enqueue_script(
            'aireno-lightbox',
            get_template_directory_uri() . '/assets/js/fslightbox.bundle.js',
            array(),
            AIRENO_VERSION,
            true
        );
    }

    if (is_front_page()) {
        wp_enqueue_script(
            'aireno-fslightbox-bundle',
            get_template_directory_uri() . '/assets/js/fslightbox.bundle.js',
            array(),
            AIRENO_VERSION,
            true
        );
        wp_enqueue_script(
            'aireno-typedjs-bundle',
            get_template_directory_uri() . '/assets/js/typedjs.bundle.js',
            array(),
            AIRENO_VERSION,
            true
        );
        wp_enqueue_script(
            'aireno-landing',
            get_template_directory_uri() . '/assets/js/landing.js',
            array(),
            AIRENO_VERSION,
            true
        );
        wp_enqueue_script(
            'aireno-pricing-general',
            get_template_directory_uri() . '/assets/js/general.js',
            array(),
            AIRENO_VERSION,
            true
        );
    }

    if (is_single()) {
        global $post;
        switch ($post->post_type) {
            case AIRENO_CPT_PROJECT:
                $author_id = get_current_user_id();
                $avatar = get_field('_avatar', 'user_' . $author_id);
                $author_data = aireno_get_userdata($author_id);
                $author = $author_data->display_name;
                if ($avatar) {
                    $avatar_url = $avatar['sizes']['thumbnail'];
                } else {
                    $avatar_url = get_avatar_url($author_id);
                }

                $args = array(
                    'post_type' => AIRENO_CPT_SCHEDULE,
                    'post_status' => array('publish'),
                    'posts_per_page' => -1,
                    'meta_query' => array(
                        'key' => 'project_id',
                        'value' => $post->ID,
                        'compare' => '=',
                        'type' => 'numeric',
                    ),
                );
                $schedule_query = new WP_Query($args);
                $schedules = array();
                if ($schedule_query->have_posts()) {
                    while ($schedule_query->have_posts()) {
                        $schedule_query->the_post();
                        $schedules[] = get_the_ID();
                    }
                }
                wp_reset_query();

                $aireno_project = array(
                    'project_id' => $post->ID,
                    'user_display_name' => $author,
                    'user_avatar_url' => $avatar_url,
                    'user_id' => $author_id,
                    'project_fee' => floatval(get_field('fee', $post->ID)),
                    'schedules' => $schedules,
                );
                wp_enqueue_style(
                    'aireno-aside-css',
                    get_template_directory_uri() . '/assets/css/aside.css',
                    array(),
                    AIRENO_VERSION,
                    'all'
                );
                wp_enqueue_style(
                    'aireno-project-css',
                    get_template_directory_uri() . '/assets/css/project.css',
                    array(),
                    AIRENO_VERSION,
                    'all'
                );
                wp_enqueue_script(
                    'aireno-lightbox',
                    get_template_directory_uri() . '/assets/js/fslightbox.bundle.js',
                    array(),
                    AIRENO_VERSION,
                    true
                );
                wp_enqueue_script(
                    'aireno-datatables-bundle',
                    get_template_directory_uri() . '/assets/js/datatables.bundle.js',
                    array(),
                    AIRENO_VERSION,
                    true
                );
                wp_enqueue_script(
                    'aireno-single-project',
                    get_template_directory_uri() . '/assets/js/single-project.js',
                    array(),
                    AIRENO_VERSION,
                    true
                );
                wp_localize_script('aireno-single-project', 'aireno_project', $aireno_project);
                break;
            case AIRENO_CPT_SCOPE:
                wp_enqueue_script(
                    'aireno-jquery-ui-js',
                    get_template_directory_uri() . '/assets/js/jquery-ui.js',
                    array('jquery'),
                    AIRENO_VERSION,
                    true
                );
                wp_enqueue_style(
                    'aireno-jquery-ui-css',
                    get_template_directory_uri() . '/assets/css/jquery-ui.css',
                    array(),
                    AIRENO_VERSION,
                    'all'
                );

                $project_id = get_field('project_id', $post->ID);
                $aireno_scope = array(
                    'scope_id' => $post->ID,
                    'project_id' => $project_id,
                );

                wp_enqueue_style(
                    'aireno-aside-css',
                    get_template_directory_uri() . '/assets/css/aside.css',
                    array(),
                    AIRENO_VERSION,
                    'all'
                );
                wp_enqueue_style(
                    'aireno-quote-css',
                    get_template_directory_uri() . '/assets/css/quote-4.css',
                    array(),
                    AIRENO_VERSION,
                    'all'
                );
                wp_enqueue_script(
                    'aireno-single-scope',
                    get_template_directory_uri() . '/assets/js/single-scope-1.js',
                    array(),
                    AIRENO_VERSION,
                    true
                );
                wp_localize_script('aireno-single-scope', 'aireno_scope', $aireno_scope);
                break;
            default:
                break;
        }
    }

    if (is_post_type_archive(AIRENO_CPT_PROJECT)) {
        wp_enqueue_script(
            'aireno-datatables-bundle',
            get_template_directory_uri() . '/assets/js/datatables.bundle.js',
            array(),
            AIRENO_VERSION,
            true
        );
        wp_enqueue_script(
            'aireno-projects',
            get_template_directory_uri() . '/assets/js/projects.js',
            array(),
            AIRENO_VERSION,
            true
        );
    }

    if (is_page_template('page-register.php')) {
        //https://www.cunninghamsautocare.com/  full calendar
        wp_enqueue_script(
            'aireno-auth-signup',
            get_template_directory_uri() . '/assets/js/signup-general.js',
            array(),
            AIRENO_VERSION,
            true
        );
    } else if (is_page_template('page-login.php')) {
        //https://www.cunninghamsautocare.com/  full calendar
        wp_enqueue_script(
            'aireno-auth-signup',
            get_template_directory_uri() . '/assets/js/signin-general.js',
            array(),
            AIRENO_VERSION,
            true
        );
    } else if (is_page_template('page-lostpassword.php')) {
        wp_enqueue_script(
            'aireno-auth-signup',
            get_template_directory_uri() . '/assets/js/password-reset.js',
            array(),
            AIRENO_VERSION,
            true
        );
    } else if (is_page_template('page-faqs.php')) {
    } else if (is_page_template('page-about.php')) {
    } else if (is_page_template('page-quotes.php')) {
        wp_enqueue_script(
            'aireno-quotes-js',
            get_template_directory_uri() . '/assets/js/quotes.js',
            array('jquery'),
            AIRENO_VERSION,
            true
        );
    } else if (is_page_template('page-add-quote.php')) {
        wp_enqueue_script(
            'aireno-jquery-ui-js',
            get_template_directory_uri() . '/assets/js/jquery-ui.js',
            array('jquery'),
            AIRENO_VERSION,
            true
        );
        wp_enqueue_style(
            'aireno-jquery-ui-css',
            get_template_directory_uri() . '/assets/css/jquery-ui.css',
            array(),
            AIRENO_VERSION,
            'all'
        );
        wp_enqueue_script(
            'aireno-quote-js',
            get_template_directory_uri() . '/assets/js/quote-1.js',
            array(),
            AIRENO_VERSION,
            true
        );
        wp_enqueue_style(
            'aireno-quote-style',
            get_template_directory_uri() . '/assets/css/quote-4.css',
            array(),
            AIRENO_VERSION,
            'all'
        );
    } else if (is_page_template('page-account-settings.php')) {
        wp_enqueue_script(
            'aireno-datatables-bundle-js',
            get_template_directory_uri() . '/assets/js/datatables.bundle.js',
            array(),
            AIRENO_VERSION,
            true
        );
        wp_enqueue_script(
            'aireno-lightbox',
            get_template_directory_uri() . '/assets/js/fslightbox.bundle.js',
            array(),
            AIRENO_VERSION,
            true
        );
        wp_enqueue_script(
            'aireno-account-settings-js',
            get_template_directory_uri() . '/assets/js/account-settings.js',
            array(),
            AIRENO_VERSION,
            true
        );
        wp_enqueue_script(
            'aireno-profile-details-js',
            get_template_directory_uri() . '/assets/js/profile-details-1.js',
            array(),
            AIRENO_VERSION,
            true
        );
        wp_enqueue_script(
            'aireno-deactivate-account-js',
            get_template_directory_uri() . '/assets/js/deactivate-account.js',
            array(),
            AIRENO_VERSION,
            true
        );
    } else if (is_page_template('page-account-overview.php')) {
        wp_enqueue_script(
            'aireno-datatables-bundle-js',
            get_template_directory_uri() . '/assets/js/datatables.bundle.js',
            array(),
            AIRENO_VERSION,
            true
        );
        wp_enqueue_script(
            'aireno-account-settings-js',
            get_template_directory_uri() . '/assets/js/contacts-2.js',
            array(),
            AIRENO_VERSION,
            true
        );
    } else {
        //begin::Page Vendor Stylesheets(used by this page)
        //        wp_enqueue_style('aireno-plugin-fullcalendar-css', get_template_directory_uri() . '/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css', array(), AIRENO_VERSION, 'all');
        //        wp_enqueue_style('aireno-plugin-datatables-css', get_template_directory_uri() . '/assets/plugins/custom/datatables/datatables.bundle.css', array(), AIRENO_VERSION, 'all');

        //Page Vendors Javascript(used by this page)
        //        wp_enqueue_script('aireno-fullcalendar-js', get_template_directory_uri() . '/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js', array(), AIRENO_VERSION, true);
        //        wp_enqueue_script('aireno-datatables-js', get_template_directory_uri() . '/assets/plugins/custom/datatables/datatables.bundle.js', array(), AIRENO_VERSION, true);

        //begin::Page Custom Javascript(used by this page)
        //        wp_enqueue_script('aireno-widgets-bundle-js', get_template_directory_uri() . '/assets/js/widgets.bundle.js', array(), AIRENO_VERSION, true);
        //        wp_enqueue_script('aireno-custom-widgets-js', get_template_directory_uri() . '/assets/js/custom/widgets.js', array(), AIRENO_VERSION, true);
        //        wp_enqueue_script('aireno-app-chat-js', get_template_directory_uri() . '/assets/js/custom/apps/chat/chat.js', array(), AIRENO_VERSION, true);
        //        wp_enqueue_script('aireno-upgrade-plan-js', get_template_directory_uri() . '/assets/js/custom/utilities/modals/upgrade-plan.js', array(), AIRENO_VERSION, true);
        //        wp_enqueue_script('aireno-create-app-js', get_template_directory_uri() . '/assets/js/custom/utilities/modals/create-app.js', array(), AIRENO_VERSION, true);
        //        wp_enqueue_script('aireno-user-search-js', get_template_directory_uri() . '/assets/js/custom/utilities/modals/users-search.js', array(), AIRENO_VERSION, true);
    }
}

add_action('wp_enqueue_scripts', 'aireno_enqueue_scripts');

function aireno_admin_enqueue_scripts()
{
    global $post;
    if (is_object($post) && $post->post_type == 'profile') {
        //global css
        wp_enqueue_style('aireno-plugin-bundle-css', get_template_directory_uri() . '/assets/plugins/global/plugins.bundle.css', array(), AIRENO_VERSION, 'all');
        wp_enqueue_style('aireno-style-bundle-css', get_template_directory_uri() . '/assets/css/style.bundle.css', array(), AIRENO_VERSION, 'all');
    }
}

add_action('admin_enqueue_scripts', 'aireno_admin_enqueue_scripts');

add_filter('show_admin_bar', '__return_false');
add_filter('acf/rest_api/field_settings/show_in_rest', '__return_true');

function aireno_body_classes($classes)
{

    global $post;
    //    $post_type = isset( $post ) ? $post->post_type : false;
    //
    //    // Check whether we're singular.
    //    if ( is_singular() ) {
    //        $classes[] = 'singular';
    //    }
    //
    //    // Check whether the current page should have an overlay header.
    //    if ( is_page_template( array( 'templates/template-cover.php' ) ) ) {
    //        $classes[] = 'overlay-header';
    //    }
    //
    //    // Check whether the current page has full-width content.
    //    if ( is_page_template( array( 'templates/template-full-width.php' ) ) ) {
    //        $classes[] = 'has-full-width-content';
    //    }
    //
    //    // Check for enabled search.
    //    if ( true === get_theme_mod( 'enable_header_search', true ) ) {
    //        $classes[] = 'enable-search-modal';
    //    }
    //
    //    // Check for post thumbnail.
    //    if ( is_singular() && has_post_thumbnail() ) {
    //        $classes[] = 'has-post-thumbnail';
    //    } elseif ( is_singular() ) {
    //        $classes[] = 'missing-post-thumbnail';
    //    }
    //
    //    // Check whether we're in the customizer preview.
    //    if ( is_customize_preview() ) {
    //        $classes[] = 'customizer-preview';
    //    }
    //
    //    // Check if posts have single pagination.
    //    if ( is_single() && ( get_next_post() || get_previous_post() ) ) {
    //        $classes[] = 'has-single-pagination';
    //    } else {
    //        $classes[] = 'has-no-pagination';
    //    }
    //
    //    // Check if we're showing comments.
    //    if ( $post && ( ( 'post' === $post_type || comments_open() || get_comments_number() ) && ! post_password_required() ) ) {
    //        $classes[] = 'showing-comments';
    //    } else {
    //        $classes[] = 'not-showing-comments';
    //    }
    //
    //    // Check if avatars are visible.
    //    $classes[] = get_option( 'show_avatars' ) ? 'show-avatars' : 'hide-avatars';
    //
    //    // Slim page template class names (class = name - file suffix).
    //    if ( is_page_template() ) {
    //        $classes[] = basename( get_page_template_slug(), '.php' );
    //    }
    //
    //    // Check for the elements output in the top part of the footer.
    //    $has_footer_menu = has_nav_menu( 'footer' );
    //    $has_social_menu = has_nav_menu( 'social' );
    //    $has_sidebar_1   = is_active_sidebar( 'sidebar-1' );
    //    $has_sidebar_2   = is_active_sidebar( 'sidebar-2' );
    //
    //    // Add a class indicating whether those elements are output.
    //    if ( $has_footer_menu || $has_social_menu || $has_sidebar_1 || $has_sidebar_2 ) {
    //        $classes[] = 'footer-top-visible';
    //    } else {
    //        $classes[] = 'footer-top-hidden';
    //    }
    //
    //    // Get header/footer background color.
    //    $header_footer_background = get_theme_mod( 'header_footer_background_color', '#ffffff' );
    //    $header_footer_background = strtolower( '#' . ltrim( $header_footer_background, '#' ) );
    //
    //    // Get content background color.
    //    $background_color = get_theme_mod( 'background_color', 'f5efe0' );
    //    $background_color = strtolower( '#' . ltrim( $background_color, '#' ) );
    //
    //    // Add extra class if main background and header/footer background are the same color.
    //    if ( $background_color === $header_footer_background ) {
    //        $classes[] = 'reduced-spacing';
    //    }
    //    $classes[] = "aside-enabled";
    //    $classes[] = "aside-fixed";

    return $classes;
}

add_filter('body_class', 'aireno_body_classes');

function aireno_excerpt_length($length)
{
    return 10;
}

add_filter('excerpt_length', 'aireno_excerpt_length');

//add_action('task_scheduled_cron', 'task_scheduled_cron');
function task_scheduled_cron()
{
    $today_time = current_time('timestamp');
    $changeDate = date('d/m/Y H:i');
    $project_args = array(
        'post_type' => AIRENO_CPT_PROJECT,
        'posts_per_page' => -1,
    );
    $projects = get_posts($project_args);

    // $to_send_users = array(4899);

    global $wpdb;
    $sql = "select meta_value from wp_postmeta where post_id = %d and meta_key = 'tasks'";

    foreach ($projects as $project) {

        $results = $wpdb->get_results($wpdb->prepare($sql, $project->ID));
        $task_count = 0;
        if (count($results) > 0) {
            $result = $results[0];
            $task_count = intval($result->meta_value);
        }

        $subject = 'Reminder for ' . $project->post_title;

        if ($task_count > 0) {

            for ($i = 1; $i <= $task_count; $i++) {

                $keys = array(
                    'task_title' => 'tasks_' . ($i - 1) . '_task_title',
                    'task_type' => 'tasks_' . ($i - 1) . '_task_type',
                    'task_author' => 'tasks_' . ($i - 1) . '_author',
                    'task_users' => 'tasks_' . ($i - 1) . '_users',
                    'email_sent' => 'tasks_' . ($i - 1) . '_email_sent',
                    'task_datetime' => 'tasks_' . ($i - 1) . '_task_datetime',
                );
                $values = array();

                $key_sql = "select meta_value from wp_postmeta where post_id = %d and meta_key = %s";
                foreach ($keys as $key => $meta_key) {
                    $results = $wpdb->get_results($wpdb->prepare($key_sql, $project->ID, $meta_key));
                    $result = $results[0];
                    $values[$key] = $result->meta_value;
                }

                if (!$values['email_sent']) {

                    $to_send_users = explode(',', $values['task_users']);
                    $to_send_users[] = $values['task_author'];

                    $task_datetime = strtotime($values['task_datetime']);
                    $interval = $task_datetime - $today_time;
                    $diff_in_hours = floor($interval / (60 * 60));

                    $values['to_send_users'] = $to_send_users;

                    if ($diff_in_hours <= 1) {
                        foreach ($to_send_users as $userId) {
                            // Hi $first_name, this is a reminder that you have "$Task title" scheduled for "$time" on "dd/mm/yyyy
                            $user_data = get_userdata($userId);
                            $first_user_name = $user_data->first_name;
                            $value_datetime = date_create_from_format('Y/m/d H:i', $values['task_datetime']);
                            $value_date = date_format($value_datetime, 'd/m/Y');
                            $value_time = date_format($value_datetime, 'H:i');
                            $text = "Hi " . $first_user_name . ", this is a reminder that you have " . $values['task_title'] . " scheduled for " . $value_time . " on " . $value_date . " for project: ";
                            $text .= '<a href="' . get_permalink($project->ID) . '" style="background:#f1416c; color:#fff; padding:12px 25px; border-radius: 4px; text-decoration:none; font-size:16px; ">Open Project</a>';
//                            aireno_send_email($subject, $values['task_title'], $text, $userId, $email = null);

                            // sent notification to clientId
//                            $notification_text = 'Reminder for ' . $values['task_title'] . ' on ' . $project->post_title;
//                            aireno_add_notification($notification_text, 'waiting', $changeDate, $userId, $project->ID);
                        }
                        update_post_meta($project->ID, 'tasks_' . ($i - 1) . '_email_sent', true);
                    }
                }
            }
        }
    }

    wp_reset_query();
}

function aireno_task_setup_cron_events()
{
    if (!wp_next_scheduled('task_scheduled_cron')) {
        wp_schedule_event(time(), 'every_minute', 'task_scheduled_cron');
    }
}

function task_remove_cron_events()
{
    flush_rewrite_rules();
    $timestamp = wp_next_scheduled('task_scheduled_cron');
    wp_unschedule_event($timestamp, 'task_scheduled_cron');
}

function aireno_add_wp_cron_schedule($schedules)
{
    $schedules['every_minute'] = array(
        'interval' => 60, // in seconds
        'display' => __('Every minute', TEXT_DOMAIN),
    );

    return $schedules;
}

/**
 * remove unread notification/messages on single project
 */
function aireno_remove_unread_notifications()
{
    global $post;
    if (is_user_logged_in() && is_single() && $post->post_type == AIRENO_CPT_PROJECT) {
        $user_id = get_current_user_id();
        if (isset($_GET['nm']) && is_numeric($_GET['nm'])){
            $nm_id = intval($_GET['nm']);
            if (get_post($nm_id)->post_type == AIRENO_CPT_MESSAGE) {
                $args = array(
                    'post_type' => AIRENO_CPT_MESSAGE,
                    'post_status' => array('publish'),
                    'posts_per_page' => -1,
                    'meta_query' => array(
                        'relation' => 'OR',
                        array(
                            'key' => 'unread_users',
                            'value' => '"' . $user_id . '"',
                            'compare' => 'LIKE',
                        ),
                        array(
                            'key' => 'project_id',
                            'value' => $post->ID,
                            'compare' => '=',
                        ),
                    ),
                );
                $result = new WP_Query($args);
                if ($result->have_posts()) {
                    while ($result->have_posts()) {
                        $result->the_post();
                        $unread_users = get_field('unread_users', get_the_ID());
                        if (!$unread_users) $unread_users = array();
                        unset($unread_users[array_search($user_id, $unread_users)]);
                        update_field('unread_users', $unread_users, get_the_ID());
                    }
                }
                wp_reset_query();
            }
            else if (get_post($nm_id)->post_type == AIRENO_CPT_NOTIFICATION) {
                $unread_users = get_field('unread_users', $nm_id);
                if (!$unread_users) $unread_users = array();
                unset($unread_users[array_search($user_id, $unread_users)]);
                update_field('unread_users', $unread_users, $nm_id);
            }
        }
    }
}

add_action('wp_head', 'aireno_remove_unread_notifications');

function aireno_disable_plugin_updates($value)
{
    if (isset($value) && is_object($value)) {
        if (isset($value->response['stripe-payments/accept-stripe-payments.php'])) {
            unset($value->response['stripe-payments/accept-stripe-payments.php']);
        }
    }
    return $value;
}

add_filter('site_transient_update_plugins', 'aireno_disable_plugin_updates');

function searchfilter($query) {

    if ($query->is_search && !is_admin() ) {
        $query->set('post_type', array('post'));
    }

    return $query;
}

add_filter('pre_get_posts','searchfilter');

add_filter( 'excerpt_length', function($length) {
    return 30;
}, PHP_INT_MAX );

function aireno_new_excerpt_more($more) {
    return '';
}
add_filter('excerpt_more', 'aireno_new_excerpt_more');