@extends('layouts.app')

@section('content')

        <h1>Edit the blog</h1>
        {!! Form::open(['action' =>['App\Http\Controllers\PostsController@update', $posts->id] , 'method'=>'POST']) !!} <!--[PostsController::class, 'store']-->
        <div class="form-group">
          {{Form::label('title', 'Title')}}
          {{Form::text('title', $posts->title, ['class'=>'form-control', 'placeholder'=>'give an interesting Title to your blog'])}}
        </div>
        <div class="form-group">
          {{Form::label('body', 'Body')}}
          {{Form::textarea('body', $posts->body, ['class'=>'form-control', 'placeholder'=>'Type you content here...'])}}
        </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Save changes',['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}

@endsection
