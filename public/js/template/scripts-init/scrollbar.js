$(document).ready(function () {
    setTimeout(function () {
        if ($(".scrollbar-container")[0]) {
            $(".scrollbar-container").each(function () {
                new PerfectScrollbar($(this)[0], {wheelSpeed: 2, wheelPropagation: !1, minScrollbarLength: 20})
            });
        }
    }, 1e3)
});
