<?php
/*
Renders an image in a container with its aspect ratio
*/

$image_id = isset($args['image_id']) ? $args['image_id'] : false; // for featured image
$size = isset($args['size']) ? $args['size'] : 'custom-xxl';
$classes = isset($args['classes']) ? $args['classes'] : [];
$aspect_ratio_override = isset($args['aspect_ratio_override']) ? $args['aspect_ratio_override'] : false;
$show_caption = isset($args['show_caption']) ? $args['show_caption'] : false;
$contain = isset($args['contain']) ? $args['contain'] : false;

// check if classes is an array
if (!is_array($classes)) {
  $classes = [$classes];
}

// set default values
$url = false;
$alt = false;
$width = false;
$height = false;
$aspectRatio = 'auto';
$ratioClass = 'portrait';
$fullImage = false;
$image_caption = false;
$object_fit_class = 'media-cover';

// if imageObject is set, set the values
if ($image_id) {
  $src_object = wp_get_attachment_image_src($image_id, 'full');
  $url = $src_object[0];
  $width = $src_object[1];
  $height = $src_object[2];
  $alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);

  if ($aspect_ratio_override) {
    $aspectRatio = $aspect_ratio_override;
  } else {
    $aspectRatio = $width && $height ? $width / $height : 'auto';
  }

  $caption = wp_get_attachment_caption($image_id);

  if ($show_caption) {
    $image_caption = $caption;
  }
}

// set ratio class
if ($aspectRatio > 1) {
  $classes[] = 'landscape';
} else if ($aspectRatio <= .6) {
  $classes[] = 'extreme-portrait';
} else {
  $classes[] = 'portrait';
}

$image_set = false;

if ($image_id) {
  $image_set = get_image_set(array(
    'image_id' => $image_id,
    'size' => $size
  ));
}

if ($contain) {
  $object_fit_class = 'media-contain';
}
?>

<?php if ($image_id): ?>
  <figure 
    class="image-sizer relative bg-grey-1 <?= implode(' ', $classes); ?>"
    style="aspect-ratio: <?= $aspectRatio; ?>;"
  >
    <?php if ($image_set): ?>
      <img 
        class="<?= $object_fit_class ?>"
        srcset="<?= $image_set['srcset'] ?>"
        sizes="<?= $image_set['sizes'] ?>"
        alt="<?= $alt ?>"
        style="transform: translate3d(0, 0, 0);"
        loading="lazy"
      >
    <?php elseif ($url): ?>
      <img 
        class="<?= $object_fit_class ?>"
        loading="lazy"
        src="<?= $url ?>" 
        alt="<?= $alt ?>"
      >
    <?php endif; ?>
  </figure>

  <?php if ($show_caption && $image_caption): ?>
    <div class="caption text-left text-sm mt-5">
      <?= $image_caption; ?>
    </div>
  <?php endif; ?>
<?php endif; ?>