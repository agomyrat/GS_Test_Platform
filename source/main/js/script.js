const notification = document.querySelector('.note');
const profile = document.querySelector('.prof');
const lang = document.querySelector('.lan');
// SIde
const burger = document.querySelector('.side-burger');
const main = document.querySelector('main');
const aside = document.querySelector('aside');


notification.onmouseover = () => {
   // fetchNotifications()
   eventListener('not')
}
profile.onmouseover = () => {
   eventListener('profile')
}
lang.onmouseover = () => {
   eventListener('language')
}
notification.onmouseout = () => {
   clear('not')
}
profile.onmouseout = () => {
   clear('profile')

}
lang.onmouseout = () => {
   clear('language')
}

function eventListener(e) {
   document.querySelector(`.${e}`).style.display = 'block'
}

function clear(e) {
   document.querySelector(`.${e}`).style.display = 'none'
}

//  NAVBAR
const collapse = document.querySelector('.collapse');
const ul = document.querySelector('.nav-list')


collapse.addEventListener('click', () => {
   ul.classList.toggle('active-nav');
   if(ul.classList.contains("active-nav")){
      main.style.filter = "brightness(30%)"
      burger.style.display = "none"
   }
   else{
      main.style.filter = ""
      burger.style.display = "block"
   }
   aside.classList.remove('active');
   burger.style.display = "block"
});
main.addEventListener('click', () => {
   ul.classList.remove('active-nav');
   main.style.filter = ""
});




burger.addEventListener('click', () => {
   aside.classList.add('active');
   ul.classList.remove('active-nav');
   burger.style.display = "none"
   main.style.filter = "brightness(30%)"
})

main.addEventListener('click', () => {
   aside.classList.remove('active');
   main.style.filter = ""
	if(window.innerWidth < 1000){
		burger.style.display = "block"
	}
})

window.addEventListener('resize', () => {
	if(window.innerWidth > 1000){
		burger.style.display = "none"
	}
	else{
		burger.style.display = "block"
	}
})


