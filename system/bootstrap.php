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

// check that we are using PHP 5.3 or better.
if (version_compare(phpversion(), '5.3.0', '<') == true) {
    exit('PHP 5.3 or newer required');
}

// make sure we have the correct time zone.
if (!ini_get('date.timezone')) {
    date_default_timezone_set('UTC');
}

// arc storage (stores system values)
$arc = array();
// setup empty menu array
$arc["menu"] = array();

// include required database system
require_once $_SERVER["DOCUMENT_ROOT"] . ARCFS . "system/medoo.min.php";

// create a connection to the database
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

// log access
LastAccess::logAccess(arcGetUser());

/**
 * 
 * @param string $class_name The class to search for
 */
function __autoload($class_name) {
    // check for system classes and check for classes in modules.
    if (file_exists($_SERVER["DOCUMENT_ROOT"] . ARCFS . "classes/" . $class_name . ".class.php")) {
        require_once($_SERVER["DOCUMENT_ROOT"] . ARCFS . "classes/" . $class_name . ".class.php");
    } elseif (file_exists($_SERVER["DOCUMENT_ROOT"] . ARCFS . "modules/" . arcGetURLData("module") . "/classes/" . $class_name . ".class.php")) {
        require_once($_SERVER["DOCUMENT_ROOT"] . ARCFS . "modules/" . arcGetURLData("module") . "/classes/" . $class_name . ".class.php");
    } elseif (isset($_SERVER["REQUEST_URI"]) && arcGetURLData("module") == "page") {
        // check if we are in a module, if so make the system aware for dispatch.
        $path = explode("/", $_SERVER["REQUEST_URI"]);
        if (isset($path[2]) && file_exists($_SERVER["DOCUMENT_ROOT"] . ARCFS . "modules/" . $path[2] . "/classes/" . $class_name . ".class.php")) {
            require_once($_SERVER["DOCUMENT_ROOT"] . ARCFS . "modules/" . $path[2] . "/classes/" . $class_name . ".class.php");
        }
    }
}

function arcGetClass($path) {
    if (file_exists($path)) {
        require_once($path);
        return true;
    }
    return false;
}

// javascript, add required javascript files to header
arcAddHeader("js", arcGetPath() . "js/jquery.min.js");
arcAddHeader("js", arcGetPath() . "js/jquery-hotkeys.min.js");
arcAddHeader("js", arcGetPath() . "js/moment.min.js");
arcAddHeader("js", arcGetPath() . "js/bootstrap.min.js");
arcAddHeader("js", arcGetPath() . "js/bootstrap-datetimepicker.min.js");
arcAddHeader("js", arcGetPath() . "js/bootstrap-filestyle.min.js");
arcAddHeader("js", arcGetPath() . "js/bootstrap-wysiwyg.min.js");
arcAddHeader("js", arcGetPath() . "js/delta-ajax.min.js");
arcAddHeader("js", arcGetPath() . "js/status.min.js");

// css, add required css files to header
arcAddHeader("css", arcGetPath() . "css/bootstrap.min.css");
arcAddHeader("css", arcGetPath() . "css/bootstrap-datetimepicker.min.css");
arcAddHeader("css", arcGetPath() . "css/font-awesome.min.css");
arcAddHeader("css", arcGetPath() . "css/status.min.css");

// favicon, add favicon it it exists.
if (file_exists(arcGetPath() . ARCFAVICON)) {
    arcAddHeader("facicon", arcGetPath() . ARCFAVICON);
}

// split the url and get module and data.
arcSplitURL();

/**
 * 
 * @global array $arc Arc settings storage
 * @return \medoo Database connection
 */
function arcGetDatabase() {
    global $arc;
    return $arc["database"];
}

/**
 * 
 * @param bool $filesystem True to return filesystem path, false for web path
 * @return string
 */
function arcGetPath($filesystem = false) {
    if ($filesystem) {
        return $_SERVER["DOCUMENT_ROOT"] . ARCFS;
    }
    return ARCWWW;
}

/**
 * 
 * @global array $arc Arc settings storage
 * @param string $name Section to get
 * @return string Module or data
 */
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

/**
 * 
 * @global array $arc Arc settings storage
 * Splits the URL
 */
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

/**
 * 
 * @global array $arc Arc settings storage
 * @param string $type title, description, keywords, author, alternate, canonical, css, js, favicon
 * @param string $content Value to assign to tag
 */
