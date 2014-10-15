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

class ARC {

    private $database;
    private $urldata;
    private $headerdata;
    
    public static function getInstance() {
        static $instance = null;
        if (null === $instance) {
            $instance = new static();
        }

        return $instance;
    }
    
    private function __construct() {
        $this->urldata = null;
        $this->headerdata = Array();

        // setup database connection from config
        require_once $_SERVER["DOCUMENT_ROOT"] . ARCFS . "system/medoo.min.php";
        try {
            $this->database = new medoo([
                "database_type" => ARCDBTYPE,
                "database_name" => ARCDBNAME,
                "server" => ARCDBSERVER,
                "username" => ARCDBUSER,
                "password" => ARCDBPASSWORD
            ]);
        } catch (Exception $e) {
            echo "Unable to connect to database. Please check 'config.php'";
            echo "<br />Exception: " . $e->getMessage();
            die();
        }

        // javascript
        $this->headerdata[] = "\t<script src=\"" . $this->getPath() . "js/jquery.min.js\"></script>" . PHP_EOL;
        $this->headerdata[] = "\t<script src=\"" . $this->getPath() . "js/jquert-hotkeys.min.js\"></script>" . PHP_EOL;
        $this->headerdata[] = "\t<script src=\"" . $this->getPath() . "js/bootstrap.min.js\"></script>" . PHP_EOL;
        $this->headerdata[] = "\t<script src=\"" . $this->getPath() . "js/bootstrap-datepicker.min.js\"></script>" . PHP_EOL;
        $this->headerdata[] = "\t<script src=\"" . $this->getPath() . "js/bootstrap-filestyle.min.js\"></script>" . PHP_EOL;
        $this->headerdata[] = "\t<script src=\"" . $this->getPath() . "js/bootstrap-wysiwyg.min.js\"></script>" . PHP_EOL;
        $this->headerdata[] = "\t<script src=\"" . $this->getPath() . "js/delta-ajax.min.js\"></script>" . PHP_EOL;
        $this->headerdata[] = "\t<script src=\"" . $this->getPath() . "js/status.min.js\"></script>" . PHP_EOL;

        // css
        $this->headerdata[] = "\t<link href=\"" . $this->getPath() . "css/bootstrap.min.css\" rel=\"stylesheet\">" . PHP_EOL;
        $this->headerdata[] = "\t<link href=\"" . $this->getPath() . "css/datepicker.min.css\" rel=\"stylesheet\">" . PHP_EOL;
        $this->headerdata[] = "\t<link href=\"" . $this->getPath() . "css/font-awesome.min.css\" rel=\"stylesheet\">" . PHP_EOL;
        $this->headerdata[] = "\t<link href=\"" . $this->getPath() . "css/status.min.css\" rel=\"stylesheet\">" . PHP_EOL;

        // favicon
        if (file_exists($this->getPath() . ARCFAVICON)) {
            $this->headerdata[] = "\t<link href=\"" . $this->getPath() . ARCFAVICON . "\" rel=\"icon\">" . PHP_EOL;
        }
    }
    
    private function __clone() {
    }
    
    private function __wakeup() {
    }

    // get database object
    public function getDatabase() {
        return $this->database;
    }

    // get www path or filesystem path if true
    public function getPath($filesystem = false) {
        if ($filesystem) {
            return $_SERVER["DOCUMENT_ROOT"] . ARCFS;
        }
        return ARCWWW;
    }

    // get url data
    public function getURLData($name = null) {
        if ($name != null) {
            if (isset($this->urldata[$name])) {
                return $this->urldata[$name];
            }
            return null;
        }
        return $this->urldata;
    }

    // function to split url
    private function splitURL() {
        if (isset($_REQUEST["url"])) {
            $url = explode("/", $_REQUEST["url"]);
            $count = 0;
            foreach ($url as $item) {
                if ($count == 0) {
                    $this->urldata["module"] = $item;
                } else {
                    $this->urldata["data" . $count] = $item;
                }
                $count++;
            }
        } else {
            // get the default page of module.
            switch (ARCDEFAULTTYPE) {
                case "module":
                    $this->setPage(ARCDEFAULTPAGE, null);
                    break;
                case "page":
                    $this->setPage("page", ARCDEFAULTPAGE);
                    break;
                default:
                    $this->setPage("error", "404");
                    break;
            }
        }
    }

