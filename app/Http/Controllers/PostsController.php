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

        $items = Post::query()->paginate(10)->withQueryString();
        return view('posts.index', ['items' => $items]);

    }
}
