<?php

if (system\Helper::arcIsAjaxRequest() == true) {
            $page = Page::getByID($_POST["id"]);
            $page->delete();
            system\Helper::arcAddMessage("success", "Page deleted");
            system\Helper::arcReturnJSON();
}