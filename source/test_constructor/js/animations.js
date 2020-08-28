
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




window.onload = init