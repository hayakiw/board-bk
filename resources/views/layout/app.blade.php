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
  @if($session_guard->check())
  <div class="utility">
    <div class="inner">
      <ul class="clearfix">
        <li class="date">処理日 : {{ Auth::guard('web')->user()->getDate() }}</li>
        <li class="clearfix">
          <ul class="setting">
            <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">設定 <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{ route('accounts.index') }}">アカウント管理</a></li>
              </ul>
            </li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- / .inner -->
  </div>
  <!-- / .utility -->
  @endif
  <div class="inner clearfix">
    <div class="site-title"> <a href="{{ route('root.index') }}">{{ config('my.site_title') }}</a></div>
    <!-- / .title -->
    <div id="gNav" class="clearfix">
      @if($session_guard->check())
      <ul class="clearfix">
        <li @if(Request::is(['print', 'print/*'])) active @endif> <a href=""> xxx </a></li>
      </ul>
      <ul class="account">
        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::guard('web')->user()->getName() }}さん <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li role="separator" class="divider"></li>
            <li><a href="{{ route('user.edit_password') }}">パスワｰド変更</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ route('auth.signout') }}">ログアウト</a></li>
          </ul>
        </li>
      </ul>
      @endif

      @if (!$session_guard->check())
      <ul class="account">
        <li><a href="{{ route('auth.signin') }}" class="exhibit">ログイン</a></li>
      </ul>
      @endif

    </div>
    <!--/.nav-collapse -->
  </div>
  <!-- / .inner -->
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
