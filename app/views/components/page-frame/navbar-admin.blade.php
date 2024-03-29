<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<!--Brand and toggle get grouped for better mobile display -->
		<div class = "navbar-header">
			<button type = "button" class = "navbar-toggle collapsed" data-toggle = "collapse" data-target = "#bs-example-navbar-collapse-1">
				<span class = "sr-only">Toggle navigation</span>
				<span class = "icon-bar"></span>
				<span class = "icon-bar"></span>
				<span class = "icon-bar"></span>
			</button>
			<a class = "navbar-brand" href = "{{ action('AdminFunctionController@getIndex') }}">管理员平台</a>
		</div>

		<!--Collect the nav links, forms, and other content for toggling -->
		<div class = "collapse navbar-collapse" id = "bs-example-navbar-collapse-1">
			<ul class = "nav navbar-nav">
				<li class = "dropdown">
					<a href = "#" class = "dropdown-toggle" data-toggle = "dropdown">物流管理 <span class = "caret"></span></a>
					<ul class = "dropdown-menu" role = "menu">
						<li><a href = "{{ action('AdminFunctionController@getUndispatchedOrders') }}">未发货</a></li>
						<li><a href = "{{ action('AdminFunctionController@getDispatchedOrders')}}">已发货</a></li>
						<li><a href = "{{ action('AdminFunctionController@getUnpaidOrders') }}">未付款</a></li>
					</ul>
				</li>
				<li class = "dropdown">
					<a href = "#" class = "dropdown-toggle" data-toggle = "dropdown">退款申请 <span class = "caret"></span></a>
					<ul class = "dropdown-menu" role = "menu">
						<li><a href = "{{ action('AdminFunctionController@getPendingRefundClaims') }}">未退款</a></li>
						<li><a href = "{{ action('AdminFunctionController@getRefundedClaims')}}">已退款</a></li>
						<li><a href = "{{ action('AdminFunctionController@getRejectedClaims')}}">已驳回</a></li>
					</ul>
				</li>
				<li class = "dropdown">
					<a href = "#" class = "dropdown-toggle" data-toggle = "dropdown">目光之星 <span class = "caret"></span></a>
					<ul class = "dropdown-menu" role = "menu">
						<li><a href = "{{ action('AdminFunctionController@getAmbassadorClaim') }}">返利申请</a></li>
						<li><a href = "{{ action('AdminFunctionController@getProcessedAmbassadorClaim') }}">已返利</a></li>
						<li><a href = "{{ action('AdminFunctionController@getAmbassadorApplication') }}">注册申请</a></li>
						<li><a href = "{{ action('AdminFunctionController@getApprovedAmbassadorApplication') }}">申请成功</a></li>
					</ul>
				</li>
				<li class = "dropdown">
					<a href = "#" class = "dropdown-toggle" data-toggle = "dropdown">用户提问 <span class = "caret"></span></a>
					<ul class = "dropdown-menu" role = "menu">
						<li><a href = "{{ action('AdminFunctionController@getUnansweredQuestion') }}">未回答的问题</a></li>
						<li><a href = "{{ action('AdminFunctionController@getAnsweredQuestion') }}">已回答的问题</a></li>
					</ul>
				</li>
				<li><a href = "{{ action('AdminFunctionController@getNewCoupon') }}">优惠券</a></li>
			</ul>
			<ul class = "nav navbar-nav navbar-right">				
				<li class = "dropdown">
					<a href = "#" class = "dropdown-toggle" data-toggle = "dropdown">
						{{ Session::get('admin.username') }}
						<span class = "caret"></span>
					</a>
					<ul class = "dropdown-menu" role = "menu">
						<li><a href = "#">Action</a></li>
						<li><a href = "#">Another action</a></li>
						<li><a href = "#">Something else here</a></li>
						<li class = "divider"></li>
						<li><a href = "#">Separated link</a></li>
					</ul>
				</li>
				<li><a href = "{{ action('AdminController@getLogout') }}">退出</a></li>
			</ul>
		</div><!--/.navbar-collapse -->
	</div><!--/.container-fluid -->
</nav>
