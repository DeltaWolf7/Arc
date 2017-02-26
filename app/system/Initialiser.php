<?php

namespace system;

/* 
 * The MIT License
 *
 * Copyright 2017 Craig Longford (deltawolf7@gmail.com).
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

include_once "vendor/medoo/Medoo.php";

class Initialiser {

    public static function Init() {
        $setup = \SystemSetting::getByKey("ARC_ISINIT");
        if ($setup->value == "1") {
            return;
        }

        // Check the assets directory exists and create it if not.
        if (!file_exists(Helper::arcGetPath(true) . "assets")) {
            \Log::createLog("warning", "Arc", "Assets directory not found. Arc will try to create it.");
            try {
                mkdir(Helper::arcGetPath(true) . "assets");
                \Log::createLog("success", "Arc", "Assets directory created.");
            } catch (Exception $ex) {
                \Log::createLog("error", "Arc", "Unable to create assets directory. Error: " . $e->getMessage());
            }
        }

        \Log::createLog("warning", "Arc", "Initilised default Arc settings");
        // Default system settings
        Helper::arcCheckSettingExists("ARC_ISINIT", "1");
        Helper::arcCheckSettingExists("ARC_KEEP_LOGS", "31");
        Helper::arcCheckSettingExists("ARC_MAIL", "{\"smtp\":\"false\", \"server\":\"localhost\""
                . ", \"username\":\"\", \"password\":\"\", \"port\":\"25\", \"sender\":\"Admin <admin@server.local>\"}");
        Helper::arcCheckSettingExists("ARC_LOGIN_URL", "welcome");
        Helper::arcCheckSettingExists("ARC_FILE_UPLOAD_SIZE_BYTES", "2000000");
        Helper::arcCheckSettingExists("ARC_THUMB_WIDTH", "80");
        Helper::arcCheckSettingExists("ARC_THEME", "default");
        Helper::arcCheckSettingExists("ARC_DEFAULT_PAGE", "welcome");
        Helper::arcCheckSettingExists("ARC_LDAP", "{\"ldap\":\"false\", \"server\":\"localhost\","
                . " \"domain\":\"mydomain\", \"base\":\"dc=mydomain,dc=local\"}");
        Helper::arcCheckSettingExists("ARC_PASSWORD_RESET_MESSAGE", htmlentities("You or someone else has requested a password reset.<br />"
                        . "Your new password is '{password}'."));
        Helper::arcCheckSettingExists("ARC_ALLOWREG", "true");
        Helper::arcCheckSettingExists("ARC_LOGO_PATH", "assets/logo-200x48-dark.png");
        Helper::arcCheckSettingExists("ARC_DATEFORMAT", "d-m-Y");
        Helper::arcCheckSettingExists("ARC_TIMEFORMAT", "H:i:s");
        Helper::arcCheckSettingExists("ARC_REQUIRECOMPANY", false);
        Helper::arcCheckSettingExists("ARC_SITETITLE", "Arc Project");
        Helper::arcCheckSettingExists("ARC_MEDIAMANAGERURL", "administration/media-manager");
    }
}
