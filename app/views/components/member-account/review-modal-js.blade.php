<script type="text/javascript">

$(document).ready(function() {
    var warningIcon = "<i class='fa fa-warning fa-lg'></i> ";
    //validate review form
    $(".review-form").each(function() {
        $(this).validate({      
            rules: {
                title: {
                    required: true,
                    maxlength: 45
                },
                content: {
                    required: true,
                    maxlength: 200
                },
                score_comfort: "required",
                score_design: "required",
                score_quality: "required"
            },
            messages: {
                title: {
                    required: warningIcon + "请输入评论标题",
                    maxlength: warningIcon + "请不要超过字符上限(45)"
                },
                content: {
                    required: warningIcon + "请输入评论内容",
                    maxlength: warningIcon + "请不要超过字符上限(200)"
                },
                score_comfort: {
                    required: warningIcon + "请选择分数"
                },
                score_design: {
                    required: warningIcon + "请选择分数"
                },
                score_quality: {
                    required: warningIcon + "请选择分数"
                }                
            },
            errorElement: "p",
            errorPlacement: function(error, element) {
                error.appendTo($(element).parent());
            },
            validClass: "",
            errorClass: "jq-validate-error",
            //ignore: [], //uncomment to validate hidden input
            onclick: true   
        });
});

    //enable raty function 
    $(".raty-star-input").raty({ 
        path: "{{ asset('plugins/raty-2.7.0/images') }}", 
        halfShow : false,
        scoreName: function() {
            return $(this).attr('data-scoreName');
        },
        score: 5
    });

    //initialize jQuery File Upload
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: '{{ action('UploadController@anyReviewImage', array('item_id' => '3')) }}',
        maxFileSize: '{{ Config::get('optimall.maxImageUploadSize') * 1024 * 1024 }}'
    });

});
</script>