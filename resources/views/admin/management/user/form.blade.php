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
            <form action="{{route('admin.management.user.post')}}" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                {{csrf_field()}}
                <input type="hidden" name="{{"{$tableName}[uuid]"}}" value="{{@$data[uuid]}}">
                {{-- FIRST NAME --}}
                <div class="form-group {{$errors->has("{$tableName}.first_name") ? 'has-error' : ''}}">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">{{trans("form.{$tableName}.first_name")}}</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <input type="text" value="{{Request::old("{$tableName}.first_name") ?: @$data['first_name']}}" name="{{"{$tableName}[first_name]"}}" id="first_name" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                @if($errors->has("{$tableName}.first_name"))
                        <span class="help-block">{{$errors->first("{$tableName}.first_name")}}</span>
                @endif
                {{-- LAST NAME --}}
                <div class="form-group {{$errors->has("{$tableName}.last_name") ? 'has-error' : ''}}">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">{{trans("form.{$tableName}.last_name")}}</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <input type="text" value="{{Request::old("{$tableName}.last_name") ?: @$data['last_name']}}" name="{{"{$tableName}[last_name]"}}" id="last_name" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                @if($errors->has("{$tableName}.last_name"))
                        <span class="help-block">{{$errors->first("{$tableName}.last_name")}}</span>
                @endif
                {{-- LAST NAME --}}
                <div class="form-group {{$errors->has("{$tableName}.password") ? 'has-error' : ''}}">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">{{trans("form.{$tableName}.password")}}</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <input type="password" value="{{Request::old("{$tableName}.password") ?: @$data['password']}}" name="{{"{$tableName}[password]"}}" id="password" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                @if($errors->has("{$tableName}.last_name"))
                        <span class="help-block">{{$errors->first("{$tableName}.last_name")}}</span>
                @endif
                
                {{-- AVATAR --}}
                 <div class="form-group {{$errors->has("{$tableName}.avatar") ? 'has-error' : ''}}">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">{{trans("form.{$tableName}.avatar")}}</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <input type="file"  name="{{"{$tableName}[avatar]"}}" id="logoView" class="form-control col-md-7 col-xs-12">
                        <input type="hidden" value="{{Request::old("{$tableName}.avatar")}}" name="{{"{$tableName}[avatar]"}}" id="avatar" class="form-control col-md-7 col-xs-12">
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
                 {{-- ROLE --}}
                 <div class="form-group {{$errors->has("{$tableName}.role") ? 'has-error' : ''}}">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">{{trans("form.{$tableName}.role")}}</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <select value="{{Request::old("{$tableName}.role") ?: @$data['role']}}" name="{{"{$tableName}[role]"}}" id="role" class="form-control col-md-7 col-xs-12">
                        </select>
                    </div>
                </div>
                @if($errors->has("{$tableName}.role"))
                        <span class="help-block">{{$errors->first("{$tableName}.role")}}</span>
                @endif

                  {{-- ORGANIZATION --}}
                  <div class="form-group {{$errors->has("{$tableName}.organization") ? 'has-error' : ''}}">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">{{trans("form.{$tableName}.organization")}}</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <select value="{{Request::old("{$tableName}.organization") ?: @$data['organization']}}" name="{{"{$tableName}[organization]"}}" id="organization" class="form-control col-md-7 col-xs-12">
                        </select>
                    </div>
                </div>
                @if($errors->has("{$tableName}.organization"))
                        <span class="help-block">{{$errors->first("{$tableName}.organization")}}</span>
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
        $('#organization').select2({
            ajax: {
                type:"POST",
                delay : 1000,
                data: function (params) {
                    var query = {
                    search: params.term,
                    isParent : 1
                    }
            
                    return query;
                },
                url: '{{route("organization.select2")}}',
                processResults: function (data) {
                    return {
                        results: data.results
                    };
                }
            }
        })
        $('#role').select2({
            ajax: {
                type:"POST",
                delay : 1000,
                data: function (params) {
                    var query = {
                    search: params.term,
                    isParent : 1
                    }
            
                    return query;
                },
                url: '{{route("role.select2")}}',
                processResults: function (data) {
                    return {
                        results: data.results
                    };
                }
            }
        })
        $('#logoView').on('change',function(){
            var reader = new FileReader();
            reader.readAsDataURL($(this)[0].files[0]);
            reader.onload = function () {
                $('#avatar').val(reader.result)
            };
        })
    })
</script>
@endsection