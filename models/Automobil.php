<?php
class Automobil{
private $conn;
private $table='Automobil';

public $id_automobil;
public $marka;
public $model;
public $boja;

// METODE
public function __construct($db) {
  $this->conn = $db;
}

// GET
public function get() {
  $query = 'CALL GetAutomobili()';

  $stmt = $this->conn->prepare($query);
  $stmt->execute();

  return $stmt;
}

public function read_single(){
$query = 'CALL GetAutomobil(?)';

  $stmt = $this->conn->prepare($query);
  $stmt->bindParam(1, $this->id_automobil, PDO::PARAM_STR);
  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  $this->id_automobil = $row['id_automobil'];
  $this->marka = $row['marka'];
  $this->model = $row['model'];
  $this->boja = $row['boja'];
}

// POST
public function create() {
$query = 'INSERT INTO ' . $this->table . ' (id_automobil, marka, model, boja)
 VALUES(:reg, :marka, :model, :color)';

$stmt = $this->conn->prepare($query);

$this->id_automobil = htmlspecialchars(strip_tags($this->id_automobil));
$this->marka = htmlspecialchars(strip_tags($this->marka));
$this->model = htmlspecialchars(strip_tags($this->model));
$this->boja = htmlspecialchars(strip_tags($this->boja));

$stmt-> bindParam(':reg', $this->id_automobil);
$stmt-> bindParam(':marka', $this->marka);
$stmt-> bindParam(':model', $this->model);
$stmt-> bindParam(':color', $this->boja);

if($stmt->execute()) {
return true;
}
printf("Greška: $s.\n", $stmt->error);

return false;
}
}
