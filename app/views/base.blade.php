<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, inital-scale=1">
  <title>OnLibrary 0.1.0</title>
  
  {{-- Bootstrap --}}
  <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('css/bootstrap-theme.min.css') }}" rel="stylesheet" />
  {{-- Font Awesome --}}
  <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet" />
  {{-- Other included third-party styles --}}
  @yield('css-include', '')
  {{-- OnLibrary --}}
  <link href="{{ URL::asset('css/onlibrary.css') }}" rel="stylesheet" />
  
  {{-- HTML5 Shim and Respond.js - IE8 support of HTML5 elements and media queries
       WARNING: Respond.js doesn't work if you view the page via file:// --}}
  <!--[if lt IE 9]>
    <script src="{{ URL::asset('js/plugins/html5shiv/html5shiv.min.js') }}"></script>
    <script src="{{ URL::asset('js/plugins/respond/respond.min.js') }}"></script>
  <![endif]-->
</head>
<body>
  @yield('body', '')
  
  {{-- jQuery (necessary for Bootstrap's JavaScript plugins) --}}
  <script src="{{ URL::asset('js/plugins/jquery/jquery-2.1.1.min.js') }}"></script>
  {{-- Bootstrap --}}
  <script src="{{ URL::asset('js/bootstrap/bootstrap.min.js') }}"></script>
  {{-- Other included third-party JavaScript --}}
  @yield('js-include', '')
  
  <script type="text/javascript">
      $(document).on('ready', function () {
          @yield('onload', '')
      });
  </script>
</body>
</html>
