<?php
include 'connect.php';
define('UPLPATH', 'slike/');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Naslovnica</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>
<body>
    <div class="container">
        <header>
            <h1>Newsweek</h1>
            <p id="datum"><?php echo date('D, M d, Y')?></p>
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="kategorija.php?id=sport">Sport</a></li>
                    <li><a href="kategorija.php?id=auti">Auti</a></li>
                    <li><a href="unos.php">Unos</a></li>
                    <li><a href="administracija.php">Administracija</a></li>
                </ul>
            </nav>
        </header>
        <main class="container">
            <hr>
            <h2>Sport</h2>
            <section>
            <?php
                $query = "SELECT * FROM clanci WHERE arhiva=0 AND kategorija='sport' LIMIT 3";
                $result = mysqli_query($dbc, $query);
                $i = 0;
                while ($row = mysqli_fetch_array($result)) {
                    echo '<article class="sazetak">';
                    echo '<img class="slika" src="'.$row['slika'].'">';
                    echo '<a href="clanak.php?id='.$row['id'].'"><h3>'.$row['naslov'].'</h3></a>';
                    echo '</article>';
                }
            ?>

            </section>
            <hr>
            <h2>Auti</h2>
            <section>
            <?php
                $query = "SELECT * FROM clanci WHERE arhiva=0 AND kategorija='auti' LIMIT 3";
                $result = mysqli_query($dbc, $query);
                $i = 0;
                while ($row = mysqli_fetch_array($result)) {
                    echo '<article class="sazetak">';
                    echo '<img class="slika" src="'.$row['slika'].'">';
                    echo '<a href="clanak.php?id='.$row['id'].'"><h3>'.$row['naslov'].'</h3></a>';
                    echo '</article>';
                }
            ?>

            </section>
        </main>
        <hr>
        <footer>
            <p>© <?php echo date('Y');?> NEWSWEEK</p>
            <hr>
        </footer>
    </div>
</body>
</html>