<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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

                                    <?php

                                    if ( have_posts() ) {
                                        ?>
                                        <header class="page-header alignwide">
                                            <h1 class="page-title">
                                                <?php
                                                printf(
                                                /* translators: %s: Search term. */
                                                    esc_html__( 'Results for "%s"', TEXT_DOMAIN ),
                                                    '<span class="page-description search-term">' . esc_html( get_search_query() ) . '</span>'
                                                );
                                                ?>
                                            </h1>
                                        </header><!-- .page-header -->

                                        <div class="search-result-count default-max-width mb-15">
                                            <?php
                                            printf(
                                                esc_html(
                                                /* translators: %d: The number of search results. */
                                                    _n(
                                                        'We found %d result for your search.',
                                                        'We found %d results for your search.',
                                                        (int) $wp_query->found_posts,
                                                        TEXT_DOMAIN
                                                    )
                                                ),
                                                (int) $wp_query->found_posts
                                            );
                                            ?>
                                        </div><!-- .search-result-count -->
                                        <div class="row">
                                            <?php
                                            // Start the Loop.
                                            while ( have_posts() ) {
                                                the_post();
                                                get_template_part( 'template-parts/content/content-excerpt', get_post_format() );
                                            } // End the loop.

                                            // Previous/next page navigation.
                                            aireno_the_posts_navigation();
                                            ?>
                                        </div>
                                        <?php
                                        // If no content, include the "No posts found" template.
                                    } else {
                                        get_template_part( 'template-parts/content/content-none' );
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
