<?php
/**
 * Description of ShoppingCartController
 *
 * @author Allen
 */
class ShoppingCartController extends BaseController {
    public static $O_S_LEFTNames = array('O_S_SPH', 'O_S_CYL', 'O_S_AXIS', 'O_S_ADD');
    public static $O_D_RIGHTNames = array('O_D_SPH', 'O_D_CYL', 'O_D_AXIS', 'O_D_ADD');
    public static $CommonNames = array('PD');
    
    const ADD_TO_CART = 1;
    const UPDATE_PRESCRIPTION = 2;
    const INCREMENT_QUANTITY = 3;
    const DECREMENT_QUANTITY = 4;            
    const REMOVE_ITEM = 5;
    const SET_PLANO = 6;
    const APPLY_COUPON = 7;
    
    public static $prescriptionOptions = array(
        'O_S_SPH' => array('min'=>0, 'max'=>800,'internval'=>25),
        'O_S_CYL' => array('min'=>0, 'max'=>200,'internval'=>25),
        'O_S_AXIS' => array('min'=>0, 'max'=>180,'internval'=>1),
        'O_S_ADD' => array('min'=>0, 'max'=>800,'internval'=>25),
        'O_D_SPH' => array('min'=>0, 'max'=>800,'internval'=>25),
        'O_D_CYL' => array('min'=>0, 'max'=>200,'internval'=>25),
        'O_D_AXIS' => array('min'=>0, 'max'=>180,'internval'=>1),
        'O_D_ADD' => array('min'=>0, 'max'=>800,'internval'=>25),
        'PD' => array('min'=>50, 'max'=>80,'internval'=>0.5)
    );
    
    
    public function showShoppingCartPage() {
        
        $params['pageTitle'] = "购物车 - 目光之城";
        $params['O_S_LEFTNames'] = self::$O_S_LEFTNames;
        $params['O_D_RIGHTNames'] = self::$O_D_RIGHTNames;
        $params['CommonNames'] = self::$CommonNames;
        $params['prescriptionOptions'] = self::getPrescriptionOptionList();
        
        $items = OrderLineItem::whereNull('order_id')->get();        
        $params['items'] = $items;
        
        $totalPrice = 0;
        foreach ($items as $item){
            $totalPrice += $item->price;
        }
        $params['totalPrice'] = $totalPrice;
        
        //implement discount
        $totalDiscount = 0;
        $params['totalDiscount'] = $totalDiscount;   
        //get net price
        $params['netPrice'] = $totalPrice - $totalDiscount;       
        
        $params['addToCartAction'] = self::ADD_TO_CART;
        $params['updatePrescriptionAction'] = self::UPDATE_PRESCRIPTION;        
        $params['incrementQuantityAction'] = self::INCREMENT_QUANTITY;
        $params['decrementQuantityAction'] = self::DECREMENT_QUANTITY;
        $params['removeItemAction'] = self::REMOVE_ITEM;
        $params['setPlanoAction'] = self::SET_PLANO;
        $params['applyCoupnAction'] = self::APPLY_COUPON;        
        
        return View::make('shopping-cart', $params);
    }
    
    public static function getPrescriptionOptionList(){
        $list = array();
        foreach (self::$prescriptionOptions as $optionName => $optionRange){
            for ($option = $optionRange['min']; $option<= $optionRange['max']; $option += $optionRange['internval']){
                $list[$optionName][] = $option;
            }            
        }
        return $list;
    }
    
    public static function getNumberOfItems (){
        return count(OrderLineItem::whereNull('order_id')->get());
    }

}
