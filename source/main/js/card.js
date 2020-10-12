// GET CARDS

let cardNumber = 0;
let lastCardFetch = false;
let changed = false;
let searched = false;
let count = null;
let list_type;
let query;

console.log(data_language)
console.log(js_translater('History'));

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
function fetchCards(type,search) {

   let type_search = type || searched;

   if (type_search && count === 0) {
      query = search;
      list_type = list_type ? type : null;
      document.querySelector('.cards').innerHTML = '';
      cardNumber = 0;
      changed = true;
      count++
   }
   else{
      list_type = 'Recent Added';
   }

   setLoading(true);

   $.ajax({
      method: 'post',
      url: 'main/getTestCards',
      data: {
         amount: cardNumber,
         type: list_type,
         search : query
      },
      success: function (res) {
         let data = JSON.parse(res)
         
         if (data !== 0) {
            createUi(data);
            cardNumber += data.length;
            setLoading(false);
         }
         else if (data === 0 && searched) {
            console.log(query)
            changeTitle(`${js_translater('No Item Found')}: ${query}`);
            setLoading(false);
         }
         else{
            lastCardFetch =  true;
            setLoading(false);
         }

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
   users.forEach(user => {
      html += `
         <div class="card" data-row=${user.TEST_ID} >
            <a href="test/solving/${user.TEST_ID}/preview">
               <div class="img-block">
               ${user.TEST_IMAGE ?
                  //  `<img src="uploads/${user.TEST_IMAGE}" alt="">`
                  `<img src="uploads/test.png" alt="">`
                   : 
                   `<img src="uploads/test.png" alt="">`
                   }
               </div>
               <article>
                  ${user.TEST_NAME}
               </article>
            </a>
            <div class="info-test">
               <span class="username">${user.USER_NAME}</span>
               <span class="date">${user.CREATED_DATE}</span>
            </div>
         </div>
         `
   });
   document.querySelector('.cards').innerHTML += html ;
}



// Scroll Function
const m = document.querySelector('main');

window.onscroll = () => {
   let y = window.innerHeight + window.scrollY;
   let height = m.clientHeight;

   if(y > height - 3 && y < height ){
      if(!lastCardFetch){
         fetchCards(list_type,query);
      }
      else{
         setLoading(false);
      }
   }
}




/* SEARCH INPUT */

const search_input = document.querySelector('#form-search');


search_input.addEventListener('submit', (e) =>{
   e.preventDefault();
   const input = document.querySelector('.search-input').value;

   searched = true;
   cardNumber = 0;
   count = 0;
   lastCardFetch = false;

   refactorList();
   console.log(input)
   changeTitle(`${js_translater('Search Result')}: ${input}`);
   fetchCards(null, input)
});