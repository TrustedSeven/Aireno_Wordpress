"use strict";
var KTSignupGeneral = function () {
    var e, t, a, s, r = function () {
        return 100 === s.getScore()
    };
    return {
        init: function () {
            e = document.querySelector("#kt_sign_up_form"),
                t = document.querySelector("#kt_sign_up_submit"),
                s = KTPasswordMeter.getInstance(e.querySelector('[data-kt-password-meter="true"]')),
                a = FormValidation.formValidation(e, {
                    fields: {
                        "display_name": {validators: {notEmpty: {message: "Full Name is required"}}},
                        email: {
                            validators: {
                                notEmpty: {message: "Email address is required"},
                                emailAddress: {message: "The value is not a valid email address"}
                            }
                        },
                        password: {
                            validators: {
                                notEmpty: {message: "The password is required"},
                                callback: {
                                    message: "Please enter valid password", callback: function (e) {
                                        if (e.value.length > 0) return r()
                                    }
                                }
                            }
                        },
                        "confirm-password": {
                            validators: {
                                notEmpty: {message: "The password confirmation is required"},
                                identical: {
                                    compare: function () {
                                        return e.querySelector('[name="password"]').value
                                    }, message: "The password and its confirm are not the same"
                                }
                            }
                        },
                        toc: {validators: {notEmpty: {message: "You must accept the terms and conditions"}}}
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger({event: {password: !1}}),
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: ".fv-row",
                            eleInvalidClass: "",
                            eleValidClass: ""
                        })
                    }
                }),
                t.addEventListener("click", (function (r) {
                    r.preventDefault(), a.revalidateField("password"), a.validate().then((function (a) {
                        "Valid" == a ? (t.setAttribute("data-kt-indicator", "on"), t.disabled = !0, setTimeout((function () {
                            var formData = new FormData($('#kt_sign_up_form')[0]);
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
                                    t.removeAttribute("data-kt-indicator"), t.disabled = !1, Swal.fire({
                                        text: "Something went wrong. Please reload the page or try again!",
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {confirmButton: "btn btn-primary"}
                                    });
                                },
                                success: function (result) {
                                    console.log(result);
                                    if (result.status) {
                                        t.removeAttribute("data-kt-indicator"), t.disabled = !1, Swal.fire({
                                            text: result.msg,
                                            icon: "success",
                                            buttonsStyling: !1,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {confirmButton: "btn btn-primary"}
                                        }).then((function (t) {
                                            t.isConfirmed && (
                                                e.reset(), s.reset(), window.location.href = result.redirect
                                            );
                                        }));
                                    } else {
                                        t.removeAttribute("data-kt-indicator"), t.disabled = !1, Swal.fire({
                                            text: result.msg,
                                            icon: "error",
                                            buttonsStyling: !1,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {confirmButton: "btn btn-primary"}
                                        });
                                    }

                                }
                            });
                        }), 1500)) : Swal.fire({
                            text: "Please fill in all fields correctly.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok",
                            customClass: {confirmButton: "btn btn-primary"}
                        })
                    }))
                })),
                e.addEventListener("submit", (function (r) {
                    r.preventDefault(), a.revalidateField("password"), a.validate().then((function (a) {
                        "Valid" == a ? (t.setAttribute("data-kt-indicator", "on"), t.disabled = !0, setTimeout((function () {
                            var formData = new FormData($('#kt_sign_up_form')[0]);
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
                                    t.removeAttribute("data-kt-indicator"), t.disabled = !1, Swal.fire({
                                        text: "Something went wrong. Please reload the page or try again!",
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {confirmButton: "btn btn-primary"}
                                    });
                                },
                                success: function (result) {
                                    if (result.status) {
                                        t.removeAttribute("data-kt-indicator"), t.disabled = !1, Swal.fire({
                                            text: result.msg,
                                            icon: "success",
                                            buttonsStyling: !1,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {confirmButton: "btn btn-primary"}
                                        }).then((function (t) {
                                            t.isConfirmed && (
                                                e.reset(), s.reset(), window.location.href = result.redirect
                                            );
                                        }));
                                    } else {
                                        t.removeAttribute("data-kt-indicator"), t.disabled = !1, Swal.fire({
                                            text: result.msg,
                                            icon: "error",
                                            buttonsStyling: !1,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {confirmButton: "btn btn-primary"}
                                        });
                                    }

                                }
                            });

                        }), 1500)) : Swal.fire({
                            text: "Please fill in all fields correctly.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok",
                            customClass: {confirmButton: "btn btn-primary"}
                        })
                    }))
                })),
                e.querySelector('input[name="password"]').addEventListener("input", (function () {
                    this.value.length > 0 && a.updateFieldStatus("password", "NotValidated")
                }))
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTSignupGeneral.init()
}));