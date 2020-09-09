// Pagination Animation
const paginationSlider = document.querySelector('.pagination-slider');
const paginationSpan = document.querySelectorAll('.page');
const leftBtn = document.querySelector('.left');
const rightBtn = document.querySelector('.right')
function onloadFunc() {
   let p = 0;
   leftBtn.style.opacity = "0.5";
   paginationSlider.children[0].classList.add('active')

   rightBtn.addEventListener('click', (e) => {
      const count = paginationSpan.length;
      if ((count - 9) * 32.83 > p){
         p += 164.2
         paginationSpan[0].style.marginLeft = `-${p}px` 
         rightBtn.style.opacity = "1"
         leftBtn.style.opacity = "1"
      }
      else{
         rightBtn.style.opacity = "0.5"
      }
   }) 
   leftBtn.addEventListener('click', (e) => {
      if(p > 0){
         p -= 164.2
         paginationSpan[0].style.marginLeft = `-${p}px`
         leftBtn.style.opacity = "1"
         rightBtn.style.opacity = "1"
      }
      else{
         leftBtn.style.opacity = "0.5"
      }
   })

   
}
//Background of each page
function activatePage(pg) {
   for (let i = 0; i < paginationSlider.children.length; i++) {
      paginationSlider.children[i].classList.remove('active')
   }
   paginationSlider.children[pg - 1].classList.add('active')
}

//OPACITY EFFECT
const opacityEffect = () => {
   const container = document.querySelector('.container')
   container.classList.add('opacityEff');
   setTimeout(() => {
      container.classList.remove('opacityEff');
   }, 1000)
}