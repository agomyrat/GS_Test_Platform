/* DOM */

/// Navbar collapse
const collapse = document.querySelector('.collapse');
const items = document.querySelector('.items');
const bgSide = document.querySelector('.bg')
const links  = document.querySelectorAll('.links');

const nav_header = document.querySelector('.nav-header');

window.onscroll = (e) => {
   if(window.scrollY > 10) {
      nav_header.classList.add('add-shadow')
   }
   else{
      nav_header.classList.remove('add-shadow')
   }
}

bgSide.style.display = "none"
function removeBg() {
   items.classList.remove('active');
   bgSide.style.display = "none"
}
collapse.onclick = () => {
   if (bgSide.style.display === 'none') {
      bgSide.style.display = 'block'
   } else {
      bgSide.style.display = 'none'
   }
      items.classList.toggle('active')  
}

bgSide.addEventListener('click',removeBg)

for(let x = 0; x < links.length ; x++){
   links[x].addEventListener('click' , () => {
      removeBg()
   })
}

/// Laoder animation

function loader() {
   document.querySelector('.loader').style.display = "none"
}

// setTimeout(loader, 3000)

///Changes Home page image
window.onresize = screen;
window.onpageshow = screen;
function screen() {
   const width = window.innerWidth;
   if (width <= "760") {
      document.querySelector('.home-1').src = "source/welcome/images/home-2.svg";
      console.log('actice')
   }
   else {
      document.querySelector('.home-1').src = "source/welcome/images/home-1.svg";
   }
}

//Dropdown
document.querySelector('.dropdown').addEventListener('mouseover', function () {
   document.querySelector('.dropdown-list').style.display = "block";
});

document.querySelector('.dropdown').addEventListener('mouseout', function () {
   document.querySelector('.dropdown-list').style.display = "none";
});


$('form').on('submit',function(e){	
   e.preventDefault()	

      var formData = new FormData(this);	
      $.ajax({	
         url:'mailnotification/contactUs',	
         type:'post',	
         processData: false,	
         contentType: false,	
         data: formData,	
         success:function(data){	
            if(data == 1){	
               alert('Thanks for contacting us!');	
            }else{	
               alert("Your message couldn't be sent!");	
            }	
         },	
         error:function(){	
            console('error boldy',data);	
         }	
      });	

});


//Validation Inputs

const data = {};
function onChangeInput(name, value) {
   data[name] = value;
}

function send() {
   // console.log({ name: data.name, email: data.email, message: data.message });
   let errors = [];
   if (!data.name || !validator.isAlpha(data.name)){
      errors.push("Invalid Name input")
      document.querySelector('.error p').innerText = errors[0]
   }
   else if (!data.email || !validator.isEmail(data.email)) {
      errors.push("Invalid Email input");
      document.querySelector('.error p').innerText = errors[0]
   }
   else if (!data.message || validator.isEmpty(data.message)) {
      errors.push("Invalid Message input");
      document.querySelector('.error p').innerText = errors[0]
   }
   else {
      console.log('SENT')
      alert('message has been sent')
      errors = []
      document.querySelector('.error p').innerText = "";
      const inputs = document.querySelectorAll('.input');
      inputs.forEach((e) => {
         e.value = ""
      })
      document.querySelector('#message').value = ""
   }
}



const inputs = document.querySelectorAll('.input');
const message_ = document.querySelector('#message');

message_.addEventListener('input', (e) => {
   onChangeInput('message', e.target.value)
});

for (let x = 0; x < inputs.length; x++) {
   inputs[x].addEventListener('input', (e) => {
      let inputName = e.target.id;
      onChangeInput(inputName, e.target.value)
   })
}

document.querySelector('.send').addEventListener('click', send);

function changeLanguage(language){
               $.ajax({ 
                  url:'welcome/changeLanguage',
                  method:'POST',
                  data:{language : language},
                  success:function(){
                        location.reload();
                   },
                  error: function(){
                        console.log("Can't change language error!!!");
                  }
              });
         }
