<div class="container-fluid">
  {{-- Visible in mobile view --}}
  <div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#library-nav-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="{{ URL::to('/') }}">OnLibrary</a>
  </div>{{-- /.navbar-header --}}
  {{-- Visible in full view --}}
  <div class="collapse navbar-collapse" id="library-nav-collapse-1">
    <ul class="nav navbar-nav">
      <li id="onlibrary-nav-search"><a href="{{ URL::to('search') }}">
        <i class="fa fa-search"></i> Search
      </a></li>
      <li id="onlibrary-nav-add"><a href="{{ URL::to('add') }}">
        <i class="fa fa-plus"></i> Add Book
      </a></li>
      <li id="onlibrary-nav-manage"><a href="{{ URL::to('manage') }}">
        <i class="fa fa-gear"></i> Manage Library
      </a></li>
    </ul>{{-- /ul.nav.navbar-nav --}}
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="onlibrary-nav-user">
          <i class="fa fa-user"></i> <span class="caret"></span>
        </a>
        <ul class="dropdown-menu" role="menu" id="onlibrary-user-menu">
          <li role="presentation" class="dropdown-header">USER NAME HERE</li>
          <li role="presentation"><a href="{{ URL::to('logout') }}" role="menuitem">
            <i class="fa fa-sign-out"></i> Sign Out
          </a></li>
        </ul>{{-- /ul.dropdown-menu --}}
      </li>
    </ul>{{-- /ul.nav.navbar-nav.navbar-right --}}
    <form class="navbar-form navbar-right" role="search" action="{{-- SEARCH HREF HERE --}}" method="GET">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Quick Search" />
        <span class="input-group-btn">
          <button class="btn btn-default" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </span>{{-- /span.input-group-btn --}}
      </div>{{-- /.input-group --}}
    </form>{{-- /form.navbar-form.navbar-right --}}
  </div>{{-- /.collapse.navbar-collapse --}}
</div>{{-- /.container-fluid --}}
