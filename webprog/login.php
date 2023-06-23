<?php
session_start();

if (isset($_SESSION['korisnicko_ime'])) {
  header("Location: administrator.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $servername = "localhost";
  $username = "root";
  $password = "1234";
  $dbname = "ovabaza";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $korisnicko_ime = $_POST['korisnicko_ime'];
  $lozinka = $_POST['lozinka'];

  $sql = "SELECT * FROM korisnik WHERE korisnicko_ime = '$korisnicko_ime'";
  $result = $conn->query($sql);

  if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    if (password_verify($lozinka, $row['lozinka'])) {
      $_SESSION['korisnicko_ime'] = $korisnicko_ime;
      $_SESSION['administratorska_prava'] = $row['administratorska_prava'];
      header("Location: administrator.php");
      exit();
    }
  }

  echo "Neuspješna prijava. Provjerite korisničko ime i lozinku.";
  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Prijava</title>
</head>
<body>
  <h1>Prijava</h1>
  <form action="login.php" method="POST">
    <label for="korisnicko_ime">Korisničko ime:</label>
    <input type="text" name="korisnicko_ime" required><br>

    <label for="lozinka">Lozinka:</label>
    <input type="password" name="lozinka" required><br>

    <button type="submit">Prijavi se</button>
  </form>
  <p>Nemate korisnički račun? <a href="registracija.php">Registrirajte se</a>.</p>
</body>
</html>
