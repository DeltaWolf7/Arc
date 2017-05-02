<?php

class Blog extends DataProvider {

    public $date;
    public $title;
    public $content;
    public $image;
    public $tags;
    public $poster;
    public $category;
    public $seourl;

    public function __construct() {
        parent::__construct();
        $this->date = date("y-m-d H:i:s");
        $this->title = "";
        $this->content = "";
        $this->image = "";
        $this->tags = "";
        $this->poster = "";
        $this->category = "[\"\"]";
        $this->seourl = "";
        $this->table = ARCDBPREFIX . "blog";
        $this->columns = ["id", "date", "title", "content", "image", "tags", "poster", "category", "seourl"];
        $this->map = ["id" => "id", "date" => "date", "title" => "title", "content" => "content", "image" => "image",
            "tags" => "tags", "poster" => "poster", "category" => "category", "seourl" => "seourl"];
    }

    public static function getByID($id) {
        $blog = new Blog();
        $blog->get(["id" => $id]);
        return $blog;
    }

    public static function getAllBlogs() {
        $blogs = new Blog();
        return $blogs->getCollection(["ORDER" => ["date" => "DESC"]]);
    }

    public static function getAllByCategory($name) {
        $blogs = Blog::getAllBlogs();
        $grpUsers = Array();
        foreach ($blogs as $blog) {
            if ($blog->inCategory($name)) {
                $grpUsers[] = $blog;
            }
        }
        return $grpUsers;
    }
    
    public function inCategory($name) {
        $groups = $this->getCategories();
        foreach ($groups as $group) {
            if ($group->name == $name) {
                return true;
            }
        }
        return false;
    }

    public static function getLatest($count = 10) {
        $blogs = new Blog();
        return $blogs->getCollection(["ORDER" => ["date" => "DESC"], "LIMIT" => $count]);
    }

    public static function getBySEOUrl($url) {
        $blog = new Blog();
        $blog->get(["SEOUrl" => $url]);
        return $blog;
    }

    /**
     * 
     * @return \Blog Gets the group of the user
     */
    public function getCategories() {
        $groups = [];
        $cats = json_decode($this->category);
        foreach ($cats as $group) {
            $grp = BlogCategory::getByName($group);
            if ($grp->id != 0) {
                $groups[] = $grp;
            }
        }
        return $groups;
    }

    /*
     * Add blog to group
     */

    public function addToCategory($name) {
        $groups = json_decode($this->category);
        foreach ($groups as $group) {
            if ($group == $name) {
                return;
            }
        }
        $groups[] = $name;
        $this->category = json_encode($groups);
        $this->update();
        echo $this->category;
    }

    /*
     * Remove blog from group
     */

    public function removeFromCategory($name) {
        $groups = json_decode($this->category);
        $newGroups = [];
        for ($i = 0; $i < count($groups); $i++) {
            if ($groups[$i] != $name) {
                $newGroups[] = $groups[$i];
            }
        }
        $this->category = json_encode($newGroups);
        $this->update();
    }

}
