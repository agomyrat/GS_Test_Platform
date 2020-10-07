const cards = document.querySelectorAll('.card');
const modal = document.querySelector('.modal-bg');
const substring = document.querySelectorAll('.substring');
const qTitle = document.querySelector('.q-title');

cards.forEach((card,index) => {
   card.addEventListener('click', () => {
      qTitle.innerHTML = cards[index].childNodes[3].innerHTML;
      // qTitle.innerHTML = cards[index].ch
      modal.style.display = "flex"
   })
})

window.onclick = (e) => {
   if(e.target.className == "modal-bg"){
      modal.style.display = "none"
   }
} 


for(let x = 0 ; x < substring.length; x++){
   const sub = substring[x].innerText;
   let res = '';

   if(sub.length > 50){
      res = sub.substr(0,50);
      substring[x].innerHTML = res + "..."
   }
   else{
      substring[x].innerHTML = sub ;
   }
}
