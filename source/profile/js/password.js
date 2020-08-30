"use strict";

let formdata = new FormData();

// getting inputs of password
let oldPass = document.getElementById("oldPass");
let newPass = document.getElementById("newPass");

// getting password btn and block
let passwordBtn = document.getElementById("password");
let passwordBlock = document.querySelector(".password-modal-wrapper");

// listener to show modal
passwordBtn.addEventListener("click", function (event) {
  passwordBlock.style.display = "flex";
});

// listener to toggle modal display
passwordBlock.addEventListener("click", function (event) {
  if (event.target === passwordBlock) {
    passwordBlock.style.display = "none";
  }
});

// getting icons of eye to listen click
let oldPassView = document.getElementById("oldPassView");
let newPassView = document.getElementById("newPassView");

// active/disactive password visibility
newPassView.addEventListener("click", function () {
  if (newPass.type == "password") {
    newPassView.style.color='red';
    newPass.removeAttribute("type");
  } else {
    newPass.setAttribute("type", "password");
  }
});

oldPassView.addEventListener("click", function () {
  if (oldPass.type == "password") {
    oldPassView.style.color = 'red';
    oldPass.removeAttribute("type");
  } else {
    oldPass.setAttribute("type", "password");
  }
});

// getting errors block from dom
let errorsBlock = document.getElementById("errors");

// function that show show validation errors
function showError(message) {
  errorsBlock.innerHTML = " ";
  errorsBlock.style.display = "block";
  let node = document.createElement("span");
  let textnode = document.createTextNode(message);
  node.innerHTML = '<i class="fa fa-exclamation-circle"></i>';
  node.appendChild(textnode);
  node.classList.add("error");
  errorsBlock.appendChild(node);
}

// function that sends formdata
function sendPass() {
  if (oldPass.value === newPass.value) {
    console.log(formdata);
  } else {
    showError("Passwords don't match");
  }
}

// oldpass validation
oldPass.addEventListener("change", function (event) {
  oldPass.value = oldPass.value.trim();
  if (oldPass.value) {
    formdata.append("oldPass", oldPass);
    if (oldPass.value && newPass.value) {
      errors.style.display = "none";
      sendPass();
    } else {
      showError("Passwords don't match");
    }
  } else {
    showError("Old password cannot be empty");
  }
});

// newpass validation
newPass.addEventListener("change", function (event) {
  newPass.value = newPass.value.trim();
  if (newPass.value && oldPass.value) {
    formdata.append("newPass", newPass);
    if (oldPass.value.length && newPass.value.length) {
      errors.style.display = "none";
      sendPass();
    } else {
      showError("Passwords don't match");
    }
  } else {
    showError("New password cannot be empty");
  }
});
