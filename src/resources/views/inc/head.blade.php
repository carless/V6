<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" >

@if (config('cesi.core.meta_robots_content'))
    <meta name="robots" content="{{ config('cesi.core.meta_robots_content', 'noindex, nofollow') }}">
@endif

<link rel="shortcut icon" href="{{ asset('vendor/cesi/core/img/favicon/favicon.ico') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('vendor/cesi/core/img/favicon/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('vendor/cesi/core/img/favicon/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('vendor/cesi/core/img/favicon/favicon-16x16.png') }}">
<link rel="manifest" href="{{ asset('vendor/cesi/core/img/favicon/site.webmanifest') }}">
<link rel="mask-icon" href="{{ asset('vendor/cesi/core/img/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">

{{-- Encrypted CSRF token for Laravel, in order for Ajax requests to work --}}
<meta name="csrf-token" content="{{ csrf_token() }}" />

<title>
    {{ isset($title) ? $title.' :: '.config('cesi.core.project_name').' Admin' : config('cesi.core.project_name').' Admin' }}
    {{-- config('cesi.core.project_name').' Admin' --}}
</title>

<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
{{ Html::script('https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') }}
{{ Html::script('https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js') }}
<![endif]-->

@yield('before_styles')
@stack('before_styles')

<link rel="stylesheet" href="{{ asset('vendor/cesi/core/plugins/fontawesome-free/css/all.min.css') }}">
{{-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> --}}

<link rel="stylesheet" href="{{ asset('vendor/cesi/core/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/cesi/core/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

<link rel="stylesheet" href="{{ asset('vendor/cesi/core/plugins/pnotify/pnotify.custom.min.css') }}">

<link rel="stylesheet" href="{{ asset('vendor/cesi/core/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

<link rel="stylesheet" href="{{ asset('vendor/cesi/core/css/cesitheme.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/cesi/core/css/custom.css') }}">

<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

@yield('after_styles')
@stack('after_styles')