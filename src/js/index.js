import ImageLoader from './classes/ImageLoader'
import DefVideo from './classes/DefVideo'
import StarTrail from './classes/StarTrail'
import gsap from 'gsap'
import ScrollTrigger from 'gsap/ScrollTrigger'
import lottie from 'lottie-web'
import logoAnimation from '../json/new_constellation_logo_2.json'

gsap.registerPlugin(ScrollTrigger)

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

  // Logo Lottie animation — plays once on load, holds last frame.
  // Color is driven entirely by CSS `color` on #logo-lottie (navy / cream).
  // A MutationObserver intercepts every fill/stroke Lottie sets and swaps it
  // to `currentColor` so the CSS value always wins — no JS timing needed.
  const logoContainer = document.getElementById('logo-lottie')

  if (logoContainer) {
    const observer = new MutationObserver((mutations) => {
      mutations.forEach(({ target, attributeName }) => {
        if (target.closest('defs, mask, clipPath')) return
        const val = target.getAttribute(attributeName)
        if (val && val !== 'none' && val !== 'currentColor') {
          target.setAttribute(attributeName, 'currentColor')
        }
      })
    })

    observer.observe(logoContainer, {
      attributes: true,
      attributeFilter: ['fill', 'stroke'],
      subtree: true,
    })

    const anim = lottie.loadAnimation({
      container: logoContainer,
      renderer: 'svg',
      loop: false,
      autoplay: true,
      animationData: logoAnimation,
    })

    anim.setSpeed(0.85)

    anim.addEventListener('complete', () => observer.disconnect())
  }

  // Mission statement scroll animation
  const missionStatement = document.querySelector('.mission-statement')
  if (missionStatement) {
    const gold1 = missionStatement.querySelector('[data-mission="gold-1"]')
    const gold2 = missionStatement.querySelector('[data-mission="gold-2"]')
    const blue1 = missionStatement.querySelector('[data-mission="blue-1"]')
    const blue2 = missionStatement.querySelector('[data-mission="blue-2"]')

    gsap.matchMedia().add('(min-width: 1024px)', () => {
      const tl = gsap.timeline({
        scrollTrigger: {
          trigger: missionStatement,
          start: 'top bottom',
          end: 'top 65%',
          scrub: true,
        },
      })

      if (gold1) tl.from(gold1, { x: -50, ease: 'power2.out' }, 0)
      if (gold2) tl.from(gold2, { x: 50, ease: 'power2.out' }, 0)
      if (blue1) tl.from(blue1, { x: -120, ease: 'power2.out' }, 0)
      if (blue2) tl.from(blue2, { x: 120, ease: 'power2.out' }, 0)
    })
  }

  // Light / dark mode toggle
  const themeToggle = document.getElementById('theme-toggle')
  if (themeToggle) {
    themeToggle.setAttribute('aria-pressed', document.documentElement.classList.contains('dark-mode'))
    themeToggle.addEventListener('click', () => {
      const isDark = document.documentElement.classList.toggle('dark-mode')
      localStorage.setItem('theme', isDark ? 'dark' : 'light')
      themeToggle.setAttribute('aria-pressed', isDark)

    })
  }

  const starCanvas = document.getElementById('footer-canvas')
  if (starCanvas && window.matchMedia('(min-width: 1024px)').matches) new StarTrail(starCanvas)

  // News item hover: compute center offsets so only transform is animated
  const setNewsOffsets = () => {
    document.querySelectorAll('.news-item').forEach((item) => {
      const titleSpan = item.querySelector('.title span')
      const subtitleSpan = item.querySelector('.subtitle span')
      const titleWrap = item.querySelector('.title')
      const subtitleWrap = item.querySelector('.subtitle')

      if (titleSpan && titleWrap) {
        const offset = titleWrap.offsetWidth / 2 - titleSpan.offsetWidth / 2
        titleSpan.style.setProperty('--title-center-offset', `${offset}px`)
      }
      if (subtitleSpan && subtitleWrap) {
        const offset = subtitleWrap.offsetWidth / 2 - subtitleSpan.offsetWidth / 2
        subtitleSpan.style.setProperty('--subtitle-center-offset', `${-offset}px`)
      }
    })
  }

  setNewsOffsets()
  window.addEventListener('resize', setNewsOffsets)
})
