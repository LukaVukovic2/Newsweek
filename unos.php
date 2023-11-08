<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Unos članka</title>
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
                    <li><a href="#">Unos</a></li>
                    <li><a href="administracija.php">Administracija</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <hr>
            <h2>Unos članka</h2>
            <form action="skripta.php" method="POST" enctype="multipart/form-data">
                <div class="form-item">
                    <label for="title">Naslov vijesti</label>
                    <div class="form-field">
                        <input id="title" type="text" name="title" class="form-field-textual">
                        <span id="porukaTitle" class="error-message"></span>
                    </div>
                </div>
                <div class="form-item">
                    <label for="about">Kratki sadržaj vijesti (do 100 znakova)</label>
                    <div class="form-field">
                        <textarea name="about" id="about" cols="30" rows="10" class="formfield-textual"></textarea>
                        <span id="porukaAbout" class="error-message"></span>
                    </div>
                </div>
                <div class="form-item">
                    <label for="content">Sadržaj vijesti</label>
                    <div class="form-field">
                        <textarea name="content" id="content" cols="30" rows="10" class="form-field-textual"></textarea>
                        <span id="porukaContent" class="error-message"></span>
                    </div>
                </div>
                <div class="form-item">
                    <label for="pphoto">Slika: </label>
                    <div class="form-field">
                        <input type="file" class="input-text" name="pphoto" id="pphoto"/>
                        <span id="porukaSlika" class="error-message"></span>
                    </div>
                </div><br>
                <div class="form-item">
                    <label for="category">Kategorija vijesti</label>
                    <div class="form-field">
                        <select name="category" id="category" class="form-field-textual">
                        <option value="" disabled selected>Odabir kategorije</option>
                            <option value="sport">Sport</option>
                            <option value="auti">Auti</option>
                        </select><br>
                        <span id="porukaKategorija" class="error-message"></span>
                    </div>
                </div>
                <div class="form-item">
                    <label>Spremiti u arhivu:
                        <div class="form-field">
                            <input type="checkbox" id="archive" name="archive">
                        </div>
                    </label>
                </div>
                <div class="form-item">
                    <button class="gumb" type="reset" value="Poništi">Poništi</button>
                    <button class="gumb" type="submit" id="slanje" value="Prihvati">Prihvati</button>
                </div>
            </form>
        </main>
        <hr>
        <footer>
            <p>© 2019 NEWSWEEK</p>
            <hr>
        </footer>
    </div>
    <script type="text/javascript">
        document.getElementById("slanje").onclick = function(event) {
            var slanjeForme = true;

            var poljeTitle = document.getElementById("title");
            var title = poljeTitle.value.trim();
            if (title.length < 5 || title.length > 30) {
                slanjeForme = false;
                poljeTitle.style.border = "1px dashed red";
                document.getElementById("porukaTitle").innerText = "\nNaslov vijesti mora imati između 5 i 30 znakova!";
                porukaTitle.style.color = "red";
            } else {
                poljeTitle.style.border = "1px solid green";
                document.getElementById("porukaTitle").innerText = "";
            }

            var poljeAbout = document.getElementById("about");
            var about = poljeAbout.value.trim();
            if (about.length < 10 || about.length > 100) {
                slanjeForme = false;
                poljeAbout.style.border = "1px dashed red";
                document.getElementById("porukaAbout").innerText = "\nKratki sadržaj mora imati između 10 i 100 znakova!";
                porukaAbout.style.color = "red";
            } else {
                poljeAbout.style.border = "1px solid green";
                document.getElementById("porukaAbout").innerText = "";
            }

            var poljeContent = document.getElementById("content");
            var content = poljeContent.value.trim();
            if (content.length === 0) {
                slanjeForme = false;
                poljeContent.style.border = "1px dashed red";
                document.getElementById("porukaContent").innerText = "\nSadržaj mora biti unesen!";
                porukaContent.style.color = "red";
            } else {
                poljeContent.style.border = "1px solid green";
                document.getElementById("porukaContent").innerText = "";
            }

            var poljeSlika = document.getElementById("pphoto");
            var pphoto = poljeSlika.value;
            if (pphoto.length === 0) {
                slanjeForme = false;
                poljeSlika.style.border = "1px dashed red";
                document.getElementById("porukaSlika").innerText = "\nSlika mora biti unesena!";
                porukaSlika.style.color = "red";
            } else {
                poljeSlika.style.border = "1px solid green";
                document.getElementById("porukaSlika").innerText = "";
            }

            var poljeCategory = document.getElementById("category");
            if (poljeCategory.selectedIndex === 0) {
                slanjeForme = false;
                poljeCategory.style.border = "1px dashed red";
                document.getElementById("porukaKategorija").innerText = "\nKategorija mora biti odabrana!";
                porukaKategorija.style.color = "red";
            } else {
                poljeCategory.style.border = "1px solid green";
                document.getElementById("porukaKategorija").innerText = "";
            }

            if (!slanjeForme) {
                event.preventDefault();
            }
        };
    </script>
</body>
</html>
