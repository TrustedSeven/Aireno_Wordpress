"use strict";
var KTSigninGeneral = function () {
    var t, e, i;
    return {
        init: function () {
            t = document.querySelector("#kt_sign_in_form"),
                e = document.querySelector("#kt_sign_in_submit"),
                i = FormValidation.formValidation(t, {
                    fields: {
                        email: {
                            validators: {
                                notEmpty: {message: "Email address is required"},
                                emailAddress: {message: "The value is not a valid email address"}
                            }
                        }, password: {validators: {notEmpty: {message: "The password is required"}}}
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger,
                        bootstrap: new FormValidation.plugins.Bootstrap5({rowSelector: ".fv-row"})
                    }
                }),
                e.addEventListener("click", (function (n) {
                    n.preventDefault(), i.validate().then((function (i) {
                        "Valid" == i ? (e.setAttribute("data-kt-indicator", "on"), e.disabled = !0, setTimeout((function () {
                            var formData = new FormData($('#kt_sign_in_form')[0]);
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
                                    e.removeAttribute("data-kt-indicator"), e.disabled = !1, Swal.fire({
                                        text: "Something went wrong. Please reload the page or try again!",
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {confirmButton: "btn btn-danger"}
                                    });
                                },
                                success: function (result) {
                                    if (result.status) {
                                        e.removeAttribute("data-kt-indicator"), e.disabled = !1, window.location.href = result.redirect;
                                    } else {
                                        e.removeAttribute("data-kt-indicator"), e.disabled = !1, Swal.fire({
                                            text: result.msg,
                                            icon: "error",
                                            buttonsStyling: !1,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {confirmButton: "btn btn-danger"}
                                        });
                                    }

                                }
                            });
                        }), 2e3)) : Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {confirmButton: "btn btn-primary"}
                        })
                    }))
                })),
                t.addEventListener("submit", (function (n) {
                    n.preventDefault(), i.validate().then((function (i) {
                        "Valid" == i ? (e.setAttribute("data-kt-indicator", "on"), e.disabled = !0, setTimeout((function () {
                            var formData = new FormData($('#kt_sign_in_form')[0]);
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
                                    console.log(response);
                                    e.removeAttribute("data-kt-indicator"), e.disabled = !1, Swal.fire({
                                        text: "Something went wrong. Please reload the page or try again!",
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {confirmButton: "btn btn-primary"}
                                    });
                                },
                                success: function (result) {
                                    if (result.status) {
                                        e.removeAttribute("data-kt-indicator"), e.disabled = !1, window.location.href = result.redirect;
                                    } else {
                                        e.removeAttribute("data-kt-indicator"), e.disabled = !1, Swal.fire({
                                            text: result.msg,
                                            icon: "error",
                                            buttonsStyling: !1,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {confirmButton: "btn btn-primary"}
                                        });
                                    }

                                }
                            });
                        }), 2e3)) : Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {confirmButton: "btn btn-primary"}
                        })
                    }))
                }))
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTSigninGeneral.init()
}));