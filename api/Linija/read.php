<?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Linija.php';

  $database = new Database();
  $db = $database->connect();

  $linija = new Linija($db);

  $linija->grad = isset($_GET['g']) ? $_GET['g'] : die();
  $linija->tip = isset($_GET['t']) ? $_GET['t'] : die();
  $result = $linija->get();
  
  $num = $result->rowCount();

  if($num > 0) {
        $cat_arr = array();
        $cat_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $cat_item = array(
            'id' => $id_linija,
            'polaziste' => $polaziste,
            'odrediste' => $odrediste,
            'planiraniPolazak' => $planiraniPolazak,
            'planiraniDolazak' => $planiraniDolazak,
            'sljedecaStanica' => $sljedecaStanica,
            'cijena' => $cijena,
            'tip' => $tip,
            'status' => $status, 
          );

          array_push($cat_arr['data'], $cat_item);
        }

        echo json_encode($cat_arr);

  } else {
        echo json_encode(
          array('message' => 'Nije pronađena ni jedna aktivna linija')
        );
  }
