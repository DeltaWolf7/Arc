<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv='content-language' content='en-gb'>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#f4f3ef">
    <link rel="icon" href="{{arc:path}}assets/logo-32x32.png" type="image/png" />
    {{arc:header}}
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div>
                    <a href="{{arc:path}}"><img src="{{arc:sitelogo}}" class="logo-icon" alt="{{arc:sitetitle}}"
                            width="50px" height="50px"></a>
                </div>
                <div>
                    <a href="{{arc:path}}">
                        <h4 class="logo-text">{{arc:sitetitle}}</h4>
                    </a>
                </div>
                <div class="toggle-icon ms-auto"><i class='fas fa-bars'></i>
                </div>
            </div>
            <!--navigation-->
            <div class="sidebar">
                {{arc:menu}}
            </div>
            <!--end navigation-->
        </div>
        <!--end sidebar wrapper -->
        <!--start header -->
        <header>
            <div class="topbar d-flex align-items-center">
                <nav class="navbar navbar-expand">
                    <div class="mobile-toggle-menu"><i class='fas fa-bars'></i>
                    </div>

                    <h1>{{arc:title}}</h1>

                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <form method="post" action="/search/">
                            <div class="input-group no-border">
                                <input type="text" class="form-control" name="search" placeholder="Search...">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </nav>
            </div>
        </header>
        <!--end header -->
        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                {{arc:impersonate}}

                {{arc:content}}
            </div>
        </div>
        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i
                class='fas fa-angle-double-up'></i></a>
        <!--End Back To Top Button-->
        <footer class="page-footer">
            <p class="mb-0">{{arc:footer}}</p>
        </footer>
    </div>
    <!--end wrapper-->
    </div>
</body>

</html>