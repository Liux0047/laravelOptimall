<?php

/**
 * Description of ProductController
 *
 * @author Allen
 */
class ProductController extends BaseController {

    public static $productLabels = array(
        'promotion' => array('id' => 0, 'wideModelId' => array(1001, 1005)),
        'newArrival' => array('id' => 1, 'wideModelId' => array(3001, 3004)),
        'bestSeller' => array('id' => 2, 'wideModelId' => array(2004, 3010)),
        'featured' => array('id' => 3, 'wideModelId' => array(2007, 3002)),
        'classical' => array('id' => 4, 'wideModelId' => array(2002, 3009))
    );

    public function showProductPage($modelId = 1001) {

        $model = ProductModelView::findOrFail($modelId);
        $params['model'] = $model;

        $params['pageTitle'] = $model->model_name_cn . " - 目光之城";

        $params['product'] = $model->productViews()->firstOrFail();
        $params['products'] = $model->productViews;
        $params['lensTypes'] = LensType::all();
        return View::make('pages.product', $params);
    }

    public function showIndexPage() {

        $products = array();
        $wideModelIds = array();

        foreach (self::$productLabels as $labelName => $labelValue) {
            //use variable variable name to form model groups of diffrent featured labels
            $modelGroupName = $labelName . 'Models';
            $$modelGroupName = ProductModelView::where('featured_label', '=', $labelValue['id'])->take(4)->get();
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

}
