<?php

/*
 * The MIT License
 *
 * Copyright 2015 clongford.
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
 * Description of SMTP
 *
 * @author clongford
 */
class SMTP {

    function SMTP($SmtpServer, $SmtpPort, $SmtpUser, $SmtpPass, $from, $to, $subject, $body) {

        $this->SmtpServer = $SmtpServer;
        $this->SmtpUser = base64_encode($SmtpUser);
        $this->SmtpPass = base64_encode($SmtpPass);
        $this->from = $from;
        $this->to = $to;
        $this->subject = $subject;
        $this->body = $body;

        if ($SmtpPort == "") {
            $this->PortSMTP = 25;
        } else {
            $this->PortSMTP = $SmtpPort;
        }
    }

    function SendMail() {
        if ($SMTPIN = fsockopen($this->SmtpServer, $this->PortSMTP)) {
            fputs($SMTPIN, "EHLO\r\n");
            $talk["hello"] = fgets($SMTPIN, 1024);
            fputs($SMTPIN, "auth login\r\n");
            $talk["res"] = fgets($SMTPIN, 1024);
            fputs($SMTPIN, $this->SmtpUser . "\r\n");
            $talk["user"] = fgets($SMTPIN, 1024);
            fputs($SMTPIN, $this->SmtpPass . "\r\n");
            $talk["pass"] = fgets($SMTPIN, 256);
            fputs($SMTPIN, "MAIL FROM: <" . $this->from . ">\r\n");
            $talk["From"] = fgets($SMTPIN, 1024);
            fputs($SMTPIN, "RCPT TO: <" . $this->to . ">\r\n");
            $talk["To"] = fgets($SMTPIN, 1024);
            fputs($SMTPIN, "DATA\r\n");
            $talk["data"] = fgets($SMTPIN, 1024);
            fputs($SMTPIN, "To: <" . $this->to . ">\r\nFrom: <" . $this->from . ">\r\nSubject:" . $this->subject . "\r\n\r\n\r\n" . $this->body . "\r\n.\r\n");
            $talk["send"] = fgets($SMTPIN, 256);
            
            // Close connection and exit
            fputs($SMTPIN, "QUIT\r\n");
            fclose($SMTPIN);
        }
        return $talk;
    }

}
