$(document).ready(function () {

    $('.editable_text').editable({
        emptytext: 'تعديل',
        params: {_token: $("meta[name=csrf-token]").attr("content"), _method: 'put'},
        error: function (data) {
            var error;
            $.each(data.responseJSON, function (key, data) {
                // console.log(key)
                $.each(data, function (index, data) {
                    error = data;
                });
            });
            return error;
        }
    });

    $('.editable_select').each(function () {
        var name = $(this).data('cat');
        var data = Option.getArray(name);
        var source = [];
        var extra = $(this).data('extra');

        if (jQuery.type(data) !== "string") {
            $.each(data, function (key, value) {
                source.push({id: key, text: value});
            });
        }


        $(this).editable({
            emptytext: 'تعديل',
            source: source,
            params: {_token: $("meta[name=csrf-token]").attr("content"), _method: 'put'},
            success: function (data) {

            },
            error: function (data) {
                var error;
                $.each(data.responseJSON, function (key, data) {
                    $.each(data, function (index, data) {
                        error = data;
                    });
                });
                return error;
            }
        });
    });

    $('.editable_date').editable({
        emptytext: 'تعديل',
        params: {_token: $("meta[name=csrf-token]").attr("content"), _method: 'put'},
        error: function (data) {
            var error;
            $.each(data.responseJSON, function (key, data) {
                $.each(data, function (index, data) {
                    error = data;
                });
            });
            return error;
        }
    });
});