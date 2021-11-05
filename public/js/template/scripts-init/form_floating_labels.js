/* ------------------------------------------------------------------------------
 *
 *  # Floating labels
 *
 *  Demo JS code for form_floating_labels.html page
 *
 * ---------------------------------------------------------------------------- */


// Setup module
// ------------------------------

var FloatingLabels = function() {


    //
    // Setup module components
    //

    // Floating labels config
    var _componentFloatingLabels = function() {

        // Variables
        var showClass = 'is-visible',
            animateClass = 'animate',
            labelWrapperClass = 'form-group-float',
            labelClass = 'form-group-float-label';

        // Setup
        $('input:not(.token-input):not(.bootstrap-tagsinput > input), textarea, select').on('checkval change', function () {

            // Define label
            var label = $(this).parents('.' + labelWrapperClass).children('.' + labelClass);

            // Toggle label
            if (this.value !== '') {
                label.addClass(showClass);
            }
            else {
                label.removeClass(showClass).addClass(animateClass);
            }

        }).on('keyup', function () {
            $(this).trigger('checkval');
        }).trigger('checkval').trigger('change');


        // Remove animation on page load
        $(window).on('load', function() {
            $('.' + labelWrapperClass).find('.' + showClass).removeClass(animateClass);
        });
    };







    // Multiselect
    var _componentMultiselect = function() {
        if (!$().multiselect) {
            console.warn('Warning - bootstrap-multiselect.js is not loaded.');
            return;
        }

        // Basic initialization
        $('.form-control-multiselect').multiselect({
            nonSelectedText: 'Bootstrap multiselect'
        });
    };

    // Select2
    var _componentSelect2 = function() {
        if (!$().select2) {
            console.warn('Warning - select2.min.js is not loaded.');
            return;
        }

        // Basic select
        $('.form-control-select2').select2();
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _componentFloatingLabels();
            _componentMultiselect();
            _componentSelect2();
        }
    }
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
    FloatingLabels.init();
});
