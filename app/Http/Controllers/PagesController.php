<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PagesController extends Controller
{
   public function index()
    {
      $data = DB::table('posts')->select(DB::raw('title as title'),
                                          DB::raw('post_like + post_dislike as post_engage'))
                                          ->groupBy('title')
                                          ->get();
      $array[] = ['title', 'post_engage'];
      foreach($data as $key => $value)
      {
          $array[++$key] = [$value->title, $value->post_engage];
      }
      return view('pages.index')->with('title', json_encode($array));
    }

    public function services()
     {
       return view('pages.services');
     }

     public function about()
      {
        return view('pages.about');
      }
}
