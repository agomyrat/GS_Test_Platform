<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>testSpace</title>
   <link rel="stylesheet" href="source/welcome/css/style.css">
   <link rel="stylesheet" href="source/general/icon/icons/all.min.css">
</head>
<body>
   <section>
      <!-- Container 80% -->
      <nav>
         <div class="logo">
            <h3>testSpace</h3>
            <div class="collapse">
               <i class="fas fa-bars"></i>
            </div>
         </div>
         <div class="items">
            <ul>
               <li class="links">
                  <a href="#home">Home</a>
               </li>
               <li class="links">
                  <a href="#about">About</a>
               </li>
               <li class="links">
                  <a href="#contact">Contact</a>
               </li>
               <li class="dropdown">
                  Turkmen
                  <ul class="dropdown-list">
                        <li class="dr" onclick="changeLanguage('TM')">Türkmençe</li>
                        <li class="dr" onclick="changeLanguage('RU')">Русский</li>
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

            <?php require 'views/'.$content.'.php';?>

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
   </section>

   <div class="bg">

   </div>

   
   <!-- Navbar Animation -->
   <script src="source/welcome/js/welcome.js"></script>
   <script type="text/javascript" src="source/general/validator/validator.js"></script>

</body>
</html>