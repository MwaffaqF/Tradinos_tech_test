$(document).ready(function () {
    $('.pickadate-selectors,.pickadate').pickadate({
        format: 'yyyy-mm-dd',
        min: new Date(2011,1,1),
        // max: true,
        selectYears: true,
        selectMonths: true
    });
});
// Arabic

jQuery.extend( jQuery.fn.pickadate.defaults, {
    monthsFull: [ 'كانون الثاني', 'شباط', 'آذار', 'نيسان', 'آيار', 'حزيران', 'تموز', 'آب', 'أيلول', 'تشرين الأول', 'تشرين الثاني', 'كانون الأول' ],
    monthsShort: [ 'كانون الثاني', 'شباط', 'آذار', 'نيسان', 'آيار', 'حزيران', 'تموز', 'آب', 'أيلول', 'تشرين الأول', 'تشرين الثاني', 'كانون الأول' ],
    weekdaysFull: [ 'الاحد', 'الاثنين', 'الثلاثاء', 'الاربعاء', 'الخميس', 'الجمعة', 'السبت' ],
    weekdaysShort: [ 'الاحد', 'الاثنين', 'الثلاثاء', 'الاربعاء', 'الخميس', 'الجمعة', 'السبت' ],
    today: 'اليوم',
    clear: 'مسح',
    close: 'إغلاق',
    format: 'yyyy-mm-dd',
    formatSubmit: 'yyyy-mm-dd'
});
