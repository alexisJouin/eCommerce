<html>
  <head>
    <title>Liste des articles</title>
    <?php include("../includes/include-files.php");  ?>
    <?php include("../lib/fonctions.php");  ?>
  </head>

<?php
session_start();
if (!isset($_SESSION['email']) || !isset($_SESSION['name']) ) {
  $userName = "Utilisateur Non connecté";
  $email = "Utilisateur Non connecté";
}else{
  $userName = $_SESSION['name'];
  $email = $_SESSION['email'];
  $userID = $_SESSION['userID'];
  include("../includes/menu-connection.php");
}

if (isset($_POST['submit'])){

  $name = $_POST["name"];
  $price = $_POST["price"];

  $photo = $_FILES["photo"];
  print_r($photo);

  $target_dir = "../photos/";
  //$target_file = $target_dir . basename($photo["name"]);
  //On supprime les accents et les espaces sur le nom de la photo
  $photoName = skip_accents(str_replace(' ', '', $photo["name"]));
  $nameIMG = skip_accents(str_replace(' ', '', $name));
  $target_file = $target_dir . basename($userName . "_" . $nameIMG . "_" . $photoName);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  // Check if image file is a actual image or fake image
  $check = getimagesize($photo["tmp_name"]);
  if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
  } else {
      echo "File is not an image.";
      $uploadOk = 0;
  }
  // Check if file already exists
  if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
  }
  // Check file size
  if ($photo["size"] > 5000000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file et insertion en BDD
  } else {
      if (move_uploaded_file($photo["tmp_name"], $target_file)) {
          echo "The file ". basename($name."-".$userName). " has been uploaded.";

          //Params BDD
          $user = "root";
          $pass = "";

          $photoPath = basename($userName . "_" . $name . "_" . $photoName);

          try {
              //Connection à la BDD
              $dbh = new PDO('mysql:host=localhost;dbname=eCommerce', $user, $pass);

              //On check si l'article existe déjà avec l'index : name, photo, author
              $stmt1 = $dbh->prepare('SELECT name, photo, author
                                      FROM article
                                      WHERE name LIKE :name
                                      AND photo LIKE :photo
                                      AND author LIKE :author'
              );

              $stmt1->bindParam(':name', $name);
              $stmt1->bindParam(':photo', $photoPath);
              $stmt1->bindParam(':author', $userID);
              $stmt1->execute();
              $result = $stmt1->fetch();
              $exist = $result[0];

              if($exist == $name){
                print "L'article " . $name . " existe déjà ! Redirection ...";

                echo "<script>alert('Larticle existe déjà !');</script>";
                echo "<script>setTimeout(\"location.href = '../add-article.php';\",1500);</script>";
                return 0;
              }
              else{
                //Requête préparée pour insertion
                $stmt2 = $dbh->prepare("INSERT INTO article (name, price, photo, author) VALUES (:name, :price, :photo, :author)");
                //Paramètres de la requête d'insertion
                $stmt2->bindParam(':name', $name);
                $stmt2->bindParam(':price', $price);
                $stmt2->bindParam(':photo', $photoPath);
                $stmt2->bindParam(':author', $userID);

                $stmt2->execute();
                print_r("Ajout de l'article réussi ...");
                echo "<script>alert('Ajout article réussi ! Redirection ...');</script>";
                echo "<script>setTimeout(\"location.href = '../list-articles.php';\",500);</script>";

                return 1;
              }

              $dbh = null;
            } catch (PDOException $e) {
                print "Erreur !: " . $e->getMessage() . "<br/>";
                die();
            }

      } else {
          echo "Sorry, there was an error uploading your file.";
      }
  }







}


 ?>
