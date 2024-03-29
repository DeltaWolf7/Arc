<?php

namespace system;

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

use Medoo\Medoo;

class Helper {

    /**
     * 
     * Array containing all Arc data
     */
    public static $arc = [];

    /**
     * 
     * Initialise the Helper class
     */
    public static function Init() {
        // Start session
        session_start();

        // Initilise menu
        self::$arc["menus"] = [];

        // Set module path
        self::$arc["modulepath"] = "";

        // Version
        self::$arc["version"] = "1.0.0.1";

        // Search Results Flag
        self::$arc["hassearchresults"] = false;

        // Title override
        self::$arc["titleoverride"] = "";

        // Route processor
        self::$arc['arc_processor'] = null;

        // Initilise status
        if (!isset($_SESSION["status"])) {
            self::arcClearStatus();
        }

        // Create database connection
        try {
            if (ARCDBTYPE != "sqlite") {
                self::$arc["database"] = new Medoo([
                    "database_type" => ARCDBTYPE,
                    "database_name" => ARCDBNAME,
                    "server" => ARCDBSERVER,
                    "username" => ARCDBUSER,
                    "password" => ARCDBPASSWORD,
                    'charset' => ARCCHARSET,
                    'logging' => false,
                    'option' => [
                        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
                    ]
                ]);
            } else {
                self::$arc["database"] = new Medoo([
                    'database_type' => ARCDBTYPE,
                    'database_file' => ARCDBSERVER
                ]);
            }
        } catch (\Exception $e) {
            die("Unable to connect to database. Please check 'Config.php'.<br />Exception: " . $e->getMessage());
        }

        // Javascript, add required javascript files to header
        self::arcAddFooter('external', '<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>');
        self::arcAddFooter('external', '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>');
        self::arcAddHeader('external', '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha256-IUOUHAPazai08QFs7W4MbzTlwEWFo7z/4zw8YmxEiko=" crossorigin="anonymous">');
        self::arcAddFooter('external', '<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/min/moment.min.js" integrity="sha256-80OqMZoXo/w3LuatWvSCub9qKYyyJlK0qnUCYEghBx8=" crossorigin="anonymous"></script>');
        self::arcAddFooter('external', '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.0/css/all.min.css" integrity="sha256-AbA177XfpSnFEvgpYu1jMygiLabzPCJCRIBtR5jGc0k=" crossorigin="anonymous">');
        self::arcAddFooter('js', self::arcGetPath() . 'vendor/arc/js/arc.js');

        // CSS, add required css files to header
        self::arcAddHeader('css', self::arcGetPath() . 'vendor/arc/css/arc.css');
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
                $title = \SystemSetting::getByKey("ARC_SITETITLE");
                self::$arc["headerdata"][$type] = "<title>{$title->value} | {$content}</title>" . PHP_EOL;
                self::$arc["headerdata"]["og:title"] = "<meta property=\"og:title\" content=\"{$content} - {$title->value}\">" . PHP_EOL;
                break;
            case "description":
                self::$arc["headerdata"]["og:description"] = "<meta property=\"og:description\" content=\"{$content}\">" . PHP_EOL;
            case "keywords":
            case "author":
            case "viewport":
                if ($type == "description" && strlen($content) > 160) {
                    $content = substr($content, 0, 160);
                }
                self::$arc["headerdata"][$type] = "<meta name=\"{$type}\" content=\"{$content}\" />" . PHP_EOL;
                break;
            case "alternate":
            case "canonical":
                self::$arc["headerdata"][$type] = "<link rel=\"{$type}\" href=\"{$content}\" />" . PHP_EOL;
                self::$arc["headerdata"]["og:url"] = "<meta property=\"og:url\" content=\"{$content}\">" . PHP_EOL;
                break;
            case "css":
                self::$arc["headerdata"][] = "<link href=\"{$content}\" rel=\"stylesheet\">" . PHP_EOL;
                break;
            case "favicon":
                self::$arc["headerdata"][$type] = "<link href=\"{$content}\" rel=\"icon\">" . PHP_EOL;
                self::$arc["headerdata"]["og:image"] = "<meta property=\"og:image\" content=\"{$content}\">" . PHP_EOL;
                break;
            default:
                self::$arc["headerdata"][] = $content . PHP_EOL;
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
            case "js":
                self::$arc["footerdata"][] = "<script src=\"" . $content . "\"></script>" . PHP_EOL;
                break;
            default:
                self::$arc["footerdata"][] = $content . PHP_EOL;
                break;
        }
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
        return "http" . (isset($_SERVER['HTTPS']) ? "s" : "") . "://" . "{$_SERVER['HTTP_HOST']}/";
    }

    /**
     * 
     * @global array $arc Arc settings storage
     * Adds header information to a page from header array
     */
    public static function arcGetHeader() {
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
    public static function arcGetFooter() {
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
     * Set title to override.
     * @param string $title Title to override.
     */
    public static function arcSetTitleOveride($title) {
        self::$arc["titleoverride"] = $title;
    }

    /**
     * Get title overridden.
     */
    public static function arcGetTitleOverride() {
        return self::$arc["titleoverride"];
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
        
        // get route
        $route = \Router::getRoute($uri);
        $page = null;
        if ($route != null && strlen($route->destination) > 0) {
            $page = \Page::getBySEOURL($route->destination);
        } else {
            $page = \Page::getBySEOURL($uri);
        }

        if ($page->id != 0 && $page->theme != "none") {
            $theme->value = $page->theme;
        }

        if ($filesystem) {
            return self::arcGetPath(true) . "themes/" . $theme->value . "/";
        }
        return self::arcGetPath() . "themes/" . $theme->value . "/";
    }


    public static function arcParseEmail($content, $message) {
        $content = self::arcProcessTags($content);

        // email body
        $content = str_replace("{{arc:emailcontent}}", $message, $content);

        return $content;
    }

    public static function arcProcessTags($content) {

        // site logo
        $logo = \SystemSetting::getByKey("ARC_LOGO_PATH");
        // site title
        $title = \SystemSetting::getByKey("ARC_SITETITLE");
        
        
        // logo, title, path, themepath, version, header, footer
        $tags = array("{{arc:sitelogo}}", "{{arc:sitetitle}}", "{{arc:path}}",
            "{{arc:themepath}}", "{{arc:version}}", "{{arc:header}}", "{{arc:footer}}");
        // logo, title, path, themepath, version, header, footer
        $data = array(self::arcGetPath() . $logo->value, $title->value, self::arcGetPath(),
            self::arcGetThemePath(), self::arcGetVersion(), self::arcGetHeader(),
            self::arcGetFooter());
        
        // do replacement
        $content = str_replace($tags, $data, $content);

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
     * @param array $groups Group name
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

    public static function arcGetSessionID() {
        return session_id();
    }

    public static function arcSetSession($id) {
        // added @ to prevent warning causing issues.
        @session_id($id);
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
     * 
     * @param string $destination Outputs a javascript redirect to root or specified url
     */
    public static function arcRedirect($destination = null) {
        ob_start();
        ob_clean();
        if (empty($destination)) {
            header("Location: " . self::arcGetPath(), true, 301);
        } else {
            header("Location: " . $destination, true, 301);
        }
        exit();
    }

    public static function arcGetMenu($exclude = []) {
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

            if (\Router::hasPermission($groups, $page->seourl)) {

                // check exclude list
                if (\in_array($page->seourl, $exclude)) {
                    // skip item if in the exclude list.
                    continue;
                }

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


    public static function arcCheckSettingExists($name, $value, $id = 0) {
        $setting = \SystemSetting::getByKey($name, $id);
        if (!\SystemSetting::keyExists($name, $id)) {
            $setting->value = $value;
            $setting->userid = $id;
            $setting->update();
            \Log::createLog("warning", "Setting", $name . " was initilised with value '" . $value . "', ID: '" . $id . "'");
        }
    }

    public static function arcGetSetting($name) {
        $setting = \SystemSetting::getByKey($name, 0);
        return $setting->value;
    }

    /**
     * 
     * @param type $array Array containing the key value parameters.
     * Echos out the array.
     */
    public static function arcReturnJSON($array = [], $status = "200") {
        header("HTTP/1.1 " . (string)$status . " " . self::arcRequestStatus($status));
        header("content-type:application/json");
        echo utf8_encode(json_encode($array));
    }

    /**
     * 
     * @param int $code Status code
     * @return string Status code
     */
    public static function arcRequestStatus(string $code) {
        $status = array(
            "200" => 'OK',
            "404"=> 'Not Found',
            "405" => 'Method Not Allowed',
            "500" => 'Internal Server Error',
            "400" => 'Bad Request',
            "403" => 'Forbidden',
            "401" => 'Access denied',
            "401.1" => 'Logon failed'
        );
        return ($status[$code]) ? $status[$code] : $status["500"];
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
     * @param type $filesystem
     * @return type
     */
    public static function arcGetAddonPath($filesystem = false) {
        if (!$filesystem) {
            return self::arcGetPath() . self::$arc["addonpath"];
        }
        return self::arcGetPath(true) . self::$arc["addonpath"];
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
     * @param string $name
     * @param type $addon
     * @param type $filesystem
     * @return type
     */
    public static function arcGetAddonControllerPath($module, $view, $controller, $filesystem = false) {
        if (!$filesystem) {
            echo self::arcGetPath() . "app/addons/{$module}/{$view}/controller/{$controller}";
        }
        return self::arcGetPath(true) . "app/addons/{$module}/{$view}/controller/{$controller}.php";
    }

    /**
     * 
     * Process module tags in content
     * @param string $content
     * @return string
     */
    public static function arcProcessModuleTags($content) {
        preg_match_all('/{{module:([^,]+?):([^,]+?)(:([^,]+?))?}}/', $content, $matches);

        $filename = "";
        if (isset($matches[1][0])) {
            $filename = $matches[1][0];
        }
        $view = "";
        if (isset($matches[2][0])) {
            $view = $matches[2][0];
        }
        $values = [];

        // Check if we have values to pass
        if (isset($matches[4][0])) {
            $values = explode(",", $matches[4][0]);
        }
        
        ob_start();
        self::arcGetModule($filename, $view, $values);
        $newContent = ob_get_contents();
        ob_end_clean();

        if (count($values) == 0) {
            // No values to pass
            $content = str_replace("{{module:" . $filename . ":" . $view . "}}", $newContent, $content);
        } else {
            // Module has values
            $content = str_replace("{{module:" . $filename . ":" . $view . $matches[3][0] . "}}", $newContent, $content);
        }

        return $content;
    }

    /**
     * 
     * @param string $name Module name
     * @param string $view View name
     * Includes the module by name and view along with controller if it exists.
     */
    public static function arcGetModule($arc_name, $arc_view, $values = []) {
        // Set values of module
        self::$arc["modulevalues"] = $values;

        if (!file_exists(self::arcGetPath(true) . "app/modules/{$arc_name}")) {
            \Log::createLog("warning", "Modules", "Modules by the name of {$arc_name} was not found.");
            return;
        }

        self::$arc["modulepath"] = "app/modules/{$arc_name}/";

        if (file_exists(self::arcGetPath(true) . "app/modules/{$arc_name}/controller/{$arc_view}.php")) {
            include_once self::arcGetPath(true) . "app/modules/{$arc_name}/controller/{$arc_view}.php";
        }

        ob_start();
        if (file_exists(self::arcGetThemePath(true) . "override/{$arc_name}/{$arc_view}.php")) {
            include_once self::arcGetThemePath(true) . "override/{$arc_name}/{$arc_view}.php";
            // allow override on controller
            if (file_exists(self::arcGetThemePath(true) . "controller/override/{$arc_name}/{$arc_view}.php")) {
                include_once self::arcGetThemePath(true) . "controller/override/{$arc_name}/{$arc_view}.php";
            }
        } elseif (file_exists(self::arcGetPath(true) . "app/modules/{$arc_name}/view/{$arc_view}.php")) {
            include_once self::arcGetPath(true) . "app/modules/{$arc_name}/view/{$arc_view}.php";
        } else {        
            if ($arc_name != "" && $arc_view != "") {
                echo "<div class=\"alert alert-danger\">The module '{$arc_name}' has no view named '{$arc_view}'.</div>";
                \Log::createLog("danger", "Modules", "The module '{$arc_name}' has no view named '{$arc_view}'.");
            }
        }
        // addons
        if (is_dir(self::arcGetPath(true) . "app/addons/{$arc_name}/{$arc_view}/view") === true) {
            $addons = scandir(self::arcGetPath(true) . "app/addons/{$arc_name}/{$arc_view}/view");
            foreach($addons as $addon) {
                if ($addon != "." && $addon != "..") {

                    self::$arc["addonpath"] = "app/addons/{$arc_name}/{$arc_view}/";

                    // controllers
                    if (file_exists(self::arcGetPath(true) . "app/addons/{$arc_name}/{$arc_view}/controller/{$addon}")) {
                        include_once self::arcGetPath(true) . "app/addons/{$arc_name}/{$arc_view}/controller/{$addon}";
                    }

                    // page addon
                    include_once self::arcGetPath(true) . "app/addons/{$arc_name}/{$arc_view}/view/" . $addon;
                }
            }
        }
    }

    /**
     * 
     * Returns the Arc version
     * @return string
     */
    public static function arcGetVersion() {
        return self::$arc["version"];
    }

    public static function arcGetURI() {
        // Break URL apart and check for API request
        $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
        $uri = $uri_parts[0];
        $uri = ltrim($uri, "/");
        return $uri;
    }

    /**
     * Return Url as array for processing parts individually.
     */
    public static function arcGetURIAsArray($uri = null) {
        if ($uri == null) {
            return explode("/", self::arcGetURI());
        }
        return explode("/", $uri);
    }

    public static function arcGetLastURIItem($uri = null) {
        $data = self::arcGetURIAsArray($uri);
        return $data[count($data) - 1];
    }

    /**
     * Return module values get by module load
     */
    public static function arcGetModuleValues() {
        // Return module values
        return self::$arc["modulevalues"];
    }
    
    /**
     * Used to get Arc to build the content of the page or preform API request.
     */
    public static function arcGetContent() {
        $uri = self::arcGetURI();
        // check for API request
        if (strpos($uri, "api/") !== false) {
             // process uri
            API::arcGetAPI($uri);
        }
        else if (strpos($uri, "runcron") !== false) {
            // run cron jobs
            CRON::arcRunCron();
        }
        else if (strpos($uri, "search") !== false && (isset($_POST["search"]) || isset($_GET["search"]))) {
            // run cron jobs

            $searchquery = null;
            if (isset($_POST["search"])) {
                $searchquery = $_POST["search"];
            } else {
                $searchquery = $_GET["search"];
            }

            Render::arcRenderSearch($searchquery);
        }
        else {
            // No API, Get regular content
            Render::arcRenderContent($uri);
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
     * Covert a date in to Sql format compatible with a database
     * @param string $date to be converted
     * @return date in Sql format
     */
    public static function arcConvertDateToSql($date) {
        return date('Y-m-d', strtotime($date));
    }

    /**
     * 
     * Covert a time in to Sql format compatible with a database
     * @param string $time to be converted
     * @return date in Sql format
     */
    public static function arcConvertTimeToSql($time) {
        return date('H:i:s', strtotime($time));
    }

    /**
     * 
     * Covert a datetime in to Sql format compatible with a database
     * @param string $datetime to be converted
     * @return date in Sql format
     */
    public static function arcConvertDateTimeToSql($datetime) {
        return date('Y-m-d H:i:s', strtotime($datetime));
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

    /**
     * 
     * Creates and HTML select with items and selection.
     * @param array Select options
     * @param array Select values
     * @param string CSS class
     * @param string Selected value
     * @param string Select ID
     */
    public static function arcCreateHTMLSelect($options, $values, $class, $selected, $id) {
        $html = "<select id=\"" . $id . "\" name=\"" . $id . "\" class=\"" . $class . "\">";
        $count = 0;
        if (is_array($options) && is_array($values) && count($options) == count($values)) {
            foreach ($options as $option) {
                $html .= "<option value=\"" . $values[$count] . "\"";
                if ($values[$count] == $selected) {
                    $html .= " selected";
                }
                $html .= ">" . $option . "</option>";
                $count++;
            }
        }        
        $html .= "</select>";
        return $html;
    }

    public static function arcGetProcessor() {
        return "/" . self::$arc["arc_processor"];
    }

    public static function arcHasSearchResults() {
        return self::$arc["hassearchresults"];
    }

    public static function arcMarkSearch($flag = true) {
        self::$arc["hassearchresults"] = $flag;
    }
}
