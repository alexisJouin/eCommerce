<html>
  <head>
    <title>Accueil - eCommerce</title>
    <?php include("/includes/include-files.php");  ?>
  </head>

  <body>
    <?php
      include("/includes/menu.php");
    ?>
    <h1>Inscription</h1>
    <form class="" action="traitement/register-traitement.php" method="post">
      <label for="name">Nom:</label>
      <input type="text" name="name" value="" required>
      <label for="email">eMail :</label>
      <input type="email" name="email" value="" required>
      <label for="pwd">Mot de passe :</label>
      <input type="password" name="pwd" value="" required>
      <button type="submit" name="submit">Inscription</button>
    </form>

  </body>


</html>
