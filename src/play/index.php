<?php

$move = $_GET['move'];

if( !array_key_exists("pid", $_GET) ){
    $response = array(
        'response' => false,
        'reason' => "PID not specified"
    );
    echo json_encode($response);
}
else if(!file_exists("../saved/".$_GET['pid'].".txt")){
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
    $response = array(
        'response' => true,
        'ack_move' => array(
            'slot' => $move,
            'isWin' => false,
            'isDraw' => false,
            'row' => array(),
            'move' => array(
                'slot' => $move,
                'isWin' => false,
                'isDraw' => false,
                'row' => array()
            )
        )
    );
    echo json_encode($response);
}



?>



