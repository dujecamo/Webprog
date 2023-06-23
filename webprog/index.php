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

  <main>
    <section>
      <div class="category">
        <h2 class="kategorija">Sport</h2>
        <div class="articles">
          <?php
          $servername = "127.0.0.1";
          $username = "root";
          $password = "1234";
          $dbname = "ovabaza";
          $conn = new mysqli($servername, $username, $password, $dbname);

          if ($conn->connect_error) {
            die("Neuspjela veza s bazom podataka: " . $conn->connect_error);
          }

          $sql_sport = "SELECT * FROM news WHERE category = 'Sport' AND archive = 'Ne'";
          $result_sport = $conn->query($sql_sport);

          if ($result_sport && $result_sport->num_rows > 0) {
            while ($row_sport = $result_sport->fetch_assoc()) {
              echo "<article class='article'>";
              echo "<a href='article.php?id=" . $row_sport['id'] . "'>";
              if (!empty($row_sport['image'])) {
                echo "<img src='slike/" . $row_sport['image'] . "' alt='Article Image'>";
              }
              echo "<h2>" . $row_sport['title'] . "</h2>";
              echo "<p>" . $row_sport['about'] . "</p>";
              echo "<p>AUTOR: " . $row_sport['author'] . "</p>";
              echo "<p>OBJAVLJENO: " . $row_sport['published_date'] . "</p>";
              echo "</a>";
              echo "</article>";
            }
          } else {
            echo "<p>Nema članaka u kategoriji Sport.</p>";
          }

          $conn->close();
          ?>
        </div>
      </div>
    </section>

    <section>
      <div class="category">
        <h2 class="kategorija">Kultura</h2>
        <div class="articles">
          <?php
          $conn = new mysqli($servername, $username, $password, $dbname);

          if ($conn->connect_error) {
            die("Neuspjela veza s bazom podataka: " . $conn->connect_error);
          }

          $sql_kultura = "SELECT * FROM news WHERE category = 'Kultura' AND archive = 'Ne'";
          $result_kultura = $conn->query($sql_kultura);

          if ($result_kultura && $result_kultura->num_rows > 0) {
            while ($row_kultura = $result_kultura->fetch_assoc()) {
              echo "<article class='article'>";
              echo "<a href='article.php?id=" . $row_kultura['id'] . "'>";
              if (!empty($row_kultura['image'])) {
                echo "<img src='slike/" . $row_kultura['image'] . "' alt='Article Image'>";
              }
              echo "<h2>" . $row_kultura['title'] . "</h2>";
              echo "<p>" . $row_kultura['about'] . "</p>";
              echo "<p>AUTOR: " . $row_kultura['author'] . "</p>";
              echo "<p>OBJAVLJENO: " . $row_kultura['published_date'] . "</p>";
              echo "</a>";
              echo "</article>";
            }
          } else {
            echo "<p>Nema članaka u kategoriji Kultura.</p>";
          }

          $conn->close();
          ?>
        </div>
      </div>
    </section>
  </main>
</body>
</html>
