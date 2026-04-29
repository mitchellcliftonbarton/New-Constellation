<?php
  // get post id
  $post_id = get_the_ID();

  // check if password protected
  $is_password_protected = post_password_required();

  // page title
  $title = get_the_title($post_id);

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
    <div class="page-modules col-span-12 lg:col-span-10 xl:col-span-8 2xl:col-span-5 fade-in delay-1">
      <?php foreach ($modules as $module): ?>
        <?php get_template_part('partials/module-wrapper', null, array(
          'module' => $module
        )); ?>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
<?php endif; ?>

<?php get_footer(); ?>
