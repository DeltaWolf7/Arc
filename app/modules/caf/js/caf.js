var editid = 0;

function edit(id) {
    editid = id;
    arcAjaxRequest("caf/editform", {id: editid}, null, successEdit); 
}

function successEdit(data) {
    $("#myModal").modal('show');
}

$("saveBtn").click(function() {
    arcAjaxRequest("caf/saveform", {id: id}, null, successSave);    
});