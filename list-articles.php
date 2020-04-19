<html>
  <head>
    <title>Liste des articles</title>
    <?php include("/includes/include-files.php");  ?>
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
    <h1>Liste des articles</h1>


  </body>


</html>
