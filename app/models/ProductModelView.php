<?php

/**
 * Description of productModel
 *
 * @author Allen
 */
class ProductModelView extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'model_view';
    //primary ID
    protected $primaryKey = 'model_id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');

    public function productViews() {
        return $this->hasMany('ProductView', 'model_id');
    }
    
    /*
     * dynmaic scope to get models of certain styles
     */

    public function scopeOfStyles($query, $styles) {
        return $query->whereIn('style', $styles);
    }

    /*
     * dynmaic scope to get models of certain categories
     */

    public function scopeOfCategories($query, $categories) {
        return $query->whereIn('category', $categories);
    }

    /*
     * dynmaic scope to get models of certain shapes
     */

    public function scopeOfShapes($query, $shapes) {
        return $query->whereIn('shape', $shapes);
    }

    /*
     * dynmaic scope to get models of certain materials
     */

    public function scopeOfMaterials($query, $materials) {
        return $query->whereIn('material', $materials);
    }

    /*
     * dynmaic scope to get models of certain genders
     */

    public function scopeOfGenders($query, $genders) {
        return $query->whereIn('gender', $genders);
    }

    /*
     * dynmaic scope to get models of certain frames
     */

    public function scopeOfFrames($query, $frames) {
        return $query->whereIn('frame', $frames);
    }

    /*
     * dynamic scope to test if this model contains products of certain base colors
     */

    public function scopeOfBaseColors($query, $baseColors) {
        return $query->join('product', 'model_view.model_id', '=', 'product.model_id')
                        ->join('product_color_mapping', 'product_color_mapping.product_color_id', '=', 'product.product_color_id')
                        ->whereIn('product_color_mapping.product_base_color_id', $baseColors)
                        ->groupBy('model_view.model_id');
    }

}
