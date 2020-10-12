const mobileRotate = () => {
   if (window.innerWidth < 500) {
      document.querySelector('.rotate-bg').style.display = "flex"
   } else {
      document.querySelector('.rotate-bg').style.display = "none"
   }
}


window.onorientationchange = () => {
   if (window.innerWidth >= 500) {
      document.querySelector('.rotate-bg').style.display = "flex"
   } else {
      document.querySelector('.rotate-bg').style.display = "none"
   }
}

mobileRotate()
window.onresize = mobileRotate;

// FETCH DATAS FOR DATA TABLE

const tbody = document.querySelector('tbody');

function createUi (data) {
   let html = '';
   console.log(data)
   data.forEach((val) => {
      html += `
         <tr>
            <td>${val.userId}</td>
            <td>${val.id}</td>
            <td>${val.title}</td>
            <td>${val.body}</td>
         </tr>  
      `
   })
   tbody.innerHTML = html;
}

function fetchData () {
   fetch(('https://jsonplaceholder.typicode.com/posts'))
   .then((res) => res.json())
   .then((data) => {
      createUi(data)
   })
}
