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
            <form action="{{route('admin.management.organization.post')}}" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                {{csrf_field()}}
                <input type="hidden" name="{{"{$tableName}[uuid]"}}" value="{{@$data[uuid]}}">
                {{-- NAME --}}
                <div class="form-group {{$errors->has("{$tableName}.name") ? 'has-error' : ''}}">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">{{trans("form.{$tableName}.name")}}</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <input type="text" value="{{Request::old("{$tableName}.name") ?: @$data['name']}}" name="{{"{$tableName}[name]"}}" id="name" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                @if($errors->has("{$tableName}.name"))
                        <span class="help-block">{{$errors->first("{$tableName}.name")}}</span>
                @endif
                {{-- LOGO --}}
                 <div class="form-group {{$errors->has("{$tableName}.logo") ? 'has-error' : ''}}">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">{{trans("form.{$tableName}.logo")}}</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <input type="file"  name="{{"{$tableName}[logo]"}}" id="logoView" class="form-control col-md-7 col-xs-12">
                        <input type="hidden" value="{{Request::old("{$tableName}.logo")}}" name="{{"{$tableName}[logo]"}}" id="logo" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                @if($errors->has("{$tableName}.logo"))
                        <span class="help-block">{{$errors->first("{$tableName}.logo")}}</span>
                @endif
                {{-- EMAIL --}}
                <div class="form-group {{$errors->has("{$tableName}.email") ? 'has-error' : ''}}">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">{{trans("form.{$tableName}.email")}}</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <input type="text" value="{{Request::old("{$tableName}.email") ?: @$data['email']}}" name="{{"{$tableName}[email]"}}" id="email" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                @if($errors->has("{$tableName}.email"))
                        <span class="help-block">{{$errors->first("{$tableName}.email")}}</span>
                @endif
                {{-- PHONE --}}
                <div class="form-group {{$errors->has("{$tableName}.phone") ? 'has-error' : ''}}">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">{{trans("form.{$tableName}.phone")}}</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <input type="number" value="{{Request::old("{$tableName}.phone") ?: @$data['phone']}}" name="{{"{$tableName}[phone]"}}" id="phone" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                @if($errors->has("{$tableName}.phone"))
                        <span class="help-block">{{$errors->first("{$tableName}.phone")}}</span>
                @endif

                {{-- WEBISTE --}}
                <div class="form-group {{$errors->has("{$tableName}.website") ? 'has-error' : ''}}">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">{{trans("form.{$tableName}.website")}}</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <input type="text" value="{{Request::old("{$tableName}.website") ?: @$data['website']}}" name="{{"{$tableName}[website]"}}" id="website" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                @if($errors->has("{$tableName}.website"))
                        <span class="help-block">{{$errors->first("{$tableName}.website")}}</span>
                @endif


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
        $('#logoView').on('change',function(){
            var reader = new FileReader();
            reader.readAsDataURL($(this)[0].files[0]);
            reader.onload = function () {
                $('#logo').val(reader.result)
            };
        })
    })
</script>
@endsection