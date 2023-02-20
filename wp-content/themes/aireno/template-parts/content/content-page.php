<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
<!--begin::Col-->
<div id="post-<?php the_ID(); ?>" <?php post_class("col-md-6 justify-content-between d-flex flex-column"); ?> >
    <!--begin::Post-->
    <div class="row">
        <!--begin::Body-->
        <div class="mb-6">
            <h1 class="mb-10 text-dark fw-bolder text-hover-primary"><?php the_title()?></h1>
            <a class="d-block overlay fw-bolder text-dark mb-4 fs-2 lh-base text-hover-primary" href="<?=get_the_permalink()?>">
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
                <!--begin::Action-->
                <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                </div>
                <!--end::Action-->
            </a>
            <div class="fw-bold fs-5 mt-4 text-gray-600 text-dark">
                <?php
                the_content();

                wp_link_pages(
                    array(
                        'before'   => '<nav class="page-links" aria-label="' . esc_attr__( 'Page', TEXT_DOMAIN ) . '">',
                        'after'    => '</nav>',
                        /* translators: %: Page number. */
                        'pagelink' => esc_html__( 'Page %', TEXT_DOMAIN ),
                    )
                );
                ?>
            </div>
        </div>
        <!--end::Body-->
        <?php if ( get_edit_post_link() ) : ?>
            <!--begin::Footer-->
            <div class="d-flex flex-stack flex-wrap">
                <!--begin::Item-->
                <div class="d-flex align-items-center pe-2">
                    <?php
                    edit_post_link(
                        sprintf(
                        /* translators: %s: Post title. Only visible to screen readers. */
                            esc_html__( 'Edit %s', TEXT_DOMAIN ),
                            '<span class="screen-reader-text">' . get_the_title() . '</span>'
                        ),
                        '<span class="edit-link">',
                        '</span>'
                    );
                    ?>
                </div>
                <!--end::Item-->
            </div>
            <!--end::Footer-->
        <?php endif; ?>

    </div>
    <!--end::Post-->
</div>
<!--end::Col-->
