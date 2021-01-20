<?php

namespace system;

/* 
 * The MIT License
 *
 * Copyright 2021 Craig Longford (deltawolf7@gmail.com).
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the 'Software'), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED 'AS IS', WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

include_once 'vendor/medoo/Medoo.php';

class Initialiser {

    public static function Init() {
        // Check the assets directory exists and create it if not.
        if (!file_exists(Helper::arcGetPath(true) . 'assets')) {
            \Log::createLog('warning', 'Arc', 'Assets directory not found. Arc will try to create it.');
            try {
                mkdir(Helper::arcGetPath(true) . 'assets');
                \Log::createLog('success', 'Arc', 'Assets directory created.');
            } catch (Exception $e) {
                \Log::createLog('error', 'Arc', 'Unable to create assets directory. Error: ' . $e->getMessage());
            }
        }
    }
}
