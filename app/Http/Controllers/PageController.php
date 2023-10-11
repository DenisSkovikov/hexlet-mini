<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        // Точка используется вместо /.
        // То есть шаблон находится по пути resources/views/page/about.blade.php
        $team = [
            ['name' => 'иванов', 'post' => 'директор'],
            ['name' => 'петров', 'post' => 'прогер']
        ];
        return view('page.about', ['team' => $team]);
    }
    
    public function team()
    {
        return view('page.team');
    }
}
