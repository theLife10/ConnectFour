<?php
Class Board{
    //2d array
    public $gameBoard=array();
    
    
    function __construct(){
       
        for($row=0; $row < 7; $row++){
            for($column=0; $column < 6; $column++){
                $this->gameBoard[$row][$column]=0;
            }
        }
       
       
    }
    
    function printBoard($grid){
        for ($i = 0; $i < 7; $i++) {
            for ($j = 0; $j < 6; $j++) {
                echo $grid[$i][$j] . " ";
            }
            echo "<br>";
        }
    }
    
    
    function writeInformation($pid){
        $data = json_decode(file_get_contents("../writable/$pid.txt"),true);
        $strategy = $data["strategy"];
        $info = array(
            "pid" => $pid,
            "strategy" => $strategy,
            "grid" => $this->gameBoard,
            "isWin" => ""          
        );
        
        $file_path = "../writable/" . $pid . '.txt';
       
        file_put_contents($file_path, json_encode($info));
       
    } 
    
     function dropInSlot($slot, $player) {
         for($i = 5; $i >= 0; $i--){
             if($this->gameBoard[$slot][$i] == 0){
                 $this->gameBoard[$slot][$i] =$player;
                // exit;
                break;
             }
         }
         
     }
     
     function refreshBoard($pid){
         $saved = json_decode(file_get_contents("../writable/" . "$pid.txt"), true);
         // New instance to restore game
         $boardd = new self();
         
         // Build Board from saved data
         $boardd->gameBoard = $saved["grid"];
         
         return $boardd;
     }
 
   
}

?>
