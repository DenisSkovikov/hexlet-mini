<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Создаем Пост
    public static function create($user, $params)
    {
        //$f = array();
        //foreach ($f as $tt) {
        //    echo $tt;
        //}
        $post = $user->posts()->make($params);
        $post->save();
        return $post;
    }

    // Создаем Лайк и связываем его с постом и пользователем
    public static function createLike($user, $post)
    {
        $like = new PostLike();
        $like->creator()->associate($user);
        $like->post()->associate($post);
        $like->save();
        
        return $like;
    }
    
    // Показываем самые залайканные посты пользователя (запрос через Скоуп)
    public static function index($user, $limit)
    {
        $posts = $user->posts()->manyLikes($limit)->get();
        return $posts;
    }
}
