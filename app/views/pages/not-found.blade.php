@extends ('layouts.base')

@section ('content')
<div class="container content-container">
    <div class="page-header">
        <h1>
            很抱歉，您要查看的页面不存在!
        </h1>
    </div>

    <p>
        {{ HTML::image('images/404.jpg')}}
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">目光之城为您推荐</div>
        <div class="panel-body shop-items-container">
            <div class="row row-narrow">
                @foreach ($models as $model)
                @include ('components.product-page.product-card', array('model'=>$model))
                @endforeach
            </div>
        </div>
    </div>


</div>
@stop

@section('link-script')
@parent
{{ HTML::script('plugins/raty-2.7.0/jquery.raty.js') }}
@stop

@section("script")
@parent
@include('components.product-page.product-card-js')
@stop
