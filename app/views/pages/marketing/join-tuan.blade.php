@extends ('layouts.tuan-base')

@section('content')
<div class="container">
    <h4>加入团购活动</h4>
    @if (Session::has('error'))
        <div class="alert alert-warning fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="fa fa-exclamation-circle"></i>
            {{ Session::get('error') }}
        </div>
    @endif
    <hr>
    {{ Form::open(array('action' => 'MarketingController@postJoinTuan', 'class' => 'form-horizontal')) }}

    <div class="form-group">
        <label for="phone_number" class="col-sm-2 control-label">请输入手机号码</label>

        <div class="col-sm-10">
            <input type="text" class="form-control" value="" maxlength="11" name="phone_number"
                   id="phone_number" />
        </div>
    </div>


    <p class="text-center">
        <button class="btn btn-danger" type="submit" disabled id="submit_btn">获取验证码</button>
    </p>

    {{ Form::close() }}

</div>
@stop

@section('javascript')
<script type="text/javascript">
    $('#phone_number').on('input',function(e){
        if ($(this).val().length == 11) {
            $('#submit_btn').attr('disabled', false);
        } else {
            $('#submit_btn').attr('disabled', true);
        }
    });
</script>
@stop