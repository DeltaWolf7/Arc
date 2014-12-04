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
if (isset($_POST["action"])) {
    require "../../../system/bootstrap.php";
    
    if ($_POST["action"] == "login") {

        if (empty($_POST["email"])) {
            echo "danger|<strong>Email address</strong> must be provided";
            return;
        }

        if (empty($_POST["password"])) {
            echo "danger|<strong>Password</strong> must be provided";
            return;
        }

        $user = User::getByEmail($_POST["email"]);

        if ($user->verifyPassword($_POST["password"])) {

            if ($user->enabled) {
                arcSetUser($user);

                echo "success|Login successful";
                return;
            } else {
                echo "danger|Account disabled";
                return;
            }
        }

        echo "danger|Invalid username and/or password";
    } elseif ($_POST["action"] == "forgot") {

        if (empty($_POST["email"])) {
            echo "danger|<strong>Email address</strong> must be provided";
            return;
        }

        $user = User::getByEmail($_POST["email"]);

        if ($user->id == 0) {
            echo "danger|No user found matching that email address";
            return;
        }

        $to[$user->firstname . " " . $user->lastname] = $user->email;

        $message = "Hi " . $user->firstname . ", <br />";
        $message .= "You or someone else has requested a password reset.";
        $message .= " If you have not requested a reset, ignore this email";
        $message .= " else click the link below to reset your password.<br /><br />";

        $message .= "<a href=\"" . arcGetHost() . "login/reset/" . $user->id . "/" . $user->email . "\">Reset Password</a>";

        $mail = arcSendMail($to, "Password Reset Request", $message);

        echo "success|Password reset request sent";
    } elseif ($_POST["action"] == "reset") {

        if (empty($_POST["password"])) {
            echo "danger|<strong>Password</strong> must be provided";
            return;
        }

        if (empty($_POST["retype"])) {
            echo "danger|<strong>Password retype</strong> must be provided";
            return;
        }

        if ($_POST["password"] != $_POST["retype"]) {
            echo "danger|Passwords do not match";
            return;
        }

        $user = new User();
        $user->getByID($_POST["id"]);
        $user->setPassword($_POST["password"]);
        $user->update();

        echo "success|Password reset";
    }
} else {
    switch (arcGetURLData("data2")) {
        case "forgot":
            arcAddView("products");
            break;
        default:
            arcAddView("overview");
            break;
    }
}
