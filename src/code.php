<?php

print_r($_POST);
if(isset($_REQUEST['submit']))
{
print_r('sssssssssssssss');
     get_programmes($keyword);
}

/**
 *
 */
function get_programmes($keyword) {

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_URL, 'http://www.bbc.co.uk/radio/programmes/a-z/by/chris/current.json');
  $result = curl_exec($ch);
  curl_close($ch);

  $obj = json_decode($result);

  $output = '';
  $output .='<ul>';
  foreach ($obj-> atoz->tleo_titles as $out) {
     if (!empty($out->title)) {
       
         if ($out->programme->type == 'episode') {

             // Get parent programe
             get_parent_program($out->programme->pid);
         } elseif ($out->programme->type == 'brand') {
          
             $episodes = get_episodes ($out->programme->pid);
        }
         $output .= render_result ($out->programme->pid, $out->title, '', $out->programme->short_synopsis, $out->programme->image->pid, $out->programme->ownership->service->title, $episodes); 
    }
  }
    $output .='</ul>';
//  print_r($output);
  return $output;
}

/**
 *
 */
function render_result ($pid, $brand_name, $episode_names, $short_synopi, $img, $service, $episodes) {
  $output = '<li class="col-sm-12"><a target="_blank" href="http://www.bbc.co.uk/programmes/' . $pid . '">';
  $output .= '<div class="col-sm-3"><img class="img-responsive" src="https://ichef.bbci.co.uk/images/ic/480x270/' . $img . '.jpg" /></div>';
  $output .= '<div class="col-sm-9"><h4>' . $brand_name . '</h4>';
  $output .= '<span>' . $short_synopi . '</span><br /><br />';
  $output .= '<span><b>' . $service . '</b></span>';

  if (!empty($episodes)) {
    $output .= "<br />" . $episodes;
  }
  $output .= '</div></a></li>';
  
  return $output;
}

/**
 *
 */
function get_parent_program($episode_id) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_URL, 'http://www.bbc.co.uk/programmes/' . 'b07jdc0p' . '.json');
  $result = curl_exec($ch);
  curl_close($ch);

  $obj = json_decode($result);
 // print_r($obj);
}

/**
 *
 */
function get_episodes($pid) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_URL, 'http://www.bbc.co.uk/programmes/' . $pid . '/episodes/player.json');
  $result = curl_exec($ch);
  curl_close($ch);
  $obj = json_decode($result);

  $output = '<div class="episodes_list">';
  $output .= '<h5>'. 'Episodes:' . '<h5>';

  foreach($obj->episodes as $episode) {
      $output .= "<span>" . $episode->programme->title . ', </span>';
  }
    $output .= '</div>';
  return $output;
}
