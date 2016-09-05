<?php

namespace system;

/*
 * The MIT License
 *
 * Copyright 2015 Craig Longford.
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
include_once "medoo.php";

class Helper {

    /**
     * 
     * Array containing all Arc data
     */
    private static $arc = [];

    /**
     * 
     * Initialise the Helper class
     */
    public static function init() {
        // Start session
        session_start();

        // Initilise menu
        self::$arc["menus"] = [];

        // Set module path
        self::$arc["modulepath"] = "";

        // Version
        self::$arc["version"] = "0.4.0.7";

        // Initilise status
        if (!isset($_SESSION["status"])) {
            self::arcClearStatus();
        }

        // Create database connection
        try {
            if (ARCDBTYPE != "sqlite") {
                self::$arc["database"] = new \medoo([
                    "database_type" => ARCDBTYPE,
                    "database_name" => ARCDBNAME,
                    "server" => ARCDBSERVER,
                    "username" => ARCDBUSER,
                    "password" => ARCDBPASSWORD,
                    'charset' => ARCCHARSET,
                    'option' => [
                        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
                    ]
                ]);
            } else {
                self::$arc["database"] = new \medoo([
                    'database_type' => ARCDBTYPE,
                    'database_file' => ARCDBSERVER
                ]);
            }
        } catch (Exception $e) {
            die("Unable to connect to database. Please check 'Config.php'.<br />Exception: " . $e->getMessage());
        }

        // Javascript, add required javascript files to header
        self::arcAddFooter("js", self::arcGetPath() . "js/jquery.min.js");
        self::arcAddFooter("js", self::arcGetPath() . "js/bootstrap.min.js");
        self::arcAddFooter("js", self::arcGetPath() . "js/moment.min.js");
        self::arcAddFooter("js", self::arcGetPath() . "js/arc.min.js");
        self::arcAddFooter("js", self::arcGetPath() . "js/codemirror/codemirror.js");
        self::arcAddFooter("js", self::arcGetPath() . "js/codemirror/xml.js");
        self::arcAddFooter("js", self::arcGetPath() . "js/summernote.min.js");
        self::arcAddFooter("js", self::arcGetPath() . "js/bootstrap-datetimepicker.min.js");

        // CSS, add required css files to header
        self::arcAddHeader("css", self::arcGetPath() . "css/bootstrap.min.css");
        self::arcAddHeader("css", self::arcGetPath() . "css/font-awesome.min.css");
        self::arcAddHeader("css", self::arcGetPath() . "css/arc.min.css");
        self::arcAddHeader("css", self::arcGetPath() . "css/codemirror/codemirror.css");
        self::arcAddHeader("css", self::arcGetPath() . "css/codemirror/monokai.css");
        self::arcAddHeader("css", self::arcGetPath() . "css/summernote.css");
        self::arcAddHeader("css", self::arcGetPath() . "css/bootstrap-datetimepicker.min.css");

        // Get POST data
        self::$arc["post"] = [];
        foreach ($_POST as $key => $value) {
            self::$arc["post"][$key] = $value;
        }
    }

    /**
     * 
     * Returns the database class and connection
     * @return Medoo database class
     */
    public static function arcGetDatabase() {
        return self::$arc["database"];
    }

    /**
     * 
     * @global array $arc Arc settings storage
     * @param string $type title, description, keywords, author, alternate, canonical, css, js, favicon
     * @param string $content Value to assign to tag
     */
    public static function arcAddHeader($type, $content) {
        switch ($type) {
            case "title":
                self::$arc["headerdata"][] = "<title>" . $content . "</title>" . PHP_EOL;
                break;
            case "description":
                self::$arc["headerdata"][] = "<meta name=\"description\" content=\"" . $content . "\">" . PHP_EOL;
                break;
            case "keywords":
                self::$arc["headerdata"][] = "<meta name=\"keywords\" content=\"" . $content . "\">" . PHP_EOL;
                break;
            case "author":
                self::$arc["headerdata"][] = "<meta name=\"author\" content=\"" . $content . "\">" . PHP_EOL;
                break;
            case "alternate":
                self::$arc["headerdata"][] = "<link rel=\"alternate\" href=\"" . self::arcGetPath() . $content . "\">" . PHP_EOL;
                break;
            case "canonical":
                self::$arc["headerdata"][] = "<link rel=\"canonical\" href=\"" . $content . "\" />" . PHP_EOL;
                break;
            case "css":
                self::$arc["headerdata"][] = "<link href=\"" . $content . "\" rel=\"stylesheet\">" . PHP_EOL;
                break;
            case "js":
                self::$arc["headerdata"][] = "<script src=\"" . $content . "\"></script>" . PHP_EOL;
                break;
            case "favicon":
                self::$arc["headerdata"][] = "<link href=\"" . $content . "\" rel=\"icon\">" . PHP_EOL;
                break;
            default:
                self::$arc["headerdata"][] = $content;
                break;
        }
    }

    /**
     * 
     * @global array $arc Arc settings storage
     * @param string $type css, js
     * @param string $content Value to assign to tag
     */
    public static function arcAddFooter($type, $content) {
        switch ($type) {
            case "css":
                self::$arc["footerdata"][] = "<link href=\"" . $content . "\" rel=\"stylesheet\">" . PHP_EOL;
                break;
            case "js":
                self::$arc["footerdata"][] = "<script src=\"" . $content . "\"></script>" . PHP_EOL;
                break;
            default:
                self::$arc["footerdata"][] = $content;
                break;
        }
    }

    private static function arcGetPostData($name) {
        if (isset(self::$arc["post"][$name]))
            return self::$arc["post"][$name];
        return null;
    }

    /**
     * 
     * @param bool $filesystem True to return filesystem path, false for web path
     * @return string
     */
    public static function arcGetPath($filesystem = false) {
        if ($filesystem) {
            // fix for server that dont append /
            $path = $_SERVER["DOCUMENT_ROOT"];
            if (substr($path, -1) != "/") {
                $path .= "/";
            }
            return $path;
        }
        if (ARCFORCENOSSL == true) {
            return "http://{$_SERVER['HTTP_HOST']}/";
        }
        return "http" . (isset($_SERVER['HTTPS']) ? "s" : "") . "://" . "{$_SERVER['HTTP_HOST']}/";
    }

    /**
     * 
     * @global array $arc Arc settings storage
     * Adds header information to a page from header array
     */
    private static function arcGetHeader() {
        // output header
        $content = "";
        if (!empty(self::$arc["headerdata"])) {
            foreach (self::$arc["headerdata"] as $line) {
                $content .= $line;
            }
        }
        return $content;
    }

    /**
     * 
     * @global array $arc Arc settings storage
     * Adds footer information to a page from header array
     */
    private static function arcGetFooter() {
        // output header
        $content = "";
        if (!empty(self::$arc["footerdata"])) {
            foreach (self::$arc["footerdata"] as $line) {
                $content .= $line;
            }
        }
        $content .= "<script>var arcsid = '" . self::arcGetSessionID() . "'</script>";
        return $content;
    }

    /**
     * 
     * @param bool $filesystem Get filesystem path if true
     * @return string Path to content
     */
    public static function arcGetThemePath($filesystem = false) {
        $theme = \SystemSetting::getByKey("ARC_THEME");
        $uri = $_SERVER["REQUEST_URI"];
        $uri = trim($uri, '/');
        $page = \Page::getBySEOURL($uri);
        if ($page->id != 0 && $page->theme != "none") {
            $theme->value = $page->theme;
        }

        if ($filesystem) {
            return self::arcGetPath(true) . "themes/" . $theme->value . "/";
        }
        return self::arcGetPath() . "themes/" . $theme->value . "/";
    }

    /**
     * Get the view based on the request
     */
    private static function arcGetView() {
        $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
        $uri = $uri_parts[0];
        // set session if it exists.
        if (self::arcGetPostData("arcsid") != null) {
            self::arcSetSession(self::arcGetPostData("arcsid"));
        }

        //stop impersonating user
        if ($uri == "/arcsiu") {
            self::arcStopImpersonatingUser();
            $uri = "/";
        }

        if (self::arcIsAjaxRequest() == false) {
            // get page
            if ($uri == "/") {
                $defaultPage = \SystemSetting::getByKey("ARC_DEFAULT_PAGE");
                $uri = $defaultPage->value;
            }
            $uri = trim($uri, '/');

            $page = \Page::getBySEOURL($uri);
            // does page exist
            if ($page->id == 0) {
                $page = \Page::getBySEOURL("error");
                unset(self::$arc["post"]);
                self::$arc["post"]["error"] = "404";
                self::$arc["post"]["path"] = $_SERVER["REQUEST_URI"];
            }
        } else {
            // new get
            if (self::arcGetPostData("action") == "getarcstatusmessages") {
                self::arcGetStatusMessages();
                return;
            }
        }

        // expired session - check for actual user because guests don't need to timeout.
        if (ARCSESSIONTIMEOUT > 0) {
            $timeout = ARCSESSIONTIMEOUT * 60;
            if (isset($_SESSION["LAST_ACTIVITY"]) && (time() - $_SESSION["LAST_ACTIVITY"] > $timeout) && isset($_SESSION["arc_user"])) {
                session_unset();
                session_destroy();
                $page = \Page::getBySEOURL("error");
                unset(self::$arc["post"]);
                self::$arc["post"]["error"] = "401";
                self::$arc["post"]["path"] = $_SERVER["REQUEST_URI"];
            }
        } else {
            self::arcAddFooter("js", self::arcGetPath() . "js/arckeepalive.min.js");
        }

        // update last activity time stamp
        $_SESSION["LAST_ACTIVITY"] = time();

        if (self::arcIsAjaxRequest() == false) {
            // get the current theme
            $theme = \SystemSetting::getByKey("ARC_THEME");

            // setup page
            self::arcAddHeader("title", $page->title);
            if (!empty($page->metadescription)) {
                self::arcAddHeader("description", $page->metadescription);
            }
            if (!empty($page->metakeywords)) {
                self::arcAddHeader("keywords", $page->metakeywords);
            }

            // Check the theme in config exists.
            if (!file_exists(self::arcGetPath(true) . "themes/" . $theme->value)) {
                $name = $theme->value;
                $theme->value = "default";
                $theme->update();
                die("Unable to find theme '" . $name . "'. Selected theme reset to 'default'.");
            }

            // If page has theme set, use it.
            if ($page->theme != "none") {
                $theme->value = $page->theme;
                // If page theme is not present, switch to global theme.
                if (!file_exists(self::arcGetPath(true) . "themes/" . $theme->value)) {
                    $theme = \SystemSetting::getByKey("ARC_THEME");
                }
            }

            // Check if the theme has a controller and include it if it does.
            if (file_exists(self::arcGetPath(true) . "themes/" . $theme->value . "/controller/controller.php")) {
                include_once self::arcGetPath(true) . "themes/" . $theme->value . "/controller/controller.php";
            }
        }

        $groups[] = \UserGroup::getByName("Guests");
        if (self::arcIsUserLoggedIn() == true) {
            $groups = array_merge($groups, self::arcGetUser()->getGroups());
        }

        if (self::arcIsAjaxRequest() == false) {
            if (!\UserPermission::hasPermission($groups, $page->seourl)) {
                $page = \Page::getBySEOURL("error");
                unset(self::$arc["post"]);
                self::$arc["post"]["error"] = "403";
                self::$arc["post"]["path"] = $_SERVER["REQUEST_URI"];
            }

            // template
            if (!file_exists(self::arcGetPath(true) . "themes/" . $theme->value . "/template.php")) {
                die("Unable to find template.php for theme '" . $theme->value . "'.");
            }

            $content = file_get_contents(self::arcGetPath(true) . "themes/" . $theme->value . "/template.php");


            // custom menu
            if (file_exists(self::arcGetThemePath(true) . "menu.php")) {
                ob_start();
                include self::arcGetThemePath(true) . "menu.php";
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
            $content = self::arcProcessModuleTags($content);

            // impersonating
            if (isset($_SESSION["arc_imposter"])) {
                $content = str_replace("{{arc:impersonate}}", "<div class=\"alert alert-info\">Impersonating " . self::arcGetUser()->getFullname() . ". <a href=\"/arcsiu\">Stop impersonating user</a></div>", $content);
            } else {
                $content = str_replace("{{arc:impersonate}}", "", $content);
            }

            // body
            $content = str_replace("{{arc:content}}", self::arcProcessModuleTags(html_entity_decode($page->content)), $content);

            // page icon
            $content = str_replace("{{arc:pageicon}}", "<i class=\"" . $page->iconclass . "\"></i> ", $content);

            $content = self::arcProcessTags($content);

            echo $content;
        } else {
            $data = explode("/", $uri);
            if (isset($data[1]) && isset($data[2])) {
                include self::arcGetModuleControllerPath($data[1], $data[2], true);
            } else {
                \Log::createLog("danger", "Ajax", "Invalid url: '{$uri}'");
            }
        }

        self::$arc["modulepath"] = "";
    }

    public static function arcParseEmail($content, $message) {
        $content = self::arcProcessTags($content);

        // email body
        $content = str_replace("{{arc:emailcontent}}", $message, $content);

        return $content;
    }

    private static function arcProcessTags($content) {

        // site logo
        $logo = \SystemSetting::getByKey("ARC_LOGO_PATH");
        $content = str_replace("{{arc:sitelogo}}", self::arcGetPath() . $logo->value, $content);

        // path
        $content = str_replace("{{arc:path}}", self::arcGetPath(), $content);

        // themepath
        $content = str_replace("{{arc:themepath}}", self::arcGetThemePath(), $content);

        // version
        $content = str_replace("{{arc:version}}", self::arcGetVersion(), $content);

        // meta
        $content = str_replace("{{arc:header}}", self::arcGetHeader(), $content);

        // footer
        $content = str_replace("{{arc:footer}}", self::arcGetFooter(), $content);

        return $content;
    }

    public static function arcAddMessage($status, $data, $parameters = []) {
        $_SESSION["status"][] = ["data" => $data, "status" => $status, "parameters" => $parameters];
    }

    public static function arcClearStatus() {
        $_SESSION["status"] = [];
    }

    // new notification manager
    public static function arcGetStatusMessages() {
        $data = [];
        foreach ($_SESSION["status"] as $message) {
            $data["messages"] = array("message" => $message["data"], "type" => $message["status"],
                "parameters" => $message["parameters"]);
        }
        $_SESSION["status"] = [];
        self::arcReturnJSON($data);
    }

    /**
     * 
     * @return \User Return the logged in user object or null if no one
     */
    public static function arcGetUser() {
        if (isset($_SESSION["arc_user"])) {
            if (isset($_SESSION["arc_imposter"])) {
                return unserialize($_SESSION["arc_imposter"]);
            }
            return unserialize($_SESSION["arc_user"]);
        }
        return null;
    }

    /**
     * 
     * @param User $user Sets the logged in user
     */
    public static function arcSetUser($user) {
        $_SESSION["arc_user"] = serialize($user);
    }

    public static function arcImpersonateUser($user) {
        $_SESSION["arc_imposter"] = serialize($user);
    }

    public static function arcIsImpersonator() {
        if (isset($_SESSION["arc_imposter"])) {
            return true;
        }
        return false;
    }

    public static function arcGetImpersonator() {
        return unserialize($_SESSION["arc_user"]);
    }

    public static function arcStopImpersonatingUser() {
        if (isset($_SESSION["arc_imposter"])) {
            unset($_SESSION["arc_imposter"]);
        }
    }

    /**
     * Check if user is logged in
     * @return boolean true if they are
     */
    public static function arcIsUserLoggedIn() {
        if (self::arcGetUser() != null) {
            return true;
        }
        return false;
    }

    /**
     * 
     * Check if logged in user is in a group
     * @param string/array $groups Group name
     * @return boolean true if they are
     */
    public static function arcIsUserInGroup($groups = []) {
        if (self::arcIsUserLoggedIn() == true) {
            if (!is_array($groups)) {
                $newGroup = [];
                $newGroup[] = $groups;
                $groups = $newGroup;
            }
            $grps = self::arcGetUser()->getGroups();
            foreach ($groups as $group) {
                foreach ($grps as $grp) {
                    if ($group == $grp->name) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    /**
     * 
     * Is the logged in user an admin
     * @return boolean true if they are
     */
    public static function arcIsUserAdmin() {
        if (self::arcGetUser() == null) {
            return false;
        } else {
            return self::arcIsUserInGroup("Administrators");
        }
        return true;
    }

    private static function arcGetSessionID() {
        return session_id();
    }

    private static function arcSetSession($id) {
        session_id($id);
    }

    /**
     * 
     * @param string $destination Outputs a javascript redirect to root or specified url
     */
    public static function arcRedirect($destination = null) {
        ob_start();
        ob_clean();
        if (empty($destination)) {
            header("Location: " . self::arcGetPath());
        } else {
            header("Location: " . $destination);
        }
    }

    public static function arcGetMenu() {
        $menu = [];
        $pages = \Page::getAllPages();

        $groups[] = \UserGroup::getByName("Guests");
        if (self::arcIsUserLoggedIn() == true) {
            $groups = array_merge($groups, self::arcGetUser()->getGroups());
        }

        foreach ($pages as $page) {

            if ($page->hidefrommenu == true || ($page->hideonlogin == true && self::arcIsUserLoggedIn() == true)) {
                continue;
            }
            if (\UserPermission::hasPermission($groups, $page->seourl)) {
                $data = explode("/", $page->seourl);
                $menu[ucwords($data[0])][$page->title]["name"] = $page->title;
                $menu[ucwords($data[0])][$page->title]["url"] = $page->seourl;
                $menu[ucwords($data[0])][$page->title]["icon"] = $page->iconclass;
            }
        }

        return $menu;
    }

    public static function arcIsAjaxRequest() {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return true;
        }
        return false;
    }

    public static function arcGetThumbImage($image, $width = null) {
        if (!empty($image) && file_exists(self::arcGetPath(true) . "assets/{$image}")) {
            $thumbWidth = \SystemSetting::getByKey("ARC_THUMB_WIDTH");
            if ($width == null) {
                $width = $thumbWidth->value;
            }
            if (!file_exists(self::arcGetPath(true) . "assets/thumbs")) {
                mkdir(self::arcGetPath(true) . "assets/thumbs");
            }
            $filename = $width . "_" . $image;
            if (!file_exists(self::arcGetPath(true) . "assets/thumbs/{$filename}")) {
                $size = getimagesize(self::arcGetPath(true) . "assets/{$image}");
                $ratio = $size[0] / $size[1]; // width/height
                if ($ratio > 1) {
                    $width = $width;
                    $height = $width / $ratio;
                } else {
                    $width = $width * $ratio;
                    $height = $width;
                }
                $src = imagecreatefromstring(file_get_contents(self::arcGetPath(true) . "assets/{$image}"));
                $dst = imagecreatetruecolor($width, $height);
                imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);
                imagedestroy($src);

                $extension = strtolower(strrchr(self::arcGetPath(true) . "assets/{$image}", '.'));
                switch ($extension) {
                    case '.jpg':
                    case '.jpeg':
                        imagejpeg($dst, self::arcGetPath(true) . "assets/thumbs/{$filename}");
                        break;
                    case '.gif':
                        imagegif($dst, self::arcGetPath(true) . "assets/thumbs/{$filename}");
                        break;
                    case '.png':
                        imagepng($dst, self::arcGetPath(true) . "assets/thumbs/{$filename}");
                        break;
                }
                imagedestroy($dst);
            }
            return self::arcGetPath() . "assets/thumbs/{$filename}";
        }
        return null;
    }

    public static function arcCheckSettingExists($name, $value, $id = 0) {
        $setting = \SystemSetting::getByKey($name, $id);
        if (!\SystemSetting::keyExists($name, $id)) {
            $setting->value = $value;
            $setting->userid = $id;
            $setting->update();
            \Log::createLog("warning", "Setting", $name . " was initilised with value '" . $value . "', ID: '" . $id . "'");
        }
    }

    /**
     * 
     * @param type $array Array containing the key value parameters.
     * Echos out the array.
     */
    public static function arcReturnJSON($array) {
        echo utf8_encode(json_encode($array));
    }

    /**
     * 
     * @param type $filesystem
     * @return type
     */
    public static function arcGetModulePath($filesystem = false) {
        if (!$filesystem) {
            return self::arcGetPath() . self::$arc["modulepath"];
        }
        return self::arcGetPath(true) . self::$arc["modulepath"];
    }

    /**
     * 
     * @param string $name
     * @param type $controller
     * @param type $filesystem
     * @return type
     */
    public static function arcGetModuleControllerPath($name, $controller, $filesystem = false) {
        if (!$filesystem) {
            echo self::arcGetPath() . "{$name}/{$controller}";
        }
        return self::arcGetPath(true) . "app/modules/{$name}/controller/{$controller}.php";
    }

    /**
     * 
     * Process module tags in content
     * @param string $content
     * @return string
     */
    public static function arcProcessModuleTags($content) {
        preg_match_all('/{{module:([^,]+?):([^,]+?)}}/', $content, $matches);
        foreach ($matches[1] as $key => $filename) {
            foreach ($matches[2] as $key2 => $view) {
                ob_start();
                self::arcGetModule($filename, $view);
                $newContent = ob_get_contents();
                ob_end_clean();
                $content = str_replace("{{module:" . $filename . ":" . $view . "}}", $newContent, $content);
            }
        }
        return $content;
    }

    /**
     * 
     * @param string $name Module name
     * @param string $view View name
     * Includes the module by name and view along with controller if it exists.
     */
    private static function arcGetModule($name, $view) {
        if (!file_exists(self::arcGetPath(true) . "app/modules/{$name}")) {
            \Log::createLog("warning", "Modules", "Modules by the name of {$name} was not found.");
            return;
        }

        self::$arc["modulepath"] = "app/modules/{$name}/";

        if (file_exists(self::arcGetPath(true) . "app/modules/{$name}/controller/{$view}.php")) {
            include_once self::arcGetPath(true) . "app/modules/{$name}/controller/{$view}.php";
        }

        ob_start();
        if (file_exists(self::arcGetThemePath(true) . "override/{$name}/{$view}.php")) {
            include_once self::arcGetThemePath(true) . "override/{$name}/{$view}.php";
            // allow override on controller
            if (file_exists(self::arcGetThemePath(true) . "controller/override/{$name}/{$view}.php")) {
                include_once self::arcGetThemePath(true) . "controller/override/{$name}/{$view}.php";
            }
        } elseif (file_exists(self::arcGetPath(true) . "app/modules/{$name}/view/{$view}.php")) {
            include_once self::arcGetPath(true) . "app/modules/{$name}/view/{$view}.php";
        } else {
            echo "<div class=\"alert alert-danger\">The module '{$name}' has no view named '{$view}'.</div>";
            \Log::createLog("danger", "Modules", "The module '{$name}' has no view named '{$view}'.");
        }
        $newContent = ob_get_contents();
        self::arcProcessTags($newContent);
        ob_end_clean();
        echo $newContent;
    }

    /**
     * 
     * Returns the Arc version
     * @return string
     */
    public static function arcGetVersion() {
        return "Arc Version " . self::$arc["version"];
    }

    /**
     * Used to get Arc to build the content of the page or preform API request.
     */
    public static function getContent() {
        // Break URL apart and check for API request
        $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
        $uri = $uri_parts[0];

        if (strpos($uri, "/api/v1") === false) {
            // No API, Get regular content
            self::arcGetView();
        } else {
            // Handle API request
            $key = \SystemSetting::getByKey("ARC_APIKEY");
            $split = explode("/", $uri);

            if (!isset($_GET["key"])) {
                self::arcReturnJSON(["error" => "API key required to process request"]);
                \Log::createLog("danger", "API", "API key required to process request");
            } elseif (!isset($split[3]) || !file_exists(self::arcGetPath(true) . "app/modules/{$split[3]}/api")) {
                self::arcReturnJSON(["error" => "Invalid API request"]);
                \Log::createLog("danger", "API", "Invalid API request");
            } elseif (!isset($split[4]) || !file_exists(self::arcGetPath(true) . "app/modules/{$split[3]}/api/{$split[4]}.php")) {
                self::arcReturnJSON(["error" => "Invalid API method request"]);
                \Log::createLog("danger", "API", "Invalid API method request");
            } elseif (isset($value) && $key->value == $value) {
                self::arcReturnJSON(["error" => "Invalid API key"]);
                \Log::createLog("danger", "API", "Invalid API key");
            } else {
                include self::arcGetPath(true) . "app/modules/{$split[3]}/api/{$split[4]}.php";
                \Log::createLog("success", "API", "OK:: Module: {$split[3]}, Method: {$split[4]}");
            }
        }
    }

    /**
     * 
     * Converts a date to the format specified in settings.
     * @param string $date
     * @return date
     */
    public static function arcConvertDate($date) {
        $format = \SystemSetting::getByKey("ARC_DATEFORMAT");
        return date($format->value, strtotime($date));
    }

    /**
     * 
     * Converts a time to the format specified in settings.
     * @param string $date
     * @return date
     */
    public static function arcConvertTime($time) {
        $format = \SystemSetting::getByKey("ARC_TIMEFORMAT");
        return date($format->value, strtotime($time));
    }

    /**
     * 
     * Converts a date and time to the format specified in settings.
     * @param string $datetime
     * @return date
     */
    public static function arcConvertDateTime($datetime) {
        $formatD = \SystemSetting::getByKey("ARC_DATEFORMAT");
        $formatT = \SystemSetting::getByKey("ARC_TIMEFORMAT");
        return date($formatD->value . " " . $formatT->value, strtotime($datetime));
    }

    /**
     * 
     * @param string String to encrypt
     * @return string
     */
    public static function arcEncrypt($string) {
        $encryption_key = \SystemSetting::getByKey("ARC_PAIR")->value;
        $encrypted = openssl_encrypt($string, "aes-256-cbc", $encryption_key, 0, ARCIVKEYPAIR);
        return $encrypted;
    }

    /**
     * 
     * @param string String to decrypt
     * @return string
     */
    public static function arcDecrypt($string) {
        $encryption_key = \SystemSetting::getByKey("ARC_PAIR")->value;
        $decrypted = openssl_decrypt($string, "aes-256-cbc", $encryption_key, 0, ARCIVKEYPAIR);
        return $decrypted;
    }

}
