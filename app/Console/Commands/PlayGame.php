<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use EasternEnterprise\PlayGame as Game;

class PlayGame extends Command
{
    protected $signature = 'play:game';

    protected $description = 'Play Game Between Two Teams';
        
    public function __construct(){
        parent::__construct();
    }    

    
    /*
    * @description - Check team A Win or Lose 
    * @return String Win or Lose
    * Note: to check newly sorted team A can use $playGame->matchDetails()->getTeamAChangeDrain() 
    */
    public function handle(){
        try{
            $teamA = $this->ask('Enter A team players:');
            $teamB = $this->ask('Enter B team players:');
            $playGame=new Game\PlayGame(new Game\TwoTeamsGame($teamA,$teamB));
            $this->line($playGame->matchResult());
        }catch(\Exception $e){
            $this->line("Match can not play ". $e->getMessage());
        }
    }
}
