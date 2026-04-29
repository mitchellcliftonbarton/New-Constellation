<?php
// check if password protected
$is_password_protected = post_password_required();
?>

<?php if (!$is_password_protected): ?>
  </main>
<?php endif; ?>

<?php get_template_part('partials/main-footer'); ?>

<?php wp_footer(); ?>
</body>
</html>
