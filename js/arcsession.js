var refreshSn = function ()
{
    var time = 600000; // 10 mins
    settimeout(function () {
        arcAjaxRequest("user/keepalive", {}, null, refreshSn());
    }, time);
};