<?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Vozilo.php';

  $database = new Database();
  $db = $database->connect();

  $vehicle = new Vozilo($db);

  $vehicle->id_vozilo = isset($_GET['reg']) ? $_GET['reg'] : die();
  
  $result = $vehicle->slobodna();
  
  $row = $result->fetch(PDO::FETCH_ASSOC);
  if($row['broj'] == 1) {
    echo json_encode(
        array('message' => 'Zauzeto')
      );
  } else {
        echo json_encode(
          array('message' => 'Slobodno')
        );
  }
