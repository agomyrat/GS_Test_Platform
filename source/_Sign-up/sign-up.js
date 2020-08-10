
/* Animations */
const slidePage = document.querySelector(".slide");
const nextBtnFirst = document.querySelector(".next-button-1");
const prevBtnSec = document.querySelector(".prev-button-2");
const nextBtnSec = document.querySelector(".next-button-2");
const prevBtnThird = document.querySelector(".prev-button-3");
const createBtn = document.querySelector(".next-button-3");
const terms =  document.querySelector('.terms');
const modal = document.querySelector(".modal");
const close = document.querySelector('.close');
const countPage = document.querySelectorAll('#page')

countPage[0].style.backgroundColor = "#FF570C"
countPage[0].style.color = "white"
countPage[0].classList.add("active")

close.onclick  = () => {
   modal.style.display = "none";
}

terms.addEventListener('click',(e) => {
   e.preventDefault()
   modal.style.display = "flex";
})
window.onclick = function (event) {
   if (event.target == modal) {
      modal.style.display = "none";
   }
}

const firstFormAnimation = () => {
   if (window.innerWidth > 450) {
      slidePage.style.marginLeft = "-33.5%";
   } 
   if (window.innerWidth <= 450) {
      slidePage.style.marginLeft = "-33.5%";
   }
   countPage[1].style.backgroundColor = "#FF570C"
   countPage[1].style.color = "white"
   countPage[0].style.backgroundColor = "white"
   countPage[0].style.color = "black"
   countPage[1].classList.add("active")
   countPage[0].classList.remove("active")
}
const secondFormAnimation = () => {
   slidePage.style.marginLeft = "-66.5%";
   countPage[2].style.backgroundColor = "#FF570C";
   countPage[2].style.color = "white";
   countPage[1].style.backgroundColor = "white"
   countPage[1].style.color = "black"
   countPage[2].classList.add("active")
   countPage[1].classList.remove("active")
}

prevBtnSec.addEventListener("click", () => {
   slidePage.style.marginLeft = "0%";
   countPage[0].style.backgroundColor = "#FF570C"
   countPage[0].style.color = "white"
   countPage[1].style.backgroundColor = "white"
   countPage[1].style.color = "black"
   countPage[0].classList.add("active")
   countPage[1].classList.remove("active")
});
prevBtnThird.addEventListener("click", () => {
   slidePage.style.marginLeft = "-33.5%";
   countPage[1].style.backgroundColor = "#FF570C"
   countPage[1].style.color = "white"
   countPage[2].style.backgroundColor = "white"
   countPage[2].style.color = "black"
   countPage[1].classList.add("active")
   countPage[2].classList.remove("active")
});


/**********  Functionality   **************/

const birthDateSelector = () => {
   const days = []
   const months = ["January","February","March","April","May","June","July",
                  "August","September","October","November","December"];
   const years = []
   for(let i=1;i<=31;i++){
      days.push(i)
   }
   for(let i=2020;i>=1900;i--){
      years.push(i)  
   }

   //get all selectors
   const select = document.querySelectorAll('select.birth')
   
   const optionsDays = days.map((day) => select[0].innerHTML += `<option>${day}</option>`)
   const optionsMonth = months.map((month ,index) => select[1].innerHTML += `<option value=${index+1}>${month}</option>`)
   const optionsYears = years.map((year) => select[2].innerHTML += `<option>${year}</option>`)
   

}
window.onload = birthDateSelector;



/*User information */ 
const user = {
   firstname: '',
   lastname: '',
   username: '',
   country: '',
   phoneNumber: '',
   birthDate: '',
   email: '',
   password: ''
}
const userData = {
   username: 'Reis',
   phoneNumber: 99365577136,
   email: 'mr.parahat28@gmail.com',
}
let firstForm = false;
let secondForm = false;


 /* GET VALUES */
