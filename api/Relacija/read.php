<?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Relacija.php';

  $database = new Database();
  $db = $database->connect();

  $relacija = new Relacija($db);

  $prevoznik_id = isset($_GET['id']) ? $_GET['id'] : die();
  $result = $relacija->get($prevoznik_id);
  
  $num = $result->rowCount();

  if($num > 0) {
        $cat_arr = array();
        $cat_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $cat_item = array(
            'id' => $id_relacija,
            'polaziste' => $polaziste,
            'odrediste' => $odrediste,
            'cijena' => $cijena,
            'interval' => $intervalRelacije,
            'vozilo' => $tipVozila  
          );

          array_push($cat_arr['data'], $cat_item);
        }

        echo json_encode($cat_arr);

  } else {
        echo json_encode(
          array('message' => 'No Categories Found')
        );
  }
