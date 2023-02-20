<?php
function aireno_register_post_types()
{
    $labels = array(
        'name' => __('Quote Templates', TEXT_DOMAIN),
        'singular_name' => __('Quote Template', TEXT_DOMAIN)
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => true,
        'show_in_rest' => true,
        'menu_position' => null,
        'rewrite' => array('slug' => 'quotes'),
        //        'taxonomies' => array( 'post_tag' ),
        'supports' => array('title', 'author', 'page-attributes')
    );
    register_post_type(AIRENO_CPT_TEMPLATE, $args);

    $labels = array(
        'name' => __('Projects', TEXT_DOMAIN),
        'singular_name' => __('Project', TEXT_DOMAIN)
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'author')
    );
    register_post_type(AIRENO_CPT_PROJECT, $args);

    $labels = array(
        'name' => __('Scopes', TEXT_DOMAIN),
        'singular_name' => __('Scope', TEXT_DOMAIN)
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => 'edit.php?post_type=project',
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'author')
    );
    register_post_type(AIRENO_CPT_SCOPE, $args);

    $labels = array(
        'name' => __('Payments', TEXT_DOMAIN),
        'singular_name' => __('Payment', TEXT_DOMAIN)
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_menu' => 'edit.php?post_type=project',
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'author'),
    );
    register_post_type(AIRENO_CPT_PAYMENT, $args);

    $labels = array(
        'name' => __('Payment templates', TEXT_DOMAIN),
        'singular_name' => __('Payment template', TEXT_DOMAIN)
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_menu' => 'edit.php?post_type=project',
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'author')
    );
    register_post_type(AIRENO_CPT_PAYMENT_TEMPLATE, $args);

    $labels = array(
        'name' => __('Schedules templates', TEXT_DOMAIN),
        'singular_name' => __('Schedules template', TEXT_DOMAIN)
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => 'edit.php?post_type=project',
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'author')
    );
    register_post_type(AIRENO_CPT_SCHEDULE_TEMPLATE, $args);

    $labels = array(
        'name' => 'Quote Tags',
        'singular_name' => 'Quote Tag',
        'menu_name' => 'Quote Tags',
    );
    register_taxonomy('quote-tag', array('template'), array(
        'hierarchical' => false,
        'show_ui' => true,
        'labels' => $labels,
        'query_var' => true,
    ));

    $labels = array(
        'name' => 'Refine Categories',
        'singular_name' => 'Refine Category',
        'menu_name' => 'Refine Categories',
    );
    register_taxonomy('refinecat', array('template'), array(
        'hierarchical' => true,
        'show_ui' => true,
        'labels' => $labels,
        'query_var' => true,
    ));


    $labels = array(
        'name' => __('Tasks', TEXT_DOMAIN),
        'singular_name' => __('Task', TEXT_DOMAIN)
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_menu' => 'edit.php?post_type=project',
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'author')
    );
    register_post_type(AIRENO_CPT_TASK, $args);

    $labels = array(
        'name' => __('Notes', TEXT_DOMAIN),
        'singular_name' => __('Note', TEXT_DOMAIN)
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_menu' => 'edit.php?post_type=project',
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'author')
    );
    register_post_type(AIRENO_CPT_NOTE, $args);

    $labels = array(
        'name' => __('Messages', TEXT_DOMAIN),
        'singular_name' => __('Message', TEXT_DOMAIN)
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_menu' => 'edit.php?post_type=project',
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'author')
    );
    register_post_type(AIRENO_CPT_MESSAGE, $args);

    $labels = array(
        'name' => __('Schedules', TEXT_DOMAIN),
        'singular_name' => __('Schedule', TEXT_DOMAIN)
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_menu' => 'edit.php?post_type=project',
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'author'),
    );
    register_post_type(AIRENO_CPT_SCHEDULE, $args);

    $labels = array(
        'name' => __('Notifications', TEXT_DOMAIN),
        'singular_name' => __('Notification', TEXT_DOMAIN)
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_menu' => 'edit.php?post_type=project',
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'author', 'editor'),
    );
    register_post_type(AIRENO_CPT_NOTIFICATION, $args);

    flush_rewrite_rules(true);

    $labels = array(
        'name' => 'ASP Categories',
        'singular_name' => 'ASP Category',
        'menu_name' => 'ASP Categories',
    );
    register_taxonomy('asp-category', array('asp-products'), array(
        'hierarchical' => true,
        'show_ui' => true,
        'labels' => $labels,
        'query_var' => true,
    ));
}

add_action('init', 'aireno_register_post_types');


