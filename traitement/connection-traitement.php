<?php
  $user = "root";
  $pass = "";

  $email=$_POST['email'];
  $pwd=$_POST['pwd'];

  try {
      //Connection à la BDD
      $dbh = new PDO('mysql:host=localhost;dbname=eCommerce', $user, $pass);

      //On check si le user existe et le pwd match bien
      $stmt1 = $dbh->prepare('SELECT email, pwd, name, id FROM user WHERE email LIKE :email');
      $stmt1->bindParam(':email', $email);
      $stmt1->execute();
      $result = $stmt1->fetch();

      $resEmail = $result[0];
      $resPwd = $result[1];
      $resName = $result[2];
      $userID = $result[3];

      if($resEmail == $email){
        if($resPwd == $pwd){
          //Si le mot de passe est correcte alors on redirige sur la page d'accueil
          //On démarre la session
          session_start();
          //Création des variables session
          $_SESSION['name'] = $resName;
          $_SESSION['email'] = $resEmail;
          $_SESSION['userID'] = $userID;
          //Redirection vers accueil
          print "Connection réussi ! Redirection ... ";
          echo "<script>alert('Connection réussi ! Redirection ...');</script>";
          echo "<script>setTimeout(\"location.href = '../index.php';\",1500);</script>";
        }
        else{
          print "Mot de passe incorrecte ! Redirection ... ";
          echo "<script>alert('Mot de passe incorrecte ! Redirection ... ');</script>";
          echo "<script>setTimeout(\"location.href = '../connection.php';\",1500);</script>";
        }
      }
      else{
        print "Utilisateur inconnus ! Redirection ... ";
        echo "<script>alert('Utilisateur inconnus ! Redirection ... ');</script>";
        echo "<script>setTimeout(\"location.href = '../connection.php';\",1500);</script>";
      }

      $dbh = null;
  } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage() . "<br/>";
      die();
  }


?>
