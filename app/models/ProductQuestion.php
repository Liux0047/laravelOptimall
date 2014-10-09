<?php

/**
 * Created by PhpStorm.
 * User: Allen
 * Date: 10/9/2014
 * Time: 2:52 PM
 */
class ProductQuestion extends Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_question';
    //primary ID
    protected $primaryKey = 'product_question_id';


    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');

    /*
     * Inverse one to many relationship with member
     */
    public function member () {
        return $this->belongsTo('Member', 'member_id');
    }

    /*
     * Dynamic scope of questions belonging to a model
     */
    public function scopeOfModel($query, $modelId) {
        return $query->where('model_id', '=', $modelId)->where('is_presentable','=', '1');
    }

} 