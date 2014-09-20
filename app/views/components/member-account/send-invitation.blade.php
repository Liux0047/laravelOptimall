
<div class="invitation-container">
    <div class="page-header">
        <h4>
            邀请您的好友             
            <small>给他（她）一个惊喜</small>
        </h4>
    </div>
    {{ Form::open(array('action'=>'AmbassadorController@postSendInvitation','role'=>'form', 'class'=>'form-horizontal'))}}
    <div class="form-group">
        <label class="col-sm-2 control-label" for="emails">好友邮箱</label>
        <div class="col-md-6">                  
            <input type="text" class="form-control"  name="emails" id="emails" placeholder="请输入您好友的邮箱">
            <p class="help-block">用分号（;）分开发送多人</p>
        </div>
    </div>    
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            {{ Form::submit('立即发送给您好友', array('class'=>'btn btn-primary', 'id'=>'send_invitation_btn', 'disabled'=>true))}}
        </div>
    </div>
    {{ Form::close()}}
</div>