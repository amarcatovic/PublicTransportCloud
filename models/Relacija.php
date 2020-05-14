<?php
class Relacija{

    private $conn;
    private $table = 'Relacija';

    public $id_relacija;
    public $cijena;
    public $polaziste_id;
    public $polaziste;
    public $odrediste_id;
    public $odrediste;
    public $interval_id;
    public $interval;
    public $tipVozila_id;
    public $tipVozila;

    // METODE
    public function __construct($db) {
      $this->conn = $db;
    }

    // GET SVE RELACIJE OD NEKOG PREVOZNIKA (potreban prevoznikID)
    public function get($id) {
      $query = 'CALL GetRelacija('. $id .')';

      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      return $stmt;
    }

  public function read_single(){
    $query = 'CALL ';

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
    $query = 'INSERT INTO ' . $this->table . ' (cijena, interval_id, tipVozila_id, polaziste_id, odrediste_id)
    VALUES(:price, :interval, :type, :A, :B)';

  $stmt = $this->conn->prepare($query);
  $this->cijena = htmlspecialchars(strip_tags($this->cijena));

  $stmt-> bindParam(':price', $this->cijena);
  $stmt-> bindParam(':interval', $this->interval_id);
  $stmt-> bindParam(':type', $this->tipVozila_id);
  $stmt-> bindParam(':A', $this->polaziste_id);
  $stmt-> bindParam(':B', $this->odrediste_id);

  if($stmt->execute()) {
    return $this->conn->lastInsertId();
  }
  printf("Greška: $s.\n", $stmt->error);

  return false;
  }
}