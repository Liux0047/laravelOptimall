<?php

/**
 * Description of PrescriptionController
 *
 * @author Allen
 */
class PrescriptionController extends BaseController {

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

    public static function getPrescriptionNames() {
        $names['O_S_LEFTNames'] = self::$O_S_LEFTNames;
        $names['O_D_RIGHTNames'] = self::$O_D_RIGHTNames;
        $names['CommonNames'] = self::$CommonNames;        
        return $names;
    }
    
    public static function getPrescriptionNameArray (){
        return array_merge(self::$O_S_LEFTNames, self::$O_D_RIGHTNames, self::$CommonNames);
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
    
    public static function savePrescription() {
        $prescription = new Prescription;
        $prescriptionNames = self::getPrescriptionNameArray();
        foreach ($prescriptionNames as $prescriptionName) {
            $prescription->$prescriptionName = Input::get($prescriptionName);
        }
        $prescription->name = Input::get('prescription_name');
        $prescription->member_id = Auth::id();
        $prescription->save();
    }

}
