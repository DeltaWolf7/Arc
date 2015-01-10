<?php

class Blog extends DataProvider {

    public $date;
    public $title;
    public $content;
    public $image;
    public $tags;
    public $poster;
    public $categoryid;
    public $seourl;

    public function __construct() {
        parent::__construct();
        $this->date = date("y-m-d h:i:s");
        $this->title = "";
        $this->content = "";
        $this->image = "";
        $this->tags = "";
        $this->poster = "";
        $this->categoryid = 0;
        $this->seourl = "";
        $this->table = ARCDBPREFIX . "blog";
        $this->columns = ["id", "date", "title", "content", "image", "tags", "poster", "categoryid", "seourl"];
    }

    public static function getAllByCategory($catid) {
        $blogs = new Blog();
        return $blogs->getCollection(["categoryid" => $catid, "ORDER" => "date DESC"]);
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

    public function getThumbImage() {
        if (!empty($this->image)) {
            if (!file_exists(system\Helper::arcGetModulePath(true) . "images/thumbs/" . $this->image)) {

                $thumbWidth = SystemSetting::getByKey("ARC_BLOG_THUMB_WIDTH");
                $size = getimagesize(system\Helper::arcGetModulePath(true) . "images/" . $this->image);
                $ratio = $size[0] / $size[1]; // width/height
                if ($ratio > 1) {
                    $width = $thumbWidth->value;
                    $height = $thumbWidth->value / $ratio;
                } else {
                    $width = $thumbWidth->value * $ratio;
                    $height = $thumbWidth->value;
                }
                $src = imagecreatefromstring(file_get_contents(system\Helper::arcGetModulePath(true) . "images/" . $this->image));
                $dst = imagecreatetruecolor($width, $height);
                imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);
                imagedestroy($src);
                
                $extension = strtolower(strrchr(system\Helper::arcGetModulePath(true) . "images/" . $this->image, '.'));
                switch ($extension) {
                    case '.jpg':
                    case '.jpeg':
                        imagejpeg($dst, system\Helper::arcGetModulePath(true) . "images/thumbs/" . $this->image);
                        break;
                    case '.gif':
                        imagegif($dst, system\Helper::arcGetModulePath(true) . "images/thumbs/" . $this->image);
                        break;
                    case '.png':
                        imagepng($dst, system\Helper::arcGetModulePath(true) . "images/thumbs/" . $this->image);
                        
                        break;
                }
                imagedestroy($dst);
            }
            return system\Helper::arcGetPath() . "app/modules/blog/images/thumbs/" . $this->image;
        }
        return null;
    }

}
