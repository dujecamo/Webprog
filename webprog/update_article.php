<?php
session_start();

if (!isset($_SESSION['korisnicko_ime'])) {
  header("Location: login.php");
  exit();
}

if ($_SESSION['administratorska_prava'] != 1) {
  echo "Pozdrav, " . $_SESSION['korisnicko_ime'] . "! Nemate pristup administratorskoj stranici.";
  exit();
}

$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "ovabaza";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Neuspjela veza s bazom podataka: " . $conn->connect_error);
}

if (isset($_POST['article_id']) && isset($_POST['title']) && isset($_POST['content'])) {
  $article_id = $_POST['article_id'];
  $title = $_POST['title'];
  $content = $_POST['content'];

  $sql_update = "UPDATE news SET title = '$title', content = '$content' WHERE id = '$article_id'";
  $result_update = $conn->query($sql_update);

  if ($result_update) {
    echo "Članak je uspješno ažuriran.";
  } else {
    echo "Pogreška prilikom ažuriranja članka: " . $conn->error;
  }
}

$conn->close();
?>
