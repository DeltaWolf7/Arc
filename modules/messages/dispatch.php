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
require_once '../../bootstrap.php';

if ($_POST['action'] == 'send') {

    $from = new User();
    $from->getByID($_POST['userid']);

    if ($_POST['replyid'] != '0') {
        $m = new Message();
        $m->getByID($_POST['replyid']);
        $m->replied = 1;
        $m->update();
    }

    $message = new Message();
    $message->fromid = $from->id;
    $message->fromuser = $from->firstname . ' ' . $from->lastname;
    $message->content = $_POST['message'];
    $message->subject = $_POST['subject'];
    $message->userid = $_POST['touser'];
    $message->folder = 'Inbox';

    $messageX = new Message();
    $messageX->fromid = $from->id;
    $messageX->fromuser = $from->firstname . ' ' . $from->lastname;
    $messageX->content = $_POST['message'];
    $messageX->subject = $_POST['subject'];
    $messageX->userid = $from->id;
    $messageX->read = true;
    $messageX->folder = 'Sent';

    $message->update();
    $messageX->update();

    echo 'success|Message sent';
}
