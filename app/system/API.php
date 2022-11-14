<?php

/*
 * The MIT License
 *
 * Copyright 2022 Craig Longford (deltawolf7@gmail.com).
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

namespace system;

/**
 * Description of API
 *
 * @author Craig Longford (deltawolf7@gmail.com)
 */
class API {

    public static function arcGetAPI($uri) {
        $lastUser = null;
        // Handle API request
        if (!isset($_GET["key"])) {
            Helper::arcReturnJSON(["error" => "API key required to process request"]);
            \Log::createLog("danger", "API", "API key required to process request");
        } else {

            // Get API key
            $key = \APIKey::getByKey($_GET["key"]);
                        
            if (empty($key->id)) {
                // Check if valid
                Helper::arcReturnJSON(["error" => "Invalid API key"]);
                \Log::createLog("danger", "API", "Invalid API key");
            } else {

                // check if secret is correct.
                if (!isset($_GET["secret"]) || !$key->verifySecret($_GET["secret"])) {
                    Helper::arcReturnJSON(["error" => "Invalid API secret"]);
                    \Log::createLog("danger", "API", "Invalid API secret");
                }
                else
                {
                    // key and secret are good, so precess.
                    $split = explode("/", $uri);

                    if (!isset($split[1]) || !file_exists(Helper::arcGetPath(true) . "app/modules/{$split[1]}/api")) {
                        Helper::arcReturnJSON(["error" => "Invalid API request"]);
                        \Log::createLog("danger", "API", "Invalid API request");
                    } elseif (!isset($split[2]) || !file_exists(Helper::arcGetPath(true) . "app/modules/{$split[1]}/api/{$split[2]}.php")) {
                        Helper::arcReturnJSON(["error" => "Invalid API method request"]);
                        \Log::createLog("danger", "API", "Invalid API method request");
                    } else {
                        include Helper::arcGetPath(true) . "app/modules/{$split[1]}/api/{$split[2]}.php";
                        $classname = $split[2] . "Api";
                        $apimethod = new $classname;
                        $apimethod->request = $_SERVER['REQUEST_URI'];
                        switch ($_SERVER['REQUEST_METHOD']) {
                            case "GET":
                                $apimethod->GET();
                                break;
                            case "POST":
                                $apimethod->POST();
                                break;
                            case "DELETE":
                                $apimethod->DELETE();
                                break;
                            case "PUT":
                                $apimethod->PUT();
                                break;
                        }
                        \Log::createLog("success", "API", "OK:: Module: {$split[1]}, Command: {$split[2]}, KeyID: {$key->id}, Method: {$_SERVER['REQUEST_METHOD']}");
                    }
                }
            }
        }
        Helper::arcSetUser($lastUser);
    }

}
