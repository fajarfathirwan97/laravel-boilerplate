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
<body>
    <div class="container body">
      <div class="main_container">
        <!-- page content -->
        <div class="col-md-12">
          <div class="col-middle">
            <div class="text-center text-center">
              <h1 class="error-number">403</h1>
              <h2>Unauthorized</h2>
              </p>
            </div>
            </div>
        <!-- /page content -->
        </div>
      </div>
    </div>
</body>