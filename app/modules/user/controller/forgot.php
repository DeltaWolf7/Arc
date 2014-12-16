<?php

if (count($_POST) > 0) {
    if (empty($_POST["email"])) {
        echo json_encode(["status" => "danger", "data" => "Email address must be provided"]);
        return;
    }

    $user = \User::getByEmail($_POST["email"]);

    if ($user->id == 0) {
        echo json_encode(["status" => "danger", "data" => "No user found matching that email address"]);
        return;
    }
       
    $to[$user->firstname . " " . $user->lastname] = $user->email;

    $message = "Hello " . $user->firstname . ", <br /><br />";
    $message .= "You or someone else has requested a password reset.";
    $message .= " If you have not requested a reset you can ignore this email";
    $message .= " or click the link below to reset your password.<br /><br />";

    $message .= "<a href=\"" . system\Helper::arcGetModulePath() . "reset/" . base64_encode($user->id . "|" . $user->email) . "\">Reset Password</a>";
    
    $mail = system\Helper::arcSendMail($to, "Password Reset Request", $message);
    
    if (empty($mail)) {
        echo json_encode(["status" => "success", "data" => "Password reset request sent"]);
    } else {
        echo json_encode(["status" => "danger", "data" => $mail]);
    }
}
