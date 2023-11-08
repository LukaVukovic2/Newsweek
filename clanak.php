<?php
include 'connect.php';
define('UPLPATH', 'slike/');

if (isset($_GET['id'])) {
    $articleId = $_GET['id'];
    
    $query = "SELECT * FROM clanci WHERE id='$articleId'";
    $result = mysqli_query($dbc, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        echo '<!DOCTYPE html>';
        echo '<html lang=en>';
        echo '<head>';
        echo '<meta charset="UTF-8">';
        echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        echo '<link rel="stylesheet" href="style.css">';
        echo '<title>' . $row['naslov'] . '</title>';
        echo '</head>';
        echo '<body>';
        echo '<div class="container">';
        echo '<header>';
        echo '<h1>Newsweek</h1>';
        echo '<p id="datum">'.date("D, M d, Y").'</p>';
        echo '<nav>';
        echo '<ul>';
        echo '<li><a href="index.php">Home</a></li>';
        echo '<li><a href="kategorija.php?id=sport">Sport</a></li>';
        echo '<li><a href="kategorija.php?id=auti">Auti</a></li>';
        echo '<li><a href="unos.php">Unos</a></li>';
        echo '<li><a href="administracija.php">Administracija</a></li>';
        echo '</ul>';
        echo '</nav>';
        echo '</header>';
        echo '<main>';
        echo '<article class="clanak">';
        echo '<h2>' . ucfirst($row['kategorija']) . '</h2>';
        echo '<h3>' . $row['naslov'] . '</h3>';
        echo '<span>'.date('m/d/y').'</span>';
        echo '<img class="slika" src="'.$row['slika'].'" alt="">';
        echo '<br>';
        echo '<button class="kategorija"><a href="kategorija.php?id=' . $row['kategorija'] . '">' . ucfirst($row['kategorija']) . '</a></button>';
        echo '<p>' . $row['sadrzaj'] . '</p>';
        echo '</article>';
        echo '</main>';
        echo '<hr>';
        echo '<footer>';?>
        <p>© <?php echo date("Y");?> NEWSWEEK</p>
        <?php
        echo '</footer>';
        echo '</div>';
        echo '</body>';
        echo '</html>';
    } else {
        echo '<p>Članak nije pronađen.</p>';
    }
} else {
    echo '<p>Članak nije pronađen.</p>';
}
?>
