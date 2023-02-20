<?php
/**
 * Template Name: Add Quote Page
 *
 * @package WordPress
 * @subpackage Aireno
 * @since Aireno 1.0
 */
$quote_id = intval($_GET['q']);
if (!$quote_id || ($quote_id && get_post($quote_id)->post_type != 'template')) //
{
    wp_safe_redirect(aireno_get_page_link_by_name('quotes'));
    exit;
} else {
    if (!is_user_logged_in()) {
        $redirect_args = array();
        foreach ($_GET as $key => $val) {
            $redirect_args[$key] = $val;
        }
        wp_safe_redirect(
            add_query_arg(
                array(
                    'redirect' => wp_sanitize_redirect(
                        urlencode(
                            base64_encode(
                                add_query_arg(
                                    $redirect_args,
                                    aireno_get_page_link_by_name('add-quote')
                                )
                            )
                        )
                    )
                ),
                aireno_get_page_link_by_name('login')
            )
        );
    }
}
get_header('full');

$templateId = $quote_id;
$project_id = isset($_REQUEST['project_id']) ? intval($_REQUEST['project_id']) : 0;

$templateName = get_the_title($templateId);
$projectName = isset($_POST['project_id']) ? get_post($project_id)->post_title : $templateName;

$user_id = get_current_user_id();

