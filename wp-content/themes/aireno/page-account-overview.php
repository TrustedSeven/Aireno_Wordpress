<?php
/**
 * Template Name: Contacts Page
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
$user_data  = get_userdata($user_id);
$display_name = $user_data->data->display_name;
$user_email = $user_data->data->user_email;

$address = get_field('_address', 'user_'.$user_id);
$phone = get_field('_phone', 'user_'.$user_id);

$avatar = get_field('_avatar', 'user_'.$user_id);
if ($avatar) {
    $avatar_url = $avatar['url'];
    $avatar_id = $avatar['ID'];
}
else {
    $avatar_url = get_avatar_url($user_id);
    $avatar_id = '';
}

if (is_business($user_id)) {
    $business_logo = $avatar = get_field('_business_logo', 'user_'.$user_id);
    if ($business_logo) {
        $business_logo_url = $business_logo['url'];
        $business_logo_id = $business_logo['ID'];
    }
    else {
        if (has_custom_logo()) {
            $custom_logo_id = get_theme_mod('custom_logo');
            $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
            $business_logo_url = $logo[0];
        } else {
            $business_logo_url = get_theme_file_uri('assets/images/logo.png');
        }
        $business_logo_id = '';
    }
    $company_name = get_field('_company_name', 'user_'.$user_id);
    $company_abn = get_field('_company_abn', 'user_'.$user_id);
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
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5" href="<?= get_author_posts_url($user_id) ?>">Profile</a>
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5" href="<?= get_post_type_archive_link(AIRENO_CPT_PROJECT) ?>">Projects</a>
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5 active"
                                   href="<?= aireno_get_page_link_by_name('account-overview') ?>">Contacts</a>
                            </li>
                            <!--end::Nav item-->
                        </ul>
                        <!--begin::Navs-->
                    </div>
                </div>
                <!--end::Navbar-->
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search user" />
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--begin::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                                <!--begin::Add user-->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_contact">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                    <span class="svg-icon svg-icon-2">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
														<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor" />
													</svg>
												</span>
                                    <!--end::Svg Icon-->
                                    Add User
                                </button>
                                <!--end::Add user-->
                            </div>
                            <!--end::Toolbar-->
                            <!--begin::Group actions-->
                            <div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
                                <div class="fw-bolder me-5">
                                    <span class="me-2" data-kt-user-table-select="selected_count"></span>Selected</div>
                                <button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">Remove Selected</button>
                            </div>
                            <!--end::Group actions-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body py-4">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                            <!--begin::Table head-->
                            <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2">
                                </th>
                                <th class="min-w-100px">Name</th>
                                <th class="min-w-125px">Company</th>
                                <th class="min-w-75px">Phone Number</th>
                                <th class="min-w-125px">Address</th>
                                <th class="text-end min-w-100px">Actions</th>
                            </tr>
                            <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="text-gray-600 fw-bold">
                            <?php
                            $contacts = aireno_get_contacts($user_id);
                            foreach ($contacts as $contact) {
                                $contact_data = aireno_get_userdata($contact);
                                $author_link = get_author_posts_url($contact_data->id);
                                ?>
                                <!--begin::Table row-->
                                <tr>
                                    <!--begin::Checkbox-->
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="<?=$contact_data->id?>" />
                                        </div>
                                    </td>
                                    <!--end::Checkbox-->
                                    <!--begin::Name=-->
                                    <td class="d-flex align-items-center">
                                        <!--begin:: Avatar -->
                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                            <a href="<?= $author_link ?>" target="_blank">
                                                <div class="symbol-label">
                                                    <img src="<?=$contact_data->avatar?>" alt="<?=$contact_data->display_name?>" class="w-100" />
                                                </div>
                                            </a>
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::User details-->
                                        <div class="d-flex flex-column">
                                            <a href="<?= $author_link ?>" target="_blank" class="text-gray-800 text-hover-primary mb-1"><?=$contact_data->display_name?></a>
                                            <span><?=$contact_data->email?></span>
                                        </div>
                                        <!--begin::User details-->
                                    </td>
                                    <!--end::Name=-->
                                    <!--begin::Company=-->
                                    <td><?=$contact_data->company?></td>
                                    <!--end::Company=-->
                                    <!--begin::Phone Number-->
                                    <td><?=$contact_data->phone?></td>
                                    <!--begin::Phone Number-->
                                    <!--begin::Address=-->
                                    <td><?=$contact_data->address?></td>
                                    <!--end::Address=-->
                                    <!--begin::Action=-->
                                    <td class="text-end">
                                        <a href="javascript:void(0)" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                            <span class="svg-icon svg-icon-5 m-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                            <!--end::Svg Icon-->
                                        </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="<?= $author_link ?>" target="_blank" class="menu-link px-3">View</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="javascript:void(0)" class="menu-link px-3" data-kt-users-table-filter="delete_row" data-contact="<?=$contact_data->id?>">Remove</a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                    <!--end::Action=-->
                                </tr>
                                <!--end::Table row-->
                                 <?php
                            }
                            ?>
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->

    <!--begin::Modal - Add Contact-->
    <div class="modal fade" id="kt_modal_add_contact" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-450px">
            <!--begin::Modal content-->
            <div class="modal-content rounded">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 position-relative justify-content-end">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary position-absolute" style="top:15px;z-index:10;" data-bs-dismiss="modal">
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
                        <div class="result-item p-3 border border-danger border-dashed rounded d-flex w-100 justify-content-start flex-row d-none mb-3 cursor-pointer" data-kt-element="template">
                            <div class="me-3">
                                <img class="h-50px" src="http://dev.aireno.com/wp-content/uploads/2022/06/canvas-150x150.webp" alt="avatar"/>
                            </div>
                            <div class="d-flex flex-column justify-content-around">
                                <div class="d-flex flex-row">
                                    <span class="fw-boldest fs-4 me-3" data-kt-element="display_name">Vasile Darmaz</span>
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
                    <form id="kt_modal_add_contact_form" class="form d-none" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="aireno_register_client">
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
                                    <option value="Business">Business</option>
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
                            <button type="submit" id="kt_modal_add_contact_submit" class="btn btn-danger">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>

                            <button type="button" id="kt_modal_add_contact_search" class="btn btn-success">
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
    <!--end::Modal - Add Contact-->
<?php
get_footer();
