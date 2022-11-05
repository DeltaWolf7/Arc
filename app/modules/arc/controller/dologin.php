<?php

if (system\Helper::arcIsAjaxRequest()) {
    if (empty($_POST["email"])) {
        system\Helper::arcAddMessage("danger", "Email address must be provided");
        system\Helper::arcReturnJSON([], 401.1);
        return;
    }

    if (empty($_POST["password"])) {
        system\Helper::arcAddMessage("danger", "Password must be provided");
        system\Helper::arcReturnJSON([], 401.1);
        return;
    }

    Log::createLog("info", "user", "Agent: " . $_SERVER['HTTP_USER_AGENT'] . ", IP: " . $_SERVER['REMOTE_ADDR']);
    
    // start ldap
    $ldapEnabled = SystemSetting::getByKey("ARC_LDAP_ENABLED");
    $ldapServer = SystemSetting::getByKey("ARC_LDAP_SERVER");
    $ldapDomain = SystemSetting::getByKey("ARC_LDAP_DOMAIN");
    $ldapBase = SystemSetting::getByKey("ARC_LDAP_BASE");

    if ($ldapEnabled->value == "1") {
        Log::createLog("warning", "ldap", "LDAP lookup: " . $_POST["email"]);
        $result = LDAPLogin($_POST["email"], $_POST["password"], $ldapServer->value, $ldapDomain->value, $ldapBase->value);
        $user = \User::getByEmail($result["email"]);

        if (is_array($result)) {
            if ($user->id != 0) {
                Log::createLog("success", "ldap", "User logged in: {$_POST["email"]}");
                $user->setPassword($_POST["password"]);
                $user->update();
                
                $ad = SystemSetting::getByKey("ARC_USER_AD", $user->id);
                if ($ad->id == 0) {
                    $ad->key = "ARC_USER_AD";
                    $ad->value = true;
                    $ad->userid = $user->id;
                    $ad->update();
                }
                
                doLogin($user);
                return;
            } else {
                $user->firstname = $result["firstname"];
                $user->lastname = $result["lastname"];
                $user->email = $result["email"];
                $user->setPassword($_POST["password"]);
                $user->update();
                Log::createLog("warning", "ldap", "LDAP user created: " . $_POST["email"]);
                
                $ad = new SystemSetting();
                $ad->key = "ARC_USER_AD";
                $ad->value = true;
                $ad->userid = $user->id;
                $ad->update();
                
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
            system\Helper::arcAddMessage("info", "Account disabled, if you have just registered please wait for the account to be enabled.");
            Log::createLog("danger", "user", "Attempt to access disabled account: " . $_POST["email"]);
            system\Helper::arcReturnJSON([], 401);
            return;
        }
    }

    system\Helper::arcAddMessage("danger", "Invalid username and/or password");
    Log::createLog("warning", "user", "Incorrect password: " . $_POST["email"]);
    system\Helper::arcReturnJSON([], 401.1);
}

function doLogin($user)
{
    system\Helper::arcSetUser($user);

    $lastSeen = SystemSetting::getByKey("ARC_USER_LASTSEEN", $user->id);
    if ($lastSeen->id == 0) {
        $lastSeen->userid = $user->id;
        $lastSeen->key = "ARC_USER_LASTSEEN";
    }
    $lastSeen->value = date("d-m-Y H:i:s");
    $lastSeen->update();

    Log::createLog("success", "user", "User logged in: " . $user->email);
    system\Helper::arcCheckSettingExists("ARC_LOGIN_URL", "/");

    $url = SystemSetting::getByKey("ARC_LOGIN_URL");

    system\Helper::arcAddMessage("success", "Login successful.");

    if (isset($_POST["redirect"]) && $_POST["redirect"] != "") {
        system\Helper::arcReturnJSON(["redirect" => $_POST["redirect"]]);
    } elseif (empty($url->value)) {
        system\Helper::arcReturnJSON(["redirect" => "/"]);
    } else {
        system\Helper::arcReturnJSON(["redirect" => $url->value]);
    }
}

function LDAPLogin($username, $password, $server = "mydomain.local", $domain = "mydomain", $dc = "dc=mydomain,dc=local")
{
    // https://www.exchangecore.com/blog/how-use-ldap-active-directory-authentication-php/   
    $ldap = ldap_connect("ldap://{$server}");
    $ldaprdn = "{$domain}\\{$username}";
    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
    $bind = @ldap_bind($ldap, $ldaprdn, $password);
    if ($bind) {
        
        $filter = "(sAMAccountName=$username)";
        $result = ldap_search($ldap, $dc, $filter);
        if ($result) {

            $info = ldap_get_entries($ldap, $result);
            if (!isset($info[0]["mail"][0])) {
                // user has no email address
                Log::createLog("danger", "ldap", "Unable to login user that has no email address");
                return null;
            }

            $data = array();
            $data["email"] = $info[0]["mail"][0];
            $data["lastname"] = $info[0]["sn"][0];
            $data["firstname"] = $info[0]["givenname"][0];
            @ldap_close($ldap);
            return $data;
        }
    }

    // something has gone wrong
    Log::createLog("danger", "ldap", "Error: " . ldap_error($ldap));
    return null;
}
