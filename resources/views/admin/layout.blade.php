<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('blog.title') }} Admin</title>

    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset("/css/admin/all.css")}}" rel="stylesheet" type="text/css" />

    @yield('styles')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body class="hold-transition skin-blue sidebar-mini" >
<div class="wrapper">

    {{-- Main header --}}
    @include('admin.partials.main-header')

    {{-- Sidebar --}}
    @include('admin.partials.sidebar')

    {{-- Content wrapper --}}
    <div class="content-wrapper" style="min-height: 916px;">

        {{-- Content header : title vs breadcrumb --}}
        @include('admin.partials.content-header')

        @yield('content')
    </div>

    {{-- Main footer --}}
    @include('admin.partials.main-footer')

</div><!-- ./wrapper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="{{ asset ('/js/all.js') }}" type="text/javascript"></script>
@yield('scripts')

</body>
</html>