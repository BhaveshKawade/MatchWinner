<?php 

namespace EasternEnterprise\PlayGame;

class TwoTeamsGame{
    private $teamA,$teamB;
    private $teamASort;
    private $countTeamMembers=5;
    private $totalTeams=2;
    
    function __construct($teamA, $teamB ){
        $this->teamA=new Team($teamA);
        $this->teamB=new Team($teamB);        
    }


    function validateTeamsMembers(){
        
        $this->teamA->countPlayers($this->countTeamMembers);
        $this->teamB->countPlayers($this->countTeamMembers);
        $this->teamA->numericDrain();
        $this->teamB->numericDrain() ;
        return true;
    }

    function getResult(){  
        $this->compareScore();
        if(count($this->teamASort)==$this->countTeamMembers){
            return "Win";
        }else{
            return "Lose";
        }
        
    }

    function getTeamAChangeDrain(){
        if(!empty($this->teamASort)){
            return implode(',',$this->teamASort);
        }else{
            return '';
        }
    }


    function compareScore(){  
        $drainUsed=[];
        $closestDrain=[];
        
        $teamADrain=$this->teamA->playersDrain();
        $teamBDrain=$this->teamB->playersDrain();
        
        for ($i=0; $i<$this->countTeamMembers; $i++ ){            
            $getDrain='';            
            for ( $j=0; $j<$this->countTeamMembers; $j++ ){        
                if($teamBDrain[$i] < $teamADrain[$j] ){                    
                    $getDrain = $this->getClosestDrain($closestDrain, $teamADrain[$j], $teamBDrain[$i] ,$drainUsed ,$getDrain);
                }        
            }    
            $drainUsed[$getDrain]=$i;
            if(!empty($getDrain)){
                $this->teamASort[]=$getDrain;
            }            
        }
    }


    function getClosestDrain(&$closestDrain, $teamADrain, $teamBDrain,$drainUsed,$getDrain){
        
        $returnDrain=$getDrain;
        
        $diffBetweenDrain=$teamADrain-$teamBDrain;

        if(isset($closestDrain[$teamBDrain])  ){                    
            
            if($closestDrain[$teamBDrain] > $diffBetweenDrain && !isset($drainUsed[$teamADrain])){                
                $closestDrain[$teamBDrain]=$diffBetweenDrain;
                $returnDrain=$teamADrain;            
            }
        } else{
            if(!isset($drainUsed[$teamADrain])){
                
                $closestDrain[$teamBDrain]=$diffBetweenDrain;
                $returnDrain=$teamADrain;
            }            
        }
        return $returnDrain;
    }




}