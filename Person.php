<?php

class Person {

   public $name;

   /**
    * Konstruktor - Erzeugt ein neues Personen-Objekt
    */
   function __construct($name = '') {
      $this->name = $name;
   }

   /**
    * Definiert die Ausgabe, wenn das Objekt als String behandelt wird
    * @return string Aussagekräftige Beschreibung des Objekts
    */
   function __toString() {
      return "$this->name hat einen Score von {$this->getScore()}";
   }

   /**
    * Gibt den Score der im Objekt repräsentierten Person zurück
    * @return integer Wert des verrechneten Personen-Names
    */
   function getScore() {
      $chars = str_split($this->name);
      $char_to_num = function ($sum, $char) {
         return $sum + ord($char);
      };

      return array_reduce($chars, $char_to_num);
   }

   /**
    * Gibt den Namen der Person zurück
    * @return string Name der Person
    */
   function getName() {
      return $this->name;
   }

   /**
    * Vergleicht eine Person mit einer anderen und gibt die prozentuale Nähe zurück
    * @param  Person  $person             Die zum Vergleich heranzuziehende Person
    * @param  integer $places_after_comma Anzahl der Nachkommastellen des Ergebnisses
    * @return integer                     Ergebnis der Verrechnung als Wert zwischen 0 und 100
    */
   function compareTo(Person $person, $places_after_comma = 1) {
      $scores = array($this->getScore(), $person->getScore());
      if ($scores[0] > 0 && $scores[1] > 0) {
         return round( min($scores) / max($scores) * 100, $places_after_comma);
      }
      return 0;
   }

   /**
    * Gibt einem zum Ergebnis passenden Kommentar zurück
    * @param  Person $person Die Person, mit der verglichen werden soll
    * @return string         Der Kommentar
    */
   function getStatementFor(Person $person) {
      $score = $this->compareTo($person);

      switch (true) {
         case $score > 90: return 'Ihr seid ein Traumpaar.';
         case $score > 70: return 'Einen Versuch ist es wert.';
         case $score > 50: return 'Naja…';
         case $score > 30: return 'Wird wohl nichts.';
         default:          return 'Lasst es lieber!';
      }
   }

}