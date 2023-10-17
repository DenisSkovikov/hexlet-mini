<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostLike extends Model
{
    use HasFactory;
    
    // Связываем лайк с постом (один лайк принадлежит одному посту)
    public function post()
    {
        return $this->belongsTo(__NAMESPACE__ . '\Post', 'post_id');
    }
    
    // Связываем лайк с пользователем который его поставил (один лайк принадлежит одному пользователю)
    public function creator()
    {
        return $this->belongsTo(__NAMESPACE__ . '\User', 'creator_id');
    }
}
