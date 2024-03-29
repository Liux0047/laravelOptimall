<?php

/**
 * Description of productModel
 *
 * @author Allen
 */
class ProductModelView extends Eloquent
{

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

    public function productViews()
    {
        return $this->hasMany('ProductView', 'model_id');
    }


    public function productMaterialMappings()
    {
        return $this->hasMany('ProductMaterialMapping', 'model_id');
    }

    public function productTagMappings()
    {
        return $this->hasMany('ProductTagMapping', 'model_id');
    }

    /*
     * live models are ones with  is_active = 1
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', '=', '1');
    }

    /*
     * dynamic scope to get models of certain styles
     */

    public function scopeOfStyles($query, $styles)
    {
        return $query->join('product_style_mapping', 'product_style_mapping.model_id', '=', 'model_view.model_id')
            ->whereIn('product_style_id', $styles);
    }

    /*
     * dynamic scope to get models of certain categories
     */

    public function scopeOfCategories($query, $categories)
    {
        return $query->whereIn('product_category_id', $categories);
    }

    /*
     * dynamic scope to get models of certain shapes
     */

    public function scopeOfShapes($query, $shapes)
    {
        return $query->whereIn('product_shape_id', $shapes);
    }

    /*
     * dynamic scope to get models of certain materials
     */

    public function scopeOfMaterials($query, $materials)
    {
        return $query->join('product_material_mapping', 'product_material_mapping.model_id', '=', 'model_view.model_id')
            ->whereIn('product_material_id', $materials);
    }

    /*
     * dynamic scope to get models of certain genders
     */

    public function scopeOfGenders($query, $genders)
    {
        return $query->whereIn('product_gender_id', $genders);
    }

    /*
     * dynamic scope to get models of certain frames
     */

    public function scopeOfFrames($query, $frames)
    {
        return $query->whereIn('product_frame_id', $frames);
    }

    /*
     * dynamic scope to get models of certain prices
     */

    public function scopeOfPrices($query, $prices)
    {
        return $query->whereBetween('price', $prices);
    }

    /*
     * dynamic scope to get models of certain materials
     */

    public function scopeOfFaces($query, $faces)
    {
        return $query->join('product_face_mapping', 'product_face_mapping.model_id', '=', 'model_view.model_id')
            ->whereIn('product_face_id', $faces);
    }

    /*
     * dynamic scope to test if this model contains products of certain base colors
     */

    public function scopeOfBaseColors($query, $baseColors)
    {
        return $query->join('product', 'model_view.model_id', '=', 'product.model_id')
            ->join('product_color_mapping', 'product_color_mapping.product_color_id', '=', 'product.product_color_id')
            ->whereIn('product_color_mapping.product_base_color_id', $baseColors)
            ->groupBy('model_view.model_id');
    }

    /*
     * Dynamic scope to determine if keyword matches
     */
    public function scopeOfKeyword($query, $keyword)
    {
        return $query->join('product_tag_mapping', 'model_view.model_id', '=', 'product_tag_mapping.model_id')
            ->join('product_tag', 'product_tag.product_tag_id', '=', 'product_tag_mapping.product_tag_id')
            ->where(function ($query) use ($keyword) {
                $query->where('model_name_cn', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('model_name_en', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('product_tag.tag_name_cn', 'LIKE', '%' . $keyword . '%');

            });
    }

}
