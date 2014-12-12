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
        // Get the current URI and break up the path into parts.
        if ($_SERVER["REQUEST_URI"] != "/") {
            $uri = parse_url($_SERVER["REQUEST_URI"]);
            $routes = explode("/", trim($uri["path"], "/"));
            foreach ($routes as $route) {
                if (empty(self::$arc["urldata"])) {
                    self::$arc["urldata"]["module"] = $route;
                } elseif (count(self::$arc["urldata"]) == 1) {
                    self::$arc["urldata"]["action"] = $route;
                } else {
                    $count = count(self::$arc["urldata"]) - 1;
                    self::$arc["urldata"]["data{$count}"] = $route;
                }
            }
        }
        
        if (empty(self::$arc["urldata"])) {
            self::$arc["urldata"]["module"] = ARCDEFAULTMODULE;
            self::$arc["urldata"]["action"] = ARCDEFAULTACTION;
        }
        
        // Create database connection
        try {
            self::$arc["database"] = new \medoo([
                "database_type" => ARCDBTYPE,
                "database_name" => ARCDBNAME,
                "server" => ARCDBSERVER,
                "username" => ARCDBUSER,
                "password" => ARCDBPASSWORD
            ]);
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
        self::arcAddHeader("js", self::arcGetPath() . "js/delta-ajax.min.js");
        self::arcAddHeader("js", self::arcGetPath() . "js/status.min.js");

        // CSS, add required css files to header
        self::arcAddHeader("css", self::arcGetPath() . "css/bootstrap.min.css");
        self::arcAddHeader("css", self::arcGetPath() . "css/bootstrap-datetimepicker.min.css");
        self::arcAddHeader("css", self::arcGetPath() . "css/font-awesome.min.css");
        self::arcAddHeader("css", self::arcGetPath() . "css/status.min.css");
        self::arcAddHeader("css", self::arcGetPath() . "css/summernote.css");
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
        return 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}/";
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

            // Check if the template has a header and include if it does.
            if (!file_exists(self::arcGetPath(true) . "app/templates/" . ARCTEMPLATE . "/view/header.php")) {
                die("Unable to find template header.php.");
            }
            require_once self::arcGetPath(true) . "app/templates/" . ARCTEMPLATE . "/view/header.php";

            if (!file_exists(self::arcGetPath(true) . "app/modules/" . self::arcGetURLData("module"))) {
                die("Module '" . self::arcGetURLData("module") . "' was not found.");
            }

            // Get module controller
            $moduleController = self::arcGetPath(true) . "app/modules/" . self::arcGetURLData("module");
            if (self::arcGetURLData("action") == "adminstration") {
                $moduleController .= "/adminstration";               
            }
            $moduleController .= "/controller/controller.php";
            if (file_exists($moduleController)) {
                require_once $moduleController;
            }
        }
        
        // Get module view controller
        $moduleViewController = self::arcGetPath(true) . "app/modules/" . self::arcGetURLData("module");
        if (self::arcGetURLData("action") == "administration") {
            $moduleViewController .= "/administration/controller/" . self::arcGetURLData("data1");
        } else {
            $moduleViewController .= "/controller/" . self::arcGetURLData("action");
        }
        $moduleViewController .=  ".php";
        if (file_exists($moduleViewController)) {
            require_once $moduleViewController;
        }
        
        if (count($_POST) == 0) {
            // Get module view
            $moduleView = self::arcGetPath(true) . "app/modules/" . self::arcGetURLData("module");
            if (self::arcGetURLData("action") == "administration") {
                $moduleView .= "/administration/view/" . self::arcGetURLData("data1") . ".php";
                if (!file_exists($moduleView)) {
                    die("Unable to find view '" . self::arcGetURLData("data1") . "' for module '" . self::arcGetURLData("module") . "'.");
                }
            } else {
                $moduleView .= "/view/" . self::arcGetURLData("action") . ".php";
                if (!file_exists($moduleView)) {
                    die("Unable to find view '" . self::arcGetURLData("action") . "' for module '" . self::arcGetURLData("module") . "'.");
                }
            }

            // Check if the template has a footer and include if it does.
            if (!file_exists(self::arcGetPath(true) . "app/templates/" . ARCTEMPLATE . "/view/footer.php")) {
                die("Unable to find template footer.php.");
            }
            require_once self::arcGetPath(true) . "app/templates/" . ARCTEMPLATE . "/view/footer.php";
        }
    }

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /* NOT DONE YET NOT DONE YET NOT DONE YET NOT DONE YET NOT DONE YET NOT DONE YET  */
    

    /**
     * 
     * @param string $view Name of view file excluding .php
     */
    function arcAddView_dead($view) {
        global $arc;
        if (file_exists(arcGetModulePath(true) . "view/" . $view . ".php")) {
            $arc["viewdata"][] = arcGetModulePath(true) . "view/" . $view . ".php";
        }
    }

    /**
     * Includes the controller path used by the current page
     */
    function arcGetController() {
        // get module controllers
        if (!empty(arcGetURLData("module"))) {
            if (file_exists(arcGetPath(true) . "modules/" . arcGetURLData("module") . "/controller/module.php") && arcGetURLData("data1") != "administration") {
                include arcGetPath(true) . "modules/" . arcGetURLData("module") . "/controller/module.php";
            } elseif (arcGetURLData("data1") == "administration" && file_exists(arcGetPath(true) . "modules/" . arcGetURLData("module") . "/administration/controller/module.php")) {
                include arcGetPath(true) . "modules/" . arcGetURLData("module") . "/administration/controller/module.php";
            }

            $path = arcGetPath(true) . "modules/" . arcGetURLData("module");
            if (arcGetURLData("data1") == "administration") {
                $path .= "/administration";
            }
            $path .= "/controller/";

            if (!empty(arcGetURLData("data1")) && file_exists($path . arcGetURLData("data1") . ".php")) {
                $path .= arcGetURLData("data1") . ".php";
                if (file_exists($path)) {
                    include_once $path;
                    return;
                }
            }

            $page = Page::getBySEOURL(arcGetURLData("module"));
            if ($page->id > 0) {
                include_once arcGetPath(true) . "modules/page/controller/module.php";
            }
        }
        include arcGetTheme(true) . "controller/theme.php";
    }

    /**
     * 
     * @return null Returns on user logout
     * Includes the specified view
     */
    function arcGetView_dead() {
        // logout user
        if (arcGetURLData("module") == "logout") {
            session_unset();
            session_destroy();
            arcRedirect();
            return;
        }
        // expired session
        $timeout = ARCSESSIONTIMEOUT * 60;
        if (isset($_SESSION["LAST_ACTIVITY"]) && (time() - $_SESSION["LAST_ACTIVITY"] > $timeout)) {
            session_unset();
            session_destroy();
            arcSetPage("error", "419");
        } else {
            // update last activity time stamp
            $_SESSION["LAST_ACTIVITY"] = time();

            $page = Page::getBySEOURL(arcGetURLData("module"));
            if ($page->id != 0) {
                // if we have a page set it.
                arcSetPage("page", arcGetURLData("module"));
            }

            if (!file_exists(arcGetPath(true) . "modules/" . arcGetURLData("module"))) {
                // module not found.
                arcSetPage("error", "404");
            } else {
                if (!empty(arcGetUser())) {
                    $user = arcGetUser();
                    $group = $user->getGroup();
                    $permissions = $group->getPermissions();
                } else {
                    $group = UserGroup::getByName("Anyone");
                    $permissions = $group->getPermissions();
                }

                // permission check string
                $pCheck = arcGetURLData("module") . "/" . arcGetURLData("data1");

                // module is not a page
                if (arcGetURLData("module") != "page") {
                    $pCheck = "module/" . arcGetURLData("module");
                }

                // user doesn't have permission to access module
                if (!UserPermission::hasPermission($permissions, $pCheck)) {
                    arcSetPage("error", "403");
                }
            }
        }
    }

    /**
     * Include the content from the selected module
     */
    function arcGetContent_dead() {
        arcGetController();

        // get theme header
        include arcGetTheme(true) . "view/header.php";

        arcGetView();

        $path = arcGetPath(true) . "modules/" . arcGetURLData("module");
        if (arcGetURLData("data1") == "administration") {
            $path .= "/administration";
        }
        $path .= "/view/index.php";

        if (file_exists($path)) {
            include_once $path;
        } else {
            exit("Missing view: " . $path);
        }

        if (arcGetURLData("module") != "error") {
            // allow access to global
            global $arc;
            if (isset($arc["viewdata"]) && count($arc["viewdata"]) > 0) {
                foreach ($arc["viewdata"] as $view) {
                    include $view;
                }
            }
        }

        // get theme footer
        include arcGetTheme(true) . "view/footer.php";
    }

   

    /**
     * Output a standard status div.
     */
    function arcGetStatus() {
        echo "<p><div id=\"status\" style=\"display:none;\" class=\"alert alert-success\" role=\"alert\"></div></p>";
    }

    /**
     * 
     * @global array $arc Arc settings storage
     * @param string $name Section to change, eg module
     * @param string $data Data if any
     * Can be used to force a module. Required for calling classes in dispatch from modules.
     */
    function arcSetPage($name, $data = null) {
        global $arc;
        $arc["urldata"] = array();
        $arc["urldata"]["module"] = $name;
        $count = 1;
        $url = explode("/", $data);
        foreach ($url as $item) {
            $arc["urldata"]["data" . $count] = $item;
            $count++;
        }
    }

    /**
     * 
     * @return \User Return the logged in user object or null if no one
     */
    function arcGetUser() {
        if (isset($_SESSION["arc_user"])) {
            return unserialize($_SESSION["arc_user"]);
        }
        return null;
    }

    /**
     * 
     * @param User $user Sets the logged in user
     */
    function arcSetUser($user) {
        $_SESSION["arc_user"] = serialize($user);
    }

    /**
     * 
     * @param string $destination Outputs a javascript redirect to root or specified url
     */
    function arcRedirect($destination = null) {
        if (empty($destination)) {
            header("Location: " . arcGetPath());
        } else {
            header("Location: " . $destination);
        }
    }

    /**
     * Output the path the the modules dispatch file
     */
    function arcGetDispatch() {
        if (file_exists(arcGetPath(true) . "modules/" . arcGetURLData("module") . "/controller/module.php") && arcGetURLData("data1") != "administration") {
            echo arcGetPath() . "modules/" . arcGetURLData("module") . "/controller/module.php";
        } elseif (arcGetURLData("data1") == "administration" && file_exists(arcGetPath(true) . "modules/" . arcGetURLData("module") . "/administration/controller/module.php")) {
            echo arcGetPath() . "modules/" . arcGetURLData("module") . "/administration/controller/module.php";
        }
    }

    /**
     * 
     * @param bool $filesystem True for filesystem path, False for web path
     * @return string Path to module
     */
    function arcGetModulePath($filesystem = false) {
        if ($filesystem == true) {
            if (arcGetURLData("data1") == "administration") {
                return arcGetPath(true) . "modules/" . arcGetURLData("module") . "/administration/";
            } else {
                return arcGetPath(true) . "modules/" . arcGetURLData("module");
            }
        }
        if (arcGetURLData("data1") == "administration") {
            return arcGetPath() . arcGetURLData("module") . "/administration/";
        } else {
            return arcGetPath() . arcGetURLData("module") . "/";
        }
    }

    /**
     * 
     * @param string $name Name of the menu item
     * @param string $icon Font Awesome icon name fa-*
     * @param bool $divider True to include a divider in menu
     * @param string $url Url of this link, null for default
     * @param string $group Group to palce the item
     */
    function arcAddMenuItem($name, $icon, $divider, $url, $group) {
        // setup menu storage if not already in existance
        if (!isset($GLOBALS["arc"]["menus"])) {
            $GLOBALS["arc"]["menus"] = array();
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
        $item["module"] = $GLOBALS["arc"]["menumodule"];
        if (isset($GLOBALS["arc"]["menuadmin"]) && $GLOBALS["arc"]["menuadmin"] == true) {
            $item["module"] = $item["module"] . "/administration";
        }
        if (!empty($group)) {
            $GLOBALS["arc"]["menus"][$group][] = $item;
        } else {
            $GLOBALS["arc"]["menus"][] = $item;
        }
    }

    /**
     * Processes modules and building menus from info data
     */
    function arcGetMenu() {
        $modules = scandir(arcGetPath(true) . "modules");

        $group = new UserGroup();
        if (!empty(arcGetUser())) {
            $user = arcGetUser();
            $group = $user->getGroup();
        } else {
            $group = UserGroup::getByName("Anyone");
        }

        $permissions = $group->getPermissions();
        $perms = new UserPermission();

        foreach ($modules as $module) {
            if ($module != ".." && $module != ".") {
                // module menu
                if (file_exists(arcGetPath(true) . "modules/" . $module . "/info.php")) {
                    if ($perms->hasPermission($permissions, "module/" . $module)) {
                        $GLOBALS["arc"]["menumodule"] = $module;
                        include arcGetPath(true) . "modules/" . $module . "/info.php";
                    }
                }
                // module administration menu
                if ($group->name == "Administrators") {
                    if (file_exists(arcGetPath(true) . "modules/" . $module . "/administration/info.php")) {
                        $GLOBALS["arc"]["menumodule"] = $module;
                        $GLOBALS["arc"]["menuadmin"] = true;
                        include arcGetPath(true) . "modules/" . $module . "/administration/info.php";
                        unset($GLOBALS["arc"]["menuadmin"]);
                    }
                }
            }
        }

        if (arcGetUser() != null) {
            $GLOBALS["arc"]["menumodule"] = "logout";
            // logout menu (last item)
            arcAddMenuItem("Logout", "fa-lock", false, null, null);
        }
        $GLOBALS["arc"]["menumodule"] = null;
        arcProcessMenuItems($GLOBALS["arc"]["menus"]);
    }

    /**
     * 
     * @param Array $menus Array containing menu data
     * Builds the html for the menu items
     */
    function arcProcessMenuItems($menus) {
        foreach ($menus as $menu => $value) {
            if ($menu != "" && !is_numeric($menu)) {
                echo "<li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">"
                . "<span class='fa fa-list'></span> " . $menu . " <span class=\"caret\"></span></a>" . PHP_EOL
                . "<ul class=\"dropdown-menu\" role=\"menu\">" . PHP_EOL;
                arcProcessMenuItems($value);
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
                    echo arcGetPath() . $value["module"];
                }
                echo "\"><span class='fa " . $value["icon"] . "'></span> "
                . $value['name'] . "</a></li>";
            } else {
                arcProcessMenuItems($value);
            }
        }
    }

    /**
     * 
     * @return Array Containing the modules installed on the system and their details
     */
    function arcGetModules() {
        $modules = scandir(arcGetPath(true) . "modules");
        $module_list = array();
        foreach ($modules as $module) {
            $module_info["name"] = 'Unknown';
            $module_info["description"] = 'No description provided';
            $module_info["version"] = '0.0.0.0';
            $module_info["author"] = 'Unknown';
            $module_info["email"] = 'Unknown';
            $module_info["www"] = 'Unknown';
            $module_info["system"] = false;
            if ($module != ".." && $module != ".") {
                if (file_exists(arcGetPath(true) . "modules/" . $module . "/info.php")) {
                    include arcGetPath(true) . "modules/" . $module . "/info.php";

                    $module_info["module"] = $module;
                    $module_list[] = $module_info;
                } elseif (file_exists(
                                arcGetPath(true) . "modules/" . $module . "/administration/info.php")) {
                    include arcGetPath(true) . "modules/" . $module . "/administration/info.php";

                    $module_info["module"] = $module;
                    $module_list[] = $module_info;
                }
            }
        }
        return $module_list;
    }

    /**
     * 
     * @return string Arc version information
     */
    function arcPoweredBy() {
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
    function arcSendMail($to, $subject, $message, $attachments = null) {
        $mailSettings = SystemSetting::getByKey("ARCSMTP");
        require_once arcGetPath(true) . "system/PHPMailer/PHPMailerAutoload.php";

        $mail = new PHPMailer();
        $mail->isSMTP();
        if (ARCDEBUG == true) {
            $mail->SMTPDebug = 2;
        } else {
            $mail->SMTPDebug = 0;
        }
        $mail->Debugoutput = "html";

        if (empty($mailSettings->setting)) {
            return "Unable to get mail settings";
            return;
        }

        $settings = $mailSettings->getArray(",");
        $mail->Host = $settings[0];
        $mail->Port = $settings[1];
        $mail->SMTPAuth = true;
        $mail->Username = $settings[2];
        $mail->Password = $settings[3];
        $mail->setFrom($settings[4], $settings[5]);

        foreach ($to as $name => $email) {
            $mail->addAddress($email, $name);
        }

        $mail->Subject = $subject;
        $mail->msgHTML($message);

        if (isset($attachments)) {
            foreach ($attachments as $attachment) {
                $mail->addAttachment($attachment);
            }
        }

        if (!$mail->send()) {
            return $mail->ErrorInfo;
        }

        return null;
    }

    /**
     * 
     * @param string $date Date to convert
     * @return date In UK format
     */
    function arcUKDateToSql($date) {
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
    function arcPagination($objects, $page, $amount) {
        $pagecount = $amount * $page;
        return array_slice($objects, $pagecount, $amount);
    }

}
