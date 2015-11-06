<?php

/*
 * The MIT License
 *
 * Copyright 2015 Craig.
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
     * Description of page
     *
     * @author Craig
     */
    class Page extends DataProvider {

        public $title;
        public $content;
        public $seourl;
        public $metadescription;
        public $metakeywords;
        public $sortorder;
        public $iconclass;
        public $showtitle;

        /**
         * Page constructor
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
            $this->table = ARCDBPREFIX . "pages";
            $this->columns = ["id", "title", "content", "seourl", "metadescription", "metakeywords", "sortorder", "iconclass", "showtitle"];
        }

        /**
         * 
         * @param string $seourl SEO Url
         * @return \Page
         */
        public static function getBySEOURL($seourl) {
            $page = new Page();
            $page->get(["seourl" => $seourl]);
            return $page;
        }

        public static function getAllPages() {
            $page = new Page();
            return $page->getCollection(["ORDER" => "sortorder ASC"]);
        }

        public function getPermissions() {
            $permissions = new UserPermission();
            return $permissions->getCollection(["permission" => $this->seourl]);
        }

    }

