<?php
get_header();
?>
    <!--begin::Content-->
    <div class="content d-flex flex-column bg-white flex-column-fluid" id="kt_content">
        <!--begin::How It Works Section-->
        <div class="mb-n10 mb-lg-n20 z-index-2">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Heading-->
               <script src="<?=get_theme_file_uri("assets/js/typedjs.bundle.js")?>">
               </script>
                 <div class="row justify-content-center">
               <div class="text-center col-12 col-md-12">
                 <h1 class="display-1">Renovate
											<span class="d-inline-block position-relative">
											<span class="display-1">Smart</span>
											<span class="d-inline-block position-absolute h-8px bottom-0 end-0 start-0 bg-danger translate rounded"></span>
											</span>
                      </h1>
                  <div class="fw-semibold fs-2 text-muted m-10 h-100px"><span class="fw-bold text-danger">Find out instantly how much your <br/><span id="typed" class="fw-bolder"></span>costs?</span><br/>
                  <span data-bs-toggle="tooltip" title="Build a precise quote instantly. Our quote engine uses a smart questionaire & real market pricing data to generate a quote on the spot." class="fw-bolder text-dark">Magically quote</span>, plan & manage your project on <span class="fw-bolder text-dark">Aireno</span> 
								</div>
                 <script>
             var typed = new Typed("#typed", {
            strings: ["Bathroom Renovation", "Kitchen Renovation", "House extension", "Home project", "Painting project", "Flooring project", "Electrical project", "Plumbing project"],
            typeSpeed: 60,
            loop: true  
             });
            </script>
                      <div class="m-10 position-relative z-index-3">
                        <a class="btn btn-danger btn-lg fw-bolder z-index-3" href="/quote-builder"><i class="fa-regular fa-calculator"></i> Build a Quote</a>
                        <a class="btn btn-bg-white fw-bold btn-lg fw-bolder" href="/business"><i class="fa-sharp fa-solid fa-briefcase"></i> For Business</a>
                        </div>
                </div>
              </div>
                    <!--begin::Product slider-->
                    <div class="row justify-content-center mt-n20">
                     <div class="col-md-6 col-12">
                        <img src="<?= get_theme_file_uri("assets/images/front-page/undraw_under.svg") ?>"
                                         class="w-100 mb-9 mt-n20" alt=""/>
                      </div>        
                    </div>
                    <!--end::Product slider-->
                    <!--end::Heading-->
                </div>
                <!--end::Container-->
            </div>
           <div class="container mt-20">
                <div class="text-center mb-12 mt-20">
                    <!--begin::Title-->
                    <h3 class="fs-2hx text-dark mb-5" id="team" data-kt-scroll-offset="{default: 100, lg: 150}">Renovate
                        Digitally</h3>
                    <!--end::Title-->
                    <!--begin::Sub-title-->
                    <div class="fs-5 text-muted fw-bold">Do it all online
                    </div>
                    <!--end::Sub-title=-->
                </div>
                <div class="card mt-n1" style="filter: drop-shadow(0px 0px 40px rgba(68, 81, 96, 0.08))">
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
                                        instantly using our researched rates or add your own.
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
                                    <div class="fw-bold fs-6 fs-lg-4 text-muted">Plan everything using our 
                                      tailor made tools that are designed to streamline every step.
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
                                        seamless workflow makes managing your project a breeze.
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
                        <div class="text-center mt-15 mb-18" id="achievements"
                             data-kt-scroll-offset="{default: 100, lg: 150}">
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
                                <div class="d-flex flex-column flex-center h-200px w-200px h-lg-250px w-lg-250px m-3 bgi-no-repeat bgi-position-center bgi-size-contain"
                                     style="background-image: url('<?= get_theme_file_uri("assets/images/octagon.svg") ?>')">
                                    <!--begin::Symbol-->
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2tx svg-icon-white mb-3">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none">
											<rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor"/>
											<rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2"
                                                  fill="currentColor"/>
											<rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2"
                                                  fill="currentColor"/>
											<rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2"
                                                  fill="currentColor"/>
										</svg>
									</span>
                                    <!--end::Svg Icon-->
                                    <!--end::Symbol-->
                                    <!--begin::Info-->
                                    <div class="mb-0">
                                        <!--begin::Value-->
                                        <div class="fs-lg-2hx fs-2x fw-bolder text-white d-flex flex-center">
                                            <div class="min-w-70px" data-kt-countup="true" data-kt-countup-value="30"
                                                 data-kt-countup-suffix="+">0
                                            </div>
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
                                <div class="d-flex flex-column flex-center h-200px w-200px h-lg-250px w-lg-250px m-3 bgi-no-repeat bgi-position-center bgi-size-contain"
                                     style="background-image: url('<?= get_theme_file_uri("assets/images/octagon.svg") ?>')">
                                    <!--begin::Symbol-->
                                    <!--begin::Svg Icon | path: icons/duotune/graphs/gra008.svg-->
                                    <span class="svg-icon svg-icon-2tx svg-icon-white mb-3">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none">
											<path d="M13 10.9128V3.01281C13 2.41281 13.5 1.91281 14.1 2.01281C16.1 2.21281 17.9 3.11284 19.3 4.61284C20.7 6.01284 21.6 7.91285 21.9 9.81285C22 10.4129 21.5 10.9128 20.9 10.9128H13Z"
                                                  fill="currentColor"/>
											<path opacity="0.3"
                                                  d="M13 12.9128V20.8129C13 21.4129 13.5 21.9129 14.1 21.8129C16.1 21.6129 17.9 20.7128 19.3 19.2128C20.7 17.8128 21.6 15.9128 21.9 14.0128C22 13.4128 21.5 12.9128 20.9 12.9128H13Z"
                                                  fill="currentColor"/>
											<path opacity="0.3"
                                                  d="M11 19.8129C11 20.4129 10.5 20.9129 9.89999 20.8129C5.49999 20.2129 2 16.5128 2 11.9128C2 7.31283 5.39999 3.51281 9.89999 3.01281C10.5 2.91281 11 3.41281 11 4.01281V19.8129Z"
                                                  fill="currentColor"/>
										</svg>
									</span>
                                    <!--end::Svg Icon-->
                                    <!--end::Symbol-->
                                    <!--begin::Info-->
                                    <div class="mb-0">
                                        <!--begin::Value-->
                                        <div class="fs-lg-2hx fs-2x fw-bolder text-white d-flex flex-center">
                                            <div class="min-w-70px" data-kt-countup="true" data-kt-countup-value="2.5"
                                                 data-kt-countup-suffix="mins">0
                                            </div>
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
                                <div class="d-flex flex-column flex-center h-200px w-200px h-lg-250px w-lg-250px m-3 bgi-no-repeat bgi-position-center bgi-size-contain"
                                     style="background-image: url('<?= get_theme_file_uri("assets/images/octagon.svg") ?>')">
                                    <!--begin::Symbol-->
                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm002.svg-->
                                    <span class="svg-icon svg-icon-2tx svg-icon-white mb-3">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none">
											<path d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z"
                                                  fill="currentColor"/>
											<path opacity="0.3"
                                                  d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z"
                                                  fill="currentColor"/>
											<path opacity="0.3"
                                                  d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z"
                                                  fill="currentColor"/>
										</svg>
									</span>
                                    <!--end::Svg Icon-->
                                    <!--end::Symbol-->
                                    <!--begin::Info-->
                                    <div class="mb-0">
                                        <!--begin::Value-->
                                        <div class="fs-lg-2hx fs-2x fw-bolder text-white d-flex flex-center">
                                            <div class="min-w-70px" data-kt-countup="true" data-kt-countup-value="150000"
                                                 data-kt-countup-suffix="+">0
                                            </div>
                                        </div>
                                        <!--end::Value-->
                                        <!--begin::Label-->
                                        <span class="text-gray-600 fw-bold fs-5 lh-0">Instant prices</span>
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
                            <h3 class="fs-2hx text-dark mb-5">Renovate Easier</h3>
                            <div class="fs-5 text-gray-700 fw-bold">Online tools that make renovating 10x easier</div>
                            <!--end::Title-->
                        </div>
                        <div class="row p-10">
                            <div class="col-md-6 col-12">
                                <a data-fslightbox="lightbox-basic" href="<?= get_theme_file_uri("assets/images/front-page/breakdown.png") ?>"><div class="card bg-light-danger mb-5 h-200px">
                                    <div class="card-body">
                                        <div class="d-flex flex-stack">
                                            <!--begin::Symbol-->
                                            <i class="fs-5x text-danger fa-solid fa-calculator-simple"></i>
                                            <!--end::Symbol-->
                                            <!--begin::Section-->
                                            <div class="d-flex align-items-center flex-row-fluid flex-wrap p-5">
                                                <!--begin:Author-->
                                                <div class="flex-grow-1 me-2">
                                                    <h3 class="card-title text-danger fw-bolder fs-2x">
                                                        Quote Builder
                                                    </h3>
                                                    <span class="text-dark fw-semibold d-block fs-7">We've made answering the "How much does it cost?" question super easy. Build your own quote on the spot using our pricing algorithm which is driven by real market prices.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  </div></a>
                                <a data-fslightbox="lightbox-basic" href="<?= get_theme_file_uri("assets/images/front-page/overview.png") ?>">
                                  <div class="card bg-light-danger mb-5 h-200px">
                                    <div class="card-body">
                                        <div class="d-flex flex-stack">
                                            <!--begin::Symbol-->
                                            <i class="fs-5x text-danger fa-regular fa-gauge-max"></i>
                                            <!--end::Symbol-->
                                            <!--begin::Section-->
                                            <div class="d-flex align-items-center flex-row-fluid flex-wrap p-5">
                                                <!--begin:Author-->
                                                <div class="flex-grow-1 me-2">
                                                    <h3 class="card-title text-danger fw-bolder fs-2x">
                                                        Project Dashboard
                                                    </h3>
                                                    <span class="text-dark fw-semibold d-block fs-7">Manage everything on one easy-to-use dashboard. Centralsing your workflow brings transparency to your project, we've built custom tools for every step, simplifying & streamlining the whole process.  </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </a>
                            </div>
                            <div class="col-md-3 col-6">
                               <a data-fslightbox="lightbox-basic" href="<?= get_theme_file_uri("assets/images/front-page/teamchat.png") ?>">
                                  <div class="card border border-dashed border-danger bg-hover-light h-125px mb-6">
                                    <div class="card-body text-center">
                                        <i class="fs-2x text-danger fa-light fa-messages"></i>
                                        <h3 class="card-title text-danger fw-bolder m-0">
                                            Team Chat
                                        </h3>
                                        <span class="text-dark fw-semibold d-block fs-7">Keep in touch with everyone in one place</span>
                                    </div>
                                </div>
                              </a>
                               <a data-fslightbox="lightbox-basic" href="<?= get_theme_file_uri("assets/images/front-page/invoice.png") ?>">
                                <div class="card border border-dashed border-danger bg-hover-light h-125px mb-6">
                                    <div class="card-body text-center">
                                        <i class="fs-2x text-danger fa-light fa-file-invoice"></i>
                                        <h3 class="card-title text-danger fw-bolder m-0">
                                            Payments
                                        </h3>
                                        <span class="text-dark fw-semibold d-block fs-7">Instant, simple, transperant payment manager</span>
                                    </div>
                                </div>
                              </a>
                               <a data-fslightbox="lightbox-basic" href="<?= get_theme_file_uri("assets/images/front-page/schedule.png") ?>">
                                <div class="card border border-dashed border-danger bg-hover-light h-125px mb-5 bg-hover-danger-light">
                                    <div class="card-body text-center">
                                        <i class="fs-2x text-danger fa-light fa-bars-progress"></i>
                                        <h3 class="card-title text-danger fw-bolder m-0">
                                            Progress Tracker
                                        </h3>
                                        <span class="text-dark fw-semibold d-block fs-7">Easily keep track of progress with photos and tasks</span>
                                    </div>
                                </div>
                                  </a>
                            </div>
                            <div class="col-md-3 col-6">
                               <a data-fslightbox="lightbox-basic" href="<?= get_theme_file_uri("assets/images/front-page/task.png") ?>">
                                <div class="card border border-dashed border-danger bg-hover-light h-125px mb-6">
                                    <div class="card-body text-center">
                                        <i class="fs-2x text-danger fa-regular fa-list-check"></i>
                                        <h3 class="card-title text-danger fw-bolder m-0">
                                            Tasks Manager
                                        </h3>
                                        <span class="text-dark fw-semibold d-block fs-7">Schedule & assign tasks on the go & get reminders</span>
                                    </div>
                                </div>
                              </a>
                              <a data-fslightbox="lightbox-basic" href="<?= get_theme_file_uri("assets/images/front-page/uploads.png") ?>">
                                <div class="card border border-dashed border-danger bg-hover-light h-125px mb-6">
                                    <div class="card-body text-center">
                                        <i class="fs-2x text-danger fa-light fa-folder-arrow-up"></i>
                                        <h3 class="card-title text-danger fw-bolder m-0">
                                            Documents
                                        </h3>
                                        <span class="text-dark fw-semibold d-block fs-7">Upload & manage all project photos & plans in one place.  </span>
                                    </div>
                                </div>
                             </a>
                             <a data-fslightbox="lightbox-basic" href="<?= get_theme_file_uri("assets/images/front-page/contract.png") ?>"><div class="card border border-dashed border-danger bg-hover-light h-125px mb-5">
                                    <div class="card-body text-center">
                                        <i class="fs-2x text-danger fa-light fa-file-signature"></i>
                                        <h3 class="card-title text-danger fw-bolder m-0">
                                            Contract Manager
                                        </h3>
                                        <span class="text-dark fw-semibold d-block fs-7">Manage & accept contacts online using industry templates. </span>
                                    </div>
                                </div>
                              </a>
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="pb-5">
                                <a class="btn btn-danger fw-bolder text-center" data-fslightbox="lightbox-basic" href="<?= get_theme_file_uri("assets/images/front-page/overview.png") ?>">View All Features</a>
                            </div>
                        </div>
                        <div class="row p-10">
                            <h3 class="fs-2hx text-dark text-center">Get Extra Help</h3>
                            <div class="fs-5 text-gray-700 fw-bold mb-10 text-center">Get
                                instantly connected with our designers, estimators & planners.
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="card bg-gray-100 mb-6">
                                    <div class="card-header ribbon ribbon-top ribbon-vertical">
                                        <h3 class="card-title text-dark fw-bolder m-0">
                                            Design
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex flex-stack">
                                            <div class="symbol p-5 bg-danger">
                                                <i class="fs-3x text-light fa-regular fa-swatchbook"></i>
                                            </div>
                                            <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                                <div class="flex-grow-1">
                                                    <span class="text-dark ms-3 fw-semibold d-block fs-7">Looking for all inclusive design guidance & advice? Get a dedicated designer to draw and curate your renovation. Turn your ideas into workable design drawings.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="card bg-gray-100 mb-6">
                                    <div class="card-header ribbon ribbon-top ribbon-vertical">
                                        <h3 class="card-title text-dark fw-bolder m-0">
                                            Planning
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex flex-stack">
                                            <div class="symbol p-5 bg-danger">
                                                <i class="fs-3x text-light fa-regular fa-handshake-angle"></i>
                                            </div>
                                            <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                                <div class="flex-grow-1">
                                                    <span class="text-dark ms-3 fw-semibold d-block fs-7">Get dedicated, expert support from a project planner who will help you through every step in the quoting and planning phases.  </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="card bg-gray-100 mb-6">
                                    <div class="card-header ribbon ribbon-top ribbon-vertical">
                                        <h3 class="card-title text-dark fw-bolder m-0">
                                            Estimating
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex flex-stack">
                                            <div class="symbol p-5 bg-danger">
                                                <i class="fs-3x text-light fa-regular fa-scanner-keyboard"></i>
                                            </div>
                                            <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                                <div class="flex-grow-1">
                                                    <span class="text-dark ms-3 fw-semibold d-block fs-7">If you're looking for extra help our pricing experts can make sure your quote is correct or even help you with complex projects requiring more attention. </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       <div class="row text-center">
                            <div class="pb-5">
                                <a class="btn btn-danger fw-bolder text-center" data-bs-toggle="modal" data-bs-target="#kt_modal_upgrade_plan">View Options</a>
                            </div>
                        </div>
            <!--begin::FAQ Section-->
                        <div class="row p-10">
                            <h3 class="fs-2hx text-dark mb-5 text-center">FAQ</h3>
                            <!--begin::Col-->
                            <div class="col-md-6 pe-md-10 mb-10 mb-md-0">
                                <!--begin::Accordion-->
                                <!--begin::Section-->
                                <div class="m-0">
                                    <!--begin::Heading-->
                                    <div class="d-flex align-items-center collapsible py-3 toggle mb-0"
                                         data-bs-toggle="collapse" data-bs-target="#kt_job_4_1">
                                        <!--begin::Icon-->
                                        <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                            <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
																		<svg width="24" height="24" viewBox="0 0 24 24"
                                                                             fill="none"
                                                                             xmlns="http://www.w3.org/2000/svg">
																			<rect opacity="0.3" x="2" y="2" width="20"
                                                                                  height="20" rx="5"
                                                                                  fill="currentColor"></rect>
																			<rect x="6.0104" y="10.9247" width="12"
                                                                                  height="2" rx="1"
                                                                                  fill="currentColor"></rect>
																		</svg>
																	</span>
                                            <!--end::Svg Icon-->
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                            <span class="svg-icon toggle-off svg-icon-1">
																		<svg width="24" height="24" viewBox="0 0 24 24"
                                                                             fill="none"
                                                                             xmlns="http://www.w3.org/2000/svg">
																			<rect opacity="0.3" x="2" y="2" width="20"
                                                                                  height="20" rx="5"
                                                                                  fill="currentColor"></rect>
																			<rect x="10.8891" y="17.8033" width="12"
                                                                                  height="2" rx="1"
                                                                                  transform="rotate(-90 10.8891 17.8033)"
                                                                                  fill="currentColor"></rect>
																			<rect x="6.01041" y="10.9247" width="12"
                                                                                  height="2" rx="1"
                                                                                  fill="currentColor"></rect>
																		</svg>
																	</span>
                                            <!--end::Svg Icon-->
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">How can you generate an accurate price, instantly? </h4>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Body-->
                                    <div id="kt_job_4_1" class="collapse show fs-6 ms-1">
                                        <!--begin::Text-->
                                        <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">We’ve developed a quoting algorithm that uses market rates with the recommended industry time scales for labour tasks to calculate an accurate price on the spot. The magic is its simplicity, each project has a tailor made questionnaire which covers all aspects of the work involved, so answer the questions and adjust to the values to suit your project. 
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Content-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed"></div>
                                    <!--end::Separator-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Section-->
                                <div class="m-0">
                                    <!--begin::Heading-->
                                    <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0"
                                         data-bs-toggle="collapse" data-bs-target="#kt_job_4_2">
                                        <!--begin::Icon-->
                                        <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                            <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
																		<svg width="24" height="24" viewBox="0 0 24 24"
                                                                             fill="none"
                                                                             xmlns="http://www.w3.org/2000/svg">
																			<rect opacity="0.3" x="2" y="2" width="20"
                                                                                  height="20" rx="5"
                                                                                  fill="currentColor"></rect>
																			<rect x="6.0104" y="10.9247" width="12"
                                                                                  height="2" rx="1"
                                                                                  fill="currentColor"></rect>
																		</svg>
																	</span>
                                            <!--end::Svg Icon-->
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                            <span class="svg-icon toggle-off svg-icon-1">
																		<svg width="24" height="24" viewBox="0 0 24 24"
                                                                             fill="none"
                                                                             xmlns="http://www.w3.org/2000/svg">
																			<rect opacity="0.3" x="2" y="2" width="20"
                                                                                  height="20" rx="5"
                                                                                  fill="currentColor"></rect>
																			<rect x="10.8891" y="17.8033" width="12"
                                                                                  height="2" rx="1"
                                                                                  transform="rotate(-90 10.8891 17.8033)"
                                                                                  fill="currentColor"></rect>
																			<rect x="6.01041" y="10.9247" width="12"
                                                                                  height="2" rx="1"
                                                                                  fill="currentColor"></rect>
																		</svg>
																	</span>
                                            <!--end::Svg Icon-->
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">Can I accept the quote online?</h4>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Body-->
                                    <div id="kt_job_4_2" class="collapse fs-6 ms-1">
                                        <!--begin::Text-->
                                        <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">Absolutely, hit the accept button and add your credit card details to lock it in. 
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Content-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed"></div>
                                    <!--end::Separator-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Section-->
                                <div class="m-0">
                                    <!--begin::Heading-->
                                    <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0"
                                         data-bs-toggle="collapse" data-bs-target="#kt_job_4_3">
                                        <!--begin::Icon-->
                                        <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                            <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
																		<svg width="24" height="24" viewBox="0 0 24 24"
                                                                             fill="none"
                                                                             xmlns="http://www.w3.org/2000/svg">
																			<rect opacity="0.3" x="2" y="2" width="20"
                                                                                  height="20" rx="5"
                                                                                  fill="currentColor"></rect>
																			<rect x="6.0104" y="10.9247" width="12"
                                                                                  height="2" rx="1"
                                                                                  fill="currentColor"></rect>
																		</svg>
																	</span>
                                            <!--end::Svg Icon-->
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                            <span class="svg-icon toggle-off svg-icon-1">
																		<svg width="24" height="24" viewBox="0 0 24 24"
                                                                             fill="none"
                                                                             xmlns="http://www.w3.org/2000/svg">
																			<rect opacity="0.3" x="2" y="2" width="20"
                                                                                  height="20" rx="5"
                                                                                  fill="currentColor"></rect>
																			<rect x="10.8891" y="17.8033" width="12"
                                                                                  height="2" rx="1"
                                                                                  transform="rotate(-90 10.8891 17.8033)"
                                                                                  fill="currentColor"></rect>
																			<rect x="6.01041" y="10.9247" width="12"
                                                                                  height="2" rx="1"
                                                                                  fill="currentColor"></rect>
																		</svg>
																	</span>
                                            <!--end::Svg Icon-->
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">Can I just use the tools? </h4>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Body-->
                                    <div id="kt_job_4_3" class="collapse fs-6 ms-1">
                                        <!--begin::Text-->
                                        <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">Yes, Aireno is a software first platform so you’re welcome to make use of the tools all you want, however if you are looking extra services like designer, estimators, planners or even a contractor to do the work we can match you instantly. 
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Content-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed"></div>
                                    <!--end::Separator-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Section-->
                                <div class="m-0">
                                    <!--begin::Heading-->
                                    <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0"
                                         data-bs-toggle="collapse" data-bs-target="#kt_job_4_4">
                                        <!--begin::Icon-->
                                        <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                            <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
																		<svg width="24" height="24" viewBox="0 0 24 24"
                                                                             fill="none"
                                                                             xmlns="http://www.w3.org/2000/svg">
																			<rect opacity="0.3" x="2" y="2" width="20"
                                                                                  height="20" rx="5"
                                                                                  fill="currentColor"></rect>
																			<rect x="6.0104" y="10.9247" width="12"
                                                                                  height="2" rx="1"
                                                                                  fill="currentColor"></rect>
																		</svg>
																	</span>
                                            <!--end::Svg Icon-->
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                            <span class="svg-icon toggle-off svg-icon-1">
																		<svg width="24" height="24" viewBox="0 0 24 24"
                                                                             fill="none"
                                                                             xmlns="http://www.w3.org/2000/svg">
																			<rect opacity="0.3" x="2" y="2" width="20"
                                                                                  height="20" rx="5"
                                                                                  fill="currentColor"></rect>
																			<rect x="10.8891" y="17.8033" width="12"
                                                                                  height="2" rx="1"
                                                                                  transform="rotate(-90 10.8891 17.8033)"
                                                                                  fill="currentColor"></rect>
																			<rect x="6.01041" y="10.9247" width="12"
                                                                                  height="2" rx="1"
                                                                                  fill="currentColor"></rect>
																		</svg>
																	</span>
                                            <!--end::Svg Icon-->
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">How much does it cost to use the quoting tool? </h4>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Body-->
                                    <div id="kt_job_4_4" class="collapse fs-6 ms-1">
                                        <!--begin::Text-->
                                        <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">Aireno is completely free to use for your own renovation project. if you’re looking for a solution for your business check out our business account here. 
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Section-->
                                <!--end::Accordion-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-6 ps-md-10">
                                <!--begin::Accordion-->
                                <!--begin::Section-->
                                <div class="m-0">
                                    <!--begin::Heading-->
                                    <div class="d-flex align-items-center collapsible py-3 toggle mb-0"
                                         data-bs-toggle="collapse" data-bs-target="#kt_job_5_1">
                                        <!--begin::Icon-->
                                        <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                            <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
																		<svg width="24" height="24" viewBox="0 0 24 24"
                                                                             fill="none"
                                                                             xmlns="http://www.w3.org/2000/svg">
																			<rect opacity="0.3" x="2" y="2" width="20"
                                                                                  height="20" rx="5"
                                                                                  fill="currentColor"></rect>
																			<rect x="6.0104" y="10.9247" width="12"
                                                                                  height="2" rx="1"
                                                                                  fill="currentColor"></rect>
																		</svg>
																	</span>
                                            <!--end::Svg Icon-->
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                            <span class="svg-icon toggle-off svg-icon-1">
																		<svg width="24" height="24" viewBox="0 0 24 24"
                                                                             fill="none"
                                                                             xmlns="http://www.w3.org/2000/svg">
																			<rect opacity="0.3" x="2" y="2" width="20"
                                                                                  height="20" rx="5"
                                                                                  fill="currentColor"></rect>
																			<rect x="10.8891" y="17.8033" width="12"
                                                                                  height="2" rx="1"
                                                                                  transform="rotate(-90 10.8891 17.8033)"
                                                                                  fill="currentColor"></rect>
																			<rect x="6.01041" y="10.9247" width="12"
                                                                                  height="2" rx="1"
                                                                                  fill="currentColor"></rect>
																		</svg>
																	</span>
                                            <!--end::Svg Icon-->
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">Can I customise the quote and pricing? </h4>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Body-->
                                    <div id="kt_job_5_1" class="collapse show fs-6 ms-1">
                                        <!--begin::Text-->
                                        <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">Sure you can, our default pricing and quantities are a recommended guide from our pricing experts and industry data. We’re confident our pricing is accurate so make adjustments with caution. 
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Content-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed"></div>
                                    <!--end::Separator-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Section-->
                                <div class="m-0">
                                    <!--begin::Heading-->
                                    <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0"
                                         data-bs-toggle="collapse" data-bs-target="#kt_job_5_2">
                                        <!--begin::Icon-->
                                        <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                            <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
																		<svg width="24" height="24" viewBox="0 0 24 24"
                                                                             fill="none"
                                                                             xmlns="http://www.w3.org/2000/svg">
																			<rect opacity="0.3" x="2" y="2" width="20"
                                                                                  height="20" rx="5"
                                                                                  fill="currentColor"></rect>
																			<rect x="6.0104" y="10.9247" width="12"
                                                                                  height="2" rx="1"
                                                                                  fill="currentColor"></rect>
																		</svg>
																	</span>
                                            <!--end::Svg Icon-->
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                            <span class="svg-icon toggle-off svg-icon-1">
																		<svg width="24" height="24" viewBox="0 0 24 24"
                                                                             fill="none"
                                                                             xmlns="http://www.w3.org/2000/svg">
																			<rect opacity="0.3" x="2" y="2" width="20"
                                                                                  height="20" rx="5"
                                                                                  fill="currentColor"></rect>
																			<rect x="10.8891" y="17.8033" width="12"
                                                                                  height="2" rx="1"
                                                                                  transform="rotate(-90 10.8891 17.8033)"
                                                                                  fill="currentColor"></rect>
																			<rect x="6.01041" y="10.9247" width="12"
                                                                                  height="2" rx="1"
                                                                                  fill="currentColor"></rect>
																		</svg>
																	</span>
                                            <!--end::Svg Icon-->
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">Can I use the instant quote for a bank loan or for budgeting? </h4>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Body-->
                                    <div id="kt_job_5_2" class="collapse fs-6 ms-1">
                                        <!--begin::Text-->
                                        <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">Ofcourse, if you want this we’d recommend using our estimator add-on to ensure it’s accurate. We wouldn’t want the quote to be incorrect. Banks and insurance companies accept our quotes. 
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Content-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed"></div>
                                    <!--end::Separator-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Section-->
                                <div class="m-0">
                                    <!--begin::Heading-->
                                    <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0"
                                         data-bs-toggle="collapse" data-bs-target="#kt_job_5_3">
                                        <!--begin::Icon-->
                                        <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                            <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
																		<svg width="24" height="24" viewBox="0 0 24 24"
                                                                             fill="none"
                                                                             xmlns="http://www.w3.org/2000/svg">
																			<rect opacity="0.3" x="2" y="2" width="20"
                                                                                  height="20" rx="5"
                                                                                  fill="currentColor"></rect>
																			<rect x="6.0104" y="10.9247" width="12"
                                                                                  height="2" rx="1"
                                                                                  fill="currentColor"></rect>
																		</svg>
																	</span>
                                            <!--end::Svg Icon-->
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                            <span class="svg-icon toggle-off svg-icon-1">
																		<svg width="24" height="24" viewBox="0 0 24 24"
                                                                             fill="none"
                                                                             xmlns="http://www.w3.org/2000/svg">
																			<rect opacity="0.3" x="2" y="2" width="20"
                                                                                  height="20" rx="5"
                                                                                  fill="currentColor"></rect>
																			<rect x="10.8891" y="17.8033" width="12"
                                                                                  height="2" rx="1"
                                                                                  transform="rotate(-90 10.8891 17.8033)"
                                                                                  fill="currentColor"></rect>
																			<rect x="6.01041" y="10.9247" width="12"
                                                                                  height="2" rx="1"
                                                                                  fill="currentColor"></rect>
																		</svg>
																	</span>
                                            <!--end::Svg Icon-->
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">Do you have contractors you can recommend? </h4>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Body-->
                                    <div id="kt_job_5_3" class="collapse fs-6 ms-1">
                                        <!--begin::Text-->
                                        <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">Yes we do, we have an extensive network of digital first contractors ready to help. You can request this once you’ve setup a project. Click “request contractor match”
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Content-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed"></div>
                                    <!--end::Separator-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Section-->
                                <div class="m-0">
                                    <!--begin::Heading-->
                                    <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0"
                                         data-bs-toggle="collapse" data-bs-target="#kt_job_5_4">
                                        <!--begin::Icon-->
                                        <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                            <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
																		<svg width="24" height="24" viewBox="0 0 24 24"
                                                                             fill="none"
                                                                             xmlns="http://www.w3.org/2000/svg">
																			<rect opacity="0.3" x="2" y="2" width="20"
                                                                                  height="20" rx="5"
                                                                                  fill="currentColor"></rect>
																			<rect x="6.0104" y="10.9247" width="12"
                                                                                  height="2" rx="1"
                                                                                  fill="currentColor"></rect>
																		</svg>
																	</span>
                                            <!--end::Svg Icon-->
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                            <span class="svg-icon toggle-off svg-icon-1">
																		<svg width="24" height="24" viewBox="0 0 24 24"
                                                                             fill="none"
                                                                             xmlns="http://www.w3.org/2000/svg">
																			<rect opacity="0.3" x="2" y="2" width="20"
                                                                                  height="20" rx="5"
                                                                                  fill="currentColor"></rect>
																			<rect x="10.8891" y="17.8033" width="12"
                                                                                  height="2" rx="1"
                                                                                  transform="rotate(-90 10.8891 17.8033)"
                                                                                  fill="currentColor"></rect>
																			<rect x="6.01041" y="10.9247" width="12"
                                                                                  height="2" rx="1"
                                                                                  fill="currentColor"></rect>
																		</svg>
																	</span>
                                            <!--end::Svg Icon-->
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">Can I bring my use my own team? </h4>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Body-->
                                    <div id="kt_job_5_4" class="collapse fs-6 ms-1">
                                        <!--begin::Text-->
                                        <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">Sure, bring along your own contractors, suppliers, partners to enjoy the power and efficiency of renovating digitally. Invite your team directly on your project and assign their role or if you have opted for a planner they can do this for you. 
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Section-->
                                <!--end::Accordion-->
                            </div>
                            <!--end::Col-->
                        </div>
            <!--end::FAQ Section-->
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

  <!--begin::Modal - project addons-->
  <div class="modal fade" id="kt_modal_upgrade_plan" tabindex="-1" aria-modal="true" role="dialog">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-xl">
      <!--begin::Modal content-->
      <div class="modal-content rounded">
        <!--begin::Modal header-->
        <div class="modal-header justify-content-end border-0 pb-0">
          <!--begin::Close-->
          <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
            <span class="svg-icon svg-icon-1"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
