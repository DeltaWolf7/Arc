<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#system" aria-controls="system" role="tab" data-toggle="tab">System</a></li>
    <li role="presentation"><a href="#login" aria-controls="login" role="tab" data-toggle="tab">Login</a></li>
    <li role="presentation"><a href="#smtp" aria-controls="smtp" role="tab" data-toggle="tab">SMTP</a></li>
    <li role="presentation"><a href="#ldap" aria-controls="ldap" role="tab" data-toggle="tab">LDAP</a></li>
    <li role="presentation"><a href="#api" aria-controls="api" role="tab" data-toggle="tab">API</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <!-- System Settings /-->
    <div role="tabpanel" class="tab-pane active" id="system">

        <!-- Log Retention /-->
        <fieldset>
            <legend>Log Retention</legend>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="keepLogsDays">Number of Days</label>
                        <input id="keepLogsDays" type="number" class="form-control" placeholder="30" value="<?php echo $logs->value; ?>">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <i class="fa fa-info-circle"></i> How many days should logs be kept? When a log is older than the specified period it will be purged.
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>

        <!-- Style /-->
        <fieldset>
            <legend>Style</legend>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="siteTitle">Site Title</label>
                        <input id="siteTitle" type="text" class="form-control" placeholder="Arc Project" value="<?php echo $title->value; ?>">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel panel-default">      
                        <div class="panel-body">
                            <i class="fa fa-info-circle"></i> The title used for all site and email branding.
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="theme">Global Site Theme</label>
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
                <div class="col-md-8">
                    <div class="panel panel-default"> 
                        <div class="panel-body">
                            <i class="fa fa-info-circle"></i> The default theme applied to all pages where no override has been specified.
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="siteLogo">Site Logo</label>
                        <div class="input-group">
                            <input id="siteLogo" type="text" class="form-control" placeholder="" value="<?php echo $logo->value; ?>">
                            <i class="input-group-addon"><a class="clickable" id="btnMediaManager"><i class="fa fa-folder-open-o"></i></a></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel panel-default">      
                        <div class="panel-body">
                            <i class="fa fa-info-circle"></i> The logo used for all site and email branding.
                        </div>
                    </div>
                </div>
            </div>
        </fieldset> 

        <!-- Guest Access /-->
        <fieldset>
            <legend>Guest Access</legend>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="defaultPage">Default Landing Page</label>
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
                <div class="col-md-8">
                    <div class="panel panel-default">                
                        <div class="panel-body">
                            <i class="fa fa-info-circle"></i> The default landing page for any visitor to the site.
                        </div>
                    </div>
                </div>
            </div>
        </fieldset> 

        <!-- Upload Limit /-->
        <fieldset>
            <legend>Uploads</legend>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="uploadLimit">Limit in Megabytes (MB) </label>
                        <input id="uploadLimit" type="number" class="form-control" placeholder="2" value="<?php echo $file_size->value; ?>">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel panel-default">  
                        <div class="panel-body">
                            <i class="fa fa-info-circle"></i> The maximum file size allowed for uploads.
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="thumbWidth">Thumbnail Width (Pixels) </label>
                        <input id="thumbWidth" type="number" class="form-control" placeholder="80" value="<?php echo $thumb->value; ?>">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel panel-default">       
                        <div class="panel-body">
                            <i class="fa fa-info-circle"></i> The width applied to thumbnails created by Arc. Height will automatically adjust based on the width to maintain aspect ratio.
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>   

        <!-- Time/Date /-->
        <fieldset>
            <legend>Date/Time</legend>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="dateFormat">Date Format </label>
                        <input id="dateFormat" type="text" class="form-control" placeholder="d-m-Y" value="<?php echo $dateformat->value; ?>">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel panel-default">              
                        <div class="panel-body">
                            <i class="fa fa-info-circle"></i> The formatting of the date based on standard PHP date formatting rules. You can view accepted format on the PHP site <a href="http://php.net/manual/en/function.date.php" target="_new">here</a>.
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="timeFormat">Time Format </label>
                        <input id="timeFormat" type="text" class="form-control" placeholder="H:i:s" value="<?php echo $timeformat->value; ?>">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel panel-default">            
                        <div class="panel-body">
                            <i class="fa fa-info-circle"></i> The formatting of the time based on standard PHP time formatting rules. You can view accepted format on the PHP site <a href="http://php.net/manual/en/function.date.php" target="_new">here</a>.
                        </div>
                    </div>
                </div>
            </div>
        </fieldset> 

        <!-- Media Manager /-->
        <fieldset>
            <legend>Media Manager</legend>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="mediaManagerURL">Media Manager URL </label>
                        <select id="mediaManagerURL" class="form-control">
                            <?php
                            $pages = Page::getAllPages();
                            foreach ($pages as $page) {
                                echo "<option";
                                if ($media->value == $page->seourl) {
                                    echo " selected";
                                }
                                echo ">{$page->seourl}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel panel-default">              
                        <div class="panel-body">
                            <i class="fa fa-info-circle"></i> The page containing the media manager module</a>.
                        </div>
                    </div>
                </div>
            </div>
        </fieldset> 
    </div>

    <!-- Login /-->
    <div role="tabpanel" class="tab-pane" id="login">

        <!-- Log Retention /-->
        <fieldset>
            <legend>Login Actions</legend>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="loginURL">Successful Login Destination</label>
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
                <div class="col-md-8">
                    <div class="panel panel-default">       
                        <div class="panel-body">
                            <i class="fa fa-info-circle"></i> After a successful login the user will be redirected to the specified page. A failed login does not redirect the user.<br />
                            Note, the authenticated user must also have permission to access the destination. If not, the user will receive a 403 error – Permission Denied.
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>

        <!-- Registration /-->
        <fieldset>
            <legend>Registration</legend>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="allowReg">Allow Registration</label>
                        <select id="allowReg" class="form-control">
                            <option value="true"<?php
                            if ($reg->value == "true") {
                                echo " selected";
                            }
                            ?>>Yes</option>
                            <option value="false"<?php
                            if ($reg->value == "false") {
                                echo " selected";
                            }
                            ?>>No</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel panel-default">   
                        <div class="panel-body">
                            <i class="fa fa-info-circle"></i> Are guests allowed to register for an account?
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="company">Show Company Field</label>
                        <select id="company" class="form-control">
                            <option value="true"<?php
                            if ($company->value == "1") {
                                echo " selected";
                            }
                            ?>>Yes</option>
                            <option value="false"<?php
                            if ($company->value == "0") {
                                echo " selected";
                            }
                            ?>>No</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel panel-default">  
                        <div class="panel-body">
                            <i class="fa fa-info-circle"></i> Shows the company field on the registration form and on the user profile page. Allowing users to associate themselves with a company.
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>

    </div>

    <!-- SMTP /-->
    <div role="tabpanel" class="tab-pane" id="smtp">

        <!-- SMTP Key /-->
        <fieldset>
            <legend>SMTP Server</legend>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="useSMTP">Enable SMTP</label>
                        <?php $smtpData = $mail->getArrayFromJson(); ?>
                        <select id="useSMTP" class="form-control" onchange="updateEmail()">
                            <option value="true"<?php
                            if ($smtpData["smtp"] == "true") {
                                echo " selected";
                            }
                            ?>>Yes</option>
                            <option value="false"<?php
                            if ($smtpData["smtp"] == "false") {
                                echo " selected";
                            }
                            ?>>No</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel panel-default">        
                        <div class="panel-body">
                            <i class="fa fa-info-circle"></i> Use SMTP to send email over the built in PHP mailer function?
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="smtpServer">SMTP Server</label>
                        <input id="smtpServer" type="text" class="form-control" placeholder="localhost" value="<?php echo $smtpData["server"]; ?>">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel panel-default">        
                        <div class="panel-body">
                            <i class="fa fa-info-circle"></i> The domain name or IP of the SMTP server.
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="smtpUser">Username</label>
                        <input id="smtpUser" type="text" class="form-control" value="<?php echo $smtpData["username"]; ?>">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel panel-default">        
                        <div class="panel-body">
                            <i class="fa fa-info-circle"></i> If required, the username to authenticate the SMTP session.
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="smtpPass">Password</label>
                        <input id="smtpPass" type="password" class="form-control" value="<?php echo system\Helper::arcDecrypt($smtpData["password"]); ?>">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel panel-default">            
                        <div class="panel-body">
                            <i class="fa fa-info-circle"></i> If required, the password to authenticate the SMTP session.
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="smtpPort">Port</label>
                        <input id="smtpPort" type="number" class="form-control" placeholder="21" value="<?php echo $smtpData["port"]; ?>">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel panel-default">  
                        <div class="panel-body">
                            <i class="fa fa-info-circle"></i> Port of the SMTP server.
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="smtpSender">Sender</label>
                        <input id="smtpSender" type="text" class="form-control" value="<?php echo $smtpData["sender"]; ?>">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel panel-default">              
                        <div class="panel-body">
                            <i class="fa fa-info-circle"></i> The sender of the email's sent by Arc. Can be a email address or name and email address.<br />
                            John Smith &lt;johnsmith@emailserver.com&gt;
                        </div>
                    </div>
                </div>
            </div>
        </fieldset> 

    </div>

    <!-- LDAP /-->
    <div role="tabpanel" class="tab-pane" id="ldap">

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
                    <div class="form-group">
                        <label for="useLDAP">Enable LDAP</label>
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
                            ?>>Yes</option>
                            <option value="false"<?php
                            if ($ldapData["ldap"] == "false") {
                                echo " selected";
                            }
                            ?>>No</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel panel-default">     
                        <div class="panel-body">
                            <i class="fa fa-info-circle"></i> The Lightweight Directory Access Protocol allows 3rd party authentication to be performed by integrating with products supporting LDAP such as Microsoft Active Directory. Arc supports failover in the event LDAP becomes unavailable.
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="ldapServer">Server</label>
                        <input id="ldapServer" type="text" class="form-control" placeholder="localhost" value="<?php echo $ldapData["server"]; ?>">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel panel-default">    
                        <div class="panel-body">
                            <i class="fa fa-info-circle"></i> LDAP servers's Domain Name or IP address.
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="ldapDomain">Domain</label>
                        <input id="ldapDomain" type="text" class="form-control" placeholder="mydomain" value="<?php echo $ldapData["domain"]; ?>">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel panel-default">    
                        <div class="panel-body">
                            <i class="fa fa-info-circle"></i> The domain to authenticate against.
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="ldapBase">Search Base</label>
                        <input id="ldapBase" type="text" class="form-control" placeholder="dc=mydomain,dc=local" value="<?php echo $ldapData["base"]; ?>">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel panel-default">   
                        <div class="panel-body">
                            <i class="fa fa-info-circle"></i> LDAP search parameters (DC, OU, CN). Explanation can be found <a href="https://technet.microsoft.com/en-gb/library/cc978021.aspx" target="_new">here</a>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset> 

    </div>

    <!-- API /-->
    <div role="tabpanel" class="tab-pane" id="api">

        <!-- API Key /-->
        <fieldset>
            <legend>API</legend>

            <div class="panel panel-default">     
                <div class="panel-body">
                    <i class="fa fa-info-circle"></i> Application Programming Interface key required for allowing 3rd party access to the API’s provided by Arc and its modules.<br />
                    RESTful based API URL: http://{yourdomain}/api/v1/{module}/{method}?key={key}
                </div>
            </div>

            <div class="panel panel-default">     
                <div class="panel-body">
                    <div class="table">
                        <table class="table table-striped">
                            <thead>
                                <tr><th>User</th><th>Key</th><th>Actions</th></tr>
                            </thead>
                            <tbody id="apiKeys">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">     
                <div class="panel-body">
                    <label for="apiuser">Add user</label>
                    <div class="row">
                        <div class="col-md-8">
                            <select class="form-control" id="apiuser">
                                <?php
                                $users = User::getAllUsers();
                                foreach ($users as $user) {
                                    $apikey = SystemSetting::getByKey("APIKEY", $user->id);
                                    if ($apikey->id == 0) {
                                        echo "<option value=\"{$user->id}\">{$user->getFullname()} ({$user->email})</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <a class="btn btn-default btn-block" id="createAPI"><i class="fa fa-plus"></i> Create API key</a>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="well">
                Arc Version: <?php echo system\Helper::arcGetVersion(); ?>
            </div>

        </fieldset>        
    </div>
</div>

<div class="text-right">
    <a id="btnSaveSettings" class="btn btn-primary"><i class="fa fa-save"></i> Save</a>
</div>


<div class="modal fade" id="mediaManager" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2 class="modal-title">Media Manager</h4>
            </div>
            <div class="modal-body">
                <iframe style="width: 100%; height: 500px; border: 0;" src="<?php echo system\Helper::arcGetPath() . $media->value; ?>"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="$('#contentViewer').html('');">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->