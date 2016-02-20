taskid = 0;

function edit(id) {
    taskid = id;
    arcAjaxRequest("taskmaster/getTask", {id: id}, null, editSuccess);
}

function editSuccess(data) {
    var jdata = arcGetJson(data);
    $('#created').data("DateTimePicker").date(jdata.created);
    $('#due').data("DateTimePicker").date(jdata.due);
    $("#description").val(jdata.description);
    $("#tags").val(jdata.tags);
    $("#assign").val(jdata.owner);
    $("#editModal").modal('show');
}

$(document).ready(function () {
    $('#created').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        sideBySide: true
    });
    $('#due').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        sideBySide: true
    });
});