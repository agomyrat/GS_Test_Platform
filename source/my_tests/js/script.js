
// TABS
const tabs = document.querySelectorAll('.tab');

for (let tab of tabs) {
   tab.addEventListener('click', (e) => {
      activeTab(tab);
      let type = tab.dataset.row;
      fetchCards(type);
   })
}

function activeTab (val) {

   for (let tab of tabs) tab.classList.remove('active-tab');

   val.classList.add('active-tab')
}



const links = document.querySelectorAll('.links');


// GET LINKS
function getLinks(id) {
   let domain = url_from_php;

   for (let link of links){
      let row = link.dataset.row;

      switch(row) {
         case 'showResults':
            link.href = `${domain}/test/results/${id}`;
            break;
         case 'editQuestions':
            link.href = `${domain}/test/constructor/${id}`;
            break;
         case 'editInformations':
            link.href = `${domain}/test/constructor/${id}/postview`;
            break;
         case 'copyLink':
            link.nextElementSibling.value = `${domain}/test/solving/${id}/preview`;
            break;
         case 'copyTest':
            console.log('showRecopyTestsults')
            break;
         case 'delete':
            console.log('delete')
            break;
         default :
            'DEF'
            break;
   }
   }


   console.log(domain)
   console.log(links)
}

// Copy Link
function copy() {
  var copyText = document.querySelector(".copy-link-test");
  copyText.focus();
  copyText.select();
  document.execCommand("copy");
}

document.querySelector("#copy-link").addEventListener("click", copy);