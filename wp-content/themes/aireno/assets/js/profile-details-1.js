"use strict";
var blockTarget = document.querySelector("body");
var blockUI = new KTBlockUI(blockTarget, {
    message: '<div class="blockui-message"><span class="spinner-border text-primary"></span> Processing...</div>',
    overlayClass: "bg-info bg-opacity-25"
});

var KTAccountSettingsProfileDetails = function () {
    var form, validator, btnSave;
    return {
        init: function () {
            form = document.getElementById("kt_account_profile_details_form"),
                btnSave = form.querySelector("#kt_account_profile_details_submit"),
                validator = FormValidation.formValidation(form, {
                    fields: {
                        display_name: {validators: {notEmpty: {message: "Full name is required"}}},
                        address: {validators: {notEmpty: {message: "Address is required"}}},
                        phone: {validators: {notEmpty: {message: "Phone number is required"}}},
                        _business_logo: {validators: {notEmpty: {message: "Business Logo is required"}}},
                        company_name: {validators: {notEmpty: {message: "Company Name is required"}}},
                        profile_url: {validators: {notEmpty: {message: "Profile Url is required"}}},
                        company_abn: {
                            validators: {
                                notEmpty: {message: "ABN is required"},
                                min: {message: "Wrong ABN"},
                                max: {message: "Wrong ABN"}
                            }
                        },
                        company_services: {validators: {notEmpty: {message: "Selecte services you offer"}}},
                        company_margin: {validators: {notEmpty: {message: "Please put the Margin!"}}},
                        payment_instructions: {
                            validators: {
                                notEmpty: {message: "Please fill your payment instructions here."},
                            }
                        },
                        payment_details: {
                            validators: {
                                notEmpty: {message: "Please fill your payment details here."},
                            }
                        },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger,
                        submitButton: new FormValidation.plugins.SubmitButton,
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: ".fv-row",
                            eleInvalidClass: "",
                            eleValidClass: ""
                        })
                    }
                }),
                $(form.querySelector('[name="display_name"]')).on("change", (function () {
                    validator.revalidateField("display_name");
                })),
                $(form.querySelector('[name="avatar"]')).on("change", (function () {
                    $(form.querySelector('[name="_avatar"]')).val(1);
                    validator.revalidateField("_avatar");
                })),
                $(form.querySelector('[name="address"]')).on("change", (function () {
                    validator.revalidateField("address");
                })),
                $(form.querySelector('[name="phone"]')).on("change", (function () {
                    validator.revalidateField("phone");
                })),
                $(form.querySelector('[name="profile_url"]')).on("change", (function () {
                    validator.revalidateField("profile_url");
                })),
                $(form.querySelector('[name="business_logo"]')).on("change", (function () {
                    $(form.querySelector('[name="_business_logo"]')).val(1);
                    validator.revalidateField("_business_logo");
                })),
                $(form.querySelector('[name="company_name"]')).on("change", (function () {
                    validator.revalidateField("company_name");
                })),
                $(form.querySelector('[name="company_abn"]')).on("change", (function () {
                    validator.revalidateField("company_abn");
                })),
                $(form.querySelector('[name="company_services"]')).on("change", (function () {
                    validator.revalidateField("company_services");
                })),
                $(form.querySelector('[name="company_margin"]')).on("change", (function () {
                    validator.revalidateField("company_margin");
                })),
                $(form.querySelector('[name="payment_instructions"]')).on("change", (function () {
                    validator.revalidateField("payment_instructions");
                })),
                $(form.querySelector('[name="payment_details"]')).on("change", (function () {
                    validator.revalidateField("payment_details");
                })),
                btnSave.addEventListener('click', function (n) {
                    n.preventDefault();
                    validator.validate().then((function (i) {
                        if ("Valid" === i) {
                            btnSave.setAttribute("data-kt-indicator", "on");
                            btnSave.disabled = !0;
                            var formData = new FormData($('#kt_account_profile_details_form')[0]);
                            blockUI.block();
                            $.ajax({
                                method: 'POST',
                                dataType: 'json',
                                url: aireno.ajax_url,
                                type: 'POST',
                                data: formData,
                                cache: false,
                                contentType: false,
                                processData: false,
                                error: function error(response) {
                                    blockUI.release();
                                    btnSave.removeAttribute("data-kt-indicator");
                                    btnSave.disabled = !1;
                                    Swal.fire({
                                        text: "Something went wrong. Please reload the page or try again!",
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "OK",
                                        customClass: {confirmButton: "btn btn-primary"}
                                    });
                                },
                                success: function (result) {
                                    console.log(result);
                                    blockUI.release();
                                    $('#aireno_user_name').html(formData.get('display_name'));
                                    if (result.avatar.status) {
                                        $(form.querySelector('[name="_avatar"]')).val(result.avatar.attachment_id);
                                        $('img.aireno_user_avatar').attr('src', result.avatar.url);
                                    }
                                    if (result.business_logo) {
                                        $(form.querySelector('[name="_business_logo"]')).val(result.avatar.attachment_id);
                                        $('#aireno_business_logo').attr('src', result.avatar.url);
                                    }
                                    btnSave.removeAttribute("data-kt-indicator"), btnSave.disabled = !1, Swal.fire({
                                        text: "Successfully Saved!",
                                        icon: "success",
                                        buttonsStyling: !1,
                                        confirmButtonText: "OK",
                                        customClass: {confirmButton: "btn btn-primary"}
                                    });

                                }
                            });
                        } else {
                            Swal.fire({
                                text: "Sorry, looks like there are some errors detected, please try again.",
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "OK",
                                customClass: {confirmButton: "btn btn-primary"}
                            });
                        }
                    }));
                });
            var zipcode = document.querySelector('[name=address]');
            var options = {
                types: ['address']
            };
            if (zipcode) {
                var zipcodeautocomplete = new google.maps.places.Autocomplete(zipcode, options);
                zipcodeautocomplete.setComponentRestrictions({
                    country: ["au"],
                });
            }
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTAccountSettingsProfileDetails.init();
}));

