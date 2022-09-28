@extends('layouts.app')
@section('content')
    <h1>Delete this post permanently</h1>
    <form method="post" action="/posts/{{$post->id}}">
    {{csrf_field()}}
    <input type="hidden" name="_method" value="DELETE"/>

        {{$post->title}}
        
        <input type="submit" name="submit" value="Delete"/>   
        
        <a class="text-sm text-gray-700" href="{{route('posts.index')}}">
                    Go back
        </a>
    </form>
@endsection