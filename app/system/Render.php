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

namespace system;

/**
 * Description of Render
 *
 * @author Craig Longford (deltawolf7@gmail.com)
 */
class Render {

    public static function arcRenderContent($uri) {

        // set session if it exists.
        if (isset($_POST["arcsid"])) {
            Helper::arcSetSession($_POST["arcsid"]);
        }

        if (Helper::arcIsAjaxRequest() == false) {

            // get route
            $route = \Router::getRoute($uri);
            $page = null;
            

            if ($route->id > 0) {
                // we have a route
                if (strlen($route->destination) > 0) {

                    // route has destination
                    $page = \Page::getBySEOURL($route->destination);
                } else {
                    // route is direct (no destination)
                    $page = \Page::getBySEOURL($uri);
                }
                

            } else {              
                // no route, 404
                $page = \Page::getBySEOURL("error");
                http_response_code(404);
                \Log::createLog("warning", "arc", "404: " . $uri);
            }
        } else {
            // new get
            if (isset($_POST["action"]) && $_POST["action"] == "getarcstatusmessages") {
                Helper::arcGetStatusMessages();
                return;
            }
        }

        // expired session - check for actual user because guests don't need to timeout.
        if (ARCSESSIONTIMEOUT > 0) {
            $timeout = ARCSESSIONTIMEOUT * 60;
            if (isset($_SESSION["LAST_ACTIVITY"]) && (time() - $_SESSION["LAST_ACTIVITY"] > $timeout) && isset($_SESSION["arc_user"])) {
                // 401 session timeout
                session_unset();
                session_destroy();
                $page = \Page::getBySEOURL("error");
                http_response_code(401);
                \Log::createLog("warning", "arc", "401: " . $uri);
            }
        } else {
            Helper::arcAddFooter("js", Helper::arcGetPath() . "vendor/arc/js/arckeepalive.js");
        }

        // update last activity time stamp
        $_SESSION["LAST_ACTIVITY"] = time();
       
        if (Helper::arcIsAjaxRequest() == false) {
            // get the current theme
            $theme = \SystemSetting::getByKey("ARC_THEME");

            // setup page
            Helper::arcAddHeader("title", $page->title);
            if (!empty($page->metadescription)) {
                Helper::arcAddHeader("description", $page->metadescription);
            }

            if (!empty($page->metakeywords)) {
                Helper::arcAddHeader("keywords", $page->metakeywords);
            }

            // Check the theme in config exists.
            if (!file_exists(Helper::arcGetPath(true) . "themes/" . $theme->value)) {
                $name = $theme->value;
                $theme->value = "beagle";
                $theme->update();
                die("Unable to find theme '" . $name . "'. Selected theme reset to 'beagle'.");
            }

            // If page has theme set, use it.
            if ($page->theme != "none") {
                $theme->value = $page->theme;
                // If page theme is not present, switch to global theme.
                if (!file_exists(Helper::arcGetPath(true) . "themes/" . $theme->value)) {
                    $theme = \SystemSetting::getByKey("ARC_THEME");
                }
            }

            // Check if the theme has a controller and include it if it does.
            if (file_exists(Helper::arcGetPath(true) . "themes/" . $theme->value . "/controller/controller.php")) {
                include_once Helper::arcGetPath(true) . "themes/" . $theme->value . "/controller/controller.php";
            }
        }

        $groups[] = \UserGroup::getByName("Guests");
        if (Helper::arcIsUserLoggedIn() == true) {
            $groups = array_merge($groups, Helper::arcGetUser()->getGroups());
        }

        if (Helper::arcIsAjaxRequest() == false) {
            if (!\Router::hasPermission($groups, $uri) && $page->seourl != "error") {
                // 403 permission denied
                $page = \Page::getBySEOURL("error");
                http_response_code(403);
                \Log::createLog("warning", "arc", "403: " . $uri);
            }

            // template
            if (!file_exists(Helper::arcGetPath(true) . "themes/" . $theme->value . "/template.php")) {
                die("Unable to find template.php for theme '" . $theme->value . "'.");
            }

            $content = file_get_contents(Helper::arcGetPath(true) . "themes/" . $theme->value . "/template.php");


            // custom menu
            if (file_exists(Helper::arcGetThemePath(true) . "menu.php")) {
                ob_start();
                include Helper::arcGetThemePath(true) . "menu.php";
                $newContent = ob_get_contents();
                ob_end_clean();
                $content = str_replace("{{arc:menu}}", $newContent, $content);
            }

            // header
            if ($page->showtitle == "1") {
                $content = str_replace("{{arc:title}}", "{$page->title}", $content);
            } else {
                $content = str_replace("{{arc:title}}", "", $content);
            }

            //template modules
            $content = Helper::arcProcessModuleTags($content);

            // impersonating
            if (isset($_SESSION["arc_imposter"])) {
                $content = str_replace("{{arc:impersonate}}", "<div class=\"alert alert-info\">Impersonating " . Helper::arcGetUser()->getFullname() . ". <a href=\"/arcsiu\">Stop impersonating user</a></div>", $content);
            } else {
                $content = str_replace("{{arc:impersonate}}", "", $content);
            }

            // body
            $content = str_replace("{{arc:content}}", Helper::arcProcessModuleTags(html_entity_decode($page->content)), $content);

            // page icon
            $content = str_replace("{{arc:pageicon}}", "<i class=\"" . $page->iconclass . "\"></i> ", $content);

            $content = Helper::arcProcessTags($content);

            echo $content;
        } else {
            $data = explode("/", $uri);
            if (isset($data[0]) && isset($data[1])) {
                include Helper::arcGetModuleControllerPath($data[0], $data[1], true);
            } else {
                \Log::createLog("danger", "Ajax", "Invalid url: '{$uri}'");
            }
        }
    }

}
