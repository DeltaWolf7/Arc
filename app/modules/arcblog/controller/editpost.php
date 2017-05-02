<?php

if (system\Helper::arcIsAjaxRequest()) {
     $blog = Blog::getByID($_POST["id"]);
        $content = html_entity_decode($blog->content);
        $groups = $blog->getCategories();
        $group = " <label>Selected Categories</label><select class=\"form-control\" id=\"sel\" size=\"5\">";
        foreach ($groups as $cat) {
            $group .= "<option value=\"{$cat->name}\">{$cat->name}</option>";
        }
            $group .= "</select>";
            $img = "<img class=\"img-rounded\" src=\"";
        if (!empty($blog->image)) {
            $img .= system\Helper::arcGetThumbImage($blog->image, 195);
        } else {
            $img .= system\Helper::arcGetPath() . "app/modules/blog/images/placeholder.png";
        }
        $img .= "\" id=\"setImage\" />";

        system\Helper::arcReturnJSON(["title" => $blog->title, "content" => $content, "tags" => $blog->tags, "seourl" => $blog->seourl, "date" => $blog->date, "sel" => $group, "img" => $img]);
}
