<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Php</title>
  </head>

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
      echo "<table border='1'>";

      if ($selectOption != "All") {
        $sql = "SELECT $selectOption FROM users";
        echo "<tr><th>$selectOption</th></tr>";
      } else {
        $sql = "SELECT * FROM users";
        echo "<tr><th>Nom</th><th>Prenom</th><th>Age</th></tr>";
      }
      
      $stmt = $pdo->prepare($sql);// Préparation de la requête
      $stmt->execute();

      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($selectOption != "All") {
          echo "<tr><td>{$row[$selectOption]}</td></tr>";
        } else {
          echo "<tr><td>{$row['Nom']}</td><td>{$row['Prenom']}</td><td>{$row['Age']}</td></tr>";
        }
      }
      echo "</table>";
    }

  } catch (PDOException $e) {
    die("Erreur de connexion à la base de données: " . $e->getMessage());
  }
?>
