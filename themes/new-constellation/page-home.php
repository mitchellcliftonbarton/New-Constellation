<?php
  // get post id
  $post_id = get_the_ID();

  // check if password protected
  $is_password_protected = post_password_required();

  // ACF
  $mission_statement = get_field('mission_statement', $post_id);
  $gold_text_1 = $mission_statement['gold_text_1'] ?? '';
  $gold_text_2 = $mission_statement['gold_text_2'] ?? '';
  $blue_text_1 = $mission_statement['blue_text_1'] ?? '';
  $blue_text_2 = $mission_statement['blue_text_2'] ?? '';

  $news = get_field('news', $post_id);
  $news_title = $news['news_title'] ?? '';
  $news_items = $news['news_items'] ?? [];
?>

<?php get_header(); ?>

<?php if ($is_password_protected): ?>
  <main class="password-form h-svh w-full flex justify-center items-center">
    <?php the_content(); ?>
  </main>
<?php else: ?>
  <section class="w-full bg-cream relative">
    <div class="landing h-svh flex justify-center items-center relative z-10">
      <h1 class="fade-in delay-3">
        <span class="sr-only">New Constellation</span>
        <?php get_template_part('partials/icons/wordmark'); ?>
      </h1>
    </div>

    <div class="mission-statement h-[60svh] flex justify-center items-start relative z-10 pt-md">
      <div class="flex flex-col items-center">
        <?php if ($gold_text_1 || $gold_text_2): ?>
          <div class="flex gap-4">
            <?php if ($gold_text_1): ?>
              <p class="uppercase text-gold font-secondary font-medium text-md tracking-[0.09em]"><?= $gold_text_1; ?></p>
            <?php endif; ?>

            <?php if ($gold_text_2): ?>
              <p class="font-tertiary text-base italic text-navy mt-[35px]">and</p>
              <p class="uppercase text-gold font-secondary text-md mt-[25px] font-medium tracking-[0.09em]"><?= $gold_text_2; ?></p>
            <?php endif; ?>
          </div>
        <?php endif; ?>

        <?php if ($blue_text_1 || $blue_text_2): ?>
          <div class="text-md text-navy font-primary leading-[.9] mt-[-8px]">
            <?php if ($blue_text_1): ?>
              <p class="translate-x-[-39%]"><?= $blue_text_1; ?></p>
            <?php endif; ?>

            <?php if ($blue_text_2): ?>
              <p class="translate-x-[39%]"><?= $blue_text_2; ?></p>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <div class="bg-pattern fill-parent overflow-hidden fade-in" aria-hidden="true">
      <?php get_template_part('partials/icons/bg-wordmark'); ?>
    </div>
  </section>

  <?php if ($news_items): ?>
    <section class="w-full bg-gold relative px-xl py-[210px]">
      <div class="mx-auto max-w-[850px] space-y-md">
        <?php if ($news_title): ?>
          <h2 class="text-md font-secondary uppercase text-white text-center font-medium"><?= $news_title; ?></h2>
        <?php endif; ?>

        <ul class="news-items">
          <?php foreach ($news_items as $item): ?>
            <?php
              $title = $item['title'] ?? '';
              $subtitle = $item['subtitle'] ?? '';
              $link = $item['link'] ?? '';
              if (!$title && !$subtitle && !$link) continue;
            ?>

            <li class="news-item border-t border-white">
              <a href="<?= $link; ?>" target="_blank" class="block space-y-6 py-12">
                <div class="title h-[24px] relative">
                  <span class="text-base font-primary text-navy"><?= $title; ?></span>
                </div>
                
                <div class="subtitle h-[31px] relative">
                  <span class="text-sm font-secondary text-white"><?= $subtitle; ?></span>
                </div>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </section>
  <?php endif; ?>
<?php endif; ?>

<?php get_footer(); ?>
