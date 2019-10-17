<?php
require_once './php/db_connect.php';
?>

<?php 
if(isset($_POST['vote'])) {
	$gender = trim($_POST['gender']);
	$nameDescription = trim($_POST['nameDescription']);
    
  // Selecting the record from VOTEDBABYNAMES that match user's input
  
    $newRecord = 'SELECT * FROM `VOTEDBABYNAMES` WHERE name = "' . $nameDescription . '" AND gender = "' . $gender . '";';
 
    $result = $db->query($newRecord);
 

  if($result->num_rows > 0) {       // If record exists, update count
    $row = $result->fetch_assoc();
    $updatestm = "UPDATE `VOTEDBABYNAMES` SET count = " . ($row['count']+1) .
      " WHERE name = '" . $row['name'] . "' AND gender = '" . $row['gender'] . "';";
    if (!$db->query($updatestm)){
      echo json_encode(array('error' => '2'));
      exit;
    }
  } 
  else {        // If record does not exist, insert new record

    $insertstm = "INSERT INTO `VOTEDBABYNAMES` VALUES (NULL, '" . $nameDescription . 
      "', '" . $gender . "', 1);";
    if (!$db->query($insertstm)){
      echo json_encode(array('error' => '2'));
      exit;
    }
  }
  
  
  // Inserting the boys and girls records into separate arrays
  
  $selectstm1 = "SELECT name, count FROM `VOTEDBABYNAMES` WHERE gender = '";
  $selectstm2 = "' ORDER BY count DESC LIMIT 10;";
  $feedback_f = $db->query($selectstm1 . 'F' . $selectstm2);
  $feedback_m = $db->query($selectstm1 . 'M' . $selectstm2);
  if ($feedback_f and $feedback_m){
    $res_f = array();
    $res_m = array();
    while($row = $feedback_f->fetch_assoc()){
      array_push($res_f, $row);
    }
    while($row = $feedback_m->fetch_assoc()){
      array_push($res_m, $row);
    }
    echo json_encode(array('error'=>'0', 'girls'=>$res_f, 'boys'=>$res_m));
    exit;
  }
  else{
    echo json_encode(array('error' => '2'));
    exit;
  }

} 
?>