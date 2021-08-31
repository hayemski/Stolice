<?php
	if(isset($_GET['productId'])) {
		require_once 'konekcija/konekcija.php';

		$productId = $_GET['productId'];
		$sql = "UPDATE proizvodi SET brojglasova = brojglasova + 1 WHERE idproizvod = $productId";
		$result = $mysqli->query($sql);

	    if($result) {
			echo 'Ok';
			print 'pregledProizvoda.php';
		}
	}
