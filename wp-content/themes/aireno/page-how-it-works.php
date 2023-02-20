<?php
/**
 * Template Name: How it works
 *
 * @package WordPress
 * @subpackage Aireno
 * @since Aireno 1.0
 */

get_header();

?>
<!--begin::Content-->
    <div class="content d-flex flex-column bg-white flex-column-fluid" id="kt_content">
        <!--begin::How It Works Section-->
        <div class="mb-n10 mb-lg-n20 z-index-2">
            <!--begin::Container-->
          <div class="container">
            <script src="<?=get_theme_file_uri("assets/js/typedjs.bundle.js")?>"></script>
                <!--begin::Heading-->
              <div class="row justify-content-center">  
               <div class="text-center col-12 col-md-8">
                 <h1 class="display-2">A new way to
											<span class="d-inline-block position-relative">
											<span class="display-1">Renovate</span>
											<span class="d-inline-block position-absolute h-8px bottom-0 end-0 start-0 bg-danger translate rounded"></span>
											</span>
                      </h1>
                 <div class="fw-semibold fs-2 text-muted mt-10 h-80px">
                    <span class="fw-bolder text-dark">Renovate better on Aireno.</span> Streamline those typical hassles like<br/> <span id="typed" class="fw-bolder text-danger"></span> into one seamless, efficient online experience. </span> 
                </div>
                <div class="m-10">
                        <a class="btn btn-dark btn-lg fw-bolder" href="/quote-builder"><i class="fa-solid fa-wand-magic-sparkles"></i> Get Started</a>
                 </div>
                </div>
                 <script>
             var typed = new Typed("#typed", {
            strings: ["Quoting", "Project planning", "Designing", "Choosing products", "Hiring a team", "Project management ", "Communication", "Billing & payments"],
            typeSpeed: 60,
            loop: true  
             });
            </script>
                </div>
                <!--end::Heading-->
            </div>
        </div>
         <div class="container">
               <!--end::Container-->
         <div class="card mt-20" style="filter: drop-shadow(0px 0px 40px rgba(68, 81, 96, 0.08))">
                    <div class="card-body">
                        <div class="row w-100 gy-10">
                            <!--begin::Col-->
                            <div class="col-md-4 px-5">
                                <!--begin::Story-->
                                <div class="text-center mb-10 mb-md-0">
                                    <!--begin::Illustration-->
                                    <img src="<?= get_theme_file_uri("assets/images/undraw_calculator.svg") ?>"
                                         class="mh-125px mb-9" alt=""/>
                                    <!--end::Illustration-->
                                    <!--begin::Heading-->
                                    <div class="d-flex flex-center mb-5">
                                        <!--begin::Badge-->
                                        <span class="badge badge-circle badge-light-primary fw-bolder p-5 me-3 fs-3">1</span>
                                        <!--end::Badge-->
                                        <!--begin::Title-->
                                        <div class="fs-5 fs-lg-3 fw-bolder text-dark">Quote Instantly</div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Description-->
                                    <div class="fw-bold fs-6 fs-lg-4 text-muted">Magically build an accurate quote
                                        instantly using market rates or your own.
                                    </div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Story-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-4 px-5">
                                <!--begin::Story-->
                                <div class="text-center mb-10 mb-md-0">
                                    <!--begin::Illustration-->
                                    <img src="<?= get_theme_file_uri("assets/images/undraw_interior_design.svg") ?>"
                                         class="mh-125px mb-9" alt=""/>
                                    <!--end::Illustration-->
                                    <!--begin::Heading-->
                                    <div class="d-flex flex-center mb-5">
                                        <!--begin::Badge-->
                                        <span class="badge badge-circle badge-light-primary fw-bolder p-5 me-3 fs-3">2</span>
                                        <!--end::Badge-->
                                        <!--begin::Title-->
                                        <div class="fs-5 fs-lg-3 fw-bolder text-dark">Plan Online</div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Description-->
                                    <div class="fw-bold fs-6 fs-lg-4 text-muted">Plan every aspect of your project with
                                        the help of our tailor made tools and smart AI driven system
                                    </div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Story-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-4 px-5">
                                <!--begin::Story-->
                                <div class="text-center mb-10 mb-md-0">
                                    <!--begin::Illustration-->
                                    <img src="<?= get_theme_file_uri("assets/images/undraw_progress.svg") ?>"
                                         class="mh-125px mb-9" alt=""/>
                                    <!--end::Illustration-->
                                    <!--begin::Heading-->
                                    <div class="d-flex flex-center mb-5">
                                        <!--begin::Badge-->
                                        <span class="badge badge-circle badge-light-primary fw-bolder p-5 me-3 fs-3">3</span>
                                        <!--end::Badge-->
                                        <!--begin::Title-->
                                        <div class="fs-5 fs-lg-3 fw-bolder text-dark">Manage Centrally</div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Description-->
                                    <div class="fw-bold fs-6 fs-lg-4 text-muted">Do everything in one place, our
                                        seamless workflow making managing your project a breeze.
                                    </div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Story-->
                            </div>
                            <!--end::Col-->
                        </div>

                    </div>
                </div>
     
