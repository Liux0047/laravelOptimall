<?php

/**
 * Description of ProductController
 *
 * @author Allen
 */
class ProductController extends BaseController
{

    const MIN_FILTER_PRICE = 0;
    const MAX_FILTER_PRICE = 500;

    public static $productLabels = array(
        'promotion' => 1,
        'bestSeller' => 2,
        'newArrival' => 3,
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
    public static $eminentModelQuote = array(
        1001 => "【炫彩夏威夷】<br> 缤纷夏日狂欢， 有你有我", 1009 => "【文艺.复兴】<br>在平凡的世界中不平凡",
        3001 => "【沁心】<br> Samatha", 3004 => "【雅皮士Yuppies】<br>你的爱羡为我加冕",
        2004 => "【极简主义】<br> Simply Elegant", 3010 => "【摩登时代】<br> Timeless Classic",
        2007 => "【原木物语】<br>匠心独具<br>原木打造<br>徒手文化", 3002 => "【豆蔻.年华】<br>荏苒岁月，海枯石烂谁伴",
        2002 => "【潮人】<br>Glitterati", 3009 => "【罗曼蒂克】<br> Romantic"
    );

    public function getProduct($modelId = 1001)
    {

        $model = ProductModelView::with('productViews')->findOrFail($modelId);
        $params['model'] = $model;

        $params['pageTitle'] = $model->model_name_cn . " - 目光之城";

        $params['products'] = $model->productViews;
        $params['product'] = $params['products'][0];

        //progressive lens not allowed for models with vetical less thant 35mm
        if ($model->dimension_vertical < 35) {
            $lensUnavailable[] = 4;
            $params['lensTypes'] = LensType::whereNotIn('lens_type_id', $lensUnavailable)->get();
        } else {
            $params['lensTypes'] = LensType::all();
        }

        $reviews = Review::ofModel($modelId)->orderBy('created_at', 'DESC')->get();
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
        $params['reviewOrderLineItemId'] = $this->isReviewable($modelId);
        $params['sequence'] = array(3, 1, 4, 2,);
        $params['alsoBuys'] = $this->getAlsoBuyModels($modelId);

        $this->recordViewHistory($modelId);
        return View::make('pages.product', $params);
    }

    public function getIndex()
    {
        foreach (self::$productLabels as $labelName => $labelValue) {
            //use variable variable name to form model groups of diffrent featured labels
            $modelGroupName = $labelName . 'Models';
            $$modelGroupName = ProductModelView::with('productViews')->active()
                ->where('product_label_id', '=', $labelValue)
                ->orderBy('num_items_sold_display', 'DESC')->take(4)->get();
            $params[$modelGroupName] = $$modelGroupName;
        }

        foreach (self::$eminentModels as $key => $eminentModelIds) {
            $params['wideModels'][$key] = ProductModelView::with('productViews')
                ->whereIn('model_id', $eminentModelIds)
                ->get();
        }
        $params['wideModelQuote'] = self::$eminentModelQuote;
        return View::make('pages.index', $params);
    }

    public function getGallery()
    {
        $filters = array(
            array('filterName' => 'styles', 'functionName' => 'ofStyles', 'displayName' => '风格'),
            array('filterName' => 'colors', 'functionName' => 'ofBaseColors', 'displayName' => '颜色'),
            array('filterName' => 'shapes', 'functionName' => 'ofShapes', 'displayName' => '形状'),
            array('filterName' => 'materials', 'functionName' => 'ofMaterials', 'displayName' => '材料'),
            array('filterName' => 'frames', 'functionName' => 'ofFrames', 'displayName' => '框型'),
            array('filterName' => 'faces', 'functionName' => 'ofFaces', 'displayName' => '脸型'),
        );
        $params['filters'] = $filters;

        $params['filterValues'] = array();
        $params['filterValues']['styles'] = ProductStyle::getGalleryFilters();
        $params['filterValues']['colors'] = ProductBaseColor::getGalleryFilters();
        $params['filterValues']['shapes'] = ProductShape::getGalleryFilters();
        $params['filterValues']['materials'] = ProductMaterial::getGalleryFilters();
        $params['filterValues']['faces'] = ProductFace::getGalleryFilters();
        $params['filterValues']['frames'] = ProductFrame::getGalleryFilters();

        Session::forget('remainingModels');
        $params['checkedValues'] = array();

        $models = ProductModelView::with('productViews')->active()->distinct()->select("model_view.*");
        foreach ($filters as $filter) {
            if (Input::has($filter['filterName']) && count(Input::get($filter['filterName']))) {
                $models = $models->$filter['functionName'](Input::get($filter['filterName']));
                $params['checkedValues'][$filter['filterName']] = Input::get($filter['filterName']);
            }
        }
        if (Input::has('search_keyword') && strlen(trim(Input::get('search_keyword')))) {
            $models = $models->ofKeyword(Input::get('search_keyword'));
        }

        $params['price_min'] = self::MIN_FILTER_PRICE;
        $params['price_max'] = self::MAX_FILTER_PRICE;
        if (( Input::has('price_min') && Input::has('price_max'))) {
            if ( Input::get('price_min') != self::MIN_FILTER_PRICE || Input::get('price_max') != self::MAX_FILTER_PRICE ) {
                $params['price_min'] = Input::get('price_min');
                $params['price_max'] = Input::get('price_max');
                $models = $models->ofPrices(array($params['price_min'], $params['price_max']));
            }
        }

        //get the sort order
        //default is number of items sold, descending
        $sortOrder = Input::get('sort_order', 'num_items_sold_display');
        $params['isDesc'] = true;
        if (Input::has('is_desc') && Input::get('is_desc') == 0) {
            $params['isDesc'] = false;
            $models = $models->orderBy($sortOrder);
        } else {
            $models = $models->orderBy($sortOrder, 'DESC');
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

        return View::make('pages.gallery', $params);
    }

    public function postShowRemainingModels()
    {
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

    private function recordViewHistory($modelId)
    {
        if (Auth::check()) {
            $count = ViewItemHistory::where('member_id', '=', Auth::id())
                ->where('model_id', '=', $modelId)
                ->count();
            if ($count == 0) {
                $viewHistory = new ViewItemHistory;
                $viewHistory->member_id = Auth::id();
                $viewHistory->model_id = $modelId;
                $viewHistory->save();
            }
        }
    }

    private function getAlsoBuyModels($currentModelId)
    {
        $baseModels = OrderLineItemView::viewThisAlsoBuy($currentModelId)->take(5)->get();
        $models = array();
        $count = 0;
        foreach ($baseModels as $baseModel) {
            $models[] = ProductModelView::with('productViews')->find($baseModel->model_id);
            $count++;
        }
        for ($i = $count; $i < 5; $i++) {
            $models[] = ProductModelView::with('productViews')->find(3001 + $i);
        }
        return array('models' => $models);
    }

    /*
     * check if current member is eligible to write review for this model
     * returns the member's orderLineItemId if eligible
     * otherwise false
     */

    private function isReviewable($modelId)
    {
        if (Auth::check()) {
            $orderLineItemIds = OrderLineItemView::select('order_line_item_id')
                ->where('model_id', '=', $modelId)
                ->where('member_id', '=', Auth::id())
                ->get();
            if ($orderLineItemIds->count() > 0) {
                foreach ($orderLineItemIds as $orderLineItemId) {
                    $id = $orderLineItemId->order_line_item_id;
                    if (Review::where('order_line_item_id', '=', $id)->count() == 0) {
                        return $id;
                    }
                }
                return false;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
