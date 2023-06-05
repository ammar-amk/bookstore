<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'authors';

    protected $fillable = ['name', 'email', 'biography'];

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }
}

