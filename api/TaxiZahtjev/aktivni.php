<?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/TaxiZahtjev.php';

  $database = new Database();
  $db = $database->connect();

  $taxi = new TaxiZahtjev($db);

  $result =  $taxi->GetAktivni();
  
  $num = $result->rowCount();

  if($num > 0) {
        $cat_arr = array();
        $cat_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $cat_item = array(
            'id' => $id_zahtjev,
            'lokacija' => $lokacija,
            'opis' => $opis,
            'vrijeme' => $vrijemeZahtjeva
          );

          array_push($cat_arr['data'], $cat_item);
        }

        echo json_encode($cat_arr);

  } else {
        echo json_encode(
          array('message' => 'Trenutno nema zahtjeva')
        );
  }
