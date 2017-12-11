<?php

if (system\Helper::arcIsAjaxRequest()) {
     $blog = New Blog();
        $blog->getByID($_POST["id"]);
        
        if ($blog->id != 0) {
           $blog->addToCategory($_POST["catname"]);
           $blog->update();
           system\Helper::arcAddMessage("success", "Blog added to category");
           return;
        }
        
        system\Helper::arcAddMessage("danger", "New blog entries must be saved before adding categories");
        system\Helper::arcReturnJSON([]);
}