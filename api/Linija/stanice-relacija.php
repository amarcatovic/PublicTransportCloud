<?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Linija.php';

  $database = new Database();
  $db = $database->connect();

  $linija = new Linija($db);

  $linija->relacija_id = isset($_GET['id']) ? $_GET['id'] : die();
  $result = $linija->getStaniceRelacije();
  
  $num = $result->rowCount();

  if($num > 0) {
        $cat_arr = array();
        $cat_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $cat_item = array(
            'naziv' => $naziv,
            'lat' => $lat,
            'lng' => $lng,
            'tip' => $tip
          );

          array_push($cat_arr['data'], $cat_item);
        }

        echo json_encode($cat_arr);

  } else {
        echo json_encode(
          array('message' => 'Nije pronađena ni jedna stanica')
        );
  }
