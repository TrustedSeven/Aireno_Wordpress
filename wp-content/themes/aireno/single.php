<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();

?>
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
                                    <div class="d-flex flex-column flex-xl-row">
                                        <!--begin::Content-->
                                        <div class="flex-lg-row-fluid me-xl-15">
                                            <!--begin::Section-->
                                            <div class="mb-17">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <?php
                                                    // Load posts loop.
                                                    while (have_posts()) {
                                                        the_post();
                                                        get_template_part('template-parts/content/content-single');

                                                        if (is_attachment()) {
                                                            // Parent post navigation.
                                                            the_post_navigation(
                                                                array(
                                                                    /* translators: %s: Parent post link. */
                                                                    'prev_text' => sprintf(__('<span class="meta-nav">Published in</span><span class="post-title">%s</span>', TEXT_DOMAIN), '%title'),
                                                                )
                                                            );
                                                        }

                                                        // If comments are open or there is at least one comment, load up the comment template.
                                                        if (comments_open() || get_comments_number()) {
                                                            comments_template();
                                                        }

                                                        // Previous/next post navigation.
                                                        $aireno_next = is_rtl() ? aireno_get_icon_svg('ui', 'arrow_left') : aireno_get_icon_svg('ui', 'arrow_right');
                                                        $aireno_prev = is_rtl() ? aireno_get_icon_svg('ui', 'arrow_right') : aireno_get_icon_svg('ui', 'arrow_left');

                                                        $aireno_next_label = esc_html__('Next', TEXT_DOMAIN);
                                                        $aireno_previous_label = esc_html__('Prev', TEXT_DOMAIN);

                                                        the_post_navigation(
                                                            array(
                                                                'next_text' => '<p class="meta-nav">' . $aireno_next_label . $aireno_next . '</p><p class="post-title">%title</p>',
                                                                'prev_text' => '<p class="meta-nav">' . $aireno_prev . $aireno_previous_label . '</p><p class="post-title">%title</p>',
                                                            )
                                                        );
                                                    }
                                                    ?>
                                                </div>
                                                <!--begin::Row-->
                                            </div>
                                            <!--end::Section-->
                                        </div>
                                        <!--end::Content-->
                                        <!--begin::Sidebar-->
                                        <div class="flex-column flex-lg-row-auto w-100 w-xl-300px mb-10">
                                            <!--begin::Search blog-->
                                            <div class="mb-16">
                                                <h4 class="text-black mb-7">Search Blog</h4>
                                                <?php
                                                get_search_form();
                                                ?>
                                            </div>
                                            <!--end::Search blog-->
                                            <!--begin::Catigories-->
                                            <div class="mb-16">
                                                <h4 class="text-black mb-7">Categories</h4>
                                                <!--begin::Item-->
                                                <div class="d-flex flex-stack fw-bold fs-5 text-muted mb-4">
                                                    <!--begin::Text-->
                                                    <a href="#" class="text-muted text-hover-primary pe-2">SaaS
                                                        Solutions</a>
                                                    <!--end::Text-->
                                                    <!--begin::Number-->
                                                    <div class="m-0">24</div>
                                                    <!--end::Number-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="d-flex flex-stack fw-bold fs-5 text-muted mb-4">
                                                    <!--begin::Text-->
                                                    <a href="#" class="text-muted text-hover-primary pe-2">Company
                                                        News</a>
                                                    <!--end::Text-->
                                                    <!--begin::Number-->
                                                    <div class="m-0">152</div>
                                                    <!--end::Number-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="d-flex flex-stack fw-bold fs-5 text-muted mb-4">
                                                    <!--begin::Text-->
                                                    <a href="#" class="text-muted text-hover-primary pe-2">Events &amp;
                                                        Activities</a>
                                                    <!--end::Text-->
                                                    <!--begin::Number-->
                                                    <div class="m-0">52</div>
                                                    <!--end::Number-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="d-flex flex-stack fw-bold fs-5 text-muted mb-4">
                                                    <!--begin::Text-->
                                                    <a href="#" class="text-muted text-hover-primary pe-2">Support
                                                        Related</a>
                                                    <!--end::Text-->
                                                    <!--begin::Number-->
                                                    <div class="m-0">305</div>
                                                    <!--end::Number-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="d-flex flex-stack fw-bold fs-5 text-muted mb-4">
                                                    <!--begin::Text-->
                                                    <a href="#"
                                                       class="text-muted text-hover-primary pe-2">Innovations</a>
                                                    <!--end::Text-->
                                                    <!--begin::Number-->
                                                    <div class="m-0">70</div>
                                                    <!--end::Number-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="d-flex flex-stack fw-bold fs-5 text-muted">
                                                    <!--begin::Text-->
                                                    <a href="#" class="text-muted text-hover-primary pe-2">Product
                                                        Updates</a>
                                                    <!--end::Text-->
                                                    <!--begin::Number-->
                                                    <div class="m-0">585</div>
                                                    <!--end::Number-->
                                                </div>
                                                <!--end::Item-->
                                            </div>
                                            <!--end::Catigories-->
                                            <!--begin::Recent posts-->
                                            <div class="m-0">
                                                <h4 class="text-black mb-7">Recent Posts</h4>
                                                <?php
                                                // Define our WP Query Parameters
                                                $the_query = new WP_Query('posts_per_page=5'); ?>
                                                <?php
                                                // Start our WP Query
                                                while ($the_query->have_posts()) : $the_query->the_post();
                                                    if (has_post_thumbnail()) {
                                                        $thubnail_link = get_the_post_thumbnail_url();
                                                    }
                                                    else {
                                                        $thubnail_link = get_theme_file_uri("assets/images/1600x800/img-1.jpg");
                                                    }
                                                    ?>
                                                    <!--begin::Item-->
                                                    <div class="d-flex flex-stack mb-7">
                                                        <!--begin::Symbol-->
                                                        <div class="symbol symbol-60px symbol-2by3 me-4">
                                                            <div class="symbol-label"
                                                                 style="background-image: url('<?= $thubnail_link ?>')"></div>
                                                        </div>
                                                        <!--end::Symbol-->
                                                        <!--begin::Title-->
                                                        <div class="m-0">
                                                            <a href="<?=get_the_permalink()?>" class="text-dark fw-bolder text-hover-primary fs-6"><?=get_the_title()?></a>
                                                            <span class="text-gray-600 fw-bold d-block pt-1 fs-7"><?=get_the_excerpt()?></span>
                                                        </div>
                                                        <!--end::Title-->
                                                    </div>
                                                    <!--end::Item-->
                                                <?php
                                                endwhile;
                                                wp_reset_postdata();
                                                ?>
                                            </div>
                                            <!--end::Recent posts-->
                                        </div>
                                        <!--end::Sidebar-->
                                    </div>
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
