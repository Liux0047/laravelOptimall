<!--detailed product info -->
<ul class="nav nav-tabs" role="tablist">
    <li class="active">
        <a href="#detailed_description" role="tab" data-toggle="tab">
            详细描述
        </a>
    </li>
    <li>
        <a href="#lens_description" role="tab" data-toggle="tab">
            镜片描述
        </a>
    </li>
    <li>
        <a href="#prescription_guide" role="tab" data-toggle="tab">
            配镜指南
        </a>
    </li>
    <li>
        <a href="#user_review" role="tab" data-toggle="tab" id="user_review_tab">
            评价
        </a>
    </li>
</ul>

<div class="tab-content">
    <div class="tab-pane fade in active tab-pane-bordered" id="detailed_description">
        <div class="row">
            <div class="col-md-12">

                <img src="{{ asset(Config::get('optimall.lazyloadImg')) }}" 
                data-original="{{ asset('images/gallery/'.$model->model_id.'/spec.jpg') }}"
                class="lazy poster">

                @for ($i=1; $i<=5; $i++)
                @if (File::exists('images/gallery/'.$model->model_id.'/poster-'.$i.'.jpg'))
                <img src="{{ asset(Config::get('optimall.lazyloadImg')) }}" 
                data-original="{{ asset('images/gallery/'.$model->model_id.'/poster-'.$i.'.jpg') }}"
                class="lazy poster">
                @endif
                @endfor

                @for ($i=1; $i<=4; $i++)
                <br>
                <img src="{{ asset(Config::get('optimall.lazyloadImg')) }}" 
                data-original="{{ asset('images/gallery/'.$model->model_id.'/detail-'.$i.'.jpg') }}"
                class="lazy poster">
                @endfor
            </div>
        </div>
    </div>
    <div class="tab-pane fade tab-pane-bordered" id="lens_description">
        <div class="row">
            <div class="col-md-12">
                @for ($i=1; $i<=7; $i++)
                <img src="{{ asset(Config::get('optimall.lazyloadImg')) }}" 
                data-original="{{ asset('images/lens/lens-poster-'.$i.'.jpg') }}"
                class="lazy poster">
                <br>
                @endfor
            </div>
        </div>            
    </div>


    <div class="tab-pane fade tab-pane-bordered" id="prescription_guide">
        <img src="{{ asset(Config::get('optimall.lazyloadImg')) }}" 
        data-original="{{ asset('images/info/beginner-guide/guide.jpg') }}"
        class="lazy poster">
    </div>


    <div class="tab-pane fade" id="user_review">
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="align-center" width="100%">
                    <tr>
                        <td width="30%">
                            <input class="knob" id="overall_rating" value="0">                            
                        </td>
                        <td width="20%"><input class="knob" id="design_rating" value="{{ $model->average_design_rating }}"></td>
                        <td width="20%"><input class="knob" id="comfort_rating" value="{{ $model->average_comfort_rating }}"></td>
                        <td width="20%"><input class="knob" id="quality_rating" value="{{ $model->average_quality_rating }}"></td>
                    </tr>
                    <tr>
                        <td><h4>总体评分</h4></td>
                        <td><h4>外观</h4></td>
                        <td><h4>舒适</h4></td>
                        <td><h4>质量</h4></td>
                    </tr>
                </table>
                @if ($hasReview)
                @foreach($reviews as $review)
                <hr>
                <h4>{{ $review->title }}
                    <small> {{ $review->nickname }} 于 {{ $review->created_at }} 发布 </small>                  
                </h4>            
                <p>
                    <div class="raty-star" id="star_id_{{ $model->model_id }}" 
                        data-score="{{ ($review->design_rating + $review->comfort_rating + $review->quality_rating) / 3 }}">
                    </div>
                </p>                
                <p> {{ $review->content }}</p>
                <p>                    
                    <span id='thumb_btn_{{ $review->review_id }}' class='thumb-btn'>
                        @if (Auth::check())                        
                        @if (in_array($review->review_id, $thumbedList))
                        <a href="javascript:removeThumbUp({{ $review->review_id }})" class='thumbed'>
                            <i class='fa fa-thumbs-up fa-lg'></i> 
                        </a>
                        <span>我和</span> {{ $review->thumb_ups - 1 }} 人点赞
                        @else                        
                        <a href="javascript:thumbUp({{ $review->review_id }})">
                            <i class='fa fa-thumbs-o-up fa-lg'></i>
                        </a>
                        {{ $review->thumb_ups }} 人点赞
                        @endif  
                        @else
                        {{ $review->thumb_ups }} 人点赞
                        @endif  
                    </span>           
                </p>
                @endforeach
                @else
                <hr>
                暂无评论
                @endif
            </div>
        </div>
    </div>
</div>