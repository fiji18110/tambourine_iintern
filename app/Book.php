<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'subTitle',
        'imageUrl',
        'isbn',
    ];
    public function book(){
        return $this->hasMany('App\Book');
    }
}