function proceed_deletion_before_delete_project($postid, $post)
{
    if ($post->post_type == AIRENO_CPT_PROJECT) {

        //delete scope first
        $args = array(
            'post_type' => AIRENO_CPT_SCOPE,
            'post_status' => 'any',
            'posts_per_page' => -1,
            'meta_key' => 'project_id',
            'meta_value' => $postid,
            'meta_compare' => '=',
        );
        $sq = new WP_Query($args);
        if ($sq->have_posts()) {
            while ($sq->have_posts()) {
                $sq->the_post();
                wp_delete_post(get_the_ID(), true);
            }
        }
        wp_reset_query();

        //delete invoice
        $args = array(
            'post_type' => AIRENO_CPT_INVOICE,
            'post_status' => 'any',
            'posts_per_page' => -1,
            'meta_key' => 'project_id',
            'meta_value' => $postid,
            'meta_compare' => '=',
        );
        $sq = new WP_Query($args);
        if ($sq->have_posts()) {
            while ($sq->have_posts()) {
                $sq->the_post();
                wp_delete_post(get_the_ID(), true);
            }
        }
        wp_reset_query();

        //delete notes
        $args = array(
            'post_type' => AIRENO_CPT_NOTE,
            'post_status' => 'any',
            'posts_per_page' => -1,
            'meta_key' => 'project_id',
            'meta_value' => $postid,
            'meta_compare' => '=',
        );
        $sq = new WP_Query($args);
        if ($sq->have_posts()) {
            while ($sq->have_posts()) {
                $sq->the_post();
                wp_delete_post(get_the_ID(), true);
            }
        }
        wp_reset_query();

        //delete tasks
        $args = array(
            'post_type' => AIRENO_CPT_TASK,
            'post_status' => 'any',
            'posts_per_page' => -1,
            'meta_key' => 'project_id',
            'meta_value' => $postid,
            'meta_compare' => '=',
        );
        $sq = new WP_Query($args);
        if ($sq->have_posts()) {
            while ($sq->have_posts()) {
                $sq->the_post();
                wp_delete_post(get_the_ID(), true);
            }
        }
        wp_reset_query();

        //delete messages
        $args = array(
            'post_type' => AIRENO_CPT_MESSAGE,
            'post_status' => 'any',
            'posts_per_page' => -1,
            'meta_key' => 'project_id',
            'meta_value' => $postid,
            'meta_compare' => '=',
        );
        $sq = new WP_Query($args);
        if ($sq->have_posts()) {
            while ($sq->have_posts()) {
                $sq->the_post();
                wp_delete_post(get_the_ID(), true);
            }
        }
        wp_reset_query();

        //delete payments
        $args = array(
            'post_type' => AIRENO_CPT_PAYMENT,
            'post_status' => 'any',
            'posts_per_page' => -1,
            'meta_key' => 'project_id',
            'meta_value' => $postid,
            'meta_compare' => '=',
        );
        $sq = new WP_Query($args);
        if ($sq->have_posts()) {
            while ($sq->have_posts()) {
                $sq->the_post();
                wp_delete_post(get_the_ID(), true);
            }
        }
        wp_reset_query();

        //delete schedule
        $args = array(
            'post_type' => AIRENO_CPT_SCHEDULE,
            'post_status' => 'any',
            'posts_per_page' => -1,
            'meta_key' => 'project_id',
            'meta_value' => $postid,
            'meta_compare' => '=',
        );
        $sq = new WP_Query($args);
        if ($sq->have_posts()) {
            while ($sq->have_posts()) {
                $sq->the_post();
                wp_delete_post(get_the_ID(), true);
            }
        }
        wp_reset_query();

        //delete attachments
        $args = array(
            'post_type' => 'attachment',
            'post_status' => 'any',
            'meta_key' => 'project_id',
            'meta_value' => $postid,
            'meta_compare' => '=',
        );
        $sq = new WP_Query($args);
        if ($sq->have_posts()) {
            while ($sq->have_posts()) {
                $sq->the_post();
                wp_delete_post(get_the_ID(), true);
            }
        }
        wp_reset_query();
    }

    if ($post->post_type == AIRENO_CPT_SCHEDULE || $post->post_type == AIRENO_CPT_MESSAGE) {

        //delete attachments
        $args = array(
            'post_type' => 'attachment',
            'post_status' => 'inherit',
            'posts_per_page' => -1,
            'post_parent' => $postid,
            'order' => 'ASC',
        );
        $sq = new WP_Query($args);
        if ($sq->have_posts()) {
            while ($sq->have_posts()) {
                $sq->the_post();
                wp_delete_attachment(get_the_ID(), true);
            }
        }
        wp_reset_query();

    }

}

add_action('before_delete_post', 'proceed_deletion_before_delete_project', 10, 2);


add_filter('manage_' . AIRENO_CPT_MESSAGE . '_posts_columns', 'set_cpts_project_admin_columns');
add_filter('manage_' . AIRENO_CPT_NOTE . '_posts_columns', 'set_cpts_project_admin_columns');
add_filter('manage_' . AIRENO_CPT_TASK . '_posts_columns', 'set_cpts_project_admin_columns');
function set_cpts_project_admin_columns($columns)
{
    $columns['project'] = __('Project', TEXT_DOMAIN);
    return $columns;
}


// Add the data to the custom columns for the book post type:
add_action('manage_' . AIRENO_CPT_MESSAGE . '_posts_custom_column', 'cpts_project_admin_column', 10, 2);
add_action('manage_' . AIRENO_CPT_NOTE . '_posts_custom_column', 'cpts_project_admin_column', 10, 2);
add_action('manage_' . AIRENO_CPT_TASK . '_posts_custom_column', 'cpts_project_admin_column', 10, 2);
function cpts_project_admin_column($column, $post_id)
{
    switch ($column) {
        case 'project':
            $project_id = get_post_meta($post_id, 'project_id', true);
            $project_title = get_post($project_id)->post_title;
            $project_link = get_permalink($project_id);
            ?>
            <a href="<?= $project_link ?>" target="_blank"><?= $project_title ?></a>
            <?php
            break;
        default:
            break;
    }
}


add_filter('manage_posts_columns', 'reorder_cpts_project_admin_columns');
function reorder_cpts_project_admin_columns($defaults)
{
    $new = array();
    $project = $defaults['project'];

    // $tags = $defaults['tags'];  // save the tags column
    unset($defaults['project']);   // remove it from the columns list

    foreach ($defaults as $key => $value) {
        $new[$key] = $value;
        if ($key == 'title') {  // when we find the date column
            $new['project'] = $project;  // put the tags column before it
        }
    }
    return $new;
}

