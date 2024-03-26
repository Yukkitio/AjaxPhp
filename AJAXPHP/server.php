<?php
// Lit l'entrée brute de la requête POST et la décode de JSON
$data = json_decode(file_get_contents('php://input'), true);

// Récupère le nom à partir des données décodées
$name = htmlspecialchars($data['name']);
$pwd = htmlspecialchars($data['pwd']);

$host = 'localhost';
$dbname = 'phppdotest';
$username = 'root';
$password = '';

$con = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
  $pdo = new PDO($con, $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Erreur de connexion à la base de données: " . $e->getMessage());
}

if ($data['type']) {
  logUser($pdo,$name,$pwd);
} else {
  addUser($pdo,$name,$pwd);
}

function logUser($pdo,$name,$pwd) {

  $stmt = $pdo->prepare("SELECT * FROM logintable WHERE username=?");
  $stmt->execute([$name]);
  $user = $stmt->fetch();

  if ($user && password_verify($pwd, $user['password'])) {
      session_start();
      $_SESSION['username'] = $user['username'];
      echo json_encode(['success' => true]); // On dit au client Ok et le switch ce fait client side
      exit;
  } else {
      echo json_encode(['success' => false, 'error' => "Login info incorrect !"]);
  }
}

function addUser($pdo,$name,$pwd) {

  $hashedPassword = password_hash($pwd, PASSWORD_DEFAULT);
  $sql = "INSERT INTO logintable (username, password) VALUES (?, ?);";

  try {
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$name, $hashedPassword]);
      echo "Nouvel utilisateur créé avec succès.";
  } catch (PDOException $e) {
      die("Erreur lors de la création de l'utilisateur : " . $e->getMessage());
  }
}

?>
