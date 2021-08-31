<?php
	function curPage() {
	    $curUrl = $_SERVER['REQUEST_URI'];
	    $curUrlArray = explode('/', $curUrl);
	    $name = end($curUrlArray);
	    return $name;
	} 

	error_reporting(E_ALL ^ E_NOTICE);
	
	if(!isset($_SESSION)) {
		session_start();
	}

	if(curPage() != 'index.php') {
		if(!isset($_SESSION['login'])) {
			header('Location: index.php');
		}
	}
