<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authors extends Model
{
    use HasFactory;
    protected $table = "authors";
    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
        "id",
        "book_id"
    ];
}
