<?php
/**
 * Template Name: Quotes Page
 *
 * @package WordPress
 * @subpackage Aireno
 * @since Aireno 1.0
 */

get_header();


?>

    <div class="d-flex flex-column flex-column-fluid bg-white" id="kt_content">
        <!--begin::Post-->
            <div class="container pb-20">
               </script>
                <div class="row justify-content-md-center">
                    <div class="col-md-6 col-12">
                      <div class="text-center p-5">
                      <h1 class="display-5">Instant
											<span class="d-inline-block position-relative">
											<span class="display-5">Quote</span>
											<span class="d-inline-block position-absolute h-8px bottom-0 end-0 start-0 bg-danger translate rounded"></span>
											</span>
                      </h1>
                      </div>
                       <div class="text-center">
                       <img src="<?= get_theme_file_uri("assets/images/undraw_calculator.svg") ?>"
                                         class="w-100px" alt=""/>
                      </div> 
                        <!--begin::Top-->
                         <div class="card bg-danger">
                            <!--begin::Body-->
                            <div class="p-5">
                                <!--begin::Layout-->
                                <!--end::Top-->
                                <?php
                                $args = array(
                                    'taxonomy' => 'quote-tag',
                                    'orderby' => 'name',
                                    'order' => 'ASC',
                                    'hide_empty' => false,
                                );

                                $tags = get_categories($args);
                                ?>
                                <div class="input-group border-0 flex-nowrap">
                                    <span class="input-group-text bg-danger"><i
                                                class="fa-brands fa-searchengin text-light fw-bolder"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select name="quote-tags" class="form-select rounded-start-0 form-select-lg"
                                                data-control="select2"
                                                data-placeholder="Search for your project" data-hide-search="false"
                                                data-allow-clear="true" multiple="multiple">
                                            <option></option>
                                            <?php
                                            foreach ($tags as $tag) {
                                                ?>
                                                <option value="<?= $tag->name ?>"><?= $tag->name ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <!--end::Layout-->
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>
                </div>
            </div>
    </div>
   
    <div class="post d-flex flex-column-fluid bg-white" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Post card-->
            <div class="card mb-sm-n20 mt-sm-n20">
                <div class="card-body">
                    <!--begin::Row-->

     <div class="row g-10 kt-quotes">
       <div class="text-center">
                      <b>Legend</b><br/>
                      <span class="text-dark"><i class="fa-regular fa-timer text-danger"></i> = Avg time to quote <i class="fa-solid fa-filter text-danger"></i> = Level of difficulty</span>
                     </div>
    <?php
                        $args = array(
                            'post_type' => 'template',
                            'post_status' => 'publish',
                            'posts_per_page' => -1,
                        );
                        $projects_query = new WP_Query($args);
                        if ($projects_query->have_posts()) {
                            while ($projects_query->have_posts()) {
                                $projects_query->the_post();
                                $img = get_field('template_icon', get_the_ID());
                                $time = get_field('time', get_the_ID());
                                $type = get_field('level_type', get_the_ID());
                                $link = aireno_get_page_link_by_name('add-quote');
                                $redirects = array(
                                    'q' => get_the_ID(),
                                );
                                if (isset($_GET['project_id']) && get_post($_GET['project_id'])->post_type == AIRENO_CPT_PROJECT) {
                                    $redirects['project_id'] = $_GET['project_id'];
                                }
                                $link = add_query_arg($redirects, $link);
                                if (!is_user_logged_in())
                                    $link = wp_sanitize_redirect(
                                        add_query_arg(
                                            array(
                                                'redirect' => urlencode(base64_encode($link)),
                                            ),
                                            aireno_get_page_link_by_name('login')
                                        )
                                    );
                                $quote_tags = get_the_terms(get_the_ID(), 'quote-tag');
                                ?>
                                <!--begin::Col-->
                                <div class="col-md-2 col-6 kt-quote">
                                    <!--begin::Publications post-->
                                    <a class="d-block btn btn-outline border-dashed border-danger bg-hover-light-danger h-200px"
                                       data-fslightbox="lightbox-hot-sales"
                                       data-name="<?= get_the_title() ?>"
                                       data-template="<?php echo get_the_ID(); ?>"
                                       href="<?= $link ?>">
                                        <!--begin::Overlay-->
                                   <span class="badge badge-square badge-light-danger"><i class="fa-regular fa-timer text-danger"></i> <?= $time ?> mins</span> 
                                        <!--begin:Icon-->
                               <span class="symbol symbol-100px">
																<span class="symbol-label bg-light-danger">
																	<i class="<?php echo $img; ?> fs-3x text-danger fw-bolder p-0"></i>
																</span>
															</span>
                                        <!--end:Icon-->
                                        <!--begin:Info-->
                                        <span class="d-flex flex-column">
																<span class="fw-bolder text-dark fs-3"><?= get_the_title() ?></span>
														          	</span>
                                        <!--end:Info-->
                                  <span class="badge badge-square badge-light-danger"><i class="fa-solid fa-filter text-danger"></i> <?= $type ?></span>
                                        <?php
                                        if ($quote_tags) {
                                            ?>
                                            <div class="d-none kt-tags">
                                                <?php
                                                foreach ($quote_tags as $quote_tag) {
                                                    ?>
                                                    <p><?= $quote_tag->name ?></p>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </a>
                                    <!--end::Overlay-->
                                </div>
                                <!--end::Col-->
                                <?php
                            }
                        } else {
                            ?>
                            <?php
                        }
                        wp_reset_query();
                        ?> 
     </div>
 
                      
                </div>
            </div>
            <!--end::Post card-->
        </div>
        <!--end::Container-->
    </div>
<?php
get_footer();