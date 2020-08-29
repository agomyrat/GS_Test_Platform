<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Solving</title>
   <!-- External Links -->
   <link rel="stylesheet" href="<?=URL?>source/general/icons/icons/all.min.css">
   <!-- CSS Links -->
   <link rel="stylesheet" href="<?=URL?>source/test_solving/css/single_choice.css">
   <link rel="stylesheet" href="<?=URL?>source/test_solving/css/input_type.css">
   <link rel="stylesheet" href="<?=URL?>source/test_solving/css/true_false.css">
   <link rel="stylesheet" href="<?=URL?>source/test_solving/css/blank.css">
   <link rel="stylesheet" href="<?=URL?>source/test_solving/css/pagination.css">
   <link rel="stylesheet" href="<?=URL?>source/test_solving/css/matching.css">
   <link rel="stylesheet" href="<?=URL?>source/test_solving/css/header.css">
</head>
<body> 
   <?php require 'views/' . $content . '.php'; ?>
 <!-- Main js files -->
   <script src="<?=URL?>source/test_solving/js/data/data.js"></script>
   <script src="<?=URL?>source/test_solving/js/Questions.js"></script>
   <script src="<?=URL?>source/test_solving/js/Answers.js"></script>
   <script src="<?=URL?>source/test_solving/js/Timing.js"></script>
   <!-- Components -->
   <script src="<?=URL?>source/test_solving/js/components/Pagination.js"></script>
   <script src="<?=URL?>source/test_solving/js/components/Header.js"></script>
   <script src="<?=URL?>source/test_solving/js/components/QuestionBlock.js"></script>
   <script src="<?=URL?>source/test_solving/js/components/SingleChoice.js"></script>
   <script src="<?=URL?>source/test_solving/js/components/MultiChoice.js"></script>
   <script src="<?=URL?>source/test_solving/js/components/InputType.js"></script>
   <script src="<?=URL?>source/test_solving/js/components/TrueFalse.js"></script>
   <script src="<?=URL?>source/test_solving/js/components/Matching.js"></script>
   <script src="<?=URL?>source/test_solving/js/components/Blank.js"></script>
   <!-- Animations -->
   <script src="<?=URL?>source/test_solving/js/animations.js"></script>
</body>
</html>
