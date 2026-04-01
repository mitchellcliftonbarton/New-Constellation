<?php
/*
Renders a video player
*/

$type = isset($args['type']) ? $args['type'] : 'mp4';
$video_file = $args['video_file'] ?? false;
$vimeo_url = $args['vimeo_url'] ?? false;
$youtube_id = $args['youtube_id'] ?? false;
$poster_image_id = $args['poster_image_id'] ?? false;
$custom_caption = $args['custom_caption'] ?? false;
$disable_aspect_ratio = $args['disable_aspect_ratio'] ?? false;
$autoplay = $args['autoplay'] ?? false;

$poster_image_set = $poster_image_id ? get_image_set(array(
  'image_id' => $poster_image_id,
  'size' => 'custom-xl'
)) : false;

$poster_alt = $poster_image_id ? get_post_meta($poster_image_id, '_wp_attachment_image_alt', true) : false;

// classes
$classes = [];

if ($autoplay) {
  $classes[] = 'autoplay';
}

if ($disable_aspect_ratio) {
  $classes[] = 'fill-parent';
}
?>

<def-video class="def-video <?= implode(' ', $classes); ?>">
  <div class="video-container <?php if (!$disable_aspect_ratio): ?>aspect-video<?php else: ?>fill-parent<?php endif; ?> relative">
    <?php if ($type === 'mp4' and $video_file): ?>
      <?php if (isset($video_file['url'])): ?>
        <video class="video media-cover" playsinline <?php if ($autoplay): ?>autoplay muted loop<?php else: ?>controls<?php endif; ?>>
          <source src="<?= $video_file['url']; ?>" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      <?php else: ?>
        <video class="video media-cover" controls playsinline>
          <source src="<?= $video_file; ?>" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      <?php endif; ?>
    <?php elseif ($type === 'vimeo' and $vimeo_url): ?>
      <div class="video-inner fill-parent" data-vimeo-url="<?= $vimeo_url ?>"></div>
    <?php elseif ($type === 'youtube' and $youtube_id): ?>
      <div class="fill-parent">
        <div class="video-inner fill-parent" data-youtube-id="<?= $youtube_id ?>"></div>
      </div>
    <?php endif; ?>
    
    <?php if (!$autoplay): ?>
      <button class="play fill-parent flex justify-center items-center">
        <?php if ($poster_image_set): ?>
          <figure class="fill-parent">
            <img 
              class="media-cover" 
              srcset="<?= $poster_image_set['srcset'] ?>"
              sizes="<?= $poster_image_set['sizes'] ?>"
              alt="<?= $poster_alt; ?>"
              style="transform: translate3d(0, 0, 0);"
              loading="lazy"
            >
          </figure>
        <?php endif; ?>

        <?php 
          get_template_part('partials/icons/play'); 
        ?>
      </button>
    <?php endif; ?>
  </div>

  <?php if ($custom_caption): ?>
    <div class="text-sm text-left mt-4"><?= $custom_caption; ?></div>
  <?php endif; ?>
</def-video>