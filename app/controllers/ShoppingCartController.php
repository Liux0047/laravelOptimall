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
    public static $prescriptionOptions = array(
        'O_S_SPH' => array('min' => 0, 'max' => 800, 'internval' => 25),
        'O_S_CYL' => array('min' => 0, 'max' => 200, 'internval' => 25),
        'O_S_AXIS' => array('min' => 0, 'max' => 180, 'internval' => 1),
        'O_S_ADD' => array('min' => 0, 'max' => 800, 'internval' => 25),
        'O_D_SPH' => array('min' => 0, 'max' => 800, 'internval' => 25),
        'O_D_CYL' => array('min' => 0, 'max' => 200, 'internval' => 25),
        'O_D_AXIS' => array('min' => 0, 'max' => 180, 'internval' => 1),
        'O_D_ADD' => array('min' => 0, 'max' => 800, 'internval' => 25),
        'PD' => array('min' => 50, 'max' => 80, 'internval' => 0.5)
    );
    private $totalPrice = 0;
    private $totalDiscount = 0;
    private $netPrice = 0;

    public function showShoppingCartPage() {
        $params['pageTitle'] = "购物车 - 目光之城";
        $params['O_S_LEFTNames'] = self::$O_S_LEFTNames;
        $params['O_D_RIGHTNames'] = self::$O_D_RIGHTNames;
        $params['CommonNames'] = self::$CommonNames;
        $params['prescriptionOptions'] = self::getPrescriptionOptionList();

        $items = $this->getCartItems();
        $params['items'] = $items;

        $isAllPrescriptionComplete = true;
        foreach ($items as $item) {
            $isEntered = $this->isPrescriptionEntered($item);
            $params['isPrescriptionEntered'][$item->order_line_item_id] = $isEntered;
            if (!$isEntered && !$item->is_plano) {
                $isAllPrescriptionComplete = false;
            }
        }
        $params['isAllPrescriptionComplete'] = $isAllPrescriptionComplete;
        $params['storedPrescriptions'] = Prescription::ofMember(Auth::id())->get();
        
        if (Session::has('couponId')){
            $coupon = Coupon::find(Session::get('couponId'));
            $params['couponCode'] = $coupon->coupon_code;
            $this->calculatePrice($items, $coupon);
        }
        else {
            $params['couponCode'] = "";
            $this->calculatePrice($items, $coupon);
        }

        $params['totalPrice'] = $this->totalPrice;
        //implement discount
        $params['totalDiscount'] = $this->totalDiscount;
        //get net price
        $params['netPrice'] = $this->netPrice;

        return View::make('pages.shopping-cart', $params);
    }
    
    public function showCheckoutPage () {
        $params['pageTitle'] = "结算 - 目光之城";
        
        $items = $this->getCartItems();
        $params['items'] = $items;
        foreach ($items as $item) {
            if (!$this->isPrescriptionEntered($item) && !$item->is_plano) {
                return Redirect::to('shopping-cart')->with('warning', '请完整填写所有验光单'); 
            }
        }
        
        $addresses = Address::ofMember(Auth::id())->get();
        $params['addresses'] = $addresses;
        foreach ($addresses as $address) {
            if ($address->is_default){
                $params['selectedAddress'] = $address;
                break;
            }
            $params['selectedAddress'] = $address[0];
        }
        $params['newAddress'] = new Address;
        
        $params['O_S_LEFTNames'] = self::$O_S_LEFTNames;
        $params['O_D_RIGHTNames'] = self::$O_D_RIGHTNames;
        $params['CommonNames'] = self::$CommonNames;
        
        return View::make('pages.checkout', $params);
    }

    public function AddItem() {
        $item = new OrderLineItem;
        $item->product = Input::get('product_id');
        $item->lens_type = Input::get('lens_type');
        $item->quantity = 1;
        $item->member = Auth::id();
        $item->is_plano = 0;
        $item->save();
        return Redirect::to('shopping-cart')->with('message', '成功添加商品');
    }

    public function updatePrescription() {
        $prescriptionNames = array_merge(self::$O_S_LEFTNames, self::$O_D_RIGHTNames, self::$CommonNames);
        $orderLineItem = $this->getItembyFromPost();
        foreach ($prescriptionNames as $prescriptionName) {
            $orderLineItem->$prescriptionName = Input::get($prescriptionName);
        }
        $orderLineItem->save();

        if (Input::get('remember_prescription')) {
            $this->savePrescription();
        }

        return Redirect::to('shopping-cart')->with('message', '成功填写验光单');
    }

    public function incrementQuatity() {
        $orderLineItem = $this->getItembyFromPost();
        $orderLineItem->quantity += 1;
        $orderLineItem->save();
        //re-calculate the price and send response
        return Response::json($this->getUpdateQuantityResponse($orderLineItem));
    }

    public function decrementQuatity() {
        $orderLineItem = $this->getItembyFromPost();
        if ($orderLineItem->quantity > 1) {
            $orderLineItem->quantity -= 1;
        }
        $orderLineItem->save();
        //re-calculate the price and send response
        return Response::json($this->getUpdateQuantityResponse($orderLineItem));
    }

    public function removeItem() {
        $orderLineItem = $this->getItembyFromPost();
        $orderLineItem->delete();
        return Redirect::to('shopping-cart')->with('message', '成功移除此商品');
    }

    public function setPlano() {
        $orderLineItem = $this->getItembyFromPost();
        $orderLineItem->is_plano = 1;
        $orderLineItem->save();
        return Redirect::to('shopping-cart')->with('message', '成功修改验光单');
    }

    public function applyCoupon() {
        $coupon = Coupon::validCoupon(Input::get('coupon_code'))->first();
        if (isset($coupon)) {    //if a valid coupon was found
            if ($coupon->couponUsages()->where('member', '=', Auth::id())->count()) {
                //if this coupon has been used
                return Redirect::to('shopping-cart')->with('warning', '消费卷无效或者已经过期');
            } else {
                Session::put('couponId', $coupon->coupon_id);
                return Redirect::to('shopping-cart')->with('message', '成功添加消费卷');
            }
        } else {
            return Redirect::to('shopping-cart')->with('warning', '消费卷无效或者已经过期');
        }
    }

    public static function getPrescriptionOptionList() {
        $list = array();
        foreach (self::$prescriptionOptions as $optionName => $optionRange) {
            for ($option = $optionRange['min']; $option <= $optionRange['max']; $option += $optionRange['internval']) {
                $list[$optionName][] = $option;
            }
        }
        return $list;
    }

    public static function getNumberOfItems() {
        if (!Auth::check()) {
            return 0;
        } else {
            return OrderLineItemView::ofMember(Auth::id())->count();
        }
    }

    private function getItembyFromPost() {
        $itemId = Input::get('order_line_item_id');
        return OrderLineItem::find($itemId);
    }

    private function getCartItems() {
        return OrderLineItemView::ofMember(Auth::id())->get();
    }

    private function calculatePrice($items, $coupon) {
        $this->totalPrice = 0;
        $this->totalDiscount = 0;
        $this->netPrice = 0;
        foreach ($items as $item) {
            $this->totalPrice += ($item->price + $item->lens_price) * $item->quantity;
        }
        //calculate discount
        if ($coupon->discount_type == 1){
            $this->totalDiscount = $coupon->discount_value;
        }
        else if ($coupon->discount_type == 2){
            $this->totalDiscount = $this->totalPrice * $coupon->discount_value;
        }
        else {
            $this->totalDiscount = 0;
        }
        $this->netPrice = $this->totalPrice - $this->totalDiscount;
    }

    private function getUpdateQuantityResponse($orderLineItem) {
        $this->calculatePrice($this->getCartItems());
        $price = $orderLineItem->product()->first()->productModel()->first()->price;
        return array(
            'quantity' => $orderLineItem->quantity,
            'itemTotal' => $orderLineItem->quantity * $price,
            'totalPrice' => $this->totalPrice,
            'discountAmount' => $this->totalDiscount,
            'netAmount' => $this->netPrice
        );
    }

    private function isPrescriptionEntered($orderLineItem) {
        $prescriptionNames = array_merge(self::$O_S_LEFTNames, self::$O_D_RIGHTNames, self::$CommonNames);
        foreach ($prescriptionNames as $prescriptionName) {
            if (!isset($orderLineItem->$prescriptionName)) { //false if at least one entry is blank
                return false;
            }
        }
        return true;
    }

    private function savePrescription() {
        $prescription = new Prescription;
        $prescriptionNames = array_merge(self::$O_S_LEFTNames, self::$O_D_RIGHTNames, self::$CommonNames);
        foreach ($prescriptionNames as $prescriptionName) {
            $prescription->$prescriptionName = Input::get($prescriptionName);
        }
        $prescription->name = Input::get('prescription_name');
        $prescription->member = 58;
        $prescription->save();
    }

}
