"use strict";

import alertMessage from "./functions.js";

let photoInput = document.getElementById("photoInput");
let photo = document.getElementById("photo");

let upperAlert = document.querySelector(".alert");

photoInput.addEventListener("change", function () {
  let newImage = event.target.files[0];
  console.log(newImage);
  if (newImage.size > 2000000) {
    alertMessage(upperAlert, "error", "Image cannot be more than 2mb");
  } else {
    //sending file
    // some code

    // setting new image
    photo.src = URL.createObjectURL(event.target.files[0]);
  }
});

let status = document.getElementById("status");
let password = document.getElementById("password");

if (status.value === "private") {
  password.removeAttribute("disabled");
  console.log("private");
} else {
  password.value = null;
  password.setAttribute("disabled", true);
  console.log("public");
}

status.addEventListener("change", function (event) {
  if (status.value === "private") {
    password.removeAttribute("disabled");
    console.log("private");
  } else {
    password.value = null;
    password.setAttribute("disabled", true);
    console.log("public");
  }
});

let formdata = new FormData();

let form = document.getElementById("form");

form.addEventListener("submit", function (event) {
  event.preventDefault();
  let inputs = {};
  for (let element of form.elements) {
    if (
      element.value === "" ||
      element.value === undefined ||
      element.value === null
    ) {
    } else {
      inputs[element.name] = { value: element.value };
      console.log(inputs);
    }
  }

  formdata.append("datas", inputs);

  //   async function sendData() {
  //     let response = await fetch("/path/to/somewhere", {
  //       method: "POST",
  //       body: formdata,
  //     });
  //     // test
  //     let result = await response.json();
  //     console.log(result);
  //   }

  //   sendData();
});
