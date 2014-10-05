@extends ('layouts.base')

@section('link-css')
@parent
@stop

@section ('content')
<div class="container content-container">
    <div class="page-header">
        @include('components.page-frame.message-bar')
        <h1>
            注册新会员                    
            <small>轻松一点，享受会员特权和及时优惠资讯</small>
        </h1>
    </div>

    <div class="row">
        <div class="col-md-4">
            {{ HTML::image('images/background-images/registration.jpg') }}
        </div>
        <div class="col-md-8">
            {{ Form::open(array('action' => 'MemberController@postSignUp', 'role'=>'form', 'id'=>'registration_form', 
            'novalidate'=>'novalidate', 'class'=>'form-horizontal')) }}            
            <div class="form-group">
                <label for="nickname" class="col-md-2 control-label">昵称*</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="nickname" name="nickname" placeholder="昵称" value="{{ Input::old('nickname') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-md-2 control-label">邮箱*</label>
                <div class="col-md-6">
                    <input type="email" class="form-control mailtip-input" id="email" name="email" placeholder="邮箱" value="{{ Input::old('email') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-md-2 control-label">密码*</label>
                <div class="col-md-6">
                    <input type="password" class="form-control" id="password" name="password" placeholder="密码">
                </div>
            </div>
            <div class="form-group">
                <label for="confirm-password" class="col-md-2 control-label">确认密码*</label>
                <div class="col-md-6">
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="确认密码">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-4">
                    <div class="checkbox">
                        <label for="show_ambassador_code">
                            <input type="checkbox" name="show_ambassador_code" id="show_ambassador_code" onchange="toggleAmbassadorCode();">
                            我被目光之星邀请了
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group no-display" id="ambassador_code_container">
                <label for="ambassador_code" class="col-md-2 control-label">邀请码</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="ambassador_code" name="ambassador_code" placeholder="请输入对方提供的邀请码" {{ Input::old('ambassador_code') }}>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-4">
                    <div class="checkbox">                        
                        <label for="agree_terms">
                            <input type="checkbox" name="agree_terms" id="agree_terms">
                            我同意                                        
                            <a data-toggle="modal" data-target="#terms_modal">目光之城的协议和条款</a>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button type="submit" class="btn btn-primary">注册会员</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>


    <div class="modal fade" id="terms_modal" tabindex="-1" role="dialog" aria-labelledby="terms_modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">目光之城用户注册协议</h4>
                </div>
                <div class="modal-body">
                    <p>尊敬的用户：</p>
                    <p>您好!</p>
                    <p>欢迎您注册成为本站会员! 在注册本网站会员之前，请您先详细阅读用户注册协议!</p>
                    <p>江苏木痕电子商务有限公司旗下目光之城眼镜平台（以下合称“目光之城”）同意按照本协议的规定及其不时发布的操作规则提供基于互联网以及移动网的相关服务，为获得网络服务，服务使用人（以下称“用户”）应当同意本协议的全部条款并按照页面上的提示完成全部的注册程序。用户在进行注册程序过程中点击“同意”按钮即表示用户完全接受本协议项下的全部条款。</p>
                    <p>一、服务条款的接受及更新</p>
                    <p>用户协议规定了您在目光之城眼镜商城拥有的权利、享受的服务以及应履行的义务。目光之城眼镜商城保留在任何时间对该协议的任何一条进行添加、删除、更改的权利，请您留意协议的变动，因为协议更新后，您对目光之城眼镜商城的继续使用将表明您对新条款的接受。您继续使用本网站会被视为同意遵守本协议的条款及其修改。</p>
                    <p>二、用户的权利</p>
                    <p>用户账号及密码</p>
                    <p>您在目光之城眼镜商城注册成功后，将获得一个用户账号及相应的密码。您有权在任何时间和地点利用该账号和密码登录目光之城眼镜商城并进行购买商品的操作。</p>
                    <p>用户隐私制度</p>
                    <p>目光之城眼镜商城承诺尊重和保护用户的个人隐私。</p>
                    <p>享受服务</p>
                    <p>用户有权根据本用户协议的规定以及目光之城眼镜商城上发布的相关条例来发布买家照片，购买商品，评论提问，管理账户，以及使用目光之城眼镜商城提供的任何服务。</p>
                    <p>用户肖像权</p>
                    <p>您对您的买家照片拥有全部的所有权。但是，依据非独家许可协议，通过提交买家秀的方式，您授权目光之城眼镜商城有永久的、世界性的使用、复制、发行、展示您的作品的非排他性许可使用权。对于侵犯他人版权或其他知识产权的用户，目光之城眼镜商城将终止他的账号。如果您认为您的照片被复制，已经构成对您权益的侵犯，请和我们联系，共同商议解决办法。</p>
                    <p>三、用户的义务</p>
                    <p>用户账号及密码的保管</p>
                    <p>用户账号和密码的安全由用户负责;在用户账号下进行的所有活动都应由拥有该账号的用户负法律责任。您同意：</p>
                    <p>（1）如果发现未经授权使用您的账户或密码的行为，立即通知目光之城眼镜商城;</p>
                    <p>（2）请在每次关闭目光之城眼镜商城页之前，确保已从您的账号中退出;</p>
                    <p>（3）不得盗取他人账户，不得假冒其他个人或实体，或伪造与其他个人或实体的关系。</p>
                    <p>如果您未能遵守以上三条条款，目光之城眼镜商城不会对由此产生的损失负责。</p>
                    <p>对传播内容的规定</p>
                    <p>不得以上传、下载、发布、发送邮件或其他方式在目光之城眼镜商城上传播违反国家相关法律法规的任何文字，图片。</p>
                    <p>补偿</p>
                    <p>公共声誉</p>
                    <p>用户不应在目光之城眼镜商城上恶意评价其他用户、诋毁他人名誉。您确认并同意，您不会在公共场合(包括互联网)，利用任何从目光之城眼镜商城订购的产品，来损害目光之城眼镜商城及其董事、雇员、代理商、许可使用人或是合作伙伴的公共声誉。如果您违反了该项协议，目光之城眼镜商城有权要求您立即归还产品以及在法律上采取一切手段进行补救。</p>
                    <p>四、目光之城眼镜商城的权利和义务</p>
                    <p>网站运行及维护</p>
                    <p>目光之城眼镜商城有义务在现有技术上维护整个网上发布平台的正常运行，并努力提升和改进技术，使用户网上各项活动得以顺利进行。</p>
                    <p>客户服务</p>
                    <p>用户在注册、购买、定制、发布等各个环节遇到的问题，目光之城眼镜商城都有责任及时回复解决。</p>
                    <p>编辑网站内容</p>
                    <p>您同意目光之城眼镜商城对您提交的内容进行审查，使其符合我们的原则以及用户协议，并且目光之城眼镜商城有权利删除任何我们认为不妥的内容。目光之城眼镜商城在对您提交的内容进行技术上的使用和操作过程中，可能会为适应网络传输和设备的需要而对您提交的内容进行修改。</p>
                    <p>五、服务的中断和终止</p>
                    <p>您同意目光之城眼镜商城可以自行决定终止您的密码、账户(或其任何部分)，删除您所有相关资料和档案，或者禁止您再次进入本网站。以上行为目光之城眼镜商城可以不用事先通知及征得您的同意。此外，目光之城不对终止您或任何第三方进入本网站承担责任。您如果反对该协议的任何条款或是对目光之城眼镜商城的服务有任何不满之处，可以立即停止使用本站并且终止您的账户。</p>
                    <p>六、链接</p>
                    <p>目光之城眼镜商城可能需要第三方(网站链接、速递公司)来提供一些服务。目光之城眼镜商城不能管理第三方的服务，因此不能向您保证第三方的服务一定可靠。您必须服从第三方公司的条款与规定，如果它们的条款与规定与目光之城眼镜商城的有冲突，以目光之城眼镜商城的条款与规定为准。</p>
                    <p>七、拒绝提供担保</p>
                    <p>您同意由您个人对使用本网站的服务承担风险。目光之城公司明确表示不提供任何类型的担保，不论是明示的或暗示的，包括但不限于任何权利担保、商业性的隐含担保，为特定目的担保以及不侵权的担保。目光之城公司不做如下担保：</p>
                    <p>（1）服务一定能满足您的要求;</p>
                    <p>（2）服务不会受中断，以及服务的及时性、安全性和准确性;</p>
                    <p>（3）产品的质量、服务、信息等等能够达到您的期望值。对于因数据延误造成的丢失，未发出的内容和电子邮件、错误、系统崩溃、传送错误的内容和电子邮件、网络或系统中断或服务中断或是用户自身的错误和疏忽，目光之城公司将不承担责任。</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" onclick="checkTermsAndConditions()">
                        同意
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
@stop

