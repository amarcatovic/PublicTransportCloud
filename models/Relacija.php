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

  public function getSljedecaStanica(){
    $query = 'CALL GetSljedecaStanica(?)';

      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1, $this->id_relacija);
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      return $row['polaziste_id'];
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