<!--detailed product info -->
<ul class="nav nav-tabs" role="tablist">
    <li class="active">
        <a href="#detailed_description" role="tab" data-toggle="tab">
            详细描述
        </a>
    </li>
    <li>
        <a href="#lens_description" role="tab" data-toggle="tab" id="len_desc_tab">
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
            用户评价
        </a>
    </li>
    <li>
        <a href="#user_question" role="tab" data-toggle="tab" id="user_question_tab">
            我有疑问
        </a>
    </li>
</ul>

<div class="tab-content">
    <div class="tab-pane fade in active tab-pane-bordered" id="detailed_description">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default panel-no-border">
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td class="active align-right">商品名称</td>
                                <td>{{ $model->model_name_cn }}</td>
                                <td class="active align-right">材料</td>
                                <td>
                                    @foreach($model->productMaterialMappings as $materialMapping)
                                        {{ $materialMapping->productMaterial->material_name_cn }}
                                    @endforeach
                                </td>
                                <td class="active align-right">重量</td>
                                <td>{{ $model->weight }}g</td>
                            </tr>
                            <tr>
                                <td class="active align-right">鼻间距</td>
                                <td>{{ $model->dimension_bridge }}mm</td>
                                <td class="active align-right">镜宽</td>
                                <td>{{ $model->dimension_eye }}mm</td>
                                <td class="active align-right">镜腿</td>
                                <td>{{ $model->dimension_temple }}mm</td>
                            </tr>
                            <tr>
                                <td class="active align-right">镜高</td>
                                <td>{{ $model->dimension_vertical }}mm</td>
                                <td class="active align-right">总宽</td>
                                <td>{{ $model->dimension_eye*2 + $model->dimension_bridge}}mm</td>
                                <td class="active align-right">形状</td>
                                <td>{{ $model->shape_name_cn }}</td>
                            </tr>
                            </tbody>
                        </table>
                        标签：
                        @foreach($model->productTagMappings as $tagMapping)
                            <span class="label">
                            <a target="_blank"
                               href="{{ url('gallery?search_keyword='.$tagMapping->productTag->tag_name_cn) }}">
                                #{{ $tagMapping->productTag->tag_name_cn }}#
                            </a>
                        </span>
                        @endforeach
                    </div>
                </div>

                <img src="{{ asset(Config::get('optimall.lazyloadImg')) }}"
                     data-original="{{ asset('images/gallery/'.$model->model_id.'/spec.jpg') }}"
                     class="lazy poster">

                @for ($i=1; $i<=Config::get('optimall.maxProductPosters'); $i++)
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

                <img src="{{ asset(Config::get('optimall.lazyloadImg')) }}"
                     data-original="{{ asset('images/package-poster/glasses-box.jpg') }}"
                     class="lazy poster">
                <img src="{{ asset(Config::get('optimall.lazyloadImg')) }}"
                     data-original="{{ asset('images/package-poster/package-conceptual.jpg') }}"
                     class="lazy poster">
            </div>
        </div>
    </div>
    <div class="tab-pane fade tab-pane-bordered" id="lens_description">
        <div class="row">
            <div class="col-md-12">

                @for ($i=1; $i<=3; $i++)
                    <img src="{{ asset(Config::get('optimall.lazyloadImg')) }}"
                         data-original="{{ asset('images/lens/lens-feature-'.$i.'.jpg') }}"
                         class="lazy poster">
                @endfor

                @foreach($lensTypes as $lensType)
                    @if ($lensType->lens_type_id != 1)
                        <section id="lens_description_{{ $lensType->lens_type_id }}">
                            <h1 class="shelf-header">
                        <span class="title">
                            {{ $lensType->title_cn }}
                        </span>
                                <span class="divider"></span>
                            </h1>
                            @for ($i=1; $i<=Config::get('optimall.maxLensPosters'); $i++)
                                @if (File::exists('images/lens/lens-'.$lensType->lens_type_id.'/lens-poster-'.$i.'.jpg'))
                                    <img src="{{ asset(Config::get('optimall.lazyloadImg')) }}"
                                         data-original="{{ asset('images/lens/lens-'.$lensType->lens_type_id.'/lens-poster-'.$i.'.jpg') }}"
                                         class="lazy poster">
                                @endif
                            @endfor
                            <br>
                        </section>
                    @endif
                @endforeach
            </div>
        </div>
    </div>


    <div class="tab-pane fade tab-pane-bordered" id="prescription_guide">
        <img src="{{ asset(Config::get('optimall.lazyloadImg')) }}"
             data-original="{{ asset('images/info/beginner-guide/guide.jpg') }}"
             class="lazy poster">
    </div>


    <div class="tab-pane fade tab-pane-bordered" id="user_review">
        <div class="panel panel-default panel-no-border">
            <div class="panel-body">
                <table class="align-center" width="100%">
                    <tr>
                        <td width="30%">
                            <input class="knob" id="overall_rating" value="0">
                        </td>
                        <td width="20%"><input class="knob" id="design_rating"
                                               value="{{ $model->average_design_rating }}"></td>
                        <td width="20%"><input class="knob" id="comfort_rating"
                                               value="{{ $model->average_comfort_rating }}"></td>
                        <td width="20%"><input class="knob" id="quality_rating"
                                               value="{{ $model->average_quality_rating }}"></td>
                    </tr>
                    <tr>
                        <td><h4>总体评分</h4></td>
                        <td><h4>外观</h4></td>
                        <td><h4>舒适</h4></td>
                        <td><h4>质量</h4></td>
                    </tr>
                </table>

                @if($reviewOrderLineItemId)
                    <hr><br>
                    @include('components.member-account.review-panel', array('itemId'=>$reviewOrderLineItemId))
                @endif

                @if ($hasReview)
                    @foreach($reviews as $review)
                        <div id="review_{{ $review->review_id }}">

                            <hr>
                            @if (Auth::check())
                                <a class="pull-right" data-toggle="modal" href="#review_reply_{{ $review->review_id }}">
                                    <i class="fa fa-comment"></i>
                                    回复此评论
                                </a>
                                <!-- Modal -->
                                <div class="modal fade" id="review_reply_{{ $review->review_id }}" tabindex="-1"
                                     role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span
                                                            aria-hidden="true">&times;</span><span
                                                            class="sr-only">Close</span></button>
                                                <h4 class="modal-title" id="myModalLabel">回复此评论</h4>
                                            </div>
                                            <div class="modal-body">
                                                <textarea class="form-control review-reply-content" rows="3"
                                                          name="content" placeholder="请添加您的回复（200字以内哦）"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                                                </button>
                                                <button class="btn btn-primary review-reply-btn" disabled
                                                        onclick="postReviewReply({{ $review->review_id }});">回复
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <h4>{{ $review->title }}
                                <small> {{ $review->nickname }} 于 {{ formatDateTime($review->created_at) }} 发布</small>
                            </h4>

                            <p>

                            <div class="raty-star" id="star_id_{{ $model->model_id }}"
                                 data-score="{{ ($review->design_rating + $review->comfort_rating + $review->quality_rating) / 3 }}">
                            </div>
                            </p>
                            <p> {{ $review->content }}</p>

                            <div>
                                <div class="review-gallery">
                                    {{-- get all images uploaded under uploads/reviews/currentItemId folder--}}
                                    @foreach(File::files(Config::get('optimall.reviewPicPath').$review->order_line_item_id) as $file)
                                        <a href="{{ getReviewImageUrl($file, $review->order_line_item_id) }}">
                                            <img src="{{ getReviewThumbnailUrl($file, $review->order_line_item_id) }}">
                                        </a>
                                    @endforeach
                                </div>
                            </div>
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
                                <a><i class='fa fa-thumbs-o-up fa-lg'></i></a>
                                {{ $review->thumb_ups }} 人点赞
                            @endif  
                        </span>
                            </p>

                            {{-- Review replies --}}
                            <div class="review-reply-container">
                                @foreach($review->reviewReplies()->orderBy('created_at')->get() as $reply)
                                    <p>
                                        @if( hasReservedKeyword($reply->member->nickname))
                                            <span class="font-orange">{{ $reply->member->nickname }}</span>
                                            <span class="font-orange"> 于 {{ formatDateTime($reply->created_at) }}
                                                回复：</span>
                                            <span class="font-orange">{{ $reply->content }}</span>
                                        @else
                                            {{ $reply->member->nickname }}
                                            <span class="font-grey"> 于 {{ formatDateTime($reply->created_at) }}
                                                回复：</span>
                                            <span>{{$reply->content}}</span>
                                        @endif
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @else
                    <hr>
                    暂无评论
                @endif

            </div>
        </div>
    </div>


    <div class="tab-pane fade tab-pane-bordered" id="user_question">
        <div class="panel panel-default panel-no-border">
            <div class="panel-body">
                <div class="alert alert-info">
                    <i class="fa fa-exclamation-circle"></i>
                    <strong>温馨小提示：</strong>该版块是用于会员们提交对该款眼镜的疑问，我们将在第一时间通过邮件回答。
                    在此您也可以看到别人曾经提出的问题，解决您个人问题的同时也可以了解到大家的一些常见疑问，希望对您的购镜体验有所帮助
                </div>
                @if ($userQuestions->count() == 0)
                    暂时没有对该商品的提问
                @else
                    <h4>看看大家都问了些什么</h4>
                    <br>
                    <table class="table table-striped">
                        <tbody>
                        @foreach($userQuestions as $userQuestion)
                            <tr>
                                <td width="5%"><span class="badge badge-danger">Q</span></td>
                                <td>{{{ $userQuestion->question }}}</td>
                            </tr>
                            <td width="5%"><span class="badge badge-info">A</span></td>
                            <td class="answer-cell">
                                {{{ $userQuestion->answer }}}
                            </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif

                @if (Auth::check())
                    <hr>
                    {{ Form::open(array('action'=>'QuestionController@postAskQuestion', 'id'=>'user_question_form')) }}
                    <div class="form-group">
                        <textarea class="form-control user_question" rows="3" name="question"
                                  placeholder="请填写您的问题（200字以内哦）"></textarea>
                    </div>
                    {{ Form::hidden('model_id', $model->model_id) }}
                    {{ Form::submit('提交我的问题', array('class'=>'btn btn-primary pull-right', 'disabled'=>'true')) }}
                    {{ Form::close() }}
                @endif

            </div>
        </div>


    </div>

</div>