<?php
	require_once 'login/loginProvera.php';

	if(isset($_SESSION['tipKorisnika'])) {
		
		if($_SESSION['tipKorisnika'] == '1') {
			require_once 'admin.php';
		}
		
		if($_SESSION['tipKorisnika'] == '2') {
			if($_SESSION['tipAktivacije'] == '1') {
				require_once 'obavestenje.php';
			} else {
                require_once 'pregledProizvoda.php';
            }
		}
	}
