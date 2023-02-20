<?php
/**
 * Template part for displaying post archives and search results
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
    <div class="row px-3">
        <!--begin::Body-->
        <h1 class="mb-3 text-dark fw-bolder text-hover-primary">
            <a href="<?= get_the_permalink() ?>" class="text-decoration-none text-dark text-hover-primary"><?php the_title() ?></a>
        </h1>
        <?php
        if (has_post_thumbnail()) {
            $thubnail_link = get_the_post_thumbnail_url();
            ?>
            <a class="d-block mb-3 overlay fw-bolder text-dark fs-2 lh-base text-hover-primary"
               href="<?= $thubnail_link ?>">
                <!--begin::Container-->
                <div class="overlay">
                    <!--begin::Image-->
                    <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-250px"
                         style="background-image:url('<?= $thubnail_link ?>')"></div>
                    <!--end::Image-->
                </div>
                <!--end::Container-->
                <!--begin::Action-->
                <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                </div>
                <!--end::Action-->
            </a>
            <?php
        }
        ?>

        <div class="fw-bold fs-5 text-muted text-dark">
            <?php
            the_excerpt(
                aireno_continue_reading_text()
            );
            ?>
        </div>
        <!--end::Body-->
        <!--begin::Footer-->
        <div class="d-flex flex-stack justify-content-between flex-wrap mb-6 pb-6 border-bottom border-1 border-solid border-danger">
            <!--begin::Item-->
            <div class="d-flex align-items-center pe-2">
                <!--begin::Avatar-->
                <div class="symbol symbol-35px symbol-circle me-3">
                    <?php
                    $author_id = get_the_author_meta('ID');
                    $avatar = get_field('_avatar', 'user_' . $author_id);
                    $author = get_the_author_meta('display_name');
                    if ($avatar) {
                        $avatar_url = $avatar['sizes']['thumbnail'];
                    } else {
                        $avatar_url = get_avatar_url($author_id);
                    }
                    ?>
                    <img src="<?= $avatar_url ?>" class="" alt=""/>
                </div>
                <!--end::Avatar-->
                <!--begin::Text-->
                <div class="fs-5 fw-bolder">
                    <a href="<?= get_author_posts_url($author_id) ?>"
                       class="text-gray-700 text-hover-primary"><?= $author ?></a>
                    <span class="text-muted"> on <?= get_the_date('F j Y') ?></span>
                </div>
                <!--end::Text-->
            </div>
            <?php
            $post_categories = get_the_category();
            $categories = array();
            foreach ($post_categories as $post_category) {
                $categories[] = $post_category->name;
            }
            if (count($categories) > 0) {
                ?>
                <div class="d-flex">
                  <span class="badge badge-success">
                    <?php
                    echo implode(',', $categories);
                    ?>
                  </span>
                </div>
                <?php
            }
            ?>
            <!--end::Item-->
        </div>
        <!--end::Footer-->
    </div>
    <!--end::Post-->
</div>
<!--end::Col-->
