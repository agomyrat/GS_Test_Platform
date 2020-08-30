<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>testSpace</title>
   <?php
   /*   if(isset($asset_array['css'])){
        foreach($asset_array['css'] as $css){
            echo ("<link rel='stylesheet' href='".$css."'>");
        }
    } */
   ?>
   <link rel="stylesheet" href="../../source/test_constructor/css/__questions.css">
   <link rel="stylesheet" href="../../source/test_constructor/css/__question_types.css">
   <link rel="stylesheet" href="../../source/test_constructor/css/animation.css">
   <link rel="stylesheet" href="../../source/general/icons/icons/all.min.css">
</head>

<body>
   <div id="content">
      <?php require 'views/' . $content . '.php'; ?>
   </div>

   <?php
   /* if(isset($asset_array['js'])){
            foreach($asset_array['js'] as $js){
                echo "<script src='".$js."'></script>";
            }
        } */
   ?>
   <script src="../../source/general/js/jquery/jquery-3.4.1.min.js"></script>
   <script src="../../source/test_constructor/js/animations.js"></script>

   <script src="../../source/test_constructor/js/components/SingleChoice.js"></script>
   <script src="../../source/test_constructor/js/components/MultiChoice.js"></script>
   <script src="../../source/test_constructor/js/components/Input.js"></script>
   <script src="../../source/test_constructor/js/components/TrueFalse.js"></script>
   <script src="../../source/test_constructor/js/components/Matching.js"></script>
   <script src="../../source/test_constructor/js/components/Blank.js"></script>
   <script src="../../source/test_constructor/js/question.js"></script>
   <script src="../../source/test_constructor/js/main.js"></script>
</body>

</html>