<?php

include 'connect.php';


if (isset($_POST['title']) && isset($_POST['about']) && isset($_POST['content']) && isset($_POST['category'])) {
    $naslov = $_POST['title'];
    $sazetak = $_POST['about'];
    $sadrzaj = $_POST['content'];
    $kategorija = $_POST['category'];
    $arhiva = isset($_POST['archive']) ? true : false;
    $target_dir = "slike/";
    $slika = $target_dir . basename($_FILES["pphoto"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($slika,PATHINFO_EXTENSION));

    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["pphoto"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
    }

    if (file_exists($slika)) {
        $uploadOk = 0;
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        $uploadOk = 0;
    }

    if (move_uploaded_file($_FILES["pphoto"]["tmp_name"], $slika)) {
    }
    $query = "INSERT INTO clanci (naslov, sazetak, sadrzaj, kategorija, arhiva, slika) VALUES 
    ('$naslov', '$sazetak', '$sadrzaj', '$kategorija', '$arhiva', '$slika')";
    $result = mysqli_query($dbc, $query) or die('Error querying databese.');
    mysqli_close($dbc);

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title><?php echo $naslov ?></title>
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
            <article class="clanak">
            <h2><?php echo $kategorija; ?></h2>
                <h3><?php echo $naslov; ?></h3>
                <span><?php echo date('m/d/y')?></span><br>
                <img class="slika" src="<?php echo $slika;?>" alt=""><br>
                <?php echo '<button class="kategorija"><a href="kategorija.php?id=' . $kategorija . '">' . ucfirst($kategorija) . '</a></button>'; ?>
                <p><?php echo $sadrzaj; ?></p>
            </article>
        </main>
        <hr>
        <footer>
            <p>© <?php echo date('Y');?> NEWSWEEK</p>
            <hr>
        </footer>
    </div>
</body>
</html>