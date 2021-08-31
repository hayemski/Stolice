<?php
    require_once 'konekcija/konekcija.php';
    
    $userId = $_GET['userId'];
    $sql = "SELECT * FROM korisnik WHERE idkorisnika = $userId";
    $result = $mysqli->query($sql);
    if($result) {
        $row = $result->fetch_object();
    }

    echo "
        <h3>Izmena podataka za izabranog korisnika</h3>
        
        <form class='form' method='POST' action='izmeniKorisnika.php'>
            <input type='hidden' name='userId' id='userId' value='$row->idkorisnika'>
            
            <div>
                <label for='name'>Ime</label> 
                <input type='text' name='name' id='name' value='$row->ime'>
            </div>
            
            <div>
                <label for='lastname'>Prezime</label>
                <input type='text' name='lastname' id='lastname' value='$row->prezime'>
            </div>
            
            <div>
                <label for='username'>Korisničko ime</label>
                <input type='text' name='username' id='username' value='$row->korisnickoime'>
            </div>
            
            <div>
                <label for='password'>Lozinka</label>
                <input type='text' name='password' id='password' value='$row->sifra'>
            </div>
            
            <div>
                <label for='email'>Email</label>
                <input type='text' name='email' id='email' value='$row->email'>
            </div>
            
            <div>
                <label for='activationId'>Aktivacija</label>
                <input type='text' name='activationId' id='activationId' value='$row->idaktivacije'>
            </div>
            
            <div>
                <label for='userTypeId'>Tip korisnika</label>
                <input type='text' name='userTypeId' id='userTypeId' value='$row->idtipakorisnika'>
            </div>
            
            <input type='submit' class='button-success' value='Sačuvaj izmene!'>
            <input type='reset' class='button-secondary1' value='Poništi izmene!' onclick='skloniFormu()'>
        </form>";
