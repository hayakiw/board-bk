@php
    /* @var string $page_title 画面のタイトル */
    /* @var Illuminate\Auth\SessionGuard $session_guard */
    $session_guard = Auth::guard('web');
@endphp
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<title>@if(isset($page_title)){{ $page_title }} | @endif{{ config('my.site_title') }}</title>
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<meta name="format-detection" content="telephone=no">
<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('css/stylesheet.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('css/jquery.fancybox.css') }}">
<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery-migrate-1.0.0.js') }}"></script><!-- / .fancybox -->
<script type="text/javascript" src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery-ujs.js') }}"></script>
<script type="text/javascript">
    $(function () {
        $(".datepicker").datepicker({
            showOn: "button",
            buttonImage: "{{ asset('css/images/calendar.gif') }}",
            buttonImageOnly: true,
            buttonText: "Select date",
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
    });
</script>
<script type="text/javascript" src="{{ asset('js/jquery.fancybox.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
  $("a.iframe").fancybox({
    'width'         : 660,
    'height'        : '80%',
    'autoScale'     : false,
    'transitionIn'  : 'none',
    'transitionOut' : 'none',
    'type'          : 'iframe'
  });
});
</script>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</head>
<body>
<div class="header">
<nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      <a class="navbar-brand" href="{{ route('root.index') }}">Board</a>
      </div>
  
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        @if($session_guard->check())
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
          <li><a href="#">Link</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#">Separated link</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#">One more separated link</a></li>
            </ul>
          </li>
        </ul>
        <form class="navbar-form navbar-left">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
          </div>
          <button type="submit" class="btn btn-default">Submit</button>
        </form>
        @endif
        <ul class="nav navbar-nav navbar-right">
          @if($session_guard->check())
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::guard('web')->user()->getName() }} <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li role="separator" class="divider"></li>
              <li><a href="#">パスワｰド変更</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="{{ route('auth.signout') }}">ログアウト</a></li>
            </ul>
          </li>
          @else
          <li><a href="{{ route('auth.signin') }}" class="exhibit">ログイン</a></li>
          @endif
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
</div>
<!-- / .header -->

<div class="content">
    <div class="inner">
      @if (session('info'))
      <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('info') }}
      </div>
      @endif

      @if (session('error'))
      <div class="alert alert-danger alert-dismissible" role="alert">
        {{ session('error') }}
      </div>
      @endif

      @yield('content')
    </div>
</div>

@if (isset($page_js))
<script src="{{ asset('js/' . $page_js . '.js?2') }}"></script>
@endif
<script type="text/javascript">@stack('script_codes')</script>

</body>
</html>
