<?php

namespace App\Http\Controllers;

use App\post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function post(){
        // return request('query');
        $query = request('query');
        $posts= post::where("title", "like", "%$query%")->latest()->paginate(10);
        // return $posts;
        return view('posts.index', compact('posts'));
    }
}