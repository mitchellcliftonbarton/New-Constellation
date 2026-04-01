function d(o){return{all:o=o||new Map,on:function(t,e){var n=o.get(t);n?n.push(e):o.set(t,[e])},off:function(t,e){var n=o.get(t);n&&(e?n.splice(n.indexOf(e)>>>0,1):o.set(t,[]))},emit:function(t,e){var n=o.get(t);n&&n.slice().map(function(l){l(e)}),(n=o.get("*"))&&n.slice().map(function(l){l(t,e)})}}}const a=d();class s{constructor(){this.init()}init(){this.loadAllImages(),a.on("images:load-new",this.loadAllImages.bind(this))}loadAllImages(){const t=document.querySelectorAll('img[loading="lazy"]:not(.loaded)');t.length!==0&&t.forEach(e=>{e.complete&&e.naturalWidth>0?e.classList.add("loaded"):(e.addEventListener("load",()=>{e.classList.add("loaded")}),e.addEventListener("error",()=>{e.classList.add("loaded")}))})}}document.addEventListener("DOMContentLoaded",async()=>{console.log(`%c 
Development by Cold Rice 
 
cold-rice.info 
 
`,"color: grey"),new s});
