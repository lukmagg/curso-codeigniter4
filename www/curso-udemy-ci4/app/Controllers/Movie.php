<?php

namespace App\Controllers;

use App\Models\MovieModel;
use App\Models\CategoryModel;
use App\Models\MovieImageModel;
use App\Controllers\BaseController;


class Movie extends BaseController
{
	public function index()
	{

		$movie = new MovieModel();

	
		$data = [
			'movies' => $movie->asObject()
				->select('movies.*, categories.title as category')
				->join('categories', 'categories.id = movies.category_id')
				->paginate(10),
			'pager' => $movie->pager
		];

		$this->_loadDefaultView('Listado de peliculas', $data, 'index');
	}

	// Show
	public function show($id = null){
		$movieModel = new MovieModel();
		$imageModel = new MovieImageModel();
		$movie = $movieModel->asObject()->find($id);
		if($movie == null){
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		$validation = \Config\Services::validation();

		$this->_loadDefaultView($movie->title,
			[
				'movie'=>$movie, 
				'images' => $imageModel->getByMovieId($id)
			], 
			'show');
	}

	// Delete
	public function delete($id = null){
		$movie = new MovieModel();
		if($movie->find($id) == null){
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}
		$movie->delete($id);
		return redirect()->to('/movie')->with('message', 'Pelicula eliminada');
	}

	// Delete Image
	public function delete_image($imageId){
		$Images_Model = new MovieImageModel();

		$image = $Images_Model->asObject()->find($imageId);

		if($image == null){
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		// abre el archivo en modo binario
		$imgRoute = WRITEPATH.'uploads/movies/'.$image->movie_id.'/'.$image->image;
		
		if(!file_exists($imgRoute)){
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		// aca se borra la ruta de la imagen en la base de datos.
		$Images_Model->delete($imageId);

		// aca se borra la imagen desde la carpeta.
		unlink($imgRoute);

		return redirect()->back()->with('message', 'Imagen eliminada con exito!');



	}

	// New
	public function new(){
		$category = new CategoryModel();
		$movie = new MovieModel();
		$categories = $category->asObject()->findAll(); 
		$validation = \Config\Services::validation();
		$this->_loadDefaultView('Crear pelicula', ['validation'=>$validation, 'movie' => $movie, 'categories' => $categories], 'new');
	}	


	// Update
	public function update($id = null){
		$movie = new MovieModel();
		if($movie->find($id) == null){
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}
		if($this->validate('movies')){
			$movie->update(
				$id,
				[
					'title' => $this->request->getPost('title'),
					'description' => $this->request->getPost('description'),
					'category_id' => $this->request->getPost('category_id')
				]
			);
			$this->_upload($id);
			return redirect()->to('/movie')->with('message', 'Pelicula editada con exito.');
		}
		return redirect()->back()->withInput();
	}



	// Edit
	public function edit($id = null){
		$movieModel = new MovieModel();
		$category = new CategoryModel();
		$imagesModel = new MovieImageModel();

		$categories = $category->asObject()->findAll(); 
		$movie = $movieModel->asObject()->find($id);
		$images = $imagesModel->getByMovieId($id);
		
		if($movieModel->find($id) == null){
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}
		echo "Session: ". session('message');
		$validation = \Config\Services::validation();

		$this->_loadDefaultView('Crear pelicula', ['validation'=>$validation, 'categories'=>$categories, 'movie'=>$movie, 'images' => $images], 'edit');
	}



	// Create
	public function create(){
		$movie = new MovieModel();
		if($this->validate('movies')){
			$id = $movie->insert([
				'title' => $this->request->getPost('title'),
				'description' => $this->request->getPost('description'),
				'category_id' => $this->request->getPost('category_id')
			]);
			
			return redirect()->to("/movie/$id/edit")->with('message', 'Pelicula creada con exito.');
		}
		return redirect()->back()->withInput();
	}


	// upload
	private function _upload($movieId){
		// hasMoved: devuelve true si fue movida y false si aun no.
		// isValid: devuelve true si fue subida desde el form correctamente.
		//			y false en caso contrario.

		$images = new MovieImageModel();

		if($imagefile = $this->request->getFile('image')){
			if($imagefile->isValid() && !$imagefile->hasMoved()){
				$newName = $imagefile->getRandomName();
			
				$imagefile->move(WRITEPATH . 'uploads/movies/'.$movieId, $newName);

				$images->save([
					'movie_id' => $movieId,
					'image' => $newName
				]);
			}
		}
	}



	// _loadDefaultView
	private function _loadDefaultView($title, $data, $view){
		$dataHeader = [
			'title' => $title
		];

		echo view('dashboard/templates/header', $dataHeader);
		echo view('dashboard/movie/'.$view, $data);
		echo view('dashboard/templates/footer');
	}






}








?>