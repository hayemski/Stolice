<?php
    require_once 'login/loginProvera.php';
?>
<!DOCTYPE html>
<html lang="sr">
<head>
    <title>Admin</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/skripteZaKorisnike.js"></script>
</head>
<body>
    <div class="container">    
        <div class="top-bar">
            <?php                    
                require_once 'login/logovanje.php';
                logovanje();
                if($_SESSION['tipKorisnika'] == '1') {
                    echo '<a href="admin.php">Administratorski deo</a>';
                }
            ?>
            <a class="logout" href="login/logout.php">Odjavi se</a>
        </div>
        
        <?php require_once 'template.php';?>
        
        <section>
            <p>Tabela korisnika</p>

            <div class="product-table" id="edit">
                <?php
                    require_once 'konekcija/konekcija.php';

                    $username = $_SESSION['username'];
                    $sql = "SELECT * FROM korisnik k JOIN tipkorisnika t ON k.idtipakorisnika = t.idtipakorisnika WHERE korisnickoime != '$username'";
                                
                    if($result = $mysqli->query($sql)) {
                        if(mysqli_num_rows($result) > 0) {
                            echo '<table border="1">
                                    <tr>
                                        <th>Tip korisnika</th>
                                        <th>Ime</th>
                                        <th>Prezime</th>       
                                        <th>Korisničko ime</th>    
                                        <th>Email</th>
                                        <th>Aktivacija</th>    
                                        <th>Izmeni</th>    
                                        <th>Izbriši</th>
                                    </tr>';
                            while($user = $result->fetch_object()) {
                                echo "<tr>
                                        <td>$user->nazivtipakorisnika</td>
                                        <td>$user->ime</td>
                                        <td>$user->prezime</td>
                                        <td>$user->korisnickoime</td>
                                        <td>$user->email</td>
                                        <td>$user->idaktivacije</td>
                                        <td><a href='#' class='action-link' onClick='updateUser($user->idkorisnika)'>Izmeni</a></td>
                                        <td><a href='#' class='action-link' onClick='deleteUser($user->idkorisnika)'>Izbriši</a></td>
                                      </tr>";
                            }
                            echo '</table>';
                            $mysqli->close();
                        } else {
                            echo 'Nema korisnika.';
                        }
                    } else {
                        echo 'Greška!';
                    }
                ?>
            </div>
        </section>             
    </div>
</body>
</html>