<?php
Class Board{
    //2d array
    public $gameBoard=array();
   
    function __construct(){
       
        for($row=0; $row < 6; $row++){
            for($column=0; $column < 7; $column++){
                $this->gameBoard[$row][$column]=0;
            }
        }
       
       
    }
    
    function printBoard($grid){
        for ($i = 0; $i < 6; $i++) {
            for ($j = 0; $j < 7; $j++) {
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
            "flag" => false,
            "isWin" => ""          
        );
        
        $file_path = "../writable/" . $pid . '.txt';
       
        file_put_contents($file_path, json_encode($info));
        
        
       
    } 
    
     function dropInSlot($slot, $player) {
         for($i = 5; $i >= 0; $i--){
             if($this->gameBoard[$i][$slot] == 0){
                // $this->gameBoard[$i][$slot] =$player;
                // exit;
                $firstAva = $i;
                break;
             }
         }
         
        
         $this->gameBoard[$firstAva][$slot] =$player;   
        
     }
     
     public static function refreshBoard($json){
        
         $saved = json_decode($json, true);
         // New instance to restore game
         $boardd = new Board();
        
         // Build Board from saved data
         if($saved["flag"]== true){
             $boardd ->gameBoard = $saved["grid"]["gameBoard"];
             $saved["flag"]=false;
         }else{
             $boardd->gameBoard= $saved["grid"];
         }
           
        
         
         return $boardd;
     }
     
     function checkForWin($row,$column) {
         if($this->verticalLine($row, $column)==true){
             return true;
         }
     }
     
      function verticalLine($row,$col){
          $grid = $this->gameBoard[$row][$col];
          if ( $row >= 3 ) { 
              return false;
          }     
                  
          for ( $i = $row + 1; $i <= $row + 3; $i++ ){           
              if($this->gameBoard[$i][$col] !== $grid){  
                  return false;            
              }
              
          }
          
          
          return true;
      }
 
   
}

?>
