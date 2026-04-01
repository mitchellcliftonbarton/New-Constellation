import { emitter } from '../lib/utils'

export default class ImageLoader {
  constructor() {
    this.init()
  }

  init() {
    // load all images on initial load
    this.loadAllImages()

    // listen for new images to load
    emitter.on('images:load-new', this.loadAllImages.bind(this))
  }

  loadAllImages() {
    // get all images that are not already loaded
    const allImages = document.querySelectorAll('img[loading="lazy"]:not(.loaded)')

    // if no images are found, return
    if (allImages.length === 0) {
      return
    }

    // loop through all images
    allImages.forEach((image) => {
      // check if image is already loaded, if not, add listener
      if (image.complete && image.naturalWidth > 0) {
        image.classList.add('loaded')
      } else {
        image.addEventListener('load', () => {
          image.classList.add('loaded')
        })

        image.addEventListener('error', () => {
          image.classList.add('loaded')
        })
      }
    })
  }
}
