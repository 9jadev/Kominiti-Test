<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Authors;
class Book extends Model
{
    use HasFactory;
    protected $table = "books";
    protected $guarded = [];
    protected $with = ['authorsdata'];
    protected $appends = ['authors'];

    protected $hidden = [
        'created_at',
        'updated_at',
        'authorsdata'
    ];

    public function authorsdata()
    {
        return $this->hasMany(Authors::class, "book_id", "id");
    }

    public function getAuthorsAttribute()
    {

        return $this->authorsdata()->pluck('author_name');

    }

}
