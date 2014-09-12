<tr>
    <td class="col-md-4">
        <div class="row">
            <div class="col-md-6">
                <a href="{{ action('ProductController@getProduct', array($item->model_id)) }}">
                    {{ HTML::image('images/gallery/'.$item->model_id.'/'.$item->product_id.'/medium-view-3.jpg', "Product Image", array('class' => 'shopping-cart-img')) }}
                </a>
            </div>
            <div class="col-md-6 shopping-cart-item-info">
                <h4>
                    <a href="{{ action('ProductController@getProduct', array($item->model_id)) }}">
                        <strong class="font-black">{{ $item->model_name_cn }}</strong>
                    </a>
                </h4>
                <p>颜色:
                    {{ HTML::image('images/color/color-'.$item->product_color_id.'.png') }}
                    {{ $item->color_name_cn }} 
                    <br>
                    镜片: {{ $item->lens_title_cn }}
                    <br>
                    单价: ¥{{ number_format($item->price, 2) }}      
                </p>
                <span class="label label-warning">销量优先</span>
            </div>
        </div>
    </td>
    <td class="col-md-4">
        @if (!$isPrescriptionRequired[$item->order_line_item_id])
        @if($item->is_plano)
        <h5><strong>平光镜 </strong></h5>
        <br>
        <a class="" data-toggle="modal" href="#prescription_modal_{{ $item->order_line_item_id }}">
            <i class="fa fa-edit fa-lg"></i> 
            修改验光单
        </a> 
        @else
        <h5><strong>无镜片(送衬片) </strong></h5>
        @endif        
        @elseif($isPrescriptionEntered[$item->order_line_item_id])
        @include('components.order-page.prescription-table', array('prescription' => $item, 'prescriptionNames'=>$prescriptionNames))
        <a class="pull-left" data-toggle="modal" href="javascript:document.getElementById('plano_form_{{ $item->order_line_item_id }}').submit();">
            使用平光镜
        </a>
        {{ Form::open(array('action' => 'ShoppingCartController@postSetPlano', 'id'=>'plano_form_'.$item->order_line_item_id)) }}
        {{ Form::hidden('order_line_item_id',$item->order_line_item_id) }}
        {{ Form::close() }}
        <a class="pull-right" data-toggle="modal" href="#prescription_modal_{{ $item->order_line_item_id }}">
            <i class="fa fa-edit fa-lg"></i> 修改验光单
        </a>
        @else
        <div class="btn-group">
            <a class="btn btn-primary btn-sm" data-toggle="modal" href="#prescription_modal_{{ $item->order_line_item_id }}">
                <i class="fa fa-edit fa-lg"></i> 填写验光单
            </a>
            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li>
                    <a href="javascript:document.getElementById('plano_form_{{ $item->order_line_item_id }}').submit();">
                        使用平光镜
                    </a>
                </li>
                {{ Form::open(array('action' => 'ShoppingCartController@postSetPlano', 'id'=>'plano_form_'.$item->order_line_item_id)) }}
                {{ Form::hidden('order_line_item_id',$item->order_line_item_id) }}
                {{ Form::close() }}
                @foreach($storedPrescriptions as $storedPrescription)
                <li>
                    <a href="javascript:$('#stored_pres_form_{{ $storedPrescription->prescription_id }} form').submit();"
                        id="stored_pres_popover_{{ $storedPrescription->prescription_id }}">
                        使用验光单:
                        <strong>{{ $storedPrescription->name }}</strong>
                    </a>
                </li>        
                {{-- generate the form to be submitted --}}
                <div id="stored_pres_form_{{ $storedPrescription->prescription_id }}" class="hidden">
                    {{ Form::open(array('action' => 'ShoppingCartController@postUpdatePrescription')) }}
                    {{ Form::hidden('order_line_item_id', $item->order_line_item_id) }}
                    @foreach ($prescriptionNames['O_S_LEFTNames'] as $O_S_LEFTName)
                    {{ Form::hidden( $O_S_LEFTName, $storedPrescription->$O_S_LEFTName) }}
                    @endforeach
                    @foreach ($prescriptionNames['O_D_RIGHTNames'] as $O_D_RIGHTName)
                    {{ Form::hidden($O_D_RIGHTName, $storedPrescription->$O_D_RIGHTName) }}
                    @endforeach
                    @foreach ($prescriptionNames['CommonNames'] as $CommonName)
                    {{ Form::hidden($CommonName, $storedPrescription->$CommonName) }}
                    @endforeach
                    {{ Form::close() }}
                    @include('components.order-page.prescription-table', array( 'prescription' => $storedPrescription, 'prescriptionNames'=>$prescriptionNames))    
                </div>
                @endforeach
                <li>
                    <a data-toggle="modal" href="#prescription_modal_{{ $item->order_line_item_id }}">
                        <i class="fa fa-plus"></i> 添加验光单
                    </a>
                </li>
            </ul>
            
        </div>
        @endif

        @if($isPrescriptionRequired[$item->order_line_item_id] || $item->is_plano)
        {{ Form::open(array('action' => 'ShoppingCartController@postUpdatePrescription', 'id'=>'prescription_form_'.$item->order_line_item_id, 'novalidate'=>'novalidate', 'class'=>'form-horizontal', 'role'=>'form')) }}
        {{ Form::hidden('order_line_item_id', $item->order_line_item_id)}}
        @include('components.order-page.prescription-modal', array('order_line_item_id' => $item->order_line_item_id,'prescriptionNames'=>$prescriptionNames,'prescriptionOptions' => $prescriptionOptions))
        {{ Form::close() }}
        @endif
    </td>
    <td class="col-md-2">
        <a href="javascript:updateQuantity({{ $item->order_line_item_id }},'decrement')">
            <i class="fa fa-minus-circle fa-lg"></i>
        </a>
        <span id="quantity_{{ $item->order_line_item_id }}" class="quantity-cell">
            {{ $item->quantity }}
        </span>
        <a href="javascript:updateQuantity({{ $item->order_line_item_id }},'increment')">
            <i class="fa fa-plus-circle fa-lg"></i>
        </a>

    </td>
    <td class="col-md-1">
        <span class="shopping-cart-price" id="item_total_{{ $item->order_line_item_id }}">
            ¥{{ number_format(($item->price+$item->lens_price)* $item->quantity, 2) }}
        </span>
    </td>
    <td class="col-md-1">
        {{ Form::open(array('action' => 'ShoppingCartController@postRemoveItem', 'id'=>'remove_'.$item->order_line_item_id)) }}        
        {{ Form::hidden('order_line_item_id', $item->order_line_item_id) }}
        <a data-toggle="modal" href="#confirm_remove_{{ $item->order_line_item_id }}">
            <i class="fa fa-trash-o fa-lg"></i>
        </a>
        <div class="modal fade" id="confirm_remove_{{ $item->order_line_item_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">删除</h4>
                    </div>
                    <div class="modal-body">
                        <p>
                            <i class="fa fa-exclamation-triangle fa-lg"></i>
                            确认要从购物车中删除这件商品吗？ 
                        </p>
                        <input type="submit" class="btn btn-danger btn-sm" value="确认">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">取消</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        {{ Form::close() }}
    </td>
</tr>
