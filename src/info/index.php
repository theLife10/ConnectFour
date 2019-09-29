<?php

class GameInfo{
    public $width;
    public $height;
    public $strategies;
    public function __construct(array $data)
    {
        $this->width = $data['width'];
        $this->height = $data['height'];
        $this->strategies = $data['strategies'];
    }
}

$gameInfo = new GameInfo(array('width'=>6, 'height'=>7,'strategies'=>["Smart","Random"]));
echo json_encode($gameInfo);

   
?>