jQuery(document).ready(function ($) {
    $('body').on('click', '#portfoliosFTrigger', function (ev) {
        ev.preventDefault();
        $('#portfoliosF').trigger('click');
    });

    $('body').on('change', '#portfoliosF', function (ev) {
        $('#portfoliosUF').trigger('submit');
    });
    $('body').on('submit', '#portfoliosUF', function (ev) {
        ev.preventDefault();
        var formData = new FormData($(this)[0]);
        blockUI.block();
        $.ajax({
            method: 'POST',
            dataType: 'json',
            url: aireno.ajax_url,
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            error: function error(response) {
                blockUI.release();
                Swal.fire({
                    text: "Something went wrong. Please reload the page or try again!",
                    icon: "error",
                    buttonsStyling: !1,
                    confirmButtonText: "OK",
                    customClass: {confirmButton: "btn btn-danger"}
                });
            },
            success: function (result) {
                console.log(result);
                blockUI.release();
                if (result.status) {
                    window.location.reload();
                } else {
                    Swal.fire({
                        text: result.message,
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "OK",
                        customClass: {confirmButton: "btn btn-danger"}
                    });
                }
            }
        });
        return false;
    });
    $('body').on('click', '.remove_portfolio', function (ev) {
        var target = $(this);
        var portfolio_id = $(this).attr('data-id');

        Swal.fire({
            text: "Are you sure delete this portfolio?",
            icon: "info",
            buttonsStyling: !1,
            confirmButtonText: "Yes",
            customClass: {confirmButton: "btn btn-danger"}
        }).then((function (t) {
            if (t.isConfirmed) {
                var formData = new FormData();
                formData.set('action', 'aireno_remove_portfolio');
                formData.set('portfolio', portfolio_id);
                blockUI.block();
                $.ajax({
                    method: 'POST',
                    dataType: 'json',
                    url: aireno.ajax_url,
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    error: function error(response) {
                        blockUI.release();
                        Swal.fire({
                            text: "Something went wrong. Please reload the page or try again!",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "OK",
                            customClass: {confirmButton: "btn btn-danger"}
                        });
                    },
                    success: function (result) {
                        blockUI.release();
                        if (result.status) {
                            target.closest('.portfolio-item').remove();
                        } else {
                            Swal.fire({
                                text: result.message,
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "OK",
                                customClass: {confirmButton: "btn btn-danger"}
                            });
                        }
                    }
                });
            }
        }));
        return false;
    });
});