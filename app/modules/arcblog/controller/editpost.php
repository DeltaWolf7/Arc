<?php

if (system\Helper::arcIsAjaxRequest()) {
        $blog = Blog::getByID($_POST["id"]);
        $content = html_entity_decode($blog->content);
        $category = $blog->getCategory();
        $group = " <label>Selected Category</label><select class=\"form-control\" id=\"sel\" size=\"5\">";
        $categories = BlogCategory::getAllCategories();
        foreach ($categories as $cat) {
            $group .= "<option value=\"{$cat->name}\"";
            if ($cat->id == $category->id) {
                $group .= " selected";
            }
            $group .= ">{$cat->name}</option>";
        }
            $group .= "</select>";
            $img = "<img class=\"img-rounded\" src=\"";
        if (!empty($blog->image)) {
            $img .= $blog->image;
        } else {
            // no image
        }
        $img .= "\" id=\"setImage\" />";

        system\Helper::arcReturnJSON(["title" => $blog->title, "content" => $content, 
            "tags" => $blog->tags, "seourl" => $blog->seourl, "date" => $blog->date,
            "sel" => $group, "img" => $img]);
}
