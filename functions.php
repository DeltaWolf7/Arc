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
 * Application functions
 *
 * @author Craig Longford
 */
// get database object
function arcDatabase() {
    return $GLOBALS["arc_db"];
}

// get www path or filesystem path if true
function arcGetPath($filesystem = false) {
    if ($filesystem) {
        return $_SERVER["DOCUMENT_ROOT"] . ARCFS;
    }
    return ARCWWW;
}

// url data
$arc_url_data = null;

// get url data
function arcGetURLData($name = null) {
    if ($name != null) {
        if (isset($GLOBALS["arc_url_data"][$name])) {
            return $GLOBALS["arc_url_data"][$name];
        }
        return null;
    }
    return $GLOBALS["arc_url_data"];
}

// function to split url
function arcSplitURL() {
    if (isset($_REQUEST["url"])) {
        $url = explode("/", $_REQUEST["url"]);
        $count = 0;
        foreach ($url as $item) {
            if ($count == 0) {
                $GLOBALS["arc_url_data"]["module"] = $item;
            } else {
                $GLOBALS["arc_url_data"]["data" . $count] = $item;
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

// get header
function arcGetHeader() {
    arcSplitURL();

    $page = Page::getBySEOURL(arcGetURLData("data1"));
    echo "<title>";
    if (!empty($page->title)) {
        echo $page->title;
    } else {
        echo ARCTITLE;
    }

    echo "</title>" . PHP_EOL;
    echo "\t<meta name='author' content='" . ARCAUTHOR . "'>" . PHP_EOL;
    if (!empty($page->metadescription)) {
        echo "\t<meta name='description' content='" . $page->metadescription . "'>" . PHP_EOL;
    }
    if (!empty($page->metakeywords)) {
        echo "\t<meta name='keywords' content='" . $page->metakeywords . "'>" . PHP_EOL;
    }
    if (!empty($page->title)) {
        echo "\t<link rel='alternate' href='http://" . $_SERVER['HTTP_HOST'] . ARCWWW . "page/" . $page->seourl . "'>" . PHP_EOL;
    }
    echo "\t<link rel='icon' href='" . ARCFAVICON . "'>" . PHP_EOL;

    arcGetCSSJavascript("css", "css/");
    if (!empty(arcGetURLData("module"))) {
        arcGetCSSJavascript("css", "modules/" . arcGetURLData("module") . "/css/");
    }
    arcGetTheme();

    arcGetCSSJavascript("js", "js/");
    if (!empty(arcGetURLData("module"))) {
        arcGetCSSJavascript("js", "modules/" . arcGetURLData("module") . "/js/");
    }
}

// output css and javascript
function arcGetCSSJavascript($type, $path) {
    if (file_exists(arcGetPath(true) . $path)) {
        $files = scandir(arcGetPath(true) . $path);
        foreach ($files as $file) {
            if ($file != "." && $file != ".." && !is_dir(arcGetPath(true) . $path . $file)) {
                if ($type == "js") {
                    echo "\t<script src='" . arcGetPath() . $path . $file . "'></script>" . PHP_EOL;
                } elseif ($type == "css") {
                    echo "\t<link href='" . arcGetPath() . $path . $file . "' rel='stylesheet'>" . PHP_EOL;
                }
            }
        }
    }
}

// set page
function arcSetPage($name, $data = null) {
    $GLOBALS["arc_url_data"] = array();
    $GLOBALS["arc_url_data"]["module"] = $name;
    $count = 1;
    $url = explode("/", $data);
    foreach ($url as $item) {
        $GLOBALS["arc_url_data"]["data" . $count] = $item;
        $count++;
    }
}

// get content
function arcGetContent() {
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
        if (!empty($GLOBALS["arc_page"]->title)) {
            // if we have a page set it.
            arcSetPage("page", $GLOBALS["arc_page"]->seourl);
        }

        if (!file_exists(arcGetPath(true) . "modules/" . arcGetURLData("module"))) {
            // module not found.
            arcSetPage("error", "404");
        } else {

            $permissions;
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

    if (arcGetURLData("data1") == "administration") {
        include_once arcGetPath(true) . "modules/" . arcGetURLData("module") . "/administration/index.php";
    } else {
        include_once arcGetPath(true) . "modules/" . arcGetURLData("module") . "/index.php";
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

// redirect to default
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
        $group->getByID("3");
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

                    if (isset($module_info["menu"])) {
                        $module_info["module"] = $module;
                        if (empty($module_info["group"])) {
                            $module_list[] = $module_info;
                        } else {
                            $groups[$module_info["group"]][] = $module_info;
                        }
                    }
                }
            }

            // module administration menu
            if ($group->name == "Administrators") {
                if (file_exists(arcGetPath(true) . "modules/" . $module . "/administration/info.php")) {
                    include arcGetPath(true) . "modules/" . $module . "/administration/info.php";
                    $module_info["group"] = "Administration";
                    $module_info["requireslogin"] = true;
                    $module_info["module"] = $module;
                    $groups["Administration"][] = $module_info;
                }
            }
        }
    }

    // logout menu (last item)
    $module_info["menu"] = "Logout";
    $module_info["icon"] = "fa-lock";
    $module_info["divider"] = false;
    $module_info["requireslogin"] = true;
    $module_info["group"] = "";
    $module_info["module"] = "logout";
    $module_list[] = $module_info;

    echo "\t<ul class='nav navbar-nav navbar-right'>" . PHP_EOL;

    if (count($groups) > 0) {
        foreach ($groups as $key => $value) {
            echo "\t\t<li class='dropdown'>";
            echo "<a href='#' class='dropdown-toggle' data-toggle='dropdown'>";
            echo "<span class='fa ";
            if ($key == "Administration") {
                echo "fa-cogs";
            } else {
                echo "fa-list";
            }
            echo "'></span>&nbsp;" . $key . " <span class='caret'></span></a>";
            echo "\t\t<ul class='dropdown-menu' role='menu'>";
            arcProcessMenuItems($value);
            echo "</ul></li>" . PHP_EOL;
        }
    }

    arcProcessMenuItems($module_list);

    echo "</ul>" . PHP_EOL;
}

// process menu items
function arcProcessMenuItems($items) {
    if (!empty(arcGetUser())) {
        foreach ($items as $item) {
            if ($item["requireslogin"] == true) {
                if ($item["divider"] == true) {
                    echo "\t\t\t<li class='divider'></li>" . PHP_EOL;
                }
                echo "\t\t\t<li><a href='" . arcGetPath() . $item["module"];
                if ($item["group"] == "Administration") {
                    echo "/administration";
                }
                echo "'><span class='fa " . $item["icon"] . "'></span> " . $item["menu"] . "</a></li>" . PHP_EOL;
            }
        }
    } else {
        foreach ($items as $item) {
            if ($item["requireslogin"] == false) {
                if ($item["divider"] == true) {
                    echo "\t\t\t<li class='divider'></li>" . PHP_EOL;
                }
                echo "<li><a href='" . arcGetPath() . $item["module"] . "'><span class='fa " . $item["icon"] . "'></span> " . $item["menu"] . "</a></li>" . PHP_EOL;
            }
        }
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
    if (!empty(arcGetUser())) {
        $user = arcGetUser();
        $theme = $user->getSettingByKey("ARC_THEME");
        if (!empty($theme->setting)) {
            echo "\t<link href='" . arcGetPath() . "css/themes/" . $theme->setting . ".min.css' rel='stylesheet'>" . PHP_EOL;
            return;
        }
    }
    echo "\t<link href='" . arcGetPath() . "css/themes/bootstrap-theme.min.css' rel='stylesheet'>" . PHP_EOL;
}
