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

    protected $casts = [
        'returned_at' => 'datetime',
        'updated_at' => 'datetime',
    ];      

    public function calculateFines()
    {
        $fine = 0;

        $dueDate = $this->returned_at;
        $actualReturn = $this->updated_at;
        
        if($this->lending_status === 'borrowed' && $this->status === 'success') {
            if ($actualReturn && $dueDate && $actualReturn->greaterThan($dueDate)) {
                $daysLate = $dueDate->diffInDays($actualReturn);
                $fine += 1000 * $daysLate;
            }

            if ($this->book_status === 'bad' && $this->book) {
                $fine += $this->book->price;
            }
        }

        return $fine;
    }

    // relasi many to many dengan Lending
    public function books()
    {
        return $this->belongsToMany(Book::class, 'order_lendings')
            ->withPivot('qty')
            ->withTimestamps();
    }

}