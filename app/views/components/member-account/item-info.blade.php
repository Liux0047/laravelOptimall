<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-4 font-blue">
                <strong>订单号: CN{{ str_pad($order->order_id, 8, "0", STR_PAD_LEFT) }}</strong>
            </div>
            <div class="col-md-3">成交时间: {{ $order->created_at }}
            </div>
            <div class="col-md-2"> 合计: ¥{{ number_format($order->total_transaction_amount, 2) }}
            </div>
            <div class="col-md-2">
                订单状态: 
                @if ($order->order_status == 1)
                订单已提交
                @elseif ($order->order_status == 2)
                已付款
                @elseif ($order->order_status == 3)
                已发货
                @elseif ($order->order_status == 4)
                确认收货
                @endif
            </div>
            <div class="col-md-1"> 
                @if ($order->order_status == 1)
                {{ Form::open(array('action'=>'OrderController@postReSubmitPayment'))}}
                {{ Form::hidden('order_id', $order->order_id)}}
                {{ Form::submit('去付款', array('class'=>'btn btn-warning btn-xs')) }}
                {{ Form::close() }}
                @endif
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3">
                <strong>寄送至:</strong>
                <br>
                {{ $order->receive_address }}, 
                {{ $order->receive_zip }}
                <br>
                {{ $order->recipient_name }} 收
                <br>
                电话: {{ $order->receive_phone }}<br>
            </div>
            <div class="col-md-9">
                <table class="table table-bordered order-summary-table">                                    
                    <thead>
                        <tr class="success">
                            <td width="20%">样品图片</td>
                            <td width="15%">品名</td>
                            <td width="10%">颜色</td>
                            <td width="15%">镜片</td>
                            <td width="10%">单价</td>
                            <td width="10%">订购数量</td>      
                            <td width="20%"></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>
                                {{ HTML::image('images/gallery/'.$item->model.'/'.$item->product.'/medium-view-3.jpg','', array('class'=>'product-img-tiny')) }}
                            </td>
                            <td>{{ $item->model_name_cn }}</td>
                            <td> 
                                {{ HTML::image('images/color/color-'.$item->color.'.png') }}
                                {{ $item->color_name_cn }}
                            </td>
                            <td>{{ $item->lens_title_cn }}</td>
                            <td>¥{{ number_format($item->price+$item->lens_price, 2) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>
                                @if($item->is_plano)
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
                                                @include('components.order-page.prescription-table', array('prescription'=>$item, 'O_S_LEFTNames'=>$O_S_LEFTNames, 'O_D_RIGHTNames'=>$O_D_RIGHTNames,'CommonNames'=>$CommonNames))     
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
            </div>
        </div>
    </div>
</div>