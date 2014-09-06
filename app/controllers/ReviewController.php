<?php

/**
 * Description of ReviewController
 *
 * @author Allen
 */
class ReviewController extends BaseController {

    public function postCreateReview() {
        
        $validator = $this->validateReview();
        
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        
        $item = OrderLineItem::find(Input::get('order_line_item_id'));
        if ($item->member_id != Auth::id()){
            return Redirect::back()->with('error'.'无法添加评论');
        }
        
        $review = new Review;
        $review->title = Input::get('title');
        $review->content = Input::get('content');
        
        $review->design_rating = Input::get('score_design', '5');
        if ($review->design_rating > 5) {
            $review->design_rating = 5;
        }
        $review->comfort_rating = Input::get('score_comfort', '5');
        if ($review->comfort_rating > 5) {
            $review->comfort_rating = 5;
        }
        $review->quality_rating = Input::get('score_quality', '5');
        if ($review->quality_rating > 5) {
            $review->quality_rating = 5;
        }
        
        $review->order_line_item_id = $item->order_line_item_id;
        $review->save();
        
        return Redirect::back()->with('status', '评论成功');
    }

    public function postThumbUp() {
        if (Request::ajax()) {
            $thumbUp = new ThumbUp;
            $thumbUp->member_id = Auth::id();
            $thumbUp->review_id = Input::get('review_id');
            $thumbUp->save();
            return Response::json(array('success'=>true));
        }
    }

    public function postRemoveThumbUp() {
        if (Request::ajax()) {
            $thumbUp = ThumbUp::where('member_id','=',Auth::id())
                    ->where('review_id','=',Input::get('review_id'));
            $thumbUp->delete();
            return Response::json(array('success'=>true));
        }
    }
    
    private function validateReview() {
        $rules = array(
            'title' => 'required|max:45',
            'content' => 'required|max:200'
        );
        return Validator::make(Input::all(), $rules);
        
    }
}
