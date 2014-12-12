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
    require "../../../../config.php";
    if ($_POST["action"] == "setimage") {
        $post = new Blog();
        $post->getByID($_POST["id"]);
        if ($post->id != 0) {
            if (empty($_POST["image"])) {
                $post->image = "";
            } else {
                $post->image = $_POST["image"];
            }
        }
        $post->update();
    } elseif ($_POST["action"] == "savepost") {
        $post = new Blog();
        $post->getByID($_POST['id']);
        $post->categoryid = $_POST['categoryid'];
        $post->content = $_POST['editor'];
        $post->posterid = $_POST['poster'];
        $post->seourl = $_POST['seourl'];
        $post->tags = $_POST['tags'];
        $post->title = $_POST['title'];
        $post->update();
        echo "success|Post saved";
    }
}