if (is_business($user_id) && !pmpro_hasMembershipLevel(null, $user_id)) {
    ?>
<style>
.input-group > .select2-container--bootstrap {
    width: auto;
    flex: 1 1 auto;
}

.input-group > .select2-container--bootstrap .select2-selection--single {
    height: 100%;
    line-height: inherit;
    padding: 0.5rem 1rem;
}
</style>
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="w-100 container-fluid">
                <div class="card mb-7">
                    <div class="card-body">
                        <h2 class="mb-5">Purchase your membership to use our powerful quoting system.</h2>
                        <a class="btn btn-danger" href="<?= get_site_url() ?>/#pricing">Purchase Membership</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    ?>
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="w-100 container-fluid">
                <!--begin::Quoting Form-->
                <div class="stepper stepper-pills stepper-column d-flex flex-row flex-row-fluid between"
                     id="kt_quoting_form_stepper">
                    <!--begin::stepper-->
                    <div class="card d-flex justify-content-center justify-content-xl-start flex-row-auto me-3">
                        <!--begin::Wrapper-->
                        <div class="card-body px-5 py-5">
                            <!--begin::Nav-->
                            <div class="stepper-nav">
                                <?php
                                $index = 1;
                                if (!$project_id) {
                                    ?>
                                    <!--begin::Step brief-->
                                    <div class="stepper-item current" data-kt-stepper-element="nav">
                                        <!--begin::Line-->
                                        <div class="stepper-line w-40px"></div>
                                        <!--end::Line-->
                                        <!--begin::Icon-->
                                        <div class="stepper-icon w-40px h-40px">
                                            <i class="stepper-check fas fa-check"></i>
                                            <span class="stepper-number"><?= $index ?></span>
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Label-->
                                        <div class="stepper-label">
                                            <h3 class="stepper-title">Brief</h3>
                                        </div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Step brief-->
                                    <?php
                                    $index++;
                                }

                                if (have_rows('quote_fields', $templateId)) {
                                    $idx = 0;
                                    while (have_rows('quote_fields', $templateId)) : the_row();
                                        ?>
                                        <!--begin::Step Item-->
                                        <div class="stepper-item <?= $index == 1 ? 'current' : '' ?>"
                                             data-kt-stepper-element="nav">
                                            <!--begin::Line-->
                                            <div class="stepper-line w-40px"></div>
                                            <!--end::Line-->
                                            <!--begin::Icon-->
                                            <div class="stepper-icon w-40px h-40px">
                                                <i class="stepper-check fas fa-check"></i>
                                                <span class="stepper-number"><?= $index ?></span>
                                            </div>
                                            <!--end::Icon-->
                                            <!--begin::Label-->
                                            <div class="stepper-label">
                                                <h3 class="stepper-title"><?= get_sub_field('title') ?></h3>
                                            </div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Step Item-->
                                        <?php
                                        $index++;
                                    endwhile;

                                    $autoSuggestions = [];
                                    $autoSuggestions = get_field('master_sheet', 'option');

                                    if (get_field('display_repeater', $templateId) && (is_business($user_id) || is_head($user_id))
                                        && is_array($autoSuggestions) && count($autoSuggestions) > 0) {
                                        ?>
                                        <!--begin::Step Repeater-->
                                        <div class="stepper-item" data-kt-stepper-element="nav">
                                            <!--begin::Line-->
                                            <div class="stepper-line w-40px"></div>
                                            <!--end::Line-->
                                            <!--begin::Icon-->
                                            <div class="stepper-icon w-40px h-40px">
                                                <i class="stepper-check fas fa-check"></i>
                                                <span class="stepper-number"><?= $index ?></span>
                                            </div>
                                            <!--end::Icon-->
                                            <!--begin::Label-->
                                            <div class="stepper-label">
                                                <h3 class="stepper-title">Custom</h3>
                                            </div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Step Repeater-->
                                        <?php
                                        $index++;
                                    }
                                }
                                ?>
                            </div>
                            <!--end::Nav-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::stepper-->

                    <!--end::Begin Form Container-->
                    <div class="card d-flex flex-row-fluid flex-center h-100">
                        <!--begin::Form-->
                        <form class="card-body py-5 px-5 h-100" novalidate="novalidate" id="kt_quoting_form">
                            <input type="hidden" name="action" value="aireno_finish_quote">
                            <input type="hidden" name="templateId" value="<?= $quote_id ?>">
                            <input type="hidden" name="project_id" value="<?= $project_id ?>">
                            <?php
                            if (isset($_REQUEST['b']) && is_business($_REQUEST['b'])) {
                                ?>
                                <input type="hidden" name="business_id" value="<?= $_REQUEST['b'] ?>"/>
                                <?php
                            }
                            ?>
                            <!--begin::Form Sub Container-->
                            <div class="form-container h-100">
                                <!--begin::Form Header-->
                                <div class="form-header d-flex justify-content-between flex-row pb-5">
                                   <div class="input-group me-5">
                                    <span class="input-group-text bg-light-primary"><i class="fa-regular text-primary fa-tag"></i></span>
                                    <input type="text" name="projectName" placeholder="Project Name"
                                           value="<?= $projectName ?>" class="form-control fw-bolder text-dark"/>
                                   </div>
                                     <div id="total-quote"
                                         class="quoting-price border border-danger border-dashed bg-light-danger text-danger">$0
                                    </div>
                                    <input type="hidden" name="total_price" value=""/>
                                </div>
                                <!--begin::Form Header-->
                                <!--begin::Form Steps-->
                                <div class="kt-quoting-steps">
                                    <?php
                                    $index = 1;
                                    if (!$project_id) {
                                        ?>
                                        <!--begin::Step brief-->
                                        <div class="current kt-quoting-step kt-brief-step"
                                             data-kt-stepper-element="content">
                                            <!--begin::Wrapper-->
                                            <div class="w-100">
                                                <!--begin::Heading-->
                                                <div class="pb-10">
                                                    <!--begin::Title-->
                                                    <h2 class="fw-bolder d-flex align-items-center text-dark">Project
                                                        Information
                                                    </h2>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Heading-->
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <div class="col-md-6 col-xs-12 pb-5 fv-row">
                                                      <label for="zipcode_picker" class="form-label required">Project
                                                            Address</label>
                                                      <div class="input-group">
                                                        <span class="input-group-text bg-light-primary"><i class="fa-regular text-primary fa-location-dot"></i></span>
                                                        <input class="form-control kt-require" type="text"
                                                               id="zipcode_picker"
                                                               name="zipcode"
                                                               required placeholder="Project Address" value=""/>
                                                            </div>

                                                    </div>
                                                    <div class="col-md-6 col-xs-12 pb-5 fv-row">
                                                        <!--begin::Input group-->
                                                        <!--begin::Label-->
                                                        <label class="required form-label">Project Stage</label>
                                                        <!--end::Label-->
                                                        <!--begin::Select2-->
                                                        <select class="form-select mb-2" name="stage"
                                                                data-control="select2" data-hide-search="true"
                                                                data-placeholder="Select an option">
                                                            <option value="Ready To Start">Ready To Start</option>
                                                            <option value="Planning to Hire">Planning to Hire</option>
                                                            <option value="Just budgeting">Just budgeting</option>
                                                            <option value="Project Started">Project Started</option>
                                                        </select>
                                                        <!--end::Select2-->
                                                        <!--end::Input group-->
                                                    </div>
                                                    <div class="col-md-6 col-xs-12 pb-5 fv-row">
                                                        <label for="date_start_picker" class="form-label required">Start
                                                            Date</label>
                                                       <div class="input-group">
                                                        <span class="input-group-text bg-light-primary"><i class="fa-light text-primary fa-calendar-days"></i></span>
                                                        <input class="form-control kt-require" id="date_start_picker"
                                                               name="date_start" required
                                                               placeholder="Pick a start date"
                                                               value="<?= date_i18n('Y-m-d') ?>"/>
                                                      </div>
                                                    </div>
                                                    <?php
                                                    if (is_business($user_id) || is_head($user_id)) {
                                                        $contacts = aireno_get_contacts($user_id);
                                                        ?>
                                                        <div class="col-md-6 col-xs-12 pb-5 fv-row">
                                                            <label class="form-label">Add client (optional)
                                                            <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                           data-bs-toggle="tooltip" title="You can assign a client at any point, even after you setup your quote."></i>
                                                           </label>
                                                            <select class="form-select mb-5" data-allow-clear="true" data-hide-search="false" name="client"
                                                                    data-control="select2"
                                                                    data-placeholder="Select a Client">
                                                                <option value=""></option>
                                                                <?php
                                                                foreach ($contacts as $contact) {
                                                                    $client_data = get_userdata($contact);
                                                                    $first_client_name = $client_data->first_name;
                                                                    $client_email = $client_data->user_email;
                                                                    ?>
                                                                    <option value="<?= $client_data->ID ?>"><?= $client_data->display_name . '(' . $client_email . ')' ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                            <!--begin::Action-->
                                                            <a href="javascript:void(0)"
                                                               class="btn btn-light-danger er fs-6 px-5 py-3 "
                                                               data-bs-toggle="modal"
                                                               data-bs-target="#kt_modal_new_target">Invite New User</a>
                                                            <!--end::Action-->
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                                <!--end::Row-->
                                            </div>
                                            <!--end::Wrapper-->
                                        </div>
                                        <!--end::Step brief-->
                                        <?php
                                        $index++;
                                    }

                                    if (have_rows('quote_fields', $templateId)) {
                                        $idx = 0;

                                        while (have_rows('quote_fields', $templateId)) : the_row();
                                            $layout = get_row_layout();
                                            switch ($layout) {
                                                case 'fields':
                                                    $slug = get_sub_field('slug');
                                                    $type = get_sub_field('type_of_fields');
                                                    if ($type == "Checkbox") {
                                                        $type = 'checkbox';
                                                        $type_array = '[]';
                                                    } elseif ($type == "Radio") {
                                                        $type = 'radio';
                                                        $type_array = '';
                                                    }
                                                    $in_price = get_sub_field('in_price');
                                                    $refine_cls_name = "refine_item";
                                                    ?>
                                                    <!--begin::Step Item-->
                                                    <div class="<?= $index == 1 ? 'current' : '' ?> kt-quoting-step"
                                                         data-kt-stepper-element="content">
                                                        <!--begin::Wrapper-->
                                                        <div class="w-100">
                                                            <!--begin::Heading-->
                                                            <div class="pb-10">
                                                                <!--begin::Title-->
                                                                <h2 class="fw-bolder d-flex align-items-center text-dark">
                                                                    <?= get_sub_field('question') ?>
                                                                </h2>
                                                                <!--end::Title-->
                                                                <!--begin::Notice-->
                                                                <div class="text-muted fw-bold fs-6">
                                                                    <?php echo get_sub_field('description') ?>
                                                                </div>
                                                                <!--end::Notice-->
                                                            </div>
                                                            <!--end::Heading-->
                                                            <!--begin::Input group-->
                                                            <div class="fv-row">
                                                                <!--begin::Row-->
                                                                <div class="row">
                                                                    <!--begin::Col-->
                                                                    <div class="col-xs-12">
                                                                        <!--begin::Option-->
                                                                        <?php
                                                                        while (have_rows('fields')) {
                                                                            the_row();
                                                                            $qnt = get_sub_field('quantity');
                                                                            $dvalue = get_sub_field('default_quantity');
                                                                            $icon = get_sub_field('icon');
                                                                            $checked = get_sub_field('checked');
                                                                            if ($checked == 'yes') {
                                                                                $class_checked = 'checked="checked"';
                                                                                $checked_class = 'refine-active';
                                                                            } else {
                                                                                $class_checked = '';
                                                                                $checked_class = '';
                                                                            }
                                                                            $item_slug = get_sub_field('slug');
                                                                            $value_string = get_sub_field('title');

                                                                            $tooltip = get_sub_field('tooltip');
                                                                            if ($tooltip != '') {
                                                                                $tooltit_text = 'data-toggle="tooltip" data-placement="top" data-trigger="hover" data-original-title="' . $tooltip . '" title=""';
                                                                            } else {
                                                                                $tooltit_text = '';
                                                                            }

                                                                            ?>
                                                                            <div class="refine-item-row mb-5">
                                                                                <label class="styled_in_ajax bg-hover-light-danger text-hover-danger bg-white <?= $checked_class ?>" <?= $tooltit_text ?> >
                                                                                    <input class='chr d-none <?= $refine_cls_name ?> kt-calculate'
                                                                                           data-target='<?= $item_slug ?>'
                                                                                           type='<?= $type ?>'
                                                                                           title
                                                                                           name='<?= $slug . $type_array ?>' <?= $class_checked ?>
                                                                                           value='<?= $value_string ?>'>
                                                                                    <span class='px-2 py-2 lead fw-bolder text-dark'><?= get_sub_field('title') ?> <i
                                                                                                class="<?= $icon ?> fs-2 fw-bolder"></i> </span>
                                                                                    <?php
                                                                                    if ($qnt == true) {
                                                                                        ?>
                                                                                        <div class="num-container position-absolute end-0">
                                                                                            <!--begin::Dialer-->
                                                                                            <div class="input-group input-group-sm"
                                                                                                 data-kt-dialer="true"
                                                                                                 data-kt-dialer-min="1"
                                                                                                 data-kt-dialer-step="1">

                                                                                                <!--begin::Decrease control-->
                                                                                                <button class="btn btn-icon btn-outline bg-white btn-outline-secondary"
                                                                                                        type="button"
                                                                                                        data-kt-dialer-control="decrease">
                                                                                                    <i class="fa-solid fa-circle-minus text-dark"></i>
                                                                                                </button>
                                                                                                <!--end::Decrease control-->

                                                                                                <!--begin::Input control-->
                                                                                                <input type="text"
                                                                                                       class="form-control form-control-solid fw-bolder text-dark fs-7 kt-calculate"
                                                                                                       placeholder="Quantity"
                                                                                                       data-kt-dialer-control="input"
                                                                                                       data-bs-toggle="tooltip"
                                                                                                       title="Quantity"
                                                                                                       style="width: 50px; text-align: center;"
                                                                                                       name="<?= $item_slug ?>_multiple"
                                                                                                       value="<?= $dvalue ?>"
                                                                                                />
                                                                                                <!--end::Input control-->

                                                                                                <!--begin::Increase control-->
                                                                                                <button class="btn btn-icon btn-outline bg-white btn-outline-secondary"
                                                                                                        type="button"
                                                                                                        data-kt-dialer-control="increase">
                                                                                                    <i class="fa-solid fa-circle-plus text-danger"></i>
                                                                                                </button>
                                                                                                <!--end::Increase control-->
                                                                                            </div>
                                                                                            <!--end::Dialer-->
                                                                                        </div>
                                                                                        <?php
                                                                                    }
                                                                                    else {
                                                                                        ?>
                                                                                        <input type="hidden" name="<?= $item_slug ?>_multiple" value="1" />
                                                                                        <?php
                                                                                    }
                                                                                    ?>
                                                                                </label>
                                                                            </div>
                                                                            <?php

                                                                            $item_title = get_sub_field('title');
                                                                            $item_slug = get_sub_field('slug');
                                                                            $checked = get_sub_field('checked');

                                                                            if ($checked == 'yes') $style_checked = "d-block"; else $style_checked = "d-none";
                                                                            if (is_business($user_id) || is_head($user_id)) $check = "show"; elseif ($checked == 'yes') $check = "show"; else $check = "";
                                                                            if ($item_slug && have_rows('refine_price')) {
                                                                                ?>
                                                                                <div class="refine-rows <?= $style_checked ?> refine-<?= $item_slug ?>"
                                                                                     data-trigger="<?= $item_slug ?>">
                                                                                 <label class="badge badge-primary"
                                                                                           data-bs-toggle="tooltip"
                                                                                           title="Make adjustments, choose your inclusions & exclusions & add the correct quantities for an accurate quote">Adjust
                                                                                        : <?= $item_title ?></label>
                                                                                  <div class="row">
                                                                                        <div class="col-md-12">
                                                                                            <div class="table-responsive">
                                                                                                <table class="table refine-table">
                                                                                                    <?php
                                                                                                    $css = ($in_price && (is_head($user_id) || is_business($user_id))) ? '' : 'display:none;';
                                                                                                    if (is_business($user_id) || is_head($user_id)) {
                                                                                                        ?>
                                                                                                        <tr class="screen-reader-text">
                                                                                                            <td si
                                                                                                                class="d-none"></td>
                                                                                                            <td include>
                                                                                                                <div class="kd-switcher-container"
                                                                                                                     data-bs-toggle="tooltip"
                                                                                                                     title="Include or Exclude from the quote">
                                                                                                                    <div class="kd-switcher-bg">
                                                                                                                        <div class="kd-switcher-open kd-switcher-indicator">
                                                                                                                            <div>
                                                                                                                                Inc
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="kd-switcher-closed kd-switcher-indicator">
                                                                                                                            <div>
                                                                                                                                Exc
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="kd-switcher-handle">
                                                                                                                    </div>
                                                                                                                    <input type="checkbox"
                                                                                                                           class="d-none kt-calculate"
                                                                                                                           name=""
                                                                                                                           value="true">
                                                                                                                </div>
                                                                                                            </td>
                                                                                                            <td description>
                                                                                                                <div class="input-group"
                                                                                                                     data-bs-toggle="tooltip"
                                                                                                                     data-bs-custom-class="tooltip-inverse"
                                                                                                                     title="Description">
                                                                                                                        <textarea
                                                                                                                                class="form-control form-control-solid fw-bolder text-dark d-none"
                                                                                                                                rows="1"></textarea>
                                                                                                                </div>
                                                                                                            </td>
                                                                                                            <td category>
                                                                                                                <?php
                                                                                                                aireno_list_refine_categories("", 0, "d-none fw-bolder fs-7 text-dark form-control-solid");
                                                                                                                ?>
                                                                                                            </td>
                                                                                                            <td price
                                                                                                                style="<?= $css ?>">
                                                                                                                <div class="input-group input-group-solid">
                                                                                                                    <span class="input-group-text border-0">$</span>
                                                                                                                    <input class="form-control form-control-solid d-none fw-bolder text-dark kt-calculate"
                                                                                                                           title="Unit Price"
                                                                                                                           value="0"
                                                                                                                           type="text"/>
                                                                                                                </div>
                                                                                                            </td>
                                                                                                            <td quantity>
                                                                                                                <input
                                                                                                                        class="form-control form-control-solid d-none fw-bolder text-dark kt-calculate"
                                                                                                                        data-bs-toggle="tooltip"
                                                                                                                        title="Quantity"
                                                                                                                        type="number"/>
                                                                                                            </td>
                                                                                                            <td quantity_type>
                                                                                                                <select class="form-control form-control-solid form-select fw-bolder text-dark d-none"
                                                                                                                        data-bs-toggle="tooltip"
                                                                                                                        title="Quantity Type">
                                                                                                                    <option value="hour">
                                                                                                                        Hour
                                                                                                                    </option>
                                                                                                                    <option value="m2">
                                                                                                                        M2
                                                                                                                    </option>
                                                                                                                    <option value="m">
                                                                                                                        M
                                                                                                                    </option>
                                                                                                                    <option value="each">
                                                                                                                        Each
                                                                                                                    </option>
                                                                                                                </select>
                                                                                                            </td>
                                                                                                            <td margin
                                                                                                                style="<?= $css ?>">
                                                                                                                <div class="input-group align-center">
                                                                                                                    <input class="form-control form-control-solid d-none fw-bolder text-dark kt-calculate"
                                                                                                                           data-bs-toggle="tooltip"
                                                                                                                           title="Margin on unit price"
                                                                                                                           type="number"
                                                                                                                           value="">
                                                                                                                    <span class="input-group-text border-0">%</span>
                                                                                                                </div>
                                                                                                            </td>
                                                                                                            <td action>
                                                                                                                <div class="refine-actions">
                                                                                                                  <a class="refine-icon refine-add"
                                                                                                                       data-id="<?= $item_slug ?>">+</a>
                                                                                                                    <a class="refine-icon refine-remove"
                                                                                                                       data-id="<?= $item_slug ?>">-</a>
                                                                                                                </div>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <?php
                                                                                                    }
                                                                                                    ?>
                                                                                                    <tr>
                                                                                                        <th class="d-none">
                                                                                                        </th>
                                                                                                        <th style="min-width: 60px;">
                                                                                                        </th>
                                                                                                        <th style="min-width: 300px;">
                                                                                                        </th>
                                                                                                        <th style="<?= (is_business($user_id) || is_head($user_id)) ? '' : 'display:none;' ?> min-width: 120px;">
                                                                                                        </th>
                                                                                                        <th style="<?= $css ?> min-width: 170px;">
                                                                                                        </th>
                                                                                                        <th style="min-width: 150px;">
                                                                                                        </th>
                                                                                                        <th style="min-width: 100px;">
                                                                                                        </th>
                                                                                                        <th style="<?= $css ?> min-width: 150px;">
                                                                                                        </th>
                                                                                                        <?php
                                                                                                        if (is_business($user_id) || is_head($user_id)) {
                                                                                                            ?>
                                                                                                            <th style="min-width: 55px;">
                                                                                                            </th>
                                                                                                            <?php
                                                                                                        }
                                                                                                        ?>
                                                                                                    </tr>
                                                                                                    <?php
                                                                                                    $index = 1;
                                                                                                    while (have_rows('refine_price')) {
                                                                                                        the_row();
                                                                                                        $default = get_sub_field('default');
                                                                                                        $category = get_sub_field('category');
                                                                                                        $quote_description = get_sub_field('quote_description');
                                                                                                        $price = floatval(get_sub_field('price'));
                                                                                                        $quantity = floatval(get_sub_field('quantity'));
                                                                                                        $step = floatval(get_sub_field('quantity_step'));
                                                                                                        $quantity_type = get_sub_field('quantity_type');
                                                                                                        $margin = "";
                                                                                                        if (isset($_REQUEST['b']) && is_business($_REQUEST['b'])) {
                                                                                                            $margin = get_field("_company_margin", "user_" . $_REQUEST['b']);
                                                                                                        } else if (is_business($user_id)) {
                                                                                                            $margin = get_field("_company_margin", "user_" . $user_id);
                                                                                                        } else $margin = intval(get_sub_field('margin'));

                                                                                                        $open_class = ($default) ? 'open' : '';
                                                                                                        $default_checked = ($default) ? 'checked' : '';
                                                                                                        $required = ($default) ? 'kt-require' : '';
                                                                                                        if (!$category) {
                                                                                                            $refine_categories = get_terms(
                                                                                                                array(
                                                                                                                    'taxonomy' => 'refinecat',
                                                                                                                    'hide_empty' => false,
                                                                                                                )
                                                                                                            );
                                                                                                            foreach ($refine_categories as $refine_category) {
                                                                                                                $category = $refine_category->term_id;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                        ?>
                                                                                                        <tr>
                                                                                                            <td class="d-none"><?= $index ?></td>
                                                                                                            <td include>
                                                                                                                <div class="kd-switcher-container <?= $open_class ?>"
                                                                                                                     data-bs-toggle="tooltip"
                                                                                                                     title="Include or exclude from quote">
                                                                                                                    <div class="kd-switcher-bg">
                                                                                                                        <div class="kd-switcher-open kd-switcher-indicator">
                                                                                                                            <div>
                                                                                                                                Inc
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="kd-switcher-closed kd-switcher-indicator">
                                                                                                                            <div>
                                                                                                                                Exc
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="kd-switcher-handle">
                                                                                                                    </div>
                                                                                                                    <input type="checkbox"
                                                                                                                           class="d-none kt-calculate"
                                                                                                                           name="default_<?= $item_slug . '_' . $index ?>"
                                                                                                                           value="true" <?= $default_checked ?>>
                                                                                                                </div>
                                                                                                            </td>
                                                                                                            <td description>
                                                                                                                <div class="input-group">
                                                                                                                    <?php
                                                                                                                    if (is_business($user_id) || is_head($user_id)) {
                                                                                                                        ?>
                                                                                                                        <textarea
                                                                                                                                class="form-control form-control-solid fw-bolder fs-7 text-dark <?= $required ?>"
                                                                                                                                rows="1"
                                                                                                                                name="description_<?= $item_slug . '_' . $index ?>"
                                                                                                                                value="<?= $quote_description ?>"><?= $quote_description ?></textarea>
                                                                                                                        <?php
                                                                                                                    } else {
                                                                                                                        ?>
                                                                                                                        <p class="fw-bolder text-dark fs-7">
                                                                                                                            <?= $quote_description ?>
                                                                                                                        </p>
                                                                                                                        <input type="hidden"
                                                                                                                               name="description_<?= $item_slug . '_' . $index ?>"
                                                                                                                               value="<?= $quote_description ?>">
                                                                                                                        <?php
                                                                                                                    }
                                                                                                                    ?>
                                                                                                                </div>
                                                                                                            </td>
                                                                                                            <td category
                                                                                                                style="<?= (is_business($user_id) || is_head($user_id)) ? '' : 'display:none;' ?>">
                                                                                                                <?php
                                                                                                                if (is_business($user_id) || is_head($user_id)) {
                                                                                                                } else $disabled = "disabled";
                                                                                                                aireno_list_refine_categories("category_" . $item_slug . "_" . $index, $category, "text-dark fw-bolder fs-7", $disabled);
                                                                                                                ?>
                                                                                                            </td>
                                                                                                            <td price
                                                                                                                style="<?= $css ?>">
                                                                                                                <?php
                                                                                                                if (is_business($user_id) || is_head($user_id)) {
                                                                                                                    ?>
                                                                                                                    <!--begin::Dialer-->
                                                                                                                    <div class="input-group"
                                                                                                                         data-kt-dialer="true"
                                                                                                                         data-kt-dialer-min="1"
                                                                                                                         data-kt-dialer-decimals="2"
                                                                                                                         data-kt-dialer-step=".5"
                                                                                                                         data-kt-dialer-prefix="$">

                                                                                                                        <!--begin::Decrease control-->
                                                                                                                        <button class="btn btn-icon btn-outline btn-outline-secondary"
                                                                                                                                type="button"
                                                                                                                                data-kt-dialer-control="decrease">
                                                                                                                            <i class="fa-solid fa-circle-minus text-dark"></i>
                                                                                                                        </button>
                                                                                                                        <!--end::Decrease control-->

                                                                                                                        <!--begin::Input control-->
                                                                                                                        <input type="text"
                                                                                                                               class="form-control form-control-solid fw-bolder text-dark fs-7 <?= $required ?> kt-calculate"
                                                                                                                               placeholder="Unit price"
                                                                                                                               data-kt-dialer-control="input"
                                                                                                                               data-bs-toggle="tooltip"
                                                                                                                               title="Unit price"
                                                                                                                               name="price_<?= $item_slug . '_' . $index ?>"
                                                                                                                               value="<?= $price ?>"
                                                                                                                        />
                                                                                                                        <!--end::Input control-->

                                                                                                                        <!--begin::Increase control-->
                                                                                                                        <button class="btn btn-icon btn-outline btn-outline-secondary"
                                                                                                                                type="button"
                                                                                                                                data-kt-dialer-control="increase">
                                                                                                                            <i class="fa-solid fa-circle-plus text-danger"></i>
                                                                                                                        </button>
                                                                                                                        <!--end::Increase control-->
                                                                                                                    </div>
                                                                                                                    <!--end::Dialer-->
                                                                                                                    <?php
                                                                                                                } else {
                                                                                                                    ?>
                                                                                                                    <input type="hidden"
                                                                                                                           name="price_<?= $item_slug . '_' . $index ?>"
                                                                                                                           value="<?= $price ?>"/>
                                                                                                                    <?php
                                                                                                                }
                                                                                                                ?>
                                                                                                            </td>
           
                                                                                                            <td quantity>
                                                                                                                <!--begin::Dialer-->
                                                                                                                <div class="input-group"
                                                                                                                     data-kt-dialer="true"
                                                                                                                     data-kt-dialer-min="1"
                                                                                                                     data-kt-dialer-decimals="2"
                                                                                                                     data-kt-dialer-step="<?= $step ?>">

                                                                                                                    <!--begin::Decrease control-->
                                                                                                                    <button class="btn btn-icon btn-outline btn-outline-secondary"
                                                                                                                            type="button"
                                                                                                                            data-kt-dialer-control="decrease">
                                                                                                                        <i class="fa-solid fa-circle-minus text-dark"></i>
                                                                                                                    </button>
                                                                                                                    <!--end::Decrease control-->

                                                                                                                    <!--begin::Input control-->
                                                                                                                    <input type="text"
                                                                                                                           class="form-control form-control-solid fw-bolder text-dark fs-7 <?= $required ?> kt-calculate"
                                                                                                                           data-bs-toggle="tooltip"
                                                                                                                           title="Quantity"
                                                                                                                           name="quantity_<?= $item_slug . '_' . $index ?>"
                                                                                                                           value="<?= $quantity ?>"
                                                                                                                           min="1"
                                                                                                                    />
                                                                                                                    <!--end::Input control-->

                                                                                                                    <!--begin::Increase control-->
                                                                                                                    <button class="btn btn-icon btn-outline btn-outline-secondary"
                                                                                                                            type="button"
                                                                                                                            data-kt-dialer-control="increase">
                                                                                                                        <i class="fa-solid fa-circle-plus text-danger"></i>
                                                                                                                    </button>
                                                                                                                    <!--end::Increase control-->
                                                                                                                </div>
                                                                                                                <!--end::Dialer-->
                                                                                                            </td>
                                                                                                            <td quantity_type>
                                                                                                                <?php
                                                                                                                if (is_business($user_id) || is_head($user_id)) {
                                                                                                                    ?>
                                                                                                                    <select class="form-select form-control-solid fw-bolder text-dark fs-7 form-control"
                                                                                                                            data-bs-toggle="tooltip"
                                                                                                                            title="Unit Type"
                                                                                                                            name="quantity_type_<?= $item_slug . '_' . $index ?>">
                                                                                                                        <option value="hour"
                                                                                                                            <?= ($quantity_type == 'hour') ? 'selected="selected"' : '' ?>>
                                                                                                                            Hour
                                                                                                                        </option>
                                                                                                                        <option value="m2"
                                                                                                                            <?= ($quantity_type == 'm2') ? 'selected="selected"' : '' ?>>
                                                                                                                            M2
                                                                                                                        </option>
                                                                                                                        <option value="m"
                                                                                                                            <?= ($quantity_type == 'm') ? 'selected="selected"' : '' ?>>
                                                                                                                            M
                                                                                                                        </option>
                                                                                                                        <option value="each"
                                                                                                                            <?= ($quantity_type == 'each') ? 'selected="selected"' : '' ?>>
                                                                                                                            Each
                                                                                                                        </option>
                                                                                                                    </select>
                                                                                                                    <?php
                                                                                                                } else {
                                                                                                                    echo $quantity_type;
                                                                                                                    ?>
                                                                                                                    <input type="hidden"
                                                                                                                           name="quantity_type_<?= $item_slug . '_' . $index ?>"
                                                                                                                           value="<?= strtolower($quantity_type) ?>"/>
                                                                                                                    <?php
                                                                                                                }
                                                                                                                ?>
                                                                                                            </td>
                                                                                                            <td margin
                                                                                                                style="<?= $css ?>">
                                                                                                                <?php
                                                                                                                if (is_business($user_id) || is_head($user_id)) {
                                                                                                                    ?>
                                                                                                                    <!--begin::Dialer-->
                                                                                                                    <div class="input-group"
                                                                                                                         data-kt-dialer="true"
                                                                                                                         data-kt-dialer-min="0"
                                                                                                                         data-kt-dialer-max="100"
                                                                                                                         data-kt-dialer-step="1"
                                                                                                                         data-kt-dialer-suffix="%">

                                                                                                                        <!--begin::Decrease control-->
                                                                                                                        <button class="btn btn-icon btn-outline btn-outline-secondary"
                                                                                                                                type="button"
                                                                                                                                data-kt-dialer-control="decrease">
                                                                                                                            <i class="fa-solid fa-circle-minus text-dark"></i>
                                                                                                                        </button>
                                                                                                                        <!--end::Decrease control-->

                                                                                                                        <!--begin::Input control-->
                                                                                                                        <input type="text"
                                                                                                                               class="form-control form-control-solid fw-bolder text-dark fs-7 <?= $required ?> kt-calculate"
                                                                                                                               placeholder="Unit price"
                                                                                                                               data-kt-dialer-control="input"
                                                                                                                               data-bs-toggle="tooltip"
                                                                                                                               title="Margin on unit price"
                                                                                                                               name="margin_<?= $item_slug . '_' . $index ?>"
                                                                                                                               value="<?= $margin ?>"
                                                                                                                        />
                                                                                                                        <!--end::Input control-->

                                                                                                                        <!--begin::Increase control-->
                                                                                                                        <button class="btn btn-icon btn-outline btn-outline-secondary"
                                                                                                                                type="button"
                                                                                                                                data-kt-dialer-control="increase">
                                                                                                                            <i class="fa-solid fa-circle-plus text-danger"></i>
                                                                                                                        </button>
                                                                                                                        <!--end::Increase control-->
                                                                                                                    </div>
                                                                                                                    <!--end::Dialer-->
                                                                                                                    <?php
                                                                                                                } else {
                                                                                                                    ?>
                                                                                                                    <input type="hidden"
                                                                                                                           name="margin_<?= $item_slug . '_' . $index ?>"
                                                                                                                           value="<?= $margin ?>"/>
                                                                                                                    <?php
                                                                                                                }
                                                                                                                ?>
                                                                                                            </td>
                                                                                                            <?php
                                                                                                            if (is_business($user_id) || is_head($user_id)) {
                                                                                                                ?>
                                                                                                                <td action>
                                                                                                                    <div class="refine-actions">
                                                                                                                        <a class="refine-icon refine-add"
                                                                                                                           data-id="<?= $item_slug ?>">+</a>
                                                                                                                        <a class="refine-icon refine-remove"
                                                                                                                           data-id="<?= $item_slug . "_count" ?>">-</a>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <?php
                                                                                                            }
                                                                                                            ?>
                                                                                                        </tr>
                                                                                                        <?php
                                                                                                        $index++;
                                                                                                    }
                                                                                                    ?>
                                                                                                </table>
                                                                                            </div>
                                                                                            <input type="hidden"
                                                                                                   name="<?= $item_slug . "_count" ?>"
                                                                                                   value="<?= $index ?>"/>
                                                                                        </div>
                                                                                    </div>
                                                                                  </div>
                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                        <!--end::Option-->
                                                                    </div>
                                                                    <!--end::Col-->
                                                                </div>
                                                                <!--end::Row-->
                                                            </div>
                                                            <!--end::Input group-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </div>
                                                    <!--end::Step Item-->
                                                    <?php
                                                    break;
                                                case 'additional_notes':
                                                    ?>
                                                    <!--begin::Step Item-->
                                                    <div class="<?= $index == 1 ? 'current' : '' ?> kt-quoting-step"
                                                         data-kt-stepper-element="content">
                                                        <!--begin::Wrapper-->
                                                        <div class="w-100">
                                                            <!--begin::Heading-->
                                                            <div class="pb-10">
                                                                <!--begin::Title-->
                                                                <h2 class="fw-bolder d-flex align-items-center text-dark">
                                                                    <?= get_sub_field('title') ?>
                                                                </h2>
                                                                <!--end::Title-->
                                                                <!--begin::Notice-->
                                                                <div class="text-muted fw-bold fs-6">
                                                                    <?php echo get_sub_field('description') ?>
                                                                </div>
                                                                <!--end::Notice-->
                                                            </div>
                                                            <!--end::Heading-->
                                                            <!--begin::Input group-->
                                                            <div class="fv-row">
                                                                <!--begin::Row-->
                                                                <div class="row">
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-12">
                                                                        <!--begin::Option-->
                                                                        <textarea
                                                                                class='quote_textarea w-100 form-control non-required'
                                                                                rows="7"
                                                                                name='<?= get_sub_field('slug') ?>'></textarea>
                                                                        <!--end::Option-->
                                                                    </div>
                                                                    <!--end::Col-->
                                                                </div>
                                                                <!--end::Row-->
                                                            </div>
                                                            <!--end::Input group-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </div>
                                                    <!--end::Step Item-->
                                                    <?php
                                                    break;
                                                default:
                                                    break;
                                            }
                                        endwhile;

                                        if (get_field('display_repeater', $templateId) && (is_business($user_id) || is_head($user_id))
                                            && is_array($autoSuggestions) && count($autoSuggestions) > 0) {
                                            ?>
                                            <!--begin::Step Repeater-->
                                            <div class="kt-quoting-step" data-kt-stepper-element="content">
                                                <!--begin::Wrapper-->
                                                <div class="w-100">
                                                    <!--begin::Heading-->
                                                    <div class="pb-8 pb-lg-10">
                                                        <!--begin::Title-->
                                                        <h2 class="fw-bolder text-dark">Add custom pricing</h2>
                                                        <!--end::Title-->
                                                        <!--begin::Notice-->
                                                        <div class="text-muted fw-bold fs-6">Search the database for
                                                            other prices or add your own.
                                                        </div>
                                                        <!--end::Notice-->
                                                    </div>
                                                    <!--end::Heading-->
                                                    <!--begin::Body-->
                                                    <div class="mb-0 fv-row">
                                                        <div class="customQuoteFieldContainer" data-rows="1">
                                                        </div>
                                                        <hr>
                                                        <div class="row" style="padding-bottom: 80px">
                                                            <div class="col-md-12">
                                                                <div class="">
                                                                    <a class="btn btn-sm btn-light-danger populateCustomQuoteField">Add
                                                                        Custom Price</a>
                                                                    <div class="row customQuoteFieldRow mb-10 screen-reader-text">
                                                                        <div class="col-md-10">
                                                                            <div class="form-group form-control-default title-suggestion-container">
                                                                                <label for="customQuoteFieldTitle"
                                                                                       class="mb-3 required">
                                                                                    Title
                                                                                    <a class="refine-icon deleteCustomQuoteField red">-</a>
                                                                                </label>
                                                                                <input type="text"
                                                                                       class="form-control customQuoteFieldTitle kt-require"
                                                                                       placeholder="Title">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <div class="form-group form-control-default">
                                                                                <label class="mb-3 required"
                                                                                       for="customQuoteFieldTotalPrice">Total</label>
                                                                                <input type="text" readonly min="0"
                                                                                       class="form-control customQuoteFieldTotalPrice"
                                                                                       placeholder="0.00">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="table-responsive refine-table-container">
                                                                                <table class="table refine-table">
                                                                                    <thead>
                                                                                    <tr>
                                                                                        <th style="min-width: 40px; width : 40px;">
                                                                                            #
                                                                                        </th>
                                                                                        <th style="min-width: 90px; width : 90px;">
                                                                                            Include
                                                                                        </th>
                                                                                        <th style="min-width: 300px;">
                                                                                            Description
                                                                                        </th>
                                                                                        <th style="min-width: 130px;">
                                                                                            Category
                                                                                        </th>
                                                                                        <th style="min-width: 100px; width : 100px;">
                                                                                            Price
                                                                                        </th>
                                                                                        <th style="min-width: 80px; width : 80px;">
                                                                                            Quantity
                                                                                        </th>
                                                                                        <th style="min-width: 100px; width : 100px;">
                                                                                            Type
                                                                                        </th>
                                                                                        <th style="min-width: 80px; width : 80px;">
                                                                                            Margin
                                                                                        </th>
                                                                                        <th style="min-width: 55px; width : 55px;">
                                                                                            Action
                                                                                        </th>
                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tr class="screen-reader-text">
                                                                                        <td></td>
                                                                                        <td>
                                                                                            <div class="kd-manual kd-switcher-container">
                                                                                                <div class="kd-switcher-bg">
                                                                                                    <div class="kd-switcher-open kd-switcher-indicator">
                                                                                                        <div>Yes</div>
                                                                                                    </div>
                                                                                                    <div class="kd-switcher-closed kd-switcher-indicator">
                                                                                                        <div>No</div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="kd-switcher-handle">
                                                                                                </div>
                                                                                                <input type="checkbox"
                                                                                                       class="d-none kt-calculate kt-custom"
                                                                                                       value="0">
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div class="input-group">
                                                                                                <textarea
                                                                                                        class="form-control"
                                                                                                        rows="1"></textarea>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <?php
                                                                                            aireno_list_refine_categories('', 0, '', '');
                                                                                            ?>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div class="input-group align-center">
                                                                                                <span class="me-2">$</span>
                                                                                                <input type="text"
                                                                                                       class="form-control kt-calculate kt-custom"/>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td><input type="number"
                                                                                                   class="form-control kt-calculate kt-custom"/>
                                                                                        </td>
                                                                                        <td>
                                                                                            <select class="form-control form-select">
                                                                                                <option value="Hour">
                                                                                                    Hour
                                                                                                </option>
                                                                                                <option value="M2">M2
                                                                                                </option>
                                                                                                <option value="M">M
                                                                                                </option>
                                                                                                <option value="Each">
                                                                                                    Each
                                                                                                </option>
                                                                                            </select>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div class="input-group align-center">
                                                                                                <span class="me-2">%</span>
                                                                                                <input type="number"
                                                                                                       class="form-control kt-calculate kt-custom"
                                                                                                       value="30"/>
                                                                                            </div>
                                                                                        <td>
                                                                                            <div class="refine-actions">
                                                                                                <a class="refine-icon refine-actions-remove">-</a>
                                                                                                <a class="refine-icon refine-actions-add">+</a>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>1</td>
                                                                                        <td>
                                                                                            <div class="kd-manual kd-switcher-container">
                                                                                                <div class="kd-switcher-bg">
                                                                                                    <div
                                                                                                            class="kd-switcher-open kd-switcher-indicator">
                                                                                                        <div>Yes</div>
                                                                                                    </div>
                                                                                                    <div
                                                                                                            class="kd-switcher-closed kd-switcher-indicator">
                                                                                                        <div>No</div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="kd-switcher-handle">
                                                                                                </div>
                                                                                                <input type="checkbox"
                                                                                                       class="d-none kt-calculate kt-custom"
                                                                                                       value="0">
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div class="input-group">
                                                                                                <textarea
                                                                                                        class="form-control"
                                                                                                        rows="1"></textarea>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <?php
                                                                                            aireno_list_refine_categories('', 0);;
                                                                                            ?>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div class="input-group align-center">
                                                                                                <span class="me-2">$</span>
                                                                                                <input type="text"
                                                                                                       class="form-control kt-calculate kt-custom"/>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td><input type="number"
                                                                                                   class="form-control kt-calculate kt-custom"/>
                                                                                        </td>
                                                                                        <td>
                                                                                            <select class="form-control form-select">
                                                                                                <option value="Hour">
                                                                                                    Hour
                                                                                                </option>
                                                                                                <option value="M2">M2
                                                                                                </option>
                                                                                                <option value="M">M
                                                                                                </option>
                                                                                                <option value="Each">
                                                                                                    Each
                                                                                                </option>
                                                                                            </select>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div class="input-group align-center">
                                                                                                <span class="me-2">%</span>
                                                                                                <input type="number"
                                                                                                       class="form-control kt-calculate kt-custom"
                                                                                                       value="30"/>
                                                                                            </div>
                                                                                        <td>
                                                                                            <div class="refine-actions">
                                                                                                <a class="refine-icon refine-actions-remove">-</a>
                                                                                                <a class="refine-icon refine-actions-add">+</a>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <script>
                                                            window.titleList = JSON.parse(
                                                                '<?php echo json_encode($autoSuggestions); ?>');
                                                            for (var i = 0; i < titleList.length; i++) {
                                                                titleList[i].label = titleList[i].title;
                                                            }
                                                        </script>
                                                    </div>
                                                    <!--end::Body-->
                                                </div>
                                                <!--end::Wrapper-->
                                            </div>
                                            <!--end::Step Repeater-->
                                            <?php
                                            $index++;
                                        }
                                    }

                                    ?>
                                    <!--begin::Next, Prev Actions-->
                                    <div class="d-flex flex-stack kt-quoting-step-actions w-100">
                                        <!--begin::Wrapper-->
                                        <div class="mr-2">
                                            <button type="button" class="btn btn-lg btn-secondary me-3"
                                                    data-kt-stepper-action="previous">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr063.svg-->
                                                <span class="svg-icon svg-icon-4 me-1">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none">
															<rect opacity="0.5" x="6" y="11" width="13" height="2"
                                                                  rx="1" fill="currentColor"/>
															<path d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z"
                                                                  fill="currentColor"/>
														</svg>
													</span>
                                                <!--end::Svg Icon-->Back
                                            </button>
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Wrapper-->
                                        <div>
                                            <button type="button" class="btn btn-lg btn-danger me-3"
                                                    data-kt-stepper-action="submit">
														<span class="indicator-label">Submit
                                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
														<span class="svg-icon svg-icon-3 ms-2 me-0">
															<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.5" x="18" y="13" width="13" height="2"
                                                                      rx="1" transform="rotate(-180 18 13)"
                                                                      fill="currentColor"/>
																<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                                      fill="currentColor"/>
															</svg>
														</span>
                                                            <!--end::Svg Icon--></span>
                                                <span class="indicator-progress">Please wait...
														<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                            <button type="button" class="btn btn-lg btn-danger"
                                                    data-kt-stepper-action="next">Continue
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                                <span class="svg-icon svg-icon-4 ms-1 me-0">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none">
															<rect opacity="0.5" x="18" y="13" width="13" height="2"
                                                                  rx="1" transform="rotate(-180 18 13)"
                                                                  fill="currentColor"/>
															<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                                  fill="currentColor"/>
														</svg>
													</span>
                                                <!--end::Svg Icon--></button>
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Next, Prev Actions-->
                                </div>
                                <!--begin::Form Steps-->
                            </div>
                            <!--end::Form Sub Container-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Begin Form Container-->
                </div>
                <!--end::Quoting Form-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>

    <!--begin::Modal - New Target-->
    <div class="modal fade" id="kt_modal_new_target" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-450px">
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
                            <h1 class="mb-3 fs-3">Search Users</h1>
                            <!--end::Title-->
                            <!--begin::Description-->
                            <div class="text-muted fw-bold fs-6">
                                We'll check if the user is a member and add them to your quote & contact list.
                            </div>
                            <!--end::Description-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-5 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Search by email or phone</span>
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
                        <div class="result-item p-3 border border-danger border-dashed rounded d-flex w-100 justify-content-start flex-row d-none mb-3 cursor-pointer"
                             data-kt-element="template">
                            <div class="me-3">
                                <img class="h-50px"
                                     src=""
                                     alt="avatar"/>
                            </div>
                            <div class="d-flex flex-column justify-content-around">
                                <div class="d-flex flex-row">
                                    <span class="fw-boldest fs-4 me-3"
                                          data-kt-element="display_name">Vasile Darmaz</span>
                                    <span class="badge badge-info" data-kt-element="type">Client</span>
                                </div>
                                <span class="fw-bolder" data-kt-element="email">vasiledarmaz0025@hotmail.com</span>
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
                        <!--begin::Heading-->
                        <div class="mb-13 text-center">
                            <!--begin::Title-->
                            <h1 class="mb-3">Invite New User</h1>
                            <!--end::Title-->
                            <!--begin::Description-->
                            <div class="text-muted fw-bold fs-5">The user will receive the invitation via
                                E-mail.
                            </div>
                            <!--end::Description-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
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
                           <button type="button" id="kt_modal_new_target_search" class="btn btn-success">
                                Back to Search
                            </button>
                            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-danger">
                                <span class="indicator-label">Invite User</span>
                                <span class="indicator-progress">Please wait...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
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
    <!--end::Modal - New Target-->
    <?php
}
get_footer('blank');
