<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{arc:header}}
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden sidebar-hidden">
    <header class="app-header navbar">
        <button class="navbar-toggler mobile-sidebar-toggler hidden-lg-up" type="button">☰</button>
        <a class="navbar-brand" href="{{arc:path}}"><img style="max-height: 40px;" src="{{arc:sitelogo}}" /></a>
        <ul class="nav navbar-nav hidden-md-down">
            <li class="nav-item">
                <a class="nav-link navbar-toggler sidebar-toggler" href="#">☰</a>
            </li>
            {{module:arc:breadcrumb}}
        </ul>
    </header>

    <div class="app-body">
        <div class="sidebar">
            <nav class="sidebar-nav">
                    <div class="form-group p-h mb-0 text-center">
                            <h5>Navigation</h5>
                    </div>
                {{arc:menu}}
            </nav>
        </div>

        <!-- Main content -->
        <main class="main">
            <div class="container-fluid pt-2">

                <div class="page-head">
                    <h2 class="page-head-title">{{arc:title}}</h2>
                </div>
                <div class="main-content">
                        {{arc:impersonate}}
                    {{arc:content}}
                </div>

            </div>
            <!-- /.conainer-fluid -->
        </main>

    </div>

    <footer class="app-footer">
        <span class="float-right">
            Powered by {{arc:version}}
        </span>
    </footer>
    {{arc:footer}}
</body>
</html>