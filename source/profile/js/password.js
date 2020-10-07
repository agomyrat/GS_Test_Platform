"use strict";

let data = new FormData();

// getting inputs of password
let passwordForm = document.getElementById("passwordForm");
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
  } else {
  }
});

// getting icons of eye to listen click
let oldPassView = document.getElementById("oldPassView");
let newPassView = document.getElementById("newPassView");

// active/disactive password visibility
newPassView.addEventListener("click", function () {
  if (newPass.type == "password") {
    newPass.removeAttribute("type");
  } else {
    newPass.setAttribute("type", "password");
  }
});

oldPassView.addEventListener("click", function () {
  if (oldPass.type == "password") {
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

let old_password = 123;

oldPass.addEventListener("change", function (event) {
  event.target.value = event.target.value.trim();
  if (event.target.value != old_password) {
    errorsBlock.style.display = "block";
    showError("Old password dont match");
  } else {
    errorsBlock.style.display = "none";
    data.append("oldPass", event.target.value);
  }
});

passwordForm.addEventListener("submit", function (event) {
  event.preventDefault();
  if (event.target.elements["oldPass"].value != old_password) {
    errorsBlock.style.display = "block";
    showError("Old password dont match");
  } else {
    data.append("oldPass", event.target.elements["oldPass"]);
    if (event.target.elements["newPass"].value.trim().length) {
      data.append("newPass", event.target.elements["newPass"].value);
    } else {
      errorsBlock.style.display = "block";
      showError("Enter new password");
    }
  }
});

console.log(data);
