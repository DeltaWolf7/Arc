<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv='content-language' content='en-gb'>
    {{arc:header}}
  </head>
  <body>
    <div class="be-wrapper">
      <nav class="navbar navbar-default navbar-fixed-top be-top-header">
            <div class="navbar-header"><a href="{{arc:path}}" class="navbar-brand"><img style="max-height: 55px; padding-top: 5px;" src="{{arc:sitelogo}}"></a></div>
            <div class="be-right-navbar">
                <ul class="nav navbar-nav navbar-right be-user-nav">
                    <li><a href="{{arc:path}}"><img class="img-responsive" style="padding-top: 5px;" src="{{arc:sitelogo}}"></a><li>
                </ul>
            </div>
      </nav>
      <div class="be-left-sidebar">
        <div class="left-sidebar-wrapper"><a href="#" class="left-sidebar-toggle">Navigation</a>
          <div class="left-sidebar-spacer">
            <div class="left-sidebar-scroll">
              <div class="left-sidebar-content">
                {{arc:menu}}
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="be-content">
        <div class="page-head">
          <h1 class="page-head-title">{{arc:title}}</h1>
          {{module:arc:breadcrumb}}
        </div>
        <div class="main-content">
          {{arc:impersonate}}
          {{arc:content}}
        </div>
      </div>
    </div>
    {{arc:footer}}
  </body>
</html>