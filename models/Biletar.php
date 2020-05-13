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

public function read_single(){
$query = 'CALL';

  $stmt = $this->conn->prepare($query);
  $stmt->bindParam(1, $this->id_korisnik);
  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  $this->id_korisnik = $row['id_korisnik'];
  $this->ime = $row['ime'];
  $this->prezime = $row['prezime'];
  $this->email = $row['email'];
  $this->passwordHash = $row['passwordHash'];
  $this->Grad = $row['Grad'];
  $this->Uloga = $row['Uloga'];
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
