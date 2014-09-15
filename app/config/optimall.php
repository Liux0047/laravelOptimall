<?php

return array(
    /*
     * Optiamll site specific configs
     */
    'lazyloadImg'=>'images/lazyload-holder.png',
    
    'smallViewImg'=>'medium-view-3.jpg',

    'orderCodeLength' => 8,
    
    //number of items on gallery page
    'itemsOnPage' => 12,
    
    //the percentage of ambassador rewards for first purchase
    'ambassadorFirstReward'=> 0.2,
    
    //the percentage of ambassador rewards for subsequent purchase
    'ambassadorSubsequentReward'=> 0.1,
    
    //the ambassador subsequent reward period (in days)
    'ambassadorSubsequentPeriod'=> 60,
    
    //the number of days after which an order is confirmed
    'ambassadorOrderConfirmation'=> 40,
    
    //the number of days after which the reward is not claimable
    'ambassadorClaimDuration'=> 365,
    
    //the minimum amount that an ambassador can claim
    'minAmbassadorClaim'=> 80,
    
);
