<?php
    function logovanje() {
        if(isset($_SESSION['login'])) {
            if($_SESSION['login'] == '1') {
                if(isset($_SESSION['username'])) {
                    $username = $_SESSION['username'];
                    echo "<p>Dobrodošli $username!</p>";
                }
            }
        }

        if(!isset($_SESSION['login']) || $_SESSION['login'] != '1') {
            echo '<form method="POST" action="login/login.php">
                        <label for="username">Korisničko ime </label>
                        <input type="text" name="username" id="username">
                        
                        <label for="password">Lozinka </label>
                        <input type="password" name="password" id="password">
                        
                        <input type="submit" name="login" value="Prijavi se">                        
                  </form>';
                  
            if(isset($_SESSION['login']) && $_SESSION['login'] == 0) {
                echo '<p>Pogrešno korisničko ime ili lozinka. Pokušajte ponovo!</p>';
            }
        }
    }