</div>
           <!--end::How It Works Section-->
        <!--begin::Statistics Section-->
        <div class="mt-sm-n10">
            <!--begin::Wrapper-->
            <div class="pb-15 pt-18 landing-dark-bg">
                <!--begin::Container-->
                <div class="container">
                    <!--begin::Heading-->
                    <div class="text-center mt-15 mb-18" id="achievements" data-kt-scroll-offset="{default: 100, lg: 150}">
                        <!--begin::Title-->
                        <h3 class="fs-2hx text-white fw-bolder mb-5">Renovate Better</h3>
                        <!--end::Title-->
                        <!--begin::Description-->
                        <div class="fs-5 text-gray-700 fw-bold">Quote, plan & manage your project on autopilot 
                            </div>
                        <!--end::Description-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Statistics-->
                    <div class="d-flex flex-center">
                        <!--begin::Items-->
                        <div class="d-flex flex-wrap flex-center justify-content-lg-between mb-15 mx-auto w-xl-900px">
                            <!--begin::Item-->
                            <div class="d-flex flex-column flex-center h-200px w-200px h-lg-250px w-lg-250px m-3 bgi-no-repeat bgi-position-center bgi-size-contain" style="background-image: url('<?=get_theme_file_uri("assets/media/svg/misc/octagon.svg")?>')">
                                <!--begin::Symbol-->
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-2tx svg-icon-white mb-3">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor" />
											<rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor" />
											<rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor" />
											<rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor" />
										</svg>
									</span>
                                <!--end::Svg Icon-->
                                <!--end::Symbol-->
                                <!--begin::Info-->
                                <div class="mb-0">
                                    <!--begin::Value-->
                                    <div class="fs-lg-2hx fs-2x fw-bolder text-white d-flex flex-center">
                                        <div class="min-w-70px" data-kt-countup="true" data-kt-countup-value="30" data-kt-countup-suffix="+">0</div>
                                    </div>
                                    <!--end::Value-->
                                    <!--begin::Label-->
                                    <span class="text-gray-600 fw-bold fs-5 lh-0">Hours Saved (per project)</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex flex-column flex-center h-200px w-200px h-lg-250px w-lg-250px m-3 bgi-no-repeat bgi-position-center bgi-size-contain" style="background-image: url('<?=get_theme_file_uri("assets/media/svg/misc/octagon.svg")?>')">
                                <!--begin::Symbol-->
                                <!--begin::Svg Icon | path: icons/duotune/graphs/gra008.svg-->
                                <span class="svg-icon svg-icon-2tx svg-icon-white mb-3">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<path d="M13 10.9128V3.01281C13 2.41281 13.5 1.91281 14.1 2.01281C16.1 2.21281 17.9 3.11284 19.3 4.61284C20.7 6.01284 21.6 7.91285 21.9 9.81285C22 10.4129 21.5 10.9128 20.9 10.9128H13Z" fill="currentColor" />
											<path opacity="0.3" d="M13 12.9128V20.8129C13 21.4129 13.5 21.9129 14.1 21.8129C16.1 21.6129 17.9 20.7128 19.3 19.2128C20.7 17.8128 21.6 15.9128 21.9 14.0128C22 13.4128 21.5 12.9128 20.9 12.9128H13Z" fill="currentColor" />
											<path opacity="0.3" d="M11 19.8129C11 20.4129 10.5 20.9129 9.89999 20.8129C5.49999 20.2129 2 16.5128 2 11.9128C2 7.31283 5.39999 3.51281 9.89999 3.01281C10.5 2.91281 11 3.41281 11 4.01281V19.8129Z" fill="currentColor" />
										</svg>
									</span>
                                <!--end::Svg Icon-->
                                <!--end::Symbol-->
                                <!--begin::Info-->
                                <div class="mb-0">
                                    <!--begin::Value-->
                                    <div class="fs-lg-2hx fs-2x fw-bolder text-white d-flex flex-center">
                                        <div class="min-w-70px" data-kt-countup="true" data-kt-countup-value="2.5" data-kt-countup-suffix="mins">0</div>
                                    </div>
                                    <!--end::Value-->
                                    <!--begin::Label-->
                                    <span class="text-gray-600 fw-bold fs-5 lh-0">Avg quoting time</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex flex-column flex-center h-200px w-200px h-lg-250px w-lg-250px m-3 bgi-no-repeat bgi-position-center bgi-size-contain" style="background-image: url('<?=get_theme_file_uri("assets/media/svg/misc/octagon.svg")?>')">
                                <!--begin::Symbol-->
                                <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm002.svg-->
                                <span class="svg-icon svg-icon-2tx svg-icon-white mb-3">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<path d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z" fill="currentColor" />
											<path opacity="0.3" d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z" fill="currentColor" />
											<path opacity="0.3" d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z" fill="currentColor" />
										</svg>
									</span>
                                <!--end::Svg Icon-->
                                <!--end::Symbol-->
                                <!--begin::Info-->
                                <div class="mb-0">
                                    <!--begin::Value-->
                                    <div class="fs-lg-2hx fs-2x fw-bolder text-white d-flex flex-center">
                                        <div class="min-w-70px" data-kt-countup="true" data-kt-countup-value="150000" data-kt-countup-suffix="+">0</div>
                                    </div>
                                    <!--end::Value-->
                                    <!--begin::Label-->
                                    <span class="text-gray-600 fw-bold fs-5 lh-0">Available instant prices</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Items-->
                    </div>
                    <!--end::Statistics-->
                  </div>
                <!--end::Container-->
            </div>
            <!--end::Wrapper-->
        </div>

        <div class="mb-lg-n15 position-relative z-index-2">
                <!--begin::Container-->
                <div class="container">
                    <!--begin::Card-->
                    <div class="card mt-sm-n10" style="filter: drop-shadow(0px 0px 40px rgba(68, 81, 96, 0.08))">
                        <!--begin::Card body-->
                        <!--begin::Heading-->
                        <div class="text-center mt-20 mb-5">
                            <h3 class="fs-2hx text-dark mb-5">How it works</h3>
                            <!--end::Title-->
                        </div>
           <!--begin::Plans-->
          <div class="d-flex flex-column p-5">
            <!--begin::Nav-->
            <ul class="nav nav-pills nav-pills-custom justify-content-center mb-3" role="tablist">
              <!--begin::Item-->
              <li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
                <!--begin::Link-->
                <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-danger flex-column overflow-hidden w-150px h-100px pt-5 pb-2 active" id="bath_link" data-bs-toggle="tab" href="#bath_tab" aria-selected="true" role="tab" tabindex="-1">
                  <!--begin::Icon-->
                  <div class="nav-icon m-3">
                    <i class="fa-regular fa-house-heart fs-3x p-0"></i>
                  </div>
                  <!--end::Icon-->
                  <!--begin::Title-->
                  <span class="nav-text text-dark fw-bolder mt-3 fs-5">
                            For your Home                        
                   </span>
                  <!--end::Title-->
                  <!--begin::Bullet-->
                  <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-danger"></span>
                  <!--end::Bullet-->
                </a>
                <!--end::Link-->
              </li>
              <!--end::Item-->
              <!--begin::Item-->
              <li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
                <!--begin::Link-->
                <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-danger flex-column overflow-hidden w-150px h-100px pt-5 pb-2" id="kitchen_link" data-bs-toggle="tab" href="#kitchen_tab" role="tab" aria-selected="false">
                  <!--begin::Icon-->
                  <div class="nav-icon m-3">
                    <i class="fa-regular fa-user-helmet-safety fs-3x p-0"></i>
                  </div>
                  <!--end::Icon-->
                  <!--begin::Title-->
                  <span class="nav-text text-dark fw-bolder mt-3 fs-5">
                            For Renovators                         
                        </span>
                  <!--end::Title-->
                  <!--begin::Bullet-->
                  <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-danger"></span>
                  <!--end::Bullet-->
                </a>
                <!--end::Link-->
              </li>
              <!--end::Item-->
              <!--begin::Item-->
              <li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
                <!--begin::Link-->
                <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-danger flex-column overflow-hidden w-150px h-100px pt-5 pb-2" id="full_link" data-bs-toggle="tab" href="#full_tab" role="tab">
                  <!--begin::Icon-->
                  <div class="nav-icon m-3">
                    <i class="fa-regular fa-users-viewfinder fs-3x p-0"></i>
                  </div>
                  <!--end::Icon-->
                  <!--begin::Title-->
                  <span class="nav-text text-dark fw-bolder mt-3 fs-5">
                          For Business                  
                        </span>
                  <!--end::Title-->
                  <!--begin::Bullet-->
                  <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-danger"></span>
                  <!--end::Bullet-->
                </a>
                <!--end::Link-->
              </li>
              <!--end::Item-->
             </ul>
            <!--end::Nav-->

            <!--begin::Tab Content-->
            <div class="tab-content">
              <div class="tab-pane fade show active" id="bath_tab" role="tabpanel" aria-labelledby="#bath_link">
                <!--begin::Row-->
                <div class="w-md-50 mx-auto">
                  <div class="fw-bolder text-danger text-center p-5 fs-4">
                    Aireno caters to everyone, whether you’re budgeting to buy your new home or ready to break ground. 
                  </div>
                </div>
                <div class="row">
                  <!--begin::Col-->
                  <div class="col-lg-6 mb-10 mb-lg-0">
                    <ul class="nav flex-column nav-pills nav-fill" id="tabset">
                      <li class="nav-item" role="presentation">
                        <a class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6 active" id="bathtab1" data-bs-toggle="pill" data-bs-target="#bath1" type="button" role="tab" aria-controls="bath1" aria-selected="true">
                          <!--end::Description-->
                          <div class="d-flex align-items-center me-2">
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                              <div class="fw-semibold opacity-75 badge badge-circle badge-light-danger fw-bolder p-5 me-3 fs-3">
                                1
                              </div>
                              <div class="d-flex align-items-center fs-2 fw-bolder flex-wrap">
                                Quoting & Budgeting 
                              </div>
                            </div>
                            <!--end::Info-->
                          </div>
                          <!--end::Description-->
                          <!--begin::Price-->
                          <div class="ms-5">
                            <span class="fs-2x fw-bolder"><i class="fa-solid fa-money-check-dollar-pen fs-3x fw-bolder"></i></span>
                          </div>
                          <!--end::Price-->
                        </a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" id="bathtab2" data-bs-toggle="pill" data-bs-target="#bath2" type="button" role="tab" aria-controls="bath2" aria-selected="false">
                          <!--end::Description-->
                          <div class="d-flex align-items-center me-2">
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                               <div class="fw-semibold opacity-75 badge badge-circle badge-light-danger fw-bolder p-5 me-3 fs-3">
                                2
                              </div>
                              <div class="d-flex align-items-center fs-2 fw-bolder flex-wrap">
                                Planning & Designing
                              </div>
                            </div>
                            <!--end::Info-->
                          </div>
                          <!--end::Description-->
                          <!--begin::Price-->
                          <div class="ms-5">
                            <span class="fs-2x fw-bolder"><i class="fa-regular fa-ruler-combined fs-3x fw-bolder"></i></span>
                          </div>
                          <!--end::Price-->
                        </a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" id="bathtab3" data-bs-toggle="pill" data-bs-target="#bath3" type="button" role="tab" aria-controls="bath3" aria-selected="false">
                          <!--end::Description-->
                          <div class="d-flex align-items-center me-2">
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                               <div class="fw-semibold opacity-75 badge badge-circle badge-light-danger fw-bolder p-5 me-3 fs-3">
                                3
                              </div>
                              <div class="d-flex align-items-center fs-2 fw-bolder flex-wrap">
                                Choosing a team 
                              </div>
                            </div>
                            <!--end::Info-->
                          </div>
                          <!--end::Description-->
                          <!--begin::Price-->
                          <div class="ms-5">
                            <span class="fs-2x fw-bolder"><i class="fa-light fa-users-medical fs-3x fw-bolder"></i></span>
                          </div>
                          <!--end::Price-->
                        </a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" id="bathtab4" data-bs-toggle="tab" data-bs-target="#bath4" type="button" role="tab" aria-controls="bath4" aria-selected="true">
                          <!--end::Description-->
                         <div class="d-flex align-items-center me-2">
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                               <div class="fw-semibold opacity-75 badge badge-circle badge-light-danger fw-bolder p-5 me-3 fs-3">
                                4
                              </div>
                              <div class="d-flex align-items-center fs-2 fw-bolder flex-wrap">
                                Managing your Project
                              </div>  
                            </div>
                            <!--end::Info-->
                          </div>
                          <!--end::Description-->
                          <!--begin::Price-->
                          <div class="ms-5">
                            <span class="fs-2x fw-bolder"><i class="fa-solid fa-bars-progress fs-3x fw-bolder"></i></span>
                          </div>
                          <!--end::Price-->
                        </a>
                      </li>
                    </ul>
                  </div>
                  <!--end::Col-->
                  <!--begin::Col-->
                  <div class="col-lg-6">
                    <!--begin::Tab content-->
                    <div class="tab-content rounded h-100 bg-light-danger p-10" id="bathtabset">
                      <!--begin::Tab Pane-->
                      <div class="tab-pane fade show active" id="bath1" role="tabpanel" aria-labelledby="bathtab1">
                        <!--begin::Body-->
                        <div class="pt-1">
                          <!--begin::Item-->
                          <div class="text-center">
                            <img src="<?= get_theme_file_uri("assets/images/undraw_calculator.svg") ?>"
                                         class="w-50 mx-auto" alt=""/>
                          </div>
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Build an accurate renovation quote instantly using our pricing engine. It’s as simple as answering a questionnaire for your project which uses researched market rates and your inputs for size, 
                              finish and quantity to generate a price on the spot. Online quotes are a time-saving breakthrough and you even can get your quote verified by our estimators at the click of a button. 
                            </span>
                          </div>
                          <!--end::Item-->
                          <!--end::Item-->
                         <div class="d-flex flex-column mb-7">
                           <a class="btn btn-danger btn-lg fw-bolder" href="/quote-builder">Get Started</a>
                         </div>
                        </div>
                        <!--end::Body-->
                      </div>
                      <!--end::Tab Pane-->
                       <!--begin::Tab Pane-->
                      <div class="tab-pane fade" id="bath2" role="tabpanel" aria-labelledby="bathtab2">
                          <div class="pt-1">
                          <!--begin::Item-->
                          <div class="text-center">
                            <img src="<?= get_theme_file_uri("assets/images/undraw_interior_design.svg") ?>"
                                         class="w-50 mx-auto" alt=""/>
                          </div>
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Plan and coordinate with your team on our powerful project dashboard, it brings everything you need in one place, 
                              consolidating communication and streamlining your project planning. If you need help you can get instant access to expert designers and projects planners ready to guide you through design and beyond 
                             </span>
                          </div>
                          <!--end::Item-->
                          <!--end::Item-->
                         <div class="d-flex flex-column mb-7">
                           <a class="btn btn-danger btn-lg fw-bolder" href="/quote-builder">Get Started</a>
                         </div>
                        </div>
                      </div>
                      <!--end::Tab Pane-->
                      <!--begin::Tab Pane-->
                      <div class="tab-pane fade" id="bath3" role="tabpanel" aria-labelledby="bathtab3">
                        <div class="pt-1">
                          <!--begin::Item-->
                          <div class="text-center">
                            <img src="<?= get_theme_file_uri("assets/images/undraw_selecting_team.svg") ?>"
                                         class="w-50 mx-auto" alt=""/>
                          </div>
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             You can either Invite your own team through our project portal or request a contractor match from our experts who find and background check the best teams for the job. They’ll choose from our pool of digital 
                              first contractors or find a suitable teams in our extended network. Each team we put forward is put through a rigorous vetting process. </span>
                          </div>
                          <!--end::Item-->
                          <!--end::Item-->
                         <div class="d-flex flex-column mb-7">
                           <a class="btn btn-danger btn-lg fw-bolder" href="/quote-builder">Get Started</a>
                         </div>
                        </div>
                 
                      </div>
                      <!--end::Tab Pane-->
                       <!--begin::Tab Pane-->
                      <div class="tab-pane fade" id="bath4" role="tabpanel" aria-labelledby="bathtab4">
                         <div class="pt-1">
                          <!--begin::Item-->
                          <div class="text-center">
                            <img src="<?= get_theme_file_uri("assets/images/undraw_progress.svg") ?>"
                                         class="w-50 mx-auto" alt=""/>
                          </div>
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Project management is made easy through our centralised project dashboard, keep a finger on the pulse of your project with our custom tools for each phase. Easily follow progress on the visual schedule timeline, stay in touch with team chat. 
                            </span>
                          </div>
                          <!--end::Item-->
                          <!--end::Item-->
                         <div class="d-flex flex-column mb-7">
                           <a class="btn btn-danger btn-lg fw-bolder" href="/quote-builder">Get Started</a>
                         </div>
                        </div>
                 
                      </div>
                      <!--end::Tab Pane-->
                   
                    </div>
                    <!--end::Tab content-->
                  </div>
                  <!--end::Col-->
                </div>
                <!--end::Row-->
              </div>
              <div class="tab-pane fade" id="kitchen_tab" role="tabpanel" aria-labelledby="#kitchen_link">
                <!--begin::Row-->
                <!--begin::Row-->
                <div class="w-md-50 mx-auto">
                  <div class="fw-bolder text-danger text-center p-5 fs-4">
                    Become a digital first contractor with Aireno’s online renovation tools and streamlined process. 
                  </div>
                </div>
                <div class="row">
                  <!--begin::Col-->
                  <div class="col-lg-6 mb-10 mb-lg-0">
                    <ul class="nav flex-column nav-pills nav-fill" id="tabset">
                      <li class="nav-item" role="presentation">
                        <a class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6 active" id="kitchentab1" data-bs-toggle="pill" data-bs-target="#kitchen1" type="button" role="tab" aria-controls="kitchen1" aria-selected="true">
                          <!--end::Description-->
                          <div class="d-flex align-items-center me-2">
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                              <div class="fw-semibold opacity-75 badge badge-circle badge-light-danger fw-bolder p-5 me-3 fs-3">
                                1
                              </div>
                              <div class="d-flex align-items-center fs-2 fw-bolder flex-wrap">
                                Quoting & Budgeting 
                              </div>
                            </div>
                            <!--end::Info-->
                          </div>
                          <!--end::Description-->
                          <!--begin::Price-->
                          <div class="ms-5">
                            <span class="fs-2x fw-bolder"><i class="fa-solid fa-money-check-dollar-pen fs-3x fw-bolder"></i></span>
                          </div>
                          <!--end::Price-->
                        </a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" id="kitchentab2" data-bs-toggle="pill" data-bs-target="#kitchen2" type="button" role="tab" aria-controls="kitchen2" aria-selected="false">
                           <!--end::Description-->
                          <div class="d-flex align-items-center me-2">
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                              <div class="fw-semibold opacity-75 badge badge-circle badge-light-danger fw-bolder p-5 me-3 fs-3">
                                2
                              </div>
                              <div class="d-flex align-items-center fs-2 fw-bolder flex-wrap">
                                Planning & Design
                              </div>
                            </div>
                            <!--end::Info-->
                          </div>
                          <!--end::Description-->
                          <!--begin::Price-->
                          <div class="ms-5">
                            <span class="fs-2x fw-bolder"><i class="fa-regular fa-ruler-combined fs-3x fw-bolder"></i></span>
                          </div>
                          <!--end::Price-->
                        </a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" id="kitchentab3" data-bs-toggle="pill" data-bs-target="#kitchen3" type="button" role="tab" aria-controls="kitchen3" aria-selected="false">
                          <!--end::Description-->
                          <div class="d-flex align-items-center me-2">
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                              <div class="fw-semibold opacity-75 badge badge-circle badge-light-danger fw-bolder p-5 me-3 fs-3">
                                3
                              </div>
                              <div class="d-flex align-items-center fs-2 fw-bolder flex-wrap">
                                Lead Generation 
                              </div>
                            </div>
                            <!--end::Info-->
                          </div>
                          <!--end::Description-->
                          <!--begin::Price-->
                          <div class="ms-5">
                            <span class="fs-2x fw-bolder"><i class="fa-regular fa-message-dollar fs-3x fw-bolder"></i></span>
                          </div>
                          <!--end::Price-->
                        </a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" id="kitchentab4" data-bs-toggle="tab" data-bs-target="#kitchen4" type="button" role="tab" aria-controls="kitchen4" aria-selected="false">
                          <!--end::Description-->
                          <div class="d-flex align-items-center me-2">
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                              <div class="fw-semibold opacity-75 badge badge-circle badge-light-danger fw-bolder p-5 me-3 fs-3">
                                4
                              </div>
                              <div class="d-flex align-items-center fs-2 fw-bolder flex-wrap">
                               Managing Your Projects
                              </div>
                            </div>
                            <!--end::Info-->
                          </div>
                          <!--end::Description-->
                          <!--begin::Price-->
                          <div class="ms-5">
                            <span class="fs-2x fw-bolder"><i class="fa-solid fa-bars-progress fs-3x fw-bolder"></i></span>
                          </div>
                          <!--end::Price-->
                        </a>
                      </li>
                    </ul>
                  </div>
                  <!--end::Col-->
                  <!--begin::Col-->
                  <div class="col-lg-6">
                    <!--begin::Tab content-->
                    <div class="tab-content rounded h-100 bg-light-danger p-10" id="bathtabset">
                      <!--begin::Tab Pane-->
                      <div class="tab-pane fade show active" id="kitchen1" role="tabpanel" aria-labelledby="kitchentab1">
                       <!--begin::Body-->
                        <div class="pt-1">
                          <!--begin::Item-->
                          <div class="text-center">
                            <img src="<?= get_theme_file_uri("assets/images/undraw_calculator.svg") ?>"
                                         class="w-50 mx-auto" alt=""/>
                          </div>
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                            Build accurate renovation quotes on the spot. Our comprehensive database of market rate pricing gives you a reliable foundation to quote your customers instantly and better yet, our pricing engine is flexible, allowing you to edit and add your own rates or manage your margin in seconds. Online quotes are a time-saving breakthrough 
                              and now you can offer this to your clients to quote and qualify on autopilot while you focus on more important parts of your business.
                            </span>
                          </div>
                          <!--end::Item-->
                          <!--end::Item-->
                         <div class="d-flex flex-column mb-7">
                           <a class="btn btn-danger btn-lg fw-bolder" href="/register">Get Started</a>
                         </div>
                        </div>
                        <!--end::Body-->
                      </div>
                      <!--end::Tab Pane-->
                       <!--begin::Tab Pane-->
                      <div class="tab-pane fade" id="kitchen2" role="tabpanel" aria-labelledby="kitchentab2">
                       <!--begin::Body-->
                        <div class="pt-1">
                          <!--begin::Item-->
                          <div class="text-center">
                            <img src="<?= get_theme_file_uri("assets/images/undraw_interior_design.svg") ?>"
                                         class="w-50 mx-auto" alt=""/>
                          </div>
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                            Plan and coordinate with your clients and team on our powerful project dashboard, it brings everything you need in one place, consolidating communication and streamlining your project planning. 
                              Most issues arise from a lack of contact so funnelling communication through a central point is a game-changer. 
                            </span>
                          </div>
                          <!--end::Item-->
                          <!--end::Item-->
                         <div class="d-flex flex-column mb-7">
                           <a class="btn btn-danger btn-lg fw-bolder" href="/register">Get Started</a>
                         </div>
                        </div>
                        <!--end::Body-->
                      </div>
                      <!--end::Tab Pane-->
                      <!--begin::Tab Pane-->
                      <div class="tab-pane fade" id="kitchen3" role="tabpanel" aria-labelledby="kitchentab3">
                        <!--begin::Body-->
                        <div class="pt-1">
                          <!--begin::Item-->
                          <div class="text-center">
                            <img src="<?= get_theme_file_uri("assets/images/undraw_online_payments.svg") ?>"
                                         class="w-50 mx-auto" alt=""/>
                          </div>
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Get first dibs on renovation ready customers from our network, our planners & estimators verify and qualify projects at the request of the customers so you know you’re not wasting time on tyre kickers. We don’t charge an upfront fee for leads like other platforms, 
                              our costs are built into the quote given to the customer and given our rigorous qualification process and seamless online workflow you can expect conversion rates upwards of 70%.
                            </span>
                          </div>
                          <!--end::Item-->
                          <!--end::Item-->
                         <div class="d-flex flex-column mb-7">
                           <a class="btn btn-danger btn-lg fw-bolder" href="/register">Get Started</a>
                         </div>
                        </div>
                        <!--end::Body-->
                      </div>
                      <!--end::Tab Pane-->
                       <!--begin::Tab Pane-->
                      <div class="tab-pane fade" id="kitchen4" role="tabpanel" aria-labelledby="kitchentab4">
                      <!--begin::Body-->
                        <div class="pt-1">
                          <!--begin::Item-->
                          <div class="text-center">
                            <img src="<?= get_theme_file_uri("assets/images/undraw_progress.svg") ?>"
                                         class="w-50 mx-auto" alt=""/>
                          </div>
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Project management is made easy through our centralised project dashboard, keep a finger on the pulse of your project with our custom tools for each phase and just to make things even easier 
                              for you we’ve built-in standardised templates for billing and scheduling so you can setup and manage these typically arduous tasks in a matter of seconds.
                            </span>
                          </div>
                          <!--end::Item-->
                          <!--end::Item-->
                         <div class="d-flex flex-column mb-7">
                           <a class="btn btn-danger btn-lg fw-bolder" href="/register">Get Started</a>
                         </div>
                        </div>
                        <!--end::Body-->
                      </div>
                      <!--end::Tab Pane-->
                   
                    </div>
                    <!--end::Tab content-->
                  </div>
                  <!--end::Col-->
                </div>
                <!--end::Row-->
              </div>
              <div class="tab-pane fade" id="full_tab" role="tabpanel" aria-labelledby="#full_link">
              <!--begin::Row-->
                <div class="w-md-50 mx-auto">
                  <div class="fw-bolder text-danger text-center p-5 fs-4">
                   Aireno can help your customers regardless of what part of the renovation journey they are on.
                  </div>
                </div>
                <div class="row">
                  <!--begin::Col-->
                  <div class="col-lg-6 mb-10 mb-lg-0">
                    <ul class="nav flex-column nav-pills nav-fill" id="tabset">
                      <li class="nav-item" role="presentation">
                        <a class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6 active" id="fulltab1" data-bs-toggle="pill" data-bs-target="#full1" type="button" role="tab" aria-controls="full1" aria-selected="true">
                          <!--end::Description-->
                          <div class="d-flex align-items-center me-2">
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                              <div class="fw-semibold opacity-75 badge badge-circle badge-light-danger fw-bolder p-5 me-3 fs-3">
                                <i class="fa-solid fa-check fw-bolder text-danger"></i>
                              </div>
                              <div class="d-flex align-items-center fs-2 fw-bolder flex-wrap">
                                Real Estate 
                              </div>
                            </div>
                            <!--end::Info-->
                          </div>
                          <!--end::Description-->
                          <!--begin::Price-->
                          <div class="ms-5">
                            <span class="fs-2x fw-bolder"><i class="fa-regular fa-sign-hanging fs-3x fw-bolder"></i></span>
                          </div>
                          <!--end::Price-->
                        </a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" id="fulltab2" data-bs-toggle="pill" data-bs-target="#full2" type="button" role="tab" aria-controls="full2" aria-selected="false">
                          <!--end::Description-->
                          <div class="d-flex align-items-center me-2">
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                              <div class="fw-semibold opacity-75 badge badge-circle badge-light-danger fw-bolder p-5 me-3 fs-3">
                                <i class="fa-solid fa-check fw-bolder text-danger"></i>
                              </div>
                              <div class="d-flex align-items-center fs-2 fw-bolder flex-wrap">
                                Designers & Decorators 
                              </div>
                            </div>
                            <!--end::Info-->
                          </div>
                          <!--end::Description-->
                          <!--begin::Price-->
                          <div class="ms-5">
                            <span class="fs-2x fw-bolder"><i class="fa-solid fa-swatchbook fs-3x fw-bolder"></i></span>
                          </div>
                          <!--end::Price-->
                        </a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" id="fulltab3" data-bs-toggle="pill" data-bs-target="#full3" type="button" role="tab" aria-controls="full3" aria-selected="false">
                          <!--end::Description-->
                          <div class="d-flex align-items-center me-2">
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                              <div class="fw-semibold opacity-75 badge badge-circle badge-light-danger fw-bolder p-5 me-3 fs-3">
                                <i class="fa-solid fa-check fw-bolder text-danger"></i>
                              </div>
                              <div class="d-flex align-items-center fs-2 fw-bolder flex-wrap">
                                Finance & Insurance 
                              </div>
                            </div>
                            <!--end::Info-->
                          </div>
                          <!--end::Description-->
                          <!--begin::Price-->
                          <div class="ms-5">
                            <span class="fs-2x fw-bolder"><i class="fa-regular fa-landmark fs-3x fw-bolder"></i></span>
                          </div>
                          <!--end::Price-->
                        </a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" id="fulltab4" data-bs-toggle="tab" data-bs-target="#full4" type="button" role="tab" aria-controls="full4" aria-selected="false">
                          <!--end::Description-->
                          <div class="d-flex align-items-center me-2">
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                              <div class="fw-semibold opacity-75 badge badge-circle badge-light-danger fw-bolder p-5 me-3 fs-3">
                                <i class="fa-solid fa-check fw-bolder text-danger"></i>
                              </div>
                              <div class="d-flex align-items-center fs-2 fw-bolder flex-wrap">
                               Renovation Suppliers 
                              </div>
                            </div>
                            <!--end::Info-->
                          </div>
                          <!--end::Description-->
                          <!--begin::Price-->
                          <div class="ms-5">
                            <span class="fs-2x fw-bolder"><i class="fa-regular fa-cart-shopping fs-3x fw-bolder"></i></span>
                          </div>
                          <!--end::Price-->
                        </a>
                      </li>
                    </ul>
                  </div>
                  <!--end::Col-->
                  <!--begin::Col-->
                  <div class="col-lg-6">
                    <!--begin::Tab content-->
                    <div class="tab-content rounded h-100 bg-light-danger p-10" id="bathtabset">
                      <!--begin::Tab Pane-->
                      <div class="tab-pane fade show active" id="full1" role="tabpanel" aria-labelledby="fulltab1">
                        <!--begin::Body-->
                        <div class="pt-1">
                          <!--begin::Item-->
                          <div class="text-center">
                            <img src="<?= get_theme_file_uri("assets/images/undraw_realestate.png") ?>"
                                         class="w-50 mx-auto" alt=""/>
                          </div>
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                            One of the biggest hurdles prospective buyers face is knowing how much to offer, this decision is made even more difficult when there are renovations needed on the property. Buyers need reliable pricing advice, promptly.  Aireno makes answering the “How much will it cost” question super easy, 
                              enabling you and your buyers to build an accurate, verified quote on the spot. 
                            </span>
                          </div>
                          <!--end::Item-->
                          <!--end::Item-->
                         <div class="d-flex flex-column mb-7">
                           <a class="btn btn-danger btn-lg fw-bolder" href="/register">Get Started</a>
                         </div>
                        </div>
                        <!--end::Body-->
                      </div>
                      <!--end::Tab Pane-->
                       <!--begin::Tab Pane-->
                      <div class="tab-pane fade" id="full2" role="tabpanel" aria-labelledby="fulltab2">
                        <!--begin::Body-->
                        <div class="pt-1">
                          <!--begin::Item-->
                          <div class="text-center">
                            <img src="<?= get_theme_file_uri("assets/images/undraw_complete.svg") ?>"
                                         class="w-50 mx-auto" alt=""/>
                          </div>
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                            Offer an end-to-end solution for your customers by harnessing our tools and digital workflow for planning and managing your projects, Aireno is a self service platform so you can easily pick and choose what level of service you require. 
                              Use what you need, whether it be a quick quote for a customer in the early stages of planning or a project ready to start, needing a builder asap. We can help.   
                            </span>
                          </div>
                          <!--end::Item-->
                          <!--end::Item-->
                         <div class="d-flex flex-column mb-7">
                           <a class="btn btn-danger btn-lg fw-bolder" href="/register">Get Started</a>
                         </div>
                        </div>
                        <!--end::Body-->
                      </div>
                      <!--end::Tab Pane-->
                      <!--begin::Tab Pane-->
                      <div class="tab-pane fade" id="full3" role="tabpanel" aria-labelledby="fulltab3">
                       <!--begin::Body-->
                        <div class="pt-1">
                          <!--begin::Item-->
                          <div class="text-center">
                            <img src="<?= get_theme_file_uri("assets/images/undraw_online_banking.svg") ?>"
                                         class="w-50 mx-auto" alt=""/>
                          </div>
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Getting a reliable quote is one of the major hurdles standing in the way of issuing finance or approving an insurance claim. This typically slows down the approval process dramatically. 
                              Aireno expedites this process by allowing you and your customers to quickly and accurately build market rate renovation quotes that you can rely on.
                            </span>
                          </div>
                          <!--end::Item-->
                          <!--end::Item-->
                         <div class="d-flex flex-column mb-7">
                           <a class="btn btn-danger btn-lg fw-bolder" href="/register">Get Started</a>
                         </div>
                        </div>
                        <!--end::Body-->
                      </div>
                      <!--end::Tab Pane-->
                       <!--begin::Tab Pane-->
                      <div class="tab-pane fade" id="full4" role="tabpanel" aria-labelledby="fulltab4">
                        <!--begin::Body-->
                        <div class="pt-1">
                          <!--begin::Item-->
                          <div class="text-center">
                            <img src="<?= get_theme_file_uri("assets/images/undraw_add_to.svg") ?>"
                                         class="w-50 mx-auto" alt=""/>
                          </div>
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Choosing product and finishes is a big step in the renovation journey, ultimately you want your customers to be decisive and the complexity of other big questions like “can you recommend contractors” or “how much this will entire project cost”  will usually derail their purchasing intent. 
                               Aireno can address both of those scenarios by offering a seamless online experience that will inevitably streamline your sales process. 
                            </span>
                          </div>
                          <!--end::Item-->
                          <!--end::Item-->
                         <div class="d-flex flex-column mb-7">
                           <a class="btn btn-danger btn-lg fw-bolder" href="/register">Get Started</a>
                         </div>
                        </div>
                        <!--end::Body-->
                      </div>
                      <!--end::Tab Pane-->
                    </div>
                    <!--end::Tab content-->
                  </div>
                  <!--end::Col-->
                </div>
                <!--end::Row-->
              </div>
            </div>
            <!--end::Tab Content-->
          </div>
          <!--end::Plans-->
          
                  </div>
                </div>
            </div>
            <!--end::Projects Section-->
            <!--begin::Pricing Section-->
            <div class="mt-sm-n20">
                <!--begin::Wrapper-->
                <div class="py-20 landing-dark-bg">
                    <!--begin::Container-->
                    <div class="container">
                        <!--begin::Plans-->
                        <div class="d-flex flex-column container pt-lg-20">
                            <!--begin::Heading-->
                            <div class="mb-13 text-center">
                                <h1 class="fs-2hx fw-bolder text-white mb-5" id="pricing"
                                    data-kt-scroll-offset="{default: 100, lg: 150}">Get Started</h1>
                                <div class="text-gray-600 fw-bold fs-5">Quote, plan & manage your project on Aireno
                                </div>
                            </div>
                            <!--end::Heading-->
                            <!--begin::Pricing-->
                            <div class="text-center" id="kt_pricing">
                                <!--begin::Row-->
                                <div class="row g-10">
                                    <div class="col-md-2">

                                    </div>
                                    <!--begin::Col-->
                                    <div class="col-md-4">
                                        <div class="d-flex h-100 align-items-center justify-content-start">
                                            <!--begin::Option-->
                                            <div class="w-100 d-flex flex-column flex-center rounded-3 bg-primary py-20 px-10">
                                                <!--begin::Heading-->
                                                <div class="mb-7 text-center">
                                                    <!--begin::Title-->
                                                    <h1 class="text-white mb-5 fw-boldest">For Your Business</h1>
                                                    <!--end::Title-->
                                                    <!--begin::Description-->
                                                    <div class="text-white opacity-75 fw-bold mb-5">Harness our tools
                                                        for your business & streamline every phase in your project.
                                                    </div>
                                                    <!--end::Description-->
                                                    <!--begin::Price-->
                                                    <div class="text-center">
                                                        <span class="mb-2 text-white">$</span>
                                                        <span class="fs-3x fw-bolder text-white"
                                                              data-kt-plan-price-month="199"
                                                              data-kt-plan-price-annual="1999">349</span>
                                                        <span class="fs-7 fw-bold text-white opacity-75"
                                                              data-kt-plan-price-month="Mon">/ Mon</span>
                                                    </div>
                                                    <!--end::Price-->
                                                </div>
                                                <!--end::Heading-->
                                                <!--begin::Features-->
                                                <div class="w-100 mb-10">
                                                    <!--begin::Item-->
                                                    <div class="d-flex flex-stack mb-5">
                                                        <span class="fw-bold fs-6 text-white opacity-75 text-start pe-3">Branded Instant quote builder </span>
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                        <span class="svg-icon svg-icon-1 svg-icon-white">
															<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                      rx="10" fill="currentColor"/>
																<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                      fill="currentColor"/>
															</svg>
														</span>
                                                        <!--end::Svg Icon-->
                                                    </div>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <div class="d-flex flex-stack mb-5">
                                                        <span class="fw-bold fs-6 text-white opacity-75 text-start pe-3">Edit & manage our pricing & margins</span>
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                        <span class="svg-icon svg-icon-1 svg-icon-white">
															<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                      rx="10" fill="currentColor"/>
																<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                      fill="currentColor"/>
															</svg>
														</span>
                                                        <!--end::Svg Icon-->
                                                    </div>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <div class="d-flex flex-stack mb-5">
                                                        <span class="fw-bold fs-6 text-white opacity-75 text-start pe-3">150,000 + instant prices with new prices daily</span>
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                        <span class="svg-icon svg-icon-1 svg-icon-white">
															<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                      rx="10" fill="currentColor"/>
																<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                      fill="currentColor"/>
															</svg>
														</span>
                                                        <!--end::Svg Icon-->
                                                    </div>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <div class="d-flex flex-stack mb-5">
                                                        <span class="fw-bold fs-6 text-white opacity-75 text-start pe-3">Unlimited access for you & your clients</span>
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                        <span class="svg-icon svg-icon-1 svg-icon-white">
															<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                      rx="10" fill="currentColor"/>
																<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                      fill="currentColor"/>
															</svg>
														</span>
                                                        <!--end::Svg Icon-->
                                                    </div>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <div class="d-flex flex-stack mb-5">
                                                        <span class="fw-bold fs-6 text-white opacity-75 text-start pe-3">Lead Generation & Qualification</span>
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                        <span class="svg-icon svg-icon-1 svg-icon-white">
															<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                      rx="10" fill="currentColor"/>
																<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                      fill="currentColor"/>
															</svg>
														</span>
                                                        <!--end::Svg Icon-->
                                                    </div>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <div class="d-flex flex-stack mb-5">
                                                        <span class="fw-bold fs-6 text-white opacity-75">Instance access to our experts</span>
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
                                                        <span class="svg-icon svg-icon-1 svg-icon-white">
															<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                      rx="10" fill="currentColor"/>
																<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                      fill="currentColor"/>
															</svg>
														</span>
                                                        <!--end::Svg Icon-->
                                                    </div>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <div class="d-flex flex-stack mb-5">
                                                        <span class="fw-bold fs-6 text-white opacity-75">Allow your customers to quote directly</span>
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
                                                        <span class="svg-icon svg-icon-1 svg-icon-white">
															<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                      rx="10" fill="currentColor"/>
																<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                      fill="currentColor"/>
															</svg>
														</span>
                                                        <!--end::Svg Icon-->
                                                    </div>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <div class="d-flex flex-stack mb-5">
                                                        <span class="fw-bold fs-6 text-white opacity-75">Powerful project dashboard</span>
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
                                                        <span class="svg-icon svg-icon-1 svg-icon-white">
															<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                      rx="10" fill="currentColor"/>
																<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                      fill="currentColor"/>
															</svg>
														</span>
                                                        <!--end::Svg Icon-->
                                                    </div>
                                                    <!--end::Item--><!--begin::Item-->
                                                    <div class="d-flex flex-stack mb-5">
                                                        <span class="fw-bold fs-6 text-white opacity-75">Free project templates, setup in seconds</span>
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
                                                        <span class="svg-icon svg-icon-1 svg-icon-white">
															<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                      rx="10" fill="currentColor"/>
																<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                      fill="currentColor"/>
															</svg>
														</span>
                                                        <!--end::Svg Icon-->
                                                    </div>
                                                    <!--end::Item--><!--begin::Item-->
                                                    <div class="d-flex flex-stack mb-5">
                                                        <span class="fw-bold fs-6 text-white opacity-75">Group chat & easy team invites</span>
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
                                                        <span class="svg-icon svg-icon-1 svg-icon-white">
															<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                      rx="10" fill="currentColor"/>
																<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                      fill="currentColor"/>
															</svg>
														</span>
                                                        <!--end::Svg Icon-->
                                                    </div>
                                                    <!--end::Item-->
                                                    <!--end::Item--><!--begin::Item-->
                                                    <div class="d-flex flex-stack mb-5">
                                                        <span class="fw-bold fs-6 text-white opacity-75">File manager - Upload photos, plans & docs.  </span>
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
                                                        <span class="svg-icon svg-icon-1 svg-icon-white">
															<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                      rx="10" fill="currentColor"/>
																<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                      fill="currentColor"/>
															</svg>
														</span>
                                                        <!--end::Svg Icon-->
                                                    </div>
                                                    <!--end::Item-->
                                                    <!--end::Item--><!--begin::Item-->
                                                    <div class="d-flex flex-stack mb-5">
                                                        <span class="fw-bold fs-6 text-white opacity-75">Contact manager & CRM</span>
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
                                                        <span class="svg-icon svg-icon-1 svg-icon-white">
															<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                      rx="10" fill="currentColor"/>
																<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                      fill="currentColor"/>
															</svg>
														</span>
                                                        <!--end::Svg Icon-->
                                                    </div>
                                                    <!--end::Item-->
                                                    <!--end::Item--><!--begin::Item-->
                                                    <div class="d-flex flex-stack mb-5">
                                                        <span class="fw-bold fs-6 text-white opacity-75">Activity log with email & native notifications</span>
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
                                                        <span class="svg-icon svg-icon-1 svg-icon-white">
															<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                      rx="10" fill="currentColor"/>
																<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                      fill="currentColor"/>
															</svg>
														</span>
                                                        <!--end::Svg Icon-->
                                                    </div>
                                                    <!--end::Item-->
                                                    <!--end::Item--><!--begin::Item-->
                                                    <div class="d-flex flex-stack mb-5">
                                                        <span class="fw-bold fs-6 text-white opacity-75">Dedicated support & training </span>
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
                                                        <span class="svg-icon svg-icon-1 svg-icon-white">
															<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                      rx="10" fill="currentColor"/>
																<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                      fill="currentColor"/>
															</svg>
														</span>
                                                        <!--end::Svg Icon-->
                                                    </div>
                                                    <!--end::Item-->
                                                </div>
                                                <!--end::Features-->
                                                <!--begin::Select-->
                                                <a href="<?=site_url()?>/membership/membership-checkout/?level=1"
                                                   class="btn btn-color-primary btn-active-light-primary btn-light">Get
                                                    Started</a>
                                                <!--end::Select-->
                                            </div>
                                            <!--end::Option-->
                                        </div>
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col-md-4">
                                        <div class="d-flex h-100  justify-content-start">
                                            <!--begin::Option-->
                                            <div class="w-100 d-flex flex-column flex-center rounded-3 bg-body py-20 px-10 justify-content-between">
                                                <!--begin::Heading-->
                                                <div class="mb-7 text-center">
                                                    <!--begin::Title-->
                                                    <h1 class="text-dark mb-5 fw-boldest">For Your Home</h1>
                                                    <!--end::Title-->
                                                    <!--begin::Description-->
                                                    <div class="text-gray-400 fw-bold mb-5">Quote, plan & manage everything for your
                                                        home project for free
                                                    </div>
                                                    <!--end::Description-->
                                                    <!--begin::Price-->
                                                    <div class="text-center">
                                                        <span class="fs-3x fw-bolder text-primary"
                                                              data-kt-plan-price-month="99"
                                                              data-kt-plan-price-annual="999">Free</span>
                                                    </div>
                                                    <!--end::Price-->

                                                    <!--begin::Features-->
                                                    <div class="w-100 mt-10 mb-10">
                                                        <!--begin::Item-->
                                                        <div class="d-flex flex-stack mb-5">
                                                            <span class="fw-bold fs-6 text-gray-800 text-start pe-3">Free Instant pricing tool</span>
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                            <span class="svg-icon svg-icon-1 svg-icon-success">
															<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                      rx="10" fill="currentColor"/>
																<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                      fill="currentColor"/>
															</svg>
														</span>
                                                            <!--end::Svg Icon-->
                                                        </div>
                                                        <!--end::Item-->
                                                        <!--begin::Item-->
                                                        <div class="d-flex flex-stack mb-5">
                                                            <span class="fw-bold fs-6 text-gray-800 text-start pe-3">150,000 + instant prices with new prices daily</span>
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                            <span class="svg-icon svg-icon-1 svg-icon-success">
															<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                      rx="10" fill="currentColor"/>
																<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                      fill="currentColor"/>
															</svg>
														</span>
                                                            <!--end::Svg Icon-->
                                                        </div>
                                                        <!--end::Item-->
                                                        <!--begin::Item-->
                                                        <div class="d-flex flex-stack mb-5">
                                                            <span class="fw-bold fs-6 text-gray-800">Online Project Dashbaord</span>
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
                                                            <span class="svg-icon svg-icon-1 svg-icon-success">
															<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                      rx="10" fill="currentColor"/>
																<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                      fill="currentColor"/>
															</svg>
														</span>
                                                            <!--end::Svg Icon-->
                                                        </div>
                                                        <!--end::Item-->
                                                        <!--begin::Item-->
                                                        <div class="d-flex flex-stack mb-5">
                                                            <span class="fw-bold fs-6 text-gray-800">Instant access to our experts</span>
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
                                                            <span class="svg-icon svg-icon-1 svg-icon-success">
															<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                      rx="10" fill="currentColor"/>
																<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                      fill="currentColor"/>
															</svg>
														</span>
                                                            <!--end::Svg Icon-->
                                                        </div>
                                                        <!--end::Item-->
                                                        <!--begin::Item-->
                                                        <div class="d-flex flex-stack mb-5">
                                                            <span class="fw-bold fs-6 text-gray-800">Get matched to contractors</span>
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
                                                            <span class="svg-icon svg-icon-1 svg-icon-success">
															<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                      rx="10" fill="currentColor"/>
																<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                      fill="currentColor"/>
															</svg>
														</span>
                                                            <!--end::Svg Icon-->
                                                        </div>
                                                        <!--end::Item-->
                                                        <!--begin::Item-->
                                                        <div class="d-flex flex-stack mb-5">
                                                            <span class="fw-bold fs-6 text-gray-800">Activity log with email & native notifications</span>
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
                                                            <span class="svg-icon svg-icon-1 svg-icon-success">
															<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                      rx="10" fill="currentColor"/>
																<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                      fill="currentColor"/>
															</svg>
														</span>
                                                            <!--end::Svg Icon-->
                                                        </div>
                                                        <!--end::Item-->
                                                      <!--begin::Item-->
                                                        <div class="d-flex flex-stack">
                                                            <span class="fw-bold fs-6 text-gray-800">Group chat & easy team invites</span>
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
                                                            <span class="svg-icon svg-icon-1 svg-icon-success">
															<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                      rx="10" fill="currentColor"/>
																<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                      fill="currentColor"/>
															</svg>
														</span>
                                                            <!--end::Svg Icon-->
                                                        </div>
                                                        <!--end::Item-->
                                                    </div>
                                                    <!--end::Features-->
                                                </div>
                                                <!--end::Heading-->

                                                <!--begin::Select-->
                                                <a href="/quote-builder" class="btn btn-primary">Quote Builder</a>
                                                <!--end::Select-->
                                            </div>
                                            <!--end::Option-->
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Pricing-->
                        </div>
                        <!--end::Plans-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Wrapper-->
            </div>
             <!--end::Pricing Section-->
          <!--begin::Testimonials Section-->
            <div class="mt-20 mb-n20 position-relative z-index-2">
                <!--begin::Container-->
                <div class="container">
                    <!--begin::Heading-->
                    <div class="text-center mb-17">
                        <!--begin::Title-->
                        <h3 class="fs-2hx text-dark mb-5" id="clients" data-kt-scroll-offset="{default: 125, lg: 150}">
                            What Our Users Say</h3>
                        <!--end::Title-->
                        <!--begin::Description-->
                        <div class="fs-5 text-muted fw-bold">Renovate Better on Aireno
                        </div>
                        <!--end::Description-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Row-->
                    <div class="row g-lg-10 mb-10 mb-lg-20">
                        <!--begin::Col-->
                        <div class="col-lg-4">
                            <!--begin::Testimonial-->
                            <div class="d-flex flex-column justify-content-between h-lg-100 px-10 px-lg-0 pe-lg-10 mb-15 mb-lg-0">
                                <!--begin::Wrapper-->
                                <div class="mb-7">
                                    <!--begin::Rating-->
                                    <div class="rating mb-6">
                                        <div class="rating-label me-2 checked">
                                            <i class="bi bi-star-fill fs-5"></i>
                                        </div>
                                        <div class="rating-label me-2 checked">
                                            <i class="bi bi-star-fill fs-5"></i>
                                        </div>
                                        <div class="rating-label me-2 checked">
                                            <i class="bi bi-star-fill fs-5"></i>
                                        </div>
                                        <div class="rating-label me-2 checked">
                                            <i class="bi bi-star-fill fs-5"></i>
                                        </div>
                                        <div class="rating-label me-2 checked">
                                            <i class="bi bi-star-fill fs-5"></i>
                                        </div>
                                    </div>
                                    <!--end::Rating-->
                                   <!--begin::Title-->
                                    <div class="fs-2 fw-bolder text-dark mb-3">It was easy for me and I've never renovated
                                    </div>
                                    <!--end::Title-->
                                    <!--begin::Feedback-->
                                    <div class="text-gray-500 fw-bold fs-4">For young homeowners who have no idea what they're doing, the support, the technology and the options were fantastic to have.
                                    </div>
                                    <!--end::Feedback-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Author-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-circle symbol-50px me-5">
                                        <img src="<?= get_theme_file_uri("assets/images/paul.png") ?>"
                                             class="" alt=""/>
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Name-->
                                    <div class="flex-grow-1">
                                        <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">Paul Miles</a>
                                        <span class="text-muted d-block fw-bold">Renovated in Sydney</span>
                                    </div>
                                    <!--end::Name-->
                                </div>
                                <!--end::Author-->
                            </div>
                            <!--end::Testimonial-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-lg-4">
                            <!--begin::Testimonial-->
                            <div class="d-flex flex-column justify-content-between h-lg-100 px-10 px-lg-0 pe-lg-10 mb-15 mb-lg-0">
                                <!--begin::Wrapper-->
                                <div class="mb-7">
                                    <!--begin::Rating-->
                                    <div class="rating mb-6">
                                        <div class="rating-label me-2 checked">
                                            <i class="bi bi-star-fill fs-5"></i>
                                        </div>
                                        <div class="rating-label me-2 checked">
                                            <i class="bi bi-star-fill fs-5"></i>
                                        </div>
                                        <div class="rating-label me-2 checked">
                                            <i class="bi bi-star-fill fs-5"></i>
                                        </div>
                                        <div class="rating-label me-2 checked">
                                            <i class="bi bi-star-fill fs-5"></i>
                                        </div>
                                        <div class="rating-label me-2 checked">
                                            <i class="bi bi-star-fill fs-5"></i>
                                        </div>
                                    </div>
                                    <!--end::Rating-->
                                   <!--begin::Title-->
                                    <div class="fs-2 fw-bolder text-dark mb-3">It saves me at least 10 hours a week
                                    </div>
                                    <!--end::Title-->
                                    <!--begin::Feedback-->
                                    <div class="text-gray-500 fw-bold fs-4">This platform has transformed how I run my business, I love it and my customers do too. 
                                    </div>
                                    <!--end::Feedback-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Author-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-circle symbol-50px me-5">
                                        <img src="<?= get_theme_file_uri("assets/images/sean.png") ?>"
                                             alt=""/>
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Name-->
                                    <div class="flex-grow-1">
                                        <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">Sean
                                            Colbert</a>
                                        <span class="text-muted d-block fw-bold">Builder</span>
                                    </div>
                                    <!--end::Name-->
                                </div>
                                <!--end::Author-->
                            </div>
                            <!--end::Testimonial-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-lg-4">
                            <!--begin::Testimonial-->
                            <div class="d-flex flex-column justify-content-between h-lg-100 px-10 px-lg-0 pe-lg-10 mb-15 mb-lg-0">
                                <!--begin::Wrapper-->
                                <div class="mb-7">
                                    <!--begin::Rating-->
                                    <div class="rating mb-6">
                                        <div class="rating-label me-2 checked">
                                            <i class="bi bi-star-fill fs-5"></i>
                                        </div>
                                        <div class="rating-label me-2 checked">
                                            <i class="bi bi-star-fill fs-5"></i>
                                        </div>
                                        <div class="rating-label me-2 checked">
                                            <i class="bi bi-star-fill fs-5"></i>
                                        </div>
                                        <div class="rating-label me-2 checked">
                                            <i class="bi bi-star-fill fs-5"></i>
                                        </div>
                                        <div class="rating-label me-2 checked">
                                            <i class="bi bi-star-fill fs-5"></i>
                                        </div>
                                    </div>
                                    <!--end::Rating-->
                                    <!--begin::Title-->
                                    <div class="fs-2 fw-bolder text-dark mb-3">Its a gamechanger.
                                    </div>
                                    <!--end::Title-->
                                    <!--begin::Feedback-->
                                    <div class="text-gray-500 fw-bold fs-4">I would usually sit on sending a quote for at least a week not knowing that I was losing business, now I can do it instantly and with little effort.
                                    </div>
                                    <!--end::Feedback-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Author-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-circle symbol-50px me-5">
                                        <img src="<?= get_theme_file_uri("assets/images/steve.png") ?>"
                                             alt=""/>
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Name-->
                                    <div class="flex-grow-1">
                                        <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">Steve Prescott</a>
                                        <span class="text-muted d-block fw-bold">Project Manager</span>
                                    </div>
                                    <!--end::Name-->
                                </div>
                                <!--end::Author-->
                            </div>
                            <!--end::Testimonial-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                    <!--begin::Highlight-->
                    <div class="d-flex flex-stack flex-wrap flex-md-nowrap card-rounded shadow p-8 p-lg-12 mb-n5 mb-lg-n13 bg-primary">
                        <!--begin::Content-->
                        <div class="my-2 me-5">
                        <!--begin::Title-->
                        <div class="fs-1 fs-lg-2qx fw-bolder text-white mb-2">Quote, plan & manage your project on autopilot
                            </div>
                        <!--end::Title-->
                        <!--begin::Description-->
                        <div class="fs-6 fs-lg-5 text-white fw-bold opacity-75">Streamline & automate your project with smart AI driven renovation tools</div>
                        <!--end::Description-->
                    </div>
                        <!--end::Content-->
                        <!--begin::Link-->
                        <a href="/quote-builder"
                           class="btn btn-lg btn-outline border-2 btn-outline-white flex-shrink-0 my-2">Get Started</a>
                        <!--end::Link-->
                    </div>
                    <!--end::Highlight-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Testimonials Section-->
          
    </div>
     </div>
    <!--end::Content-->
  <?php
get_footer();
