$("saveBtn").click(function() {
    arcAjaxRequest("caf/saveform", {id: id}, null, successEdit);    
});