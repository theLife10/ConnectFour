<?php
Class Board{
    //2d array
    var $board = array(array());
    function __construct() {
        
        $this->board=array(array());
        
        for($row=0; $row < 6; $row++){
            for($column=0; $column < 7; $column){
                $this->board[$row][$column] = 0;
                
            }
            
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