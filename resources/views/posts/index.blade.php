@extends('layouts.app')
  
@section('content')
   <ul>       
            @foreach($posts as $post)
            <li>
                <a href="{{route('posts.show', $post->id)}}">
                    {{$post->title}}
                </a>

                <a class="text-sm text-gray-500"
                   href="{{route('posts.edit', $post->id)}}">
                    Edit
                </a>

                <a class="text-sm text-gray-700"
                   href="{{route('posts.delete', $post->id)}}">
                    Delete
                </a>
            </li>
            @endforeach
    </ul>
@endsection

@section('createlink')
    <div class="text-sm text-gray-500 sm:text-right sm:ml-0 flex">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="ml-4 -mt-px w-5 h-5 text-gray-400">
                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
            </svg>

            <a href="{{route('posts.create')}}" class="ml-1 underline">
                Create post
            </a>
    </div>
@endsection