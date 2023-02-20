"use strict";

var blockTarget = document.querySelector("body");

var blockUI = new KTBlockUI(blockTarget, {
    message: '<div class="blockui-message"><span class="spinner-border text-primary"></span> Processing...</div>',
    overlayClass: "bg-info bg-opacity-25"
});

var KTAddQuote = function () {
    var stepper, steps, btnSubmit, btnNext, stepperObj, kt_quoting_form, zipcode, options;
    return {
        init: function () {
            stepper = document.querySelector("#kt_quoting_form_stepper"),
                kt_quoting_form = stepper.querySelector("#kt_quoting_form"),
                steps = $(stepper).find("#kt_quoting_form .kt-quoting-steps .kt-quoting-step"),
                btnSubmit = stepper.querySelector('[data-kt-stepper-action="submit"]');

            //Date Picker on Brief step
            $("[name=date_start]").flatpickr({enableTime: false, dateFormat: "Y-m-d"});
            //Zipcode Autocomplete on Brief step
            zipcode = document.querySelector('#zipcode_picker');
            options = {
                types: ['address']
            };
            if (zipcode) {
                var zipcodeautocomplete = new google.maps.places.Autocomplete(zipcode, options);
                zipcodeautocomplete.setComponentRestrictions({
                    country: ["au"],
                });
            }

            //Next, Prev, Submit button actions handler
            btnNext = stepper.querySelector('[data-kt-stepper-action="next"]');
            (stepperObj = new KTStepper(stepper)).on("kt.stepper.changed", (function (e) {
                steps.length === stepperObj.getCurrentStepIndex() ? (btnSubmit.classList.remove("d-none"),
                    btnSubmit.classList.add("d-inline-block"),
                    btnNext.classList.add("d-none")) : steps.length + 1 === stepperObj.getCurrentStepIndex() ? (btnSubmit.classList.add("d-none"), btnNext.classList.add("d-none")) : (btnSubmit.classList.remove("d-inline-block"), btnSubmit.classList.remove("d-none"), btnNext.classList.remove("d-none"))
            }));

            steps.length === stepperObj.getCurrentStepIndex() ? (btnSubmit.classList.remove("d-none"),
                btnSubmit.classList.add("d-inline-block"),
                btnNext.classList.add("d-none")) : steps.length + 1 === stepperObj.getCurrentStepIndex() ? (btnSubmit.classList.add("d-none"), btnNext.classList.add("d-none")) : (btnSubmit.classList.remove("d-inline-block"), btnSubmit.classList.remove("d-none"), btnNext.classList.remove("d-none"));

            stepperObj.on("kt.stepper.next", (function (e) {
                var validated = true;

                //field row validation
                $('#kt_quoting_form .kt-quoting-step.current.kt-brief-step input[type=text].kt-require,' +
                    '#kt_quoting_form .kt-quoting-step.current.kt-brief-step input[type=date].kt-require,' +
                    '#kt_quoting_form .kt-quoting-step.current .refine-rows:not(.d-none) input[type=text].kt-require,' +
                    '#kt_quoting_form .kt-quoting-step.current .refine-rows:not(.d-none) input[type=tel].kt-require,' +
                    '#kt_quoting_form .kt-quoting-step.current .refine-rows:not(.d-none) input[type=number].kt-require,' +
                    '#kt_quoting_form .kt-quoting-step.current .refine-rows:not(.d-none) input[type=email].kt-require,' +
                    '#kt_quoting_form .kt-quoting-step.current .refine-rows:not(.d-none) input[type=date].kt-require,' +
                    ' #kt_quoting_form .kt-quoting-step.current .refine-rows:not(.d-none) select.kt-require,' +
                    '#kt_quoting_form .kt-quoting-step.current .refine-rows:not(.d-none) textarea.kt-require').each(function (index, elem) {
                    $(elem).removeClass('kt-error');
                    if (!$(elem).val()) {
                        if ($(elem).attr('name') == 'client') $(elem).siblings('span.select2').find('span.selection span.select2-selection').addClass('kt-error');
                        else $(elem).addClass('kt-error');
                        validated = false;
                    }
                });

                if (validated) {
                    $('#kt_quoting_form .kt-quoting-step.current .kt-error').removeClass('kt-error');
                    aireno_calculate_quote();
                    e.goNext();
                    KTUtil.scrollTop();
                } else {
                    Swal.fire({
                        text: "Please fill out all fields before go to next step.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "OK!",
                        customClass: {confirmButton: "btn btn-light"}
                    }).then((function () {
                        KTUtil.scrollTop();
                    }));
                }
            }));
            stepperObj.on("kt.stepper.previous", (function (e) {
                e.goPrevious();
                KTUtil.scrollTop();
                if (1 == stepperObj.getCurrentStepIndex()) {
                    window.history.back();
                }
            }));

            btnSubmit.addEventListener("click", (function (e) {
                var validated = true;

                //custom pricing validation
                $('#kt_quoting_form .kt-quoting-step.current .customQuoteFieldRow:not(.screen-reader-text) .customQuoteFieldTitle,' +
                    '#kt_quoting_form .kt-quoting-step.current .customQuoteFieldRow:not(.screen-reader-text) .customQuoteFieldTotalPrice,' +
                    '#kt_quoting_form .kt-quoting-step.current .customQuoteFieldRow:not(.screen-reader-text) tr:not(.screen-reader-text) textarea.kt-require,' +
                    '#kt_quoting_form .kt-quoting-step.current .customQuoteFieldRow:not(.screen-reader-text) tr:not(.screen-reader-text) input.kt-require').each(function (index, elem) {
                    if (!$(elem).val()) {
                        $(elem).addClass('kt-error');
                        validated = false;
                    }
                });
                if (validated) {
                    $('#kt_quoting_form .kt-quoting-step.current .kt-error').removeClass('kt-error');
                    btnSubmit.setAttribute("data-kt-indicator", "on");
                    btnSubmit.disabled = !0;

                    var formData = new FormData($('#kt_quoting_form')[0]);
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
                        },
                        success: function (result) {
                            btnSubmit.removeAttribute("data-kt-indicator");
                            btnSubmit.disabled = !1;
                            Swal.fire({
                                text: result.message,
                                icon: "success",
                                buttonsStyling: !1,
                                confirmButtonText: "OK!",
                                customClass: {confirmButton: "btn btn-danger"}
                            }).then((function () {
                                window.location.href = result.redirect;
                            }));
                        }
                    });
                } else {
                    Swal.fire({
                        text: "Please fill out all fields before go to next step.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "OK!",
                        customClass: {confirmButton: "btn btn-light"}
                    }).then((function () {
                        KTUtil.scrollTop()
                    }))
                }
            }));

            //
            $('body').on('change', '#kt_quoting_form .kt-quoting-step.current input', function () {
                var target = $('#kt_quoting_form .kt-quoting-step.current  .refine-rows.refine-' + $(this).attr('data-target'));
                if ($(this).is('input[type=radio]')) {
                    $('#kt_quoting_form .kt-quoting-step.current .refine-rows').addClass('d-none');
                    $(this).parent().toggleClass('refine-active');
                    $(this).parent().parent().siblings('.refine-item-row').each(function (index, obj) {
                        $(this).find('.refine-active').removeClass('refine-active');
                    });
                    target.removeClass('d-none');
                } else if ($(this).is('input[type=checkbox]')) {
                    target.toggleClass('d-none');
                    $(this).parent().toggleClass('refine-active');
                } else {

                }
            });

            $('body').on('click', '.kd-switcher-container.kd-manual', function (e) {
                change_toggle($(this));
                var rowContainer = $(this).closest('.customQuoteFieldRow');
                var rowTotalPriceField = rowContainer.find('.customQuoteFieldTotalPrice');
                var rowPrice = 0;
                rowContainer.find('table tbody tr:not(.screen-reader-text)').each(function (index, row) {
                    var included = $(row).find('> td:eq(1) [type=checkbox]').prop('checked');//
                    if (included) {
                        var price_val = ($(row).find('>td:eq(4) input').val()) ? $(row).find('>td:eq(4) input').val() : 0;
                        var price = parseFloat(price_val);
                        var quantity_val = ($(row).find('>td:eq(5) input').val()) ? $(row).find('>td:eq(5) input').val() : 0;
                        var quantity = parseFloat(quantity_val);
                        var margin_val = ($(row).find('>td:eq(7) input').val()) ? $(row).find('>td:eq(7) input').val() : 0;
                        var margin = parseFloat(margin_val);
                        rowPrice += price * quantity * (1 + margin / 100);
                    }
                })
                rowTotalPriceField.val(rowPrice.toFixed(2));
                aireno_calculate_quote();
            });

            $('body').on('click', '.kd-switcher-container:not(.kd-manual)', function (e) {
                change_toggle($(this));
                aireno_calculate_quote();
            });
            $('body').on('click', '#kt_quoting_form .kt-quoting-step.current [data-kt-dialer="true"] [data-kt-dialer-control="increase"]', function (e) {
                aireno_calculate_quote();
            });
            $('body').on('click', '#kt_quoting_form .kt-quoting-step.current [data-kt-dialer="true"] [data-kt-dialer-control="decrease"]', function (e) {
                aireno_calculate_quote();
            });

            $('body').on('click', '#kt_quoting_form .kt-quoting-step.current a.refine-add', function () {
                var target_id = $(this).attr('data-id');

                var table = $(this).closest('table');
                var refine_row = table.find('.screen-reader-text').clone(true);
                refine_row.removeClass('screen-reader-text');
                var index = table.find('tr:not(.screen-reader-text)').length;
                refine_row.find('td:first').html(index);
                refine_row.find('td:eq(1) input[type=checkbox]').attr('name', 'default_' + target_id + '_' + index);
                refine_row.find('td:eq(2) textarea').removeClass('d-none').attr('name', 'description_' + target_id + '_' + index);
                refine_row.find('td:eq(3) select').removeClass('d-none').attr('name', 'category_' + target_id + '_' + index);
                refine_row.find('td:eq(4) input[type=text]').removeClass('d-none').attr('name', 'price_' + target_id + '_' + index);
                refine_row.find('td:eq(5) input[type=number]').removeClass('d-none').attr('name', 'quantity_' + target_id + '_' + index);
                refine_row.find('td:eq(6) select').removeClass('d-none').attr('name', 'quantity_type_' + target_id + '_' + index);
                refine_row.find('td:eq(7) input[type=number]').removeClass('d-none').attr('name', 'margin_' + target_id + '_' + index);

                table.append(refine_row);
                var refine_count_element = $('[name=' + target_id + '_count]');
                var refine_count = parseInt(refine_count_element.val());
                refine_count_element.val(refine_count + 1);
            });

            $('body').on('click', '#kt_quoting_form .kt-quoting-step.current a.refine-remove', function () {
                var table = $(this).closest('table');
                var target_id = $(this).attr('data-id');
                $(this).closest('tr').remove();
                var target = $('[name=' + target_id + ']');
                var refine_count = parseInt(target.val());
                target.val(refine_count - 1);
                remake_index(table);
                aireno_calculate_quote();
            });

            $('body').on('click', '#kt_quoting_form .kt-quoting-step.current a.refine-actions-add', function () {
                var table = $(this).closest('table');
                var refine_row = $(this).closest('table').find('.screen-reader-text').clone().removeClass('screen-reader-text');
                var index = table.find('tr:not(.screen-reader-text)').length;
                refine_row.find('td:first-of-type').html(index);
                var idx = $('.customQuoteFieldContainer .customQuoteFieldRow').index($(this).closest('.customQuoteFieldRow'));
                refine_row.find('td:eq(1) input[type=checkbox]').attr('name', 'customQuoteFieldIncluded' + idx + '[]').val(index - 1);
                refine_row.find('td:eq(2) textarea').removeClass('d-none').attr('name', 'customQuoteFieldDescription' + idx + '[]');
                refine_row.find('td:eq(3) select').removeClass('d-none').attr('name', 'customQuoteFieldCategory' + idx + '[]');
                refine_row.find('td:eq(4) input').removeClass('d-none').attr('name', 'customQuoteFieldPrices' + idx + '[]');
                refine_row.find('td:eq(5) input').removeClass('d-none').attr('name', 'customQuoteFieldQuantity' + idx + '[]');
                refine_row.find('td:eq(6) select').removeClass('d-none').attr('name', 'customQuoteFieldQuantityType' + idx + '[]');
                refine_row.find('td:eq(7) input').removeClass('d-none').attr('name', 'customQuoteFieldMargin' + idx + '[]');

                table.append(refine_row);
            });

            $('body').on('click', '#kt_quoting_form .kt-quoting-step.current a.refine-actions-remove', function () {
                var table = $(this).closest('table');
                var rowContainer = $(this).closest('.customQuoteFieldRow');
                $(this).closest('tr').remove();
                reindex_table(table);
                calculateCustomFields(rowContainer);
                aireno_calculate_quote();
            });

            $('body').on('change', '#kt_quoting_form input.kt-calculate:not(.kt-custom)', function (e) {
                aireno_calculate_quote();
            });

            $('body').on('change', '#kt_quoting_form input.kt-calculate.kt-custom', function (e) {
                var rowContainer = $(this).closest('.customQuoteFieldRow');
                calculateCustomFields(rowContainer);
            });

            $('body').on('click', '.populateCustomQuoteField', function () {
                var clones = $(this).siblings('.customQuoteFieldRow.screen-reader-text').clone().removeClass('screen-reader-text');

                var idx = $('.customQuoteFieldContainer .customQuoteFieldRow').length;
                var newWrapper = clones.appendTo($('.customQuoteFieldContainer'));
                newWrapper.find('.customQuoteFieldTitle').attr('name', 'customQuoteFieldTitle[]');
                newWrapper.find('.customQuoteFieldPrice').attr('name', 'customQuoteFieldPrice[]');
                newWrapper.find('.customQuoteFieldTotalPrice').attr('name', 'customQuoteFieldTotalPrice[]');
                newWrapper.find('.refine-table tr:not(.screen-reader-text)').each(function (index, row) {
                    $(row).find('td:eq(1) input[type=checkbox]').attr('name', 'customQuoteFieldIncluded' + idx + '[]');
                    $(row).find('td:eq(2) textarea').attr('name', 'customQuoteFieldDescription' + idx + '[]');
                    $(row).find('td:eq(3) select').attr('name', 'customQuoteFieldCategory' + idx + '[]');
                    $(row).find('td:eq(4) input[type=text]').attr('name', 'customQuoteFieldPrices' + idx + '[]');
                    $(row).find('td:eq(5) input[type=number]').attr('name', 'customQuoteFieldQuantity' + idx + '[]');
                    $(row).find('td:eq(6) select').attr('name', 'customQuoteFieldQuantityType' + idx + '[]');
                    $(row).find('td:eq(7) input[type=number]').attr('name', 'customQuoteFieldMargin' + idx + '[]');
                });
                applySuggestion(newWrapper.find(".customQuoteFieldTitle"), newWrapper.find(".title-suggestion-container"));
            });

            $('body').on('click', '.customQuoteFieldContainer .deleteCustomQuoteField', function () {
                $(this).closest('.customQuoteFieldRow').remove();

                $('.customQuoteFieldContainer .customQuoteFieldRow').each(function (idx, fieldRow) {
                    $(fieldRow).find('.refine-table tr:not(.screen-reader-text)').each(function (index, row) {
                        $(row).find('td:eq(1) input[type=checkbox]').attr('name', 'customQuoteFieldIncluded' + idx + '[]');
                        $(row).find('td:eq(2) textarea').attr('name', 'customQuoteFieldDescription' + idx + '[]');
                        $(row).find('td:eq(3) select').attr('name', 'customQuoteFieldCategory' + idx + '[]');
                        $(row).find('td:eq(4) input[type=text]').attr('name', 'customQuoteFieldPrices' + idx + '[]');
                        $(row).find('td:eq(5) input[type=number]').attr('name', 'customQuoteFieldQuantity' + idx + '[]');
                        $(row).find('td:eq(6) select').attr('name', 'customQuoteFieldQuantityType' + idx + '[]');
                        $(row).find('td:eq(7) input[type=number]').attr('name', 'customQuoteFieldMargins' + idx + '[]');
                    });
                });
                aireno_calculate_quote();
            });
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTAddQuote.init()
}));

