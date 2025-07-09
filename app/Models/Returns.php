<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Returns extends Model
{
    public $fillable = ['lending_id','user_id','book_id','returned_at','fines','book_status','status','lending_status'];

    public function lending()
    {
        return $this->belongsTo(Lending::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // relasi many to many dengan Lending
    public function books()
    {
        return $this->belongsToMany(Book::class, 'order_lendings')
            ->withPivot('qty')
            ->withTimestamps();
    }

}