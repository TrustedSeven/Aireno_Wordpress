<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <?php wp_head(); ?>
</head>
<!--begin::Body-->
<?php
//aside-enabled aside-fixed
if (is_user_logged_in()) {
    $user_id = get_current_user_id();
}
?>
<body id="kt_body" <?php body_class('header-fixed header-tablet-and-mobile-fixed aside-enabled'); ?>
      style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px" data-kt-aside-minimize="on">
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <!--begin::Header-->
    <div class="landing-header" data-kt-sticky="true" data-kt-sticky-name="landing-header"
         data-kt-sticky-offset="{default: '200px', lg: '300px'}">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Wrapper-->
            <div class="d-flex align-items-center justify-content-between">
                <!--begin::Logo-->
                <div class="d-flex align-items-center flex-equal">
                    <!--begin::Mobile menu toggle-->
                    <button class="btn btn-icon btn-active-color-primary me-3 d-flex d-lg-none"
                            id="kt_landing_menu_toggle">
                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                        <span class="svg-icon svg-icon-2hx">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none">
                                <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                                      fill="currentColor"/>
                                <path opacity="0.3"
                                      d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                                      fill="currentColor"/>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </button>
                    <!--end::Mobile menu toggle-->
                    <!--begin::Logo image-->
                    <a href="<?= site_url() ?>">
                        <?php
                        if (has_custom_logo()) {
                            $custom_logo_id = get_theme_mod('custom_logo');
                            $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                            ?>
                            <img src="<?= esc_url($logo[0]) ?>" alt="<?= get_bloginfo('name') ?>"
                                 class="logo-default h-35px h-lg-40px">
                            <img src="<?= esc_url($logo[0]) ?>" alt="<?= get_bloginfo('name') ?>"
                                 class="logo-sticky h-30px h-lg-35px">
                            <?php
                        } else {
                            ?>
                            <img alt="Logo" src="<?= get_theme_file_uri("assets/images/logo.png") ?>"
                                 class="logo-default h-35px h-lg-40px"/>
                            <img alt="Logo" src="<?= get_theme_file_uri("assets/images/logo.png") ?>"
                                 class="logo-sticky h-30px h-lg-35px"/>
                            <?php
                        }
                        ?>
                    </a>

                    <!--begin::Menu wrapper-->
                    <div class="d-lg-block" id="kt_header_nav_wrapper">
                        <div class="d-lg-block p-5 p-lg-0" data-kt-drawer="true" data-kt-drawer-name="landing-menu"
                             data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                             data-kt-drawer-width="200px" data-kt-drawer-direction="start"
                             data-kt-drawer-toggle="#kt_landing_menu_toggle" data-kt-swapper="true"
                             data-kt-swapper-mode="prepend"
                             data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav_wrapper'}">
                            <!--begin::Menu-->
                            <?php wp_nav_menu(
                                array(
                                    'menu' => 'primary',
                                    'menu_class' => 'primary',
                                    'container' => 'div', // parent container
                                    'container_class' => 'menu menu-column flex-nowrap menu-rounded menu-lg-row menu-title-gray-800 nav nav-flush fw-bolder',
                                    'container_id' => 'kt_landing_menu', //parent container ID
                                    'before' => '',
                                    'after' => '',
                                    'link_before' => '',
                                    'link_after' => '',
                                    'items_wrap' => '%3$s', // removes ul
                                    'walker' => new Aireno_Walker_Nav_Menu // custom walker to replace li with div
                                )
                            );
                            ?>
                            <!--end::Menu-->
                        </div>
                    </div>
                    <!--end::Menu wrapper-->
                    <!--end::Logo image-->
                </div>
                <!--end::Logo-->

                <!--begin::Toolbar-->
                <?php
                /*if user logged in display the welcome text else display the signin button */
                if (is_user_logged_in()) {
                    ?>
                  <!--begin::Toolbar wrapper-->
                    <div class="d-flex align-items-stretch flex-shrink-0">
                        <?php
                        $unread_messages = aireno_get_unread_messages($user_id);
                        $unread_notifications = aireno_get_unread_notifications($user_id);
                        $unread_messages_count = count($unread_messages);
                        $unread_notifications_count = count($unread_notifications);
                        ?>
                        <!--begin::Notifications-->
                        <div class="d-flex align-items-center ms-1 ms-lg-3">
                            <!--begin::Menu- wrapper-->
                            <div class="position-relative btn btn-icon btn-icon-muted btn-active-light btn-active-color-primary w-30px h-30px w-md-40px h-md-40px"
                                 data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                                 data-kt-menu-placement="bottom-end">
                                <i class="fa-regular fa-bell-on fs-3 fw-bold"></i>
                                <?php
                                if ($unread_messages_count + $unread_notifications_count > 0) {
                                    ?>
                                    <span class="position-absolute top-0 mt-n2 left-0 badge bg-danger rounded-circle"><?= $unread_messages_count + $unread_notifications_count ?></span>
                                    <?php
                                }
                                ?>
                            </div>
                            <!--end::Menu Wrapper-->
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px"
                                 data-kt-menu="true">
                                <!--begin::Heading-->
                                <div class="d-flex flex-column rounded-top pt-5 bg-primary">
                                    <!--begin::Tabs-->
                                   <ul class="nav nav-line-tabs justify-content-center nav-line-tabs-2x nav-stretch fw-bold px-9 w-100">
                                        <li class="nav-item w-50 text-center">
                                            <a class="nav-link text-white opacity-75 opacity-state-100 fw-bolder pb-2 ms-0 me-3 active"
                                               data-bs-toggle="tab" href="#kt_topbar_notifications_1"><i class="fa-regular fa-bells me-2 text-light"></i> Notifications
                                          <?php
                                            if ($unread_notifications_count > 0) {
                                                ?>
                                                <span class="badge bg-danger rounded-circle"><?= $unread_notifications_count ?></span>
                                                <?php
                                            }
                                            ?>
                                          </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-white opacity-75 opacity-state-100 fw-bolder pb-2 ms-0 me-3"
                                               data-bs-toggle="tab" href="#kt_topbar_notifications_3"><i class="fa-regular fa-messages me-2 text-light"></i> Messages
                                          <?php
                                            if ($unread_messages_count > 0) {
                                                ?>
                                                <span class="badge bg-danger rounded-circle"><?= $unread_messages_count ?></span>
                                                <?php
                                            }
                                            ?></a>
                                        </li>
                                    </ul>
                                  <!--end::Tabs-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Tab content-->
                                <div class="tab-content">
                                    <!--begin::Tab panel-->
                                    <div class="tab-pane fade show active" id="kt_topbar_notifications_1"
                                         role="tabpanel">
                                        <!--begin::Items-->
                                        <div class="scroll-y mh-325px mt-5">
                                            <?php
                                            if ($unread_notifications_count > 0) {
                                                foreach ($unread_notifications as $unread_notification) {
                                                    $notification = get_post($unread_notification);
                                                    $content = aireno_decode_content($notification->post_content);
                                                    $description = wp_strip_all_tags($content->description);
                                                    if (strlen($description) >= 39) {
                                                        $description = substr($description, 0, 36) . '...';
                                                    }
                                                    $link = $content->link;
                                                    $link = add_query_arg(
                                                        array('nm' => $unread_notification),
                                                        $link
                                                    );
                                                    $datetime = date_i18n('M d, Y g:i:a', strtotime($notification->post_date));
                                                    ?>
                                                    <!--begin::Item-->
                                                    <a href="<?= $link ?>"
                                                       class="d-flex flex-stack py-4 bg-hover-light-danger ps-4 border-bottom">
                                                        <!--begin::Section-->
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Symbol-->
                                                            <div class="symbol symbol-35px me-4">
                                                            <span class="symbol-label bg-light-primary">
                                                                <!--begin::Svg Icon | path: icons/duotune/technology/teh008.svg-->
                                                                <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                         height="24" viewBox="0 0 24 24" fill="none">
                                                                        <path opacity="0.3"
                                                                              d="M11 6.5C11 9 9 11 6.5 11C4 11 2 9 2 6.5C2 4 4 2 6.5 2C9 2 11 4 11 6.5ZM17.5 2C15 2 13 4 13 6.5C13 9 15 11 17.5 11C20 11 22 9 22 6.5C22 4 20 2 17.5 2ZM6.5 13C4 13 2 15 2 17.5C2 20 4 22 6.5 22C9 22 11 20 11 17.5C11 15 9 13 6.5 13ZM17.5 13C15 13 13 15 13 17.5C13 20 15 22 17.5 22C20 22 22 20 22 17.5C22 15 20 13 17.5 13Z"
                                                                              fill="currentColor"/>
                                                                        <path d="M17.5 16C17.5 16 17.4 16 17.5 16L16.7 15.3C16.1 14.7 15.7 13.9 15.6 13.1C15.5 12.4 15.5 11.6 15.6 10.8C15.7 9.99999 16.1 9.19998 16.7 8.59998L17.4 7.90002H17.5C18.3 7.90002 19 7.20002 19 6.40002C19 5.60002 18.3 4.90002 17.5 4.90002C16.7 4.90002 16 5.60002 16 6.40002V6.5L15.3 7.20001C14.7 7.80001 13.9 8.19999 13.1 8.29999C12.4 8.39999 11.6 8.39999 10.8 8.29999C9.99999 8.19999 9.20001 7.80001 8.60001 7.20001L7.89999 6.5V6.40002C7.89999 5.60002 7.19999 4.90002 6.39999 4.90002C5.59999 4.90002 4.89999 5.60002 4.89999 6.40002C4.89999 7.20002 5.59999 7.90002 6.39999 7.90002H6.5L7.20001 8.59998C7.80001 9.19998 8.19999 9.99999 8.29999 10.8C8.39999 11.5 8.39999 12.3 8.29999 13.1C8.19999 13.9 7.80001 14.7 7.20001 15.3L6.5 16H6.39999C5.59999 16 4.89999 16.7 4.89999 17.5C4.89999 18.3 5.59999 19 6.39999 19C7.19999 19 7.89999 18.3 7.89999 17.5V17.4L8.60001 16.7C9.20001 16.1 9.99999 15.7 10.8 15.6C11.5 15.5 12.3 15.5 13.1 15.6C13.9 15.7 14.7 16.1 15.3 16.7L16 17.4V17.5C16 18.3 16.7 19 17.5 19C18.3 19 19 18.3 19 17.5C19 16.7 18.3 16 17.5 16Z"
                                                                              fill="currentColor"/>
                                                                    </svg>
                                                                </span>
                                                                <!--end::Svg Icon-->
                                                            </span>
                                                            </div>
                                                            <!--end::Symbol-->
                                                            <!--begin::Title-->
                                                            <div class="mb-0 me-2 text-hover-danger">
                                                                <div class="fs-6 text-gray-800 fw-bolder"><?= $description ?></div>
                                                                <div class="text-gray-400 fs-7"><?= $datetime ?></div>
                                                            </div>
                                                            <!--end::Title-->
                                                        </div>
                                                        <!--end::Section-->
                                                    </a>
                                                    <!--end::Item-->
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                               <div class="mb-0 me-2 text-hover-danger text-center">
                                                            <i class="fa-regular fa-bells text-dark me-2 fs-5x"></i>
                                                          <div class="text-dark">
                                                            No notifications
                                                          </div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <!--begin::Clear All-->
                                        <div class="py-3 text-center border-top">
                                            <a href="javascript:void(0)"
                                               class="btn btn-color-gray-600 btn-active-color-primary"
                                               id="btnClearNotis">Clear All
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                                <span class="svg-icon svg-icon-5">
															<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.5" x="18" y="13" width="13" height="2"
                                                                      rx="1" transform="rotate(-180 18 13)"
                                                                      fill="currentColor"/>
																<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                                      fill="currentColor"/>
															</svg>
														</span>
                                                <!--end::Svg Icon--></a>
                                        </div>
                                        <!--end::Clear All-->
                                    </div>
                                    <!--end::Tab panel-->
                                    <!--begin::Tab panel-->
                                    <div class="tab-pane fade" id="kt_topbar_notifications_3" role="tabpanel">
                                        <!--begin::Items-->
                                        <div class="scroll-y mh-325px mt-5">
                                            <?php
                                            if ($unread_messages_count > 0) {
                                                foreach ($unread_messages as $unread_message) {
                                                    $message = get_post($unread_message);
                                                    $content = wp_strip_all_tags($message->post_content);
                                                    if (strlen($content) >= 39) {
                                                        $content = substr($content, 0, 36) . '...';
                                                    }
                                                    $link = get_permalink(get_field('project_id', $unread_message));
                                                    $link = add_query_arg(
                                                        array('nm' => $unread_message),
                                                        $link
                                                    );
                                                    $datetime = date_i18n('M d, Y g:i:a', strtotime($message->post_date));
                                                    $author_id = $message->post_author;
                                                    $author_data = aireno_get_userdata($author_id);
                                                    ?>
                                                    <!--begin::Item-->
                                                    <a href="<?= $link ?>"
                                                       class="d-flex flex-stack py-4 bg-hover-light-danger ps-4 border-bottom">
                                                        <!--begin::Section-->
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Symbol-->
                                                            <div class="symbol symbol-50px me-4">
                                                            <span class="symbol-label bg-light-primary">
                                                                <img class="w-100 h-auto rounded-circle"
                                                                     src="<?= $author_data->avatar ?>"/>
                                                            </span>
                                                            </div>
                                                            <!--end::Symbol-->
                                                            <!--begin::Title-->
                                                            <div class="mb-0 me-2 text-hover-danger">
                                                                <div class="fs-6 text-gray-800 fw-bolder"><?= $content ?></div>
                                                                <div class="text-gray-400 fs-7"><?= $datetime ?></div>
                                                            </div>
                                                            <!--end::Title-->
                                                        </div>
                                                        <!--end::Section-->
                                                    </a>
                                                    <!--end::Item-->
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                        <div class="mb-0 me-2 text-hover-danger text-center">
                                                            <i class="fa-regular fa-messages text-dark me-2 fs-5x"></i>
                                                          <div class="text-dark">
                                                            No messages
                                                          </div>
                                                        </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <!--end::Items-->
                                        <!--begin::Clear All-->
                                        <div class="py-3 text-center border-top">
                                            <a href="javascript:void(0)"
                                               class="btn btn-color-gray-600 btn-active-color-primary"
                                               id="btnClearMsgs">Clear All
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                                <span class="svg-icon svg-icon-5">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1"
                                                              transform="rotate(-180 18 13)" fill="currentColor"/>
                                                        <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                              fill="currentColor"/>
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </a>
                                        </div>
                                        <!--end::Clear All-->
                                    </div>
                                    <!--end::Tab panel-->
                                </div>
                                <!--end::Tab content-->
                            </div>
                            <!--end::Menu-->
                            <!--end::Menu wrapper-->
                        </div>
                        <!--end::Notifications-->
                        <!--begin::User menu-->
                        <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                            <!--begin::Menu wrapper-->
                            <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click"
                                 data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                <?php

                                $avatar = get_field('_avatar', 'user_' . $user_id);
                                if ($avatar) {
                                    $avatar_url = $avatar['sizes']['thumbnail'];
                                } else {
                                    $avatar_url = get_avatar_url($user_id);
                                }
                                ?>
                                <img src="<?= $avatar_url ?>" alt="user" class="aireno_user_avatar"/>
                            </div>
                            <!--begin::User account menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
                                 data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <div class="menu-content d-flex align-items-center px-3">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-50px me-5">
                                            <img alt="Logo" class="aireno_user_avatar"
                                                 src="<?= $avatar_url ?>"/>
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Username-->
                                        <?php
                                        $userdata = get_userdata($user_id);
                                        $display_name = $userdata->data->display_name;
                                        $user_email = $userdata->data->user_email;
                                        ?>
                                        <div class="d-flex flex-column">
                                            <div class="fw-bolder d-flex align-items-center fs-5"><?= $display_name ?></div>
                                            <a href="mailto:<?= $user_email ?>"
                                               class="fw-bold text-muted text-hover-primary fs-7"><?= $user_email ?></a>
                                        </div>
                                        <!--end::Username-->
                                    </div>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu separator-->
                                <div class="separator my-2"></div>
                                <!--end::Menu separator-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-5">
                                    <a href="<?= get_author_posts_url($user_id) ?>" class="menu-link px-5">My
                                        Profile</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-5">
                                    <a href="<?= aireno_get_page_link_by_name('account-overview') ?>"
                                       class="menu-link px-5">
                                        <span class="menu-text">My Contacts</span>
                                        <span class="menu-badge">
                                            <span class="badge badge-light-danger badge-circle fw-bolder fs-7"><?= aireno_get_contacts_count($user_id) ?></span>
                                        </span>
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-5">
                                    <a href="<?= get_post_type_archive_link(AIRENO_CPT_PROJECT) ?>"
                                       class="menu-link px-5">
                                        <span class="menu-text">My Projects</span>
                                        <span class="menu-badge">
                                            <span class="badge badge-light-danger badge-circle fw-bolder fs-7"><?= aireno_get_user_projects_count($user_id) ?></span>
                                        </span>
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu separator-->
                                <div class="separator my-2"></div>
                                <!--end::Menu separator-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-5 my-1">
                                    <a href="<?= aireno_get_page_link_by_name('account-settings') ?>"
                                       class="menu-link px-5">Account Settings</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-5">
                                    <a href="<?= wp_logout_url(home_url()); ?>" class="menu-link px-5">Sign Out</a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::User account menu-->
                            <!--end::Menu wrapper-->
                        </div>
                        <!--end::User menu-->
                    </div>
                    <!--end::Toolbar wrapper-->
                    <?php
                } else { ?>
                    <div class="flex-equal text-end ms-1">
                        <a href="<?= aireno_get_page_link_by_name('login') ?>" class="btn btn-danger">Sign In</a>
                    </div>
                <?php } ?>

                <!--end::Toolbar-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Header-->