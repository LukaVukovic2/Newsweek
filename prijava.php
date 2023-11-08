<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Prijava</title>
</head>
<body>
    <div class="container">
        <header>
            <h1>Newsweek</h1>
            <p id="datum"><?php echo date('D, M d, Y');?></p>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="kategorija.php?id=sport">Sport</a></li>
                    <li><a href="kategorija.php?id=auti">Auti</a></li>
                    <li><a href="unos.php">Unos</a></li>
                    <li><a href="administracija.php">Administracija</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <h2>Prijava</h2>
            <form method="post">
                <label for="ime">Unesite korisničko ime:</label><br>
                <input type="text" name="ime" required><br>
                <label for="pass">Unesite lozinku:</label><br>
                <input type="password" name="pass" required><br>
                <input class="gumb" type="submit" value="Pošalji">
                <br>
                <p>Nemate račun?</p>
                <a class="btn" href="registracija.php">Registracija</a>
            </form>
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $dbhost = "localhost";
                    $dbuser = "root";
                    $dbpass = "";
                    $db = "newsweek";
                    $ime = $_POST['ime'];
                    $lozinka = $_POST['pass'];
                    $dbc = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
                    $select = "SELECT * FROM korisnik WHERE korisnicko_ime='$ime'";
                    $result = mysqli_query($dbc, $select);
                    if ($row = mysqli_fetch_assoc($result)) {
                        $hashedPassword = $row['lozinka'];
                        if (password_verify($lozinka, $hashedPassword)) {
                            session_start();
                            $_SESSION['username'] = $row['korisnicko_ime'];
                            $_SESSION['level'] = $row['razina'];
                            echo "Dobro došli ". $_SESSION['username'] . ". <br><a href=\"administracija.php\">Odi na administraciju</a>";
                            header('Location: administracija.php');
                            exit;
                        } else {
                            echo "Unijeli ste pogrešno korisničko ime ili lozinku";
                        }
                    } else {
                        echo "Unijeli ste pogrešno korisničko ime ili lozinku";
                    }
                    mysqli_close($dbc);
                }
            ?>
        </main>
        <hr>
        <footer>
            <p>© 2019 NEWSWEEK</p>
            <hr>
        </footer>
    </div>
</body>
</html>
