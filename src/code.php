<?php

get_programmes('ss');
function get_programmes($keyword) {
print_r('aaaaa');
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_URL, 'http://www.bbc.co.uk/radio/programmes/a-z/by/chris/current.json');
  $result = curl_exec($ch);
  curl_close($ch);

  $obj = json_decode($result);

   print_r($result);

}
