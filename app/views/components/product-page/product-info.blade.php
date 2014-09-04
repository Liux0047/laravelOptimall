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
    <div class="tab-pane fade in active detailed-poster-container" id="detailed_description">
        <div class="row">
            <div class="col-md-12 img-size-limit">
                @for ($i=1; $i<=4; $i++)
                <br>
                <img src="{{ asset('images/lazyload-holder.png') }}" 
                data-original="{{ asset('images/gallery/'.$model->model_id.'/detail-'.$i.'.jpg') }}"
                class="lazy poster">
                @endfor
            </div>
        </div>
    </div>
    <div class="tab-pane fade detailed-poster-container" id="lens_description">
        <div class="row">
            <div class="col-md-12">     
                <h1 class="shelf-header">
                    <span class="title">
                        <a href="#">积家 <small>LENSES</small></a>
                    </span>
                    <span class="divider"></span>
                </h1>
                <img src="/optimall/asset/img/lens/description_1.jpg">            
                <h1 class="shelf-header">
                    <span class="title">
                        <a href="#">推荐 <small>FEATURED</small></a>
                    </span>
                    <span class="divider"></span>
                </h1>
                <img src="/optimall/asset/img/lazyload-holder.png" data-original="/optimall/asset/img/lens/description_2.jpg"" class="lazy ">            
                <h1 class="shelf-header">
                    <span class="title">
                        <a href="#">推荐 <small>FEATURED</small></a>
                    </span>
                    <span class="divider"></span>
                </h1>
                <img src="/optimall/asset/img/lazyload-holder.png" data-original="/optimall/asset/img/lens/description_3.jpg"" class="lazy ">
            </div>
        </div>            
    </div>
    
    
    <div class="tab-pane fade detailed-poster-container" id="prescription_guide">

    </div>
    <div class="tab-pane fade" id="user_review">
        <div class="row">
            <div class="col-md-9">
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

            <div class="col-md-3">
                <div class="panel panel-default also-buy-container">
                    <div class="panel-heading">猜你喜欢的：</div>                    
                    
                    <table class="table">
                        @foreach($alsoBuys['models'] as $alsoBuyModel)
                        <tr>
                            <td rowspan="3" width="50%">
                                <img src="{{ asset('images/lazyload-holder.png') }}" 
                                data-original="{{ asset('images/gallery/'.$alsoBuyModel->model_id.'/'.$alsoBuys['products'][$alsoBuyModel->model_id][0]->product_id.'/medium-view-3.jpg') }}" 
                                class="lazy">
                            </td>
                            <td>
                                <h5><strong>{{ $alsoBuyModel->model_name_cn }}</strong></h4>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="discount-price">
                                        {{ number_format($alsoBuyModel->price, 0) }} 
                                    </span>
                                    <span class="market-price"><del>¥{{ $alsoBuyModel->price + 300 }}</del></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    @foreach($alsoBuys['products'][$alsoBuyModel->model_id] as $product)
                                    <span class="color-icon-link"> 
                                        <img src="{{ asset('images/color/color-'.$product->color.'.png') }}" class="color-icon">
                                    </span>
                                    @endforeach
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        
                    </div>
                </div>
            </div>
        </div><!-- .row -->
    </div>
</div>