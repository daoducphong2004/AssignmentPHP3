<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class news extends Model
{
    use HasFactory;
    protected $table = 'news';

    protected $fillable = [
        'title',
        'img',
        'desc',
        'content',
        'view',
        'like',
        'id_author',
        'id_category',
        'created_at',
        'updated_at',
    ];

    public function category()
    {
        return $this->belongsTo(category::class, 'id_category');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'id_author');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'tintuc_id')->whereNull('parent_id');
    }
}
