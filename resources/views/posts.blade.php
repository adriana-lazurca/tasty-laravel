@extends('layout')

@section('content')
<h1>MY TASTY RECIPES</h1>
<?php foreach ($posts as $post) { ?>
    <article>
        <h1>
            <a href="/posts/<?= $post->slug ?>">{!! $post->title !!}</a>

        </h1>
        <p>
            <a href="/categories/{{$post->category->slug}}">{{$post->category->name}}</a>
        </p>
        <div>{!! $post->excerpt !!}</div>
    </article>
<?php } ?>
@endsection