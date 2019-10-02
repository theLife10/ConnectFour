<?php

include ("../play/Board.php");

$response = array();

$STRATEGY = $_GET["strategy"];
//$STRATEGY="Random";


if(empty( $STRATEGY ) ) {
    $response = array(
            'response' => false,
            'message' => "Strategy not specified"
            );
}
elseif($STRATEGY == "Smart" || $STRATEGY == "Random"){
    $response = array(
        'response' => true,
        'pid' => uniqid()
    );
    //the problem here it is not generating a txt file to save game through the application
    $grid = new Board();
    $info = array(
        'pid' => $response["pid"],
        'strategy' => $STRATEGY,
        'board' => $grid->gameBoard
    );
    file_put_contents("../saved/".$response["pid"].".txt", json_encode($info));
     
  
}
else{
    $response = array(
        'response' => false,
        'message' => "Unknown Strategy"
    );
}




echo json_encode($response);


?>
