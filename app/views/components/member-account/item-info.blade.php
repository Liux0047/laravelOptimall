<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-3 font-blue">
                <strong>订单号: {{ generateTradeNumber($order->order_id) }}</strong>
            </div>
            <div class="col-md-3">成交时间: {{ formatDateTime($order->created_at) }}
            </div>
            <div class="col-md-2"> 合计: <span class="rmb-sign">￥</span>{{ number_format($order->total_transaction_amount, 2) }}
            </div>
            <div class="col-md-3">
                订单状态: 
                @if ($order->order_status_id == 1)
                订单已提交
                @elseif ($order->order_status_id == 2)
                已付款
                @elseif ($order->order_status_id == 3)
                已发货
                @elseif ($order->order_status_id == 4)
                确认收货
                @endif
            </div>
            <div class="col-md-1"> 
                @if ($order->order_status_id == 1)
                {{ Form::open(array('action'=>'OrderController@postReSubmitPayment'))}}
                {{ Form::hidden('order_id', $order->order_id)}}
                {{ Form::hidden('payment_service', $order->payment_method) }}
                {{ Form::submit('去付款', array('class'=>'btn btn-warning btn-xs')) }}
                {{ Form::close() }}
                @endif
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3">
                <p>
                    <strong>寄送至:</strong>
                    <br>
                    {{ $order->receive_address }},
                    {{ $order->receive_zip }}
                    <br>
                    {{ $order->recipient_name }} 收
                    <br>
                    电话: {{ $order->receive_phone }}
                </p>

                <a href="#shipping_info_{{ $order->order_id }}" data-toggle="modal" data-target="#shipping_info_{{ $order->order_id }}">查看物流信息</a>

                <div class="modal fade shipping-info-modal" id="shipping_info_{{ $order->order_id }}"  tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel" aria-hidden="true"
                    data-shipping-track-num="{{ $order->shipping_track_num }}" data-shipping-company="{{ $order->shipping_company }}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title">物流信息</h4>
                            </div>
                            <div class="modal-body">
                                <p>One fine body&hellip;</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

            </div>
            <div class="col-md-9">
                <table class="table table-bordered order-summary-table">                                    
                    <thead>
                        <tr class="success">
                            <td width="20%">样品图片</td>
                            <td width="10%">品名</td>
                            <td width="15%">颜色</td>
                            <td width="15%">镜片</td>
                            <td width="10%">单价</td>
                            <td width="10%">订购数量</td>      
                            <td width="20%">商品操作</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>
                                <a href="{{ action('ProductController@getProduct', [$item->model_id]) }}">
                                    {{ HTML::image('images/gallery/'.$item->model_id.'/'.$item->product_id.'/'.Config::get('optimall.smallViewImg'),'', array('class'=>'item-small-view')) }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ action('ProductController@getProduct', [$item->model_id]) }}">
                                    {{ $item->model_name_cn }}
                                </a>
                            </td>
                            <td> 
                                {{ HTML::image('images/color/color-'.$item->product_color_id.'.png') }}
                                {{ $item->color_name_cn }}
                            </td>
                            <td>{{ $item->lens_title_cn }}</td>
                            <td><span class="rmb-sign">￥</span>{{ number_format($item->price+$item->lens_price, 2) }}</td>
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

                                {{-- enable review and refund modal if status more than paid --}}
                                @if($order->order_status_id > 1)
                                @if(!isset($item->review_id))       
                                <p>
                                    <a href="{{ action('ProductController@getProduct', array($item->model_id)).'?show_review='.urlencode('1') }}">
                                        <i class="fa fa-pencil"></i> 添加评论
                                    </a>        
                                </p>
                                @endif

                                @if(!isset($item->refund_id))
                                <p>
                                    <a href="#" data-toggle="modal" data-target="#refund_{{ $item->order_line_item_id }}" >
                                        <i class="fa fa-bullhorn"></i> 申请退款
                                    </a>
                                </p>        
                                {{ Form::open(array('action'=>'MemberAccountController@postClaimRefund', 'class'=>'refund-form','files'=>true)) }}
                                {{ Form::hidden('order_line_item_id', $item->order_line_item_id) }}
                                <div class="modal fade" id="refund_{{ $item->order_line_item_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
                                    <div class="modal-dialog" >
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title">退款申请表</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="quantity">退货数量: </label>
                                                    <select class="form-control" name="quantity">
                                                        @for($i=1; $i<= $item->quantity; $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                        @endfor                                                  
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="reason">退货原因: </label>
                                                    <textarea class="form-control" rows="3" name="reason" placeholder="150字以内"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="reason">附图(2M以内, jpg格式): </label>
                                                    {{ Form::file('photo') }}
                                                </div>                                                
                                                <p>
                                                    注：
                                                </p>
                                                <ol>
                                                    <li>一个订单只享受一次退换货服务，所以为了确保您的权益，请您谨慎考虑后与我们联系。</li>
                                                    <li>优惠促销产品退货时,我们将按照该商品优惠后实际支付金额退款。</li>
                                                    <li>
                                                        收到您的退货，客服人员会在1-2个工作日内为您办理退换，并及时通知您。<br><br>
                                                        **更多详细信息请看<a href="{{ url('info/about-products#gouwubaozhang-2') }}">《目光之城退换货条例》</a>
                                                    </li>
                                                </ol>
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">关闭</button>
                                                {{ Form::submit('提交申请', array('class'=>'btn btn-primary btn-sm'))}}
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                {{ Form::close()}}
                                @else
                                <p>
                                    <a href="#" data-toggle="modal" data-target="#refund_{{ $item->order_line_item_id }}" >
                                        <i class="fa fa-search-plus"></i> 查看退款详情
                                    </a>
                                    @include('components.member-account.refund-info-modal', array('item'=>$item))
                                </p>
                                @endif
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


