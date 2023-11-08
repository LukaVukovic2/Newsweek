<?php
include 'connect.php';
define('UPLPATH', 'slike/');
?>
<!DOCTYPE html>
<html lang=en>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Kategorija</title>
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
        <hr>
            <?php
                if (isset($_GET['id'])) {
                    $category = $_GET['id'];
                    $kategorija = ucfirst($category);
                    echo "<h2>$kategorija</h2>";
                    echo "<section>";
                    $query = "SELECT * FROM clanci WHERE arhiva=0 AND kategorija='$category'";
                    $result = mysqli_query($dbc, $query);
                    
                    while ($row = mysqli_fetch_array($result)) {
                        echo '<article class="sazetak">';
                        echo '<img class="slika" src="'.$row['slika'].'">';
                        echo '<a href="clanak.php?id='.$row['id'].'"><h3>'.$row['naslov'].'</h3></a>';
                        echo '</article>';
                    }
                    echo "</section>";
                } else {
                    echo '<p>Nema vijesti u željenoj kategoriji.</p>';
                }
            ?>
        </main>
        <hr>
        <footer>
            <p>© <?php echo date('Y');?> NEWSWEEK</p>            
            <hr>
        </footer>
    </div>
</body>
</html>