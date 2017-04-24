$(document).ready(function () {
    setInterval(function() { getItems(); }, 1000); // 1 seconds
});

function getItems() {
    arcAjaxRequest("arcboard/getitems", {}, null, updateDisplay);
}

function updateDisplay(data) {
    var jdata = arcGetJson(data);
    $("#data").html(jdata.html);
}