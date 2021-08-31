<?php
    $productId = $_GET['idproizvod'];
    if(isset($_POST['naziv']) && isset($_POST['tip']) && isset($_POST['velicina']) && isset($_POST['boja']) && isset($_POST['materijal'])) {    
        $productUpdate = '{
                            "naziv": "' . $_POST['naziv'] . '",
                            "idtip": "' . $_POST['tip'] . '",
                            "velicina":"' . $_POST['velicina'] . '",
                            "boja":"' . $_POST['boja'] . '",
                            "materijal":"' . $_POST['materijal'] . '",
                            "cena":"' . $_POST['cena'] . '"
                           }';
    } else {
        $productUpdate = '{"Greška": "Niste uneli sve podatke!"}';
    }
    
    $url = 'http://localhost/Faris/proizvodi/' . $productId;
    $curl = curl_init($url);                                     
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);            
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");     
    curl_setopt($curl, CURLOPT_POSTFIELDS, $productUpdate);
    $curl_response = curl_exec($curl);                           
    curl_close($curl);                                           
    $json_object = json_decode($curl_response);
    
    if(isset($json_object)) {
        header("Location: azuriranjeProizvoda.php?message=$json_object->message");
    }
