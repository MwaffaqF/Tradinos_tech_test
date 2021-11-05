$('#next-btn').on('click', function () {
    var stepNumber = $('ul.forms-wizard li.active').attr('data-step-number');
    $('.validation-error').html('');
    $('#smartwizard').find('input, .select2-selection.select2-selection--single, textarea').css('border', "solid 1px #ced4da");

    if (stepNumber == parseInt(stepsCount) - 2) {
        $('#next-btn').html('حفظ');
    }

    if (stepNumber == 0) {
        let verification = callbackNext();
        if (!verification) {
            validateStep(stepNumber);
        }
    } else {
        if (stepNumber == parseInt(stepsCount) - 1) {
            if (validateStep(stepNumber)) {
                $('#wizard-form').submit();
            }
        } else {
            validateStep(stepNumber);
        }
    }
    return true;
});

function validateStep(stepNumber) {
    var returnValue = false;
    var formData = new FormData();

    var action = $('#step' + stepNumber + '-action').val();
    var inputs = $('fieldset[title="' + stepNumber + '"] input, fieldset[title="' + stepNumber + '"] select, fieldset[title="' + stepNumber + '"] textarea');

    formData.append("csrf-token", $('meta[name="csrf-token"]').attr('content'));

    inputs.each(function (i) {
        formData.append($(this).attr("name"), $(this).val());
    });

    $.ajax({
        url: action,
        data: formData,
        type: "post",
        async: false,
        processData: false,
        contentType: false,
        success: function (data) {
            $('.wizard-errors').html('').hide();
            if (data.errors) {
                for (const [key, value] of Object.entries(data.errors)) {
                    $('.wizard-errors').append('<span class="validation-error">' + value + '</span><br>');
                    $('select[name="' + key + '"]').parent().append('<span class="validation-error" style="color: red;font-size: smaller">' + value + '</span>').find('.select2-selection.select2-selection--single').css('border', "solid 1px red");
                    $('input[name="' + key + '"]').css('border', "solid 1px red").parent().append('<span class="validation-error" style="color: red;font-size: smaller">' + value + '</span>');
                    $('select[name="' + key + '.0"]').parent().append('<span class="validation-error" style="color: red;font-size: smaller">' + value + '</span>').find('.select2-selection.select2-selection--single').css('border', "solid 1px red");
                    $('input[name="' + key + '.0"]').css('border', "solid 1px red").parent().append('<span class="validation-error" style="color: red;font-size: smaller">' + value + '</span>');
                }
                $('.validation-errors,.wizard-errors').show();
                returnValue = false;
            } else {
                $('#smartwizard').smartWizard("next");
                returnValue = true;
            }

        },
        error: function () {
            // alert('error loading');
        }
    });

    return returnValue;
}

$('#prev-btn').on('click', function () {
    $('#next-btn').html('التالي');
});

$('.clone-tab-element').on('click', function (e) {
        var tabName = $(this).attr('data-tab-name');
        var newTabNumber = parseInt($(this).attr('data-tab-number')) + 1;
        $('.' + tabName + '-nav-tabs > li > a').removeClass('active');
        $('.' + tabName + '-tab-content > .tab-pane').removeClass('active');
        $(this).before('<li class="nav-item"><a data-toggle="tab" href="#' + tabName + '-tab-' + newTabNumber + '" class="nav-link">العنصر ' + getSpellingOfNumber(newTabNumber) + '</a></li>');
        $('.' + tabName + '-tab-to-clone').find('select').select2("destroy");
        var tabhtml = $('.' + tabName + '-tab-to-clone').clone(false);
        tabhtml.find('input,select,textarea').val("");
        $('.' + tabName + '-tab-content').append(tabhtml);
        $(this).attr('data-tab-number', newTabNumber);
        tabhtml.removeClass(tabName + '-tab-to-clone');
        tabhtml.attr('id', tabName + '-tab-' + newTabNumber);
        var elements = $('#' + tabName + '-tab-' + newTabNumber).find('select');
        for (i = 0; i < elements.length; i++) {
            elements[i].setAttribute('id', elements[i].id + '_' + newTabNumber);
            elements[i].setAttribute('data-select2-id', elements[i].id);
            if (elements[i].hasAttribute('data-child-class')) {
                var childClassName = elements[i].getAttribute('data-child-class');
                elements[i].setAttribute('data-child-class', childClassName + '_' + newTabNumber);

            }
            if (elements[i].classList.contains(childClassName)) {
                elements[i].classList.remove(childClassName);
                elements[i].classList.add(childClassName + '_' + newTabNumber);
            }
        }
        tabhtml.addClass('active');
        tabhtml.find('select').val('').trigger('change');
        tabhtml.find('select').select2({
            allowClear: true,
            dir: "rtl",
            language: {
                noResults: function () {
                    return "لا توجد خيارات";
                }
            },
            // minimumResultsForSearch: Infinity
        });
        $('.' + tabName + '-tab-to-clone').find('select').select2({
            allowClear: true,
            dir: "rtl",
            language: {
                noResults: function () {
                    return "لا توجد خيارات";
                }
            },
        });
        $('.' + tabName + '-nav-tabs > li > a[href="#' + tabName + '-tab-' + newTabNumber + '"]').addClass('active');
        // $('.' + tabName + '-tab-to-clone').find('select').select2({
        //     allowClear: true,
        //     dir: "rtl",
        //     language: {
        //         noResults: function () {
        //             return "لا توجد خيارات";
        //         }
        //     },
        //     // minimumResultsForSearch: Infinity
        // });
        getAreasByGovernorate();
        getWeaknessesByType();
    }
);
