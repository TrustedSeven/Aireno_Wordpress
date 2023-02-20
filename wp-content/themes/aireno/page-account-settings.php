<?php
/**
 * Template Name: Account Settings Page
 *
 * @package WordPress
 * @subpackage Aireno
 * @since Aireno 1.0
 */
if (!is_user_logged_in()) {
    wp_safe_redirect(aireno_get_page_link_by_name('login'));
}

get_header();

$user_id = get_current_user_id();
$user_data = get_userdata($user_id);
$display_name = $user_data->data->display_name;
$user_email = $user_data->data->user_email;

$address = get_field('_address', 'user_' . $user_id);
$phone = get_field('_phone', 'user_' . $user_id);

$avatar = get_field('_avatar', 'user_' . $user_id);

if ($avatar) {
    $avatar_url = $avatar['url'];
    $avatar_id = $avatar['ID'];
} else {
    $avatar_url = get_avatar_url($user_id);
    $avatar_id = '';
}

if (is_business($user_id)) {
    $business_logo = $avatar = get_field('_business_logo', 'user_' . $user_id);
    if ($business_logo) {
        $business_logo_url = $business_logo['url'];
        $business_logo_id = $business_logo['ID'];
    } else {
        if (has_custom_logo()) {
            $custom_logo_id = get_theme_mod('custom_logo');
            $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
            $business_logo_url = $logo[0];
        } else {
            $business_logo_url = get_theme_file_uri('assets/images/logo.png');
        }
        $business_logo_id = '';
    }
    $company_name = get_field('_company_name', 'user_' . $user_id);
    $company_abn = get_field('_company_abn', 'user_' . $user_id);
    $payment_instructions = get_field('_payment_instructions', 'user_' . $user_id);
    $payment_details = get_field('_payment_details', 'user_' . $user_id);

    $company_services = get_field('_company_services', 'user_' . $user_id);
    if (!$company_services) $company_services = array();
    $company_margin = get_field('_company_margin', 'user_' . $user_id);
    if (!$company_margin) $company_margin = 30;
}
?>
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">

                <!--begin::Navbar-->
                <div class="card mb-5 mb-xl-10">
                    <div class="card-body pt-9 pb-0">
                        <?php
                        get_template_part('template-parts/profile/account', 'header');
                        ?>
                        <!--begin::Navs-->
                        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder">
                            <!--begin::Nav item-->
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5 active"
                                   href="<?= aireno_get_page_link_by_name('account-settings') ?>">Settings</a>
                            </li>
                            <!--end::Nav item-->
                            <?php
                            if (is_business($user_id)) {
                                ?>
                                <!--begin::Nav item-->
                                <li class="nav-item mt-2">
                                    <a class="nav-link text-active-primary ms-0 me-10 py-5"
                                       href="<?= aireno_get_page_link_by_name('account-billing') ?>">Membership</a>
                                </li>
                                <!--end::Nav item-->
                                <?php
                            }
                            ?>
                            <!--begin::Nav item-->
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5"
                                   href="<?= get_author_posts_url($user_id) ?>">Profile</a>
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5"
                                   href="<?= get_post_type_archive_link(AIRENO_CPT_PROJECT) ?>">Projects</a>
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5"
                                   href="<?= aireno_get_page_link_by_name('account-overview') ?>">Contacts</a>
                            </li>
                            <!--end::Nav item-->
                        </ul>
                        <!--begin::Navs-->
                    </div>
                </div>
                <!--end::Navbar-->

                <!--begin::Settings-->
                <div class="card mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                         data-bs-target="#kt_account_settings_profile_details" aria-expanded="true"
                         aria-controls="kt_account_profile_details">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bolder text-dark m-0">Profile Details</h3>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--begin::Card header-->
                    <!--begin::Content-->
                    <div id="kt_account_settings_profile_details" class="card-body collapse show">
                        <!--begin::Form-->
                        <form id="kt_account_profile_details_form" class="form" method="post"
                              enctype="multipart/form-data">
                            <input type="hidden" name="action" value="aireno_save_account_details">
                            <!--begin::Card body-->
                            <div class="border-top pt-6">
                                <!--begin::Avatar group-->
                                <div class="row mb-6 fv-row">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-bolder text-dark fs-6">Avatar</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <!--begin::Image input-->
                                        <div class="image-input image-input-outline" data-kt-image-input="true"
                                             style="background-image: url('<?= $avatar_url ?>')">
                                            <!--begin::Preview existing avatar-->
                                            <div class="image-input-wrapper w-125px h-125px"
                                                 style="background-image: url(<?= $avatar_url ?>"></div>
                                            <!--end::Preview existing avatar-->
                                            <!--begin::Label-->
                                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                   data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                   title="Change avatar">
                                                <i class="bi bi-pencil-fill fs-7"></i>
                                                <!--begin::Inputs-->
                                                <input type="file" name="avatar" accept=".png, .jpg, .jpeg"/>
                                                <input type="hidden" name="_avatar" value="<?= $avatar_id ?>">
                                                <input type="hidden" name="avatar_remove"/>
                                                <!--end::Inputs-->
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Cancel-->
                                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                  data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                  title="Cancel avatar">
                                                <i class="bi bi-x fs-2"></i>
                                            </span>
                                            <!--end::Cancel-->
                                        </div>
                                        <!--end::Image input-->
                                        <!--begin::Hint-->
                                        <div class="form-text text-muted">Allowed file types: png, jpg, jpeg.</div>
                                        <!--end::Hint-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Avatar group-->
                                <!--begin::Full Name group-->
                                <div class="row mb-6 fv-row">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-bolder text-dark fs-6">Full Name</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <input type="text" name="display_name"
                                               class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                               placeholder="Full name" value="<?= $display_name ?>"/>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Full Name group-->
                                <!--begin::Address group-->
                                <div class="row mb-6 fv-row">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-bolder text-darkfs-6">Address</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <input type="text" name="address"
                                               class="form-control form-control-lg form-control-solid"
                                               placeholder="Address" value="<?= $address ?>"/>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Address group-->
                                <!--begin::Phone Number group-->
                                <div class="row mb-6 fv-row">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-bolder text-dark fs-6">
                                        <span class="required">Phone Number</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                           title="Phone number must be active"></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <input type="tel" name="phone"
                                               class="form-control form-control-lg form-control-solid"
                                               placeholder="Phone number" value="<?= $phone ?>"/>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Phone Number group-->
                                <?php
                                if (is_business($user_id)) {

                                    $userdata = get_userdata($user_id);
                                    // Setup the nicename.
                                    $user_nicename = $userdata->user_nicename;

                                    ?>

                                    <!--begin::Profile Url group-->
                                    <div class="row mb-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-bold fs-6">
                                            <span class="required">Profile Url</span>
                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                               title="Profile Url must be active"></i>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <input type="text" name="profile_url"
                                                   class="form-control form-control-lg form-control-solid mb-3"
                                                   placeholder="Profile Url" value="<?= aireno_esc_nicename($user_nicename) ?>"/>
                                            <p class="ms-10">Choose your profile url based on the below profile information, or create your
                                                own. <br/><span class="description">ie. - 'user-name', 'firstname-lastname', or 'master-ninja'</span>
                                            </p>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Profile Url group-->

                                    <!--begin::Logo group-->
                                    <div class="row mb-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label required fw-bolder text-dark fs-6">Business
                                            Logo</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <!--begin::Image input-->
                                            <div class="image-input image-input-outline" data-kt-image-input="true"
                                                 style="background-image: url('<?= $business_logo_url ?>')">
                                                <!--begin::Preview existing avatar-->
                                                <div class="image-input-wrapper w-125px h-125px"
                                                     style="background-image: url(<?= $business_logo_url ?>"></div>
                                                <!--end::Preview existing avatar-->
                                                <!--begin::Label-->
                                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                       data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                       title="Change Business Logo">
                                                    <i class="bi bi-pencil-fill fs-7"></i>
                                                    <!--begin::Inputs-->
                                                    <input type="file" name="business_logo" accept=".png, .jpg, .jpeg"/>
                                                    <input type="hidden" name="_business_logo"
                                                           value="<?= $business_logo_id ?>">
                                                    <input type="hidden" name="business_logo_remove"/>
                                                    <!--end::Inputs-->
                                                </label>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Image input-->
                                            <!--begin::Hint-->
                                            <div class="form-text text-muted">Allowed file types: png, jpg, jpeg.</div>
                                            <!--end::Hint-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Logo group-->
                                    <!--begin::Company Name group-->
                                    <div class="row mb-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label required fw-bolder text-dark fs-6">Company
                                            Name</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <input type="text" name="company_name"
                                                   class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                   placeholder="My amazing company LTD" value="<?= $company_name ?>"/>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Company Name group-->
                                    <!--begin::Services Offer group-->
                                    <div class="row mb-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label required fw-bolder text-dark fs-6">What Services do you offer? <small class="text-muted">This will impact the instant quotes shown on your profile. </small></label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <?php
                                            $args = array(
                                                'taxonomy' => 'quote-tag',
                                                'orderby' => 'name',
                                                'order' => 'ASC',
                                                'hide_empty' => false,
                                            );
                                            $tags = get_categories($args);
                                            ?>
                                            <div class="input-group border-0 flex-nowrap">
                                                <span class="input-group-text bg-danger border-0">
                                                    <i class="fa-brands fa-searchengin text-light fw-bolder"></i>
                                                </span>
                                                <div class="overflow-hidden flex-grow-1" id="company_services_container">
                                                    <select name="company_services[]"
                                                            class="form-select rounded-start-0 form-select-lg"
                                                            data-control="select2"
                                                            data-placeholder="Services you offer"
                                                            data-hide-search="false"
                                                            data-allow-clear="true" multiple="multiple">
                                                        <option></option>
                                                        <?php
                                                        foreach ($tags as $tag) {
                                                            $selected = in_array($tag->term_id, $company_services) ? "selected" : "";
                                                            ?>
                                                            <option value="<?= $tag->term_id ?>" <?= $selected ?>><?= ucwords($tag->name) ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <style>
                                                    #company_services_container .select2-container--bootstrap5 .select2-selection--multiple .select2-selection__rendered .select2-selection__choice{
                                                        display: inline-block !important;
                                                        float: left !important;
                                                    }
                                                    #company_services_container .select2-selection.select2-selection--multiple {
                                                        display: inline-flex !important;
                                                    }
                                                </style>
                                            </div>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Services Offer group-->
                                    <!--begin::Margin group-->
                                    <div class="row mb-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label required fw-bolder text-dark fs-6">Default Margin <small class="text-muted">This will added to our base pricing so you have full control over your profit margin.  </small></label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <!--begin::Dialer-->
                                            <div class="input-group w-175px"
                                                 data-kt-dialer="true"
                                                 data-kt-dialer-min="1"
                                                 data-kt-dialer-step="1"
                                                 data-kt-dialer-suffix="%">

                                                <!--begin::Decrease control-->
                                                <button class="btn btn-icon btn-outline btn-outline-secondary"
                                                        type="button" data-kt-dialer-control="decrease">
                                                    <i class="bi bi-dash fs-1"></i>
                                                </button>
                                                <!--end::Decrease control-->

                                                <!--begin::Input control-->
                                                <input type="text"
                                                       class="form-control form-control-solid fw-bolder text-dark"
                                                       readonly placeholder="Margin"
                                                       data-kt-dialer-control="input"
                                                       data-bs-toggle="tooltip"
                                                       title="Margin"
                                                       name="company_margin"
                                                       value="<?= $company_margin ?>"
                                                />
                                                <!--end::Input control-->

                                                <!--begin::Increase control-->
                                                <button class="btn btn-icon btn-outline btn-outline-secondary"
                                                        type="button" data-kt-dialer-control="increase">
                                                    <i class="bi bi-plus fs-1"></i>
                                                </button>
                                                <!--end::Increase control-->
                                            </div>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Margin group-->
                                    <!--begin::Company ABN group-->
                                    <div class="row mb-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label required fw-bolder text-dark fs-6">Company ABN <small class="text-muted">Shown on profile</small></label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <input type="text" name="company_abn"
                                                   class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                   placeholder="ABN" value="<?= $company_abn ?>"/>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Company ABN group-->
                                    <!--begin::Payment Instructions-->
                                    <div class="row mb-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label required fw-bolder text-dark fs-6">Payment
                                            Instructions <small class="text-muted">Tell your customers your invoice terms</small></label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <textarea name="payment_instructions" rows="5"
                                                      class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                      placeholder="Eg: Payment due on reciept with a late fee of 1.7% per annum..."><?= $payment_instructions ?></textarea>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Payment Instructions-->
                                    <!--begin::Payment Details-->
                                    <div class="row mb-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label required fw-bolder text-dark fs-6">Account Details <small class="text-muted">Tell you customer where to send payment</small>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <textarea name="payment_details" rows="5"
                                                      class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                      placeholder="Account Name, BSB & Account Number"><?= $payment_details ?></textarea>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Payment Details-->
                                    <?php
                                }
                                ?>
                            </div>
                            <!--end::Card body-->
                            <!--begin::Actions-->
                            <div class="d-flex justify-content-end">
                                <button type="submit" id="kt_account_profile_details_submit"
                                        class="btn btn-primary ">
                                    <span class="indicator-label">Save Details</span>
                                    <span class="indicator-progress">Please wait...
                                            <span
                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Settings-->

                <?php
                if (is_business($user_id)) {
                    ?>
                    <!--begin::Portfolios Method-->
                    <div class="card mb-5 mb-xl-10">
                        <!--begin::Card header-->
                        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                             data-bs-target="#kt_account_portfolios">
                            <div class="card-title m-0">
                                <h3 class="fw-bolder text-dark m-0">Portfolio <small class="text-muted">Show off your best work and important credentials</small></h3>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div id="kt_account_portfolios" class="card-body border-top p-9 pb-0 collapse show">
                            <!--begin::Photos-->
                            <div class="row g-6 g-xl-9">
                                <?php
                                $portfolios = get_field('_company_portfolios', 'user_' . $user_id);
                                if ($portfolios && count($portfolios) > 0) {
                                    foreach ($portfolios as $portfolio) {
                                        $src = wp_get_attachment_image_url($portfolio, 'full');
                                        ?>
                                        <!--begin::Col-->
                                        <div class="col-md-6 col-lg-4 col-xl-3 portfolio-item">
                                            <!--begin::Card-->
                                            <div class="card h-250px">
                                                <label class="remove_portfolio position-absolute btn btn-icon btn-circle btn-active-color-danger w-25px h-25px bg-body shadow"
                                                       data-bs-toggle="tooltip" title="Remove"
                                                       style="right: -10px; top: -10px; z-index: 99"
                                                       data-id="<?=$portfolio?>"
                                                       data-bs-original-title="Change avatar">
                                                        <span class="svg-icon svg-icon-1 text-danger">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24" viewBox="0 0 24 24" fill="none">
                                                                <rect opacity="0.5" x="6" y="17.3137" width="16"
                                                                      height="2" rx="1"
                                                                      transform="rotate(-45 6 17.3137)"
                                                                      fill="currentColor"></rect>
                                                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                                                      transform="rotate(45 7.41422 6)"
                                                                      fill="currentColor">
                                                                </rect>
                                                            </svg>
                                                        </span>
                                                </label>
                                                <!--begin::Overlay-->
                                                <a class="rounded bg-info h-100 d-block overlay"
                                                   data-fslightbox="lightbox-basic" href="<?= $src ?>">
                                                    <!--begin::Image-->
                                                    <div class="h-100 d-block overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded"
                                                         style="background-image:url('<?= $src ?>')">
                                                        <img src="<?= $src ?>" class="mw-300px h-auto invisible">
                                                    </div>
                                                    <!--end::Image-->
                                                    <!--begin::Action-->
                                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                                        <i class="bi bi-eye-fill text-white fs-3x"></i>
                                                    </div>
                                                    <!--end::Action-->
                                                </a>
                                                <!--end::Overlay-->
                                            </div>
                                            <!--end::Card-->
                                        </div>
                                        <!--end::Col-->
                                        <?php
                                    }
                                }
                                ?>
                                <!--begin::Col-->
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <!--begin::Card-->
                                    <div id="portfoliosFTrigger"
                                         class="card h-100 flex-center bg-light-primary border-primary border border-dashed p-8 cursor-pointer">
                                        <!--begin::Image-->
                                        <img src="<?= get_theme_file_uri("assets/images/upload.svg") ?>" class="mb-5"
                                             alt="">
                                        <!--end::Image-->
                                        <!--begin::Link-->
                                        <a href="#" class="text-hover-primary fs-5 fw-bolder mb-2">File Upload</a>
                                        <!--end::Link-->
                                        <!--begin::Description-->
                                        <div class="fs-7 fw-bold text-gray-400">Drag and drop files here</div>
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Card-->
                                </div>
                                <!--end::Col-->
                                <form id="portfoliosUF" enctype="multipart/form-data" method="post">
                                    <input type="hidden" name="action" value="aireno_upload_portfolios">
                                    <input type="file" class="d-none" name="portfolios[]" id="portfoliosF"
                                           accept=".png, .jpg, .jpeg" multiple>
                                </form>
                            </div>
                            <!--end::Photos-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Portfolios Method-->
                    <?php
                }
                ?>

                <!--begin::Sign-in Method-->
                <div class="card mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                         data-bs-target="#kt_account_settings_signin_method">
                        <div class="card-title m-0">
                            <h3 class="fw-bolder m-0">Sign-in Method</h3>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div id="kt_account_settings_signin_method" class="card-body border-top p-9 collapse show">
                        <!--begin::Email Address-->
                        <div class="d-flex flex-wrap align-items-center">
                            <!--begin::Label-->
                            <div id="kt_signin_email">
                                <div class="fs-6 fw-bolder mb-1">Email Address</div>
                                <div class="fw-bold text-gray-600"><?= $user_email ?></div>
                            </div>
                            <!--end::Label-->
                            <!--begin::Edit-->
                            <div id="kt_signin_email_edit" class="flex-row-fluid d-none">
                                <!--begin::Form-->
                                <form id="kt_signin_change_email" class="form" novalidate="novalidate">
                                    <input type="hidden" name="action" value="aireno_change_user_email">
                                    <input type="hidden" name="user_id" value="<?= $user_id ?>">
                                    <div class="row mb-6">
                                        <div class="col-lg-6 mb-4 mb-lg-0">
                                            <div class="fv-row mb-0">
                                                <label for="emailaddress" class="form-label fs-6 fw-bolder mb-3">Enter
                                                    New Email Address</label>
                                                <input type="email"
                                                       class="form-control form-control-lg form-control-solid"
                                                       id="emailaddress" placeholder="Email Address"
                                                       name="emailaddress"
                                                       value="<?= $user_email ?>"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="fv-row mb-0">
                                                <label for="confirmemailpassword"
                                                       class="form-label fs-6 fw-bolder mb-3">Confirm
                                                    Password</label>
                                                <input type="password"
                                                       class="form-control form-control-lg form-control-solid"
                                                       name="confirmemailpassword" id="confirmemailpassword"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <button id="kt_signin_submit" type="button"
                                                class="btn btn-primary me-2 px-6">
                                            <span class="indicator-label">Update Email</span>
                                            <span class="indicator-progress">Please wait...
                                            <span
                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                        <button id="kt_signin_cancel" type="button"
                                                class="btn btn-color-gray-400 btn-active-light-primary px-6">Cancel
                                        </button>
                                    </div>
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Edit-->
                            <!--begin::Action-->
                            <div id="kt_signin_email_button" class="ms-auto">
                                <button class="btn btn-light btn-active-light-primary">Change Email</button>
                            </div>
                            <!--end::Action-->
                        </div>
                        <!--end::Email Address-->
                        <!--begin::Separator-->
                        <div class="separator separator-dashed my-6"></div>
                        <!--end::Separator-->
                        <!--begin::Password-->
                        <div class="d-flex flex-wrap align-items-center">
                            <!--begin::Label-->
                            <div id="kt_signin_password">
                                <div class="fs-6 fw-bolder mb-1">Password</div>
                                <div class="fw-bold text-gray-600">************</div>
                            </div>
                            <!--end::Label-->
                            <!--begin::Edit-->
                            <div id="kt_signin_password_edit" class="flex-row-fluid d-none">
                                <!--begin::Form-->
                                <form id="kt_signin_change_password" class="form" novalidate="novalidate">
                                    <input type="hidden" name="action" value="aireno_change_user_password">
                                    <input type="hidden" name="user_id" value="<?= $user_id ?>">
                                    <div class="row mb-1">
                                        <div class="col-lg-4">
                                            <div class="fv-row mb-0">
                                                <label for="currentpassword"
                                                       class="form-label fs-6 fw-bolder mb-3">Current
                                                    Password</label>
                                                <input type="password"
                                                       class="form-control form-control-lg form-control-solid"
                                                       name="currentpassword" id="currentpassword"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="fv-row mb-0">
                                                <label for="newpassword" class="form-label fs-6 fw-bolder mb-3">New
                                                    Password</label>
                                                <input type="password"
                                                       class="form-control form-control-lg form-control-solid"
                                                       name="newpassword" id="newpassword"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="fv-row mb-0">
                                                <label for="confirmpassword"
                                                       class="form-label fs-6 fw-bolder mb-3">Confirm
                                                    New Password</label>
                                                <input type="password"
                                                       class="form-control form-control-lg form-control-solid"
                                                       name="confirmpassword" id="confirmpassword"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-text mb-5">Password must be at least 8 character and contain
                                        symbols
                                    </div>
                                    <div class="d-flex">
                                        <button id="kt_password_submit" type="button"
                                                class="btn btn-primary me-2 px-6">
                                            <span class="indicator-label">Update Password</span>
                                            <span class="indicator-progress">Please wait...
                                            <span
                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                        <button id="kt_password_cancel" type="button"
                                                class="btn btn-color-gray-400 btn-active-light-primary px-6">Cancel
                                        </button>
                                    </div>
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Edit-->
                            <!--begin::Action-->
                            <div id="kt_signin_password_button" class="ms-auto">
                                <button class="btn btn-light btn-active-light-primary">
                                    Reset Password
                                </button>
                            </div>
                            <!--end::Action-->
                        </div>
                        <!--end::Password-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Sign-in Method-->

                <!--begin::Deactivate Account-->
                <div class="card d-none">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                         data-bs-target="#kt_account_settings_deactivate" aria-expanded="true"
                         aria-controls="kt_account_deactivate">
                        <div class="card-title m-0">
                            <h3 class="fw-bolder m-0">Deactivate Account</h3>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Content-->
                    <div class="card-body collapse" id="kt_account_settings_deactivate">
                        <!--begin::Form-->
                        <form id="kt_account_deactivate_form" class="form">
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                <!--begin::Notice-->
                                <div
                                        class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
                                    <!--begin::Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                                    <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none">
                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10"
                                              fill="currentColor"/>
                                        <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)"
                                              fill="currentColor"/>
                                        <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)"
                                              fill="currentColor"/>
                                    </svg>
                                </span>
                                    <!--end::Svg Icon-->
                                    <!--end::Icon-->
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-stack flex-grow-1">
                                        <!--begin::Content-->
                                        <div class="fw-bold">
                                            <h4 class="text-gray-900 fw-bolder">You Are Deactivating Your Account</h4>

                                            <div class="fs-6 text-gray-700">For extra security, this requires you to
                                                confirm your email or phone number when you reset yousignr password.
                                                <br/>
                                                <a class="fw-bolder" href="javascript:void(0)">Learn more</a>
                                            </div>
                                        </div>
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Notice-->
                                <!--begin::Form input row-->
                                <div class="form-check form-check-solid fv-row">
                                    <input name="deactivate" class="form-check-input" type="checkbox" value=""
                                           id="deactivate"/>
                                    <label class="form-check-label fw-bold ps-2 fs-6" for="deactivate">I confirm my
                                        account deactivation</label>
                                </div>
                                <!--end::Form input row-->
                            </div>
                            <!--end::Card body-->
                            <!--begin::Card footer-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button id="kt_account_deactivate_account_submit" type="submit"
                                        class="btn btn-danger fw-bold">Deactivate Account
                                </button>
                            </div>
                            <!--end::Card footer-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Deactivate Account-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->
<?php
get_footer();