$(document).ready( function() {
    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {        
        console.log(numFiles);
        console.log(label);
    });
});

$(document).on('change', '.btn-file :file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');

    arcAjaxRequest("mediamanager/uploadfile", input[0].files[0], null, uploadComplete);
        
    input.trigger('fileselect', [numFiles, label]);
});

function uploadComplete(data) {
    var jdata = arcGetJson(data);
    
}

