--
-- Datenbank: orakel
--
CREATE DATABASE orakel DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE orakel;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle archiv
--

CREATE TABLE archiv (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  timestamp timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  name1 varchar(30) NOT NULL,
  name2 varchar(30) NOT NULL,
  score float NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
