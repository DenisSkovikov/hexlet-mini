@extends('layouts.app')

@section('content')
    <h1>Добавить статью</h1>
    
    {{ Form::model($article, ['route' => 'articles.store']) }}
        @include('article.form')
        {{ Form::submit('Создать') }}
    {{ Form::close() }}

@endsection