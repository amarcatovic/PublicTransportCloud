<?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Vozilo.php';

  $database = new Database();
  $db = $database->connect();

  $vehicle = new Vozilo($db);

  $result = $vehicle->get();
  
  $num = $result->rowCount();

  if($num > 0) {
        $cat_arr = array();
        $cat_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $cat_item = array(
            'registracija' => $id_vozilo,
            'naziv' => $naziv,
            'kapacitet' => $kapacitet,
            'tip_id' => $tip_id,
            'tip' => $tip,
            'prevoznik_id' => $prevoznik_id,
            'prevoznik' => $prevoznik    

          );

          array_push($cat_arr['data'], $cat_item);
        }

        echo json_encode($cat_arr);

  } else {
        echo json_encode(
          array('message' => 'No Categories Found')
        );
  }
