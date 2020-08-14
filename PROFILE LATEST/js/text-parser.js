"use strict";

// getting paragraphs in HTML collection
let paragraphs = document.getElementsByClassName("text");

// getting paragraphs in array
let texts = [...document.getElementsByClassName("text")];

// splitting an array into words to parse each of them
for (let i = 0; i < texts.length; i++) {
  texts[i] = texts[i].textContent.trim().split(" ");
}

// regular expression
let regex = /^@\S*/gi;

// validation and inserting an HTML if validation is true (@LIMMIE => true)
for (let text of texts) {
  for (let i = 0; i < text.length; i++) {
    if (text[i].match(regex)) {
      if (text[i].length > 1) {
        text[
          i
        ] = `<span class="profile">${text[i]}<div class="profile-modal"><div class="profile-wrapper">
          <div class="avatar-wrapper">
            <img src="../img/profile.jpg" />
          </div>
          <h3>Username</h3>
          <p>This is user's information</p>
        </div></div></span>`;
      }
    }
  }
}
// rendering a content
for (let i = 0; i < texts.length; i++) {
  paragraphs[i].textContent = texts[i].join(" ");
  paragraphs[i].innerHTML = paragraphs[i].textContent;
}

// creating a style tag in head of html
let style = document.head.appendChild(document.createElement("style"));

// selecting all validated html (from regex)
let profiles = document.querySelectorAll(".profile");

// iterating them
for (let profile of profiles) {
  // getting font sizes to add dynamic style
  let fontSize = Number(
    window
      .getComputedStyle(profile)
      .getPropertyValue("font-size")
      .split("px")[0]
  );
  // getting a modal of each element
  let profileModal = profile.querySelector(".profile-modal");

  // getting their rect information (x, y, width, height)
  let profileRect = profile.getBoundingClientRect();

  // on mouseover default rendering of html block with some validations
  profile.addEventListener("mouseover", function (event) {
    profileModal.style.display = "inline-block";
    profileModal.style.top = 20 + fontSize + "px";
    profileModal.style.right = "-20px";

    let profileModalRect = profileModal.getBoundingClientRect();

    // if block is in the top left or middle
    style.textContent = `.profile-modal::before { top: -40px; left: 0; right: unset; width: ${Math.round(
      profileRect.width - 20
    )}px; }`;

    // if block is in top right
    if (profileModalRect.width + profileRect.x > window.innerWidth) {
      profileModal.style.right = "-20px";
      profileModal.style.left = "unset";
      style.textContent = `.profile-modal::before { right: 0; left: unset; top: -40px; width: ${Math.round(
        profileRect.width - 10
      )}px; }} }`;
    }

    // if block is in the bottom left or middle
    if (profileModalRect.height + profileRect.y > window.innerHeight) {
      profileModal.style.top = "unset";
      profileModal.style.bottom = 20 + fontSize + "px";

      style.textContent = `.profile-modal::before { top: unset; left: 0; bottom: -40px; border-top-color: #ff570c; border-bottom-color: transparent; width: ${Math.round(
        profileRect.width - 20
      )}px; }}`;
    }

    // if block is in the left bottom
    if (
      profileModalRect.height + profileRect.y > window.innerHeight &&
      profileModalRect.width + profileRect.x > window.innerWidth
    ) {
      style.textContent = `.profile-modal::before { left: unset; right: 0; top: unset; bottom: -40px; border-bottom-color: transparent; border-top-color: #ff570c; width: ${Math.round(
        profileRect.width - 20
      )}px }`;
    }
  });

  // removing rendered html
  profile.addEventListener("mouseleave", function (event) {
    profileModal.style.display = "none";
  });
}
