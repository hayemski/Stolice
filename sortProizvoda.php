<?php
	require_once 'konekcija/konekcija.php';
	
	$sort = $_GET['sort'];
	$sql = "SELECT * FROM proizvodi ORDER BY $sort";

	if($sort == "brojglasova") {
		$sql = "SELECT * FROM proizvodi ORDER BY brojglasova DESC";
	} else {
		$sql = "SELECT * FROM proizvodi ORDER BY $sort";
	}

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
