<?php
if (system\Helper::arcGetURLData("action") == null) {
    system\Helper::arcOverrideView("manager", true);
}

if (isset($_POST["action"])) {
    require "../../../../config.php";

    if ($_POST['action'] == "savepage") {

        $page = Page::getBySEOURL($_POST["seourl"]);
        if ($page->id == 0) {
            $page->seourl = $_POST["seourl"];
        }
        
        if (empty($_POST["seourl"])) {
            echo "danger|SEO Url can't be nothing.";
            return;
        }
        
        $input = htmlentities($_POST["editor"]);
        $page->content = $input;
        $page->title = $_POST["title"];
        $page->metadescription = $_POST["metadescription"];
        $page->metakeywords = $_POST["metakeywords"];
        $page->metatitle = $_POST["metatitle"];
        $page->update();

        echo "success|Page updated";
    } elseif ($_POST['action'] == "addpermission") {
        $permission = new UserPermission();
        $permission->groupid = $_POST['groupid'];
        $page = new Page();
        $page->getByID($_POST['pageid']);
        $permission->permission = "page/" . $page->seourl;
        $permission->update();
    }
}