const getFirstForm = (firstname,lastname,username) =>{
   
   user.firstname = firstname;
   user.lastname = lastname;
   user.username = username;

}
const getSecondForm = (phoneNumber,country,birthDate) => {

   user.phoneNumber = phoneNumber;
   user.country = country;
   user.birthDate = birthDate;

}
const getThirdForm = (email, password) => {

   user.email = email;
   user.password = password

}
/******************************* Validate First Form */
nextBtnFirst.addEventListener("click", () => {

   const firstname = document.querySelector('.firstname').value;
   const lastname = document.querySelector('.lastname').value;
   const username = document.querySelector('.username').value;

   const checkValid = validator.isAlpha(firstname) && validator.isAlpha(lastname) && !validator.isNumeric(username);
   const checkValid2 = validator.isAlphanumeric(username) || validator.isAlpha(username);
   const checkData = userData.username.toLowerCase() !== username.toLowerCase() ; 

   // const checkValid = true
   // const checkValid2 = true
   // const checkData = true

   //validate first form
   if (checkValid && checkValid2 && checkData ) {
      firstFormAnimation();
      getFirstForm(firstname, lastname, username);
      firstForm = true;

   }
   else {
      alert('*Please fill out all forms !! ')
   }
});


/********************** Validate Second Form */

const input = document.querySelector("#phone");
const iti = window.intlTelInput(input, {
   // any initialisation options go here
   preferredCountries: ['tm','ru','tr','us'],
   nationalMode: true,
   utilsScript: "/build/js/utils.js?1590403638580"
});
const text = (iti.isValidNumber()) ? "International: " + iti.getNumber() : "Please enter a number below";

nextBtnSec.addEventListener("click", () => {
 
   const countryData = iti.getSelectedCountryData();
   const phoneNumber = iti.getNumber();
   const country = countryData.name
   const isValid = iti.isValidNumber();
   const birth_day = document.querySelector('.birth-day').value;
   const birth_month = document.querySelector('.birth-month').value;
   const birth_year = document.querySelector('.birth-year').value;

   const validateDate = (d, m, y) => {
      y = Number(y);
      m = Number(m);
      d = Number(d);

      let a = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
      if (y % 400 === 0 || y % 4 === 0 && y % 100 !== 0) a[1] = 29;

      --m;

      if (a[m] < d) d = a[m];

      return d;
   };

   let b_day = validateDate(Number(birth_day), Number(birth_month), Number(birth_year));

   let birthDate = ''
   console.log(Number(b_day), Number(birth_month), Number(birth_year))
   if (Number(b_day) < 10 && Number(birth_month) > 10) {
      birthDate = birth_year + "-" + birth_month + "-0" + b_day;
   }
   if (Number(birth_month) < 10 && Number(b_day) > 10) {
      birthDate = birth_year + "-0" + birth_month + "-" + b_day;
   }
   if (Number(b_day) < 10 && Number(birth_month) < 10){
      birthDate = birth_year + "-0" + birth_month + "-0" + b_day;
   }
   if(Number(birth_month) > 10 && Number(b_day) > 10) {
      birthDate = birth_year + "-" + birth_month + "-" + b_day;
   }

   const checkValid = isValid && validator.isNumeric(birth_day)  && validator.isNumeric(birth_year) && firstForm;
   // const checkValid = true

   if(checkValid){
      getSecondForm(phoneNumber,country,birthDate);
      secondForm = true
      secondFormAnimation();
   }
   else{
      alert('*Please fill out all forms !! ')
   }
});


/********************** Validate Third Form */

createBtn.addEventListener("click", () => {
   
   const email = document.querySelector('.email').value;
   const password = document.querySelector('.password').value;
   const password2 = document.querySelector('.password2').value;
   const checkbutton = document.querySelector('.check');

   const equalPassword = password == password2;
   const checkValid = validator.isEmail(email) && equalPassword && validator.isAlphanumeric(password) && checkbutton.checked && secondForm;
   // const checkValid = true

   if(checkValid){

      getThirdForm(email,password);
      console.log(user)
   }
   else{
      alert(`*Please fill all forms
*Password must contain symbols and characters
         `)
   }


});


