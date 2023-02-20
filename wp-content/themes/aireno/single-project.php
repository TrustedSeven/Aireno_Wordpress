<?php
$project_id = get_the_ID();

$client = get_field('client', $project_id);

$businesses = get_field('business', $project_id);
if (!$businesses) $businesses = array();
if (!is_array($businesses) && $businesses) $businesses = array($businesses);

$partners = get_field('partner', $project_id);
if (!$partners) $partners = array();
if (!is_array($partners)) $partners = array($partners);

$contractors = get_field('contractor', $project_id);
if (!$contractors) $contractors = array();
if (!is_array($contractors)) $contractors = array($contractors);

$suppliers = get_field('supplier', $project_id);
if (!$suppliers) $suppliers = array();
if (!is_array($suppliers)) $suppliers = array($suppliers);

$designers = get_field('designer', $project_id);
if (!$designers) $designers = array();
if (!is_array($designers)) $designers = array($designers);

$planners = get_field('planner', $project_id);
if (!$planners) $planners = array();
if (!is_array($planners)) $planners = array($planners);

$user_id = get_current_user_id();
if (!is_user_logged_in()) {
    wp_safe_redirect(
        add_query_arg(
            array(
                'redirect' => urlencode(base64_encode(get_the_permalink())),
            ),
            aireno_get_page_link_by_name('login')
        )
    );
    exit;
}
if (current_user_can('manage_options')) {
    get_template_part('template-parts/project/project', 'head');
}
else if ($user_id == $client) {
    get_template_part('template-parts/project/project', 'client');
}
else if (in_array($user_id, $businesses)) {
    get_template_part('template-parts/project/project', 'business');
}
else if (in_array($user_id, $partners)) {
    get_template_part('template-parts/project/project', 'partner');
}
else if (in_array($user_id, $contractors)) {
    get_template_part('template-parts/project/project', 'contractor');
}
else if (in_array($user_id, $suppliers)) {
    get_template_part('template-parts/project/project', 'supplier');
}
else if (in_array($user_id, $designers)) {
    get_template_part('template-parts/project/project', 'designer');
}
else if (in_array($user_id, $planners)) {
    get_template_part('template-parts/project/project', 'planner');
}
else {
    wp_safe_redirect(home_url());
    exit;
}