<?php

function perspective($firstPicture, $twoPicture, $pointTLX, $pointTLY, $pointBLX,
         $pointBLY, $pointTRX, $pointTRY, $pointBRX,$pointBRY){
$imagick = new \Imagick(realpath($firstPicture/*"source.png"*/));

$points = array(
    array('x' => $pointTLX/*166*/, 'y' => $pointTLY/*362*/),
    array('x' => $pointBLX/*210*/, 'y' => $pointBLY/*423*/),
    array('x' => $pointTRX/*260*/, 'y' => $pointTRY/*295*/),
    array('x' => $pointBRX/*310*/, 'y' => $pointBRY/*353*/),
);
$geometry = $imagick->getImageGeometry();
$controlPoints = array(
    0, 0, $points[0]['x'], $points[0]['y'],
    0, $geometry['height'], $points[1]['x'], $points[1]['y'],
    $geometry['width'], 0, $points[2]['x'], $points[2]['y'],
    $geometry['width'], $geometry['height'], $points[3]['x'], $points[3]['y'],
);

$imagick->distortImage(Imagick::DISTORTION_AFFINE, $controlPoints, true);

header( "Content-Type: image/jpg" );
$img2 = new Imagick($twoPicture/*'good.jpg'*/);
$imagick->thumbnailImage(140, 140);
//$img2->compositeImage($imagick, $imagick->getImageCompose(), 155, 290);
$img2->compositeImage($imagick, $imagick->getImageCompose(), $pointTLX/*166*/, $pointTRY/*295*/);
echo $img2;
}
perspective($firstPicture = "source.png", $twoPicture = 'good.jpg', $pointTLX = 166, $pointTLY = 362, $pointBLX = 210,
    $pointBLY = 423, $pointTRX = 260, $pointTRY = 295, $pointBRX = 310,$pointBRY = 350);