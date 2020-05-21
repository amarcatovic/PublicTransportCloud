<?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/LinijaPlacanje.php';

  $database = new Database();
  $db = $database->connect();

  $linija = new LinijaPlacanje($db);

  $linija->korisnik_id = isset($_GET['id']) ? $_GET['id'] : die();
  $result = $linija->get();
  
  $num = $result->rowCount();

  if($num > 0) {
        $cat_arr = array();
        $cat_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $cat_item = array(
            'polaziste' => $polaziste,
            'odrediste' => $odrediste,
            'datum' => $vrijemePlacanja,
            'cijena' => $kolicina,
            'vozilo' => $vozilo
          );

          array_push($cat_arr['data'], $cat_item);
        }

        echo json_encode($cat_arr);

  } else {
        echo json_encode(
          array('message' => 'Error')
        );
  }
