<?php

/**
 * Description of ShoppingCartController
 *
 * @author Allen
 */
class ShoppingCartController extends BaseController
{

    private $totalPrice = 0;
    private $totalDiscount = 0;
    private $netPrice = 0;

    public function __construct()
    {
        $items = $this->getCartItems();
        $coupon = CouponController::getCoupon();
        $this->calculatePrice($items, $coupon);
    }

    public function getMyCart()
    {
        $params['pageTitle'] = "购物车 - 目光之城";
        $params['prescriptionNames'] = PrescriptionController::getPrescriptionNames();
        $params['prescriptionOptions'] = PrescriptionController::getPrescriptionOptionList();

        $items = $this->getCartItems();
        $params['items'] = $items;

        $isAllPrescriptionComplete = true;
        foreach ($items as $item) {
            $isRequired = $this->isPrescriptionRequired($item);
            $isEntered = $this->isPrescriptionEntered($item);
            $params['isPrescriptionEntered'][$item->order_line_item_id] = $isEntered;
            $params['isPrescriptionRequired'][$item->order_line_item_id] = $isRequired;
            if ($isRequired) {
                if (!$isEntered) {
                    $isAllPrescriptionComplete = false;
                }
            }
        }
        $params['isAllPrescriptionComplete'] = $isAllPrescriptionComplete;
        $params['storedPrescriptions'] = Auth::user()->prescriptions;

        $coupon = CouponController::getCoupon();
        $params['coupon'] = $coupon;
        $this->calculatePrice($items, $coupon);

        $params['totalPrice'] = $this->totalPrice;
        $params['totalDiscount'] = $this->totalDiscount;
        $params['netPrice'] = $this->netPrice;

        return View::make('pages.shopping-cart', $params);
    }

    public function getCheckout()
    {
        $params['pageTitle'] = "结算 - 目光之城";

        $items = $this->getCartItems();
        if (count($items) == 0) {
            return Redirect::to('/');
        }
        $params['items'] = $items;
        foreach ($items as $item) {
            $isRequired = $this->isPrescriptionRequired($item);
            $params['isPrescriptionRequired'][$item->order_line_item_id] = $isRequired;
            if ($isRequired) {
                if (!$this->isPrescriptionEntered($item)) {
                    return Redirect::action('ShoppingCartController@getMyCart')
                        ->with('error', '请完整填写所有验光单');
                }
            }
        }
        $coupon = CouponController::getCoupon();
        $this->calculatePrice($items, $coupon);

        $params['totalDiscount'] = $this->totalDiscount;
        $params['netPrice'] = $this->netPrice;

        $addresses = Auth::user()->addresses;
        $params['addresses'] = $addresses;
        if (count($addresses)) {    //if has address
            $params['selectedAddress'] = $addresses[0];
            foreach ($addresses as $address) {
                if ($address->is_default) {
                    $params['selectedAddress'] = $address;
                    break;
                }
            }
        }
        $params['newAddress'] = new Address;

        $params['prescriptionNames'] = PrescriptionController::getPrescriptionNames();

        return View::make('pages.checkout', $params);
    }

    public function getAddItem()
    {
        if ($this->isProductInCart(Input::get('product_id'))) { // if this product already been added to cart
            if (Request::ajax()) {
                return Response::json(array('success' => true, 'num_cart_items' => self::getNumberOfItems()));
            } else {
                return Redirect::action('ShoppingCartController@getMyCart')->with('status', '该商品已经在您的购物车中');
            }
        } else {
            $item = new OrderLineItem;
            $item->product_id = Input::get('product_id');
            $item->lens_type_id = Input::get('lens_type');
            $item->quantity = 1;
            $item->member_id = Auth::id();
            $item->is_plano = 0;
            $item->save();
            if (Request::ajax()) {
                if (isset($item->order_line_item_id)) {
                    return Response::json(array('success' => true, 'num_cart_items' => self::getNumberOfItems()));
                } else {
                    return Response::json(array('success' => false));
                }
            } else {
                return Redirect::action('ShoppingCartController@getMyCart')->with('status', '成功添加商品');
            }
        }

    }

