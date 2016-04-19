<?php
$logs = SystemSetting::getByKey("ARC_KEEP_LOGS");
$file_size = SystemSetting::getByKey("ARC_FILE_UPLOAD_SIZE_BYTES");
$theme_setting = SystemSetting::getByKey("ARC_THEME");
$thumb = SystemSetting::getByKey("ARC_THUMB_WIDTH");
$login_url = SystemSetting::getByKey("ARC_LOGIN_URL");
$default_page = SystemSetting::getByKey("ARC_DEFAULT_PAGE");
$mail = SystemSetting::getByKey("ARC_MAIL");
$ldap = SystemSetting::getByKey("ARC_LDAP");
$apikey = \SystemSetting::getByKey("ARC_APIKEY");
$reg = \SystemSetting::getByKey("ARC_ALLOWREG");
?>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Keep Logs for</span>
                <input id="keepLogsDays" type="number" class="form-control" placeholder="30" value="<?php echo $logs->value; ?>">
                <span class="input-group-addon">days</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">File upload size limit</span>
                <input id="uploadLimit" type="number" class="form-control" placeholder="2000000" value="<?php echo $file_size->value; ?>">
                <span class="input-group-addon">bytes</span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Theme</span>
                <select id="theme" class="form-control">
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
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Thumb width</span>
                <input id="thumbWidth" type="number" class="form-control" placeholder="80" value="<?php echo $thumb->value; ?>">
                <span class="input-group-addon">px</span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">URL after login</span>
                <select id="loginURL" class="form-control">
                    <?php
                    $pages = Page::getAllPages();
                    foreach ($pages as $page) {
                        echo "<option";
                        if ($login_url->value == $page->seourl) {
                            echo " selected";
                        }
                        echo ">{$page->seourl}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Default page</span>
                <select id="defaultPage" class="form-control">
                    <?php
                    $pages = Page::getAllPages();
                    foreach ($pages as $page) {
                        echo "<option";
                        if ($default_page->value == $page->seourl) {
                            echo " selected";
                        }
                        echo ">{$page->seourl}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Allow Registration</span>
                <select id="allowReg" class="form-control">
                    <option value="true"<?php
                    if ($reg->value == "true") {
                        echo " selected";
                    }
                    ?>>True</option>
                    <option value="false"<?php
                    if ($reg->value  == "false") {
                        echo " selected";
                    }
                    ?>>False</option>
                </select>
            </div>
        </div>
    </div>
</div>
<hr />
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Use SMTP</span>
                <?php $smtpData = $mail->getArrayFromJson(); ?>
                <select id="useSMTP" class="form-control" onchange="updateEmail()">
                    <option value="true"<?php
                    if ($smtpData["smtp"] == "true") {
                        echo " selected";
                    }
                    ?>>True</option>
                    <option value="false"<?php
                    if ($smtpData["smtp"] == "false") {
                        echo " selected";
                    }
                    ?>>False</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Mail server</span>
                <input id="smtpServer" type="text" class="form-control" placeholder="localhost" value="<?php echo $smtpData["server"]; ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Username</span>
                <input id="smtpUser" type="text" class="form-control" value="<?php echo $smtpData["username"]; ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Password</span>
                <input id="smtpPass" type="password" class="form-control" value="<?php echo $smtpData["password"]; ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Port</span>
                <input id="smtpPort" type="number" class="form-control" placeholder="21" value="<?php echo $smtpData["port"]; ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Sender</span>
                <input id="smtpSender" type="email" class="form-control" value="<?php echo $smtpData["sender"]; ?>">
            </div>
        </div>
    </div>
</div>
<hr />

<?php
if (!function_exists("ldap_connect")) {
    ?>
    <div class="alert alert-warning">PHP LDAP module not loaded. LDAP will not function.</div>
    <?php
}
?>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Use LDAP</span>
                <?php $ldapData = $ldap->getArrayFromJson(); ?>
                <select id="useLDAP" class="form-control" onchange="updateLDAP()" <?php
                if (!function_exists("ldap_connect")) {
                    echo "disabled";
                }
                ?>>
                    <option value="true"<?php
                    if ($ldapData["ldap"] == "true") {
                        echo " selected";
                    }
                    ?>>True</option>
                    <option value="false"<?php
                    if ($ldapData["ldap"] == "false") {
                        echo " selected";
                    }
                    ?>>False</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">LDAP Server</span>
                <input id="ldapServer" type="text" class="form-control" placeholder="localhost" value="<?php echo $ldapData["server"]; ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Domain</span>
                <input id="ldapDomain" type="text" class="form-control" placeholder="mydomain" value="<?php echo $ldapData["domain"]; ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Base</span>
                <input id="ldapBase" type="text" class="form-control" placeholder="dc=mydomain,dc=local" value="<?php echo $ldapData["base"]; ?>">
            </div>
        </div>
    </div>
</div>

<hr />

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">API Key</span>
                <input id="apiKey" type="text" class="form-control" value="<?php echo $apikey->value ?>" disabled>
            </div>
        </div>
    </div>
</div>

<div class="text-right">
    <a class="btn btn-primary" onclick="saveSystem()"><i class="fa fa-save"></i> Save</a>
</div>