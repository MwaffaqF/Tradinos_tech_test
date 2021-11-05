var FormWizard = function () {
    $(".select2_render").select2("destroy");
    var _componentWizard = function () {
        if (!$().steps) {
            console.warn('Warning - steps.min.js is not loaded.');
            return;
        }
        var form = $('.steps-basic').show();
        // Basic wizard setup
        $('.steps-basic').steps({
            headerTag: 'h6',
            bodyTag: 'fieldset',
            transitionEffect: 'fade',
            titleTemplate: '<span class="number">#index#</span> #title#',
            labels: {
                previous: '<i class="icon-arrow-right14 mr-2" /> السابق',
                next: 'التالي <i class="icon-arrow-left13 ml-2" />',
                finish: 'حفظ <i class="icon-arrow-left13 ml-2" />'
            },
            onStepChanging: function (event, currentIndex, newIndex) {

                // Allways allow previous action even if the current form is not valid!
                if (currentIndex > newIndex) {
                    return true;
                }

                if (currentIndex === 0 && $('#input-family_identifier').val()) {
                    var action = $('#step-action').val();
                    var familyIdentifier = $('#input-family_identifier').val();
                    var familyIdentifierType = $('#family_identifier_type_filter').val();
                    $.ajax({
                        url: action,
                        data: {familyIdentifier, familyIdentifierType,
                            "_token": $('meta[name="csrf-token"]').attr('content'),
                        },
                        type: "post",
                        success: function (data) {
                            if(data != null)
                            {
                                $('#input-card_number').val(data.card_number);
                                $('#input-card_letter').val(data.card_letter);
                                $('#type_filter').val(data.type).trigger('change');
                                $('#input-migrations_details').val(data.migrations_details);
                                $('#input-migrations_count').val(data.migrations_count);
                                $('#input-members_count').val(data.members_count);
                                $('#input-children_count').val(data.children_count);
                                $('#registration_type_filter').val(data.registration_type).trigger('change');
                                console.log('contacts are '+ data.last_contact);
                                console.log('accommodations are '+ data.last_accommodation);
                                if(data.last_contact)
                                {
                                    var contacts = data.last_contact;
                                    for(var k in contacts) {
                                        $('#contacts_type_filter').val(contacts[k].type).trigger('change');
                                        $('#input-value').val(contacts[k].value);
                                    }
                                }
                                if(data.last_accommodation)
                                {
                                    var accommodations = data.last_accommodation;
                                    for(var j in accommodations) {
                                        $('#accommodations_type_filter').val(accommodations[j].type).trigger('change');
                                        $('#accommodations_status_filter').val(accommodations[j].status).trigger('change');
                                        // $('#governorate_id_filter').val(accommodations[j].type).trigger('change');
                                        $('#accommodations_area_id_filter').val(accommodations[j].area_id).trigger('change');
                                        $('#accommodations_is_current_filter').val(accommodations[j].is_current).trigger('change');
                                        $('#input-details').val(accommodations[j].details);
                                    }
                                }

                            }
                        },
                        error: function () {
                            alert("error loading"); //TODO remove it :D
                        }
                    });
                }

                // Needed in some cases if the user went back (clean up)
                if (currentIndex < newIndex) {

                    // To remove error styles
                    form.find('.body:eq(' + newIndex + ') label.error').remove();
                    form.find('.body:eq(' + newIndex + ') .error').removeClass('error');
                }

                var validation_form = $("#wizard-form").find("fieldset[class='body current']");
                return validation_form.find("input,select,textarea").valid();
            },
            onFinishing: function (event, currentIndex) {
                var validation_form = $("#wizard-form").find("fieldset[class='body current']");
                if (validation_form.find("input,select").valid()) ;
                {
                    $("#wizard-form").trigger("submit");
                    return true;
                }
                return false;
            },
            onFinished: function (event, currentIndex) {

            }
        });


        // Stop function if validation is missing
        if (!$().validate) {
            console.warn('Warning - validate.min.js is not loaded.');
            return;
        }


        // Initialize validation
        $('.steps-basic').validate({
            ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
            errorClass: 'validation-invalid-label',
            bodyTag: "fieldset",
            message: 'الرجاء إكمال المعلومات',
            highlight: function (element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function (element, errorClass) {
                $(element).removeClass(errorClass);
            },

            // Different components require proper error label placement
            errorPlacement: function (error, element) {
                // Unstyled checkboxes, radios
                if (element.parents().hasClass('form-check')) {
                    error.appendTo(element.parents('.form-check').parent());
                }

                // Input with icons and Select2
                else if (element.parents().hasClass('form-group-feedback') || element.hasClass('select2-hidden-accessible')) {
                    error.appendTo(element.parent());
                }

                // Input group, styled file input
                else if (element.parent().is('.uniform-uploader, .uniform-select') || element.parents().hasClass('input-group')) {
                    error.appendTo(element.parent().parent());
                }

                // Other elements
                else {
                    error.insertAfter(element);
                }

            },
            rules: {
                email: {
                    email: true
                }
            }
        });
    };

    // Uniform
    var _componentUniform = function () {
        if (!$().uniform) {
            console.warn('Warning - uniform.min.js is not loaded.');
            return;
        }

        // Initialize
        $('.form-input-styled').uniform({
            fileButtonClass: 'action btn bg-blue'
        });
    };

    // Select2 select
    var _componentSelect2 = function () {
        if (!$().select2) {
            console.warn('Warning - select2.min.js is not loaded.');
            return;
        }

        // Initialize
        var $select = $('.select2_render').select2({
            allowClear: true,
            dir: "rtl",
            language: {
                noResults: function () {
                    return "لا توجد خيارات";
                }
            }
        });

        // Trigger value change when selection is made
        $select.on('change', function () {
            $(this).trigger('blur');
        });
    };
    //
    // Setup module components
    //


    // Show form

    // Wizard

    return {
        init: function () {
            _componentWizard();
            _componentUniform();
            _componentSelect2();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function () {
    FormWizard.init();
});