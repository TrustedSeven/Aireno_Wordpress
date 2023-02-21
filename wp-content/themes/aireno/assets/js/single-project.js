"use strict";
//edit project name modal
var KTModalEditProjectName = function () {
    var btnSubmit, btnCancel, validator, modalForm, bsmodal, ptModal;
    return {
        init: function () {
            (ptModal = document.querySelector("#kt_modal_edit_project_name")) && (bsmodal = new bootstrap.Modal(ptModal), modalForm = document.querySelector("#kt_modal_edit_project_name_form"), btnSubmit = document.getElementById("kt_modal_edit_project_name_submit"), btnCancel = document.getElementById("kt_modal_edit_project_name_cancel"), validator = FormValidation.formValidation(modalForm, {
                fields: {
                    "project-name": {validators: {notEmpty: {message: "Project name is required"}}},
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            }), btnSubmit.addEventListener("click", (function (e) {
                e.preventDefault(), validator && validator.validate().then((function (e) {
                    if ("Valid" == e) {
                        btnSubmit.setAttribute("data-kt-indicator", "on");
                        btnSubmit.disabled = !0;
                        setTimeout((function () {
                            var formData = new FormData();
                            formData.set('action', 'aireno_change_project_name');
                            formData.set('project_id', aireno_project.project_id);
                            formData.set('project-name', $('#kt_modal_edit_project_name_form [name=project-name]').val());
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
                                    btnSubmit.removeAttribute("data-kt-indicator");
                                    btnSubmit.disabled = !1;
                                    Swal.fire({
                                        text: "Something went wrong. Please try again!",
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "OK",
                                        customClass: {confirmButton: "btn btn-primary"}
                                    }).then((function (t) {
                                        t.isConfirmed && bsmodal.hide()
                                    }))
                                },
                                success: function (result) {
                                    btnSubmit.removeAttribute("data-kt-indicator");
                                    btnSubmit.disabled = !1;
                                    $('.project-name').html(result.msg);
                                    bsmodal.hide();
                                }
                            });
                        }), 2e3);
                    } else {
                        Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "OK",
                            customClass: {confirmButton: "btn btn-primary"}
                        })
                    }
                }))
            })), btnCancel.addEventListener("click", (function (t) {
                t.preventDefault(), bsmodal.hide()
            })))
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTModalEditProjectName.init()
}));

var KTModalManageProjectFee = function () {
    var btnSubmit, btnCancel, validator, modalForm, bsmodal, ptModal;
    return {
        init: function () {
            (ptModal = document.querySelector("#kt_modal_manage_project_fee")) && (
                bsmodal = new bootstrap.Modal(ptModal),
                    modalForm = document.querySelector("#kt_modal_manage_project_fee_form"),
                    btnSubmit = document.getElementById("kt_modal_manage_project_fee_submit"),
                    btnCancel = document.getElementById("kt_modal_manage_project_fee_cancel"),
                    validator = FormValidation.formValidation(modalForm, {
                fields: {
                    "project-fee": {validators: {notEmpty: {message: "Project Fee is required"}}},
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            }), btnSubmit.addEventListener("click", (function (e) {
                e.preventDefault(), validator && validator.validate().then((function (e) {
                    if ("Valid" == e) {
                        btnSubmit.setAttribute("data-kt-indicator", "on");
                        btnSubmit.disabled = !0;
                        setTimeout((function () {
                            var formData = new FormData();
                            formData.set('action', 'aireno_change_project_fee');
                            formData.set('project_id', aireno_project.project_id);
                            formData.set('project-fee', $('#kt_modal_manage_project_fee_form [name=project-fee]').val());
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
                                    btnSubmit.removeAttribute("data-kt-indicator");
                                    btnSubmit.disabled = !1;
                                    Swal.fire({
                                        text: "Something went wrong. Please try again!",
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "OK",
                                        customClass: {confirmButton: "btn btn-danger"}
                                    }).then((function (t) {
                                        t.isConfirmed && bsmodal.hide()
                                    }))
                                },
                                success: function (result) {
                                    btnSubmit.removeAttribute("data-kt-indicator");
                                    btnSubmit.disabled = !1;
                                    bsmodal.hide();
                                }
                            });
                        }), 2e3);
                    } else {
                        Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "OK",
                            customClass: {confirmButton: "btn btn-primary"}
                        })
                    }
                }))
            })), btnCancel.addEventListener("click", (function (t) {
                t.preventDefault(), bsmodal.hide()
            })))
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTModalManageProjectFee.init();
}));

var reloadOnCurrentTab = function () {
    var active_tab = $('#kt_content_container > .tab-content > .tab-pane.active').attr('id');
    var url = window.location.href;

    var hash = location.hash;
    url = url.replace(hash, '');
    if (url.indexOf('tab' + "=") >= 0) {
        var prefix = url.substring(0, url.indexOf("tab="));
        var suffix = url.substring(url.indexOf("tab="));
        suffix = suffix.substring(suffix.indexOf("=") + 1);
        suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
        url = prefix + "tab=" + active_tab + suffix;
    } else {
        if (url.indexOf("?") < 0)
            url += "?tab" + "=" + active_tab;
        else
            url += "&tab" + "=" + active_tab;
    }

    window.location.href = url;
    // window.location.reload();
}

//edit project address modal
var KTModalEditProjectAddress = function () {
    var btnSubmit, btnCancel, validator, modalForm, bsmodal, ptModal, zipcode;
    return {
        init: function () {
            (ptModal = document.querySelector("#kt_modal_edit_project_address")) && (bsmodal = new bootstrap.Modal(ptModal), modalForm = document.querySelector("#kt_modal_edit_project_address_form"), btnSubmit = document.getElementById("kt_modal_edit_project_address_submit"), btnCancel = document.getElementById("kt_modal_edit_project_address_cancel"), validator = FormValidation.formValidation(modalForm, {
                fields: {
                    "project_address": {validators: {notEmpty: {message: "Please fill the project address!"}}},
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            }), btnSubmit.addEventListener("click", (function (e) {
                e.preventDefault(), validator && validator.validate().then((function (e) {
                    if ("Valid" == e) {
                        btnSubmit.setAttribute("data-kt-indicator", "on");
                        btnSubmit.disabled = !0;
                        setTimeout((function () {
                            var formData = new FormData();
                            formData.set('action', 'aireno_change_project_address');
                            formData.set('project_id', aireno_project.project_id);
                            formData.set('project_address', $('#kt_modal_edit_project_address_form [name=project_address]').val());
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
                                    btnSubmit.removeAttribute("data-kt-indicator");
                                    btnSubmit.disabled = !1;
                                    Swal.fire({
                                        text: "Something went wrong. Please try again!",
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "OK",
                                        customClass: {confirmButton: "btn btn-primary"}
                                    }).then((function (t) {
                                        t.isConfirmed && bsmodal.hide()
                                    }))
                                },
                                success: function (result) {
                                    btnSubmit.removeAttribute("data-kt-indicator");
                                    btnSubmit.disabled = !1;
                                    $('.project-address').html(result.msg);
                                    bsmodal.hide();
                                }
                            });
                        }), 2e3);
                    } else {
                        Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "OK",
                            customClass: {confirmButton: "btn btn-primary"}
                        })
                    }
                }))
            })), btnCancel.addEventListener("click", (function (t) {
                t.preventDefault(), bsmodal.hide()
            })))
            //Zipcode Autocomplete on Brief step
            zipcode = document.querySelector('#kt_modal_edit_project_address_form [name=project_address]');
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
    KTModalEditProjectAddress.init()
}));

//edit project date modal
var KTModalEditProjectDate = function () {
    var btnSubmit, btnCancel, validator, modalForm, bsmodal, ptModal;
    return {
        init: function () {
            (ptModal = document.querySelector("#kt_modal_edit_project_date")) && (bsmodal = new bootstrap.Modal(ptModal), modalForm = document.querySelector("#kt_modal_edit_project_date_form"), btnSubmit = document.getElementById("kt_modal_edit_project_date_submit"), btnCancel = document.getElementById("kt_modal_edit_project_date_cancel"), $("[name=date_start]").flatpickr({
                enableTime: false,
                dateFormat: "Y-m-d"
            }), validator = FormValidation.formValidation(modalForm, {
                fields: {
                    "date_start": {validators: {notEmpty: {message: "Please select a date!"}}},
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            }), btnSubmit.addEventListener("click", (function (e) {
                e.preventDefault(), validator && validator.validate().then((function (e) {
                    if ("Valid" == e) {
                        btnSubmit.setAttribute("data-kt-indicator", "on");
                        btnSubmit.disabled = !0;
                        setTimeout((function () {
                            var formData = new FormData();
                            formData.set('action', 'aireno_change_project_date');
                            formData.set('project_id', aireno_project.project_id);
                            formData.set('date_start', $('#kt_modal_edit_project_date_form [name=date_start]').val());
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
                                    btnSubmit.removeAttribute("data-kt-indicator");
                                    btnSubmit.disabled = !1;
                                    Swal.fire({
                                        text: "Something went wrong. Please try again!",
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "OK",
                                        customClass: {confirmButton: "btn btn-primary"}
                                    }).then((function (t) {
                                        t.isConfirmed && bsmodal.hide()
                                    }))
                                },
                                success: function (result) {
                                    btnSubmit.removeAttribute("data-kt-indicator");
                                    btnSubmit.disabled = !1;
                                    $('.project-date').html(result.msg);
                                    bsmodal.hide();
                                }
                            });
                        }), 2e3);
                    } else {
                        Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "OK",
                            customClass: {confirmButton: "btn btn-primary"}
                        })
                    }
                }))
            })), btnCancel.addEventListener("click", (function (t) {
                t.preventDefault(), bsmodal.hide()
            })))
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTModalEditProjectDate.init()
}));

//edit project status modal
var KTModalEditProjectStatus = function () {
    var btnSubmit, btnCancel, validator, modalForm, bsmodal, ptModal;
    return {
        init: function () {
            (ptModal = document.querySelector("#kt_modal_manage_project_status")) && (bsmodal = new bootstrap.Modal(ptModal), modalForm = document.querySelector("#kt_modal_manage_project_status_form"), btnSubmit = document.getElementById("kt_modal_manage_project_status_submit"), btnCancel = document.getElementById("kt_modal_manage_project_status_cancel"), validator = FormValidation.formValidation(modalForm, {
                fields: {
                    "status": {validators: {notEmpty: {message: "Please select a status!"}}},
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            }), btnSubmit.addEventListener("click", (function (e) {
                e.preventDefault(), validator && validator.validate().then((function (e) {
                    if ("Valid" == e) {
                        btnSubmit.setAttribute("data-kt-indicator", "on");
                        btnSubmit.disabled = !0;
                        setTimeout((function () {
                            var formData = new FormData();
                            formData.set('action', 'aireno_manage_project_status');
                            formData.set('project_id', aireno_project.project_id);
                            formData.set('status', $('#kt_modal_manage_project_status_form [name=status]').val());
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
                                    btnSubmit.removeAttribute("data-kt-indicator");
                                    btnSubmit.disabled = !1;
                                    Swal.fire({
                                        text: "Something went wrong. Please try again!",
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "OK",
                                        customClass: {confirmButton: "btn btn-primary"}
                                    }).then((function (t) {
                                        t.isConfirmed && bsmodal.hide()
                                    }))
                                },
                                success: function (result) {
                                    btnSubmit.removeAttribute("data-kt-indicator");
                                    btnSubmit.disabled = !1;
                                    reloadOnCurrentTab();
                                    bsmodal.hide();
                                }
                            });
                        }), 2e3);
                    } else {
                        Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "OK",
                            customClass: {confirmButton: "btn btn-primary"}
                        })
                    }
                }))
            })), btnCancel.addEventListener("click", (function (t) {
                t.preventDefault(), bsmodal.hide()
            })))
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTModalEditProjectStatus.init()
}));

//edit project stage modal
var KTModalEditProjectStage = function () {
    var btnSubmit, btnCancel, validator, modalForm, bsmodal, ptModal;
    return {
        init: function () {
            (ptModal = document.querySelector("#kt_modal_edit_project_stage")) && (bsmodal = new bootstrap.Modal(ptModal), modalForm = document.querySelector("#kt_modal_edit_project_stage_form"), btnSubmit = document.getElementById("kt_modal_edit_project_stage_submit"), btnCancel = document.getElementById("kt_modal_edit_project_stage_cancel"),
                validator = FormValidation.formValidation(modalForm, {
                    fields: {
                        "stage": {validators: {notEmpty: {message: "Please select a stage!"}}},
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger,
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: ".fv-row",
                            eleInvalidClass: "",
                            eleValidClass: ""
                        })
                    }
                }),
                btnSubmit.addEventListener("click", (function (e) {
                    e.preventDefault(), validator && validator.validate().then((function (e) {
                        if ("Valid" == e) {
                            btnSubmit.setAttribute("data-kt-indicator", "on");
                            btnSubmit.disabled = !0;
                            setTimeout((function () {
                                var formData = new FormData();
                                formData.set('action', 'aireno_change_project_stage');
                                formData.set('project_id', aireno_project.project_id);
                                formData.set('stage', $('#kt_modal_edit_project_stage_form [name=stage]').val());
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
                                        btnSubmit.removeAttribute("data-kt-indicator");
                                        btnSubmit.disabled = !1;
                                        Swal.fire({
                                            text: "Something went wrong. Please try again!",
                                            icon: "error",
                                            buttonsStyling: !1,
                                            confirmButtonText: "OK",
                                            customClass: {confirmButton: "btn btn-primary"}
                                        }).then((function (t) {
                                            t.isConfirmed && bsmodal.hide()
                                        }))
                                    },
                                    success: function (result) {
                                        btnSubmit.removeAttribute("data-kt-indicator");
                                        btnSubmit.disabled = !1;
                                        $('.project-stage').html(result.msg);
                                        bsmodal.hide();
                                    }
                                });
                            }), 2e3);
                        } else {
                            Swal.fire({
                                text: "Sorry, looks like there are some errors detected, please try again.",
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "OK",
                                customClass: {confirmButton: "btn btn-primary"}
                            })
                        }
                    }))
                })), btnCancel.addEventListener("click", (function (t) {
                t.preventDefault(), bsmodal.hide()
            })))
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTModalEditProjectStage.init()
}));

//close project modal
var KTModalCloseProject = function () {
    var btnSubmit, btnCancel, validator, modalForm, bsmodal, ptModal;
    return {
        init: function () {
            (ptModal = document.querySelector("#kt_modal_close_project")) && (bsmodal = new bootstrap.Modal(ptModal), modalForm = document.querySelector("#kt_modal_close_project_form"), btnSubmit = document.getElementById("kt_modal_close_project_submit"), btnCancel = document.getElementById("kt_modal_close_project_cancel"), validator = FormValidation.formValidation(modalForm, {
                fields: {
                    "cancel_reason": {validators: {notEmpty: {message: "Please select a reason!"}}},
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            }), btnSubmit.addEventListener("click", (function (e) {
                e.preventDefault(), validator && validator.validate().then((function (e) {
                    if ("Valid" == e) {
                        btnSubmit.setAttribute("data-kt-indicator", "on");
                        btnSubmit.disabled = !0;
                        setTimeout((function () {
                            var formData = new FormData();
                            formData.set('action', 'aireno_close_project');
                            formData.set('project_id', aireno_project.project_id);
                            formData.set('cancel_reason', $('#kt_modal_close_project_form [name=cancel_reason]').val());
                            formData.set('explained', $('#kt_modal_close_project_form [name=explained]').val());
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
                                    btnSubmit.removeAttribute("data-kt-indicator");
                                    btnSubmit.disabled = !1;
                                    Swal.fire({
                                        text: "Something went wrong. Please try again!",
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "OK",
                                        customClass: {confirmButton: "btn btn-primary"}
                                    }).then((function (t) {
                                        t.isConfirmed && bsmodal.hide()
                                    }))
                                },
                                success: function (result) {
                                    btnSubmit.removeAttribute("data-kt-indicator");
                                    btnSubmit.disabled = !1;
                                    if (result.status) {
                                        reloadOnCurrentTab();
                                    } else {
                                        bsmodal.hide();
                                        Swal.fire({
                                            text: result.message,
                                            icon: "error",
                                            buttonsStyling: !1,
                                            confirmButtonText: "OK",
                                            customClass: {confirmButton: "btn btn-primary"}
                                        });
                                    }
                                }
                            });
                        }), 2e3);
                    } else {
                        Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "OK",
                            customClass: {confirmButton: "btn btn-primary"}
                        })
                    }
                }))
            })), btnCancel.addEventListener("click", (function (t) {
                t.preventDefault(), bsmodal.hide()
            })))
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTModalCloseProject.init()
}));

//delete project modal
var KTModalDeleteProject = function () {
    var btnSubmit, btnCancel, bsmodal, ptModal;
    return {
        init: function () {
            (ptModal = document.querySelector("#kt_modal_delete_project")) && (bsmodal = new bootstrap.Modal(ptModal), btnSubmit = document.getElementById("kt_modal_delete_project_submit"), btnCancel = document.getElementById("kt_modal_delete_project_cancel"), btnSubmit.addEventListener("click", (function (e) {
                e.preventDefault();
                btnSubmit.setAttribute("data-kt-indicator", "on");
                btnSubmit.disabled = !0;
                setTimeout((function () {
                    var formData = new FormData();
                    formData.set('action', 'aireno_delete_project');
                    formData.set('project_id', aireno_project.project_id);
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
                            btnSubmit.removeAttribute("data-kt-indicator");
                            btnSubmit.disabled = !1;
                            Swal.fire({
                                text: "Something went wrong. Please try again!",
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "OK",
                                customClass: {confirmButton: "btn btn-primary"}
                            }).then((function (t) {
                                t.isConfirmed && bsmodal.hide()
                            }))
                        },
                        success: function (result) {
                            btnSubmit.removeAttribute("data-kt-indicator");
                            btnSubmit.disabled = !1;
                            if (result.status) {
                                window.location.href = result.redirect;
                            } else {
                                bsmodal.hide();
                                Swal.fire({
                                    text: result.message,
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "OK",
                                    customClass: {confirmButton: "btn btn-primary"}
                                });
                            }
                        }
                    });
                }), 2e3);
            })), btnCancel.addEventListener("click", (function (t) {
                t.preventDefault(), bsmodal.hide()
            })))
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTModalDeleteProject.init()
}));