    // add to header
    public function AddHeader($type, $content) {
        switch ($type) {
            case "title":
                $this->headerdata[] = "\t<title>" . $content . "</title>" . PHP_EOL;
                break;
            case "description":
                $this->headerdata[] = "\t<meta name=\"description\" content=\"" . $content . "\">" . PHP_EOL;
                break;
            case "keywords":
                $this->headerdata[] = "\t<meta name=\"keywords\" content=\"" . $content . "\">" . PHP_EOL;
                break;
            case "author":
                $this->headerdata[] = "\t<meta name=\"author\" content=\"" . $content . "\">" . PHP_EOL;
                break;
            case "alternate":
                $this->headerdata[] = "\t<link rel=\"alternate\" href=\"http://" . $_SERVER['HTTP_HOST'] . ARCWWW . $content . "\">" . PHP_EOL;
                break;
        }
    }

    // get header
    public function getHeader() {
        // split the url, get module and data.
        $this->splitURL();
        foreach ($this->headerdata as $line) {
            echo $line;
        }
    }

    // set page
    public function setPage($name, $data = null) {
        $this->urldata = array();
        $this->urldata["module"] = $name;
        $count = 1;
        $url = explode("/", $data);
        foreach ($url as $item) {
            $this->urldata["data" . $count] = $item;
            $count++;
        }
    }

    // get content
    public function getContent() {
        if ($this->getURLData("module") == "logout") {
            session_unset();
            session_destroy();
            $this->redirect();
            return;
        }

        $timeout = ARCSESSIONTIMEOUT * 60;
        if (isset($_SESSION["LAST_ACTIVITY"]) && (time() - $_SESSION["LAST_ACTIVITY"] > $timeout)) {
            session_unset();
            session_destroy();
            $this->setPage("error", "419");
        } else {
            $_SESSION["LAST_ACTIVITY"] = time(); // update last activity time stamp   

            $page = Page::getBySEOURL($this->getURLData("module"));
            if ($page->id != 0) {
                // if we have a page set it.
                $this->setPage("page", $this->getURLData("module"));
            }

            if (!file_exists($this->getPath(true) . "modules/" . $this->getURLData("module"))) {
                // module not found.
                arcSetPage("error", "404");
            } else {

                $permissions;
                if (!empty($this->getUser())) {
                    $user = $this->getUser();
                    $group = $user->getGroup();
                    $permissions = $group->getPermissions();
                } else {
                    $group = UserGroup::getByName("Anyone");
                    $permissions = $group->getPermissions();
                }

                $pCheck = $this->getURLData("module") . "/" . $this->getURLData("data1");

                if ($this->getURLData("module") != "page") {
                    $pCheck = "module/" . $this->getURLData("module");
                }

                if (!UserPermission::hasPermission($permissions, $pCheck)) {
                    $this->setPage("error", "403");
                }
            }
        }

        if ($this->getURLData("data1") == "administration") {
            include_once $this->getPath(true) . "modules/" . $this->getURLData("module") . "/administration/index.php";
        } else {
            include_once $this->getPath(true) . "modules/" . $this->getURLData("module") . "/index.php";
        }
    }

    // get user
    public function getUser() {
        if (isset($_SESSION["arc_user"])) {
            return unserialize($_SESSION["arc_user"]);
        }
        return null;
    }

    // set user
    public function setUser($user) {
        $_SESSION["arc_user"] = serialize($user);
    }

    // redirect to default
    public function redirect($destination = null) {
        echo "<script>window.location = '";
        if (empty($destination)) {
            echo ARCWWW;
        } else {
            echo $destination;
        }
        echo "';</script>";
    }

    // get dispatch url
    public function getDispatch() {
        if ($this->getURLData("data1") == "administration") {
            echo ARCWWW . "modules/" . $this->getURLData("module") . "/administration/dispatch.php";
        } else {
            echo ARCWWW . "modules/" . $this->getURLData('module') . "/dispatch.php";
        }
    }

    // get module root
    public function getModulePath($filesystem = false) {
        if ($filesystem == true) {
            if ($this->getURLData("data1") == "administration") {
                return $this->getPath(true) . "modules/" . $this->getURLData("module") . "/administration/";
            } else {
                return $this->getPath(true) . "modules/" . $this->getURLData("module");
            }
        }
        if ($this->getURLData("data1") == "administration") {
            return ARCWWW . $this->getURLData("module") . "/administration/";
        } else {
            return ARCWWW . $this->getURLData("module");
        }
    }

