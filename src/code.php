<?php

  $keyword = $_POST['search'];
  if (!empty($keyword)) {
    get_programmes($keyword);
  }

/**
 * Function to get list of programmes using a search string matching the keyword passed 
 */
function get_programmes($keyword) {

  $output = '';
  
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_URL, 'http://www.bbc.co.uk/radio/programmes/a-z/by/' . $keyword . '/current.json');
  $result = curl_exec($ch);
  curl_close($ch);

  $obj = json_decode($result);
  if (empty($obj->atoz->tleo_titles)) {
     $output = '<div class="empty_result">No result</div>';
     print_r($output);
  }
  else {
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
    print_r($output);
  }
  //return $output;
}

/**
 *  Function to render the result in nice HTML list
 */
function render_result ($pid, $brand_name, $episode_names, $short_synopi, $img, $service, $episodes) {
  $output = '<li class="col-sm-12" id="programmes_li">';
  $output .= '<div class="col-sm-3"><a target="_blank" href="http://www.bbc.co.uk/programmes/' . $pid . '"><img class="img-responsive" src="https://ichef.bbci.co.uk/images/ic/480x270/' . $img . '.jpg" /></a></div>';
  $output .= '<div class="col-sm-9"><a target="_blank" href="http://www.bbc.co.uk/programmes/' . $pid . '"><h4>' . $brand_name . '</h4>';
  $output .= '<span>' . $short_synopi . '</span><br /><br />';
  $output .= '<span><b>' . $service . '</b></span></a>';

  if (!empty($episodes)) {
    $output .= "<br />" . $episodes;
  }
  $output .= '</div></li>';
  
  return $output;
}

/**
 *  Function to render episodes in list style
 */
function get_episode_component($pid, $episode_name, $short_synopi, $img) {
  $output = '<li class="col-sm-12 main_li" id="episodes_li"><a target="_blank" href="http://www.bbc.co.uk/programmes/' . $pid . '">';
  $output .= '<div class="col-sm-3"><img class="img-responsive" src="https://ichef.bbci.co.uk/images/ic/480x270/' . $img . '.jpg" /></div>';
  $output .= '<div class="col-sm-9"><h4>' . $episode_name . '</h4>';
  $output .= '<span>' . $short_synopi . '</span><br /><br />';
  $output .= '</div></a></li>'; 
  return $output;
}

/**
 *  Function to get parent of episode using episode id
 */
function get_parent_program($episode_id) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_URL, 'http://www.bbc.co.uk/programmes/' . 'b07jdc0p' . '.json');
  $result = curl_exec($ch);
  curl_close($ch);

  $obj = json_decode($result);
}

/**
 * Function to get the episodes of certain programme id
 */
function get_episodes($pid) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_URL, 'http://www.bbc.co.uk/programmes/' . $pid . '/episodes/player.json');
  $result = curl_exec($ch);
  curl_close($ch);
  $obj = json_decode($result);

  if (!empty($obj->episodes)) {
    $output = '<h5 class="show_episodes">'. 'Show available episodes' . '</h5>';
    $output .= '<div class="episodes_list"><ul>';

    foreach($obj->episodes as $episode) {
      $output .= get_episode_component ($episode->programme->pid, $episode->programme->title, $episode->programme->short_synopsis, $episode->programme->image->pid); //"<span>" . $episode->programme->title . ', </span>';
    }
  
    $output .= '</ul></div>';
  }
  return $output;
}
