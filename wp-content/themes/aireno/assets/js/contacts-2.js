"use strict";

const validateEmail = (email) => {
    return String(email)
        .toLowerCase()
        .match(
            /^\w+@(\w)+((\-)\w+)?(\.(\w+)){1,2}$/
        );
};///
const validatePhone = (phone) => {
    return String(phone)
        .toLowerCase()
        .match(
            /^\({0,1}((0|\+61)(2|4|3|7|8)){0,1}\){0,1}(\ |-){0,1}[0-9]{2}(\ |-){0,1}[0-9]{2}(\ |-){0,1}[0-9]{1}(\ |-){0,1}[0-9]{3}$/
        );
};

var blockTarget = document.querySelector("body");
var blockUI = new KTBlockUI(blockTarget, {
    message: '<div class="blockui-message"><span class="spinner-border text-primary"></span> Processing...</div>',
    overlayClass: "bg-info bg-opacity-25"
});


var KTModalAddContact = function () {
    var btnRegisterSubmit, regValidation, registerForm, modal, modalTarget, btnBackSearch,
        searchForm, btnSearchSubmit, searchValidation, resultContainer, template;
    return {
        init: function () {
            modalTarget = document.querySelector("#kt_modal_add_contact");
            modal = new bootstrap.Modal(modalTarget);
            registerForm = document.querySelector("#kt_modal_add_contact_form");
            btnRegisterSubmit = registerForm.querySelector("#kt_modal_add_contact_submit");
            btnBackSearch = registerForm.querySelector('#kt_modal_add_contact_search');
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
                        blockUI.block();
                        var formData = new FormData($(registerForm)[0]);
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
                                btnRegisterSubmit.removeAttribute("data-kt-indicator");
                                btnRegisterSubmit.disabled = !1;
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
                                    registerForm.reset();
                                    modal.hide();
                                    window.location.reload();
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
                                console.log(result);
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
                                            }
                                            else {
                                                $(registerForm).find('[name="phone"]').val(emailOrPhone);
                                            }
                                        }
                                        else {
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
                                        for (var i = 0; i < users.length; i ++){
                                            user = users[i];
                                            (templateClone = template.cloneNode(!0)).classList.remove("d-none");
                                            $(templateClone).removeAttr('data-kt-element');
                                            $(templateClone).find('img').attr('src', user.avatar);
                                            $(templateClone).attr('data-user-id', user.id);
                                            $(templateClone).find('[data-kt-element="display_name"]').html(user.display_name);
                                            $(templateClone).attr('data-display-name', user.display_name);
                                            $(templateClone).find('[data-kt-element="email"]').html(user.email);
                                            $(templateClone).attr('data-user-email', user.email);
                                            $(templateClone).find('[data-kt-element="type"]').html(user.user_type);
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

            $('body').on('click', '#kt_modal_search_user_form #kt_modal_search_user_form_result .result-item', function (e) {
                e.preventDefault();
                var userId = $(this).attr('data-user-id');
                modal.hide();
                var formData = new FormData();
                formData.set('action', 'add_contact_on_contacts');
                formData.set('contact_id', userId);
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
                            customClass: {confirmButton: "btn btn-light"}
                        });
                    },
                    success: function (result) {
                        console.log(result);
                        blockUI.release();
                        if (result.status) {
                            window.location.reload();
                        }
                        else {
                            Swal.fire({
                                text: result.message,
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "OK!",
                                customClass: {confirmButton: "btn btn-light"}
                            });
                        }
                    }
                });
            });
        }
    };
}();
KTUtil.onDOMContentLoaded((function () {
    KTModalAddContact.init();
}));


