<?php

/**
Retire les accents d'une chaine de caractères
Par défaut selon l'encodage UTF8
**/
function skip_accents( $str, $charset='utf-8' ) {

  $str = htmlentities( $str, ENT_NOQUOTES, $charset );

  $str = preg_replace( '#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str );
  $str = preg_replace( '#&([A-za-z]{2})(?:lig);#', '\1', $str );
  $str = preg_replace( '#&[^;]+;#', '', $str );

  return $str;
}



 ?>
