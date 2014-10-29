<?php

class LogInModel{
	private $user;
	private $password;

	public function __construct(){
	$this->user = "Admin";
	$this->password = "Password";
	}

	public function loggingIn($user, $password)
	{
			
		if($user === $this->user && $password === $this->password){
		$_SESSION["LoggedIn"] = 1;
		$_SESSION["SessionID"] = $_SERVER["HTTP_USER_AGENT"];
		return true;
		}
		elseif($user === $this->user && $password === md5($this->password)){
			$_SESSION["LoggedIn"] = 1;
			$_SESSION["SessionID"] = $_SERVER["HTTP_USER_AGENT"];
			return true;
		}
		else{
		return false;
		}
	}

	//Kollar om användaren är inloggad eller ej
	public function loggedIn()
	{
		if(isset($_SESSION["LoggedIn"]) == true){
			return true;
		}
		else{
			return false;
		}
	}
	//Loggar ut genom att ta bort sessionen LoggedIn
	public function logOut(){
		unset($_SESSION["LoggedIn"]);
	}

	public function setTime($time){
		$file = "time.txt";
		$current = file_get_contents($file);
		$current = $time;
		file_put_contents($file, $current);
	}

	public function checkTime(){
		$file = "time.txt";
		$section = file_get_contents($file);
		if($section >= time()){
			return true;
		}
		else{
			return false;
		}
	}

	public function validateSession(){
		if(isset($_SESSION["SessionID"])){
		if($_SESSION["SessionID"] === $_SERVER["HTTP_USER_AGENT"]){
			return true;
		}
		else{
			return false;
		}}
		else{return false;}
	}
}