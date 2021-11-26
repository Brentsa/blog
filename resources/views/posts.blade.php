@extends('layout')

@section('banner')
    <h1>My Blog</h1>
@endsection

@section('content')
    @foreach($posts as $post)
        <article>
            <h2>
                <a href="/posts/{{ $post->slug }}">
                    <?= $post->title; ?>
                </a>
            </h2>
            <div>
                <?= $post->excerpt; ?>     
            </div>
        </article>
    @endforeach 
@endsection
