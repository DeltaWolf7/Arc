<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
{{arc:header}}
</head>
   <body>
    <div class="body-container">
      <nav class="navbar navbar-expand-lg navbar-fixed navbar-default">
        <div class="navbar-inner">

          <div class="navbar-intro justify-content-xl-between">

            <button type="button" class="btn btn-burger burger-arrowed static collapsed ml-2 d-flex d-xl-none" data-toggle-mobile="sidebar" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle sidebar">
              <span class="bars"></span>
            </button><!-- mobile sidebar toggler button -->

            <a class="navbar-brand text-white" href="{{arc:path}}">
             <img src="{{arc:sitelogo}}" style="max-width: 180px;" alt="{{arc:sitetitle}}" />
            </a><!-- /.navbar-brand -->

            <button type="button" class="btn mr-2 d-none d-xl-flex btn-burger" data-toggle="sidebar" data-target="#sidebar" aria-controls="sidebar" aria-expanded="true" aria-label="Toggle sidebar">
              <span class="bars"></span>
            </button><!-- sidebar toggler button -->

          </div><!-- /.navbar-intro -->


          <div class="navbar-content">

            <button class="navbar-toggler py-2" type="button" data-toggle="collapse" data-target="#navbarSearch" aria-controls="navbarSearch" aria-expanded="false" aria-label="Toggle navbar search">
              <i class="fa fa-search text-white text-90 py-1"></i>
            </button>

            <div class="navbar-content-section collapse navbar-collapse navbar-backdrop" id="navbarSearch">
              <div class="d-flex align-items-center ml-lg-3">
                <i class="fa fa-search text-white mr-n1 d-none d-lg-block"></i>
                <input type="text" class="navbar-search-input px-1 pl-lg-4 ml-lg-n3 w-100 autofocus" placeholder=" SEARCH ..." aria-label="Search" />
              </div>
            </div>

          </div><!-- .navbar-content -->

        </div><!-- /.navbar-inner -->
      </nav>
      <div class="main-container">

        <div id="sidebar" class="sidebar sidebar-fixed sidebar-default expandable sidebar-hover">
		{{arc:menu}}
        </div><!-- /#sidebar -->

        <div role="main" class="main-content">
          <div class="d-none content-nav mb-1 bgc-grey-l4">
            <div class="d-flex justify-content-between align-items-center">
              <ol class="breadcrumb pl-2">
                <li class="breadcrumb-item active text-grey">
                  <i class="fa fa-home text-dark-m3 mr-1"></i>
                  <a class="text-blue" href="#">
                    Home
                  </a>
                </li>

                <li class="breadcrumb-item active text-grey-d1">Gallery</li>
              </ol>

              <div class="nav-search">
                <form class="form-search">
                  <span class="d-inline-flex align-items-center">
                           <input type="text" placeholder="Search ..." class="form-control pr-4 form-control-sm radius-1 brc-info-m2 text-grey" autocomplete="off" />
                           <i class="fa fa-search text-info-m1 ml-n4"></i>
                       </span>
                </form>
              </div><!-- /.nav-search -->
            </div>
          </div><!-- breadcrumbs -->

          <div class="page-content container">
            <div class="page-header">
              <h1 class="page-title text-primary-d2">
			  {{arc:title}}
              </h1>
            </div>

            <div class="container">
			{{arc:content}}
            </div>
           
          </div><!-- /.page-content -->

          <footer class="footer d-none d-sm-block">
            <div class="footer-inner bgc-white-tp1">
              <div class="pt-3 border-none border-t-3 brc-grey-l1 border-double">
                <span class="text-muted">{{arc:version}}</span>
              </div>
            </div><!-- .footer-inner -->
          </footer>

      </div><!-- /.main-container -->
	  {{arc:footer}}
    </div><!-- /.body-container -->
  </body>

</html>