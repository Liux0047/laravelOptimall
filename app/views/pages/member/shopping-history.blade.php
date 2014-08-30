@extends ('layouts.base')

@section ('content')
<div class="container content-container">
    <div class="page-header">
        <h1>我的目光之城                    
            <small>已购买的商品</small>
        </h1>
    </div>
    <div class="row">
        @include('components.member-account.side-nav', array('entry'=>1))
        <div class="col-xs-12 col-sm-10">
            @if (count($orders))
            @foreach ($orders as $order)
            @include('components.member-account.item-info', array('order'=>$order, 'items'=>$items[$order->order_id],'O_S_LEFTNames'=>$O_S_LEFTNames, 'O_D_RIGHTNames'=>$O_D_RIGHTNames, 'CommonNames'=>$CommonNames))
            @endforeach    
            @else
            您还没有购买任何商品
            @endif

        </div><!--col-md-10-->
    </div><!--/row-->
</div>
@stop