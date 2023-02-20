<?php
get_header();

?>

    <!--begin::Authentication - 404 Page-->
    <div class="d-flex flex-column flex-center flex-column-fluid p-10">
        <!--begin::Illustration-->
        <img src="<?=get_theme_file_uri('assets/images/404-1.png')?>" alt="" class="mw-100 mb-10 h-lg-450px" />
        <!--end::Illustration-->
        <!--begin::Message-->
        <h1 class="fw-bolder mb-10 text-primary">Sorry that page has gone missing</h1>
        <!--end::Message-->
        <!--begin::Link-->
        <a href="<?=site_url()?>" class="btn btn-danger">Take me Home</a>
        <!--end::Link-->
    </div>
    <!--end::Authentication - 404 Page-->

<?php
get_footer();