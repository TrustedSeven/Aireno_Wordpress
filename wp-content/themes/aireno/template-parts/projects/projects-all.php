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

$user_id = get_current_user_id();
?>
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Navbar-->
                <div class="card mb-5 mb-xxl-8">
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
                                <a class="nav-link text-active-primary ms-0 me-10 py-5 active" href="<?= get_post_type_archive_link(AIRENO_CPT_PROJECT) ?>">Projects</a>
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
                <!--begin::Toolbar-->
                <div class="d-flex flex-wrap flex-stack mb-6">
                    <div class="d-flex flex-row align-items-center">
                        <!--begin::Heading-->
                        <h3 class="fw-bolder m-0 me-3">My Projects</h3>
                        <!--end::Heading-->
                        <!--Begin : Search-->
                        <div class="d-flex align-items-center position-relative">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                            <!--end::Svg Icon-->
                            <input type="text" data-kt-project-filter="search" class="form-control form-control-solid w-250px ps-14 bg-white" placeholder="Search projects">
                        </div>
                        <!--End : Search-->
                    </div>

                    <!--begin::Actions-->
                    <div class="d-flex flex-wrap my-2">
                        <div class="me-4">
                            <!--begin::Select-->
                            <select data-kt-status-filter="true" data-control="select2" data-hide-search="true" class="form-select form-select-sm bg-body border-body w-150px">
                                <option value="" selected="selected">All</option>
                                <option value="quote">Estimate</option>
                                <option value="active">Reviewing</option>
                                <option value="updated">Updated Estimate</option>
                                <option value="booked">Site Visit</option>
                                <option value="pending">Final Quote</option>
                                <option value="live">Working</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                            <!--end::Select-->
                        </div>
                        <a href="<?= aireno_get_page_link_by_name('quotes') ?>" class="btn btn-primary btn-sm">New Project</a>
                    </div>
                    <!--end::Actions-->
                </div>
                <!--end::Toolbar-->
                <?php
                $user_projects = aireno_get_user_projects($user_id);
                $total_count = count($user_projects);
                $index = 0;
                $projects_per_page = 9;
                ?>
                <!--begin::Row-->
                <div class="row g-6 g-xl-9 <?=$total_count == 0 ? 'd-none' : ''?>" id="user_projects">
                    <?php
                    foreach ($user_projects as $project_id) {
                        $index ++;
                        $project_template_icon = get_field('template_icon', $project_id);
                        $projectStatus = aireno_project_status($project_id);
                        $project_date = get_field('date_start', $project_id);
                        $pdatetime = strtotime($project_date);
                        $project_date = date_i18n('M d, Y', $pdatetime);
                        $project_budget = number_format(aireno_get_project_total($project_id), 2);
                        $project_address = get_field('project_address', $project_id);

                        $project_users = aireno_get_project_users($project_id);
                        $percentage = aireno_get_project_percentage($project_id);

                        $show = ($index <= $projects_per_page) ? '' : 'd-none';
                        ?>
                        <!--begin::Col-->
                        <div class="col-md-6 col-xl-4 project-item <?=$show?>" data-id="<?=$project_id?>" data-status="<?=$projectStatus->status?>">
                            <!--begin::Card-->
                            <a href="<?=get_permalink($project_id)?>" class="card border-hover-primary">
                                <!--begin::Card header-->
                                <div class="card-header border-0 pt-9">
                                    <!--begin::Card Title-->
                                    <div class="card-title m-0">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-50px w-50px bg-light">
                                            <span class="symbol-label bg-danger">
                                                <i class="<?php echo $project_template_icon; ?> fs-2 text-light fw-bolder p-0"></i>
                                            </span>
                                            <!--end:Icon-->
                                        </div>
                                        <!--end::Avatar-->
                                    </div>
                                    <!--end::Car Title-->
                                    <!--begin::Card toolbar-->
                                    <div class="card-toolbar">
                                        <span class="badge badge-light-primary fw-bolder me-auto px-4 py-3"><?= $projectStatus->label ?></span>
                                    </div>
                                    <!--end::Card toolbar-->
                                </div>
                                <!--end:: Card header-->
                                <!--begin:: Card body-->
                                <div class="card-body p-9">
                                    <!--begin::Name-->
                                    <div class="fs-3 fw-bolder text-dark"><?=get_post($project_id)->post_title?></div>
                                    <!--end::Name-->
                                    <!--begin::Description-->
                                    <p class="text-gray-400 fw-bold fs-5 mt-1 mb-7"><?=$project_address?></p>
                                    <!--end::Description-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-wrap mb-5">
                                        <!--begin::Due-->
                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
                                            <div class="fs-6 text-gray-800 fw-bolder"><?=$project_date?></div>
                                            <div class="fw-bold text-gray-400">Due Date</div>
                                        </div>
                                        <!--end::Due-->
                                        <!--begin::Budget-->
                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
                                            <div class="fs-6 text-gray-800 fw-bolder">$<?=$project_budget?></div>
                                            <div class="fw-bold text-gray-400">Budget</div>
                                        </div>
                                        <!--end::Budget-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Progress-->
                                    <div class="h-4px w-100 bg-light mb-5" data-bs-toggle="tooltip" title="This project <?=$percentage?>% completed">
                                        <div class="bg-primary rounded h-4px" role="progressbar" style="width: <?=$percentage?>%" aria-valuenow="<?=$percentage?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <!--end::Progress-->
                                    <!--begin::Users-->
                                    <div class="symbol-group symbol-hover">
                                        <?php
                                        foreach ($project_users as $project_user){
                                            $p_u_data = aireno_get_userdata($project_user);
                                            ?>
                                            <!--begin::User-->
                                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="<?=$p_u_data->display_name?>">
                                                <img alt="<?=$p_u_data->display_name?>" src="<?=$p_u_data->avatar?>" />
                                            </div>
                                            <!--begin::User-->
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <!--end::Users-->
                                </div>
                                <!--end:: Card body-->
                            </a>
                            <!--end::Card-->
                        </div>
                        <!--end::Col-->
                        <?php
                    }
                    ?>
                </div>
                <!--end::Row-->

                <!--Begin: No Count-->
                <div class="d-flex p-10 d-none" data-kt-element="noProjects">
                    No matching projects found!
                </div>
                <!--End: No Count-->

                <!--begin::Pagination-->
                <div class="d-flex flex-stack flex-wrap pt-10 <?=$total_count == 0 ? 'd-none' : ''; ?>" data-kt-element="showCount">
                    <div class="fs-6 fw-bold text-gray-700">Showing <span data-kt-element="first-project">1</span> to <span data-kt-element="end-project"><?=$projects_per_page?></span> of <span data-kt-element="total"><?=$total_count?></span> projects</div>
                    <!--begin::Pages-->
                    <ul class="pagination pagination-circle" data-kt-element="navigations">
                        <li class="page-item previous disabled">
                            <a href="javascript:void(0)" class="page-link">
                                <i class="previous"></i>
                            </a>
                        </li>
                        <?php
                        $index = 0;
                        $page_count = ceil($total_count / $projects_per_page);
                        while ($index < $page_count) {
                            $active = $index == 0 ? 'active' : '';
                            $index ++;
                            ?>
                            <li class="page-item <?=$active?>" data-index="<?=$index?>">
                                <a href="javascript:void(0)" class="page-link"><?=$index?></a>
                            </li>
                            <?php
                        }
                        $next_disabled = ($page_count > 1) ? '' : 'disabled';
                        ?>
                        <li class="page-item next">
                            <a href="javascript:void(0)" class="page-link <?=$next_disabled?>">
                                <i class="next"></i>
                            </a>
                        </li>
                    </ul>
                    <!--end::Pages-->
                    <!--Begin:Pagination item template-->
                    <li class="d-none page-item item" data-kt-element="item-template">
                        <a href="javascript:void(0)" class="page-link">
                        </a>
                    </li>
                    <!--End:Pagination item template-->
                </div>
                <!--end::Pagination-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->

<?php
get_footer();
