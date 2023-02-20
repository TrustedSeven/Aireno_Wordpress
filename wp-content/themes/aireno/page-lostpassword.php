<?php
/**
 * Template Name: Lost Password Page
 *
 * @package WordPress
 * @subpackage Aireno
 * @since Aireno 1.0
 */
if (is_user_logged_in()) {
    wp_safe_redirect(aireno_get_page_link_by_name('profile'));
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
            <!--begin::Authentication - Password reset -->
            <div class="d-flex flex-column flex-lg-row flex-column-fluid">
                <!--begin::Aside-->
                <div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative bg-white">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
                        <!--begin::Content-->
                        <div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
                            <!--begin::Logo-->
                            <a href="<?=site_url()?>" class="py-9 mb-5">
                                <?php
                                if ( has_custom_logo() ) {
                                    $custom_logo_id = get_theme_mod( 'custom_logo' );
                                    $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                                    ?>
                                <img alt="Logo" src="<?=esc_url( $logo[0] )?>" class="h-60px" />
                                <?php
                                }
                                else {
                                    ?>
                                <img alt="Logo" src="<?= get_theme_file_uri("assets/images/logo-2.svg") ?>"
                                    class="h-60px" />
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
                        </div>
                        <!--end::Content-->
                        <!--begin::Illustration-->
                        <div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px"
                            style="background-image: url(<?=get_theme_file_uri("assets/images/undraw_calculator.svg")?>)">
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
                        <div class="w-lg-500px p-10 p-lg-15 mx-auto">
                            <!--begin::Email Form-->
                            <form class="form w-100" novalidate="novalidate" id="kt_password_reset_form">
                                <input type="hidden" name="action" value="aireno_send_pin">
                                <!--begin::Heading-->
                                <div class="text-center mb-10">
                                    <!--begin::Title-->
                                    <h1 class="text-light mb-3">Forgot Password ?</h1>
                                    <!--end::Title-->
                                    <!--begin::Link-->
                                    <div class="text-light fw-bold fs-4">Enter your emailand we'll send you PIN-code to restore your password.
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--begin::Heading-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <label class="form-label fw-bolder text-light fs-6">Email</label>
                                    <input class="form-control form-control-solid" type="email" placeholder=""
                                        name="email" autocomplete="off" />
                                </div>
                                <!--end::Input group-->
                                <!--begin::Actions-->
                                <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                                    <button type="button" id="kt_password_reset_submit"
                                        class="btn btn-lg btn-primary fw-bolder me-4">
                                        <span class="indicator-label">Send PIN code</span>
                                        <span class="indicator-progress">Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                    <a href="<?=aireno_get_page_link_by_name('login')?>"
                                        class="btn btn-lg btn-light-primary fw-bolder">Cancel</a>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Email Form-->

                            <!--begin::Pin Form-->
                            <form class="form w-100" novalidate="novalidate" id="kt_check_pin_form" style="display: none;">
                                <input type="hidden" name="action" value="aireno_check_pin">
                                <input type="hidden" name="user_id" value="">
                                <!--begin::Heading-->
                                <div class="text-center mb-10">
                                    <!--begin::Title-->
                                    <h1 class="text-light mb-3">Input the PIN-code you received.</h1>
                                    <!--end::Title-->
                                </div>
                                <!--begin::Heading-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <label class="form-label fw-bolder text-gray-900 fs-6">PIN-code</label>
                                    <input class="form-control form-control-solid" type="text" placeholder=""
                                           name="pin_code" autocomplete="off" />
                                </div>
                                <!--end::Input group-->
                                <!--begin::Actions-->
                                <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                                    <button type="button" id="kt_check_pin_submit"
                                            class="btn btn-lg btn-primary fw-bolder me-4">
                                        <span class="indicator-label">Send PIN code</span>
                                        <span class="indicator-progress">Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Pin Form-->

                            <!--begin::New Password Form-->
                            <form class="form w-100" novalidate="novalidate" style="display: none" id="kt_new_password_form">
                                <input type="hidden" name="action" value="aireno_reset_password">
                                <input type="hidden" name="resent_pin" value="">
                                <input type="hidden" name="user_id" value="">
                                <!--begin::Heading-->
                                <div class="text-center mb-10">
                                    <!--begin::Title-->
                                    <h1 class="text-light mb-3">Enter New Password</h1>
                                    <!--end::Title-->
                                    <!--begin::Link-->
                                    <div class="text-gray-400 fw-bold fs-4">Already have reset your password ?
                                        <a href="<?=aireno_get_page_link_by_name('login')?>" class="link-primary fw-bolder">Sign in here</a></div>
                                    <!--end::Link-->
                                </div>
                                <!--begin::Heading-->
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row" data-kt-password-meter="true">
                                    <!--begin::Wrapper-->
                                    <div class="mb-1">
                                        <!--begin::Label-->
                                        <label class="form-label fw-bolder text-light fs-6">Password</label>
                                        <!--end::Label-->
                                        <!--begin::Input wrapper-->
                                        <div class="position-relative mb-3">
                                            <input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="password" autocomplete="off" />
											<span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
												<i class="bi bi-eye-slash fs-2"></i>
												<i class="bi bi-eye fs-2 d-none"></i>
											</span>
                                        </div>
                                        <!--end::Input wrapper-->
                                        <!--begin::Meter-->
                                        <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                        </div>
                                        <!--end::Meter-->
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Hint-->
                                    <div class="text-light">Use 8 or more characters with a mix of letters, numbers &amp; symbols.</div>
                                    <!--end::Hint-->
                                </div>
                                <!--end::Input group=-->
                                <!--begin::Input group=-->
                                <div class="fv-row mb-10">
                                    <label class="form-label fw-bolder text-light fs-6">Confirm Password</label>
                                    <input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="confirm-password" autocomplete="off" />
                                </div>
                                <!--end::Input group=-->
                                <!--begin::Input group=-->
                                <div class="fv-row mb-10">
                                    <div class="form-check form-check-custom form-check-solid form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="toc" value="1" />
                                        <label class="form-check-label fw-bold text-light fs-6">I Agree &amp;
                                            <a href="<?=site_url()?>" class="ms-1 link-primary">Terms and conditions</a>.</label>
                                    </div>
                                </div>
                                <!--end::Input group=-->
                                <!--begin::Action-->
                                <div class="text-center">
                                    <button type="button" id="kt_new_password_submit" class="btn btn-lg btn-primary fw-bolder">
                                        <span class="indicator-label">Submit</span>
										<span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                <!--end::Action-->
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
            <!--end::Authentication - Password reset-->
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