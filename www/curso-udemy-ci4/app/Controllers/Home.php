<?php

namespace App\Controllers;

class Home extends BaseController
{
/* 	public function index()
	{

		$servername = "database";
		$database = "base_de_datos";
		$username = "root";
		$password = "tiger";
		// Create connection
		$conn = mysqli_connect($servername, $username, $password, $database);
		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		echo "Connected successfully";
		mysqli_close($conn);
	} */

	public function contacto($name = "default")
	{
		$dataHeader = [
			'title' => 'Contacto ' . $name
		];

		echo view('dashboard/templates/header', $dataHeader);
		echo view('welcome_message');
		echo view('dashboard/templates/footer');



	}
}
