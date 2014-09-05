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

        <div class="col-md-10">    

            @include('components.page-frame.message-bar')

            <div class="row prescription-chart-container">
                <div class="col-md-5">                    
                    <h4>度数</h4>
                    <canvas id="SPH_chart"></canvas>
                    <div id="SPH_legend"></div>
                </div>                
                <div class="col-md-offset-1 col-md-5">
                    <h4>散光</h4>
                    <canvas id="CYL_chart"></canvas>
                    <div id="CYL_legend"></div>
                </div>
            </div>

            @foreach($prescriptions->reverse() as $prescription)
            <div class="prescription-history-container">
                <div class="page-header">
                    <h4>
                        {{ $prescription->name }}
                        <small> 创建于 {{ (new DateTime($prescription->created_at))->format('Y/m/d') }}</small>
                    </h4>
                </div>

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
            </div>                
            @endforeach      
        </div>
    </div>
</div>
@stop



@section("link-script")
@parent
{{ HTML::script('plugins/Chart-js/chart.min.js') }}
{{ HTML::script('plugins/Chart-js/legend.js') }}
@stop

@section("script")
@parent
<script type="text/javascript">

var labels = ["曾经年少时",
@foreach($prescriptions as $prescription)
"{{ (new DateTime($prescription->created_at))->format('Y/m/d') }}",
@endforeach
]

var O_S_SPHData = [0,
@foreach($prescriptions as $prescription)
{{ $prescription->O_S_SPH }},
@endforeach
]

var O_D_SPHData = [0,
@foreach($prescriptions as $prescription)
{{ $prescription->O_D_SPH }},
@endforeach
]

var O_S_CYLData = [0,
@foreach($prescriptions as $prescription)
{{ $prescription->O_S_CYL }},
@endforeach
]

var O_D_CYLData = [0,
@foreach($prescriptions as $prescription)
{{ $prescription->O_D_CYL }},
@endforeach
]



var SPHData = {
    labels : labels,
    datasets : [
    {
        label: "O_S_SPH dataset",
        fillColor : "rgba(220,220,220,0.2)",
        strokeColor : "rgba(220,220,220,1)",
        pointColor : "rgba(220,220,220,1)",
        pointStrokeColor : "#fff",
        pointHighlightFill : "#fff",
        pointHighlightStroke : "rgba(220,220,220,1)",
        data : O_S_SPHData,
        title : '左眼'
    },
    {
        label: "O_D_SPH dataset",
        fillColor : "rgba(151,187,205,0.2)",
        strokeColor : "rgba(151,187,205,1)",
        pointColor : "rgba(151,187,205,1)",
        pointStrokeColor : "#fff",
        pointHighlightFill : "#fff",
        pointHighlightStroke : "rgba(151,187,205,1)",
        data : O_D_SPHData,
        title : '右眼'
    }
    ]

}

var CYLData = {
    labels : labels,
    datasets : [
    {
        label: "O_S_CYL dataset",
        fillColor : "rgba(220,220,220,0.2)",
        strokeColor : "rgba(220,220,220,1)",
        pointColor : "rgba(220,220,220,1)",
        pointStrokeColor : "#fff",
        pointHighlightFill : "#fff",
        pointHighlightStroke : "rgba(220,220,220,1)",
        data : O_S_CYLData,
        title : '左眼'
    },
    {
        label: "O_D_CYL dataset",
        fillColor : "rgba(151,187,205,0.2)",
        strokeColor : "rgba(151,187,205,1)",
        pointColor : "rgba(151,187,205,1)",
        pointStrokeColor : "#fff",
        pointHighlightFill : "#fff",
        pointHighlightStroke : "rgba(151,187,205,1)",
        data : O_D_CYLData,
        title : '右眼'
    }
    ]

}

$(document).ready(function(){
    var ctx = document.getElementById("SPH_chart").getContext("2d");
    window.myLine = new Chart(ctx).Line(SPHData, {
        responsive: true,
    });

    var ctx = document.getElementById("CYL_chart").getContext("2d");
    window.myLine = new Chart(ctx).Line(CYLData, {
        responsive: true
    });

    legend(document.getElementById("SPH_legend"), SPHData);
    legend(document.getElementById("CYL_legend"), CYLData);
})
</script>       
@stop
