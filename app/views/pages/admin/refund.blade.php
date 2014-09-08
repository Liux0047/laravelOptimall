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
                <th>退款金额</th>
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
                {{ $refund->orderLineItemView->price }} + {{ $refund->orderLineItemView->lens_price }}(镜片)
            </td>
            <td>
                @if($refund->orderLineItemView->placedOrder->coupon()->count())
                {{ $refund->orderLineItemView->placedOrder->coupon->coupon_code }} <br>
                @if ($refund->orderLineItemView->placedOrder->coupon->discount_type_id == 1)
                减金额
                @elseif($refund->orderLineItemView->placedOrder->coupon->discount_type_id == 2)
                打折
                @else
                无效
                @endif
                {{ $refund->orderLineItemView->placedOrder->coupon->discount_value }}
                @endif
            </td>
            <td>
                {{ $refund->amount }}
            </td>
            <td>
                <a href="#refund_image_{{ $refund->order_line_item_id }}" data-toggle="modal">
                    查看图片
                </a>
                <div class="modal fade" id="refund_image_{{ $refund->order_line_item_id }}">
                    <div class="modal-dialog"> 
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title">退款申请人上传的图片</h4>
                            </div>
                            <div class="modal-body">
                                {{ HTML::image('images/uploads/refunds/'.$refund->order_line_item_id.'.jpg') }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

            </td>
            <td>
                {{ Form::open(array('action'=>'AdminFunctionController@postRefund', 'onsubmit'=>'return confirmChangeStatus();'))}}
                {{ Form::hidden('refund_id', $refund->refund_id)}}
                @if($refund->refund_status_id == 1)
                <input type="number" name="amount">
                {{ Form::submit('批准申请', array('class'=>'btn btn-warning')) }}
                @elseif($refund->refund_status_id == 2)
                {{ Form::submit('确认收到退货', array('class'=>'btn btn-warning')) }}
                @elseif ($refund->refund_status_id == 3)
                {{ Form::submit('确认退款成功', array('class'=>'btn btn-warning')) }}
                @elseif ($refund->refund_status_id == 4)
                退款成功
                @else
                Invalid order_status_id
                @endif
                {{ Form::close() }}
            </td>
        </tr>

        @endforeach
    </table>

    {{  $refunds->links() }}

</div>
@stop

@section('script')
@parent
<script type="text/javascript">
function confirmChangeStatus () {
    return confirm('确认改变状态?');
}

</script> 
@stop