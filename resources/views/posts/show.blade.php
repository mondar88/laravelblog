@extends('layouts.app')

@section('content')
        <a href="/posts">Back</a>
        <h1>{{$posts->title}}</h1>
        <p>{{$posts->body}}</p>
        <hr>
        <small>Written at {{$posts->created_at}}</small>
        <hr>
        @if(!Auth::guest())
          @if(Auth::user()->id == $posts->user_id)
            <a href="/posts/{{$posts->id}}/edit" class="btn btn-default">Edit</a>
            {!! Form::open(['action' =>['App\Http\Controllers\PostsController@destroy', $posts->id] , 'method'=>'POST', 'class'=>'pull-right']) !!}
            {{Form::hidden('_method','DELETE')}}
            {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
            {!! Form::close() !!}
          @endif
        @endif
@endsection
