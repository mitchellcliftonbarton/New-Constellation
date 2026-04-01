<?php
  // get post id
  $post_id = get_the_ID();

  // check if password protected
  $is_password_protected = post_password_required();

  // get image
  $image = get_field('image', $post_id);
?>

<?php get_header(); ?>

<?php if ($is_password_protected): ?>
  <main class="password-form h-svh w-full flex justify-center items-center">
    <?php the_content(); ?>
  </main>
<?php else: ?>
  <section class="w-full bg-cream relative">
    <div class="landing h-svh flex justify-center items-center relative z-10">
      <h1>
        <span class="sr-only">New Constellation</span>
        <?php get_template_part('partials/icons/wordmark'); ?>
      </h1>
    </div>

    <div class="mission-statement relative z-10">

    </div>

    <div class="bg-pattern fill-parent overflow-hidden" aria-hidden="true">
      <?php get_template_part('partials/icons/bg-wordmark'); ?>
    </div>
  </section>
<?php endif; ?>

<?php get_footer(); ?>
