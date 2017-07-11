<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        {{arc:header}}
    </head>

    <body data-ma-theme="green">
        <main class="main">
            <div class="page-loader">
                <div class="page-loader__spinner">
                    <svg viewBox="25 25 50 50">
                        <circle cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
                    </svg>
                </div>
            </div>

            <header class="header">
                <div class="navigation-trigger" data-ma-action="aside-open" data-ma-target=".sidebar">
                    <div class="navigation-trigger__inner">
                        <i class="navigation-trigger__line"></i>
                        <i class="navigation-trigger__line"></i>
                        <i class="navigation-trigger__line"></i>
                    </div>
                </div>

                <div class="header__logo hidden-sm-down">
                    <h1><a href="{{arc:path}}">{{arc:sitetitle}}</a></h1>
                </div>

                <form class="search">
                    <div class="search__inner">
                        <input type="text" class="search__text" placeholder="Search for people, files, documents...">
                        <i class="zmdi zmdi-search search__helper" data-ma-action="search-close"></i>
                    </div>
                </form>

                <ul class="top-nav">
                    <li class="hidden-xl-up"><a href="" data-ma-action="search-open"><i class="zmdi zmdi-search"></i></a></li>

                    <li class="dropdown hidden-xs-down">
                        <a href="" data-toggle="dropdown"><i class="zmdi zmdi-more-vert"></i></a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-item theme-switch">
                                Theme Switch

                                <div class="btn-group btn-group--colors mt-2" data-toggle="buttons">
                                    <label class="btn bg-green active"><input type="radio" value="green" autocomplete="off" checked></label>
                                    <label class="btn bg-blue"><input type="radio" value="blue" autocomplete="off"></label>
                                    <label class="btn bg-red"><input type="radio" value="red" autocomplete="off"></label>
                                    <label class="btn bg-orange"><input type="radio" value="orange" autocomplete="off"></label>
                                    <label class="btn bg-teal"><input type="radio" value="teal" autocomplete="off"></label>

                                    <br>

                                    <label class="btn bg-cyan"><input type="radio" value="cyan" autocomplete="off"></label>
                                    <label class="btn bg-blue-grey"><input type="radio" value="blue-grey" autocomplete="off"></label>
                                    <label class="btn bg-purple"><input type="radio" value="purple" autocomplete="off"></label>
                                    <label class="btn bg-indigo"><input type="radio" value="indigo" autocomplete="off"></label>
                                    <label class="btn bg-lime"><input type="radio" value="lime" autocomplete="off"></label>
                                </div>
                            </div>
                        </div>
                    </li>

                </ul>
            </header>

            <aside class="sidebar sidebar--hidden">
                {{arc:menu}}
            </aside>

            <section class="content content--full">
                <h1>{{arc:title}}</h1>
                {{arc:content}}        
                <footer class="text-right footer hidden-xs-down">
                    <p>{{arc:version}}</p>
                </footer>
            </section>
        </main>
        {{arc:footer}}
    </body>
</html>