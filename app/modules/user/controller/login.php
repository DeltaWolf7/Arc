<?php

if (system\Helper::arcIsAjaxRequest()) {
    if (empty($_POST["email"])) {
        system\Helper::arcAddMessage("danger", "Email address must be provided");
        return;
    }

    if (empty($_POST["password"])) {
        system\Helper::arcAddMessage("danger", "Password must be provided");
        return;
    }


    // start ldap
    $ldap = SystemSetting::getByKey("ARC_LDAP");
    $ldapData = $ldap->getArrayFromJson();

    if ($ldapData["ldap"] == "true") {
        Log::createLog("warning", "ldap", "LDAP lookup: " . $_POST["email"]);
        $result = LDAPLogin($ldapData["server"], $_POST["email"], $_POST["password"], $ldapData["domain"], $ldapData["base"]);
        $user = \User::getByEmail($result["email"]);

        if (is_array($result)) {
            if ($user->id != 0) {
                Log::createLog("success", "ldap", "User logged in: " . $_POST["email"]);
                $user->setPassword($_POST["password"]);
                $user->update();
                doLogin($user);
                return;
            } else {
                $user->firstname = $result["firstname"];
                $user->lastname = $result["lastname"];
                $user->email = $result["email"];
                $user->setPassword($_POST["password"]);
                $user->update();
                Log::createLog("warning", "ldap", "LDAP user created: " . $_POST["email"]);
                doLogin($user);
                return;
            }
        } else {
            Log::createLog("danger", "ldap", "LDAP lookup failed.");
        }
    }

    // end ldap
    $user = \User::getByEmail($_POST["email"]);

    if ($user->verifyPassword($_POST["password"])) {
        if ($user->enabled) {
            doLogin($user);
            return;
        } else {
            system\Helper::arcAddMessage("danger", "Account disabled");
            Log::createLog("danger", "user", "Attempt to access disabled account: " . $_POST["email"]);
            return;
        }
    }

    system\Helper::arcAddMessage("danger", "Invalid username and/or password");
    Log::createLog("warning", "user", "Incorrect password: " . $_POST["email"]);
} else {
    return system\Helper::arcAddFooter("js", system\Helper::arcGetModulePath("user") . "js/login.js");
}

function doLogin($user) {
    system\Helper::arcSetUser($user);
    Log::createLog("success", "user", "User logged in: " . $user->email);
    system\Helper::arcCheckSettingExists("ARC_LOGIN_URL", "/");

    $url = SystemSetting::getByKey("ARC_LOGIN_URL");
    system\Helper::arcReturnJSON(["redirect" => $url->value]);

    system\Helper::arcAddMessage("success", "Login successful.");
}

function LDAPLogin($server = "mydomain.local", $username, $password, $domain = "mydomain", $dc = "dc=mydomain,dc=local") {
// https://www.exchangecore.com/blog/how-use-ldap-active-directory-authentication-php/
    $ldap = ldap_connect("ldap://{$server}");
    $ldaprdn = "{$domain}\\{$username}";
    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
    $bind = @ldap_bind($ldap, $ldaprdn, $password);
    if ($bind) {
        $filter = "(sAMAccountName=$username)";
        $result = ldap_search($ldap, $dc, $filter);     
        ldap_sort($ldap, $result, "sn");
        $info = ldap_get_entries($ldap, $result);
        
        if (!isset($info[0]["mail"][0])) {
            Log::createLog("danger", "ldap", "Unable to query LDAP, check base settings.");
            return null;
        }

        $data = array();
        $data["email"] = $info[0]["mail"][0];
        $data["lastname"] = $info[0]["sn"][0];
        $data["firstname"] = $info[0]["givenname"][0];
        @ldap_close($ldap);
        return $data;
    } else {
        Log::createLog("danger", "ldap", "Error: " . ldap_error($ldap));
    }
    return null;
}
