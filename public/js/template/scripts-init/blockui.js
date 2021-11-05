// BlockUI Loading


$('.app-container').block();

$(window).on('load', function () {
    $('.app-container').unblock();
});


$.blockUI.defaults = {
    message: $('' +
        '<div class="loader mx-auto">\n' +
        '                            <div class="line-scale-pulse-out">\n' +
        '                                <div class="bg-alert"></div>\n' +
        '                                <div class="bg-alert"></div>\n' +
        '                                <div class="bg-alert"></div>\n' +
        '                                <div class="bg-alert"></div>\n' +
        '                                <div class="bg-alert"></div>\n' +
        '                            </div>\n' +
        '                        </div>')
};

$(document).ajaxStart($.blockUI).ajaxStop($.unblockUI);


