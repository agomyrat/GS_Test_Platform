<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>testSpace</title>
   <link rel="stylesheet" href="<?=URL?>source/test_constructor/css/__questions.css">
   <link rel="stylesheet" href="<?=URL?>source/test_constructor/css/__question_types.css">
   <link rel="stylesheet" href="<?=URL?>source/general/icons/icons/all.min.css">
</head>

<body>
   <div id="content">
      <?php require 'views/' . $content . '.php'; ?>
   </div>

   <script src="<?=URL?>source/general/js/jquery/jquery-3.4.1.min.js"></script>
   <script  src="<?=URL?>source/test_constructor/js/Questions.js"></script>
   <script src="<?=URL?>source/test_constructor/js/animations.js"></script>

</body>

</html>