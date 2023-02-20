<?php
if (!is_user_logged_in()) {
    wp_safe_redirect(
        add_query_arg(
            array(
                'redirect' => get_the_permalink(),
            ),
            aireno_get_page_link_by_name('login')
        )
    );
    exit;
}
get_template_part('template-parts/projects/projects', 'all');