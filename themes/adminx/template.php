
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
{{arc:header}}
</head>
<body class="theme-blue">
<!-- Page Loader -->
<div class="page-loader-wrapper">
	<div class="loader">
		<div class="line"></div>
		<div class="line"></div>
		<div class="line"></div>
		<div class="line"></div>
		<p>Please wait...</p>
	</div>
</div>

<!-- Overlay For Sidebars -->
<div class="overlay"></div>

<!-- Search  -->
<div class="search-bar">
	<div class="search-icon"> <i class="material-icons">search</i> </div>
	<input type="text" placeholder="Search..">
	<div class="close-search"> <i class="material-icons">close</i> </div>
</div>

<!-- Top Bar -->
<nav class="navbar clearHeader">
	<div class="col-12">
		<div class="navbar-header"> <a href="javascript:void(0);" class="bars"></a> <a class="navbar-brand" href="{{arc:path}}"><img class="logo" src="{{arc:sitelogo}}" alt="{{arc:title}}"></a> </div>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="zmdi zmdi-search"></i></a></li>
			<li><a href="login" class="mega-menu" data-close="true"><i class="zmdi zmdi-power"></i></a></li>
		</ul>
	</div>
</nav>
<!-- #Top Bar --> 

<!--Side menu and right menu -->
<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">  
    <!-- Menu -->
    <div class="menu">
        {{arc:menu}}
    </div>
    <!-- #Menu --> 
</aside>
<!-- #END# Left Sidebar --> 

<!-- main content -->
<section class="content blog-page">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Blank Page</h2>
            {{module:arc:breadcrumb}}
        </div>
        {{arc:content}}
    </div>
</section>
{{arc:footer}}
</body>
</html>