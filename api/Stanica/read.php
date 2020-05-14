<?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Stanica.php';

  $database = new Database();
  $db = $database->connect();

  $station = new Stanica($db);

  $station->grad_id = isset($_GET['id']) ? $_GET['id'] : die();
  $result = $station->get();
  
  $num = $result->rowCount();

  if($num > 0) {
        $cat_arr = array();
        $cat_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $cat_item = array(
            'id' => $id_stanica,
            'naziv' => $naziv,
            'lat' => $lat,
            'lng' => $lng,
            'adresa' => $adresa
          );

          array_push($cat_arr['data'], $cat_item);
        }

        echo json_encode($cat_arr);

  } else {
        echo json_encode(
          array('message' => 'No Categories Found')
        );
  }
