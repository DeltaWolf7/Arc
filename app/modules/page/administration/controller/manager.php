<?php

if (isset($_POST["action"])) {
    if ($_POST["action"] == "edit") {
        $page = new Page();
        $page->getByID($_POST["id"]);

        echo json_encode(["title" => $page->title, "seourl" => $page->seourl,
            "metadescription" => $page->metadescription, "metakeywords" => $page->metakeywords,
            "seourl" => $page->seourl, "html" => html_entity_decode($page->content)]);
        return;
    } elseif ($_POST["action"] == "remove") {
        $page = new Page();
        $page->delete($_POST["id"]);
        return;
    }
     elseif ($_POST["action"] == "sav") {
        $page = new Page();
        $page->getByID($_POST["id"]);
        $page->content = htmlentities($_POST["html"]);
        $page->seourl = $_POST["seourl"];
        $page->metadescription = $_POST["metadescription"];
        $page->metakeywords = $_POST["metakeywords"];
        $page->title = $_POST["title"];
        $page->update();
        return;
    }
}