</svg>

</span>
            <!--end::Svg Icon-->
          </div>
          <!--end::Close-->
        </div>
        <!--end::Modal header-->

        <!--begin::Modal body-->
        <div class="modal-body pt-0 pb-15 px-5 px-xl-20">
          <!--begin::Heading-->
          <div class="mb-13 text-center">
            <h1 class="mb-3">Upgrade Your Project</h1>
            <div class="text-muted fw-semibold fs-5">
              Get professional help on your project from our designers, estimators and planners
            </div>
            <div class="text-danger fw-bolder fs-5">Choose your project:</div>
          </div>
          <!--end::Heading-->
          <!--begin::Plans-->
          <div class="d-flex flex-column">
            <!--begin::Nav-->
            <ul class="nav nav-pills nav-pills-custom justify-content-center mb-3" role="tablist">
              <!--begin::Item-->
              <li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
                <!--begin::Link-->
                <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-danger flex-column overflow-hidden w-80px h-85px pt-5 pb-2 active" id="bath_link" data-bs-toggle="tab" href="#bath_tab" aria-selected="true" role="tab" tabindex="-1">
                  <!--begin::Icon-->
                  <div class="nav-icon mb-3">
                    <i class="fa-solid fa-bath fs-1 p-0"></i>
                  </div>
                  <!--end::Icon-->
                  <!--begin::Title-->
                  <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">
                            Bathroom                        
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
                <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-danger flex-column overflow-hidden w-80px h-85px pt-5 pb-2" id="kitchen_link" data-bs-toggle="tab" href="#kitchen_tab" role="tab" aria-selected="false">
                  <!--begin::Icon-->
                  <div class="nav-icon mb-3">
                    <i class="fa-solid fa-kitchen-set fs-1 p-0"></i>
                  </div>
                  <!--end::Icon-->
                  <!--begin::Title-->
                  <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">
                            Kitchen                        
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
                <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-danger flex-column overflow-hidden w-80px h-85px pt-5 pb-2" id="full_link" data-bs-toggle="tab" href="#full_tab" role="tab">
                  <!--begin::Icon-->
                  <div class="nav-icon mb-3">
                    <i class="fa-solid fa-house-medical fs-1 p-0"></i>
                  </div>
                  <!--end::Icon-->
                  <!--begin::Title-->
                  <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">
                          Full Reno                       
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
                <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-danger flex-column overflow-hidden w-80px h-85px pt-5 pb-2" id="extend_link" data-bs-toggle="tab" href="#extend_tab" role="tab">
                  <!--begin::Icon-->
                  <div class="nav-icon mb-3">
                    <i class="fa-regular fa-arrows-maximize fs-1 p-0"></i>
                  </div>
                  <!--end::Icon-->
                  <!--begin::Title-->
                  <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">
                          Extensions                      
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
                <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-danger flex-column overflow-hidden w-80px h-85px pt-5 pb-2" id="laundry_link" data-bs-toggle="tab" href="#laundry_tab" role="tab">
                  <!--begin::Icon-->
                  <div class="nav-icon mb-3">
                    <i class="fa-solid fa-washing-machine fs-1 p-0"></i>
                  </div>
                  <!--end::Icon-->
                  <!--begin::Title-->
                  <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">
                            Laundry                        
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
                <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-danger flex-column overflow-hidden w-80px h-85px pt-5 pb-2" id="general_link" data-bs-toggle="tab" href="#general_tab" role="tab">
                  <!--begin::Icon-->
                  <div class="nav-icon mb-3">
                    <i class="fa-regular fa-hammer fs-1 p-0"></i>
                  </div>
                  <!--end::Icon-->
                  <!--begin::Title-->
                  <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">
                            General                        
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
                              <div class="d-flex align-items-center fs-2 fw-bold flex-wrap">
                                Planning 
                              </div>
                              <div class="fw-semibold opacity-75">
                                Complete package, everything included
                              </div>
                            </div>
                            <!--end::Info-->
                          </div>
                          <!--end::Description-->
                          <!--begin::Price-->
                          <div class="ms-5">
                            <span class="fs-2x fw-bolder">$1800.00</span>
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
                              <div class="d-flex align-items-center fs-2 fw-bold flex-wrap">
                                Design & Selections
                              </div>
                              <div class="fw-semibold opacity-75">
                                All inclusive design service
                              </div>
                            </div>
                            <!--end::Info-->
                          </div>
                          <!--end::Description-->
                          <!--begin::Price-->
                          <div class="ms-5">
                            <span class="fs-2x fw-bolder">$1250.00</span>
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
                              <div class="d-flex align-items-center fs-2 fw-bold flex-wrap">
                                Contractor Selection
                              </div>
                              <div class="fw-semibold opacity-75">
                                Upto 3 verified contractor matches
                              </div>
                            </div>
                            <!--end::Info-->
                          </div>
                          <!--end::Description-->
                          <!--begin::Price-->
                          <div class="ms-5">
                            <span class="fs-2x fw-bolder">$89.00</span>
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
                              <div class="d-flex align-items-center fs-2 fw-bold flex-wrap">
                                Verify Quote
                              </div>
                              <div class="fw-semibold opacity-75">
                                Get verified from our estimators
                              </div>
                            </div>
                            <!--end::Info-->
                          </div>
                          <!--end::Description-->
                          <!--begin::Price-->
                          <div class="ms-5">
                            <span class="fs-2x fw-bolder">$85.00</span>
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
                    <div class="tab-content rounded h-100 bg-light p-10" id="bathtabset">
                      <!--begin::Tab Pane-->
                      <div class="tab-pane fade show active" id="bath1" role="tabpanel" aria-labelledby="bathtab1">
                        <!--begin::Heading-->
                        <div class="pb-5">
                          <h2 class="fw-bold text-dark">What’s included?</h2>
                          <div class="text-muted fw-semibold">
                           Everything you need for your project
                          </div>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div class="pt-1">
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Dedicated support
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Complete design and drawing
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Product selection - Access trade rates from suppliers
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                         <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Contractor selection & Background checks
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                         <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Verfied pricing from an estimator 
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                         <div class="d-flex flex-column mb-7">
                           <a class="btn btn-danger btn-lg fw-bolder asp-attach-product-932" href="#">Buy Planning Upgrade</a>
                         </div>
                        </div>
                        <!--end::Body-->
                      </div>
                      <!--end::Tab Pane-->
                       <!--begin::Tab Pane-->
                      <div class="tab-pane fade" id="bath2" role="tabpanel" aria-labelledby="bathtab2">
                        <!--begin::Heading-->
                        <div class="pb-5">
                          <h2 class="fw-bold text-dark">What’s included?</h2>
                          <div class="text-muted fw-semibold">
                           Everything you need to design your project
                          </div>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div class="pt-1">
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Complete design drawing
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Elevations & 3D view
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Fixture & finish selection
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                         <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Access trade rates from top suppliers
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                         <div class="d-flex flex-column mb-7">
                           <a class="btn btn-danger btn-lg fw-bolder asp-attach-product-790" href="#">Buy Design Upgrade</a>
                         </div>
                        </div>
                        <!--end::Body-->
                      </div>
                      <!--end::Tab Pane-->
                      <!--begin::Tab Pane-->
                      <div class="tab-pane fade" id="bath3" role="tabpanel" aria-labelledby="bathtab3">
                        <!--begin::Heading-->
                        <div class="pb-5">
                          <h2 class="fw-bold text-dark">What’s included?</h2>
                          <div class="text-muted fw-semibold">
                           We'll research and background check local contractors on your behalf
                          </div>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div class="pt-1">
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Upto 3 verified contractors
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Background checking
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             License and insurance check
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--end::Item-->
                         <div class="d-flex flex-column mb-7">
                           <a class="btn btn-danger btn-lg fw-bolder asp-attach-product-933" href="#">Buy Matching Upgrade</a>
                         </div>
                        </div>
                        <!--end::Body-->
                      </div>
                      <!--end::Tab Pane-->
                       <!--begin::Tab Pane-->
                      <div class="tab-pane fade" id="bath4" role="tabpanel" aria-labelledby="bathtab4">
                        <!--begin::Heading-->
                        <div class="pb-5">
                          <h2 class="fw-bold text-dark">What’s included?</h2>
                          <div class="text-muted fw-semibold">
                           We'll manually verify your estimate is correct
                          </div>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div class="pt-1">
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Manual Review of scope by estimator
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Update of correct quantities
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Supply PDF version of quote (can be used for bank loan or insurance)
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--end::Item-->
                         <div class="d-flex flex-column mb-7">
                           <a class="btn btn-danger btn-lg fw-bolder asp-attach-product-337" href="#">Buy Estimate Verification Upgrade</a>
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
              <div class="tab-pane fade" id="kitchen_tab" role="tabpanel" aria-labelledby="#kitchen_link">
                <!--begin::Row-->
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
                              <div class="d-flex align-items-center fs-2 fw-bold flex-wrap">
                                Planning 
                              </div>
                              <div class="fw-semibold opacity-75">
                                Complete package, everything included
                              </div>
                            </div>
                            <!--end::Info-->
                          </div>
                          <!--end::Description-->
                          <!--begin::Price-->
                          <div class="ms-5">
                            <span class="fs-2x fw-bolder">$2499.00</span>
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
                              <div class="d-flex align-items-center fs-2 fw-bold flex-wrap">
                                Design & Selections
                              </div>
                              <div class="fw-semibold opacity-75">
                                All inclusive design service
                              </div>
                            </div>
                            <!--end::Info-->
                          </div>
                          <!--end::Description-->
                          <!--begin::Price-->
                          <div class="ms-5">
                            <span class="fs-2x fw-bolder">$1750.00</span>
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
                              <div class="d-flex align-items-center fs-2 fw-bold flex-wrap">
                                Contractor Selection
                              </div>
                              <div class="fw-semibold opacity-75">
                                Upto 3 verified contractor matches
                              </div>
                            </div>
                            <!--end::Info-->
                          </div>
                          <!--end::Description-->
                          <!--begin::Price-->
                          <div class="ms-5">
                            <span class="fs-2x fw-bolder">$89.00</span>
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
                              <div class="d-flex align-items-center fs-2 fw-bold flex-wrap">
                                Verify Quote
                              </div>
                              <div class="fw-semibold opacity-75">
                                Get verified from our estimators
                              </div>
                            </div>
                            <!--end::Info-->
                          </div>
                          <!--end::Description-->
                          <!--begin::Price-->
                          <div class="ms-5">
                            <span class="fs-2x fw-bolder">$95.00</span>
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
                    <div class="tab-content rounded h-100 bg-light p-10" id="bathtabset">
                      <!--begin::Tab Pane-->
                      <div class="tab-pane fade show active" id="kitchen1" role="tabpanel" aria-labelledby="kitchentab1">
                        <!--begin::Heading-->
                        <div class="pb-5">
                          <h2 class="fw-bold text-dark">What’s included?</h2>
                          <div class="text-muted fw-semibold">
                           Everything you need for your project
                          </div>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div class="pt-1">
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Dedicated support
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Complete design and drawing
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Product selection - Access trade rates from suppliers
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                         <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Contractor selection & Background checks
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                         <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Verfied pricing from an estimator 
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                         <div class="d-flex flex-column mb-7">
                           <a class="btn btn-danger btn-lg fw-bolder asp-attach-product-937" href="#">Buy Planning Upgrade</a>
                         </div>
                        </div>
                        <!--end::Body-->
                      </div>
                      <!--end::Tab Pane-->
                       <!--begin::Tab Pane-->
                      <div class="tab-pane fade" id="kitchen2" role="tabpanel" aria-labelledby="kitchentab2">
                        <!--begin::Heading-->
                        <div class="pb-5">
                          <h2 class="fw-bold text-dark">What’s included?</h2>
                          <div class="text-muted fw-semibold">
                           Everything you need to design your project
                          </div>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div class="pt-1">
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Complete design drawing
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Elevations & 3D view
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Fixture & finish selection
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                         <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Access trade rates from top suppliers
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                         <div class="d-flex flex-column mb-7">
                           <a class="btn btn-danger btn-lg fw-bolder asp-attach-product-792" href="#">Buy Design Upgrade</a>
                         </div>
                        </div>
                        <!--end::Body-->
                      </div>
                      <!--end::Tab Pane-->
                      <!--begin::Tab Pane-->
                      <div class="tab-pane fade" id="kitchen3" role="tabpanel" aria-labelledby="kitchentab3">
                        <!--begin::Heading-->
                        <div class="pb-5">
                          <h2 class="fw-bold text-dark">What’s included?</h2>
                          <div class="text-muted fw-semibold">
                           We'll research and background check local contractors on your behalf
                          </div>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div class="pt-1">
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Upto 3 verified contractors
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Background checking
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             License and insurance check
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--end::Item-->
                         <div class="d-flex flex-column mb-7">
                           <a class="btn btn-danger btn-lg fw-bolder asp-attach-product-933" href="#">Buy Matching Upgrade</a>
                         </div>
                        </div>
                        <!--end::Body-->
                      </div>
                      <!--end::Tab Pane-->
                       <!--begin::Tab Pane-->
                      <div class="tab-pane fade" id="kitchen4" role="tabpanel" aria-labelledby="kitchentab4">
                        <!--begin::Heading-->
                        <div class="pb-5">
                          <h2 class="fw-bold text-dark">What’s included?</h2>
                          <div class="text-muted fw-semibold">
                           We'll manually verify your estimate is correct
                          </div>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div class="pt-1">
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Manual Review of scope by estimator
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Update of correct quantities
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Supply PDF version of quote (can be used for bank loan or insurance)
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--end::Item-->
                         <div class="d-flex flex-column mb-7">
                           <a class="btn btn-danger btn-lg fw-bolder asp-attach-product-785" href="#">Buy Estimate Verification Upgrade</a>
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
                              <div class="d-flex align-items-center fs-2 fw-bold flex-wrap">
                                Planning 
                              </div>
                              <div class="fw-semibold opacity-75">
                                Complete package, everything included
                              </div>
                            </div>
                            <!--end::Info-->
                          </div>
                          <!--end::Description-->
                          <!--begin::Price-->
                          <div class="ms-5">
                            <span class="fs-2x fw-bolder">$2990.00</span>
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
                              <div class="d-flex align-items-center fs-2 fw-bold flex-wrap">
                                Design & Selections
                              </div>
                              <div class="fw-semibold opacity-75">
                                All inclusive design service
                              </div>
                            </div>
                            <!--end::Info-->
                          </div>
                          <!--end::Description-->
                          <!--begin::Price-->
                          <div class="ms-5">
                            <span class="fs-2x fw-bolder">$2340.00</span>
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
                              <div class="d-flex align-items-center fs-2 fw-bold flex-wrap">
                                Contractor Selection
                              </div>
                              <div class="fw-semibold opacity-75">
                                Upto 3 verified contractor matches
                              </div>
                            </div>
                            <!--end::Info-->
                          </div>
                          <!--end::Description-->
                          <!--begin::Price-->
                          <div class="ms-5">
                            <span class="fs-2x fw-bolder">$89.00</span>
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
                              <div class="d-flex align-items-center fs-2 fw-bold flex-wrap">
                                Verify Quote
                              </div>
                              <div class="fw-semibold opacity-75">
                                Get verified from our estimators
                              </div>
                            </div>
                            <!--end::Info-->
                          </div>
                          <!--end::Description-->
                          <!--begin::Price-->
                          <div class="ms-5">
                            <span class="fs-2x fw-bolder">$149.00</span>
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
                    <div class="tab-content rounded h-100 bg-light p-10" id="bathtabset">
                      <!--begin::Tab Pane-->
                      <div class="tab-pane fade show active" id="full1" role="tabpanel" aria-labelledby="fulltab1">
                        <!--begin::Heading-->
                        <div class="pb-5">
                          <h2 class="fw-bold text-dark">What’s included?</h2>
                          <div class="text-muted fw-semibold">
                           Everything you need for your project
                          </div>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div class="pt-1">
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Dedicated support
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Complete design and drawing
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Product selection - Access trade rates from suppliers
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                         <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Contractor selection & Background checks
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                         <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Verfied pricing from an estimator 
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                         <div class="d-flex flex-column mb-7">
                           <a class="btn btn-danger btn-lg fw-bolder asp-attach-product-938" href="#">Buy Planning Upgrade</a>
                         </div>
                        </div>
                        <!--end::Body-->
                      </div>
                      <!--end::Tab Pane-->
                       <!--begin::Tab Pane-->
                      <div class="tab-pane fade" id="full2" role="tabpanel" aria-labelledby="fulltab2">
                        <!--begin::Heading-->
                        <div class="pb-5">
                          <h2 class="fw-bold text-dark">What’s included?</h2>
                          <div class="text-muted fw-semibold">
                           Everything you need to design your project
                          </div>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div class="pt-1">
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Complete design drawing
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Elevations & 3D view
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Fixture & finish selection
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                         <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Access trade rates from top suppliers
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                         <div class="d-flex flex-column mb-7">
                           <a class="btn btn-danger btn-lg fw-bolder asp-attach-product-793" href="#">Buy Design Upgrade</a>
                         </div>
                        </div>
                        <!--end::Body-->
                      </div>
                      <!--end::Tab Pane-->
                      <!--begin::Tab Pane-->
                      <div class="tab-pane fade" id="full3" role="tabpanel" aria-labelledby="fulltab3">
                        <!--begin::Heading-->
                        <div class="pb-5">
                          <h2 class="fw-bold text-dark">What’s included?</h2>
                          <div class="text-muted fw-semibold">
                           We'll research and background check local contractors on your behalf
                          </div>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div class="pt-1">
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Upto 3 verified contractors
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Background checking
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             License and insurance check
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--end::Item-->
                         <div class="d-flex flex-column mb-7">
                           <a class="btn btn-danger btn-lg fw-bolder asp-attach-product-933" href="#">Buy Matching Upgrade</a>
                         </div>
                        </div>
                        <!--end::Body-->
                      </div>
                      <!--end::Tab Pane-->
                       <!--begin::Tab Pane-->
                      <div class="tab-pane fade" id="full4" role="tabpanel" aria-labelledby="fulltab4">
                        <!--begin::Heading-->
                        <div class="pb-5">
                          <h2 class="fw-bold text-dark">What’s included?</h2>
                          <div class="text-muted fw-semibold">
                           We'll manually verify your estimate is correct
                          </div>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div class="pt-1">
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Manual Review of scope by estimator
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Update of correct quantities
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Supply PDF version of quote (can be used for bank loan or insurance)
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--end::Item-->
                         <div class="d-flex flex-column mb-7">
                           <a class="btn btn-danger btn-lg fw-bolder asp-attach-product-942" href="#">Buy Estimate Verification Upgrade</a>
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
              <div class="tab-pane fade" id="extend_tab" role="tabpanel" aria-labelledby="#extend_link">
                <!--begin::Row-->
                <div class="row">
                  <!--begin::Col-->
                  <div class="col-lg-6 mb-10 mb-lg-0">
                    <ul class="nav flex-column nav-pills nav-fill" id="tabset">
                      <li class="nav-item" role="presentation">
                        <a class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6 active" id="extendtab1" data-bs-toggle="pill" data-bs-target="#extend1" type="button" role="tab" aria-controls="full1" aria-selected="true">
                          <!--end::Description-->
                          <div class="d-flex align-items-center me-2">
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                              <div class="d-flex align-items-center fs-2 fw-bold flex-wrap">
                                Planning 
                              </div>
                              <div class="fw-semibold opacity-75">
                                Complete package, everything included
                              </div>
                            </div>
                            <!--end::Info-->
                          </div>
                          <!--end::Description-->
                          <!--begin::Price-->
                          <div class="ms-5">
                            <span class="fs-2x fw-bolder">$8900.00</span>
                          </div>
                          <!--end::Price-->
                        </a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" id="extendtab2" data-bs-toggle="pill" data-bs-target="#extend2" type="button" role="tab" aria-controls="extend2" aria-selected="false">
                          <!--end::Description-->
                          <div class="d-flex align-items-center me-2">
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                              <div class="d-flex align-items-center fs-2 fw-bold flex-wrap">
                                Design & Selections
                              </div>
                              <div class="fw-semibold opacity-75">
                                All inclusive design service
                              </div>
                            </div>
                            <!--end::Info-->
                          </div>
                          <!--end::Description-->
                          <!--begin::Price-->
                          <div class="ms-5">
                            <span class="fs-2x fw-bolder">$4900.00</span>
                          </div>
                          <!--end::Price-->
                        </a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" id="extendtab3" data-bs-toggle="pill" data-bs-target="#extend3" type="button" role="tab" aria-controls="extend3" aria-selected="false">
                          <!--end::Description-->
                          <div class="d-flex align-items-center me-2">
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                              <div class="d-flex align-items-center fs-2 fw-bold flex-wrap">
                                Contractor Selection
                              </div>
                              <div class="fw-semibold opacity-75">
                                Upto 3 verified contractor matches
                              </div>
                            </div>
                            <!--end::Info-->
                          </div>
                          <!--end::Description-->
                          <!--begin::Price-->
                          <div class="ms-5">
                            <span class="fs-2x fw-bolder">$89.00</span>
                          </div>
                          <!--end::Price-->
                        </a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" id="extendtab4" data-bs-toggle="tab" data-bs-target="#extend4" type="button" role="tab" aria-controls="extend4" aria-selected="false">
                          <!--end::Description-->
                          <div class="d-flex align-items-center me-2">
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                              <div class="d-flex align-items-center fs-2 fw-bold flex-wrap">
                                Verify Quote
                              </div>
                              <div class="fw-semibold opacity-75">
                                Get verified from our estimators
                              </div>
                            </div>
                            <!--end::Info-->
                          </div>
                          <!--end::Description-->
                          <!--begin::Price-->
                          <div class="ms-5">
                            <span class="fs-2x fw-bolder">$249.00</span>
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
                    <div class="tab-content rounded h-100 bg-light p-10" id="bathtabset">
                      <!--begin::Tab Pane-->
                      <div class="tab-pane fade show active" id="extend1" role="tabpanel" aria-labelledby="extendtab1">
                        <!--begin::Heading-->
                        <div class="pb-5">
                          <h2 class="fw-bold text-dark">What’s included?</h2>
                          <div class="text-muted fw-semibold">
                           Everything you need for your project
                          </div>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div class="pt-1">
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Dedicated support
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Complete design and drafting service
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Product selection - Access trade rates from suppliers
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                         <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Contractor selection & Background checks
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                         <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Verfied pricing from an estimator 
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             DA or CDC preparation
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Coordinate external consultants
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                         <div class="d-flex flex-column mb-7">
                           <a class="btn btn-danger btn-lg fw-bolder asp-attach-product-943" href="#">Buy Planning Upgrade</a>
                         </div>
                        </div>
                        <!--end::Body-->
                      </div>
                      <!--end::Tab Pane-->
                       <!--begin::Tab Pane-->
                      <div class="tab-pane fade" id="extend2" role="tabpanel" aria-labelledby="extendtab2">
                        <!--begin::Heading-->
                        <div class="pb-5">
                          <h2 class="fw-bold text-dark">What’s included?</h2>
                          <div class="text-muted fw-semibold">
                           Everything you need to design your project
                          </div>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div class="pt-1">
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Complete design drafting
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Elevations & 3D view/DA or CDC prep
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Fixture & finish selection
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                         <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Access trade rates from top suppliers
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                         <div class="d-flex flex-column mb-7">
                           <a class="btn btn-danger btn-lg fw-bolder asp-attach-product-944" href="#">Buy Design Upgrade</a>
                         </div>
                        </div>
                        <!--end::Body-->
                      </div>
                      <!--end::Tab Pane-->
                      <!--begin::Tab Pane-->
                      <div class="tab-pane fade" id="extend3" role="tabpanel" aria-labelledby="extendtab3">
                        <!--begin::Heading-->
                        <div class="pb-5">
                          <h2 class="fw-bold text-dark">What’s included?</h2>
                          <div class="text-muted fw-semibold">
                           We'll research and background check local contractors on your behalf
                          </div>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div class="pt-1">
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Upto 3 verified contractors
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Background checking
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             License and insurance check
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--end::Item-->
                         <div class="d-flex flex-column mb-7">
                           <a class="btn btn-danger btn-lg fw-bolder asp-attach-product-933" href="#">Buy Matching Upgrade</a>
                         </div>
                        </div>
                        <!--end::Body-->
                      </div>
                      <!--end::Tab Pane-->
                       <!--begin::Tab Pane-->
                      <div class="tab-pane fade" id="extend4" role="tabpanel" aria-labelledby="extendtab4">
                        <!--begin::Heading-->
                        <div class="pb-5">
                          <h2 class="fw-bold text-dark">What’s included?</h2>
                          <div class="text-muted fw-semibold">
                           We'll manually verify your estimate is correct
                          </div>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div class="pt-1">
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Manual Review of scope by estimator
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Update of correct quantities
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Supply PDF version of quote (can be used for bank loan or insurance)
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--end::Item-->
                         <div class="d-flex flex-column mb-7">
                           <a class="btn btn-danger btn-lg fw-bolder asp-attach-product-945" href="#">Buy Estimate Verification Upgrade</a>
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
              <div class="tab-pane fade" id="laundry_tab" role="tabpanel" aria-labelledby="#laundry_link">
                <!--begin::Row-->
                <div class="row">
                  <!--begin::Col-->
                  <div class="col-lg-6 mb-10 mb-lg-0">
                    <ul class="nav flex-column nav-pills nav-fill" id="tabset">
                      <li class="nav-item" role="presentation">
                        <a class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6 active" id="laundrytab1" data-bs-toggle="pill" data-bs-target="#laundry1" type="button" role="tab" aria-controls="laundry1" aria-selected="true">
                          <!--end::Description-->
                          <div class="d-flex align-items-center me-2">
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                              <div class="d-flex align-items-center fs-2 fw-bold flex-wrap">
                                Planning 
                              </div>
                              <div class="fw-semibold opacity-75">
                                Complete package, everything included
                              </div>
                            </div>
                            <!--end::Info-->
                          </div>
                          <!--end::Description-->
                          <!--begin::Price-->
                          <div class="ms-5">
                            <span class="fs-2x fw-bolder">$1750.00</span>
                          </div>
                          <!--end::Price-->
                        </a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" id="laundrytab2" data-bs-toggle="pill" data-bs-target="#laundry2" type="button" role="tab" aria-controls="laundry2" aria-selected="false">
                          <!--end::Description-->
                          <div class="d-flex align-items-center me-2">
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                              <div class="d-flex align-items-center fs-2 fw-bold flex-wrap">
                                Design & Selections
                              </div>
                              <div class="fw-semibold opacity-75">
                                All inclusive design service
                              </div>
                            </div>
                            <!--end::Info-->
                          </div>
                          <!--end::Description-->
                          <!--begin::Price-->
                          <div class="ms-5">
                            <span class="fs-2x fw-bolder">$1150.00</span>
                          </div>
                          <!--end::Price-->
                        </a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" id="laundrytab3" data-bs-toggle="pill" data-bs-target="#laundry3" type="button" role="tab" aria-controls="laundry3" aria-selected="false">
                          <!--end::Description-->
                          <div class="d-flex align-items-center me-2">
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                              <div class="d-flex align-items-center fs-2 fw-bold flex-wrap">
                                Contractor Selection
                              </div>
                              <div class="fw-semibold opacity-75">
                                Upto 3 verified contractor matches
                              </div>
                            </div>
                            <!--end::Info-->
                          </div>
                          <!--end::Description-->
                          <!--begin::Price-->
                          <div class="ms-5">
                            <span class="fs-2x fw-bolder">$89.00</span>
                          </div>
                          <!--end::Price-->
                        </a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" id="laundrytab4" data-bs-toggle="tab" data-bs-target="#laundry4" type="button" role="tab" aria-controls="laundry4" aria-selected="false">
                          <!--end::Description-->
                          <div class="d-flex align-items-center me-2">
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                              <div class="d-flex align-items-center fs-2 fw-bold flex-wrap">
                                Verify Quote
                              </div>
                              <div class="fw-semibold opacity-75">
                                Get verified from our estimators
                              </div>
                            </div>
                            <!--end::Info-->
                          </div>
                          <!--end::Description-->
                          <!--begin::Price-->
                          <div class="ms-5">
                            <span class="fs-2x fw-bolder">$69.00</span>
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
                    <div class="tab-content rounded h-100 bg-light p-10" id="bathtabset">
                      <!--begin::Tab Pane-->
                      <div class="tab-pane fade show active" id="laundry1" role="tabpanel" aria-labelledby="laundrytab1">
                        <!--begin::Heading-->
                        <div class="pb-5">
                          <h2 class="fw-bold text-dark">What’s included?</h2>
                          <div class="text-muted fw-semibold">
                           Everything you need for your project
                          </div>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div class="pt-1">
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Dedicated support
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Complete design and drawing
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Product selection - Access trade rates from suppliers
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                         <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Contractor selection & Background checks
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                         <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Verfied pricing from an estimator 
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                         <div class="d-flex flex-column mb-7">
                           <a class="btn btn-danger btn-lg fw-bolder asp-attach-product-948" href="#">Buy Planning Upgrade</a>
                         </div>
                        </div>
                        <!--end::Body-->
                      </div>
                      <!--end::Tab Pane-->
                       <!--begin::Tab Pane-->
                      <div class="tab-pane fade" id="laundry2" role="tabpanel" aria-labelledby="laundrytab2">
                        <!--begin::Heading-->
                        <div class="pb-5">
                          <h2 class="fw-bold text-dark">What’s included?</h2>
                          <div class="text-muted fw-semibold">
                           Everything you need to design your project
                          </div>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div class="pt-1">
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Complete design drawing
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Elevations & 3D view
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Fixture & finish selection
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                         <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Access trade rates from top suppliers
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                         <div class="d-flex flex-column mb-7">
                           <a class="btn btn-danger btn-lg fw-bolder asp-attach-product-947" href="#">Buy Design Upgrade</a>
                         </div>
                        </div>
                        <!--end::Body-->
                      </div>
                      <!--end::Tab Pane-->
                      <!--begin::Tab Pane-->
                      <div class="tab-pane fade" id="laundry3" role="tabpanel" aria-labelledby="laundrytab3">
                        <!--begin::Heading-->
                        <div class="pb-5">
                          <h2 class="fw-bold text-dark">What’s included?</h2>
                          <div class="text-muted fw-semibold">
                           We'll research and background check local contractors on your behalf
                          </div>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div class="pt-1">
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Upto 3 verified contractors
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Background checking
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             License and insurance check
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--end::Item-->
                         <div class="d-flex flex-column mb-7">
                           <a class="btn btn-danger btn-lg fw-bolder asp-attach-product-933" href="#">Buy Matching Upgrade</a>
                         </div>
                        </div>
                        <!--end::Body-->
                      </div>
                      <!--end::Tab Pane-->
                       <!--begin::Tab Pane-->
                      <div class="tab-pane fade" id="laundry4" role="tabpanel" aria-labelledby="laundrytab4">
                        <!--begin::Heading-->
                        <div class="pb-5">
                          <h2 class="fw-bold text-dark">What’s included?</h2>
                          <div class="text-muted fw-semibold">
                           We'll manually verify your estimate is correct
                          </div>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div class="pt-1">
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Manual Review of scope by estimator
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Update of correct quantities
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Supply PDF version of quote (can be used for bank loan or insurance)
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--end::Item-->
                         <div class="d-flex flex-column mb-7">
                           <a class="btn btn-danger btn-lg fw-bolder asp-attach-product-946" href="#">Buy Estimate Verification Upgrade</a>
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
              <div class="tab-pane fade" id="general_tab" role="tabpanel" aria-labelledby="#general_link">
                <!--begin::Row-->
                <div class="row">
                  <!--begin::Col-->
                  <div class="col-lg-6 mb-10 mb-lg-0">
                    <ul class="nav flex-column nav-pills nav-fill" id="tabset">
                      <li class="nav-item" role="presentation">
                        <a class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6 active" id="generaltab1" data-bs-toggle="pill" data-bs-target="#general1" type="button" role="tab" aria-controls="general1" aria-selected="true">
                          <!--end::Description-->
                          <div class="d-flex align-items-center me-2">
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                              <div class="d-flex align-items-center fs-2 fw-bold flex-wrap">
                                Planning 
                              </div>
                              <div class="fw-semibold opacity-75">
                                Complete package, everything included
                              </div>
                            </div>
                            <!--end::Info-->
                          </div>
                          <!--end::Description-->
                          <!--begin::Price-->
                          <div class="ms-5">
                            <span class="fs-2x fw-bolder">$690.00</span>
                          </div>
                          <!--end::Price-->
                        </a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" id="generaltab2" data-bs-toggle="pill" data-bs-target="#general2" type="button" role="tab" aria-controls="general2" aria-selected="false">
                          <!--end::Description-->
                          <div class="d-flex align-items-center me-2">
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                              <div class="d-flex align-items-center fs-2 fw-bold flex-wrap">
                                Design & Selections
                              </div>
                              <div class="fw-semibold opacity-75">
                                All inclusive design service
                              </div>
                            </div>
                            <!--end::Info-->
                          </div>
                          <!--end::Description-->
                          <!--begin::Price-->
                          <div class="ms-5">
                            <span class="fs-2x fw-bolder">$350.00</span>
                          </div>
                          <!--end::Price-->
                        </a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" id="generaltab3" data-bs-toggle="pill" data-bs-target="#general3" type="button" role="tab" aria-controls="general3" aria-selected="false">
                          <!--end::Description-->
                          <div class="d-flex align-items-center me-2">
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                              <div class="d-flex align-items-center fs-2 fw-bold flex-wrap">
                                Contractor Selection
                              </div>
                              <div class="fw-semibold opacity-75">
                                Upto 3 verified contractor matches
                              </div>
                            </div>
                            <!--end::Info-->
                          </div>
                          <!--end::Description-->
                          <!--begin::Price-->
                          <div class="ms-5">
                            <span class="fs-2x fw-bolder">$89.00</span>
                          </div>
                          <!--end::Price-->
                        </a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" id="generaltab4" data-bs-toggle="tab" data-bs-target="#general4" type="button" role="tab" aria-controls="general4" aria-selected="false">
                          <!--end::Description-->
                          <div class="d-flex align-items-center me-2">
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                              <div class="d-flex align-items-center fs-2 fw-bold flex-wrap">
                                Verify Quote
                              </div>
                              <div class="fw-semibold opacity-75">
                                Get verified from our estimators
                              </div>
                            </div>
                            <!--end::Info-->
                          </div>
                          <!--end::Description-->
                          <!--begin::Price-->
                          <div class="ms-5">
                            <span class="fs-2x fw-bolder">$65.00</span>
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
                    <div class="tab-content rounded h-100 bg-light p-10" id="bathtabset">
                      <!--begin::Tab Pane-->
                      <div class="tab-pane fade show active" id="general1" role="tabpanel" aria-labelledby="generaltab1">
                        <!--begin::Heading-->
                        <div class="pb-5">
                          <h2 class="fw-bold text-dark">What’s included?</h2>
                          <div class="text-muted fw-semibold">
                           Everything you need for your project
                          </div>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div class="pt-1">
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Dedicated support
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Complete design support
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Product selection - Access trade rates from suppliers
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                         <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Contractor selection & Background checks
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                         <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Verfied pricing from an estimator 
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                         <div class="d-flex flex-column mb-7">
                           <a class="btn btn-danger btn-lg fw-bolder asp-attach-product-951" href="#">Buy Planning Upgrade</a>
                         </div>
                        </div>
                        <!--end::Body-->
                      </div>
                      <!--end::Tab Pane-->
                       <!--begin::Tab Pane-->
                      <div class="tab-pane fade" id="general2" role="tabpanel" aria-labelledby="generaltab2">
                        <!--begin::Heading-->
                        <div class="pb-5">
                          <h2 class="fw-bold text-dark">What’s included?</h2>
                          <div class="text-muted fw-semibold">
                           Everything you need to design your project
                          </div>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div class="pt-1">
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Complete design support
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Fixture & finish selection
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                         <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Access trade rates from top suppliers
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                         <div class="d-flex flex-column mb-7">
                           <a class="btn btn-danger btn-lg fw-bolder asp-attach-product-953" href="#">Buy Design Upgrade</a>
                         </div>
                        </div>
                        <!--end::Body-->
                      </div>
                      <!--end::Tab Pane-->
                      <!--begin::Tab Pane-->
                      <div class="tab-pane fade" id="general3" role="tabpanel" aria-labelledby="generaltab3">
                        <!--begin::Heading-->
                        <div class="pb-5">
                          <h2 class="fw-bold text-dark">What’s included?</h2>
                          <div class="text-muted fw-semibold">
                           We'll research and background check local contractors on your behalf
                          </div>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div class="pt-1">
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Upto 3 verified contractors
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Background checking
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             License and insurance check
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--end::Item-->
                         <div class="d-flex flex-column mb-7">
                           <a class="btn btn-danger btn-lg fw-bolder asp-attach-product-933" href="#">Buy Matching Upgrade</a>
                         </div>
                        </div>
                        <!--end::Body-->
                      </div>
                      <!--end::Tab Pane-->
                       <!--begin::Tab Pane-->
                      <div class="tab-pane fade" id="general4" role="tabpanel" aria-labelledby="generaltab4">
                        <!--begin::Heading-->
                        <div class="pb-5">
                          <h2 class="fw-bold text-dark">What’s included?</h2>
                          <div class="text-muted fw-semibold">
                           We'll manually verify your estimate is correct
                          </div>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div class="pt-1">
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Manual Review of scope by estimator
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Update of correct quantities
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <div class="d-flex align-items-center mb-7">
                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                             Supply PDF version of quote (can be used for bank loan or insurance)
                            </span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
</svg>
</span>
                            <!--end::Svg Icon-->
                          </div>
                          <!--end::Item-->
                          <!--end::Item-->
                         <div class="d-flex flex-column mb-7">
                           <a class="btn btn-danger btn-lg fw-bolder asp-attach-product-952" href="#">Buy Estimate Verification Upgrade</a>
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
          <!--begin::Actions-->
          <div class="d-flex flex-center flex-row-fluid pt-12">
            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">
                        Cancel
            </button>
          </div>
          <!--end::Actions-->
        </div>
        <!--end::Modal body-->
      </div>
      <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
  </div>
  <!--end::Modal - Edit Project addons-->

    <!--end::Content-->
<?php
get_footer();