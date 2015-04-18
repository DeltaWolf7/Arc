<?php

/*
 * The MIT License
 *
 * Copyright 2015 craig.
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

class Result extends DataProvider {

    public $groupid;
    public $questionid;
    public $resultno;
    public $userid;
    public $timetaken;
    public $questionno;
    public $pack;

    public function __construct() {
        parent::__construct();
        $this->groupid = 0;
        $this->resultno = 0;
        $this->userid = 0;
        $this->questionid = 0;
        $this->timetaken = 0;
        $this->pack = "0000-00-00";
        $this->table = ARCDBPREFIX . "askquestion_results";
        $this->columns = ["id", "groupid", "questionid", "resultno", "userid", "timetaken", "questionno", "pack"];
    }

    public static function getByGroupAndUserID($groupid, $userid, $pack) {
        $results = new Result();
        return $results->getCollection(["AND" => ["groupid" => $groupid, "userid" => $userid, "pack" => $pack]]);
    }

    public static function getByGroupAndUserIDAndQuestionID($groupid, $userid, $questionid, $pack) {
        $results = new Result();
        return $results->getCollection(["AND" => ["groupid" => $groupid, "userid" => $userid, "questionid" => $questionid, "pack" => $pack]]);
    }

    public static function getByGroup($groupid, $pack) {
        $results = new Result();
        return $results->getCollection(["AND" => ["groupid" => $groupid, "pack" => $pack]]);
    }

    public static function getArchive($groupid) {
        $results = new Result();
        $packs = $results->getCollection(["groupid" => $groupid]);
        $newResults = Array();
        foreach ($packs as $result) {
            if (in_array($result->pack, $newResults) == false) {
                $newResults[] = $result->pack;
            }
        }
        return $newResults;
    }
}
