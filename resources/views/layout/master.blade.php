<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {!! Html::style('plugin/bootstrap/dist/css/bootstrap.min.css') !!}
    {!! Html::style('plugin/font-awesome/css/font-awesome.min.css') !!}
    {!! Html::style('plugin/nprogress/nprogress.css') !!}
    {!! Html::style('/plugin/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css') !!}
    {!! Html::style('plugin/animate.css/animate.min.css') !!}
    {!! Html::style('/build/css/custom.min.css') !!}
  </head>
  
  <body class='nav-md'>
  <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
            </div>
            <div class="clearfix"></div>
            <!-- menu profile quick info -->
            @include('layout.menu-profile')
            <!-- /menu profile quick info -->
            <br />
            <!-- sidebar menu -->
            @include('layout.sidebar')
            <!-- /sidebar menu -->
            <!-- /menu footer buttons -->
            @include('layout.menu-footer')            
            <!-- /menu footer buttons -->
          </div>
        </div>
        <!-- top navigation -->
        @include('layout.top-nav')                   
        <!-- /top navigation -->
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>  {{translateUrl()}} </h3>
              </div>
              <div class="clearfix"></div>
              @yield('content')
            </div>
          </div>
        </div>
        <!-- /page content -->
        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    <script src="{{asset('plugin/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('plugin/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('plugin/fastclick/lib/fastclick.js')}}"></script>
    <script src="{{asset('plugin/nprogress/nprogress.js')}}"></script>
    <script src="{{asset('plugin/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script src="{{asset('plugin/validator/validator.js')}}"></script>
    <script src="{{asset('build/js/custom.min.js')}}"></script>
    {!! Html::script('js/ajax.js') !!}
    @yield('script')
  </body>
</html>