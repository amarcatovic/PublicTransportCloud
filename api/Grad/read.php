<?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Grad.php';

  $database = new Database();
  $db = $database->connect();

  $city = new Grad($db);

  $result = $city->get();
  
  $num = $result->rowCount();

  if($num > 0) {
        $cat_arr = array();
        $cat_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $cat_item = array(
            'id' => $id_grad,
            'naziv' => $naziv,
            'drzava_Id' => $drzava_id,
            'lat' => $lat,
            'lng' => $lng,
            'drzava' => $drzava
           );

          array_push($cat_arr['data'], $cat_item);
        }

        echo json_encode($cat_arr);

  } else {
        echo json_encode(
          array('message' => 'Nema Gradova')
        );
  }
