<?php

if (system\Helper::arcIsAjaxRequest() == true) {
            $page = new Page();
            $page->delete($_POST["id"]);
            system\Helper::arcAddMessage("success", "Page deleted");
}