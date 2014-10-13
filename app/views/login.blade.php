@extends('loggedout')

@section('content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <form role="form" action="{{ URL::to('login') }}" method="post">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">
              <i class="fa fa-sign-in"></i> Sign In
            </h3>
          </div>{{-- /.panel-heading --}}
          <div class="panel-body clearfix">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-user"></i>
                </span>
                <input type="text"
                       class="form-control"
                       placeholder="Username"
                       name="username"
                       value="{{ (Session::has('auth-username')) ? Session::get('auth-username') : '' }}"
                />
              </div>{{-- /.input-group --}}
            </div>{{-- /.form-group --}}
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-lock"></i>
                </span>
                <input type="password" class="form-control" placeholder="Password" name="password" />
              </div>{{-- /.input-group --}}
            </div>{{-- /.form-group --}}
            <p>
              <span class="pull-left">
                <a href="{{ URL::to('reset') }}">Forgot your password?</a>
              </span>
              <label class="checkbox-inline pull-right">
                <input type="checkbox" name="remember" value="yes" />
                Remember me
              </label>
            </p>
          </div>{{-- /.panel-body.clearfix --}}
          <div class="panel-footer clearfix">
            <a href="{{ URL::to('register') }}" class="btn btn-default pull-left">
              <i class="fa fa-pencil-square-o"></i> Create a New Account
            </a>
            <button type="submit" class="btn btn-primary pull-right">
              <i class="fa fa-sign-in"></i> Sign In
            </button>
          </div>{{-- /.panel-footer.clearfix --}}
        </div>{{-- /.panel.panel-primary --}}
      </form>
    </div>{{-- /.col-md-6.col-md-offset-3 --}}
  </div>{{-- /.row --}}
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
@if (Session::has('auth-message'))
      <div class="alert alert-success" role="alert">
        <i class="fa fa-check"></i>
        {{ Session::get('auth-message') }}
      </div>{{-- /.alert.alert-success --}}
@endif
@if (Session::has('auth-error'))
      <div class="alert alert-danger" role="alert">
        <i class="fa fa-exclamation"></i>
        {{ Session::get('auth-error') }}
      </div>{{-- /.alert.alert-danger --}}
@endif
    </div>{{-- /.col-md-6.col-md-offset-3 --}}
  </div>{{-- /.row --}}
@stop
