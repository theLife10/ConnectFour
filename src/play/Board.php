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
    function printBoard(){
        for ($i = 0; $i < 6; $i++) {
            for ($j = 0; $j < 7; $j++) {
                echo $this->gameBoard[$i][$j] . " ";
            }
            echo "<br>";
        }
    }
    
    public static $EMPTY ="";
    
    public static function emptyBoard(){
        if( empty( self::$EMPTY ) ) {
            
            self::$EMPTY = new self();
            
            return self::$EMPTY;
        }
    }  
   
}

?>
