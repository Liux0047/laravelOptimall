<!DOCTYPE html>
<html lang='zh-Hans'>
<head>
    <meta charset="UTF-8">
    <meta name='token' content='{{ csrf_token() }}'/>
    @section('link-css')
    {{ HTML::style('css/bootstrap.min.css'); }}
    {{ HTML::style('plugins/font-awesome/css/font-awesome.min.css'); }}
    {{ HTML::style('css/yamm.css'); }}        
    <link rel='shortcut icon' type="image/x-icon" href="{{ asset('images/favicon.ico') }}"> 
    @show
    {{ HTML::style('css/style.css'); }}
    <title>{{{ $pageTitle or '目光之城管理员'}}}</title>
</head>        


<body>                
    @include('components.page-frame.navbar-admin')
    @yield('content')
</body>


@section('link-script')
{{ HTML::script('js/jquery.min.js') }}
{{ HTML::script('js/bootstrap.min.js') }}
{{ HTML::script('js/jquery.lazyload.min.js') }}
{{ HTML::script('js/script.js') }}
@show

@section('script')
<script type="text/javascript">
      
</script>
@show

</html>