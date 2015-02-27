<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>目光之城 大型团购活动</title>
    <meta name="author" content="Alvaro Trigo Lopez"/>
    <meta name="description"
          content="fullPage plugin by Alvaro Trigo. Create fullscreen pages fast and simple. One page scroll like iPhone website."/>
    <meta name="keywords" content="fullpage,jquery,alvaro,trigo,plugin,fullscren,screen,full,iphone5,apple"/>
    <meta name="Resource-type" content="Document"/>

    {{ HTML::style('css/bootstrap.min.css'); }}


    <style>

        .font-white {
            color: #FFFFFF;
        }

    </style>


</head>
<body>

<div class="container">
    <h4>验证</h4>
    @if (Session::has('error'))
        <div class="alert alert-warning fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="fa fa-exclamation-circle"></i>
            {{ Session::get('error') }}
        </div>
    @endif
    <hr>
    {{ Form::open(array('action' => 'MarketingController@postVerifyTuan', 'class' => 'form-horizontal')) }}

    <div class="form-group">
        <label for="code" class="col-sm-2 control-label">请输入验证码</label>

        <div class="col-sm-10">
            <input type="text" class="form-control" value="" maxlength="6" name="code"/>
        </div>
    </div>

    <p class="text-center">
        <button class="btn btn-danger" type="submit">验证</button>
    </p>


    {{ Form::close() }}

</div>

</body>



{{ HTML::script('js/jquery.min.js') }}
{{ HTML::script('js/bootstrap.min.js') }}

</html>
