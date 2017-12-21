<html>
  <head>
      {!! Html::style('plugin/font-awesome/css/font-awesome.min.css') !!}
      {!! Html::style('plugin/css/app.css') !!}
      {!! Html::style('plugin/nprogress/nprogress.css') !!}
      {!! Html::style('plugin/animate.css/animate.min.css') !!}
      {!! Html::style('/build/css/custom.min.css') !!}
      {!! Html::style('plugin/bootstrap/dist/css/bootstrap.min.css') !!}
  </head>
  <body>
    @if (session('level'))
      <div class='col-md-3 pull-right'>
        <div class="alert alert-{{session('level')}}" style="position:fixed;">
          <strong>{{ucwords(session('level'))}}!</strong> {{trans(session('message'))}}
        </div>
      </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="x_content">
                @yield('content')
            </div>
        </div>
    </div>
  </body>
  {!! Html::script('js/ajax.js') !!}
  @yield('script')
</html>