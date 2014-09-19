<?php

/**
 * Description of ProductController
 *
 * @author Allen
 */
class ProductController extends BaseController {
    
    public static $productLabels = array(
        'promotion' => 1,
        'newArrival' => 2,
        'bestSeller' => 3,
        'featured' => 4,
        'classical' => 5
    );

    public static $eminentModels = array(
        'promotion' => array(1001, 1009),
        'newArrival' => array(3001, 3004),
        'bestSeller' => array(2004, 3010),
        'featured' => array(2007, 3002),
        'classical' => array(2002, 3009)
    );
    
    public static $eminentModelQuote = array (
        1001 => "【炫彩夏威夷】<br> 缤纷夏日狂欢， 有你有我", 1009 => "【文艺.复兴】<br>在平凡的世界中不平凡",
        3001 => "【沁心】<br> Samatha", 3004 => "【雅皮士Yuppies】<br>你的爱羡为我加冕",
        2004 => "【极简主义】<br> Simply Elegant", 3010 => "【摩登时代】<br> Timeless Classic",
        2007 => "【原木物语】<br>匠心独具<br>原木打造<br>徒手文化", 3002 => "【豆蔻.年华】<br>荏苒岁月，海枯石烂谁伴",
        2002 => "【潮人】<br>Glitterati", 3009 => "【罗曼蒂克】<br> Romantic"
    );

    public function getProduct($modelId = 1001) {

        $model = ProductModelView::findOrFail($modelId);
        $params['model'] = $model;

        $params['pageTitle'] = $model->model_name_cn . " - 目光之城";

        $params['product'] = $model->productViews()->firstOrFail();
        $params['products'] = $model->productViews;
        $params['lensTypes'] = LensType::all();
        $reviews = Review::ofModel($modelId)->orderBy('created_at','DESC')->get();
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
        $params['sequence'] = array(3,1,4,2,);
        $params['alsoBuys'] = $this->getAlsoBuyModels($modelId);
        $this->recordViewHistory($modelId);
        return View::make('pages.product', $params);
    }

    public function getIndex() {
        foreach (self::$productLabels as $labelName => $labelValue) {
            //use variable variable name to form model groups of diffrent featured labels
            $modelGroupName = $labelName . 'Models';
            $$modelGroupName = ProductModelView::active()
                            ->where('product_label_id', '=', $labelValue)
                            ->orderBy('num_items_sold_display', 'DESC')->take(4)->get();
            $params[$modelGroupName] = $$modelGroupName;
        }        

        foreach(self::$eminentModels as $key=>$eminentModelIds) {
            $params['wideModels'][$key] = ProductModelView::whereIn('model_id' ,$eminentModelIds)->get();
        }
        $params['wideModelQuote'] = self::$eminentModelQuote;
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

        $models = ProductModelView::active()->distinct()->select("model_view.*");
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
        $count = 0;
        foreach ($baseModels as $baseModel) {            
            $models[] = ProductModelView::find($baseModel->model_id);
            $count++;
        }
        for ($i = $count; $i<5; $i++){
            $models[] = ProductModelView::find(3001 + $i);
        }
        return array('models' => $models);
    }

}
