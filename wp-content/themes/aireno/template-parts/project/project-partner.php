<?php
$project_id = get_the_ID();
$user_id = get_current_user_id();

// get project details
$projectStatus = aireno_project_status($project_id);

$project_title = get_the_title();

$project_date = get_field('date_start', $project_id);
$project_address = get_field('project_address', $project_id);
$project_stage = get_field('stage', $project_id);

$projectPayments = get_field('payments', $project_id);
$projectVariations = get_field('add_payments', $project_id);

// set client approvement based on project status
if ($projectStatus->status == 'live' || $projectStatus->status == 'completed') {
    $clientApprove = true;
} else {
    $clientApprove = false;
}

// get total of project based on subtotals of scopes
$project_budget = number_format(aireno_get_project_total($project_id), 2);

$team_members = array();

$client = get_field('client', $project_id);
if ($client) {
    $client_data = aireno_get_userdata($client);
    $team_members[] = $client_data;
}

$businesses = get_field('business', $project_id);
if (!is_array($businesses))
    $businesses = array();
foreach ($businesses as $business) {
    $business_data = aireno_get_userdata($business);
    $team_members[] = $business_data;
}

$partners = get_field('partner', $project_id);
if (!is_array($partners))
    $partners = array();
foreach ($partners as $partner) {
    $partner_data = aireno_get_userdata($partner);
    $team_members[] = $partner_data;
}

$contractors = get_field('contractor', $project_id);

if (!is_array($contractors))
    $contractors = array();
foreach ($contractors as $contractor) {
    $contractor_data = aireno_get_userdata($contractor);
    $team_members[] = $contractor_data;
}

$suppliers = get_field('supplier', $project_id);
if (!is_array($suppliers))
    $suppliers = array();
foreach ($suppliers as $supplier) {
    $supplier_data = aireno_get_userdata($supplier);
    $team_members[] = $supplier_data;
}

$planners = get_field('planner', $project_id);
if (!is_array($planners))
    $planners = array();
foreach ($planners as $planner) {
    $planner_data = aireno_get_userdata($planner);
    $team_members[] = $planner_data;
}

$designers = get_field('designer', $project_id);
if (!is_array($designers))
    $designers = array();
foreach ($designers as $designer) {
    $designer_data = aireno_get_userdata($designer);
    $team_members[] = $designer_data;
}

$heads = get_field('head', $project_id);
if (!is_array($heads))
    $heads = array();
foreach ($heads as $head) {
    $head_data = aireno_get_userdata($head);
    $team_members[] = $head_data;
}

$scopes = get_field('project_scopes', $project_id);
if (!is_array($scopes))
    $scopes = array();

get_header();

$user_details = array();
foreach ($team_members as $team_member) {
    $user_details[$team_member->id] = $team_member;
}

