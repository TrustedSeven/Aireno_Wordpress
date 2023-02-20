"use strict";
var KTAccountSettingsSigninMethods = {
    init: function () {
        var t, e, es;
        !function () {
            var t = document.getElementById("kt_signin_email"),
                e = document.getElementById("kt_signin_email_edit"),
                n = document.getElementById("kt_signin_password"),
                o = document.getElementById("kt_signin_password_edit"),
                i = document.getElementById("kt_signin_email_button"),
                s = document.getElementById("kt_signin_cancel"),
                r = document.getElementById("kt_signin_password_button"),
                a = document.getElementById("kt_password_cancel");
            i.querySelector("button").addEventListener("click", (function () {
                l()
            })),
                s.addEventListener("click", (function () {
                    l()
                })),
                r.querySelector("button").addEventListener("click", (function () {
                    d()
                })),
                a.addEventListener("click", (function () {
                    d()
                }));
            var l = function () {
                    t.classList.toggle("d-none"), i.classList.toggle("d-none"), e.classList.toggle("d-none")
                },
                d = function () {
                    n.classList.toggle("d-none"), r.classList.toggle("d-none"), o.classList.toggle("d-none")
                }
        }(),
            e = document.getElementById("kt_signin_change_email"),
            es = e.querySelector('#kt_signin_submit'),
            t = FormValidation.formValidation(e, {
                fields: {
                    emailaddress: {
                        validators: {
                            notEmpty: {message: "Email is required"},
                            emailAddress: {message: "The value is not a valid email address"}
                        }
                    }, confirmemailpassword: {validators: {notEmpty: {message: "Password is required"}}}
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({rowSelector: ".fv-row"})
                }
            }),
            es.addEventListener("click", (function (n) {
                n.preventDefault(),
                    console.log("change email"),
                    t.validate().then((function (n) {
                        if (n == 'Valid') {
                            es.setAttribute("data-kt-indicator", "on");
                            es.disabled = !0;
                            var formData = new FormData($('#kt_signin_change_email')[0]);
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
                                    es.removeAttribute("data-kt-indicator"), es.disabled = !1, Swal.fire({
                                        text: "Something went wrong. Please reload the page or try again!",
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {confirmButton: "btn btn-primary"}
                                    });
                                },
                                success: function (result) {
                                    if (result.status) {
                                        es.removeAttribute("data-kt-indicator"), es.disabled = !1, window.location.reload();
                                    } else {
                                        es.removeAttribute("data-kt-indicator"), es.disabled = !1, Swal.fire({
                                            text: result.msg,
                                            icon: "error",
                                            buttonsStyling: !1,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {confirmButton: "btn btn-primary"}
                                        });
                                    }

                                }
                            });
                        }
                        else {
                            swal.fire({
                                text: "Sorry, looks like there are some errors detected, please try again.",
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "Ok, got it!",
                                customClass: {confirmButton: "btn font-weight-bold btn-light-primary"}
                            })
                        }
                    }))
            })),
            function (t) {
                var e, n = document.getElementById("kt_signin_change_password"),
                ns = n.querySelector('#kt_password_submit');
                e = FormValidation.formValidation(n, {
                    fields: {
                        currentpassword: {validators: {notEmpty: {message: "Current Password is required"}}},
                        newpassword: {validators: {notEmpty: {message: "New Password is required"}}},
                        confirmpassword: {
                            validators: {
                                notEmpty: {message: "Confirm Password is required"},
                                identical: {
                                    compare: function () {
                                        return n.querySelector('[name="newpassword"]').value
                                    }, message: "The password and its confirm are not the same"
                                }
                            }
                        }
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger,
                        bootstrap: new FormValidation.plugins.Bootstrap5({rowSelector: ".fv-row"})
                    }
                }),
                    ns.addEventListener("click", (function (t) {
                        t.preventDefault(), console.log("change password click"), e.validate().then((function (t) {
                            if (t == 'Valid') {
                                ns.setAttribute("data-kt-indicator", "on");
                                ns.disabled = !0;
                                var formData = new FormData($('#kt_signin_change_password')[0]);
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
                                        ns.removeAttribute("data-kt-indicator"), ns.disabled = !1, Swal.fire({
                                            text: "Something went wrong. Please reload the page or try again!",
                                            icon: "error",
                                            buttonsStyling: !1,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {confirmButton: "btn btn-primary"}
                                        });
                                    },
                                    success: function (result) {
                                        console.log(result);
                                        ns.removeAttribute("data-kt-indicator"), ns.disabled = !1, Swal.fire({
                                            text: result.msg,
                                            icon: result.status ? "success" : "error",
                                            buttonsStyling: !1,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {confirmButton: "btn btn-primary"}
                                        });
                                        n.reset();
                                        $('#kt_password_cancel').trigger('click');
                                    }
                                });
                            }
                            else {
                                swal.fire({
                                    text: "Sorry, looks like there are some errors detected, please try again.",
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {confirmButton: "btn font-weight-bold btn-light-primary"}
                                })
                            }
                        }))
                    }))
            }()
    }
};
KTUtil.onDOMContentLoaded((function () {
    KTAccountSettingsSigninMethods.init()
}));