<?php


/**
 * Description of AddressController
 *
 * @author Allen
 */
class AddressController extends BaseController {
    
    public static $addressFields = array('recipient_name','province','city','area','street_name', 'postal_code', 'phone');
    
    
    public function postAddAddress(){        
        $address = new Address;
        foreach (self::$addressFields as $addressField){
            $address->$addressField = Input::get($addressField);
        }
        //set all address as non-default
        Address::ofMember(Auth::id())->update(array('is_default' => 0));
        //set the newly added address as the default
        $address->is_default = true;
        $address->member = Auth::id();
        $address->save();
        return Redirect::back();
    }
    
    public function postUpdateAddress() {             
        $address = Address::find(Input::get('address_id'));
        foreach (self::$addressFields as $addressField){
            $address->$addressField = Input::get($addressField);
        }
        //set the newly updated address as the default
        $address->is_default = true;
        $address->save();
        return Redirect::back();
        
    }
    
    public function postUseAddress() {             
        $address = Address::find(Input::get('address_id'));
        //set all address as non-default
        Address::ofMember(Auth::id())->update(array('is_default' => 0));
        //set this address as the default        
        $address->is_default = true;
        $address->save();
        return Redirect::back();        
    }
    

}
