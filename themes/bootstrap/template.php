<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{arc:header}}
  </head>
  <body>
    <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
      <button class="navbar-toggler navbar-toggler-right hidden-lg-up" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a href="{{arc:path}}" class="navbar-brand"><img src="{{arc:sitelogo}}"></a>
    </nav>
    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 hidden-xs-down bg-faded sidebar">
          {{arc:menu}}
        </nav>
        <main class="col-md-10 offset-md-2 pt-3">
         <h1>{{arc:title}}</h1>
          {{arc:content}}
        </main>
      </div>
    </div>
    {{arc:footer}}
  </body>
</html>