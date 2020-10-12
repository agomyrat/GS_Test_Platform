const notification = document.querySelector('.note');
const profile = document.querySelector('.prof');
const lang = document.querySelector('.lan');


notification.onmouseover = () => {
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
});





function changeLanguage(language){
   console.log(url_from_php);

   $.ajax({ 
      url: url_from_php+'main/changeLanguage',
      method:'POST',
      data:{language : language},
      success:function(){
            location.reload();
       },
      error: function(){
            console.log("Can't change language error!!!");
      }
  });
}


