<?php
/**
 * Template Name: Login Page
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
            <!--begin::Authentication - Sign-in -->
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
                            <!--begin::Form-->
                            <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form"
                                enctype="multipart/form-data" method="post">
                                <input type="hidden" name="action" value="aireno_login_user">
                                <input type="hidden" name="redirect" value="<?=isset($_GET['redirect']) ? $_GET['redirect'] : ''?>" />
                                <!--begin::Heading-->
                                <div class="text-center mb-10">
                                    <!--begin::Title-->
                                    <h1 class="text-light mb-3">Sign In</h1>
                                    <!--end::Title-->
                                    <!--begin::Link-->
                                    <div class="text-light fw-bold fs-4">New Here?
                                        <?php
                                        $register_link = aireno_get_page_link_by_name('register');
                                        if (isset($_GET['redirect']) && $_GET['redirect'] != '') $register_link .= '?redirect=' . $_GET['redirect'];
                                        ?>
                                        <a href="<?= $register_link ?>"
                                            class="link-primary fw-bolder">Create an Account</a>
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--begin::Heading-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fs-6 fw-bolder text-light">Email</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control form-control-lg form-control-solid" type="text"
                                        name="email" autocomplete="off" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-stack mb-2">
                                        <!--begin::Label-->
                                        <label class="form-label fw-bolder text-light fs-6 mb-0">Password</label>
                                        <!--end::Label-->
                                        <!--begin::Link-->
                                        <a href="<?=aireno_get_page_link_by_name('lostpassword')?>"
                                            class="link-primary fs-6 fw-bolder">Forgot Password ?</a>
                                        <!--end::Link-->
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Input-->
                                    <input class="form-control form-control-lg form-control-solid" type="password"
                                        name="password" autocomplete="off" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Actions-->
                                <div class="text-center">
                                    <!--begin::Submit button-->
                                    <button type="submit" id="kt_sign_in_submit"
                                        class="btn btn-lg btn-primary w-100 mb-5">
                                        <span class="indicator-label">Sign In</span>
                                        <span class="indicator-progress">Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                    <!--end::Submit button-->
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
            <!--end::Authentication - Sign-in-->
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