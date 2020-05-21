<?php
class LinijaPlacanje{

    private $conn;
    private $table = 'LinijaPlacanje';

    public $linija_id;
    public $korisnik_id;
    public $vrijemePlacanja;
    public $kolicina;
    public $vozilo;

    // METODE
    public function __construct($db) {
      $this->conn = $db;
    }

    // GET
    public function get() {
      $query = 'CALL GetPlaceneLinije(?)';

      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1, $this->korisnik_id);
      $stmt->execute();

      return $stmt;
    }

  public function LinijaPlacena(){
    $query = 'CALL LinijaPlacena(?, ?)';

      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1, $this->korisnik_id);
      $stmt->bindParam(2, $this->linija_id);
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      if($row['broj'] != 0)
        return true;
      
      return false;
  }

  // POST
  public function create() {
    $query = 'INSERT INTO ' . $this->table . ' (linija_id, korisnik_id, kolicina)
    VALUES(:line, :user, :kol)';

  $stmt = $this->conn->prepare($query);

  $stmt-> bindParam(':line', $this->linija_id);
  $stmt-> bindParam(':user', $this->korisnik_id);
  $stmt-> bindParam(':kol', $this->kolicina);

  if($stmt->execute()) {
    return true;
  }
  printf("Greška: $s.\n", $stmt->error);

  return false;
  }
}