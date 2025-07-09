<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    public $fillable = ['name', 'slug'];

    // relasione to many model book

    public function book()
    {
        return $this->hasMany(Book::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
