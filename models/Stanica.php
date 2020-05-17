<?php
class Stanica{

    private $conn;
    private $table = 'Stanica';

    public $id_stanica;
    public $naziv;
    public $lat;
    public $lng;
    public $tip_id;
    public $tip;
    public $adresa;
    public $grad_id;

    // METODE
    public function __construct($db) {
      $this->conn = $db;
    }

    // GET
    public function get() {
      $query = 'CALL GetStanice(?)';

      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1, $this->grad_id);
      $stmt->execute();

      return $stmt;
    }

  public function read_single(){
    $query = 'CALL GetStanica(?)';

      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1, $this->id_stanica);
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      $this->id_stanica = $row['id_stanica'];
      $this->naziv = $row['naziv'];
      $this->lat = $row['lat'];
      $this->lng = $row['lng'];
      $this->adresa = $row['adresa'];
      $this->grad_id = $row['grad_id'];
      $this->tip_id = $row['tip_id'];
      $this->tip = $row['tip'];
  }

  // POST
  public function create() {
    $query = 'INSERT INTO ' . $this->table . ' (naziv, lat, lng, adresa, grad_id, tip_id)
    VALUES(:name, :lat, :lng, :adresa, :city, :type)';

  $stmt = $this->conn->prepare($query);
  $this->naziv = htmlspecialchars(strip_tags($this->naziv));
  $this->lat = htmlspecialchars(strip_tags($this->lat));
  $this->lng = htmlspecialchars(strip_tags($this->lng));
  $this->adresa = htmlspecialchars(strip_tags($this->adresa));
  $this->grad_id = htmlspecialchars(strip_tags($this->grad_id));

  $stmt-> bindParam(':name', $this->naziv);
  $stmt-> bindParam(':lat', $this->lat);
  $stmt-> bindParam(':lng', $this->lng);
  $stmt-> bindParam(':adresa', $this->adresa);
  $stmt-> bindParam(':city', $this->grad_id);
  $stmt-> bindParam(':type', $this->tip_id);

  if($stmt->execute()) {
    return true;
  }
  printf("Greška: $s.\n", $stmt->error);

  return false;
  }
}