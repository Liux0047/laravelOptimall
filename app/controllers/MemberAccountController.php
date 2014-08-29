<?php

/**
 * Description of MemberAccountController
 *
 * @author Allen
 */
class MemberAccountController extends BaseController {
    
    public function showShoppingHistory (){
        $params['pageTitle'] = "已下单 - 我的目光之城";
        
        $params['O_S_LEFTNames'] = ShoppingCartController::$O_S_LEFTNames;
        $params['O_D_RIGHTNames'] = ShoppingCartController::$O_D_RIGHTNames;
        $params['CommonNames'] = ShoppingCartController::$CommonNames;
        
        $orders = PlacedOrder::ofMember(Auth::id())->get();
        $params['orders'] = $orders;
        
        $items = array();
        foreach ($orders as $order) {
            $items[$order->order_id] = OrderLineItemView::ofOrder($order->order_id)->get();
        }
        $params['items'] = $items;
        return View::make('pages.shopping-history', $params);
    }
}
