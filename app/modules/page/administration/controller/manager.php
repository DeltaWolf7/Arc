<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    if (isset($_POST["action"])) {
        if ($_POST["action"] == "edit") {
            $page = new Page();
            $page->getByID($_POST["id"]);
            system\Helper::arcReturnJSON(["title" => $page->title, "seourl" => $page->seourl,
                "metadescription" => $page->metadescription, "metakeywords" => $page->metakeywords,
                "seourl" => $page->seourl, "html" => html_entity_decode($page->content)]);
        } elseif ($_POST["action"] == "remove") {
            $page = new Page();
            $page->delete($_POST["id"]);
            system\Helper::arcAddMessage("success", "Page deleted");
        } elseif ($_POST["action"] == "save") {
            $page = new Page();
            $page->getByID($_POST["id"]);
            $page->content = htmlentities($_POST["html"]);

            if (preg_match('`^[a-zA-Z0-9_]{1,}$`', $_POST["seourl"])) {
                $page->seourl = strtolower($_POST["seourl"]);
            } else {
                system\Helper::arcAddMessage("danger", "Invalid SEO Url");
                return;
            }

            $page->metadescription = $_POST["metadescription"];
            $page->metakeywords = $_POST["metakeywords"];
            $page->title = $_POST["title"];
            $seo = Page::getBySEOURL($_POST["seourl"]);
            if ($seo->id != 0 && $seo->id != $page->id) {
                system\Helper::arcAddMessage("danger", "Duplicate SEO Url found, please choose another");
                return;
            }
            $page->update();
            system\Helper::arcAddMessage("success", "Page saved");
        } elseif ($_POST["action"] == "getpages") {
            $table = "<thead><tr><th>SEO Url</th><th>Title</th><th class=\"text-right\"><a onclick=\"editPage(0);\" class=\"btn btn-primary btn-xs\"><i class=\"fa fa-plus\"></i> New Page</a></th></tr></thead>";
            $table .= "<tbody>";
            $pages = Page::getAllPages();
            foreach ($pages as $page) {
                $table .= "<tr>"
                        . "<td>{$page->seourl}</td>"
                        . "<td>{$page->title}</td>"
                        . "<td class=\"text-right\"><a class=\"btn btn-default btn-xs\" onclick=\"editPage({$page->id});\"><i class='fa fa-edit'></i>&nbsp;Edit</a>"
                        . "&nbsp;<a onclick=\"removePage({$page->id});\" class=\"btn btn-default btn-xs\"><i class='fa fa-remove'></i>&nbsp;Remove</button></td>"
                        . "</tr>";
            }
            $table .= "</tbody>";
            system\Helper::arcReturnJSON(["html" => $table]);
        }
    }
}