<html>
  <head>
    <title>Ajouter un article</title>
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
    <h1>Ajouter un article</h1>
    <form class="" action="traitement/add-article-traitement.php" method="POST"
     enctype="multipart/form-data">
      <label for="name">Nom :</label>
      <input type="text" name="name" value="" required>
      <label for="price">Prix :</label>
      <input type="number" step="0.01" name="price" value="" min=0 required>€
      <label for="photo">Photo : </label>
      <input type="file" name="photo" value="">
      <button type="submit" name="submit">Ajouter</button>
    </form>

  </body>


</html>
