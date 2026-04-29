<?php
  // get post id
  $post_id = get_the_ID();

  // check if password protected
  $is_password_protected = post_password_required();
?>

<?php get_header(); ?>

<?php if ($is_password_protected): ?>
  <main class="password-form h-svh w-full flex justify-center items-center">
    <?php the_content(); ?>
  </main>
<?php else: ?>
  <!-- Add code here -->
<?php endif; ?>

<?php get_footer(); ?>
