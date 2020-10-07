<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>testSpace</title>
   <link rel="stylesheet" href="source/welcome/css/style.css">
   <link rel="stylesheet" href="source/general/icons/icons/all.min.css">
</head>

<body>
   <section>
      <!-- Container 80% -->
      <header class="nav-header">
         <nav>
            <div class=" logo">
               <h3>
                  <a href="welcome"><img src="source/general/img/LogoText-Orange.svg"></a>
               </h3>
               <div class="collapse">
                  <i class="fas fa-bars"></i>
               </div>
            </div>
            <div class="items">
               <ul>
                  <li class="links">
                     <a href="#home"><?= Polyglot::translate('Home') ?></a>
                  </li>
                  <li class="links">
                     <a href="#about"><?= Polyglot::translate('About') ?></a>
                  </li>
                  <li class="links">
                     <a href="#contact"><?= Polyglot::translate('ContactUs') ?></a>
                  </li>
                  <li class="dropdown">
                     <?= Polyglot::translate('CurrentLanguage') ?>
                     <ul class="dropdown-list">
                        <li class="dr" onclick="changeLanguage('TM')">Türkmençe</li>
                        <li class="dr" onclick="changeLanguage('RU')">Русский</li>
                        <li class="dr" onclick="changeLanguage('EN')">English</li>
                     </ul>
                  </li>
                  <li class="sign-up">
                     <a href="signup"><?= Polyglot::translate('Sign Up') ?></a>
                  </li>
                  <li class="login">
                     <a href="login"><?= Polyglot::translate('Login') ?></a>
                  </li>
               </ul>
            </div>
         </nav>
      </header>

      <?php require 'views/' . $content . '.php'; ?>

      <footer>
         <div class="phone">
            <?= Polyglot::translate('Mobile') ?>: +993 62 776655
            |<?= Polyglot::translate('Tel') ?>: +993 12 555858
            |<?= Polyglot::translate('OurEmail') ?>: info@testspace.com
         </div>
         <div class="info">
            <?= Polyglot::translate('PoweredBy') ?> Geek Space <i style="color:#FF5903 ;" class="fas fa-lightbulb"></i> | <?= Polyglot::translate('Rights') ?>
         </div>
      </footer>
      </div>
      </div>

   </section>

   <div class="bg"></div>

   <!-- Loader -->
   <div class="loader">
      <div class="box">
         <img src="source/welcome/images/testSpace-logo-loader.svg" alt="">
      </div>
   </div>

   <!-- SCRIPTS -->

   <script src="source/general/js/jquery/jquery-3.4.1.min.js"></script>
   <!-- Navbar Animation -->
   <script type="text/javascript" src="source/general/js/validator/validator.js"></script>
   <script src="source/welcome/js/welcome.js"></script>


   <!-- GSAP Animations -->
   <script src="source/general/js/gsap/gsap.min.js"></script>
   <script src="source/general/js/gsap/ScrollTrigger.min.js"></script>
   <script src="source/welcome/js/gsap.js"></script>
</body>

</html>