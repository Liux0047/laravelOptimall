{{ Form::open(array('action'=>'ReviewController@postCreateReview', 'class'=>'review-form', 'role'=>'form' ,'id'=>'review_form_'.$itemId)) }}
{{ Form::hidden('order_line_item_id', $itemId) }}

<div class="panel panel-default">
    <div class="panel-heading">我也来评论一发</div>
    <div class="panel-body">

        <div class="form-group">
            <div class="row">
                <div class="col-md-2">舒适 </div>
                <div class="col-md-10">
                    <div class="raty-star-input" id="score_comfort_{{ $itemId }}" data-scoreName="score_comfort"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">外观 </div>
                <div class="col-md-10">
                    <div class="raty-star-input" id="score_design_{{ $itemId }}" data-scoreName="score_design"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">质量 </div>
                <div class="col-md-10">
                    <div class="raty-star-input" id="score_quality_{{ $itemId }}" data-scoreName="score_quality"></div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="title" name="title" placeholder="小标题（不超过45字）">
        </div>
        <div class="form-group">
            <textarea class="form-control" id="content" name="content" rows="3" placeholder="评论内容（不超过200字）"></textarea>
        </div>

        <!-- The file upload form used as target for the file upload widget -->
        <div class="file-upload"  data-item-id="{{ $itemId }}">
            <!-- Redirect browsers with JavaScript disabled to the origin page -->
            <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
            <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
            <div class="row fileupload-buttonbar">
                <div class="col-md-12">
                    <!-- The fileinput-button span is used to style the file input field as button -->
                    <span class="btn btn-success fileinput-button">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>添加图片...</span>
                        <input type="file" name="files[]" multiple>
                    </span>
                    <button type="submit" class="btn btn-primary start">
                        <i class="glyphicon glyphicon-upload"></i>
                        <span>全部上传</span>
                    </button>
                    <!-- The global file processing state -->
                    <span class="fileupload-process"></span>
                </div>
                <!-- The global progress state -->
                <div class="col-lg-5 fileupload-progress fade">
                    <!-- The global progress bar -->
                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                    </div>
                    <!-- The extended global progress state -->
                    <div class="progress-extended">&nbsp;</div>
                </div>
            </div>
            <!-- The table listing the files available for upload/download -->
            <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
        </div>
    </div>
    <div class="panel-footer">
        <div class="align-right">
            <input type="submit" class="btn btn-primary"  value="发布我的评论">
        </div>
    </div>
</div>
{{ Form::close()}}