<div class="modal fade" id="refund_{{ $item->order_line_item_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">退款状态</h4>
            </div>
            <div class="modal-body">
                @if($item->refund->is_rejected)
                <div class="alert alert-warning" role="alert">
                    <p><strong>您的退款申请以及被驳回</strong></p>
                    <p>
                        <strong>原因：</strong> 
                        {{ $item->refund->rejection_reason }}
                    </p>
                </div>
                @else
                <ol class="progtrckr" data-progtrckr-steps="4">    
                    <li class='progtrckr-done'>提交申请</li>@if( $item->refund->refund_status_id>=2)<li class='progtrckr-done'>@else<li class='progtrckr-todo'>@endif客服确认</li>@if( $item->refund->refund_status_id>=3)<li class='progtrckr-done'>@else<li class='progtrckr-todo'>@endif寄回商品</li>@if( $item->refund->refund_status_id==4)<li class='progtrckr-done'>@else<li class='progtrckr-todo'>@endif收货退款</li>    
                </ol>
                @endif
                <br>
                <p>退货数量: {{ $item->refund_quantity }}</p>
                <p>退货原因: {{ $item->refund_reason }}</p>
                <p>
                    @if(File::exists('images/uploads/refunds/'.$item->refund_id.'.jpg')) 
                    {{ HTML::image('images/uploads/refunds/'.$item->refund_id.'.jpg')}}
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