<?php
/**
 * Created by PhpStorm.
 * User: Allen
 * Date: 3/10/2015
 * Time: 10:28 AM
 */

class VoteController extends BaseController{

    const LASER_ENGRAVING = 1;

    public function postVote () {

        $vote = new Vote;
        $vote->vote_program = VoteController::LASER_ENGRAVING;
        $vote->like = Input::get('is_for', 0);
        $vote->save();

        Cookie::queue('hasVoted', '1', 36000);
        return Response::json(array('success' => '1'));

    }
}