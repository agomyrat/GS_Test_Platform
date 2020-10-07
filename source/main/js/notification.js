// const myData = [
//    {
//       title: 'Your test has been added as global.',
//       status : 'accepted'
//    },
//    {  
//       title: 'Your test has not been added as global for some reasons.',
//       status: 'declared'
//    },
//    {
//       title: 'Your solved "General Knowledge" test has been checked..',
//       status: 'normal'
//    }, 
//    {
//       title: 'Your test has not been added as global for some reasons.',
//       status: 'declared'
//    }
// ]

const status = ['accepted', 'declared', 'normal'];

function getRandomStatus() {
   const randomNum = Math.floor(Math.random() * 3);
   const randomStatus = status[randomNum];
   return randomStatus;
}

// Set Loading
function setLoadingNotification(par) {
   const loading = document.querySelector('.loading-not');

   if (par) {
      loading.classList.add('active-loading');
   } else {
      loading.classList.remove('active-loading');
   }
}

// GET Cards from DB
function fetchNotifications() {
   setLoadingNotification(true);
   fetch('https://jsonplaceholder.typicode.com/posts')
      .then((res) => res.json())
      .then((data) => {
         createUi_N(data);
         
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
         <li  id = "${notifications[i].id}" >
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
   for(let btn of rmv_btn){
      btn.addEventListener('click', (e) => {
         let li = e.target.parentElement.parentElement;
         li.classList.add('cross');
         console.log(li.children)
         li.children[1].remove();

         // DELETED NOTIFYS
         deletedNotifications.push(li.id)
         console.log(deletedNotifications)
      })
   }
}

