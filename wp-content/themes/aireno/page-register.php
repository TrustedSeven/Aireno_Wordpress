<?php
/**
 * Template Name: Register Page
 *
 * @package WordPress
 * @subpackage Aireno
 * @since Aireno 1.0
 */
if (is_user_logged_in()) {
    wp_safe_redirect(site_url());
    exit;
}
?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>

    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php wp_head(); ?>
    </head>
    <!--end::Head-->
    <!--begin::Body-->

    <body id="kt_body" class="bg-body">
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Sign-up -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Aside-->
            <div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative bg-white">
                <!--begin::Wrapper-->
                <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
                    <!--begin::Content-->
                    <div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
                        <!--begin::Logo-->
                        <a href="<?= site_url() ?>" class="py-9 mb-5">
                            <?php
                            if (has_custom_logo()) {
                                $custom_logo_id = get_theme_mod('custom_logo');
                                $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                                ?>
                                <img alt="Logo" src="<?= esc_url($logo[0]) ?>" class="h-60px"/>
                            <?php
                            } else {
                                ?>
                                <img alt="Logo" src="<?= get_theme_file_uri("assets/images/logo-2.svg") ?>"
                                     class="h-60px"/>
                            <?php
                            }
                            ?>
                        </a>
                        <!--end::Logo-->
                            <!--begin::Title-->
                            <h1 class="display-5">Renovate
											<span class="d-inline-block position-relative">
											<span class="display-5">Smart</span>
											<span class="d-inline-block position-absolute h-8px bottom-0 end-0 start-0 bg-danger translate rounded"></span>
											</span>
                      </h1>
                            <!--end::Title-->
                        <!--begin::Description-->
                    </div>
                    <!--end::Content-->
                    <!--begin::Illustration-->
                    <div
                        class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px"
                        style="background-image: url(<?= get_theme_file_uri("assets/images/undraw_calculator.svg") ?>)">
                    </div>
                    <!--end::Illustration-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Aside-->
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid py-10 bg-dark">
                <!--begin::Content-->
                <div class="d-flex flex-center flex-column flex-column-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-lg-600px p-10 p-lg-15 mx-auto">
                        <!--begin::Form-->
                        <form class="form w-100" novalidate="novalidate" id="kt_sign_up_form" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="aireno_register_user">
                            <input type="hidden" name="redirect" value="<?=isset($_GET['redirect']) ? $_GET['redirect'] : ''?>">
                            <!--begin::Heading-->
                            <div class="mb-10 text-center">
                                <!--begin::Title-->
                                <h1 class="text-light mb-3">Create an Account</h1>
                                <!--end::Title-->
                                <!--begin::Link-->
                                <div class="text-gray-400 fw-bold fs-4">Already have an account?
                                    <a href="<?= aireno_get_page_link_by_name('login') ?>"
                                       class="link-primary fw-bolder">Sign in here</a>
                                </div>
                                <!--end::Link-->
                            </div>
                            <!--end::Heading-->

                            <!--begin::Choose Profile-->
                            <div class="fv-row mb-7">
                                <label class="form-label fw-bolder text-light fs-6 mb-5">Choose your profile</label>
                                <select class="form-select form-select-lg mb-3" name="user_type"
                                        data-control="select2" data-placeholder="Choose Type" data-hide-search="true">
                                    <option value="Client">Client</option>
                                    <option value="Business">Business</option>
                                </select>
                            </div>
                            <!--end::Choose Profile-->

                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <label class="form-label fw-bolder text-light fs-6">Full Name</label>
                                <input class="form-control form-control-lg" type="text"
                                       placeholder="" name="display_name" autocomplete="off" required/>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <label class="form-label fw-bolder text-light fs-6">Email</label>
                                <input class="form-control form-control-lg" type="email"
                                       placeholder="" name="email" autocomplete="off" required/>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="mb-7 fv-row" data-kt-password-meter="true">
                                <!--begin::Wrapper-->
                                <div class="mb-1">
                                    <!--begin::Label-->
                                    <label class="form-label fw-bolder text-light fs-6">Password</label>
                                    <!--end::Label-->
                                    <!--begin::Input wrapper-->
                                    <div class="position-relative mb-3">
                                        <input class="form-control form-control-lg"
                                               type="password" placeholder="" name="password" autocomplete="off" required/>
                                            <span
                                                class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                                data-kt-password-meter-control="visibility">
                                                <i class="bi bi-eye-slash fs-2"></i>
                                                <i class="bi bi-eye fs-2 d-none"></i>
                                            </span>
                                    </div>
                                    <!--end::Input wrapper-->
                                    <!--begin::Meter-->
                                    <div class="d-flex align-items-center mb-3"
                                         data-kt-password-meter-control="highlight">
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                        </div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                        </div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                        </div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                    </div>
                                    <!--end::Meter-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Hint-->
                                <div class="text-light">Use 8 or more characters with a mix of letters, numbers
                                    &amp; symbols.
                                </div>
                                <!--end::Hint-->
                            </div>
                            <!--end::Input group=-->

                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <label class="form-label fw-bolder text-dark fs-6">Confirm Password</label>
                                <input class="form-control form-control-lg" type="password"
                                       placeholder="" name="confirm-password" autocomplete="off" required/>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <label class="form-check form-check-custom form-check-inline" style="align-items: flex-start">
                                    <input class="form-check-input" type="checkbox" name="toc" value="1" required/>
                                    <span class="form-check-label fw-bold text-gray-700 fs-6">By signing up you are accepting the Aireno <a href="#" class="ms-1 link-primary">Terms and Conditions</a> and <a href="#" class="ms-1 link-primary">Privacy Policy</a>.</span>
                                </label>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Actions-->
                            <div class="text-center">
                                <button type="button" id="kt_sign_up_submit" class="btn btn-lg btn-primary">
                                    <span class="indicator-label">Register</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Content-->
                <!--begin::Footer-->
                <div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
                    <!--begin::Links-->
                      <div class="d-flex flex-center fw-bold fs-6">
                            <a href="/about" class="text-light text-hover-primary px-2"
                                target="_blank">About</a>
                            <a href="/contact" class="text-light text-hover-primary px-2"
                                target="_blank">Help</a>
                            <a href="/get-quote" class="text-light text-hover-primary px-2"
                                target="_blank">Quote Builder</a>
                        </div>
                    <!--end::Links-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Authentication - Sign-up-->
    </div>
    <!--end::Root-->
    <!--end::Main-->
    <?php
    wp_footer();
    ?>
    </body>
    <!--end::Body-->

    </html>

<?php