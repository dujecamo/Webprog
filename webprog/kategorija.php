<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Projekt</title>
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
      </ul>
    </nav>
  </header>

  <div class="news-container">
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $dbname = "ovabaza";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      die("Neuspjela veza s bazom podataka: " . $conn->connect_error);
    }
    $kategorija = isset($_GET['category']) ? $_GET['category'] : '';

    $sql = "SELECT * FROM news WHERE category = '$kategorija' AND archive = 'Ne'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<div class='news-item'>";
        echo "<h2>" . $row['title'] . "</h2>";
        if (!empty($row['image'])) {
          echo "<img src='slike/" . $row['image'] . "' alt='Article Image'>";
        }
        echo "<p>" . $row['about'] . "</p>";
        echo "</div>";
      }
    } else {
      echo "Nema vijesti za odabranu kategoriju.";
    }

    $conn->close();
    ?>
  </div>

  <footer>
    <p>Duje Čamo, 2023. dcamo@tvz.hr</p>
  </footer>
</body>
</html>
