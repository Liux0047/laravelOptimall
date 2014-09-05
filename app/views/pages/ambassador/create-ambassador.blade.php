@extends ('layouts.base')

@section('content')
<div class="container content-container">
	<div class="page-header">
        <h1>
            注册成为目光之星                    
            <small>享受优惠</small>
        </h1>
    </div>
	<div class="row">
		<div class="col-md-6">			
			{{ Form::open(array('action'=>'AmbassadorController@postCreateAmbassador', 'role'=>'form', 'id'=>'ambassador_form', 'class'=>'form-horizontal'))}}
			<div class="form-group">
				<label for="alipay_account" class="col-sm-2 control-label">支付宝账号</label>
				<div class="col-md-10">
					<input type="text" id="alipay_account" name="alipay_account" class="form-control"  placeholder="请填写您的支付宝账号">
				</div>				
			</div>			
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					{{ Form::submit('立即成为目光之星', array('class'=>'btn btn-primary btn-sm'))}}
				</div>
			</div>			
			{{ Form::close() }}
			
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">		
			{{ HTML::image('images/ambassador/ambassador-illustration.jpg')}}	
		</div>
	</div>
</div>
@stop

@section('link-script')
@parent
{{ HTML::script('plugins/jQuery-Validation/jquery.validate.min.js') }}
{{ HTML::script('js/jQuery-Validation-customize.js') }}
@stop


@section('script')
@parent
<script type="text/javascript">
$(document).ready(function() {
	// validate signup form on keyup and submit
	var warningIcon = "<i class='fa fa-warning fa-lg'></i> ";
	$("#ambassador_form").validate({
		rules: {
			alipay_account: {
				required: true
			}
		},
		messages: {
			alipay_account: {
				required: warningIcon + "请输入您的支付宝账号"
			}
		},
		errorElement: "span",
		errorPlacement: function(error, element) {
			error.appendTo($(element).parent());
		},
		success: function(label) {
			label.html("<span class='jq-validate-valid'><i class='fa fa-check-circle fa-lg'></i></span>");
		},
		validClass: "",
		errorClass: "jq-validate-error",
	    //ignore: [], //validate hidden input
	    onkeyup: function(element) {
	    	$(element).valid();
	    },
	    onfocusout: function(element) {
	    	$(element).valid();
	    },
	    //onkeyup: true,
	    //onfocusout: true,
	    onclick: true
	});
});
</script>
@stop