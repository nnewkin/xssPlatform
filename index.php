<?php
	header("Access-Control-Allow-Headers: Content-Type");
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: text/html;charset=utf-8");
	error_reporting(0);
	if(file_get_contents('php://input')){
		if(strpos(file_get_contents('php://input'),'information')==False){
			file_put_contents('null/'.date("Y.m.d").date("h:i:sa").'.txt',file_get_contents('php://input'));
		}
		else{
			include 'add.php';
			die();
		}
	}
	if($_GET['xss']=='xss'){
		include 'show.php';
	}else{
		echo "You are a shadiao!";	
	}
	
