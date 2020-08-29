function animations() {
   gsap.from('.anim1',{opacity: 0,duration:0.7, y : -30,delay:1,stagger:0.4})
   gsap.from('.part2 .svg img', {opacity:0, duration:1 ,x: 30,delay:1})
}


document.body.onload = function() {
   animations();
   loader()
}


let tl = gsap.timeline({
   scrollTrigger : {
      trigger: '.animate'
   }
}) 

tl.from('.about-header', {x: -50, opacity: 0, duration:0.5 })
   .from('.about-image', {x: -200, opacity: 0, duration:  1})
   .from('article', { y: 200, opacity:0, duration:1}, "-=1")
   .from('.contact-header' ,{x: -50, opacity: 0, duration:0.5 })
   .from('.contact-image',{x: -200, opacity: 0, duration:  1})