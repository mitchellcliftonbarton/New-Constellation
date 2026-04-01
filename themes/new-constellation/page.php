<?php
  // get post id
  $post_id = get_the_ID();

  // check if password protected
  $is_password_protected = post_password_required();

  // get modules
  $modules = get_modules([
    'post_id'    => $post_id,
    'field_name' => 'modules',
  ]);
?>

<?php get_header(); ?>

<?php if ($is_password_protected): ?>
  <main class="password-form h-svh w-full flex justify-center items-center">
    <?php the_content(); ?>
  </main>
<?php else: ?>
  <?php if ($modules): ?>
    <?php foreach ($modules as $module): ?>
      <?php get_template_part('partials/module-wrapper', null, array(
        'module' => $module
      )); ?>
    <?php endforeach; ?>
  <?php endif; ?>
<?php endif; ?>

<?php get_footer(); ?>
