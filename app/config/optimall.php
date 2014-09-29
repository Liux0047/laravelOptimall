<?php

return array(
    /*
     * Optiamll site specific configs
     */
    'lazyloadImg'=>'images/lazyload-holder.png',
    
    'smallViewImg'=>'small-view.jpg',

    'orderCodeLength' => 8,
    
    'orderNumberPrefixLength' => 8,
    
    //number of items on gallery page
    'itemsOnPage' => 12,
    
    //the percentage of ambassador rewards for first purchase
    'ambassadorFirstReward'=> 0.2,
    
    //the percentage of ambassador rewards for subsequent purchase
    'ambassadorSubsequentReward'=> 0.1,    
    
    //the percentage off for an invited member by ambassador
    'ambassadorInvitedReward'=> 0.15,    
    
    //single order reward cap
    'ambassadorRewardCap'=> 50,
    
    //the ambassador subsequent reward period (in days)
    'ambassadorSubsequentPeriod'=> 60,
    
    //the number of days after which an order is confirmed
    'ambassadorOrderConfirmation'=> 40,
    
    //the number of days after which the reward is not claimable
    'ambassadorClaimDuration'=> 365,
    
    //the minimum amount that an ambassador can claim
    'minAmbassadorClaim'=> 80,

    //max image upload size, in M
    'maxImageUploadSize' => 4,

    //path for review pictures uploads
    'reviewPicPath' => public_path().DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'reviews'.DIRECTORY_SEPARATOR,

    //path to refund picture uploads
    'refundPicPath' => public_path().DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'refunds'.DIRECTORY_SEPARATOR,

        
);
