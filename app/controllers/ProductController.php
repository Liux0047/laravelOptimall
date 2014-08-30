<?php

/**
 * Description of ProductController
 *
 * @author Allen
 */
class ProductController extends BaseController {

    public static $eminentModels = array(
        'promotion' => array('id' => 0, 'wideModelId' => array(1001, 1005)),
        'newArrival' => array('id' => 1, 'wideModelId' => array(3001, 3004)),
        'bestSeller' => array('id' => 2, 'wideModelId' => array(2004, 3010)),
        'featured' => array('id' => 3, 'wideModelId' => array(2007, 3002)),
        'classical' => array('id' => 4, 'wideModelId' => array(2002, 3009))
    );

    public function getProduct($modelId = 1001) {

        $model = ProductModelView::findOrFail($modelId);
        $params['model'] = $model;

        $params['pageTitle'] = $model->model_name_cn . " - 目光之城";

        $params['product'] = $model->productViews()->firstOrFail();
        $params['products'] = $model->productViews;
        $params['lensTypes'] = LensType::all();
        return View::make('pages.product', $params);
    }

    public function getIndex() {

        $products = array();
        $wideModelIds = array();

        foreach (self::$eminentModels as $labelName => $labelValue) {
            //use variable variable name to form model groups of diffrent featured labels
            $modelGroupName = $labelName . 'Models';
            $$modelGroupName = ProductModelView::where('label', '=', $labelValue['id'])->take(4)->get();
            $params[$modelGroupName] = $$modelGroupName;
            foreach ($$modelGroupName as $model) {
                //associate model id with all products under this model id
                $products[$model->model_id] = $model->productViews;
            }
            $wideModelIds[$labelName] = $labelValue['wideModelId'];
        }

        $params['products'] = $products;
        $params['wideModelIds'] = $wideModelIds;

        return View::make('pages.index', $params);
    }

    public function getGallery() {
        $numItemsPerPage = Input::get('items_per_page', 12);
        $params['numItemsPerPage'] = $numItemsPerPage;
        $params['checkedValues'] = array();
        $models = ProductModelView::distinct();
        if (Input::has('styles')){
            $models = $models->ofStyles(Input::get('styles'));
            $params['checkedValues']['styles'] = Input::get('styles');
        }
        if (Input::has('categories')){
            $models = $models->ofCategories(Input::get('categories'));
            $params['checkedValues']['categories'] = Input::get('categories');
        }
        if (Input::has('shapes')){
            $models = $models->ofShapes(Input::get('shapes'));
            $params['checkedValues']['shapes'] = Input::get('shapes');
        }        
        if (Input::has('materials')){
            $models = $models->ofMaterials(Input::get('materials'));
            $params['checkedValues']['materials'] = Input::get('materials');
        }        
        if (Input::has('genders')){
            $models = $models->ofGenders(Input::get('genders'));
            $params['checkedValues']['genders'] = Input::get('genders');
        }
        if (Input::has('frames')){
            $models = $models->ofFrames(Input::get('frames'));
            $params['checkedValues']['frames'] = Input::get('frames');
        }

        $sortOrder = Input::get('sort_order', 'num_items_sold_display');
        $params['isDesc'] = false;
        if( Input::get('is_desc') == 1){
            $params['isDesc'] = true;
            $models = $models->orderBy($sortOrder, 'DESC');
        }
        else {
            $models = $models->orderBy($sortOrder);
        }
        $params['sortOrder'] = $sortOrder;

        $models = $models->paginate($numItemsPerPage);
        
        $products = array();
        $params['models'] = $models;
        foreach ($models as $model) {
            //associate model id with all products under this model id
            $products[$model->model_id] = $model->productViews;
        }
        $params['products'] = $products;
        
        $params['styles'] = ProductStyle::all();
        $params['categories'] = ProductCategory::all();
        $params['shapes'] = ProductShape::all();
        $params['materials'] = ProductMaterial::all();
        $params['genders'] = ProductGender::all();
        $params['frames'] = ProductFrame::all();
        $params['colors'] = ProductBaseColor::all();
        return View::make('pages.gallery', $params);
    }

}
