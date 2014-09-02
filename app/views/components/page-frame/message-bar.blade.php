@if(Session::has('status'))
<div class="alert alert-success alert-dismissable fade in">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<i class="fa fa-check-circle fa-lg"></i> 
	{{ Session::get('status') }}
</div>
@elseif (Session::has('warning'))
<div class="alert alert-warning alert-dismissable fade in">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<i class="fa fa-exclamation-circle fa-lg"></i> 
	{{ Session::get('error') }}
</div>
@elseif (Session::has('error'))
<div class="alert alert-error alert-dismissable fade in">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<i class="fa fa-exclamation-circle fa-lg"></i> 
	{{ Session::get('error') }}
</div>
@elseif ($errors->has())
<div class="alert alert-danger alert-dismissable fade in">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<i class="fa fa-exclamation-circle fa-lg"></i> 
	@foreach ($errors->all() as $error)
	<div>{{ $error }}</div>
	@endforeach
</div>
@else
@endif