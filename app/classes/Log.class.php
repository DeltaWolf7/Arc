<?php

/*
 * The MIT License
 *
 * Copyright 2015 Craig Longford.
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
 * Description of system setting
 *
 * @author Craig Longford
 */
class Log extends DataProvider {

    public $message;
    public $when;
    public $type;
    public $module;

    public function __construct() {
        parent::__construct();
        $this->when = date("y-m-d H:i:s");
        $this->message = "";
        $this->table = ARCDBPREFIX . "logs";
        $this->columns = ["id", "type", "module", "when", "message"];
    }

    public static function getLogs() {
        $logs = new Log();
        return $logs->getCollection(["ORDER" => "when DESC"]);
    }

    public static function createLog($type, $module, $message) {
        $log = new Log();
        $log->type = $type;
        $log->module = $module;
        $log->message = $message;
        $log->update();
        
        // get days
        $days = SystemSetting::getByKey("ARC_KEEP_LOGS");    
        system\Helper::arcGetDatabase()->query("delete from arc_logs where datediff(now(), arc_logs.when) > " . $days->value);
    }

}
