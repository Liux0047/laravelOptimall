@extends ('layouts.base')

@section ('content')
<div class="container content-container">
	<div class="page-header">		
		<h1>
			忘记密码                    
			<small>重置您的密码</small>
		</h1>
	</div>
	<div class="col-md-6">
		@include('components.page-frame.message-bar')
		<h4>
			请输入您的邮箱地址，并通过您的邮箱重置密码                
		</h4>
		<br>
		{{ Form::open(array('action' => 'RemindersController@postRemind', 'id'=>'forget-pwd-form', 'role'=>'form'))}}
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-envelope fa-fw fa-lg"></i></span>
				<input type="email" class="form-control" id="email" name="email" placeholder="邮箱地址">
			</div>
		</div>
		<input type="submit" class="btn btn-primary btn-sm pull-right" value="发送至此邮箱"> 
		{{ Form::close() }} 
	</div>

</div>
@stop