//accept project modal
var KTModalAcceptProject = function () {
    var btnAcceptProject, btnCancelProject, validator, bsModal, apModal, modalForm;
    return {
        init: function () {
            (apModal = document.querySelector("#kt_modal_accept_project")) && (bsModal = new bootstrap.Modal(apModal), modalForm = document.querySelector("#kt_modal_accept_project_form"), btnAcceptProject = document.getElementById("kt_modal_accept_project_submit"), btnCancelProject = document.getElementById("kt_modal_accept_project_cancel"), validator = FormValidation.formValidation(modalForm, {
                fields: {
                    "client_approve": {validators: {notEmpty: {message: "You must agree T&C of the contract"}}},
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            }), btnAcceptProject.addEventListener("click", (function (e) {
                e.preventDefault(), validator && validator.validate().then((function (e) {
                    if ("Valid" == e) {
                        btnAcceptProject.setAttribute("data-kt-indicator", "on");
                        btnAcceptProject.disabled = !0;
                        
                        if (parseFloat(aireno_project.project_fee) > 0) {
                            blockUI.release();
                            btnAcceptProject.removeAttribute("data-kt-indicator");
                            btnAcceptProject.disabled = !1;
                            bsModal.hide();
                            $('.aspBtnContainer button[type=submit]').trigger('click');
                        }
                        else {
                            var formData = new FormData();
                            formData.set('action', 'aireno_accept_project');
                            formData.set('project_id', aireno_project.project_id);
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
                                    btnAcceptProject.removeAttribute("data-kt-indicator");
                                    btnAcceptProject.disabled = !1;
                                    Swal.fire({
                                        text: "Something went wrong. Please try again!",
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "OK",
                                        customClass: {confirmButton: "btn btn-primary"}
                                    }).then((function (t) {
                                        t.isConfirmed && bsmodal.hide()
                                    }))
                                },
                                success: function (result) {
                                    blockUI.release();
                                    btnAcceptProject.removeAttribute("data-kt-indicator");
                                    btnAcceptProject.disabled = !1;
                                    if (result.status) reloadOnCurrentTab();
                                    else {
                                        bsModal.hide();
                                        Swal.fire({
                                            text: "Something went wrong. Please try again!",
                                            icon: "error",
                                            buttonsStyling: !1,
                                            confirmButtonText: "OK",
                                            customClass: {confirmButton: "btn btn-primary"}
                                        })
                                    }
                                }
                            });
                        }
                    } else {
                        Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "OK",
                            customClass: {confirmButton: "btn btn-primary"}
                        })
                    }
                }))
            })), btnCancelProject.addEventListener("click", (function (t) {
                bsModal.hide()
            })))
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTModalAcceptProject.init()
}));

$('body').on('click', '.btnLoadContacts', function (e) {
    e.preventDefault();
    var formData = new FormData();
    formData.set('action', 'aireno_load_contacts');
    formData.set('project_id', aireno_project.project_id);
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
                text: "Something went wrong. Please try again!",
                icon: "error",
                buttonsStyling: !1,
                confirmButtonText: "OK",
                customClass: {confirmButton: "btn btn-primary"}
            });
        },
        success: function (result) {
            blockUI.release();
            if (result.status) {
                var apModal = document.querySelector("#kt_modal_users_search");
                var bsModal = new bootstrap.Modal(apModal);
                var modalForm = document.querySelector("#search_project_pending_users_form");
                var resultContainer = document.querySelector('[data-kt-search-element="results"]');
                $(resultContainer).empty();
                var template = modalForm.querySelector('[data-kt-element="template"]');
                for (var i = 0; i < result.message.length; i++) {
                    var user = result.message[i];
                    var clone = $(template).clone().removeClass('d-none');

                    clone.find('img').attr('src', user.avatar);
                    clone.find('[data-kt-element="display_name"]').html(user.display_name);
                    clone.find('[data-kt-element="email"]').html(user.email);

                    if (user.in_project == 1) {
                        clone.find('.btnAddMember').removeClass('btnAddMember').addClass('btnUpdateMember').attr('data-user', user.id).html('Update');
                    } else {
                        clone.find('.btnAddMember').attr('data-user', user.id);
                    }
                    clone.find('select').val(user.role);
                    clone.appendTo($(resultContainer));
                }
                bsModal.show();
            } else {
                $('#kt_modal_new_target').modal('show');
            }
        }
    });
});

//add members to a project
var KTModalAddUser = function () {
    var btnAddMemberToProject, bsModal, apModal, modalForm, searchInput, resultContainer;
    return {
        init: function () {
            apModal = document.querySelector("#kt_modal_users_search");
            bsModal = new bootstrap.Modal(apModal);
            modalForm = document.querySelector("#search_project_pending_users_form");
            btnAddMemberToProject = document.getElementById("kt_modal_users_search_submit");
            searchInput = document.getElementById('search_project_pending_users');
            resultContainer = document.querySelector('[data-kt-search-element="results"]');

            btnAddMemberToProject.addEventListener("click", (function (e) {
                btnAddMemberToProject.setAttribute("data-kt-indicator", "on");
                btnAddMemberToProject.disabled = !0;
                var formData = new FormData($('#search_project_pending_users_form')[0]);
                formData.set('project_id', aireno_project.project_id);
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
                        btnAddMemberToProject.removeAttribute("data-kt-indicator");
                        btnAddMemberToProject.disabled = !1;
                        blockUI.release();
                        Swal.fire({
                            text: "Something went wrong. Please try again!",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "OK",
                            customClass: {confirmButton: "btn btn-danger"}
                        });
                    },
                    success: function (result) {
                        btnAddMemberToProject.removeAttribute("data-kt-indicator");
                        btnAddMemberToProject.disabled = !1;
                        bsModal.hide();
                        blockUI.release();
                        if (result.status) {
                            reloadOnCurrentTab();
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
            }));
            searchInput.addEventListener("keypress", function (e) {
                if (e.keyCode == 13) {
                    e.preventDefault();
                    return false;
                }
            });
            searchInput.addEventListener("keyup", function (e) {
                if (e.keyCode == 13) {
                    e.preventDefault();
                    return false;
                } else {
                    var txt = $(this).val();
                    if (txt.length > 0) {
                        $('.project_pending_members [data-kt-element="template"]').each(function () {
                            if ($(this).text().toUpperCase().indexOf(txt.toUpperCase()) != -1) {
                                $(this).removeClass('d-none').addClass('d-flex');
                            } else $(this).addClass('d-none').removeClass('d-flex');
                        });
                    } else {
                        $('.project_pending_members [data-kt-element="template"]').each(function () {
                            $(this).removeClass('d-none').addClass('d-flex');
                        });
                    }
                }
            });
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    if ($("#kt_modal_users_search").length) {
        KTModalAddUser.init();
    }
}));

const validateEmail = (email) => {
    return String(email)
        .toLowerCase()
        .match(
            /^\w+@(\w)+((\-)\w+)?(\.(\w+)){1,2}$/
        );
};///^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
const validatePhone = (phone) => {
    return String(phone)
        .toLowerCase()
        .match(
            /^\({0,1}((0|\+61)(2|4|3|7|8)){0,1}\){0,1}(\ |-){0,1}[0-9]{2}(\ |-){0,1}[0-9]{2}(\ |-){0,1}[0-9]{1}(\ |-){0,1}[0-9]{3}$/
        );
};

$('body').on("click", '.btnAddMember', function (e) {
    e.preventDefault();
    var userId = $(this).attr('data-user');
    var type = $(this).closest('[data-kt-element="template"]').find('select').val();
    var formData = new FormData();
    formData.set('action', 'aireno_add_user_to_project');
    formData.set('member_id', userId);
    formData.set('project_id', aireno_project.project_id);
    formData.set('type', type);
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
                confirmButtonText: "OK!",
                customClass: {confirmButton: "btn btn-danger"}
            });
        },
        success: function (result) {
            blockUI.release();
            if (result.status)
                reloadOnCurrentTab();
            else Swal.fire({
                text: result.message,
                icon: "error",
                buttonsStyling: !1,
                confirmButtonText: "OK!",
                customClass: {confirmButton: "btn btn-danger"}
            });
        }
    });
});
$('body').on("click", '.btnUpdateMember', function (e) {
    e.preventDefault();
    var userId = $(this).attr('data-user');
    var type = $(this).closest('[data-kt-element="template"]').find('select').val();
    var formData = new FormData();
    formData.set('action', 'aireno_update_user_to_project');
    formData.set('member_id', userId);
    formData.set('project_id', aireno_project.project_id);
    formData.set('type', type);
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
                confirmButtonText: "OK!",
                customClass: {confirmButton: "btn btn-danger"}
            });
        },
        success: function (result) {
            blockUI.release();
            if (result.status)
                reloadOnCurrentTab();
            else Swal.fire({
                text: result.message,
                icon: "error",
                buttonsStyling: !1,
                confirmButtonText: "OK!",
                customClass: {confirmButton: "btn btn-danger"}
            });
        }
    });
});

var KTModalProjectClient = function () {
    var btnRegisterSubmit, regValidation, registerForm, modal, modalTarget, btnBackSearch,
        searchForm, btnSearchSubmit, searchValidation, resultContainer, template;
    return {
        init: function () {
            modalTarget = document.querySelector("#kt_modal_new_target");
            modal = new bootstrap.Modal(modalTarget);
            registerForm = document.querySelector("#kt_modal_new_target_form");
            btnRegisterSubmit = registerForm.querySelector("#kt_modal_new_target_submit");
            btnBackSearch = registerForm.querySelector('#kt_modal_new_target_search');
            $(registerForm.querySelector('[name="due_date"]')).flatpickr({
                enableTime: !0,
                dateFormat: "d, M Y, H:i"
            });
            regValidation = FormValidation.formValidation(registerForm, {
                fields: {
                    display_name: {validators: {notEmpty: {message: "Full name is required"}}},
                    email: {validators: {notEmpty: {message: "Email is required"}}},
                    phone: {validators: {notEmpty: {message: "Phone number is required"}}},
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            });
            btnRegisterSubmit.addEventListener("click", (function (e) {
                e.preventDefault(),
                regValidation && regValidation.validate().then(function (e) {
                    if (e == "Valid") {
                        btnRegisterSubmit.setAttribute("data-kt-indicator", "on");
                        btnRegisterSubmit.disabled = !0;
                        var formData = new FormData($(registerForm)[0]);
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
                                btnRegisterSubmit.removeAttribute("data-kt-indicator");
                                btnRegisterSubmit.disabled = !1;
                                blockUI.release();
                                Swal.fire({
                                    text: "Something went wrong. Please reload the page or try again!",
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "OK!",
                                    customClass: {confirmButton: "btn btn-light"}
                                });
                            },
                            success: function (result) {
                                blockUI.release();
                                btnRegisterSubmit.removeAttribute("data-kt-indicator");
                                btnRegisterSubmit.disabled = !1;
                                if (result.status) {
                                    reloadOnCurrentTab();
                                } else {
                                    Swal.fire({
                                        text: result.msg,
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "OK!",
                                        customClass: {confirmButton: "btn btn-light"}
                                    });
                                }
                            }
                        });
                    } else {
                        Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {confirmButton: "btn btn-danger"}
                        });
                    }
                });
            }));
            btnBackSearch.addEventListener("click", function (e) {
                e.preventDefault();
                $(registerForm).addClass('d-none');
                $('#kt_modal_search_user_form').removeClass('d-none');
            });

            searchForm = document.querySelector("#kt_modal_search_user_form");
            searchValidation = FormValidation.formValidation(searchForm, {
                fields: {
                    email_or_phone: {validators: {notEmpty: {message: "Fill Email or Phone number!"}}},
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            });
            btnSearchSubmit = searchForm.querySelector("#kt_modal_search_user_form_submit");

            resultContainer = searchForm.querySelector('#kt_modal_search_user_form_result');
            template = searchForm.querySelector('[data-kt-element="template"]');

            btnSearchSubmit.addEventListener("click", (function (e) {
                e.preventDefault();
                searchValidation && searchValidation.validate().then(function (e) {
                    if (e == "Valid") {
                        btnSearchSubmit.setAttribute("data-kt-indicator", "on");
                        btnSearchSubmit.disabled = !0;
                        $(resultContainer).empty().addClass('d-none');
                        var formData = new FormData($(searchForm)[0]);
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
                                btnSearchSubmit.removeAttribute("data-kt-indicator");
                                btnSearchSubmit.disabled = !1;
                                $(resultContainer).empty().addClass('d-none');
                                Swal.fire({
                                    text: "Something went wrong. Please reload the page or try again!",
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "OK!",
                                    customClass: {confirmButton: "btn btn-light"}
                                });
                            },
                            success: function (result) {
                                var templateClone, users, user;
                                blockUI.release();
                                btnSearchSubmit.removeAttribute("data-kt-indicator");
                                btnSearchSubmit.disabled = !1;
                                switch (result.status) {
                                    case 0:
                                    case 1:
                                        Swal.fire({
                                            text: result.msg,
                                            icon: "error",
                                            buttonsStyling: !1,
                                            confirmButtonText: "OK!",
                                            customClass: {confirmButton: "btn btn-danger"}
                                        });
                                        break;
                                    case 2:
                                        var emailOrPhone = $(searchForm).find('[name=email_or_phone]').val();
                                        if (validateEmail(emailOrPhone) || validatePhone(emailOrPhone)) {
                                            $(searchForm).addClass('d-none');
                                            $(registerForm).removeClass('d-none');
                                            if (validateEmail(emailOrPhone)) {
                                                $(registerForm).find('[name="email"]').val(emailOrPhone);
                                            } else {
                                                $(registerForm).find('[name="phone"]').val(emailOrPhone);
                                            }
                                        } else {
                                            Swal.fire({
                                                text: "Please fill valid Email or Phone number!",
                                                icon: "error",
                                                buttonsStyling: !1,
                                                confirmButtonText: "OK!",
                                                customClass: {confirmButton: "btn btn-danger"}
                                            });
                                        }
                                        break;
                                    case 3:
                                        $(resultContainer).empty().removeClass('d-none');
                                        users = result.users;
                                        for (var i = 0; i < users.length; i++) {
                                            user = users[i];
                                            (templateClone = template.cloneNode(!0)).classList.remove("d-none");
                                            $(templateClone).find('img').attr('src', user.avatar);
                                            $(templateClone).find('.btnAddMember').attr('data-user', user.id);

                                            $(templateClone).find('[data-kt-element="display_name"]').html(user.display_name);
                                            $(templateClone).find('[data-kt-element="email"]').html(user.email);
                                            $(templateClone).appendTo($(resultContainer));
                                        }
                                        break;
                                    default:
                                        break;
                                }
                            }
                        });
                    } else {
                        Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {confirmButton: "btn btn-danger"}
                        });
                    }
                });
            }));
        }
    };
}();
KTUtil.onDOMContentLoaded((function () {
    if ($("#kt_modal_new_target").length)
        KTModalProjectClient.init();
}));


$("#kt_tasks_footer [data-kt-element='datetime_field']").flatpickr({enableTime: true, dateFormat: "Y-m-d H:i"});
$("[name='activity_datetime']").flatpickr({enableTime: true, dateFormat: "Y-m-d H:i"});

