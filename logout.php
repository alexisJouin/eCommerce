<h1>Déconnection ...</h1>
<?php
  session_start();
  session_destroy();
  echo "<script>setTimeout(\"location.href = 'connection.php';\",1500);</script>";
 ?>
