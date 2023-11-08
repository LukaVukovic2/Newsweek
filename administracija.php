<?php
    include 'connect.php';
    session_start();
    if (!isset($_SESSION['level'])) {
        $_SESSION['level'] = -1;
    }
    echo "<!DOCTYPE html>\n";
        echo "<html lang=en>\n";
        echo "<head>\n";
        echo "    <meta charset=\"UTF-8\">\n";
        echo "    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\n";
        echo "    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
        echo "    <link rel=\"stylesheet\" href=\"style.css\">\n";
        echo "    <title>Administracija</title>\n";
        echo "</head>\n";
        echo "<body>\n";
        echo "    <div class=\"container\">\n";
        echo "        <header>\n";
        echo "            <h1>Newsweek</h1>\n";?>
        <p id="datum"><?php echo date('D, M d, Y') ?></p>
        <?php echo "            <nav>\n";
        echo "                <ul>\n";
        echo "                    <li><a href=\"index.php\">Home</a></li>\n";
        echo "                    <li><a href=\"kategorija.php?id=sport\">Sport</a></li>\n";
        echo "                    <li><a href=\"kategorija.php?id=auti\">Auti</a></li>\n";
        echo "                    <li><a href=\"unos.php\">Unos</a></li>\n";
        echo "                    <li><a href='#'>Administracija</a></li>";
        echo "                </ul>\n";
        echo "            </nav>\n";
        echo "        </header>\n";
        echo "        <main>\n";
        echo "              <hr>";
        if($_SESSION['level'] == 1){
            $query = "SELECT * FROM clanci";
            $result = mysqli_query($dbc, $query);
            echo "<h2>Administracija</h2>";
            while ($row = mysqli_fetch_array($result)) {
                echo '<form enctype="multipart/form-data" action="" method="POST">
                    <p><b>Članak ID: '.$row['id'].'</b></p>
                    <div class="form-item">
                        <label for="title">Naslov vijesti:</label>
                        <div class="form-field">
                            <input type="text" name="title" class="form-field-textual" value="' . $row['naslov'] . '">
                        </div><br>
                    </div>
                    <div class="form-item">
                        <label for="about">Kratki sadržaj vijesti:</label>
                        <div class="form-field">
                            <textarea name="about" id="" cols="30" rows="10" class="formfield-textual">' . $row['sazetak'] . '</textarea>
                        </div>
                    </div>
                    <div class="form-item"><br>
                        <label for="content">Sadržaj vijesti:</label>
                        <div class="form-field">
                            <textarea name="content" id="" cols="30" rows="10" class="formfield-textual">' . $row['sadrzaj'] . '</textarea>
                        </div>
                    </div>
                    <div class="form-item"><br>
                        <label for="pphoto">Slika:</label>
                        <div class="form-field">
                            <input type="file" id="pphoto" value="' . $row['slika'] . '" name="pphoto"/> <br><img class="adm_slika" src="' . $row['slika'] . '" width="100px">
                        </div><br>
                    </div>
                    <div class="form-item">
                        <label for="category">Kategorija vijesti:</label><br>
                        <div class="form-field">
                            <select name="category" id="" class="form-field-textual" value="' . $row['kategorija'] . '">
                                <option value="sport">Sport</option>
                                <option value="auti">Auti</option>
                            </select>
                        </div>
                    </div><br>
                    <div class="form-item">
                        <label>Spremiti u arhivu:</label>
                        <div class="form-field">';
                if ($row['arhiva'] == 0) {
                    echo '<input type="checkbox" name="archive" id="archive"/>
                        Arhiviraj?';
                } else {
                    echo '<input type="checkbox" name="archive" id="archive" checked/> Arhiviraj?<br>';
                }
                echo '</div>
                    </label>
                    </div>
                    <div class="form-item">
                        <input type="hidden" name="id" class="form-field-textual" value="' . $row['id'] . '">
                        <button class="gumb" type="reset" value="Poništi">Poništi</button>
                        <button class="gumb" type="submit" name="update" value="Prihvati">Izmjeni</button>
                        <button class="gumb" type="submit" name="delete" value="Izbriši">Izbriši</button>
                    </div>
                </form>';
                echo '<hr>';
            }

            if (isset($_POST['delete'])) {
                $id = $_POST['id'];
                $query = "DELETE FROM clanci WHERE id=$id ";
                $result = mysqli_query($dbc, $query);
            }

            if (isset($_POST['update'])) {
                $title = $_POST['title'];
                $about = $_POST['about'];
                $content = $_POST['content'];
                $category = $_POST['category'];
                $archive = isset($_POST['archive']) ? 1 : 0;
                $picture = $_FILES['pphoto']['name'];
                $id = $_POST['id'];
                if(isset($_POST['archive'])){
                    $archive=1;
                }else{
                    $archive=0;
                }
                $target_dir = 'slike/'.$picture;
                move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_dir);
                $id=$_POST['id'];
                $query = "UPDATE clanci SET naslov='$title', sazetak='$about', sadrzaj='$content', kategorija='$category', arhiva='$archive', slika='$target_dir' WHERE id=$id ";
                $result = mysqli_query($dbc, $query);
            }
        }
        elseif ($_SESSION['level'] == 0) {
            echo "<p>".$_SESSION['username'].", nemate dovoljna prava za
            pristup ovoj stranici.</p>";
        }
        else{
            echo "<br>Za mogućnost upravljanja ovom stranicu potrebna je prijava ili registracija.<br><br>";
            echo "<button class='gumb'><a href='prijava.php'>Prijava</a></button> ";
            echo "<button class='gumb'><a href='registracija.php'>Registracija</a></button>";
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