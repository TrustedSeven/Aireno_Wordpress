<?php
/**
 * The template for displaying Author's Profile
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package aireon
 * @since 1.0
 */
get_header();

global $wp_query;
$curauth = $wp_query->get_queried_object();
$user_id = $curauth->ID;

$user_data = get_userdata($user_id);
$user_login = $user_data->user_login;
$user_login = str_replace('user', '', $user_login);
$display_name = $user_data->data->display_name;
$user_email = $user_data->data->user_email;

$address = get_field('_address', 'user_' . $user_id);
$phone = get_field('_phone', 'user_' . $user_id);

$avatar = get_field('_avatar', 'user_' . $user_id);
if ($avatar) {
    $avatar_url = $avatar['url'];
} else {
    $avatar_url = get_avatar_url($user_id);
}

if (is_business($user_id)) {
    $business_logo = $avatar = get_field('_business_logo', 'user_' . $user_id);
    if ($business_logo) {
        $business_logo_url = $business_logo['url'];
    } else {
        if (has_custom_logo()) {
            $custom_logo_id = get_theme_mod('custom_logo');
            $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
            $business_logo_url = $logo[0];
        } else {
            $business_logo_url = get_theme_file_uri('assets/images/logo.png');
        }
    }
    $company_name = get_field('_company_name', 'user_' . $user_id);
    $company_abn = get_field('_company_abn', 'user_' . $user_id);
    $company_margin = get_field('_company_margin', 'user_' . $user_id);
    if (!$company_margin) $company_margin = 30;
}
$reviw_count = aireno_get_user_review_count($user_id);


