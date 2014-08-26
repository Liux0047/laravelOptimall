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

}
