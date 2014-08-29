<!-- Modal -->
<div class="modal fade" id="{{ $modalId }}" 
	tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">编辑地址</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="province" class="col-md-2 control-label">选择所在地</label>
					<div class="col-md-3">
						<select name="province" id="{{ $fieldPrefix }}_province" class="form-control">                                        
						</select>
					</div>
					<div class="col-md-3">
						<select name="city" id="{{ $fieldPrefix }}_city" class="form-control">
						</select>
					</div>
					<div class="col-md-4">
						<select name="area" id="{{ $fieldPrefix }}_area" class="form-control">
						</select>
					</div>
				</div>                            
				<div class="form-group">
					<label for="postal_code" class="col-md-2 control-label">邮政编码</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="postal_code"  name="postal_code"
						placeholder="邮政编码" 
						value="{{ $address->postal_code }}">
					</div>
				</div>
				<div class="form-group">
					<label for="街道地址" class="col-md-2 control-label">街道地址</label>
					<div class="col-md-10">
						<input type="text" class="form-control" id="街道地址" name="street_name"
						placeholder="街道地址" 
						value="{{ $address->street_name }}">
					</div>
				</div>
				<div class="form-group">
					<label for="收货人姓名" class="col-md-2 control-label">收货人姓名</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="收货人姓名"  name="recipient_name"
						placeholder="收货人姓名" 
						value="{{ $address->recipient_name }}">
					</div>
				</div>
				<div class="form-group">
					<label for="电话" class="col-md-2 control-label">电话</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="phone" name="phone"
						placeholder="电话" 
						value="{{ $address->phone }}">
					</div>
				</div>                                                                
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				<input type="submit" class="btn btn-primary" value="确认">
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
            </div><!-- /.modal -->