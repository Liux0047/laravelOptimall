<!-- Modal -->
<div class="modal fade prescription-modal" id="prescription_modal_{{ $order_line_item_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                <th width="21%">
                                    度数(SPH)
                                    <a href="#" class="prescription_popover" data-toggle="popover" data-content="球镜度数指的是近视或者远视矫正度数。减号(-)代表近视，加号(+) 代表远视。 如果“PL”或者“Plano”写在你的验光单上，它代表相应眼镜是0度。" data-placement="right">
                                        <i class="fa fa-info-circle fa-lg"></i>
                                    </a>
                                </th>
                                <th width="21%">
                                    散光(CYL)
                                    <a href="#" class="prescription_popover" data-toggle="popover" data-content="散光指的是散光度数。它也可以是正数或者是负数。如果“DS” 或者“SPH” 出现在散光的空格内，说明您某眼没有散光。相应地，你在此处选择0.00，在后面相应的Axis也选择0。" data-placement="right">
                                        <i class="fa fa-info-circle fa-lg"></i>
                                    </a>
                                </th>
                                <th width="21%">
                                    轴位(AXIS)
                                    <a href="#" class="prescription_popover" data-toggle="popover" data-content="轴位代表散光的方向，数值介于1到180。如果一只眼睛有散光就一定有相对的轴位。如果散光是0，轴位也就相应是0。" data-placement="left">
                                        <i class="fa fa-info-circle fa-lg"></i>
                                    </a>
                                </th>
                                <th width="21%">
                                    加光(ADD)
                                    <a href="#" class="prescription_popover" data-toggle="popover" data-content="加光的数值代表近距离用眼的度数。它的数值指在远用光度的基础上增加的度数，来解决远近看物体度数不一样的问题(仅适用于渐进眼镜片)。通常左右眼的加光是一样的，所以你的验光单如果只有一个加光，代表的是双眼。" data-placement="left">
                                        <i class="fa fa-info-circle fa-lg"></i>
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th valign="middle">右眼</th>
                                @foreach($prescriptionNames['O_D_RIGHTNames'] as $O_D_RIGHTName)
                                <td valign="middle">                                    
                                    <select name="{{ $O_D_RIGHTName }}" id="{{ $O_D_RIGHTName }}" data-placeholder="请选择" class="chosen-select" style="width:100px;">
                                        @foreach($prescriptionOptions[$O_D_RIGHTName] as $prescriptionOption)
                                        <option value="{{ $prescriptionOption }}" 
                                        @if(isset($item->$O_D_RIGHTName) && ($item->$O_D_RIGHTName == $prescriptionOption) )
                                        selected=true
                                        @endif
                                        >{{ $prescriptionOption }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                @endforeach
                            </tr>
                            <tr>
                                <th valign="middle">左眼</th>
                                @foreach($prescriptionNames['O_S_LEFTNames'] as $O_S_LEFTName)
                                <td valign="middle">
                                    <select name="{{ $O_S_LEFTName }}" id="{{ $O_S_LEFTName }}" data-placeholder="请选择" class="chosen-select" style="width:100px;">
                                        @foreach($prescriptionOptions[$O_S_LEFTName] as $prescriptionOption)
                                        <option value="{{ $prescriptionOption }}" 
                                        @if(isset($item->$O_S_LEFTName) && ($item->$O_S_LEFTName == $prescriptionOption) )
                                        selected=true
                                        @endif
                                        >{{ $prescriptionOption }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                @endforeach
                            </tr>                            
                            <tr class="PD_popover">
                                <th valign="middle">瞳距(cm)
                                    <a href="#" class="prescription_popover" data-toggle="popover" data-content="瞳距是指左右眼瞳孔中心两点间的距离（以毫米为单位），一般验光单上的PD即表示瞳距。大多数人瞳距在54至74毫米之间。" data-placement="right">
                                        <i class="fa fa-info-circle fa-lg"></i>
                                    </a>
                                </th>

                                @foreach($prescriptionNames['CommonNames'] as $CommonName)
                                <td valign="middle">
                                    <select name="{{ $CommonName }}" id="{{ $CommonName }}" data-placeholder="请选择" class="chosen-select" style="width:100px;">
                                        @foreach($prescriptionOptions[$CommonName] as $prescriptionOption)
                                        <option value="{{ $prescriptionOption }}" 
                                        @if(isset($item->$CommonName) && ($item->$CommonName == $prescriptionOption) )
                                        selected=true
                                        @endif
                                        >{{ $prescriptionOption }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                @endforeach
                                <td></td><td></td>
                                <td>
                                    <div class="checkbox">
                                        <lable>
                                            <input type="checkbox" id="enable_add_option" value="1" onchange="toggleAddPrescription({{ $order_line_item_id }});">
                                            我有加光
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div><!-- .panel -->  
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember_prescription" id="remember_prescription" value="1" onchange="togglePresName({{ $order_line_item_id }});">
                        保存我的验光单 
                    </label>
                </div>
                <div class="form-group hidden" id="prescription_user_field">
                    <label class="sr-only" for="prescription_user_field">请给这只验光单起个名字 (20字以内)</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="prescription_name" id="prescription_name" placeholder="请给这只验光单起个名字 (20字以内)">
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