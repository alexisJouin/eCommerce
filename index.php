<html>
  <head>
    <title>Accueil - eCommerce</title>
    <?php include("/includes/include-files.php");  ?>
    <?php include("/lib/fonctions.php");  ?>
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

    <?php
      if (isset($_SESSION['email']) && isset($_SESSION['name']) ) {
     ?>
    <p>Voici quelques articles qui pourraient vous intéresser :</p>
    <div class="container-articles">
      <?php
      //Params BDD
      $user = "root";
      $pass = "";

      try {
          //Connection à la BDD
          $dbh = new PDO('mysql:host=localhost;dbname=eCommerce', $user, $pass);

          //On selectionne aléatoirement 4 articles
          $stmt1 = $dbh->prepare('SELECT a.name, photo, author, price, u.name AS authorName
                                  FROM article a
                                  INNER JOIN user u
                                  WHERE u.id = a.author
                                  ORDER BY RAND()
                                  LIMIT 4');

          $stmt1->execute();
          $result = $stmt1->fetchAll();

          foreach($result as $article){
            $photoPath = skip_accents(str_replace(' ', '', $article['photo']));
            print_r("<div class='div-article'>");
            print_r("<h2>" . $article['name']. "</h2>");
            print_r("<img class='img-article' src='photos/". $photoPath . "'>" );
            print_r("</br>");
            print_r("<h3>" . $article['price']. "€</h3>");
            print_r("<h4>Vendu par " . $article['authorName']. "</h4>");
            print_r("</div>");
          }


        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
       ?>
     </div>
   <?php } ?>
  </body>


</html>
