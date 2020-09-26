<?php

if (system\Helper::arcIsAjaxRequest()) {
    $users = User::search($_POST["search"]);

    $html = "<table class=\"table table-striped table-sm\">"
        . "<thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Actions</th></tr></thead>"
        . "<tbody>";
    
    foreach ($users as $user) {
        $html .= "<tr><td>" . $user->id . "</td><td>" . $user->getFullname() . "</td>"
            . "<td>" . $user->email . "</td>"
            . "<td><button class=\"btn btn-default\" onclick=\"addLink(" . $user->id . ")\"><i class=\"fas fa-plus\"></i></button></td></tr>";
    }

    $html .= "</tbody>"
        . "</table>";

    system\Helper::arcReturnJSON(["html" => $html]);
}
