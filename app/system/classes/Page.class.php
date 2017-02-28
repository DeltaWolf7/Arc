<?php

/* 
 * The MIT License
 *
 * Copyright 2017 Craig Longford (deltawolf7@gmail.com).
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * Page object
 */
class Page extends DataProvider {

    // Title of the page
    public $title;
    // Content of the Page
    public $content;
    // Search Engine Optomised URL
    public $seourl;
    // Meta description for search engines
    public $metadescription;
    // Meta keywords for search engines
    public $metakeywords;
    // Display sort order
    public $sortorder;
    // CSS class used for the page icon
    public $iconclass;
    // Show the page title?
    public $showtitle;
    // Hide the page after login?
    public $hideonlogin;
    // Hide the page from the menu?
    public $hidefrommenu;
    // Theme override for the page
    public $theme;

    /**
     * Default constructor
     */
    public function __construct() {
        parent::__construct();
        $this->title = "";
        $this->content = "";
        $this->metadescription = "";
        $this->metakeywords = "";
        $this->metatitle = "";
        $this->seourl = "";
        $this->sortorder = 0;
        $this->iconclass = "";
        $this->showtitle = true;
        $this->hideonlogin = false;
        $this->hidefrommenu = false;
        $this->theme = "none";
        $this->table = ARCDBPREFIX . "pages";
        $this->map = ["id" => "id", "title" => "title", "content" => "content",
            "seourl" => "seourl", "metadescription" => "metadescription", "metakeywords" => "metakeywords",
            "sortorder" => "sortorder", "iconclass" => "iconclass", "showtitle" => "showtitle",
            "hideonlogin" => "hideonlogin", "hidefrommenu" => "hidefrommenu", "theme" => "theme"];
        $this->columns = ["id", "title", "content", "seourl", "metadescription",
            "metakeywords", "sortorder", "iconclass", "showtitle", "hideonlogin",
            "hidefrommenu", "theme"];
    }

    /**
     * Get a page by its unique SEO URL from database
     * @param type $seourl
     * @return \Page
     */
    public static function getBySEOURL($seourl) {
        $page = new Page();
        $page->get(["seourl" => $seourl]);
        return $page;
    }

    /**
     * Get all pages from the database
     * @return type
     */
    public static function getAllPages() {
        $page = new Page();
        return $page->getCollection(["ORDER" => ['sortorder' => 'ASC']]);
    }

    /**
     * Get the User group permissions for the page
     * @return type
     */
    public function getPermissions() {
        $permissions = new UserPermission();
        return $permissions->getCollection(["permission" => $this->seourl]);
    }

    /**
     * Get the page from the database by its unique ID
     * @param type $id
     * @return \Page
     */
    public static function getByID($id) {
        $page = new Page();
        $page->get(["id" => $id]);
        return $page;
    }
}
