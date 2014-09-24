<div class="invitation-container">
    <div class="page-header">
        <h4>
            邀请您的好友             
            <small>给他（她）一个惊喜</small>
        </h4>
    </div>
    {{ Form::open(array('action'=>'AmbassadorController@postSendInvitation','role'=>'form', 'class'=>'form-horizontal','id'=>'invitation_form'))}}
    <div class="form-group">
        <label class="col-sm-2 control-label" for="email">好友邮箱</label>
        <div class="col-md-6">                  
            <input type="email" class="form-control"  name="email" id="email" placeholder="请输入您好友的邮箱">
        </div>
    </div>    
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            {{ Form::submit('立即发送给您好友', array('class'=>'btn btn-primary', 'id'=>'send_invitation_btn'))}}
        </div>
    </div>
    {{ Form::close()}}
</div>