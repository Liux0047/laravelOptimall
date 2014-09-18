<?php

/**
 * Description of Review
 *
 * @author Allen
 */
class Review extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'review';
    //primary ID
    protected $primaryKey = 'review_id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');
    
    /*
     * one to many relationship with ReivewReplay
     */
    public function reviewReplies() {
        return $this->hasMany('ReviewReply', 'review_id');
    }
    
    /*
     * Dynamic scope to query for reviews belonging to a model
     */
    public function scopeOfModel ($query, $modelId) {
        return $query->select('review.review_id', 'review.title','review.content','review.created_at',
                'review.design_rating','review.comfort_rating','review.quality_rating', 'member.nickname',
                DB::raw('count(thumb_up.thumb_up_id) AS thumb_ups '))
                ->join('order_line_item','order_line_item.order_line_item_id','=','review.order_line_item_id')
                ->join('product', 'product.product_id','=','order_line_item.product_id')
                ->join('member','order_line_item.member_id','=','member.member_id')
                ->leftJoin('thumb_up','thumb_up.review_id','=','review.review_id')
                ->where('product.model_id','=',$modelId);
    }
}
