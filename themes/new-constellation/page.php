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
    <div class="page-content py-[150px] lg:py-[250px] px-md lg:px-xl relative overflow-hidden">
      <div class="absolute top-0 left-0 w-full h-[160svh] overflow-hidden">
        <div class="bg-pattern fill-parent" aria-hidden="true">
          <?php get_template_part('partials/icons/bg-wordmark'); ?>
        </div>
      </div>

      <section id="main-content" class="header relative z-10" tabindex="-1">
        <h1 class="text-base lg:text-md font-secondary uppercase text-left tracking-[.09em] fade-in"><?= $title; ?></h1>
      </section>

      <div class="grid grid-cols-12 lg:gap-base mt-lg lg:mt-xl relative z-10">
        <div class="page-modules col-span-12 lg:col-span-5 fade-in delay-1">
          <?php foreach ($modules as $module): ?>
            <?php get_template_part('partials/module-wrapper', null, array(
              'module' => $module
            )); ?>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  <?php endif; ?>
<?php endif; ?>

<?php get_footer(); ?>
