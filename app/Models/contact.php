<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    use HasFactory;
    protected $table = 'contact';

    protected $fillable = [
        'title', 
        'name', 
        'email', 
        'content', 
        'status', 
        'created_at',
        'updated_at',
    ];
}
