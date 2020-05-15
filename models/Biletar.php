<?php
 include_once '../../models/KorisnikAplikacije.php';
class Biletar extends KorisnikAplikacije{
private $conn;
private $table='Biletar';

public $id_biletar;
public $prodajnoMjesto_id;

// METODE
public function __construct($db) {
  $this->conn = $db;
}

// GET
public function get() {
  $query = 'CALL GetBiletare()';

  $stmt = $this->conn->prepare($query);
  $stmt->execute();

  return $stmt;
}


// POST
public function create() {
  $query = 'INSERT INTO ' . $this->table . ' (id_biletar, prodajnoMjesto_id)
  VALUES(:id, :place)';
  
  $stmt = $this->conn->prepare($query);
  $this->naziv = htmlspecialchars(strip_tags($this->prodajnoMjesto_id));
  
  $stmt-> bindParam(':id', $this->id_biletar);
  $stmt-> bindParam(':place', $this->prodajnoMjesto_id);

  
  if($stmt->execute()) {
  return true;
  }
  printf("Greška: $s.\n", $stmt->error);
  
  return false;
  }
}
