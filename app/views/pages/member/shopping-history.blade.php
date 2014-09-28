@extends ('layouts.base')

@section('link-css')
@parent
{{ HTML::style('plugins/raty-2.7.0/jquery.raty.css') }}

@include('components.plugin.jquery-file-upload-css')

@stop

@section ('content')
<div class="container content-container">
    <div class="page-header">
        <h1>我的目光之城                    
            <small>已购买的商品</small>
        </h1>
    </div>
    <div class="row">
        @include('components.member-account.side-nav', array('entry'=>1))
        <div class="col-xs-12 col-sm-10">
            <!-- The file upload form used as target for the file upload widget -->
                            <form id="fileupload" action="" method="POST" enctype="multipart/form-data">
                                <!-- Redirect browsers with JavaScript disabled to the origin page -->
                                <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
                                <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                                <div class="row fileupload-buttonbar">
                                    <div class="col-md-12">
                                        <!-- The fileinput-button span is used to style the file input field as button -->
                                        <span class="btn btn-success fileinput-button">
                                            <i class="glyphicon glyphicon-plus"></i>
                                            <span>Add files...</span>
                                            <input type="file" name="files[]" multiple>
                                        </span>
                                        <button type="submit" class="btn btn-primary start">
                                            <i class="glyphicon glyphicon-upload"></i>
                                            <span>Start upload</span>
                                        </button>
                                        <button type="reset" class="btn btn-warning cancel">
                                            <i class="glyphicon glyphicon-ban-circle"></i>
                                            <span>Cancel upload</span>
                                        </button>
                                        <button type="button" class="btn btn-danger delete">
                                            <i class="glyphicon glyphicon-trash"></i>
                                            <span>Delete</span>
                                        </button>
                                        <input type="checkbox" class="toggle">
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
                            </form>

            @include('components.page-frame.message-bar')
            @if (count($orders))
            @foreach ($orders as $order)
            @include('components.member-account.item-info', array('order'=>$order, 'items'=>$order->orderLineItemViews,'prescriptionNames'=>$prescriptionNames))
            @endforeach    
            @else
            您还没有购买任何商品
            @endif
        </div><!--col-md-10-->
    </div><!--/row-->
</div>
@stop



@section('link-script')
@parent
{{ HTML::script('plugins/jQuery-Validation/jquery.validate.min.js') }}
{{ HTML::script('js/jQuery-Validation-customize.js') }}
{{ HTML::script('plugins/raty-2.7.0/jquery.raty.js') }}
@include('components.plugin.jquery-file-upload-js')
@stop


@section('script')
@parent
<script type="text/javascript">
$(document).ready(function() {
    // validate refund form on keyup and submit
    var warningIcon = "<i class='fa fa-warning fa-lg'></i> ";
    $(".refund-form").each(function() {
        $(this).validate({
            rules: {
                reason: {
                    required: true,
                    maxlength: 150
                }
            },
            messages: {
                reason: {
                    required: warningIcon + "请填写退款理由",
                    maxlength: warningIcon + "请不要超过150字"
                }
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                error.appendTo($(element).parent());
            },
            validClass: "",
            errorClass: "jq-validate-error",
            //ignore: [], //validate hidden input
            onkeyup: function(element) {
                $(element).valid();
            },
            onfocusout: function(element) {
                $(element).valid();
            },
            //onkeyup: true,
            //onfocusout: true,
            onclick: true
        });
    });
});
</script>

@include('components.member-account.review-modal-js', array('itemId'=>1))
@stop