import ImageLoader from './classes/ImageLoader'
import DefVideo from './classes/DefVideo'
import StarTrail from './classes/StarTrail'
import gsap from 'gsap'
import ScrollTrigger from 'gsap/ScrollTrigger'
import lottie from 'lottie-web'
import logoAnimation from '../json/new_constellation_logo.json'

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

  // Logo Lottie animation — plays once on load, holds last frame
  const logoContainer = document.getElementById('logo-lottie')
  const LOTTIE_NAVY = [29 / 255, 23 / 255, 53 / 255, 1]
  const LOTTIE_CREAM = [250 / 255, 250 / 255, 242 / 255, 1]

  const getLottieData = (isDark) => {
    const data = JSON.parse(JSON.stringify(logoAnimation))
    const color = isDark ? LOTTIE_CREAM : LOTTIE_NAVY
    const replace = (obj) => {
      if (!obj || typeof obj !== 'object') return
      if (Array.isArray(obj)) { obj.forEach(replace); return }
      if ((obj.ty === 'fl' || obj.ty === 'st') && obj.c?.k) obj.c.k = color
      Object.values(obj).forEach(replace)
    }
    replace(data)

    // Fix fill layers that exit before the composition ends — their op is set
    // below the total frame count, making them invisible at the held end frame.
    // Only extend layers containing a fill (not stroke-only draw-on layers).
    data.layers.forEach((layer) => {
      if (typeof layer.op === 'number' && layer.op < data.op) {
        const hasFill = layer.shapes?.some((shape) => shape.it?.some((item) => item.ty === 'fl'))
        if (hasFill) layer.op = data.op + 1
      }
    })

    return data
  }

  if (logoContainer) {
    lottie.loadAnimation({
      container: logoContainer,
      renderer: 'svg',
      loop: false,
      autoplay: true,
      animationData: getLottieData(document.documentElement.classList.contains('dark-mode')),
    })
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

      if (logoContainer) {
        const color = isDark ? '#fafaf2' : '#1d1735'
        logoContainer.querySelectorAll('[fill]:not([fill="none"])').forEach((el) => el.setAttribute('fill', color))
        logoContainer.querySelectorAll('[stroke]:not([stroke="none"])').forEach((el) => el.setAttribute('stroke', color))
      }
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
