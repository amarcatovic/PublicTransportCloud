<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/RelacijaStanica.php';

  $database = new Database();
  $db = $database->connect();

  $stations = new RelacijaStanica($db);

  $data = json_decode(file_get_contents("php://input"));

  $relacija = $data->relacija_id;
  $ids = $data->ids;

  for ($i = 0; $i < sizeof($ids); $i++) {
    $stations->relacija_id = $relacija;
    $stations->stanica_id = $ids[$i];
    $stations->redniBr = $i + 1;
    $stations->create();
}
