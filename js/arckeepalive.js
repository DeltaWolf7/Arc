var time = 300000; // 5 minutes

$(document).ready(function () {
    refreshSn();
});

function refreshSn() {
    setTimeout(function () {
        arcAjaxRequest("user/keepalive", {}, null, refreshSn());
    }, time);
};