<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
   <!-- Navbar -->
   <nav>
      <div class="logo">
         <a href="welcome">
            <img src="source/general/img/LogoText-Orange.svg">
         </a>
      </div>
   </nav>

   <div id="content">
      <?php require 'views/' . $content . '.php'; ?>
   </div>

    <?php
    if(isset($asset_array['js'])){
            foreach($asset_array['js'] as $js){
                echo "<script src='".URL.$js."'></script>";
            }
        }
   ?>

</body>

</html>