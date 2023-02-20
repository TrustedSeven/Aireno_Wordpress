<?php
/**
 * Template part for displaying posts
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
    <div class="ps-lg-6 mb-16 mt-md-0 mt-17">
        <!--begin::Body-->
        <div class="mb-6">
            <h1 class="mb-10"><a class="text-dark fw-bolder text-hover-primary" href="<?=get_the_permalink()?>"><?php the_title()?></a></h1>
            <a class="d-block overlay fw-bolder text-dark mb-4 fs-2 lh-base text-hover-primary" href="<?=get_the_permalink()?>">
                <?php
                /**
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
                */
                ?>
                <!--begin::Action-->
                <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                </div>
                <!--end::Action-->
            </a>
            <div class="fw-bold fs-5 mt-4 text-gray-600 text-dark">
                <?php
                the_content(
                    aireno_continue_reading_text()
                );
                ?>
            </div>
        </div>
        <!--end::Body-->
        <!--begin::Footer-->
        <div class="d-flex flex-stack flex-wrap">
            <!--begin::Item-->
            <div class="d-flex align-items-center pe-2">
                <!--begin::Avatar-->
                <div class="symbol symbol-35px symbol-circle me-3">
                    <?php
                    $author_id = get_the_author_meta('ID');
                    $avatar = get_field('_avatar', 'user_'.$author_id);
                    $author = get_the_author_meta('display_name');
                    if ($avatar) {
                        $avatar_url = $avatar['sizes']['thumbnail'];
                    }
                    else {
                        $avatar_url = get_avatar_url($author_id);
                    }
                    ?>
                    <img src="<?= $avatar_url ?>" class="" alt=""/>
                </div>
                <!--end::Avatar-->
                <!--begin::Text-->
                <div class="fs-5 fw-bolder">
                    <a href="<?=get_author_posts_url($author_id)?>"
                       class="text-gray-700 text-hover-primary"><?=$author?></a>
                    <span class="text-muted"> on <?=get_the_date('F j Y')?></span>
                </div>
                <!--end::Text-->
            </div>
            <!--end::Item-->
        </div>
        <!--end::Footer-->
    </div>
    <!--end::Post-->
</div>
<!--end::Col-->