?>
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Navbar-->
                <div class="card mb-6">
                    <div class="card-body pt-9 pb-0">
                        <!--begin::Details-->
                        <div class="d-flex flex-wrap flex-sm-nowrap">
                            <?php
                            if (is_business($user_id)) {
                                ?>
                                <!--begin: Pic-->
                                <div class="me-7 mb-4">
                                    <span class="symbol symbol-100px symbol-lg-160px">
                                        <span class="symbol-label">
                                            <img class="mw-100 p-5" src="<?= $business_logo_url; ?>" alt="Logo"/>
                                        </span>
                                    </span>
                                </div>
                                <!--end::Pic-->
                                <?php
                            } else {
                                ?>
                                <!--begin: Pic-->
                                <div class="me-7 mb-4">
                                    <span class="symbol symbol-100px symbol-lg-160px">
                                        <span class="symbol-label">
                                            <img class="mw-100" src="<?= $avatar_url ?>" alt="avatar"/>
                                        </span>
                                    </span>
                                </div>
                                <!--end::Pic-->
                                <?php
                            }
                            ?>
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                                <!--begin::Title-->
                                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                    <!--begin::User-->
                                    <div class="d-flex flex-column">
                                        <!--begin::Name-->
                                        <div class="d-flex align-items-center mb-2">
                                            <?php
                                            if (is_business($user_id)) {
                                                ?>
                                                <div class="symbol symbol-35px symbol-circle m-1"
                                                     data-bs-toggle="tooltip" title="<?= $display_name ?>">
                                                    <img class="mw-100" src="<?= $avatar_url ?>" alt="avatar"/>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            <a href="<?= get_author_posts_url($user_id) ?>"
                                               class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1"
                                               id="aireno_user_name"><?= $display_name ?></a>
                                            <?php
                                            if (pmpro_hasMembershipLevel(null, $user_id)) {
                                                ?>
                                                <a href="javascript:void(0)">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen026.svg-->
                                                    <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                                         height="24px" viewBox="0 0 24 24">
                                                        <path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z"
                                                              fill="#00A3FF"/>
                                                        <path class="permanent"
                                                              d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z"
                                                              fill="white"/>
                                                    </svg>
                                                </span>
                                                    <!--end::Svg Icon-->
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <!--end::Name-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                                          <?php if(is_business($user_id)): ?> 
                                          <a href="https://abr.business.gov.au/Search/ResultsActive?SearchText=<?= $company_name ?>"
                                               target="_blank" class="d-flex align-items-center text-gray-400 fw-bolder text-hover-primary me-5 ms-2 mb-2">
                                          <i class="fa-regular fa-briefcase me-1"></i> <?= $company_name ?>
                                          </a>  
                                              <?php endif ;?>
                                            
                                            <a href="javascript:void(0)"
                                               class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                                                <span class="svg-icon svg-icon-4 me-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                         height="24" viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3"
                                                              d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z"
                                                              fill="currentColor"/>
                                                        <path d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
                                                              fill="currentColor"/>
                                                    </svg>
                                                </span>
                                                <?= ($address) ? $address : '' ?>
                                            </a>
                                            <?php
                                            if (is_business($user_id)) {
                                                ?>
                                                <a href="javascript:void(0)"
                                                   class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                                    <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                                    <span class="svg-icon svg-icon-4 me-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                         height="24" viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3"
                                                              d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z"
                                                              fill="currentColor"/>
                                                        <path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z"
                                                              fill="currentColor"/>
                                                    </svg>
                                                </span>
                                                    <?= $user_email ?>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                    <?php
                                    if (!is_user_logged_in()) {
                                        ?>
                                        <!--begin::Actions-->
                                        <div class="d-flex my-4">
                                            <a href="<?= aireno_get_page_link_by_name("login") ?>"
                                               class="btn btn-sm btn-primary me-2">Message</a>
                                        </div>
                                        <!--end::Actions-->
                                        <?php
                                    } else if (is_business($user_id) && (is_user_logged_in() && $user_id != get_current_user_id())) {
                                        ?>
                                        <!--begin::Actions-->
                                        <div class="d-flex my-4">
                                            <a href="mailto:<?= $user_email ?>" class="btn btn-sm btn-primary me-2">Message</a>
                                        </div>
                                        <!--end::Actions-->
                                        <?php
                                    }
                                    ?>
                                </div>
                                <!--end::Title-->
                                <!--begin::Stats-->
                                <div class="d-flex flex-wrap flex-stack">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column flex-grow-1 pe-8">
                                        <!--begin::Stats-->
                                        <div class="d-flex flex-wrap">
                                            <!--begin::Projects-->
                                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                <!--begin::Number-->
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->
                                                    <span class="svg-icon svg-icon-3 svg-icon-danger me-2">
																		<svg xmlns="http://www.w3.org/2000/svg"
                                                                             width="24" height="24" viewBox="0 0 24 24"
                                                                             fill="none">
																			<rect opacity="0.5" x="11" y="18" width="13"
                                                                                  height="2" rx="1"
                                                                                  transform="rotate(-90 11 18)"
                                                                                  fill="currentColor"/>
																			<path d="M11.4343 15.4343L7.25 11.25C6.83579 10.8358 6.16421 10.8358 5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75L11.2929 18.2929C11.6834 18.6834 12.3166 18.6834 12.7071 18.2929L18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25C17.8358 10.8358 17.1642 10.8358 16.75 11.25L12.5657 15.4343C12.2533 15.7467 11.7467 15.7467 11.4343 15.4343Z"
                                                                                  fill="currentColor"/>
																		</svg>
																	</span>
                                                    <!--end::Svg Icon-->
                                                    <div class="fs-2 fw-bolder" data-kt-countup="true"
                                                         data-kt-countup-value="<?= aireno_get_user_projects_count($user_id) ?>"><?= aireno_get_user_projects_count($user_id) ?></div>
                                                </div>
                                                <!--end::Number-->
                                                <!--begin::Label-->
                                                <div class="fw-bold fs-6 text-gray-400">Projects</div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Projects-->
                                            <!--begin::Reviews-->
                                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                <!--begin::Number-->
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->
                                                    <span class="svg-icon svg-icon-3 svg-icon-danger me-2">
																		<svg xmlns="http://www.w3.org/2000/svg"
                                                                             width="24" height="24" viewBox="0 0 24 24"
                                                                             fill="none">
																			<rect opacity="0.5" x="11" y="18" width="13"
                                                                                  height="2" rx="1"
                                                                                  transform="rotate(-90 11 18)"
                                                                                  fill="currentColor"/>
																			<path d="M11.4343 15.4343L7.25 11.25C6.83579 10.8358 6.16421 10.8358 5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75L11.2929 18.2929C11.6834 18.6834 12.3166 18.6834 12.7071 18.2929L18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25C17.8358 10.8358 17.1642 10.8358 16.75 11.25L12.5657 15.4343C12.2533 15.7467 11.7467 15.7467 11.4343 15.4343Z"
                                                                                  fill="currentColor"/>
																		</svg>
																	</span>
                                                    <!--end::Svg Icon-->
                                                    <div class="fs-2 fw-bolder" data-kt-countup="true"
                                                         data-kt-countup-value="<?= $reviw_count ?>"><?= $reviw_count ?></div>
                                                </div>
                                                <!--end::Number-->
                                                <!--begin::Label-->
                                                <div class="fw-bold fs-6 text-gray-400">Reviews</div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Reviews-->
                                        </div>
                                        <!--end::Stats-->
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Progress-->
                                    <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                                        <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                            <span class="fw-bold fs-6 text-gray-400">Profile Completion</span>
                                            <span class="fw-bolder fs-6"><?= get_profile_completion_percent($user_id) ?>%</span>
                                        </div>
                                        <div class="h-5px mx-3 w-100 bg-light mb-3">
                                            <div class="bg-success rounded h-5px" role="progressbar"
                                                 style="width: <?= get_profile_completion_percent($user_id) ?>%;"
                                                 aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <!--end::Progress-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Details-->
                        <?php
                        if ($user_id == get_current_user_id()) {
                            ?>
                            <!--begin::Navs-->
                            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder">
                                <!--begin::Nav item-->
                                <li class="nav-item mt-2">
                                    <a class="nav-link text-active-primary ms-0 me-10 py-5 "
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
                                <li class="nav-item mt-2 ">
                                    <a class="nav-link text-active-primary ms-0 me-10 py-5 active"
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
                            <?php
                        }
                        ?>

                    </div>
                </div>
                <!--end::Navbar-->
                <?php
                if (is_business($user_id)) {
                    if (!pmpro_hasMembershipLevel(null, $user_id) && $user_id == get_current_user_id()) {
                        ?>
                        <div class="card mb-7">
                            <div class="card-body">
                                <h2 class="mb-5">Sorry, you do not have an active membership.</h2>
                                <p class="mb-5">Your profile content will be hidden until you purchase a membership. Upgrade to business to enable your clients to quote on autopilot.</p>
                                <a class="btn btn-danger" href="<?= get_site_url() ?>/#pricing">Purchase Membership</a>
                            </div>
                        </div>

                        <?php
                    }
                    if (pmpro_hasMembershipLevel(null, $user_id) || $user_id == get_current_user_id()) {
                        ?>
                        <!--begin:Map, Services-->
                        <div class="row">
                            <!--begin:Map-->
                            <div class="col-md-6 mb-6">
                                <div class="card h-100 p-3">
                                    <iframe class="rounded-2 w-100" width="480" height="360"
                                            src="https://maps.google.it/maps?q=<?php echo $address; ?>&output=embed&z=17">
                                    </iframe>
                                </div>

                            </div>
                            <!--end:Map-->
                            <!--begin:Services-->
                            <div class="col-md-6 mb-6">
                                <div class="card h-100 p-3">
                                    <!--begin::Card header-->
                                    <div class="card-header border-0 cursor-pointer px-0 min-h-40px pb-3">
                                        <h3 class="fw-bolder m-0 py-2 fs-1">Company Details</h3>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Content-->
                                    <div class="border-top pt-9 px-3">
                                        <div class="scroll-y h-275px"
                                             data-kt-scroll="true"
                                             data-kt-scroll-activate="{default: false, lg: true}"
                                             data-kt-scroll-max-height="auto"
                                             data-kt-scroll-offset="5px">
                                            <?php
                                            if ($company_name) {
                                                ?>
                                                <!--begin:Name-->
                                                <div class="d-flex align-items-center mb-7">
                                                    <!--begin::Bullet-->
                                                    <span class="bullet bullet-vertical h-40px bg-danger me-5"></span>
                                                    <!--end::Bullet-->
                                                    <!--begin::Description-->
                                                    <div class="flex-grow-1">
                                                        <span class="text-muted fw-bold d-block">Company Name</span>
                                                        <a href="javascript:void(0)"
                                                           class="text-gray-800 text-hover-primary fw-bolder fs-3"><?= $company_name ?></a>
                                                    </div>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end:Name-->
                                                <?php
                                            }
                                            ?>
                                            <?php
                                            if ($company_abn) {
                                                ?>
                                                <!--begin:ABN-->
                                                <div class="d-flex align-items-center mb-7">
                                                    <!--begin::Bullet-->
                                                    <span class="bullet bullet-vertical h-40px bg-danger me-5"></span>
                                                    <!--end::Bullet-->
                                                    <!--begin::Description-->
                                                    <div class="flex-grow-1">
                                                        <span class="text-muted fw-bold d-block">ABN</span>
                                                        <a href="javascript:void(0)"
                                                           class="text-gray-800 text-hover-primary fw-bolder fs-3"><?= $company_abn ?></a>
                                                    </div>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end:ABN-->
                                                <?php
                                            }
                                            $company_services = get_field('_company_services', 'user_' . $user_id);
                                            if (!$company_services) $company_services = array();
                                            if (count($company_services) > 0) {
                                                $srevices_offer = [];
                                                foreach ($company_services as $company_service) {
                                                    $services_offer[] = ucwords(get_term($company_service)->name);
                                                }
                                                ?>
                                                <!--begin:Services-->
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Bullet-->
                                                    <span class="bullet bullet-vertical min-h-40px bg-danger me-5"></span>
                                                    <!--end::Bullet-->
                                                    <!--begin::Description-->
                                                    <div class="flex-grow-1">
                                                        <span class="text-muted fw-bold d-block">Services we offer</span>
                                                        <a href="javascript:void(0)"
                                                           class="text-gray-800 text-hover-primary fw-bolder fs-3"><?= implode(', ', $services_offer) ?></a>
                                                    </div>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end:Services-->
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <!--end::Content-->
                                </div>
                            </div>
                            <!--end:Services-->
                        </div>
                        <!--end:Map, Services-->
                        <!--begin:Reviews, Portfolio-->
                        <div class="row">
                            <!--begin:Reviews-->
                           <?php  
                           $reviews = get_field('reviews', 'user_' . $user_id);
                           if(!empty($reviews)) :?>
                            <div class="col-md-6 mb-6">
                                <div class="card h-100 p-3">
                                    <!--begin::Card header-->
                                    <div class="card-header border-0 cursor-pointer px-0 min-h-40px pb-3">
                                        <h3 class="fw-bolder m-0 py-2 fs-1">Reviews</h3>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Content-->
                                    <div class="border-top pt-9">
                                        <?php
                                        $reviews = get_field('reviews', 'user_' . $user_id);
                                        if (!$reviews) $reviews = array();
                                        if (count($reviews) > 0) {
                                            ?>
                                            <!--begin:Reviews-->
                                            <div class="scroll-y h-500px px-3"
                                                 data-kt-scroll="true"
                                                 data-kt-scroll-activate="{default: false, lg: true}"
                                                 data-kt-scroll-max-height="auto"
                                                 data-kt-scroll-offset="5px">
                                                <?php
                                                foreach ($reviews as $review) {
                                                    $project = get_post($review['project_id']);
                                                    if ($project) {
                                                        $title = $project->post_title;
                                                        $link = get_permalink($project);
                                                    } else {
                                                        $title = "This project has been deleted.";
                                                        $link = "javascript:void(0)";
                                                    }

                                                    $reviewer_userdata = aireno_get_userdata($review['user_id']);
                                                    ?>
                                                    <!--begin:Review Item-->
                                                    <div class="mb-6 border-bottom border-2 pb-6">
                                                        <h3 class="mb-2">
                                                            <a class="text-dark" href="<?= $link ?>">
                                                                <?= $title ?>
                                                            </a>
                                                        </h3>
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
                                                            echo nl2br($review['review']);
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
                                                            <p class="mb-0"><?= date_i18n('M, j Y', strtotime($review['review_date'])) ?></p>
                                                        </div>
                                                    </div>
                                                    <!--end:Review Item-->
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <!--end:Reviews-->
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <!--end::Content-->
                                </div>

                            </div>
                          <?php endif ;?>
                            <!--end:Reviews-->
                            <!--begin:Portfolio-->
                           <?php  
                           $portfolios = get_field('_company_portfolios', 'user_' . $user_id);
                           if(!empty($portfolios)) :?>
                            <div class="col-md-6 mb-6">
                                <div class="card h-100 p-3">
                                    <!--begin::Card header-->
                                    <div class="card-header border-0 cursor-pointer px-0 min-h-40px pb-3">
                                        <h3 class="fw-bolder m-0 py-2 fs-1">Portfolio</h3>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Content-->
                                    <div class="border-top pt-9">
                                        <?php
                                        $portfolios = get_field('_company_portfolios', 'user_' . $user_id);
                                        if (!$portfolios) $portfolios = array();
                                        if (count($portfolios) > 0) {
                                            ?>
                                            <div class="scroll-y h-500px px-3"
                                                 data-kt-scroll="true"
                                                 data-kt-scroll-activate="{default: false, lg: true}"
                                                 data-kt-scroll-max-height="auto"
                                                 data-kt-scroll-offset="5px">
                                                <div class="row">
                                                    <?php
                                                    foreach ($portfolios as $portfolio) {
                                                        $src = wp_get_attachment_image_url($portfolio, 'full');
                                                        ?>
                                                        <!--begin::Col-->
                                                        <div class="col-md-6 mb-6">
                                                            <!--begin::Card-->
                                                            <div class="card h-250px">
                                                                <!--begin::Overlay-->
                                                                <a class="rounded bg-info h-100 d-block overlay"
                                                                   data-fslightbox="lightbox-basic" href="<?= $src ?>">
                                                                    <!--begin::Image-->
                                                                    <div class="h-100 d-block overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded"
                                                                         style="background-image:url('<?= $src ?>')">
                                                                        <img src="<?= $src ?>"
                                                                             class="mw-300px h-auto invisible">
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
                                                    ?>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <!--end::Content-->
                                </div>
                            </div>
                           <?php endif ;?>
                            <!--end:Portfolio-->
                        </div>
                        <!--end:Reviews, Portfolio-->
                        <?php
                        $templates = array();
                        foreach ($company_services as $company_service) {
                            $args = array(
                                'post_type' => 'template',
                                'post_status' => 'publish',
                                'posts_per_page' => -1,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'quote-tag',
                                        'field' => 'term_id',
                                        'terms' => $company_service, /// Where term_id of Term 1 is "1".
                                        'include_children' => false
                                    )
                                ),
                            );
                            $templates_query = new WP_Query($args);
                            while ($templates_query->have_posts()) {
                                $templates_query->the_post();
                                $templates[] = get_the_ID();
                            }
                        }
                        $templates = array_unique($templates);

                        if (count($templates) > 0) {
                            ?>
                            <!--begin:Instant Quotes-->
                            <div class="">
                                <h2 class="mb-4">Get an instant quote from <?= $company_name ?></h2>
                                <div class="row">
                                    <?php
                                    foreach ($templates as $template) {
                                        $img = get_field('template_icon', $template);
                                        $link = aireno_get_page_link_by_name('add-quote');
                                        $redirects = array(
                                            'q' => $template,
                                            'b' => $user_id,
                                        );
                                        $link = add_query_arg($redirects, $link);
                                        $time = get_field('time', $template);
                                        $type = get_field('level_type', $template);
                                        if (!is_user_logged_in())
                                            $link = wp_sanitize_redirect(
                                                add_query_arg(
                                                    array(
                                                        'redirect' => urlencode(base64_encode($link)),
                                                    ),
                                                    aireno_get_page_link_by_name('login')
                                                )
                                            );
                                        ?>
                                        <div class="col-md-2 col-6 kt-quote">
                                            <!--begin::Publications post-->
                                            <a class="d-block btn btn-outline border-dashed border-danger bg-white bg-hover-light-danger h-200px"
                                                data-template="<?= $template ?>"
                                               href="<?= $link ?>">
                                                <!--begin::Overlay-->
                                                <!--begin:Icon-->
                                                 <span class="badge badge-square badge-light-danger"><i class="fa-regular fa-timer text-danger"></i> <?= $time ?> mins</span> 
                                                  <!--begin:Icon-->
                                         <span class="symbol symbol-100px">
                                          <span class="symbol-label bg-light-danger">
                                            <i class="<?php echo $img; ?> fs-3x text-danger fw-bolder p-0"></i>
                                          </span>
                                        </span>
                                                  <!--end:Icon-->
                                                  <!--begin:Info-->
                                         <span class="d-flex flex-column">
                                          <span class="fw-bolder text-dark fs-3"><?= get_post($template)->post_title ?></span>
                                        </span>
                                     <!--end:Info-->
                                    <span class="badge badge-square badge-light-danger"><i class="fa-solid fa-filter text-danger"></i> <?= $type ?></span>
                                            </a>
                                            <!--end::Overlay-->
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <!--end:Instant Quotes-->
                            <?php
                        } else {

                        }
                    }
                } else {
                    ?>
                    <!--begin:Map, Reviews-->
                    <div class="row">
                        <!--begin:Map-->
                        <div class="col-md-6 mb-6">
                            <div class="card p-3">
                                <iframe class="rounded-2 w-100" width="640" height="360"
                                        src="https://maps.google.it/maps?q=<?php echo $address; ?>&output=embed&z=17">
                                </iframe>
                            </div>

                        </div>
                        <!--end:Map-->
                        <!--begin:Reviews-->
                        <div class="col-md-6">
                            <div class="card h-100 p-3">
                                <!--begin::Card header-->
                                <div class="card-header border-0 cursor-pointer px-0 min-h-40px pb-3">
                                    <h3 class="fw-bolder m-0 py-2 fs-1">Reviews</h3>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Content-->
                                <div class="border-top pt-9">
                                    <?php
                                    $reviews = get_field('reviews', 'user_' . $user_id);
                                    if (!$reviews) $reviews = array();
                                    if (count($reviews) > 0) {
                                        ?>
                                        <!--begin:Reviews-->
                                        <div class="scroll-y h-500px px-3"
                                             data-kt-scroll="true"
                                             data-kt-scroll-activate="{default: false, lg: true}"
                                             data-kt-scroll-max-height="auto"
                                             data-kt-scroll-offset="5px">
                                            <?php
                                            foreach ($reviews as $review) {
                                                $project = get_post($review['project_id']);
                                                if ($project) {
                                                    $title = $project->post_title;
                                                    $link = get_permalink($project);
                                                } else {
                                                    $title = "This project had been deleted.";
                                                    $link = "javascript:void(0)";
                                                }

                                                $reviewer_userdata = aireno_get_userdata($review['user_id']);
                                                ?>
                                                <!--begin:Review Item-->
                                                <div class="mb-6 border-bottom border-2 pb-6">
                                                    <h3 class="mb-2">
                                                        <a class="text-dark" href="<?= $link ?>">
                                                            <?= $title ?>
                                                        </a>
                                                    </h3>
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
                                                        echo nl2br($review['review']);
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
                                                        <p class="mb-0"><?= date_i18n('M, j Y', strtotime($review['review_date'])) ?></p>
                                                    </div>
                                                </div>
                                                <!--end:Review Item-->
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <!--end:Reviews-->
                                        <?php
                                    }
                                    ?>
                                </div>
                                <!--end::Content-->
                            </div>

                        </div>
                        <!--end:Reviews-->
                    </div>
                    <!--end:Map, Reviews-->
                    <?php
                }
                ?>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->
<?php
get_footer();
