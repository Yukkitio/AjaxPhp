<!DOCTYPE HTML>
<html>  
  <body>
    <form method="POST">
      <select name="operator" onchange="this.form.submit()">
        <option value="--" <?php if (isset($_POST['operator']) && $_POST['operator'] == "--") echo 'selected'; ?>>--</option>
        <option value="Nom" <?php if (isset($_POST['operator']) && $_POST['operator'] == "Nom") echo 'selected'; ?>>Nom</option>
        <option value="Prenom" <?php if (isset($_POST['operator']) && $_POST['operator'] == "Prenom") echo 'selected'; ?>>Prenom</option>
        <option value="Age" <?php if (isset($_POST['operator']) && $_POST['operator'] == "Age") echo 'selected'; ?>>Age</option>
        <option value="All" <?php if (isset($_POST['operator']) && $_POST['operator'] == "All") echo 'selected'; ?>>All</option>
      </select>
    </form>
  </body>
</html>

<?php
  $host = 'localhost';
  $dbname = 'phppdotest';
  $username = 'root';
  $password = '';

  $con = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

  try {
    $pdo = new PDO($con, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $selectOption = $_POST['operator'] ?? "--";
    
    if ($selectOption != "--") {
      if ($selectOption != "All") {
        $sql = "SELECT $selectOption FROM users";
      } else {
        $sql = "SELECT * FROM users";
      }

      $stmt = $pdo->prepare($sql); // Préparation de la requête
      $stmt->execute();
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);// On fetchall pour tout avoir directement pour par la suite l'afficher
    }

    echoTable($results ?? False);

  } catch (PDOException $e) {
    die("Erreur de connexion à la base de données: " . $e->getMessage());
  }

  function echoTable($results) {
    if(!$results) {
        echo "Aucun résultats à afficher !";
    } else {        
      echo "<table border='1'>";
      $firstRow = true; // Utilisation comme d'une balise pour entete tableau

      foreach($results as $row) {
        if ($firstRow) {
          echo "<tr>";
          foreach(array_keys($row) as $header) {
            echo "<th>$header</th>"; // Titre dans le tableau
          }
          echo "</tr>";
          $firstRow = false; // On uncheck pour passer a la suite
        }
        echo "<tr>";
        foreach($row as $cell) {
          echo "<td>$cell</td>"; // Affichage des données
        }
        echo "</tr>";
      }
      echo "</table>";
    } 
  }

?>
