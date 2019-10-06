<?php
require_once '../play/Board.php'; 
require_once '../play/Random.php';

$move = $_GET['move'];
$pid = $_GET['pid'];
$currentBoard = new Board();
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
 //     $board = $info["board"]["gameBoard"];
      
      $currentBoard ->refreshBoard($pid);
      
      
     //  $random = new Random($board,$move);
     
      $randomToken = rand(0,6);
      $currentBoard->dropInSlot($move, 1);
      $currentBoard->dropInSlot($randomToken, 2);
     
        
    //   $randomToken = $random->getPosition();
        
        
        
            $response = array('response'=> true, 
                'ack_move'=> array(
                    'slot'=> $move,
                    'isWin' => false, 
                    'isDraw' => false, 
                    'row' =>[] ),
                'move' => array(
                    'slot' => $randomToken, 
                    'isWin' => false, 
                    'isDraw' => false, 
                    'row' => []
                )
                
            );
            
        
                
            
          
        
        $currentBoard -> writeInformation($pid);
        
    }
    echo json_encode($response);
   
}
    
    
    

?>



