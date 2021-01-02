@extends('layouts.app')

@section('content')
        <h1>Welcome to Larablog blogs</h1>
        @if(count($posts)>1)
          <div class="card">
            <ul class="list-group list-group-flush">
              @foreach($posts as $post)
                <li class="list-group-item">
                  <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                  <small> Written on {{$post->created_at}} by <i> {{DB::table('users')->where('id', $post->user_id)->value('name')}}</i></small>
                  <span>
                  <div class="d-flex justify-content-center">
                  <button type="button"  class="btn btn-outline-success btn-sm disabled ">Like</button>
                  <p>{{$post->post_like}} &nbsp;&nbsp;</p>
                  
                  <button type="button" class="btn btn-outline-warning btn-sm disabled">Dislike</button>
                  <p>{{$post->post_dislike}}</p>
                  </div>
                  </span>
                  
                </li>
              @endforeach

            </ul>

          </div>
        @else
        <p>nothing to show</p>
        @endif
@endsection
