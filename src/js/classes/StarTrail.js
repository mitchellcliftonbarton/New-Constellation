export default class StarTrail {
  constructor(canvas) {
    this.canvas = canvas;
    this.ctx = canvas.getContext('2d');

    this.resize();
    this.ro = new ResizeObserver(() => this.resize());
    this.ro.observe(canvas.parentElement);

    // Mouse state — start at canvas centre
    this.mouseX = canvas.width / 2;
    this.mouseY = canvas.height / 2;
    this.onPage = false;

    // Path history
    this.totalDist = 0;
    this.headDist  = 0;
    this.TRAIL_LAG = 0.14;
    this.pathHistory = [{ x: this.mouseX, y: this.mouseY, d: 0 }];
    this.MAX_HISTORY = 8000;

    // Trail config
    this.TRAIL_COUNT   = 7;
    this.CIRCLE_R      = 5;
    this.TRAIL_SPACING = 40;

    // Placed circles (on click)
    this.placed = [];

    // Bind & attach events to the parent so they fire regardless of which
    // child element (links, canvas, etc.) the mouse is over
    this._onMouseMove  = this._onMouseMove.bind(this);
    this._onMouseLeave = this._onMouseLeave.bind(this);
    this._onMouseEnter = this._onMouseEnter.bind(this);
    this._onClick      = this._onClick.bind(this);

    const container = canvas.parentElement;
    container.addEventListener('mousemove',  this._onMouseMove);
    container.addEventListener('mouseleave', this._onMouseLeave);
    container.addEventListener('mouseenter', this._onMouseEnter);
    container.addEventListener('click',      this._onClick);

    requestAnimationFrame(() => this.animate());
  }

  resize() {
    const rect = this.canvas.parentElement.getBoundingClientRect();
    this.canvas.width  = rect.width;
    this.canvas.height = rect.height;
  }

  _onMouseMove(e) {
    const rect = this.canvas.getBoundingClientRect();
    this.mouseX = e.clientX - rect.left;
    this.mouseY = e.clientY - rect.top;
    this.onPage = true;

    const last = this.pathHistory[this.pathHistory.length - 1];
    const dx = this.mouseX - last.x;
    const dy = this.mouseY - last.y;
    const segLen = Math.sqrt(dx * dx + dy * dy);
    if (segLen > 2) {
      this.totalDist += segLen;
      this.pathHistory.push({ x: this.mouseX, y: this.mouseY, d: this.totalDist });
      if (this.pathHistory.length > this.MAX_HISTORY) this.pathHistory.shift();
    }
  }

  _onMouseLeave() { this.onPage = false; }
  _onMouseEnter() { this.onPage = true; }

  _onClick(e) {
    const rect = this.canvas.getBoundingClientRect();
    this.placed.push({
      x:        e.clientX - rect.left,
      y:        e.clientY - rect.top,
      birth:    performance.now(),
      duration: 10000,
    });
  }

  pointAtAbsDist(d) {
    const ph = this.pathHistory;
    if (ph.length < 2) return { x: ph[0].x, y: ph[0].y };
    d = Math.max(ph[0].d, Math.min(d, ph[ph.length - 1].d));
    let lo = 0, hi = ph.length - 1;
    while (lo < hi - 1) {
      const mid = (lo + hi) >> 1;
      if (ph[mid].d <= d) lo = mid; else hi = mid;
    }
    const a = ph[lo], b = ph[hi];
    if (b.d === a.d) return { x: a.x, y: a.y };
    const t = (d - a.d) / (b.d - a.d);
    return { x: a.x + (b.x - a.x) * t, y: a.y + (b.y - a.y) * t };
  }

  circlePath(cx, cy, r) {
    this.ctx.beginPath();
    this.ctx.arc(cx, cy, r, 0, Math.PI * 2);
    this.ctx.closePath();
  }

  animate() {
    requestAnimationFrame(() => this.animate());
    const { ctx, canvas } = this;
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // Ease head toward the latest recorded distance
    this.headDist += (this.totalDist - this.headDist) * this.TRAIL_LAG;

    if (this.onPage) {
      // Trail dots
      for (let i = this.TRAIL_COUNT - 1; i >= 0; i--) {
        const pt    = this.pointAtAbsDist(this.headDist - (i + 1) * this.TRAIL_SPACING);
        const frac  = 1 - (i + 1) / this.TRAIL_COUNT;
        const alpha = 0.25 + frac * 0.5;
        ctx.save();
        ctx.globalAlpha = alpha;
        ctx.fillStyle   = '#FAFAF2';
        this.circlePath(pt.x, pt.y, this.CIRCLE_R);
        ctx.fill();
        ctx.restore();
      }

      // Cursor dot
      ctx.save();
      ctx.globalAlpha = 0.9;
      ctx.fillStyle   = '#FAFAF2';
      this.circlePath(this.mouseX, this.mouseY, this.CIRCLE_R);
      ctx.fill();
      ctx.restore();
    }

    // Expire old placed circles
    const now = performance.now();
    for (let i = this.placed.length - 1; i >= 0; i--) {
      if (now - this.placed[i].birth > this.placed[i].duration) this.placed.splice(i, 1);
    }

    // Build active list with live alpha
    const active = this.placed.map(s => {
      const age   = now - s.birth;
      const HOLD  = 5000;
      const alpha = age < HOLD ? 1.0 : Math.max(0, 1 - (age - HOLD) / (s.duration - HOLD));
      return { ...s, alpha };
    });

    // Connecting lines between placed circles
    if (active.length > 1) {
      const sorted = [...active].sort((a, b) => a.birth - b.birth);
      for (let i = 0; i < sorted.length - 1; i++) {
        const a = sorted[i], b = sorted[i + 1];
        ctx.save();
        ctx.globalAlpha = Math.min(a.alpha, b.alpha) * 0.6;
        ctx.strokeStyle = '#FAFAF2';
        ctx.lineWidth   = 1.5;
        ctx.beginPath();
        ctx.moveTo(a.x, a.y);
        ctx.lineTo(b.x, b.y);
        ctx.stroke();
        ctx.restore();
      }
    }

    // Placed circles
    for (const s of active) {
      ctx.save();
      ctx.globalAlpha = s.alpha;
      ctx.fillStyle   = '#FAFAF2';
      this.circlePath(s.x, s.y, this.CIRCLE_R);
      ctx.fill();
      ctx.restore();
    }
  }
}
