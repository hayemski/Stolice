<?php
    session_start();

    require_once '../konekcija/konekcija.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM korisnik WHERE korisnickoime = '$username' AND sifra = '$password'";
    $result = $mysqli->query($sql);

    if($result) {
        $num_rows = mysqli_num_rows($result);
        if($num_rows > 0) {
            session_start();
            $_SESSION['login'] = "1";		
            $_SESSION['username'] = $username;

            if($user = $result->fetch_object()) {
                $_SESSION['tipKorisnika'] = $user->idtipakorisnika;
                $_SESSION['tipAktivacije'] = $user->idaktivacije;

                header("Location: ../pocetna.php");
            }
        } else {
            session_start();
            $_SESSION['login'] = '0';       

            header("Location: ../index.php");
        }
    } else {
        header("Location: ../index.php"); 
    }
