<?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/RelacijaStanica.php';

  $database = new Database();
  $db = $database->connect();

  $stations = new RelacijaStanica($db);

  $stations->relacija_id = isset($_GET['id']) ? $_GET['id'] : die();
  $result = $stations->getNiz();
  
  $num = $result->rowCount();

  if($num > 0) {
        $cat_arr = array();
        $cat_arr['data'] = array();
        
        $ids = array();
        $ids['ids'] = array();

        $imena = array();
        $imena['imena'] = array();
        


        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          array_push($ids['ids'], $stanica_id);
          array_push($imena['imena'], $naziv);
        }

        array_push($cat_arr['data'], $imena['imena']);
        array_push($cat_arr['data'], $ids['ids']);
        echo json_encode($cat_arr);

  } else {
        echo json_encode(
          array('message' => 'No Categories Found')
        );
  }
