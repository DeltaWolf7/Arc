<?php

system\Helper::arcCheckSettingExists("ARC_BLOG_NOLATEST", "20");
system\Helper::arcCheckSettingExists("ARC_BLOG_CHAR_LIMIT", "150");

if (system\Helper::arcIsAjaxRequest() == true) {
    if ($_POST["action"] == "clearcache") {
        $thumbs = scandir(system\Helper::arcGetPath(true) . "images/thumbs/");
        foreach ($thumbs as $thumb) {
            if ($thumb != "." && $thumb != "..") {
                unlink(system\Helper::arcGetPath(true) . "images/thumbs/{$thumb}");
            }
        }
        system\Helper::arcAddMessage("success", "Cache has been cleaned");
    } elseif ($_POST["action"] == "posts") {
        $data = "<table class=\"table table-hover table-condensed\">";
        $data .= "<thead><tr><th>Title</th><th>Category</th><th>Date</th><th class=\"text-right\"><a class=\"btn btn-primary btn-xs\" onclick=\"editPost(0);\"><i class=\"fa fa-plus\"></i> New Post</a></th></tr></thead>";
        $data .= "<tbody>";
        $blogs = Blog::getAllBlogs();
        foreach ($blogs as $blog) {
            $data .= "<tr><td>{$blog->title}</td><td>";
            $categories = $blog->getCategories();
            foreach ($categories as $category) {
                $data .= "<i class=\"label label-default\">{$category->name}</i> ";
            }
            $data .= "</td><td>{$blog->date}</td><td class=\"text-right\"><a class=\"btn btn-default btn-xs\" href=\"#\" onclick=\"editPost({$blog->id});\"><i class=\"fa fa-pencil\"></i> Edit</a> <a class=\"btn btn-default btn-xs\"><i class=\"fa fa-remove\"></i> Delete</a></td></tr>";
        }
        $data .= "</tbody></table>";
        system\Helper::arcReturnJSON(["html" => $data]);
    } elseif ($_POST["action"] == "categories") {
        $data = "<table class=\"table table-hover table-condensed\">";
        $data .= "<thead><tr><th>Name</th><th class=\"text-right\"><a class=\"btn btn-primary btn-xs\" onclick=\"catBtn(0)\"><i class=\"fa fa-plus\"></i> New Category</a></th></tr></thead><tbody>";
        $cats = BlogCategory::getAllCategories();
        foreach ($cats as $cat) {
            $data .= "<tr><td>{$cat->name}</td><td class=\"text-right\"><a class=\"btn btn-default btn-xs\" onclick=\"catBtn({$cat->id})\"><i class=\"fa fa-edit\"></i> Edit</a> <a class=\"btn btn-default btn-xs\" onclick=\"catDelete({$cat->id})\"><i class=\"fa fa-remove\"></i> Delete</a></td></tr>";
        }
        $data .= "</tbody></table>";
        system\Helper::arcReturnJSON(["html" => $data]);
    } elseif ($_POST["action"] == "getpost") {
        $blog = new Blog();
        $blog->getByID($_POST["id"]);
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
    } elseif ($_POST["action"] == "getcategory") {
        $category = new BlogCategory();
        $category->getByID($_POST["id"]);
        system\Helper::arcReturnJSON(["name" => $category->name, "seourl" => $category->seourl]);
    } elseif ($_POST["action"] == "saveCategory") {
        $category = new BlogCategory();
        $category->getByID($_POST["id"]);

        if (empty($_POST["name"])) {
            system\Helper::arcAddMessage("danger", "Blog category must have a name");
            return;
        }

        if (empty($_POST["seourl"])) {
            system\Helper::arcAddMessage("danger", "Blog category must have a SEO Url");
            return;
        }

        $seocheck = BlogCategory::getBySEOUrl($_POST["seourl"]);
        if ($seocheck->id != $category->id) {
            system\Helper::arcAddMessage("danger", "SEO Url already in use by " . $seocheck->name);
            return;
        }

        $category->name = $_POST["name"];
        if (preg_match('`^[a-zA-Z0-9_]{1,}$`', $_POST["seourl"])) {
            $category->seourl = strtolower($_POST["seourl"]);
        } else {
            system\Helper::arcAddMessage("danger", "Invalid SEO Url");
            return;
        }

        $category->update();

        system\Helper::arcAddMessage("success", "Blog category saved");
    } elseif ($_POST["action"] == "deletecategory") {
        $category = new BlogCategory();
        $category->delete($_POST["id"]);
        system\Helper::arcAddMessage("success", "Blog category deleted");
    } elseif ($_POST["action"] == "addpostcat") {
        $blog = New Blog();
        $blog->getByID($_POST["id"]);
        
        if ($blog->id != 0) {
           $blog->addToCategory($_POST["catname"]);
           $blog->update();
           system\Helper::arcAddMessage("success", "Blog added to category");
           return;
        }
        
        system\Helper::arcAddMessage("danger", "New blog entries must be saved before adding categories");
    } elseif ($_POST["action"] == "rempostcat") {
        $blog = New Blog();
        $blog->getByID($_POST["id"]);
        
        if ($blog->id != 0) {
           $blog->removeFromCategory($_POST["catname"]);
           $blog->update();
           system\Helper::arcAddMessage("success", "Blog removed from category");
           return;
        }
        
        system\Helper::arcAddMessage("danger", "New blog entries must be saved before removing categories");
    } elseif ($_POST["action"] == "savePost") {
        $blog = new Blog();
        $blog->getByID($_POST["id"]);
        
        $blog->content = $_POST["content"];
        $blog->date = $_POST["date"];
        $blog->title = $_POST["title"];
        $blog->seourl = $_POST["seourl"];
        $blog->tags = $_POST["tags"];
        
        $user = new User();
        $user->getByID($_POST["poserid"]);
        $blog->poster = $user->getFullname();
        
        $blog->update();
        system\Helper::arcAddMessage("success", "Blog post saved");
    }
}