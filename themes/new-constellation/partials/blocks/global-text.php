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
  <section class="global-text grid grid-cols-12 gap-md">
    <?php if ($text): ?>
      <div class="rich-text col-span-12 lg:col-span-6 lg:col-start-4"><?= $text; ?></div>
    <?php endif; ?>
  </section>
<?php endif; ?>
