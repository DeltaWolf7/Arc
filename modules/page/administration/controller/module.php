<?php

/*
 * The MIT License
 *
 * Copyright 2014 Craig Longford.
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
 * AJAX data dispatch handler
 *
 * @author Craig Longford
 */
if (isset($_POST["action"])) {
    require "../../../../system/bootstrap.php";

    if ($_POST['action'] == "savepage") {

        $page = Page::getBySEOURL($_POST["seourl"]);
        if ($page->id == 0) {
            $page->seourl = $_POST["seourl"];
        }

        if (empty($_POST["seourl"])) {
            echo "danger|SEO Url can't be nothing.";
            return;
        }

        $input = html_entity_decode($_POST["editor"]);
        $page->content = $input;
        $page->title = $_POST["title"];
        $page->metadescription = $_POST["metadescription"];
        $page->metakeywords = $_POST["metakeywords"];
        $page->metatitle = $_POST["metatitle"];
        $page->update();

        echo "success|Page updated";
    } elseif ($_POST['action'] == "addpermission") {
        $permission = new UserPermission();
        $permission->groupid = $_POST['groupid'];
        $page = new Page();
        $page->getByID($_POST['pageid']);
        $permission->permission = "page/" . $page->seourl;
        $permission->update();
    }
}