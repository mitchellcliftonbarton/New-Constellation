import ImageLoader from './classes/ImageLoader'
import DefVideo from './classes/DefVideo'

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
})
