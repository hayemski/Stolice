<?php
	require_once 'flight/Flight.php';
	require_once 'jsonindent.php';

	Flight::register('db', 'Database', array('baza3'));
	$json_data = file_get_contents('php://input');    
	Flight::set('json_data', $json_data);
	
	Flight::route('GET /proizvodi.json', function() {
		header('Content-Type: application/json; charset=utf-8');
		$db = Flight::db();
		
		$data_json = Flight::get('json_data');
		$data = json_decode($data_json);
		
		if(!isset($_GET['search'])) {
			$db->select(" proizvodi ", ' * ', "tipovi", "idtip", "idtip", null, null);					
			$array = array();
			while($row = $db->getResult()->fetch_object()) {
				$array[] = $row;
			}
			$json_array = json_encode($array,JSON_UNESCAPED_UNICODE);
			echo '{' . '"proizvodi":' . indent($json_array) . ' }';
			return false;
		} else {
			$search = $_GET['search'];
			$db->select(" proizvodi ", ' * ', "tipovi", "idtip", "idtip", " naziv LIKE '%". $search ."%' ", null);
			$array = array();
			while($row = $db->getResult()->fetch_object()) {
				$array[] = $row;
			}
			$json_array = json_encode($array,JSON_UNESCAPED_UNICODE);
			echo '{' . '"proizvodi":' . indent($json_array) . ' }';
			return false;	
		} 
	});
	
	Flight::route('GET /proizvodi/@idtip.json', function($typeId) {
		header('Content-Type: application/json; charset=utf-8');
		$db = Flight::db();
		
		$data_json = Flight::get('json_data');
		$data = json_decode($data_json);
		
		if(!isset($_GET['search'])) {
			$db->select(" proizvodi ", ' * ', "tipovi", "idtip", "idtip", "proizvodi.idtip = ". $typeId, null);
			$array = array();
			while($row = $db->getResult()->fetch_object()) {
				$array[] = $row;
			}
			$json_array = json_encode($array,JSON_UNESCAPED_UNICODE);
			echo '{' . '"proizvodi":' . indent($json_array) . ' }';
			return false;
		} else {
			$search = $_GET['search'];
			$db->select(" proizvodi ", ' * ', "tipovi", "idtip", "idtip", " naziv LIKE '%". $search ."%' ", null);
			$array = array();
			while($row = $db->getResult()->fetch_object()) {
				$array[] = $row;
			}
			$json_array = json_encode($array,JSON_UNESCAPED_UNICODE);
			echo '{' . '"proizvodi":' . indent($json_array) . ' }';
			return false;		
		} 
	});

	Flight::route('GET /proizvod/@idproizvod.json', function($productId) {
		header('Content-Type: application/json; charset=utf-8');
		$db = Flight::db();
		$db->select(" proizvodi ", ' * ',  "tipovi", "idtip", "idtip", "proizvodi.idproizvod = ". $productId, null);
		$row = $db->getResult()->fetch_object();
		$json_array = json_encode($row,JSON_UNESCAPED_UNICODE);
		echo indent($json_array);
		return false;
	});

	Flight::route('GET /tipovi.json', function() {
		header('Content-Type: application/json; charset=utf-8');
		$db = Flight::db();
		
		$data_json = Flight::get('json_data');
		$data = json_decode($data_json);
		
		$db->select(" tipovi ", '*', "", "", "", null, null);	
		$array = array();
		while($row = $db->getResult()->fetch_object()) {
			$array[] = $row;
		}
		$json_array = json_encode($array,JSON_UNESCAPED_UNICODE);
		echo '{' . '"tipovi":' . indent($json_array) . ' }';
		return false;
	});

	Flight::route('PUT /proizvodi/@idproizvod', function($productId) {
		header('Content-Type: application/json; charset=utf-8');
		$db = Flight::db();
		
		$data_json = Flight::get('json_data');
		$data = json_decode($data_json);
		
		if($data == null) {
			$response['message'] = 'Niste prosledili podatke!';
			$json_response = json_encode($response);
			echo $json_response;
		} else {
			if(!property_exists($data,'naziv') || !property_exists($data,'idtip') || !property_exists($data,'velicina') || !property_exists($data,'cena') || !property_exists($data,'boja') || !property_exists($data,'materijal')) {
				$response['message'] = 'Niste prosledili korektne podatke!';
				$json_response = json_encode($response,JSON_UNESCAPED_UNICODE);
				echo $json_response;
				return false;	
			} else {
				if($db->update("proizvodi", $productId, array('naziv','idtip','velicina','boja','materijal','cena'), array($data->naziv, $data->idtip, $data->velicina, $data->boja, $data->materijal, $data->cena))) {
					$response['message'] = 'Uspešno ste izmenili proizvod!';
					$json_response = json_encode($response,JSON_UNESCAPED_UNICODE);
					echo $json_response;
					return false;
				} else {
					$response['message'] = 'Došlo je do greške pri izmeni!';
					$json_response = json_encode($response,JSON_UNESCAPED_UNICODE);
					echo $json_response;
					return false;
				}
			}
		}	
	});

	Flight::route('POST /proizvodi', function() {
		header('Content-Type: application/json; charset=utf-8');
		$db = Flight::db();
		
		$data_json = Flight::get('json_data');
		$data = json_decode($data_json);
		
		if($data == null) {
			$response['message'] = 'Niste prosledili podatke!';
			$json_response = json_encode($response);
			echo $json_response;
			return false;
		} else {
			if(!property_exists($data,'naziv') || !property_exists($data,'idtip') || !property_exists($data,'cena') || !property_exists($data,'velicina') || !property_exists($data,'boja') || !property_exists($data,'materijal')) {
				$response['message'] = 'Niste ispravno uneli sve podatke!';
				$json_response = json_encode($response,JSON_UNESCAPED_UNICODE);
				echo $json_response;
				return false;	
			} else {
				$data_query = array();
				foreach($data as $k => $v) {
					$v = "'" . $v . "'";
					$data_query[$k] = $v;
				}    
				if($db->insert("proizvodi","naziv,idtip,velicina,boja,materijal,cena", array($data_query['naziv'], $data_query['idtip'], $data_query['velicina'], $data_query['boja'], $data_query['materijal'], $data_query['cena']))) {
					$response['message'] = 'Novi proizvod je uspešno unet!';
					$json_response = json_encode($response,JSON_UNESCAPED_UNICODE);
					echo $json_response;
					return false;					
				} else {
					$response['message'] = 'Došlo je do greške!';
					$json_response = json_encode($response,JSON_UNESCAPED_UNICODE);
					echo $json_response;
					return false;
				}
			}
		}	
	});

	Flight::route('DELETE /proizvodi/@idproizvod', function($productId) {
		header('Content-Type: application/json; charset=utf-8');
		$db = Flight::db();
		
		if($db->delete("proizvodi", array("idproizvod"), array($productId))) {
			$response['message'] = 'Proizvod je uspešno obrisan!';
			$json_response = json_encode($response,JSON_UNESCAPED_UNICODE);
			echo $json_response;
			return false;
		} else {
			$response['message'] = 'Došlo je do greške prilikom brisanja!';
			$json_response = json_encode($response,JSON_UNESCAPED_UNICODE);
			echo $json_response;
			return false;		
		}				
	});

	Flight::route('GET /vizuelizacija.json', function() {
		header('Content-Type: application/json; charset=utf-8');
		$db = Flight::db();
		
		if(!isset($_GET['tip'])) {
			$db->select(" proizvodi ", ' * ', "tipovi", "idtip", "idtip", null, null);		
			$array = array();
			
			while($row = $db->getResult()->fetch_object()) {
				$array[] = $row;
			}
			$json_array = json_encode($array,JSON_UNESCAPED_UNICODE);
			$showJSON = '{  "cols": [{"label":"Proizvod","type":"string"}, {"label":"Cena proizvoda","type":"number"}], "rows":[ ';
			foreach($array as $key => $value) {
				$showJSON = $showJSON . '{"c":[{"v":"' . $value->naziv . '"},{"v":' . $value->cena . '}]},';
			}
			echo $showJSON . ']}';
			return false;
		} else {
			$type = $_GET['tip'];
			$db->select(" proizvodi ", ' * ', "tipovi", "idtip", "idtip", "proizvodi.idtip=" . $type, null);
			$array = array();
			
			while($row = $db->getResult()->fetch_object()) {
				$array[] = $row;
			}
			$json_array = json_encode($array,JSON_UNESCAPED_UNICODE);
			$showJSON = '{  "cols": [{"label":"Proizvod","type":"string"}, {"label":"Cena proizvoda","type":"number"}], "rows":[ ';
			foreach($array as $key => $value) {
				$showJSON = $showJSON . '{"c":[{"v":"' . $value->naziv . '"},{"v":' . $value->cena . '}]},';
			}
			echo $showJSON . ']}';
			return false;
		}
	});

	Flight::start();
