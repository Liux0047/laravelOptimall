<div class="no-display ajax-load-container">
@foreach ($models as $model)
@include('components.product-page.product-card', array('model' => $model, 'products' => $products[$model->model_id]))
@endforeach
</div>
<script type="text/javascript">
@if ($disable)
$("#load_more_btn").prop('disabled', true);
$("#load_more_btn").addClass('disabled');
@endif

</script>