<html>
  <head></head>
    {!! Html::style('plugin/bootstrap/dist/css/bootstrap.min.css') !!}
    {!! Html::style('plugin/font-awesome/css/font-awesome.min.css') !!}
    {!! Html::style('plugin/nprogress/nprogress.css') !!}
    {!! Html::style('plugin/animate.css/animate.min.css') !!}
    {!! Html::style('/build/css/custom.min.css') !!}
  <body>
    @yield('content')
  </body>
</html>