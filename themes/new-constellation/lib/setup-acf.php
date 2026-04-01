<?php

$colors = [
  'level_1' => 'transparent',
  'level_2' => 'transparent',
];

/*
----------------------------------------
Main Function
----------------------------------------
*/

function my_acf_flexible_content_layout_title($title, $field, $layout, $i) {
  $new_title = $title;

  switch ($layout['name']) {
    case 'text':
      $new_title = text_layout($new_title, 'level_1', ['title', 'text']);
      break;
    case 'news_item':
      $new_title = text_layout($new_title, 'level_1', ['title']);
      break;
  }

  return $new_title;
}

/*
----------------------------------------
Image Layout
----------------------------------------
*/

function image_layout($old_title) {
  $image = get_sub_field('image');

  if ($image) {
    return $old_title . ' - <img src="' . $image['url'] . '" style="width: 30px; margin-left: 5px;">';
  }

  return $old_title;
}

/*
----------------------------------------
Text Layout
----------------------------------------
*/

function text_layout($old_title, $color = 'level_1', $field_names = ['text']) {
  global $colors;
  $truncate_length = 100;
  $field_values    = [];

  foreach ($field_names as $field_name) {
    $value = get_sub_field($field_name);

    if ($value) {
      $field_values[] = $value;
    }
  }

  $text = !empty($field_values) ? $field_values[0] : '';
  $text = strip_tags($text);
  $text = truncate($text, $truncate_length);

  return $old_title . ': <span style="background-color: ' . $colors[$color] . ';">' . $text . '</span>';
}