function arcAddHeader($type, $content) {
    global $arc;
    switch ($type) {
        case "title":
            $arc["headerdata"][] = "<title>" . $content . "</title>" . PHP_EOL;
            break;
        case "description":
            $arc["headerdata"][] = "<meta name=\"description\" content=\"" . $content . "\">" . PHP_EOL;
            break;
        case "keywords":
            $arc["headerdata"][] = "<meta name=\"keywords\" content=\"" . $content . "\">" . PHP_EOL;
            break;
        case "author":
            $arc["headerdata"][] = "<meta name=\"author\" content=\"" . $content . "\">" . PHP_EOL;
            break;
        case "alternate":
            $arc["headerdata"][] = "<link rel=\"alternate\" href=\"http://" . $_SERVER['HTTP_HOST'] . ARCWWW . $content . "\">" . PHP_EOL;
            break;
        case "canonical":
            $arc["headerdata"][] = "<link rel=\"canonical\" href=\"" . $content . "\" />" . PHP_EOL;
            break;
        case "css":
            $arc["headerdata"][] = "<link href=\"" . $content . "\" rel=\"stylesheet\">" . PHP_EOL;
            break;
        case "js":
            $arc["headerdata"][] = "<script src=\"" . $content . "\"></script>" . PHP_EOL;
            break;
        case "favicon":
            $arc["headerdata"][] = "<link href=\"" . arcGetPath() . ARCFAVICON . "\" rel=\"icon\">" . PHP_EOL;
            break;
        default:
            $arc["headerdata"][] = $content;
            break;
    }
}

/**
 * Includes the controller path used by the current page
 */
function arcGetController() {
    include arcGetTheme() . "controller/index.php";

// get module controllers
    if (!empty(arcGetURLData("module"))) {
        $path = arcGetPath(true) . "modules/" . arcGetURLData("module");
        if (arcGetURLData("data1") == "administration") {
            $path .= "/administration";
        }
        $path .= "/controller/";

        if (!empty(arcGetURLData("data1")) && file_exists($path . arcGetURLData("data1") . ".php")) {
            $path .= arcGetURLData("data1");
        } else {
            $path .= "index";
        }
        $path .= ".php";
        if (file_exists($path)) {
            include_once $path;
            return;
        }

        $page = Page::getBySEOURL(arcGetURLData("module"));
        if ($page->id > 0) {
            include_once arcGetPath(true) . "modules/page/controller/index.php";
        }
    }
}

/**
 * 
 * @return null Returns on user logout
 * Includes the specified view
 */
function arcGetView() {
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

// include default theme view
    include arcGetTheme() . "view/index.php";
}

/**
 * Include the content from the selected module
 */
function arcGetContent() {
    if (file_exists(arcGetTheme() . "overrides/" . arcGetURLData("module") . "/index.php")) {
        include_once arcGetTheme() . "overrides/" . arcGetURLData("module") . "/index.php";
    } else {
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
}

/**
 * 
 * @global array $arc Arc settings storage
 * Adds header information to a page from header array
 */
function arcGetHeader() {
    global $arc;
// output header
    foreach ($arc["headerdata"] as $line) {
        echo $line;
    }
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
    echo "<script>window.location = '";
    if (empty($destination)) {
        echo ARCWWW;
    } else {
        echo $destination;
    }
    echo "';</script>";
}

/**
 * Output the path the the modules dispatch file
 */
function arcGetDispatch() {
    $path = ARCWWW . "modules/" . arcGetURLData("module");
    if (arcGetURLData("data1") == "administration") {
        $path .= "/administration";
    }
    $path .= "/dispatch.php";
    echo $path;
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
        return ARCWWW . arcGetURLData("module") . "/administration/";
    } else {
        return ARCWWW . arcGetURLData("module");
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
            echo "<li><a href=\"" . ARCWWW . $value["module"];
            if (isset($value["url"])) {
                echo $value["url"];
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
            } elseif (file_exists(arcGetPath(true) . "modules/" . $module . "/administration/info.php")) {
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
 * @return string Path to template in use
 */
function arcGetTheme() {
    $theme = SystemSetting::getByKey("ARCTHEME");
    if (empty($theme->setting) || !file_exists(arcGetPath(true) . "templates/" . $theme->setting)) {
        return "templates/default/";
    }
    return "templates/" . $theme->setting . "/";
}

/**
 * 
 * @return string Arc version information
 */
function arcPoweredBy() {
    return "Powered by Arc, Version: " . ARCVERSION;
}

/**
 * 
 * @return string domain name and path of Arc
 */
function arcGetHost() {
    return "http://" . $_SERVER['SERVER_NAME'] . ARCWWW;
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
