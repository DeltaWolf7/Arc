<?php

if (system\Helper::arcIsAjaxRequest() == true) {
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