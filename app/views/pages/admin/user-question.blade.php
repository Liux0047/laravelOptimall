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
                <th width="10%">提问用户</th>
                <th width="10%">提问时间</th>
                <th width="30%">问题</th>
                <th width="10%">针对商品</th>
                <th width="40%">回答</th>
            </tr>
        </thead>
        @foreach($questions as $question)
        <tr>     
            <td>                
                {{ $question->member->nickname }}<br>
                {{ $question->member->email }}
            </td>    
            <td>
                {{ formatDateTime($question->created_at) }}
            </td>
            <td>
                {{ $question->question }}
            </td>
            <td >
                {{ $question->model_id }}
            </td>
            <td>
                @if(!isset($question->answer))
                {{ Form::open(array('action'=>'QuestionController@postAnswerQuestion', 'onsubmit' =>'return confirmSubmit();' ))}}
                {{ Form::hidden('question_id', $question->product_question_id)}}
                <div class="form-group">
                    <textarea class="form-control" rows="3" name="answer" placeholder="回答（200字以内）"></textarea>
                </div>
                {{ Form::submit('回答问题', array('class'=>'btn btn-primary pull-right')) }}
                {{ Form::close()}}
                @else
                {{ $question->answer }}
                @if(!$question->is_presentable)
                {{ Form::open(array('action'=>'QuestionController@postPresentQuestion', 'onsubmit' =>'return confirmPresent();' ))}}
                {{ Form::hidden('question_id', $question->product_question_id)}}
                {{ Form::submit('展示问题', array('class'=>'btn btn-primary pull-right')) }}
                {{ Form::close()}}
                @endif
                @endif
            </td>
        </tr>

        @endforeach
    </table>

    {{  $questions->links() }}

</div>
@stop

@section('script')
@parent
<script type="text/javascript">
function confirmSubmit () {
    return confirm('确认回复?');
}

function confirmPresent () {
    return confirm('确认展示该问题?');
}


</script> 
@stop