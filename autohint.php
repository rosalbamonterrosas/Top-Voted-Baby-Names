<?php
  require_once './php/db_connect.php';


  $nameDescription = $_GET['term'];

// Selecting names from BABYNAMES for autocomplete
    
  $autostm = "SELECT name FROM `BABYNAMES` WHERE name LIKE '" . $nameDescription . "%' ORDER by name LIMIT 5;";
  $hint = $db->query($autostm);
 
  $autores=array();

  while($row = $hint->fetch_assoc()) {
    array_push($autores, $row['name']);
  }

  echo json_encode($autores);
?>