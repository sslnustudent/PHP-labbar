<?php

require_once("..\LogIn\LogInModel.php");

class LogInView{

	private $model;

	public function __construct(LogInModel $model){
		$this->model = $model;
	}

	public function showLogIn(){
		$ret = "<h1>Labrationskod ss222tb1</h1>";
		
		$oldname = "";
		/*if(isset($_POST["autologinbox"])){
		$ret .= "<h1>First Check</h1>";*/
		/*if($_POST["check1"] == "check")	{
			$ret .= "<h1>Check</h1>";
			}*/
		//}
		//Körs när man loggat ut
		if(isset($_GET["logout"])){
			//"Raderar" kakorna
			unset($_COOKIE["autopassword"]);
			$res = setcookie("autopassword", '', time() - 3600);

			unset($_COOKIE["autousername"]);
			$res = setcookie("autousername", '', time() - 3600);

			$this->model->logout();
		}
		//Gör att användarnamnet är kvar efter omladning
		if(!empty($_POST["nametxt"])){
			$oldname = $_POST["nametxt"];
		}
		//Körs om man fyllt i uppgifterna
		if(!empty($_POST["nametxt"]) && !empty($_POST["passwordtxt"]))
		{
			if($this->model->loggingIn($_POST["nametxt"], $_POST["passwordtxt"]) === true)
			{
				if(isset($_POST["check1"])){

					setcookie("autopassword", md5($_POST["passwordtxt"]), time() + (60 * 5));
					setcookie("autousername", $_POST["nametxt"] , time() + (60 * 5));
					$this->model->setTime(time() + (60 * 5));
					$ret .= "<p>Inloggningen lyckades och vi kommer ihåg dig nästa gång</p>";
				}
				$ret .= "<p>Admin Inloggad</p>";
				$ret .= "<p>Inloggningen lyckades</p>";

				$ret .= "<a href='?logout'>Logga ut</a>";
			}

			else
			{


				$ret .= "<h2>Ej Inloggad</h2>";
				$ret .= "<form action='?login' method='post' enctype='multipart/form-data'>
				<fieldset>
				<legend>Login - Skriv in användarnamn och lösenord</legend>";

				$ret .= "<p>Fel användarnamn eller lösenord</p>";

				$ret .= "<label>Användarnamn :</label>
				<input name='nametxt' type='text' value='$oldname'>
				<label>Lösenord :</label>
				<input name='passwordtxt' type='password'>
				<label>Håll mig inloggad :</label>
				<input type='checkbox' name='check1' value='check'>
				<input type='submit' name value='Logga in'>
				</fieldset>
				</form>";
			}
		}
		//Körs om man har valt att hålla sig inloggad
		elseif(isset($_COOKIE["autousername"]) && isset($_COOKIE["autopassword"])){

			if($this->model->checkTime() === true){
			if($this->model->loggingIn($_COOKIE["autousername"], $_COOKIE["autopassword"]) === true){
				$ret .= "<p>Admin Inloggad</p>";
			    $ret .= "<a href='?logout'>Logga ut</a>";
			}
			else{
				$ret .= "<h2>Ej Inloggad</h2>";
				$ret .= "<form action='?login' method='post' enctype='multipart/form-data'>
				<fieldset>
				<legend>Login - Skriv in användarnamn och lösenord</legend>";

				$ret .= "<p>Fel användarnamn eller lösenord</p>";

				$ret .= "<label>Användarnamn :</label>
				<input name='nametxt' type='text' value='$oldname'>
				<label>Lösenord :</label>
				<input name='passwordtxt' type='password'>
				<label>Håll mig inloggad :</label>
				<input type='checkbox' name='check1' value='check'>
				<input type='submit' name value='Logga in'>
				</fieldset>
				</form>";
			}
		}
		else{
				$ret .= "<h2>Ej Inloggad</h2>";
				$ret .= "<form action='?login' method='post' enctype='multipart/form-data'>
				<fieldset>
				<legend>Login - Skriv in användarnamn och lösenord</legend>";

				$ret .= "<p>Fel användarnamn eller lösenord</p>";

				$ret .= "<label>Användarnamn :</label>
				<input name='nametxt' type='text' value='$oldname'>
				<label>Lösenord :</label>
				<input name='passwordtxt' type='password'>
				<label>Håll mig inloggad :</label>
				<input type='checkbox' name='check1' value='check'>
				<input type='submit' name value='Logga in'>
				</fieldset>
				</form>";

		}
		}
		//Kollar om man är inloggad
		elseif($this->model->loggedIn() == true)
		{	
			if($this->model->validateSession() == true){
			$ret .= "<p>Admin Inloggad</p>";
			$ret .= "<a href='?logout'>Logga ut</a>";
		}
			if($this->model->validateSession() == false){
				$ret .= "<h2>Ej Inloggad</h2>";
				$ret .= "<form action='?login' method='post' enctype='multipart/form-data'>
				<fieldset>
				<legend>Login - Skriv in användarnamn och lösenord</legend>";

				$ret .= "<p>Fel användarnamn eller lösenord</p>";

				$ret .= "<label>Användarnamn :</label>
				<input name='nametxt' type='text' value='$oldname'>
				<label>Lösenord :</label>
				<input name='passwordtxt' type='password'>
				<label>Håll mig inloggad :</label>
				<input type='checkbox' name='check1' value='check'>
				<input type='submit' name value='Logga in'>
				</fieldset>
				</form>";
		}

		}
		

		else
		{


			$ret .= "<h2>Ej Inloggad</h2>";
			$ret .= "<form action='?login' method='post'>
			<fieldset>
			<legend>Login - Skriv in användarnamn och lösenord</legend>";

			if(!empty($_POST["nametxt"]) == ""){
				$ret .= "<p>Ange ett användarnamn</p>";
			}

			elseif(!empty($_POST["passwordtxt"]) == ""){
				$ret .= "<p>Ange ett lösenord</p>";
			}

			$ret .= "<label>Användarnamn :</label>
			<input name='nametxt' type='text' value='$oldname'>
			<label>Lösenord :</label>
			<input name='passwordtxt' type='password'>
			<label>Håll mig inloggad :</label>
			<input type='checkbox' name='check1' value='check'>
			<input type='submit' name value='Logga in'>
			</fieldset>
			</form>";
		}
		$ret .= "<p>";
		// Visar datum och tid på svenska
		setlocale(LC_TIME, "swedish");
		$ret .= strftime("%A den %d %B år %Y. Klockan är %H:%M:%S");
		$ret .= "</p>";
		return $ret;
	}

}