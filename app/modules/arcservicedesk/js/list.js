$("#statusForm").submit(function( event ) {
    event.preventDefault();
    arcRedirect("?status=" + $("#status").val());    
});