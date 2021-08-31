<?php
    require_once 'login/loginProvera.php';
?>
<!DOCTYPE html>
<html lang="sr">
<head>
    <title>Pregled proizvoda</title>
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
            <p>Sortiranje proizvoda po:</p>

            <div class="radio-wrapper">
                <input type="radio" name="radioSort" id="product-name" value="naziv" onclick="sortProduct()">
                <label for="product-name">Nazivu</label>

                <input type="radio" name="radioSort" id="product-size" value="velicina" onclick="sortProduct()">
                <label for="product-size">Veličini</label>

                <input type="radio" name="radioSort" id="product-color" value="boja" onclick="sortProduct()">
                <label for="product-color">Boji</label>

                <input type="radio" name="radioSort" id="product-type" value="tipproizvoda" onclick="sortProduct()">
                <label for="product-type">Tipu</label>

                <input type="radio" name="radioSort" id="product-votes" value="brojglasova" onclick="sortProduct()">
                <label for="product-votes">Broju glasova</label>
            </div>

            <div class="search-wrapper">
                <label for="searchText">Pretraga proizvoda po nazivu</label>
                <input type="text" name="searchText" id="searchText" onkeyup="searchProduct()">
            </div>

            <div class="product-table" id="product-table">
                <?php
                    require_once 'konekcija/konekcija.php';

                    $sql = "SELECT * FROM proizvodi ORDER BY naziv";
                    if($result = $mysqli->query($sql)) {
                        if(mysqli_num_rows($result) > 0) {
                            echo '<table border="1">
                                    <tr>
                                       <th>Naziv</th>
                                       <th>Veličina</th>       
                                       <th>Boja</th>    
                                       <th>Tip</th>
                                       <th>Glasovi</th>                     
                                    </tr>';

                            while($products = $result->fetch_object()) {
                                echo "<tr>
                                         <td>$products->naziv</td>
                                         <td>$products->velicina</td>
                                         <td>$products->boja</td>
                                         <td>$products->tipproizvoda</td>
                                         <td>$products->brojglasova</td>
                                      </tr>";
                            }
                                echo '</table>';
                                $mysqli->close();
                        } else {
                            echo 'Nema proizvoda.';
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