<?php
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
}
$reviw_count = aireno_get_user_review_count($user_id);
?>
<!--begin::Details-->
<div class="d-flex flex-wrap flex-sm-nowrap mb-3">
    <?php
    if (is_business($user_id)) {
        ?>
        <!--begin: Pic-->
        <div class="me-7 mb-4">
          <span class="symbol symbol-100px symbol-lg-160px">
           <span class="symbol-label">
                <img class="mw-100" src="<?= $business_logo_url; ?>" alt="Logo"/>
            </span>
          </span>
            </div>
        <!--end::Pic-->
        <?php
    }
    else {
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
          <div class="symbol symbol-35px symbol-circle m-1" data-bs-toggle="tooltip" title="<?= $display_name ?>">
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
                    <?php
                        if (is_business($user_id)):?>
                   <a href="javascript:void(0)"
                       class="d-flex align-items-center text-gray-400 fw-bolder text-hover-primary me-5 ms-2 mb-2">
                        <i class="fa-regular fa-briefcase me-1"></i> <?= $company_name ?>
                         </a>
                        <?php endif ;?>
                    <a href="javascript:void(0)"
                       class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                        <span class="svg-icon svg-icon-4 me-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                 viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3"
                                      d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z"
                                      fill="currentColor"/>
                                <path
                                        d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
                                        fill="currentColor"/>
                            </svg>
                        </span>
                        <?= ($address) ? $address : ''; ?>
                    </a>
                    <?php
                    if (is_business($user_id)) {
                        ?>
                        <a href="javascript:void(0)"
                           class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                            <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                            <span class="svg-icon svg-icon-4 me-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                 viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3"
                                      d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z"
                                      fill="currentColor"/>
                                <path
                                        d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z"
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="11" y="18" width="13"
                                          height="2" rx="1" transform="rotate(-90 11 18)"
                                          fill="currentColor"/>
                                    <path d="M11.4343 15.4343L7.25 11.25C6.83579 10.8358 6.16421 10.8358 5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75L11.2929 18.2929C11.6834 18.6834 12.3166 18.6834 12.7071 18.2929L18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25C17.8358 10.8358 17.1642 10.8358 16.75 11.25L12.5657 15.4343C12.2533 15.7467 11.7467 15.7467 11.4343 15.4343Z"
                                          fill="currentColor"/>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <div class="fs-2 fw-bolder" data-kt-countup="true"
                                 data-kt-countup-value="<?= aireno_get_user_projects_count($user_id) ?>"><?= aireno_get_user_projects_count($user_id) ?>
                            </div>
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="11" y="18" width="13"
                                          height="2" rx="1" transform="rotate(-90 11 18)"
                                          fill="currentColor"/>
                                    <path d="M11.4343 15.4343L7.25 11.25C6.83579 10.8358 6.16421 10.8358 5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75L11.2929 18.2929C11.6834 18.6834 12.3166 18.6834 12.7071 18.2929L18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25C17.8358 10.8358 17.1642 10.8358 16.75 11.25L12.5657 15.4343C12.2533 15.7467 11.7467 15.7467 11.4343 15.4343Z"
                                          fill="currentColor"/>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <div class="fs-2 fw-bolder" data-kt-countup="true"
                                 data-kt-countup-value="<?= $reviw_count ?>"><?= $reviw_count ?>
                            </div>
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
