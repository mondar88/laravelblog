<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      
      $this->middleware('auth', ['except' => ['index', 'show', 'react']]);
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
          'title' => 'required',
          'body' => 'required'
        ]);

        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->post_like = 0;
        $post->post_dislike = 0;
        $post->post_react = 0;
        $post->comment_count = 0;
        $post->save();

        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $posts = Post::find($id);
      $comments = $posts->comments()->orderBy('created_at', 'desc')->get();
      return view('posts.show')->with('posts', $posts)->with('comments', $comments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $posts = Post::find($id);
      if (auth()->user()->id !==  $posts->user_id) {
        return redirect('/posts')->with('error', 'Unauthorized attempt');
      }
      return view('posts.edit')->with('posts', $posts);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $post = Post::find($id);
      $post->title = $request->input('title');
      $post->body = $request->input('body');
      $post->save();

      return redirect('/posts')->with('success', 'Post updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if (auth()->user()->id !==  $posts->user_id) {
          return redirect('/posts')->with('error', 'Unauthorized attempt');
        }
        $post->delete();

        return redirect('/posts')->with('success', 'Post deleted');

    }

       /**
     * increment like or dislike for the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function react(Request $request, $id)
    {
      $action = $request->get('action');
        switch ($action) {
            case 'Like':
                Post::where('id', $id)->increment('post_like');
                break;
            case 'Dislike':
                Post::where('id', $id)->increment('post_dislike');
                break;
        }
        return '';
    }
}