@section("link-script")
@parent
{{ HTML::script('plugins/jQuery-Validation/jquery.validate.min.js') }}
{{ HTML::script('js/jQuery-Validation-customize.js') }}
@stop

@section("script")
@parent
<script type="text/javascript">
$(document).ready(function() {
        // validate signup form on keyup and submit
        var warningIcon = "<i class='fa fa-warning fa-lg'></i> ";
        $("#registration_form").validate({
            rules: {
                nickname: {
                    required: true,
                    maxlength: 15
                },
                email: {
                    required: true,
                    email: true,
                    maxlength: 50
                },
                password: {
                    required: true,
                    passwordCheck: true,
                    minlength: 6,
                    maxlength: 16
                },
                confirm_password: {
                    required: true,
                    equalTo: "#password"
                },
                agree_terms: {
                    required: true
                }
            },
            messages: {
                nickname: {
                    required: warningIcon + "请输入您的昵称",
                    maxlength: warningIcon + "昵称不能超过15个字符"
                },
                email: {
                    required: warningIcon + "请输入您的邮箱",
                    email: warningIcon + "请输入正确的邮箱",
                    maxlength: warningIcon + "邮箱长度不能超过50个字符"
                },
                password: {
                    required: warningIcon + "请输入新密码",
                    minlength: warningIcon + "密码至少需要6位",
                    passwordCheck: warningIcon + "密码必须包括至少一个数字和字母，且不能有其他字符",
                    maxlength: warningIcon + "密码最多20位"
                },
                confirm_password: {
                    required: warningIcon + "请再次输入新密码",
                    equalTo: warningIcon + "两次输入的密码不匹配"
                },
                agree_terms: {
                    required: warningIcon + "请同意我们的条款"
                }
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                error.appendTo($(element).parent().parent());
            },
            success: function(label) {
                label.html("<span class='jq-validate-valid'><i class='fa fa-check-circle fa-lg'></i></span>");
            },
            validClass: "",
            errorClass: "jq-validate-error",
            ignore: [], //validate hidden input
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

function checkTermsAndConditions() {
    document.getElementById('agree_terms').checked = true;
}

function toggleAmbassadorCode(){
    $('#ambassador_code_container').toggle(300);
}

$('#terms_modal').on('show.bs.modal', function() {
    $('.modal-content').css('margin-top', $(window).height() * 0.15);
    $('.modal-body').css('height', $(window).height() * 0.5);
});

</script>
@stop
