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
        $this->date = date("y-m-d h:i:s");
        $this->title = "";
        $this->content = "";
        $this->image = "";
        $this->tags = "";
        $this->poster = "";
        $this->category = "[\"\"]";
        $this->seourl = "";
        $this->table = ARCDBPREFIX . "blog";
        $this->columns = ["id", "date", "title", "content", "image", "tags", "poster", "category", "seourl"];
    }

    public static function getAllBlogs() {
        $blogs = new Blog();
        return $blogs->getCollection(["ORDER" => "date DESC"]);
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
        return $blogs->getCollection(["ORDER" => "date DESC", "LIMIT" => $count]);
    }

    public static function getBySEOUrl($url) {
        $blog = new Blog();
        $blog->get(["SEOUrl" => $url]);
        return $blog;
    }

    public function getThumbImage($width = null) {
        if (!empty($this->image)) {
            $thumbWidth = SystemSetting::getByKey("ARC_BLOG_THUMB_WIDTH");
            if ($width == null) {
                $width = $thumbWidth->value;
            }
            if (!file_exists(system\Helper::arcGetModulePath(true) . "images/thumbs/{$this->image}")) {
                $size = getimagesize(system\Helper::arcGetModulePath(true) . "images/{$this->image}");
                $ratio = $size[0] / $size[1]; // width/height
                if ($ratio > 1) {
                    $width = $width;
                    $height = $width / $ratio;
                } else {
                    $width = $width * $ratio;
                    $height = $width;
                }
                $src = imagecreatefromstring(file_get_contents(system\Helper::arcGetModulePath(true) . "images/{$this->image}"));
                $dst = imagecreatetruecolor($width, $height);
                imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);
                imagedestroy($src);

                $extension = strtolower(strrchr(system\Helper::arcGetModulePath(true) . "images/{$this->image}", '.'));
                switch ($extension) {
                    case '.jpg':
                    case '.jpeg':
                        imagejpeg($dst, system\Helper::arcGetModulePath(true) . "images/thumbs/{$this->image}");
                        break;
                    case '.gif':
                        imagegif($dst, system\Helper::arcGetModulePath(true) . "images/thumbs/{$this->image}");
                        break;
                    case '.png':
                        imagepng($dst, system\Helper::arcGetModulePath(true) . "images/thumbs/{$this->image}");

                        break;
                }
                imagedestroy($dst);
            }
            return system\Helper::arcGetPath() . "app/modules/blog/images/thumbs/{$this->image}";
        }
        return null;
    }

    /**
     * 
     * @return \Blog Gets the group of the user
     */
    public function getCategories() {
        $groups = [];
        foreach (json_decode($this->category) as $group) {
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
