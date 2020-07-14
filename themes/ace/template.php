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

          </div><!-- .navbar-content -->

        </div><!-- /.navbar-inner -->
      </nav>
      <div class="main-container">

        <div id="sidebar" class="sidebar sidebar-fixed sidebar-default expandable sidebar-hover">
		{{arc:menu}}
        </div><!-- /#sidebar -->

        <div role="main" class="main-content">
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