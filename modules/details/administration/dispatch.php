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
 * AJAX data dispatch handler
 *
 * @author Craig Longford
 */
require_once '../../../bootstrap.php';

if ($_POST['action'] == 'saveuser') {
    $user = new User();
    $user->getByID($_POST['userid']);

// theme settings
    $theme = $user->getSettingByKey('ARC_THEME');
    $theme->setting = $_POST['theme'];


// password settings
    if (!empty($_POST['password'])) {

        if (strlen($_POST['password']) > 0 && ($_POST['password'] == $_POST['retype'])) {
            $user->setPassword($_POST['password']);
        } else {
            echo 'danger|Password and retyped password do not match';
            return;
        }
    }

    $user->firstname = $_POST['firstname'];
    $user->lastname = $_POST['lastname'];
    $user->email = $_POST['email'];
    
    $user->usergroupid = $_POST['group'];

    $user->update();
    $theme->update();

    echo 'success|User saved';
} elseif ($_POST['action'] == 'savepermission') {
    $permission = new UserPermission();
    $permission->getByID($_POST['id']);
    $permission->permission = $_POST['data'];
    $permission->update();
    echo 'success|Permission saved';
}