var KTAppTask = function () {
    var addTask = function (task_drawer) {
        var task_id = $(task_drawer).find('[data-kt-element="task_id"]').val();
        var task_title = $(task_drawer).find('[data-kt-element="input"]').val();
        var task_type = $(task_drawer).find('[data-kt-element="type_field"]').val();
        var task_datetime = $(task_drawer).find('[data-kt-element="datetime_field"]').val();
        var task_users = $(task_drawer).find('[data-kt-element="users_field"]').val();

        if (!task_title || !task_type || !task_datetime || !task_users) {
            Swal.fire({
                text: "Please fill out all fields",
                icon: "error",
                buttonsStyling: !1,
                confirmButtonText: "OK",
                customClass: {confirmButton: "btn btn-primary"}
            });
        } else {
            blockUI.block();
            var formData = new FormData();

            formData.set('action', 'aireno_manage_task');
            formData.set('task_title', task_title);
            formData.set('task_type', task_type);
            formData.set('task_datetime', task_datetime);
            formData.set('task_users', task_users);
            formData.set('task_id', task_id);
            formData.set('project_id', aireno_project.project_id);

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
                        text: "Something went wrong. Please try again!",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "OK",
                        customClass: {confirmButton: "btn btn-primary"}
                    });
                },
                success: function (result) {
                    blockUI.release();
                    var $task;
                    if (task_id) {
                        $task = $(task_drawer).find('[data-kt-element="tasks"] [data-task=' + task_id + ']');
                    } else {
                        var $taskList = $(task_drawer).find('[data-kt-element="tasks"]');
                        var taskList = task_drawer.querySelector('[data-kt-element="tasks"]');
                        var $template = $taskList.find('[data-kt-element="task-template"]');
                        $task = $template.clone().removeClass('d-none');

                        $task.attr('data-task', result.task_id).removeAttr('data-kt-element');
                        $taskList.append($task);
                        taskList.scrollTop = taskList.scrollHeight;
                    }

                    $task.find('[data-kt-element="title"]').html(result.task_title);
                    $task.find('[data-kt-element="type"]').html(result.task_type);
                    $task.find('[data-kt-element="datetime"]').html(result.task_datetime);
                    $task.find('[data-kt-element="users"]').html(result.usernames);
                    $task.find('[data-kt-element="data"]').val(result.data);

                    $('#kt_tasks_header .tasks_count').html(parseInt($('#kt_tasks_header .tasks_count').html()) + 1);
                }
            });
        }
        resetTaskFields(task_drawer);
    };
    var deleteTask = function (btnDelete) {

        Swal.fire({
            text: "Are you sure delete this task?",
            icon: "info",
            buttonsStyling: !1,
            confirmButtonText: "Yes",
            customClass: {confirmButton: "btn btn-primary"}
        }).then((function (t) {
            if (t.isConfirmed) {
                var $task = $(btnDelete).closest('[data-task]')
                var task_id = $task.attr('data-task');

                var formData = new FormData();
                formData.set('task_id', task_id);
                formData.set('project_id', aireno_project.project_id);
                formData.set('action', 'aireno_delete_task_from_project');
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
                            text: "Something went wrong. Please try again!",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "OK",
                            customClass: {confirmButton: "btn btn-primary"}
                        });
                    },
                    success: function (result) {
                        blockUI.release();
                        if (result.status) {
                            $(btnDelete).closest('[data-task]').remove();
                            resetTaskFields(document.querySelector("#kt_drawer_task"));
                            $('#kt_tasks_header .tasks_count').html(parseInt($('#kt_tasks_header .tasks_count').html()) - 1);
                        } else {
                            Swal.fire({
                                text: result.msg,
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "OK",
                                customClass: {confirmButton: "btn btn-primary"}
                            });
                        }
                    }
                });
            }
        }));
    }
    var fillTask = function (task_drawer, btnEdit) {
        var $task = $(btnEdit).closest('[data-task]');
        $(task_drawer).find('[data-kt-element="input"]').val($task.find('[data-kt-element="title"]').html());
        $(task_drawer).find('[data-kt-element="task_id"]').val($task.attr('data-task'));
        $(task_drawer).find('[data-kt-element="type_field"]').val($task.find('[data-kt-element="type"]').html()).trigger('change');
        $(task_drawer).find('[data-kt-element="datetime_field"]').val($task.find('[data-kt-element="datetime"]').html());
        ;

        var task_userdata = JSON.parse($task.find('[data-kt-element="data"]').val());
        var task_users = [];
        for (var index in task_userdata) {
            var task_user = task_userdata[index];
            task_users.push(task_user.id);
        }
        ;
        $(task_drawer).find('[data-kt-element="users_field"]').val(task_users).trigger('change');
    }
    var resetTaskFields = function (task_drawer) {
        $(task_drawer).find('[data-kt-element="input"]').val('');
        $(task_drawer).find('[data-kt-element="task_id"]').val('');
        $(task_drawer).find('[data-kt-element="type_field"]').val(null).trigger('change');
        $(task_drawer).find('[data-kt-element="datetime_field"]').val(moment().format('YYYY-MM-DD H:mm'));
        $(task_drawer).find('[data-kt-element="users_field"]').val(null).trigger('change');
    }
    var completeTask = function (obj) {
        var $task = $(obj).closest('[data-task]');
        var task_id = $task.attr('data-task');

        var formData = new FormData();
        formData.set('action', 'aireno_mark_task_completed');
        formData.set('task_id', task_id);
        formData.set('project_id', aireno_project.project_id);

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
                    text: "Something went wrong. Please try again!",
                    icon: "error",
                    buttonsStyling: !1,
                    confirmButtonText: "OK",
                    customClass: {confirmButton: "btn btn-primary"}
                });
            },
            success: function (result) {
                blockUI.release();
                if (result.status) {
                    $(obj).attr('disabled', 'disabled');
                } else {
                    Swal.fire({
                        text: result.msg,
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "OK",
                        customClass: {confirmButton: "btn btn-primary"}
                    });
                }
            }
        });
    };
    return {
        init: function (view) {
            !function (kt_drawer_task) {
                if (kt_drawer_task) {
                    KTUtil.on(kt_drawer_task, '[data-kt-element="input"]', "keydown", (function (event) {
                        if (13 == event.keyCode) return addTask(kt_drawer_task);
                    }));
                    KTUtil.on(kt_drawer_task, '[data-kt-element="save"]', "click", (function (event) {
                        addTask(kt_drawer_task);
                    }));
                    KTUtil.on(kt_drawer_task, '[data-kt-element="cancel"]', "click", (function (event) {
                        resetTaskFields(kt_drawer_task);
                    }));
                    KTUtil.on(kt_drawer_task, '[data-task-delete="true"]', "click", (function (event) {
                        deleteTask(this);
                    }));
                    KTUtil.on(kt_drawer_task, '[data-task-edit="true"]', "click", (function (event) {
                        fillTask(kt_drawer_task, this);
                    }));
                    KTUtil.on(kt_drawer_task, '[data-kt-element="complete"]', "click", (function (event) {
                        completeTask(this);
                    }));
                }
            }(view)
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTAppTask.init(document.querySelector("#kt_tasks_card_collapsible"));
}));


var KTAppNote = function () {
    var addNote = function (noteMessenger) {
        var notes = noteMessenger.querySelector('[data-kt-element="notes"]'),
            note = noteMessenger.querySelector('[data-kt-element="input"]');
        var viewer = noteMessenger.querySelector('[data-kt-element="viewer"]');

        var note_val = note.value;
        var viewer_val = viewer.value;
        if (0 !== note.value.length) {

            var formData = new FormData();

            formData.set('project_id', aireno_project.project_id);
            formData.set('action', 'aireno_add_note_of_project');
            formData.set('note', note.value);
            formData.set('viewer', viewer.value);
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
                        text: "Something went wrong. Please try again!",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "OK",
                        customClass: {confirmButton: "btn btn-primary"}
                    });
                },
                success: function (result) {
                    blockUI.release();
                    if (result.status) {
                        var cloneOut, template = notes.querySelector('[data-kt-element="template-in"]');
                        (cloneOut = template.cloneNode(!0)).classList.remove("d-none");
                        var $cloneOut = $(cloneOut);
                        $cloneOut.removeAttr('data-kt-element');

                        $cloneOut.find('[data-kt-element="message-text"] .text-content').html(result.content);
                        $cloneOut.find('[data-kt-element="note_avatar"]').attr('src', aireno_project.user_avatar_url);
                        $cloneOut.find('[data-kt-element="note_name"]').html(aireno_project.user_display_name);
                        $cloneOut.find('[data-kt-element="note_datetime"]').html(moment().format('MMM DD YYYY, h:mm'));
                        $cloneOut.find('[data-kt-element="note_viewer"]').val(viewer_val);

                        notes.appendChild(cloneOut);
                        notes.scrollTop = notes.scrollHeight;
                        $cloneOut.attr('data-note', result.note_id);
                        $('#kt_notes_header .notes_count').html(parseInt($('#kt_notes_header .notes_count').html()) + 1);
                    } else {
                        Swal.fire({
                            text: "Add Note Failed!",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "OK",
                            customClass: {confirmButton: "btn btn-primary"}
                        });
                    }
                }
            });

            note.value = "";
            viewer.value = "all";
        }
    };
    var fillNote = function (obj) {
        $('#kt_notes_footer .kt_drawer_note_sender').addClass('d-none');
        $('#kt_notes_footer .kt_drawer_note_editor').removeClass('d-none');
        var $note = $(obj).closest('[data-note]');
        var note_id = $note.attr('data-note');
        var note_content = $note.find('[data-kt-element=message-text] .text-content').html();
        note_content = note_content.replace(/(<([^>]+)>)/gi, "");
        var note_viewer = $note.find('[data-kt-element="note_viewer"]').val();

        $('#kt_notes_footer .kt_drawer_note_editor [data-kt-element=input]').val(note_content);
        $('#kt_notes_footer .kt_drawer_note_editor [data-kt-element=note_edit_id]').val(note_id);
        $('#kt_notes_footer .kt_drawer_note_editor [data-kt-element="viewer"]').val(note_viewer);
    };
    var deleteNote = function (obj) {
        var $note = $(obj).closest('[data-note]');
        var note_id = $note.attr('data-note');

        Swal.fire({
            text: "Are you sure delete this note?",
            icon: "info",
            buttonsStyling: !1,
            confirmButtonText: "Yes",
            customClass: {confirmButton: "btn btn-primary"}
        }).then((function (t) {
            if (t.isConfirmed) {
                blockUI.block();
                var formData = new FormData();

                // formData.set('project_id', aireno_project.project_id);
                formData.set('action', 'aireno_remove_note_of_project');
                formData.set('note_id', note_id);

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
                            text: "Something went wrong. Please try again!",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "OK",
                            customClass: {confirmButton: "btn btn-primary"}
                        });
                    },
                    success: function (result) {
                        blockUI.release();
                        if (result.status) {
                            $note.remove();
                            $('#kt_notes_header .notes_count').html(parseInt($('#kt_notes_header .notes_count').html()) - 1);
                        } else {
                            Swal.fire({
                                text: "The note is already deleted",
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "OK",
                                customClass: {confirmButton: "btn btn-primary"}
                            });
                        }
                    }
                });
            }

        }))
    };
    var saveNote = function () {
        var note_content = $('#kt_notes_footer .kt_drawer_note_editor [data-kt-element=input]').val();
        var note_id = $('#kt_notes_footer .kt_drawer_note_editor [data-kt-element=note_edit_id]').val();
        var viewer = $('#kt_notes_footer .kt_drawer_note_editor [data-kt-element="viewer"]').val();
        if (note_content.length && note_id) {
            blockUI.block();
            var formData = new FormData();

            formData.set('project_id', aireno_project.project_id);
            formData.set('action', 'aireno_edit_note_of_project');
            formData.set('note_id', note_id);
            formData.set('note_content', note_content);
            formData.set('viewer', viewer);

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
                        text: "Something went wrong. Please try again!",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "OK",
                        customClass: {confirmButton: "btn btn-primary"}
                    });
                },
                success: function (result) {
                    blockUI.release();
                    if (result.status) {
                        var $note = $('[data-note="' + note_id + '"]');
                        $note.find('[data-kt-element="message-text"] .text-content').html(result.content);
                        $note.find('[data-kt-element="note_viewer"]').val(viewer);
                    } else {
                        Swal.fire({
                            text: result.msg,
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "OK",
                            customClass: {confirmButton: "btn btn-primary"}
                        });
                    }
                    cancelNote();
                }
            });
        } else {
            Swal.fire({
                text: "Type note content!",
                icon: "error",
                buttonsStyling: !1,
                confirmButtonText: "OK",
                customClass: {confirmButton: "btn btn-primary"}
            });
        }
    };
    var cancelNote = function () {
        $('#kt_notes_footer .kt_drawer_note_sender').removeClass('d-none');
        $('#kt_notes_footer .kt_drawer_note_editor').addClass('d-none');

        $('#kt_notes_footer .kt_drawer_note_editor [data-kt-element=input]').val('');
        $('#kt_notes_footer .kt_drawer_note_editor [data-kt-element=note_edit_id]').val('');
        $('#kt_notes_footer .kt_drawer_note_editor [data-kt-element="viewer"]').val('all');
    };
    return {
        init: function (messenger) {
            !function (noteMessenger) {
                if (noteMessenger) {
                    KTUtil.on(noteMessenger, '[data-kt-element="input"]', "keydown", (function (event) {
                        if (13 == event.keyCode) return addNote(noteMessenger), event.preventDefault(), !1
                    }));
                    KTUtil.on(noteMessenger, '[data-kt-element="send"]', "click", (function (e) {
                        addNote(noteMessenger)
                    }));
                    KTUtil.on(noteMessenger, '[data-note-edit=true]', "click", (function (e) {
                        $('#kt_notes_footer').collapse('show');
                        fillNote(this);
                    }));
                    KTUtil.on(noteMessenger, '[data-note-delete=true]', "click", (function (e) {
                        deleteNote(this);
                    }));
                    KTUtil.on(noteMessenger, '[data-kt-element="save_note"]', "click", (function (e) {
                        saveNote();
                    }));
                    KTUtil.on(noteMessenger, '[data-kt-element="cancel_note"]', "click", (function (e) {
                        cancelNote();
                    }));
                }
            }(messenger)
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTAppNote.init(document.querySelector("#kt_notes_card_collapsible"));
}));


//load schedule templates modal
var KTModalLoadScheduleTemplates = function () {
    var btnSubmit, btnCancel, validator, modalForm, bsmodal, ptModal;
    return {
        init: function () {
            (ptModal = document.querySelector("#kt_modal_load_schedules")) && (bsmodal = new bootstrap.Modal(ptModal), modalForm = document.querySelector("#kt_modal_load_schedules_form"), btnSubmit = document.getElementById("kt_modal_load_schedules_submit"), btnCancel = document.getElementById("kt_modal_load_schedules_cancel"), validator = FormValidation.formValidation(modalForm, {
                fields: {
                    "st-template": {validators: {notEmpty: {message: "Choose a schedule template"}}},
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            }), btnSubmit.addEventListener("click", (function (e) {
                e.preventDefault(), validator && validator.validate().then((function (e) {
                    if ("Valid" == e) {
                        Swal.fire({
                            text: "All current schedules settings will be lost! Are you sure you want to load template?",
                            icon: "info",
                            buttonsStyling: !1,
                            confirmButtonText: "OK",
                            customClass: {confirmButton: "btn btn-primary"}
                        }).then((function (t) {
                            btnSubmit.setAttribute("data-kt-indicator", "on");
                            btnSubmit.disabled = !0;
                            blockUI.block();
                            setTimeout((function () {
                                var formData = new FormData();
                                formData.set('action', 'aireno_load_schedules_from_template');
                                formData.set('project_id', aireno_project.project_id);
                                formData.set('st_ID', $('#kt_modal_load_schedules_form [name=st-template]').val());
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
                                        btnSubmit.removeAttribute("data-kt-indicator");
                                        btnSubmit.disabled = !1;
                                        Swal.fire({
                                            text: "Something went wrong. Please try again!",
                                            icon: "error",
                                            buttonsStyling: !1,
                                            confirmButtonText: "OK",
                                            customClass: {confirmButton: "btn btn-primary"}
                                        }).then((function (t) {
                                            t.isConfirmed && bsmodal.hide()
                                        }))
                                    },
                                    success: function (result) {
                                        blockUI.release();
                                        btnSubmit.removeAttribute("data-kt-indicator");
                                        btnSubmit.disabled = !1;
                                        if (result.status) reloadOnCurrentTab();
                                    }
                                });
                            }), 2e3);
                        }))

                    } else {
                        Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "OK",
                            customClass: {confirmButton: "btn btn-primary"}
                        })
                    }
                }))
            })), btnCancel.addEventListener("click", (function (t) {
                t.preventDefault(), bsmodal.hide()
            })))
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTModalLoadScheduleTemplates.init()
}));


var btnContractorReminder = document.querySelector(".btn-contractor-reminder-project");
// var btnSendFollow = document.querySelector(".btn-send-follow-project");
var blockTarget = document.querySelector("body");

var blockUI = new KTBlockUI(blockTarget, {
    message: '<div class="blockui-message"><span class="spinner-border text-primary"></span> Processing...</div>',
    overlayClass: "bg-info bg-opacity-25"
});

