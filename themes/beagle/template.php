<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        {{arc:header}}
    </head>
    <body>
        <div class="be-wrapper be-nosidebar-left">
            <nav class="navbar navbar-default navbar-fixed-top be-top-header">
                <div class="container-fluid">
                    <div class="navbar-header"><a href="{{arc:path}}" class="navbar-brand"><img style="height: 55px; padding-top: 5px;" src="{{arc:sitelogo}}" /></a></div>
                    <a href="#" data-toggle="collapse" data-target="#be-navbar-collapse" class="be-toggle-top-header-menu collapsed"><i class="fa fa-bars"></i> Navigation</a>
                    <div id="be-navbar-collapse" class="navbar-collapse collapse">
                        {{arc:menu}}
                    </div>
                </div>
            </nav>
            <div class="be-content">
                <div class="page-head">
                    <h2 class="page-head-title">{{arc:title}}</h2>
                    {{module:beagle:breadcrumb}}
                </div>
                <div class="main-content">
                    {{arc:content}}
                </div>
            </div>
        </div>
        {{arc:footer}}
    </body>
</html>