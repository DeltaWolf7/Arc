<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        {{arc:header}}
    </head>
    <body>
        <!-- Outer Starts -->
        <div class="container-fluid container-fluid-nopad">
            <!-- Status -->

            <!-- Header two Starts -->
            <div class="header-2">

                <!-- Container -->
             
                    <div class="row">
                        <div class="col-md-4">
                            <!-- Logo section -->
                            <div class="logo">
                                <h1><a href="{{arc:path}}"><img src="{{arc:sitelogo}}" alt=""></a></h1>
                            </div>
                        </div>
                        <div class="col-md-8">

                            <!-- Navigation starts.  -->
                            <div class="navy pull-right">			
                                    <!-- Main menu -->
                                    {{arc:menu}}
                            </div>							
                            <!-- Navigation ends -->

                        </div>

                   
                </div>
            </div>

            <!-- Header two ends -->


            <!-- Main content starts -->

            <div class="main-block">
                {{arc:impersonate}}
                <div class="page-header"><h1>{{arc:title}}</h1></div>
                <div class="container-fluid">
                    {{arc:content}}
                </div>
            </div>
            <!-- Main content ends -->
        </div>
        <!-- Outer Ends -->		
        <footer class="footer">
            <div class="container">
                <p class="text-muted pull-right">{{arc:version}}</p>
            </div>
        </footer>
        {{arc:footer}}
    </body>
</html>