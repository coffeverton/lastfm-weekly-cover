<?php

require 'lastfm.class.php';

$lastFM = new LastFM;
$user = 'coffeverton';
$images = $lastFM->getWeeklyAlbumChart($user);
shuffle($images);
$selected = array_chunk($images, 5);

$image = imagecreatetruecolor(1500, 1500);

$dst_x = 0;
$dst_y = 0;
foreach($selected as $itens) {
  if(count($itens) == 5) {
    foreach($itens as $item) {
      echo $item['name']."\r\n";
      $dest = imagecreatefrompng($item['image']);
      imagealphablending($dest, false);
      imagesavealpha($dest, true);
      imagecopymerge($image, $dest,  $dst_x, $dst_y,  0, 0, 300, 300, 100);
      $dst_x += 300;
      echo __LINE__.'->'.$dst_x."\r\n";
    }
    $dst_y += 300;
    $dst_x = 0;
    echo __LINE__.'->'.$dst_y."\r\n";
  }
}
imagepng($image, 'test.png');
