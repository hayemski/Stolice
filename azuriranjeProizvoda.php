<?php
    require_once 'login/loginProvera.php';
?>
<!DOCTYPE html>
<html lang="sr">
<head>
    <title>Ažuriranje</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
		function searchProduct(searchText) {
			var bodyTable = document.getElementById('ajaxData');
            var url = "http://localhost/Faris/proizvodi/'. $idtip .'.json?search=" + searchText;
			
            $.getJSON(url, function(serviceResponse) {
	            bodyTable.innerHTML = "";
				$.each(serviceResponse.proizvodi, function(i, proizvod) {
		            $("#ajaxData").append("<tr>" +
		            							"<td>" +
                                                    "<a href='stranicaZaIzmenuProizvoda.php?idproizvod=" + proizvod.idproizvod + "'><button class='button-secondary'>Izmeni</button></a>" +
                                                    "<a href='obrisiProizvod.php?idproizvod=" + proizvod.idproizvod + "'><button class='button-warning'>Obriši</button></a>" +
                                                "</td>" +
												"<td>" + proizvod.naziv + "</td>" +
												"<td>" + proizvod.tip + "</td>" +
												"<td>" + proizvod.velicina + "</td>" +
												"<td>" + proizvod.boja + "</td>" +
												"<td>" + proizvod.materijal + "</td>" +
											"</tr>");           
                })  
            });                  
        }
    </script>
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
			<div class="azuriranje">
				<?php
					if(isset($_GET['message'])) {
						$message = $_GET['message'];
						if($message == 'Uspešno ste izmenili proizvod!') {
							echo '<h3 style="color: green;">' . $message . '</h3>';
						} else {
							echo '<h3 style="color: red;">' . $message . '</h3>';
						}
					}

					$url = 'http://localhost/Faris/proizvodi.json';
					$curl = curl_init($url);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
					curl_setopt($curl, CURLOPT_HTTPGET, true);
					$curl_response = curl_exec($curl);
					curl_close($curl);
					$json_object = json_decode($curl_response);
				?>

                <div class="search-wrapper">
                    <label for="textSearch">Pretraga prema nazivu proizvoda</label>
                    <input type="text" name="textSearch" id="textSearch" onkeyup="searchProduct(this.value)">

                    <a href="dodavanjeProizvoda.php"><button class="button-secondary1">Dodaj proizvod</button></a>
                </div>

				<div class="table-wrapper">
					<table>
						<thead>
							<tr>
								<th>Izmeni / Obriši</th>
								<th>Naziv</th>
								<th>Tip</th>
								<th>Veličina</th>
								<th>Boja</th>
								<th>Materijal</th>
							</tr>
						</thead>
						<tbody id="ajaxData">
							<?php
								foreach($json_object->proizvodi as $product) {
									echo "<tr>
											<td>
											    <a href='stranicaZaIzmenuProizvoda.php?idproizvod=" . $product->idproizvod . "'><button class='button-secondary'>Izmeni</button></a>
											    <a href='obrisiProizvod.php?idproizvod=" . $product->idproizvod . "'><button class='button-warning'>Obriši</button></a>
                                            </td>
											<td>$product->naziv</td>
											<td>$product->tip</td>
											<td>$product->velicina</td>
											<td>$product->boja</td>
											<td>$product->materijal</td>
										</tr>";
								}
							?>  
						</tbody>
					</table>                                   
				</div>
			</div>    
        </section>
    </div>
</body>
</html>