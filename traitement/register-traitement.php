<?php
  $user = "root";
  $pass = "";

  $name=$_POST['name'];
  $email=$_POST['email'];
  $pwd=$_POST['pwd'];
  try {
      //Connection à la BDD
      $dbh = new PDO('mysql:host=localhost;dbname=eCommerce', $user, $pass);

      //On check si le user existe déjà avec son adresse email
      $stmt1 = $dbh->prepare('SELECT email from user where email LIKE :email');
      $stmt1->bindParam(':email', $email);
      $stmt1->execute();
      $result = $stmt1->fetch();
      $exist = $result[0];

      if($exist == $email){
        print "L'utilisateur existe déjà ! Redirection ...";

        echo "<script>alert('Lutilisateur existe déjà !');</script>";
        echo "<script>setTimeout(\"location.href = '../register.php';\",1500);</script>";
        return 0;
      }
      else{
        //Requête préparée pour insertion
        $stmt2 = $dbh->prepare("INSERT INTO user (name, email, pwd) VALUES (:name, :email, :pwd)");
        //Paramètres de la requête d'insertion
        $stmt2->bindParam(':name', $name);
        $stmt2->bindParam(':email', $email);
        $stmt2->bindParam(':pwd', $pwd);

        $stmt2->execute();
        print "Inscription réussi !";
        echo "<script>alert('Inscription réussi !' Redirection ...);</script>";
        echo "<script>setTimeout(\"location.href = '../connection.php';\",1500);</script>";

        return 1;
      }

      $dbh = null;
  } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage() . "<br/>";
      die();
  }


?>
