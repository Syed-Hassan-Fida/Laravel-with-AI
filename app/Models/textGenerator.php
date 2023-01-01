<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class textGenerator extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'vote'
    ];
}
