@extends ('layouts.tuan-base')

@section('content')
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
            <input type="text" class="form-control" value="" maxlength="6" name="code" id="code"/>
        </div>
    </div>

    <p class="text-center">
        <button class="btn btn-danger" type="submit" disabled id="submit_btn">验证</button>
    </p>


    {{ Form::close() }}

</div>


@section('javascript')
<script type="text/javascript">
    $('#code').on('input',function(e){
        if ($(this).val()) {
            $('#submit_btn').attr('disabled', false);
        } else {
            $('#submit_btn').attr('disabled', true);
        }
    });
</script>
@stop