const validateEmail = (email) => {
    return String(email)
        .toLowerCase()
        .match(
            /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        );
};///^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
const validatePhone = (phone) => {
    return String(phone)
        .toLowerCase()
        .match(
            /^\({0,1}((0|\+61)(2|4|3|7|8)){0,1}\){0,1}(\ |-){0,1}[0-9]{2}(\ |-){0,1}[0-9]{2}(\ |-){0,1}[0-9]{1}(\ |-){0,1}[0-9]{3}$/
        );
};

function change_toggle(obj) {
    obj.toggleClass('open');
    var row = obj.closest('tr');
    row.find('select:not(.d-none), input:not(.d-none), textarea:not(.d-none), textarea:not(.non-required)').toggleClass('kt-require');
    var included_element = obj.find('input[type=checkbox]');
    included_element.prop("checked", !included_element.prop("checked"));
}

function remake_index(table) {
    var length = table.find('tr').length;
    var target_id = table.find('.screen-reader-text a.refine-remove').attr('data-id');
    table.find('tr:not(.screen-reader-text)').each(function (index, element) {
        if ((index != 0) && (index != length - 1)) {
            $(element).find('td:first').html(index);
            $(element).find('td:eq(1) input[type=checkbox]').attr('name', 'default_' + target_id + '_' + index);
            $(element).find('td:eq(2) textarea').attr('name', 'description_' + target_id + '_' + index);
            $(element).find('td:eq(3) select').attr('name', 'category_' + target_id + '_' + index);
            $(element).find('td:eq(4) input[type=text]').attr('name', 'price_' + target_id + '_' + index);
            $(element).find('td:eq(5) input[type=number]').attr('name', 'quantity_' + target_id + '_' + index);
            $(element).find('td:eq(6) select').attr('name', 'quantity_type_' + target_id + '_' + index);
            $(element).find('td:eq(7) select').attr('name', 'margin_' + target_id + '_' + index);
        }
    });
}

