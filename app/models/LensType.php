<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LensType
 *
 * @author Allen
 */
class LensType extends Eloquent{
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'lens_type';
        
        //primary ID
        protected $primaryKey = 'lens_type_id';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	//protected $hidden = array('password', 'remember_token');
}
