<?php
    $db_server = 'localhost';
    $db_user = 'root';
    $db_password = '';
    $db_1 = 'baza1';
    $db_3 = 'baza3';
    
    $mysqli = new mysqli($db_server, $db_user, $db_password, $db_1);
    if ($mysqli->connect_errno) {
        printf('Konekcija neuspešna: %s\n', $mysqli->connect_error);
        exit();
    }
    $mysqli->set_charset('utf8');
    
    $mysqli3 = new mysqli($db_server, $db_user, $db_password, $db_3);
    if ($mysqli3->connect_errno) {
        printf('Konekcija neuspešna: %s\n', $mysqli3->connect_error);
        exit();
    }
    $mysqli3->set_charset('utf8');
