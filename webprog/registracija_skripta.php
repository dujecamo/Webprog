<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $servername = "localhost";
  $username = "root";
  $password = "1234";
  $database = "ovabaza";

  $conn = new mysqli($servername, $username, $password, $database);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $korisnicko_ime = $_POST['korisnicko_ime'];
  $lozinka = $_POST['lozinka'];

  $hashed_password = password_hash($lozinka, PASSWORD_DEFAULT);

  $administratorska_prava = isset($_POST['administratorska_prava']) ? 1 : 0;

  $sql = "INSERT INTO korisnik (korisnicko_ime, lozinka, administratorska_prava) VALUES ('$korisnicko_ime', '$hashed_password', '$administratorska_prava')";

  if ($conn->query($sql) === TRUE) {
    echo "Korisnik je uspješno registriran.";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
}
?>
