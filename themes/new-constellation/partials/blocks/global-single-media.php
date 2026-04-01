<?php
  $module        = $args['module']        ?? false;
  $section_class = $args['section_class'] ?? 'single-media';
  $inner_class   = $args['inner_class']   ?? 'w-full mx-auto';

  if ( ! $module ) return;

  $media_type   = $module['media_type']   ?? false;
  $image        = $module['image']        ?? false;
  $video_file   = $module['video_file']   ?? false;
  $vimeo_url    = $module['vimeo_url']    ?? false;
  $youtube_id   = $module['youtube_id']   ?? false;
  $autoplay     = $module['autoplay']     ?? false;
  $poster_image = $module['poster_image'] ?? false;
  $caption      = $module['caption']      ?? false;

  $image_check   = $media_type === 'image'   && $image;
  $video_check   = $media_type === 'mp4'     && $video_file;
  $vimeo_check   = $media_type === 'vimeo'   && $vimeo_url;
  $youtube_check = $media_type === 'youtube' && $youtube_id;

  if ( ! ( $image_check || $video_check || $vimeo_check || $youtube_check ) ) return;
?>

<section class="<?= esc_attr( $section_class ); ?>">
  <div class="<?= esc_attr( $inner_class ); ?>">
    <?php if ( $media_type === 'image' ): ?>
      <?php get_template_part( 'partials/image-sizer', null, [
        'image_id'     => $image['id'],
        'show_caption' => true,
      ] ); ?>
    <?php elseif ( in_array( $media_type, [ 'mp4', 'vimeo', 'youtube' ] ) ): ?>
      <?php get_template_part( 'partials/def-video', null, [
        'type'             => $media_type,
        'video_file'       => $video_file,
        'vimeo_url'        => $vimeo_url,
        'youtube_id'       => $youtube_id,
        'poster_image_id'  => $poster_image ? $poster_image['id'] : false,
        'autoplay'         => $autoplay,
        'custom_caption'   => $caption,
      ] ); ?>
    <?php endif; ?>
  </div>
</section>