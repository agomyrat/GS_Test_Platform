"use strict";

// import alertMessage from "./functions.js";

let photoInput = document.getElementById("photoInput");
let photo = document.getElementById("photo");
let upperAlert = document.querySelector(".alert");
let data = {};
let deletedFileName;


photoInput.addEventListener("change", function () {
  let newImage = event.target.files[0];
  console.log(newImage);
  if (newImage.size > 2000000) {
    alertMessage(upperAlert, "error", "Image cannot be more than 2mb");
  } else {
    //sending file
      if(data.image != undefined){
        deletedFileName = photo.getAttribute('data-image'); 
        console.log(data.image.name);
      }
    data.image = newImage;
 
    // some code
    // setting new image
    photo.src = URL.createObjectURL(event.target.files[0]);
    console.log(photo.src);
  }
});

let status = document.getElementById("status");
let password = document.getElementById("password");

if (status.value === "private") {
  password.removeAttribute("disabled");
} else {
  password.value = null;
  password.setAttribute("disabled", true);
}

status.addEventListener("change", function (event) {
  if (status.value === "private") {
    password.removeAttribute("disabled");
  } else {
    password.value = null;
    password.setAttribute("disabled", true);
  }
});


let formData = new FormData();

let form = document.getElementById("form");

// form.addEventListener("submit", function (event) {
//   event.preventDefault();
//   for (let element of form.elements) {
//     if (
//       element.value === "" ||
//       element.value === undefined ||
//       element.value === null
//     ) {
//     } else {
//       data[element.name] = { value: element.value };
//     } 
//   }

//    if(data.image){
//       formData.append("image",data.image,JSON.stringify({
//          id : 'abcd',
//       }))
//    }
//   formData.append("data", JSON.stringify(data));
//   console.log(formData)

//   $.ajax({
//     type: 'post',
//     processData: false,
//     contentType: false,
//     url: '../../publishTest',
//     data: formData,
//     success: function(result){     
//       console.log(result);
//     },
//     error: function(error){
//         console.log(error,"error: constructor postview error!");
//     }
//     });
// });

$("#form").on('submit',function(event){
  event.preventDefault();
  let formData = new FormData(this);
  formData.append('deletedFileName',deletedFileName);

  $.ajax({
    type: 'post',
    processData: false,
    contentType: false,
    url: '../../publishTest',
    data: formData,
    success: function(result){     
      console.log(result);
    },
    error: function(error){
        console.log(error,"error: constructor postview error!");
    }
  });
})


// KEYWORDS
var txt = document.getElementById('txt');
var list = document.getElementById('list');
var items = ['PHP', 'React.js', 'WordPress'];

txt.addEventListener('keypress', function (e) {
   if (e.key === 'Enter') {
      let val = txt.value;
      if (val !== '') {
         if (items.indexOf(val) >= 0) {
            alert('Tag name is a duplicate');
         } else {
            items.push(val);
            data.keywords = items;
            render();
            txt.value = '';
            txt.focus();
         }
      } else {
         alert('Please type a tag Name');
      }
   }
});

function render() {
   list.innerHTML = '';
   items.map((item, index) => {
      list.innerHTML += `<li><span>${item}</span><a href="javascript: remove(${index})">+</a></li>`;
   });
}

function remove(i) {
   items = items.filter(item => items.indexOf(item) != i);
   data.keywords = items;
   render();
}

window.onload = function () {
   render();
   txt.focus();
}