//New Schedule Form
var KTModalNewSchedule = function () {
    var submitSchedule, cancelSchedule, validator, scheduleForm, modal, scheduleModal, btnAddTask, btnRemoveTask;
    return {
        init: function () {
            (scheduleModal = document.querySelector("#kt_modal_new_schedule")) &&
            (modal = new bootstrap.Modal(scheduleModal),
                    scheduleForm = scheduleModal.querySelector("#kt_modal_new_schedule_form"),
                    submitSchedule = scheduleModal.querySelector("#kt_modal_new_schedule_submit"),
                    cancelSchedule = scheduleModal.querySelector("#kt_modal_new_schedule_cancel"),
                    validator = FormValidation.formValidation(scheduleForm, {
                        fields: {
                            schedule_title: {validators: {notEmpty: {message: "Title is required"}}},
                            schedule_duration: {validators: {notEmpty: {message: "Duration is required"}}},
                            schedule_details: {validators: {notEmpty: {message: "Details is required"}}},
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger,
                            bootstrap: new FormValidation.plugins.Bootstrap5({
                                rowSelector: ".fv-row",
                                eleInvalidClass: "",
                                eleValidClass: ""
                            })
                        }
                    }),
                    $('body').on('click', '[data-kt-element="schedule-remove-task"]', function (e) {
                        var $schedule_tasks = $(this).closest('.schedule-tasks');
                        $(this).closest('.schedule-task').remove();
                        $schedule_tasks.find('.schedule-task').each(function (index, obj) {
                            $(obj).find('[type=checkbox]').attr('name', 'schedule_tasks_completed' + (index - 1));
                        });
                    }),
                    $('body').on('click', '[data-kt-element="schedule-add-task"]', function (e) {
                        var clone, template = scheduleModal.querySelector('[data-kt-element="schedule-task-template"]');
                        (clone = template.cloneNode(!0)).classList.remove("d-none");
                        clone.removeAttribute('data-kt-element');
                        $(clone).find('[type=text]').attr('name', 'schedule_tasks[]');
                        $(clone).find('[type=checkbox]').attr('name', 'schedule_tasks_completed' + parseInt($(this).closest('.schedule-tasks').find('.schedule-task:not(d-none)').length - 1));
                        $(this).closest('.schedule-tasks').append($(clone));
                    }),
                    submitSchedule.addEventListener("click", (function (e) {
                        e.preventDefault(), validator && validator.validate().then((function (e) {
                            if ("Valid" == e) {
                                submitSchedule.setAttribute("data-kt-indicator", "on");
                                submitSchedule.disabled = !0;
                                var formData = new FormData(scheduleForm);
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
                                        modal.hide();
                                        Swal.fire({
                                            text: "Something went wrong. Please try again!",
                                            icon: "error",
                                            buttonsStyling: !1,
                                            confirmButtonText: "OK",
                                            customClass: {confirmButton: "btn btn-primary"}
                                        });
                                    },
                                    success: function (result) {
                                        blockUI.release();
                                        resetScheduleModal();
                                        submitSchedule.removeAttribute("data-kt-indicator");
                                        submitSchedule.disabled = !1;
                                        modal.hide();
                                        if (!result.status) {
                                            Swal.fire({
                                                text: "Something went wrong!",
                                                icon: "error",
                                                buttonsStyling: !1,
                                                confirmButtonText: "OK",
                                                customClass: {confirmButton: "btn btn-primary"}
                                            });
                                        } else {
                                            if (result.is_new) {
                                                reloadOnCurrentTab();
                                                // var schedule_clone;
                                                // var schedule_template = document.querySelector('[data-kt-element="schedule-template"]');
                                                // (schedule_clone = schedule_template.cloneNode(!0)).classList.remove("d-none");
                                                // $(schedule_clone).find('[data-kt-element="duration"]').html(result.duration);
                                                // $(schedule_clone).find('[data-kt-element="title"]').html(result.title);
                                                // $(schedule_clone).find('[data-kt-element="content"]').html(result.detail);
                                                // $(schedule_clone).attr('data-kt-element', 'schedule');
                                                //
                                                // $(schedule_clone).find('[data-kt-element="status"] option:selected').removeAttr('selected');
                                                // $(schedule_clone).find('[data-kt-element="status"] option[value="' + result.schedule_status + '"]').attr('selected', 'selected');
                                                // $(schedule_clone).find('[data-kt-element="status"]').val(result.schedule_status);
                                                //
                                                // $(schedule_clone).find('[data-kt-menu="true"]').attr('id', 'kt_schedule_menu_' + result.id);
                                                //
                                                // $(schedule_clone).find('[data-kt-element="trigger_attachments"]').attr('data-bs-target', '#kt_schedule_' + result.id + '_attachments_collapsible');
                                                // $(schedule_clone).find('[data-kt-element="trigger_comments"]').attr('data-bs-target', '#kt_schedule_' + result.id + '_comments_collapsible');
                                                //
                                                // $(schedule_clone).find('[data-kt-element="attachments_collapsible"]').attr('id', 'kt_schedule_' + result.id + '_attachments_collapsible');
                                                // $(schedule_clone).find('[data-kt-element="attachments_collapsible_body"]').attr('id', 'kt_schedule_' + result.id + '_attachments_body');
                                                // $(schedule_clone).find('[data-kt-element="schedule_attachments"]').attr('data-kt-scroll-dependencies', '#kt_schedule_' + result.id + '_attachments_footer');
                                                // $(schedule_clone).find('[data-kt-element="schedule_attachments"]').attr('data-kt-scroll-wrappers', '#kt_schedule_' + result.id + '_attachments_body');
                                                // $(schedule_clone).find('[data-kt-element="schedule_attachments_footer"]').attr('id', 'kt_schedule_' + result.id + '_attachments_footer');
                                                //
                                                // $(schedule_clone).find('[data-kt-element="comments_collapsible"]').attr('id', 'kt_schedule_' + result.id + '_comments_collapsible');
                                                // $(schedule_clone).find('[data-kt-element="comments_collapsible_body"]').attr('id', 'kt_schedule_' + result.id + '_comments_body');
                                                // $(schedule_clone).find('[data-kt-element="schedule_comments"]').attr('data-kt-scroll-dependencies', '#kt_schedule_' + result.id + '_comments_footer');
                                                // $(schedule_clone).find('[data-kt-element="schedule_comments"]').attr('data-kt-scroll-wrappers', '#kt_schedule_' + result.id + '_comments_body');
                                                // $(schedule_clone).find('[data-kt-element="comments_collapsible_footer"]').attr('id', 'kt_schedule_' + result.id + '_comments_footer');
                                                //
                                                // $(schedule_clone).find('[data-kt-element="tasks"] [data-kt-element="task"]').remove();
                                                // var schedule_task_template = $(schedule_clone).find('[data-kt-element="task-template"]');
                                                // for (var i = 0; i < result.tasks.length; i ++) {
                                                //     var task = result.tasks[i];
                                                //     var schedule_task_clone = schedule_task_template.clone();
                                                //     schedule_task_clone.removeClass('d-none').removeAttr('data-kt-element').attr('data-kt-element', 'task');
                                                //     schedule_task_clone.find('input[data-kt-element="task-completed"]').val(i);
                                                //     if (task.done) schedule_task_clone.find('input[data-kt-element="task-completed"]').attr('checked', 'checked').attr('disabled', 'disabled');
                                                //     schedule_task_clone.find('[data-kt-element="task-title"]').html(task.title);
                                                //     $(schedule_clone).find('[data-kt-element="tasks"]').append(schedule_task_clone);
                                                // }
                                                // switch (parseInt(result.schedule_status)) {
                                                //     case 0:
                                                //         $(schedule_clone).appendTo($('.schedules > div').eq(0));
                                                //         $('.schedules > div').eq(0).find('[data-kt-element="schedules-count"]').html(parseInt($('.schedules > div').eq(0).find('[data-kt-element="schedules-count"]').html()) + 1);
                                                //         break;
                                                //     case 1:
                                                //         $(schedule_clone).appendTo($('.schedules > div').eq(1));
                                                //         $('.schedules > div').eq(0).find('[data-kt-element="schedules-count"]').html(parseInt($('.schedules > div').eq(1).find('[data-kt-element="schedules-count"]').html()) + 1);
                                                //         break;
                                                //     case 2:
                                                //         $(schedule_clone).appendTo($('.schedules > div').eq(2));
                                                //         $('.schedules > div').eq(0).find('[data-kt-element="schedules-count"]').html(parseInt($('.schedules > div').eq(2).find('[data-kt-element="schedules-count"]').html()) + 1);
                                                //         break;
                                                //     default:
                                                //         break;
                                                // }
                                            } else {
                                                var schedule_element = $('[data-schedule-id=' + result.id + ']');
                                                var editted_working_days = parseInt($('[data-kt-element="total-working-days"]').html()) - parseInt(schedule_element.find('[data-kt-element="duration"]').html()) + parseInt(result.duration);
                                                $('[data-kt-element="total-working-days"]').html(editted_working_days);
                                                console.log(editted_working_days)
                                                if(editted_working_days === 0) {
                                                    $('#project-total-days').remove();
                                                }
                                                schedule_element.find('[data-kt-element="duration"]').html(result.duration);
                                                schedule_element.find('[data-kt-element="title"]').html(result.title);
                                                schedule_element.find('[data-kt-element="content"]').html(result.detail);

                                                schedule_element.find('[data-kt-element="status"] option:selected').removeAttr('selected');
                                                schedule_element.find('[data-kt-element="status"] option[value="' + result.schedule_status + '"]').attr('selected', 'selected');
                                                schedule_element.find('[data-kt-element="status"]').val(result.schedule_status);

                                                schedule_element.find('[data-kt-element="tasks"] [data-kt-element="task"]').remove();
                                                var schedule_task_template = schedule_element.find('[data-kt-element="task-template"]');
                                                for (var i = 0; i < result.tasks.length; i++) {
                                                    var task = result.tasks[i];
                                                    var schedule_task_clone = schedule_task_template.clone();
                                                    schedule_task_clone.removeClass('d-none').removeAttr('data-kt-element').attr('data-kt-element', 'task');
                                                    schedule_task_clone.find('input[data-kt-element="task-completed"]').val(i);
                                                    if (task.done) schedule_task_clone.find('input[data-kt-element="task-completed"]').attr('checked', 'checked').attr('disabled', 'disabled');
                                                    schedule_task_clone.find('[data-kt-element="task-title"]').html(task.title);
                                                    schedule_element.find('[data-kt-element="tasks"]').append(schedule_task_clone);
                                                }
                                                if (result.origin_status != result.schedule_status) {
                                                    $('.schedules > div').eq(parseInt(result.origin_status)).find('[data-kt-element="schedules-count"]').html(parseInt($('.schedules > div').eq(parseInt(result.origin_status)).find('[data-kt-element="schedules-count"]').html()) - 1);
                                                    switch (parseInt(result.schedule_status)) {
                                                        case 0:
                                                            schedule_element.appendTo($('.schedules > div').eq(0));
                                                            $('.schedules > div').eq(0).find('[data-kt-element="schedules-count"]').html(parseInt($('.schedules > div').eq(0).find('[data-kt-element="schedules-count"]').html()) + 1);
                                                            break;
                                                        case 1:
                                                            schedule_element.appendTo($('.schedules > div').eq(1));
                                                            $('.schedules > div').eq(1).find('[data-kt-element="schedules-count"]').html(parseInt($('.schedules > div').eq(1).find('[data-kt-element="schedules-count"]').html()) + 1);
                                                            break;
                                                        case 2:
                                                            schedule_element.appendTo($('.schedules > div').eq(2));
                                                            $('.schedules > div').eq(2).find('[data-kt-element="schedules-count"]').html(parseInt($('.schedules > div').eq(2).find('[data-kt-element="schedules-count"]').html()) + 1);
                                                            break;
                                                        default:
                                                            break;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                })
                            } else
                                Swal.fire({
                                    text: "Sorry, please fill all fields and try again.",
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {confirmButton: "btn btn-primary"}
                                });
                        }))
                    })),
                    cancelSchedule.addEventListener("click", (function (t) {
                        scheduleForm.reset(), modal.hide();
                    }))
            )
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTModalNewSchedule.init()
}));

$('body').on('click', '#btnCreateSchedule', function () {
    resetScheduleModal();
    $('#kt_modal_new_schedule').modal('show');
})
var resetScheduleModal = function () {
    $('#kt_modal_new_schedule [name=schedule_id]').val('');
    $('#kt_modal_new_schedule [name=schedule_title]').val('');
    $('#kt_modal_new_schedule [name=schedule_duration]').val('');
    $('#kt_modal_new_schedule [name=schedule_details]').val('');
    $('#kt_modal_new_schedule [name=schedule_status]').val(0);
    $('#kt_modal_new_schedule .schedule-task > input[type=text]').val('');
    $('#kt_modal_new_schedule .schedule-task > input[type=checkbox]').prop('checked', false);
    $('#kt_modal_new_schedule .schedule-tasks .schedule-task:not(.d-none):not(:nth-child(2))').remove();
}


var global_message_files = [];
var allowedFileTypes = [
    'image/png',
    'image/jpeg',
    'image/jpg',
    'image/bmp',
    'image/jpe',
    'image/gif',
    'image/ico',
    'image/svg',
    'image/svgz',
    'image/tif',
    'image/tiff',
    'image/ai',
    'image/drw',
    'image/pct',
    'image/psp',
    'image/xcf',
    'image/psd',
    'image/raw',
    'image/webp',
    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    'application/vnd.ms-excel',
    'text/plain',
    'application/pdf',
    'application/msword',
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
];

var KTAppChat = function () {
    var sendMessage = function (messenger) {
        var messages = messenger.querySelector('[data-kt-element="messages"]'),
            msgField = messenger.querySelector('[data-kt-element="input"]');
        var fileField = messenger.querySelector('#kt_message_file');

        var files = fileField.files;
        var message = msgField.value;
        var attachfiles = [];

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            if (allowedFileTypes.includes(file.type)) {
                attachfiles.push(file);
            }
        }

        if (0 !== message.length || attachfiles.length > 0) {
            var formData = new FormData();

            formData.set('project_id', aireno_project.project_id);
            formData.set('action', 'aireno_send_message');
            formData.set('message', message);

            for (var i = 0; i < attachfiles.length; i++) {
                var file = attachfiles[i];
                if (allowedFileTypes.includes(file.type)) {
                    formData.append('files[]', file);
                }
            }
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
                        text: "Something went wrong. Please try again!",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "OK",
                        customClass: {confirmButton: "btn btn-primary"}
                    });
                },
                success: function (result) {
                    blockUI.release();
                    if (!result.status) {
                        Swal.fire({
                            text: "Sending message Failed!",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "OK",
                            customClass: {confirmButton: "btn btn-primary"}
                        });
                    } else {
                        if (result.attachments.length > 0) {
                            reloadOnCurrentTab();
                        } else {
                            var oClone, oTemplate = messages.querySelector('[data-kt-element="template-out"]');
                            (oClone = oTemplate.cloneNode(!0)).classList.remove("d-none");
                            oClone.removeAttribute('data-kt-element');
                            $(oClone).find('[data-kt-element="message-text"]').html(result.message).removeClass('mb-3');
                            if (message.length == 0) $(oClone).find('[data-kt-element="message-text"]').addClass('d-none');

                            oClone.querySelector('[data-kt-element="message_avatar"]').setAttribute('src', aireno_project.user_avatar_url);
                            // oClone.querySelector('[data-kt-element="message_name"]').innerHTML = aireno_project.user_display_name;
                            oClone.querySelector('[data-kt-element="message_datetime"]').innerHTML = moment().format('MMM DD YYYY HH:mm');

                            // if (result.attachments.length > 0) {
                            //     var imgContainer = oClone.querySelector('[data-kt-element="message-attachments"]');
                            //     var previewTemplate = oClone.querySelector('[data-kt-element="message-attachment-preview"]');
                            //     var downloadTemplate = oClone.querySelector('[data-kt-element="message-attachment-download"]');
                            //     for (var i = 0; i < result.attachments.length; i++) {
                            //         var attachment = result.attachments[i];
                            //         if (attachment.preview) {
                            //             var previewClone = previewTemplate.cloneNode(!0);
                            //             $(previewClone).removeClass('d-none');
                            //             previewClone.removeAttribute('data-kt-element');
                            //             previewClone.setAttribute('href', attachment.url);
                            //             $(previewClone).find('>div.overlay-wrapper').css('background-image', 'url(' + attachment.url + ')');
                            //             $(previewClone).find('>div.overlay-wrapper> img').attr('src', attachment.url).attr('alt', attachment.title);
                            //             imgContainer.appendChild(previewClone);
                            //         } else {
                            //             var downloadClone = downloadTemplate.cloneNode(!0);
                            //             $(downloadClone).removeClass('d-none');
                            //             downloadClone.removeAttribute('data-kt-element');
                            //             $(downloadClone).find('>a').attr('src', attachment.url).html(attachment.title);
                            //             imgContainer.appendChild(downloadClone);
                            //         }
                            //     }
                            // }
                            messages.appendChild(oClone);
                            messages.scrollTop = messages.scrollHeight;
                        }
                    }
                }
            });

        }
        msgField.value = "";
        fileField.value = "";
        resetPreview();
    };
    var previewFiles = function (files) {
        resetPreview();
        var messenger = document.querySelector("#kt_chat_messenger");
        var previewTemplate = messenger.querySelector('[data-kt-element="preview-template"]');
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            if (allowedFileTypes.includes(file.type)) {
                var clone = previewTemplate.cloneNode(!0);
                clone.classList.remove("d-none");
                if (file && isImage(file)) {
                    $(clone).find("img").attr('src', URL.createObjectURL(file));
                } else {
                    $(clone).find("img").addClass('d-none');
                    $(clone).find(".for-img").removeClass('d-none');
                }
                $(clone).find('.img-title').html(file.name);
                $(clone).find('.img-size').html(parseInt(file.size / 1024) + 'KB');
                $(clone).find('.ai-remove').attr('data-file-id', i);
                messenger.querySelector('[data-kt-element="kt_chat_previews"]').appendChild(clone);
            }

        }
    };
    var isImage = function (file) {
        return file && file['type'].split('/')[0] === 'image';
    }
    var resetPreview = function () {
        var messenger = document.querySelector("#kt_chat_messenger");
        $(messenger).find('[data-kt-element="kt_chat_previews"] [data-kt-element="preview-template"]:not(.d-none)').remove();
    };
    return {
        init: function (messenger) {
            !function (chatMessenger) {
                if (chatMessenger) {
                    KTUtil.on(chatMessenger, '[data-kt-element="input"]', "keydown", (function (event) {
                        if (13 == event.keyCode) return sendMessage(chatMessenger), event.preventDefault(), !1
                    }));
                    KTUtil.on(chatMessenger, '[data-kt-element="send"]', "click", (function (n) {
                        sendMessage(chatMessenger)
                    }));
                    KTUtil.on(chatMessenger, '#kt_message_file_trigger', "click", (function (n) {
                        $('#kt_message_file').trigger('click');
                    }));
                    KTUtil.on(chatMessenger, '#kt_message_file', "change", (function (n) {
                        previewFiles(this.files);
                    }));
                    KTUtil.on(chatMessenger, '.ai-remove', "click", (function (n) {
                        var file_id = $(this).attr('data-file-id');
                        $(this).closest('[data-kt-element="preview-template"]').remove();
                    }));
                    var messages = chatMessenger.querySelector('[data-kt-element="messages"]');
                    messages.scrollTop = messages.scrollHeight;
                }
            }(messenger)
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTAppChat.init(document.querySelector("#kt_chat_messenger"))
}));

$('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
    var chatMessenger = document.querySelector("#kt_chat_messenger");
    var messages = chatMessenger.querySelector('[data-kt-element="messages"]');
    messages.scrollTop = messages.scrollHeight;
});


/**
 * Start Manage Schedules
 * @param scheduler
 */
