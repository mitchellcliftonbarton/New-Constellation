<?php
// ACF
$footer_links = get_field('footer_links', 'option');
?>

<footer 
  id="main-footer" 
  aria-label="Footer"
  class="bg-navy w-full px-xl py-lg flex flex-col items-start justify-between gap-[400px]"
>
  <a 
    href="/" 
    class="lg:hover:opacity-50 transition-opacity duration-300"
  >
    <span class="sr-only">New Constellation Home</span>
    <?php get_template_part('partials/icons/wordmark-alt'); ?>
  </a>

  <ul class="footer-link text-xs font-secondary flex items-center justify-between w-full gap-base" role="navigation">
    <?php foreach ($footer_links as $link):
      $url = $link['link']['url'] ?? '';
      $title = $link['link']['title'] ?? '';
      $target = $link['link']['target'] ?? '';
      if (!$url || !$title) continue;
    ?>
      <li>
        <a href="<?= esc_url($url) ?>"<?= $target ? ' target="' . esc_attr($target) . '"' : '' ?> class="lg:hover:opacity-50 transition-opacity duration-300">
          <?= esc_html($title) ?>
          <?php if ($target === '_blank'): ?>
            <span class="sr-only"> (opens in new tab)</span>
          <?php endif; ?>
        </a>
      </li>
    <?php endforeach; ?>

    <li>
      <p>&copy; <?= date('Y') ?> New Constellation</p>
    </li>
  </ul>
</footer>