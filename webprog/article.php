<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>NBA - National Basketball Association</title>
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
    <section class="row">
      <div class="article-container">
        <?php
        if (isset($_GET['id'])) {
          $article_id = $_GET['id'];

          $servername = "127.0.0.1";
          $username = "root";
          $password = "1234";
          $dbname = "ovabaza";

          $conn = new mysqli($servername, $username, $password, $dbname);

          if ($conn->connect_error) {
            die("Neuspjela veza s bazom podataka: " . $conn->connect_error);
          }

          $sql_article = "SELECT * FROM news WHERE id = '$article_id'";
          $result_article = $conn->query($sql_article);

          if ($result_article && $result_article->num_rows > 0) {
            $row_article = $result_article->fetch_assoc();
            echo "<article>";
            echo "<h2>" . $row_article['title'] . "</h2>";
            echo "<p>AUTOR: " . $row_article['author'] . "</p>";
            echo "<p>Datum objave: " . $row_article['published_date'] . "</p>";
            if (!empty($row_article['image'])) {
              echo "<img src='slike/" . $row_article['image'] . "' alt='Article Image'>";
            }
            echo "<p class='kratki'>" . $row_article['about'] . "</p>";
            echo "<p>" . $row_article['content'] . "</p>";
            echo "</article>";
          } else {
            echo "<p>Članak nije pronađen.</p>";
          }

          $conn->close();
        } else {
          echo "<p>Članak nije odabran.</p>";
        }
        ?>
      </div>
    </section>
  </main>

  <footer>
    <p>Duje Čamo, 2023. dcamo@tvz.hr</p>
  </footer>
</body>
</html>
