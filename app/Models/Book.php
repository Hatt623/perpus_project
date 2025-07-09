<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public $fillable = ['genre_id','title','slug','writer','publisher','image','description','price','stock'];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function cart(){
        return $this->hasMany(Cart::class);
    }

    public function lending()
    {
        return $this->hasMany(Lending::class);
    }

    public function return()
    {
        return $this->hasMany(Returns::class);    
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // relasi many to many dengan order
    // Pivot digunakan untuk apa yang ingin dipanggil
    public function orders(){
        return $this->belongsToMany(Order::class)->withPivot('qty','price')
        ->withTimestamps();
    }

    public function lendings(){
        return $this->belongsToMany(Lending::class)->withPivot('qty')
        ->withTimestamps();
    }

}
