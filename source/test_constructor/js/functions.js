// function that alerts text with error or success.
//Excepts 3 params.
//           1) Element of alert (html tag).
//           2) Type of alert (true or false)
//           3) Text of alert

function alertMessage(alert, type, message) {
  let text = document.createTextNode(message);
  alert.classList.add(type);
  alert.style.display = "block";

  // adding icon depending on type of alert
  if (type === "error") {
    alert.innerHTML = "<i class='fa fa-exclamation-circle'>";
  }
  alert.appendChild(text);

  // getting pos of alert
  let alertPos = Number(alert.style.top.split("px", 1)[0]);

  // animation "showfromtop"
  let showInterval = setInterval(showFromTop, 5);
  function showFromTop() {
    if (alertPos == 0) {
      clearInterval(showInterval);
    } else {
      alertPos++;
      alert.style.top = alertPos + "px";

      let fadeInterval = setInterval(fade, 5);
      let opacity = 1;

      // fade hiding animation
      function fade() {
        if (opacity <= 0) {
          clearInterval(fadeInterval);
          alert.style.display = "none";
          alert.style.opacity = 0;
          alert.style.top = "-50px";
          alert.innerHTML = "";
        } else {
          opacity -= 0.002;
          alert.style.opacity = opacity;
        }
      }

      // show on hover to alert
      alert.addEventListener("mouseover", function (event) {
        clearInterval(fadeInterval);
        alert.style.opacity = 1;
        opacity = 1;
      });

      // again starts hiding with fade effect
      alert.addEventListener("mouseout", function (event) {
        fadeInterval = setInterval(fade, 5);
        fade();
      });
    }
  }
}

// export default alertMessage;
