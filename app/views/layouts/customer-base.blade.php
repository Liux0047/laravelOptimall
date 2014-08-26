@extends ('layouts.base')

@section('top-banner')
@include('components.page-frame.top-banner')
@stop


@section('navbar')
@include('components.page-frame.navbar-customer')
@stop


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
            url: "/optimall/functions/Ajax/auth-login.php",
            data: {email: email, password: password, remember_me: remember_me}
        }).done(function(data) {
            var ajaxReturn = JSON.parse(data);      //parse the return data
            //if successfully logged in
            if (ajaxReturn.isValidUser) {        //if valid user exists         
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