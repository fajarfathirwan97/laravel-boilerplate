@extends('layout.master')
  @section('content')
  <div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
      <div class="animate form login_form">
        <section class="login_content">
        	<form id='formLogin' method='POST' action="{{route('auth')}}">
            <h1>Login Form</h1>
            <div>
              <input type="email" class="form-control" name="auth[email]" placeholder="{{trans('form.email')}}" required="" />
            </div>
            <div>
              <input type="password" class="form-control" name="auth[password]" placeholder="{{trans('form.password')}}" required="" />
            </div>
            <div>
	        	<input type="submit" value='Log-in' class="btn btn-default submit">
              <a class="reset_pass" href="#">Lost your password?</a>
            </div>
            <div class="clearfix"></div>
	          <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
          </form>
        </section>
      </div>
    </div>
  </div>
@endsection
