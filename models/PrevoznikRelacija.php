<?php
class PrevoznikRelacija{

    private $conn;
    private $table = 'PrevoznikRelacija';

    public $prevoznik_id;
    public $relacija_id;
    public $datumUvodjenja;

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
    $query = 'INSERT INTO ' . $this->table . ' (prevoznik_id, relacija_id, datumUvodjenja)
    VALUES(:prevoznik, :relacija, CURRENT_TIMESTAMP())';

  $stmt = $this->conn->prepare($query);
  $this->prevoznik_id = htmlspecialchars(strip_tags($this->prevoznik_id));

  $stmt-> bindParam(':prevoznik', $this->prevoznik_id);
  $stmt-> bindParam(':relacija', $this->relacija_id);

  if($stmt->execute()) {
    return true;
  }
  printf("Greška: $s.\n", $stmt->error);

  return false;
  }
}