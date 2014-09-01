@extends ('layouts.base')

@section('content')
<div class="container content-container">
	@if ($isAlreadyAmbassador)
	<div class="page-header">
        <h1>您已经是目光之星了
        </h1>
    </div>
	@else
	<div class="page-header">
        <h1>成功注册目光之星                    
            <small>开始邀请朋友加入吧</small>
        </h1>
    </div>
	<div class="row">
		<div class="col-md-12">
			您的邀请码为： {{ $amabassadorCode }}
		</div><!--End col-md-->
	</div>
	@endif
</div>
@stop