var global_upload_files = [];
var fillSchedule = function (scheduler) {
    resetScheduleModal();
    var title = scheduler.find('[data-kt-element="title"]').html();
    var duration = scheduler.find('[data-kt-element="duration"]').html();
    var details = scheduler.find('[data-kt-element="content"]').html();
    var status = scheduler.find('[data-kt-element="status"]').val()

    var tasks = [];
    var completes = [];

    $('#kt_modal_new_schedule [name=schedule_id]').val(scheduler.data('schedule-id'));
    $('#kt_modal_new_schedule [name=schedule_title]').val(title);
    $('#kt_modal_new_schedule [name=schedule_duration]').val(duration);
    $('#kt_modal_new_schedule [name=schedule_details]').val(details);
    $('#kt_modal_new_schedule [name=schedule_status]').val(status);

    scheduler.find('[data-kt-element="tasks"] [data-kt-element="task"]').each(function (index, obj) {
        var completed = $(obj).find('[data-kt-element="task-completed"]').prop('checked');
        var task_title = $(obj).find('[data-kt-element="task-title"]').html();
        tasks.push(task_title);
        completes.push(completed);
    });

    if (tasks.length > 0) {
        $('#kt_modal_new_schedule .schedule-tasks .schedule-task:not(.d-none)').remove();
        for (var i = 0; i < tasks.length; i++) {
            var clone, template = $('#kt_modal_new_schedule [data-kt-element="schedule-task-template"]');
            clone = template.clone().removeClass('d-none').removeAttr('data-kt-element');
            clone.find('[type=text]').val(tasks[i]);
            if (completes[i]) clone.find('[type=checkbox]').prop('checked', true);
            clone.find('[type=text]').attr('name', 'schedule_tasks[]');
            clone.find('[type=checkbox]').attr('name', 'schedule_tasks_completed' + i);
            $('#kt_modal_new_schedule .schedule-tasks').append(clone);
        }
    }
}
var sendComment = function (scheduler) {
    var comments = scheduler.find('[data-kt-element="schedule_comments"]'),
        commentField = scheduler.find('[data-kt-element="input"]');

    var comment = commentField.val();

    if (0 !== comment.length) {
        var formData = new FormData();

        formData.set('project_id', aireno_project.project_id);
        formData.set('action', 'aireno_send_comment_schedule');
        formData.set('schedule_id', scheduler.data('schedule-id'));
        formData.set('comment', comment);

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
                    text: "Something went wrong. Please try again!",
                    icon: "error",
                    buttonsStyling: !1,
                    confirmButtonText: "OK",
                    customClass: {confirmButton: "btn btn-primary"}
                });
            },
            success: function (result) {
                blockUI.release();
                if (!result.status) {
                    Swal.fire({
                        text: "Commenting Failed!",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "OK",
                        customClass: {confirmButton: "btn btn-primary"}
                    });
                } else {
                    var oClone, oTemplate = comments.find('[data-kt-element="schedule-comment-template"]');
                    oClone = oTemplate.clone().removeClass("d-none");
                    oClone.removeAttr('data-kt-element');
                    oClone.find('[data-kt-element="content"]').html(result.comment);

                    oClone.find('[data-kt-element="avatar"]').attr('src', result.avatar);
                    oClone.find('[data-kt-element="author"]').html(result.author);
                    oClone.find('[data-kt-element="datetime"]').html(result.datetime);

                    comments.append(oClone);

                    scheduler.find('[data-kt-element="comments-count"]').html(parseInt(scheduler.find('[data-kt-element="comments-count"]').html()) + 1);
                }
            }
        });

        commentField.val("");
    }

};

var uploadAttachments = function ($schedule) {

    var schedule_id = parseInt($schedule.data('schedule-id'));

    if (global_upload_files[schedule_id].length > 0) {
        var formData = new FormData();

        formData.set('project_id', aireno_project.project_id);
        formData.set('schedule_id', $schedule.data('schedule-id'));
        formData.set('action', 'aireno_attach_files_schedule');
        formData.set('type', $schedule.find('[name=type]').val());

        for (var i = 0; i < global_upload_files[schedule_id].length; i++) {
            var afile = global_upload_files[schedule_id][i];
            formData.append('files[]', afile);
        }
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
                    text: "Something went wrong. Please try again!",
                    icon: "error",
                    buttonsStyling: !1,
                    confirmButtonText: "OK",
                    customClass: {confirmButton: "btn btn-primary"}
                });
            },
            success: function (result) {
                blockUI.release();
                if (!result.status) {
                    Swal.fire({
                        text: "File uploading Failed!",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "OK",
                        customClass: {confirmButton: "btn btn-primary"}
                    });
                } else {
                    reloadOnCurrentTab();
                }
            }
        });
    }
    resetSchedulePreview($schedule);
};
var attachFiles = function ($schedule, files) {
    // resetSchedulePreview($schedule);
    var schedule_id = parseInt($schedule.data('schedule-id'));
    var file = files[0];
    var being_files = file.files;

    if (!Array.isArray(global_upload_files[schedule_id])) global_upload_files[schedule_id] = [];
    var previewTemplate = $schedule.find('[data-kt-element="preview-template"]');

    for (var i = 0; i < being_files.length; i++) {
        var being_file = being_files[i];
        if (allowedFileTypes.includes(being_file.type) && !(isFileIncluded(global_upload_files[schedule_id], being_file))) {
            global_upload_files[schedule_id].push(being_file);
            var $clone = previewTemplate.clone();
            $clone.removeClass("d-none").removeAttr('data-kt-element');
            if (being_file && isImage(being_file)) {
                $clone.find("img").attr('src', URL.createObjectURL(being_file));
            } else {
                $clone.find("img").addClass('d-none');
                $clone.find(".for-img").removeClass('d-none');
            }
            $clone.find('.img-title').html(being_file.name);
            $clone.find('.img-size').html(parseInt(being_file.size / 1024) + 'KB');
            $clone.find('.ai-remove').attr('data-file-id', global_upload_files[schedule_id].indexOf(being_file));
            $schedule.find('[data-kt-element="kt_schedule_attachment_previews"]').append($clone);
        }
    }
    if (global_upload_files[schedule_id].length > 0) $schedule.find('[data-kt-element="kt_schedule_upload_button"]').removeClass('d-none');
    else $schedule.find('[data-kt-element="kt_schedule_upload_button"]').addClass('d-none');
};
var isImage = function (file) {
    return file && file['type'].split('/')[0] === 'image';
}
var isFileIncluded = function (arr, ele) {
    var result = false;
    for (var i in arr) {
        var file = arr[i];
        if (file.type == ele.type && file.name == ele.name && file.size == ele.size) {
            result = true;
            break;
        }
    }
    return result;
}
var resetSchedulePreview = function ($schedule) {
    var schedule_id = parseInt($schedule.data('schedule-id'));
    $schedule.find('[data-kt-element="kt_schedule_upload_button"]').addClass('d-none');
    global_upload_files[schedule_id] = [];
    $schedule.find('[data-kt-element="kt_schedule_attachment_previews"] > div:not(.d-none)').remove();
};

//edit schedule
$('body').on('click', '[data-kt-element="schedule"] [data-kt-element="edit"]', function () {
    fillSchedule($(this).closest('[data-kt-element="schedule"]'));
    $('#kt_modal_new_schedule').modal('show');
});
//delete schedule
$('body').on('click', '[data-kt-element="schedule"] [data-kt-element="delete"]', function () {
    var $schedule = $(this).closest('[data-kt-element="schedule"]');
    Swal.fire({
        text: "Are you sure delete this schedule?",
        icon: "info",
        buttonsStyling: !1,
        confirmButtonText: "Yes",
        customClass: {confirmButton: "btn btn-primary"}
    }).then((function (t) {
        if (t.isConfirmed) {
            
            var formData = new FormData();
            formData.set('action', 'aireno_delete_schedule');
            formData.set('schedule_id', $schedule.data('schedule-id'));
            formData.set('project_id', aireno_project.project_id);
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
                        text: "Something went wrong. Please try again!",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "OK",
                        customClass: {confirmButton: "btn btn-primary"}
                    });
                },
                success: function (result) {
                    blockUI.release();
                    if (!result.status) {
                        Swal.fire({
                            text: "Something went wrong!",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "OK",
                            customClass: {confirmButton: "btn btn-primary"}
                        });
                    } else {
                        var deleted_working_days = parseInt($('[data-kt-element="total-working-days"]').html()) - parseInt($schedule.find('[data-kt-element="duration"]').html());
                        $('[data-kt-element="total-working-days"]').html(deleted_working_days);
                        if(deleted_working_days === 0) {
                            $('#project-total-days').remove();
                        }
                        $schedule.siblings().find('[data-kt-element="schedules-count"]').html(parseInt($schedule.siblings().find('[data-kt-element="schedules-count"]').html()) - 1);
                        $schedule.remove();
                    }
                }
            });
        }
    }));
});
//change status of schedule
$('body').on('change', '[data-kt-element="schedule"] [data-kt-element="status"]', function () {
    var $schedule = $(this).closest('[data-kt-element="schedule"]');
    var formData = new FormData();
    formData.set('action', 'aireno_schedule_change_status');
    formData.set('schedule_id', $schedule.data('schedule-id'));
    formData.set('project_id', aireno_project.project_id);
    formData.set('status', $(this).val());
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
                text: "Something went wrong. Please try again!",
                icon: "error",
                buttonsStyling: !1,
                confirmButtonText: "OK",
                customClass: {confirmButton: "btn btn-primary"}
            });
        },
        success: function (result) {
            blockUI.release();
            if (!result.status) {
                Swal.fire({
                    text: "Something went wrong!",
                    icon: "error",
                    buttonsStyling: !1,
                    confirmButtonText: "OK",
                    customClass: {confirmButton: "btn btn-primary"}
                });
            } else {
                var schedule_element = $('[data-schedule-id=' + result.schedule_id + ']');

                schedule_element.find('[data-kt-element="status"] option:selected').removeAttr('selected');
                schedule_element.find('[data-kt-element="status"] option[value="' + result.schedule_status + '"]').attr('selected', 'selected');
                schedule_element.find('[data-kt-element="status"]').val(result.schedule_status);

                if (result.origin_status != result.schedule_status) {
                    $('.schedules > div').eq(parseInt(result.origin_status)).find('[data-kt-element="schedules-count"]').html(parseInt($('.schedules > div').eq(parseInt(result.origin_status)).find('[data-kt-element="schedules-count"]').html()) - 1);
                    switch (parseInt(result.schedule_status)) {
                        case 0:
                            schedule_element.appendTo($('.schedules > div').eq(0));
                            $('.schedules > div').eq(0).find('[data-kt-element="schedules-count"]').html(parseInt($('.schedules > div').eq(0).find('[data-kt-element="schedules-count"]').html()) + 1);
                            break;
                        case 1:
                            schedule_element.appendTo($('.schedules > div').eq(1));
                            $('.schedules > div').eq(1).find('[data-kt-element="schedules-count"]').html(parseInt($('.schedules > div').eq(1).find('[data-kt-element="schedules-count"]').html()) + 1);
                            break;
                        case 2:
                            schedule_element.appendTo($('.schedules > div').eq(2));
                            $('.schedules > div').eq(2).find('[data-kt-element="schedules-count"]').html(parseInt($('.schedules > div').eq(2).find('[data-kt-element="schedules-count"]').html()) + 1);
                            break;
                        default:
                            break;
                    }
                }
                schedule_element.find('[data-kt-menu="true"]').removeAttr('data-popper-placement').attr('style', '').removeClass('show');
            }
        }
    });
});
//add schedule
$('body').on('keydown', '[data-kt-element="schedule"] [data-kt-element="input"]', function (event) {
    if (13 == event.keyCode) {
        event.preventDefault();
        var $schedule = $(this).closest('[data-kt-element="schedule"]');
        sendComment($schedule);
        $(this).blur();
    }
});
//add schedule
$('body').on('click', '[data-kt-element="schedule"] [data-kt-element="send"]', function (e) {
    e.preventDefault();
    var $schedule = $(this).closest('[data-kt-element="schedule"]');
    sendComment($schedule);
});
//file trigger
$('body').on('click', '[data-kt-element="schedule"] [data-kt-element="schedule_attachments_footer"] > div.filter-trigger', function (e) {
    $(this).siblings('[type=file]').trigger('click');
});
//file chooser
$('body').on('change', '[data-kt-element="schedule"] [data-kt-element="schedule_attachments_footer"] [data-kt-element="file"]', function (e) {
    var $schedule = $(this).closest('[data-kt-element="schedule"]');
    attachFiles($schedule, $(this));
});
//task complete
$('body').on('change', '[data-kt-element="schedule"] [data-kt-element="task-completed"]', function () {
    var $schedule = $(this).closest('[data-kt-element="schedule"]');
    var $task_complete = $(this);
    var formData = new FormData();
    formData.set('action', 'aireno_schedule_task_completed');
    formData.set('schedule_id', $schedule.data('schedule-id'));
    formData.set('project_id', aireno_project.project_id);
    formData.set('task_index', $(this).val());

    if ($(this).prop('checked'))
        Swal.fire({
            text: "Are you sure mark this task as completed?",
            icon: "info",
            buttonsStyling: !1,
            confirmButtonText: "Yes",
            customClass: {confirmButton: "btn btn-primary"}
        }).then((function (t) {
            if (t.isConfirmed) {
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
                            text: "Something went wrong. Please try again!",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "OK",
                            customClass: {confirmButton: "btn btn-primary"}
                        });
                    },
                    success: function (result) {
                        blockUI.release();
                        if (!result.status) {
                            Swal.fire({
                                text: "Something went wrong!",
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "OK",
                                customClass: {confirmButton: "btn btn-primary"}
                            });
                        } else {
                            // reloadOnCurrentTab();
                            $task_complete.attr('disabled', 'disabled');
                        }
                    }
                });
            } else $(this).prop('checked', false);
        }));

});
//remove attached files
$('body').on('click', '[data-kt-element="schedule"] [data-kt-element="schedule_attachments_footer"] .ai-remove', function (e) {
    e.preventDefault();
    var $schedule = $(this).closest('[data-kt-element="schedule"]');
    var schedule_id = parseInt($schedule.data('schedule-id'));

    var file_index = $(this).data('file-id');
    global_upload_files[schedule_id].splice(file_index, 1);

    $(this).parentsUntil('[data-kt-element="kt_schedule_attachment_previews"]').remove();
    $('[data-kt-element="kt_schedule_attachment_previews"] > div:not([data-kt-element="preview-template"])').each(function (index, obj) {
        $(obj).find('.ai-remove').attr('data-file-id', index);
    });
    if (global_upload_files[schedule_id].length > 0) $schedule.find('[data-kt-element="kt_schedule_upload_button"]').removeClass('d-none');
    else $schedule.find('[data-kt-element="kt_schedule_upload_button"]').addClass('d-none');
});
//upload attached files
$('body').on('click', '[data-kt-element="schedule"] [data-kt-element="schedule_attachments_footer"] [data-kt-element="kt_schedule_upload_button"] > a:not(.disabled)', function (e) {
    e.preventDefault();
    var $schedule = $(this).closest('[data-kt-element="schedule"]');
    uploadAttachments($schedule);
});
/**
 * End Manage Schedules
 * @param scheduler
 */

//Contract Reminder Action Handler
if (btnContractorReminder) {
    btnContractorReminder.addEventListener("click", function () {
        blockUI.block();
        var formData = new FormData();
        formData.set('action', 'aireno_contractor_reminder');
        formData.set('project_id', aireno_project.project_id);
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
                    text: "Something went wrong. Please try again!",
                    icon: "error",
                    buttonsStyling: !1,
                    confirmButtonText: "OK",
                    customClass: {confirmButton: "btn btn-primary"}
                });
            },
            success: function (result) {
                blockUI.release();
                if (result.status) {
                    Swal.fire({
                        text: "Contractor Reminder sent!",
                        icon: "success",
                        buttonsStyling: !1,
                        confirmButtonText: "OK",
                        customClass: {confirmButton: "btn btn-primary"}
                    });
                } else {
                    Swal.fire({
                        text: result.message,
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "OK",
                        customClass: {confirmButton: "btn btn-primary"}
                    });
                }
            }
        });
    });
}


$('body').on('click', '.btn_aireno_delete_quote', function () {
    var quote_id = parseInt($(this).data('quote-id'));
    var formData = new FormData();
    formData.set('action', 'aireno_delete_quote');
    formData.set('project_id', aireno_project.project_id);
    formData.set('scope_id', quote_id);
    Swal.fire({
        text: "Are you sure delete this quote?",
        icon: "info",
        buttonsStyling: !1,
        confirmButtonText: "Yes",
        customClass: {confirmButton: "btn btn-primary"}
    }).then((function (t) {
        if (t.isConfirmed) {
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
                        text: "Something went wrong. Please try again!",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "OK",
                        customClass: {confirmButton: "btn btn-primary"}
                    });
                },
                success: function (result) {
                    blockUI.release();
                    if (!result.status) {
                        Swal.fire({
                            text: "Something went wrong!",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "OK",
                            customClass: {confirmButton: "btn btn-primary"}
                        });
                    } else {
                        reloadOnCurrentTab();
                    }
                }
            });
        }
    }));
});

//Send Follow Action Handler
//btnSendFollow.addEventListener("click", function () {
//    blockUI.block();
//    var formData = new FormData();
//    formData.set('action', 'aireno_send_follow');
//    formData.set('project_id', aireno_project.project_id);
//    $.ajax({
//        method: 'POST',
//        dataType: 'json',
//        url: aireno.ajax_url,
//        type: 'POST',
//        data: formData,
//        cache: false,
//        contentType: false,
//        processData: false,
//        error: function error(response) {
//            blockUI.release();
//            Swal.fire({
//                text: "Something went wrong. Please try again!",
//                icon: "error",
//                buttonsStyling: !1,
//                confirmButtonText: "OK",
//                customClass: {confirmButton: "btn btn-primary"}
//            });
//        },
//        success: function (result) {
//            blockUI.release();
//            if (result.status) {
//                // window.location.href = result.redirect;
//            } else {
//                Swal.fire({
//                    text: result.message,
//                    icon: "error",
//                    buttonsStyling: !1,
//                    confirmButtonText: "OK",
//                    customClass: {confirmButton: "btn btn-primary"}
//                });
//            }
//        }
//    });
//});

