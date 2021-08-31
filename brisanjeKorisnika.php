<?php
    if(isset($_GET['userId'])) {
        require_once 'konekcija/konekcija.php';

        $userId = $_GET['userId'];
        $sql = "DELETE FROM korisnik WHERE idkorisnika = $userId";
        $result = $mysqli->query($sql);

        if($result) {
            echo 'Ok';
        }
    }
