<?php

/**
 * Description of AddressController
 *
 * @author Allen
 */
class AddressController extends BaseController {

    public static $addressFields = array('recipient_name', 'province', 'city', 'area', 'street_name', 'postal_code', 'phone');

    public function postAddAddress() {

        $validator = $this->validateAddress();
        
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $address = new Address;
        foreach (self::$addressFields as $addressField) {
            $address->$addressField = Input::get($addressField);
        }
        //set all address as non-default
        Auth::user()->addresses()->update(array('is_default' => 0));
        //set the newly added address as the default
        $address->is_default = true;
        $address->member_id = Auth::id();
        $address->save();
        return Redirect::back();
    }

    public function postUpdateAddress() {

        $validator = $this->validateAddress();
        
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $address = Address::findOrFail(Input::get('address_id'));
        if ($address->member_id == Auth::id()) {
            foreach (self::$addressFields as $addressField) {
                $address->$addressField = Input::get($addressField);
            }
            //set the newly updated address as the default
            $address->is_default = true;
            $address->save();
            return Redirect::back();
        } else {
            return Redirect::back()->with('error', '不能使用此地址');
        }
    }

    public function postUseAddress() {
        $address = Address::findOrFail(Input::get('address_id'));
        if ($address->member_id == Auth::id()) {
            //set all address as non-default
            Auth::user()->addresses()->update(array('is_default' => 0));
            //set this address as the default        
            $address->is_default = true;
            $address->save();
            return Redirect::back();
        } else {
            return Redirect::back()->with('error', '不能使用此地址');
        }
    }

    private function validateAddress() {
        $rules = array(
            'recipient_name' => 'required|max:45',
            'province' => 'required|max:25',
            'city' => 'max:25',
            'area' => 'max:25',
            'street_name' => 'required|min:5|max:100',
            'postal_code' => 'required|digits_between:5,6',
            'phone' => 'required|min:8|max:20'
        );
        return Validator::make(Input::all(), $rules);
        
    }

}
