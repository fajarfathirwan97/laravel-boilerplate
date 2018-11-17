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
            </ul>
            <div class="clearfix"></div>
            </div>
            <div class="x_content">
            <br />
            <form action="{{route('admin.management.role.post')}}" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                {{csrf_field()}}
                <input type="hidden" name="role[uuid]" value="{{@$role[uuid]}}">

                <!-- block 1 form -->
                <div class="form-group {{$errors->has('role.name') ? 'has-error' : ''}}">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">{{trans('form.role.name')}}</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <input type="text" value="{{@$role['name']}}" name="role[name]" id="name" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                @if($errors->has('role.name'))
                        <span class="help-block">{{$errors->first('role.name')}}</span>
                @endif
                <!-- /block 1 form -->

                <!-- block 1 form -->
                <div class="form-group {{$errors->has('role.permission') ? 'has-error' : ''}}">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">{{trans('form.role.permissions')}}</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <select name="role[permissions][]" id="permission" data-value="{{@$role[permission]}}" class="form-control col-md-7 col-xs-12" multiple>
                            @foreach ( $app->routes->getRoutes() as $item)
                            <option value="{{$item->getName()}}">{{translateUrl($item->getName())}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @if($errors->has('role.name'))
                        <span class="help-block">{{$errors->first('role.name')}}</span>
                @endif
                <!-- /block 1 form -->

                
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
        $('#permission').select2()
        var permission = $('#permission').data('value'); 
        $(permission).each(function(key,item){
            $('#permission').append($('<option>', {value: item.value, text: item.text,selected: true}))
        })
    })
</script>
@endsection