function reindex_table(table) {
    table.find('tr:not(.screen-reader-text)').each(function (index, element) {
        if ((index != 0)) {
            $(element).find('td:first').html(index);
            $(element).find('td:eq(1) input[type=checkbox]').val(index - 1);
        }
    });
}

function aireno_calculate_quote() {
    var formData = new FormData($('#kt_quoting_form')[0]);
    formData.set('action', 'aireno_calculate_quote');
    // blockUI.block();
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
            // blockUI.release();
            Swal.fire({
                text: "Something went wrong. Plesae try again or contact the support",
                icon: "error",
                buttonsStyling: !1,
                confirmButtonText: "OK!",
                customClass: {confirmButton: "btn btn-danger"}
            });
        },
        success: function (result) {
            // blockUI.release();
            $('#total-quote').html('$' + result.total);
            $('[name=total_price]').val(result.total);
        }
    });
}

function calculateCustomFields(rowContainer) {
    var rowTotalPriceField = rowContainer.find('.customQuoteFieldTotalPrice');
    var rowPrice = 0;
    rowContainer.find('table tbody tr:not(.screen-reader-text)').each(function (index, row) {
        var included = $(row).find('> td:eq(1) [type=checkbox]').prop('checked');//
        if (included) {
            var price_val = ($(row).find('>td:eq(4) input').val()) ? $(row).find('>td:eq(4) input').val() : 0;
            var price = parseFloat(price_val);
            var quantity_val = ($(row).find('>td:eq(5) input').val()) ? $(row).find('>td:eq(5) input').val() : 0;
            var quantity = parseFloat(quantity_val);
            var margin_val = ($(row).find('>td:eq(7) input').val()) ? $(row).find('>td:eq(7) input').val() : 0;
            var margin = parseFloat(margin_val);
            rowPrice += price * quantity * (1 + margin / 100);
        }
    })
    rowTotalPriceField.val(rowPrice.toFixed(2));
    aireno_calculate_quote();
}

