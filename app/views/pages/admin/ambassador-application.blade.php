@extends ('layouts.admin-base')

@section ('content')
<div class="container content-container content-no-header">
    <div class="page-header">
        @include('components.page-frame.message-bar')
        <h1>
            {{ $pageTitle }}
        </h1>
    </div>
    
    <table class="table table-hover">
        <thead>
            <tr>
                <th>申请人(目光之星)</th>                
                <th>支付账号</th>
                <th>申请时间</th>
                <th>手机号</th>
                <th>计划</th>
                <th>是否批准</th>
            </tr>
        </thead>
        @foreach($applications as $application)
        <tr>     
            <td>                
                {{ $application->nickname }}<br>
                {{ $application->email }}
            </td>    
            <td>
                {{ $application->alipay_account }}
            </td>
            <td>
                {{ formateDateTime($application->created_at) }}
            </td>
            <td>
                {{ $application->mobile_phone }}
            </td>
            <td >
                {{ $application->ambassador_plan }}
            </td>
            <td>
                @if(!$application->is_approved_ambassador)
                {{ Form::open(array('action'=>'AdminFunctionController@postAmbassadorApplication', 'onsubmit' =>'return confirmChangeStatus();' ))}}    
                {{ Form::hidden('member_id', $application->member_id)}}
                {{ Form::submit('同意申请', array('class'=>'btn btn-primary')) }}
                {{ Form::close()}}
                @else
                已批准
                @endif
            </td>
        </tr>

        @endforeach
    </table>

    {{  $applications->links() }}

</div>
@stop

@section('script')
@parent
<script type="text/javascript">
function confirmChangeStatus () {
    return confirm('确认改变状态?');
}


</script> 
@stop