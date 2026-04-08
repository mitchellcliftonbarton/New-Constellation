<?php
// ACF
$footer_links = get_field('footer_links', 'option');
?>

<footer
  id="main-footer"
  aria-label="Footer"
  class="bg-navy w-full px-xl py-lg flex flex-col items-start justify-between gap-[400px] relative"
>
  <canvas id="footer-canvas" class="fill-parent" aria-hidden="true"></canvas>
  <a 
    href="/" 
    class="lg:hover:opacity-50 transition-opacity duration-300"
  >
    <span class="sr-only">New Constellation Home</span>
    <?php get_template_part('partials/icons/wordmark-alt'); ?>
  </a>

  <ul class="footer-link font-secondary flex items-center justify-between w-full gap-base" role="navigation">
    <?php foreach ($footer_links as $link):
      $is_large = $link['is_large'] ?? false;
      $url = $link['link']['url'] ?? '';
      $title = $link['link']['title'] ?? '';
      $target = $link['link']['target'] ?? '';

      $font_size_class = $is_large ? 'text-sm' : 'text-xs';
      if (!$url || !$title) continue;
    ?>
      <li>
        <a href="<?= esc_url($url) ?>"<?= $target ? ' target="' . esc_attr($target) . '"' : '' ?> class="lg:hover:opacity-50 transition-opacity duration-300 <?= $font_size_class ?>">
          <?= esc_html($title) ?>
          <?php if ($target === '_blank'): ?>
            <span class="sr-only"> (opens in new tab)</span>
          <?php endif; ?>
        </a>
      </li>
    <?php endforeach; ?>

    <li>
      <p class="text-xs">&copy; <?= date('Y') ?> New Constellation</p>
    </li>
  </ul>
</footer>