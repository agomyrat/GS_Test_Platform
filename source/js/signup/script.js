
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
console.log(window.innerWidth )

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
   const optionsMonth = months.map((month) => select[1].innerHTML += `<option>${month}</option>`)
   const optionsYears = years.map((year) => select[2].innerHTML += `<option>${year}</option>`)
   

}
window.onload = birthDateSelector;

/************************Check Database */

let check_username = false;
let check_email = false;

function throttle(fun, delay){
            var timer = null;
            return function(){
                var context = this, args = arguments;
                clearTimeout(timer);
                timer = window.setTimeout(function(){
                    fun.apply(context, args);
                },
                delay || 800);
            };
        }
function check(column_name,text){
            if((column_name == "E_MAIL" && text.indexOf('@') == -1) || text.indexOf(' ') != -1){
                return false;
            }
// type_checking: USER_NAME, E_MAIL
            $.ajax({
                url:'signup/check_database_for_sign_up_input',
                method:'POST',
                data:{column_name:column_name,text:text},
                success:function(data){
                    console.log(data);
                   if(data == 1){
                        console.log('gul yaly on yok eken basyber', text);
                        if(column_name == 'USER_NAME'){check_username= true; $(".check-username").fadeOut(600);}
                        else if(column_name == 'E_MAIL'){check_email = true; $(".check-email").fadeOut(600);}
                   }else{
                        console.log('Onem bara', text);
                        if(column_name == 'USER_NAME'){check_username= false;$(".check-username").fadeIn(300);}
                        else if(column_name == 'E_MAIL'){check_email = false;$(".check-email").fadeIn(300);}
                   }
                },
                error: function(){
                    console.log('Error bolda hoooow');
                    return false;
                }
            });
        }


        // user name control 
        $('.username').keyup(throttle(function(){
            check('USER_NAME',$(this).val());
        }));


        // email control
        $('.email').keyup(throttle(function(){
            check('E_MAIL',$(this).val());
        }));




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
   //const checkData = userData.username.toLowerCase() !== username.toLowerCase() ; 

   // const checkValid = true
   // const checkValid2 = true
   // const checkData = true

    //check('USER_NAME',username);

   //validate first form
   if (checkValid && checkValid2 && check_username ) {
      firstFormAnimation();
      getFirstForm(firstname, lastname, username);
      firstForm = true;
      console.log(user)

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
   utilsScript: "/build/utils.js?1590403638580"
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
   const birthDate = birth_day + "-" + birth_month + "-" + birth_year

   const checkValid = isValid && validator.isNumeric(birth_day) && validator.isAlpha(birth_month) && validator.isNumeric(birth_year) && firstForm;
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
   const checkValid = validator.isEmail(email) && equalPassword && validator.isAlphanumeric(password) && checkbutton.checked && secondForm && check_email;
   // const checkValid = true

   if(checkValid){
      getThirdForm(email,password);
      console.log(user);

       $.ajax({
            url:'signup/registrate_user',
            method:'POST',
            data:{user : user},
            success:function(data){
                  console.log("success",data);
                },
            error: function(){
                    console.log('Something went wrong! Cant registrate user');
                }
            });

     // window.location.href = "welcome/mailNotification";
   }
   else{
      alert(`*Please fill all forms
            *Password must contain symbols and characters
         `)
   }


});




        
    

