<?php

/**
 * Description of ReviewController
 *
 * @author Allen
 */
class ReviewController extends BaseController {

    public function postCreateReview() {
        $review = new Review;
        $review->title = Input::get('title');
        $review->content = Input::get('content');
        $review->design_rating = Input::get('score_design', '5');
        $review->comfort_rating = Input::get('score_comfort', '5');
        $review->quality_rating = Input::get('score_quality', '5');
        $review->save();
        $item = OrderLineItem::find(Input::get('order_line_item_id'));
        $item->review = $review->review_id;
        $item->save();
        return Redirect::back()->with('status', '评论成功');
    }

    public function postThumbUp() {
        if (Request::ajax()) {
            $thumbUp = new ThumbUp;
            $thumbUp->member = Auth::id();
            $thumbUp->review = Input::get('review_id');
            $thumbUp->save();
            return Response::json(array('success'=>true));
        }
    }

    public function postRemoveThumbUp() {
        if (Request::ajax()) {
            $thumbUp = ThumbUp::where('member','=',Auth::id())->where('review','=',Input::get('review_id'));
            $thumbUp->delete();
            return Response::json(array('success'=>true));
        }
    }
}
