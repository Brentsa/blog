@extends('layout')

@section('content')
    <article>
        <h1>
            {{ $post->title }}
        </h1>
        <div>
            {!! $post->body !!}
        </div>
        <a href="/">go back</a>
    </article>
@endsection