    public function postUpdatePrescription()
    {
        $prescriptionNames = PrescriptionController::getPrescriptionNameArray();
        $orderLineItem = $this->getItemFromPost();
        $orderLineItem->is_plano = 0;
        foreach ($prescriptionNames as $prescriptionName) {
            $orderLineItem->$prescriptionName = Input::get($prescriptionName);
        }
        $orderLineItem->save();

        if (Input::get('remember_prescription')) {
            PrescriptionController::savePrescription();
        }

        return Redirect::back()->with('status', '成功填写验光单');
    }

    public function postUpdateQuatity()
    {
        $orderLineItem = $this->getItemFromPost();
        if (Input::get('action') == 'increment') {
            $orderLineItem->quantity += 1;
        } else if (Input::get('action') == 'decrement') {
            if ($orderLineItem->quantity > 1) {
                $orderLineItem->quantity -= 1;
            }
        }
        $orderLineItem->save();
        //re-calculate the price and send response
        $coupon = CouponController::getCoupon();
        $this->calculatePrice($this->getCartItems(), $coupon);
        $price = $orderLineItem->product->productModel->price;
        $lensPrice = $orderLineItem->lensType->price;
        return Response::json(array(
            'quantity' => $orderLineItem->quantity,
            'itemTotal' => $orderLineItem->quantity * ($price + $lensPrice),
            'totalPrice' => $this->totalPrice,
            'discountAmount' => $this->totalDiscount,
            'netAmount' => $this->netPrice
        ));
    }

    public function postRemoveItem()
    {
        $orderLineItem = $this->getItemFromPost();
        if ($orderLineItem->member_id != Auth::id()) {
            return Redirect::back()->with('error', '无法移除此商品');
        }
        $orderLineItem->delete();
        return Redirect::back()->with('status', '成功移除此商品');
    }

    public function postSetPlano()
    {
        $orderLineItem = $this->getItemFromPost();
        if ($orderLineItem->member_id != Auth::id()) {
            return Redirect::back()->with('error', '无法修改验光单');
        }
        $orderLineItem->is_plano = 1;
        $orderLineItem->save();
        return Redirect::back()->with('status', '成功修改验光单');
    }

    public static function getNumberOfItems()
    {
        if (!Auth::check()) {
            return 0;
        } else {
            return OrderLineItemView::cartItems(Auth::id())->count();
        }
    }

    private function getItemFromPost()
    {
        $itemId = Input::get('order_line_item_id');
        return OrderLineItem::find($itemId);
    }

    private function getCartItems()
    {
        return OrderLineItemView::cartItems(Auth::id())->orderBy('created_at')->get();
    }

    private function calculatePrice($items, $coupon)
    {
        $this->totalPrice = 0;
        $this->totalDiscount = 0;
        $this->netPrice = 0;
        foreach ($items as $item) {
            $this->totalPrice += ($item->price + $item->lens_price) * $item->quantity;
        }
        //calculate discount
        if (isset($coupon)) {
            if ($coupon->discount_type_id == 1) {
                $this->totalDiscount = $coupon->discount_value;
            } else if ($coupon->discount_type_id == 2) {
                $this->totalDiscount = $this->totalPrice * $coupon->discount_value;
            } else {
                $this->totalDiscount = 0;
            }
        }

        $this->netPrice = $this->totalPrice - $this->totalDiscount;
    }

    private function isPrescriptionEntered($orderLineItem)
    {
        $prescriptionNames = PrescriptionController::getPrescriptionNameArray();
        foreach ($prescriptionNames as $prescriptionName) {
            if (!isset($orderLineItem->$prescriptionName)) { //false if at least one entry is blank
                return false;
            }
        }
        return true;
    }

    public function getTotalDiscount()
    {
        return $this->totalDiscount;
    }

    public function getNetPrice()
    {
        return $this->netPrice;
    }

    private function isPrescriptionRequired($item)
    {
        return $item->lens_type_id != 1 && !$item->is_plano;
    }

    private function isProductInCart($productId)
    {
        $count = OrderLineItemView::cartItems(Auth::id())
            ->where('product_id', '=', $productId)
            ->count();

        return ($count > 0);
    }
}
