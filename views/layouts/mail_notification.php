<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Check Email</title>
   <link rel="stylesheet" href="source/mail_notification/css/style.css">
   <link rel="stylesheet" href="source/navbar/navbar.css">
   <link rel="icon" href="source/welcome/images/Logo-orange.svg">
</head>

<body>
   <!-- Navbar -->
   <nav>
      <div class="logo">
         <a href="index.php">
            testSpace
         </a>
      </div>
   </nav>
   <div id="content">
      <?php require 'views/' . $content . '.php'; ?>
   </div>
</body>

</html>