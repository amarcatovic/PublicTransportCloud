<?php
class Nadopune{

    private $conn;
    private $table = 'Nadopune';

    public $korisnik_id;
    public $prodajnoMjesto_id;
    public $datumNadopune;
    public $kolicina;

    // METODE
    public function __construct($db) {
      $this->conn = $db;
    }

    // GET
    public function get() {
      $query = 'CALL GetNadopune(?)';

      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1, $this->korisnik_id);
      $stmt->execute();

      return $stmt;
    }

  // POST
  public function create() {
    $query = 'INSERT INTO ' . $this->table . ' (korisnik_id, prodajnoMjesto_id, kolicina)
    VALUES(:user, :pm, :kol)';

  $stmt = $this->conn->prepare($query);
  $this->kolicina = htmlspecialchars(strip_tags($this->kolicina));

  $stmt-> bindParam(':user', $this->korisnik_id);
  $stmt-> bindParam(':pm', $this->prodajnoMjesto_id);
  $stmt-> bindParam(':kol', $this->kolicina);

  if($stmt->execute()) {
    return true;
  }
  printf("Greška: $s.\n", $stmt->error);

  return false;
  }
}