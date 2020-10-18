
// ALERT
function displayAlert(str, color) {
   const alert = document.querySelector('.alert');
   console.log(alert)
   alert.classList.add('active-alert');
   alert.children[0].innerHTML = str;
   alert.style.backgroundColor = color;
   setTimeout(() => {
      alert.classList.remove('active-alert');
   }, 3000)
}

console.log('ALERT')



