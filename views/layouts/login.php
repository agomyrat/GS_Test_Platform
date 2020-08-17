<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="source/login/css/loginpage.css">
   <link rel="icon" href="source/welcome/images/Logo-orange.svg">

   <!--fonts.googleapis.com name? fonts papkanyn ozunden baglamaly-->
   <title>Log in</title>
</head>

<body>
   <!-- Navbar -->
   <nav>
      <div class="logo">
         <a href="index">
            testSpace
         </a>
      </div>
   </nav>
   
   <div id="content">
      <?php require 'views/' . $content . '.php'; ?>
   </div>

   <script src="source/general/js/jquery/jquery-3.4.1.min.js"></script>
   <script src="source/login/js/main.js"></script>
</body>

</html>