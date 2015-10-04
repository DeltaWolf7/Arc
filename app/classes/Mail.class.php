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
 * Description of Mail
 *
 * @author Craig Longford
 */
class Mail {

    public function __construct() {
        $SMTP = SystemSetting::getByKey("ARC_MAIL_SMTP_SERVER");
        $SMTPPort = SystemSetting::getByKey("ARC_MAIL_SMTP_PORT");
        $SMTPU = SystemSetting::getByKey("ARC_MAIL_SMTP_USERNAME");
        $SMTPP = SystemSetting::getByKey("ARC_MAIL_SMTP_PASSWORD");
        $this->server = $SMTP->value;
        $this->port = $SMTPPort->value;
        $this->password = base64_encode($SMTPP->value);
        $this->username = base64_encode($SMTPU->value);
        $useSMTP = \SystemSetting::getByKey("ARC_MAIL_USE_SMTP");

        // Set default mode
        if (boolval($useSMTP->value) == true)
            $this->mode = "SMTP";
        else
            $this->mode = "MAIL";
    }

    public function Mail($mode = "Mail") {
// Set mode
        switch (strtoupper($mode)) {
            case "MAIL":
                $this->mode = "MAIL";
                break;
            case "SMTP":
                $this->mode = "SMTP";
                break;
        }
    }

    /**
     * 
     * @param string $from Sender, left null to use system setting.
     * @param string/array $to To, format as 'Firstname Lastname' <email@address.com> or email address only.
     * @param string/array $cc CC, format as 'Firstname Lastname' <email@address.com> or email address only.
     * @param string $subject String message subject.
     * @param string $message Message body, html or plain text.
     * @param boolean $html True for html body, false for plain.
     * @return boolean True/False depending is the operation was completed.
     */
    public function Send($to = array(), $subject, $message, $html = true, $from = null, $cc = array()) {
        try {
            Log::createLog("info", "arcmail", "Send email request");

            // Set from details
            if ($from == null) {
                $fromSetting = SystemSetting::getByKey("ARC_MAIL_FROM");
                $from = $fromSetting->value;
            }

            // Build to list
            if (!is_array($to)) {
                $list = array();
                $list[] = $to;
                $to = $list;
            }

            // Build to list
            if (!is_array($cc)) {
                $list = array();
                $list[] = $cc;
                $cc = $list;
            }

            // Build Mail Header
            $headers = "MIME-Version: 1.0\r\n";
            if ($html == true) {
                // Html content
                $headers .= "Content-Type: text/html; charset=iso-8859-1\r\n";
            } else {
                // Plain test
                $headers .= "Content-Type: text/plain;\r\n";
            }

            Log::createLog("info", "arcmail", "Mail headers built");

            switch ($this->mode) {
                case "MAIL":
                    // Add from header
                    $headers .= "From: " . $from . "\r\n";

                    // Build recipients list
                    $toList = "";
                    foreach ($to as $recipient) {
                        $toList .= $recipient . ", ";
                    }
                    $toList = substr($toList, 0, -2);
                    Log::createLog("success", "arcmail", "PHP mail created.");

                    // Send mail
                    mail($toList, $subject, $message, $headers);
                    Log::createLog("success", "arcmail", "PHP mail sent.");
                    break;
                case "SMTP":
                    if ($SMTPIN = fsockopen($this->server, $this->port)) {
                        // Output holder
                        $output = "";

                        // Connect to SMTP server
                        fputs($SMTPIN, "EHLO\r\n");
                        $output = fgets($SMTPIN, 1024) . "\r\n";
                        fputs($SMTPIN, "auth login\r\n");
                        $output .= fgets($SMTPIN, 1024) . "\r\n";
                        fputs($SMTPIN, $this->username . "\r\n");
                        $output .= fgets($SMTPIN, 1024) . "\r\n";
                        fputs($SMTPIN, $this->password . "\r\n");
                        $output .= fgets($SMTPIN, 256) . "\r\n";

                        // Mail from
                        fputs($SMTPIN, "MAIL FROM: <" . $from . ">\r\n");
                        $output .= fgets($SMTPIN, 1024) . "\r\n";

                        // Add to recipients
                        foreach ($to as $recipient) {
                            fputs($SMTPIN, "RCPT TO: <" . $recipient . ">\r\n");
                            $output .= fgets($SMTPIN, 1024) . "\r\n";
                        }

                        // Add cc recipients
                        foreach ($cc as $recipient) {
                            fputs($SMTPIN, "RCPT TO: <" . $recipient . ">\r\n");
                            $output .= fgets($SMTPIN, 1024) . "\r\n";
                        }

                        // Signal data
                        fputs($SMTPIN, "DATA\r\n");
                        $output .= fgets($SMTPIN, 1024) . "\r\n";

                        // Build message data
                        $messageData = "";
                        // Add to recipients
                        foreach ($to as $recipient) {
                            $messageData .= "To: <" . $recipient . ">\r\n";
                        }
                        // Add cc recipients
                        foreach ($cc as $recipient) {
                            $messageData .= "Cc: <" . $recipient . ">\r\n";
                        }
                        // Add from
                        $messageData .= "From: <" . $from . ">\r\n";
                        // Add subject
                        $messageData .= "Subject:" . $subject . "\r\n";
                        // Add headers
                        $messageData .= $headers . "\r\n\r\n";
                        // Add body
                        $messageData .= $message . "\r\n.\r\n";
                        // Send data                        
                        fputs($SMTPIN, $messageData);
                        $output .= fgets($SMTPIN, 256) . "\r\n";
                        // Quit
                        fputs($SMTPIN, "QUIT\r\n");
                        fclose($SMTPIN);
                        Log::createLog("warning", "arcmail", $output);
                    }
                    Log::createLog("success", "arcmail", "SMTP connection failed.");
                    break;
            }
        } catch (Exception $ex) {
            Log::createLog("danger", "arcmail", "SMTP: " . $ex->getMessage());
        }
    }

}
