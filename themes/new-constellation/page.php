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
    <div class="page-modules py-xl mx-auto max-w-[850px]">
      <section class="header">
        <h1 class="text-md font-secondary uppercase text-navy text-center"><?= $title; ?></h1>
      </section>

      <?php foreach ($modules as $module): ?>
        <?php get_template_part('partials/module-wrapper', null, array(
          'module' => $module
        )); ?>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
<?php endif; ?>

<?php get_footer(); ?>
