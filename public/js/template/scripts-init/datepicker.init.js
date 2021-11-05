var error_message = '<div class="alert alert-danger text-center dynamic-added">التاريخ المدخل غير صالح</div>';

//on year change
$(document).on('select2:select', '.select_year', function () {
    var year = $(this).val();
    var day = $(this).parent().parent().siblings().children().children('.select_day').val();
    var month = $(this).parent().parent().siblings().children().children('.select_month').val();

    handleDate($(this), day, month, year);
});

// on month change
$(document).on('select2:select', '.select_month', function () {
    var month = $(this).val();
    var day = $(this).parent().parent().siblings().children().children('.select_day').val();
    var year = $(this).parent().parent().siblings().children().children('.select_year').val();

    handleDate($(this), day, month, year);
});

// on day change
$(document).on('select2:select', '.select_day', function () {
    var day = $(this).val();
    var month = $(this).parent().parent().siblings().children().children('.select_month').val();
    var year = $(this).parent().parent().siblings().children().children('.select_year').val();

    handleDate($(this), day, month, year);
});

function handleDate(selector, day, month, year) {
    var row_parent = selector.parent().parent().parent().parent();


    if ((month == null) || (day == null) || (month == "") || (day == "")) {

        if (row_parent.children('.dynamic-added').length == 0) {
            row_parent.append(error_message);
        }
        return;
    }

    if ((month == 4) || (month == 6) || (month == 9) || (month == 11)) {
        if (day == 31) {
            if (row_parent.children('.dynamic-added').length == 0) {
                row_parent.append(error_message);
            }
            return;
        }
    }

    if ((month == 2) && (day > 29)) {
        if (row_parent.children('.dynamic-added').length == 0) {
            row_parent.append(error_message);
        }
        return;
    }

    row_parent.children('.dynamic-added').remove();

    if (day < 10) {
        day = "0" + day;
    }

    if (month < 10) {
        month = "0" + month;
    }

    var span = selector.parent().parent().siblings().children().children('.input-datepicker');
    var value = year + '-' + month + '-' + day;
    span.html(value);

    var input = selector.parent().parent().siblings(".input-date");
    input.val(value);
}

