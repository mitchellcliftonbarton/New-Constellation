<?php
  /*
    Global Text Module
    ------------------
    ACF fields: title (text), text (wysiwyg)
  */

  $module = isset($args['module']) ? $args['module'] : false;
  $text   = $module['text'] ?? false;
?>

<?php if ($title || $text): ?>
  <section class="global-text">
    <?php if ($text): ?>
      <div class="rich-text"><?= $text; ?></div>
    <?php endif; ?>
  </section>
<?php endif; ?>