// $('.aireno-rm-team-member').click(function (e) {
//     e.preventDefault();
//     var formData = new FormData();
//     formData.set('action', 'aireno_remove_member_from_project');
//     formData.set('project_id', aireno_project.project_id);
//     formData.set('target_user_id', $(this).attr('data-user-id'));
//     blockUI.block();
//     $.ajax({
//         method: 'POST',
//         dataType: 'json',
//         url: aireno.ajax_url,
//         type: 'POST',
//         data: formData,
//         cache: false,
//         contentType: false,
//         processData: false,
//         error: function error(response) {
//             blockUI.release();
//             Swal.fire({
//                 text: "Something went wrong. Please try again!",
//                 icon: "error",
//                 buttonsStyling: !1,
//                 confirmButtonText: "OK",
//                 customClass: {confirmButton: "btn btn-primary"}
//             });
//         },
//         success: function (result) {
//             blockUI.release();
//             if (result.status) {
//                 reloadOnCurrentTab();
//             } else {
//                 Swal.fire({
//                     text: "No members removed!",
//                     icon: "error",
//                     buttonsStyling: !1,
//                     confirmButtonText: "OK",
//                     customClass: {confirmButton: "btn btn-primary"}
//                 });
//             }
//         }
//     });
// });

var KTProjectUsers = {
    init: function () {
        !function () {
            const t = document.getElementById("kt_project_users_table");
            if (!t) return;
            t.querySelectorAll("tbody tr").forEach((t => {
                const e = t.querySelectorAll("td"),
                    r = moment(e[1].innerHTML, "MMM D, YYYY").format();
                e[1].setAttribute("data-order", r)
            }));
            const e = $(t).DataTable({info: !1, order: [], columnDefs: [{targets: 4, orderable: !1}]});
            var r = document.getElementById("kt_filter_search");
            r && r.addEventListener("keyup", (function (t) {
                e.search(t.target.value).draw()
            }))
        }()
    }
};
KTUtil.onDOMContentLoaded((function () {
    KTProjectUsers.init()
}));


var KTProjectPayments = function () {
    return {
        init: function () {
            !function () {
                var po_table = document.querySelector("#kt_payments_overview_table");
                if (!po_table) return;
                // po_table.querySelectorAll("tbody tr").forEach((row => {
                //     const td = row.querySelectorAll("td"), a = moment(td[1].innerHTML, "MMM D, YYYY").format();
                //     td[1].setAttribute("data-order", a)
                // }));
                const dataTable = $(po_table).DataTable({info: !1, order: []});
                var o, n;
                $('#kt_filter_payments_orders').on('change', function (e) {
                    dataTable.column(3).search($(this).val()).draw();
                });
                $.fn.dataTable.ext.search.push((function (t, e, a) {
                    var r = o,
                        s = n,
                        i = parseFloat(moment(e[1]).format()) || 0;
                    return !!(isNaN(r) && isNaN(s) || isNaN(r) && i <= s || r <= i && isNaN(s) || r <= i && i <= s)
                }));
                document.getElementById("kt_filter_payments_search").addEventListener("keyup", (function (t) {
                    dataTable.search(t.target.value).draw()
                }));
            }()
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTProjectPayments.init()
}));


//New Schedule Form
var KTModalNewPayment = function () {
    var submitPayment, cancelPayment, validator, paymentForm, modal, paymentModal;
    return {
        init: function () {
            (paymentModal = document.querySelector("#kt_modal_new_payment")) &&
            (modal = new bootstrap.Modal(paymentModal),
                    paymentForm = paymentModal.querySelector("#kt_modal_new_payment_form"),
                    submitPayment = paymentModal.querySelector("#kt_modal_new_payment_submit"),
                    cancelPayment = paymentModal.querySelector("#kt_modal_new_payment_cancel"),
                    validator = FormValidation.formValidation(paymentForm, {
                        fields: {
                            payment_title: {validators: {notEmpty: {message: "Title is required"}}},
                            payment_amount: {validators: {notEmpty: {message: "Amount is required"}}},
                            payment_description: {validators: {notEmpty: {message: "Description is required"}}},
                            payment_user: {validators: {notEmpty: {message: "Please select an user"}}},
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger,
                            bootstrap: new FormValidation.plugins.Bootstrap5({
                                rowSelector: ".fv-row",
                                eleInvalidClass: "",
                                eleValidClass: ""
                            })
                        }
                    }),
                    submitPayment.addEventListener("click", (function (e) {
                        e.preventDefault(), validator && validator.validate().then((function (e) {
                            if ("Valid" == e) {
                                submitPayment.setAttribute("data-kt-indicator", "on");
                                submitPayment.disabled = !0;
                                var formData = new FormData(paymentForm);
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
                                        modal.hide();
                                        Swal.fire({
                                            text: "Something went wrong. Please try again!",
                                            icon: "error",
                                            buttonsStyling: !1,
                                            confirmButtonText: "OK",
                                            customClass: {confirmButton: "btn btn-primary"}
                                        });
                                    },
                                    success: function (result) {
                                        blockUI.release();
                                        resetPaymentModal();
                                        submitPayment.removeAttribute("data-kt-indicator");
                                        submitPayment.disabled = !1;
                                        modal.hide();
                                        if (!result.status) {
                                            Swal.fire({
                                                text: "Something went wrong!",
                                                icon: "error",
                                                buttonsStyling: !1,
                                                confirmButtonText: "OK",
                                                customClass: {confirmButton: "btn btn-primary"}
                                            });
                                        } else {
                                            reloadOnCurrentTab();
                                        }
                                    }
                                });
                            } else
                                Swal.fire({
                                    text: "Sorry, please fill all fields and try again.",
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {confirmButton: "btn btn-primary"}
                                })
                        }))
                    })),
                    cancelPayment.addEventListener("click", (function (t) {
                        paymentForm.reset(), modal.hide();
                    }))
            )
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTModalNewPayment.init()
}));

$('body').on('click', '#btnCreatePayment', function () {
    resetPaymentModal();
    $('#kt_modal_new_payment').modal('show');
});

//trigger Edit Payment Modal
$('body').on('click', '#kt_payments_overview_table [data-kt-element="kt_single_payment"] [data-kt-element="btnEditPayment"]', function () {
    var payment_id = $(this).data('payment-id');
    var payments = JSON.parse($('[data-kt-element="payments"]').val());
    var payment = payments[payment_id];
    fillPaymentDetails(payment);
    $('#kt_modal_new_payment').modal('show');
});
//trigger Claim Payment Modal
$('body').on('click', '#kt_payments_overview_table [data-kt-element="kt_single_payment"] [data-kt-element="btnClaimPayment"]', function () {
    var payment_id = $(this).data('payment-id');
    var payments = JSON.parse($('[data-kt-element="payments"]').val());
    var payment = payments[payment_id];
    Swal.fire({
        text: "Are you sure claim this payment?",
        icon: "info",
        buttonsStyling: !1,
        confirmButtonText: "Yes",
        customClass: {confirmButton: "btn btn-primary"}
    }).then((function (t) {
        if (t.isConfirmed) {
            blockUI.block();
            var formData = new FormData();

            formData.set('action', 'aireno_claim_payment_of_project');
            formData.set('payment_id', payment_id);
            formData.set('project_id', aireno_project.project_id);

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
                        text: "Something went wrong. Please try again!",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "OK",
                        customClass: {confirmButton: "btn btn-primary"}
                    });
                },
                success: function (result) {
                    blockUI.release();
                    if (result.status) {
                        Swal.fire({
                            text: result.message,
                            icon: "success",
                            buttonsStyling: !1,
                            confirmButtonText: "OK",
                            customClass: {confirmButton: "btn btn-success"}
                        });
                        reloadOnCurrentTab();
                    } else {
                        Swal.fire({
                            text: result.message,
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "OK",
                            customClass: {confirmButton: "btn btn-primary"}
                        });
                    }
                }
            });
        }

    }));
});
//trigger View Invoice of Payment Modal
$('body').on('click', '#kt_payments_overview_table [data-kt-element="kt_single_payment"] [data-kt-element="btnViewInvoice"]', function () {
    var payment_id = $(this).data('payment-id');
    var payments = JSON.parse($('[data-kt-element="payments"]').val());
    var payment = payments[payment_id];
    fillInvoiceDetails(payment);
    $('#kt_modal_view_invoice').modal('show');
});
//trigger Cancel Payment Modal
$('body').on('click', '#kt_payments_overview_table [data-kt-element="kt_single_payment"] [data-kt-element="btnCancelPayment"]', function () {
    var payment_id = $(this).data('payment-id');
    var payments = JSON.parse($('[data-kt-element="payments"]').val());
    var payment = payments[payment_id];
    Swal.fire({
        text: "Are you sure cancel this payment?",
        icon: "error",
        buttonsStyling: !1,
        confirmButtonText: "Yes",
        customClass: {confirmButton: "btn btn-danger"}
    }).then((function (t) {
        if (t.isConfirmed) {
            blockUI.block();
            var formData = new FormData();

            formData.set('action', 'aireno_cancel_payment_of_project');
            formData.set('payment_id', payment_id);
            formData.set('project_id', aireno_project.project_id);

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
                        text: "Something went wrong. Please try again!",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "OK",
                        customClass: {confirmButton: "btn btn-primary"}
                    });
                },
                success: function (result) {
                    blockUI.release();
                    if (result.status) {
                        Swal.fire({
                            text: result.message,
                            icon: "success",
                            buttonsStyling: !1,
                            confirmButtonText: "OK",
                            customClass: {confirmButton: "btn btn-success"}
                        });
                        reloadOnCurrentTab();
                    } else {
                        Swal.fire({
                            text: result.message,
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "OK",
                            customClass: {confirmButton: "btn btn-primary"}
                        });
                    }
                }
            });
        }

    }));
});

var resetPaymentModal = function () {
    $('#kt_modal_new_payment .fv-plugins-message-container.invalid-feedback').empty();
    $('#kt_modal_new_payment [name=payment_title]').val('');
    $('#kt_modal_new_payment [name=payment_description]').val('');
    $('#kt_modal_new_payment [name=payment_amount]').val('');
    $('#kt_modal_new_payment [name=payment_user]').val('');
    $('#kt_modal_new_payment [name=payment_id]').val('');
}
var fillPaymentDetails = function (payment) {
    $('#kt_modal_new_payment .fv-plugins-message-container.invalid-feedback').empty();
    $('#kt_modal_new_payment [name=payment_title]').val(payment.title);
    $('#kt_modal_new_payment [name=payment_description]').val(payment.description);
    $('#kt_modal_new_payment [name=payment_amount]').val(payment.amount);
    $('#kt_modal_new_payment [name=payment_user]').val(payment.payment_user);
    $('#kt_modal_new_payment [name=payment_id]').val(payment.id);
}
var fillInvoiceDetails = function (payment) {
    var modal = $('#kt_modal_view_invoice_form');
    if (payment.payment_senderdata) {
        modal.find('[data-kt-element="business_name"]').html(payment.payment_senderdata.company_name);
        modal.find('[data-kt-element="business_abn"]').html(payment.payment_senderdata.company_abn);
        modal.find('[data-kt-element="business_address"]').html(payment.payment_senderdata.address);
        modal.find('[data-kt-element="business_payment_instructions"]').html(payment.payment_senderdata.payment_instructions);
        modal.find('[data-kt-element="business_payment_details"]').html(payment.payment_senderdata.payment_details);
    }
    if (payment.payment_userdata) {
        modal.find('[data-kt-element="user_display_name"]').html(payment.payment_userdata.display_name + '(' + payment.payment_userdata.email + ')');
    }

    modal.find('[data-kt-element="project_id_of_payment"]').html('#' + aireno_project.project_id);
    modal.find('[data-kt-element="invoice_of_payment"]').html('#INV-' + payment.id);
    modal.find('[data-kt-element="title_of_payment"]').html(payment.title);
    modal.find('[data-kt-element="detail_of_payment"]').html(payment.description);
    modal.find('[data-kt-element="amount_of_payment"]').html('$' + parseFloat(payment.amount).toFixed(2));
    modal.find('[data-kt-element="gst_of_payment"]').html('$' + parseFloat(payment.amount * 0.1).toFixed(2));
    modal.find('[data-kt-element="grand_of_payment"]').html('$' + parseFloat(payment.amount).toFixed(2));

    if (payment.status == 'Paid') modal.find('#kt_modal_view_invoice_form_pay').attr('disabled', 'disabled');
    else modal.find('#kt_modal_view_invoice_form_pay').attr('data-payment-id', payment.id);
    modal.find('#kt_modal_view_invoice_form_print').attr('data-payment-id', payment.id);
};

//load Payment templates modal
var KTModalLoadPayments = function () {
    var btnSubmit, btnCancel, validator, modalForm, bsmodal, ptModal;
    return {
        init: function () {
            (ptModal = document.querySelector("#kt_modal_load_payments")) &&
            (bsmodal = new bootstrap.Modal(ptModal),
                modalForm = document.querySelector("#kt_modal_load_payments_form"),
                btnSubmit = document.getElementById("kt_modal_load_payments_submit"),
                btnCancel = document.getElementById("kt_modal_load_payments_cancel"),
                validator = FormValidation.formValidation(modalForm, {
                    fields: {
                        "pt-template": {validators: {notEmpty: {message: "Choose a payment template"}}},
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger,
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: ".fv-row",
                            eleInvalidClass: "",
                            eleValidClass: ""
                        })
                    }
                }),
                btnSubmit.addEventListener("click", (function (e) {
                    e.preventDefault(), validator && validator.validate().then((function (e) {
                        if ("Valid" == e) {
                            Swal.fire({
                                text: "Will you create payments by template?",
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "OK",
                                customClass: {confirmButton: "btn btn-primary"}
                            }).then((function (t) {
                                if (t.isConfirmed) {
                                    btnSubmit.setAttribute("data-kt-indicator", "on");
                                    btnSubmit.disabled = !0;
                                    blockUI.block();
                                    var formData = new FormData();
                                    formData.set('action', 'aireno_load_payments_from_template');
                                    formData.set('project_id', aireno_project.project_id);
                                    formData.set('pt_ID', $('#kt_modal_load_payments_form [name=pt-template]').val());
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
                                            btnSubmit.removeAttribute("data-kt-indicator");
                                            btnSubmit.disabled = !1;
                                            Swal.fire({
                                                text: "Something went wrong. Please try again!",
                                                icon: "error",
                                                buttonsStyling: !1,
                                                confirmButtonText: "OK",
                                                customClass: {confirmButton: "btn btn-primary"}
                                            }).then((function (t) {
                                                t.isConfirmed && bsmodal.hide()
                                            }))
                                        },
                                        success: function (result) {
                                            blockUI.release();
                                            btnSubmit.removeAttribute("data-kt-indicator");
                                            btnSubmit.disabled = !1;
                                            if (result.status) reloadOnCurrentTab();
                                        }
                                    });
                                }
                            }));

                        } else {
                            Swal.fire({
                                text: "Sorry, looks like there are some errors detected, please try again.",
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "OK",
                                customClass: {confirmButton: "btn btn-primary"}
                            })
                        }
                    }))
                })),
                btnCancel.addEventListener("click", (function (t) {
                    t.preventDefault(), bsmodal.hide()
                })))
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTModalLoadPayments.init()
}));

//Invoice modal actions
var KTModalViewInvoice = function () {
    var btnPay, btnPrint, modalForm, bsmodal, ptModal;
    return {
        init: function () {
            (ptModal = document.querySelector("#kt_modal_load_payments")) &&
            (bsmodal = new bootstrap.Modal(ptModal),
                modalForm = document.querySelector("#kt_modal_load_payments_form"),
                btnPay = document.getElementById("kt_modal_view_invoice_form_pay"),
                btnPrint = document.getElementById("kt_modal_view_invoice_form_print"),
                btnPay.addEventListener("click", (function (e) {
                    e.preventDefault();
                    var formData = new FormData();
                    formData.set('action', 'aireno_mark_payment_paid');
                    formData.set('project_id', aireno_project.project_id);
                    formData.set('payment_id', $(btnPay).data('payment-id'));
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
                                text: "Something went wrong. Please try again!",
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "OK",
                                customClass: {confirmButton: "btn btn-primary"}
                            }).then((function (t) {
                                t.isConfirmed && bsmodal.hide()
                            }))
                        },
                        success: function (result) {
                            blockUI.release();
                            if (result.status) reloadOnCurrentTab();
                            else {
                                Swal.fire({
                                    text: result.message,
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "OK",
                                    customClass: {confirmButton: "btn btn-primary"}
                                });
                            }
                        }
                    });
                })),
                btnPrint.addEventListener("click", (function (t) {
                    var request_url = aireno.ajax_url + '?action=download_invoice&payment_id=' + $(btnPrint).data('payment-id');
                    window.location.href = request_url;
                })));
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTModalViewInvoice.init()
}));