function applySuggestion(inputWrapper, parentWrapper) {
    inputWrapper.autocomplete({
        minLength: 0,
        source: titleList,
        appendTo: parentWrapper,
        change: function (event, ui) {
            if (ui.item == null) return;
            var data = ui.item;
            if (data.refine_price) {
                var table = $(this).closest('.customQuoteFieldRow').find('.refine-table');
                table.find('tr').each(function (index, element) {
                    if (index != 0 && index != 1) {
                        element.remove();
                    }
                });
                var refine_prices = data.refine_price;
                var idx = $('.customQuoteFieldContainer .customQuoteFieldRow').index($(this).closest('.customQuoteFieldRow'));
                var item_price = 0;
                for (var i in refine_prices) {
                    var refine_price = refine_prices[i];
                    var row = table.find('tr.screen-reader-text').clone().removeClass('screen-reader-text');
                    var index = table.find('tr:not(.screen-reader-text)').length;
                    row.find('td').eq(0).html(index);
                    row.find('td').eq(1).find('input[type=checkbox]').prop('checked', refine_price['default']).attr('name', 'customQuoteFieldIncluded' + idx + '[]').val(index - 1);
                    if (refine_price['default']) row.find('td').eq(1).find('.kd-switcher-container').addClass('open');
                    row.find('td').eq(2).find('textarea').val(refine_price['quote_description']).attr('name', 'customQuoteFieldDescription' + idx + '[]');
                    row.find('td').eq(3).find('select').val(refine_price['category']).attr('name', 'customQuoteFieldCategory' + idx + '[]');
                    row.find('td').eq(4).find('input').val(refine_price['price']).attr('name', 'customQuoteFieldPrices' + idx + '[]');
                    row.find('td').eq(5).find('input').val(refine_price['quantity']).attr('name', 'customQuoteFieldQuantity' + idx + '[]');
                    row.find('td').eq(6).find('select').val(refine_price['quantity_type']).attr('name', 'customQuoteFieldQuantityType' + idx + '[]');
                    row.find('td').eq(7).find('input').val(refine_price['margin']).attr('name', 'customQuoteFieldMargins' + idx + '[]');
                    if (refine_price['default'])
                        item_price += refine_price['price'] * refine_price['quantity'] * (1 + refine_price['margin'] / 100);
                    table.append(row);
                }
                $(this).closest('.customQuoteFieldRow').find('.customQuoteFieldTotalPrice').val(item_price);
                aireno_calculate_quote();
            }
        }
    }).bind('focus', function () {
        $(this).autocomplete("search");
    }).autocomplete("instance")._renderItem = function (ul, item) {
        return $("<li>")
            .append("<div class='ui-menu-item-wrapper'>" + item.label + "</div>")
            .appendTo(ul);
    };
}

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
                                Swal.fire({
                                    text: "Something went wrong. Please reload the page or try again!",
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "OK!",
                                    customClass: {confirmButton: "btn btn-light"}
                                });
                            },
                            success: function (result) {
                                btnRegisterSubmit.removeAttribute("data-kt-indicator");
                                btnRegisterSubmit.disabled = !1;
                                if (result.status) {
                                    $('select[name=client]').append($("<option></option>").attr("value", result.client.ID).text(result.client.display_name).attr('selected', 'selected'));
                                    registerForm.reset();
                                    modal.hide();
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
                                            $(templateClone).find('[data-kt-element="type"]').html(user.type);
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
               var displayName = $(this).attr('data-display-name');
               var email = $(this).attr('data-user-email');
                $('select[name=client]').append($("<option></option>").attr("value", userId).text(displayName + '(' + email + ')').attr('selected', 'selected'));
                modal.hide();
            });
        }
    };
}();
KTUtil.onDOMContentLoaded((function () {
    KTModalProjectClient.init();
}));