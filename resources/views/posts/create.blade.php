@extends('layouts.app')

@section('content')

        <h1>Create a new blog</h1>
        {!! Form::open(['action' =>'App\Http\Controllers\PostsController@store' , 'method'=>'POST']) !!} <!--[PostsController::class, 'store']-->
        <div class="form-group">
          {{Form::label('title', 'Title')}}
          {{Form::text('title','',['class'=>'form-control', 'placeholder'=>'give an interesting Title to your blog'])}}
        </div>
        <div class="form-group">
          {{Form::label('body', 'Body')}}
          {{Form::textarea('body','',['class'=>'form-control', 'placeholder'=>'Type you content here...'])}}
        </div>
        {{Form::submit('Upload',['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}

@endsection