var KTUsersList = function () {
    var dataTable, baseDiv, selectedDiv, selected_count, usersTable = document.getElementById("kt_table_users"),
        initSingleDeletion = function () {
            usersTable.querySelectorAll('[data-kt-users-table-filter="delete_row"]').forEach((btnDeleteRow => {
                btnDeleteRow.addEventListener("click", (function (t) {
                    t.preventDefault();
                    var trRow = t.target.closest("tr");
                    var display_name = trRow.querySelectorAll("td")[1].querySelectorAll("a")[1].innerText;
                    var contact_id = $(this).attr('data-contact');

                    Swal.fire({
                        text: "Are you sure you want to delete " + display_name + "?",
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
                        if (t.value) {
                            var formData = new FormData();
                            formData.set('action', 'aireno_remove_contacts');
                            formData.append('contacts[]', contact_id);

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
                                        customClass: {confirmButton: "btn btn-light"}
                                    });
                                },
                                success: function (result) {
                                    blockUI.release();
                                    if (result.status) {
                                        dataTable.row($(trRow)).remove().draw();
                                        toggleSelectedDiv();
                                    } else {
                                        Swal.fire({
                                            text: result.msg,
                                            icon: "error",
                                            buttonsStyling: !1,
                                            confirmButtonText: "OK!",
                                            customClass: {confirmButton: "btn btn-danger"}
                                        });
                                    }
                                }
                            });
                        } else {
                            t.dismiss;
                        }
                    }));
                }));
            }));
        },
        initMultipleDeletion = function () {
            var uCheckBoxList = usersTable.querySelectorAll('[type="checkbox"]');
            baseDiv = document.querySelector('[data-kt-user-table-toolbar="base"]');
            selectedDiv = document.querySelector('[data-kt-user-table-toolbar="selected"]');
            selected_count = document.querySelector('[data-kt-user-table-select="selected_count"]');
            var btnDeleteSelected = document.querySelector('[data-kt-user-table-select="delete_selected"]');
            uCheckBoxList.forEach((eachCheckBox => {
                eachCheckBox.addEventListener("click", (function () {
                    toggleSelectedDiv();
                }));
            }));
            btnDeleteSelected.addEventListener("click", function () {
                Swal.fire({
                    text: "Are you sure you want to remove selected users from your contact list?",
                    icon: "warning",
                    showCancelButton: !0,
                    buttonsStyling: !1,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (t) {
                    if (t.value) {
                        var formData = new FormData();
                        formData.set('action', 'aireno_remove_contacts');

                        uCheckBoxList.forEach((checkBox => {
                            if (checkBox.checked) {
                                formData.append('contacts[]', checkBox.value);
                            }
                        }));

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
                                    customClass: {confirmButton: "btn btn-light"}
                                });
                            },
                            success: function (result) {
                                blockUI.release();
                                if (result.status) {
                                    uCheckBoxList.forEach((checkBox => {
                                        if (checkBox.checked) {
                                            dataTable.row($(checkBox.closest("tbody tr"))).remove().draw();
                                        }
                                    }));
                                    usersTable.querySelectorAll('[type="checkbox"]')[0].checked = false;
                                    toggleSelectedDiv();
                                    initMultipleDeletion();
                                } else {
                                    Swal.fire({
                                        text: result.msg,
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "OK!",
                                        customClass: {confirmButton: "btn btn-danger"}
                                    });
                                }
                            }
                        });

                    } else {
                        t.dismiss;
                    }
                });
            });
        };
    var toggleSelectedDiv = function () {
        var checkBoxes = usersTable.querySelectorAll('tbody [type="checkbox"]');
        var isChecked = false, selectedCount = 0;
        checkBoxes.forEach((checkBox => {
            if (checkBox.checked) {
                isChecked = true;
                selectedCount++;
            }
        }));
        if (isChecked) {
            selected_count.innerHTML = selectedCount;
            baseDiv.classList.add("d-none");
            selectedDiv.classList.remove("d-none");
        } else {
            baseDiv.classList.remove("d-none");
            selectedDiv.classList.add("d-none");
        }
    };
    return {
        init: function () {
            if (usersTable) {
                (dataTable = $(usersTable).DataTable({
                    info: !1,
                    order: [],
                    pageLength: 10,
                    lengthChange: !1,
                    columnDefs: [{orderable: !1, targets: 0}, {orderable: !1, targets: 5}]
                })).on("draw", (function () {
                    initMultipleDeletion(), initSingleDeletion(), toggleSelectedDiv();
                }));
                initMultipleDeletion();
                document.querySelector('[data-kt-user-table-filter="search"]').addEventListener("keyup", (function (t) {
                    dataTable.search(t.target.value).draw();
                }));
                initSingleDeletion();
            }
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTUsersList.init();
}));

