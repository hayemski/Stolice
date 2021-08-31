<?php
    $productId = $_GET['idproizvod'];
    
    $url = 'http://localhost/Faris/proizvodi/'. $productId;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");     
    $curl_response = curl_exec($curl);
    curl_close($curl);
    $json_object = json_decode($curl_response);
    
    if(isset($json_object)) {
        header("Location: azuriranjeProizvoda.php?message=$json_object->message");
    }
