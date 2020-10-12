// Side bar
const sideBar = document.querySelector('.side-burger');
const aside = document.querySelector('aside');
const section = document.querySelector('section');

sideBar.addEventListener('click', () => {
   aside.classList.toggle('aside-active')
   sideBar.classList.toggle('sideBar-active')
})
section.addEventListener('click' , () => {
   aside.classList.remove('aside-active');
   sideBar.classList.remove('sideBar-active')
})



// Image effect
const imageEffect = () => {
   let img = document.querySelectorAll('.img-eff');
   let bg_dark = document.querySelector('.bg-dark');
   let imgPlace = document.querySelector('.image-place img');
   let closeBtn = document.querySelector('.close-btn');

   for(let x = 0 ; x < img.length ; x++){
      img[x].addEventListener('click', (e) => {
         const imgSrc = e.target.src;
         imgPlace.src = imgSrc
         bg_dark.style.display = 'flex'
      });

      closeBtn.addEventListener('click', () => {
         bg_dark.style.display = 'none'
      })
   }
}



/// FOR AUTO HEIGHT TEXTAREA
var observe;
if (window.attachEvent) {
    observe = function (element, event, handler) {
        element.attachEvent('on'+event, handler);
    };
   console.log(window.attachEvent)
}
else {
    observe = function (element, event, handler) {
        element.addEventListener(event, handler, false);
    };
}
function init () {
    var text = document.querySelector('.question-field');
    function resize () {
        text.style.height = 'auto';
        text.style.height = text.scrollHeight+'px';
    }
    /* 0-timeout to get the already changed text */
    function delayedResize () {
        window.setTimeout(resize, 0);
    }
    observe(text, 'change',  resize);
    observe(text, 'cut',     delayedResize);
    observe(text, 'paste',   delayedResize);
    observe(text, 'drop',    delayedResize);
    observe(text, 'keydown', delayedResize);

    text.focus();
    text.select();
    resize();
}


/// ANIMATIONS FOR NOTIFICATIONS
const displayError = (err) => {
   const errorBlock = document.querySelector('.error-block')
   question.error = err;
   errorBlock.innerHTML = question.error
   errorBlock.style.marginRight = "0px"
   setTimeout(() => {
      errorBlock.style.marginRight = "-50%"
   }, 3000)
}
const notify = (n) => {
   const note = document.querySelector('.note')
   question.error = n;
   note.innerHTML = question.error
   note.style.marginRight = "0px"
   setTimeout(() => {
      note.style.marginRight = "-50%"
   }, 2000)
}

//OPACITY EFFECT
const opacityEffect = () => {
   const section = document.querySelector('section')
   section.classList.add('active');
   setTimeout(() => {
      section.classList.remove('active');
   }, 700)
}




const mobileRotate = () => {
   console.log(document.querySelector('.rotate-bg'))
   if (window.innerWidth < 500) {
      document.querySelector('.rotate-bg').style.display = "flex";

   } else {
      document.querySelector('.rotate-bg').style.display = "none";
   }
}


window.onorientationchange = () => {
   if (window.innerWidth >= 568) {
      document.querySelector('.rotate-bg').style.display = "flex"
   } else {
      document.querySelector('.rotate-bg').style.display = "none"
   }
}
mobileRotate()
window.onresize = mobileRotate;
window.onload = init

