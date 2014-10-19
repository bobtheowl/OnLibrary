@extends('loggedout')

@section('content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <form role="form">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">
              <i class="fa fa-pencil-square-o"></i>Create a New Account
            </h3>
          </div>{{-- /.panel-heading --}}
          <div class="panel-body clearfix">
            <div class="form-group" id="register-input-group-firstname">
              <label for="firstname">First Name</label>
              <input type="text" class="form-control" name="firstname" id="firstname" />
              <span class="help-block hidden"></span>
            </div>{{-- /.form-group --}}
            <div class="form-group" id="register-input-group-lastname">
              <label for="lastname">Last Name</label>
              <input type="text" class="form-control" name="lastname" id="lastname" />
              <span class="help-block hidden"></span>
            </div>{{-- /.form-group --}}
            <div class="form-group" id="register-input-group-email">
              <label for="email">Email Address</label>
              <div class="input-group">
                <label class="input-group-addon" for="email">
                  <i class="fa fa-at"></i>
                </label>
                <input type="email" class="form-control" name="email" id="email" />
              </div>{{-- /.input-group --}}
              <span class="help-block hidden"></span>
            </div>{{-- /.form-group --}}
            <div class="form-group" id="register-input-group-username">
              <label for="username">Username</label>
              <div class="input-group">
                <label class="input-group-addon" for="username">
                  <i class="fa fa-user"></i>
                </label>
                <input type="text" class="form-control" name="username" id="username" />
              </div>{{-- /.input-group --}}
              <span class="help-block hidden"></span>
            </div>{{-- /.form-group --}}
            <div class="form-group" id="register-input-group-password">
              <label for="password">Password</label>
              <div class="input-group">
                <label class="input-group-addon" for="password">
                  <i class="fa fa-lock"></i>
                </label>
                <input type="password" class="form-control" name="password" id="password" />
              </div>{{-- /.input-group --}}
              <span class="help-block hidden"></span>
            </div>{{-- /.form-group --}}
            <div class="form-group" id="register-input-group-password-repeat">
              <label for="password-repeat">Repeat Password</label>
              <div class="input-group">
                <label class="input-group-addon" for="password-repeat">
                  <i class="fa fa-lock"></i>
                </label>
                <input type="password" class="form-control" name="password-repeat" id="password-repeat" />
              </div>{{-- /.input-group --}}
              <span class="help-block hidden"></span>
            </div>{{-- /.form-group --}}
          </div>{{-- /.panel-body.clearfix --}}
          <div class="panel-footer clearfix">
            <a href="{{ URL::to('login') }}" class="btn btn-default pull-left">
              <i class="fa fa-reply"></i> Return to Sign In
            </a>
            <button type="button" class="btn btn-primary pull-right" id="register-submit">
              <i class="fa fa-pencil-square-o"></i> Create Account
            </button>
          </div>{{-- /.panel-footer.clearfix --}}
        </div>{{-- /.panel.panel-primary --}}
      </form>
    </div>{{-- /.col-md-6.col-md-offset-3 --}}
  </div>{{-- /.row --}}
@stop

@section('js-include')
  <script src="{{ URL::asset('js/register.js') }}"></script>
@stop

@section('onload')
    register.init();
@stop
