"use strict";
var KTPasswordResetGeneral = function () {
    var t, e, i;
    return {
        init: function () {
            t = document.querySelector("#kt_password_reset_form"),
                e = document.querySelector("#kt_password_reset_submit"),
                i = FormValidation.formValidation(t, {
                fields: {
                    email: {
                        validators: {
                            notEmpty: {message: "Email address is required"},
                            emailAddress: {message: "The value is not a valid email address"}
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            }),e.addEventListener("click", (function (o) {
                o.preventDefault(), i.validate().then((function (i) {
                    "Valid" == i ? (e.setAttribute("data-kt-indicator", "on"), e.disabled = !0, setTimeout((function () {
                        var formData = new FormData($('#kt_password_reset_form')[0]);
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
                                    customClass: {confirmButton: "btn btn-primary"}
                                });
                            },
                            success: function (result) {
                                console.log(result);
                                if (result.status) {
                                    e.removeAttribute("data-kt-indicator"), e.disabled = !1, Swal.fire({
                                        text: result.msg,
                                        icon: "success",
                                        buttonsStyling: !1,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {confirmButton: "btn btn-primary"}
                                    }).then((function (e) {
                                        e.isConfirmed && (t.querySelector('[name="email"]').value = "");
                                    }));
                                    $('#kt_check_pin_form [name=user_id]').val(result.user_id);
                                    $('#kt_password_reset_form').hide();
                                    $('#kt_check_pin_form').show();
                                }
                                else {
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


                    }), 1500)) : Swal.fire({
                        text: "Sorry, looks like there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, got it!",
                        customClass: {confirmButton: "btn btn-primary"}
                    })
                }))
            })),t.addEventListener("submit", (function (o) {
                o.preventDefault(), i.validate().then((function (i) {
                    "Valid" == i ? (e.setAttribute("data-kt-indicator", "on"), e.disabled = !0, setTimeout((function () {
                        var formData = new FormData($('#kt_password_reset_form')[0]);
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
                                    customClass: {confirmButton: "btn btn-primary"}
                                });
                            },
                            success: function (result) {
                                console.log(result);
                                if (result.status) {
                                    e.removeAttribute("data-kt-indicator"), e.disabled = !1, Swal.fire({
                                        text: result.msg,
                                        icon: "success",
                                        buttonsStyling: !1,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {confirmButton: "btn btn-primary"}
                                    }).then((function (e) {
                                        e.isConfirmed && (t.querySelector('[name="email"]').value = "");
                                    }));
                                    $('#kt_check_pin_form [name=user_id]').val(result.user_id);
                                    $('#kt_password_reset_form').hide();
                                    $('#kt_check_pin_form').show();
                                }
                                else {
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


                    }), 1500)) : Swal.fire({
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

var KTPasswordResetCheckPin = function () {
    var t, e, i;
    return {
        init: function () {
            t = document.querySelector("#kt_check_pin_form"),
                e = document.querySelector("#kt_check_pin_submit"),
                i = FormValidation.formValidation(t, {
                    fields: {
                        pin_code: {
                            validators: {
                                notEmpty: {message: "PIN-code is required"}
                            }
                        }
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger,
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: ".fv-row",
                            eleInvalidClass: "",
                            eleValidClass: ""
                        })
                    }
                }), e.addEventListener("click", (function (o) {
                o.preventDefault(), i.validate().then((function (i) {
                    "Valid" == i ? (e.setAttribute("data-kt-indicator", "on"), e.disabled = !0, setTimeout((function () {
                        var formData = new FormData($('#kt_check_pin_form')[0]);
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
                                    customClass: {confirmButton: "btn btn-primary"}
                                });
                            },
                            success: function (result) {
                                console.log(result);
                                if (result.status) {
                                    e.removeAttribute("data-kt-indicator"), e.disabled = !1, Swal.fire({
                                        text: result.msg,
                                        icon: "success",
                                        buttonsStyling: !1,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {confirmButton: "btn btn-primary"}
                                    }).then((function (e) {
                                        e.isConfirmed && (t.querySelector('[name="pin_code"]').value = "");
                                    }));
                                    $('#kt_new_password_form').show();
                                    $('#kt_new_password_form [name=resent_pin]').val(result.pin_code);
                                    $('#kt_new_password_form [name=user_id]').val(result.user_id);
                                    $('#kt_check_pin_form').hide();
                                }
                                else {
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


                    }), 1500)) : Swal.fire({
                        text: "Sorry, looks like there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, got it!",
                        customClass: {confirmButton: "btn btn-primary"}
                    })
                }))
            })), t.addEventListener("submit", (function (o) {
                o.preventDefault(), i.validate().then((function (i) {
                    "Valid" == i ? (e.setAttribute("data-kt-indicator", "on"), e.disabled = !0, setTimeout((function () {
                        var formData = new FormData($('#kt_check_pin_form')[0]);
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
                                    customClass: {confirmButton: "btn btn-primary"}
                                });
                            },
                            success: function (result) {
                                console.log(result);
                                if (result.status) {
                                    e.removeAttribute("data-kt-indicator"), e.disabled = !1, Swal.fire({
                                        text: result.msg,
                                        icon: "success",
                                        buttonsStyling: !1,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {confirmButton: "btn btn-primary"}
                                    }).then((function (e) {
                                        e.isConfirmed && (t.querySelector('[name="pin_code"]').value = "");
                                    }));
                                    $('#kt_new_password_form').show();
                                    $('#kt_new_password_form [name=resent_pin]').val(result.pin_code);
                                    $('#kt_new_password_form [name=user_id]').val(result.user_id);
                                    $('#kt_check_pin_form').hide();
                                }
                                else {
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


                    }), 1500)) : Swal.fire({
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

var KTPasswordResetNewPassword = function () {
    var e, t, r, o, s = function () {
        return 100 === o.getScore()
    };
    return {
        init: function () {
            e = document.querySelector("#kt_new_password_form"), t = document.querySelector("#kt_new_password_submit"), o = KTPasswordMeter.getInstance(e.querySelector('[data-kt-password-meter="true"]')), r = FormValidation.formValidation(e, {
                fields: {
                    password: {
                        validators: {
                            notEmpty: {message: "The password is required"},
                            callback: {
                                message: "Please enter valid password", callback: function (e) {
                                    if (e.value.length > 0)return s()
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
            }), t.addEventListener("click", (function (s) {
                s.preventDefault(), r.revalidateField("password"), r.validate().then((function (r) {
                    "Valid" == r ? (t.setAttribute("data-kt-indicator", "on"), t.disabled = !0, setTimeout((function () {
                        var formData = new FormData($('#kt_new_password_form')[0]);
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
                                t.removeAttribute("data-kt-indicator"), t.disabled = !1, Swal.fire({
                                    text: "Something went wrong. Please reload the page or try again!",
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {confirmButton: "btn btn-primary"}
                                }).then((function (t) {
                                    t.isConfirmed && (e.querySelector('[name="password"]').value = "", e.querySelector('[name="confirm-password"]').value = "", o.reset())
                                }))
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
                                        t.isConfirmed && (e.querySelector('[name="password"]').value = "", e.querySelector('[name="confirm-password"]').value = "", o.reset())
                                    }))
                                    window.location.href = result.redirect;
                                }
                                else {
                                    t.removeAttribute("data-kt-indicator"), t.disabled = !1, Swal.fire({
                                        text: result.msg,
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {confirmButton: "btn btn-primary"}
                                    }).then((function (t) {
                                        t.isConfirmed && (e.querySelector('[name="password"]').value = "", e.querySelector('[name="confirm-password"]').value = "", o.reset())
                                    }))
                                }

                            }
                        });

                    }), 1500)) : Swal.fire({
                        text: "Sorry, looks like there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, got it!",
                        customClass: {confirmButton: "btn btn-primary"}
                    })
                }))
            })), e.querySelector('input[name="password"]').addEventListener("input", (function () {
                this.value.length > 0 && r.updateFieldStatus("password", "NotValidated")
            })), e.addEventListener("submit", (function (s) {
                s.preventDefault(), r.revalidateField("password"), r.validate().then((function (r) {
                    "Valid" == r ? (t.setAttribute("data-kt-indicator", "on"), t.disabled = !0, setTimeout((function () {
                        var formData = new FormData($('#kt_new_password_form')[0]);
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
                                t.removeAttribute("data-kt-indicator"), t.disabled = !1, Swal.fire({
                                    text: "Something went wrong. Please reload the page or try again!",
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {confirmButton: "btn btn-primary"}
                                }).then((function (t) {
                                    t.isConfirmed && (e.querySelector('[name="password"]').value = "", e.querySelector('[name="confirm-password"]').value = "", o.reset())
                                }))
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
                                        t.isConfirmed && (e.querySelector('[name="password"]').value = "", e.querySelector('[name="confirm-password"]').value = "", o.reset())
                                    }))
                                    window.location.href = result.redirect;
                                }
                                else {
                                    t.removeAttribute("data-kt-indicator"), t.disabled = !1, Swal.fire({
                                        text: result.msg,
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {confirmButton: "btn btn-primary"}
                                    }).then((function (t) {
                                        t.isConfirmed && (e.querySelector('[name="password"]').value = "", e.querySelector('[name="confirm-password"]').value = "", o.reset())
                                    }))
                                }

                            }
                        });

                    }), 1500)) : Swal.fire({
                        text: "Sorry, looks like there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, got it!",
                        customClass: {confirmButton: "btn btn-primary"}
                    })
                }))
            })), e.querySelector('input[name="password"]').addEventListener("input", (function () {
                this.value.length > 0 && r.updateFieldStatus("password", "NotValidated")
            }))
        }
    }
}();

KTUtil.onDOMContentLoaded((function () {
    KTPasswordResetGeneral.init();
    KTPasswordResetCheckPin.init();
    KTPasswordResetNewPassword.init();
}));