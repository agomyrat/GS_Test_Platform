"use strict";

let hamburger = document.querySelector(".hamburger-wrapper");

let hamburgerMenu = document.querySelector(".header").querySelector(".right");

let hamburgerMenuPos = hamburgerMenu.style.right;

if (window.innerWidth < 548) {
  hamburgerMenu.style.right = -250 + "px";
}

hamburgerMenuPos = Number(hamburgerMenu.style.right.split("px", 1)[0]);

hamburger.addEventListener("click", function (event) {
  hamburger.classList.toggle("active");
  hamburger.classList.toggle("inactive");

  if (hamburger.classList[1] == "active") {
    let slideInInterval = setInterval(slideIn, 0.1);

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
  } else {
    let slideOutInterval = setInterval(slideOut, 0.1);

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
