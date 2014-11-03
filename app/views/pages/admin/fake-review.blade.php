@extends ('layouts.admin-base')

@section ('content')
<div class="container content-container content-no-header">
    <div class="page-header">
        @include('components.page-frame.message-bar')
        <h1>
            {{ $pageTitle }}
        </h1>
    </div>

    {{ Form::open(array('action'=>'AdminFunctionController@postFakeReview', 'onsubmit'=>'return confirmSubmit();')) }}
    	<div class="form-group">
    		<label for="email">Member email</label>
    		<input type="email" class="form-control" name="email" placeholder="Email">
    	</div>
    	<div class="form-group">
    		<label for="password">Password</label>
    		<input type="text" class="form-control" name="password" value="test123" placeholder="Password">
    	</div>
    	<div class="form-group">
    		<label for="nickname">Member nickname</label>
    		<input type="text" class="form-control" name="nickname" placeholder="nickname">
    	</div>
    	<div class="form-group">
    		<label for="model_id">Model ID</label>
    		<input type="text" class="form-control" name="model_id" placeholder="Model ID (eg. 3001)">
    	</div>
    	<div class="form-group">
    		<label for="title">Title</label>
    		<input type="text" class="form-control" name="title" placeholder="Review title">
    	</div>
    	<div class="form-group">
    		<label for="design_rating">Design Rating</label>
    		<input type="number" min="0" max="5" class="form-control" name="design_rating" value="5" placeholder="0-5">
    	</div>
    	<div class="form-group">
    		<label for="comfort_rating">Comfort Rating</label>
    		<input type="number" min="0" max="5" class="form-control" name="comfort_rating" value="5" placeholder="0-5">
    	</div>
    	<div class="form-group">
    		<label for="quality_rating">Quality Rating</label>
    		<input type="number" min="0" max="5" class="form-control" name="quality_rating" value="5" placeholder="0-5">
    	</div>
    	<div class="form-group">
    		<label for="content">Content</label>
    		<textarea class="form-control" rows="3" name="content"></textarea>
    	</div>

    	<button type="submit" class="btn btn-primary">Submit</button>
    {{ Form::close() }}

</div>
@stop

@section('script')
@parent
<script type="text/javascript">
function confirmSubmit () {
    return confirm('确认添加评论?');
}

function confirmPresent () {
    return confirm('确认展示该问题?');
}


</script>
@stop