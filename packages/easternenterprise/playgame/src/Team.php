<?php
namespace EasternEnterprise\PlayGame;

class Team{
    private $playersDrainString='';
    private $playersDrain=[];
    
    public function __construct( $playersDrain='' ){
        if ($playersDrain) { 
            $this->playersDrainString=$playersDrain;
            $this->playersDrain();
        }
    }    

    public function playersDrain(){
        return $this->playersDrain= explode(',',preg_replace('/\s+/', '', $this->playersDrainString));
    }
    
    public function numericDrain(){
        foreach ($this->playersDrain as $index => $drain) {
            if( !is_numeric($drain)){
                throw new \Exception("Only Numeric Drain is allowed");                
            }
        }
        return true;
    }

    public function countPlayers($totalTeamMemebrs){
        if(count($this->playersDrain())!=$totalTeamMemebrs){
            throw new \Exception("5 players allowed each team");
        }else{
            true;
        }
    }


}