import ImageLoader from './classes/ImageLoader'
import DefVideo from './classes/DefVideo'
import StarTrail from './classes/StarTrail'

// DOMContentLoaded
document.addEventListener('DOMContentLoaded', async () => {
  /*
  ----------------
  CREDITS
  ----------------
  */

  console.log('%c \nDevelopment by Cold Rice \n \ncold-rice.info \n \n', 'color: grey')

  /*
  ----------------
  WEB COMPONENTS
  ----------------
  */

  customElements.define('def-video', DefVideo)

  /*
  ----------------
  CLASSES
  ----------------
  */

  new ImageLoader()

  // Light / dark mode toggle
  const themeToggle = document.getElementById('theme-toggle');
  if (themeToggle) {
    themeToggle.addEventListener('click', () => {
      const isDark = document.body.classList.toggle('dark-mode');
      themeToggle.setAttribute('aria-pressed', isDark);
    });
  }

  const starCanvas = document.getElementById('footer-canvas');
  if (starCanvas) new StarTrail(starCanvas);

  // News item hover: compute center offsets so only transform is animated
  const setNewsOffsets = () => {
    document.querySelectorAll('.news-item').forEach(item => {
      const titleSpan    = item.querySelector('.title span');
      const subtitleSpan = item.querySelector('.subtitle span');
      const titleWrap    = item.querySelector('.title');
      const subtitleWrap = item.querySelector('.subtitle');

      if (titleSpan && titleWrap) {
        const offset = titleWrap.offsetWidth / 2 - titleSpan.offsetWidth / 2;
        titleSpan.style.setProperty('--title-center-offset', `${offset}px`);
      }
      if (subtitleSpan && subtitleWrap) {
        const offset = subtitleWrap.offsetWidth / 2 - subtitleSpan.offsetWidth / 2;
        subtitleSpan.style.setProperty('--subtitle-center-offset', `${-offset}px`);
      }
    });
  };

  setNewsOffsets();
  window.addEventListener('resize', setNewsOffsets);
})
