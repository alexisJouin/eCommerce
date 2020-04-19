<html>
  <head>
    <title>Accueil - eCommerce</title>
  </head>

  <body>
    <?php

      session_start();
      if (!isset($_SESSION['email']) || !isset($_SESSION['name']) ) {
        $name = "Utilisateur Non connecté";
        $email = "Utilisateur Non connecté";
        include("/includes/menu.php");
      }else{
        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
        include("/includes/menu-connection.php");
      }

    ?>
    <h1>Accueil</h1>
    <h2>Bienvenue <?php echo $name; ?></h2>
    <p><?php echo $email; ?></p>

  </body>


</html>
