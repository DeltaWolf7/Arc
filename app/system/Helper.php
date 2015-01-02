<?php

namespace system;

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
require_once "medoo.min.php";

class Helper {

    private static $arc = Array();

    public static function init() {
        // Start session
        session_start();

        // Get the current URI and break up the path into parts.
        if ($_SERVER["REQUEST_URI"] != "/") {
            $uri = parse_url($_SERVER["REQUEST_URI"]);
            $routes = explode("/", trim($uri["path"], "/"));
            $count = 1;
            foreach ($routes as $route) {
                if (!isset(self::$arc["urldata"]["module"])) {
                    self::$arc["urldata"]["module"] = $route;
                } elseif ($route == "administration") {
                    self::$arc["urldata"]["administration"] = true;
                } elseif (!isset(self::$arc["urldata"]["action"])) {
                    self::$arc["urldata"]["action"] = $route;
                } else {
                    self::$arc["urldata"]["data" . $count] = $route;
                    $count++;
                }
            }
        }

        if (empty(self::$arc["urldata"])) {
            self::$arc["urldata"]["module"] = ARCDEFAULTMODULE;
            self::$arc["urldata"]["action"] = ARCDEFAULTACTION;
        }

        // Initilise menu
        self::$arc["menus"] = Array();

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
        self::arcAddHeader("js", self::arcGetPath() . "js/moment.min.js");
        self::arcAddHeader("js", self::arcGetPath() . "js/bootstrap.min.js");
        self::arcAddHeader("js", self::arcGetPath() . "js/bootstrap-datetimepicker.min.js");
        self::arcAddHeader("js", self::arcGetPath() . "js/bootstrap-filestyle.min.js");
        self::arcAddHeader("js", self::arcGetPath() . "js/summernote.min.js");
        self::arcAddHeader("js", self::arcGetPath() . "js/status.min.js");

        // CSS, add required css files to header
        self::arcAddHeader("css", self::arcGetPath() . "css/bootstrap.min.css");
        self::arcAddHeader("css", self::arcGetPath() . "css/bootstrap-datetimepicker.min.css");
        self::arcAddHeader("css", self::arcGetPath() . "css/font-awesome.min.css");
        self::arcAddHeader("css", self::arcGetPath() . "css/summernote.css");
        self::arcAddHeader("css", self::arcGetPath() . "css/status.min.css");
    }

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
    }

    /**
     * 
     * @global array $arc Arc settings storage
     * @param string $name Section to get
     * @return string Module or data
     */
    public static function arcGetURLData($name = null) {
        if (!empty($name)) {
            if (isset(self::$arc["urldata"][$name])) {
                return self::$arc["urldata"][$name];
            }
            return null;
        }
        return self::$arc["urldata"];
    }

    public static function arcGetTemplatePath($filesystem = false) {
        if ($filesystem) {
            return self::arcGetPath(true) . "app/templates/" . ARCTEMPLATE . "/";
        }
        return self::arcGetPath() . "app/templates/" . ARCTEMPLATE . "/";
    }

    public static function arcGetView() {
        if (count($_POST) == 0) {
            // Check the template in config exists.
            if (!file_exists(self::arcGetPath(true) . "app/templates/" . ARCTEMPLATE)) {
                die("Unable to find template '" . ARCTEMPLATE . "' specified in Config.php.");
            }

            // Check if the template has a controller and include it if it does.
            if (file_exists(self::arcGetPath(true) . "app/templates/" . ARCTEMPLATE . "/controller/controller.php")) {
                require_once self::arcGetPath(true) . "app/templates/" . ARCTEMPLATE . "/controller/controller.php";
            }

            if (!file_exists(self::arcGetPath(true) . "app/modules/" . self::arcGetURLData("module"))) {
                self::arcForceView("error", "error", false, ["404", self::arcGetURLData("module")]);
            }
        }

        $groups[] = \UserGroup::getByName("Guests");
        if (self::arcIsUserLoggedIn() == true) {
            $groups = self::arcGetUser()->getGroups();
        }

        if (\UserPermission::hasPermission($groups, self::arcGetURLData("module"))) {
            // Get module controller
            if (self::arcGetURLData("administration") == null && file_exists(self::arcGetPath(true) . "app/modules/" . self::arcGetURLData("module") . "/controller/controller.php")) {
                require_once self::arcGetPath(true) . "app/modules/" . self::arcGetURLData("module") . "/controller/controller.php";
            } elseif (file_exists(self::arcGetPath(true) . "app/modules/" . self::arcGetURLData("module") . "/administration/controller/controller.php")) {
                require_once self::arcGetPath(true) . "app/modules/" . self::arcGetURLData("module") . "/administration/controller/controller.php";
            }
        } else {
            self::arcForceView("error", "error", false, ["403"]);
        }

        if (count($_POST) == 0) {
            // Check if the template has a header and include if it does.
            if (!file_exists(self::arcGetPath(true) . "app/templates/" . ARCTEMPLATE . "/view/header.php")) {
                die("Unable to find template header.php.");
            }
            require_once self::arcGetPath(true) . "app/templates/" . ARCTEMPLATE . "/view/header.php";
        }

        if (\UserPermission::hasPermission($groups, self::arcGetURLData("module"))) {
            // Get module view controller
            if (self::arcGetURLData("administration") == null && file_exists(self::arcGetPath(true) . "app/modules/" . self::arcGetURLData("module") . "/controller/" . self::arcGetURLData("action") . ".php")) {
                require_once self::arcGetPath(true) . "app/modules/" . self::arcGetURLData("module") . "/controller/" . self::arcGetURLData("action") . ".php";
            } elseif (file_exists(self::arcGetPath(true) . "app/modules/" . self::arcGetURLData("module") . "/administration/controller/" . self::arcGetURLData("action") . ".php")) {
                require_once self::arcGetPath(true) . "app/modules/" . self::arcGetURLData("module") . "/administration/controller/" . self::arcGetURLData("action") . ".php";
            }
        } else {
            self::arcForceView("error", "error", false, ["403"]);
        }

        if (count($_POST) == 0) {
            // Get module view      
            if (self::arcGetURLData("administration") == null) {
                if (!file_exists(self::arcGetPath(true) . "app/modules/" . self::arcGetURLData("module") . "/view/" . self::arcGetURLData("action") . ".php")) {
                    die("Unable to find view '" . self::arcGetURLData("action") . "' for module '" . self::arcGetURLData("module") . "'.");
                }
                require_once self::arcGetPath(true) . "app/modules/" . self::arcGetURLData("module") . "/view/" . self::arcGetURLData("action") . ".php";
            } else {
                if (!file_exists(self::arcGetPath(true) . "app/modules/" . self::arcGetURLData("module") . "/administration/view/" . self::arcGetURLData("action") . ".php")) {
                    die("Unable to find view '" . self::arcGetURLData("action") . "' for administrative module '" . self::arcGetURLData("module") . "'.");
                }
                require_once self::arcGetPath(true) . "app/modules/" . self::arcGetURLData("module") . "/administration/view/" . self::arcGetURLData("action") . ".php";
            }

            // Check if the template has a footer and include if it does.
            if (!file_exists(self::arcGetPath(true) . "app/templates/" . ARCTEMPLATE . "/view/footer.php")) {
                die("Unable to find template footer.php.");
            }
            require_once self::arcGetPath(true) . "app/templates/" . ARCTEMPLATE . "/view/footer.php";
        }
    }

    private static function arcForceView($module, $action, $administration = false, $data = Array()) {
        unset(self::$arc["urldata"]);
        self::$arc["urldata"]["module"] = $module;
        self::$arc["urldata"]["action"] = $action;
        self::$arc["urldata"]["administration"] = $administration;
        $count = 1;
        if (is_array($data)) {
            foreach ($data as $item) {
                self::$arc["urldata"]["data" . $count] = $item;
                $count++;
            }
        }
    }

    public static function arcOverrideView($action, $administration = false, $data = Array()) {
        $module = self::$arc["urldata"]["module"];
        unset(self::$arc["urldata"]);
        self::$arc["urldata"]["module"] = $module;
        self::$arc["urldata"]["action"] = $action;
        self::$arc["urldata"]["administration"] = $administration;
        $count = 1;
        foreach ($data as $item) {
            self::$arc["urldata"]["data" . $count] = $item;
            $count++;
        }
    }

    /**
     * Output a standard status div.
     */
    public static function arcGetStatus() {
        echo "<br /><div id=\"status\" style=\"display:none;\" role=\"alert\"></div>";
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

    public static function arcIsUserLoggedIn() {
        if (self::arcGetUser() != null) {
            return true;
        }
        return false;
    }

    public static function arcIsUserInGroup($groups = Array()) {
        if (self::arcIsUserLoggedIn() == true) {
            if (is_array($groups)) {
                $grps = self::arcGetUser()->getGroups();
                foreach ($groups as $group) {
                    foreach ($grps as $grp) {
                        if ($group == $grp->name) {
                            return true;
                        }
                    }
                }
            }
        }
        return false;
    }

    public static function arcIsUserAdmin() {
        if (self::arcGetUser() == null) {
            return false;
        } else {
            foreach (self::arcGetUser()->getGroups() as $group) {
                if ($group->name == "Adminsitrators") {
                    return true;
                }
            }
            return false;
        }
        return true;
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
        if (self::arcGetURLData("administration") == null) {
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
    public static function arcGetMenu($menuItems = array()) {
        $modules = scandir(self::arcGetPath(true) . "app/modules");

        $groups[] = \UserGroup::getByName("Guests");
        if (self::arcIsUserLoggedIn() == true) {
            $groups = self::arcGetUser()->getGroups();
        }
       
        $lastModule = self::arcGetURLData("module");

        foreach ($modules as $module) {
            if ($module != ".." && $module != ".") {

                if (count($menuItems) > 0) {
                    $found = false;
                    foreach ($menuItems as $item) {
                        if ($module == $item) {
                            $found = true;
                            break;
                        }
                    }

                    if (!$found) {
                        continue;
                    }
                }

                // module menu
                if (file_exists(self::arcGetPath(true) . "app/modules/" . $module . "/module.php")) {
                    if (\UserPermission::hasPermission($groups, $module)) {
                        self::$arc["menumodule"] = $module;
                        self::$arc["urldata"]["module"] = $module;
                        require_once self::arcGetPath(true) . "app/modules/" . $module . "/module.php";
                    }
                }
                // module administration menu
                if (self::arcIsUserInGroup(["Administrators"]) == true) {
                    if (file_exists(self::arcGetPath(true) . "app/modules/" . $module . "/administration/module.php")) {
                        self::$arc["menumodule"] = $module;
                        self::$arc["menuadmin"] = true;
                        self::$arc["urldata"]["module"] = $module;
                        require_once self::arcGetPath(true) . "app/modules/" . $module . "/administration/module.php";
                        unset(self::$arc["menuadmin"]);
                    }
                }
            }
        }
        self::$arc["urldata"]["module"] = $lastModule;
        self::$arc["menumodule"] = null;
        self::arcProcessMenuItems(self::$arc["menus"]);
    }

    /**
     * 
     * @param string $name Name of the menu item
     * @param string $icon Font Awesome icon name fa-*
     * @param bool $divider True to include a divider in menu
     * @param string $url Url of this link, null for default
     * @param string $group Group to palce the item
     */
    public static function arcAddMenuItem($name, $icon, $divider, $url, $group) {
        // setup menu storage if not already in existance
        if (!isset(self::$arc["menus"])) {
            self::$arc["menus"] = array();
        }
        // build menu item
        $item = array();
        $item["name"] = $name;
        $item["icon"] = $icon;
        if (!empty($divider)) {
            $item["divider"] = $divider;
        }
        if (!empty($url)) {
            $item["url"] = $url;
        }
        $item["module"] = self::$arc["menumodule"];
        if (isset(self::$arc["menuadmin"]) && self::$arc["menuadmin"] == true) {
            $item["module"] = $item["module"] . "/administration";
        }
        if (!empty($group)) {
            self::$arc["menus"][$group][] = $item;
        } else {
            self::$arc["menus"][] = $item;
        }
    }

    /**
     * 
     * @param Array $menus Array containing menu data
     * Builds the html for the menu items
     */
    public static function arcProcessMenuItems($menus) {
        foreach ($menus as $menu => $value) {
            if ($menu != "" && !is_numeric($menu)) {
                echo "<li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">"
                . "<span class='fa fa-list'></span> " . $menu . " <span class=\"caret\"></span></a>" . PHP_EOL
                . "<ul class=\"dropdown-menu\" role=\"menu\">" . PHP_EOL;
                self::arcProcessMenuItems($value);
                echo "</ul>" . PHP_EOL
                . "</li>" . PHP_EOL;
            } elseif (isset($value["module"])) {
                if (isset($value["divider"])) {
                    echo "<li class=\"divider\"></li>";
                }
                echo "<li><a href=\"";
                if (isset($value["url"])) {
                    echo $value["url"];
                } else {
                    echo self::arcGetPath() . $value["module"];
                }
                echo "\"><span class='fa " . $value["icon"] . "'></span> " . $value['name'] . "</a></li>";
            } else {
                self::arcProcessMenuItems($value);
            }
        }
    }

    public static function arcGetModulePath($filesystem = false) {
        if ($filesystem) {
            if (self::arcGetURLData("administration") == null) {
                return self::arcGetPath(true) . "app/modules/" . self::arcGetURLData("module") . "/";
            } else {
                return self::arcGetPath(true) . "app/modules/" . self::arcGetURLData("module") . "/administration/";
            }
        }

        if (self::arcGetURLData("administration") == null) {
            return self::arcGetPath() . self::arcGetURLData("module") . "/";
        } else {
            return self::arcGetPath() . self::arcGetURLData("module") . "/administration/";
        }
    }

    /**
     * 
     * @return Array Containing the modules installed on the system and their details
     */
    public static function arcGetModules() {
        $modules = scandir(self::arcGetPath(true) . "app/modules");
        $module_list = array();
        foreach ($modules as $module) {
            $module_info["name"] = 'Unknown';
            $module_info["description"] = 'No description provided';
            $module_info["version"] = '0.0.0.0';
            $module_info["author"] = 'Unknown';
            $module_info["email"] = 'Unknown';
            $module_info["www"] = 'Unknown';
            if ($module != ".." && $module != ".") {
                if (file_exists(self::arcGetPath(true) . "app/modules/" . $module . "/info.json")) {
                    $module_list[] = self::arcGetModuleDetails(self::arcGetPath(true) . "app/modules/" . $module . "/info.json", $module);
                } elseif (file_exists(self::arcGetPath(true) . "app/modules/" . $module . "/administration/info.json")) {
                    $module_list[] = self::arcGetModuleDetails(self::arcGetPath(true) . "app/modules/" . $module . "/administration/info.json", $module);
                }
            }
        }
        return $module_list;
    }

    private static function arcGetModuleDetails($file, $module) {
        $json = file_get_contents($file);
        $data = json_decode($json);
        $module_info["name"] = 'Unknown';
        $module_info["description"] = 'No description provided';
        $module_info["version"] = '0.0.0.0';
        $module_info["author"] = 'Unknown';
        $module_info["email"] = 'Unknown';
        $module_info["www"] = 'Unknown';
        if (isset($data->name))
            $module_info["name"] = $data->name;
        if (isset($data->description))
            $module_info["description"] = $data->description;
        if (isset($data->version))
            $module_info["version"] = $data->version;
        if (isset($data->author))
            $module_info["author"] = $data->author;
        if (isset($data->email))
            $module_info["email"] = $data->email;
        if (isset($data->www))
            $module_info["www"] = $data->www;
        $module_info["module"] = $module;
        return $module_info;
    }

    /**
     * 
     * @return string Arc version information
     */
    public static function arcPoweredBy() {
        return "<a href=\"http://www.github.com/deltawolf7/arc\" target=\"_new\">Powered by Arc, Version: " . ARCVERSION . "</a>";
    }

    /**
     * 
     * @param array $to Array containing Name and Email address of the recipients.
     * @param string $subject Subject of the email
     * @param string $message Content of the email
     * @param array $attachments Array of paths to attach
     * @return string Null is returned on OK and the error on failure.
     */
    public static function arcSendMail($to, $subject, $message, $attachments = null) {
        ob_start();
        $mailSettings = \SystemSetting::getByKey("ARCSMTP");
        require_once self::arcGetPath(true) . "app/system/PHPMailer/PHPMailerAutoload.php";

        $mail = new \PHPMailer();
        $mail->isSMTP();
        if (ARCDEBUG == true) {
            $mail->SMTPDebug = 2;
        } else {
            $mail->SMTPDebug = 0;
        }
        $mail->Debugoutput = "html";

        if (empty($mailSettings->setting)) {
            return "Unable to get mail settings";
        }

        $settings = $mailSettings->getArray(",");
        $mail->Host = $settings[0];
        $mail->Port = $settings[1];
        $mail->SMTPAuth = true;
        $mail->Username = $settings[2];
        $mail->Password = $settings[3];
        $mail->setFrom($settings[4], $settings[5]);

        if (is_array($to)) {
            foreach ($to as $name => $email) {
                $mail->addAddress($email, $name);
            }
        } else {
            $mail->addAddress($to);
        }

        $mail->Subject = $subject;
        $mail->msgHTML($message);

        if (isset($attachments)) {
            foreach ($attachments as $attachment) {
                $mail->addAttachment($attachment);
            }
        }


        $mail->send();
        $error = ob_get_contents();
        ob_end_clean();
        if (!empty($error)) {
            return $error;
        }
        return null;
    }

    /**
     * 
     * @param string $date Date to convert
     * @return date In UK format
     */
    public static function arcUKDateToSql($date) {
        $date_year = substr($date, 6, 4);
        $date_month = substr($date, 3, 2);
        $date_day = substr($date, 0, 2);
        return date("Y-m-d", mktime(0, 0, 0, $date_month, $date_day, $date_year));
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

}
