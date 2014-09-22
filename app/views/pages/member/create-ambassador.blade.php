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
		@include('components.member-account.side-nav', array('entry'=>4))

		<div class="col-md-10">			
			@include('components.page-frame.message-bar')

			{{ Form::open(array('action'=>'AmbassadorController@postCreateAmbassador', 'role'=>'form', 'id'=>'ambassador_form', 'class'=>'form-horizontal'))}}
			<div class="form-group">
				<label for="alipay_account" class="col-sm-2 control-label">支付宝账号</label>
				<div class="col-md-6">
					<input type="text" id="alipay_account" name="alipay_account" class="form-control"  placeholder="请填写您的支付宝账号">
				</div>				
			</div>	
			<div class="form-group">
				<label for="mobile_phone" class="col-sm-2 control-label">手机号码</label>
				<div class="col-md-6">
					<input type="text" id="mobile_phone" name="mobile_phone" class="form-control"  placeholder="请填写您的手机号码">
				</div>				
			</div>			
			<div class="form-group">
				<label for="ambassador_plan" class="col-sm-2 control-label">目光之星计划</label>
				<div class="col-md-6">
					<textarea rows="3" id="ambassador_plan" name="ambassador_plan" class="form-control"  placeholder="请简述为什么你会成为一个成功的目光之星？你打算如何推广目光之星眼镜商城？(100字以内)"></textarea>
				</div>				
			</div>			
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					{{ Form::submit('立即申请为目光之星', array('class'=>'btn btn-primary'))}}
				</div>
			</div>			
			{{ Form::close() }}

			@include('components.member-account.send-invitation')


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
				required: true,
				maxlength: 45
			},
			mobile_phone: {
				required: true,
				maxlength: 20
			},
			ambassador_plan: {
				required: true,
				maxlength: 100
			}
		},
		messages: {
			alipay_account: {
				required: warningIcon + "请输入您的支付宝账号",
				maxlength: warningIcon + "支付宝账号过长"
			},
			mobile_phone: {
				required: warningIcon + "请输入您的手机号码",
				maxlength: warningIcon + "手机号码过长"
			},
			ambassador_plan: {
				required: warningIcon + "请输入您的目光之星计划",
				maxlength: warningIcon + "请控制在100字内"
			}
		},
		errorElement: "span",
		errorPlacement: function(error, element) {
			error.appendTo($(element).parent());
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