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
include_once "medoo.min.php";

class Helper {

    /**
     * 
     * Array containing all Arc data
     */
    private static $arc = Array();

    /**
     * 
     * Initialise the Helper class
     */
    public static function init() {
        // Start session
        session_start();

        // Default view data, if  nothing is set.
        if (empty(self::$arc["urldata"])) {
            self::$arc["urldata"]["module"] = ARCDEFAULTMODULE;
            self::$arc["urldata"]["action"] = ARCDEFAULTACTION;
        }

        // Initilise menu
        self::$arc["menus"] = Array();

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
                    "password" => ARCDBPASSWORD
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
        self::arcAddHeader("js", self::arcGetPath() . "js/jquery.min.js");
        self::arcAddFooter("js", self::arcGetPath() . "js/bootstrap.min.js");
        self::arcAddFooter("js", self::arcGetPath() . "js/arc.min.js");
        self::arcAddFooter("js", self::arcGetPath() . "js/summernote.min.js");

        // CSS, add required css files to header
        self::arcAddHeader("css", self::arcGetPath() . "css/bootstrap.min.css");
        self::arcAddHeader("css", self::arcGetPath() . "css/font-awesome.min.css");
        self::arcAddHeader("css", self::arcGetPath() . "css/arc.min.css");
        self::arcAddHeader("css", self::arcGetPath() . "css/summernote.css");

        // Get POST data
        self::$arc["post"] = array();
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

    public static function arcGetPostData($name) {
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
            return $_SERVER["DOCUMENT_ROOT"] . "/";
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
    public static function arcGetHeader() {
        // output header
        if (!empty(self::$arc["headerdata"])) {
            foreach (self::$arc["headerdata"] as $line) {
                echo $line;
            }
        }
    }

    /**
     * 
     * @global array $arc Arc settings storage
     * Adds footer information to a page from header array
     */
    public static function arcGetFooter() {
        // output header
        if (!empty(self::$arc["footerdata"])) {
            foreach (self::$arc["footerdata"] as $line) {
                echo $line;
            }
        }
        echo "<script>var arcsid = '" . self::arcGetSessionID() . "'</script>";
    }

    /**
     * 
     * @param bool $filesystem Get filesystem path if true
     * @return string Path to content
     */
    public static function arcGetThemePath($filesystem = false) {
        $theme = \SystemSetting::getByKey("ARC_THEME");
        if ($filesystem) {
            return self::arcGetPath(true) . "themes/" . $theme->value . "/";
        }
        return self::arcGetPath() . "themes/" . $theme->value . "/";
    }

    /**
     * Get the view based on the request
     */
    public static function arcGetView() {
        $uri = $_SERVER["REQUEST_URI"];
        // set session if it exists.
        if (self::arcGetPostData("arcsid") != null) {
            self::arcSetSession(self::arcGetPostData("arcsid"));
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
            // get system messages
            if (self::arcGetPostData("action") == "getarcsystemmessages") {
                self::arcGetStatus();
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
                self::$arc["post"]["error"] = "403";
                self::$arc["post"]["path"] = $_SERVER["REQUEST_URI"];
            }
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

            // Check if the theme has a controller and include it if it does.
            if (file_exists(self::arcGetPath(true) . "themes/" . $theme->value . "/controller/controller.php")) {
                include_once self::arcGetPath(true) . "themes/" . $theme->value . "/controller/controller.php";
            }
        }

        $groups[] = \UserGroup::getByName("Guests");
        if (self::arcIsUserLoggedIn() == true) {
            $groups = self::arcGetUser()->getGroups();
        }

        if (self::arcIsAjaxRequest() == false) {
            if (!\UserPermission::hasPermission($groups, $page->seourl)) {
                $page = \Page::getBySEOURL("error");
                unset(self::$arc["post"]);
                self::$arc["post"]["error"] = "403";
                self::$arc["post"]["path"] = $_SERVER["REQUEST_URI"];
            }


            // Check if the theme has a header and include if it does.
            if (!file_exists(self::arcGetPath(true) . "themes/" . $theme->value . "/view/header.php")) {
                die("Unable to find header.php for theme '" . $theme->value . "'.");
            }
            include_once self::arcGetPath(true) . "themes/" . $theme->value . "/view/header.php";

            // Show page
            echo self::arcProcessModuleTags(html_entity_decode($page->content));

            // Check if the theme has a footer and include if it does.
            if (!file_exists(self::arcGetPath(true) . "themes/" . $theme->value . "/view/footer.php")) {
                die("Unable to find footer.php for theme '" . $theme->value . "'.");
            }
            include_once self::arcGetPath(true) . "themes/" . $theme->value . "/view/footer.php";
        } else {
            $data = explode("/", $uri);
            if (isset($data[1]) && isset($data[2])) {
                include self::arcGetModuleControllerPath($data[1], $data[2], true);
            } else {
                \Log::createLog("danger", "Ajax", "Invalid url: '{$uri}'");
            }
        }
    }

    public static function arcProcessImageUpload() {
        if (self::arcIsAjaxRequest() == true && count($_FILES) > 0) {
            \Log::createLog("success", "arc", "Detected upload request.");
            if (isset($_FILES['file']['name'])) {
                if (!$_FILES['file']['error']) {
                    \Log::createLog("success", "arc", "Starting image upload.");

                    $filesize = \SystemSetting::getByKey("ARC_FILE_UPLOAD_SIZE_BYTES");
                    \Log::createLog("info", "arc", "Upload size limit: " . $filesize->value);

                    if ($_FILES['file']['size'] > $filesize->value) {
                        self::arcAddMessage("danger", "Image file size exceeds limit");
                        \Log::createLog("danger", "arc", "Image exceeds size limit.");
                        return;
                    }
                    $file_type = $_FILES['file']['type'];
                    \Log::createLog("info", "arc", "Type: " . $_FILES['file']['type']);
                    if (($file_type != "image/jpeg") && ($file_type != "image/jpg") && ($file_type != "image/gif") && ($file_type != "image/png")) {
                        self::arcAddMessage("danger", "Invalid image type, requires JPEG, JPG, GIF or PNG");
                        \Log::createLog("danger", "arc", "Invalid image type.");
                        return;
                    }

                    \Log::createLog("info", "arc", "Valid image type detected.");

                    $name = md5(uniqid(rand(), true));
                    $ext = explode('.', $_FILES['file']['name']);
                    $filename = $name . '.' . $ext[1];
                    // force lowercase names
                    $filename = strtolower($filename);
                    $destination = self::arcGetPath(true) . "images/" . $filename;

                    \Log::createLog("info", "arc", "Destination: '" . $destination . "'");

                    $location = $_FILES["file"]["tmp_name"];

                    \Log::createLog("info", "arc", "Source: '" . $location . "'");

                    $size = getimagesize($location);

                    \Log::createLog("info", "arc", "Size: " . $size[0]);

                    if ($size == 0) {
                        self::arcAddMessage("danger", "Invalid image uploaded");
                        \Log::createLog("danger", "arc", "Invalid image size.");
                        return;
                    }
                    move_uploaded_file($location, $destination);
                    \Log::createLog("info", "arc", "Image moved to image folder.");
                    echo json_encode(["data" => self::arcGetPath() . "images/" . $filename, "status" => "success"]);
                    \Log::createLog("success", "arc", "Upload complete.");
                } else {
                    \Log::createLog("danger", "arc", "Upload error " . $_FILES['file']['error']);
                    self::arcAddMessage("danger", "Error occured while uploading image");
                }
            }
            return;
        }
    }

    public static function arcAddMessage($status, $data) {
        $_SESSION["status"][] = ["data" => $data, "status" => $status];
    }

    public static function arcClearStatus() {
        $_SESSION["status"] = Array();
    }

    /**
     * Output a standard status div.
     */
    public static function arcGetStatus() {
        $data = "";
        $warning = 0;
        $danger = 0;
        foreach ($_SESSION["status"] as $message) {
            $data .= "<div id=\"" . uniqid() . "\" class=\"alert alert-" . $message["status"] . " alert-dismissible\" role=\"alert\">"
                    . "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
            switch ($message["status"]) {
                case "danger":
                    $danger++;
                    $data .= "<i class=\"fa fa-close\"></i> ";
                    break;
                case "warning":
                    $warning++;
                    $data .= "<i class=\"fa fa-warning\"></i> ";
                    break;
                default:
                    $data .= "<i class=\"fa fa-check\"></i> ";
                    break;
            }
            $data .= $message["data"] . "</div>" . PHP_EOL;
        }

        $_SESSION["status"] = Array();
        self::arcReturnJSON(["data" => $data, "warning" => $warning, "danger" => $danger]);
    }

    /**
     * 
     * @return \User Return the logged in user object or null if no one
     */
    public static function arcGetUser() {
        if (isset($_SESSION["arc_user"])) {
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
     * @param string/array $groups Group name
     * @return boolean true if they are
     */
    public static function arcIsUserInGroup($groups = Array()) {
        if (self::arcIsUserLoggedIn() == true) {
            if (!is_array($groups)) {
                $newGroup = Array();
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

    /**
     * Output the path the the modules dispatch file
     */
    public static function arcGetDispatch() {
        if (self::arcGetUrlData("administration") == false) {
            $url = self::arcGetPath() . self::arcGetURLData("module");
        } else {
            $url = self::arcGetPath() . self::arcGetURLData("module") . "/administration";
        }
        if (self::arcGetURLData("action") != null) {
            $url .= "/" . self::arcGetURLData("action");
        }
        echo $url;
    }

    /**
     * Processes modules and building menus from info data
     */
    public static function arcGetMenu() {
        $pages = \Page::getAllPages();

        $groups[] = \UserGroup::getByName("Guests");
        if (self::arcIsUserLoggedIn() == true) {
            $groups = self::arcGetUser()->getGroups();
        }

        foreach ($pages as $page) {
            if ($page->seourl != "error") {
                if (\UserPermission::hasPermission($groups, $page->seourl)) {
                    $data = explode("/", $page->seourl);
                    self::$arc["menus"][ucwords($data[0])][$page->title]["name"] = $page->title;
                    self::$arc["menus"][ucwords($data[0])][$page->title]["url"] = $page->seourl;
                    self::$arc["menus"][ucwords($data[0])][$page->title]["icon"] = $page->iconclass;
                }
            }
        }

        self::arcProcessMenuItems(self::$arc["menus"]);
    }

    /**
     * 
     * @param Array $menus Array containing menu data
     * Builds the html for the menu items
     */
    public static function arcProcessMenuItems($menus) {
        foreach ($menus as $menu => $item) {
            if (count($item) == 1) {
                foreach ($item as $subitem => $more) {
                    self::arcProcessMenuItem($more);
                }
            } else {
                echo "<li class=\"dropdown\">"
                . "<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">"
                . $menu . " <span class=\"caret\"></span></a><ul class=\"dropdown-menu\">";
                foreach ($item as $subitem => $more) {
                    self::arcProcessMenuItem($more);
                }
                echo "</ul></li>";
            }
        }
    }

    private static function arcProcessMenuItem($item) {
        echo "<li><a href=\"" . self::arcGetPath() . $item["url"] . "\">";
        if (!empty($item["icon"])) {
            echo "<i class='{$item["icon"]}'></i> ";
        }
        echo $item["name"] . "</a></li>";
    }

    /**
     * 
     * @param array $objects Collection of objects
     * @param int $page Page number
     * @param int $amount Amount of object per page
     * @return array Collection of objects
     */
    public static function arcPagination($objects, $page, $amount) {
        $pagecount = $amount * $page;
        return array_slice($objects, $pagecount, $amount);
    }

    /**
     * 
     * Pagination view
     * @param array $objects collection of objects
     * @param int $page page number
     * @param int $amount amount per page
     * @param boolean $simple simple view or complex
     * @param string $baseurl of next page
     */
    public static function arcGetPaginationView($objects, $page, $amount, $simple = false, $baseurl = "") {
        $noperpage = count($objects) / $amount;
        $link1 = "";
        $link2 = "";
        if (!empty($page) && $page > 1) {
            $prev = $page - 1;
            $link1 = "{$baseurl}/{$prev}";
        }

        if ($page < $noperpage - 1) {
            $next = $page + 1;
            $link2 = "{$baseurl}/{$next}";
        }

        if (!$simple) {
            $html = "<nav><ul class=\"pagination\"><li><a href=\"{$link1}\""
                    . " aria-label=\"Previous\"><span aria-hidden=\"true\">&laquo;</span></a></li>";

            for ($i = 0; $i <= $noperpage; $i++) {
                $count = $i + 1;
                $html .= "<li><a href=\"{$baseurl}/";
                if (!empty($i)) {
                    $html .= $i;
                }
                $html .= "\">{$count}</a></li>";
            }

            $html .= "<li><a href=\"{$link2}\" aria-label=\"Next\"><span aria-hidden=\"true\">&raquo;</span></a></li>"
                    . "</ul></nav>";
        } else {
            $html = "<nav><ul class=\"pager\">";
            $html .= "<li class=\"previous\"><a href=\"{$link2}\"><span aria-hidden=\"true\">&larr;</span> Older</a></li>";
            $html .= "<li class=\"next\"><a href=\"{$link1}\">Newer <span aria-hidden=\"true\">&rarr;</span></a></li>";
            $html .= "</ul></nav>";
        }
        echo $html;
    }

    public static function arcIsAjaxRequest() {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return true;
        }
        return false;
    }

    public static function arcGetThumbImage($image, $width = null) {
        if (!empty($image) && file_exists(self::arcGetPath(true) . "images/{$image}")) {
            $thumbWidth = \SystemSetting::getByKey("ARC_THUMB_WIDTH");
            if ($width == null) {
                $width = $thumbWidth->value;
            }
            if (!file_exists(self::arcGetPath(true) . "images/thumbs")) {
                mkdir(self::arcGetPath(true) . "images/thumbs");
            }
            $filename = $width . "_" . $image;
            if (!file_exists(self::arcGetPath(true) . "images/thumbs/{$filename}")) {
                $size = getimagesize(self::arcGetPath(true) . "images/{$image}");
                $ratio = $size[0] / $size[1]; // width/height
                if ($ratio > 1) {
                    $width = $width;
                    $height = $width / $ratio;
                } else {
                    $width = $width * $ratio;
                    $height = $width;
                }
                $src = imagecreatefromstring(file_get_contents(self::arcGetPath(true) . "images/{$image}"));
                $dst = imagecreatetruecolor($width, $height);
                imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);
                imagedestroy($src);

                $extension = strtolower(strrchr(self::arcGetPath(true) . "images/{$image}", '.'));
                switch ($extension) {
                    case '.jpg':
                    case '.jpeg':
                        imagejpeg($dst, self::arcGetPath(true) . "images/thumbs/{$filename}");
                        break;
                    case '.gif':
                        imagegif($dst, self::arcGetPath(true) . "images/thumbs/{$filename}");
                        break;
                    case '.png':
                        imagepng($dst, self::arcGetPath(true) . "images/thumbs/{$filename}");
                        break;
                }
                imagedestroy($dst);
            }
            return self::arcGetPath() . "images/thumbs/{$filename}";
        }
        return null;
    }

    public static function arcCheckSettingExists($name, $value, $group) {
        $setting = \SystemSetting::getByKey($name);
        if (!\SystemSetting::keyExists($name)) {
            $setting->value = $value;
            $setting->group = $group;
            $setting->update();
            \Log::createLog("warning", "Setting", $name . " was initilised with value '" . $value . "'");
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

    public static function arcGetModulePath($name, $filesystem = false) {
        if (!$filesystem) {
            return self::arcGetPath() . "app/modules/{$name}/";
        }
        return self::arcGetPath(true) . "app/modules/{$name}/";
    }

    public static function arcGetModuleControllerPath($name, $controller, $filesystem = false) {
        if (!$filesystem) {
            echo self::arcGetPath() . "{$name}/{$controller}";
        }
        return self::arcGetPath(true) . "app/modules/{$name}/controller/{$controller}.php";
    }

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

        if (file_exists(self::arcGetPath(true) . "app/modules/{$name}/controller/{$view}.php")) {
            include_once self::arcGetPath(true) . "app/modules/{$name}/controller/{$view}.php";
        }

        if (file_exists(self::arcGetPath(true) . "app/modules/{$name}/view/{$view}.php")) {
            include_once self::arcGetPath(true) . "app/modules/{$name}/view/{$view}.php";
        } else {
            echo "The module '{$name}' has no view named '{$view}'.";
            \Log::createLog("danger", "Modules", "The module '{$name}' has no view named '{$view}'.");
        }
    }

}
