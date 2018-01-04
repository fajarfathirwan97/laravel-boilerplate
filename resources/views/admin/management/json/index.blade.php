@extends('layout.master')
@section('title')
    {{translateUrl()}}
@endsection

@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>{{translateUrl()}}</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form id='jsonForm' class="form-horizontal form-label-left">
                    {{csrf_field()}}
                    <div class="form-group {{$errors->has('menu.slug') ? 'has-error' : ''}}">            
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">JSON</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <textarea name='json' style="resize: none; height:500px " class="form-control col-md-7"></textarea>
                        </div>
                    </div>
                </form>                    
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button class="btn btn-primary" type="button">Cancel</button>
                        <button id='submitJsonDummy' class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('#submitJsonDummy').on('click',function(){
        var jsonPost = new ajax("{{route('admin.management.json.post')}}",$('#jsonForm').serializeArray(),{},'POST').execAjax().getResult()
    })
</script>
@endsection