$can_edit = ($projectStatus->status == 'cancelled' || $projectStatus->status == 'completed') ? false : true;
?>
    <input type="hidden" id="aireno_team_members"
           value='<?= json_encode($user_details) ?>'/>
    <!--begin::Page-->
    <div class="page d-flex flex-row">
        <!--begin::Wrapper-->
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            <!--begin::Content-->
            <div class="content d-flex flex-column flex-column-fluid"
                 id="kt_content">
                <!--begin::Post-->
                <div class="post d-flex flex-column-fluid" id="kt_post">
                    <!--begin::Container-->
                    <div id="kt_content_container" class="container">
                        <!--begin::Navbar-->
                        <div class="card mb-6 mb-xl-9">
                            <div class="card-body pt-9 pb-0">
                                <!--begin::Details-->
                                <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
                                    <!--begin::Image-->
                                    <div
                                            class="d-flex flex-center flex-shrink-0 bg-light rounded w-100px h-100px w-lg-150px h-lg-150px me-7 mb-4">
                                        <?php
                                        $project_template_icon = get_field('template_icon', $project_id);
                                        ?>
                                        <!--begin:Icon-->
                                        <span class="symbol symbol-100px">
                                            <span class="symbol-label bg-danger">
                                                <i class="<?php echo $project_template_icon; ?> fs-2 text-light fw-bolder p-0"></i>
                                            </span>
                                        </span>
                                        <!--end:Icon-->
                                    </div>
                                    <!--end::Image-->
                                    <!--begin::Wrapper-->
                                    <div class="flex-grow-1">
                                        <!--begin::Head-->
                                        <div
                                                class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                            <!--begin::Details-->
                                            <div class="d-flex flex-column">
                                                <!--begin::Status-->
                                                <div class="d-flex align-items-center mb-1">
                                                    <span
                                                            class="text-gray-800 text-hover-primary fs-2 fw-bolder me-3 project-name">
                                                        <?= $project_title ?>
                                                    </span>
                                                    <a href="javascript:void(0)"
                                                       class="btn btn-icon btn-active-color-primary text-hover-primary"
                                                       data-bs-toggle="modal"
                                                       data-bs-target="#kt_modal_edit_project_name">
                                                        <i class="bi bi-pencil-fill fs-4 text-dark"></i>
                                                    </a>
                                                    <span
                                                            class="badge badge-light-success me-auto cursor-pointer">
                                                        <?= $projectStatus->label ?>
                                                    </span>
                                                </div>
                                                <!--end::Status-->
                                                <!--begin::Description-->
                                                <div class="d-flex flex-wrap">
                                                    <span class="fw-bold mb-4 fs-5 text-gray-400 me-3">
                                                        <span
                                                                class="project-address"><?= $project_address ?></span>
                                                        <a
                                                                href="javascript:void(0)"
                                                                class="btn btn-icon btn-active-color-primary w-25px h-25px"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#kt_modal_edit_project_address"> <i
                                                                    class="bi bi-pencil-fill fs-7 text-dark"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Details-->
                                            <!--begin::Actions-->
                                            <div class="d-flex mb-4">
                                                <span class="me-3">
                                                    <a href="javascript:void(0)"
                                                       class="btn btn-danger btn-sm fw-bolder"
                                                       data-bs-toggle="modal"
                                                       data-bs-target="#kt_modal_edit_project_addons">Buy Addons <i class="fa-regular fa-basket-shopping text-dark fw-bolder"></i>
                                                    </a>
                                                </span>
                                                <?php
                                                $add_scope_link = add_query_arg(array(
                                                    'project_id' => $project_id
                                                ), aireno_get_page_link_by_name('quotes'));
                                                ?>
                                                <!--begin::Menu-->
                                                <div class="me-0">
                                                    <button
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">
                                                        <i class="bi bi-three-dots fs-3"></i>
                                                    </button>
                                                    <!--begin::Menu 3-->
                                                    <div
                                                            class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3"
                                                            data-kt-menu="true">
                                                        <?php
                                                        if ($projectStatus->status != 'completed' &&
                                                            $projectStatus->status != 'cancelled') {
                                                            ?>
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3 my-1">
                                                                <a href="javascript:void(0)" class="menu-link px-3"
                                                                   data-bs-toggle="modal"
                                                                   data-bs-target="#kt_modal_no_contact_close_project">No
                                                                    Contact</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="javascript:void(0)" class="menu-link px-3"
                                                                   data-bs-toggle="modal"
                                                                   data-bs-target="#kt_modal_close_project">Close
                                                                    Project</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <?php
                                                        }
                                                        ?>
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="javascript:void(0)" class="menu-link px-3"
                                                               data-bs-toggle="modal"
                                                               data-bs-target="#kt_modal_delete_project">Delete
                                                                Project</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                    </div>
                                                    <!--end::Menu 3-->
                                                </div>
                                                <!--end::Menu-->
                                            </div>
                                            <!--end::Actions-->
                                        </div>
                                        <!--end::Head-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-wrap justify-content-start">
                                            <!--begin::Stats-->
                                            <div class="d-flex flex-wrap">
                                                <!--begin::Start Date-->
                                                <div
                                                        class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                    <!--begin::Number-->
                                                    <div class="d-flex align-items-center">
													<span class="fs-4 fw-bolder me-3"> <span
                                                                class="project-date"><?= $project_date ?></span> <a
                                                                href="javascript:void(0)"
                                                                class="btn btn-icon btn-active-color-primary w-25px h-25px"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#kt_modal_edit_project_date"> <i
                                                                    class="bi bi-pencil-fill fs-7 text-dark"></i>
													</a>
													</span>
                                                    </div>
                                                    <!--end::Number-->
                                                    <!--begin::Label-->
                                                    <div class="fw-bold fs-6 text-gray-400">Start Date</div>
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Start Date-->
                                                <!--begin::Stage-->
                                                <div
                                                        class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                    <!--begin::Number-->
                                                    <div class="d-flex align-items-center">
													<span class="fs-4 fw-bolder me-3"> <span
                                                                class="project-stage"><?= $project_stage ?></span> <a
                                                                href="javascript:void(0)"
                                                                class="btn btn-icon btn-active-color-primary w-25px h-25px"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#kt_modal_edit_project_stage"> <i
                                                                    class="bi bi-pencil-fill fs-7 text-dark"></i>
													</a>
													</span>
                                                    </div>
                                                    <!--end::Number-->
                                                    <!--begin::Label-->
                                                    <div class="fw-bold fs-6 text-gray-400">Project Stage</div>
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Stage-->
                                                <!--begin::Budget-->
                                                <div
                                                        class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                    <!--begin::Number-->
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                                        <span class="svg-icon svg-icon-3 svg-icon-success me-2"> <svg
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24"
                                                                    viewBox="0 0 24 24" fill="none">
                                                            <rect
                                                                    opacity="0.5" x="13" y="6" width="13" height="2"
                                                                    rx="1"
                                                                    transform="rotate(90 13 6)" fill="currentColor"/>
                                                            <path
                                                                    d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                                                                    fill="currentColor"/>
                                                        </svg>
													</span>
                                                        <!--end::Svg Icon-->
                                                        <div class="fs-4 fw-bolder" data-kt-countup="false"
                                                             data-kt-countup-value="<?= $project_budget ?>"
                                                             data-kt-countup-prefix="$">$<?= $project_budget ?></div>
                                                    </div>
                                                    <!--end::Number-->
                                                    <!--begin::Label-->
                                                    <div class="fw-bold fs-6 text-gray-400">Budget</div>
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Budget-->
                                                <!--begin::Users-->
                                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                    <!--begin::Quotes-->
                                                    <div class="symbol-group symbol-hover mb-3">
                                                        <?php
                                                        foreach ($team_members as $team_member) {
                                                            ?>
                                                            <a class="symbol symbol-circle mne-5" target="_blank"
                                                               href="<?= get_author_posts_url($team_member->id) ?>">
                                                                <img src="<?= $team_member->avatar ?>" class="h-50px"/>
                                                            </a>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <!--end::Quotes-->
                                                </div>
                                                <!--end::Users-->
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Details-->
                                <div class="separator"></div>
                                <?php
                                if (isset($_GET['tab']))
                                    $tab = $_GET['tab'];
                                else
                                    $tab = 'project-overview';
                                $tabs = array(
                                    'project-overview',
                                    'project-schedules',
                                    'project-payments',
                                    'project-users',
                                    'project-files',
                                    'project-activity',
                                    'project-contract',
                                    'project-review',
                                );
                                if (!in_array($tab, $tabs))
                                    $tab = 'project-overview';
                                ?>
                                <!--begin::Nav-->
                                <ul
                                        class="nav nav-tabs nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder">
                                    <!--begin::Nav item-->
                                    <li class="nav-item"><a
                                                class="nav-link text-active-primary py-5 me-6 <?= $tab == 'project-overview' ? 'active' : '' ?>"
                                                data-bs-toggle="tab" href="#project-overview">Overview</a></li>
                                    <!--end::Nav item-->
                                    <!--begin::Nav item-->
                                    <li class="nav-item"><a
                                                class="nav-link text-active-primary py-5 me-6 <?= $tab == 'project-schedules' ? 'active' : '' ?>"
                                                data-bs-toggle="tab" href="#project-schedules">Schedules</a></li>
                                    <!--end::Nav item-->
                                    <!--begin::Nav item-->
                                    <li class="nav-item"><a
                                                class="nav-link text-active-primary py-5 me-6 <?= $tab == 'project-payments' ? 'active' : '' ?>"
                                                data-bs-toggle="tab" href="#project-payments">Payments</a></li>
                                    <!--end::Nav item-->
                                    <!--begin::Nav item-->
                                    <li class="nav-item"><a
                                                class="nav-link text-active-primary py-5 me-6 <?= $tab == 'project-users' ? 'active' : '' ?>"
                                                data-bs-toggle="tab" href="#project-users">Users</a></li>
                                    <!--end::Nav item-->
                                    <!--begin::Nav item-->
                                    <li class="nav-item"><a
                                                class="nav-link text-active-primary py-5 me-6 <?= $tab == 'project-files' ? 'active' : '' ?>"
                                                data-bs-toggle="tab" href="#project-files">Files</a></li>
                                    <!--end::Nav item-->
                                    <!--begin::Nav item-->
                                    <li class="nav-item"><a
                                                class="nav-link text-active-primary py-5 me-6 <?= $tab == 'project-activity' ? 'active' : '' ?>"
                                                data-bs-toggle="tab" href="#project-activity">Activity</a></li>
                                    <!--end::Nav item-->
                                    <!--begin::Nav item-->
                                    <li class="nav-item"><a
                                                class="nav-link text-active-primary py-5 me-6 <?= $tab == 'project-contract' ? 'active' : '' ?>"
                                                data-bs-toggle="tab" href="#project-contract">Contract</a></li>
                                    <!--end::Nav item-->
                                    <?php
                                    if ($projectStatus->status == 'completed' || $projectStatus->status == 'cancelled') {
                                        ?>
                                        <!--begin::Nav item-->
                                        <li class="nav-item"><a
                                                    class="nav-link text-active-primary py-5 me-6 <?= $tab == 'project-review' ? 'active' : '' ?>"
                                                    data-bs-toggle="tab" href="#project-review">Reviews</a></li>
                                        <!--end::Nav item-->
                                        <?php
                                    }
                                    ?>
                                </ul>
                                <!--end::Nav-->
                            </div>
                        </div>
                        <!--end::Navbar-->

                        <!--Begin ::Tab content-->
                        <div class="tab-content">
                            <!--Begin:Overview-->
                            <div class="tab-pane fade show <?= $tab == 'project-overview' ? 'active' : '' ?>"
                                 id="project-overview" role="tabpanel">
                                <div class="row g-6 g-xl-9">
                                    <!--begin::Summary-->
                                    <div class="col-lg-6">
                                        <!--begin::Quote Summary-->
                                        <div class="card" id="kt_quotes_summary">
                                            <div class="card-header collapsible cursor-pointer"
                                                 id="kt_quotes_summary_header">
                                                <a href="javascript:void(0)"
                                                   class="card-title fs-4 fw-bolder text-gray-900 text-hover-primary me-1 mb-2 lh-1"
                                                   data-bs-toggle="collapse"
                                                   data-bs-target="#kt_quotes_card_collapsible">Quotes Summary</a>
                                                <div class="card-toolbar">
                                                    <button class="btn btn-sm btn-icon btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">
                                                        <i class="bi bi-three-dots fs-2"></i>
                                                    </button>
                                                    <!--begin::Menu 3-->
                                                    <div
                                                            class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3"
                                                            data-kt-menu="true">
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="<?= $add_scope_link ?>" class="menu-link px-3">Add
                                                                New Quote</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="javascript:void(0)" id="btnPrintQuotes"
                                                               class="menu-link flex-stack px-3">Print</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                    </div>
                                                    <!--end::Menu 3-->
                                                </div>
                                            </div>
                                            <div id="kt_quotes_card_collapsible" class="collapse show">
                                                <div class="card-body" id="kt_quotes_summary_body">
                                                    <!--begin::Quotes-->
                                                    <div class="symbol-group symbol-hover mb-3">
                                                        <?php
                                                        foreach ($scopes as $scope) {
                                                            $scope_photo = get_field('template_icon', $scope);
                                                            ?>
                                                            <!--begin::Scope-->
                                                            <div class="symbol me-5 image-input">
                                                                <a class="symbol-label fs-8 fw-bolder"
                                                                   href="javascript:void(0)"
                                                                   data-kt-menu-trigger="click"
                                                                   data-kt-menu-placement="bottom-start">
                                                                    <!--begin:Icon-->
                                                                    <span class="symbol symbol-50px">
                                                                        <span class="symbol-label bg-danger">
                                                                            <i class="<?php echo $scope_photo; ?> fs-2 text-light fw-bolder p-0"></i>
                                                                        </span>
                                                                    </span>
                                                                    <!--end:Icon-->
                                                                </a>
                                                                <div
                                                                        class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3"
                                                                        data-kt-menu="true">
                                                                    <!--begin::Menu item-->
                                                                    <div class="menu-item px-3">
                                                                        <a href="<?= get_permalink($scope) ?>"
                                                                           target="_blank"
                                                                           class="menu-link px-3">Edit Quote</a>
                                                                    </div>
                                                                    <!--end::Menu item-->
                                                                    <!--begin::Menu item-->
                                                                    <div class="menu-item px-3">
                                                                        <a href="javascript:void(0)"
                                                                           class="btn_aireno_delete_quote menu-link flex-stack px-3"
                                                                           data-quote-id="<?= $scope ?>">Delete
                                                                            Quote</a>
                                                                    </div>
                                                                    <!--end::Menu item-->
                                                                </div>
                                                            </div>
                                                            <!--end::Scope-->
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <!--end::Quotes-->
                                                    <!--begin::Wrapper-->
                                                    <div
                                                            class="d-flex flex-wrap scroll-y me-n5 pe-5 h-600px h-lg-auto"
                                                            data-kt-element="quotes" data-kt-scroll="true"
                                                            data-kt-scroll-activate="{default: false, lg: true}"
                                                            data-kt-scroll-max-height="auto"
                                                            data-kt-scroll-dependencies="#kt_quotes_summary_header"
                                                            data-kt-scroll-wrappers="#kt_quotes_summary_body"
                                                            data-kt-scroll-offset="5px">
                                                        <?php
                                                        $arrayNames = array();
                                                        $refine_data = array();
                                                        $notes = array();

                                                        $scopeNamesAndIDs = array();
                                                        foreach ($scopes as $sS) {
                                                            $scopeId = $sS;
                                                            $scopeNamesAndIDs[get_post($sS)->post_title] = $sS;

                                                            $scopeContent = get_post($scopeId)->post_content;
                                                            $scopeDataDecoded = base64_decode($scopeContent);
                                                            $sData = json_decode($scopeDataDecoded, true);

                                                            $name = $sData['projectName'];

                                                            $templateID = $sData['templateId'];

                                                            if (have_rows('quote_fields', $templateID)) {
                                                                while (have_rows('quote_fields', $templateID)) {
                                                                    the_row();
                                                                    $layout = get_row_layout();
                                                                    $slug = get_sub_field('slug');
                                                                    if ($layout == 'fields') {
                                                                        $in_price = get_sub_field('in_price');
                                                                        while (have_rows('fields')) {
                                                                            the_row();
                                                                            $item_title = get_sub_field('title');
                                                                            $item_slug = get_sub_field('slug');
                                                                            $extra_count = intval($sData[$item_slug . '_multiple']);

                                                                            if (is_array($sData[$slug]) && in_array($item_title, $sData[$slug]) && $item_slug) {
                                                                                for ($i = 1; $i < $sData[$item_slug . '_count']; $i++) {
                                                                                    $c_key = 'category_' . $item_slug . '_' . $i;
                                                                                    if ($sData['default_' . $item_slug . '_' . $i] == 'true') {
                                                                                        if (!array_key_exists($sData[$c_key], $refine_data)) {
                                                                                            $refine_data[$sData[$c_key]] = array(
                                                                                                'total_price' => 0,
                                                                                                'items' => array()
                                                                                            );
                                                                                        }
                                                                                        $item_price = ($in_price) ? $sData['price_' . $item_slug . '_' . $i] : 0;
                                                                                        $item_price = str_replace('$', '', $item_price);
                                                                                        $margin = ($in_price) ? $sData['margin_' . $item_slug . '_' . $i] : 0;
                                                                                        $margin = str_replace('%', '', $margin);
                                                                                        $refine_data[$sData[$c_key]]['total_price'] += floatval($item_price) * floatval($sData['quantity_' . $item_slug . '_' . $i]) * $extra_count * (1 + $margin / 100);
                                                                                        $refine_data[$sData[$c_key]]['items'][] = array(
                                                                                            'title' => $item_title,
                                                                                            'price' => $item_price,
                                                                                            'quantity' => $sData['quantity_' . $item_slug . '_' . $i],
                                                                                            'quantity_type' => $sData['quantity_type_' . $item_slug . '_' . $i],
                                                                                            'description' => $sData['description_' . $item_slug . '_' . $i],
                                                                                            'scopeName' => get_post($scopeId)->post_title,
                                                                                            'scopeID' => $scopeId,
                                                                                            'margin' => $margin,
                                                                                            'extra_count' => $extra_count
                                                                                        );
                                                                                    }
                                                                                }
                                                                            } else if ($item_title == $sData[$slug] && $item_slug) {
                                                                                for ($i = 1; $i < $sData[$item_slug . '_count']; $i++) {
                                                                                    if ($sData['default_' . $item_slug . '_' . $i] == 'true') {
                                                                                        $c_key = 'category_' . $item_slug . '_' . $i;
                                                                                        if (!array_key_exists($sData[$c_key], $refine_data)) {
                                                                                            $refine_data[$sData[$c_key]] = array(
                                                                                                'total_price' => 0,
                                                                                                'items' => array()
                                                                                            );
                                                                                        }
                                                                                        $item_price = ($in_price) ? $sData['price_' . $item_slug . '_' . $i] : 0;
                                                                                        $item_price = str_replace('$', '', $item_price);
                                                                                        $margin = ($in_price) ? $sData['margin_' . $item_slug . '_' . $i] : 0;
                                                                                        $margin = str_replace('%', '', $margin);
                                                                                        $refine_data[$sData[$c_key]]['total_price'] += floatval($item_price) * floatval($sData['quantity_' . $item_slug . '_' . $i]) * $extra_count * (1 + $margin / 100);
                                                                                        $refine_data[$sData[$c_key]]['items'][] = array(
                                                                                            'title' => $item_title,
                                                                                            'price' => $item_price,
                                                                                            'quantity' => $sData['quantity_' . $item_slug . '_' . $i],
                                                                                            'quantity_type' => $sData['quantity_type_' . $item_slug . '_' . $i],
                                                                                            'description' => $sData['description_' . $item_slug . '_' . $i],
                                                                                            'scopeName' => get_post($scopeId)->post_title,
                                                                                            'scopeID' => $scopeId,
                                                                                            'margin' => $margin,
                                                                                            'extra_count' => $extra_count
                                                                                        );
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                    else if ($layout == 'additional_notes') {
                                                                        $notes[$scopeId] = $sData[$slug];
                                                                    }
                                                                }
                                                            }

                                                            $scopePrice = get_field('scope_price', $scopeId);
                                                            $scopeTemplateId = get_field('scopeTemplate', $scopeId);
                                                            $scopeTemplateFields = get_field('quote_fields', $scopeTemplateId);

                                                            $customQuoteFieldTitle = $sData['customQuoteFieldTitle'];
                                                            $customQuoteFieldTotal = $sData['customQuoteFieldTotalPrice'];

                                                            $extra_count = 1;
                                                            if (is_array($customQuoteFieldTitle))
                                                                foreach ($customQuoteFieldTitle as $customFieldId => $title) {
                                                                    if (isset($sData['customQuoteFieldDescription' . $customFieldId]) && is_array($sData['customQuoteFieldDescription' . $customFieldId])) {
                                                                        foreach ($sData['customQuoteFieldDescription' . $customFieldId] as $idx => $description) {
                                                                            $defaults = $sData['customQuoteFieldIncluded' . $customFieldId];
                                                                            $default = in_array($idx, $defaults);
                                                                            $category = $sData['customQuoteFieldCategory' . $customFieldId][$idx];
                                                                            $quantity = $sData['customQuoteFieldQuantity' . $customFieldId][$idx];
                                                                            $quantity_type = $sData['customQuoteFieldQuantityType' . $customFieldId][$idx];
                                                                            $price = $sData['customQuoteFieldPrices' . $customFieldId][$idx];
                                                                            $margin = $sData['customQuoteFieldMargins' . $customFieldId][$idx];
                                                                            if ($default && $category && $quantity && $price) {
                                                                                if (!array_key_exists($category, $refine_data)) {
                                                                                    $refine_data[$category] = array(
                                                                                        'total_price' => 0,
                                                                                        'items' => array()
                                                                                    );
                                                                                }
                                                                                $refine_data[$category]['items'][] = array(
                                                                                    'title' => $title,
                                                                                    'description' => $description,
                                                                                    'price' => $price,
                                                                                    'quantity' => $quantity,
                                                                                    'quantity_type' => $quantity_type,
                                                                                    'scopeName' => get_post($scopeId)->post_title,
                                                                                    'scopeID' => $scopeId,
                                                                                    'margin' => $margin,
                                                                                    'extra_count' => $extra_count
                                                                                );
                                                                                $refine_data[$category]['total_price'] += floatval($price) * floatval($quantity) * (100 + $margin) / 100;
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                        }
                                                        if (count($notes) > 0) {
                                                            ?>
                                                            <!--begin::Section-->
                                                            <div class="m-0 w-100">
                                                                <!--begin::Heading-->
                                                                <div
                                                                        class="d-flex justify-content-between collapsible py-3 toggle mb-0"
                                                                        data-bs-toggle="collapse"
                                                                        data-bs-target="#kt_cat_notes">
                                                                    <div class="d-flex align-items-center">
                                                                        <!--begin::Icon-->
                                                                        <div
                                                                                class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-2">
                                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                                                            <span
                                                                                    class="svg-icon toggle-on svg-icon-primary svg-icon-1">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                     width="24"
                                                                                     height="24" viewBox="0 0 24 24"
                                                                                     fill="none">
                                                                                    <rect
                                                                                            opacity="0.3" x="2" y="2"
                                                                                            width="20"
                                                                                            height="20"
                                                                                            rx="5" fill="currentColor"/>
                                                                                    <rect
                                                                                            x="6.0104" y="10.9247"
                                                                                            width="12"
                                                                                            height="2" rx="1"
                                                                                            fill="currentColor"/>
                                                                                </svg>
                                                                            </span>
                                                                            <!--end::Svg Icon-->
                                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                                                            <span class="svg-icon toggle-off svg-icon-1">
                                                                                <svg
                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                        width="24"
                                                                                        height="24" viewBox="0 0 24 24"
                                                                                        fill="none">
                                                                                    <rect
                                                                                            opacity="0.3" x="2" y="2"
                                                                                            width="20"
                                                                                            height="20"
                                                                                            rx="5" fill="currentColor"/>
                                                                                    <rect
                                                                                            x="10.8891" y="17.8033"
                                                                                            width="12"
                                                                                            height="2" rx="1"
                                                                                            transform="rotate(-90 10.8891 17.8033)"
                                                                                            fill="currentColor"/>
                                                                                    <rect
                                                                                            x="6.01041" y="10.9247"
                                                                                            width="12"
                                                                                            height="2" rx="1"
                                                                                            fill="currentColor"/>
                                                                                </svg>
                                                                            </span>
                                                                            <!--end::Svg Icon-->
                                                                        </div>
                                                                        <!--end::Icon-->
                                                                        <!--begin::Title-->
                                                                        <h4 class="d-flex align-items-center text-dark fw-bolder cursor-pointer mb-0">
                                                                            <!--begin:Icon-->
                                                                            <span class="symbol symbol-20px me-1">
                                                                                <span class="symbol-label bg-danger rounded-0">
                                                                                    <i class="fs-2 text-light fw-bolder p-0"></i>
                                                                                </span>
                                                                            </span>
                                                                            <!--end:Icon-->
                                                                            Notes
                                                                        </h4>
                                                                        <!--end::Title-->
                                                                    </div>
                                                                </div>
                                                                <!--end::Heading-->
                                                                <!--begin::Body-->
                                                                <div id="kt_cat_notes"
                                                                     class="collapse show fs-6 ps-5">
                                                                    <!--begin::Text-->
                                                                    <div class="m-0">
                                                                        <?php
                                                                        $note_index = 1;
                                                                        foreach ($notes as $scopeID => $note) {
                                                                            if (!$note) continue;
                                                                            $sIcon = get_field('template_icon', $scopeID);
                                                                            $name = get_post($scopeID)->post_title;
                                                                            ?>
                                                                            <!--begin::Heading-->
                                                                            <div
                                                                                    class="d-flex justify-content-between collapsible py-3 toggle mb-0"
                                                                                    data-bs-toggle="collapse"
                                                                                    data-bs-target="#kt_note_<?= $note_index ?>">
                                                                                <div class="d-flex align-items-center">
                                                                                    <!--begin::Icon-->
                                                                                    <div
                                                                                            class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-2">
                                                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                                                                        <span
                                                                                                class="svg-icon toggle-on svg-icon-primary svg-icon-1">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                 width="24"
                                                                                                 height="24" viewBox="0 0 24 24"
                                                                                                 fill="none">
                                                                                                <rect
                                                                                                        opacity="0.3" x="2" y="2"
                                                                                                        width="20" height="20"
                                                                                                        rx="5" fill="currentColor"/>
                                                                                                <rect
                                                                                                        x="6.0104" y="10.9247"
                                                                                                        width="12" height="2"
                                                                                                        rx="1" fill="currentColor"/>
                                                                                            </svg>
                                                                                        </span>
                                                                                        <!--end::Svg Icon-->
                                                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                                                                        <span class="svg-icon toggle-off svg-icon-1">
                                                                                            <svg
                                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                                    width="24"
                                                                                                    height="24"
                                                                                                    viewBox="0 0 24 24"
                                                                                                    fill="none">
                                                                                                <rect
                                                                                                        opacity="0.3" x="2" y="2"
                                                                                                        width="20" height="20"
                                                                                                        rx="5" fill="currentColor"/>
                                                                                                <rect
                                                                                                        x="10.8891" y="17.8033"
                                                                                                        width="12" height="2"
                                                                                                        rx="1"
                                                                                                        transform="rotate(-90 10.8891 17.8033)"
                                                                                                        fill="currentColor"/>
                                                                                                <rect
                                                                                                        x="6.01041" y="10.9247"
                                                                                                        width="12" height="2"
                                                                                                        rx="1" fill="currentColor"/>
                                                                                            </svg>
                                                                                        </span>
                                                                                        <!--end::Svg Icon-->
                                                                                    </div>
                                                                                    <!--end::Icon-->
                                                                                    <!--begin::Title-->
                                                                                    <h4 class="d-flex align-items-center text-gray-700 fw-bolder cursor-pointer mb-0">
                                                                                        <!--begin:Icon-->
                                                                                        <span class="symbol symbol-20px me-1">
                                                                                            <span class="symbol-label bg-danger rounded-0">
                                                                                                <i class="<?php echo $sIcon; ?> fs-2 text-light fw-bolder p-0"></i>
                                                                                            </span>
                                                                                        </span>
                                                                                        <!--end:Icon-->
                                                                                        <?= $name ?>
                                                                                    </h4>
                                                                                    <!--end::Title-->
                                                                                </div>
                                                                            </div>
                                                                            <!--end::Heading-->
                                                                            <!--begin::Body-->
                                                                            <div id="kt_note_<?= $note_index ?>"
                                                                                 class="collapse show fs-6 ms-1">
                                                                                <!--begin::Text-->
                                                                                <div class="mb-4 text-gray-600 fw-bold fs-6 ps-10">
                                                                                    <div>
                                                                                        <?php
                                                                                        echo nl2br($note);
                                                                                        ?>
                                                                                    </div>
                                                                                </div>
                                                                                <!--end::Text-->
                                                                            </div>
                                                                            <!--end::Content-->
                                                                            <!--begin::Separator-->
                                                                            <div class="separator separator-dashed"></div>
                                                                            <!--end::Separator-->
                                                                            <?php
                                                                            $note_index ++;
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                    <!--end::Text-->
                                                                </div>
                                                                <!--end::Content-->
                                                                <!--begin::Separator-->
                                                                <div class="separator separator-dashed"></div>
                                                                <!--end::Separator-->
                                                            </div>
                                                            <!--end::Section-->
                                                            <?php
                                                        }
                                                        foreach ($refine_data as $cat => $data) {
                                                            $cat_icon = get_field('refine_icon', 'refinecat_' . $cat);
                                                            ?>
                                                            <!--begin::Section-->
                                                            <div class="m-0 w-100">
                                                                <!--begin::Heading-->
                                                                <div
                                                                        class="d-flex justify-content-between collapsible py-3 toggle mb-0"
                                                                        data-bs-toggle="collapse"
                                                                        data-bs-target="#kt_cat_<?= $cat ?>">
                                                                    <div class="d-flex align-items-center">
                                                                        <!--begin::Icon-->
                                                                        <div
                                                                                class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-2">
                                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                                                            <span
                                                                                    class="svg-icon toggle-on svg-icon-primary svg-icon-1">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                     width="24"
                                                                                     height="24" viewBox="0 0 24 24"
                                                                                     fill="none">
                                                                                    <rect
                                                                                            opacity="0.3" x="2" y="2"
                                                                                            width="20"
                                                                                            height="20"
                                                                                            rx="5" fill="currentColor"/>
                                                                                    <rect
                                                                                            x="6.0104" y="10.9247"
                                                                                            width="12"
                                                                                            height="2" rx="1"
                                                                                            fill="currentColor"/>
                                                                                </svg>
                                                                            </span>
                                                                            <!--end::Svg Icon-->
                                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                                                            <span class="svg-icon toggle-off svg-icon-1">
                                                                                <svg
                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                        width="24"
                                                                                        height="24" viewBox="0 0 24 24"
                                                                                        fill="none">
                                                                                    <rect
                                                                                            opacity="0.3" x="2" y="2"
                                                                                            width="20"
                                                                                            height="20"
                                                                                            rx="5" fill="currentColor"/>
                                                                                    <rect
                                                                                            x="10.8891" y="17.8033"
                                                                                            width="12"
                                                                                            height="2" rx="1"
                                                                                            transform="rotate(-90 10.8891 17.8033)"
                                                                                            fill="currentColor"/>
                                                                                    <rect
                                                                                            x="6.01041" y="10.9247"
                                                                                            width="12"
                                                                                            height="2" rx="1"
                                                                                            fill="currentColor"/>
                                                                                </svg>
                                                                            </span>
                                                                            <!--end::Svg Icon-->
                                                                        </div>
                                                                        <!--end::Icon-->
                                                                        <!--begin::Title-->
                                                                        <h4 class="d-flex align-items-center text-dark fw-bolder cursor-pointer mb-0">
                                                                            <!--begin:Icon-->
                                                                            <span class="symbol symbol-20px me-1">
                                                                                <span class="symbol-label bg-danger rounded-0">
                                                                                    <i class="<?php echo $cat_icon; ?> fs-2 text-light fw-bolder p-0"></i>
                                                                                </span>
                                                                            </span>
                                                                            <!--end:Icon-->
                                                                            <?= get_term($cat)->name ?>
                                                                        </h4>
                                                                        <!--end::Title-->
                                                                    </div>
                                                                    <div class="price">
                                                                        <?php
                                                                        if ($data['total_price'] > 0) {
                                                                            ?>
                                                                            $<?= number_format($data['total_price'], 2, '.', '') ?>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <!--end::Heading-->
                                                                <!--begin::Body-->
                                                                <div id="kt_cat_<?= $cat ?>"
                                                                     class="collapse show fs-6 ps-5">
                                                                    <!--begin::Text-->
                                                                    <div class="m-0">

                                                                        <?php
                                                                        $scopeNames = array();
                                                                        foreach ($data['items'] as $item) {
                                                                            $scopeNames[$item['scopeID']] = $item['scopeName'];
                                                                        }
                                                                        $index = 1;
                                                                        foreach ($scopeNames as $scopeID => $name) {
                                                                            $refines = array(
                                                                                'items' => array(),
                                                                                'price' => 0
                                                                            );
                                                                            foreach ($data['items'] as $item) {
                                                                                if ($item['scopeID'] == $scopeID) {
                                                                                    $refines['items'][] = $item;
                                                                                    $refines['price'] += floatval($item['price']) * floatval($item['quantity']) * $item['extra_count'] * (1 + $item['margin'] / 100);
                                                                                }
                                                                            }
                                                                            $sID = $scopeNamesAndIDs[$name];
                                                                            $sIcon = get_field('template_icon', $sID);
                                                                            ?>
                                                                            <!--begin::Heading-->
                                                                            <div
                                                                                    class="d-flex justify-content-between collapsible py-3 toggle mb-0"
                                                                                    data-bs-toggle="collapse"
                                                                                    data-bs-target="#kt_cat_<?= $cat . '_' . $index ?>">
                                                                                <div class="d-flex align-items-center">
                                                                                    <!--begin::Icon-->
                                                                                    <div
                                                                                            class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-2">
                                                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                                                                        <span
                                                                                                class="svg-icon toggle-on svg-icon-primary svg-icon-1">
																				<svg xmlns="http://www.w3.org/2000/svg"
                                                                                     width="24"
                                                                                     height="24" viewBox="0 0 24 24"
                                                                                     fill="none">
                                                                                    <rect
                                                                                            opacity="0.3" x="2" y="2"
                                                                                            width="20" height="20"
                                                                                            rx="5" fill="currentColor"/>
                                                                                    <rect
                                                                                            x="6.0104" y="10.9247"
                                                                                            width="12" height="2"
                                                                                            rx="1" fill="currentColor"/>
                                                                                </svg>
																			</span>
                                                                                        <!--end::Svg Icon-->
                                                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                                                                        <span class="svg-icon toggle-off svg-icon-1"> <svg
                                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                                    width="24"
                                                                                                    height="24"
                                                                                                    viewBox="0 0 24 24"
                                                                                                    fill="none">
                                                                                    <rect
                                                                                            opacity="0.3" x="2" y="2"
                                                                                            width="20" height="20"
                                                                                            rx="5" fill="currentColor"/>
                                                                                    <rect
                                                                                            x="10.8891" y="17.8033"
                                                                                            width="12" height="2"
                                                                                            rx="1"
                                                                                            transform="rotate(-90 10.8891 17.8033)"
                                                                                            fill="currentColor"/>
                                                                                    <rect
                                                                                            x="6.01041" y="10.9247"
                                                                                            width="12" height="2"
                                                                                            rx="1" fill="currentColor"/>
                                                                                </svg>
																			</span>
                                                                                        <!--end::Svg Icon-->
                                                                                    </div>
                                                                                    <!--end::Icon-->
                                                                                    <!--begin::Title-->
                                                                                    <h4 class="d-flex align-items-center text-gray-700 fw-bolder cursor-pointer mb-0">
                                                                                        <!--begin:Icon-->
                                                                                        <span class="symbol symbol-20px me-1">
                                                                                            <span class="symbol-label bg-danger rounded-0">
                                                                                                <i class="<?php echo $sIcon; ?> fs-2 text-light fw-bolder p-0"></i>
                                                                                            </span>
                                                                                        </span>
                                                                                        <!--end:Icon-->
                                                                                        <?= $name ?>
                                                                                    </h4>
                                                                                    <!--end::Title-->
                                                                                </div>
                                                                                <div class="price">
                                                                                    <?php
                                                                                    if ($refines['price'] > 0) {
                                                                                        ?>
                                                                                        $<?= number_format($refines['price'], 2, '.', '') ?>
                                                                                        <?php
                                                                                    }
                                                                                    ?>
                                                                                </div>
                                                                            </div>
                                                                            <!--end::Heading-->
                                                                            <!--begin::Body-->
                                                                            <div id="kt_cat_<?= $cat . '_' . $index ?>"
                                                                                 class="collapse show fs-6 ms-1">
                                                                                <!--begin::Text-->
                                                                                <div class="mb-4 text-gray-600 fw-bold fs-6 ps-10">
                                                                                    <?php
                                                                                    foreach ($refines['items'] as $item) {
                                                                                        $price = floatval($item['price']) * floatval($item['quantity']) * $item['extra_count'] * (1 + $item['margin'] / 100);
                                                                                        ?>
                                                                                        <div
                                                                                                class="d-flex justify-content-between flex-wrap mb-3">
                                                                                            <span><?= $item['title'] ?></span>
                                                                                            <span><?= $item['description'] . ' x ' . (floatval($item['quantity']) * $item['extra_count']) . ' (' . $item['quantity_type'] . ')' ?></span>
                                                                                            <span>
                                                                                <?php
                                                                                if ($price > 0) {
                                                                                    ?>
                                                                                    $<?= number_format($price, 2, '.', '') ?>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </span>
                                                                                        </div>

                                                                                        <?php
                                                                                    }
                                                                                    ?>
                                                                                </div>
                                                                                <!--end::Text-->
                                                                            </div>
                                                                            <!--end::Content-->
                                                                            <!--begin::Separator-->
                                                                            <div class="separator separator-dashed"></div>
                                                                            <!--end::Separator-->
                                                                            <?php
                                                                            $index++;
                                                                        }
                                                                        ?>

                                                                    </div>
                                                                    <!--end::Text-->
                                                                </div>
                                                                <!--end::Content-->
                                                                <!--begin::Separator-->
                                                                <div class="separator separator-dashed"></div>
                                                                <!--end::Separator-->
                                                            </div>
                                                            <!--end::Section-->
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <!--end::Wrapper-->
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Quote Summary-->
                                    </div>
                                    <!--end::Summary-->
                                    <!--begin::Team Chat-->
                                    <div class="col-lg-6">
                                        <!--begin::Messenger-->
                                        <div class="card" id="kt_chat_messenger">
                                            <!--begin::Card header-->
                                            <div class="card-header collapsible cursor-pointer rotate"
                                                 data-bs-toggle="collapse"
                                                 data-bs-target="#kt_messages_card_collapsible"
                                                 id="kt_chat_messenger_header">
                                                <!--begin::Title-->
                                                <div class="card-title">
                                                    <!--begin::User-->
                                                    <div class="d-flex justify-content-center flex-column me-3">
                                                        <a href="javascript:void(0)"
                                                           class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 mb-2 lh-1">Team
                                                            Chat</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Title-->
                                                <!--begin::Card toolbar-->
                                                <div class="card-toolbar rotate-180">
                                                    <button class="btn btn-sm btn-icon btn-active-light-primary">
                                                        <i class="bi bi-three-dots fs-2"></i>
                                                    </button>
                                                </div>
                                                <!--end::Card toolbar-->
                                            </div>
                                            <!--end::Card header-->
                                            <!--begin:card content-->
                                            <div id="kt_messages_card_collapsible" class="collapse show">
                                                <!--begin::Card body-->
                                                <div class="card-body" id="kt_chat_messenger_body">
                                                    <!--begin::Messages-->
                                                    <div class="scroll-y me-n5 pe-5 h-400px  h-lg-auto"
                                                         data-kt-element="messages" data-kt-scroll="true"
                                                         data-kt-scroll-activate="{default: false, lg: true}"
                                                         data-kt-scroll-max-height="auto"
                                                         data-kt-scroll-dependencies="#kt_chat_messenger_header, #kt_chat_messenger_footer"
                                                         data-kt-scroll-wrappers="#kt_chat_messenger_body"
                                                         data-kt-scroll-offset="5px">
                                                        <?php
                                                        $args = array(
                                                            'post_type' => AIRENO_CPT_MESSAGE,
                                                            'post_status' => array(
                                                                'publish'
                                                            ),
                                                            'posts_per_page' => -1,
                                                            'meta_key' => 'project_id',
                                                            'meta_value' => $project_id,
                                                            'meta_compare' => '=',
                                                            'order' => 'ASC'
                                                        );
                                                        $messages = new WP_Query($args);
                                                        if ($messages->have_posts()) {
                                                            while ($messages->have_posts()) {
                                                                $messages->the_post();
                                                                $content = get_the_content();
                                                                $s_args = array(
                                                                    'post_type' => 'attachment',
                                                                    'post_status' => 'inherit',
                                                                    'posts_per_page' => -1,
                                                                    'post_parent' => get_the_ID(),
                                                                    'order' => 'ASC'
                                                                );
                                                                $attachments = new WP_Query($s_args);

                                                                if ($content == '' && !$attachments->have_posts()) {
                                                                    wp_delete_post(get_the_ID());
                                                                    continue;
                                                                }

                                                                $author_id = get_the_author_meta('ID');
                                                                $avatar = get_field('_avatar', 'user_' . $author_id);
                                                                $author = get_the_author_meta('display_name');
                                                                if ($avatar) {
                                                                    $avatar_url = $avatar['sizes']['thumbnail'];
                                                                } else {
                                                                    $avatar_url = get_avatar_url($author_id);
                                                                }

                                                                $date = get_the_date('M d, Y'); // g:i:a
                                                                $time = get_the_time('g:i:a');
                                                                if ($user_id == $author_id) {
                                                                    ?>
                                                                    <!--begin::Message(template for out)-->
                                                                    <div class="d-flex justify-content-end mb-6">
                                                                        <!--begin::Wrapper-->
                                                                        <div class="d-flex flex-column align-items-end">
                                                                            <!--begin::User-->
                                                                            <div class="d-flex align-items-center mb-2">
                                                                                <!--begin::Details-->
                                                                                <div class="me-3">
                                                                                    <span class="text-muted fs-7 mb-1"
                                                                                          data-kt-element="message_datetime"><?= $date . ' ' . $time ?></span>
                                                                                    <a href="javascript:void(0)"
                                                                                       class="fs-5 fw-bolder text-gray-900 text-hover-primary ms-1"
                                                                                       data-kt-element="message_name">You</a>
                                                                                </div>
                                                                                <!--end::Details-->
                                                                                <!--begin::Avatar-->
                                                                                <div class="symbol symbol-35px symbol-circle">
                                                                                    <img alt="Pic"
                                                                                         data-kt-element="message_avatar"
                                                                                         src="<?= $avatar_url ?>"/>
                                                                                </div>
                                                                                <!--end::Avatar-->
                                                                            </div>
                                                                            <!--end::User-->
                                                                            <!--begin::Text-->
                                                                            <div
                                                                                    class="p-3 pb-0 rounded bg-primary mw-lg-400px text-end">
                                                                                <div
                                                                                        class="text-white fw-boldest mb-3 <?= $content == '' ? 'd-none' : '' ?>"
                                                                                        data-kt-element="message-text"><?= $content ?></div>
                                                                                <!--begin::attachments-->
                                                                                <div class="mw-lg-400px text-end"
                                                                                     data-kt-element="message-attachments">
                                                                                    <?php
                                                                                    if ($attachments->have_posts()) {
                                                                                        while ($attachments->have_posts()) {
                                                                                            $attachments->the_post();
                                                                                            $mime_type = get_post_mime_type(get_the_ID());
                                                                                            if (in_array($mime_type, PREVIEW_ALLOWED_IMG_FILE_TYPES)) {
                                                                                                ?>
                                                                                                <!--begin::Overlay-->
                                                                                                <a class="d-block overlay mb-3"
                                                                                                   data-fslightbox="lightbox-basic"
                                                                                                   data-kt-element="message-attachment-preview"
                                                                                                   href="<?= wp_get_attachment_url(get_the_ID()) ?>">
                                                                                                    <!--begin::Image-->
                                                                                                    <div class="d-block overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded"
                                                                                                         style="background-image:url('<?php echo wp_get_attachment_url(get_the_ID()) ?>')">
                                                                                                        <img src="<?= wp_get_attachment_url(get_the_ID()) ?>"
                                                                                                             class="mw-300px h-auto invisible"/>
                                                                                                    </div>
                                                                                                    <!--end::Image-->
                                                                                                    <!--begin::Action-->
                                                                                                    <div
                                                                                                            class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                                                                                        <i class="bi bi-eye-fill text-white fs-3x"></i>
                                                                                                    </div>
                                                                                                    <!--end::Action-->
                                                                                                </a>
                                                                                                <!--end::Overlay-->
                                                                                                <?php
                                                                                            } else {
                                                                                                ?>
                                                                                                <div
                                                                                                        class="mb-5"
                                                                                                        data-kt-element="message-attachment-download">
                                                                                                    <!--begin::Svg Icon | path: icons/duotune/files/fil003.svg-->
                                                                                                    <span class="svg-icon svg-icon-2x svg-icon-white me-4">
																			<svg xmlns="http://www.w3.org/2000/svg"
                                                                                 width="24"
                                                                                 height="24" viewBox="0 0 24 24"
                                                                                 fill="none">
                                                                                <path
                                                                                        opacity="0.3"
                                                                                        d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z"
                                                                                        fill="currentColor"/>
                                                                                <path
                                                                                        d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z"
                                                                                        fill="currentColor"/>
                                                                            </svg>
																		</span> <a
                                                                                                            href="<?= wp_get_attachment_url(get_the_ID()) ?>"
                                                                                                            download
                                                                                                            class="text-white fw-boldest"><?= basename(get_attached_file(get_the_ID())) ?></a>
                                                                                                    <!--end::Svg Icon-->
                                                                                                </div>
                                                                                                <?php
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                    wp_reset_query();
                                                                                    ?>
                                                                                </div>
                                                                                <!--end::attachments-->
                                                                            </div>
                                                                            <!--end::Text-->
                                                                        </div>
                                                                        <!--end::Wrapper-->
                                                                    </div>
                                                                    <!--end::Message(template for out)-->
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <!--begin::Message(template for in)-->
                                                                    <div class="d-flex justify-content-start mb-6">
                                                                        <!--begin::Wrapper-->
                                                                        <div class="d-flex flex-column align-items-start">
                                                                            <!--begin::User-->
                                                                            <div class="d-flex align-items-center mb-2">
                                                                                <!--begin::Avatar-->
                                                                                <div class="symbol symbol-35px symbol-circle">
                                                                                    <img alt="User"
                                                                                         data-kt-element="message_avatar"
                                                                                         src="<?= $avatar_url ?>"/>
                                                                                </div>
                                                                                <!--end::Avatar-->
                                                                                <!--begin::Details-->
                                                                                <div class="ms-3">
                                                                                    <a href="javascript:void(0)"
                                                                                       class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1"
                                                                                       data-kt-element="message_name"><?= $author ?></a>
                                                                                    <span
                                                                                            class="text-muted fs-7 mb-1"
                                                                                            data-kt-element="message_datetime"><?= $date . ' ' . $time ?></span>
                                                                                </div>
                                                                                <!--end::Details-->
                                                                            </div>
                                                                            <!--end::User-->
                                                                            <!--begin::Text-->
                                                                            <div
                                                                                    class="p-3 pb-0 rounded bg-info fw-bold mw-lg-400px text-start">
                                                                                <div
                                                                                        class="text-white fw-boldest mb-3 <?= $content == '' ? 'd-none' : '' ?>"
                                                                                        data-kt-element="message-text"><?= $content ?></div>
                                                                                <!--begin::attachments-->
                                                                                <div class="mw-lg-400px text-start"
                                                                                     data-kt-element="message-attachments">
                                                                                    <?php
                                                                                    if ($attachments->have_posts()) {
                                                                                        while ($attachments->have_posts()) {
                                                                                            $attachments->the_post();
                                                                                            $mime_type = get_post_mime_type(get_the_ID());
                                                                                            if (in_array($mime_type, PREVIEW_ALLOWED_IMG_FILE_TYPES)) {
                                                                                                ?>
                                                                                                <!--begin::Overlay-->
                                                                                                <a class="d-block overlay mb-3"
                                                                                                   data-fslightbox="lightbox-basic"
                                                                                                   data-kt-element="message-attachment-preview"
                                                                                                   href="<?= wp_get_attachment_url(get_the_ID()) ?>">
                                                                                                    <!--begin::Image-->
                                                                                                    <div class="d-block overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded"
                                                                                                         style="background-image:url('<?php echo wp_get_attachment_url(get_the_ID()) ?>')">
                                                                                                        <img src="<?= wp_get_attachment_url(get_the_ID()) ?>"
                                                                                                             class="mw-300px h-auto invisible"/>
                                                                                                    </div>
                                                                                                    <!--end::Image-->
                                                                                                    <!--begin::Action-->
                                                                                                    <div
                                                                                                            class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                                                                                        <i class="bi bi-eye-fill text-white fs-3x"></i>
                                                                                                    </div>
                                                                                                    <!--end::Action-->
                                                                                                </a>
                                                                                                <!--end::Overlay-->
                                                                                                <?php
                                                                                            } else {
                                                                                                ?>
                                                                                                <div
                                                                                                        class="mb-5"
                                                                                                        data-kt-element="message-attachment-download">
                                                                                                    <!--begin::Svg Icon | path: icons/duotune/files/fil003.svg-->
                                                                                                    <span class="svg-icon svg-icon-2x svg-icon-white me-4">
																			<svg xmlns="http://www.w3.org/2000/svg"
                                                                                 width="24"
                                                                                 height="24" viewBox="0 0 24 24"
                                                                                 fill="none">
                                                                                <path
                                                                                        opacity="0.3"
                                                                                        d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z"
                                                                                        fill="currentColor"/>
                                                                                <path
                                                                                        d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z"
                                                                                        fill="currentColor"/>
                                                                            </svg>
																		</span> <a
                                                                                                            href="<?= wp_get_attachment_url(get_the_ID()) ?>"
                                                                                                            download
                                                                                                            class="text-white fw-boldest"><?= basename(get_attached_file(get_the_ID())) ?></a>
                                                                                                    <!--end::Svg Icon-->
                                                                                                </div>
                                                                                                <?php
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                    wp_reset_query();
                                                                                    ?>
                                                                                </div>
                                                                                <!--end::attachments-->
                                                                            </div>
                                                                            <!--end::Text-->
                                                                        </div>
                                                                        <!--end::Wrapper-->
                                                                    </div>
                                                                    <!--end::Message(template for in)-->
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                        wp_reset_query();
                                                        ?>
                                                        <!--begin::Message(template for out)-->
                                                        <div class="d-flex justify-content-end mb-6 d-none"
                                                             data-kt-element="template-out">
                                                            <!--begin::Wrapper-->
                                                            <div class="d-flex flex-column align-items-end">
                                                                <!--begin::User-->
                                                                <div class="d-flex align-items-center mb-2">
                                                                    <!--begin::Details-->
                                                                    <div class="me-3">
																	<span class="text-muted fs-7 mb-1"
                                                                          data-kt-element="message_datetime">Just now</span>
                                                                        <a
                                                                                href="javascript:void(0)"
                                                                                class="fs-5 fw-bolder text-gray-900 text-hover-primary ms-1"
                                                                                data-kt-element="message_name">You</a>
                                                                    </div>
                                                                    <!--end::Details-->
                                                                    <!--begin::Avatar-->
                                                                    <div class="symbol symbol-35px symbol-circle">
                                                                        <img alt="Pic" data-kt-element="message_avatar"
                                                                             src="<?= get_theme_file_uri("assets/images/300-1.jpg") ?>"/>
                                                                    </div>
                                                                    <!--end::Avatar-->
                                                                </div>
                                                                <!--end::User-->
                                                                <!--begin::Text-->
                                                                <div class="p-3 rounded bg-primary mw-lg-400px text-end">
                                                                    <div class="text-white fw-boldest mb-3"
                                                                         data-kt-element="message-text"></div>
                                                                </div>
                                                                <!--end::Text-->
                                                            </div>
                                                            <!--end::Wrapper-->
                                                        </div>
                                                        <!--end::Message(template for out)-->
                                                        <!--begin::Message(template for in)-->
                                                        <div class="d-flex justify-content-start mb-6 d-none"
                                                             data-kt-element="template-in">
                                                            <!--begin::Wrapper-->
                                                            <div class="d-flex flex-column align-items-start">
                                                                <!--begin::User-->
                                                                <div class="d-flex align-items-center mb-2">
                                                                    <!--begin::Avatar-->
                                                                    <div class="symbol symbol-35px symbol-circle">
                                                                        <img alt="Pic" data-kt-element="message_avatar"
                                                                             src="<?= get_theme_file_uri("assets/images/300-25.jpg") ?>"/>
                                                                    </div>
                                                                    <!--end::Avatar-->
                                                                    <!--begin::Details-->
                                                                    <div class="ms-3">
                                                                        <a href="javascript:void(0)"
                                                                           class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1"
                                                                           data-kt-element="message_name">Brian Cox</a>
                                                                        <span
                                                                                class="text-muted fs-7 mb-1"
                                                                                data-kt-element="message_datetime">Just now</span>
                                                                    </div>
                                                                    <!--end::Details-->
                                                                </div>
                                                                <!--end::User-->
                                                                <!--begin::Text-->
                                                                <div
                                                                        class="p-3 pb-0 rounded bg-light-info mw-lg-400px text-start">
																<span class="text-dark fw-bold mb-3"
                                                                      data-kt-element="message-text"></span>
                                                                    <!--begin::attachments-->
                                                                    <div class="mw-lg-400px text-start"
                                                                         data-kt-element="message-attachments">
                                                                        <img class="mb-3 d-block mw-300px h-auto d-none"
                                                                             data-kt-element="message-attachment"
                                                                             src=""/>
                                                                    </div>
                                                                    <!--end::attachments-->
                                                                </div>
                                                                <!--end::Text-->
                                                            </div>
                                                            <!--end::Wrapper-->
                                                        </div>
                                                        <!--end::Message(template for in)-->
                                                    </div>
                                                    <!--end::Messages-->
                                                </div>
                                                <!--end::Card body-->
                                                <!--begin::Card footer-->
                                                <div class="card-footer pt-4" id="kt_chat_messenger_footer">
                                                    <!--begin:image preview-->
                                                    <div class="w-100" data-kt-element="kt_chat_previews">
                                                        <div class="d-none  float-start p-1 d-flex w-100 w-sm-50 "
                                                             data-kt-element="preview-template">
                                                            <div
                                                                    class="position-relative flex-stack border-dotted border-1 w-100 d-flex p-2 rounded-10px">
                                                                <div
                                                                        class="d-flex justify-content-start align-items-center">
                                                                    <img src="" alt="" class="h-50px w-auto mw-200px"
                                                                         height="auto"/> <span class="d-none for-img"><i
                                                                                class="bi bi-card-text fs-4hx"></i></span>
                                                                    <div class="d-inline-block ms-5">
                                                                        <span class="d-block img-title">title.png</span>
                                                                        <span
                                                                                class="d-block img-size">234.4KB</span>
                                                                    </div>
                                                                </div>
                                                                <a class="ai-remove" href="javascript:void(0)"
                                                                   data-file-id=""> <i
                                                                            class="bi bi-x-lg text-danger fs-2 fw-bolder"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end:image preview-->
                                                    <!--begin::Input-->
                                                    <textarea class="form-control mb-3" rows="3"
                                                              data-kt-element="input"
                                                              placeholder="Type a message"></textarea>
                                                    <!--end::Input-->
                                                    <!--begin:Toolbar-->
                                                    <div class="d-flex flex-stack">
                                                        <!--begin::Actions-->
                                                        <div class="d-flex align-items-center me-2">
                                                            <button id="kt_message_file_trigger"
                                                                    class="btn btn-sm btn-icon btn-active-light-primary me-1"
                                                                    type="button" data-bs-toggle="tooltip"
                                                                    title="Attach file(s)">
                                                                <i class="bi bi-paperclip fs-3"></i>
                                                            </button>
                                                            <input type="file" id="kt_message_file" multiple
                                                                   class="d-none"
                                                                   accept=".xlsx, .xls, .csv, .pdf , image/*, .doc, .docx, .txt, image/heic, .xlsx"/>
                                                        </div>
                                                        <!--end::Actions-->
                                                        <!--begin::Send-->
                                                        <button class="btn btn-primary" type="button"
                                                                data-kt-element="send">Send
                                                        </button>
                                                        <!--end::Send-->
                                                    </div>
                                                    <!--end::Toolbar-->
                                                </div>
                                                <!--end::Card footer-->
                                            </div>
                                            <!--end:card content-->
                                        </div>
                                        <!--end::Messenger-->
                                    </div>
                                    <!--end::Team Chat-->
                                    <!--begin::Tasks-->
                                    <div class="col-lg-6">
                                        <!--begin:card-->
                                        <div class="card">
                                            <!--begin::Card header-->
                                            <div class="card-header collapsible cursor-pointer rotate"
                                                 data-bs-toggle="collapse"
                                                 data-bs-target="#kt_tasks_card_collapsible"
                                                 id="kt_tasks_header">
                                                <!--begin::Title-->
                                                <div class="card-title">
                                                    <!--begin::User-->
                                                    <div class="d-flex justify-content-center flex-column me-3">
                                                        <h3 class="fw-bolder mb-1">Tasks</h3>
                                                        <?php
                                                        $args = array(
                                                            'post_type' => AIRENO_CPT_TASK,
                                                            'post_status' => array(
                                                                'publish'
                                                            ),
                                                            'posts_per_page' => -1,
                                                            'meta_key' => 'project_id',
                                                            'meta_value' => $project_id,
                                                            'meta_compare' => '=',
                                                            'order' => 'ASC'
                                                        );
                                                        $tasks = new WP_Query($args);
                                                        ?>
                                                        <div
                                                                class="fs-6 text-gray-400">
                                                            Total <span
                                                                    class="tasks_count"><?= intval($tasks->post_count) ?></span>
                                                        </div>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Title-->
                                                <!--begin::Card toolbar-->
                                                <div class="card-toolbar">
                                                    <button
                                                            class="btn btn-sm btn-secondary collapsible btn-active-light-primary"
                                                            data-bs-toggle="collapse" data-bs-target="#kt_tasks_footer">
                                                        Add Task
                                                    </button>
                                                </div>
                                                <!--end::Card toolbar-->
                                            </div>
                                            <!--end::Card header-->

                                            <!--begin:card content-->
                                            <div id="kt_tasks_card_collapsible" class="collapse show">
                                                <!--begin::Card body-->
                                                <div class="card-body" id="kt_tasks_body">
                                                    <div class="scroll-y me-n5 pe-5 h-400px h-lg-auto"
                                                         data-kt-element="tasks" data-kt-scroll="true"
                                                         data-kt-scroll-activate="{default: false, lg: true}"
                                                         data-kt-scroll-max-height="auto"
                                                         data-kt-scroll-dependencies="#kt_tasks_header, #kt_tasks_footer"
                                                         data-kt-scroll-wrappers="#kt_tasks_body"
                                                         data-kt-scroll-offset="5px">
                                                        <!--begin::Task(template for out)-->
                                                        <div class="d-flex align-items-center mb-6 d-none overlay"
                                                             data-task="" data-kt-element="task-template">
                                                            <!--begin::Bullet-->
                                                            <span
                                                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 bg-info"></span>
                                                            <!--end::Bullet-->
                                                            <!--begin::Checkbox-->
                                                            <div
                                                                    class="form-check form-check-custom form-check-solid mx-5">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="1"
                                                                       data-kt-element="complete">
                                                            </div>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Info-->
                                                            <div class="flex-grow-1 me-5">
                                                                <!--begin::Time-->
                                                                <div class="text-gray-800 fw-bold fs-3"
                                                                     data-kt-element="title"></div>
                                                                <!--end::Time-->
                                                                <div class="d-flex flex-column">
                                                                    <!--begin::Description-->
                                                                    <div class="d-flex flex-stack">
                                                                        <div class="text-gray-700 fw-bold fs-6"
                                                                             data-kt-element="datetime"></div>
                                                                        <!--begin::Menu-->
                                                                        <div class="ms-2 d-inline-flex flex-end">
                                                                            <div
                                                                                    class="overlay-layer bg-opacity-0 position-relative">
                                                                                <button
                                                                                        class="btn btn-flush btn-active-light-primary"
                                                                                        data-task-edit="true">
                                                                                    <i class="bi bi-pencil-square fs-6"></i>
                                                                                </button>
                                                                                <button
                                                                                        class="btn btn-flush btn-active-light-primary"
                                                                                        data-task-delete="true">
                                                                                    <i class="bi bi-x fs-3"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                        <!--end::Menu-->
                                                                    </div>
                                                                    <!--end::Description-->
                                                                    <!--begin::Link-->
                                                                    <div class="text-gray-400 fw-bold fs-7"
                                                                         data-kt-element="users"></div>
                                                                    <input type="hidden" data-kt-element="data"
                                                                           value=''/>
                                                                    <!--end::Link-->
                                                                </div>
                                                            </div>
                                                            <!--end::Info-->
                                                            <!--begin::Action-->
                                                            <span
                                                                    class="badge badge-light-primary fs-8 fw-bolder px-6 py-3"
                                                                    data-kt-element="type"></span>
                                                            <!--end::Action-->
                                                        </div>
                                                        <!--end::Task(template for out)-->
                                                        <?php
                                                        if ($tasks->have_posts()) {
                                                            while ($tasks->have_posts()) {
                                                                $tasks->the_post();
                                                                $type = get_field('task_type', get_the_ID());
                                                                $task_users = get_field('task_users', get_the_ID());
                                                                $datetime = get_field('task_datetime', get_the_ID());
                                                                $completed = get_field('completed', get_the_ID());
                                                                $usernames = array();
                                                                $data = array();
                                                                foreach ($task_users as $task_user) {
                                                                    $task_userdata = aireno_get_userdata($task_user);
                                                                    $usernames[] = $task_userdata->display_name;
                                                                    $data[] = array(
                                                                        'id' => $task_user,
                                                                        'name' => $task_userdata->display_name
                                                                    );
                                                                }
                                                                $data_json = json_encode($data); // str_replace('"', "'", json_encode($data));
                                                                ?>
                                                                <!--begin::task item-->
                                                                <div class="d-flex align-items-center mb-6 overlay"
                                                                     data-task="<?= get_the_ID() ?>">
                                                                    <!--begin::Bullet-->
                                                                    <span
                                                                            class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 bg-info"></span>
                                                                    <!--end::Bullet-->
                                                                    <!--begin::Checkbox-->
                                                                    <div
                                                                            class="form-check form-check-custom form-check-solid mx-5">
                                                                        <input class="form-check-input" type="checkbox"
                                                                               value="1"
                                                                               data-kt-element="complete"
                                                                            <?= $completed ? 'disabled checked' : '' ?>>
                                                                    </div>
                                                                    <!--end::Checkbox-->
                                                                    <!--begin::Info-->
                                                                    <div class="flex-grow-1 me-5">
                                                                        <!--begin::Time-->
                                                                        <div class="text-gray-800 fw-bold fs-3"
                                                                             data-kt-element="title"><?= get_the_title() ?></div>
                                                                        <!--end::Time-->
                                                                        <div class="d-flex flex-column">
                                                                            <!--begin::Description-->
                                                                            <div class="d-flex flex-stack">
                                                                                <div class="text-gray-700 fw-bold fs-6"
                                                                                     data-kt-element="datetime"><?= $datetime ?>
                                                                                </div>
                                                                                <?php
                                                                                $task_author = get_post_field('post_author');
                                                                                if ($task_author == $user_id) {
                                                                                    ?>
                                                                                    <!--begin::Menu-->
                                                                                    <div class="ms-2 d-inline-flex flex-end">
                                                                                        <div
                                                                                                class="overlay-layer bg-opacity-0 position-relative">
                                                                                            <button
                                                                                                    class="btn btn-flush btn-active-light-primary"
                                                                                                    data-task-edit="true">
                                                                                                <i class="bi bi-pencil-square fs-6"></i>
                                                                                            </button>
                                                                                            <button
                                                                                                    class="btn btn-flush btn-active-light-primary"
                                                                                                    data-task-delete="true">
                                                                                                <i class="bi bi-x fs-3"></i>
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!--end::Menu-->
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                            <!--end::Description-->
                                                                            <!--begin::Link-->
                                                                            <div class="text-gray-400 fw-bold fs-7"
                                                                                 data-kt-element="users">
                                                                                <?= implode(', ', $usernames) ?></div>
                                                                            <input type="hidden" data-kt-element="data"
                                                                                   value='<?= $data_json ?>'/>
                                                                            <!--end::Link-->
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Info-->
                                                                    <!--begin::Action-->
                                                                    <span
                                                                            class="badge badge-light-primary fs-8 fw-bolder px-6 py-3"
                                                                            data-kt-element="type"><?= $type ?></span>
                                                                    <!--end::Action-->
                                                                </div>
                                                                <!--end::task item-->
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </div>

                                                </div>
                                                <!--end::Card body-->
                                                <!--begin::Card footer-->
                                                <div class="card-footer pt-4 collapse" id="kt_tasks_footer">
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control mb-3"
                                                           data-kt-element="input" placeholder="Title"/>
                                                    <!--end::Input-->
                                                    <!--begin::task datetime, type-->
                                                    <div class="d-flex flex-stack mb-3">
                                                        <input type="hidden" data-kt-element="task_id" value=""/>
                                                        <!--begin::Select2-->
                                                        <select class="form-select" data-kt-element="type_field"
                                                                data-control="select2" data-hide-search="true"
                                                                data-placeholder="Select a type">
                                                            <option value=""></option>
                                                            <option value="Meeting">Meeting</option>
                                                            <option value="Call">Call</option>
                                                            <option value="Delivery">Delivery</option>
                                                            <option value="Follow Up">Follow Up</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                        <!--end::Select2-->
                                                        <!--begin::datetime-->
                                                        <input class="form-control"
                                                               data-kt-element="datetime_field"
                                                               placeholder="Pick date &amp; time"
                                                               value="<?= date_i18n('Y-m-d H:i') ?>"/>
                                                        <!--end::datetime-->
                                                    </div>
                                                    <!--end::task datetime, type-->
                                                    <!--begin::task assigned users-->
                                                    <div class="d-flex mb-3">
                                                        <!--begin::Select2-->
                                                        <select class="form-select" data-kt-element="users_field"
                                                                data-control="select2" multiple
                                                                data-placeholder="Assign users">
                                                            <?php
                                                            foreach ($team_members as $team_member) {
                                                                ?>
                                                                <option
                                                                        value="<?= $team_member->id ?>">
                                                                    <?= $team_member->display_name ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <!--end::Select2-->
                                                    </div>
                                                    <!--end::task assigned users-->
                                                    <!--begin:Toolbar-->
                                                    <div class="d-flex flex-stack">
                                                        <!--begin::Actions-->
                                                        <button class="btn btn-active-light-primary" type="button"
                                                                data-kt-element="cancel">Cancel
                                                        </button>
                                                        <!--end::Actions-->
                                                        <!--begin::Send-->
                                                        <button class="btn btn-primary" type="button"
                                                                data-kt-element="save">Save
                                                        </button>
                                                        <!--end::Send-->
                                                    </div>
                                                    <!--end::Toolbar-->
                                                </div>
                                                <!--end::Card footer-->
                                            </div>
                                            <!--end:card content-->
                                        </div>
                                        <!--end:card-->
                                    </div>
                                    <!--end::Tasks-->
                                    <!--begin::Notes-->
                                    <div class="col-lg-6">
                                        <!--begin:card-->
                                        <div class="card">
                                            <!--begin::Card header-->
                                            <div class="card-header collapsible cursor-pointer rotate"
                                                 data-bs-toggle="collapse"
                                                 data-bs-target="#kt_notes_card_collapsible"
                                                 id="kt_notes_header">
                                                <!--begin::Title-->
                                                <div class="card-title">
                                                    <!--begin::User-->
                                                    <div class="d-flex justify-content-center flex-column me-3">
                                                        <h3 class="fw-bolder mb-1">Notes</h3>
                                                        <?php
                                                        $args = array(
                                                            'post_type' => AIRENO_CPT_NOTE,
                                                            'post_status' => array(
                                                                'publish'
                                                            ),
                                                            'posts_per_page' => -1,
                                                            'meta_key' => 'project_id',
                                                            'meta_value' => $project_id,
                                                            'meta_compare' => '=',
                                                            'order' => 'ASC'
                                                        );
                                                        $notes = new WP_Query($args);
                                                        ?>
                                                        <div
                                                                class="fs-6 text-gray-400">
                                                            Total <span
                                                                    class="notes_count"><?= intval($notes->post_count) ?></span>
                                                        </div>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Title-->
                                                <!--begin::Card toolbar-->
                                                <div class="card-toolbar">
                                                    <button
                                                            class="btn btn-sm collapsible btn-secondary btn-active-light-primary"
                                                            data-bs-toggle="collapse" data-bs-target="#kt_notes_footer">
                                                        Add Note
                                                    </button>
                                                </div>
                                                <!--end::Card toolbar-->
                                            </div>
                                            <!--end::Card header-->

                                            <!--begin:card content-->
                                            <div id="kt_notes_card_collapsible" class="collapse show">
                                                <!--begin::Card body-->
                                                <div class="card-body" id="kt_notes_body">
                                                    <div class="scroll-y me-n5 pe-5 h-400px h-lg-auto"
                                                         data-kt-element="notes" data-kt-scroll="true"
                                                         data-kt-scroll-activate="{default: false, lg: true}"
                                                         data-kt-scroll-max-height="auto"
                                                         data-kt-scroll-dependencies="#kt_notes_header, #kt_notes_footer"
                                                         data-kt-scroll-wrappers="#kt_notes_body"
                                                         data-kt-scroll-offset="5px">
                                                        <?php
                                                        if ($notes->have_posts()) {
                                                            while ($notes->have_posts()) {
                                                                $notes->the_post();
                                                                $author_id = get_the_author_meta('ID');
                                                                $avatar = get_field('_avatar', 'user_' . $author_id);
                                                                $author = get_the_author_meta('display_name');
                                                                if ($avatar) {
                                                                    $avatar_url = $avatar['sizes']['thumbnail'];
                                                                } else {
                                                                    $avatar_url = get_avatar_url($author_id);
                                                                }
                                                                $viewer = get_field('viewer');
                                                                ?>

                                                                <!--begin::Message(template for in)-->
                                                                <div class="d-flex justify-content-start mb-10 overlay"
                                                                     data-note="<?= get_the_ID() ?>">
                                                                    <!--begin::Avatar-->
                                                                    <div class="symbol symbol-45px me-5">
                                                                        <img alt="Pic" data-kt-element="note_avatar"
                                                                             src="<?= $avatar_url ?>"/>
                                                                    </div>
                                                                    <!--end::Avatar-->
                                                                    <!--begin::Info-->
                                                                    <div class="d-flex flex-column flex-row-fluid">
                                                                        <!--begin::Info-->
                                                                        <div class="d-flex align-items-center flex-wrap mb-1">
                                                                            <a href="javascript:void(0)"
                                                                               class="text-gray-800 text-hover-primary fw-bolder me-2"
                                                                               data-kt-element="note_name"><?= $author ?></a>
                                                                            <span
                                                                                    class="text-gray-400 fw-bold fs-7"
                                                                                    data-kt-element="note_datetime"><?= get_the_date('M d, Y H:i a') ?></span>
                                                                            <input type="hidden"
                                                                                   data-kt-element="note_viewer"
                                                                                   value="<?= $viewer ?>">
                                                                            <?php
                                                                            if ($user_id == $author_id) {
                                                                                ?>
                                                                                <!--begin::Menu-->
                                                                                <div class="ms-auto d-inline-flex flex-end">
                                                                                    <div
                                                                                            class="overlay-layer bg-opacity-0 position-relative">
                                                                                        <button class="btn btn-flush btn-active-light-primary"
                                                                                                data-note-edit="true">
                                                                                            <i class="bi bi-pencil-square fs-6"></i>
                                                                                        </button>
                                                                                        <button class="btn btn-flush btn-active-light-primary"
                                                                                                data-note-delete="true">
                                                                                            <i class="bi bi-x fs-3"></i>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                                <!--end::Menu-->
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                        <!--end::Info-->
                                                                        <!--begin::Post-->
                                                                        <div class="text-gray-800 fs-7 fw-normal pt-1"
                                                                             data-kt-element="message-text">
                                                                            <span class="text-content"><?= get_the_content() ?></span>
                                                                        </div>
                                                                        <!--end::Post-->
                                                                    </div>
                                                                    <!--end::Info-->
                                                                </div>
                                                                <!--end::Message(template for in)-->
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                        <!--begin::Message(template for in)-->
                                                        <div
                                                                class="d-flex justify-content-start mb-10 d-none overlay"
                                                                data-kt-element="template-in" data-note="">
                                                            <!--begin::Avatar-->
                                                            <div class="symbol symbol-45px me-5">
                                                                <img data-kt-element="note_avatar" alt=""/>
                                                            </div>
                                                            <!--end::Avatar-->
                                                            <!--begin::Info-->
                                                            <div class="d-flex flex-column flex-row-fluid">
                                                                <!--begin::Info-->
                                                                <div class="d-flex align-items-center flex-wrap mb-1">
                                                                    <a href="javascript:void(0)"
                                                                       class="text-gray-800 text-hover-primary fw-bolder me-2"
                                                                       data-kt-element="note_name"></a> <span
                                                                            class="text-gray-400 fw-bold fs-7"
                                                                            data-kt-element="note_datetime"></span>
                                                                    <input
                                                                            type="hidden" data-kt-element="note_viewer"
                                                                            value="">
                                                                    <!--begin::Menu-->
                                                                    <div class="ms-auto d-inline-flex flex-end">
                                                                        <div
                                                                                class="overlay-layer bg-opacity-0 position-relative">
                                                                            <button class="btn btn-flush btn-active-light-primary"
                                                                                    data-note-edit="true">
                                                                                <i class="bi bi-pencil-square fs-6"></i>
                                                                            </button>
                                                                            <button class="btn btn-flush btn-active-light-primary"
                                                                                    data-note-delete="true">
                                                                                <i class="bi bi-x fs-3"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Menu-->
                                                                </div>
                                                                <!--end::Info-->
                                                                <!--begin::Post-->
                                                                <div class="text-gray-800 fs-7 fw-normal pt-1"
                                                                     data-kt-element="message-text">
                                                                    <span class="text-content"></span>
                                                                </div>
                                                                <!--end::Post-->
                                                            </div>
                                                            <!--end::Info-->
                                                        </div>
                                                        <!--end::Message(template for in)-->
                                                    </div>
                                                </div>
                                                <!--end::Card body-->
                                                <!--begin::Card footer-->
                                                <div class="card-footer collapse pt-4" id="kt_notes_footer">
                                                    <div class="kt_drawer_note_sender">
                                                        <!--begin::Input-->
                                                        <textarea class="form-control mb-3" rows="2"
                                                                  data-kt-element="input"
                                                                  placeholder="Type note"></textarea>
                                                        <!--end::Input-->
                                                        <!--begin:Toolbar-->
                                                        <div class="d-flex flex-stack">
                                                            <!--begin::Actions-->
                                                            <div class="me-2 d-none">
                                                                <p>Who will see this Note?</p>
                                                                <select class="form-select" data-kt-element="viewer">
                                                                    <option value="all">Everyone</option>
                                                                </select>
                                                            </div>
                                                            <!--end::Actions-->
                                                            <!--begin::Send-->
                                                            <button class="btn btn-primary" type="button"
                                                                    data-kt-element="send">Add Note
                                                            </button>
                                                            <!--end::Send-->
                                                        </div>
                                                        <!--end::Toolbar-->
                                                    </div>
                                                    <div class="kt_drawer_note_editor d-none">
                                                        <!--begin::Input-->
                                                        <textarea class="form-control mb-3" rows="2"
                                                                  data-kt-element="input"
                                                                  placeholder="Type note"></textarea>
                                                        <!--end::Input-->
                                                        <input type="hidden" data-kt-element="note_edit_id"
                                                               value="">
                                                        <!--begin:Toolbar-->
                                                        <div class="d-flex flex-stack">
                                                            <!--begin::Actions-->
                                                            <div class="me-2 d-none">
                                                                <p>Who will see this Note?</p>
                                                                <select class="form-select" data-kt-element="viewer">
                                                                    <option value="all">Everyone</option>
                                                                </select>
                                                            </div>
                                                            <!--end::Actions-->
                                                            <!--begin::Send-->
                                                            <button class="btn btn-secondary" type="button"
                                                                    data-kt-element="cancel_note">Cancel
                                                            </button>
                                                            <button class="btn btn-primary" type="button"
                                                                    data-kt-element="save_note">Update note
                                                            </button>
                                                            <!--end::Send-->
                                                        </div>
                                                        <!--end::Toolbar-->
                                                    </div>
                                                </div>
                                                <!--end::Card footer-->
                                            </div>
                                            <!--end:card content-->
                                        </div>
                                        <!--end:card-->
                                    </div>
                                    <!--end::Notes-->
                                </div>
                            </div>
                            <!--End:Overview-->
                            <!--Begin:Schedules-->
                            <div class="tab-pane fade show <?= $tab == 'project-schedules' ? 'active' : '' ?>"
                                 id="project-schedules" role="tabpanel">
                                <?php
                                $args = array(
                                    'post_type' => AIRENO_CPT_SCHEDULE,
                                    'post_status' => array(
                                        'publish'
                                    ),
                                    'posts_per_page' => -1,
                                    'meta_key' => 'project_id',
                                    'meta_value' => $project_id,
                                    'meta_compare' => '='
                                );
                                $schedule_query = new WP_Query($args);
                                $schedules = array();
                                if ($schedule_query->have_posts()) {
                                    while ($schedule_query->have_posts()) {
                                        $schedule_query->the_post();
                                        $schedule_status = get_field('status', get_the_ID());
                                        $schedule_tasks = array();
                                        $schedule_comments = array();
                                        $schedule_attachments = array();
                                        if (have_rows('tasks')) {
                                            while (have_rows('tasks')) {
                                                the_row();
                                                $schedule_tasks[] = array(
                                                    'title' => get_sub_field('title'),
                                                    'done' => get_sub_field('done')
                                                );
                                            }
                                        }

                                        if (have_rows('comments')) {
                                            while (have_rows('comments')) {
                                                the_row();
                                                $schedule_comments[] = get_sub_field('comment');
                                            }
                                        }
                                        $schedules[$schedule_status][get_the_ID()] = array(
                                            'ID' => get_the_ID(),
                                            'title' => get_the_title(),
                                            'content' => get_the_content(),
                                            'tasks' => $schedule_tasks,
                                            'comments' => $schedule_comments,
                                            'duration' => intval(get_field('duration', get_the_ID()))
                                        );
                                    }
                                }
                                wp_reset_query();
                                ?>
                                <!--begin::Row-->
                                <div class="row g-9 schedules">
                                    <!--begin::Col-->
                                    <div class="col-md-4">
                                        <!--begin::Col header-->
                                        <div class="mb-9">
                                            <div class="d-flex flex-stack">
                                                <div class="fw-bolder fs-4">
                                                    Yet to start <span
                                                            class="fs-6 text-gray-400 ms-2"
                                                            data-kt-element="schedules-count"><?= (array_key_exists(0, $schedules)) ? count($schedules[0]) : 0 ?></span>
                                                </div>
                                            </div>
                                            <div class="h-3px w-100 bg-warning"></div>
                                        </div>
                                        <!--end::Col header-->
                                        <!--begin::Card-->
                                        <?php
                                        if (array_key_exists(0, $schedules)) {
                                            foreach ($schedules[0] as $schedule_id => $schedule) {
                                                $schedule_attachments = get_posts(array(
                                                    'post_type' => 'attachment',
                                                    'posts_per_page' => -1,
                                                    'post_parent' => $schedule_id,
                                                    'post_status' => array(
                                                        'inherit'
                                                    ),
                                                    'orderby' => 'ID',
                                                    'order' => 'ASC'
                                                ));
                                                wp_reset_postdata();
                                                ?>
                                                <!--begin::Card-->
                                                <div class="card mb-6 mb-xl-9" data-kt-element="schedule"
                                                     data-schedule-id="<?= $schedule_id ?>">
                                                    <!--begin::Card body-->
                                                    <div class="card-body">
                                                        <!--begin::Header-->
                                                        <div class="d-flex flex-stack mb-3">
												            <span class="badge badge-success fs-8 fw-bold">
                                                                <span data-kt-element="duration"><?= $schedule['duration'] ?></span>&nbsp;Days</span>
                                                            <!--begin::Menu-->
                                                            <div>
                                                                <button type="button"
                                                                        class="btn btn-sm btn-icon btn-color-light-dark btn-active-light-primary"
                                                                        data-kt-menu-trigger="click"
                                                                        data-kt-menu-placement="bottom-end">
                                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                                                    <span class="svg-icon svg-icon-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                             width="24px" height="24px"
                                                                             viewBox="0 0 24 24">
                                                                            <g stroke="none" stroke-width="1"
                                                                               fill="none" fill-rule="evenodd">
                                                                                <rect
                                                                                        x="5" y="5" width="5" height="5"
                                                                                        rx="1"
                                                                                        fill="currentColor"/>
                                                                                <rect
                                                                                        x="14" y="5" width="5"
                                                                                        height="5" rx="1"
                                                                                        fill="currentColor"
                                                                                        opacity="0.3"/>
                                                                                <rect
                                                                                        x="5" y="14" width="5"
                                                                                        height="5" rx="1"
                                                                                        fill="currentColor"
                                                                                        opacity="0.3"/>
                                                                                <rect
                                                                                        x="14" y="14" width="5"
                                                                                        height="5" rx="1"
                                                                                        fill="currentColor"
                                                                                        opacity="0.3"/>
                                                                            </g>
                                                                        </svg>
                                                                    </span>
                                                                    <!--end::Svg Icon-->
                                                                </button>
                                                                <!--begin::Menu 1-->
                                                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px pb-7"
                                                                     data-kt-menu="true"
                                                                     id="kt_schedule_menu_<?= $schedule_id ?>">
                                                                    <!--begin::Header-->
                                                                    <div class="px-7 py-5">
                                                                        <div class="fs-5 text-grey">Settings</div>
                                                                    </div>
                                                                    <div class="px-7 py-2">
                                                                        <select class="form-select form-select-solid text-dark"
                                                                                data-kt-element="status">
                                                                            <option value="0" selected>Yet to start
                                                                            </option>
                                                                            <option value="1">In Process</option>
                                                                            <option value="2">Complete</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="px-7 py-2">
                                                                        <a class="w-100 d-block py-3 fs-5 text-dark fw-bolder"
                                                                           data-kt-element="edit"
                                                                           href="javascript:void(0)">Edit</a>
                                                                    </div>
                                                                    <div class="px-7 py-2">
                                                                        <a class="w-100 d-block py-3 fs-5 text-dark fw-bolder"
                                                                           data-kt-element="delete"
                                                                           href="javascript:void(0)">Delete</a>
                                                                    </div>
                                                                    <!--end::Header-->
                                                                </div>
                                                                <!--end::Menu 1-->
                                                            </div>
                                                            <!--end::Menu-->
                                                        </div>
                                                        <!--end::Header-->
                                                        <div class="d-flex mb-3">
                                                            <!--begin::Title-->
                                                            <a href="javascript:void(0)"
                                                               class="fs-4 fw-bolder mb-1 text-gray-900 text-hover-primary"
                                                               data-kt-element="title"><?= $schedule['title'] ?></a>
                                                            <!--end::Title-->
                                                        </div>
                                                        <!--begin::Content-->
                                                        <div class="fs-6 fw-bold text-gray-600 mb-5"
                                                             data-kt-element="content"><?= $schedule['content'] ?></div>
                                                        <!--end::Content-->
                                                        <!--begin:Tasks-->
                                                        <div class="d-flex flex-column mb-3" data-kt-element="tasks">
                                                            <?php
                                                            foreach ($schedule['tasks'] as $task_index => $task) {
                                                                ?>
                                                                <label class="d-flex flex-row mb-3 cursor-pointer"
                                                                       data-kt-element="task">
                                                                    <div class="form-check form-check-custom form-check-solid">
                                                                        <input class="form-check-input" type="checkbox"
                                                                               value="<?= $task_index ?>"
                                                                            <?= ($task['done']) ? 'disabled checked' : '' ?>
                                                                               data-kt-element="task-completed">
                                                                    </div>
                                                                    <div class="ms-3 text-dark"
                                                                         data-kt-element="task-title"><?= $task['title'] ?></div>
                                                                </label>
                                                                <?php
                                                            }
                                                            ?>
                                                            <label
                                                                    class="d-flex flex-row mb-3 cursor-pointer d-none"
                                                                    data-kt-element="task-template">
                                                                <div class="form-check form-check-custom form-check-solid">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           value="" data-kt-element="task-completed">
                                                                </div>
                                                                <div class="ms-3 text-dark"
                                                                     data-kt-element="task-title"></div>
                                                            </label>
                                                        </div>
                                                        <!--end:Tasks-->
                                                        <!--begin::Footer-->
                                                        <div class="d-flex flex-stack flex-wrap mb-3">
                                                            <!--begin::Stats-->
                                                            <div class="d-flex my-1">
                                                                <!--begin::Stat-->
                                                                <a data-bs-toggle="collapse"
                                                                   data-bs-target="#kt_schedule_<?= $schedule_id ?>_attachments_collapsible"
                                                                   href="javascript:void(0)"
                                                                   class="border border-2 border-dashed border-gray-300 rounded py-2 px-3">
                                                                    <!--begin::Svg Icon | path: icons/duotune/communication/com008.svg-->
                                                                    <span class="svg-icon svg-icon-3"> <svg
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                width="24"
                                                                                height="24" viewBox="0 0 24 24"
                                                                                fill="none">
                                                                <path
                                                                        opacity="0.3"
                                                                        d="M4.425 20.525C2.525 18.625 2.525 15.525 4.425 13.525L14.825 3.125C16.325 1.625 18.825 1.625 20.425 3.125C20.825 3.525 20.825 4.12502 20.425 4.52502C20.025 4.92502 19.425 4.92502 19.025 4.52502C18.225 3.72502 17.025 3.72502 16.225 4.52502L5.82499 14.925C4.62499 16.125 4.62499 17.925 5.82499 19.125C7.02499 20.325 8.82501 20.325 10.025 19.125L18.425 10.725C18.825 10.325 19.425 10.325 19.825 10.725C20.225 11.125 20.225 11.725 19.825 12.125L11.425 20.525C9.525 22.425 6.425 22.425 4.425 20.525Z"
                                                                        fill="currentColor"/>
                                                                <path
                                                                        d="M9.32499 15.625C8.12499 14.425 8.12499 12.625 9.32499 11.425L14.225 6.52498C14.625 6.12498 15.225 6.12498 15.625 6.52498C16.025 6.92498 16.025 7.525 15.625 7.925L10.725 12.8249C10.325 13.2249 10.325 13.8249 10.725 14.2249C11.125 14.6249 11.725 14.6249 12.125 14.2249L19.125 7.22493C19.525 6.82493 19.725 6.425 19.725 5.925C19.725 5.325 19.525 4.825 19.125 4.425C18.725 4.025 18.725 3.42498 19.125 3.02498C19.525 2.62498 20.125 2.62498 20.525 3.02498C21.325 3.82498 21.725 4.825 21.725 5.925C21.725 6.925 21.325 7.82498 20.525 8.52498L13.525 15.525C12.325 16.725 10.525 16.725 9.32499 15.625Z"
                                                                        fill="currentColor"/>
                                                            </svg>
													</span> <!--end::Svg Icon--> <span
                                                                            class="ms-1 fs-7 fw-bolder text-gray-600"
                                                                            data-kt-element="attachments-count"><?= count($schedule_attachments) ?></span>
                                                                </a>
                                                                <!--end::Stat-->
                                                                <!--begin::Stat-->
                                                                <a data-bs-toggle="collapse"
                                                                   data-bs-target="#kt_schedule_<?= $schedule_id ?>_comments_collapsible"
                                                                   href="javascript:void(0)"
                                                                   class="border border-2 border-dashed border-gray-300 rounded py-2 px-3 ms-3">
                                                                    <!--begin::Svg Icon | path: icons/duotune/communication/com012.svg-->
                                                                    <span class="svg-icon svg-icon-3"> <svg
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                width="24"
                                                                                height="24" viewBox="0 0 24 24"
                                                                                fill="none">
                                                                <path
                                                                        opacity="0.3"
                                                                        d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z"
                                                                        fill="currentColor"/>
                                                                <rect
                                                                        x="6" y="12" width="7" height="2" rx="1"
                                                                        fill="currentColor"/>
                                                                <rect
                                                                        x="6" y="7" width="12" height="2" rx="1"
                                                                        fill="currentColor"/>
                                                            </svg>
													</span> <!--end::Svg Icon--> <span
                                                                            class="ms-1 fs-7 fw-bolder text-gray-600"
                                                                            data-kt-element="comments-count"><?= count($schedule['comments']) ?></span>
                                                                </a>
                                                                <!--end::Stat-->
                                                            </div>
                                                            <!--end::Stats-->
                                                        </div>
                                                        <!--end::Footer-->
                                                        <!--begin:Attachments -->
                                                        <div id="kt_schedule_<?= $schedule_id ?>_attachments_collapsible"
                                                             class="mb-3 collapse">
                                                            <h3 class="py-7">Attachments</h3>
                                                            <!--begin::Card body-->
                                                            <div id="kt_schedule_<?= $schedule_id ?>_attachments_body">
                                                                <!--begin::schedule attachments-->
                                                                <div class="scroll-y me-n5 pe-5 mh-400px h-auto"
                                                                     data-kt-element="schedule_attachments"
                                                                     data-kt-scroll="true"
                                                                     data-kt-scroll-activate="{default: false, lg: true}"
                                                                     data-kt-scroll-max-height="auto"
                                                                     data-kt-scroll-dependencies="#kt_schedule_<?= $schedule_id ?>_attachments_footer"
                                                                     data-kt-scroll-wrappers="#kt_schedule_<?= $schedule_id ?>_attachments_body"
                                                                     data-kt-scroll-offset="5px">
                                                                    <?php
                                                                    foreach ($schedule_attachments as $schedule_attachment) {
                                                                        $author_id = $schedule_attachment->post_author;
                                                                        $avatar = get_field('_avatar', 'user_' . $author_id);
                                                                        $author = get_the_author_meta('display_name', $author_id);
                                                                        if ($avatar) {
                                                                            $avatar_url = $avatar['sizes']['thumbnail'];
                                                                        } else {
                                                                            $avatar_url = get_avatar_url($author_id);
                                                                        }
                                                                        $datetime = date_i18n('d/m/Y g:i a', strtotime($schedule_attachment->post_date));
                                                                        $datetime = get_post_datetime($schedule_attachment->ID)->format('d M Y h:i A');
                                                                        ?>
                                                                        <!--begin::Attachment Template-->
                                                                        <div class="d-flex justify-content-start mb-10">
                                                                            <!--begin::Wrapper-->
                                                                            <div class="d-flex flex-column align-items-start w-100">
                                                                                <!--begin::User-->
                                                                                <div class="d-flex align-items-center mb-2">
                                                                                    <!--begin::Avatar-->
                                                                                    <div class="symbol symbol-35px symbol-circle">
                                                                                        <img alt="Pic"
                                                                                             src="<?= $avatar_url ?>"/>
                                                                                    </div>
                                                                                    <!--end::Avatar-->
                                                                                    <!--begin::Details-->
                                                                                    <div class="ms-3 d-flex flex-column">
                                                                                        <a href="javascript:void(0)"
                                                                                           class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1"><?= $author ?></a>
                                                                                        <span class="text-muted fs-7 mb-1"><?= $datetime ?></span>
                                                                                    </div>
                                                                                    <!--end::Details-->
                                                                                </div>
                                                                                <!--end::User-->
                                                                                <!--begin::Text-->
                                                                                <div class="p-5 pb-0 rounded bg-light-info w-100">
                                                                                    <!--begin::attachments-->
                                                                                    <!--begin::Overlay-->
                                                                                    <?php
                                                                                    $attach_mime_type = get_post_mime_type($schedule_attachment->ID);
                                                                                    if (in_array($attach_mime_type, PREVIEW_ALLOWED_IMG_FILE_TYPES)) {
                                                                                        ?>
                                                                                        <a class="d-block overlay mb-3 mw-200px"
                                                                                           data-fslightbox="lightbox-basic"
                                                                                           href="<?= wp_get_attachment_url($schedule_attachment->ID) ?>">
                                                                                            <!--begin::Image-->
                                                                                            <div class="d-block mw-100 overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                                                                                 style="background-image:url('<?= wp_get_attachment_url($schedule_attachment->ID) ?>')">
                                                                                            </div> <!--end::Image-->
                                                                                            <!--begin::Action-->
                                                                                            <div
                                                                                                    class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                                                                                <i class="bi bi-eye-fill text-white fs-3x"></i>
                                                                                            </div> <!--end::Action-->
                                                                                        </a>
                                                                                        <?php
                                                                                    }
                                                                                    else {
                                                                                        ?>
                                                                                        <div class="mb-3">
                                                                                            <!--begin::Svg Icon | path: icons/duotune/files/fil003.svg-->
                                                                                            <span class="svg-icon svg-icon-2x svg-icon-white me-4">
                                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                     width="24"
                                                                                                     height="24" viewBox="0 0 24 24"
                                                                                                     fill="none">
                                                                                                    <path
                                                                                                            opacity="0.3"
                                                                                                            d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z"
                                                                                                            fill="currentColor"/>
                                                                                                    <path
                                                                                                            d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z"
                                                                                                            fill="currentColor"/>
                                                                                                </svg>
                                                                                            </span>
                                                                                            <a href="<?= wp_get_attachment_url($schedule_attachment->ID) ?>"
                                                                                               download
                                                                                               class="text-dark fw-bolder"><?= basename(get_attached_file($schedule_attachment->ID)) ?></a>
                                                                                            <!--end::Svg Icon-->
                                                                                        </div>
                                                                                        <?php
                                                                                    }
                                                                                    ?>
                                                                                    <!--end::Overlay-->
                                                                                    <!--end::attachments-->
                                                                                </div>
                                                                                <!--end::Text-->
                                                                            </div>
                                                                            <!--end::Wrapper-->
                                                                        </div>
                                                                        <!--end::Attachment Template-->
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <!--end::schedule attachments-->
                                                            </div>
                                                            <!--end::Card body-->
                                                            <!--begin::Card footer-->
                                                            <div id="kt_schedule_<?= $schedule_id ?>_attachments_footer"
                                                                 data-kt-element="schedule_attachments_footer">
                                                                <!--begin:image category field-->
                                                                <div class="w-100 d-none1"
                                                                     data-kt-element="kt_schedule_attachment_category">
                                                                    <select class="form-select mb-1 cursor-pointer"
                                                                            name="type">
                                                                        <?php
                                                                        foreach (AIRENO_FILE_TYPES as $key => $name) {
                                                                            echo '<option value="' . $key . '">' . $name . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <!--end:image category field-->
                                                                <!--begin:image preview-->
                                                                <div class="w-100 mb-3"
                                                                     data-kt-element="kt_schedule_attachment_previews">
                                                                    <div class="d-none p-1 d-flex"
                                                                         data-kt-element="preview-template">
                                                                        <div
                                                                                class="position-relative flex-stack border-dotted border-1 w-100 d-flex p-2 rounded-10px">
                                                                            <div
                                                                                    class="d-flex justify-content-start align-items-center">
                                                                                <div class="d-inline-block ms-5">
                                                                                    <span class="d-block img-title">title.png</span>
                                                                                    <span
                                                                                            class="d-block img-size">234.4KB</span>
                                                                                </div>
                                                                            </div>
                                                                            <a class="ai-remove"
                                                                               href="javascript:void(0)"
                                                                               data-file-id=""> <i
                                                                                        class="bi bi-x-lg text-danger fs-2 fw-bolder"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--end:image preview-->
                                                                <!--begin:file upload button-->
                                                                <div class="w-100 mb-3 d-none"
                                                                     data-kt-element="kt_schedule_upload_button">
                                                                    <a class="btn btn-success w-100">Upload</a>
                                                                </div>
                                                                <!--end:file upload button-->
                                                                <div
                                                                        class="cursor-pointer border-dashed border-2 px-5 py-4 rounded filter-trigger">
                                                                    <!--begin::file trigger-->
                                                                    <div class="cursor-pointer text-left d-flex">
                                                                        <!--begin::Icon-->
                                                                        <!--begin::Svg Icon | path: icons/duotune/files/fil010.svg-->
                                                                        <span class="svg-icon svg-icon-3hx svg-icon-primary"> <svg
                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                    width="24"
                                                                                    height="24" viewBox="0 0 24 24"
                                                                                    fill="none">
                                                                    <path
                                                                            opacity="0.3"
                                                                            d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM14.5 12L12.7 9.3C12.3 8.9 11.7 8.9 11.3 9.3L10 12H11.5V17C11.5 17.6 11.4 18 12 18C12.6 18 12.5 17.6 12.5 17V12H14.5Z"
                                                                            fill="currentColor"></path>
                                                                    <path
                                                                            d="M13 11.5V17.9355C13 18.2742 12.6 19 12 19C11.4 19 11 18.2742 11 17.9355V11.5H13Z"
                                                                            fill="currentColor"></path>
                                                                    <path
                                                                            d="M8.2575 11.4411C7.82942 11.8015 8.08434 12.5 8.64398 12.5H15.356C15.9157 12.5 16.1706 11.8015 15.7425 11.4411L12.4375 8.65789C12.1875 8.44737 11.8125 8.44737 11.5625 8.65789L8.2575 11.4411Z"
                                                                            fill="currentColor"></path>
                                                                    <path
                                                                            d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z"
                                                                            fill="currentColor"></path>
                                                                </svg>
															</span>
                                                                        <!--end::Svg Icon-->
                                                                        <!--end::Icon-->
                                                                        <!--begin::Info-->
                                                                        <div class="ms-4 text-left">
                                                                            <h3 class="dfs-6 fs-6 fw-bolder text-gray-900 mb-1">
                                                                                Click here to choose file(s).</h3>
                                                                            <span class="fw-bold fs-7 text-muted">Choose up to 10
																	files</span>
                                                                        </div>
                                                                        <!--end::Info-->
                                                                    </div>
                                                                    <!--end::file trigger-->
                                                                </div>
                                                                <input type="file" class="d-none" data-kt-element="file"
                                                                       multiple
                                                                       accept=".xlsx, .xls, .csv, .pdf , image/*, .doc, .docx, .txt, image/heic">
                                                            </div>
                                                            <!--end::Card footer-->
                                                        </div>
                                                        <!--end:Attachments -->
                                                        <!--begin:Comment -->
                                                        <div id="kt_schedule_<?= $schedule_id ?>_comments_collapsible"
                                                             class="mb-3 collapse">
                                                            <h3 class="py-7">Comments</h3>
                                                            <!--begin::Card body-->
                                                            <div id="kt_schedule_<?= $schedule_id ?>_comments_body">
                                                                <!--begin::Messages-->
                                                                <div class="scroll-y me-n5 pe-5 mh-400px h-auto"
                                                                     data-kt-element="schedule_comments"
                                                                     data-kt-scroll="true"
                                                                     data-kt-scroll-activate="{default: false, lg: true}"
                                                                     data-kt-scroll-max-height="auto"
                                                                     data-kt-scroll-dependencies="#kt_schedule_<?= $schedule_id ?>_comments_footer"
                                                                     data-kt-scroll-wrappers="#kt_schedule_<?= $schedule_id ?>_comments_body"
                                                                     data-kt-scroll-offset="5px">
                                                                    <?php

                                                                    if (count($schedule['comments'])) {
                                                                        foreach ($schedule['comments'] as $schedule_comment) {
                                                                            $author_id = $schedule_comment['author'];
                                                                            $avatar = get_field('_avatar', 'user_' . $author_id);
                                                                            $author = get_the_author_meta('display_name', $author_id);
                                                                            if ($avatar) {
                                                                                $avatar_url = $avatar['sizes']['thumbnail'];
                                                                            } else {
                                                                                $avatar_url = get_avatar_url($author_id);
                                                                            }
                                                                            $datetime = date_i18n('d/m/Y g:i a', strtotime($schedule_comment['datetime']));
                                                                            $content = $schedule_comment['content'];
                                                                            ?>
                                                                            <!--begin::Message(template for in)-->
                                                                            <div class="d-flex justify-content-start mb-5">
                                                                                <!--begin::Wrapper-->
                                                                                <div class="d-flex flex-column align-items-start">
                                                                                    <!--begin::User-->
                                                                                    <div class="d-flex align-items-center mb-2">
                                                                                        <!--begin::Avatar-->
                                                                                        <div class="symbol symbol-35px symbol-circle">
                                                                                            <img alt="Pic"
                                                                                                 src="<?= $avatar_url ?>"/>
                                                                                        </div>
                                                                                        <!--end::Avatar-->
                                                                                        <!--begin::Details-->
                                                                                        <div class="ms-3">
                                                                                            <a href="javascript:void(0)"
                                                                                               class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1"><?= $author ?></a>
                                                                                            <span class="text-muted fs-7 mb-1"><?= $datetime ?></span>
                                                                                        </div>
                                                                                        <!--end::Details-->
                                                                                    </div>
                                                                                    <!--end::User-->
                                                                                    <!--begin::Text-->
                                                                                    <div
                                                                                            class="p-3 rounded bg-light-info mw-lg-400px text-start">
                                                                                        <span class="text-dark fw-bold mb-5"><?= $content ?></span>
                                                                                    </div>
                                                                                    <!--end::Text-->
                                                                                </div>
                                                                                <!--end::Wrapper-->
                                                                            </div>
                                                                            <!--end::Message(template for in)-->
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <!--begin::Message(template for in)-->
                                                                    <div class="d-flex justify-content-start mb-5 d-none"
                                                                         data-kt-element="schedule-comment-template">
                                                                        <!--begin::Wrapper-->
                                                                        <div class="d-flex flex-column align-items-start">
                                                                            <!--begin::User-->
                                                                            <div class="d-flex align-items-center mb-2">
                                                                                <!--begin::Avatar-->
                                                                                <div class="symbol symbol-35px symbol-circle">
                                                                                    <img alt="Pic"
                                                                                         data-kt-element="avatar"
                                                                                         src="<?= get_theme_file_uri("assets/images/300-25.jpg") ?>"/>
                                                                                </div>
                                                                                <!--end::Avatar-->
                                                                                <!--begin::Details-->
                                                                                <div class="ms-3">
                                                                                    <a href="javascript:void(0)"
                                                                                       class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1"
                                                                                       data-kt-element="author">Brian
                                                                                        Cox</a> <span
                                                                                            class="text-muted fs-7 mb-1"
                                                                                            data-kt-element="datetime">Just now</span>
                                                                                </div>
                                                                                <!--end::Details-->
                                                                            </div>
                                                                            <!--end::User-->
                                                                            <!--begin::Text-->
                                                                            <div
                                                                                    class="p-3 rounded bg-light-info mw-lg-400px text-start">
																	<span class="text-dark fw-bold mb-5"
                                                                          data-kt-element="content"></span>
                                                                            </div>
                                                                            <!--end::Text-->
                                                                        </div>
                                                                        <!--end::Wrapper-->
                                                                    </div>
                                                                    <!--end::Message(template for in)-->
                                                                </div>
                                                                <!--end::Messages-->
                                                            </div>
                                                            <!--end::Card body-->
                                                            <!--begin::Card footer-->
                                                            <div id="kt_schedule_<?= $schedule_id ?>_comments_footer">
                                                                <!--begin::Input-->
                                                                <textarea class="form-control mb-3" rows="3"
                                                                          data-kt-element="input"
                                                                          placeholder="Type a comment"></textarea>
                                                                <!--end::Input-->
                                                                <!--begin:Toolbar-->
                                                                <div class="d-flex flex-stack">
                                                                    <!--begin::Send-->
                                                                    <button class="btn btn-primary" type="button"
                                                                            data-kt-element="send">Send
                                                                    </button>
                                                                    <!--end::Send-->
                                                                </div>
                                                                <!--end::Toolbar-->
                                                            </div>
                                                            <!--end::Card footer-->
                                                        </div>
                                                        <!--end:Comment -->
                                                    </div>
                                                    <!--end::Card body-->
                                                </div>
                                                <!--end::Card-->
                                                <?php
                                            }
                                        }
                                        ?>
                                        <!--end::Card-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-4">
                                        <!--begin::Col header-->
                                        <div class="mb-9">
                                            <div class="d-flex flex-stack">
                                                <div class="fw-bolder fs-4">
                                                    In Progress <span
                                                            class="fs-6 text-gray-400 ms-2"
                                                            data-kt-element="schedules-count"><?= (array_key_exists(1, $schedules)) ? count($schedules[1]) : 0 ?></span>
                                                </div>
                                            </div>
                                            <div class="h-3px w-100 bg-primary"></div>
                                        </div>
                                        <!--end::Col header-->
                                        <!--begin::Card-->
                                        <?php
                                        if (array_key_exists(1, $schedules)) {
                                            foreach ($schedules[1] as $schedule_id => $schedule) {
                                                $schedule_attachments = get_posts(array(
                                                    'post_type' => 'attachment',
                                                    'posts_per_page' => -1,
                                                    'post_parent' => $schedule_id,
                                                    'post_status' => array(
                                                        'inherit'
                                                    ),
                                                    'orderby' => 'ID',
                                                    'order' => 'ASC'
                                                ));
                                                wp_reset_postdata();
                                                ?>
                                                <!--begin::Card-->
                                                <div class="card mb-6 mb-xl-9" data-kt-element="schedule"
                                                     data-schedule-id="<?= $schedule_id ?>">
                                                    <!--begin::Card body-->
                                                    <div class="card-body">
                                                        <!--begin::Header-->
                                                        <div class="d-flex flex-stack mb-3">
												<span class="badge badge-success fs-8 fw-bold"> <span
                                                            data-kt-element="duration"><?= $schedule['duration'] ?></span>&nbsp;Days
												</span>
                                                            <!--begin::Menu-->
                                                            <div>
                                                                <button type="button"
                                                                        class="btn btn-sm btn-icon btn-color-light-dark btn-active-light-primary"
                                                                        data-kt-menu-trigger="click"
                                                                        data-kt-menu-placement="bottom-end">
                                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                                                    <span class="svg-icon svg-icon-2"> <svg
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                width="24px"
                                                                                height="24px" viewBox="0 0 24 24">
                                                                <g
                                                                        stroke="none" stroke-width="1" fill="none"
                                                                        fill-rule="evenodd">
                                                                    <rect
                                                                            x="5" y="5" width="5" height="5" rx="1"
                                                                            fill="currentColor"/>
                                                                    <rect
                                                                            x="14" y="5" width="5" height="5" rx="1"
                                                                            fill="currentColor" opacity="0.3"/>
                                                                    <rect
                                                                            x="5" y="14" width="5" height="5" rx="1"
                                                                            fill="currentColor" opacity="0.3"/>
                                                                    <rect
                                                                            x="14" y="14" width="5" height="5" rx="1"
                                                                            fill="currentColor" opacity="0.3"/>
                                                                </g>
                                                            </svg>
														</span>
                                                                    <!--end::Svg Icon-->
                                                                </button>
                                                                <!--begin::Menu 1-->
                                                                <div
                                                                        class="menu menu-sub menu-sub-dropdown w-250px w-md-300px pb-7"
                                                                        data-kt-menu="true"
                                                                        id="kt_schedule_menu_<?= $schedule_id ?>">
                                                                    <!--begin::Header-->
                                                                    <div class="px-7 py-5">
                                                                        <div class="fs-5 text-grey">Settings</div>
                                                                    </div>
                                                                    <div class="px-7 py-2">
                                                                        <select class="form-select form-select-solid text-dark"
                                                                                data-kt-element="status">
                                                                            <option value="0">Yet to start</option>
                                                                            <option value="1" selected>In Process
                                                                            </option>
                                                                            <option value="2">Complete</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="px-7 py-2">
                                                                        <a class="w-100 d-block py-3 fs-5 text-dark fw-bolder"
                                                                           data-kt-element="edit"
                                                                           href="javascript:void(0)">Edit</a>
                                                                    </div>
                                                                    <div class="px-7 py-2">
                                                                        <a class="w-100 d-block py-3 fs-5 text-dark fw-bolder"
                                                                           data-kt-element="delete"
                                                                           href="javascript:void(0)">Delete</a>
                                                                    </div>
                                                                    <!--end::Header-->
                                                                </div>
                                                                <!--end::Menu 1-->
                                                            </div>
                                                            <!--end::Menu-->
                                                        </div>
                                                        <!--end::Header-->
                                                        <div class="d-flex mb-3">
                                                            <!--begin::Title-->
                                                            <a href="javascript:void(0)"
                                                               class="fs-4 fw-bolder mb-1 text-gray-900 text-hover-primary"
                                                               data-kt-element="title"><?= $schedule['title'] ?></a>
                                                            <!--end::Title-->
                                                        </div>
                                                        <!--begin::Content-->
                                                        <div class="fs-6 fw-bold text-gray-600 mb-5"
                                                             data-kt-element="content">
                                                            <?= $schedule['content'] ?></div>
                                                        <!--end::Content-->
                                                        <!--begin:Tasks-->
                                                        <div class="d-flex flex-column mb-3" data-kt-element="tasks">
                                                            <?php
                                                            foreach ($schedule['tasks'] as $task_index => $task) {
                                                                ?>
                                                                <label
                                                                        class="d-flex flex-row mb-3 cursor-pointer"
                                                                        data-kt-element="task">
                                                                    <div class="form-check form-check-custom form-check-solid">
                                                                        <input class="form-check-input" type="checkbox"
                                                                               value="<?= $task_index ?>"
                                                                            <?= ($task['done']) ? 'disabled checked' : '' ?>
                                                                               data-kt-element="task-completed">
                                                                    </div>
                                                                    <div class="ms-3 text-dark"
                                                                         data-kt-element="task-title"><?= $task['title'] ?></div>
                                                                </label>
                                                                <?php
                                                            }
                                                            ?>
                                                            <label
                                                                    class="d-flex flex-row mb-3 cursor-pointer d-none"
                                                                    data-kt-element="task-template">
                                                                <div class="form-check form-check-custom form-check-solid">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           value="" data-kt-element="task-completed">
                                                                </div>
                                                                <div class="ms-3 text-dark"
                                                                     data-kt-element="task-title"></div>
                                                            </label>
                                                        </div>
                                                        <!--end:Tasks-->
                                                        <!--begin::Footer-->
                                                        <div class="d-flex flex-stack flex-wrap mb-3">
                                                            <!--begin::Stats-->
                                                            <div class="d-flex my-1">
                                                                <!--begin::Stat-->
                                                                <a data-bs-toggle="collapse"
                                                                   data-bs-target="#kt_schedule_<?= $schedule_id ?>_attachments_collapsible"
                                                                   href="javascript:void(0)"
                                                                   class="border border-2 border-dashed border-gray-300 rounded py-2 px-3">
                                                                    <!--begin::Svg Icon | path: icons/duotune/communication/com008.svg-->
                                                                    <span class="svg-icon svg-icon-3"> <svg
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                width="24"
                                                                                height="24" viewBox="0 0 24 24"
                                                                                fill="none">
                                                                <path
                                                                        opacity="0.3"
                                                                        d="M4.425 20.525C2.525 18.625 2.525 15.525 4.425 13.525L14.825 3.125C16.325 1.625 18.825 1.625 20.425 3.125C20.825 3.525 20.825 4.12502 20.425 4.52502C20.025 4.92502 19.425 4.92502 19.025 4.52502C18.225 3.72502 17.025 3.72502 16.225 4.52502L5.82499 14.925C4.62499 16.125 4.62499 17.925 5.82499 19.125C7.02499 20.325 8.82501 20.325 10.025 19.125L18.425 10.725C18.825 10.325 19.425 10.325 19.825 10.725C20.225 11.125 20.225 11.725 19.825 12.125L11.425 20.525C9.525 22.425 6.425 22.425 4.425 20.525Z"
                                                                        fill="currentColor"/>
                                                                <path
                                                                        d="M9.32499 15.625C8.12499 14.425 8.12499 12.625 9.32499 11.425L14.225 6.52498C14.625 6.12498 15.225 6.12498 15.625 6.52498C16.025 6.92498 16.025 7.525 15.625 7.925L10.725 12.8249C10.325 13.2249 10.325 13.8249 10.725 14.2249C11.125 14.6249 11.725 14.6249 12.125 14.2249L19.125 7.22493C19.525 6.82493 19.725 6.425 19.725 5.925C19.725 5.325 19.525 4.825 19.125 4.425C18.725 4.025 18.725 3.42498 19.125 3.02498C19.525 2.62498 20.125 2.62498 20.525 3.02498C21.325 3.82498 21.725 4.825 21.725 5.925C21.725 6.925 21.325 7.82498 20.525 8.52498L13.525 15.525C12.325 16.725 10.525 16.725 9.32499 15.625Z"
                                                                        fill="currentColor"/>
                                                            </svg>
													</span> <!--end::Svg Icon--> <span
                                                                            class="ms-1 fs-7 fw-bolder text-gray-600"
                                                                            data-kt-element="attachments-count"><?= count($schedule_attachments) ?></span>
                                                                </a>
                                                                <!--end::Stat-->
                                                                <!--begin::Stat-->
                                                                <a data-bs-toggle="collapse"
                                                                   data-bs-target="#kt_schedule_<?= $schedule_id ?>_comments_collapsible"
                                                                   href="javascript:void(0)"
                                                                   class="border border-2 border-dashed border-gray-300 rounded py-2 px-3 ms-3">
                                                                    <!--begin::Svg Icon | path: icons/duotune/communication/com012.svg-->
                                                                    <span class="svg-icon svg-icon-3"> <svg
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                width="24"
                                                                                height="24" viewBox="0 0 24 24"
                                                                                fill="none">
                                                                <path
                                                                        opacity="0.3"
                                                                        d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z"
                                                                        fill="currentColor"/>
                                                                <rect
                                                                        x="6" y="12" width="7" height="2" rx="1"
                                                                        fill="currentColor"/>
                                                                <rect
                                                                        x="6" y="7" width="12" height="2" rx="1"
                                                                        fill="currentColor"/>
                                                            </svg>
													</span> <!--end::Svg Icon--> <span
                                                                            class="ms-1 fs-7 fw-bolder text-gray-600"
                                                                            data-kt-element="comments-count"><?= count($schedule['comments']) ?></span>
                                                                </a>
                                                                <!--end::Stat-->
                                                            </div>
                                                            <!--end::Stats-->
                                                        </div>
                                                        <!--end::Footer-->
                                                        <!--begin:Attachments -->
                                                        <div
                                                                id="kt_schedule_<?= $schedule_id ?>_attachments_collapsible"
                                                                class="mb-3 collapse">
                                                            <h3 class="py-7">Attachments</h3>
                                                            <!--begin::Card body-->
                                                            <div id="kt_schedule_<?= $schedule_id ?>_attachments_body">
                                                                <!--begin::schedule attachments-->
                                                                <div class="scroll-y me-n5 pe-5 mh-400px h-auto"
                                                                     data-kt-element="schedule_attachments"
                                                                     data-kt-scroll="true"
                                                                     data-kt-scroll-activate="{default: false, lg: true}"
                                                                     data-kt-scroll-max-height="auto"
                                                                     data-kt-scroll-dependencies="#kt_schedule_<?= $schedule_id ?>_attachments_footer"
                                                                     data-kt-scroll-wrappers="#kt_schedule_<?= $schedule_id ?>_attachments_body"
                                                                     data-kt-scroll-offset="5px">
                                                                    <?php
                                                                    foreach ($schedule_attachments as $schedule_attachment) {
                                                                        $author_id = $schedule_attachment->post_author;
                                                                        $avatar = get_field('_avatar', 'user_' . $author_id);
                                                                        $author = get_the_author_meta('display_name', $author_id);
                                                                        if ($avatar) {
                                                                            $avatar_url = $avatar['sizes']['thumbnail'];
                                                                        } else {
                                                                            $avatar_url = get_avatar_url($author_id);
                                                                        }
                                                                        $datetime = date_i18n('d/m/Y g:i a', strtotime($schedule_attachment->post_date));
                                                                        $datetime = get_post_datetime($schedule_attachment->ID)->format('d M Y h:i A');
                                                                        ?>
                                                                        <!--begin::Attachment Template-->
                                                                        <div class="d-flex justify-content-start mb-10">
                                                                            <!--begin::Wrapper-->
                                                                            <div class="d-flex flex-column align-items-start w-100">
                                                                                <!--begin::User-->
                                                                                <div class="d-flex align-items-center mb-2">
                                                                                    <!--begin::Avatar-->
                                                                                    <div class="symbol symbol-35px symbol-circle">
                                                                                        <img alt="Pic"
                                                                                             src="<?= $avatar_url ?>"/>
                                                                                    </div>
                                                                                    <!--end::Avatar-->
                                                                                    <!--begin::Details-->
                                                                                    <div class="ms-3 d-flex flex-column">
                                                                                        <a href="javascript:void(0)"
                                                                                           class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1"><?= $author ?></a>
                                                                                        <span class="text-muted fs-7 mb-1"><?= $datetime ?></span>
                                                                                    </div>
                                                                                    <!--end::Details-->
                                                                                </div>
                                                                                <!--end::User-->
                                                                                <!--begin::Text-->
                                                                                <div class="p-5 pb-0 rounded bg-light-info w-100">
                                                                                    <!--begin::attachments-->
                                                                                    <!--begin::Overlay-->
                                                                                    <?php
                                                                                    $attach_mime_type = get_post_mime_type($schedule_attachment->ID);
                                                                                    if (in_array($attach_mime_type, PREVIEW_ALLOWED_IMG_FILE_TYPES)) {
                                                                                        ?>
                                                                                        <a class="d-block overlay mb-3 mw-200px"
                                                                                           data-fslightbox="lightbox-basic"
                                                                                           href="<?= wp_get_attachment_url($schedule_attachment->ID) ?>">
                                                                                            <!--begin::Image-->
                                                                                            <div class="d-block mw-100 overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                                                                                 style="background-image:url('<?= wp_get_attachment_url($schedule_attachment->ID) ?>')">
                                                                                            </div> <!--end::Image-->
                                                                                            <!--begin::Action-->
                                                                                            <div
                                                                                                    class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                                                                                <i class="bi bi-eye-fill text-white fs-3x"></i>
                                                                                            </div> <!--end::Action-->
                                                                                        </a>
                                                                                        <?php
                                                                                    }
                                                                                    else {
                                                                                        ?>
                                                                                        <div class="mb-3">
                                                                                            <!--begin::Svg Icon | path: icons/duotune/files/fil003.svg-->
                                                                                            <span class="svg-icon svg-icon-2x svg-icon-white me-4">
                                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                     width="24"
                                                                                                     height="24" viewBox="0 0 24 24"
                                                                                                     fill="none">
                                                                                                    <path
                                                                                                            opacity="0.3"
                                                                                                            d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z"
                                                                                                            fill="currentColor"/>
                                                                                                    <path
                                                                                                            d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z"
                                                                                                            fill="currentColor"/>
                                                                                                </svg>
                                                                                            </span>
                                                                                            <a href="<?= wp_get_attachment_url($schedule_attachment->ID) ?>"
                                                                                               download
                                                                                               class="text-dark fw-bolder"><?= basename(get_attached_file($schedule_attachment->ID)) ?></a>
                                                                                            <!--end::Svg Icon-->
                                                                                        </div>
                                                                                        <?php
                                                                                    }
                                                                                    ?>
                                                                                    <!--end::Overlay-->
                                                                                    <!--end::attachments-->
                                                                                </div>
                                                                                <!--end::Text-->
                                                                            </div>
                                                                            <!--end::Wrapper-->
                                                                        </div>
                                                                        <!--end::Attachment Template-->
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <!--end::schedule attachments-->
                                                            </div>
                                                            <!--end::Card body-->
                                                            <!--begin::Card footer-->
                                                            <div id="kt_schedule_<?= $schedule_id ?>_attachments_footer"
                                                                 data-kt-element="schedule_attachments_footer">
                                                                <!--begin:image category field-->
                                                                <div class="w-100 d-none1"
                                                                     data-kt-element="kt_schedule_attachment_category">
                                                                    <select class="form-select mb-1 cursor-pointer"
                                                                            name="type">
                                                                        <?php
                                                                        foreach (AIRENO_FILE_TYPES as $key => $name) {
                                                                            echo '<option value="' . $key . '">' . $name . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <!--end:image category field-->
                                                                <!--begin:image preview-->
                                                                <div class="w-100 mb-3"
                                                                     data-kt-element="kt_schedule_attachment_previews">
                                                                    <div class="d-none p-1 d-flex"
                                                                         data-kt-element="preview-template">
                                                                        <div
                                                                                class="position-relative flex-stack border-dotted border-1 w-100 d-flex p-2 rounded-10px">
                                                                            <div
                                                                                    class="d-flex justify-content-start align-items-center">
                                                                                <div class="d-inline-block ms-5">
                                                                                    <span class="d-block img-title">title.png</span>
                                                                                    <span
                                                                                            class="d-block img-size">234.4KB</span>
                                                                                </div>
                                                                            </div>
                                                                            <a class="ai-remove"
                                                                               href="javascript:void(0)"
                                                                               data-file-id=""> <i
                                                                                        class="bi bi-x-lg text-danger fs-2 fw-bolder"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--end:image preview-->
                                                                <!--begin:file upload button-->
                                                                <div class="w-100 mb-3 d-none"
                                                                     data-kt-element="kt_schedule_upload_button">
                                                                    <a class="btn btn-success w-100">Upload</a>
                                                                </div>
                                                                <!--end:file upload button-->
                                                                <div
                                                                        class="cursor-pointer border-dashed border-2 px-5 py-4 rounded filter-trigger">
                                                                    <!--begin::file trigger-->
                                                                    <div class="cursor-pointer text-left d-flex">
                                                                        <!--begin::Icon-->
                                                                        <!--begin::Svg Icon | path: icons/duotune/files/fil010.svg-->
                                                                        <span class="svg-icon svg-icon-3hx svg-icon-primary"> <svg
                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                    width="24"
                                                                                    height="24" viewBox="0 0 24 24"
                                                                                    fill="none">
                                                                    <path
                                                                            opacity="0.3"
                                                                            d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM14.5 12L12.7 9.3C12.3 8.9 11.7 8.9 11.3 9.3L10 12H11.5V17C11.5 17.6 11.4 18 12 18C12.6 18 12.5 17.6 12.5 17V12H14.5Z"
                                                                            fill="currentColor"></path>
                                                                    <path
                                                                            d="M13 11.5V17.9355C13 18.2742 12.6 19 12 19C11.4 19 11 18.2742 11 17.9355V11.5H13Z"
                                                                            fill="currentColor"></path>
                                                                    <path
                                                                            d="M8.2575 11.4411C7.82942 11.8015 8.08434 12.5 8.64398 12.5H15.356C15.9157 12.5 16.1706 11.8015 15.7425 11.4411L12.4375 8.65789C12.1875 8.44737 11.8125 8.44737 11.5625 8.65789L8.2575 11.4411Z"
                                                                            fill="currentColor"></path>
                                                                    <path
                                                                            d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z"
                                                                            fill="currentColor"></path>
                                                                </svg>
															</span>
                                                                        <!--end::Svg Icon-->
                                                                        <!--end::Icon-->
                                                                        <!--begin::Info-->
                                                                        <div class="ms-4 text-left">
                                                                            <h3 class="dfs-6 fs-6 fw-bolder text-gray-900 mb-1">
                                                                                Click here to choose file(s).</h3>
                                                                            <span class="fw-bold fs-7 text-muted">Choose up to 10
																	files</span>
                                                                        </div>
                                                                        <!--end::Info-->
                                                                    </div>
                                                                    <!--end::file trigger-->
                                                                </div>
                                                                <input type="file" class="d-none" data-kt-element="file"
                                                                       multiple
                                                                       accept=".xlsx, .xls, .csv, .pdf , image/*, .doc, .docx, .txt, image/heic">
                                                            </div>
                                                            <!--end::Card footer-->
                                                        </div>
                                                        <!--end:Attachments -->
                                                        <!--begin:Comment -->
                                                        <div
                                                                id="kt_schedule_<?= $schedule_id ?>_comments_collapsible"
                                                                class="mb-3 collapse">
                                                            <h3 class="py-7">Comments</h3>
                                                            <!--begin::Card body-->
                                                            <div id="kt_schedule_<?= $schedule_id ?>_comments_body">
                                                                <!--begin::Messages-->
                                                                <div class="scroll-y me-n5 pe-5 mh-400px h-auto"
                                                                     data-kt-element="schedule_comments"
                                                                     data-kt-scroll="true"
                                                                     data-kt-scroll-activate="{default: false, lg: true}"
                                                                     data-kt-scroll-max-height="auto"
                                                                     data-kt-scroll-dependencies="#kt_schedule_<?= $schedule_id ?>_comments_footer"
                                                                     data-kt-scroll-wrappers="#kt_schedule_<?= $schedule_id ?>_comments_body"
                                                                     data-kt-scroll-offset="5px">
                                                                    <?php
                                                                    if (count($schedule['comments'])) {
                                                                        foreach ($schedule['comments'] as $schedule_comment) {
                                                                            $author_id = $schedule_comment['author'];
                                                                            $avatar = get_field('_avatar', 'user_' . $author_id);
                                                                            $author = get_the_author_meta('display_name', $author_id);
                                                                            if ($avatar) {
                                                                                $avatar_url = $avatar['sizes']['thumbnail'];
                                                                            } else {
                                                                                $avatar_url = get_avatar_url($author_id);
                                                                            }
                                                                            $datetime = date_i18n('d/m/Y g:i a', strtotime($schedule_comment['datetime']));
                                                                            $content = $schedule_comment['content'];
                                                                            ?>
                                                                            <!--begin::Message(template for in)-->
                                                                            <div class="d-flex justify-content-start mb-5">
                                                                                <!--begin::Wrapper-->
                                                                                <div class="d-flex flex-column align-items-start">
                                                                                    <!--begin::User-->
                                                                                    <div class="d-flex align-items-center mb-2">
                                                                                        <!--begin::Avatar-->
                                                                                        <div class="symbol symbol-35px symbol-circle">
                                                                                            <img alt="Pic"
                                                                                                 src="<?= $avatar_url ?>"/>
                                                                                        </div>
                                                                                        <!--end::Avatar-->
                                                                                        <!--begin::Details-->
                                                                                        <div class="ms-3">
                                                                                            <a href="javascript:void(0)"
                                                                                               class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1"><?= $author ?></a>
                                                                                            <span class="text-muted fs-7 mb-1"><?= $datetime ?></span>
                                                                                        </div>
                                                                                        <!--end::Details-->
                                                                                    </div>
                                                                                    <!--end::User-->
                                                                                    <!--begin::Text-->
                                                                                    <div
                                                                                            class="p-3 rounded bg-light-info mw-lg-400px text-start">
                                                                                        <span class="text-dark fw-bold mb-5"><?= $content ?></span>
                                                                                    </div>
                                                                                    <!--end::Text-->
                                                                                </div>
                                                                                <!--end::Wrapper-->
                                                                            </div>
                                                                            <!--end::Message(template for in)-->
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <!--begin::Message(template for in)-->
                                                                    <div class="d-flex justify-content-start mb-5 d-none"
                                                                         data-kt-element="schedule-comment-template">
                                                                        <!--begin::Wrapper-->
                                                                        <div class="d-flex flex-column align-items-start">
                                                                            <!--begin::User-->
                                                                            <div class="d-flex align-items-center mb-2">
                                                                                <!--begin::Avatar-->
                                                                                <div class="symbol symbol-35px symbol-circle">
                                                                                    <img alt="Pic"
                                                                                         data-kt-element="avatar"
                                                                                         src="<?= get_theme_file_uri("assets/images/300-25.jpg") ?>"/>
                                                                                </div>
                                                                                <!--end::Avatar-->
                                                                                <!--begin::Details-->
                                                                                <div class="ms-3">
                                                                                    <a href="javascript:void(0)"
                                                                                       class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1"
                                                                                       data-kt-element="author">Brian
                                                                                        Cox</a> <span
                                                                                            class="text-muted fs-7 mb-1"
                                                                                            data-kt-element="datetime">Just now</span>
                                                                                </div>
                                                                                <!--end::Details-->
                                                                            </div>
                                                                            <!--end::User-->
                                                                            <!--begin::Text-->
                                                                            <div
                                                                                    class="p-3 rounded bg-light-info mw-lg-400px text-start">
																	<span class="text-dark fw-bold mb-5"
                                                                          data-kt-element="content"></span>
                                                                            </div>
                                                                            <!--end::Text-->
                                                                        </div>
                                                                        <!--end::Wrapper-->
                                                                    </div>
                                                                    <!--end::Message(template for in)-->
                                                                </div>
                                                                <!--end::Messages-->
                                                            </div>
                                                            <!--end::Card body-->
                                                            <!--begin::Card footer-->
                                                            <div id="kt_schedule_<?= $schedule_id ?>_comments_footer">
                                                                <!--begin::Input-->
                                                                <textarea class="form-control mb-3" rows="3"
                                                                          data-kt-element="input"
                                                                          placeholder="Type a comment"></textarea>
                                                                <!--end::Input-->
                                                                <!--begin:Toolbar-->
                                                                <div class="d-flex flex-stack">
                                                                    <!--begin::Send-->
                                                                    <button class="btn btn-primary" type="button"
                                                                            data-kt-element="send">Send
                                                                    </button>
                                                                    <!--end::Send-->
                                                                </div>
                                                                <!--end::Toolbar-->
                                                            </div>
                                                            <!--end::Card footer-->
                                                        </div>
                                                        <!--end:Comment -->
                                                    </div>
                                                    <!--end::Card body-->
                                                </div>
                                                <!--end::Card-->
                                                <?php
                                            }
                                        }
                                        ?>
                                        <!--end::Card-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-4">
                                        <!--begin::Col header-->
                                        <div class="mb-9">
                                            <div class="d-flex flex-stack">
                                                <div class="fw-bolder fs-4">
                                                    Completed
                                                    <span class="fs-6 text-gray-400 ms-2"
                                                          data-kt-element="schedules-count"><?= (array_key_exists(2, $schedules)) ? count($schedules[2]) : 0 ?></span>
                                                </div>
                                            </div>
                                            <div class="h-3px w-100 bg-success"></div>
                                        </div>
                                        <!--end::Col header-->
                                        <!--begin::Card-->
                                        <?php
                                        if (array_key_exists(2, $schedules)) {
                                            foreach ($schedules[2] as $schedule_id => $schedule) {
                                                $schedule_attachments = get_posts(array(
                                                    'post_type' => 'attachment',
                                                    'posts_per_page' => -1,
                                                    'post_parent' => $schedule_id,
                                                    'post_status' => array(
                                                        'inherit'
                                                    ),
                                                    'orderby' => 'ID',
                                                    'order' => 'ASC'
                                                ));
                                                wp_reset_postdata();
                                                ?>
                                                <!--begin::Card-->
                                                <div class="card mb-6 mb-xl-9" data-kt-element="schedule"
                                                     data-schedule-id="<?= $schedule_id ?>">
                                                    <!--begin::Card body-->
                                                    <div class="card-body">
                                                        <!--begin::Header-->
                                                        <div class="d-flex flex-stack mb-3">
												<span class="badge badge-success fs-8 fw-bold"><span
                                                            data-kt-element="duration"><?= $schedule['duration'] ?></span>&nbsp;Days</span>
                                                            <!--begin::Menu-->
                                                            <div>
                                                                <button type="button"
                                                                        class="btn btn-sm btn-icon btn-color-light-dark btn-active-light-primary"
                                                                        data-kt-menu-trigger="click"
                                                                        data-kt-menu-placement="bottom-end">
                                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                                                    <span class="svg-icon svg-icon-2"> <svg
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                width="24px"
                                                                                height="24px" viewBox="0 0 24 24">
                                                                <g
                                                                        stroke="none" stroke-width="1" fill="none"
                                                                        fill-rule="evenodd">
                                                                    <rect
                                                                            x="5" y="5" width="5" height="5" rx="1"
                                                                            fill="currentColor"/>
                                                                    <rect
                                                                            x="14" y="5" width="5" height="5" rx="1"
                                                                            fill="currentColor" opacity="0.3"/>
                                                                    <rect
                                                                            x="5" y="14" width="5" height="5" rx="1"
                                                                            fill="currentColor" opacity="0.3"/>
                                                                    <rect
                                                                            x="14" y="14" width="5" height="5" rx="1"
                                                                            fill="currentColor" opacity="0.3"/>
                                                                </g>
                                                            </svg>
														</span>
                                                                    <!--end::Svg Icon-->
                                                                </button>
                                                                <!--begin::Menu 1-->
                                                                <div
                                                                        class="menu menu-sub menu-sub-dropdown w-250px w-md-300px pb-7"
                                                                        data-kt-menu="true"
                                                                        id="kt_schedule_menu_<?= $schedule_id ?>">
                                                                    <!--begin::Header-->
                                                                    <div class="px-7 py-5">
                                                                        <div class="fs-5 text-grey">Settings</div>
                                                                    </div>
                                                                    <div class="px-7 py-2">
                                                                        <select class="form-select form-select-solid text-dark"
                                                                                data-kt-element="status">
                                                                            <option value="0">Yet to start</option>
                                                                            <option value="1">In Process</option>
                                                                            <option value="2" selected>Complete</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="px-7 py-2">
                                                                        <a class="w-100 d-block py-3 fs-5 text-dark fw-bolder"
                                                                           data-kt-element="edit"
                                                                           href="javascript:void(0)">Edit</a>
                                                                    </div>
                                                                    <div class="px-7 py-2">
                                                                        <a class="w-100 d-block py-3 fs-5 text-dark fw-bolder"
                                                                           data-kt-element="delete"
                                                                           href="javascript:void(0)">Delete</a>
                                                                    </div>
                                                                    <!--end::Header-->
                                                                </div>
                                                                <!--end::Menu 1-->
                                                            </div>
                                                            <!--end::Menu-->
                                                        </div>
                                                        <!--end::Header-->
                                                        <div class="d-flex mb-3">
                                                            <!--begin::Title-->
                                                            <a href="javascript:void(0)"
                                                               class="fs-4 fw-bolder mb-1 text-gray-900 text-hover-primary"
                                                               data-kt-element="title"><?= $schedule['title'] ?></a>
                                                            <!--end::Title-->
                                                        </div>
                                                        <!--begin::Content-->
                                                        <div class="fs-6 fw-bold text-gray-600 mb-5"
                                                             data-kt-element="content">
                                                            <?= $schedule['content'] ?></div>
                                                        <!--end::Content-->
                                                        <!--begin:Tasks-->
                                                        <div class="d-flex flex-column mb-3" data-kt-element="tasks">
                                                            <?php
                                                            foreach ($schedule['tasks'] as $task_index => $task) {
                                                                ?>
                                                                <label
                                                                        class="d-flex flex-row mb-3 cursor-pointer"
                                                                        data-kt-element="task">
                                                                    <div class="form-check form-check-custom form-check-solid">
                                                                        <input class="form-check-input" type="checkbox"
                                                                               value="<?= $task_index ?>"
                                                                            <?= ($task['done']) ? 'disabled checked' : '' ?>
                                                                               data-kt-element="task-completed">
                                                                    </div>
                                                                    <div class="ms-3 text-dark"
                                                                         data-kt-element="task-title"><?= $task['title'] ?></div>
                                                                </label>
                                                                <?php
                                                            }
                                                            ?>
                                                            <label
                                                                    class="d-flex flex-row mb-3 cursor-pointer d-none"
                                                                    data-kt-element="task-template">
                                                                <div class="form-check form-check-custom form-check-solid">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           value="" data-kt-element="task-completed">
                                                                </div>
                                                                <div class="ms-3 text-dark"
                                                                     data-kt-element="task-title"></div>
                                                            </label>
                                                        </div>
                                                        <!--end:Tasks-->
                                                        <!--begin::Footer-->
                                                        <div class="d-flex flex-stack flex-wrap mb-3">
                                                            <!--begin::Stats-->
                                                            <div class="d-flex my-1">
                                                                <!--begin::Stat-->
                                                                <a data-bs-toggle="collapse"
                                                                   data-bs-target="#kt_schedule_<?= $schedule_id ?>_attachments_collapsible"
                                                                   href="javascript:void(0)"
                                                                   class="border border-2 border-dashed border-gray-300 rounded py-2 px-3">
                                                                    <!--begin::Svg Icon | path: icons/duotune/communication/com008.svg-->
                                                                    <span class="svg-icon svg-icon-3"> <svg
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                width="24"
                                                                                height="24" viewBox="0 0 24 24"
                                                                                fill="none">
                                                                                <path
                                                                                        opacity="0.3"
                                                                                        d="M4.425 20.525C2.525 18.625 2.525 15.525 4.425 13.525L14.825 3.125C16.325 1.625 18.825 1.625 20.425 3.125C20.825 3.525 20.825 4.12502 20.425 4.52502C20.025 4.92502 19.425 4.92502 19.025 4.52502C18.225 3.72502 17.025 3.72502 16.225 4.52502L5.82499 14.925C4.62499 16.125 4.62499 17.925 5.82499 19.125C7.02499 20.325 8.82501 20.325 10.025 19.125L18.425 10.725C18.825 10.325 19.425 10.325 19.825 10.725C20.225 11.125 20.225 11.725 19.825 12.125L11.425 20.525C9.525 22.425 6.425 22.425 4.425 20.525Z"
                                                                                        fill="currentColor"/>
                                                                                <path
                                                                                        d="M9.32499 15.625C8.12499 14.425 8.12499 12.625 9.32499 11.425L14.225 6.52498C14.625 6.12498 15.225 6.12498 15.625 6.52498C16.025 6.92498 16.025 7.525 15.625 7.925L10.725 12.8249C10.325 13.2249 10.325 13.8249 10.725 14.2249C11.125 14.6249 11.725 14.6249 12.125 14.2249L19.125 7.22493C19.525 6.82493 19.725 6.425 19.725 5.925C19.725 5.325 19.525 4.825 19.125 4.425C18.725 4.025 18.725 3.42498 19.125 3.02498C19.525 2.62498 20.125 2.62498 20.525 3.02498C21.325 3.82498 21.725 4.825 21.725 5.925C21.725 6.925 21.325 7.82498 20.525 8.52498L13.525 15.525C12.325 16.725 10.525 16.725 9.32499 15.625Z"
                                                                                        fill="currentColor"/>
                                                                            </svg>
                                                                    </span> <!--end::Svg Icon-->
                                                                    <span
                                                                            class="ms-1 fs-7 fw-bolder text-gray-600"
                                                                            data-kt-element="attachments-count"><?= count($schedule_attachments) ?></span>
                                                                </a>
                                                                <!--end::Stat-->
                                                                <!--begin::Stat-->
                                                                <a data-bs-toggle="collapse"
                                                                   data-bs-target="#kt_schedule_<?= $schedule_id ?>_comments_collapsible"
                                                                   href="javascript:void(0)"
                                                                   class="border border-2 border-dashed border-gray-300 rounded py-2 px-3 ms-3">
                                                                    <!--begin::Svg Icon | path: icons/duotune/communication/com012.svg-->
                                                                    <span class="svg-icon svg-icon-3"> <svg
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                width="24"
                                                                                height="24" viewBox="0 0 24 24"
                                                                                fill="none">
                                                                <path
                                                                        opacity="0.3"
                                                                        d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z"
                                                                        fill="currentColor"/>
                                                                <rect
                                                                        x="6" y="12" width="7" height="2" rx="1"
                                                                        fill="currentColor"/>
                                                                <rect
                                                                        x="6" y="7" width="12" height="2" rx="1"
                                                                        fill="currentColor"/>
                                                            </svg>
													</span> <!--end::Svg Icon--> <span
                                                                            class="ms-1 fs-7 fw-bolder text-gray-600"
                                                                            data-kt-element="comments-count"><?= count($schedule['comments']) ?></span>
                                                                </a>
                                                                <!--end::Stat-->
                                                            </div>
                                                            <!--end::Stats-->
                                                        </div>
                                                        <!--end::Footer-->
                                                        <!--begin:Attachments -->
                                                        <div
                                                                id="kt_schedule_<?= $schedule_id ?>_attachments_collapsible"
                                                                class="mb-3 collapse">
                                                            <h3 class="py-7">Attachments</h3>
                                                            <!--begin::Card body-->
                                                            <div id="kt_schedule_<?= $schedule_id ?>_attachments_body">
                                                                <!--begin::schedule attachments-->
                                                                <div class="scroll-y me-n5 pe-5 mh-400px h-auto"
                                                                     data-kt-element="schedule_attachments"
                                                                     data-kt-scroll="true"
                                                                     data-kt-scroll-activate="{default: false, lg: true}"
                                                                     data-kt-scroll-max-height="auto"
                                                                     data-kt-scroll-dependencies="#kt_schedule_<?= $schedule_id ?>_attachments_footer"
                                                                     data-kt-scroll-wrappers="#kt_schedule_<?= $schedule_id ?>_attachments_body"
                                                                     data-kt-scroll-offset="5px">
                                                                    <?php
                                                                    foreach ($schedule_attachments as $schedule_attachment) {
                                                                        $author_id = $schedule_attachment->post_author;
                                                                        $avatar = get_field('_avatar', 'user_' . $author_id);
                                                                        $author = get_the_author_meta('display_name', $author_id);
                                                                        if ($avatar) {
                                                                            $avatar_url = $avatar['sizes']['thumbnail'];
                                                                        } else {
                                                                            $avatar_url = get_avatar_url($author_id);
                                                                        }
                                                                        $datetime = date_i18n('d/m/Y g:i a', strtotime($schedule_attachment->post_date));
                                                                        $datetime = get_post_datetime($schedule_attachment->ID)->format('d M Y h:i A');
                                                                        ?>
                                                                        <!--begin::Attachment Template-->
                                                                        <div class="d-flex justify-content-start mb-10">
                                                                            <!--begin::Wrapper-->
                                                                            <div class="d-flex flex-column align-items-start w-100">
                                                                                <!--begin::User-->
                                                                                <div class="d-flex align-items-center mb-2">
                                                                                    <!--begin::Avatar-->
                                                                                    <div class="symbol symbol-35px symbol-circle">
                                                                                        <img alt="Pic"
                                                                                             src="<?= $avatar_url ?>"/>
                                                                                    </div>
                                                                                    <!--end::Avatar-->
                                                                                    <!--begin::Details-->
                                                                                    <div class="ms-3 d-flex flex-column">
                                                                                        <a href="javascript:void(0)"
                                                                                           class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1"><?= $author ?></a>
                                                                                        <span class="text-muted fs-7 mb-1"><?= $datetime ?></span>
                                                                                    </div>
                                                                                    <!--end::Details-->
                                                                                </div>
                                                                                <!--end::User-->
                                                                                <!--begin::Text-->
                                                                                <div class="p-5 pb-0 rounded bg-light-info w-100">
                                                                                    <!--begin::attachments-->
                                                                                    <!--begin::Overlay-->
                                                                                    <?php
                                                                                    $attach_mime_type = get_post_mime_type($schedule_attachment->ID);
                                                                                    if (in_array($attach_mime_type, PREVIEW_ALLOWED_IMG_FILE_TYPES)) {
                                                                                        ?>
                                                                                        <a class="d-block overlay mb-3 mw-200px"
                                                                                           data-fslightbox="lightbox-basic"
                                                                                           href="<?= wp_get_attachment_url($schedule_attachment->ID) ?>">
                                                                                            <!--begin::Image-->
                                                                                            <div class="d-block mw-100 overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                                                                                 style="background-image:url('<?= wp_get_attachment_url($schedule_attachment->ID) ?>')">
                                                                                            </div> <!--end::Image-->
                                                                                            <!--begin::Action-->
                                                                                            <div
                                                                                                    class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                                                                                <i class="bi bi-eye-fill text-white fs-3x"></i>
                                                                                            </div> <!--end::Action-->
                                                                                        </a>
                                                                                        <?php
                                                                                    }
                                                                                    else {
                                                                                        ?>
                                                                                        <div class="mb-3">
                                                                                            <!--begin::Svg Icon | path: icons/duotune/files/fil003.svg-->
                                                                                            <span class="svg-icon svg-icon-2x svg-icon-white me-4">
                                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                     width="24"
                                                                                                     height="24" viewBox="0 0 24 24"
                                                                                                     fill="none">
                                                                                                    <path
                                                                                                            opacity="0.3"
                                                                                                            d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z"
                                                                                                            fill="currentColor"/>
                                                                                                    <path
                                                                                                            d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z"
                                                                                                            fill="currentColor"/>
                                                                                                </svg>
                                                                                            </span>
                                                                                            <a href="<?= wp_get_attachment_url($schedule_attachment->ID) ?>"
                                                                                               download
                                                                                               class="text-dark fw-bolder"><?= basename(get_attached_file($schedule_attachment->ID)) ?></a>
                                                                                            <!--end::Svg Icon-->
                                                                                        </div>
                                                                                        <?php
                                                                                    }
                                                                                    ?>
                                                                                    <!--end::Overlay-->
                                                                                    <!--end::attachments-->
                                                                                </div>
                                                                                <!--end::Text-->
                                                                            </div>
                                                                            <!--end::Wrapper-->
                                                                        </div>
                                                                        <!--end::Attachment Template-->
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <!--end::schedule attachments-->
                                                            </div>
                                                            <!--end::Card body-->
                                                            <!--begin::Card footer-->
                                                            <div id="kt_schedule_<?= $schedule_id ?>_attachments_footer"
                                                                 data-kt-element="schedule_attachments_footer">
                                                                <!--begin:image category field-->
                                                                <div class="w-100 d-none1"
                                                                     data-kt-element="kt_schedule_attachment_category">
                                                                    <select class="form-select mb-1 cursor-pointer"
                                                                            name="type">
                                                                        <?php
                                                                        foreach (AIRENO_FILE_TYPES as $key => $name) {
                                                                            echo '<option value="' . $key . '">' . $name . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <!--end:image category field-->
                                                                <!--begin:image preview-->
                                                                <div class="w-100 mb-3"
                                                                     data-kt-element="kt_schedule_attachment_previews">
                                                                    <div class="d-none p-1 d-flex"
                                                                         data-kt-element="preview-template">
                                                                        <div
                                                                                class="position-relative flex-stack border-dotted border-1 w-100 d-flex p-2 rounded-10px">
                                                                            <div
                                                                                    class="d-flex justify-content-start align-items-center">
                                                                                <div class="d-inline-block ms-5">
                                                                                    <span class="d-block img-title">title.png</span>
                                                                                    <span
                                                                                            class="d-block img-size">234.4KB</span>
                                                                                </div>
                                                                            </div>
                                                                            <a class="ai-remove"
                                                                               href="javascript:void(0)"
                                                                               data-file-id=""> <i
                                                                                        class="bi bi-x-lg text-danger fs-2 fw-bolder"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--end:image preview-->
                                                                <!--begin:file upload button-->
                                                                <div class="w-100 mb-3 d-none"
                                                                     data-kt-element="kt_schedule_upload_button">
                                                                    <a class="btn btn-success w-100">Upload</a>
                                                                </div>
                                                                <!--end:file upload button-->
                                                                <div
                                                                        class="cursor-pointer border-dashed border-2 px-5 py-4 rounded filter-trigger">
                                                                    <!--begin::file trigger-->
                                                                    <div class="cursor-pointer text-left d-flex">
                                                                        <!--begin::Icon-->
                                                                        <!--begin::Svg Icon | path: icons/duotune/files/fil010.svg-->
                                                                        <span class="svg-icon svg-icon-3hx svg-icon-primary"> <svg
                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                    width="24"
                                                                                    height="24" viewBox="0 0 24 24"
                                                                                    fill="none">
                                                                                <path
                                                                                        opacity="0.3"
                                                                                        d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM14.5 12L12.7 9.3C12.3 8.9 11.7 8.9 11.3 9.3L10 12H11.5V17C11.5 17.6 11.4 18 12 18C12.6 18 12.5 17.6 12.5 17V12H14.5Z"
                                                                                        fill="currentColor"></path>
                                                                                <path
                                                                                        d="M13 11.5V17.9355C13 18.2742 12.6 19 12 19C11.4 19 11 18.2742 11 17.9355V11.5H13Z"
                                                                                        fill="currentColor"></path>
                                                                                <path
                                                                                        d="M8.2575 11.4411C7.82942 11.8015 8.08434 12.5 8.64398 12.5H15.356C15.9157 12.5 16.1706 11.8015 15.7425 11.4411L12.4375 8.65789C12.1875 8.44737 11.8125 8.44737 11.5625 8.65789L8.2575 11.4411Z"
                                                                                        fill="currentColor"></path>
                                                                                <path
                                                                                        d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z"
                                                                                        fill="currentColor"></path>
                                                                            </svg>
                                                                        </span>
                                                                        <!--end::Svg Icon-->
                                                                        <!--end::Icon-->
                                                                        <!--begin::Info-->
                                                                        <div class="ms-4 text-left">
                                                                            <h3 class="dfs-6 fs-6 fw-bolder text-gray-900 mb-1">
                                                                                Click here to choose file(s).</h3>
                                                                            <span class="fw-bold fs-7 text-muted">Choose up to 10
																	files</span>
                                                                        </div>
                                                                        <!--end::Info-->
                                                                    </div>
                                                                    <!--end::file trigger-->
                                                                </div>
                                                                <input type="file" class="d-none" data-kt-element="file"
                                                                       multiple
                                                                       accept=".xlsx, .xls, .csv, .pdf , image/*, .doc, .docx, .txt, image/heic">
                                                            </div>
                                                            <!--end::Card footer-->
                                                        </div>
                                                        <!--end:Attachments -->
                                                        <!--begin:Comment -->
                                                        <div
                                                                id="kt_schedule_<?= $schedule_id ?>_comments_collapsible"
                                                                class="mb-3 collapse">
                                                            <h3 class="py-7">Comments</h3>
                                                            <!--begin::Card body-->
                                                            <div id="kt_schedule_<?= $schedule_id ?>_comments_body">
                                                                <!--begin::Messages-->
                                                                <div class="scroll-y me-n5 pe-5 mh-400px h-auto"
                                                                     data-kt-element="schedule_comments"
                                                                     data-kt-scroll="true"
                                                                     data-kt-scroll-activate="{default: false, lg: true}"
                                                                     data-kt-scroll-max-height="auto"
                                                                     data-kt-scroll-dependencies="#kt_schedule_<?= $schedule_id ?>_comments_footer"
                                                                     data-kt-scroll-wrappers="#kt_schedule_<?= $schedule_id ?>_comments_body"
                                                                     data-kt-scroll-offset="5px">
                                                                    <?php
                                                                    if (count($schedule['comments'])) {
                                                                        foreach ($schedule['comments'] as $schedule_comment) {
                                                                            $author_id = $schedule_comment['author'];
                                                                            $avatar = get_field('_avatar', 'user_' . $author_id);
                                                                            $author = get_the_author_meta('display_name', $author_id);
                                                                            if ($avatar) {
                                                                                $avatar_url = $avatar['sizes']['thumbnail'];
                                                                            } else {
                                                                                $avatar_url = get_avatar_url($author_id);
                                                                            }
                                                                            $datetime = date_i18n('d/m/Y g:i a', strtotime($schedule_comment['datetime']));
                                                                            $content = $schedule_comment['content'];
                                                                            ?>
                                                                            <!--begin::Message(template for in)-->
                                                                            <div class="d-flex justify-content-start mb-5">
                                                                                <!--begin::Wrapper-->
                                                                                <div class="d-flex flex-column align-items-start">
                                                                                    <!--begin::User-->
                                                                                    <div class="d-flex align-items-center mb-2">
                                                                                        <!--begin::Avatar-->
                                                                                        <div class="symbol symbol-35px symbol-circle">
                                                                                            <img alt="Pic"
                                                                                                 src="<?= $avatar_url ?>"/>
                                                                                        </div>
                                                                                        <!--end::Avatar-->
                                                                                        <!--begin::Details-->
                                                                                        <div class="ms-3">
                                                                                            <a href="javascript:void(0)"
                                                                                               class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1"><?= $author ?></a>
                                                                                            <span class="text-muted fs-7 mb-1"><?= $datetime ?></span>
                                                                                        </div>
                                                                                        <!--end::Details-->
                                                                                    </div>
                                                                                    <!--end::User-->
                                                                                    <!--begin::Text-->
                                                                                    <div
                                                                                            class="p-3 rounded bg-light-info mw-lg-400px text-start">
                                                                                        <span class="text-dark fw-bold mb-5"><?= $content ?></span>
                                                                                    </div>
                                                                                    <!--end::Text-->
                                                                                </div>
                                                                                <!--end::Wrapper-->
                                                                            </div>
                                                                            <!--end::Message(template for in)-->
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <!--begin::Message(template for in)-->
                                                                    <div class="d-flex justify-content-start mb-5 d-none"
                                                                         data-kt-element="schedule-comment-template">
                                                                        <!--begin::Wrapper-->
                                                                        <div class="d-flex flex-column align-items-start">
                                                                            <!--begin::User-->
                                                                            <div class="d-flex align-items-center mb-2">
                                                                                <!--begin::Avatar-->
                                                                                <div class="symbol symbol-35px symbol-circle">
                                                                                    <img alt="Pic"
                                                                                         data-kt-element="avatar"
                                                                                         src="<?= get_theme_file_uri("assets/images/300-25.jpg") ?>"/>
                                                                                </div>
                                                                                <!--end::Avatar-->
                                                                                <!--begin::Details-->
                                                                                <div class="ms-3">
                                                                                    <a href="javascript:void(0)"
                                                                                       class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1"
                                                                                       data-kt-element="author">Brian
                                                                                        Cox</a> <span
                                                                                            class="text-muted fs-7 mb-1"
                                                                                            data-kt-element="datetime">Just now</span>
                                                                                </div>
                                                                                <!--end::Details-->
                                                                            </div>
                                                                            <!--end::User-->
                                                                            <!--begin::Text-->
                                                                            <div
                                                                                    class="p-3 rounded bg-light-info mw-lg-400px text-start">
																	<span class="text-dark fw-bold mb-5"
                                                                          data-kt-element="content"></span>
                                                                            </div>
                                                                            <!--end::Text-->
                                                                        </div>
                                                                        <!--end::Wrapper-->
                                                                    </div>
                                                                    <!--end::Message(template for in)-->
                                                                </div>
                                                                <!--end::Messages-->
                                                            </div>
                                                            <!--end::Card body-->
                                                            <!--begin::Card footer-->
                                                            <div id="kt_schedule_<?= $schedule_id ?>_comments_footer">
                                                                <!--begin::Input-->
                                                                <textarea class="form-control mb-3" rows="3"
                                                                          data-kt-element="input"
                                                                          placeholder="Type a comment"></textarea>
                                                                <!--end::Input-->
                                                                <!--begin:Toolbar-->
                                                                <div class="d-flex flex-stack">
                                                                    <!--begin::Send-->
                                                                    <button class="btn btn-primary" type="button"
                                                                            data-kt-element="send">Send
                                                                    </button>
                                                                    <!--end::Send-->
                                                                </div>
                                                                <!--end::Toolbar-->
                                                            </div>
                                                            <!--end::Card footer-->
                                                        </div>
                                                        <!--end:Comment -->
                                                    </div>
                                                    <!--end::Card body-->
                                                </div>
                                                <!--end::Card-->
                                                <?php
                                            }
                                        }
                                        ?>
                                        <!--end::Card-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--End:Schedules-->
                            <!--Begin:Payments-->
                            <div class="tab-pane fade show <?= $tab == 'project-payments' ? 'active' : '' ?>"
                                 id="project-payments" role="tabpanel">
                                <?php
                                $args = array(
                                    'post_type' => AIRENO_CPT_PAYMENT,
                                    'post_status' => array(
                                        'publish'
                                    ),
                                    'posts_per_page' => -1,
                                    'meta_key' => 'project_id',
                                    'meta_value' => $project_id,
                                    'meta_compare' => '=',
                                    'orderby' => 'ID',
                                    'order' => 'ASC',
                                );
                                $payments_total = 0;
                                $payments = array();
                                $payments_query = new WP_Query($args);
                                if ($payments_query->have_posts()) {
                                    while ($payments_query->have_posts()) {
                                        $payments_query->the_post();
                                        $payment_amount = get_field('amount', get_the_ID());
                                        $payment_user = get_field('payment_user', get_the_ID());
                                        $payment_status = get_field('status', get_the_ID());
                                        $payment_userdata = aireno_get_userdata($payment_user);
                                        $payment_sender_id = get_field('sender', get_the_ID());
                                        $payment_senderdata = ($payment_sender_id) ? aireno_get_userdata($payment_sender_id) : null;
                                        if (current_user_can('manage_options') || is_head($user_id) || $payment_sender_id == $user_id
                                            || $user_id == $payment_user) {
                                            if ($payment_status != 'Cancelled')
                                                $payments_total += $payment_amount;
                                            $payments[get_the_ID()] = array(
                                                'id' => get_the_ID(),
                                                'title' => get_the_title(),
                                                'description' => get_the_content(),
                                                'status' => $payment_status,
                                                'amount' => $payment_amount,
                                                'payment_user' => $payment_user,
                                                'payment_userdata' => $payment_userdata,
                                                'sender' => $payment_sender_id,
                                                'payment_senderdata' => $payment_senderdata,
                                            );
                                        }
                                    }
                                }
                                wp_reset_query();
                                ?>
                                <!--begin::Table-->
                                <div class="card card-flush mt-6 mt-xl-9">
                                    <!--begin::Card header-->
                                    <div class="card-header mt-5">
                                        <!--begin::Card title-->
                                        <div class="card-title flex-column">
                                            <h3 class="fw-bolder mb-1">Project Spendings</h3>
                                            <div class="fs-6 text-gray-400">Total
                                                $<?= number_format($payments_total, 2, '.', '') ?> sepnt so far
                                            </div>
                                        </div>
                                        <!--begin::Card title-->
                                        <!--begin::Card toolbar-->
                                        <div class="card-toolbar my-1">
                                            <!--begin::Select-->
                                            <div class="me-4 my-1">
                                                <select id="kt_filter_payments_orders" name="orders"
                                                        data-control="select2" data-hide-search="true"
                                                        class="w-125px form-select form-select-solid form-select-sm">
                                                    <option value="" selected="selected">All Orders</option>
                                                    <?php
                                                    foreach (AIRENO_PAYMENT_STATUSES as $value => $title) {
                                                        ?>
                                                        <option
                                                                value="<?= $value ?>"><?= $title ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <!--end::Select-->
                                            <!--begin::Search-->
                                            <div class="d-flex align-items-center position-relative my-1">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                                <span class="svg-icon svg-icon-3 position-absolute ms-3"> <svg
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5"
                                                          x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                                          transform="rotate(45 17.0365 15.1223)" fill="currentColor"/>
                                                    <path
                                                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                            fill="currentColor"/>
                                                </svg>
											</span>
                                                <!--end::Svg Icon-->
                                                <input type="text" id="kt_filter_payments_search"
                                                       class="form-control form-control-solid form-select-sm w-150px ps-9"
                                                       placeholder="Search Order"/>
                                            </div>
                                            <!--end::Search-->
                                        </div>
                                        <!--begin::Card toolbar-->
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <!--begin::Table-->
                                        <table id="kt_payments_overview_table"
                                               class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bolder">
                                            <!--begin::Head-->
                                            <thead class="fs-7 text-gray-400 text-uppercase">
                                            <tr>
                                                <th class="min-w-250px">Manager</th>
                                                <th class="min-w-250px">Details</th>
                                                <th class="min-w-90px">Amount</th>
                                                <th class="min-w-90px">Status</th>
                                                <th class="min-w-50px text-center">Actions</th>
                                            </tr>
                                            </thead>
                                            <!--end::Head-->
                                            <!--begin::Body-->
                                            <tbody class="fs-6">
                                            <?php
                                            foreach ($payments as $payment_id => $payment_details) {
                                                $status_class = 'badge-light-warning';
                                                switch ($payment_details['status']) {
                                                    case 'Paid':
                                                        $status_class = 'badge-light-success';
                                                        break;
                                                    case 'Cancelled':
                                                        $status_class = 'badge-light-danger';
                                                        break;
                                                    case 'Ready':
                                                        $status_class = 'badge-light-info';
                                                        break;
                                                    default:
                                                        break;
                                                }
                                                ?>
                                                <tr
                                                        data-kt-element="kt_single_payment">
                                                    <td>
                                                        <?php
                                                        if ($payment_details['payment_userdata']) {
                                                            ?>
                                                            <!--begin::User-->
                                                            <div class="d-flex align-items-center">
                                                                <!--begin::Wrapper-->
                                                                <div class="me-5 position-relative">
                                                                    <!--begin::Avatar-->
                                                                    <div class="symbol symbol-35px symbol-circle">
                                                                        <img alt="Pic"
                                                                             src="<?= $payment_details['payment_userdata']->avatar ?>"/>
                                                                    </div>
                                                                    <!--end::Avatar-->
                                                                </div>
                                                                <!--end::Wrapper-->
                                                                <!--begin::Info-->
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <a href="javascript:void(0)"
                                                                       class="fs-6 text-gray-800 text-hover-primary"><?= $payment_details['payment_userdata']->display_name ?></a>
                                                                    <div class="fw-bold text-gray-400">
                                                                        <?= $payment_details['payment_userdata']->email ?>
                                                                    </div>
                                                                </div>
                                                                <!--end::Info-->
                                                            </div> <!--end::User-->
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0"><?= $payment_details['title'] ?></p>
                                                        <p class="fs-5 fw-light mb-0">
                                                            <?= $payment_details['description'] ?></p>
                                                    </td>
                                                    <td>
                                                        $<?= number_format($payment_details['amount'], 2, '.', '') ?>
                                                    </td>
                                                    <td><span
                                                                class="badge <?= $status_class ?> fw-bolder px-4 py-3"><?= $payment_details['status'] ?></span>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php
                                                        if ($payment_details['status'] == 'Pending') {
                                                            ?>
                                                            <a href="javascript:void(0)"
                                                               class="btn btn-icon btn-active-color-primary w-25px h-25px"
                                                               data-kt-element="btnEditPayment"
                                                               data-payment-id="<?= $payment_id ?>">
                                                                <i class="bi bi-pencil-fill fs-7 text-primary"></i>
                                                            </a>
                                                            <?php
                                                        }
                                                        ?>
                                                        <?php
                                                        if ($payment_details['status'] == 'Pending') {
                                                            ?>
                                                            <a href="javascript:void(0)"
                                                               class="btn btn-icon btn-active-color-primary w-25px h-25px"
                                                               data-kt-element="btnClaimPayment"
                                                               data-payment-id="<?= $payment_id ?>">
                                                                <i class="fa-solid fa-paper-plane fs-7 text-success"></i>
                                                            </a>
                                                            <?php
                                                        }
                                                        ?>
                                                        <?php
                                                        if ($payment_details['status'] == 'Ready' || $payment_details['status'] == 'Paid') {
                                                            ?>
                                                            <a href="javascript:void(0)"
                                                               class="btn btn-icon btn-active-color-primary w-25px h-25px"
                                                               data-kt-element="btnViewInvoice"
                                                               data-payment-id="<?= $payment_id ?>">
                                                                <i class="fa-solid fa-file-invoice fs-7 text-info"></i>
                                                            </a>
                                                            <?php
                                                        }
                                                        ?>
                                                        <?php
                                                        if ($payment_details['status'] == 'Ready' || $payment_details['status'] == 'Pending') {
                                                            ?>
                                                            <a href="javascript:void(0)"
                                                               class="btn btn-icon btn-active-color-primary w-25px h-25px"
                                                               data-kt-element="btnCancelPayment"
                                                               data-payment-id="<?= $payment_id ?>">
                                                                <i class="fa-solid fa-trash fs-7 text-danger"></i>
                                                            </a>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                            <!--end::Body-->
                                        </table>
                                        <!--end::Table-->
                                        <input type="hidden" data-kt-element="payments"
                                               value='<?= json_encode($payments) ?>'/>
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Table-->
                            </div>
                            <!--End:Payments-->
                            <!--Begin:Users-->
                            <div class="tab-pane fade show <?= $tab == 'project-users' ? 'active' : '' ?>"
                                 id="project-users" role="tabpanel">
                                <!--begin::Row-->
                                <div class="row g-6 g-xl-9">
                                    <?php
                                    foreach ($team_members as $team_member) {
                                        ?>
                                        <!--begin::Col-->
                                        <div class="col-md-6 col-xxl-4">
                                            <!--begin::Card-->
                                            <div class="card h-100">
                                                <!--begin::Card body-->
                                                <div
                                                        class="card-body d-flex flex-center flex-column pt-12 p-9 position-relative justify-content-start">
                                                    <div
                                                            class="d-flex position-absolute pb-0 border-0 justify-content-end"
                                                            style="top: 15px; right: 15px;">
                                                        <?php
                                                        $badge_class = 'badge-warning';
                                                        $type = 'Client';
                                                        if (in_array($team_member->id, $businesses)) {
                                                            $badge_class = 'badge-success';
                                                            $type = 'Business';
                                                        } else if (in_array($team_member->id, $contractors)) {
                                                            $badge_class = 'badge-info';
                                                            $type = 'Contractor';
                                                        } else if (in_array($team_member->id, $suppliers)) {
                                                            $badge_class = 'badge-light-info';
                                                            $type = 'Supplier';
                                                        } else if (in_array($team_member->id, $planners)) {
                                                            $badge_class = 'badge-light-info';
                                                            $type = 'Planner';
                                                        } else if (in_array($team_member->id, $designers)) {
                                                            $badge_class = 'badge-light-info';
                                                            $type = 'Designer';
                                                        } else if (in_array($team_member->id, $partners)) {
                                                            $badge_class = 'badge-light-info';
                                                            $type = 'Partner';
                                                        } else if (in_array($team_member->id, $heads)) {
                                                            $badge_class = 'badge-primary';
                                                            $type = 'Head';
                                                        }
                                                        ?>
                                                    </div>
                                                    <!--begin::Avatar-->
                                                    <div class="symbol symbol-65px symbol-circle mb-5">
                                                        <img src="<?= $team_member->avatar ?>"
                                                             alt="<?= $team_member->display_name ?>"/>
                                                        <div
                                                                class="bg-success position-absolute border border-4 border-white h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3">
                                                        </div>
                                                    </div>
                                                    <!--end::Avatar-->
                                                    <!--begin::Name-->
                                                    <a href="javascript:void(0)" data-user-id="<?= $team_member->id ?>"
                                                       class="view-user fs-4 text-gray-800 text-hover-primary fw-bolder mb-0"><?= $team_member->display_name ?></a>
                                                    <!--end::Name-->
                                                    <!--begin::Position-->
                                                    <div class="fw-bold fs-6 text-gray-600 mb-6">
                                                        <span class="badge <?= $badge_class ?> fs-8 fw-bold ms-2"><?= $type ?></span>
                                                    </div>
                                                    <!--end::Position-->
                                                    <!--begin::Info-->
                                                    <div class="d-flex flex-center flex-wrap">
                                                        <!--begin::Rating-->
                                                        <div
                                                                class="border border-gray-700 border-dashed rounded min-w-80px py-2 px-3 mx-2 mb-3">
                                                            <a href="javascript:void(0)"
                                                               class="d-flex align-items-center text-gray-700 fw-bolder text-hover-primary">
                                                                <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                                                <span class="svg-icon svg-icon-2"> <svg
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            width="24"
                                                                            height="24" viewBox="0 0 24 24" fill="none">
                                                                <path
                                                                        d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z"
                                                                        fill="currentColor"></path>
                                                            </svg>
													</span> <!--end::Svg Icon-->
                                                                <?= $team_member->phone ?>
                                                            </a>
                                                        </div>
                                                        <!--end::Rating-->
                                                        <!--begin::Address-->
                                                        <div
                                                                class="border border-gray-700 border-dashed rounded min-w-80px py-2 px-3 mx-2 mb-3">
                                                            <a href="javascript:void(0)"
                                                               class="d-flex align-items-center text-gray-700 fw-bolder text-hover-primary">
                                                                <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                                                <span class="svg-icon svg-icon-4 me-1"> <svg
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            width="24"
                                                                            height="24" viewBox="0 0 24 24" fill="none">
                                                                <path
                                                                        opacity="0.3"
                                                                        d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z"
                                                                        fill="currentColor"></path>
                                                                <path
                                                                        d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
                                                                        fill="currentColor"></path>
                                                            </svg>
													</span> <!--end::Svg Icon-->
                                                                <?= $team_member->address ?>
                                                            </a>
                                                        </div>
                                                        <!--end::Address-->
                                                        <!--begin::phone-->
                                                        <div
                                                                class="border border-gray-700 border-dashed rounded min-w-80px py-2 px-3 mx-2 mb-3">
                                                            <a href="tel:+<?= $team_member->phone ?>"
                                                               class="d-flex align-items-center text-gray-700 fw-bolder text-hover-primary">
                                                                <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                                                <span class="svg-icon svg-icon-4 me-1"> <svg
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            width="24"
                                                                            height="24" viewBox="0 0 24 24" fill="none">
                                                                <path
                                                                        opacity="0.3"
                                                                        d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z"
                                                                        fill="currentColor"></path>
                                                                <path
                                                                        d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z"
                                                                        fill="currentColor"></path>
                                                            </svg>
													</span> <!--end::Svg Icon-->
                                                                <?= $team_member->phone ?>
                                                            </a>
                                                        </div>
                                                        <!--end::phone-->
                                                        <!--begin::email-->
                                                        <div
                                                                class="border border-gray-700 border-dashed rounded min-w-80px py-2 px-3 mx-2 mb-3">
                                                            <a href="mailto:<?= $team_member->email ?>"
                                                               class="d-flex align-items-center text-gray-700 fw-bolder text-hover-primary">
                                                                <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                                                <span class="svg-icon svg-icon-4 me-1"> <svg
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            width="24"
                                                                            height="24" viewBox="0 0 24 24" fill="none">
                                                                <path
                                                                        opacity="0.3"
                                                                        d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z"
                                                                        fill="currentColor"></path>
                                                                <path
                                                                        d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z"
                                                                        fill="currentColor"></path>
                                                            </svg>
													</span>
                                                                <?= $team_member->email ?>
                                                            </a>
                                                        </div>
                                                        <!--end::email-->
                                                    </div>
                                                    <!--end::Info-->
                                                </div>
                                                <!--end::Card body-->
                                            </div>
                                            <!--end::Card-->
                                        </div>
                                        <!--end::Col-->
                                        <?php
                                    }
                                    ?>
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--End:Users-->
                            <!--Begin:Files-->
                            <div class="tab-pane fade show <?= $tab == 'project-files' ? 'active' : '' ?>"
                                 id="project-files" role="tabpanel">
                                <!--begin::Card-->
                                <div class="card card-flush">
                                    <?php
                                    $args = array(
                                        'post_type' => 'attachment',
                                        'post_status' => array(
                                            'inherit'
                                        ),
                                        'posts_per_page' => -1,
                                        'meta_key' => 'project_id',
                                        'meta_value' => $project_id,
                                        'meta_compare' => '='
                                    );
                                    $files_query = new WP_Query($args);
                                    $files = array();
                                    if ($files_query->have_posts()) {
                                        while ($files_query->have_posts()) {
                                            $files_query->the_post();
                                            $type = get_post_meta(get_the_ID(), 'type', true);
                                            $type = $type ? $type : 'project';

                                            $files[] = array(
                                                'title' => basename(get_attached_file(get_the_ID())),
                                                'size' => ceil(filesize(get_attached_file(get_the_ID())) / 1024) . 'KB',
                                                'type' => $type,
                                                'ID' => get_the_ID(),
                                                'url' => wp_get_attachment_url(get_the_ID()),
                                                'mime' => get_post_mime_type(get_the_ID()),
                                                'uploaded_at' => get_post_datetime(get_the_ID())->format('d M Y h:i A')
                                            );
                                        }
                                    }
                                    ?>
                                    <!--begin::Card header-->
                                    <div class="card-header pt-8">
                                        <div class="card-title">
                                            <!--begin::Search-->
                                            <div class="d-flex align-items-center position-relative my-1">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                                <span class="svg-icon svg-icon-1 position-absolute ms-6"> <svg
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5"
                                                          x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                                          transform="rotate(45 17.0365 15.1223)" fill="currentColor"/>
                                                    <path
                                                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                            fill="currentColor"/>
                                                </svg>
											</span>
                                                <!--end::Svg Icon-->
                                                <input type="text" id="kt_filter_files_search"
                                                       class="form-control form-control-solid w-250px ps-15"
                                                       placeholder="Search Files"/>
                                            </div>
                                            <!--end::Search-->
                                            <button class="ms-2 btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#kt_modal_file_upload">Upload
                                            </button>
                                        </div>
                                        <!--begin::Card toolbar-->
                                        <div class="card-toolbar">
                                            <!--begin::Toolbar-->
                                            <div class="d-flex justify-content-end"
                                                 data-kt-files-table-toolbar="base">
                                                <!--begin : Type Filter-->
                                                <select id="kt_filter_file_types" data-control="select2"
                                                        data-hide-search="true"
                                                        class="w-125px form-select form-select-solid me-3">
                                                    <option value="" selected="selected">All</option>
                                                    <?php
                                                    foreach (AIRENO_FILE_TYPES as $key => $name) {
                                                        echo '<option value="' . $key . '">' . $name . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                                <!--end : Type Filter-->
                                                <!--begin::Folder Stats-->
                                                <div class="badge badge-primary px-5">
												<span id="kt_file_manager_items_counter"><?= count($files) ?>
                                                    files</span>
                                                </div>
                                                <!--end::Folder Stats-->
                                            </div>
                                            <!--end::Toolbar-->
                                            <!--begin::Group actions-->
                                            <div
                                                    class="d-flex justify-content-end align-items-center d-none"
                                                    data-kt-files-table-toolbar="selected">
                                                <div class="fw-bolder me-5">
												<span class="me-2"
                                                      data-kt-files-table-select="selected_count"></span>Selected
                                                </div>
                                                <button type="button" class="btn btn-danger"
                                                        data-kt-files-table-select="delete_selected">Delete Selected
                                                </button>
                                            </div>
                                            <!--end::Group actions-->
                                        </div>
                                        <!--end::Card toolbar-->
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table id="kt_files_overview_table"
                                                   class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bolder">
                                                <!--begin::Head-->
                                                <thead class="fs-7 text-gray-400 text-uppercase">
                                                <tr>
                                                    <th class="min-w-250px">Name</th>
                                                    <th class="min-w-250px">Type</th>
                                                    <th class="min-w-10px">Size</th>
                                                    <th class="min-w-125px">Uploaded at</th>
                                                    <th class="w-125px"></th>
                                                </tr>
                                                </thead>
                                                <!--end::Head-->
                                                <!--begin::Body-->
                                                <tbody class="fs-6">
                                                <?php
                                                foreach ($files as $file) {
                                                    ?>
                                                    <tr>
                                                        <!--begin::Name=-->
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <?php
                                                                if (in_array($file['mime'], PREVIEW_ALLOWED_IMG_FILE_TYPES)) {
                                                                    ?>
                                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen006.svg-->
                                                                    <span class="svg-icon svg-icon-2x svg-icon-primary me-4">
																<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path
                                                                            opacity="0.3"
                                                                            d="M22 5V19C22 19.6 21.6 20 21 20H19.5L11.9 12.4C11.5 12 10.9 12 10.5 12.4L3 20C2.5 20 2 19.5 2 19V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5ZM7.5 7C6.7 7 6 7.7 6 8.5C6 9.3 6.7 10 7.5 10C8.3 10 9 9.3 9 8.5C9 7.7 8.3 7 7.5 7Z"
                                                                            fill="currentColor"/>
                                                                    <path
                                                                            d="M19.1 10C18.7 9.60001 18.1 9.60001 17.7 10L10.7 17H2V19C2 19.6 2.4 20 3 20H21C21.6 20 22 19.6 22 19V12.9L19.1 10Z"
                                                                            fill="currentColor"/>
                                                                </svg>
															</span> <a data-fslightbox="lightbox-basic"
                                                                       href="<?= wp_get_attachment_url($file['ID']) ?>"
                                                                       class="text-gray-800 text-hover-primary"><?= $file['title'] ?></a>
                                                                    <!--end::Svg Icon-->
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <!--begin::Svg Icon | path: icons/duotune/files/fil003.svg-->
                                                                    <span class="svg-icon svg-icon-2x svg-icon-primary me-4">
																<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path
                                                                            opacity="0.3"
                                                                            d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z"
                                                                            fill="currentColor"/>
                                                                    <path
                                                                            d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z"
                                                                            fill="currentColor"/>
                                                                </svg>
															</span> <a
                                                                            href="<?= wp_get_attachment_url($file['ID']) ?>"
                                                                            download
                                                                            class="text-gray-800 text-hover-primary"><?= $file['title'] ?></a>
                                                                    <!--end::Svg Icon-->
                                                                    <?php
                                                                }
                                                                ?>

                                                            </div>
                                                        </td>
                                                        <!--end::Name=-->
                                                        <!--begin::Type-->
                                                        <td><?= AIRENO_FILE_TYPES[$file['type']] ?></td>
                                                        <!--end::Type-->
                                                        <!--begin::Size-->
                                                        <td><?= $file['size'] ?></td>
                                                        <!--end::Size-->
                                                        <!--begin::Last modified-->
                                                        <td><?= $file['uploaded_at'] ?></td>
                                                        <!--end::Last modified-->
                                                        <!--begin::Actions-->
                                                        <td class="text-end"
                                                            data-kt-filemanager-table="action_dropdown">
                                                            <div class="d-flex justify-content-end">
                                                                <!--begin::More-->
                                                                <div class="ms-2">
                                                                    <button type="button"
                                                                            class="btn btn-sm btn-icon btn-light btn-active-light-primary"
                                                                            data-kt-menu-trigger="click"
                                                                            data-kt-menu-placement="bottom-end">
                                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen052.svg-->
                                                                        <span class="svg-icon svg-icon-5 m-0"> <svg
                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                    width="24"
                                                                                    height="24" viewBox="0 0 24 24"
                                                                                    fill="none">
                                                                            <rect
                                                                                    x="10" y="10" width="4" height="4"
                                                                                    rx="2"
                                                                                    fill="currentColor"/>
                                                                            <rect
                                                                                    x="17" y="10" width="4" height="4"
                                                                                    rx="2"
                                                                                    fill="currentColor"/>
                                                                            <rect
                                                                                    x="3" y="10" width="4" height="4"
                                                                                    rx="2"
                                                                                    fill="currentColor"/>
                                                                        </svg>
																	</span>
                                                                        <!--end::Svg Icon-->
                                                                    </button>
                                                                    <!--begin::Menu-->
                                                                    <div
                                                                            class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-150px py-4"
                                                                            data-kt-menu="true">
                                                                        <!--begin::Menu item-->
                                                                        <div class="menu-item px-3">
                                                                            <a href="<?= $file['url'] ?>"
                                                                               class="menu-link px-3"
                                                                               download>Download File</a>
                                                                        </div>
                                                                        <!--end::Menu item-->
                                                                        <!--begin::Menu item-->
                                                                        <div class="menu-item px-3">
                                                                            <a href="javascript:void(0)"
                                                                               class="menu-link text-danger px-3 btnDeleteSingleFile"
                                                                               data-fileid="<?= $file['ID'] ?>">Delete</a>
                                                                        </div>
                                                                        <!--end::Menu item-->
                                                                    </div>
                                                                    <!--end::Menu-->
                                                                </div>
                                                                <!--end::More-->
                                                            </div>
                                                        </td>
                                                        <!--end::Actions-->
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                                </tbody>
                                                <!--end::Body-->
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--End:Files-->
                            <!--Begin:Activity-->
                            <div class="tab-pane fade show <?= $tab == 'project-activity' ? 'active' : '' ?>"
                                 id="project-activity" role="tabpanel">
                                <!--begin::Timeline-->
                                <div class="card">
                                    <!--begin::Card head-->
                                    <div class="card-header card-header-stretch">
                                        <!--begin::Title-->
                                        <div class="card-title d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                                            <span class="svg-icon svg-icon-1 svg-icon-primary me-3 lh-0">
											<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                 height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"
                                                      d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z"
                                                      fill="currentColor"/>
                                                <path
                                                        d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z"
                                                        fill="currentColor"/>
                                                <path
                                                        d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z"
                                                        fill="currentColor"/>
                                            </svg>
										</span>
                                            <!--end::Svg Icon-->
                                            <h3 class="fw-bolder m-0 text-gray-800"><?= date_i18n('M d, Y'); ?></h3>
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Card head-->
                                    <!--begin::Card body-->
                                    <div class="card-body">
                                        <!--begin::Tab Content-->
                                        <div class="tab-content">
                                            <!--begin::Tab panel-->
                                            <div id="kt_activity_today"
                                                 class="card-body p-0 tab-pane fade show active"
                                                 role="tabpanel" aria-labelledby="kt_activity_today_tab">
                                                <!--begin::Timeline-->
                                                <div class="timeline">
                                                    <?php
                                                    $type_icons = array(
                                                        'add_quote' => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                <rect x="0" y="0" width="24" height="24"/>
                                                                                <polygon fill="#000000" transform="translate(16.500000, 12.500000) rotate(-180.000000) translate(-16.500000, -12.500000) " points="19 7 17 13 19 13 19 18 14 18 14 13 16 7"/>
                                                                                <polygon fill="#000000" opacity="0.3" transform="translate(8.500000, 12.500000) rotate(-180.000000) translate(-8.500000, -12.500000) " points="11 7 9 13 11 13 11 18 6 18 6 13 8 7"/>
                                                                            </g>
                                                                        </svg>',
                                                        'edit_quote' => '<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                         height="24" viewBox="0 0 24 24" fill="none">
																		<path opacity="0.3"
                                                                              d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
                                                                              fill="currentColor"/>
																		<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
                                                                              fill="currentColor"/>
																	</svg>',
                                                        'delete_quote' => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                <rect x="0" y="0" width="24" height="24"/>
                                                                                <polygon fill="#000000" points="11 7 9 13 11 13 11 18 6 18 6 13 8 7"/>
                                                                                <polygon fill="#000000" opacity="0.3" points="19 7 17 13 19 13 19 18 14 18 14 13 16 7"/>
                                                                            </g>
                                                                        </svg>',
                                                        'add_user' => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                <polygon points="0 0 24 0 24 24 0 24"/>
                                                                                <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                                                <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                                                            </g>
                                                                        </svg>',
                                                        'delete_user' => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                <polygon points="0 0 24 0 24 24 0 24"/>
                                                                                <path d="M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z M21,8 L17,8 C16.4477153,8 16,7.55228475 16,7 C16,6.44771525 16.4477153,6 17,6 L21,6 C21.5522847,6 22,6.44771525 22,7 C22,7.55228475 21.5522847,8 21,8 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                                                <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                                                            </g>
                                                                        </svg>',
                                                        'change_status' => '<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                         height="24" viewBox="0 0 24 24" fill="none">
																		<path d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z"
                                                                              fill="currentColor"/>
																		<path opacity="0.3"
                                                                              d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z"
                                                                              fill="currentColor"/>
																		<path opacity="0.3"
                                                                              d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z"
                                                                              fill="currentColor"/>
																	</svg>',
                                                        'update_startdate' => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                        <rect x="0" y="0" width="24" height="24"/>
                                                                                        <path d="M8.43296491,7.17429118 L9.40782327,7.85689436 C9.49616631,7.91875282 9.56214077,8.00751728 9.5959027,8.10994332 C9.68235021,8.37220548 9.53982427,8.65489052 9.27756211,8.74133803 L5.89079566,9.85769242 C5.84469033,9.87288977 5.79661753,9.8812917 5.74809064,9.88263369 C5.4720538,9.8902674 5.24209339,9.67268366 5.23445968,9.39664682 L5.13610134,5.83998177 C5.13313425,5.73269078 5.16477113,5.62729274 5.22633424,5.53937151 C5.384723,5.31316892 5.69649589,5.25819495 5.92269848,5.4165837 L6.72910242,5.98123382 C8.16546398,4.72182424 10.0239806,4 12,4 C16.418278,4 20,7.581722 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 L6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,8.6862915 15.3137085,6 12,6 C10.6885336,6 9.44767246,6.42282109 8.43296491,7.17429118 Z" fill="#000000" fill-rule="nonzero"/>
                                                                                    </g>
                                                                                </svg>',
                                                        'sent_payment' => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                    <rect x="0" y="0" width="24" height="24"/>
                                                                                    <path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z" fill="#000000" opacity="0.3" transform="translate(11.500000, 12.000000) rotate(-345.000000) translate(-11.500000, -12.000000) "/>
                                                                                    <path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z M11.5,14 C12.6045695,14 13.5,13.1045695 13.5,12 C13.5,10.8954305 12.6045695,10 11.5,10 C10.3954305,10 9.5,10.8954305 9.5,12 C9.5,13.1045695 10.3954305,14 11.5,14 Z" fill="#000000"/>
                                                                                </g>
                                                                            </svg>',
                                                        'receive_payment' => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                    <rect x="0" y="0" width="24" height="24"/>
                                                                                    <path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z" fill="#000000" opacity="0.3" transform="translate(11.500000, 12.000000) rotate(-345.000000) translate(-11.500000, -12.000000) "/>
                                                                                    <path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z M11.5,14 C12.6045695,14 13.5,13.1045695 13.5,12 C13.5,10.8954305 12.6045695,10 11.5,10 C10.3954305,10 9.5,10.8954305 9.5,12 C9.5,13.1045695 10.3954305,14 11.5,14 Z" fill="#000000"/>
                                                                                </g>
                                                                            </svg>',
                                                        'mark_done' => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                <rect x="0" y="0" width="24" height="24"/>
                                                                                <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                                                                <path d="M16.7689447,7.81768175 C17.1457787,7.41393107 17.7785676,7.39211077 18.1823183,7.76894473 C18.5860689,8.1457787 18.6078892,8.77856757 18.2310553,9.18231825 L11.2310553,16.6823183 C10.8654446,17.0740439 10.2560456,17.107974 9.84920863,16.7592566 L6.34920863,13.7592566 C5.92988278,13.3998345 5.88132125,12.7685345 6.2407434,12.3492086 C6.60016555,11.9298828 7.23146553,11.8813212 7.65079137,12.2407434 L10.4229928,14.616916 L16.7689447,7.81768175 Z" fill="#000000" fill-rule="nonzero"/>
                                                                            </g>
                                                                        </svg>',
                                                        'upload_file' => '<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                         height="24" viewBox="0 0 24 24" fill="none">
																		<path d="M11.2166 8.50002L10.5166 7.80007C10.1166 7.40007 10.1166 6.80005 10.5166 6.40005L13.4166 3.50002C15.5166 1.40002 18.9166 1.50005 20.8166 3.90005C22.5166 5.90005 22.2166 8.90007 20.3166 10.8001L17.5166 13.6C17.1166 14 16.5166 14 16.1166 13.6L15.4166 12.9C15.0166 12.5 15.0166 11.9 15.4166 11.5L18.3166 8.6C19.2166 7.7 19.1166 6.30002 18.0166 5.50002C17.2166 4.90002 16.0166 5.10007 15.3166 5.80007L12.4166 8.69997C12.2166 8.89997 11.6166 8.90002 11.2166 8.50002ZM11.2166 15.6L8.51659 18.3001C7.81659 19.0001 6.71658 19.2 5.81658 18.6C4.81658 17.9 4.71659 16.4 5.51659 15.5L8.31658 12.7C8.71658 12.3 8.71658 11.7001 8.31658 11.3001L7.6166 10.6C7.2166 10.2 6.6166 10.2 6.2166 10.6L3.6166 13.2C1.7166 15.1 1.4166 18.1 3.1166 20.1C5.0166 22.4 8.51659 22.5 10.5166 20.5L13.3166 17.7C13.7166 17.3 13.7166 16.7001 13.3166 16.3001L12.6166 15.6C12.3166 15.2 11.6166 15.2 11.2166 15.6Z"
                                                                              fill="currentColor"/>
																		<path opacity="0.3"
                                                                              d="M5.0166 9L2.81659 8.40002C2.31659 8.30002 2.0166 7.79995 2.1166 7.19995L2.31659 5.90002C2.41659 5.20002 3.21659 4.89995 3.81659 5.19995L6.0166 6.40002C6.4166 6.60002 6.6166 7.09998 6.5166 7.59998L6.31659 8.30005C6.11659 8.80005 5.5166 9.1 5.0166 9ZM8.41659 5.69995H8.6166C9.1166 5.69995 9.5166 5.30005 9.5166 4.80005L9.6166 3.09998C9.6166 2.49998 9.2166 2 8.5166 2H7.81659C7.21659 2 6.71659 2.59995 6.91659 3.19995L7.31659 4.90002C7.41659 5.40002 7.91659 5.69995 8.41659 5.69995ZM14.6166 18.2L15.1166 21.3C15.2166 21.8 15.7166 22.2 16.2166 22L17.6166 21.6C18.1166 21.4 18.4166 20.8 18.1166 20.3L16.7166 17.5C16.5166 17.1 16.1166 16.9 15.7166 17L15.2166 17.1C14.8166 17.3 14.5166 17.7 14.6166 18.2ZM18.4166 16.3L19.8166 17.2C20.2166 17.5 20.8166 17.3 21.0166 16.8L21.3166 15.9C21.5166 15.4 21.1166 14.8 20.5166 14.8H18.8166C18.0166 14.8 17.7166 15.9 18.4166 16.3Z"
                                                                              fill="currentColor"/>
																	</svg>',
                                                        'accept_quote' => '<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                         height="24" viewBox="0 0 24 24" fill="none">
																		<path d="M6 8.725C6 8.125 6.4 7.725 7 7.725H14L18 11.725V12.925L22 9.725L12.6 2.225C12.2 1.925 11.7 1.925 11.4 2.225L2 9.725L6 12.925V8.725Z"
                                                                              fill="currentColor"/>
																		<path opacity="0.3"
                                                                              d="M22 9.72498V20.725C22 21.325 21.6 21.725 21 21.725H3C2.4 21.725 2 21.325 2 20.725V9.72498L11.4 17.225C11.8 17.525 12.3 17.525 12.6 17.225L22 9.72498ZM15 11.725H18L14 7.72498V10.725C14 11.325 14.4 11.725 15 11.725Z"
                                                                              fill="currentColor"/>
																	</svg>',
                                                        'canceled_project' => '<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                         height="24" viewBox="0 0 24 24" fill="none">
																		<path opacity="0.3"
                                                                              d="M5.78001 21.115L3.28001 21.949C3.10897 22.0059 2.92548 22.0141 2.75004 21.9727C2.57461 21.9312 2.41416 21.8418 2.28669 21.7144C2.15923 21.5869 2.06975 21.4264 2.0283 21.251C1.98685 21.0755 1.99507 20.892 2.05201 20.7209L2.886 18.2209L7.22801 13.879L10.128 16.774L5.78001 21.115Z"
                                                                              fill="currentColor"/>
																		<path d="M21.7 8.08899L15.911 2.30005C15.8161 2.2049 15.7033 2.12939 15.5792 2.07788C15.455 2.02637 15.3219 1.99988 15.1875 1.99988C15.0531 1.99988 14.92 2.02637 14.7958 2.07788C14.6717 2.12939 14.5589 2.2049 14.464 2.30005L13.74 3.02295C13.548 3.21498 13.4402 3.4754 13.4402 3.74695C13.4402 4.01849 13.548 4.27892 13.74 4.47095L14.464 5.19397L11.303 8.35498C10.1615 7.80702 8.87825 7.62639 7.62985 7.83789C6.38145 8.04939 5.2293 8.64265 4.332 9.53601C4.14026 9.72817 4.03256 9.98855 4.03256 10.26C4.03256 10.5315 4.14026 10.7918 4.332 10.984L13.016 19.667C13.208 19.859 13.4684 19.9668 13.74 19.9668C14.0115 19.9668 14.272 19.859 14.464 19.667C15.3575 18.77 15.9509 17.618 16.1624 16.3698C16.374 15.1215 16.1932 13.8383 15.645 12.697L18.806 9.53601L19.529 10.26C19.721 10.452 19.9814 10.5598 20.253 10.5598C20.5245 10.5598 20.785 10.452 20.977 10.26L21.7 9.53601C21.7952 9.44108 21.8706 9.32825 21.9221 9.2041C21.9737 9.07995 22.0002 8.94691 22.0002 8.8125C22.0002 8.67809 21.9737 8.54505 21.9221 8.4209C21.8706 8.29675 21.7952 8.18392 21.7 8.08899Z"
                                                                              fill="currentColor"/>
																	</svg>'
                                                    );
                                                    $activities = get_field('activities', $project_id);
                                                    $activities = array_reverse($activities);
                                                    foreach ($activities as $activity) {
                                                        $author_data = aireno_get_userdata($activity['user']);
                                                        $avatar = $author_data->avatar;
                                                        $author = $author_data->display_name;
                                                        $time = strtotime($activity['datetime']);
                                                        $timestr = date_i18n('M d, Y g:i:a', $time);
                                                        ?>
                                                        <!--begin::Timeline item-->
                                                        <div class="timeline-item">
                                                            <!--begin::Timeline line-->
                                                            <div class="timeline-line w-40px"></div>
                                                            <!--end::Timeline line-->
                                                            <!--begin::Timeline icon-->
                                                            <div class="timeline-icon symbol symbol-circle symbol-40px">
                                                                <div class="symbol-label bg-light">
                                                                    <!--begin::Svg Icon | path: icons/duotune/communication/com003.svg-->
                                                                    <span class="svg-icon svg-icon-2 svg-icon-gray-500">
                                                                <?= $type_icons[$activity['type']] ?>
                                                            </span>
                                                                    <!--end::Svg Icon-->
                                                                </div>
                                                            </div>
                                                            <!--end::Timeline icon-->
                                                            <!--begin::Timeline content-->
                                                            <div class="timeline-content mb-10 mt-n2">
                                                                <!--begin::Timeline heading-->
                                                                <div class="overflow-auto pe-3">
                                                                    <!--begin::Title-->
                                                                    <div class="fs-5 fw-bold mb-2"><?= $activity['content'] ?>
                                                                    </div>
                                                                    <!--end::Title-->
                                                                    <!--begin::Description-->
                                                                    <div class="d-flex align-items-center mt-1 fs-6">
                                                                        <!--begin::Info-->
                                                                        <div class="text-muted me-2 fs-7">Sent
                                                                            at <?= $timestr ?> by
                                                                        </div>
                                                                        <!--end::Info-->
                                                                        <!--begin::User-->
                                                                        <div class="symbol symbol-circle symbol-25px"
                                                                             data-bs-toggle="tooltip"
                                                                             data-bs-boundary="window"
                                                                             data-bs-placement="top"
                                                                             title="<?= $author ?>">
                                                                            <img alt="User" src="<?= $avatar ?>"/>
                                                                        </div>
                                                                        <!--end::User-->
                                                                    </div>
                                                                    <!--end::Description-->
                                                                </div>
                                                                <!--end::Timeline heading-->
                                                            </div>
                                                            <!--end::Timeline content-->
                                                        </div>
                                                        <!--end::Timeline item-->
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                                <!--end::Timeline-->
                                            </div>
                                            <!--end::Tab panel-->
                                        </div>
                                        <!--end::Tab Content-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Timeline-->
                            </div>
                            <!--End:Activity-->
                            <!--Begin:Contract-->
                            <div class="tab-pane fade show <?= $tab == 'project-contract' ? 'active' : '' ?>"
                                 id="project-contract" role="tabpanel">
                                <!--begin::Timeline-->
                                <div class="card">
                                    <!--begin::Card head-->
                                    <div class="card-header card-header-stretch">
                                        <!--begin::Title-->
                                        <div class="card-title d-flex align-items-center">
                                            <h3 class="fw-bolder m-0 text-gray-800">Project Contract</h3>
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Card head-->
                                    <!--begin::Card body-->
                                    <div class="card-body">
                                        <!--begin::Tab Content-->
                                        <div class="tab-content">
                                            <!--begin::Tab panel-->
                                            <div class="full_contract">
                                                <?php
                                                // $template_id = get_field('templates');
                                                $editor = get_field('contract', $project_id);

                                                /**
                                                 * foreach ($template_id as $t) {
                                                 *
                                                 * $scope_details = go_scope_details($t, $quote_id);
                                                 *
                                                 * $editor .= "<tr><td><h4>" . get_the_title($t) . "</h4></td></tr>";
                                                 *
                                                 * $quote_fields = get_field('quote_fields', $t);
                                                 * //print_r($quote_fields);
                                                 *
                                                 * $count = count($scope_details);
                                                 *
                                                 * foreach ($scope_details as $s) {
                                                 * $room = $s['room'];
                                                 * $details = $s['details'];
                                                 * if ($count > 1) {
                                                 * $editor .= "<tr><td><h4>" . $room . "</h4></td></tr>";
                                                 * }
                                                 *
                                                 * foreach ($details as $d) {
                                                 * $section_title = $d['section_title'];
                                                 * $section_details = $d['section_values'];
                                                 * $section_type = $d['section_type'];
                                                 *
                                                 * if ($section_type == 'flds') {
                                                 * $editor .= "<tr class='active'><td class='text-center'><h5>" . $section_title . "</h5></td></tr>";
                                                 * if (is_array($section_details)) {
                                                 * $s_title = preg_replace("/[^a-zA-Z]/", "", $section_title);
                                                 * $s_title = strtolower($s_title);
                                                 * foreach ($section_details as $v) {
                                                 * $title_flat = strpos($v, " x") ? substr($v, 0, strpos($v, " x")) : $v;
                                                 * if ($v != null) {
                                                 * $v_link = preg_replace("/[^a-zA-Z]/", "", $title_flat);
                                                 * $v_link = strtolower($v_link);
                                                 * $editor .= "<tr><td class='text-center'><strong>" . $v . "</strong></td>";
                                                 *
                                                 * // looking for description
                                                 * $count = count($quote_fields);
                                                 * $i = 1;
                                                 * while ($i <= $count) {
                                                 * if ($quote_fields[$i]['title'] == $section_title) {
                                                 * foreach ($quote_fields[$i]['fields'] as $field) {
                                                 * if ($field['title'] == $title_flat) {
                                                 * if ($field['description'] != '') {
                                                 * $editor .= "<td class='text-left'><em>" . $field['description'] . "</em></td>";
                                                 * } else {
                                                 * $editor .= "<td class='text-left'><em>N/A</em></td></tr>";
                                                 * }
                                                 * }
                                                 * }
                                                 * }
                                                 * $i++;
                                                 * }
                                                 * } else {
                                                 * $editor .= "";
                                                 * }
                                                 * }
                                                 * } else {
                                                 * $editor .= "<tr class='active'><td class='text-center'><strong>" . $section_details . "</strong></td>";
                                                 * // looking for description
                                                 * $count = count($quote_fields);
                                                 * $i = 1;
                                                 * while ($i <= $count) {
                                                 * if ($quote_fields[$i]['title'] == $section_title) {
                                                 *
                                                 * foreach ($quote_fields[$i]['fields'] as $field) {
                                                 * if ($field['title'] == $section_details) {
                                                 * if ($field['description'] != '') {
                                                 * $editor .= "<td><em>" . $field['description'] . "</em><td>";
                                                 * } else {
                                                 * $editor .= "<td><em>N/A</em></td></tr>";
                                                 * }
                                                 * }
                                                 * }
                                                 * }
                                                 * $i++;
                                                 * }
                                                 * }
                                                 * }
                                                 * }
                                                 * }
                                                 * }
                                                 */
                                                ?>
                                                <form
                                                        id="full_contract_form">
                                                    <?php
                                                    $settings = array(
                                                        'quicktags' => false,
                                                        'teeny' => true,
                                                        'editor_height' => 200,
                                                        'media_buttons' => false,
                                                        'textarea_name' => 'newContent'
                                                    );
                                                    wp_editor($editor, 'tiny_editor', $settings);
                                                    ?>
                                                </form>
                                            </div>
                                            <!--end::Tab panel-->
                                        </div>
                                        <!--end::Tab Content-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Timeline-->
                            </div>
                            <!--End:Contract-->
                            <?php
                            if (!$can_edit) {
                                ?>
                                <!--Begin:Review-->
                                <div class="tab-pane fade show <?= $tab == 'project-review' ? 'active' : '' ?>"
                                     id="project-review" role="tabpanel">
                                    <!--begin::Timeline-->
                                    <div class="card">
                                        <!--begin::Card head-->
                                        <div class="card-header card-header-stretch">
                                            <!--begin::Title-->
                                            <div class="card-title d-flex align-items-center">
                                                <h3 class="fw-bolder m-0 text-gray-800">Reviews</h3>
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Card head-->
                                        <!--begin::Card body-->
                                        <div class="card-body">
                                            <?php
                                            $reviews = aireno_get_project_reviews($project_id);
                                            foreach ($reviews as $review) {
                                            $reviewer_userdata = aireno_get_userdata($review['reviewer']);
                                            $receiver_userdata = aireno_get_userdata($review['receiver']);
                                            ?>
                                            <div class="mb-6 border-bottom pb-6">
                                                <h3 class="mb-2">Review for <?= $receiver_userdata->display_name ?></h3>
                                                <div class="rating mb-2">
                                                    <?php
                                                    for ($i = 1; $i <= 5; $i++) {
                                                        ?>
                                                        <div class="rating-label <?= $i <= $review['rating'] ? 'checked' : '' ?>">
                                                                <span class="svg-icon svg-icon-1">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                         height="24" viewBox="0 0 24 24" fill="none">
                                                                        <path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z"
                                                                              fill="currentColor"></path>
                                                                    </svg>
                                                                </span>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                    <div class="rating-label">
                                                        &nbsp;<?= number_format($review['rating'], 1) ?></div>
                                                </div>
                                                <div class="mb-2">
                                                    <?php
                                                    echo nl2br($review['content']);
                                                    ?>
                                                </div>
                                                <div class="d-flex flex-row align-items-center">
                                                    <div class="symbol-group symbol-hover me-3">
                                                        <a class="symbol symbol-circle me-3" target="_blank"
                                                           href="<?= get_author_posts_url($reviewer_userdata->id) ?>">
                                                            <img src="<?= $reviewer_userdata->avatar ?>"
                                                                 class="h-30px w-30px">
                                                            <span class="mb-0 fw-boldest"><?= $reviewer_userdata->display_name ?></span>
                                                        </a>
                                                    </div>
                                                    <p class="mb-0"><?= date_i18n('M, j Y', strtotime($review['date'])) ?></p>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Timeline-->
                                </div>
                                <!--End:Review-->
                                <?php
                            }
                            ?>
                        </div>
                        <!--End ::Tab content-->

                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Post-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->

<?php
if ($can_edit) {
    ?>
    <!--begin::Modal - Edit Project Name-->
    <div class="modal fade" id="kt_modal_edit_project_name" tabindex="-1"
         aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Form-->
                <form class="form" id="kt_modal_edit_project_name_form">
                    <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_edit_project_name_header">
                        <!--begin::Modal title-->
                        <h2>Edit Project Name</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div class="btn btn-sm btn-icon btn-active-color-primary"
                             data-bs-dismiss="modal">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1"> <svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137"
                                      width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)"
                                      fill="currentColor"/>
                                <rect x="7.41422" y="6" width="16"
                                      height="2" rx="1" transform="rotate(45 7.41422 6)"
                                      fill="currentColor"/>
                            </svg>
						</span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--end::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body py-10 px-lg-17">
                        <!--begin::Scroll-->
                        <div class="scroll-y me-n7 pe-7"
                             id="kt_modal_edit_project_name_scroll" data-kt-scroll="true"
                             data-kt-scroll-activate="{default: false, lg: true}"
                             data-kt-scroll-max-height="auto"
                             data-kt-scroll-dependencies="#kt_modal_new_address_header"
                             data-kt-scroll-wrappers="#kt_modal_edit_project_name_scroll"
                             data-kt-scroll-offset="300px">
                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-md-12 fv-row">
                                    <!--begin::Label-->
                                    <label class="required fs-5 fw-bold mb-2">Project name</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid"
                                           placeholder="" name="project-name"
                                           value="<?= $project_title ?>"/>
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Scroll-->
                    </div>
                    <!--end::Modal body-->
                    <!--begin::Modal footer-->
                    <div class="modal-footer flex-center">
                        <!--begin::Button-->
                        <button type="reset" id="kt_modal_edit_project_name_cancel"
                                class="btn btn-light me-3">Discard
                        </button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="submit" id="kt_modal_edit_project_name_submit"
                                class="btn btn-primary">
                            <span class="indicator-label">Save</span> <span
                                    class="indicator-progress">Please wait... <span
                                        class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Button-->
                    </div>
                    <!--end::Modal footer-->
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
    <!--end::Modal - Edit Project Name-->

    <!--begin::Modal - Project Address-->
    <div class="modal fade" id="kt_modal_edit_project_address" tabindex="-1"
         aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Form-->
                <form class="form" action="#" id="kt_modal_edit_project_address_form">
                    <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_edit_project_address_header">
                        <!--begin::Modal title-->
                        <h2>Edit Project Address</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div class="btn btn-sm btn-icon btn-active-color-primary"
                             data-bs-dismiss="modal">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1"> <svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137"
                                      width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)"
                                      fill="currentColor"/>
                                <rect x="7.41422" y="6" width="16"
                                      height="2" rx="1" transform="rotate(45 7.41422 6)"
                                      fill="currentColor"/>
                            </svg>
						</span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--end::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body py-10 px-lg-17">
                        <!--begin::Scroll-->
                        <div class="scroll-y me-n7 pe-7"
                             id="kt_modal_edit_project_address_scroll" data-kt-scroll="true"
                             data-kt-scroll-activate="{default: false, lg: true}"
                             data-kt-scroll-max-height="auto"
                             data-kt-scroll-dependencies="#kt_modal_edit_project_address_header"
                             data-kt-scroll-wrappers="#kt_modal_edit_project_address_scroll"
                             data-kt-scroll-offset="300px">
                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-md-12 fv-row">
                                    <!--begin::Label-->
                                    <label class="required fs-5 fw-bold mb-2">Project Address</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid"
                                           placeholder="" name="project_address"
                                           value="<?= $project_address ?>"/>
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Scroll-->
                    </div>
                    <!--end::Modal body-->
                    <!--begin::Modal footer-->
                    <div class="modal-footer flex-center">
                        <!--begin::Button-->
                        <button type="reset" id="kt_modal_edit_project_address_cancel"
                                class="btn btn-light me-3">Discard
                        </button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="submit" id="kt_modal_edit_project_address_submit"
                                class="btn btn-primary">
                            <span class="indicator-label">Save</span> <span
                                    class="indicator-progress">Please wait... <span
                                        class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Button-->
                    </div>
                    <!--end::Modal footer-->
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
    <!--end::Modal - Project Address-->

    <!--begin::Modal - Project Stage-->
    <div class="modal fade" id="kt_modal_edit_project_stage" tabindex="-1"
         aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Form-->
                <form class="form" action="#" id="kt_modal_edit_project_stage_form">
                    <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_edit_project_stage_header">
                        <!--begin::Modal title-->
                        <h2>Edit Project Address</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div class="btn btn-sm btn-icon btn-active-color-primary"
                             data-bs-dismiss="modal">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1"> <svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137"
                                      width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)"
                                      fill="currentColor"/>
                                <rect x="7.41422" y="6" width="16"
                                      height="2" rx="1" transform="rotate(45 7.41422 6)"
                                      fill="currentColor"/>
                            </svg>
						</span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--end::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body py-10 px-lg-17">
                        <!--begin::Scroll-->
                        <div class="scroll-y me-n7 pe-7"
                             id="kt_modal_edit_project_stage_scroll" data-kt-scroll="true"
                             data-kt-scroll-activate="{default: false, lg: true}"
                             data-kt-scroll-max-height="auto"
                             data-kt-scroll-dependencies="#kt_modal_edit_project_stage_header"
                             data-kt-scroll-wrappers="#kt_modal_edit_project_stage_scroll"
                             data-kt-scroll-offset="300px">
                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-md-12 fv-row">
                                    <!--begin::Label-->
                                    <label class="required fs-5 fw-bold mb-2">Project Stage</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select mb-2" name="stage"
                                            data-control="select2" data-hide-search="true"
                                            data-placeholder="Select an option">
                                        <option value="Ready To Start"
                                            <?= ($project_stage == 'Ready To Start') ? 'selected' : '' ?>>
                                            Ready To Start
                                        </option>
                                        <option value="Planning to Hire"
                                            <?= ($project_stage == 'Planning to Hire') ? 'selected' : '' ?>>
                                            Planning to Hire
                                        </option>
                                        <option value="Just budgeting"
                                            <?= ($project_stage == 'Just budgeting') ? 'selected' : '' ?>>
                                            Just budgeting
                                        </option>
                                        <option value="Project Started"
                                            <?= ($project_stage == 'Project Started') ? 'selected' : '' ?>>
                                            Project Started
                                        </option>
                                    </select>
                                    <!--end::Select2-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Scroll-->
                    </div>
                    <!--end::Modal body-->
                    <!--begin::Modal footer-->
                    <div class="modal-footer flex-center">
                        <!--begin::Button-->
                        <button type="reset" id="kt_modal_edit_project_stage_cancel"
                                class="btn btn-light me-3">Discard
                        </button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="submit" id="kt_modal_edit_project_stage_submit"
                                class="btn btn-primary">
                            <span class="indicator-label">Save</span> <span
                                    class="indicator-progress">Please wait... <span
                                        class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Button-->
                    </div>
                    <!--end::Modal footer-->
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
    <!--end::Modal - Project Stage-->

    <!--begin::Modal - Close Project-->
    <div class="modal fade" id="kt_modal_close_project" tabindex="-1"
         aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Form-->
                <form class="form" action="#" id="kt_modal_close_project_form">
                    <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_close_project_header">
                        <!--begin::Modal title-->
                        <h2>Are you sure you want to cancel this project?</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div class="btn btn-sm btn-icon btn-active-color-primary"
                             data-bs-dismiss="modal">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1"> <svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137"
                                      width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)"
                                      fill="currentColor"/>
                                <rect x="7.41422" y="6" width="16"
                                      height="2" rx="1" transform="rotate(45 7.41422 6)"
                                      fill="currentColor"/>
                            </svg>
						</span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--end::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body py-10 px-lg-17">
                        <!--begin::Scroll-->
                        <div class="scroll-y me-n7 pe-7">
                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Cancel reason-->
                                <div class="col-md-12 fv-row">
                                    <!--begin::Label-->
                                    <label class="required fs-5 fw-bold mb-2">Why are you cancelling
                                        this project?</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select mb-2" name="cancel_reason"
                                            data-control="select2" data-hide-search="true"
                                            data-placeholder="Select a reason">
                                        <option value="Found a better offer">Found a better offer</option>
                                        <option value="Just Budgeting">Just Budgeting</option>
                                        <option value="Circumstances have changed">Circumstances have
                                            changed
                                        </option>
                                        <option value="Out of Budget">Out of Budget</option>
                                        <option value="No Contract">No Contract</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <!--end::Select2-->
                                </div>
                                <!--end::Cancel reason-->
                                <!--begin::Comment-->
                                <div class="col-md-12 fv-row">
                                    <!--begin::Label-->
                                    <label class="required fs-5 fw-bold mb-2">Comments (optional)</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <textarea name="explained" class="form-control" rows="3"></textarea>
                                    <!--end::Select2-->
                                </div>
                                <!--end::Comment-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Scroll-->
                    </div>
                    <!--end::Modal body-->
                    <!--begin::Modal footer-->
                    <div class="modal-footer flex-center">
                        <!--begin::Button-->
                        <button type="reset" id="kt_modal_close_project_cancel"
                                class="btn btn-light me-3">Discard
                        </button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="submit" id="kt_modal_close_project_submit"
                                class="btn btn-primary">
                            <span class="indicator-label">Close Project</span> <span
                                    class="indicator-progress">Please wait... <span
                                        class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Button-->
                    </div>
                    <!--end::Modal footer-->
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
    <!--end::Modal - Close Project-->

    <!--begin::Modal - Project Date-->
    <div class="modal fade" id="kt_modal_edit_project_date" tabindex="-1"
         aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Form-->
                <form class="form" action="#" id="kt_modal_edit_project_date_form">
                    <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_edit_project_date_header">
                        <!--begin::Modal title-->
                        <h2>Change Project Date</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div class="btn btn-sm btn-icon btn-active-color-primary"
                             data-bs-dismiss="modal">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1"> <svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137"
                                      width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)"
                                      fill="currentColor"/>
                                <rect x="7.41422" y="6" width="16"
                                      height="2" rx="1" transform="rotate(45 7.41422 6)"
                                      fill="currentColor"/>
                            </svg>
						</span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--end::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body py-10 px-lg-17">
                        <!--begin::Scroll-->
                        <div class="scroll-y me-n7 pe-7"
                             id="kt_modal_edit_project_date_scroll" data-kt-scroll="true"
                             data-kt-scroll-activate="{default: false, lg: true}"
                             data-kt-scroll-max-height="auto"
                             data-kt-scroll-dependencies="#kt_modal_edit_project_date_header"
                             data-kt-scroll-wrappers="#kt_modal_edit_project_date_scroll"
                             data-kt-scroll-offset="300px">
                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-md-12 fv-row">
                                    <!--begin::Label-->
                                    <label class="required fs-5 fw-bold mb-2">Project Date Start</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control form-control-solid" placeholder=""
                                           name="date_start" value="<?= $project_date ?>"/>
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Scroll-->
                    </div>
                    <!--end::Modal body-->
                    <!--begin::Modal footer-->
                    <div class="modal-footer flex-center">
                        <!--begin::Button-->
                        <button type="reset" id="kt_modal_edit_project_date_cancel"
                                class="btn btn-light me-3">Discard
                        </button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="submit" id="kt_modal_edit_project_date_submit"
                                class="btn btn-primary">
                            <span class="indicator-label">Save</span> <span
                                    class="indicator-progress">Please wait... <span
                                        class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Button-->
                    </div>
                    <!--end::Modal footer-->
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
    <!--end::Modal - Project Date-->

    <!--begin::Modal - No Contact Close Project-->
    <div class="modal fade" id="kt_modal_no_contact_close_project"
         tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Form-->
                <form class="form" action="#"
                      id="kt_modal_no_contact_close_project_form">
                    <!--begin::Modal header-->
                    <div class="modal-header"
                         id="kt_modal_no_contact_close_project_header">
                        <!--begin::Modal title-->
                        <h2>Are you sure you want to close this project because of No
                            Contact?</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div class="btn btn-sm btn-icon btn-active-color-primary"
                             data-bs-dismiss="modal">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1"> <svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137"
                                      width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)"
                                      fill="currentColor"/>
                                <rect x="7.41422" y="6" width="16"
                                      height="2" rx="1" transform="rotate(45 7.41422 6)"
                                      fill="currentColor"/>
                            </svg>
						</span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--end::Modal header-->
                    <!--begin::Modal footer-->
                    <div class="modal-footer flex-center">
                        <!--begin::Button-->
                        <button type="reset" id="kt_modal_no_contact_close_project_cancel"
                                class="btn btn-light me-3">Cancel
                        </button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="submit" id="kt_modal_no_contact_close_project_submit"
                                class="btn btn-danger">
                            <span class="indicator-label">Yes</span> <span
                                    class="indicator-progress">Please wait... <span
                                        class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Button-->
                    </div>
                    <!--end::Modal footer-->
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
    <!--end::Modal - No Contact Close Project-->

    <!--begin::Modal - New User-->
    <div class="modal fade" id="kt_modal_new_target" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-550px">
            <!--begin::Modal content-->
            <div class="modal-content rounded">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 position-relative justify-content-end">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary position-absolute"
                         style="top:15px;z-index:10;" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                          transform="rotate(-45 6 17.3137)" fill="currentColor"/>
									<rect x="7.41422" y="6" width="16" height="2" rx="1"
                                          transform="rotate(45 7.41422 6)" fill="currentColor"/>
								</svg>
							</span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y pt-0">
                    <!--begin:Search Form-->
                    <form id="kt_modal_search_user_form" class="form" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="aireno_search_users">
                        <!--begin::Heading-->
                        <div class="mb-5 text-center">
                            <!--begin::Title-->
                            <h1 class="mb-3">Search Users</h1>
                            <!--end::Title-->
                            <!--begin::Description-->
                            <div class="text-muted fw-bold fs-5">
                                Search users by their emails or phones.
                            </div>
                            <!--end::Description-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-5 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Email or Phone</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                   title="Specify the user's email or phone number"></i>
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-solid" placeholder="Email or Phone"
                                   name="email_or_phone"/>
                        </div>
                        <!--end::Input group-->
                        <!--Begin:Search Result-->
                        <div class="d-flex d-none mb-5" id="kt_modal_search_user_form_result"></div>
                        <!--End:Search Result-->

                        <!--Begin:Search Result Template-->
                        <div class="result-item p-3 border border-danger border-dashed rounded d-flex w-100 justify-content-between flex-row d-none mb-3 cursor-pointer"
                             data-kt-element="template">
                            <div class="d-flex">
                                <div class="me-3">
                                    <img class="h-50px"
                                         src=""
                                         alt="avatar"/>
                                </div>
                                <div class="d-flex flex-column justify-content-around me-3">
                                    <div class="d-flex flex-row">
                                    <span class="fw-boldest fs-4 me-3"
                                          data-kt-element="display_name">Vasile Darmaz</span>
                                    </div>
                                    <span class="fw-bolder" data-kt-element="email">vasiledarmaz0025@hotmail.com</span>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="me-3">
                                    <select class="form-select" data-control="select2222" data-hide-search="true"
                                            data-placeholder="Select a type">
                                        <option value="Client">Client</option>
                                        <option value="Contractor">Contractor</option>
                                        <option value="Supplier">Supplier</option>
                                        <option value="Designer">Designer</option>
                                        <option value="Planner">Planner</option>
                                    </select>
                                </div>
                                <div class="">
                                    <a class="btn btn-danger btnAddMember" href="javascript:void(0)">Add</a>
                                </div>
                            </div>
                        </div>
                        <!--End:Search Result Template-->

                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="submit" id="kt_modal_search_user_form_submit" class="btn btn-danger">
                                <span class="indicator-label">Search</span>
                                <span class="indicator-progress">Please wait...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end:Search Form-->
                    <!--begin:Register Form-->
                    <form id="kt_modal_new_target_form" class="form d-none" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="aireno_register_client">
                        <input type="hidden" name="project_id" value="<?=$project_id?>" />
                        <!--begin::Heading-->
                        <div class="mb-13 text-center">
                            <!--begin::Title-->
                            <h1 class="mb-3">Add New User</h1>
                            <!--end::Title-->
                            <!--begin::Description-->
                            <div class="text-muted fw-bold fs-5">The user will receive the account information via
                                E-mail.
                            </div>
                            <!--end::Description-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Input group-->
                        <div class="row g-9 mb-8">
                            <div class="col-md-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Full Name</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                       title="Specify the user's full name"></i>
                                </label>
                                <!--end::Label-->
                                <input type="text" class="form-control form-control-solid" placeholder="Full Name"
                                       name="display_name"/>
                            </div>
                            <div class="col-md-4 fv-row">
                                <label class="required fs-6 fw-bold mb-2">User Role</label>
                                <select name="user_role"
                                        class="form-control form-control-solid form-select">
                                    <option value="Client">Client</option>
                                    <option value="Partner">Partner</option>
                                    <option value="Designer">Designer</option>
                                    <option value="Supplier">Supplier</option>
                                    <option value="Business">Business</option>
                                    <option value="Contractor">Contractor</option>
                                    <option value="Planner">Planner</option>
                                </select>
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row g-9 mb-8">
                            <!--begin::Col-->
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-bold mb-2">Mobile Number</label>
                                <input type="tel" class="form-control form-control-solid" placeholder="Mobile Number"
                                       name="phone"/>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-bold mb-2">E-Mail</label>
                                <!--begin::Input-->
                                <input type="email" class="form-control form-control-solid" placeholder="E-mail"
                                       name="email"/>
                                <!--end::Input-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-danger">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>

                            <button type="button" id="kt_modal_new_target_search" class="btn btn-success">
                                Back to Search
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end:Register Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - New User-->
    <?php
}
?>
    <!--begin::Modal - project addons-->
    <div class="modal fade" id="kt_modal_edit_project_addons" tabindex="-1"
         aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Form-->
                <form class="form" id="kt_modal_edit_project_addons_form">
                    <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_edit_project_addons_header">
                        <!--begin::Modal title-->
                        <h2>Choose Project Addons</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div class="btn btn-sm btn-icon btn-active-color-primary"
                             data-bs-dismiss="modal">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1"> <svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137"
                                      width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)"
                                      fill="currentColor"/>
                                <rect x="7.41422" y="6" width="16"
                                      height="2" rx="1" transform="rotate(45 7.41422 6)"
                                      fill="currentColor"/>
                            </svg>
						</span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--end::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body py-10 px-lg-17">
                        <?php echo do_shortcode('[products category="project-addons" columns="3"]');?>
                    </div>
                    <!--end::Modal body-->
                    <!--begin::Modal footer-->
                    <div class="modal-footer flex-center">
                        <a class="btn btn-default" data-bs-dismiss="modal">Cancel</a>
                        <a class="btn btn-danger">View Cart</a>
                    </div>
                    <!--end::Modal footer-->
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
    <!--end::Modal - Edit Project addons-->

    <!--begin::Modal - Add File Upload-->
    <div class="modal fade" id="kt_modal_file_upload" tabindex="-1"
         aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <form class="form" enctype="multipart/form-data" id="kt_modal_file_upload_form">
                    <!--begin::Modal header-->
                    <div class="modal-header pb-0 border-0 justify-content-end">
                        <!--begin::Close-->
                        <div class="btn btn-sm btn-icon btn-active-color-primary"
                             data-bs-dismiss="modal">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1"> <svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137"
                                  width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)"
                                  fill="currentColor"/>
                            <rect x="7.41422" y="6" width="16"
                                  height="2" rx="1" transform="rotate(45 7.41422 6)"
                                  fill="currentColor"/>
                        </svg>
					</span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--begin::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                        <!--begin::Heading-->
                        <div class="text-center mb-7">
                            <!--begin::Title-->
                            <h1 class="mb-3">Upload File(s)</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin:image category field-->
                        <div class="w-100">
                            <select class="form-select mb-1 cursor-pointer"
                                    name="type">
                                <?php
                                foreach (AIRENO_FILE_TYPES as $key => $name) {
                                    echo '<option value="' . $key . '">' . $name . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <!--end:image category field-->
                        <!--begin:image preview-->
                        <div class="w-100 mb-3" id="kt_modal_file_upload_form_previews">
                            <div class="d-none position-relative flex-stack border-dotted border-1 w-100 d-flex p-2 my-3 rounded-10px"
                                 data-kt-element="preview-template">
                                <div class="d-flex justify-content-start align-items-center">
                                    <img src="" alt="" class="h-50px w-auto mw-200px" height="auto"/>
                                    <span class="d-none for-img">
                                        <i class="bi bi-card-text fs-4hx"></i>
                                    </span>
                                    <div class="d-inline-block ms-5">
                                        <span class="d-block img-title">title.png</span>
                                        <span class="d-block img-size">234.4KB</span>
                                    </div>
                                </div>
                                <a class="fu-remove" href="javascript:void(0)" data-file-id="">
                                    <i class="bi bi-x-lg text-danger fs-2 fw-bolder"></i>
                                </a>
                            </div>
                        </div>
                        <!--end:image preview-->
                        <div class="cursor-pointer border-dashed border-2 px-5 py-4 rounded filter-trigger">
                            <!--begin::file trigger-->
                            <div class="cursor-pointer text-left d-flex">
                                <!--begin::Icon-->
                                <!--begin::Svg Icon | path: icons/duotune/files/fil010.svg-->
                                <span class="svg-icon svg-icon-3hx svg-icon-primary"> <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24" viewBox="0 0 24 24"
                                            fill="none">
                                                                    <path
                                                                            opacity="0.3"
                                                                            d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM14.5 12L12.7 9.3C12.3 8.9 11.7 8.9 11.3 9.3L10 12H11.5V17C11.5 17.6 11.4 18 12 18C12.6 18 12.5 17.6 12.5 17V12H14.5Z"
                                                                            fill="currentColor"></path>
                                                                    <path
                                                                            d="M13 11.5V17.9355C13 18.2742 12.6 19 12 19C11.4 19 11 18.2742 11 17.9355V11.5H13Z"
                                                                            fill="currentColor"></path>
                                                                    <path
                                                                            d="M8.2575 11.4411C7.82942 11.8015 8.08434 12.5 8.64398 12.5H15.356C15.9157 12.5 16.1706 11.8015 15.7425 11.4411L12.4375 8.65789C12.1875 8.44737 11.8125 8.44737 11.5625 8.65789L8.2575 11.4411Z"
                                                                            fill="currentColor"></path>
                                                                    <path
                                                                            d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z"
                                                                            fill="currentColor"></path>
                                                                </svg>
															</span>
                                <!--end::Svg Icon-->
                                <!--end::Icon-->
                                <!--begin::Info-->
                                <div class="ms-4 text-left">
                                    <h3 class="dfs-6 fs-6 fw-bolder text-gray-900 mb-1">
                                        Click here to choose file(s).</h3>
                                    <span class="fw-bold fs-7 text-muted">Choose up to 10 files</span>
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::file trigger-->
                        </div>
                        <input type="file" class="d-none" id="kt_modal_file_upload_form_file"
                               multiple
                               accept=".xlsx, .xls, .csv, .pdf , image/*, .doc, .docx, .txt, image/heic">
                    </div>
                    <!--end::Modal body-->
                    <div class="modal-footer d-flex flex-center">
                        <!--begin::Actions-->
                        <button type="reset" id="kt_modal_file_upload_form_cancel"
                                data-bs-dismiss="modal" class="btn btn-active-light me-3">Cancel
                        </button>
                        <button type="submit" id="kt_modal_file_upload_form_submit"
                                class="btn btn-primary">Upload
                        </button>
                        <!--end::Actions-->
                    </div>
                </form>
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Add File UPload-->

    <!--begin::Modal - View Invoice Modal-->
    <div class="modal fade" id="kt_modal_view_invoice" tabindex="-1"
         aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <form class="form" enctype="multipart/form-data" id="kt_modal_view_invoice_form">
                    <!--begin::Modal header-->
                    <div class="modal-header pb-7 border-1 mb-7">
                        <!--begin::Heading-->
                        <div class="d-flex">
                            <!--begin::Title-->
                            <h1>Invoice</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Close-->
                        <div class="btn btn-sm btn-icon btn-active-color-primary"
                             data-bs-dismiss="modal">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1"> <svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137"
                                  width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)"
                                  fill="currentColor"/>
                            <rect x="7.41422" y="6" width="16"
                                  height="2" rx="1" transform="rotate(45 7.41422 6)"
                                  fill="currentColor"/>
                        </svg>
					</span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--begin::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body scroll-y pt-0 pb-15">
                        <!--begin:Company Name, Address-->
                        <div class="w-100 mb-5 text-end">
                            <p class="fw-bolder mb-1" data-kt-element="business_name">Sender Company Name</p>
                            <p class="fw-bolder mb-1" data-kt-element="business_abn">Sender Company ABN</p>
                            <p class="fw-bolder mb-1" data-kt-element="business_address">Sender Company Address</p>
                        </div>
                        <!--end:Type & DateTime-->
                        <!--Begin:Payment Details-->
                        <div class="w-100 mb-5">
                            <p class="mb-1">Dear <span class="fw-bolder" data-kt-element="user_display_name">Client(email)</span>,
                            </p>
                            <p class="mb-0">Here is your payment details.</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="d-flex flex-column">
                                <p class="mb-0">Project ID</p>
                                <p class="fw-bolder" data-kt-element="project_id_of_payment">#123434</p>
                            </div>
                            <div class="d-flex flex-column">
                                <p class="mb-0">Payment ID</p>
                                <p class="fw-bolder" data-kt-element="invoice_of_payment">#INV-123434</p>
                            </div>
                        </div>
                        <div class="table-responsive mb-5">
                            <table class="w-100 table table-bordered">
                                <tr>
                                    <td class="py-1">
                                        <div class="d-flex flex-column text-start">
                                            <p class="mb-0 fw-bolder" data-kt-element="title_of_payment">Milestone 1</p>
                                            <p class="mb-0" data-kt-element="detail_of_payment">This is first milestone
                                                of this project.</p>
                                        </div>
                                    </td>
                                    <td class="text-end fw-bolder py-1" style="vertical-align: bottom;"
                                        data-kt-element="amount_of_payment">
                                        $250
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-end py-1">
                                        GST(10%)
                                    </td>
                                    <td class="text-end fw-bolder py-1" data-kt-element="gst_of_payment">
                                        $25
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-end fw-bolder py-1">
                                        Grand Total
                                    </td>
                                    <td class="text-end fw-boldest py-1" data-kt-element="grand_of_payment">
                                        $275
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="mb-5">
                            <p class="mb-1 fw-bolder">
                                Payment Instructions
                            </p>
                            <p data-kt-element="business_payment_instructions">
                                Business Payment Instructions
                            </p>
                        </div>
                        <div class="mb-10">
                            <p class="mb-1 fw-bolder">
                                Payment Details
                            </p>
                            <p data-kt-element="business_payment_details">
                                Business Payment Details
                            </p>
                        </div>
                        <!--End:Payment Details-->

                        <!--Begin:Action buttons-->
                        <div class="d-flex justify-content-between">
                            <!--begin::Actions-->
                            <button type="button" id="kt_modal_view_invoice_form_print"
                                    class="btn btn-success me-3" data-payment-id="">Print Invoice
                            </button>
                            <button type="button" id="kt_modal_view_invoice_form_pay"
                                    class="btn btn-primary">Mark as Paid
                            </button>
                            <!--end::Actions-->
                        </div>
                        <!--End:Action buttons-->
                    </div>
                    <!--end::Modal body-->

                </form>
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - View Invoice Modal-->

    <!--begin::Modal - View User Details Modal-->
    <div class="modal fade" id="kt_modal_view_user" tabindex="-1"
         aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog mw-500px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header pb-7 border-1 mb-7">
                    <!--begin::Heading-->
                    <div class="d-flex">
                        <!--begin::Title-->
                        <h1>User Detail</h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary"
                         data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1"> <svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137"
                                  width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)"
                                  fill="currentColor"/>
                            <rect x="7.41422" y="6" width="16"
                                  height="2" rx="1" transform="rotate(45 7.41422 6)"
                                  fill="currentColor"/>
                        </svg>
					</span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y pt-0 pb-7">
                    <!--begin:User Details-->
                    <div class="w-100 mb-5 d-flex flex-row align-items-center justify-content-center">
                        <div class="d-flex me-3">
                            <div class="symbol symbol-75px">
                                <img src="" alt="User" data-kt-element="user-avatar">
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            <div class="fw-bolder d-flex align-items-center fs-5" data-kt-element="user-display-name">
                                display name
                            </div>
                            <a href="javascript:void(0)"
                               class="d-flex align-items-center text-gray-700 fw-bolder text-hover-primary">
                                <span class="svg-icon svg-icon-4 me-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none">
                                        <path opacity="0.3"
                                              d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z"
                                              fill="currentColor"></path>
                                        <path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z"
                                              fill="currentColor"></path>
                                    </svg>
                                </span>
                                <span data-kt-element="user-email"></span>
                            </a>
                            <a href="javascript:void(0)"
                               class="d-flex align-items-center text-gray-700 fw-bolder text-hover-primary">
                                <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                <span class="svg-icon svg-icon-4 me-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none">
                                        <path opacity="0.3"
                                              d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z"
                                              fill="currentColor"></path>
                                        <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z"
                                              fill="currentColor"></path>
                                    </svg>
                                </span>
                                <span data-kt-element="user-phone"></span>
                            </a>
                            <a href="javascript:void(0)"
                               class="d-flex align-items-center text-gray-700 fw-bolder text-hover-primary">
                                <span class="svg-icon svg-icon-4 me-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none">
                                        <path opacity="0.3"
                                              d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z"
                                              fill="currentColor"></path>
                                        <path d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
                                              fill="currentColor"></path>
                                    </svg>
                                </span>
                                <span data-kt-element="user-address"></span>
                            </a>
                        </div>
                    </div>
                    <!--end:User Details-->
                    <div class="d-flex justify-content-center mb-7">
                        <a href="javascript:void(0)" class="btn btn-secondary text-primary"
                           data-kt-element="user-profile">View Full Profile</a>
                    </div>
                    <div class="d-flex justify-content-center">
                        <!--begin::Actions-->
                        <button type="button" id="kt_modal_view_user_cancel"
                                class="btn btn-success me-3">Close
                        </button>
                        <!--end::Actions-->
                    </div>
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - View User Details Modal-->

    <!--begin::Modal - Delete Project-->
    <div class="modal fade" id="kt_modal_delete_project" tabindex="-1"
         aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Form-->
                <form class="form" action="#" id="kt_modal_delete_project_form">
                    <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_delete_project_header">
                        <!--begin::Modal title-->
                        <h2>Are you sure you want to delete this project?</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div class="btn btn-sm btn-icon btn-active-color-primary"
                             data-bs-dismiss="modal">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1"> <svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137"
                                      width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)"
                                      fill="currentColor"/>
                                <rect x="7.41422" y="6" width="16"
                                      height="2" rx="1" transform="rotate(45 7.41422 6)"
                                      fill="currentColor"/>
                            </svg>
						</span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--end::Modal header-->
                    <!--begin::Modal footer-->
                    <div class="modal-footer flex-center">
                        <!--begin::Button-->
                        <button type="reset" id="kt_modal_delete_project_cancel"
                                class="btn btn-light me-3">Cancel
                        </button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="submit" id="kt_modal_delete_project_submit"
                                class="btn btn-danger">
                            <span class="indicator-label">Yes, Delete Project</span> <span
                                    class="indicator-progress">Please wait... <span
                                        class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Button-->
                    </div>
                    <!--end::Modal footer-->
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
    <!--end::Modal - Delete Project-->
<?php
get_footer('blank');