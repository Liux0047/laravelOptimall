@extends ('layouts.admin-base')

@section ('content')
<div class="container content-container content-no-header">
    <div class="page-header">
        @include('components.page-frame.message-bar')
        <h1>
            {{ $pageTitle }}
        </h1>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>申请时间</th>
                <th>理由</th>
                <th>数量</th>
                <th>单价</th>
                <th>折扣</th>
                <th>图片</th>
                <th>操作</th>
            </tr>
        </thead>
        @foreach($refunds as $refund)
        <tr>
            <td>
                {{ $refund->created_at }}
            </td>
            <td>
                {{ $refund->reason }}
            </td>
            <td>
                {{ $refund->quantity }}
            </td>
            <td>
                {{ $refund->orderLineItemView->price + $refund->orderLineItemView->lens_price }}
            </td>
            <td>
                {{ HTML::image('images/uploads/refund/'.$refund->order_line_item_id.'.jpg') }}
            </td>
            <td></td>
        </tr>

        @endforeach
    </table>

    {{  $refunds->links() }}
    

    
</div>
@stop

@section('script')
@parent
<script type="text/javascript">
function confirmDispatch () {
    return confirm('确认发货?');
}

</script> 
@stop