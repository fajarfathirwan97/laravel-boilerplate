@extends('layout.master')
@section('content')
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
            <h2>{{translateUrl()}} <small>different form elements</small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            </ul>
            <div class="clearfix"></div>
            </div>
            <div class="x_content">
            <br />
            <form id="demo-form2" action="{{route('admin.user.post')}}" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                {{csrf_field()}}
                <input type="hidden" value="{{@$user['id']}}" name="user[id]">
                <div class="form-group {{$errors->has('user.first_name') ? 'has-error' : ''}}">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{trans('form.user.first_name')}}*</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" value="{{@$user['first_name']}}" name="user[first_name]" id="first_name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    @if($errors->has('user.first_name'))
                        <span class="help-block">{{$errors->first('user.first_name')}}</span>
                    @endif
                <div class="form-group {{$errors->has('user.last_name') ? 'has-error' : ''}}">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">{{trans('form.user.last_name')}}*</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" value="{{@$user['last_name']}}" name="user[last_name]" id="last_name" name="last-name" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                    @if($errors->has('user.last_name'))
                        <span class="help-block">{{$errors->first('user.last_name')}}</span>
                    @endif
                </div>
                <div class="form-group {{$errors->has('user.current_password') ? 'has-error' : ''}}">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">{{trans('form.user.current_password')}}*</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="password" value="" name="user[current_password]" id="last_name" name="last-name" class="form-control col-md-7 col-xs-12">
                    </div>
                    @if($errors->has('user.current_password'))
                        <span class="help-block">{{$errors->first('user.current_password')}}</span>
                    @endif
                </div>
                <div class="form-group {{$errors->has('user.password') ? 'has-error' : ''}}">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">{{trans('form.user.password')}}*</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="password" value="" name="user[password]" id="last_name" name="last-name" class="form-control col-md-7 col-xs-12">
                    </div>
                    @if($errors->has('user.password'))
                        <span class="help-block">{{$errors->first('user.password')}}</span>
                    @endif
                </div>
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
