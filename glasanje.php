<?php
    require_once 'login/loginProvera.php';
?>
<!DOCTYPE html>
<html lang="sr">
<head>
    <title>Glasanje</title>
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
            <p>U poslednjoj koloni tabele možete glasati za svoj omiljeni proizvod:</p>

            <div class="product-table">
				<?php
                    require_once 'konekcija/konekcija.php';
					$username = $_SESSION['username'];

                    $sql = "SELECT * FROM proizvodi";
					if($result = $mysqli->query($sql)) {
                        if(mysqli_num_rows($result) > 0) {
                            echo '<table border="1">
                                    <tr>
										<th>Proizvod</th>
                                        <th>Boja</th>   
                                        <th>Broj glasova</th>
		    							<th>GLASAJ</th>
									</tr>';
                            while($products = $result->fetch_object()) {
								echo "<tr>
                                         <td>$products->naziv $products->velicina</td>
                                         <td>$products->boja</td>
                                         <td>$products->brojglasova</td>
										 <td><a href='#' class='action-link' onClick='vote($products->idproizvod)'><b>Glasaj</b></a></td>
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