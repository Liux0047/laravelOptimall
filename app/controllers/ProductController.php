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
        $reviews = Review::ofModel($modelId)->get();
        $params['reviews'] = $reviews;
        //invalid review collection if contains only one entry withoug review_id
        $params['hasReview'] = !($reviews->count() == 1 && !isset($reviews[0]->review_id));
        $params['thumbedList'] = array();
        if (Auth::check()) { //get the list of reviews that the member has thumbed up
            $thumbUps = Auth::user()->thumbUps;
            foreach ($thumbUps as $thumbUp) {
                $params['thumbedList'][] = $thumbUp->review_id;
            }
        }
        $params['alsoBuys'] = $this->getAlsoBuyModels($modelId);
        $this->recordViewHistory($modelId);
        return View::make('pages.product', $params);
    }

    public function getIndex() {
        $wideModelIds = array();

        foreach (self::$eminentModels as $labelName => $labelValue) {
            //use variable variable name to form model groups of diffrent featured labels
            $modelGroupName = $labelName . 'Models';
            $$modelGroupName = ProductModelView::active()
                            ->where('product_label_id', '=', $labelValue['id'])
                            ->orderBy('num_items_sold_display', 'DESC')->take(4)->get();
            $params[$modelGroupName] = $$modelGroupName;
            $wideModelIds[$labelName] = $labelValue['wideModelId'];
        }

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

        $models = ProductModelView::active();
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

        $params['models'] = $modelsToDisplay;

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

        foreach ($modelIdsToDisplay as $modelId) {
            $models[] = ProductModelView::find($modelId);
        }
        $params['models'] = $models;

        return View::make('components.product-page.ajax-load-product-cards', $params);
    }

    private function recordViewHistory($modelId) {
        if (Auth::check()) {
            $count = ViewItemHistory::where('member_id', '=', Auth::id())
                    ->where('model_id', '=', $modelId)
                    ->count();
            if ($count == 0) {
                $viewhistory = new ViewItemHistory;
                $viewhistory->member_id = Auth::id();
                $viewhistory->model_id = $modelId;
                $viewhistory->save();
            }
        }
    }

    private function getAlsoBuyModels($cuurentModelId) {
        $baseModels = OrderLineItemView::viewThisAlsoBuy($cuurentModelId)->take(5)->get();
        $models = array();
        foreach ($baseModels as $baseModel) {
            $model = ProductModelView::find($baseModel->model_id);
            $models[] = $model;
        }
        return array('models' => $models);
    }

}
