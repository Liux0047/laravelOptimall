@extends ('layouts.admin-base')

@section ('content')
<div class="container content-container content-no-header">
    <div class="page-header">
        @include('components.page-frame.message-bar')
        <h1>
            {{ $pageTitle }}
        </h1>
    </div>
    @foreach($orders as $order)
    <div class="panel panel-primary">
        <!-- Default panel contents -->
        <div class="panel-heading">
            订单号: {{ $order->order_id }}            
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <p>
                        订货会员: {{ $order->member->nickname }} ({{ $order->member->email }})
                    </p>
                    <p>
                        订单总额: {{ $order->total_transaction_amount }} {{ $order->currency_code }} 
                    </p>
                    <p>
                        订货时间: {{ $order->created_at }}
                    </p>
                    <p>
                        发票抬头: {{ $order->invoice_header }}
                    </p>
                    <p>
                        买家留言: {{ $order->message_to_seller }}
                    </p>
                </div>
                <div class="col-md-4">
                    <p>
                        订单收货地址: {{ $order->receive_address }}
                    </p>   
                    <p>
                        邮编: {{ $order->receive_zip }}
                    </p>   
                    <p>
                        收货人: {{ $order->recipient_name }}
                    </p>   
                    <p>
                        电话或手机 {{ $order->receive_phone }}
                    </p>                    
                </div>
                <div class="col-md-4">
                    @if ($order->order_status_id >= 2)
                    <p>
                        支付方式： {{ $order->peyment_method }}
                    </p>
                    <p>
                        支付时间： {{ $order->peyment_time }}
                    </p>
                    <p>
                        付款总额: {{ $order->peyment_method }}
                    </p>
                    <p>
                        交易号: {{ $order->peyment_ref_no }}
                    </p>
                    @else
                    <span class="font-orange">未付款</span>
                    @endif
                </div>
            </div>
            
        </div>

        <!-- Table -->
        <table class="table table-bordered order-summary-table">                                    
            <thead>
                <tr class="active">
                    <td width="15%">样品图片</td>
                    <td width="10%">品名</td>
                    <td width="10%">货号</td>
                    <td width="10%">颜色</td>
                    <td width="15%">镜片</td>
                    <td width="10%">单价</td>
                    <td width="10%">订购数量</td>      
                    <td width="20%">验光单</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderLineItemViews as $item)
                <tr>
                    <td>
                        {{ HTML::image('images/gallery/'.$item->model_id.'/'.$item->product_id.'/medium-view-3.jpg','', array('class'=>'item-small-view')) }}
                    </td>
                    <td>{{ $item->model_name_cn }}</td>
                    <td>{{ $item->model_code }}</td>
                    <td> 
                        {{ HTML::image('images/color/color-'.$item->product_color_id.'.png') }}
                        {{ $item->color_name_cn }}
                    </td>
                    <td>{{ $item->lens_title_cn }}</td>
                    <td>¥{{ number_format($item->price+$item->lens_price, 2) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>
                        @if ($item->lens_type_id == 1)
                        <p>无镜片</p>
                        @elseif($item->is_plano)
                        <p>平光镜</p>
                        @else
                        <p>
                            <a href="#" data-toggle="modal" data-target="#prescription_{{ $item->order_line_item_id }}" >
                                <i class="fa fa-search-plus"></i> 查看验光单
                            </a>
                        </p>
                        <div class="modal fade" id="prescription_{{ $item->order_line_item_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
                            <div class="modal-dialog" >
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title">查看验光单</h4>
                                    </div>
                                    <div class="modal-body">
                                        @include('components.order-page.prescription-table', array('prescription'=>$item, 'prescriptionNames'=>$prescriptionNames))     
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">关闭</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="panel-footer align-right">
            @if ($order->order_status_id == 2)
            {{ Form::open(array('action'=>'AdminFunctionController@postDispatchOrder', 'class'=>'form-inline', 'onsubmit'=>'return confirmDispatch();')) }}
            {{ Form::hidden('order_id', $order->order_id)}}
            <div class="form-group">
                <label class="sr-only" for="shipping_track_num">物流公司运单号</label>
                <input type="text" class="form-control" id="shipping_track_num" name='shipping_track_num' placeholder="物流公司运单号">
            </div>
            <select class="form-control" name="shipping_company">
                <option value="Shun Feng">顺丰</option>
            </select>
            {{ Form::submit('确认发货', array('class'=>'btn btn-warning btn-sm'))}}
            {{ Form::close() }}
            @elseif($order->order_status_id >= 3)
            发货于: {{ $order->dispatched_at }} ( 由 {{ $order->dispatched_by }} 确认发货) 
            @endif
        </div>
    </div>
    @endforeach

    {{  $orders->links() }}


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