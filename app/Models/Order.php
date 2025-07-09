<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $fillable= ['user_id','order_code','total_price','status'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    // relasi many to many dengan Book
    // pivot untuk memanggil yang ingin di panggil dari tabel books
    public function books(){
        return $this->belongsToMany(Book::class, 'order_books')->withPivot('qty','price');
    }
}
