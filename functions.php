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
    return $GLOBALS['arc_db'];
}

// get www path or filesystem path if true
function arcGetPath($filesystem = false) {
    if ($filesystem) {
        return $_SERVER['DOCUMENT_ROOT'] . ARCFS;
    }
    return ARCWWW;
}

// url data
$arc_url_data = null;

// get url data
function arcGetURLData($name = null) {
    if ($name != null) {
        if (isset($GLOBALS['arc_url_data'][$name])) {
            return $GLOBALS['arc_url_data'][$name];
        }
        return null;
    }
    return $GLOBALS['arc_url_data'];
}

$arc_page;

// function to split url
function arcSplitURL() {
    if (isset($_REQUEST['url'])) {
        $url = explode('/', $_REQUEST['url']);
        $count = 0;
        foreach ($url as $item) {
            if ($count == 0) {
                $GLOBALS['arc_url_data']['module'] = $item;
            } else {
                $GLOBALS['arc_url_data']['data' . $count] = $item;
            }
            $count++;
        }
    }
}

// get header
function arcGetHeader() {
    arcSplitURL();

    $GLOBALS['arc_page'] = Page::getBySEOURL(arcGetURLData('module'));

    // website title
    echo '<title>';
    if (!empty($GLOBALS['arc_page']->title)) {
        echo $GLOBALS['arc_page']->title;
    } else {
        echo ARCTITLE;
    }
    echo '</title>' . PHP_EOL;

    // website author
    echo '<meta name="author" content="' . ARCAUTHOR . '">' . PHP_EOL;

    // website met adescription
    echo '<meta name="description" content="';
    if (!empty($GLOBALS['arc_page']->metadescription)) {
        echo $GLOBALS['arc_page']->metadescription;
    } else {
        echo ARCDESCRIPTION;
    }
    echo '">' . PHP_EOL;

    // website meta keywords
    echo '<meta name="keywords" content="';
    if (!empty($GLOBALS['arc_page']->metakeywords)) {
        echo $GLOBALS['arc_page']->metakeywords;
    } else {
        echo ARCKEYWORDS;
    }
    echo '">' . PHP_EOL;

    // website icon
    echo '<link rel="icon" href="' . ARCFAVICON . '">' . PHP_EOL;
}

// set page
function arcSetPage($name, $data = null) {
    $GLOBALS['arc_url_data'] = array();
    $GLOBALS['arc_url_data']['module'] = $name;
    $GLOBALS['arc_url_data']['data'] = $data;
}

// get content
function arcGetContent() {
    if (arcGetURLData('module') == 'logout') {
        session_unset();
        session_destroy();
        echo '<script>window.location = "' . ARCWWW . '";</script>';
        return;
    }

    $timeout = ARCSESSIONTIMEOUT * 60;
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeout)) {
        session_unset();
        session_destroy();
        arcSetPage('error', '419');
    } else {
        $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
       
        // if no module, use default from config.
        if (empty(arcGetURLData('module'))) {
            // get the default page of module.
            switch (ARCDEFAULTTYPE) {
                case 'module':
                    if (isset($_REQUEST['url'])) {
                        arcSetPage(ARCDEFAULTPAGE, $_REQUEST['url']);
                    } else {
                        arcSetPage(ARCDEFAULTPAGE, null);
                    }
                    break;
                case 'page':
                    arcSetPage('page', ARCDEFAULTPAGE);
                    break;
                default:
                    arcSetPage('error', '404');
                    break;
            }
        } elseif (!empty($GLOBALS['arc_page']->title)) {
            // if we have a page set it.
            arcSetPage('page', $GLOBALS['arc_page']->seourl);
        }

        if (!file_exists(arcGetPath(true) . 'modules/' . arcGetURLData('module'))) {
            // module not found.
            arcSetPage('error', '404');
        } else {

            $permissions;
            if (!empty(arcGetUser())) {
                $user = arcGetUser();
                $group = $user->getGroup();
                $permissions = $group->getPermissions();
            } else {
                $group = UserGroup::getByName('Anyone');
                $permissions = $group->getPermissions();
            }

            if (arcGetURLData('module') == 'page') {
                if (!UserPermission::hasPermission($permissions, 'page/' . arcGetURLData('data'))) {
                    arcSetPage('error', '403');
                }
            } else {
                if (!UserPermission::hasPermission($permissions, 'module/' . arcGetURLData('module'))) {
                    arcSetPage('error', '403');
                }
            }
        }
    }

    include_once arcGetPath(true) . 'modules/' . arcGetURLData('module') . '/index.php';
}

