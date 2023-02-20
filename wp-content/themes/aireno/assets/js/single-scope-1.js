"use strict";
var KTEditScope = function() {
    var e, stepper, steps, btnSubmit, btnNext, stepperObj, a = [],
        kt_quoting_form;
    return {
        init: function() {
                stepper = document.querySelector("#kt_quoting_form_stepper"),
                kt_quoting_form = stepper.querySelector("#kt_quoting_form"),
                steps = $(stepper).find("#kt_quoting_form .kt-quoting-steps .kt-quoting-step"),
                btnSubmit = stepper.querySelector('[data-kt-stepper-action="submit"]');

            //Next, Prev, Submit button actions handler
            btnNext = stepper.querySelector('[data-kt-stepper-action="next"]');
            (stepperObj = new KTStepper(stepper)).on("kt.stepper.changed", (function(e) {
                steps.length === stepperObj.getCurrentStepIndex() ? (btnSubmit.classList.remove("d-none"),
                    btnSubmit.classList.add("d-inline-block"),
                    btnNext.classList.add("d-none")) : steps.length + 1 === stepperObj.getCurrentStepIndex() ? (btnSubmit.classList.add("d-none"), btnNext.classList.add("d-none")) : (btnSubmit.classList.remove("d-inline-block"), btnSubmit.classList.remove("d-none"), btnNext.classList.remove("d-none"))
            }));

            steps.length === stepperObj.getCurrentStepIndex() ? (btnSubmit.classList.remove("d-none"),
                btnSubmit.classList.add("d-inline-block"),
                btnNext.classList.add("d-none")) : steps.length + 1 === stepperObj.getCurrentStepIndex() ? (btnSubmit.classList.add("d-none"), btnNext.classList.add("d-none")) : (btnSubmit.classList.remove("d-inline-block"), btnSubmit.classList.remove("d-none"), btnNext.classList.remove("d-none"));

            // aireno_calculate_quote();

            stepperObj.on("kt.stepper.next", (function(e) {
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
                    '#kt_quoting_form .kt-quoting-step.current .refine-rows:not(.d-none) textarea.kt-require').each(function(index, elem) {
                    $(elem).removeClass('kt-error');
                    if (!$(elem).val()) {
                        if ($(elem).attr('name') == 'client') $(elem).siblings('span.select2').find('span.selection span.select2-selection').addClass('kt-error');
                        else $(elem).addClass('kt-error');
                        validated = false;
                    }
                });

                if (validated) {
                    $('#kt_quoting_form .kt-quoting-step.current .kt-error').removeClass('kt-error');
                    e.goNext();
                    KTUtil.scrollTop();
                } else {
                    Swal.fire({
                        text: "Please fill out all fields before go to next step.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "OK!",
                        customClass: { confirmButton: "btn btn-light" }
                    }).then((function() {
                        KTUtil.scrollTop()
                    }))
                }
            }));
            stepperObj.on("kt.stepper.previous", (function(e) {
                e.goPrevious(), KTUtil.scrollTop()
                if (1 == stepperObj.getCurrentStepIndex()) window.history.back();
            }));
            btnSubmit.addEventListener("click", (function(e) {
                var validated = true;

                //custom pricing validation
                $('#kt_quoting_form .kt-quoting-step.current .customQuoteFieldRow:not(.screen-reader-text) .customQuoteFieldTitle,' +
                    '#kt_quoting_form .kt-quoting-step.current .customQuoteFieldRow:not(.screen-reader-text) .customQuoteFieldTotalPrice,' +
                    '#kt_quoting_form .kt-quoting-step.current .customQuoteFieldRow:not(.screen-reader-text) tr:not(.screen-reader-text) textarea.kt-require,' +
                    '#kt_quoting_form .kt-quoting-step.current .customQuoteFieldRow:not(.screen-reader-text) tr:not(.screen-reader-text) input.kt-require').each(function(index, elem) {
                    if (!$(elem).val()) {
                        $(elem).addClass('kt-error');
                        validated = false;
                    }
                });
                if (validated) {
                    $('#kt_quoting_form .kt-quoting-step.current .kt-error').removeClass('kt-error');
                    btnSubmit.setAttribute("data-kt-indicator", "on");
                    btnSubmit.disabled = !0;
                    setTimeout((function() {
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
                            success: function(result) {
                                btnSubmit.removeAttribute("data-kt-indicator");
                                btnSubmit.disabled = !1;
                                window.location.href = result.redirect;
                            }
                        });
                    }), 2e3)
                } else {
                    Swal.fire({
                        text: "Please fill out all fields before go to next step.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "OK!",
                        customClass: { confirmButton: "btn btn-light" }
                    }).then((function() {
                        KTUtil.scrollTop()
                    }))
                }
            }));

            //
            $('body').on('change', '#kt_quoting_form .kt-quoting-step.current input.refine_item', function() {
                var target = $('#kt_quoting_form .kt-quoting-step.current  .refine-rows.refine-' + $(this).attr('data-target'));
                if ($(this).is('input[type=radio]')) {
                    $('#kt_quoting_form .kt-quoting-step.current .refine-rows').addClass('d-none');
                    $(this).parent().toggleClass('refine-active');
                    $(this).parent().parent().siblings('.refine-item-row').each(function(index, obj) {
                        $(this).find('.refine-active').removeClass('refine-active');
                    });
                    target.removeClass('d-none');
                } else if ($(this).is('input[type=checkbox]')) {
                    target.toggleClass('d-none');
                    $(this).parent().toggleClass('refine-active');
                } else {

                }
            });

            $('body').on('click', '.kd-switcher-container.kd-manual:not(.disabled)', function(e) {
                change_toggle($(this));
                var rowContainer = $(this).closest('.customQuoteFieldRow');
                var rowTotalPriceField = rowContainer.find('.customQuoteFieldTotalPrice');
                var rowPrice = 0;
                rowContainer.find('table tbody tr:not(.screen-reader-text)').each(function(index, row) {
                    var included = $(row).find('> td:eq(1) [type=checkbox]').prop('checked'); //
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

            $('body').on('click', '.kd-switcher-container:not(.kd-manual)', function(e) {
                change_toggle($(this));
                aireno_calculate_quote();
            });

            $('body').on('click', '#kt_quoting_form .kt-quoting-step.current a.refine-add', function() {
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
            $('body').on('click', '#kt_quoting_form .kt-quoting-step.current a.refine-remove', function() {
                var table = $(this).closest('table');
                var target_id = $(this).attr('data-id');
                $(this).closest('tr').remove();
                var target = $('[name=' + target_id + ']');
                var refine_count = parseInt(target.val());
                target.val(refine_count - 1);
                remake_index(table);
                aireno_calculate_quote();
            });

            $('body').on('click', '#kt_quoting_form .kt-quoting-step.current a.refine-actions-add', function() {
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
            $('body').on('click', '#kt_quoting_form .kt-quoting-step.current a.refine-actions-remove', function() {
                var table = $(this).closest('table');
                var rowContainer = $(this).closest('.customQuoteFieldRow');
                $(this).closest('tr').remove();
                reindex_table(table);
                calculateCustomFields(rowContainer);
                aireno_calculate_quote();
            });

            $('body').on('change', '#kt_quoting_form input.kt-calculate:not(.kt-custom)', function(e) {
                aireno_calculate_quote();
            });
            $('body').on('change', '#kt_quoting_form input.kt-calculate.kt-custom', function(e) {
                var rowContainer = $(this).closest('.customQuoteFieldRow');
                calculateCustomFields(rowContainer);
            });

            $('body').on('click', '#kt_quoting_form .kt-quoting-step.current [data-kt-dialer="true"] [data-kt-dialer-control="increase"]', function (e) {
                aireno_calculate_quote();
            });
            $('body').on('click', '#kt_quoting_form .kt-quoting-step.current [data-kt-dialer="true"] [data-kt-dialer-control="decrease"]', function (e) {
                aireno_calculate_quote();
            });

            $('body').on('click', '.populateCustomQuoteField', function() {
                var clones = $(this).siblings('.customQuoteFieldRow.screen-reader-text').clone().removeClass('screen-reader-text');

                var idx = $('.customQuoteFieldContainer .customQuoteFieldRow').length;
                var newWrapper = clones.appendTo($('.customQuoteFieldContainer'));
                newWrapper.find('.customQuoteFieldTitle').attr('name', 'customQuoteFieldTitle[]');
                newWrapper.find('.customQuoteFieldPrice').attr('name', 'customQuoteFieldPrice[]');
                newWrapper.find('.customQuoteFieldTotalPrice').attr('name', 'customQuoteFieldTotalPrice[]');
                newWrapper.find('.refine-table tr:not(.screen-reader-text)').each(function(index, row) {
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

            $('body').on('click', '.customQuoteFieldContainer .deleteCustomQuoteField', function() {
                $(this).closest('.customQuoteFieldRow').remove();

                $('.customQuoteFieldContainer .customQuoteFieldRow').each(function(idx, fieldRow) {
                    $(fieldRow).find('.refine-table tr:not(.screen-reader-text)').each(function(index, row) {
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
KTUtil.onDOMContentLoaded((function() {
    KTEditScope.init()
}));

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
    table.find('tr:not(.screen-reader-text)').each(function(index, element) {
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
    table.find('tr:not(.screen-reader-text)').each(function(index, element) {
        if ((index != 0)) {
            $(element).find('td:first').html(index);
            $(element).find('td:eq(1) input[type=checkbox]').val(index - 1);
        }
    });
}

function aireno_calculate_quote() {
    var formData = new FormData($('#kt_quoting_form')[0]);
    formData.set('action', 'aireno_calculate_quote');

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
            Swal.fire({
                text: "Something went wrong. Plesae try again or contact the support",
                icon: "error",
                buttonsStyling: !1,
                confirmButtonText: "OK!",
                customClass: {confirmButton: "btn btn-danger"}
            });
        },
        success: function(result) {
            $('#total-quote').html('$' + result.total);
            $('[name=total_price]').val(result.total);
        }
    });
}

function calculateCustomFields(rowContainer) {
    var rowTotalPriceField = rowContainer.find('.customQuoteFieldTotalPrice');
    var rowPrice = 0;
    rowContainer.find('table tbody tr:not(.screen-reader-text)').each(function(index, row) {
        var included = $(row).find('> td:eq(1) [type=checkbox]').prop('checked'); //
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
        change: function(event, ui) {
            if (ui.item == null) return;
            var data = ui.item;
            if (data.refine_price) {
                var table = $(this).closest('.customQuoteFieldRow').find('.refine-table');
                table.find('tr').each(function(index, element) {
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
    }).bind('focus', function() {
        $(this).autocomplete("search");
    }).autocomplete("instance")._renderItem = function(ul, item) {
        return $("<li>")
            .append("<div class='ui-menu-item-wrapper'>" + item.label + "</div>")
            .appendTo(ul);
    };
}