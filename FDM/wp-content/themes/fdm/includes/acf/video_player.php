<?php
get_header();
?>
<div class="container">
  <div class="row">
<?php

//get iframe HTML
$iframe = get_sub_field('fdm_video_player');
// use preg_match to find iframe src
preg_match('/src="(.+?)"/', $iframe, $matches);
$src = $matches[1];

$control = get_sub_field('fdm_vid_ctrl');

  if($control == true):
    $vid = "1";
  else:
    $vid = "0";
  endif;

echo $vid_control;

// add extra params to iframe src
$params = array(
    'controls'    => $vid,
    'hd'        => 1,
    'autohide'    => 1
);

$new_src = add_query_arg($params, $src);

$iframe = str_replace($src, $new_src, $iframe);


// add extra attributes to iframe html
$attributes = 'frameborder="0"';

$iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);


// echo $iframe
echo $iframe;

?>
  </div>
</div>
