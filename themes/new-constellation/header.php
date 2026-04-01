<?php
  /*
  Defaults
  */

  // get post
  $post_id = get_the_ID();
  $post_slug = null;

  if ($post_id) {
    $post_slug = get_post($post_id)->post_name;
  }

  // get site metadata
  $metadata = get_site_metadata([
    'post_id' => $post_id
  ]);

  // determine body classes
  $extra_body_classes = [];

  // add slug class
  $extra_body_classes[] = 'page-' . $post_slug;

  // get post type
  $post_type = get_post_type($post_id);

  // add post type class
  $extra_body_classes[] = 'post-type-' . $post_type;

  // get post template without .php extension
  $post_template = str_replace('.php', '', get_page_template_slug($post_id));

  // add template class
  $extra_body_classes[] = 'template-' . str_replace('.php', '', $post_template);

  // check if password protected
  $is_password_protected = post_password_required();

  // favicon
  $favicon = get_field('favicon', 'option');

  // is front page
  $is_front_page = is_front_page();

  /*
  End Defaults
  */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php if ($favicon): ?>
      <link rel="icon" href="<?= $favicon['url'] ?>" />
    <?php endif; ?>

    <!-- SEO -->
    <?php if ($metadata['description']): ?>
      <meta name="description" content="<?= esc_attr($metadata['description']); ?>">
    <?php endif; ?>
    <?php if ($metadata['og_image']): ?>
      <meta property="og:image" content="<?= esc_url($metadata['og_image']); ?>">
    <?php endif; ?>
    <meta property="og:title" content="<?= esc_attr($metadata['title']); ?>">
    <?php if ($metadata['description']): ?>
      <meta property="og:description" content="<?= esc_attr($metadata['description']); ?>">
    <?php endif; ?>
    <meta property="og:url" content="<?= esc_url($metadata['url']); ?>">

    <?php wp_head(); ?>
  </head>

  <body class="<?= implode(' ', array_map('esc_attr', $extra_body_classes)) ?>">
    <?php wp_body_open(); ?>

    <?php if (!$is_password_protected): ?>
      <?php get_template_part('partials/main-nav'); ?>

      <main>
    <?php endif; ?>
