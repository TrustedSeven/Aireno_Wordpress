<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage aireno
 * @since aireno 1.0.0
 */

get_header(); ?>
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <!--begin::Post-->
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <!--begin::Container-->
                        <div id="kt_content_container" class="container-xxl">
                            <!--begin::Home card-->
                            <div class="card">
                                <!--begin::Body-->
                                <div class="card-body p-lg-20">
                                    <?php
                                    if (have_posts()) {
                                        ?>
                                        <!--begin::Section-->
                                        <div class="mb-17">
                                            <!--begin::Title-->
                                            <h3 class="text-dark mb-7">Latest Articles, News &amp; Updates</h3>
                                            <!--end::Title-->
                                            <!--begin::Separator-->
                                            <div class="separator separator-dashed mb-9"></div>
                                            <!--end::Separator-->
                                            <!--begin::Row-->
                                            <div class="row">
                                                <?php
                                                // Load posts loop.
                                                while (have_posts()) {
                                                    the_post();
                                                    get_template_part('template-parts/content/content', 'excerpt');
                                                }
                                                ?>
                                            </div>
                                            <!--begin::Row-->
                                        </div>
                                        <!--end::Section-->
                                        <?php

                                        // Previous/next page navigation.
                                        aireno_the_posts_navigation();

                                    } else {

                                        // If no content, include the "No posts found" template.
                                        get_template_part('template-parts/content/content-none');

                                    }
                                    ?>

                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Home card-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Post-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->

<?php
get_footer();
