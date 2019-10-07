<?php
require_once '../play/Board.php'; 
require_once '../play/Random.php';
require_once '../play/Varibles.php';

$move = $_GET['move'];
$pid = $_GET['pid'];


$info = json_decode(file_get_contents("../writable/$pid.txt"),true);


if( !array_key_exists("pid", $_GET) ){
    $response = array(
        'response' => false,
        'reason' => "PID not specified"
    );
    echo json_encode($response);
}
else if(!file_exists("../writable/".$_GET['pid'].".txt")){
    $response = array(
        'response' => false,
        'reason' => "Unknown pid"
    );
    echo json_encode($response);
}
else if(!array_key_exists("move", $_GET)){
    $response = array(
        'response' => false,
        'reason' => "Move not specified"
    );
    echo json_encode($response);
}
else if($move < 0 || $move >= 7){
     $response = array(
         'response' => false,
         'reason' => "Invalid slot, $move"
     );
     echo json_encode($response);
 }
else{
    
    if(strcasecmp($info["strategy"], "Random") == 0){
 
       $file = "../writable/".$pid.".txt";
       $json = file_get_contents($file);
        
      $current=Board::refreshBoard($json);
      
      
     
      $randomToken = rand(0,6);
     $determine = $current->overallfunction($move, 1);
     $randDetermine=$current->overallfunction($randomToken, 2);
       
    
     
            $response = array('response'=> true, 
                'ack_move'=> array(
                    'slot'=> $move,
                    'isWin' => $determine == varibles::$isWin, 
                    'isDraw' => $determine == varibles::$isDraw, 
                    'row' => ($determine == varibles::$isWin) ? $current->play_path : [] ),
                'move' => array(
                    'slot' => $randomToken, 
                    'isWin' => $randDetermine == varibles::$isWin, 
                    'isDraw' => $randDetermine == varibles::$isDraw, 
                    'row' => ($randDetermine == varibles::$isWin) ? $current->play_path : [] 
                )
                
            );    
        
        $current -> writeInformation($pid);
           
    }
    
    if(strcasecmp($info["strategy"], "Smart") == 0){
        
        $file = "../writable/".$pid.".txt";
        $json = file_get_contents($file);
        
        $current=Board::refreshBoard($json);
        
        
        
        $smartToken = rand(0,6);
        
        $determine = $current->overallfunction($move, 1);
        if($smartToken-1 < 0){
            $smartToken = $smartToken+2;
        }
        if($smartToken >= 7){
            $smartToken = $smartToken-3;
        }
        $randDetermine=$current->overallfunction($smartToken, 2);
        
        
        
        $response = array('response'=> true,
            'ack_move'=> array(
                'slot'=> $move,
                'isWin' => $determine == varibles::$isWin,
                'isDraw' => $determine == varibles::$isDraw,
                'row' => ($determine == varibles::$isWin) ? $current->play_path : [] ),
            'move' => array(
                'slot' => $smartToken,
                'isWin' => $randDetermine == varibles::$isWin,
                'isDraw' => $randDetermine == varibles::$isDraw,
                'row' => ($randDetermine == varibles::$isWin) ? $current->play_path : []
            )
            
        );
        
        $current -> writeInformation($pid);
        
    }
    
    echo json_encode($response);
   
}
    
    
    

?>



