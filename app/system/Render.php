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

namespace system;

/**
 * Description of Render
 *
 * @author Craig Longford (deltawolf7@gmail.com)
 */
class Render {

    public static function arcRenderContent($uri) {
        // set session if it exists.
        if (isset($_POST['arcsid'])) {
            Helper::arcSetSession($_POST['arcsid']);
        }

        //stop impersonating user
        if ($uri == 'arcsiu') {
            Helper::arcStopImpersonatingUser();
            Helper::arcRedirect('/');
            return;
        }

        // uri sections
        $uriParts = Helper::arcGetURIAsArray($uri);

        if (Helper::arcIsAjaxRequest() == false) {

            // get route
            $route = \Router::getRoute($uri);
            $page = null;
            $routeProcessor = null;
            

            // check for route processor at root of uri, example "processor/category/product" if we have no route.
            if ($route->id == 0) {
                $testRoute = '';
                foreach ($uriParts as $part) {
                    // try to find a route.
                    $testRoute .= "/{$part}";
                    $testRoute = trim($testRoute, '/'); // get rid of slash at the start if we have one.
                    $route = \Router::getRoute($testRoute);
                    if ($route->id != 0) {
                        // did we find a route? If we did break the loop.
                        $routeProcessor = $testRoute;
                        break;
                    }
                    // if not keep trying.
                }
                // set router processor
                Helper::$arc['arc_processor'] = $routeProcessor;
            }

            if ($route->id > 0) {
                // we have a route
                if (strlen($route->destination) > 0) {
                    // route has destination
                    $page = \Page::getBySEOURL($route->destination);
                } else {
                    // route is direct (no destination)
                    $uriToRoute = $uri;
                    if ($routeProcessor != null) {
                        $uriToRoute = $routeProcessor;
                    }
                    $page = \Page::getBySEOURL($uriToRoute);
                }
            } else {               
                // no route, 404
                $page = \Page::getBySEOURL('error');
                http_response_code(404);
                \Log::createLog('warning', 'arc', "404: {$uri}");
            }
        } else {
            // new get
            if (isset($_POST['action']) && $_POST['action'] == 'getarcstatusmessages') {
                Helper::arcGetStatusMessages();
                return;
            }
        }

        // expired session - check for actual user because guests don't need to timeout.
        if (ARCSESSIONTIMEOUT > 0) {
            $timeout = ARCSESSIONTIMEOUT * 60;
            if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeout) && isset($_SESSION['arc_user'])) {
                // 401 session timeout
                session_unset();
                session_destroy();
                $page = \Page::getBySEOURL('error');
                http_response_code(401);
                \Log::createLog('warning', 'arc', "401: {$uri}");
            }
        } else {
            Helper::arcAddFooter('js', Helper::arcGetPath() . 'vendor/arc/js/arckeepalive.min.js');
        }

        // update last activity time stamp
        $_SESSION['LAST_ACTIVITY'] = time();
       
        if (Helper::arcIsAjaxRequest() == false) {
            // get the current theme
            $theme = \SystemSetting::getByKey('ARC_THEME');

            // setup page
            Helper::arcAddHeader('title', $page->title);
            if (!empty($page->metadescription)) {
                Helper::arcAddHeader('description', $page->metadescription);
            }

            if (!empty($page->metakeywords)) {
                Helper::arcAddHeader('keywords', $page->metakeywords);
            }

            // add in cononical and og:url.
            Helper::arcAddHeader('canonical', Helper::arcGetPath() . Helper::arcGetURI());

            // Check the theme in config exists.
            if (!file_exists(Helper::arcGetPath(true) . 'themes/' . $theme->value)) {
                $name = $theme->value;
                $theme->value = 'paper';
                $theme->update();
                die("Unable to find theme '{$name}'. Selected theme reset to '{$theme->value}'.");
            }

            // If page has theme set, use it.
            if ($page->theme != 'none') {
                $theme->value = $page->theme;
                // If page theme is not present, switch to global theme.
                if (!file_exists(Helper::arcGetPath(true) . 'themes/' . $theme->value)) {
                    $theme = \SystemSetting::getByKey('ARC_THEME');
                }
            }

            // Check if the theme has a controller and include it if it does.
            if (file_exists(Helper::arcGetPath(true) . 'themes/' . $theme->value . '/controller/controller.php')) {
                include_once Helper::arcGetPath(true) . 'themes/' . $theme->value . '/controller/controller.php';
            }

            $gAdsense = \SystemSetting::getByKey('ARC_GADSENSE');
            if (strlen($gAdsense->value) > 0) {
                Helper::arcAddFooter('external', '<script data-ad-client="' . $gAdsense->value . '" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>');
            }

            $gAnal = \SystemSetting::getByKey('ARC_GANAL');
            if (strlen($gAnal->value) > 0) {
                Helper::arcAddFooter('external', '<script async src="https://www.googletagmanager.com/gtag/js?id=' . $gAnal->value . '"></script>'
                . '<script>window.dataLayer = window.dataLayer || [];'
                . 'function gtag(){dataLayer.push(arguments);} gtag(\'js\', new Date());'
                . 'gtag(\'config\', \'' . $gAnal->value . '\');</script>');
            }
        }

        $groups[] = \UserGroup::getByName('Guests');
        if (Helper::arcIsUserLoggedIn() == true) {
            $groups = array_merge($groups, Helper::arcGetUser()->getGroups());
        }

        if (Helper::arcIsAjaxRequest() == false) {
            $uriToCheck = $uri;
            if ($routeProcessor != null) {
                $uriToCheck = $routeProcessor;
            }

            if (!\Router::hasPermission($groups, $uriToCheck) && $page->seourl != 'error') {
                // 403 permission denied
                $page = \Page::getBySEOURL('error');
                http_response_code(403);
                \Log::createLog('warning', 'arc', "403: {$uri}");
            }

            // template
            if (!file_exists(Helper::arcGetPath(true) . 'themes/' . $theme->value . '/template.php')) {
                die('Unable to find template.php for theme \'' . $theme->value . '\'.');
            }

            $content = file_get_contents(Helper::arcGetPath(true) . 'themes/' . $theme->value . '/template.php');

            // custom menu
            if (file_exists(Helper::arcGetThemePath(true) . 'menu.php')) {
                ob_start();
                include Helper::arcGetThemePath(true) . 'menu.php';
                $newContent = ob_get_contents();
                ob_end_clean();
                $content = str_replace('{{arc:menu}}', $newContent, $content);
            }

            // impersonating
            if (isset($_SESSION['arc_imposter'])) {
                $content = str_replace('{{arc:impersonate}}', '<div class="alert alert-info">Impersonating ' . Helper::arcGetUser()->getFullname() . '. <a href="/arcsiu">Stop impersonating user</a></div>', $content);
            } else {
                $content = str_replace('{{arc:impersonate}}', '', $content);
            }

            // body
            $content = str_replace('{{arc:content}}', Helper::arcProcessModuleTags(html_entity_decode($page->content)), $content);
            
            // header
            if ($page->showtitle == '1') {
                $oTitle = Helper::arcGetTitleOverride();
                if ($oTitle != "") {
                    $content = str_replace('{{arc:title}}', "{$oTitle}", $content);
                } else {
                    $content = str_replace('{{arc:title}}', "{$page->title}", $content);
                }
            } else {
                $content = str_replace('{{arc:title}}', '', $content);
            }

            // page icon
            $content = str_replace('{{arc:pageicon}}', '<i class="' . $page->iconclass . '"></i> ', $content);

            //template modules
            $content = Helper::arcProcessModuleTags($content);
            $content = Helper::arcProcessTags($content);

            echo $content;
        } else {
            if (count($uriParts) == 2) {
                // module ajax request
                include Helper::arcGetModuleControllerPath($uriParts[0], $uriParts[1], true);
            } else if (count($uriParts) == 4 && $uriParts[0] == 'addons') {
                // addon ajax request
                include Helper::arcGetAddonControllerPath($uriParts[1], $uriParts[2], $uriParts[3], true);
            } else {
                \Log::createLog('danger', 'Ajax', "Invalid url: '{$uri}'");
            }
        }
    }

    public static function arcRenderSearch($searchquery) {

        // set session if it exists.
        if (isset($_POST['arcsid'])) {
            Helper::arcSetSession($_POST['arcsid']);
        }

        // expired session - check for actual user because guests don't need to timeout.
        if (ARCSESSIONTIMEOUT > 0) {
            $timeout = ARCSESSIONTIMEOUT * 60;
            if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeout) && isset($_SESSION['arc_user'])) {
                // 401 session timeout
                session_unset();
                session_destroy();
                $page = \Page::getBySEOURL('error');
                http_response_code(401);
            }
        } else {
            Helper::arcAddFooter('js', Helper::arcGetPath() . 'vendor/arc/js/arckeepalive.min.js');
        }

        // update last activity time stamp
        $_SESSION['LAST_ACTIVITY'] = time();
       
            // get the current theme
            $theme = \SystemSetting::getByKey('ARC_THEME');

            // setup page
            Helper::arcAddHeader('title', 'Search results for \'' . $searchquery . '\'');

            // Check if the theme has a controller and include it if it does.
            if (file_exists(Helper::arcGetPath(true) . 'themes/' . $theme->value . '/controller/controller.php')) {
                include_once Helper::arcGetPath(true) . 'themes/' . $theme->value . '/controller/controller.php';
            }

            $gAdsense = \SystemSetting::getByKey('ARC_GADSENSE');
            if (strlen($gAdsense->value) > 0) {
                Helper::arcAddFooter('external', '<script data-ad-client="' . $gAdsense->value . '" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>');
            }

            $gAnal = \SystemSetting::getByKey('ARC_GANAL');
            if (strlen($gAnal->value) > 0) {
                Helper::arcAddFooter('external', '<script async src="https://www.googletagmanager.com/gtag/js?id=' . $gAnal->value . '"></script>'
                . '<script>window.dataLayer = window.dataLayer || [];'
                . 'function gtag(){dataLayer.push(arguments);} gtag(\'js\', new Date());'
                . 'gtag(\'config\', \'' . $gAnal->value . '\');</script>');
            }

            // template
            if (!file_exists(Helper::arcGetPath(true) . 'themes/' . $theme->value . '/template.php')) {
                die('Unable to find template.php for theme \'' . $theme->value . '\'.');
            }

            $content = file_get_contents(Helper::arcGetPath(true) . 'themes/' . $theme->value . '/template.php');

            // custom menu
            if (file_exists(Helper::arcGetThemePath(true) . 'menu.php')) {
                ob_start();
                include Helper::arcGetThemePath(true) . 'menu.php';
                $newContent = ob_get_contents();
                ob_end_clean();
                $content = str_replace('{{arc:menu}}', $newContent, $content);
            }

            // header
            $content = str_replace('{{arc:title}}', 'Search results for \'' . $searchquery  . '\'', $content);

            // impersonating
            if (isset($_SESSION['arc_imposter'])) {
                $content = str_replace('{{arc:impersonate}}', '<div class="alert alert-info">Impersonating ' . Helper::arcGetUser()->getFullname() . '. <a href="/arcsiu">Stop impersonating user</a></div>', $content);
            } else {
                $content = str_replace('{{arc:impersonate}}', '', $content);
            }

            // body
            ob_start();
            $dir = new \DirectoryIterator(Helper::arcGetPath(true) . "app/modules");
            foreach ($dir as $fileinfo) {
                if (!$fileinfo->isDot()) {
                    if (is_dir(Helper::arcGetPath(true) . "app/modules/" . $dir . "/search")) {
                        $s = new \DirectoryIterator(Helper::arcGetPath(true) . "app/modules/" . $dir . "/search");
                        foreach ($s as $job) {
                            if (!$job->isDot()) {
                                include_once(Helper::arcGetPath(true) . "app/modules/" . $dir . "/search/" . $job);
                            }
                        }
                    }
                }
            }

            $newContent = ob_get_contents();
            if (Helper::arcHasSearchResults() == false) {
                $newContent .= "<div class=\"card\"><div class=\"card-body\">"
                 . "<h2 class=\"text-primary\"><i class=\"fas fa-brain\"></i> Brain fuzz..</h2>"
                 . "<p>Sorry, I couldn't find anything matching <strong>'{$searchquery }'</strong>. Maybe it got lost somewhere in my circuits.</p>"
                 . "<p>Why not try searching again using different words?</p>"
                 . "</div></div>";
            }

            ob_end_clean();
            $content = str_replace('{{arc:content}}', $newContent, $content);
            
            //template modules
            $content = Helper::arcProcessModuleTags($content);
            $content = Helper::arcProcessTags($content);

            echo $content;
    }

}