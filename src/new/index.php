<?php

include ("../play/Board.php");

$response = array();

$STRATEGY = $_GET["strategy"];

if(empty( $STRATEGY ) ) {
    $response = array(
            'response' => false,
            'message' => "Strategy not specified"
            );
}
else{

    if($STRATEGY == "Smart" || $STRATEGY == "Random"){
        $response = array(
                'response' => true,
                'pid' => uniqid()
                );
    }
    else{
        $response = array(
                'response' => false,
                'message' => "Unknown Strategy"
                );

        $gameBoard = new Board($STRATEGY);
        $gameBoard->emptyBoard();

    }
    echo json_encode($response);
}

?>
