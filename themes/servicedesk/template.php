<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   {{arc:header}}
</head>

<body>
   <div class="wrapper">
      <!-- top navbar-->
      <header class="topnavbar-wrapper">
         <!-- START Top Navbar-->
         <nav role="navigation" class="navbar topnavbar">
            <!-- START navbar header-->
            <div class="navbar-header">
               <a href="" class="navbar-brand">
                  <div class="brand-logo">
                     <img src="{{arc:themepath}}images/logo-32x32.png" alt="Arc Project" class="img-responsive">
                  </div>
               </a>
            </div>
            <!-- END navbar header-->
            <!-- START Nav wrapper-->
            <div class="nav-wrapper">
               <!-- START navbar-->
              {{arc:menu}}
               <!-- END navbar-->
               
            </div>
            <!-- END Nav wrapper-->
         </nav>
         <!-- END Top Navbar-->
      </header>
           <!-- Main section-->
      <section>
         <!-- Page content-->
         <div class="content-wrapper">
            <div class="content-heading">
               {{arc:title}}
               <small data-localize="dashboard.WELCOME"></small>
            </div>
            
            <div class="row">
               <!-- START dashboard sidebar-->
               <aside class="col-lg-12">
                  <!-- START loader widget-->
                  <div class="panel panel-default">
                     <div class="panel-body">
                        <a href="#" class="text-muted pull-right">
                           <em class="fa fa-arrow-right"></em>
                        </a>
                        <div class="text-info">Average Monthly Uploads</div>
                        <canvas data-classyloader="" data-percentage="70" data-speed="20" data-font-size="40px" data-diameter="70" data-line-color="#23b7e5" data-remaining-line-color="rgba(200,200,200,0.4)" data-line-width="10"
                        data-rounded-line="true" class="center-block"></canvas>
                        <div data-sparkline="" data-bar-color="#23b7e5" data-height="30" data-bar-width="5" data-bar-spacing="2" data-values="5,4,8,7,8,5,4,6,5,5,9,4,6,3,4,7,5,4,7" class="text-center"></div>
                     </div>
                     <div class="panel-footer">
                        <p class="text-muted">
                           <em class="fa fa-upload fa-fw"></em>
                           <span>This Month</span>
                           <span class="text-dark">1000 Gb</span>
                        </p>
                     </div>
                  </div>
                  <!-- END loader widget-->
                  
                  {{arc:content}}
                  
               </aside>
               <!-- END dashboard sidebar-->
            </div>
         </div>
      </section>
      <!-- Page footer-->
      <footer>
         <span>{{arc:version}}</span>
      </footer>
   </div>
   {{arc:footer}}
</body>

</html>