@extends ('layouts.base')

@section ('content')
<div class="container content-container">
	<div class="page-header">
		<h1>
			目光之城微信公共主页            
		</h1>
	</div>
	<p>
		请扫描下面的二维码加入我们的公共主页
	</p>
	<p>
		{{ HTML::image('images/icons/wechat.jpg', '', array('class'=>'img-center'))}}             
	</p>
</div>
@stop