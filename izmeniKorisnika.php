<?php
    require_once 'konekcija/konekcija.php';

    $userId = $_POST['userId'];
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $activationId = $_POST['activationId'];
    $userTypeId = $_POST['userTypeId'];

    $sql = "UPDATE korisnik SET ime = '$name', prezime = '$lastname', korisnickoime = '$username', sifra = '$password', email = '$email', idaktivacije = $activationId, idtipakorisnika = $userTypeId 
            WHERE idkorisnika = $userId";

    $result = $mysqli->query($sql);
    echo "var_dump($result)";

    if($result) {
        header('Location: admin.php');
    }

    header('Location: admin.php');
