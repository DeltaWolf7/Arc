<?php

if (isset($_POST["action"])) {
    if ($_POST["action"] == "edit") {
        $page = new Page();
        $page->getByID($_POST["id"]);
        echo utf8_encode(json_encode(["title" => $page->title, "seourl" => $page->seourl,
            "metadescription" => $page->metadescription, "metakeywords" => $page->metakeywords,
            "seourl" => $page->seourl, "html" => html_entity_decode($page->content)]));
    } elseif ($_POST["action"] == "remove") {
        $page = new Page();
        $page->delete($_POST["id"]);
        echo json_encode(["status" => "success", "data" => "Page deleted"]);
    } elseif ($_POST["action"] == "save") {
        $page = new Page();
        $page->getByID($_POST["id"]);
        $page->content = htmlentities($_POST["html"]);
        $page->seourl = $_POST["seourl"];
        $page->metadescription = $_POST["metadescription"];
        $page->metakeywords = $_POST["metakeywords"];
        $page->title = $_POST["title"];
        $seo = Page::getBySEOURL($_POST["seourl"]);       
        if ($seo->id != 0 && $seo->id != $page->id) {
            echo json_encode(["status" => "danger", "data" => "Duplicate SEO Url found, please choose another"]);
            return;
        }
        $page->update();
        echo json_encode(["status" => "success", "data" => "Page saved"]);
    } elseif ($_POST["action"] == "getpages") {
        $table = "<tr><th>SEO Url</th><th>Title</th><th class=\"text-right\"><a onclick=\"editPage(0);\" class=\"btn btn-primary btn-sm\"><i class=\"fa fa-plus\"></i> New Page</a></th></tr>";
        $pages = Page::getAllPages();
        foreach ($pages as $page) {
            $table .= "<tr>"
                    . "<td>{$page->seourl}</td>"
                    . "<td>{$page->title}</td>"
                    . "<td class=\"text-right\"><a class=\"btn btn-default btn-sm\" onclick=\"editPage({$page->id});\"><i class='fa fa-edit'></i>&nbsp;Edit</a>"
                    . "&nbsp;<a onclick=\"removePage({$page->id});\" class=\"btn btn-default btn-sm\"><i class='fa fa-remove'></i>&nbsp;Remove</button></td>"
                    . "</tr>";
        }
        echo utf8_encode(json_encode(["html" => $table]));
    }
}