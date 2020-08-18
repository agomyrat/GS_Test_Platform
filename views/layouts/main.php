<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport"
    content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=0" />
   <title>testSpace</title>
   <?php
   if(isset($asset_array['css'])){
        foreach($asset_array['css'] as $css){
            echo "<link rel='stylesheet' href='".$css."'>";
        }
    }
   ?>

</head>

<body>
<header>
    <div class="header-container">
      <div class="header">
        <div class="left">
          <a href="#">
            <div class="header-logo">
              <h1>testSpace</h1>
            </div>
          </a>
        </div>
        <div class="right">
          <div class="header-notif">
            <i class="fa fa-bell web"></i>
            <div class="notif-count web">2</div>
            <div class="hamburger-notif">
              <span>Notifications<i class="fa fa-bell mob"></i>
                <div class="notif-count mob">2</div>
              </span>
            </div>
          </div>
          <div class="header-avatar">
            <img src="uploads/profile.jpg" alt="" />
            <i class="fa fa-sort-down"></i>
            <h3 class="username">Username</h3>
            <ul class="dropdown dropdown-avatar">
              <li><i class="fa fa-cog"></i> Settings</li>
              <li><i class="fas fa-sign-out-alt"></i>Log out</li>
            </ul>
          </div>
          <div class="header-language">
            <span>English</span>
            <i class="fa fa-sort-down"></i>
            <ul class="dropdown dropdown-language">
              <li>English</li>
              <li>Russian</li>
              <li>Turkmen</li>
            </ul>
          </div>
        </div>
        <div class="hamburger-wrapper inactive">
          <div class="hamburger">
            <span></span>
          </div>
        </div>
      </div>
    </div>
  </header>

   <div id="content">
      <?php require 'views/' . $content . '.php'; ?>
   </div>

    <?php
    if(isset($asset_array['js'])){
            foreach($asset_array['js'] as $js){
                echo "<script type='module' src='".$js."'></script>";
            }
        }
   ?>

</body>

</html>