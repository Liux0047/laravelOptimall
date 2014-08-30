<!DOCTYPE html>
<html lang='zh-Hans'>
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
    <meta name='keywords' content='Optimall' />
    <meta name='token' content='{{ csrf_token() }}'/>
    @section('link-css')
    {{ HTML::style('css/bootstrap.min.css'); }}
    {{ HTML::style('plugins/font-awesome/css/font-awesome.min.css'); }}
    {{ HTML::style('css/animate.min.css'); }}
    {{ HTML::style('css/yamm.css'); }}        
    <link rel='shortcut icon' type="image/x-icon" href="{{ asset('images/favicon.ico') }}"> 
    @show
    {{ HTML::style('css/style.css'); }}
    <title>{{{ $pageTitle or '目光之城眼镜商城'}}}</title>
</head>        


<body>
    @include('components.page-frame.top-banner')                
    @include('components.page-frame.navbar-customer')
    @yield('content')
    @include('components.page-frame.footer')
</body>


@section('link-script')
{{ HTML::script('js/jquery.min.js') }}
{{ HTML::script('js/bootstrap.min.js') }}
{{ HTML::script('js/jquery.lazyload.min.js') }}
{{ HTML::script('js/script.js') }}
@show

@section('script')
<script type="text/javascript">
$("#login_form").submit(function(e) {
    e.preventDefault();
});

function enableSubmit() {
    if ($("#login_email").val() && $("#login_password").val()) {
        $("#login_submit").prop("disabled", false);
    }
    else {
        $("#login_submit").prop("disabled", true);
    }
}

function auth_login() {
    $("#login_submit").prop("disabled", true);
    $("#login_preloader_img").show();
    $("#login_fail_container").slideUp();
    var email = document.getElementById("login_email").value;
    var password = document.getElementById("login_password").value;
    var remember_me = document.getElementById("remember_me").checked;
    if (document.getElementById("remember_me").checked) {
        remember_me = true;
    }
    $.ajax({
        type: "POST",
        url: "{{ URL::to('login') }}",
        data: {email: email, password: password, remember_me: remember_me}
    }).done(function(data) {
        //if successfully logged in
        if (data.isValidAccount) {        //if valid user exists         
            window.location.href = document.URL;
        }
        else {
            $("#login_fail_container").slideDown();
        }
    }).fail(function() {
        //if the connection to database failed
        alert("connection to database has failed");
    }).always(function() {
        $("#login_submit").prop("disabled", false);
        $("#login_preloader_img").hide();
    });
}
</script>
@show

</html>