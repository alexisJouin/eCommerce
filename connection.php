<html>
  <head>
    <title>Accueil - eCommerce</title>
  </head>

  <body>
    <?php
      include("/includes/menu.php");
    ?>
    <h1>Connection</h1>
    <form class="" action="traitement/connection-traitement.php" method="post">
      <label for="email">eMail :</label>
      <input type="email" name="email" value="" required>
      <label for="pwd">Mot de passe :</label>
      <input type="password" name="pwd" value="" required>
      <button type="submit" name="submit">Connection</button>
    </form>

  </body>


</html>
