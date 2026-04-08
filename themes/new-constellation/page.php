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
    <div class="page-content py-[250px] px-xl relative overflow-hidden">
      <div class="absolute top-0 left-0 w-full h-[160svh]">
        <div class="bg-pattern fill-parent" aria-hidden="true">
          <?php get_template_part('partials/icons/bg-wordmark'); ?>
        </div>
      </div>

      <section class="header relative z-10">
        <h1 class="text-md font-secondary uppercase text-navy text-left tracking-[.09em]"><?= $title; ?></h1>
      </section>

      <div class="page-modules w-1/2 mt-xl relative z-10">
        <?php foreach ($modules as $module): ?>
          <?php get_template_part('partials/module-wrapper', null, array(
            'module' => $module
          )); ?>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endif; ?>
<?php endif; ?>

<?php get_footer(); ?>
