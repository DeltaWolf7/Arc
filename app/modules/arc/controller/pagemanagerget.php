<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    $table = "<thead><tr><th>SEO Url</th><th>Title</th><th>Icon</th><th>Sort Order</th><th class=\"text-right\"><a onclick=\"editPage(0);\" class=\"btn btn-primary btn-xs\"><i class=\"fa fa-plus\"></i> Create</a></th></tr></thead>";
    $table .= "<tbody>";
    $pages = Page::getAllPages();
    foreach ($pages as $page) {
        $table .= "<tr>"
                . "<td>{$page->title}</td>"
                . "<td>{$page->seourl}</td>"
                . "<td><i class=\"" . $page->iconclass . "\"></i></td>"
                . "<td>{$page->sortorder}</td>"
                . "<td class=\"text-right\"><div class=\"btn-group\" role=\"group\"><a class=\"btn btn-success btn-xs\" onclick=\"editPage({$page->id});\"><i class='fa fa-pencil'></i> Edit</a>"
                . "&nbsp;<a onclick=\"removePage({$page->id});\" class=\"btn btn-danger btn-xs\"><i class='fa fa-remove'></i> Remove</a></div></td>"
                . "</tr>";
    }
    $table .= "</tbody>";
    system\Helper::arcReturnJSON(["html" => $table]);
}