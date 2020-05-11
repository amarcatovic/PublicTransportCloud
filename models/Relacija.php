<?php
class Relacija{

    private $conn;
    private $table = 'Relacija';

    public $id_relacija;
    public $cijena;
    public $interval_id;
    public $tipVozila_id;

    // METODE
    public function __construct($db) {
      $this->conn = $db;
    }

    // GET
    public function get() {
      $query = 'CALL ';

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
    $query = 'INSERT INTO ' . $this->table . ' (naziv) VALUES(:name)';

  $stmt = $this->conn->prepare($query);
  $this->naziv = htmlspecialchars(strip_tags($this->naziv));

  $stmt-> bindParam(':name', $this->naziv);

  if($stmt->execute()) {
    return true;
  }
  printf("Greška: $s.\n", $stmt->error);

  return false;
  }
}