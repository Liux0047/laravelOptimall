@extends ('layouts.base')

@section ('content')
<div class="container content-container">
    <div class="page-header">
        <h1>
            我的验光单                    
            <small>我的验光单</small>
        </h1>
    </div>
    <div class="row">
        @include('components.member-account.side-nav', array('entry'=>3))
        <div class="col-xs-12 col-md-6">    

            @include('components.page-frame.message-bar')

            @foreach($prescriptions as $prescription)
            <h4>{{ $prescription->name }}</h4>
            <hr>
            @include('components.order-page.prescription-table', array('prescription'=>$prescription, 'prescriptionNames'=>$prescriptionNames))  

            <div class="pull-right">
                {{ Form::open(array('action'=>'MemberAccountController@postDeletePrescription')) }}
                {{ Form::hidden('prescription_id', $prescription->prescription_id) }}
                <a data-toggle="modal" href="#confirm-remove-{{ $prescription->prescription_id }}">
                    <i class="fa fa-times"></i> 删除此验光单
                </a>        
                <div class="modal fade align-center" id="confirm-remove-{{ $prescription->prescription_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="myModalLabel">删除此验光单</h4>
                            </div>
                            <div class="modal-body">
                                <p>
                                    <i class="fa fa-exclamation-triangle fa-lg"></i>
                                    确定要删除此验光单吗？                        
                                </p>                        
                                <input type="submit" class="btn btn-danger btn-sm" value="确认">
                                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">取消</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                {{ Form::close() }}
            </div>
            <br><br>       
            @endforeach         
        </div>
    </div>
</div>
@stop