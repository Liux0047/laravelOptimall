@if(Session::has('status'))
<div class="alert alert-success alert-dismissable fade in">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <i class="fa fa-check-circle fa-lg"></i> 
    {{ Session::get('status') }}
</div>
@elseif (Session::has('error'))
<div class="alert alert-warning alert-dismissable fade in">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <i class="fa fa-exclamation-circle fa-lg"></i> 
    {{ Session::get('error') }}
</div>
@endif