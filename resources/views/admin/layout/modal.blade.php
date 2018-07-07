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
<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery-migrate-1.0.0.js') }}"></script><!-- / .fancybox -->
<script type="text/javascript" src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
</head>
<body class="modal-window">
<a id="top"></a>
<div class="content">
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

    <div class="inner">
      @yield('content')
    </div>
</div>
</body>
</html>
