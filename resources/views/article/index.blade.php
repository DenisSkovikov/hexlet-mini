@extends('layouts.app')

@section('content')
    <div>
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif
    </div>
    <div>Найдено: {{$articles->count()}}</div>
    {{Form::open(['route' => 'articles.index', 'method' => 'GET'])}}
    {{Form::text('q', $q)}}
    {{Form::submit('найти')}}
    {{Form::close()}}
    <h1>Список статей</h1>
    <div><a href="{{route('articles.create');}}">Добавить статью</a></div>
    @foreach ($articles as $article)
        <div style="background-color: #f0f0f0; margin: 5px; padding: 5px;">
            <a href="articles/{{$article->id}}">{{$article->name}}</a>
            {{-- Str::limit – функция-хелпер, которая обрезает текст до указанной длины --}}
            {{-- Используется для очень длинных текстов, которые нужно сократить --}}
            <div>{{Str::limit($article->body, 200)}}</div>
            <div><a href="/articles/{{$article->id}}/edit">Редактировать</a></div>
            <div><a href="/articles/{{$article->id}}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">Удалить</a></div>
        </div>
    @endforeach
        
    <div>{{ $articles->links() }}</div>
@endsection