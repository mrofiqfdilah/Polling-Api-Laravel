<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class devision extends Model
{
    use HasFactory;
    protected $table = 'devision';
    protected $fillable = 
    [
        'name',
    ];
}
