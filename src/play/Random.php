<?php

class Random{ 
    public $rand;
    function __construct($board,$move){
        $checkForColumn = array();
       
        for($i = 0; $i < 6; $i++){
            if($board[0][$i] == 0){
                array_push($checkForColumn,$i);
            }
        }
        $this->rand = array_rand($checkForColumn,1);
        
    }
    
    function getPosition(){
        return $this->rand;
    }
    
    
}
?>