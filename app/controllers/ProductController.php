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
        $params['reviews'] = Review::ofModel($model)->get();
        return View::make('pages.product', $params);
    }

    public function getIndex() {

        $products = array();
        $wideModelIds = array();

        foreach (self::$eminentModels as $labelName => $labelValue) {
            //use variable variable name to form model groups of diffrent featured labels
            $modelGroupName = $labelName . 'Models';
            $$modelGroupName = ProductModelView::where('label', '=', $labelValue['id'])
                            ->orderBy('num_items_sold_display', 'DESC')->take(4)->get();
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
        $filters = array(
            array('filterName' => 'styles', 'functionName' => 'ofStyles'),
            array('filterName' => 'categories', 'functionName' => 'ofCategories'),
            array('filterName' => 'shapes', 'functionName' => 'ofShapes'),
            array('filterName' => 'materials', 'functionName' => 'ofMaterials'),
            array('filterName' => 'genders', 'functionName' => 'ofGenders'),
            array('filterName' => 'frames', 'functionName' => 'ofFrames'),
            array('filterName' => 'colors', 'functionName' => 'ofBaseColors')
        );

        Session::forget('remainingModels');

        $params['checkedValues'] = array();
        $models = ProductModelView::distinct();

        foreach ($filters as $filter) {
            if (Input::has($filter['filterName']) && count(Input::get($filter['filterName']))) {
                $models = $models->$filter['functionName'](Input::get($filter['filterName']));
                $params['checkedValues'][$filter['filterName']] = Input::get($filter['filterName']);
            }
        }

        $sortOrder = Input::get('sort_order', 'num_items_sold_display');
        $params['isDesc'] = false;
        if (Input::get('is_desc') == 1) {
            $params['isDesc'] = true;
            $models = $models->orderBy($sortOrder, 'DESC');
        } else {
            $models = $models->orderBy($sortOrder);
        }
        $params['sortOrder'] = $sortOrder;

        $models = $models->get();

        $itemsOnPage = Config::get('optimall.itemsOnPage');
        if ($models->count() > $itemsOnPage) {
            $modelsToDisplay = $models->splice(0, $itemsOnPage);
            for ($i = 0; $i < $models->count(); $i++) {
                $remainingModelIds[] = $models->get($i)->model_id;
            }
            Session::put('remainingModels', $remainingModelIds);
        } else {
            $modelsToDisplay = $models;
        }

        $products = array();

        foreach ($modelsToDisplay as $model) {
            //associate model id with all products under this model id
            $products[$model->model_id] = $model->productViews;
        }

        $params['models'] = $modelsToDisplay;
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

    public function postShowRemainingModels() {
        $models = array();
        $products = array();

        $itemsOnPage = Config::get('optimall.itemsOnPage');
        $params['disable'] = false;
        if (Session::has('remainingModels')) {
            $remainingModelIds = Session::get('remainingModels');
            if (count($remainingModelIds) > $itemsOnPage) {
                $modelIdsToDisplay = array_splice($remainingModelIds, 0, $itemsOnPage);
                Session::put('remainingModels', $remainingModelIds);
            } else {
                $modelIdsToDisplay = Session::get('remainingModels');
                Session::forget('remainingModels');
                $params['disable'] = true;
            }
        } else {
            $params['disable'] = true;
            $modelIdsToDisplay = array();
        }

        foreach ($modelIdsToDisplay as $modelIds) {
            $models[] = ProductModelView::find($modelIds);
        }
        foreach ($models as $model) {
            //associate model id with all products under this model id
            $products[$model->model_id] = $model->productViews;
        }
        $params['models'] = $models;
        $params['products'] = $products;

        return View::make('components.product-page.ajax-load-product-cards', $params);
    }

}
