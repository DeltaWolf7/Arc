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
if (arcGetURLData("data1") == "post") {
    $blog = Blog::getBySEOUrl(arcGetURLData("data2"));
    arcAddHeader("title", $blog->title);
    arcAddHeader("keywords", $blog->tags);
    $charCount = 160;
    $content = $blog->content;
    if (strlen($blog->content) > $charCount) {
        $content = substr($blog->content, 0, $charCount - 1);
    }
    arcAddHeader("description", $content);
    arcAddHeader("", "<meta property=\"og:title\" content=\"" . $blog->title . "\" />" . PHP_EOL);
    arcAddHeader("", "\t<meta property=\"og:type\" content=\"Article\" />" . PHP_EOL);
    arcAddHeader("", "\t<meta property=\"og:description\" content=\"" . $content . "\" />" . PHP_EOL);
    arcAddHeader("", "\t<meta property=\"og:url\" content=\"http://" . $_SERVER['HTTP_HOST'] . arcGetModulePath() . arcGetURLData("data1") . "/" . arcGetURLData("data2") . "/\" />" . PHP_EOL);
    if (!empty($blog->image)) {
        arcAddHeader("", "\t<meta property=\"og:image\" content=\"http://" . $_SERVER['HTTP_HOST'] . arcGetModulePath() . arcGetURLData("data1") . "/images/" . $blog->image . "\"/>" . PHP_EOL);
    }
    arcAddHeader("", "\t<meta property=\"og:site_name\" content=\"" . ARCTITLE . "\" />" . PHP_EOL);
}