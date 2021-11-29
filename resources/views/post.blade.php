<x-layout>
    <article>
        <h1>
            {!! $post->title !!}
        </h1>
        <p>
            By <a href="#">{{$post->user->name}}</a> in <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
        </p>
        <div>
            {!! $post->body !!}
        </div>
        <a href="/">go back</a>
    </article>
</x-layout>