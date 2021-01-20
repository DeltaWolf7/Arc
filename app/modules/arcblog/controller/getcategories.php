<?php

if (system\Helper::arcIsAjaxRequest()) {
     $data = "<table class=\"table table-striped\">";
     $data .= "<thead class=\"thead-default\">"
     . "<tr>"
     . "<th scope=\"col\">Name</th>"
     . "<th scope=\"col\">SEO Url</th>"
     . "<th class=\"text-right\">"
     . "<button class=\"btn btn-primary btn-sm\" onclick=\"catBtn(0)\"><i class=\"fa fa-plus\"></i> New Category</button>"
     . "</th>"
     . "</tr>"
     . "</thead><tbody>";
     $cats = BlogCategory::getAllCategories();
     foreach ($cats as $cat) {
        $data .= "<tr>"
            . "<td>{$cat->name}</td>"
            . "<td>{$cat->seourl}</td>"
            . "<td class=\"text-right\">"
            . "<button class=\"btn btn-success btn-sm\" onclick=\"catBtn({$cat->id})\"><i class=\"fa fa-pencil\"></i> Edit</button> "
            . "<button class=\"btn btn-danger btn-sm\" onclick=\"catDelete({$cat->id})\"><i class=\"fa fa-remove\"></i> Delete</button>"
            . "</td>"
            . "</tr>";
     }
     $data .= "</tbody></table>";
     
     system\Helper::arcReturnJSON(["html" => $data]);
}
