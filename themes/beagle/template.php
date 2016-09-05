<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    {{arc:header}}
  </head>
  <body>
    <div class="be-wrapper">
      <nav class="navbar navbar-default navbar-fixed-top be-top-header">
        <div class="container-fluid">
            <div class="navbar-header"><a href="{{arc:path}}" class="navbar-brand"><img style="max-height: 55px; padding-top: 5px;" src="{{arc:sitelogo}}"></a></div>
          <!--<div class="be-right-navbar">
            <ul class="nav navbar-nav navbar-right be-icons-nav">
              <li class="dropdown"><a href="#" role="button" aria-expanded="false" class="be-toggle-right-sidebar"><span class="fa fa-cog fa-2x"></span></a></li>
            </ul>
          </div>/-->
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
          <h2 class="page-head-title">{{arc:title}}</h2>
          {{module:beagle:breadcrumb}}
        </div>
        <div class="main-content">
          {{arc:content}}
        </div>
      </div>
      <!--<nav class="be-right-sidebar">
        <div class="sb-content">
          <div class="tab-navigation">
            <ul role="tablist" class="nav nav-tabs nav-justified">
              <li role="presentation" class="active"><a href="#tab1" aria-controls="chat" role="tab" data-toggle="tab">tab 1</a></li>
              <li role="presentation"><a href="#tab2" aria-controls="todo" role="tab" data-toggle="tab">tab 2</a></li>
              <li role="presentation"><a href="#tab3" aria-controls="settings" role="tab" data-toggle="tab">tab 3</a></li>
            </ul>
          </div>
          <div class="tab-panel">
            <div class="tab-content">
              <div id="tab1" role="tabpanel" class="tab-pane active">
                tab 1                
              </div>
              <div id="tab2" role="tabpanel" class="tab-pane">
                tab 2
              </div>
              <div id="tab3" role="tabpanel" class="tab-pan">
                tab 3
              </div>
            </div>
          </div>
        </div>
      </nav>/-->
    </div>
    {{arc:footer}}
  </body>
</html>