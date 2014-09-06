<div class="no-display ajax-load-container">
@foreach ($models as $model)
@include('components.product-page.product-card', array('model' => $model))
@endforeach
</div>
<script type="text/javascript">
@if (!$disable)
$("#load_more_btn").prop('disabled', false);
@endif

</script>