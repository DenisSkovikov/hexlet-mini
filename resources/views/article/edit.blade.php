@extends('layouts.app')

@section('content')
    <h1>Редактировать статью</h1>
    
    {{ Form::model($article, ['route' => ['articles.update', $article], 'method' => 'PATCH']) }}
        @include('article.form')
        {{ Form::submit('Изменить') }}
    {{ Form::close() }}

@endsection