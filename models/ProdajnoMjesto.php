<?php
class ProdajnoMjesto{

private $conn;
private $table='ProdajnoMjesto';

public $id_prodajnoMjesto;
public $naziv;
public $lat;
public $lng;
public $adresa;
public $grad_id;
public $grad;

// METODE
public function __construct($db) {
  $this->conn = $db;
}

// GET
public function get() {
  $query = 'CALL GetProdajnaMjesta()';

  $stmt = $this->conn->prepare($query);
  $stmt->execute();

  return $stmt;
}

public function read_single(){
$query = 'CALL GetProdajnoMjesto(?)';

  $stmt = $this->conn->prepare($query);
  $stmt->bindParam(1, $this->id_prodajnoMjesto);
  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  $this->id_prodajnoMjesto = $row['id_prodajnoMjesto'];
  $this->naziv = $row['naziv'];
  $this->lat = $row['lat'];
  $this->lng = $row['lng'];
  $this->adresa = $row['adresa'];
  $this->grad_id = $row['id_grad'];
  $this->grad = $row['grad'];
}

// POST
public function create() {
$query = 'INSERT INTO ' . $this->table . ' (naziv, lat, lng, adresa, grad_id)
 VALUES(:name, :lat, :lng, :adresa, :city)';

$stmt = $this->conn->prepare($query);
$this->naziv = htmlspecialchars(strip_tags($this->naziv));
$this->lat = htmlspecialchars(strip_tags($this->lat));
$this->lng = htmlspecialchars(strip_tags($this->lng));
$this->adresa = htmlspecialchars(strip_tags($this->adresa));
$this->grad_id = htmlspecialchars(strip_tags($this->grad_id));

$stmt-> bindParam(':name', $this->naziv);
$stmt-> bindParam(':lat', $this->lat);
$stmt-> bindParam(':lng', $this->lng);
$stmt-> bindParam(':adresa', $this->adresa);
$stmt-> bindParam(':city', $this->grad_id);

if($stmt->execute()) {
return true;
}
printf("Greška: $s.\n", $stmt->error);

return false;
}
}