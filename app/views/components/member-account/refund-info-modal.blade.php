<div class="modal fade" id="refund_{{ $item->order_line_item_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">退款状态</h4>
            </div>
            <div class="modal-body">
                <ol class="progtrckr" data-progtrckr-steps="4">    
                    <li class='progtrckr-done'>提交申请</li>@if ( $item->is_approved)<li class='progtrckr-done'>@else <li class='progtrckr-todo'>@endif 客服确认</li>@if ( $item->is_goods_returned)<li class='progtrckr-done'>@else <li class='progtrckr-todo'>@endif 寄回商品</li>@if ( $item->is_refunded)<li class='progtrckr-done'>@else <li class='progtrckr-todo'> @endif 收货退款</li>    
                </ol>
                <br>
                <p>退货数量: {{ $item->refund_quantity }}</p>
                <p>退货原因: {{ $item->refund_reason }}</p>
                <p>
                    @if(file_exists('images/uploads/refunds/'.$item->order_line_item_id.'.jpg')) 
                    {{ HTML::image('images/uploads/refunds/'.$item->order_line_item_id.'.jpg')}}
                    @else
                    没有图片上传
                    @endif
                    
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">关闭</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->