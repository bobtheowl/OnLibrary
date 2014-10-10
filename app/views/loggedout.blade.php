@extends('base')

@section('body')
  <nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('/') }}">OnLibrary</a>
      </div>{{-- /.navbar-header --}}
    </div>{{-- /.container-fluid --}}
  </nav>
  <section class="container-fluid">
    @yield('content', '')
  </section>
@stop
