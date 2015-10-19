function generate(userid) {
        arcAjaxRequest('<?php system\Helper::arcGetDispatch(); ?>', {user: userid}, complete, null);
    }
    
    function complete() {
        location.reload();
    }