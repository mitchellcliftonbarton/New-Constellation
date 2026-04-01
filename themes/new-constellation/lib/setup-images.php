<?php

function add_custom_image_sizes() {
  add_image_size('custom-xs',  300,  9999);
  add_image_size('custom-sm',  648,  9999);
  add_image_size('custom-md',  768,  9999);
  add_image_size('custom-lg',  1024, 9999);
  add_image_size('custom-xl',  1280, 9999);
  add_image_size('custom-xxl', 1920, 9999);
}

function remove_default_image_sizes($sizes) {
  $sizes = array_diff($sizes, array('medium_large', 'large', '1536x1536', '2048x2048'));
  return $sizes;
}