//File List
var KTFileManagerList = function () {
    var e, t, o, n, r, checkBox;
    const l = () => {
            t.querySelectorAll('[data-kt-filemanager-table-filter="delete_row"]').forEach((t => {
                t.addEventListener("click", (function (t) {
                    t.preventDefault();
                    const o = t.target.closest("tr"),
                        n = o.querySelectorAll("td")[1].innerText;
                    Swal.fire({
                        text: "Are you sure you want to delete " + n + "?",
                        icon: "warning",
                        showCancelButton: !0,
                        buttonsStyling: !1,
                        confirmButtonText: "Yes, delete!",
                        cancelButtonText: "No, cancel",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        }
                    }).then((function (t) {
                        t.value ? Swal.fire({
                            text: "You have deleted " + n + "!.",
                            icon: "success",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {confirmButton: "btn fw-bold btn-primary"}
                        }).then((function () {
                            e.row($(o)).remove().draw()
                        })) : "cancel" === t.dismiss && Swal.fire({
                            text: customerName + " was not deleted.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {confirmButton: "btn fw-bold btn-primary"}
                        })
                    }))
                }))
            }))
        },
        i = () => {
            var o = t.querySelectorAll('[type="checkbox"]');
            "folders" === t.getAttribute("data-kt-filemanager-table") && (o = document.querySelectorAll('#kt_file_manager_list_wrapper [type="checkbox"]'));
            const n = document.querySelector('[data-kt-filemanager-table-select="delete_selected"]');
            o.forEach((e => {
                e.addEventListener("click", (function () {
                    setTimeout((function () {
                        s()
                    }), 50)
                }))
            }));
        },
        checkboxSelected = () => {
            const e = document.querySelector('[data-kt-filemanager-table-toolbar="base"]'),
                o = document.querySelector('[data-kt-filemanager-table-toolbar="selected"]'),
                n = document.querySelector('[data-kt-filemanager-table-select="selected_count"]'),
                r = t.querySelectorAll('tbody [type="checkbox"]');
            let a = !1,
                l = 0;
            r.forEach((e => {
                e.checked && (a = !0, l++)
            })), a ? (n.innerHTML = l, e.classList.add("d-none"), o.classList.remove("d-none")) : (e.classList.remove("d-none"), o.classList.add("d-none"))
        },
        c = () => {
            const e = t.querySelector("#kt_file_manager_new_folder_row");
            e && e.parentNode.removeChild(e)
        },
        d = () => {
            t.querySelectorAll('[data-kt-filemanager-table="rename"]').forEach((e => {
                e.addEventListener("click", u)
            }))
        },
        u = o => {
            let r;
            if (o.preventDefault(), t.querySelectorAll("#kt_file_manager_rename_input").length > 0) return void Swal.fire({
                text: "Unsaved input detected. Please save or cancel the current item",
                icon: "warning",
                buttonsStyling: !1,
                confirmButtonText: "Ok, got it!",
                customClass: {confirmButton: "btn fw-bold btn-danger"}
            });
            const a = o.target.closest("tr"),
                l = a.querySelectorAll("td")[1],
                i = l.querySelector(".svg-icon");
            r = l.innerText;
            const s = n.cloneNode(!0);
            s.querySelector("#kt_file_manager_rename_folder_icon").innerHTML = i.outerHTML, l.innerHTML = s.innerHTML, a.querySelector("#kt_file_manager_rename_input").value = r;
            var c = FormValidation.formValidation(l, {
                fields: {rename_folder_name: {validators: {notEmpty: {message: "Name is required"}}}},
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            });
            document.querySelector("#kt_file_manager_rename_folder").addEventListener("click", (t => {
                t.preventDefault(), c && c.validate().then((function (t) {
                    "Valid" == t && Swal.fire({
                        text: "Are you sure you want to rename " + r + "?",
                        icon: "warning",
                        showCancelButton: !0,
                        buttonsStyling: !1,
                        confirmButtonText: "Yes, rename it!",
                        cancelButtonText: "No, cancel",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        }
                    }).then((function (t) {
                        t.value ? Swal.fire({
                            text: "You have renamed " + r + "!.",
                            icon: "success",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {confirmButton: "btn fw-bold btn-primary"}
                        }).then((function () {
                            const t = document.querySelector("#kt_file_manager_rename_input").value,
                                o = `<div class="d-flex align-items-center">\n                                        ${i.outerHTML}\n                                        <a href="?page=apps/file-manager/files/" class="text-gray-800 text-hover-primary">${t}</a>\n                                    </div>`;
                            e.cell($(l)).data(o).draw()
                        })) : "cancel" === t.dismiss && Swal.fire({
                            text: r + " was not renamed.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {confirmButton: "btn fw-bold btn-primary"}
                        })
                    }))
                }))
            }));
            const d = document.querySelector("#kt_file_manager_rename_folder_cancel");
            d.addEventListener("click", (t => {
                t.preventDefault(), d.setAttribute("data-kt-indicator", "on"), setTimeout((function () {
                    const t = `<div class="d-flex align-items-center">\n                    ${i.outerHTML}\n                    <a href="?page=apps/file-manager/files/" class="text-gray-800 text-hover-primary">${r}</a>\n                </div>`;
                    d.removeAttribute("data-kt-indicator"), e.cell($(l)).data(t).draw(), toastr.options = {
                        closeButton: !0,
                        debug: !1,
                        newestOnTop: !1,
                        progressBar: !1,
                        positionClass: "toastr-top-right",
                        preventDuplicates: !1,
                        showDuration: "300",
                        hideDuration: "1000",
                        timeOut: "5000",
                        extendedTimeOut: "1000",
                        showEasing: "swing",
                        hideEasing: "linear",
                        showMethod: "fadeIn",
                        hideMethod: "fadeOut"
                    }, toastr.error("Cancelled rename function")
                }), 1e3)
            }))
        },
        m = () => {
            t.querySelectorAll('[data-kt-filemanger-table="copy_link"]').forEach((e => {
                const t = e.querySelector("button"),
                    o = e.querySelector('[data-kt-filemanger-table="copy_link_generator"]'),
                    n = e.querySelector('[data-kt-filemanger-table="copy_link_result"]'),
                    r = e.querySelector("input");
                t.addEventListener("click", (e => {
                    var t;
                    e.preventDefault(), o.classList.remove("d-none"), n.classList.add("d-none"), clearTimeout(t), t = setTimeout((() => {
                        o.classList.add("d-none"), n.classList.remove("d-none"), r.select()
                    }), 2e3)
                }))
            }))
        },
        f = () => {
            document.getElementById("kt_file_manager_items_counter").innerText = e.rows().count() + " items"
        };
    return {
        init: function () {
            (t = document.querySelector("#kt_file_manager_list")) && (o = document.querySelector('[data-kt-filemanager-template="upload"]'), n = document.querySelector('[data-kt-filemanager-template="rename"]'), r = document.querySelector('[data-kt-filemanager-template="action"]'), checkBox = document.querySelector('[data-kt-filemanager-template="checkbox"]'), (() => {
                t.querySelectorAll("tbody tr").forEach((e => {
                    const t = e.querySelectorAll("td")[3],
                        o = moment(t.innerHTML, "DD MMM YYYY, LT").format();
                    t.setAttribute("data-order", o)
                }));
                const o = {
                        info: !1,
                        order: [],
                        scrollY: "700px",
                        scrollCollapse: !0,
                        paging: !1,
                        ordering: !1,
                        columns: [{data: "checkbox"}, {data: "name"}, {data: "size"}, {data: "date"}, {data: "action"}],
                        language: {emptyTable: ``}
                    },
                    n = {
                        info: !1,
                        order: [],
                        pageLength: 10,
                        lengthChange: !1,
                        ordering: !1,
                        columns: [{data: "checkbox"}, {data: "name"}, {data: "size"}, {data: "date"}, {data: "action"}],
                        language: {emptyTable: ``},
                        conditionalPaging: !0
                    };
                var r;
                r = "folders" === t.getAttribute("data-kt-filemanager-table") ? o : n, (e = $(t).DataTable(r)).on("draw", (function () {
                    i(), l(), checkboxSelected(), c(), KTMenu.createInstances(), m(), f(), d()
                }))
            })(), i(), document.querySelector('[data-kt-filemanager-table-filter="search"]').addEventListener("keyup", (function (t) {
                e.search(t.target.value).draw()
            })), l(),
                (() => {
                    const e = "#kt_modal_upload_dropzone",
                        t = document.querySelector(e);
                    var o = t.querySelector(".dropzone-item");
                    o.id = "";
                    var n = o.parentNode.innerHTML;
                    o.parentNode.removeChild(o);
                    var r = new Dropzone(e, {
                        url: "path/to/your/server",
                        parallelUploads: 10,
                        previewTemplate: n,
                        maxFilesize: 1,
                        autoProcessQueue: !1,
                        autoQueue: !1,
                        previewsContainer: e + " .dropzone-items",
                        clickable: e + " .dropzone-select"
                    });
                    r.on("addedfile", (function (o) {
                        o.previewElement.querySelector(e + " .dropzone-start").onclick = function () {
                            const e = o.previewElement.querySelector(".progress-bar");
                            e.style.opacity = "1";
                            var t = 1,
                                n = setInterval((function () {
                                    t >= 100 ? (r.emit("success", o), r.emit("complete", o), clearInterval(n)) : (t++, e.style.width = t + "%")
                                }), 20)
                        }, t.querySelectorAll(".dropzone-item").forEach((e => {
                            e.style.display = ""
                        })), t.querySelector(".dropzone-upload").style.display = "inline-block", t.querySelector(".dropzone-remove-all").style.display = "inline-block"
                    })), r.on("complete", (function (e) {
                        const o = t.querySelectorAll(".dz-complete");
                        setTimeout((function () {
                            o.forEach((e => {
                                e.querySelector(".progress-bar").style.opacity = "0", e.querySelector(".progress").style.opacity = "0", e.querySelector(".dropzone-start").style.opacity = "0"
                            }))
                        }), 300)
                    })), t.querySelector(".dropzone-upload").addEventListener("click", (function () {
                        r.files.forEach((e => {
                            const t = e.previewElement.querySelector(".progress-bar");
                            t.style.opacity = "1";
                            var o = 1,
                                n = setInterval((function () {
                                    o >= 100 ? (r.emit("success", e), r.emit("complete", e), clearInterval(n)) : (o++, t.style.width = o + "%")
                                }), 20)
                        }))
                    })), t.querySelector(".dropzone-remove-all").addEventListener("click", (function () {
                        Swal.fire({
                            text: "Are you sure you would like to remove all files?",
                            icon: "warning",
                            showCancelButton: !0,
                            buttonsStyling: !1,
                            confirmButtonText: "Yes, remove it!",
                            cancelButtonText: "No, return",
                            customClass: {confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light"}
                        }).then((function (e) {
                            e.value ? (t.querySelector(".dropzone-upload").style.display = "none", t.querySelector(".dropzone-remove-all").style.display = "none", r.removeAllFiles(!0)) : "cancel" === e.dismiss && Swal.fire({
                                text: "Your files was not removed!.",
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "Ok, got it!",
                                customClass: {confirmButton: "btn btn-primary"}
                            })
                        }))
                    })), r.on("queuecomplete", (function (e) {
                        t.querySelectorAll(".dropzone-upload").forEach((e => {
                            e.style.display = "none"
                        }))
                    })), r.on("removedfile", (function (e) {
                        r.files.length < 1 && (t.querySelector(".dropzone-upload").style.display = "none", t.querySelector(".dropzone-remove-all").style.display = "none")
                    }))
                })(), m(), d(), (() => {
                const e = document.querySelector("#kt_modal_move_to_folder"),
                    t = e.querySelector("#kt_modal_move_to_folder_form"),
                    o = t.querySelector("#kt_modal_move_to_folder_submit"),
                    n = new bootstrap.Modal(e);
                var r = FormValidation.formValidation(t, {
                    fields: {move_to_folder: {validators: {notEmpty: {message: "Please select a folder."}}}},
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger,
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: ".fv-row",
                            eleInvalidClass: "",
                            eleValidClass: ""
                        })
                    }
                });
                o.addEventListener("click", (e => {
                    e.preventDefault(), o.setAttribute("data-kt-indicator", "on"), r && r.validate().then((function (e) {
                        "Valid" == e ? setTimeout((function () {
                            Swal.fire({
                                text: "Are you sure you would like to move to this folder",
                                icon: "warning",
                                showCancelButton: !0,
                                buttonsStyling: !1,
                                confirmButtonText: "Yes, move it!",
                                cancelButtonText: "No, return",
                                customClass: {confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light"}
                            }).then((function (e) {
                                e.isConfirmed ? (t.reset(), n.hide(), toastr.options = {
                                    closeButton: !0,
                                    debug: !1,
                                    newestOnTop: !1,
                                    progressBar: !1,
                                    positionClass: "toastr-top-right",
                                    preventDuplicates: !1,
                                    showDuration: "300",
                                    hideDuration: "1000",
                                    timeOut: "5000",
                                    extendedTimeOut: "1000",
                                    showEasing: "swing",
                                    hideEasing: "linear",
                                    showMethod: "fadeIn",
                                    hideMethod: "fadeOut"
                                }, toastr.success("1 item has been moved."), o.removeAttribute("data-kt-indicator")) : (Swal.fire({
                                    text: "Your action has been cancelled!.",
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {confirmButton: "btn btn-primary"}
                                }), o.removeAttribute("data-kt-indicator"))
                            }))
                        }), 500) : o.removeAttribute("data-kt-indicator")
                    }))
                }))
            })(), f(), KTMenu.createInstances())
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTFileManagerList.init()
}));

var KTProjectFiles = function () {
    var deleteFile = function (fileID) {
        var formData = new FormData();
        formData.set('action', 'aireno_delete_project_file');
        formData.set('fileID', fileID);
        formData.set('project_id', aireno_project.project_id);
        Swal.fire({
            text: "Are you sure delete this file?",
            icon: "error",
            buttonsStyling: !1,
            confirmButtonText: "Yes",
            customClass: {confirmButton: "btn btn-primary"}
        }).then((function (t) {
            if (t.isConfirmed) {
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
                            text: "Something went wrong. Please try again!",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "OK",
                            customClass: {confirmButton: "btn btn-primary"}
                        });
                    },
                    success: function (result) {
                        blockUI.release();
                        if (!result.status) {
                            Swal.fire({
                                text: "Something went wrong!",
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "OK",
                                customClass: {confirmButton: "btn btn-primary"}
                            });
                        } else {
                            reloadOnCurrentTab();
                        }
                    }
                });
            }
        }))
    }
    return {
        init: function () {
            !function () {
                var po_table = document.querySelector("#kt_files_overview_table");
                if (!po_table) return;
                const dataTable = $(po_table).DataTable({
                    info: !1,
                    columnDefs: [{orderable: false, targets: [0, 4]}],
                    order: [
                        [0, 'asc'],
                        [1, 'asc'],
                        [2, 'asc'],
                        [3, 'desc']
                    ]
                });
                var o, n;
                $('#kt_filter_file_types').on('change', function (e) {
                    dataTable.column(1).search($(this).val()).draw();
                });
                $.fn.dataTable.ext.search.push((function (t, e, a) {
                    var r = o,
                        s = n,
                        i = parseFloat(moment(e[1]).format()) || 0;
                    return !!(isNaN(r) && isNaN(s) || isNaN(r) && i <= s || r <= i && isNaN(s) || r <= i && i <= s)
                }));
                document.getElementById("kt_filter_files_search").addEventListener("keyup", (function (t) {
                    dataTable.column(0).search(t.target.value).draw()
                }));
                $('body').on('click', '.btnDeleteSingleFile', function () {
                    deleteFile($(this).data('fileid'));
                });
            }()
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTProjectFiles.init()
}));
/**
 * Start Aside menu item click events handler
 */
var KTScrollElement = function (e, t) {
    var target = document.querySelector(e.getAttribute("data-kt-scrolltarget"));
    var ktClicked = this,
        i = document.getElementsByTagName("BODY")[0];
    if (null != e) {
        var r = {offset: 300, speed: 600},
            o = function () {
                ktClicked.options = KTUtil.deepExtend({}, r, t), ktClicked.uid = KTUtil.getUniqueId("scrollelem"), ktClicked.element = e, ktClicked.target = target, ktClicked.element.setAttribute("data-kt-scrollelem", "true"), a(), KTUtil.data(ktClicked.element).set("scrollelem", ktClicked)
            },
            a = function () {
                window.addEventListener("scroll", (function () {
                    KTUtil.throttle(undefined, (function () {
                        getElementOffset()
                    }), 200)
                })), KTUtil.addEvent(ktClicked.element, "click", (function (e) {
                    e.preventDefault();
                    scrollToElement();
                }))
            },
            getElementOffset = function () {
                var e = parseInt(getScrollValue("offset"));
                KTUtil.getScrollTop() > e ? !1 === i.hasAttribute("data-kt-scrollelem") && i.setAttribute("data-kt-scrollelem", "on") : !0 === i.hasAttribute("data-kt-scrollelem") && i.removeAttribute("data-kt-scrollelem")
            },
            scrollToElement = function () {
                var e = parseInt(getScrollValue("speed"));
                KTUtil.scrollTo(ktClicked.target, 75)
            },
            getScrollValue = function (e) {
                if (!0 === ktClicked.element.hasAttribute("data-kt-scrollelem-" + e)) {
                    var t = ktClicked.element.getAttribute("data-kt-scrollelem-" + e),
                        i = KTUtil.getResponsiveValue(t);
                    return null !== i && "true" === String(i) ? i = !0 : null !== i && "false" === String(i) && (i = !1), i
                }
                var r = KTUtil.snakeToCamel(e);
                return ktClicked.options[r] ? KTUtil.getResponsiveValue(ktClicked.options[r]) : null
            };
        KTUtil.data(e).has("scrollelem") ? ktClicked = KTUtil.data(e).get("scrollelem") : o(), ktClicked.go = function () {
            return scrollToElement()
        }, ktClicked.getElement = function () {
            return ktClicked.element
        }, ktClicked.destroy = function () {
            KTUtil.data(ktClicked.element).remove("scrollelem")
        }
    }
};
KTScrollElement.getInstance = function (e) {
    return e && KTUtil.data(e).has("scrollelem") ? KTUtil.data(e).get("scrollelem") : null
};
KTScrollElement.createInstances = function (e = '[data-kt-scrollelem="true"]') {
    var t = document.getElementsByTagName("BODY")[0].querySelectorAll(e);
    if (t && t.length > 0)
        for (var n = 0, i = t.length; n < i; n++) new KTScrollElement(t[n])
};
KTScrollElement.init = function () {
    KTScrollElement.createInstances()
};
"loading" === document.readyState ? document.addEventListener("DOMContentLoaded", KTScrollElement.init) : KTScrollElement.init(), "undefined" != typeof module && void 0 !== module.exports && (module.exports = KTScrollElement);
/**
 * End Aside menu item click events handler
 */


