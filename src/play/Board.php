<?php
require_once '../play/Varibles.php';
Class Board{
    //2d array
    public $gameBoard=array();
   public $play_path = array();
   public  $count =0;
   public $won =FALSE;
   public $winGame=false;
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
    
     function dropInSlot($slot) {
         $firstAva=0;
         for($i = 5; $i >= 0; $i--){
             if($this->gameBoard[$i][$slot] == 0){
                
                $firstAva = $i;
                break;
             }
         }
         
        
        
        return $firstAva;
        
     }
     
     public static function refreshBoard($json){
        
         $saved = json_decode($json, true);
         
         $boardd = new Board();
        
        
         if($saved["flag"]== true){
             $boardd ->gameBoard = $saved["grid"]["gameBoard"];
             $saved["flag"]=false;
         }else{
             $boardd->gameBoard= $saved["grid"];
         }
           
        
         
         return $boardd;
     }
     
     function overallfunction($slot,$player){
        
         $ava = $this->dropInSlot($slot);
         
        
         $this->gameBoard[$ava][$slot] = $player;
         $this->count ++;
         
         
         if ($this->count == 42)
             return varibles::$isDraw;
            
             
             for ($dir = 1; $dir <= 8; $dir ++) {
                 $this->winGame = $this->checkWin($ava,$slot);
                
                 if($this->winGame){
                     $temp_path = $this->play_path;
                    
                     array_push($temp_path, $slot, $ava);
                     $this->play_path = $temp_path;
                     return varibles::$isWin;
                 }
             }
             
             return false;
     }
     
      function checkWin($row, $column){

          if( $this->verticalLine($row,$column) || $this -> horizonalLine($row, $column) || $this->diagnolone($row, $column) || $this->diagnoltwo($row, $column)){
              return true;
          }
          return false;
      }
     
    
     function verticalLine($row,$column){
         $board = $this->gameBoard;
         
         for($column =0; $column < count($board[0]); $column++){
             for($row=0; $row < 3; $row++){
                 if($board[$row][$column] != 0 && $board[$row][$column] == $board[$row+1][$column]
                     && $board[$row][$column] == $board[$row+2][$column] && $board[$row][$column] == $board[$row+3][$column])
                 {
                     return true;
                 }
             }
         }
         
         return false;
     }
     
     function horizonalLine($row,$column) {
         $board = $this->gameBoard;
         for($row=0; $row < count($board); $row++){
             for($column=0; $column < count($board[$row])-3; $column++){
                 if($board[$row][$column] != 0 && $board[$row][$column] == $board[$row][$column+1]
                     && $board[$row][$column] == $board[$row][$column+2] &&
                     $board[$row][$column] == $board[$row][$column+3]){
                     return true;
                     
                 }
             }
         }
         return false;
         
     }
     function diagnolone($row,$column){
         $board = $this->gameBoard;
         
         for($row =0; $row < count($board)-3; $row++){
             for($column=0; $column < count($board[$row])-3; $column++){
                 if($board[$row][$column] != 0 && $board[$row][$column] == $board[$row+1][$column+1] &&
                     $board[$row][$column] == $board[$row+2][$column+2] && $board[$row][$column] == $board[$row+3][$column+3]){
                     return true;
                 }
             }
         }
         return false;
     }
     function diagnoltwo($row,$column){
         $board = $this->gameBoard;
         
         for($row =0; $row < count($board)-3; $row++){
             for($column=3; $column < count($board[$row]); $column++){
                 if($board[$row][$column] != 0 && $board[$row][$column] == $board[$row+1][$column-1] &&
                     $board[$row][$column] == $board[$row+2][$column-2] && $board[$row][$column] == $board[$row+3][$column-3]){
                         return true;
                 }
             }
         }
     }
     
     
}

?>
