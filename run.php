<?php

require 'lastfm.class.php';

$lastFM = new LastFM;
$user = 'coffeverton';
$lastFM->getWeeklyAlbumChart($user);
