<?php
session_start();

require_once('configuration/configuration.php');

if(empty($_GET['page'])) 
	$_GET['page'] = "index";
	
if(!file_exists("pages/" . $_GET['page'] . ".php")) {
	include("pages/404.php");
	echo "<meta http-equiv='refresh' content='3; url=" . URL_SITE . "'> ";
	return;
}
	
if(isset($_POST['login'])) {
	$username = $_POST['username'];
    $password = hash('SHA512', md5($_POST['password']));
	$query = $login -> prepare("SELECT guid, pass, account FROM world_accounts WHERE account = ? AND pass = ?;");
	$query -> bindParam(1, $username);
	$query -> bindParam(2, $password);
	$query -> execute();
	$ok = $query -> rowCount();
	$query -> setFetchMode(PDO:: FETCH_OBJ);
	$account = $query -> fetch();
	$query -> closeCursor();
	
	if($ok) {
		$_GET['page'] = "signin";
		$_SESSION['user'] = $username;
		$_SESSION['data'] = $account;
		
		$_SESSION['id'] = $account -> guid;
		
		if(isset($_POST['checkbox'])) {
			setcookie("user", $username, time()+3600 * 24 * 7); 
			setcookie("pass", hash('SHA512', md5($password)), time()+3600 * 24 * 7); 
			echo "<script>window.location.replace(\"?page=signin&ok=5\")</script>";
		return;
		}
		echo "<script>window.location.replace(\"?page=signin&ok=1\")</script>";
		return;
	} else {
		echo "<script>window.location.replace(\"?page=signin&ok=0\")</script>";
		return;
	}
} else if(!isset($_SESSION['user']) && isset($_COOKIE["user"])) {
	$username = $_COOKIE["user"]; 
	$hash = $_COOKIE["pass"]; 
	
	$query = $login -> prepare("SELECT guid, pass, account FROM world_accounts WHERE account = ?;");
	$query -> bindParam(1, $username);
	$query -> execute();
	$ok = $query -> rowCount();
	$query -> setFetchMode(PDO:: FETCH_OBJ);
	$account = $query -> fetch();
	$query -> closeCursor();
	if($ok) {
		if(($account -> pass) == $hash) {
			$_SESSION['user'] = $username;
			$_SESSION['data'] = $account;
			$_SESSION['id'] = $account -> guid;
		}
	}
	$page = "pages/" . $_GET['page'] . ".php";	
} else {
	$page = "pages/" . $_GET['page'] . ".php";
}

include('include/header.php');
include($page);

if(!(strpos( PAGE_WITHOUT_RIGHT_MENU, $_GET['page']) !== false))
	include('include/rightmenu.php'); 
	
include('include/footer.php');
?>
