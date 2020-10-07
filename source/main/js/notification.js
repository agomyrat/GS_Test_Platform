
const status = ['accepted', 'declared', 'normal'];
let notifNumber = 0;

function getRandomStatus() {
   const randomNum = Math.floor(Math.random() * 3);
   const randomStatus = status[randomNum];
   return randomStatus;
}

// Set Loading
function setLoadingNotification(par) {
   // const loading = document.querySelector('.loading-not');

   if (par) {
      document.querySelector('.hover-block').innerHTML = 
         `<div class="loading-not active-loading">
            <div>
               <img src="source/general/img/2.svg" alt="">
            </div>
         </div>`
   }
}

// GET Cards from DB
function fetchNotifications() {
   setLoadingNotification(true);

   fetch('https://jsonplaceholder.typicode.com/posts')
      .then((res) => res.json())
      .then((data) => {
         createUi_N(data);
         notifNumber = data.length;
         notifNumber !== 0 ? showDot(true) : showDot(false)
         console.log(notifNumber)
         setLoadingNotification(false)
      })
      .catch((err) => {
         console.error('failed to fetch')
      })

}
fetchNotifications()

// Create Cards
function createUi_N(data) {
   let html = '';
   const notifications = data;

   for(let i = 0; i < notifications.length / 5 ; i++){
      html += `
         <li id="${notifications[i].id}" >
            <div>
               <a href="#" class=${getRandomStatus()}>
                  <i class="far fa-check-circle"></i>&nbsp;
                  ${notifications[i].title}
               </a>
            </div>
            <div>
               <i id="remove-btn${i}" class="fas fa-times remove-note"></i>
            </div>
         </li>
         `
   }

   document.querySelector('.hover-block').innerHTML = html;
   removeNotification()
}

let deletedNotifications = [];

function removeNotification() {
   const rmv_btn = document.querySelectorAll('.remove-note');

   console.log(rmv_btn)

   for (let i = 0 ; i < rmv_btn.length ; i++) {
      console.log(i)
      btn[i].addEventListener('click', (e) => {

         let li = e.target.parentElement.parentElement;
         li.classList.add('cross');
         li.children[1].remove();

         if (i === notifNumber - 1) {
            showDot(false);
         }

         // DELETED NOTIFYS
         deletedNotifications.push(li.id)
         console.log(deletedNotifications)
      })
   }
}

function showDot(e) {
   const dot = document.querySelector('.message-dot');

   if (e) {
      dot.classList.add('show-dot');
   }
   else{
      dot.classList.remove('show-dot');
   }
}