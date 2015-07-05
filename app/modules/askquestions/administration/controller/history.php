<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    if ($_POST["action"] == "saveNote") {
        $skype = new Skype();
        $skype->getByID($_POST["id"]);
        $skype->note = $_POST["data"];
        $skype->update();
        
        system\Helper::arcAddMessage("success", "Note saved.");
    }
}