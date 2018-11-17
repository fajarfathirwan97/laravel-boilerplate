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
    {!! Html::style('plugin/select2/dist/css/select2.min.css') !!}    
    <link href="{{asset('plugin/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('plugin/pnotify/dist/pnotify.css')}}" rel="stylesheet">
    <link href="{{asset('plugin/pnotify/dist/pnotify.material.css')}}" rel="stylesheet">
    <link href="{{asset('plugin/pnotify/dist/pnotify.brighttheme.css')}}" rel="stylesheet">
    <link href="{{asset('plugin/pnotify/dist/pnotify.mobile.css')}}" rel="stylesheet">
    <link href="{{asset('plugin/pnotify/dist/pnotify.buttons.css')}}" rel="stylesheet">
    <link href="{{asset('plugin/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('plugin/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('plugin/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('plugin/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
    <style>
      .modal-open .select2-dropdown { z-index: 10060; } .modal-open .select2-close-mask { z-index: 10055; }
      .form-horizontal .control-label{text-align:left;}
      div.dataTables_wrapper div.dataTables_filter input ,div.dataTables_wrapper div.dataTables_filter label{display: none}
    </style>
    <title>
      @yield('title')
    </title>
  </head>
  <body class='nav-md'>
  @if(session('message'))
    <div class="col-xs-12 col-md-3 alert alert-{{session('level')}} alert-dismissable fade in" style="position: fixed; right: 0px; z-index: 99;">
      <a href="#" class="close" data-dismiss="alert" aria-label="close" style="right: 1%;">&times;</a>
      <strong>{{ucwords(session('level'))}}!</strong> {{session('message')}}
    </div>
  @endif
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
                <!-- <h3>  {{translateUrl()}} </h3> -->
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
      @yield('specific_modal')
      @include('layout.general-modal')
    </div>
    <script src="{{asset('plugin/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('plugin/pnotify/dist/pnotify.js')}}"></script>
    <script src="{{asset('plugin/pnotify/dist/pnotify.animate.js')}}"></script>
    <script src="{{asset('plugin/pnotify/dist/pnotify.mobile.js')}}"></script>
    <script src="{{asset('plugin/pnotify/dist/pnotify.desktop.js')}}"></script>
    <script src="{{asset('plugin/pnotify/dist/pnotify.confirm.js')}}"></script>
    <script src="{{asset('plugin/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('plugin/select2/dist/js/select2.min.js')}}"></script>
    <script src="{{asset('plugin/select2/dist/js/select2.full.min.js')}}"></script>
    <script src="{{asset('plugin/fastclick/lib/fastclick.js')}}"></script>
    <script src="{{asset('plugin/nprogress/nprogress.js')}}"></script>
    <script src="{{asset('plugin/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script src="{{asset('plugin/validator/validator.js')}}"></script>
    <script src="{{asset('build/js/custom.min.js')}}"></script>
    <script src="{{asset('plugin/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugin/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('plugin/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('plugin/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
    <script src="{{asset('plugin/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('plugin/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('plugin/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('plugin/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{asset('plugin/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('plugin/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('plugin/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    <script src="{{asset('plugin/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
    <script src="{{asset('plugin/jszip/dist/jszip.min.js')}}"></script>
    <script src="{{asset('plugin/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{asset('plugin/pdfmake/build/vfs_fonts.js')}}"></script>
    {!! Html::script('js/ajax.js') !!}
    {!! Html::script('js/datatables.js') !!}
    <script>
      var target
    </script>
    @yield('script')
    <script>
      if(target !== undefined){
        $(target).on('click','#detailButton',function(){
              window.location.replace($(this).attr('data-url'))
        })
        $(target).on('click','#deleteModalButton',function(){
              $('#confrimationDeleteYes').attr('data-id',$(this).attr('data-id'));
              $('#deleteModal').modal('show')
        })
        $(target).on('click','#updateModalButton',function(){
              $('#confrimationUpdateYes').attr('data-id',$(this).attr('data-id'));
              $('#updateModal').modal('show')
        })
      }
    </script>
  </body>
</html>