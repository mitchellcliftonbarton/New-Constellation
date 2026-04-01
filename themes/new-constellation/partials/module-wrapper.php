<?php
  $module = isset($args['module']) ? $args['module'] : false;
  $prefix = isset($args['prefix']) ? $args['prefix'] : 'global';

  if (!$module) {
    return;
  }

  $module_name = strtolower(str_replace('_', '-', $module['acf_fc_layout']));
  $template    = 'partials/blocks/' . $prefix . '-' . $module_name;
?>

<?php if (file_exists(get_template_directory() . '/' . $template . '.php')): ?>
  <?php get_template_part($template, null, array(
    'module' => $module
  )); ?>
<?php else: ?>
  <p>Module: <?= esc_html($template); ?> not found</p>
<?php endif; ?>
