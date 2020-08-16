"use strict";

// header hamburger
let hamburger = document.querySelector(".hamburger-wrapper");
let hamburgerMenu = document.querySelector(".header").querySelector(".right");
let hamburgerMenuPos = hamburgerMenu.style.right;

if (window.innerWidth < 548) {
  hamburgerMenu.style.right = -250 + "px";
}

hamburgerMenuPos = Number(hamburgerMenu.style.right.split("px", 1)[0]);

hamburger.addEventListener("click", function (event) {
  if (hamburgerMenuPos == -250 || hamburgerMenuPos == 0) {
    hamburger.classList.toggle("active");
    hamburger.classList.toggle("inactive");
  }

  if (hamburger.classList[1] == "active" && hamburgerMenuPos == -250) {
    let slideInInterval = setInterval(slideIn, 0.1);
    console.log('hello1')

    hamburgerMenu.style.display = "flex";

    function slideIn() {
      if (hamburgerMenuPos >= 0) {
        hamburgerMenuPos = 0;
        hamburgerMenu.style.right = "0px";
        clearInterval(slideInInterval);
      } else {
        hamburgerMenuPos += 2.5;
        hamburgerMenu.style.right = hamburgerMenuPos + "px";
      }
    }
  } else if (hamburger.classList[1] == "inactive" && hamburgerMenuPos == 0) {
    let slideOutInterval = setInterval(slideOut, 0.1);

    console.log('hello2')

    function slideOut() {
      if (hamburgerMenuPos <= -250) {
        clearInterval(slideOutInterval);
        hamburgerMenuPos = -250;
        hamburgerMenu.style.right = "-250px";
        hamburgerMenu.style.display = "none";
      } else {
        hamburgerMenuPos -= 2.5;
        hamburgerMenu.style.right = hamburgerMenuPos + "px";
      }
    }
  }
});


// header dropdowns

// language dropdown
let languageBlock = document.querySelector('.header-language')
let languageDropdown = document.querySelector('.dropdown-language')

languageBlock.addEventListener('mouseover', function () {
  languageDropdown.style.display = 'block'
})

languageBlock.addEventListener('mouseleave', function () {
  languageDropdown.style.display = 'none'
})

// profile dropdown
let profileBlock = document.querySelector('.header-avatar')
let profileDropdown = document.querySelector('.dropdown-avatar')

profileBlock.addEventListener('mouseover', function () {
  profileDropdown.style.display = 'block'
})

profileBlock.addEventListener('mouseleave', function () {
  profileDropdown.style.display = 'none'
})


