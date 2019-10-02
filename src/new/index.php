<?php

include ("../play/Board.php");

$response = array();

$STRATEGY = $_GET["strategy"];
//$STRATEGY="Smart";

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
   $grid = new Board();
   
  $saved = fopen("Saved/".$response["pid"].".txt","w");
  fwrite($saved, $STRATEGY."\r\n");
  fwrite($saved, json_encode($grid->gameBoard));
  fclose($saved); 
}
else{
    $response = array(
        'response' => false,
        'message' => "Unknown Strategy"
    );
}

echo json_encode($response);


?>
