<?php
    $haveThemeSettings = false;
    if (file_exists(system\Helper::arcGetThemePath(true) . "settings.php")) {
        $haveThemeSettings = true;
    }
?>

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-start">
            <div class="nav flex-column nav-pills me-4" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <button class="nav-link active" id="v-pills-system-tab" data-bs-toggle="pill"
                    data-bs-target="#v-pills-system" type="button" role="tab" aria-controls="v-pills-system"
                    aria-selected="true">System</button>
                <button class="nav-link" id="v-pills-login-tab" data-bs-toggle="pill" data-bs-target="#v-pills-login"
                    type="button" role="tab" aria-controls="v-pills-login" aria-selected="false">Login</button>
                <button class="nav-link" id="v-pills-smtp-tab" data-bs-toggle="pill" data-bs-target="#v-pills-smtp"
                    type="button" role="tab" aria-controls="v-pills-smtp" aria-selected="false">SMTP</button>
                <button class="nav-link" id="v-pills-ldap-tab" data-bs-toggle="pill" data-bs-target="#v-pills-ldap"
                    type="button" role="tab" aria-controls="v-pills-ldap" aria-selected="false">LDAP</button>
                <?php
                    if ($haveThemeSettings === true) {
                        ?>
                <button class="nav-link" id="v-pills-theme-tab" data-bs-toggle="pill" data-bs-target="#v-pills-theme"
                    type="button" role="tab" aria-controls="v-pills-theme" aria-selected="false">Theme</button>
                <?php
                    }
                ?>
            </div>
            <div class="border p-4 rounded">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-system" role="tabpanel"
                        aria-labelledby="v-pills-system-tab">
                        <!-- Log Retention /-->
                        <fieldset>
                            <legend>Log Retention</legend>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="keepLogsDays" class="form-label">Number of Days</label>
                                    <input id="keepLogsDays" type="number" class="form-control" placeholder="30"
                                        value="<?php echo $logs->value; ?>">
                                </div>
                                <div class="col-md-8 pt-3">
                                    How many days should logs be kept? When a log is
                                    older
                                    than the specified period it will be purged.
                                </div>
                            </div>
                        </fieldset>

                        <!-- Style /-->
                        <fieldset class="mt-3">
                            <legend>Style</legend>

                            <div class="row">
                                <div class="col-md-4">
                                    <label for="siteTitle" class="form-label">Site Title</label>
                                    <input id="siteTitle" type="text" class="form-control" placeholder="Arc Project"
                                        value="<?php echo $title->value; ?>">
                                </div>
                                <div class="col-md-8 pt-3">

                                    The title used for all site and email branding.

                                </div>

                                <div class="col-md-4">
                                    <label for="theme" class="form-label">Global Site Theme</label>
                                    <select id="theme" class="form-select">
                                        <?php
                                    $themes = scandir(system\Helper::arcGetPath(true) . "themes/");
                                    foreach ($themes as $theme) {
                                        if ($theme != "." && $theme != "..") {
                                            echo "<option";
                                            if ($theme_setting->value == $theme) {
                                                echo " selected";
                                            }
                                            echo ">{$theme}</option>";
                                        }
                                    }
                                    ?>
                                    </select>
                                </div>
                                <div class="col-md-8 pt-3">

                                    The default theme applied to all pages where no
                                    override
                                    has been specified.

                                </div>

                                <div class="col-md-4">

                                    <label for="siteLogo" class="form-label">Site Logo</label>
                                    <div class="input-group">
                                        <input id="siteLogo" type="text" class="form-control" placeholder=""
                                            aria-label="Site Logo" aria-describedby="basic-addon2"
                                            value="<?php echo $logo->value; ?>">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" id="btnMediaManager"><i class="fa-solid fa-folder-open"></i></button>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-8 pt-3">

                                    The logo used for all site and email branding.

                                </div>
                            </div>
                        </fieldset>

                        <!-- Upload Limit /-->
                        <fieldset class="mt-3">
                            <legend>Uploads</legend>
                            <div class="row">
                                <div class="col-md-4">

                                    <label for="uploadLimit" class="form-label">Limit in Megabytes (MB) </label>
                                    <input id="uploadLimit" type="number" class="form-control" placeholder="2"
                                        value="<?php echo $file_size->value; ?>">

                                </div>
                                <div class="col-md-8 pt-3">

                                    The maximum file size allowed for uploads.

                                </div>
                            </div>
                        </fieldset>

                        <!-- Time/Date /-->
                        <fieldset class="mt-3">
                            <legend>Date/Time</legend>
                            <div class="row">
                                <div class="col-md-4">

                                    <label for="dateFormat" class="form-label">Date Format </label>
                                    <input id="dateFormat" type="text" class="form-control" placeholder="d-m-Y"
                                        value="<?php echo $dateformat->value; ?>">

                                </div>
                                <div class="col-md-8 pt-3">

                                    The formatting of the date based on standard PHP
                                    date
                                    formatting rules. You can view accepted format on the PHP site <a
                                        href="http://php.net/manual/en/function.date.php" target="_new">here</a>.

                                </div>

                                <div class="col-md-4">

                                    <label for="timeFormat" class="form-label">Time Format </label>
                                    <input id="timeFormat" type="text" class="form-control" placeholder="H:i:s"
                                        value="<?php echo $timeformat->value; ?>">

                                </div>
                                <div class="col-md-8 pt-3">

                                    The formatting of the time based on standard PHP
                                    time
                                    formatting rules. You can view accepted format on the PHP site <a
                                        href="http://php.net/manual/en/function.date.php" target="_new">here</a>.

                                </div>
                            </div>
                        </fieldset>

                        <!-- Media Manager /-->
                        <fieldset class="mt-3">
                            <legend>Media Manager</legend>
                            <div class="row">
                                <div class="col-md-4">

                                    <label for="mediaManagerURL" class="form-label">Media Manager URL </label>
                                    <select id="mediaManagerURL" class="form-select">
                                        <?php
                                        $routes = Router::getCurrentRoutes();
                                    foreach ($routes as $route) {
                                        echo "<option";
                                        if ($media->value == $route->route) {
                                            echo " selected";
                                        }
                                        echo ">{$route->route}</option>";
                                    }
                                    ?>
                                    </select>

                                </div>
                                <div class="col-md-8 pt-3">

                                    The page containing the media manager module</a>.

                                </div>
                            </div>
                        </fieldset>

                        <!-- Google AdSense /-->
                        <fieldset class="mt-3">
                            <legend>Google</legend>
                            <div class="row">
                                <div class="col-md-4">

                                    <label for="gAdsense" class="form-label">Adsense ID </label>
                                    <input id="gAdsense" type="text" class="form-control"
                                        value="<?php echo $gAdsense->value; ?>">

                                </div>
                                <div class="col-md-8 pt-3">
                                    Google Adsense publisher ID.</a>.
                                </div>

                                <div class="col-md-4">

                                    <label for="gAnal" class="form-label">Analytics ID </label>
                                    <input id="gAnal" type="text" class="form-control"
                                        value="<?php echo $gAnal->value; ?>">

                                </div>
                                <div class="col-md-8 pt-3">
                                    Google Analytics client ID.</a>.
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="tab-pane fade" id="v-pills-login" role="tabpanel" aria-labelledby="v-pills-login-tab">
                        <!-- Login Actions /-->
                        <fieldset>
                            <legend>Login Actions</legend>
                            <div class="row">
                                <div class="col-md-4">

                                    <label for="loginURL" class="form-label">Successful Login Destination</label>
                                    <select id="loginURL" class="form-select">
                                        <?php
                                        $routes = Router::getCurrentRoutes();
                                        foreach ($routes as $route) {
                                            echo "<option";
                                            if ($login_url->value == $route->route) {
                                                echo " selected";
                                            }
                                            echo ">{$route->route}</option>";
                                        }
                                    ?>
                                    </select>

                                </div>
                                <div class="col-md-8 pt-3">

                                    After a successful login the user will be
                                    redirected
                                    to
                                    the specified page. A failed login does not redirect the user.<br />
                                    Note, the authenticated user must also have permission to access the destination. If
                                    not,
                                    the user will receive a 403 error – Permission Denied.

                                </div>
                            </div>
                        </fieldset>

                        <!-- Registration /-->
                        <fieldset class="mt-3">
                            <legend>Registration</legend>
                            <div class="row">
                                <div class="col-md-4">

                                    <label for="allowReg" class="form-label">Allow Registration</label>
                                    <select id="allowReg" class="form-select">
                                        <option value="true" <?php
                                    if ($reg->value == "true") {
                                        echo " selected";
                                    }
                                    ?>>Yes</option>
                                        <option value="false" <?php
                                    if ($reg->value == "false") {
                                        echo " selected";
                                    }
                                    ?>>No</option>
                                    </select>

                                </div>
                                <div class="col-md-8 pt-3">

                                    Are guests allowed to register for an account?

                                </div>
                            </div>

                        </fieldset>

                    </div>
                    <div class="tab-pane fade" id="v-pills-smtp" role="tabpanel" aria-labelledby="v-pills-smtp-tab">
                        <form>
                            <!-- SMTP Key /-->
                            <fieldset>
                                <legend>SMTP Server</legend>
                                <div class="row">
                                    <div class="col-md-4">

                                        <label for="useSMTP" class="form-label">Enable SMTP</label>
                                        <select id="useSMTP" class="form-select" onchange="updateEmail()">
                                            <option value="1" <?php
                                    if ($smtpEnabled->value == "1") {
                                        echo " selected";
                                    }
                                    ?>>Yes</option>
                                            <option value="0" <?php
                                    if ($smtpEnabled->value == "0") {
                                        echo " selected";
                                    }
                                    ?>>No</option>
                                        </select>
                                    </div>

                                    <div class="col-md-8 pt-3">

                                        Use SMTP to send email over the built in PHP
                                        mailer
                                        function?

                                    </div>

                                    <div class="col-md-4">

                                        <label for="smtpServer" class="form-label">SMTP Server</label>
                                        <input id="smtpServer" type="text" class="form-control" placeholder="localhost"
                                            value="<?php echo $smtpServer->value; ?>">

                                    </div>
                                    <div class="col-md-8 pt-3">

                                        The domain name or IP of the SMTP server.

                                    </div>

                                    <div class="col-md-4">

                                        <label for="smtpUser" class="form-label">Username</label>
                                        <input id="smtpUser" type="text" class="form-control"
                                            value="<?php echo $smtpUsername->value; ?>">

                                    </div>
                                    <div class="col-md-8 pt-3">

                                        If required, the username to authenticate the
                                        SMTP
                                        session.

                                    </div>

                                    <div class="col-md-4">

                                        <label for="smtpPass" class="form-label">Password</label>
                                        <input id="smtpPass" type="password" class="form-control" autocomplete="none"
                                            value="<?php echo system\Helper::arcDecrypt($smtpPassword->value); ?>">

                                    </div>
                                    <div class="col-md-8 pt-3">

                                        If required, the password to authenticate the
                                        SMTP
                                        session.

                                    </div>

                                    <div class="col-md-4">

                                        <label for="smtpPort" class="form-label">Port</label>
                                        <input id="smtpPort" type="number" class="form-control" placeholder="21"
                                            value="<?php echo $smtpPort->value; ?>">

                                    </div>
                                    <div class="col-md-8 pt-3">

                                        Port of the SMTP server.

                                    </div>

                                    <div class="col-md-4">

                                        <label for="smtpSender" class="form-label">Sender</label>
                                        <input id="smtpSender" type="text" class="form-control"
                                            value="<?php echo $smtpSender->value; ?>">

                                    </div>
                                    <div class="col-md-8 pt-3">

                                        The sender of the email's sent by Arc. Can be
                                        a
                                        email
                                        address or name and email address.<br />
                                        johnsmith@emailserver.com

                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="v-pills-ldap" role="tabpanel" aria-labelledby="v-pills-ldap-tab">
                        <?php
                if (!function_exists("ldap_connect")) {
                    ?>
                        <div class="alert alert-warning">PHP LDAP module not loaded. LDAP will not function.</div>
                        <?php
                }
                ?>

                        <!-- LDAP Details /-->
                        <fieldset>
                            <legend>LDAP Authentication</legend>
                            <div class="row">
                                <div class="col-md-4">

                                    <label for="useLDAP" class="form-label">Enable LDAP</label>
                                    <select id="useLDAP" class="form-select" onchange="updateLDAP()" <?php
                                if (!function_exists("ldap_connect")) {
                                    echo "disabled";
                                }
                                ?>>
                                        <option value="1" <?php
                                    if ($ldapEnabled->value == "1") {
                                        echo " selected";
                                    }
                                    ?>>Yes</option>
                                        <option value="0" <?php
                                    if ($ldapEnabled->value == "0") {
                                        echo " selected";
                                    }
                                    ?>>No</option>
                                    </select>

                                </div>
                                <div class="col-md-8 pt-3">

                                    The Lightweight Directory Access Protocol allows
                                    3rd
                                    party
                                    authentication to be performed by integrating with products supporting LDAP such as
                                    Microsoft Active Directory. Arc supports failover in the event LDAP becomes
                                    unavailable.

                                </div>

                                <div class="col-md-4">

                                    <label for="ldapServer" class="form-label">Server</label>
                                    <input id="ldapServer" type="text" class="form-control" placeholder="localhost"
                                        value="<?php echo $ldapServer->value; ?>">

                                </div>
                                <div class="col-md-8 pt-3">

                                    LDAP servers's Domain Name or IP address.

                                </div>

                                <div class="col-md-4">

                                    <label for="ldapDomain" class="form-label">Domain</label>
                                    <input id="ldapDomain" type="text" class="form-control" placeholder="mydomain"
                                        value="<?php echo $ldapDomain->value; ?>">

                                </div>
                                <div class="col-md-8 pt-3">

                                    The domain to authenticate against.

                                </div>

                                <div class="col-md-4">

                                    <label for="ldapBase" class="form-label">Search Base</label>
                                    <input id="ldapBase" type="text" class="form-control"
                                        placeholder="dc=mydomain,dc=local" value="<?php echo $ldapBase->value; ?>">

                                </div>
                                <div class="col-md-8 pt-3">

                                    LDAP search parameters (DC, OU, CN). Explanation
                                    can
                                    be
                                    found <a href="https://technet.microsoft.com/en-gb/library/cc978021.aspx"
                                        target="_new">here</a>

                                </div>
                            </div>
                        </fieldset>

                    </div>

                    <?php
                    if ($haveThemeSettings === true) {
                        ?>
                    <div class="tab-pane fade" id="v-pills-theme" role="tabpanel" aria-labelledby="v-pills-theme-tab">
                        <?php include_once(system\Helper::arcGetThemePath(true) . "settings.php"); ?>
                    </div>

                    <?php
                    }
                        ?>
                </div>
            </div>
        </div>

        <div class="text-end mt-3">
            <button id="btnSaveSettings" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
        </div>

        <div class="modal" id="mediaManagerMD" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Media Manager</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <iframe style="width: 100%; height: 500px; border: 0;"
                            src="<?php echo system\Helper::arcGetPath() . $media->value; ?>"></iframe>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            onclick="$('#contentViewer').html('');">Close</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
</div>