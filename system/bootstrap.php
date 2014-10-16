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
 * Application bootstrap
 *
 * @author Craig Longford
 */
// start session
session_start();
// get config file
require_once $_SERVER["DOCUMENT_ROOT"] . "/config.php";

// check if debug is enabled
if (ARCDEBUG == true) {
    error_reporting(E_ALL);
    ini_set("display_errors", "1");
}

if (version_compare(phpversion(), '5.3.0', '<') == true) {
    exit('PHP 5.3+ Required');
}

if (!ini_get('date.timezone')) {
    date_default_timezone_set('UTC');
}

// arc storage
$arc = array();

// setup database connection from config
require_once $_SERVER["DOCUMENT_ROOT"] . ARCFS . "system/medoo.min.php";
try {
    $arc["database"] = new medoo([
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

// class auto loader
function __autoload($class_name) {
    if (file_exists($_SERVER["DOCUMENT_ROOT"] . ARCFS . "classes/" . $class_name . ".class.php")) {
        require_once($_SERVER["DOCUMENT_ROOT"] . ARCFS . "classes/" . $class_name . ".class.php");
    } elseif (file_exists($_SERVER["DOCUMENT_ROOT"] . ARCFS . "modules/" . arcGetURLData("module") . "/classes/" . $class_name . ".class.php")) {
        require_once($_SERVER["DOCUMENT_ROOT"] . ARCFS . "modules/" . arcGetURLData("module") . "/classes/" . $class_name . ".class.php");
    }
}

$arc["headerdata"] = array();

// javascript
arcAddHeader("js", arcGetPath() . "js/jquery.min.js");
arcAddHeader("js", arcGetPath() . "js/jquery-hotkeys.min.js");
arcAddHeader("js", arcGetPath() . "js/bootstrap.min.js");
arcAddHeader("js", arcGetPath() . "js/bootstrap-datepicker.min.js");
arcAddHeader("js", arcGetPath() . "js/bootstrap-filestyle.min.js");
arcAddHeader("js", arcGetPath() . "js/bootstrap-wysiwyg.min.js");
arcAddHeader("js", arcGetPath() . "js/delta-ajax.min.js");
arcAddHeader("js", arcGetPath() . "js/status.min.js");

// css
arcAddHeader("css", arcGetPath() . "css/bootstrap.min.css");
arcAddHeader("css", arcGetPath() . "css/datepicker.min.css");
arcAddHeader("css", arcGetPath() . "css/font-awesome.min.css");
arcAddHeader("css", arcGetPath() . "css/status.min.css");

// favicon
if (file_exists(arcGetPath() . ARCFAVICON)) {
    arcAddHeader("facicon", arcGetPath() . ARCFAVICON);
}

// split the url, get module and data.
arcSplitURL();

// get database object
function arcGetDatabase() {
    global $arc;
    return $arc["database"];
}

// get www path or filesystem path if true
function arcGetPath($filesystem = false) {
    if ($filesystem) {
        return $_SERVER["DOCUMENT_ROOT"] . ARCFS;
    }
    return ARCWWW;
}

// get url data
function arcGetURLData($name = null) {
    global $arc;
    if (!empty($name)) {
        if (isset($arc["urldata"][$name])) {
            return $arc["urldata"][$name];
        }
        return null;
    }
    return $arc["urldata"];
}

// function to split url
function arcSplitURL() {
    global $arc;
    $arc["urldata"] = array();
    if (isset($_REQUEST["url"])) {
        $url = explode("/", $_REQUEST["url"]);
        $count = 0;
        foreach ($url as $item) {
            if ($count == 0) {
                $arc["urldata"]["module"] = $item;
            } else {
                $arc["urldata"]["data" . $count] = $item;
            }
            $count++;
        }
    } else {
        // get the default page of module.
        switch (ARCDEFAULTTYPE) {
            case "module":
                arcSetPage(ARCDEFAULTPAGE, null);
                break;
            case "page":
                arcSetPage("page", ARCDEFAULTPAGE);
                break;
            default:
                arcSetPage("error", "404");
                break;
        }
    }
}

// add to header
function arcAddHeader($type, $content) {
    global $arc;
    switch ($type) {
        case "title":
            $arc["headerdata"][] = "\t<title>" . $content . "</title>" . PHP_EOL;
            break;
        case "description":
            $arc["headerdata"][] = "\t<meta name=\"description\" content=\"" . $content . "\">" . PHP_EOL;
            break;
        case "keywords":
            $arc["headerdata"][] = "\t<meta name=\"keywords\" content=\"" . $content . "\">" . PHP_EOL;
            break;
        case "author":
            $arc["headerdata"][] = "\t<meta name=\"author\" content=\"" . $content . "\">" . PHP_EOL;
            break;
        case "alternate":
            $arc["headerdata"][] = "\t<link rel=\"alternate\" href=\"http://" . $_SERVER['HTTP_HOST'] . ARCWWW . $content . "\">" . PHP_EOL;
            break;
        case "canonical":
            $arc["headerdata"][] = "\t<link rel=\"canonical\" href=\"" . $content . "\" />" . PHP_EOL;
            break;
        case "css":
            $arc["headerdata"][] = "\t<link href=\"" . $content . "\" rel=\"stylesheet\">" . PHP_EOL;
            break;
        case "js":
            $arc["headerdata"][] = "\t<script src=\"" . $content . "\"></script>" . PHP_EOL;
            break;
        case "favicon":
            $arc["headerdata"][] = "\t<link href=\"" . arcGetPath() . ARCFAVICON . "\" rel=\"icon\">" . PHP_EOL;
            break;
        default:
            $arc["headerdata"][] = "\t" . $content;
            break;
    }
}

function arcGetController() {
    include arcGetTheme() . "controller/index.php";

    // get module controllers
    if (!empty(arcGetURLData("module"))) {
        $path = arcGetPath(true) . "modules/" . arcGetURLData("module");
        if (arcGetURLData("data1") == "administration") {
            $path .= "/administration";
        }
        $path .= "/controller/index.php";

        if (file_exists($path)) {
            include_once $path;
        }
    }
}

function arcGetView() {
    if (arcGetURLData("module") == "logout") {
        session_unset();
        session_destroy();
        arcRedirect();
        return;
    }

    $timeout = ARCSESSIONTIMEOUT * 60;
    if (isset($_SESSION["LAST_ACTIVITY"]) && (time() - $_SESSION["LAST_ACTIVITY"] > $timeout)) {
        session_unset();
        session_destroy();
        arcSetPage("error", "419");
    } else {
        $_SESSION["LAST_ACTIVITY"] = time(); // update last activity time stamp   

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

            $pCheck = arcGetURLData("module") . "/" . arcGetURLData("data1");

            if (arcGetURLData("module") != "page") {
                $pCheck = "module/" . arcGetURLData("module");
            }

            if (!UserPermission::hasPermission($permissions, $pCheck)) {
                arcSetPage("error", "403");
            }
        }
    }

    include arcGetTheme() . "view/index.php";
}

// get content
function arcGetContent() {
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
}

// get header
function arcGetHeader() {
    global $arc;
// output header
    foreach ($arc["headerdata"] as $line) {
        echo $line;
    }
}

// set page
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

// get user
function arcGetUser() {
    if (isset($_SESSION["arc_user"])) {
        return unserialize($_SESSION["arc_user"]);
    }
    return null;
}

// set user
function arcSetUser($user) {
    $_SESSION["arc_user"] = serialize($user);
}

// arcRedirect to default
function arcRedirect($destination = null) {
    echo "<script>window.location = '";
    if (empty($destination)) {
        echo ARCWWW;
    } else {
        echo $destination;
    }
    echo "';</script>";
}

// get dispatch url
function arcGetDispatch() {
    if (arcGetURLData("data1") == "administration") {
        echo ARCWWW . "modules/" . arcGetURLData("module") . "/administration/dispatch.php";
    } else {
        echo ARCWWW . "modules/" . arcGetURLData('module') . "/dispatch.php";
    }
}

// get module root
function arcGetModulePath($filesystem = false) {
    if ($filesystem == true) {
        if (arcGetURLData("data1") == "administration") {
            return arcGetPath(true) . "modules/" . arcGetURLData("module") . "/administration/";
        } else {
            return arcGetPath(true) . "modules/" . arcGetURLData("module");
        }
    }
    if (arcGetURLData("data1") == "administration") {
        return ARCWWW . arcGetURLData("module") . "/administration/";
    } else {
        return ARCWWW . arcGetURLData("module");
    }
}

// get menu
function arcGetMenu() {
    $modules = scandir(arcGetPath(true) . "modules");
    $module_list = array();
    $groups = array();

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
        $module_info = "";
        if ($module != ".." && $module != ".") {
// module menu
            if (file_exists(arcGetPath(true) . "modules/" . $module . "/info.php")) {
                if ($perms->hasPermission($permissions, "module/" . $module)) {
                    include arcGetPath(true) . "modules/" . $module . "/info.php";
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
                if (file_exists(arcGetPath(true) . "modules/" . $module . "/administration/info.php")) {
                    include arcGetPath(true) . "modules/" . $module . "/administration/info.php";
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
            arcProcessMenuItems($value);
            echo "</ul>" . PHP_EOL . "</li>" . PHP_EOL;
        }
    }

    arcProcessMenuItems($module_list);

    echo "</ul>" . PHP_EOL;
}

// process menu items
function arcProcessMenuItems($items) {
    foreach ($items as $item) {
        if (isset($item["divider"]) && $item["divider"] == true) {
            echo "<li class='divider'></li>" . PHP_EOL;
        }
        echo "<li><a href='" . arcGetPath() . $item["module"];
        if ($item["group"] == "Administration") {
            echo "/administration";
        } elseif (isset($item["url"]) && !empty($item["url"])) {
            echo $item["url"];
        }
        echo "'><span class='fa " . $item["icon"] . "'></span> " . $item["name"] . "</a></li>" . PHP_EOL;
    }
}

// get modules
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
            } elseif (file_exists(arcGetPath(true) . "modules/" . $module . "/administration/info.php")) {
                include arcGetPath(true) . "modules/" . $module . "/administration/info.php";

                $module_info["module"] = $module;
                $module_list[] = $module_info;
            }
        }
    }
    return $module_list;
}

//get theme
function arcGetTheme() {
    $theme = SystemSetting::getByKey("ARCTHEME");
    if (empty($theme->setting) || !file_exists(arcGetPath(true) . "templates/" . $theme->setting)) {
        return "templates/default/";
    }
    return "templates/" . $theme->setting . "/";
}

//powered by
function arcPoweredBy() {
    return "Powered by Arc, Version: " . ARCVERSION;
}