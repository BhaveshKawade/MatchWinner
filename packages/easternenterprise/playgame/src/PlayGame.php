<?php
namespace EasternEnterprise\PlayGame;
use EasternEnterprise\PlayGame\TwoTeamsGame;

class PlayGame{
    private $match;

    public function __construct( $match ){
        $this->match=$match;
        $this->match->validateTeamsMembers();
    }    

    function matchDetails(){
        return $this->match;
    }

    function matchResult(){
        return $this->match->getResult();
    }
}