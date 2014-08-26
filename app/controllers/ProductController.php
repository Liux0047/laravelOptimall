<?php
/**
 * Description of ProductController
 *
 * @author Allen
 */
class ProductController extends BaseController {
    
    public function showProductPage($modelId = 1001) {
        
        $model = ProductModel::findOrFail($modelId);
        $params['model'] = $model;
        
        $params['pageTitle'] = $model->model_name_cn." - 目光之城";        
        
        $params['product'] = $model->products()->firstOrFail();
        $params['products'] = $model->products;
        $params['lensTypes'] = LensType::all();
        return View::make('product', $params);
    }

}

