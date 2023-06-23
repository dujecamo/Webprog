<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Registracija</title>
</head>
<body>
  <h1>Registracija</h1>
  <form action="registracija_skripta.php" method="POST">
    <label for="korisnicko_ime">Korisničko ime:</label>
    <input type="text" name="korisnicko_ime" required><br>

    <label for="lozinka">Lozinka:</label>
    <input type="password" name="lozinka" required><br>

    <label for="administratorska_prava">Administrativna prava:</label>
    <input type="checkbox" name="administratorska_prava">

    <button type="submit">Registriraj se</button>
  </form>
</body>
</html>
