<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $table = 'category';

    protected $fillable = [
        'title',
        'image',
        'desc',
        'created_at',
        'updated_at',
    ];

    public function tintucs()
    {
        return $this->hasMany(news::class, 'id_category');
    }
}
