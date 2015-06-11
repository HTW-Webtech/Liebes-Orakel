<?php
   require 'Person.php';
   require 'Storage.php';

   $name_du = isset($_GET['du']) ? filter_var($_GET['du'], FILTER_SANITIZE_STRING) : '';
   $name_schatzi = isset($_GET['schatzi']) ? filter_var($_GET['schatzi'], FILTER_SANITIZE_STRING) : '';
?>

<!DOCTYPE html>
<html lang="de">
<head>
   <meta charset="utf-8">
   <title>Liebes-Orakel</title>
   <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Petit+Formal+Script">
   <link rel="stylesheet" href="style.css">
</head>
<body class="hearty-bg">

   <header class="header lovebox">
      <h1>Finde die wahre Liebe</h1>
      <strong>Gib den Namen deines Schatzes ein und erfahre, ob ihr für einander bestimmt seid.</strong>
   </header>

   <form class="form lovebox" action="index.php" method="GET">
      <input type="text" name="du" placeholder="Dein Name" value="<?= $name_du ?>">
      <input type="text" name="schatzi" placeholder="Schatzis Name" value="<?= $name_schatzi ?>">
      <button type="submit">♥</button>
   </form>

   <?php
      if ($name_du && $name_schatzi):
         $du = new Person($name_du);
         $schatzi = new Person($name_schatzi);
         $score = $du->compareTo($schatzi);
         $statement = $du->getStatementFor($schatzi);
   ?>

   <div class="result lovebox">
      <p class="statement">Ihr passt zu</p>
      <p class="score"><?= $score ?>%</p>
      <p class="statement">zusammen.</p>
      <p class="statement"><?= $statement ?></p>
   </div>

   <?php endif ?>

   <div class="archive lovebox">
      <h2>Archive</h2>
      <ul class="archive-list">
         <?php
            $storage = new Storage();

            if (isset($score)) {
               $storage->addEntry(array($name_du, $name_schatzi, $score));
            }

            $archive = $storage->getArchive();

            if (!sizeof($archive)) {
               echo '<p>Derzeit gibt es keine Einträge. Sei der erste!</p>';
            }
            else {
               foreach ($archive as $entry) {
                  echo
                  "<li>
                     <small>" . date('j. M', strtotime($entry['timestamp'])) . "</small>
                     <strong> ${entry['name1']} ♥ ${entry['name2']} </strong> zu ${entry['score']}%
                  </li>";
               }
            }
         ?>
      </ul>
   </div>

   <footer class="footer lovebox">
      <p>Wir übernehmen keine Haftung für gebrochene Herzen.</p>
   </footer>

</body>
</html>