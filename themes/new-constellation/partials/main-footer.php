<?php
// ACF
$footer_links = get_field('footer_links', 'option');
?>

<footer id="main-footer" class="bg-navy w-full p-lg">
  <div class="flex justify-start">
    <a href="/" class="lg:hover:opacity-50 transition-opacity duration-300">
      <span class="sr-only">New Constellation Home</span>
      <?php get_template_part('partials/icons/wordmark-alt'); ?>
    </a>
  </div>

  <ul class="flex justify-between items-center text-sm font-secondary">
    <?php foreach ($footer_links as $link):
      $url = $link['link']['url'] ?? '';
      $title = $link['link']['title'] ?? '';
      $target = $link['link']['target'] ?? '';
      if (!$url || !$title) continue;
    ?>
      <li>
        <a href="<?= esc_url($url) ?>"<?= $target ? ' target="' . esc_attr($target) . '"' : '' ?> class="lg:hover:opacity-50 transition-opacity duration-300">
          <?= esc_html($title) ?>
        </a>
      </li>
    <?php endforeach; ?>

    <li>
      <p>&copy; <?= date('Y') ?> New Constellation</p>
    </li>
  </ul>
</footer>