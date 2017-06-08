<?php

    if (system\Helper::arcIsAjaxRequest()) {

        $blog = Blog::getByID($_POST["id"]);
        $blog->image = "";
        $blog->update();

        system\Helper::arcAddMessage("success", "Image removed");
        system\Helper::arcReturnJSON(["image" => "<img class=\"rounded img-fluid\" src=\"" . $blog->getImage() . "\">"]);
    }