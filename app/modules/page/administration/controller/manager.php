<?php

if (isset($_POST["action"])) {
    if ($_POST["action"] == "edit") {
        $page = new Page();
        $page->getByID($_POST["id"]);

        echo json_encode(["title" => $page->title, "seourl" => $page->seourl,
            "metadescription" => $page->metadescription, "metakeywords" => $page->metakeywords,
            "seourl" => $page->seourl, "html" => html_entity_decode($page->content)]);
        return;
    }
}