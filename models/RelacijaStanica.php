<?php
class RelacijaStanica{

    private $conn;
    private $table = 'RelacijaStanica';

    public $relacija_id;
    public $stanica_id;
    public $redniBr;

    // METODE
    public function __construct($db) {
      $this->conn = $db;
    }

    // GET
    public function get() {
      $query = 'CALL GetStaniceZaRelaciju(?)';

      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1, $this->relacija_id);
      $stmt->execute();

      return $stmt;
    }

    public function getNiz() {
      $query = 'CALL GetStaniceNiz(?)';

      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1, $this->relacija_id);
      $stmt->execute();

      return $stmt;
    }

    public function IzbrisiSve()
    {
      $query = 'CALL IzbrisiStaniceRelacije(?)';

      $stmt = $this->conn->prepare($query);

      $stmt-> bindParam(1, $this->relacija_id);

      if($stmt->execute()) {
        return true;
      }
      printf("Greška: $s.\n", $stmt->error);

      return false;
    }
    

  // POST
  public function create() {
    $query = 'INSERT INTO ' . $this->table . ' (relacija_id, stanica_id, rb_stanice)
    VALUES(:rel, :sta, :rb)';

  $stmt = $this->conn->prepare($query);

  $stmt-> bindParam(':rel', $this->relacija_id);
  $stmt-> bindParam(':sta', $this->stanica_id);
  $stmt-> bindParam(':rb', $this->redniBr);

  if($stmt->execute()) {
    return true;
  }
  printf("Greška: $s.\n", $stmt->error);

  return false;
  }
}