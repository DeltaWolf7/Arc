<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="../js/jquery.min.js"></script>
        <script src="../js/moment.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/status.min.js"></script>
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/font-awesome.min.css" rel="stylesheet">
        <link href="../css/status.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="page-header">
                <h1><i class="fa fa-sign-in"></i> Arc Project Installer</h1>
            </div>
            <div class="panel panel-default">
                <div class="page-header">
                    <h3 class="panel-title">Database Information</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="dbtype">Type</label>
                        <select class="form-control" id="dbtype">
                            <option value="MySQL" selected>MySQL</option>
                            <option value="MariaDB">MariaDB</option>
                            <option value="MSSQL">MSSQL</option>
                            <option value="Sybase">Sybase</option>
                            <option value="PostgreSQL">PostgreSQL</option>
                            <option value="Oracle">Oracle</option>
                            <option value="Sqlite">Sqlite</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dbhost">Host/Path</label>
                        <input type="text" class="form-control" id="dbhost" value="localhost">
                    </div>
                    <div class="form-group">
                        <label for="dbusername">Username</label>
                        <input type="text" class="form-control" id="dbusername">
                    </div>
                    <div class="form-group">
                        <label for="dbpassword">Password</label>
                        <input type="password" class="form-control" id="dbpassword">
                    </div>
                    <div class="form-group">
                        <label for="dbprefix">Prefix</label>
                        <input type="text" class="form-control" id="dbprefix" value="arc_">
                    </div>
                </div>
            </div>
            
            <div class="panel panel-default">
                <div class="page-header">
                    <h3 class="panel-title">Administrator</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="text" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password">
                        </div>
                        <div class="form-group">
                            <label for="password2">Retype</label>
                            <input type="password" class="form-control" id="password2">
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="page-header">
                    <h3 class="panel-title">Project Information</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" value="Arc Project">
                    </div>
                    <div class="form-group">
                        <label for="template">Template</label>
                        <select class="form-control" id="template">
                            <?php
                            $templates = scandir("../app/templates/");
                            foreach ($templates as $template) {
                                if ($template != "." && $template != "..") {
                                    echo "<option value=\"" . $template . "\">" . $template . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="page-header">
                    <h3 class="panel-title">Special Options</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="debug"> Debug Mode
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="forcenossl"> Force SSL Off
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="session">Session Length</label>
                            <input type="text" class="form-control" id="session" value="60">
                        </div>
                        <div class="form-group">
                            <label for="module">Default Module</label>
                            <input type="text" class="form-control" id="module" value="page">
                        </div>
                        <div class="form-group">
                            <label for="action">Action</label>
                            <input type="text" class="form-control" id="action" value="welcome">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-right"><a id="installBtn" class="btn btn-default">Check and Install</a></div>
            
            <div id="status"></div>
        </div>
    </body>
</html>

<script>
    $("#installBtn").click(function () {
        $.ajax({
            url: "do_install.php",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {dbtype: $("#dbtype").val(), dbhost: $("#dbhost").val()},
            complete: function (data) {
               
            }
        });    
    });
</script>