<?php

if (system\Helper::arcIsAjaxRequest()) {
        $blog = Blog::getByID($_POST["id"]);
        $content = html_entity_decode($blog->content);
        $category = $blog->getCategory();
        $group = " <label>Selected Category</label><select class=\"form-control\" id=\"sel\" size=\"5\">";
        $categories = BlogCategory::getAllCategories();
        foreach ($categories as $cat) {
            $group .= "<option value=\"{$cat->id}\"";
            if ($cat->id == $category->id) {
                $group .= " selected";
            }
            $group .= ">{$cat->name}</option>";
        }
            $group .= "</select>";
            $img = "<img class=\"rounded img-fluid\" src=\"";
            $img .= $blog->getImage();
            $img .= "\" />";

        system\Helper::arcReturnJSON(["title" => $blog->title, "content" => $content, 
            "tags" => $blog->tags, "seourl" => $blog->seourl,
            "date" => system\Helper::arcConvertDateTime($blog->date),
            "sel" => $group, "img" => $img]);
}
