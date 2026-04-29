<?php

function truncate($text, $length) {
  if (strlen($text) > $length) {
    $text = substr($text, 0, $length);
    $text = substr($text, 0, strrpos($text, ' '));
    $text = $text . '...';
  }

  return $text;
}

/*
----------------
Get site metadata
----------------
*/

function get_site_metadata(array $data) {
  $post_id = $data['post_id'];

  // set defaults
  $title       = get_bloginfo('name');
  $description = get_bloginfo('description') ?? get_bloginfo('name');
  $url         = get_bloginfo('url');
  $og_image    = false;

  // check global fields
  $global_meta_title       = get_field('meta_title', 'option');
  $global_meta_description = get_field('meta_description', 'option');
  $global_og_image         = get_field('og_image', 'option');

  // get post specific fields
  $post_meta_title       = get_field('meta_title', $post_id);
  $post_meta_description = get_field('meta_description', $post_id);
  $post_og_image         = get_field('og_image', $post_id);

  // apply global defaults
  if ($global_meta_title) {
    $title = $global_meta_title;
  }

  if ($global_meta_description) {
    $description = $global_meta_description;
  }

  if ($global_og_image) {
    $og_image = $global_og_image['url'];
  }

  // override with page-specific values
  if ($post_meta_title) {
    $title = $post_meta_title;
  }

  if ($post_meta_description) {
    $description = $post_meta_description;
  }

  if ($post_og_image) {
    $og_image = $post_og_image['url'];
  }

  return array(
    'title'       => $title,
    'description' => $description,
    'url'         => $url,
    'og_image'    => $og_image,
  );
}

/*
----------------
Get image set
----------------
*/

function get_image_set($data) {
  $image_id = $data['image_id'];
  $size     = $data['size'] ?? 'custom-xxl';

  if (!$image_id) {
    return false;
  }

  $image_sizes = array('custom-xs', 'custom-sm', 'custom-md', 'custom-lg', 'custom-xl', 'custom-xxl', 'full');

  $size_index = array_search($size, $image_sizes);

  $srcset = array();
  $sizes  = array();

  for ($i = 0; $i <= $size_index; $i++) {
    $current_size = $image_sizes[$i];
    $image        = wp_get_attachment_image_src($image_id, $current_size);

    if ($image) {
      $srcset[] = $image[0] . ' ' . $image[1] . 'w';

      if ($i === $size_index) {
        $sizes[] = '100vw';
      } else {
        $sizes[] = '(max-width: ' . $image[1] . 'px) ' . $image[1] . 'px';
      }
    }
  }

  return array(
    'srcset' => implode(', ', $srcset),
    'sizes'  => implode(', ', $sizes),
  );
}

/*
----------------
Get modules
----------------
*/

function get_modules($data) {
  $post_id = $data['post_id'] ?? false;

  if (!$post_id) {
    return false;
  }

  $field_name = $data['field_name'] ?? 'modules';

  return get_field($field_name, $post_id);
}
