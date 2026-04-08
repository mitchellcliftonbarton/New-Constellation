<?php $is_front_page = is_front_page(); ?>

<header id="main-nav" class=" absolute top-0 left-0 w-full px-xl py-md flex items-center justify-center lg:justify-between bg-transparent z-[1000]">

  <div class="nav-logo">
    <?php if (!$is_front_page): ?>
      <a href="/" class="block w-[266px] lg:hover:opacity-50 transition-opacity duration-300">
        <span class="sr-only">New Constellation Home</span>
        <?php get_template_part('partials/icons/wordmark'); ?>
      </a>
    <?php endif; ?>
  </div>

  <button
    id="theme-toggle"
    class="nav-theme-toggle lg:hover:opacity-50 transition-opacity duration-300 hidden lg:block"
    aria-label="Toggle light/dark mode"
    aria-pressed="false"
  >
    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" aria-hidden="true">
      <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5"/>
      <path d="M12 2 A10 10 0 0 0 12 22 Z" fill="currentColor"/>
    </svg>
  </button>

</header>
