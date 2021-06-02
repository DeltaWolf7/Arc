<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    $table = "<thead class=\"text-primary\"><tr><th>SEO Url</th><th>Title</th><th>Icon</th><th>Sort Order</th><th class=\"text-end\"><button onclick=\"editPage(0);\" class=\"btn btn-primary btn-sm\"><i class=\"fa fa-plus\"></i> Create</button></th></tr></thead>";
    $table .= "<tbody>";
    $pages = Page::getAllPages();
    foreach ($pages as $page) {
        $table .= "<tr>"
                . "<td>{$page->title}</td>"
                . "<td>{$page->seourl}</td>"
                . "<td><i class=\"" . $page->iconclass . "\"></i></td>"
                . "<td>{$page->sortorder}</td>"
                . "<td class=\"text-end\"><button class=\"btn btn-success btn-sm\" onclick=\"editPage({$page->id});\"><i class='fa fa-pencil'></i></button>"
                . " <button onclick=\"removePage({$page->id});\" class=\"btn btn-danger btn-sm\"><i class='fa fa-remove'></i></button></td>"
                . "</tr>";
    }
    $table .= "</tbody>";
    system\Helper::arcReturnJSON(["html" => $table]);
}