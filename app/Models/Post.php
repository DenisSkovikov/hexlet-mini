<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = ['title', 'body'];
    
    // Связываем пост с пользователем (у поста может быть только один создатель(пользователь))
    public function creator()
    {
        return $this->belongsTo(__NAMESPACE__ . '\User');
    }
    
    // Связываем пост с лайками (у одного поста может быть много лайков)
    public function likes()
    {
        return $this->hasMany(__NAMESPACE__ . '\PostLike', 'post_id');
    }
    
    // Скоуп выбирает только опубликованные
    public function scopePublished($query)
    {
        return $query->where('state', 'published');
    }
    
    // Скоуп (динамический) выбирает самые залайканные посты и только опубликованные
    public function scopeManyLikes($query, $limit)
    {
        return $query->published()->orderBy('likes_count', 'desc')->limit($limit);
    }
}
