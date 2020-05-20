<?php
class Grad{

    private $conn;
    private $table = 'Grad';

    public $id_grad;
    public $naziv;
    public $drzava_id;

    public $lat;
    public $lng;

    // METODE
    public function __construct($db) {
      $this->conn = $db;
    }

    // GET
    public function get() {
      $query = 'CALL GetGradovi()';

      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      return $stmt;
    }

  public function read_single(){
    $query = 'CALL GetGrad(?)';

      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1, $this->id_grad, PDO::PARAM_STR);
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      $this->id_grad = $row['id_grad'];
      $this->naziv = $row['naziv'];
      $this->drzava_id = $row['drzava_id'];
      $this->lat = $row['lat'];
      $this->lng = $row['lng'];
  }

  // POST
  public function create() {
    $query = 'INSERT INTO ' . $this->table . ' (naziv, drzava_id, lat, lng) VALUES(:name, :country, :lat, :lng)';

  $stmt = $this->conn->prepare($query);
  $this->naziv = htmlspecialchars(strip_tags($this->naziv));
  $this->lat = htmlspecialchars(strip_tags($this->lat));
  $this->lng = htmlspecialchars(strip_tags($this->lng));

  $stmt-> bindParam(':name', $this->naziv);
  $stmt-> bindParam(':country', $this->drzava_id);
  $stmt-> bindParam(':lat', $this->lat);
  $stmt-> bindParam(':lng', $this->lng);

  if($stmt->execute()) {
    return true;
  }
  printf("Greška: $s.\n", $stmt->error);

  return false;
  }
}