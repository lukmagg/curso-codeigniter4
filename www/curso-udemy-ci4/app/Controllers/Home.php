<?php

namespace App\Controllers;

class Home extends BaseController
{
 	public function index()
	{
		return view('welcome_message');
	
	} 

	function image($movieId = null, $image = null){
	
		if($movieId == null){
			$movieId = $this->request->getGet('movie_id');
		}

		if($image == null){
			$image = $this->request->getGet('image');
		}

		if($movieId == '' || $image == ''){
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		// abre el archivo en modo binario
		$name = WRITEPATH.'uploads/movies/'.$movieId.'/'.$image;
		

	
		if(!file_exists($name)){
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		$fp = fopen($name, 'rb');

		// envia las cabeceras correctas
		header("Content-Type: image/jpg");
		header("Content-Length: " . filesize($name));

		// vuelca la imagen y detiene el script
		fpassthru($fp);
		exit;
	}

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
