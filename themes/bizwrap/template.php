<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        {{arc:header}}
    </head>
    <body class="admin">
        <div id="over">
            <div id="out_container">
                <!-- #wrap -->
                <div id="wrap">
                    <!-- #top -->
                    <div id="top">
                        <!-- .navbar -->
                        <div class="navbar navbar-inverse navbar-static-top">
                            <div class="navbar-inner">
                                <div class="container-fluid">
                                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </a>
                                    <a class="brand" href="{{arc:path}}"><img src="{{arc:sitelogo}}" alt=""></a> <!-- .topnav -->
                                    <div class="btn-toolbar topnav">
                                        <div class="btn-group">
                                            <a id="changeSidebarPos" class="btn btn-default" rel="tooltip"
                                               data-original-title="Show / Hide Sidebar" data-placement="bottom">
                                                <i class="fa fa-arrows-alt"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- /.topnav -->
                                </div>
                            </div>
                        </div>
                        <!-- /.navbar -->
                    </div>
                    <!-- /#top -->
                    <!-- .head -->
                    <header class="head">
                        <div class="search-bar">
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="search-bar-inner">
                                <a id="menu-toggle" href="#menu" data-toggle="collapse"
                                   class="accordion-toggle btn btn-inverse visible-phone"
                                   rel="tooltip" data-placement="bottom" data-original-title="Show/Hide Menu">
                                    <i class="icon-sort"></i>
                                </a>

                            </div>

                        </div>
                    </div>
                </div>
                        <!-- ."main-bar -->
                        <div class="main-bar">
                            <div class="container-fluid">
                                <div class="row-fluid">
                                    <div class="span12">
                                        <h3>{{arc:pageicon}} {{arc:title}}</h3>
                                    </div>
                                </div>
                                <!-- /.row-fluid -->
                            </div>
                            <!-- /.container-fluid -->
                        </div>
                        <!-- /.main-bar -->
                    </header>
                    <!-- /.head -->

                    <!-- #left -->
                    <div id="left">
                        <!-- .user-media -->
                        
                        <!-- /.user-media -->
                        <!-- #menu -->
                        {{arc:menu}}
                        <!-- /#menu -->

                    </div>
                    <!-- /#left -->

                    <!-- #content -->
                    <div id="content" class="">
                        <!-- .outer -->
                        <div class="container-fluid outer">
                            <div class="row-fluid">
                                <!-- .inner -->
                                <div class="span12 inner">
                                    {{arc:impersonate}}
                                    <!-- content is here -->
                                    {{arc:content}}
                                </div>
                                <!-- /.inner -->
                            </div>
                            <!-- /.row-fluid -->
                        </div>
                        <!-- /.outer -->
                    </div>
                    <!-- /#content -->
                    <!-- #push do not remove -->
                    <div id="push"></div>
                    <!-- /#push -->
                </div>
                <!-- /#wrap -->

                <div class="clearfix"></div>
                <div id="footer">
                    <p>{{arc:version}}</p>
                </div>

                {{arc:footer}}
            </div>
        </div>
    </body>
</html>