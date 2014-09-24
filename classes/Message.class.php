<?php

/*
 * The MIT License
 *
 * Copyright 2014 Craig.
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
 * Description of message
 *
 * @author Craig
 */
class Message extends DataProvider {

    public $subject;
    public $content;
    public $date;
    public $userid;
    public $read;
    public $replied;
    public $fromid;
    public $fromuser;
    public $folder;

    public function __construct() {
        parent::__construct();
        $this->subject = "";
        $this->content = "";
        $this->date = date("y-m-d h:i:s");
        $this->userid = 0;
        $this->read = 0;
        $this->replied = 0;
        $this->fromid = 0;
        $this->fromuser = "";
        $this->folder = "Inbox";
        $this->table = ARCDBPREFIX . "messages";
        $this->columns = ["id", "subject", "content", "date", "userid", "read", "replied", "fromid", "fromuser", "folder"];
    }

    public static function getMessagesByFolder($userid, $folder) {
        $message = new Message();
        return $message->getCollection(["AND" => ['"userid' => $userid, "folder" => $folder], "ORDER" => "date DESC"]);
    }

}
