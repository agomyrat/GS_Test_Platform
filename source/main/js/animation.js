// const tl = gsap.timeline({defaults:{ease: "power1.out"}});

// tl.to(".card", {
//    opacity : '1',
//    delay : 1,
//    duration : 1,
//    stagger : 0.25
// })



// Side Bar
const sidebar_li = document.querySelectorAll('.side-bar-list li');
const title_name = document.querySelector('.title-name');

// First Switched tab
sidebar_li[0].classList.add('active-tab');
changeTitle(sidebar_li[0].dataset.type);

// 
for (let i = 0 ; i < sidebar_li.length ; i++ ) {

   sidebar_li[i].addEventListener('click', () => {

      let li = sidebar_li[i];
      const list_type = li.dataset.type;
      refactorList();

      li.classList.add('active-tab');
      changeTitle(list_type);
      document.querySelector('.search-input').value = '';
      count = 0;
      fetchCards(list_type)

   })

}

function refactorList() {
   // Ahli li leri onki yagdaya getir
   sidebar_li.forEach((val) => {
      val.classList.remove('active-tab');
   })
}

function changeTitle(title) {
   title_name.innerText = title;
}