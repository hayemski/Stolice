<?php
    require_once 'konekcija/konekcija.php';

    if(isset($_POST['submit'])) {
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST["email"];

        $sql = "INSERT INTO korisnik(ime, prezime, korisnickoime, sifra, email, idaktivacije, idtipakorisnika) VALUES ('" . $name . "', '" . $lastname . "', '" . $username . "', '" . $password .  "', '" . $email . "', 1, 2)";

        $result = $mysqli->query($sql);

        $mysqli->close();
    }
?>
<!DOCTYPE html>
<html lang="sr">
<head>
    <title>Registracija</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="top-bar">
            <a href="index.php">Nazad na početnu stranu</a>
        </div>

        <header><a href="#">Registruj se</a></header>

        <h2>
            <?php
                if (!isset($result)) {
                    $result = null;
                }
                
                if($result) {
                    echo 'Uspešno ste se registrovali. Sačekajte odobrenje od administratora!';
                }
            ?>
        </h2>

        <form class="form" method="POST" action="">
            <div>
                <label for="name">Ime</label>
                <input type="text" name="name" id="name">
            </div>

            <div>
                <label for="lastname">Prezime</label>
                <input type="text" name="lastname" id="lastname">
            </div>

            <div>
                <label for="email">E-mail</label>
                <input type="text" name="email" id="email">
            </div>

            <div>
                <label for="username">Korisničko ime</label>
                <input type="text" name="username" id="username">
            </div>

            <div>
                <label for="password">Lozinka</label>
                <input type="password" name="password" id="password">
            </div>

            <div>
                <label for="password2">Ponovi lozinku</label>
                <input type="password" name="password2" id="password2">
            </div>

            <input type="submit" class="button-success" name="submit" value="Registruj se">
        </form>
    </div>
</body>
</html>