<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>testSpace</title>
   <?php
     if(isset($asset_array['css'])){
        foreach($asset_array['css'] as $css){
            echo ("<link rel='stylesheet' href='".$css."'>");
        }
    }
   ?>
</head>

<body>
      <?php require 'views/' . $content . '.php'; ?>

   <?php
   if(isset($asset_array['js'])){
            foreach($asset_array['js'] as $js){
                echo "<script src='".$js."'></script>";
            }
        }
   ?>
</body>

</html>