//save contract on single project
$('body').on('click', '.full_contract .save_contract', function () {
    var formData = new FormData();
    formData.set('action', 'save_contract_on_project');
    formData.set('project_id', aireno_project.project_id);
    tinyMCE.triggerSave();
    var contract = $('.full_contract .wp-editor-area').val();
    formData.set('contract', contract);
    Swal.fire({
        text: "Are you sure save this contract?",
        icon: "info",
        buttonsStyling: !1,
        confirmButtonText: "Yes",
        customClass: {confirmButton: "btn btn-primary"}
    }).then((function (t) {
        if (t.isConfirmed) {
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
                        text: "Something went wrong. Please try again!",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "OK",
                        customClass: {confirmButton: "btn btn-primary"}
                    });
                },
                success: function (result) {
                    blockUI.release();
                    if (!result.status) {
                        Swal.fire({
                            text: result.msg,
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "OK",
                            customClass: {confirmButton: "btn btn-primary"}
                        });
                    } else {
                        reloadOnCurrentTab();
                    }
                }
            });
        }

    }));
});


//change project client modal
var KTModalChangeClient = function () {
    var btnSubmit, btnCancel, bsmodal, ptModal;
    return {
        init: function () {
            (ptModal = document.querySelector("#kt_modal_change_client")) && (bsmodal = new bootstrap.Modal(ptModal), btnSubmit = document.getElementById("kt_modal_change_client_submit"), btnCancel = document.getElementById("kt_modal_change_client_cancel"), btnSubmit.addEventListener("click", (function (e) {
                e.preventDefault();
                btnSubmit.setAttribute("data-kt-indicator", "on");
                btnSubmit.disabled = !0;
                var formData = new FormData();
                formData.set('action', 'aireno_change_client_on_project');
                formData.set('project_id', aireno_project.project_id);
                formData.set('client', $('#clientSelect2').val());
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
                        btnSubmit.removeAttribute("data-kt-indicator");
                        btnSubmit.disabled = !1;
                        blockUI.release();
                        Swal.fire({
                            text: "Something went wrong. Please try again!",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "OK",
                            customClass: {confirmButton: "btn btn-primary"}
                        }).then((function (t) {
                            t.isConfirmed && bsmodal.hide()
                        }))
                    },
                    success: function (result) {
                        btnSubmit.removeAttribute("data-kt-indicator");
                        btnSubmit.disabled = !1;
                        blockUI.release();
                        if (result.status) {
                            reloadOnCurrentTab();
                        } else {
                            bsmodal.hide();
                            Swal.fire({
                                text: result.message,
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "OK",
                                customClass: {confirmButton: "btn btn-primary"}
                            });
                        }
                    }
                });
            })), btnCancel.addEventListener("click", (function (t) {
                t.preventDefault(), bsmodal.hide()
            })))
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTModalChangeClient.init()
}));


// Format options
const optionFormat = (item) => {
    if (!item.id) {
        return item.text;
    }

    var span = document.createElement('span');
    var template = '';

    template += '<div class="d-flex align-items-center">';
    template += '<img src="' + item.element.getAttribute('data-kt-rich-content-icon') + '" class="rounded-circle h-40px w-40px me-3" alt="' + item.text + '"/>';
    template += '<div class="d-flex flex-column">'
    template += '<span class="fs-4 fw-bolder lh-1">' + item.text + '</span>';
    template += '<span class="text-muted fs-5">' + item.element.getAttribute('data-kt-rich-content-subcontent') + '</span>';
    template += '</div>';
    template += '</div>';

    span.innerHTML = template;

    return $(span);
}

// change client select2
$('#clientSelect2').select2({
    placeholder: "Choose a client",
    dropdownParent: $('#kt_modal_change_client'),
    minimumResultsForSearch: 1,
    templateSelection: optionFormat,
    templateResult: optionFormat,
});

$('body').on('click', '.btnRmUser', function () {
    var user_type = $(this).data('user-type');
    var user_id = $(this).data('user-id');
    var formData = new FormData();
    formData.set('action', 'aireno_remove_user_on_project');
    formData.set('user_type', user_type);
    formData.set('user_id', user_id);
    formData.set('project_id', aireno_project.project_id);
    Swal.fire({
        text: "Are you sure remove this user from this project?",
        icon: "error",
        buttonsStyling: !1,
        confirmButtonText: "OK",
        customClass: {confirmButton: "btn btn-primary"}
    }).then((function (t) {
        if (t.isConfirmed) {
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
                        text: "Something went wrong. Please try again!",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "OK",
                        customClass: {confirmButton: "btn btn-primary"}
                    }).then((function (t) {
                    }))
                },
                success: function (result) {
                    blockUI.release();
                    if (result.status) {
                        reloadOnCurrentTab();
                    } else {
                        Swal.fire({
                            text: result.message,
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "OK",
                            customClass: {confirmButton: "btn btn-primary"}
                        });
                    }
                }
            });
        }
    }));
});

//close project for no contact modal
var KTModalNoContactCloseProject = function () {
    var btnSubmit, btnCancel, validator, modalForm, bsmodal, ptModal;
    return {
        init: function () {
            (ptModal = document.querySelector("#kt_modal_no_contact_close_project")) && (bsmodal = new bootstrap.Modal(ptModal), modalForm = document.querySelector("#kt_modal_no_contact_close_project_form"), btnSubmit = document.getElementById("kt_modal_no_contact_close_project_submit"), btnCancel = document.getElementById("kt_modal_no_contact_close_project_cancel"),
                btnSubmit.addEventListener("click", (function (e) {
                    btnSubmit.setAttribute("data-kt-indicator", "on");
                    btnSubmit.disabled = !0;
                    blockUI.block();
                    setTimeout((function () {
                        var formData = new FormData();
                        formData.set('action', 'aireno_close_project_no_contact');
                        formData.set('project_id', aireno_project.project_id);
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
                                btnSubmit.removeAttribute("data-kt-indicator");
                                btnSubmit.disabled = !1;
                                blockUI.release();
                                Swal.fire({
                                    text: "Something went wrong. Please try again!",
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "OK",
                                    customClass: {confirmButton: "btn btn-primary"}
                                }).then((function (t) {
                                    t.isConfirmed && bsmodal.hide()
                                }))
                            },
                            success: function (result) {
                                btnSubmit.removeAttribute("data-kt-indicator");
                                btnSubmit.disabled = !1;
                                blockUI.release();
                                if (result.status) {
                                    reloadOnCurrentTab();
                                } else {
                                    bsmodal.hide();
                                    Swal.fire({
                                        text: result.message,
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "OK",
                                        customClass: {confirmButton: "btn btn-primary"}
                                    });
                                }
                            }
                        });
                    }), 2e3);
                })), btnCancel.addEventListener("click", (function (t) {
                t.preventDefault(), bsmodal.hide()
            })))
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTModalNoContactCloseProject.init()
}));

//upload files modal
var KTModalUploadFiles = function () {
    var btnSubmit, btnCancel, bsmodal, ptModal, uploadForm, fileTrigger, formFile, selectedFiles = [];
    var previewContainer;
    var previewFiles = function (files) {
        var file = files[0];
        var being_files = file.files;

        var previewTemplate = previewContainer.querySelector('[data-kt-element="preview-template"]');

        for (var i = 0; i < being_files.length; i++) {
            var being_file = being_files[i];
            if (allowedFileTypes.includes(being_file.type) && !(isFileIncluded(selectedFiles, being_file))) {
                selectedFiles.push(being_file);
                var $clone = $(previewTemplate).clone();
                $clone.removeClass("d-none").removeAttr('data-kt-element');
                if (being_file && isImage(being_file)) {
                    $clone.find("img").attr('src', URL.createObjectURL(being_file));
                } else {
                    $clone.find("img").addClass('d-none');
                    $clone.find(".for-img").removeClass('d-none');
                }
                $clone.find('.img-title').html(being_file.name);
                $clone.find('.img-size').html(parseInt(being_file.size / 1024) + 'KB');
                $clone.find('.fu-remove').attr('data-file-id', selectedFiles.indexOf(being_file));
                $(previewContainer).append($clone);
            }
        }
    };
    var resetPreview = function () {
        selectedFiles = [];
        $(previewContainer).find('> div:not(.d-none)').remove();
    }
    return {
        init: function () {
            ptModal = document.querySelector("#kt_modal_file_upload");
            bsmodal = new bootstrap.Modal(ptModal);
            uploadForm = document.getElementById("kt_modal_file_upload_form");
            btnSubmit = document.getElementById("kt_modal_file_upload_form_submit");
            btnCancel = document.getElementById("kt_modal_file_upload_form_cancel");
            fileTrigger = uploadForm.querySelector('.filter-trigger');
            formFile = document.getElementById("kt_modal_file_upload_form_file");
            previewContainer = document.getElementById("kt_modal_file_upload_form_previews");
            btnSubmit.addEventListener("click", (function (e) {
                e.preventDefault();
                if (selectedFiles.length > 0) {
                    btnSubmit.setAttribute("data-kt-indicator", "on");
                    btnSubmit.disabled = !0;
                    var formData = new FormData();
                    formData.set('action', 'aireno_upload_files_on_project');
                    formData.set('project_id', aireno_project.project_id);
                    formData.set('type', $(uploadForm).find('[name=type]').val());
                    for (var i = 0; i < selectedFiles.length; i++) {
                        var afile = selectedFiles[i];
                        formData.append('files[]', afile);
                    }
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
                            btnSubmit.removeAttribute("data-kt-indicator");
                            btnSubmit.disabled = !1;
                            blockUI.release();
                            Swal.fire({
                                text: "Something went wrong. Please try again!",
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "OK",
                                customClass: {confirmButton: "btn btn-primary"}
                            }).then((function (t) {
                                t.isConfirmed && bsmodal.hide()
                            }))
                        },
                        success: function (result) {
                            btnSubmit.removeAttribute("data-kt-indicator");
                            btnSubmit.disabled = !1;
                            blockUI.release();
                            if (result.status) {
                                reloadOnCurrentTab();
                            } else {
                                bsmodal.hide();
                                Swal.fire({
                                    text: result.message,
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "OK",
                                    customClass: {confirmButton: "btn btn-primary"}
                                });
                            }
                        }
                    });
                } else {
                    Swal.fire({
                        text: "Please choose files to upload!",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "OK",
                        customClass: {confirmButton: "btn btn-primary"}
                    });
                }
            }));
            btnCancel.addEventListener("click", (function (t) {
                t.preventDefault(), bsmodal.hide()
            }));
            fileTrigger.addEventListener("click", (function (e) {
                $(formFile).trigger('click');
            }));
            formFile.addEventListener("change", (function (e) {
                e.preventDefault();
                previewFiles($(this));
            }));
            $('body').on("click", "#kt_modal_file_upload_form_previews .fu-remove", function (e) {
                var file_index = $(this).data('file-id');
                selectedFiles.splice(file_index, 1);

                $(this).parentsUntil('#kt_modal_file_upload_form_previews').remove();
                $('#kt_modal_file_upload_form_previews > div:not([data-kt-element="preview-template"])').each(function (index, obj) {
                    $(obj).find('.fu-remove').attr('data-file-id', index);
                });
            });
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTModalUploadFiles.init()
}));


//Add Activity modal
var KTModalAddActivity = function () {
    var btnSubmit, btnCancel, bsmodal, ptModal, form, validator;
    return {
        init: function () {
            ptModal = document.querySelector("#kt_modal_add_activity");
            bsmodal = new bootstrap.Modal(ptModal);
            form = document.getElementById("kt_modal_add_activity_form");
            btnSubmit = document.getElementById("kt_modal_add_activity_form_submit");
            btnCancel = document.getElementById("kt_modal_add_activity_form_cancel");
            validator = FormValidation.formValidation(form, {
                fields: {
                    "activity_type": {validators: {notEmpty: {message: "Choose a type"}}},
                    "activity_datetime": {validators: {notEmpty: {message: "Choose a date time"}}},
                    "activity_content": {validators: {notEmpty: {message: "Fill content"}}},
                    "activity_user": {validators: {notEmpty: {message: "Choose an user"}}},
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            });
            btnSubmit.addEventListener("click", (function (e) {
                e.preventDefault(), validator && validator.validate().then((function (e) {
                    if ("Valid" == e) {
                        btnSubmit.setAttribute("data-kt-indicator", "on");
                        btnSubmit.disabled = !0;
                        blockUI.block();
                        var formData = new FormData();
                        formData.set('action', 'aireno_add_activity_manually');
                        formData.set('project_id', aireno_project.project_id);
                        formData.set('activity_type', $(form).find('[name=activity_type]').val());
                        formData.set('activity_datetime', $(form).find('[name=activity_datetime]').val());
                        formData.set('activity_content', $(form).find('[name=activity_content]').val());
                        formData.set('activity_user', $(form).find('[name=activity_user]').val());
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
                                btnSubmit.removeAttribute("data-kt-indicator");
                                btnSubmit.disabled = !1;
                                Swal.fire({
                                    text: "Something went wrong. Please try again!",
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "OK",
                                    customClass: {confirmButton: "btn btn-primary"}
                                }).then((function (t) {
                                    t.isConfirmed && bsmodal.hide()
                                }));
                            },
                            success: function (result) {
                                blockUI.release();
                                btnSubmit.removeAttribute("data-kt-indicator");
                                btnSubmit.disabled = !1;
                                if (result.status) reloadOnCurrentTab();
                                else {
                                    Swal.fire({
                                        text: result.message,
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "OK",
                                        customClass: {confirmButton: "btn btn-primary"}
                                    })
                                }
                            }
                        });

                    } else {
                        Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "OK",
                            customClass: {confirmButton: "btn btn-primary"}
                        })
                    }
                }))
            }));
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    if ($("#kt_modal_add_activity").length)
    KTModalAddActivity.init()
}));

//view user details
$('body').on('click', '.view-user', function () {
    var user_id = $(this).data('user-id');
    var user_details = JSON.parse($('#aireno_team_members').val());
    var user_detail = user_details[user_id];
    fillUserDetails(user_detail);
    $('#kt_modal_view_user').modal('show');
});

var fillUserDetails = function (user_detail) {
    var modal = $('#kt_modal_view_user');
    modal.find('[data-kt-element="user-avatar"]').attr('src', user_detail.avatar);
    modal.find('[data-kt-element="user-display-name"]').html(user_detail.display_name);
    modal.find('[data-kt-element="user-email"]').html(user_detail.email);
    modal.find('[data-kt-element="user-email"]').closest('a').attr('href', 'mailto:' + user_detail.email);
    modal.find('[data-kt-element="user-phone"]').html(user_detail.phone);
    modal.find('[data-kt-element="user-phone"]').closest('a').attr('href', 'tel:' + user_detail.phone);
    modal.find('[data-kt-element="user-address"]').html(user_detail.address);
    modal.find('[data-kt-element="user-profile"]').attr('href', user_detail.profile);
}
$('body').on('click', '#kt_modal_view_user_cancel', function (e) {
    e.preventDefault();
    $('#kt_modal_view_user').modal('hide');
});

//submit review
var KTSubmitReview = function () {
    var validator, form, btnSubmit;
    return {
        init: function () {
            form = document.querySelector("#ratingForm");
            btnSubmit = document.getElementById("btnRatingSubmit");
            validator = FormValidation.formValidation(form, {
                fields: {
                    "rating": {validators: {notEmpty: {message: "Please choose the rate!"}}},
                    "review": {validators: {notEmpty: {message: "Please fill the review!"}}},
                    "receivers[]": {validators: {notEmpty: {message: "Please choose at least 1 user to leave a review!"}}},
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            }),
                btnSubmit.addEventListener("click", (function (e) {
                    e.preventDefault(), validator && validator.validate().then((function (e) {
                        if ("Valid" == e) {
                            btnSubmit.setAttribute("data-kt-indicator", "on");
                            btnSubmit.disabled = !0;
                            blockUI.block();
                            var formData = new FormData($(form)[0]);
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
                                    btnSubmit.removeAttribute("data-kt-indicator");
                                    btnSubmit.disabled = !1;
                                    blockUI.release();
                                    Swal.fire({
                                        text: "Something went wrong. Please try again!",
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "OK",
                                        customClass: {confirmButton: "btn btn-primary"}
                                    });
                                },
                                success: function (result) {
                                    btnSubmit.removeAttribute("data-kt-indicator");
                                    btnSubmit.disabled = !1;
                                    blockUI.release();
                                    if (result.status) {
                                        reloadOnCurrentTab();
                                    } else {
                                        Swal.fire({
                                            text: result.message,
                                            icon: "error",
                                            buttonsStyling: !1,
                                            confirmButtonText: "OK",
                                            customClass: {confirmButton: "btn btn-primary"}
                                        });
                                    }
                                }
                            });
                        } else {
                            Swal.fire({
                                text: "Sorry, Please fill all fields to proceed!.",
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "OK",
                                customClass: {confirmButton: "btn btn-primary"}
                            })
                        }
                    }));
                }));
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    if ($('#ratingForm').length)
        KTSubmitReview.init()
}));

$('body').on("click", "#btnPrintQuotes", function (ev) {
    var request_url = aireno.ajax_url + '?action=export_quotes&project_id=' + aireno_project.project_id;
    window.location.href = request_url;
});

$('body').on('click', '.btnLoadMiniCart', function (ev) {
    ev.preventDefault();
    $('.xoo-wsc-basket').trigger('click');
});

$('body').on('click', '.asp-product-loader', function (ev) {
    ev.preventDefault();
    $(this).siblings('.asp-product-container').find('button[type=submit]').trigger('click');
});