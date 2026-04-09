import Player from '@vimeo/player'
import YouTubePlayer from 'youtube-player'

export default class DefVideo extends HTMLElement {
  constructor() {
    super()

    this.videoContainer = this.querySelector('.video-container')
    this.playButton = this.querySelector('.play')
    this.videoEl = this.querySelector('video')
    this.videoInner = this.querySelector('.video-inner')

    this.type = null // 'html5' | 'vimeo' | 'youtube'
    this.videoInstance = null // Vimeo Player or YouTube Player instance
  }

  connectedCallback() {
    if (this.videoEl) {
      this.type = 'html5'
    } else if (this.videoInner?.dataset.vimeoUrl) {
      this.type = 'vimeo'
      this.videoInstance = new Player(this.videoInner, {
        url: this.videoInner.dataset.vimeoUrl,
        controls: true,
        portrait: false,
        title: false,
        vimeo_logo: false,
      })
      this.videoInstance.ready().then(() => {
        const iframe = this.videoInner.querySelector('iframe')
        if (iframe) iframe.tabIndex = -1
      })
    } else if (this.videoInner?.dataset.youtubeId) {
      this.type = 'youtube'
      this.videoInstance = YouTubePlayer(this.videoInner, {
        videoId: this.videoInner.dataset.youtubeId,
      })
      this.videoInstance.getIframe().then(iframe => {
        iframe.tabIndex = -1
      })
    }

    this.playButton?.addEventListener('click', () => this.play())
  }

  play({ startOver = false } = {}) {
    if (this.type === 'html5') {
      if (startOver) {
        this.videoEl.currentTime = 0
      }
      this.videoEl.play()
    } else if (this.type === 'vimeo') {
      if (startOver) {
        this.videoInstance.setCurrentTime(0)
      }
      this.videoInstance.play()
    } else if (this.type === 'youtube') {
      if (startOver) {
        this.videoInstance.seekTo(0)
      }
      this.videoInstance.playVideo()
    }

    this.videoContainer.classList.add('playing')
    const iframe = this.videoInner?.querySelector('iframe')
    if (iframe) iframe.removeAttribute('tabindex')
  }

  pause({ removeClass = true } = {}) {
    if (this.type === 'html5') {
      this.videoEl.pause()
    } else if (this.type === 'vimeo') {
      this.videoInstance.pause()
    } else if (this.type === 'youtube') {
      this.videoInstance.pauseVideo()
    }

    if (removeClass) {
      this.videoContainer.classList.remove('playing')
    }
  }
}