    // get menu
    public function getMenu() {
        $modules = scandir($this->getPath(true) . "modules");
        $module_list = array();
        $groups = array();

        $group = new UserGroup();
        if (!empty($this->getUser())) {
            $user = $this->getUser();
            $group = $user->getGroup();
        } else {
            $group = UserGroup::getByName("Anyone");
        }

        $permissions = $group->getPermissions();
        $perms = new UserPermission();

        foreach ($modules as $module) {
            $module_info = "";
            if ($module != ".." && $module != ".") {
                // module menu
                if (file_exists($this->getPath(true) . "modules/" . $module . "/info.php")) {
                    if ($perms->hasPermission($permissions, "module/" . $module)) {
                        include $this->getPath(true) . "modules/" . $module . "/info.php";
                        if (isset($module_info["menu"]) && count($module_info["menu"] > 0)) {
                            foreach ($module_info['menu'] as $menu) {
                                $menu["module"] = $module;
                                if (empty($menu["group"])) {
                                    $module_list[] = $menu;
                                } else {
                                    $groups[$menu["group"]][] = $menu;
                                }
                            }
                        }
                    }
                }

                // module administration menu
                if ($group->name == "Administrators") {
                    if (file_exists($this->getPath(true) . "modules/" . $module . "/administration/info.php")) {
                        include $this->getPath(true) . "modules/" . $module . "/administration/info.php";
                        if (isset($module_info["menu"]) && count($module_info["menu"] > 0)) {
                            foreach ($module_info["menu"] as $menu) {
                                $menu["module"] = $module;
                                $menu["group"] = "Administration";
                                $groups["Administration"][] = $menu;
                            }
                        }
                    }
                }
            }
        }

        // logout menu (last item)
        $module_info['name'] = "Logout";
        $module_info["icon"] = "fa-lock";
        $module_info["divider"] = false;
        $module_info["group"] = "";
        $module_info["module"] = "logout";
        $module_list[] = $module_info;

        echo "<ul class=\"nav navbar-nav navbar-right\">" . PHP_EOL;

        if (count($groups) > 0) {
            foreach ($groups as $key => $value) {
                echo "<li class=\"dropdown\">" . PHP_EOL;
                echo "<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">";
                echo "<span class=\"fa ";
                if ($key == "Administration") {
                    echo "fa-cogs";
                } else {
                    echo "fa-list";
                }
                echo "\"></span>&nbsp;" . $key . " <span class=\"caret\"></span></a>" . PHP_EOL;
                echo "<ul class=\"dropdown-menu\" role=\"menu\">" . PHP_EOL;
                $this->processMenuItems($value);
                echo "</ul>" . PHP_EOL . "</li>" . PHP_EOL;
            }
        }

        $this->processMenuItems($module_list);

        echo "</ul>" . PHP_EOL;
    }

    // process menu items
    private function processMenuItems($items) {
        foreach ($items as $item) {
            if (isset($item["divider"]) && $item["divider"] == true) {
                echo "<li class='divider'></li>" . PHP_EOL;
            }
            echo "<li><a href='" . $this->getPath() . $item["module"];
            if ($item["group"] == "Administration") {
                echo "/administration";
            } elseif (isset($item["url"]) && !empty($item["url"])) {
                echo $item["url"];
            }
            echo "'><span class='fa " . $item["icon"] . "'></span> " . $item["name"] . "</a></li>" . PHP_EOL;
        }
    }

    // get modules
    public function getModules() {
        $modules = scandir($this->getPath(true) . "modules");
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
                if (file_exists($this->getPath(true) . "modules/" . $module . "/info.php")) {
                    include $this->getPath(true) . "modules/" . $module . "/info.php";

                    $module_info["module"] = $module;
                    $module_list[] = $module_info;
                } elseif (file_exists($this->getPath(true) . "modules/" . $module . "/administration/info.php")) {
                    include $this->getPath(true) . "modules/" . $module . "/administration/info.php";

                    $module_info["module"] = $module;
                    $module_list[] = $module_info;
                }
            }
        }
        return $module_list;
    }

    //get theme
    public function getTheme() {
        $theme = SystemSetting::getByKey("ARCTHEME");
        if (empty($theme->setting) || !file_exists($this->getPath(true) . "templates/" . $theme->setting)) {
            return "templates/default/";
        }
        return "templates/" . $theme->setting . "/";
    }

    //powered by
    public function poweredBy() {
        return "Powered by Arc, Version: " . ARCVERSION;
    }

}
