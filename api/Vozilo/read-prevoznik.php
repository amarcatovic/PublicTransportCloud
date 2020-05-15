<?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Vozilo.php';

  $database = new Database();
  $db = $database->connect();

  $vehicle = new Vozilo($db);

  $vehicle->prevoznik_id = isset($_GET['p']) ? $_GET['p'] : die();
  $vehicle->tip_id = isset($_GET['t']) ? $_GET['t'] : die();
  
  $result = $vehicle->getVozilaPrevoznika();
  
  $num = $result->rowCount();

  if($num > 0) {
        $cat_arr = array();
        $cat_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $cat_item = array(
            'registracija' => $id_vozilo,
            'naziv' => $naziv,
            'kapacitet' => $kapacitet
          );

          array_push($cat_arr['data'], $cat_item);
        }

        echo json_encode($cat_arr);

  } else {
        echo json_encode(
          array('message' => 'No Categories Found')
        );
  }
