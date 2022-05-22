@extends('layouts.admin')

@section('pageTitle', $post->title)

@section('content')
<main class="main_box">
    <div class="text-center my-4 box">
        <img src="{{ $post->image }}" alt="{{ $post->title }}" class="img-fluid">
        <h1>{{ $post->title }}</h1>
        <div>Created by: <strong>{{ $post->user->name }}</strong></div>
        <div>Phone number: {{ $post->user->userInfo->phone_number }}</div>
        <p>{{ $post->description }}</p>
        <div>Creation date: <strong>{{ $post->date_creation }}</strong></div>
        <div class="links mt-2">
            <a class="btn btn-primary" href="{{ url()->previous()}}" id="gray">Back</a>
            <a class="btn btn-primary" href="{{ route('admin.posts.edit', $post->id) }}">Edit</a>
            <a class="btn btn-primary" href="{{ route('admin.posts.index') }}">Return to posts list</a>
        </div>
       <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger mt-3" onClick="return confirm('Are you sure to delete this comic?')">Delete</button>
        </form>
    </div>
</main>
@endsection