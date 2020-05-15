<?php
include_once '../../models/KorisnikAplikacije.php';
class Vozac extends KorisnikAplikacije{
private $conn;
private $table='Vozac';


public $id_vozac;
public $prevoznik_id;

// METODE
public function __construct($db) {
  $this->conn = $db;
}

// GET
public function get() {
  $query = 'CALL GetVozace()';

  $stmt = $this->conn->prepare($query);
  $stmt->execute();

  return $stmt;
}

// POST
public function create() {
  $query = 'INSERT INTO ' . $this->table . ' (id_vozac, prevoznik_id)
  VALUES(:id, :company)';
  
  $stmt = $this->conn->prepare($query);
  $this->naziv = htmlspecialchars(strip_tags($this->prevoznik_id));
  
  $stmt-> bindParam(':id', $this->id_vozac);
  $stmt-> bindParam(':company', $this->prevoznik_id);

  if($stmt->execute()) {
  return true;
  }
  printf("Greška: $s.\n", $stmt->error);
  
  return false;
  }
}
