<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Registracija</title>
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
            <h2>Registracija</h2>
    <form enctype="multipart/form-data" action="" method="POST">
        <div class="form-item">
            <span id="porukaIme" class="bojaPoruke"></span>
            <label for="ime">Ime: </label>
            <div class="form-field">
                <input type="text" name="ime" id="ime" class="form-field-textual" required>
            </div>
        </div>
        <div class="form-item">
            <span id="porukaPrezime" class="bojaPoruke"></span>
            <label for="prezime">Prezime: </label>
            <div class="form-field">
                <input type="text" name="prezime" id="prezime" class="form-field-textual" required>
            </div>
        </div>
        <div class="form-item">
            <span id="porukaUsername" class="bojaPoruke"><?php echo isset($msg) ? $msg : ''; ?></span>
            <label for="username">Korisničko ime:</label>
            <div class="form-field">
                <input type="text" name="username" id="username" class="form-field-textual" required>
            </div>
        </div>
        <div class="form-item">
            <span id="porukaPass" class="bojaPoruke"></span>
            <label for="pass">Lozinka: </label>
            <div class="form-field">
                <input type="password" name="pass" id="pass" class="form-field-textual" required>
            </div>
        </div>
        <div class="form-item">
            <span id="porukaPass2" class="bojaPoruke"></span>
            <label for="pass2">Ponovljena lozinka: </label>
            <div class="form-field">
                <input type="password" name="pass2" id="pass2" class="form-field-textual" required>
            </div>
        </div>
        <div class="form-item">
            <button type="submit" class="gumb" value="Registracija" id="slanje">Registracija</button>
        </div>
    </form>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $dbhost = "localhost";
            $dbuser = "root";
            $dbpass = "";
            $db = "newsweek";
            $dbc = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
            $ime = $_POST['ime'];
            $prezime = $_POST['prezime'];
            $korisnicko_ime = $_POST['username'];
            $lozinka = $_POST['pass'];
            $lozinka2 = $_POST['pass2'];

            $query = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime = ?";
            $stmt = mysqli_prepare($dbc, $query);
            mysqli_stmt_bind_param($stmt, "s", $korisnicko_ime);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) > 0) {
                echo "Korisničko ime se već koristi";
            } else {
                if ($lozinka == $lozinka2) {
                    session_start();
                    $_SESSION['username'] = $korisnicko_ime;
                    $_SESSION['level'] = 0;
                    $hashed = password_hash($lozinka, CRYPT_BLOWFISH);
                    $query2 = "INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka) VALUES (?, ?, ?, ?)";
                    $stmt2 = mysqli_prepare($dbc, $query2);
                    mysqli_stmt_bind_param($stmt2, "ssss", $ime, $prezime, $korisnicko_ime, $hashed);
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_close($stmt2);

                    header("location: administracija.php");
                } else {
                    echo "<br>Lozinke moraju biti iste!";
                }
            }

            mysqli_stmt_close($stmt);
            mysqli_close($dbc);
        }
    ?>

        <br>
        <p>Već imate račun?</p>
        <a class="btn" href="prijava.php">Prijava</a>
        </main>
        <hr>
        <footer>
            <p>© <?php echo date('Y');?> NEWSWEEK</p>
            <hr>
        </footer>
    </div>
</body>
</html>
