<?php
class LastFM {
  private $base_url = 'http://ws.audioscrobbler.com/2.0/?format=json&api_key=';
  public function __construct() {
    $conf = require_once(__DIR__.'/.env.php');
    $this->base_url .= $conf['api_key'];
  }

  private function request($url) {
    $url = $this->base_url.$url;
    $raw = file_get_contents($url);
    $json = json_decode($raw, true);
    return $json;
  }

  public function getAlbumInfo($artist, $album) {
    $json = $this->request('&method=album.getInfo&artist='.urlencode($artist).'&album='.urlencode($album));
    return $json;
  }

  public function getWeeklyAlbumChart($user) {
    $json = $this->request('&method=user.getweeklyalbumchart&user='.$user);
    $c = 0;
    $images = [];
    foreach($json['weeklyalbumchart']['album'] as $album) {

      $image = '';
      $info = $this->getAlbumInfo($album['artist']['#text'], $album['name']);
      $name = $info['album']['name'];
      foreach($info['album']['image'] as $item) {
        $image = $item['#text'];
      }
      $images[] = [
        'name' => $name,
        'image' => $image
      ];
    }
    print_r($images);
  }
}
