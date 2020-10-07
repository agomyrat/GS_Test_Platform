<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=0" />
   <title>testSpace</title>
   <?php
   if (isset($asset_array['css'])) {
      foreach ($asset_array['css'] as $css) {
         echo "<link rel='stylesheet' href='" . URL . $css . "'>";
      }
   }
   ?>

</head>

<body>
   <!-- NAVABAR -->

   <header class="nav-header">
      <nav>
         <div class="logo">
            <a href="">
               <img src="<?= URL ?>source/general/img/LogoText-Orange.svg" alt="testspace">
            </a>
         </div>
         <ul class="nav-list">
            <!-- NOTIFICATION -->
            <li class="lists note" data-row="not">
               <div class="notification">
                  <div class="message-dot"><i class="fas fa-circle"></i></div>
                  <i class="far fa-bell"></i>
                  <span>
                     <i class="fas fa-sort-down"></i>
                  </span>
               </div>
               <ul class="hover-block not">
                     <li><a href="#" class="accepted"><i class="far fa-check-circle"></i>&nbsp;Your test has been added as global.</a></li>
                     <li><a href="#" class="declared"><i class="far fa-times-circle"></i>&nbsp;Your test has not been added as global for some reasons.</a>
                     </li>
                     <li><a href="#" class="normal"><i class="far  fa-envelope"></i>&nbsp;Your solved "General Knowledge" test has been checked.</a>
                     </li>
                     <li><a href="#" class="normal"><i class="far fa-comment-dots"></i>&nbsp;You have a comment :"I liked your test ,keep go this way"</a>
                     </li>
                     <li><a href="#">&nbsp;See all</a>
                     </li>
               <div class="loading-not">
                  <div>
                     <img src="source/general/img/2.svg" alt="">
                  </div>
               </div>
               </ul>
            </li>
            <!-- PROFILE -->
            <li class="lists prof" data-row="profile">
               <div class="prf">
                  <div class="avatar">
                     <img src="<?= URL ?>/uploads/profile.png" alt="">
                  </div>
                  <span>
                     <i class="fas fa-sort-down"></i>
                  </span>
               </div>

               <ul class="hover-block profile">
                  <li>
                     <a href="#" class="normal"><i class="far fa-user-circle"></i>&nbsp;Profile</a>
                  </li>
                  <li>
                     <a href="#" class="normal"><i class="fas fa-sign-out-alt"></i>&nbsp;Log Out</a>
                  </li>
               </ul>
            </li>
            <!-- LANGUAGES -->
            <li class="lists lan" data-row="language">
               <div class="lang">
                  Turkmen
                  <span>
                     <i class="fas fa-sort-down"></i>
                  </span>
               </div>
               <ul class="hover-block language">
                  <li>Turkmen</li>
                  <li>Russian</li>
                  <li>English</li>
               </ul>
            </li>
         </ul>
         <div class="collapse">
            <i class="fas fa-bars"></i>
         </div>
      </nav>
   </header>


   <?php require 'views/' . $content . '.php'; ?>


   <?php
   if (isset($asset_array['js'])) {
      foreach ($asset_array['js'] as $js) {
         echo "<script src='" . $js . "'></script>";
      }
   }
   ?>

</body>

</html>