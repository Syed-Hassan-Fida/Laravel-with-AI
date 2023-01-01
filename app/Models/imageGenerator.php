<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class imageGenerator extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "url",
        "image",
        "image_id"

    ];
}
