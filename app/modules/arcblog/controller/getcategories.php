<?php

if (system\Helper::arcIsAjaxRequest()) {
     $data = "<table class=\"table table-hover table-striped\">";
        $data .= "<thead><tr><th>Name</th><th class=\"text-right\"><button class=\"btn btn-primary btn-xs\" onclick=\"catBtn(0)\"><i class=\"fa fa-plus\"></i> New Category</button></th></tr></thead><tbody>";
        $cats = BlogCategory::getAllCategories();
        foreach ($cats as $cat) {
            $data .= "<tr><td>{$cat->name}</td><td class=\"text-right\"><button class=\"btn btn-default btn-xs\" onclick=\"catBtn({$cat->id})\"><i class=\"fa fa-edit\"></i> Edit</button> <button class=\"btn btn-default btn-xs\" onclick=\"catDelete({$cat->id})\"><i class=\"fa fa-remove\"></i> Delete</button></td></tr>";
        }
        $data .= "</tbody></table>";
        system\Helper::arcReturnJSON(["html" => $data]);
}
