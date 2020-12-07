@extends('layouts.app')

@section('content')
        <a href="/posts">Back</a>
        <h1>{{$posts->title}}</h1>
        <h2>{{DB::table('users')->where('id', $posts->user_id)->value('name')}}</h2>
        <p>{{$posts->body}}</p>
        <hr>
        <small>Written at {{$posts->created_at}}</small>
        
        <div class="d-flex justify-content-center">
                  <button type="button"  class="btn btn-outline-success btn-sm " onclick="actOnReact(event);" data-react-id="{{$posts->id}}">Like</button>
                  <p id="likes-count-{{$posts->id}}"> {{$posts->post_like}}&nbsp;&nbsp;</p>
                  <p>&nbsp;&nbsp;</p>
                  
                  <button type="button" class="btn btn-outline-warning btn-sm" onclick="actOnReact(event);" data-react-id="{{$posts->id}}">Dislike</button>
                  <p id="dislikes-count-{{$posts->id}}">{{$posts->post_dislike}}</p>
        </div>
        
        <hr>
        @if(Auth::guest())
        <div class="form-group">
          {{Form::label('comment', 'Comment')}}
          {{Form::textarea('comment','',['class'=>'form-control', 'placeholder'=>'Tell us what you think...'])}}
        </div>
        <div class="form-group">
          {{Form::label('email', 'Email')}}
          {{Form::text('email','',['class'=>'form-control', 'placeholder'=>'Please enter your email. It will be just between us'])}}
        </div>
        {{Form::submit('Send',['class'=>'btn btn-primary'])}}
        @endif

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
@section('js')
    <script>
        
        var updateReactStats = {
            Like:function (reactId) {
                document.querySelector('#likes-count-' + reactId).textContent++;
            },

            Dislike:function (reactId) {
                document.querySelector('#dislikes-count-' + reactId).textContent++;
            }
        }
        


        var actOnReact = function (event) {
            var reactId = event.target.dataset.reactId;
            var action = event.target.textContent;
            updateReactStats[action](reactId);
            axios.post('/posts/' + reactId + '/react',
                { action: action })
        .then((response)=>{
            console.log(response)
        }).catch((error)=>{
            console.log(error.response.data)
        })
        };

    </script>
    @endsection