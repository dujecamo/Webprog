<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Administrator</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Projekt</h1>
    <nav>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="forma.html">Forma</a></li>
        <li><a href="kategorija.php?category=Sport">Sport</a></li>
        <li><a href="kategorija.php?category=Kultura">Kultura</a></li>
        <li><a href="administrator.php">Admin</a></li>
        <li><a href="logout.php">Odjava</a></li>
      </ul>
    </nav>
  </header>

  <div class="admin-container">
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

  echo "Dobrodošli na administratorsku stranicu, " . $_SESSION['korisnicko_ime'] . "!<br><br>";

  $servername = "localhost";
  $username = "root";
  $password = "1234";
  $dbname = "ovabaza";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Neuspjela veza s bazom podataka: " . $conn->connect_error);
  }

  if (isset($_GET['delete'])) {
    $article_id = $_GET['delete'];

    $sql_delete = "DELETE FROM news WHERE id = '$article_id'";
    $result_delete = $conn->query($sql_delete);

    if ($result_delete) {
      echo "Članak uspješno obrisan.<br><br>";
    } else {
      echo "Pogreška prilikom brisanja članka: " . $conn->error . "<br><br>";
    }
  }

  if (isset($_GET['edit'])) {
    $article_id = $_GET['edit'];

    $sql_select_article = "SELECT * FROM news WHERE id = '$article_id'";
    $result_select_article = $conn->query($sql_select_article);

    if ($result_select_article->num_rows > 0) {
      $row = $result_select_article->fetch_assoc();
      ?>
      <form action="administrator.php" method="POST">
        <input type="hidden" name="article_id" value="<?php echo $row['id']; ?>">
        Naslov:<br>
        <input type="text" name="title" value="<?php echo $row['title']; ?>"><br>
        Sažetak:<br>
        <textarea name="about"><?php echo $row['about']; ?></textarea><br><br>
        <input type="submit" name="update" value="Ažuriraj članak">
      </form>
      <?php
    } else {
      echo "Članak s ID-om " . $article_id . " ne postoji.<br><br>";
    }
  }

  if (isset($_POST['update'])) {
    $article_id = $_POST['article_id'];
    $title = $_POST['title'];
    $about = $_POST['about'];

    $sql_update = "UPDATE news SET title = '$title', about = '$about' WHERE id = '$article_id'";
    $result_update = $conn->query($sql_update);

    if ($result_update) {
      echo "Članak uspješno ažuriran.<br><br>";
    } else {
      echo "Pogreška prilikom ažuriranja članka: " . $conn->error . "<br><br>";
    }
  }

  $sql_select = "SELECT * FROM news";
  $result_select = $conn->query($sql_select);

  if ($result_select->num_rows > 0) {
    while ($row = $result_select->fetch_assoc()) {
      echo "<div class='article-item'>";
      echo "<h2>" . $row['title'] . "</h2>";
      echo "<p>" . $row['about'] . "</p>";
      echo "<p><a href='administrator.php?edit=" . $row['id'] . "'>Uredi članak</a> | <a href='administrator.php?delete=" . $row['id'] . "'>Izbriši članak</a></p>";
      echo "</div>";
    }
  } else {
    echo "Nema članaka u bazi podataka.<br><br>";
  }

  $conn->close();
  ?>
  </div>

  <footer>
    <p>Duje Čamo, 2023. dcamo@tvz.hr</p>
  </footer>
</body>
</html>