// get user
function arcGetUser() {
    if (isset($_SESSION['arc_user'])) {
        return unserialize($_SESSION['arc_user']);
    }
    return null;
}

// set user
function arcSetUser($user) {
    $_SESSION['arc_user'] = serialize($user);
}

// redirect to default
function arcRedirect() {
    if (!empty(arcGetUser())) {
        echo '<script>window.location = "' . ARCWWW . '";</script>';
    }
}

// get dispatch url
function arcGetDispatch() {
    echo ARCWWW . 'modules/' . arcGetURLData('module') . '/dispatch.php';
}

// get module root
function arcGetModulePath($filesystem = false) {
    if ($filesystem == true) {
        return arcGetPath(true) . 'modules/' . arcGetURLData('module');
    }
    return ARCWWW . arcGetURLData('module');
}

// get menu
function arcGetMenu() {
    $modules = scandir(arcGetPath(true) . 'modules');
    $module_list = array();
    $groups = array();
    foreach ($modules as $module) {
        if ($module != '..' && $module != '.') {
            if (file_exists(arcGetPath(true) . 'modules/' . $module . '/menu.php')) {
                include arcGetPath(true) . 'modules/' . $module . '/menu.php';
                $menu['module'] = $module;
                if (empty($menu['group'])) {
                    $module_list[] = $menu;
                } else {
                    $groups[$menu['group']][] = $menu;
                }
            }
        }
    }

    // logout menu (last item)
    $menu['name'] = 'Logout';
    $menu['icon'] = 'fa-lock';
    $menu['divider'] = false;
    $menu['requireslogin'] = true;
    $menu['group'] = '';
    $menu['module'] = 'logout';
    $module_list[] = $menu;

    echo '<ul class="nav navbar-nav navbar-right">';

    if (count($groups) > 0) {
        foreach ($groups as $key => $value) {
            echo '<li class="dropdown">';
            echo '<a class="dropdown-toggle" data-toggle="dropdown" href="#">';
            echo '<span class="fa fa-list"></span>&nbsp;' . $key . ' <span class="caret"></span></a>';
            echo '<ul class="dropdown-menu" role="menu">';
            arcProcessMenuItems($value);
            echo '</ul></li>';
        }
    }

    arcProcessMenuItems($module_list);

    echo '</ul>';
}

// process menu items
function arcProcessMenuItems($items) {
    if (!empty(arcGetUser())) {
        foreach ($items as $item) {
            if ($item['requireslogin'] == true) {
                if ($item['divider'] == true) {
                    echo '<li class="divider"></li>';
                }
                echo '<li><a href="' . arcGetPath() . $item['module'] . '"><span class="fa ' . $item['icon'] . '"></span> ' . $item['name'] . '</a></li>';
            }
        }
    } else {
        foreach ($items as $item) {
            if ($item['requireslogin'] == false) {
                if ($item['divider'] == true) {
                    echo '<li class="divider"></li>';
                }
                echo '<li><a href="' . arcGetPath() . $item['module'] . '"><span class="fa ' . $item['icon'] . '"></span> ' . $item['name'] . '</a></li>';
            }
        }
    }
}

// get modules
function arcGetModules() {
    $modules = scandir(arcGetPath(true) . 'modules');
    $module_list = array();
    foreach ($modules as $module) {
        if ($module != '..' && $module != '.') {
            include arcGetPath(true) . 'modules/' . $module . '/info.php';
            $module_info['module'] = $module;
            $module_list[] = $module_info;
        }
    }
    return $module_list;
}

//get theme
function arcGetTheme() {
    if (!empty(arcGetUser())) {
        $user = arcGetUser();
        $theme = $user->getSettingByKey('ARC_THEME');
        if (!empty($theme->setting)) {
            return 'themes/' . $theme->setting . '.min.css';
        }
    }
    return 'bootstrap-theme.min.css';
}
