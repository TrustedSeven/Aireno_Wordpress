<?php
/**
 * The template for displaying all pages
 *
 * @package WordPress
 * @subpackage Aireno
 * @since Aireno 1.0

 */
get_header();
?>
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Post card-->
                <div class="card">
                    <!--begin::Body-->
                    <div class="card-body p-lg-20 pb-lg-0">
                        <!--begin::Layout-->
                        <div class="d-flex flex-column flex-xl-row">
                            <!--begin::Content-->
                            <div class="flex-lg-row-fluid me-xl-15">
                                <!--begin::Post content-->
                                <div class="mb-17">
                                    <!--begin::Wrapper-->
                                    <div class="mb-8">
                                        <!--begin::Title-->
                                        <a href="<?=get_the_permalink()?>" class="text-center text-dark text-hover-primary fs-2 fw-bolder"><h1><?=get_the_title()?></h1></a>
                                        <!--end::Title-->
                                        <?php
                                        if (has_post_thumbnail()) {
                                            $thubnail_link = get_the_post_thumbnail_url();
                                            ?>
                                            <!--begin::Container-->
                                            <div class="overlay mt-8">
                                                <!--begin::Image-->
                                                <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-350px" style="background-image:url('<?=$thubnail_link?>')"></div>
                                                <!--end::Image-->
                                            </div>
                                            <!--end::Container-->
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Description-->
                                    <div class="fs-5 fw-bold text-gray-600 mb-15">
                                        <?php
                                        the_content();
                                        ?>
                                    </div>
                                    <!--end::Description-->
                                    <!--begin::Icons-->
                                    <div class="d-flex flex-center">
                                        <!--begin::Icon-->
                                        <a href="#" class="mx-4">
                                            <img src="<?=get_theme_file_uri("assets/images/facebook-4.svg")?>" class="h-20px my-2" alt="" />
                                        </a>
                                        <!--end::Icon-->
                                        <!--begin::Icon-->
                                        <a href="#" class="mx-4">
                                            <img src="<?=get_theme_file_uri("assets/images/instagram-2-1.svg")?>" class="h-20px my-2" alt="" />
                                        </a>
                                        <!--end::Icon-->
                                        <!--begin::Icon-->
                                        <a href="#" class="mx-4">
                                            <img src="<?=get_theme_file_uri("assets/images/github.svg")?>" class="h-20px my-2" alt="" />
                                        </a>
                                        <!--end::Icon-->
                                        <!--begin::Icon-->
                                        <a href="#" class="mx-4">
                                            <img src="<?=get_theme_file_uri("assets/images/behance.svg")?>" class="h-20px my-2" alt="" />
                                        </a>
                                        <!--end::Icon-->
                                        <!--begin::Icon-->
                                        <a href="#" class="mx-4">
                                            <img src="<?=get_theme_file_uri("assets/images/pinterest-p.svg")?>" class="h-20px my-2" alt="" />
                                        </a>
                                        <!--end::Icon-->
                                        <!--begin::Icon-->
                                        <a href="#" class="mx-4">
                                            <img src="<?=get_theme_file_uri("assets/images/twitter.svg")?>" class="h-20px my-2" alt="" />
                                        </a>
                                        <!--end::Icon-->
                                        <!--begin::Icon-->
                                        <a href="#" class="mx-4">
                                            <img src="<?=get_theme_file_uri("assets/images/dribbble-icon-1.svg")?>" class="h-20px my-2" alt="" />
                                        </a>
                                        <!--end::Icon-->
                                    </div>
                                    <!--end::Icons-->
                                </div>
                                <!--end::Post content-->
                            </div>
                        </div>
                        <!--end::Layout-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Post card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
<?php
get_footer();
