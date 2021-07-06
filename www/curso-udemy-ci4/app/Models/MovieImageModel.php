<?php

namespace App\Models;

use CodeIgniter\Model;

class MovieImageModel extends Model
{
    protected $table      = 'movie_images';
    protected $primaryKey = 'id';
    protected $allowedFields = ['movie_id', 'image'];


    // Methods...

    function getByMovieId($id){
        return $this->asObject()
            ->where('movie_id', $id)
            ->findAll();
    }



}





?>