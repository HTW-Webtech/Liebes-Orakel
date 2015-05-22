<?php

class Storage {

   private $connection;

   /**
    * Konstruktor - Erzeugt ein neues Storage-Objekt
    */
   public function __construct() {
      $db_host = 'localhost';
      $db_name = 'orakel';
      $db_user = 'root';
      $db_pass = 'root';

      try {
         $this->connection = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
         $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      }
      catch (PDOException $e) {
         die($e->getMessage());
      }
   }

   /**
    * Destruktor - Wickelt das Objekt vor dessen Vernichtung ab
    */
    public function __destruct() {
        $this->connection = null;
    }

    /**
     * Gibt die letzten Einträge im Archiv zurück
     * @return array Liste aus Einträgen mit id, timestamp, name1, name2 und score
     */
   public function getArchive() {
      return $this->connection->query('SELECT * FROM archiv ORDER BY id DESC LIMIT 0, 5');
   }

   /**
    * Fügt einen neuen Eintrag hinzu
    * @param array $daten Liste aus name1, name2 und score
    */
   public function addEntry(array $daten) {
      $statement = $this->connection->prepare('INSERT INTO archiv (id, timestamp, name1, name2, score) VALUES (NULL, CURRENT_TIMESTAMP, ?, ?, ?)');
      return $statement->execute($daten);
   }

}