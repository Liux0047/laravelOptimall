@foreach($items as $item)
<tr>
    <td class="col-md-4">
        <div class="row">
            <div class="col-md-6">
                <img src="/optimall/asset/img/gallery/1001/6/medium-view-3.jpg" class="shopping-cart-img">
            </div><div class="col-md-6 shopping-cart-item-info">
                <h4><strong>{{ $item->model_name_cn }}</strong></h4>
                <p>颜色:
                    {{ HTML::image('images/color/color-'.$item->color.'.png') }}
                    {{ $item->color_name_cn }} 
                    <br>
                    镜片: {{ $item->lens_title_cn }}
                    <br>
                    单价: ¥{{ number_format($item->price, 2) }}
                    <br>
                </p>
                <span class="label label-warning">销量优先</span>
            </div>
        </div>
    </td>
    <td class="col-md-4">
        <div class="btn-group">
            <a class="btn btn-primary btn-sm" data-toggle="modal" href="#prescription_modal_{{ $item->order_line_item_id }}">
                <span class="fa fa-edit fa-lg"></span> 填写验光单
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
                <li>
                    <a data-toggle="modal" href="#prescription_modal_{{ $item->order_line_item_id }}">
                        <i class="fa fa-plus"></i> 添加验光单
                    </a>
                </li>
            </ul>
            {{ Form::open(array('url' => url('shopping-cart'), 'id'=>'plano_form_'.$item->order_line_item_id)) }}
                <input type="hidden" name="order_line_item_id" value="{{ $item->order_line_item_id }}">
                <input type="hidden" name="cart_action" value="{{ $setPlanoAction }}">
            {{ Form::close() }}
        </div>
                
        {{ Form::open(array('url' => url('shopping-cart'), 'id'=>'prescription_form_'.$item->order_line_item_id, 
                    'novalidate'=>'novalidate', 'class'=>'form-horizontal', 'role'=>'form')) }}        
            <input type="hidden" name="order_line_item_id" value="{{ $item->order_line_item_id }}">
            <input type="hidden" name="cart_action" value="{{ $updatePrescriptionAction }}">

            <!-- Modal -->
            <div class="modal fade prescription-modal" id="prescription_modal_{{ $item->order_line_item_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">填写验光单</h4>
                        </div>
                        <div class="modal-body">
                            <div class="panel panel-default">
                                <table class="table" id="prescription-table">
                                    <thead>
                                        <tr class="active">
                                            <th width="16%">
                                            </th>
                                            <th width="21%" class="SPH_popover">
                                                度数(SPH)
                                                <a href="#" data-toggle="popover"
                                                   data-content="球镜度数指的是近视或者远视矫正度数。减号(-)代表近视，加号(+) 代表远视。 如果“PL”或者“Plano”写在你的验光单上，它代表相应眼镜是0度。"
                                                   data-original-title="" title="">
                                                    <i class="fa fa-info-circle fa-lg"></i>
                                                </a>
                                            </th>
                                            <th width="21%" class="CYL_popover">
                                                散光(CYL)
                                                <a href="#" data-toggle="popover"
                                                   data-content="散光指的是散光度数。它也可以是正数或者是负数。如果“DS” 或者“SPH” 出现在散光的空格内，说明您某眼没有散光。相应地，你在此处选择0.00，在后面相应的Axis也选择0。"
                                                   >
                                                    <i class="fa fa-info-circle fa-lg"></i>
                                                </a>
                                            </th>
                                            <th width="21%" class="AXIS_popover">
                                                轴位(AXIS)
                                                <a href="#" data-toggle="popover" data-content="轴位代表散光的方向，数值介于1到180。如果一只眼睛有散光就一定有相对的轴位。如果散光是0，轴位也就相应是0。" >
                                                    <i class="fa fa-info-circle fa-lg"></i>
                                                </a>
                                            </th>
                                            <th width="21%" class="ADD_popover">
                                                加光(ADD)
                                                <a href="#" data-toggle="popover"
                                                   data-content="加光的数值代表近距离用眼的度数。它的数值指在远用光度的基础上增加的度数，来解决远近看物体度数不一样的问题(仅适用于渐进眼镜片)。通常左右眼的加光是一样的，所以你的验光单如果只有一个加光，代表的是双眼。">
                                                    <i class="fa fa-info-circle fa-lg"></i>
                                                </a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th valign="middle">左眼</th>
                                            @foreach($O_S_LEFTNames as $O_S_LEFTName)
                                            <td valign="middle">
                                                <select name="{{ $O_S_LEFTName }}" id="{{ $O_S_LEFTName }}" data-placeholder="请选择" class="chosen-select" style="width:100px;">
                                                    @foreach($prescriptionOptions[$O_S_LEFTName] as $prescriptionOption)
                                                    <option value="{{ $prescriptionOption }}">{{ $prescriptionOption }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <th valign="middle">左眼</th>
                                            @foreach($O_D_RIGHTNames as $O_D_RIGHTName)
                                            <td valign="middle">
                                                <select name="{{ $O_D_RIGHTName }}" id="{{ $O_D_RIGHTName }}" data-placeholder="请选择" class="chosen-select" style="width:100px;">
                                                    @foreach($prescriptionOptions[$O_D_RIGHTName] as $prescriptionOption)
                                                    <option value="{{ $prescriptionOption }}">{{ $prescriptionOption }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            @endforeach
                                        </tr>
                                        <tr class="PD_popover">
                                            <th valign="middle">瞳距(cm)
                                                <a href="#" data-toggle="popover"
                                                   data-content="瞳距是指左右眼瞳孔中心两点间的距离（以毫米为单位），一般验光单上的PD即表示瞳距。大多数人瞳距在54至74毫米之间。"
                                                   data-original-title="" title="">
                                                    <i class="fa fa-info-circle fa-lg"></i>
                                                </a>
                                            </th>

                                            @foreach($CommonNames as $CommonName)
                                            <td valign="middle">
                                                <select name="{{ $CommonName }}" id="{{ $CommonName }}" data-placeholder="请选择" class="chosen-select" style="width:100px;">
                                                    @foreach($prescriptionOptions[$CommonName] as $prescriptionOption)
                                                    <option value="{{ $prescriptionOption }}">{{ $prescriptionOption }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div><!-- .panel -->
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember_prescription" id="remember_prescription" value="1" onchange="togglePresName({{ $item->order_line_item_id }});">
                                            保存我的验光单 <p class="help-block"><small>保存这次填入的验光单以方便您下次使用</small></p>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group hidden" id="prescription_user_field">
                                <label class="sr-only" for="prescription_user_field">请给这只验光单起个名字 (20字以内)</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="prescription_user_name" id="prescription_user_name" placeholder="请给这只验光单起个名字 (20字以内)">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <a href="#" class="pull-left">如何填写验光单</a>
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            <input type="submit" class="btn btn-primary" value="确认">
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        {{ Form::close() }}
    </td>
    <td class="col-md-2">
        <a href="javascript:updateQuantity({{ $item->order_line_item_id }},{{ $decrementQuantityAction }})">
            <i class="fa fa-minus-circle fa-lg"></i>
        </a>
        <span id="quantity_{{ $item->order_line_item_id }}" class="quantity-cell">1</span>
        <a href="javascript:updateQuantity({{ $item->order_line_item_id }},{{ $incrementQuantityAction }})">
            <i class="fa fa-plus-circle fa-lg"></i>
        </a>

    </td>
    <td class="col-md-1">
        <span class="shopping-cart-price" id="item_total_{{ $item->order_line_item_id }}">
            ¥{{ number_format($item->price, 2) }}
        </span>
    </td>
    <td class="col-md-1">
        {{ Form::open(array('url' => url('shopping-cart'), 'id'=>'remove_'.$item->order_line_item_id)) }}        
            <input type="hidden" name="order_line_item_id" value="{{ $item->order_line_item_id }}">
            <input type="hidden" name="cart_action" value="{{ $removeItemAction }}">
            <a data-toggle="modal" href="#confirm-remove-{{ $item->order_line_item_id }}">
                <i class="fa fa-trash-o fa-lg"></i>
            </a>
            <div class="modal fade" id="confirm-remove-{{ $item->order_line_item_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
@endforeach
