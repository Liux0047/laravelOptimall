<div class="modal fade" id="add_review_{{ $item->order_line_item_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">添加评论</h4>
            </div>
            <div class="modal-body">              
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">舒适 </div>
                        <div class="col-md-10">
                            <div class="raty-star-input" id="score_comfort_{{ $item->order_line_item_id }}" data-scoreName="score_comfort"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">外观 </div>
                        <div class="col-md-10">
                            <div class="raty-star-input" id="score_design_{{ $item->order_line_item_id }}" data-scoreName="score_design"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">质量 </div>
                        <div class="col-md-10">
                            <div class="raty-star-input" id="score_quality_{{ $item->order_line_item_id }}" data-scoreName="score_quality"></div>                                    
                        </div>                        
                    </div>                    
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="title" name="title" placeholder="小标题（不超过45字）">
                </div>
                <div class="form-group">
                    <textarea class="form-control" id="content" name="content" rows="3" placeholder="评论内容（不超过200字）"></textarea>
                </div>
            </div><!-- /.modal-body -->
            <div class="modal-footer">                                            
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <input type="submit" class="btn btn-primary" value="确认">
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->