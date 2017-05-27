<?php

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


// Include required PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
require_once system\Helper::arcGetPath(true) . "vendor/phpmailer/PHPMailer.php";
require_once system\Helper::arcGetPath(true) . "vendor/phpmailer/SMTP.php";
require_once system\Helper::arcGetPath(true) . "vendor/phpmailer/Exception.php";

/**
 * Mail object
 */
class Mail {

    /**
     * Default constructor
     */
    public function __construct() {
        // Get mail settings
        $mode = \SystemSetting::getByKey("ARC_MAIL_USESMTP");

        // Check which mode we are using (SMTP vs MAIL)
        if ($mode->value== "1") {
            // Set SMTP mode
            $this->mode = "SMTP";
        } else {
            // Set MAIL mode
            $this->mode = "MAIL";
        }
    }

    /**
     * Instantiate Mail object and set the mail delivery method 
     * @param string $mode Values: MAIL or SMTP
     */
    public function Mail($mode = "MAIL") {
        // Select mode
        switch (strtoupper($mode)) {
            case "MAIL":
                // Set MAIL mode
                $this->mode = "MAIL";
                break;
            case "SMTP":
                // Set SMTP mode
                $this->mode = "SMTP";
                break;
        }
    }

    /**
     * Send email to recipient
     * @param array $to Recipient
     * @param string $subject Subject
     * @param string $message Message
     * @param bool $html Is email HTML?
     * @param string $from Sender
     * @param array $cc Carbon Copy
     * @param array $attachments Attachments
     */
    public function Send($to = array(), $subject, $message, $html = true, $from = null, $cc = array(), $attachments = array()) {

        // Check if this is a HTML email
        if ($html == true) {
            // Get current theme settings
            $theme = SystemSetting::getByKey("ARC_THEME");
            // Check if the theme has an email template
            if (file_exists(system\Helper::arcGetPath(true) . "themes/" . $theme->value . "/email.php")) {
                // We have found and email template, so get the content
                $content = file_get_contents(system\Helper::arcGetPath(true) . "themes/" . $theme->value . "/email.php");
                // Parse the template content and add the message
                $message = system\Helper::arcParseEmail($content, $message);
            }
        }

        // Log the email activity
        Log::createLog("info", "arcmail", "Send email request, mode: " . $this->mode);

        
        // Set from details
        if ($from == null) {
            $fromSetting = \SystemSetting::getByKey("ARC_MAIL_SENDER");
            $from = $fromSetting->value;
        }

        // Build recipient list
        if (!is_array($to)) {
            $list = array();
            $list[] = $to;
            $to = $list;
        }

        // Build cc list
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

        // Log the activity
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

                $mail = new PHPMailer;
                $mail->isSMTP();
                $portSetting = \SystemSetting::getByKey("ARC_MAIL_PORT");
                $mail->Port = $portSetting->value;

                $serverSetting = \SystemSetting::getByKey("ARC_MAIL_SERVER");
                $mail->Host = $serverSetting->value;

                $userSetting = \SystemSetting::getByKey("ARC_MAIL_USERNAME");
                $passwordSetting = \SystemSetting::getByKey("ARC_MAIL_PASSWORD");
                if (empty($userSetting->value) && empty($passwordSetting->value)) {
                    $mail->SMTPAuth = false;
                } else {
                    $mail->SMTPAuth = true;
                    $mail->Username = $userSetting->value;

                    $smtp_password = system\Helper::arcDecrypt($passwordSetting->value);

                    $mail->Password = $smtp_password;
                }
                $mail->setFrom($from);
                foreach ($to as $email) {
                    $mail->addAddress($email);
                }
                foreach ($cc as $email) {
                    $mail->addCC($email);
                }
                $mail->isHTML($html);
                $mail->Subject = $subject;
                $mail->Body = $message;
                
                // file attachments
                foreach ($attachments as $attachment) {
                    $mail->addAttachment($attachment);
                }

                if (!$mail->send()) {
                    Log::createLog("danger", "arcmail", "SMTP: " . $mail->ErrorInfo);
                } else {
                    Log::createLog("success", "arcmail", "SMTP: Message sent");
                }
                break;
        }
    }

}
