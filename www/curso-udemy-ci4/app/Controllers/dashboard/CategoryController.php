<?php

namespace App\Controllers\dashboard;

use App\Controllers\BaseController;

class CategoryController extends BaseController
{
	public function index()
	{
		echo view('dashboard/templates/header');
		echo view('dashboard/movie/index');
		echo view('dashboard/templates/footer');
	}




}








?>