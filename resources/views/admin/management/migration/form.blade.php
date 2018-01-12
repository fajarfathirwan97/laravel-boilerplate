@extends('layout.master')

@section('title')
    {{translateUrl()}}
@endsection

@section('content')
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
            <h2>{{translateUrl()}}</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                <li><a><i id='addColumn' class="fa fa-plus"></i></a></li>
            </ul>
            <div class="clearfix"></div>
            </div>
            <div class="x_content">
            <br />
            <form action="{{route('admin.management.migration.post')}}" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                {{csrf_field()}}
                <!-- <input type="hidden" name="migration[uuid]" value="{{@$migration[uuid]}}"> -->

                <!-- block 1 form -->
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">{{trans('form.migration.name')}}</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <input type="text" value="{{@$migration['name']}}" name="migration[name]" id="name" class="form-control">
                    </div>
                </div>
                <!-- /block 1 form -->

                <div class='form-generate'></div>

                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button class="btn btn-primary" type="button">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    
    $(document).ready(function(){
        $('#addColumn').on('click',function(){
            var formAjax = new ajax("{{route('admin.management.migration.getGenerateForm')}}",{length : $('[name*="migration[column]"').length/2 },{},'GET').execAjax().getResult()
            formAjax.then(function(res){
                console.log()
                $('.form-generate').append(res.body.content);
                $('.dataType').select2()
                $('.deleteColumn').on('click',function(){
                    console.log('asd');
                    $(this).parents().eq(1).remove();
                })
            })
        })
    })
</script>
@endsection