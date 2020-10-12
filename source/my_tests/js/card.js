
const obj = {
   showResults : 'shwrslt123',
   editQuestions : 'edtqst123',
   editInformations : 'edtInfo123',
   copyLink : 'cpLink123',
   copyTest : 'cpTest123',
   delete : 'dlt123'
}
// // GET CARDS

let cardNumber = 0;
let lastCardFetch = false;

// console.log(data_language)
// console.log(js_translater('History'));

// Set Loading
function setLoading(par) {
   const loading = document.querySelector('.loading');
   if(par){
      loading.classList.add('active-loading');
   }
   else{
      loading.classList.remove('active-loading');
   }
}

// GET Cards from DB
function fetchCards(type = 'mytests') {
   setLoading(true);

   console.log(type)

   $.ajax({
      method: 'post',
      url: 'getTestCards',
      data: {
         amount: cardNumber,
         type : type ,

      },
      success: function (res) {
         let data = JSON.parse(res)
         
         createUi(data);
         cardNumber = data.length;
         setLoading(false);

      },
      error: function (err) {
            console.log(err)
      }
   })

}

fetchCards();

// Create Cards
function createUi(data) {
   let domain = sessionStorage.getItem('domain');
   let html = '';
   const users = data;

   if(users !==  0){
      users.forEach(user => {
         html += `
            <div class="card" data-id=${user.TEST_ID} >
               <div class="img-block">
                  ${user.TEST_IMAGE ?
                     //  `<img src="uploads/${user.TEST_IMAGE}" alt="">`
                     `<img src="../uploads/test.png" alt="">`
                     : 
                     `<img src="../uploads/test.png" alt="">`
                     }
               </div>
               <article class="substring">
                  ${user.TEST_NAME}
               </article>
               <div class="info-test">
                  <div>
                        <span class="number-solved"><i class="far fa-user"></i>&nbsp;${user.SOLVING_COUNT}</span>
                        &nbsp;
                        <span class="likes"><i class="far fa-heart"></i>&nbsp;${user.LIKE_COUNT}</span>
                  </div>
                  <span class="date">${user.CREATED_DATE}</span>
               </div>
            </div>
            `
      });
      document.querySelector('.cards').innerHTML = html ;
      document.querySelector('.no-item-block').style.display = "none"
   }
   else{
      document.querySelector('.cards').innerHTML = ''  ;
      document.querySelector('.no-item-block').style.display = "flex"
   }
   showCards()
}



const modal = document.querySelector('.modal-bg');
const substring = document.querySelectorAll('.substring');

function showCards() {
   const cards = document.querySelectorAll('.card');
   const qTitle = document.querySelector('.q-title');

   cards.forEach((card,index) => {
      card.addEventListener('click', () => {
         qTitle.innerHTML = cards[index].childNodes[3].innerHTML;

         let test_id = cards[index].dataset.id;
         // GET LINKSs
         getLinks(test_id)
         modal.style.display = "flex"
      })
   });
}



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
