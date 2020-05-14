<?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/RelacijaStanica.php';

  $database = new Database();
  $db = $database->connect();

  $stations = new RelacijaStanica($db);

  $stations->relacija_id = isset($_GET['id']) ? $_GET['id'] : die();
  $result = $stations->get();
  
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
