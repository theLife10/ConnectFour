<?php

$move = $_GET['move'];

if( !array_key_exists("pid", $_GET) ){
    $response = array(
        'response' => false,
        'reason' => "PID not specified"
    );
    echo json_encode($response);
}
/*
 * comment this if statement to make it to the else statement
 */
else if(!file_exists("../saved/".$_GET['pid'].".txt")){
    $response = array(
        'response' => false,
        'reason' => "Cannot find PID"
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
else{
    $response = array(
        'response' => true,
        'move' => array(
            'slot' => $move,
            'isWin' => false,
            'isDraw' => false,
            'row' => array()
        )
        
    );
    echo json_encode($response);
}



?>



