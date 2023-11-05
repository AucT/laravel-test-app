<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $items = Post::paginate(10);
        return view('posts.index', ['items' => $items]);

    }
}
