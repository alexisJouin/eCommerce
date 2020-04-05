<html>
  <head>
    <title>Accueil - eCommerce</title>
  </head>

  <body>
    <?php
      include("/includes/menu.php");
      session_start();
      $name = $_SESSION['name'];
      $email = $_SESSION['email'];
    ?>
    <h1>Accueil</h1>
    <h2>Bienvenue <?php echo $name; ?></h2>
    <p><?php echo $email; ?></p>

  </body>


</html>
