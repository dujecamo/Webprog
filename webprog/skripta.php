<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = $_POST['title'];
  $about = $_POST['about'];
  $content = $_POST['content'];
  $category = $_POST['category'];
  $archive = isset($_POST['archive']) ? 'Da' : 'Ne';
  $author = $_POST['author'];
  $published_date = $_POST['published_date'];

  if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'slike/';
    $uploadFile = $uploadDir . basename($_FILES['image']['name']);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
      $image = $_FILES['image']['name'];
      echo "Slika je uspješno prenesena.\n";
    } else {
      echo "Prijenos slike nije uspio.\n";
    }
  } else {
    echo "Niste odabrali sliku.\n";
  }

  $servername = "127.0.0.1";
  $username = "root";
  $password = "1234";
  $dbname = "ovabaza";
  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Neuspjela veza s bazom podataka: " . $conn->connect_error);
  }

  $sql = "INSERT INTO news (title, about, content, category, archive, author, published_date, image)
          VALUES ('$title', '$about', '$content', '$category', '$archive', '$author', '$published_date', '$image')";

  if ($conn->query($sql) === TRUE) {
    echo "Podaci su uspješno pohranjeni u bazu.";
    header("Location: index.php");
    exit;
  }
}
?>
