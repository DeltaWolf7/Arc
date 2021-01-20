<?php

if (system\Helper::arcIsAjaxRequest()) {
    $users = User::search($_POST["search"]);
    $userid = $_POST["userid"];

    $html = "<table class=\"table table-striped table-sm\">"
        . "<thead><tr><th scope=\"col\">ID</th scope=\"col\"><th scope=\"col\">Name</th><th scope=\"col\">Email</th><th scope=\"col\">Actions</th></tr></thead>"
        . "<tbody>";
    
    foreach ($users as $user) {
        $html .= "<tr><td>" . $user->id . "</td><td>" . $user->getFullname() . "</td>"
            . "<td>" . $user->email . "</td>"
            . "<td><button class=\"btn btn-default\" onclick=\"saveLink('" . $userid . "', '" . $user->id . "')\"><i class=\"fas fa-plus\"></i></button></td></tr>";
    }

    $html .= "</tbody>"
        . "</table>";

    system\Helper::arcReturnJSON(["html" => $html]);
}
