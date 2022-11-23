<?php

/* 
 * The MIT License
 *
 * Copyright 2022 Craig Longford (deltawolf7@gmail.com).
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
        // Initilise title
        $this->title = "";
        // Initilise content
        $this->content = "";
        // Initilise meta description
        $this->metadescription = "";
        // Initilise meta keywords
        $this->metakeywords = "";
        // Initilise meta title
        $this->metatitle = "";
        // Initilise seo url
        $this->seourl = "";
        // Initilise sort order
        $this->sortorder = 0;
        // Initilise icon class
        $this->iconclass = "";
        // Initilise show title
        $this->showtitle = 1;
        // Initilise hide login
        $this->hideonlogin = 0;
        // Initilise hide from menu
        $this->hidefrommenu = 0;
        // Initilise theme
        $this->theme = "none";
        // Set table used by object
        $this->table = ARCDBPREFIX . "pages";
        // Set the property to column mapping
        $this->map = ["id" => "id", "title" => "title", "content" => "content",
            "seourl" => "seourl", "metadescription" => "metadescription", "metakeywords" => "metakeywords",
            "sortorder" => "sortorder", "iconclass" => "iconclass", "showtitle" => "showtitle",
            "hideonlogin" => "hideonlogin", "hidefrommenu" => "hidefrommenu", "theme" => "theme"];
    }

    /**
     * Get a page by its unique SEO URL from database
     * @param string $seourl SEO url
     * @return \Page Page object
     */
    public static function getBySEOURL($seourl) {
        // Create a new page class
        $page = new Page();
        // Get page data from database
        $page->get(["seourl" => $seourl, "LIMIT" => 1]);
        // Return page
        return $page;
    }

    /**
     * Get all pages from the database
     * @param bool $ignoreSortOrder Ignore sort order of pages
     * @return array Collection of page objects
     */
    public static function getAllPages($ignoreSortOrder = false) {
        // Create new page class
        $page = new Page();
        // Check if we need to sort the pages
        if ($ignoreSortOrder == false) {
            // Return sorted pages
            return $page->getCollection(["ORDER" => ['sortorder' => 'ASC']]);
        }
        // Return unsorted pages
        return $page->getCollection(["ORDER" => ['seourl' => 'ASC']]);
    }

    public static function searchPages($query) {
        // Create new page class
        $page = new Page();
        return $page->getCollection(["OR" => ["title[~]" => $query, "content[~]" => $query, "metakeywords[~]" => $query]]);
    }

    /**
     * Get the page from the database by its unique ID
     * @param int $id ID of the page to get
     * @return \Page Page object
     */
    public static function getByID($id) {
        // Create a new page class
        $page = new Page();
        // Get data from database
        $page->get(["id" => $id, "LIMIT" => 1]);
        // Return page object
        return $page;
    }
}
