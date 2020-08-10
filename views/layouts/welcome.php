<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>testSpace</title>
   <link rel="stylesheet" href="source/welcome/css/style.css">
   <link rel="stylesheet" href="source/welcome/icon/icons/all.css">
</head>
<body>
   <section>
      <!-- Container 80% -->
      <div class="container">
         <!-- Home -->
         <nav>
            <div class="logo">
               <h3>testSpace</h3>
               <div class="collapse">
                  <i class="fas fa-bars"></i>
               </div>
            </div>
            <div class="items">
               <ul>
                  <li>
                     <a href="#home"><?=Polyglot::translate('Home')?></a>
                  </li>
                  <li>
                     <a href="#about">About</a>
                  </li>
                  <li>
                     <a href="#contact">Contact</a>
                  </li>
                  <li class="dropdown">
                     Turkmen
                     <ul class="dropdown-list">
                        <li class="dr" onclick="changeLanguage('TM')">Türkmençe</li>
                        <li class="dr" onclick="changeLanguage('RU')">Russian</li>
                        <li class="dr" onclick="changeLanguage('EN')">English</li>
                     </ul>
                  </li>
                  <li class="sign-up">
                     <a href="signup">Sign-Up</a>
                  </li>
                  <li class="login">
                     <a href="login">Login</a>
                  </li>
               </ul>
            </div>
         </nav>

<div id="content">
<?php require 'views/'.$content.'.php';?>
</div>

         </div>
   </section>

   <footer>
               <div class="phone">
                  Phone: +993 62 776655
                  Tel: +993 12 555858
                  Email: info@testspace.com
               </div>
               <div class="info">
                  Powered by Geek Space <i style="color:#FF5903 ;" class="fas fa-lightbulb"></i> | All rights reserved
               </div>
            </footer>

   <div class="bg">

   </div>
   <script src="source/general/js/jquery/jquery-3.4.1.min.js"></script>
	  <!-- Navbar Animation -->
   <script>
      const collapse = document.querySelector('.collapse');
      const items = document.querySelector('.items');

      collapse.onclick = () => {
         items.classList.toggle('active')
      }
      window.onclick = function (event) {
         if (event.target == items) {
            items.classList.remove('active')
         }
         console.log('outside')
      }

      window.onresize = screen;
      window.onpageshow = screen;
      function screen() {
         const width = window.innerWidth;
         if(width <= "760"){
            document.querySelector('.home-1').src = "images/Group.svg";
            console.log('actice')
         } 
         else{
            document.querySelector('.home-1').src = "images/home-1.svg";
         }
      }
      document.querySelector('.dropdown').addEventListener('mouseover',function(){

                  document.querySelector('.dropdown-list').style.display = "block";

            });
            document.querySelector('.dropdown').addEventListener('mouseout',function(){

                  document.querySelector('.dropdown-list').style.display = "none";

            });

   </script>
   <script>
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
   </script>

</body>
</html>