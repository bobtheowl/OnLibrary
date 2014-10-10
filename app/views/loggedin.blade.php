@extends('base')

@section('body')
  <nav class="navbar navbar-default" role="navigation">
    @include('nav')
  </nav>
  <section class="container-fluid">
    @yield('content', '')
  </section>
@stop
