<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lending extends Model
{
    public $fillable = ['user_id','book_id','deadline','status','qty'];

    // relasi dengan user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // relasi dengan book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function returns()
    {
        return $this->hasMany(Returns::class);
    }

    // relasi many to many dengan returns
    // gunakan pivot untuk mengambil yang diiginkan
    public function books()
{
    return $this->belongsToMany(Book::class, 'order_lendings')
        ->withPivot('qty')
        ->withTimestamps();
}
    

}

