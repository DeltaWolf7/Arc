<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{arc:header}}
    </head>
    <body>
        <!-- start: Header -->
        <header class="navbar">
            <div class="container">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".sidebar-nav.nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a id="main-menu-toggle" class="hidden-xs open"><i class="fa fa-bars"></i></a>	
                <a class="navbar-brand col-lg-2 col-sm-1 col-xs-12" href="{{arc:path}}"><img src="{{arc:sitelogo}}" alt=""></a>
                <!-- start: Header Menu -->
                <div class="nav-no-collapse header-nav">
                    <ul class="nav navbar-nav pull-right">
                        <li class="dropdown hidden-xs">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="index.html#">
                                <i class="fa fa-warning"></i>
                            </a>
                            <ul class="dropdown-menu notifications">
                                <li class="dropdown-menu-title">
                                    <span>You have 11 notifications</span>
                                </li>	
                                <li>
                                    <a href="index.html#">
                                        <span class="icon blue"><i class="fa fa-user"></i></span>
                                        <span class="message">New user registration</span>
                                        <span class="time">1 min</span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="index.html#">
                                        <span class="icon green"><i class="fa fa-comment"></i></span>
                                        <span class="message">New comment</span>
                                        <span class="time">7 min</span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="index.html#">
                                        <span class="icon green"><i class="fa fa-comment"></i></span>
                                        <span class="message">New comment</span>
                                        <span class="time">8 min</span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="index.html#">
                                        <span class="icon green"><i class="fa fa-comment"></i></span>
                                        <span class="message">New comment</span>
                                        <span class="time">16 min</span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="index.html#">
                                        <span class="icon blue"><i class="fa fa-user"></i></span>
                                        <span class="message">New user registration</span>
                                        <span class="time">36 min</span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="index.html#">
                                        <span class="icon yellow"><i class="fa fa-shopping-cart"></i></span>
                                        <span class="message">2 items sold</span>
                                        <span class="time">1 hour</span> 
                                    </a>
                                </li>
                                <li class="warning">
                                    <a href="index.html#">
                                        <span class="icon red"><i class="fa fa-user"></i></span>
                                        <span class="message">User deleted account</span>
                                        <span class="time">2 hour</span> 
                                    </a>
                                </li>
                                <li class="warning">
                                    <a href="index.html#">
                                        <span class="icon red"><i class="fa fa-shopping-cart"></i></span>
                                        <span class="message">Transaction was canceled</span>
                                        <span class="time">6 hour</span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="index.html#">
                                        <span class="icon green"><i class="fa fa-comment"></i></span>
                                        <span class="message">New comment</span>
                                        <span class="time">yesterday</span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="index.html#">
                                        <span class="icon blue"><i class="fa fa-user"></i></span>
                                        <span class="message">New user registration</span>
                                        <span class="time">yesterday</span> 
                                    </a>
                                </li>
                                <li class="dropdown-menu-sub-footer">
                                    <a>View all notifications</a>
                                </li>	
                            </ul>
                        </li>
                        <!-- start: Notifications Dropdown -->
                        <li class="dropdown hidden-xs">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="index.html#">
                                <i class="fa fa-tasks"></i>
                            </a>
                            <ul class="dropdown-menu tasks">
                                <li>
                                    <span class="dropdown-menu-title">You have 17 tasks in progress</span>
                                </li>
                                <li>
                                    <a href="index.html#">
                                        <span class="header">
                                            <span class="title">iOS Development</span>
                                            <span class="percent"></span>
                                        </span>
                                        <div class="taskProgress progressSlim progressBlue">80</div> 
                                    </a>
                                </li>
                                <li>
                                    <a href="index.html#">
                                        <span class="header">
                                            <span class="title">Android Development</span>
                                            <span class="percent"></span>
                                        </span>
                                        <div class="taskProgress progressSlim progressYellow">47</div> 
                                    </a>
                                </li>
                                <li>
                                    <a href="index.html#">
                                        <span class="header">
                                            <span class="title">Django Project For Google</span>
                                            <span class="percent"></span>
                                        </span>
                                        <div class="taskProgress progressSlim progressRed">32</div> 
                                    </a>
                                </li>
                                <li>
                                    <a href="index.html#">
                                        <span class="header">
                                            <span class="title">SEO for new sites</span>
                                            <span class="percent"></span>
                                        </span>
                                        <div class="taskProgress progressSlim progressGreen">63</div> 
                                    </a>
                                </li>
                                <li>
                                    <a href="index.html#">
                                        <span class="header">
                                            <span class="title">New blog posts</span>
                                            <span class="percent"></span>
                                        </span>
                                        <div class="taskProgress progressSlim progressPink">80</div> 
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-menu-sub-footer">View all tasks</a>
                                </li>	
                            </ul>
                        </li>
                        <!-- end: Notifications Dropdown -->
                        <!-- start: Message Dropdown -->
                        <li class="dropdown hidden-xs">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="index.html#">
                                <i class="fa fa-envelope"></i>
                            </a>
                            <ul class="dropdown-menu messages">
                                <li>
                                    <span class="dropdown-menu-title">You have 9 messages</span>
                                </li>	
                                <li>
                                    <a href="index.html#">
                                        <span class="avatar"><img src="assets/img/avatar.jpg" alt="Avatar"></span>
                                        <span class="header">
                                            <span class="from">
                                                Łukasz Holeczek
                                            </span>
                                            <span class="time">
                                                6 min
                                            </span>
                                        </span>
                                        <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>  
                                    </a>
                                </li>
                                <li>
                                    <a href="index.html#">
                                        <span class="avatar"><img src="assets/img/avatar2.jpg" alt="Avatar"></span>
                                        <span class="header">
                                            <span class="from">
                                                Megan Abott
                                            </span>
                                            <span class="time">
                                                56 min
                                            </span>
                                        </span>
                                        <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>  
                                    </a>
                                </li>
                                <li>
                                    <a href="index.html#">
                                        <span class="avatar"><img src="assets/img/avatar3.jpg" alt="Avatar"></span>
                                        <span class="header">
                                            <span class="from">
                                                Kate Ross
                                            </span>
                                            <span class="time">
                                                3 hours
                                            </span>
                                        </span>
                                        <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>  
                                    </a>
                                </li>
                                <li>
                                    <a href="index.html#">
                                        <span class="avatar"><img src="assets/img/avatar4.jpg" alt="Avatar"></span>
                                        <span class="header">
                                            <span class="from">
                                                Julie Blank
                                            </span>
                                            <span class="time">
                                                yesterday
                                            </span>
                                        </span>
                                        <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>  
                                    </a>
                                </li>
                                <li>
                                    <a href="index.html#">
                                        <span class="avatar"><img src="assets/img/avatar5.jpg" alt="Avatar"></span>
                                        <span class="header">
                                            <span class="from">
                                                Jane Sanders
                                            </span>
                                            <span class="time">
                                                Jul 25, 2012
                                            </span>
                                        </span>
                                        <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>  
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-menu-sub-footer">View all messages</a>
                                </li>	
                            </ul>
                        </li>
                        <!-- end: Message Dropdown -->
                        <li>
                            <a class="btn" href="index.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                        </li>
                        <!-- start: User Dropdown -->
                        <li class="dropdown">
                            <a class="btn account dropdown-toggle" data-toggle="dropdown" href="index.html#">
                                <div class="avatar"><img src="assets/img/avatar.jpg" alt="Avatar"></div>
                                <div class="user">
                                    <span class="hello">Welcome!</span>
                                    <span class="name">Łukasz Holeczek</span>
                                </div>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-menu-title">
                                </li>
                                <li><a href="index.html#"><i class="fa fa-user"></i> Profile</a></li>
                                <li><a href="index.html#"><i class="fa fa-cog"></i> Settings</a></li>
                                <li><a href="index.html#"><i class="fa fa-envelope"></i> Messages</a></li>
                                <li><a href="login.html"><i class="fa fa-off"></i> Logout</a></li>
                            </ul>
                        </li>
                        <!-- end: User Dropdown -->
                    </ul>
                </div>
                <!-- end: Header Menu -->
            </div>	
        </header>
        <!-- end: Header -->
        <div class="container">
            <div class="row">
                <!-- start: Main Menu -->
                <div id="sidebar-left" class="col-lg-2 col-sm-1">
                    <input type="text" class="search hidden-sm" placeholder="..." />
                    <div class="nav-collapse sidebar-nav collapse navbar-collapse bs-navbar-collapse">
                        {{arc:menu}}
                    </div>
                </div>
                <!-- end: Main Menu -->
                <!-- start: Content -->
                <div id="content" class="col-lg-10 col-sm-11">
                   
                        <h2>{{arc:title}}</h2>
                        {{arc:content}}
                    
                </div>
                <!-- end: Content -->
            </div><!--/row-->		
        </div><!--/container-->
        <div class="clearfix"></div>
        <footer>
            <div class="row">
                <div class="col-sm-12 text-right">
                    {{arc:version}}
                </div><!--/.col-->	
            </div><!--/.row-->	
        </footer>
        {{arc:footer}}
    </body>
</html>