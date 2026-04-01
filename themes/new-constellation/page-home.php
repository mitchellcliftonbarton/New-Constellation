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
  <section class="h-svh w-full flex justify-between items-center bg-cream">
    <p>New Constellation</p>
  </section>
<?php endif; ?>

<?php get_footer(); ?>
