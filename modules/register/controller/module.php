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
if (isset($_POST["email"])) {
    require "../../../system/bootstrap.php";
    if (empty($_POST["firstname"])) {
        echo "danger|<strong>Firstname</strong> must be provided";
        return;
    }

    if (empty($_POST["lastname"])) {
        echo "danger|<strong>Lastname</strong> must be provided";
        return;
    }

    if (empty($_POST["email"])) {
        echo "danger|<strong>Email address</strong> must be provided";
        return;
    }

    if (empty($_POST["password"])) {
        echo "danger|<strong>Password</strong> must be provided";
        return;
    }

    if (empty($_POST["password2"])) {
        echo "danger|<strong>Password retype</strong> must be provided";
        return;
    }

    if ($_POST["password"] != $_POST["password2"]) {
        echo "danger|Passwords do not match";
        return;
    }

    $user = User::getByEmail($_POST["email"]);
    if ($user->id > 0) {
        echo "danger|<strong>Email address</strong> already registered";
        return;
    }

    $user->firstname = ucfirst($_POST["firstname"]);
    $user->lastname = ucfirst($_POST["lastname"]);
    $user->email = strtolower($_POST["email"]);
    $user->setPassword($_POST["password"]);
    $user->usergroupid = 2;
    $user->update();

    arcSetUser($user);
    echo "success|Your details have been registered";
}
